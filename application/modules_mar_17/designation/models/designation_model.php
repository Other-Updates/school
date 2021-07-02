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
 
class Designation_model extends CI_Model{

    private $table_name	= 'designation';
	 private $table_name2 = 'subject_details';

	function __construct()
	{
		parent::__construct();
		$this->load->database();

	}
	
	function insert_designation($data)
	{
		if ($this->db->insert($this->table_name, $data)) {
			$options_id = $this->db->insert_id();
			return array('id' => $options_id);
		}
		
		return false;

	}
	function get_all_student_by_designation()
	{
		$this->db->select($this->table_name.'.*');		 
		$query = $this->db->get($this->table_name)->result_array();
		$i=0;
		foreach($query as $val)
		{
			$this->db->where('student_group.depart_id',$val['id']);
			$this->db->join('student','student.id=student_group.student_id');	 
			$query[$i]['no_student']=$this->db->get('student_group')->num_rows();	
			$i++;
		}
		return $query;
	}
	function get_designation()
	{
		$this->db->select('*');
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	

	
	 /* Update a ur_title
	 *
	 * @param	array
	 * @param	int
	 * @return	bool
	 */
function update_designation($data,$id)
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
	function delete_designation($id)
	{
		$this->db->where('id', $id);
			if ($this->db->update($this->table_name,$data=array('status'=>0))) {
				return true;
			}
			return false;
	}
	function delete_designation_inactive($id)
	{
		$this->db->where('id', $id);
			if ($this->db->update($this->table_name,$data=array('df'=>1))) {
				return true;
			}
			return false;
	}
	function delete_designation_inactive_check($id)
	{
		$query = $this->db->query("select a.id from admin a,staff c where a.designation_id='$id' or c.designation_id='$id'");
			//print_r($query);exit;
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		
			return false;
	}
	function checking_designation($designation)
	{
		$this->db->select('*');
		$this->db->where('designation',$designation);
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	
	}
	function checking_Update($designation,$id)
	{
		$this->db->select('*');
		$this->db->where('designation',$designation);
		$this->db->where('id !=', $id);
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	
	}
	
}