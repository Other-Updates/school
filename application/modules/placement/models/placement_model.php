<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * History_model
 *
 * This model represents tasker history. It operates the following tables:
 * - history,
 *
 * @package	i2_soft
 * @author	Elavarasan
 */
 
class Placement_model extends CI_Model{

    private $table_name	= 'placement';	
	  private $table_name1	= 'placement_student';	
	function __construct()
	{
		parent::__construct();

	}
	
	
	/**
	 * Insert new placement
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function insert_interview($data)
	{
		if ($this->db->insert($this->table_name, $data)) {
			$insert_id = $this->db->insert_id();
			
			return $insert_id;
		}
		return false;
	}
	function insert_more_interview_details($data)
	{
		if ($this->db->insert_batch($this->table_name1, $data)) {
			return true;
		}
		return false;
	}
	/**
	 * Update a ur_title
	 *
	 * @param	array
	 * @param	int
	 * @return	bool
	 */
	function update_interview($data,$id)
	{
		$this->db->where('id', $id);
		
		if ($this->db->update($this->table_name, $data)) {
			
			return true;
		}
		return false;
	}
	function update_student_participation_status($where,$data)
	{
		$this->db->where($where);
		
		if ($this->db->update($this->table_name1, $data)) {
			
			return true;
		}
		return false;
	}
	
	/**
	 * Delete a ur_title
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_time_table($id)
	{
		$this->db->where('time_table_id', $id);
		$this->db->delete($this->table_name2);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	function delete_other_interview_details($id)
	{
		$this->db->where('placement_id', $id);
		$this->db->delete($this->table_name1);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	
	function get_all_placement()
	{
		$this->db->select('*');
		$query = $this->db->get($this->table_name)->result_array();
		$i=0;
		foreach($query as $val)
		{
			$this->db->select('count(placement_student.id) as eligibility_student');
			$this->db->where('placement_student.placement_id', $val['id']);
			$query[$i]['eligibility_student']=$this->db->get($this->table_name1)->result_array();
			
			$this->db->select('count(placement_student.id) as interested_student');
			$this->db->where('placement_student.placement_id', $val['id']);
			$this->db->where('placement_student.participation', 1);
			$query[$i]['interested_student']=$this->db->get($this->table_name1)->result_array();
			
			$this->db->select('count(placement_student.id) as placed_student');
			$this->db->where('placement_student.placement_id', $val['id']);
			$this->db->where('placement_student.placed', 1);
			$query[$i]['placed_student']=$this->db->get($this->table_name1)->result_array();
			
			$i++;
		}
		return $query;
	}
	function get_department($id)
	{
		$this->db->select('nickname');
		$this->db->where('id',$id);
		$query = $this->db->get('department');
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	function get_batch($id)
	{
		$this->db->select('from,to');
		$this->db->where('id',$id);
		$query = $this->db->get('batch');
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	function get_placement_by_id($id)
	{
	
		$this->db->select('*');
		$this->db->where('id',$id);
		$query = $this->db->get($this->table_name)->result_array();
		$i=0;
		foreach($query as $val)
		{
			$this->db->select('student.id,student.name,image,contact_no,student.std_id as roll_no');
			$this->db->select('group.group');
			$this->db->select('batch.from,batch.to');
			$this->db->select('department.department');
			$this->db->select($this->table_name1.'.placed,'.$this->table_name1.'.id as placement_student_id');
			
			$this->db->where($this->table_name1.'.placement_id',$val['id']);
			$this->db->where($this->table_name1.'.participation',1);
			$this->db->join('student','student.id='.$this->table_name1.'.student_id');	
			$this->db->join('student_group','student_group.student_id=student.id');	
			$this->db->join('batch','batch.id=student_group.batch_id');	
			$this->db->join('group','group.id=student_group.group_id');		
			$this->db->join('department','department.id=student_group.depart_id');	
			$query[$i]['interested_std']=$this->db->get($this->table_name1)->result_array();
			$j=0;
			foreach($query[$i]['interested_std'] as $val1)
			{
				$this->db->select('AVG(external_details.total_cgb) as total_mark');
				$this->db->where('std_id',$val1['id']);

				$query[$i]['interested_std'][$j]['internal_details'] = $this->db->get('external_details')->result_array();
				$j++;
			}
		}
		return $query;
	}
	function get_participate_status($p_id,$std_id)
	{
		$this->db->select('participation,placed');
		$this->db->where('placement_id',$p_id);
		$this->db->where('student_id',$std_id);
		$query = $this->db->get($this->table_name1)->result_array();
		return $query;
	}
	
}