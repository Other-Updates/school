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
 
class St_registration_model extends CI_Model{

    private $table_name	= 'admission';
	private $table_name2	= 'student_details';
	 //private $table_name2 = 'subject_details';
		

	function __construct()
	{
		parent::__construct();
		$this->load->database();

	}
	
	function insert_admission_set($input)
	{
		$this->db->insert($this->table_name, $input);
	}
	
	function get_st_registration()
	{
		$this->db->select('*');
	    $this->db->where('status',1);
		$this->db->order_by('id','desc');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	function delete_st_registration_model($id)
	{
		$this->db->where('id', $id);
			
			if ($this->db->update($this->table_name, $data=array('status'=>0))) {
				
				return true;
			}
			return false;
		
	}
	function update_st_registration_model($id,$data)
	{
		//echo "<pre>";print_r($data);exit;
		$this->db->where('id', $id);
			
			if ($this->db->update('admission', $data)) {
				
				return true;
			}
			return false;
		
	}
	
	
	function get_st_registration_year($y)
	{
		$this->db->select('*');
	    $this->db->where('status',1);
		$this->db->where('year',$y);
		$this->db->order_by('id','desc');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
		
	}
	function get_st_registration_type()
	{
		$this->db->select('admission.*');
		$this->db->select('student_details.admission_form_no');
		$this->db->join('student_details','student_details.admission_form_no=admission.admission_form_no');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
		
	}
	function get_st_registration_type_not()
	{
		$this->db->select('admission.*');
		$this->db->select('student_details.admission_form_no as adm');
		$this->db->join('admission','admission.admission_form_no!=student_details.admission_form_no');
		$query = $this->db->get($this->table_name2);
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
		
	}
	
	
	
		
}