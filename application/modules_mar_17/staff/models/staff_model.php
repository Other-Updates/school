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
 
class Staff_model extends CI_Model{

    private $table_name	    = 'staff';	
	private $table_name1	= 'designation';	
	private $table_name2	= 'staff_details';	
	private $table_name3	= 'qualification';	
	private $table_name4	= 'staff_group';	
	private $table_name5	= 'staff_type';	
	private $table_name6	= 'student';	
	private $table_name8	= 'department';
	function __construct()
	{
		parent::__construct();

	}
	
	/**
	 * Get all ur_title
	 *
	 * @return	array
	 */
	function get_all_staff()
	{
		$this->db->select($this->table_name.'.*');
		$this->db->select('department.department,nickname');
		$this->db->select('designation.designation');
		$this->db->where('staff.status',1);
		$this->db->where('staff.df',0);
		$this->db->join('department','department.id='.$this->table_name.'.depart_id');
		$this->db->join('designation','designation.id='.$this->table_name.'.designation_id');			 
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	function view_all_staff_details($id)
	{
		$this->db->select($this->table_name.'.*');
		$this->db->select('staff_details.gender,staff_details.address,staff_details.postal_code,staff_details.country,staff_details.state,staff_details.join_date,staff_details.end_date,staff_details.dob');
		$this->db->select('department.department');
		$this->db->select('designation.designation');
		$this->db->select('staff_type.staff_type');
		$this->db->where($this->table_name.'.id',$id);
		$this->db->join('department','department.id='.$this->table_name.'.depart_id');
		$this->db->join('designation','designation.id='.$this->table_name.'.designation_id');
		$this->db->join('staff_details','staff_details.staff_id='.$this->table_name.'.id');	
		$this->db->join('staff_type','staff_type.id='.$this->table_name.'.staff_type_id');				 
		$query = $this->db->get($this->table_name)->result_array();
		$i=0;
		foreach($query as $val)
		{
			$this->db->where('qualification.type','staff');
			$this->db->where('qualification.person_id',$val['id']);
			$q_array=$this->db->get('qualification')->result_array();
			$query['qualification'][0]=$q_array;
			$i++;
		}
		return $query;
	}
	/**
	 * Get ur_title by id (id)
	 *
	 * @param	int
	 * @return	array
	 */
	function get_ur_title_by_id($id)
	{
				
		$this->db->where('id', $id);
		
		$query = $this->db->get($this->table_name);
		
		if ($query->num_rows() == 1) {
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
	function insert_staff($data)
	{
		if ($this->db->insert($this->table_name, $data)) {
			$id = $this->db->insert_id();
			
			return array('id' => $id);
		}
		return false;
	}
	function insert_staff_details($data)
	{
		if ($this->db->insert($this->table_name2, $data)) {
			$insert_id = $this->db->insert_id();
			
			return array('id' => $insert_id);
		}
		return false;
	}
	function insert_qualification($data)
	{
		if ($this->db->insert($this->table_name3, $data))
			return true;
		else	
			return false;
	}
	/**
	 * Update a ur_title
	 *
	 * @param	array
	 * @param	int
	 * @return	bool
	 */
	function update_staff($data, $id)
	{
		$this->db->where('id', $id);
		
		if ($this->db->update($this->table_name, $data)) {
			
			return true;
		}
		return false;
	}
	function delete_staff($data, $id)
	{
		$this->db->where('id', $id);
		
		if ($this->db->update($this->table_name, $data)) {
			
			return true;
		}
		return false;
	}
	
	function update_staff1($data, $id)
	{
		$this->db->where('id', $id);
		
		if ($this->db->update($this->table_name6, $data)) {
			
			return true;
		}
		return false;
	}
	function update_staff_details($data, $id)
	{
		$this->db->where('staff_id', $id);
		
		if ($this->db->update($this->table_name2, $data)) {
			
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
	function delete_ur_title($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table_name);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	function get_all_designation()
	{
		$this->db->select('*');	
		$this->db->where('df',0);
		$this->db->where('status',1);	 
		$query = $this->db->get($this->table_name1);
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	function delete_qualification_by_id($id)
	{
		$this->db->where('qualification.type','staff');
		$this->db->where('qualification.person_id',$id);
		$this->db->delete('qualification');
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	function insert_student_group($data)
	{
		if ($this->db->insert($this->table_name4, $data))
			return true;
		else	
			return false;
	}
	function get_all_staff_by_depart_id($depart_id)
	{
		$this->db->select($this->table_name.'.id,staff_name');
		$this->db->where($this->table_name.'.depart_id',$depart_id);
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	function select_all_staff($ids) /*THIS IS FOR GETTING THE STAFF LIST*/
	{		
		$this->db->select('id,staff_name');		 
		$this->db->where('staff_type_id',$ids);
		$query = $this->db->get($this->table_name);
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	function email_checking_insert($email)
	{
		/*$this->db->select('*');
		$this->db->where('email_id',$email);*/
	$query = $this->db->query("select a.id from staff a,student b,admin c where a.df=0 and a.status=1  and  a.email_id='$email' or b.df=0 and b.status=1 and b.email_id='$email' or c.df=0 and c.status=1 and c.email_id='$email'");
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
	}
	function checking_email_update($id,$email)
	{
		//$this->db->select('*');
		//$this->db->where('id !=',$id);
	$query = $this->db->query("select a.id from staff a,student b,admin c where a.id!='$id' and a.df=0 and a.status=1  and  a.email_id='$email' or b.df=0 and b.status=1 and b.email_id='$email' or c.df=0 and c.status=1 and c.email_id='$email'");
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
	}
	function checking_staffid_insert($staff_id)
	{
		
		$query = $this->db->query("select a.id from staff a,student b where a.df=0 and a.status=1 and  a.staff_id='$staff_id' or b.df=0 and b.status=1 and b.std_id='$staff_id'");
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
	}
	function checking_staffid_update($id,$staff_id)
	{
		$this->db->select('*');
		$this->db->where('staff_id',$staff_id);
		$this->db->where('id !=',$id);
		$this->db->where('df',0);
		$this->db->where('status',1);
		$query=$this->db->get('staff');
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
	
	}
	function get_user_details_by_id($email,$pwd)
	{
		$this->db->select('*');		 
		$this->db->where('email_id',$email);
		$this->db->where('pwd',$pwd);
		$this->db->where($this->table_name.'.df',0);		
		$this->db->where($this->table_name.'.status',1);
		$query = $this->db->get($this->table_name);
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	function department()
	{
		$this->db->select('*');
		$query = $this->db->get($this->table_name8);
		$this->db->where('df',0);		
		$this->db->where('status',1);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	
	function get_all_staff_type()
	{
		$this->db->select('*');		 
		$query = $this->db->get($this->table_name5);
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	function get_all_staff_for_calendar()
	{
		$this->db->select('staff_details.dob');
		$this->db->select('department.department,nickname');
		$this->db->select($this->table_name.'.id,staff_name');
		$this->db->join('staff_details','staff_details.staff_id='.$this->table_name.'.id');
		$this->db->join('department','department.id='.$this->table_name.'.depart_id');
		$query = $this->db->get($this->table_name);
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	
	function staff_depart_wise($d_id)
	{
		//print_r($d_id); exit;
		$this->db->select($this->table_name.'.*');
		$this->db->select('department.department,nickname');
		$this->db->select('designation.designation');
		$this->db->where('staff.depart_id',$d_id);
		$this->db->where('staff.staff_type_id !=','');
		$this->db->where('staff.status',1);
		$this->db->join('department','department.id='.$this->table_name.'.depart_id');
		$this->db->join('designation','designation.id='.$this->table_name.'.designation_id');			 
		$query = $this->db->get($this->table_name)->result_array();
		/*echo "<pre>";
	   print_r($query);
	   exit;*/
		return $query;
		
	}
	function staff_depart_wise_all($d_id)
	{
		//print_r($d_id); exit;
		$this->db->select($this->table_name.'.*');
		$this->db->select('department.department,nickname');
		$this->db->select('designation.designation');
		$this->db->where('staff.depart_id !=',$d_id);
		$this->db->where('staff.staff_type_id !=',3);
		$this->db->where('staff.status',1);
		$this->db->join('department','department.id='.$this->table_name.'.depart_id');
		$this->db->join('designation','designation.id='.$this->table_name.'.designation_id');			 
		$query = $this->db->get($this->table_name)->result_array();
		/*echo "<pre>";
	   print_r($query);
	   exit;*/
		return $query;
		
	}
	function staff_depart_wise_all_type($d_id,$type)
	{
		//print_r($type); exit;
		$this->db->select($this->table_name.'.*');
		$this->db->select('department.department,nickname');
		$this->db->select('designation.designation');
		$this->db->where('staff.depart_id !=',$d_id);
		$this->db->where('staff.staff_type_id',$type);
		$this->db->where('staff.status',1);
		$this->db->join('department','department.id='.$this->table_name.'.depart_id');
		$this->db->join('designation','designation.id='.$this->table_name.'.designation_id');			 
		$query = $this->db->get($this->table_name)->result_array();
		/*echo "<pre>";
	   print_r($query);
	   exit;*/
		return $query;
		
	}
	function get_staff_depat_type1($d_id,$type)
	{
		//print_r($type); exit;
		$this->db->select($this->table_name.'.*');
		$this->db->select('department.department,nickname');
		$this->db->select('designation.designation');
		$this->db->where('staff.depart_id',$d_id);
		$this->db->where('staff.staff_type_id',$type);
		$this->db->where('staff.status',1);
		$this->db->join('department','department.id='.$this->table_name.'.depart_id');
		$this->db->join('designation','designation.id='.$this->table_name.'.designation_id');			 
		$query = $this->db->get($this->table_name)->result_array();
		/*echo "<pre>";
	   print_r($query);
	   exit;*/
		return $query;
		
	}
}