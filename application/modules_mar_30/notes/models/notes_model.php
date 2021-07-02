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
 
class Notes_model extends CI_Model{

    private $table_name	= 'notes';	
	private $table_name1 = 'department';	
	private $table_name2 = 'group';	
	private $table_name3 = 'subject_details';
	private $table_name4 = 'batch';	
	private $table_name5 = 'semester';	
	private $table_name8	= 'staff_syllabus';


	function __construct()
	{
		parent::__construct();

	}
	
	/**
	 * Get all ur_title
	 *
	 * @return	array
	 */
	 
	 function get_all_subject($dep,$grp,$sem,$bat)
	{			
		$this->db->select('id,subject_name,nick_name');
		
		$this->db->where('depart_id',$dep);
		$this->db->where('group_id',$grp);
		$this->db->where('semester_id',$sem);
		$this->db->where('batch_id',$bat);
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name3)->result_array();
		//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	
	
	
		function subject()
	{
		$this->db->select('*');
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name3);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	function get_sub_code()
	{
		$this->db->select('*');
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name3);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	
	function group()
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name2);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	function semester()
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name5);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	function batch()
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name4);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	
	function department()
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name1);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	 
	 
	 function get_all_group($id)
	{
		$this->db->select('*');
		$this->db->where('depart_id',$id);
		$this->db->where('status',1);
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name2);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	 
	 function get_all_notes($user_det)
	 {
		  
		  $this->db->select($this->table_name.'.*');
		  $this->db->order_by('id','desc');
		  $this->db->select('group.group');
		  $this->db->select('batch.from,batch.to');
		  $this->db->select('department.department,nickname');
		  $this->db->select('semester.semester as sem');
		  $this->db->select('subject_details.subject_name,nick_name');
		  $this->db->where($this->table_name.'.created_user',$user_det['user_id']);
		  $this->db->where($this->table_name.'.staff_type',$user_det['staff_type']);
		  $this->db->where($this->table_name.'.df',0);
		  $this->db->join('batch','batch.id='.$this->table_name.'.batch','left');
		  $this->db->join('department','department.id='.$this->table_name.'.depart_id','left');
		  $this->db->join('group','group.id='.$this->table_name.'.group_id','left');
		  $this->db->join('semester','semester.id='.$this->table_name.'.semester','left');
		  $this->db->join('subject_details','subject_details.id='.$this->table_name.'.subject_id','left');
		  
		  $query = $this->db->get($this->table_name)->result_array();
		  return $query;


	 }

function get_syllabus_all()
	{
		$this->db->select('*');
		$query = $this->db->get($this->table_name8);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	 
	 
	 
	 
	function get_all_ur_title()
	{
				 
		$query = $this->db->get($this->table_name);
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	

	function get_ur_title_by_id($id)
	{
		
		$this->db->where('id', $id);
		
		$query = $this->db->get($this->table_name);
		
		if ($query->num_rows() == 1) {
			return $query->result_array();
		}
		return false;
	}
	
	

	function insert_notes($data)
	{
		
		
		$this->db->insert($this->table_name, $data);
	
	}
	

	function update_ur_title($id, $data)
	{
		$this->db->where('id', $id);
		
		if ($this->db->update($this->table_name, $data)) {
			
			return true;
		}
		return false;
	}
	

	function delete_notes($id)
	{
		$this->db->where('id', $id);
			
			if ($this->db->update($this->table_name,$data=array('df'=>1))) {
				
				return true;
			}
			return false;
	}
    
	
}