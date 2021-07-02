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
 
class Staff_syllabus_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
		 $this->load->database();

	}
	private $table_name		= 'subject_details';
    private $table_name3	= 'staff_details';	
	private $table_name1	= 'batch';	
	private $table_name2	= 'group';	
	private $table_name4	= 'department';	
	private $table_name5	= 'semester';
	private $table_name6	= 'staff';
	private $table_name7	= 'master_right';
	private $table_name8	= 'staff_syllabus';

	
	
public function insert_staff_sylla($data)
	{
		
		if ($this->db->insert_batch($this->table_name8, $data)){
			//echo "<pre>";print_r($data);exit;
			return true;
		}
		return false;
	}
function get_sylla_all()
	{
	 $this->db->select($this->table_name8.'.*');
		$this->db->select('batch.from,batch.to');
		$this->db->select('semester.semester');
		$this->db->select('group.group');
		$this->db->select('department.department');
		$this->db->select('subject_details.subject_name,nick_name,scode');
		$this->db->join('subject_details','subject_details.id='.$this->table_name8.'.subject_id');
		$this->db->join('group','group.id='.$this->table_name8.'.group_id','left');
		$this->db->join('semester','semester.id='.$this->table_name8.'.select_se_id');
		$this->db->join('batch','batch.id='.$this->table_name8.'.batch_id_one');
		$this->db->join('department','department.id='.$this->table_name8.'.depart_id');
		$this->db->group_by('subject_id'); 
		$query = $this->db->get($this->table_name8);
		//echo "<pre>"; print_r($query);exit;
		if ($query->num_rows() > 0) {
			return $query->result_array();
			
		}
		return false;
	}
	
	
	function get_sylla_all_view($subject_id)
	{
	 $this->db->select($this->table_name8.'.*');
	  $this->db->where('subject_id', $subject_id);
		$this->db->select('batch.from,batch.to');
		$this->db->select('semester.semester');
		$this->db->select('group.group');
		$this->db->select('department.department');
		$this->db->select('subject_details.subject_name,nick_name,scode');
		$this->db->join('subject_details','subject_details.id='.$this->table_name8.'.subject_id');
		$this->db->join('group','group.id='.$this->table_name8.'.group_id','left');
		$this->db->join('semester','semester.id='.$this->table_name8.'.select_se_id');
		$this->db->join('batch','batch.id='.$this->table_name8.'.batch_id_one');
		$this->db->join('department','department.id='.$this->table_name8.'.depart_id');
		//$this->db->group_by('subject_id'); 
		$query = $this->db->get($this->table_name8);
		//echo "<pre>"; print_r($query);exit;
		if ($query->num_rows() > 0) {
			return $query->result_array();
			
		}
		return false;
	}
	
	
	public function delete_sylla($id)
	{
		$this->db->where('id', $id);
			
			if ($this->db->delete($this->table_name8)) {
				
				return true;
			}
		
			return false;
	}
	
	function search_sub($id)
	{
		
		$this->db->select($this->table_name.'.*');
	    $this->db->where('id', $id);
		$query = $this->db->get($this->table_name)->result_array();
		//echo "<pre>";print_r($query);exit;
		return $query;
	}
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
	
	
	
	function get_sylla_all_update($subject_id)
	{
		
		$this->db->select($this->table_name8.'.*');
	   $this->db->where('subject_id', $subject_id);
	   //print_r($subject_id);exit;
		$query = $this->db->get($this->table_name8)->result_array();
		//echo "<pre>";print_r($query);exit;
		return $query;
		
	}
	}
	