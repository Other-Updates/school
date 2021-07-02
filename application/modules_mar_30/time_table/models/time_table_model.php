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
 
class Time_table_model extends CI_Model{

    private $table_name	= 'time_table';	
	  private $table_name1	= 'subject_details';	
	   private $table_name2	= 'time_table_details';	
	    private $table_name3	= 'other_time_tables';	
		 private $table_name4	= 'other_time_table_details';	
		  private $table_name5	= 'mas_college_det';
		  private $table_name6	= 'arrear_time_table';	
	function __construct()
	{
		parent::__construct();

	}
	
	/**
	 * Get all ur_title
	 *
	 * @return	array
	 */
	function get_all_details_by_id($batch,$depart_id,$group_id,$sem_id)
	{
		$this->db->where('batch_id', $batch);
		$this->db->where('depart_id', $depart_id);
		$this->db->where('group_id', $group_id);
		$this->db->where('semester_id', $sem_id);		 
		$query = $this->db->get($this->table_name)->result_array();
		
		foreach($query as $val)
		{
			$this->db->select($this->table_name2.'.*');
			$this->db->select('subject_details.subject_name,nick_name');
			$this->db->where('time_table_id', $val['id']);
			$this->db->order_by($this->table_name2.'.id', 'asc');
			$this->db->join('subject_details','subject_details.id='.$this->table_name2.'.supject_id');
			$query[0]['time_info']=$this->db->get($this->table_name2)->result_array();
		}
		/*echo "<pre>";
		print_r($query);
		exit;*/
		return $query;
	}
	// error
	
	/**
	 * Get ur_title by id (id)
	 *
	 * @param	int
	 * @return	array
	 */
	function get_subject_by_id($select_batch,$depart_id,$group_id,$select_sem)
	{
		$this->db->where('batch_id', $select_batch);
		$this->db->where('depart_id', $depart_id);
		$this->db->where('group_id', $group_id);
		$this->db->where('semester_id', $select_sem);
		$this->db->where('scode !=','');
		$this->db->where('grade_point !=',0);
		$this->db->where('df', 0);
		$user_det = $this->session->userdata('logged_in');
		/*if($user_det['staff_type']=='staff')
			$this->db->where('staff_id', $this->user_auth->get_user_id());*/
		$query = $this->db->get($this->table_name1);
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	function get_subject_by_id1($select_batch,$depart_id,$group_id,$select_sem)
	{
		
		$this->db->where('batch_id', $select_batch);
		$this->db->where('depart_id', $depart_id);
		$this->db->where('group_id', $group_id);
		$this->db->where('semester_id', $select_sem);
		$this->db->where('df', 0);
		$user_det = $this->session->userdata('logged_in');
		/*if($user_det['staff_type']=='staff')
			$this->db->where('staff_id', $this->user_auth->get_user_id());*/
		$query = $this->db->get($this->table_name1);
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	function get_staff_info($id)
	{
		$this->db->select('staff.staff_name');
		$this->db->where($this->table_name1.'.id', $id);
		$this->db->join('staff','staff.id='.$this->table_name1.'.staff_id');	
		$query = $this->db->get($this->table_name1);
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	
	/**
	 * Insert new ur_title
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function insert_time_data($data)
	{
		if ($this->db->insert($this->table_name, $data)) {
			$history_id = $this->db->insert_id();
			
			return array('id' => $history_id);
		}
		return false;
	}
	function insert_time_details_data($data)
	{
		if ($this->db->insert($this->table_name2, $data)) {
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
	function update_time_data($data,$id)
	{
		$this->db->where('id', $id);
		
		if ($this->db->update($this->table_name, $data)) {
			
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
	function check_time_table($data)
	{	
		//echo "<pre>"; print_r($data); exit;
		if($data['select_type']==1)
		$method='internal';
		else if($data['select_type']==2)
		$method='external';
		else if($data['select_type']==3)
		$method='exam';
		
		$this->db->select('other_time_tables.*');
		$this->db->where($this->table_name3.'.batch_id', $data['select_batch']);
		$this->db->where($this->table_name3.'.depart_id', $data['depart_id']);
		$this->db->where($this->table_name3.'.group_id', $data['group_id']);
		$this->db->where($this->table_name3.'.semester_id', $data['select_sem']);
		$this->db->where($this->table_name3.'.time_table_method',$method);
		$this->db->where($this->table_name3.'.time_table_type', $data['int_id']);
		$query = $this->db->get($this->table_name3)->result_array();
		foreach($query as $val)
		{
			$this->db->select($this->table_name4.'.*');
			$this->db->select('subject_details.subject_name,nick_name');
			$this->db->where('other_time_table_id', $val['id']);
			$this->db->join('subject_details','subject_details.id='.$this->table_name4.'.subject_id');	
			$query[0]['time_info']=$this->db->get($this->table_name4)->result_array();
		}
		//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	function insert_other_time_table($data)
	{
		if ($this->db->insert($this->table_name3, $data)) {
			$insert_id = $this->db->insert_id();
			
			return array('id' => $insert_id);
		}
		return false;
	}
	function insert_other_time_details($data)
	{
		if ($this->db->insert($this->table_name4, $data)) {
			return true;
		}
		return false;
	}
	function delete_other_time_table($id)
	{
		$this->db->where('other_time_table_id',$id);
		if ($this->db->delete($this->table_name4)) {
			return true;
		}
		return false;
	}
	function print_other_time_table($data)
	{	
		
		$this->db->select('*');
		$this->db->where($data);
		$query = $this->db->get($this->table_name3)->result_array();
		foreach($query as $val)
		{
			$this->db->select($this->table_name4.'.*');
			$this->db->select('subject_details.subject_name,nick_name');
			$this->db->where('other_time_table_id', $val['id']);
			$this->db->join('subject_details','subject_details.id='.$this->table_name4.'.subject_id');	
			$query[0]['time_info']=$this->db->get($this->table_name4)->result_array();
		}
		return $query;
	}
	function get_values_by_type($type)
	{
		$this->db->select('details');
		$this->db->where($this->table_name5.'.typ_e', $type);
		$query = $this->db->get($this->table_name5);
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	function get_staff_time_table($where,$user_id)
	{
		$this->db->select($this->table_name2.'.id,supject_id');
		$this->db->where($where);
		$query = $this->db->get($this->table_name2)->result_array();
		$i=0;
		foreach($query as $val)
		{
			$this->db->select('subject_details.subject_name,nick_name');
			$this->db->select('semester.semester');
			$this->db->select('department.department,nickname');
			$this->db->select('group.group');
			$this->db->where('subject_details.id', $val['supject_id']);
			$this->db->where('subject_details.staff_id', $user_id);
			$this->db->join('department','department.id=subject_details.depart_id');
			$this->db->join('group','group.id=subject_details.group_id');	
			$this->db->join('semester','semester.id=subject_details.semester_id');
			$query[$i]['subject_info']=$this->db->get('subject_details')->result_array();
			$i++;
		}
		return $query;
	}
	function get_arrear_subject($department,$sem)
	{
		$this->db->select('subject_details.*');
		$this->db->where('depart_id',$department);
		$this->db->where('semester_id',$sem);
		$this->db->where('scode !=','');
		$this->db->group_by('subject_details.scode');
		$query = $this->db->get('subject_details')->result_array();
		return $query;
	}
	function insert_arrear_time_table($data)
	{
		if ($this->db->insert($this->table_name6, $data)) {
			return true;
		}
		return false;
	}
	function update_arrear_time_table($data,$depart_id)
	{
		/*echo "<pre>"; print_r($data);
		echo "<pre>"; print_r($depart_id);*/
		$this->db->where('depart_id', $depart_id);
		
		if ($this->db->update($this->table_name6, $data)) {
			
			return true;
		}
		return false;
	}
	function get_arrear_time_table($department)
	{
		$this->db->select('*');
		$this->db->where('depart_id',$department);
		$query = $this->db->get($this->table_name6)->result_array();
		$i=0;
		
		return $query;
	}
	function delete_arrear_time_table($id)
	{
		$this->db->where('depart_id', $id);
		$this->db->delete($this->table_name6);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
}
