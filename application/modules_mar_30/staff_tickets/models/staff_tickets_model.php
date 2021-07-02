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
 class Staff_tickets_model extends CI_Model{

    private $table_name	= 'staff_tickets';
	private $table_name1 = 'department';
	private $table_name2 = 'admin';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function insert_staff_tickets($data)
	{
		if ($this->db->insert($this->table_name, $data)) {
			$options_id = $this->db->insert_id();
			return array('id' => $options_id);
		}
		return false;
	}
	function get_staff_tickets($id)
	{
		$this->db->select($this->table_name.'.*');
		$this->db->select('department.department');
		$this->db->select('admin.name');
		$this->db->where('staff_tickets.email',$id);
		$this->db->where('staff_tickets.staff_df',1);
		$this->db->join('department','department.id='.$this->table_name.'.department');
		$this->db->join('admin','admin.id='.$this->table_name.'.admin_id');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	function get_staff_all_tickets()
	{
		$this->db->select($this->table_name.'.*');
		$this->db->select('department.department');
		$this->db->select('admin.name');
		$this->db->where('staff_tickets.df',0);
		$this->db->join('department','department.id='.$this->table_name.'.department');
		$this->db->join('admin','admin.id='.$this->table_name.'.admin_id');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) 
		{
			return $query->result_array();
		}
		return false;
		
	}
	function get_admin_tickets($id)
	{
		$this->db->select($this->table_name.'.*');
		$this->db->select('department.department as dept');
		$this->db->select('admin.name');
		$this->db->where('staff_tickets.admin_id',$id);
		
		$this->db->where('staff_tickets.admin_df',1);
		$this->db->join('department','department.id='.$this->table_name.'.department');
		
		$this->db->join('admin','admin.id='.$this->table_name.'.admin_id');
		$query = $this->db->get($this->table_name)->result_array();
		/*echo "<pre>";
		print_r($query);
		exit;*/
		
		
			return $query;
		
	}
	function get_all_department($dept_id)
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('id',$dept_id);
		$query = $this->db->get('department');	
		if ($query->num_rows() >= 1)
		 {
			return $query->result_array();
		}	
	}
	function get_all_department1()
	{
		$this->db->select('*');
		$this->db->where('status',1);
		
		$query = $this->db->get('department');	
		if ($query->num_rows() >= 1)
		 {
			return $query->result_array();
		}	
	}
	function get_all_admin()
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$query = $this->db->get('admin');	
		if ($query->num_rows() >= 1) 
		{
			return $query->result_array();
		}	
		
	}
	 /* Update a ur_title
	 *
	 * @param	array
	 * @param	int
	 * @return	bool
	 */
function update_staff_tickets($data,$id)
	{
	$this->db->where('id', $id);
	if ($this->db->update($this->table_name, $data)); 
	}
	/**
	 * Delete a ur_title
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_staff_tickets($id)
	{
		$this->db->where('id', $id);
			if ($this->db->update($this->table_name,$data=array('status'=>0)))
			 {
				return true;
			 }
			return false;
	}
	function admin_delete_staff_tickets($id)
	{
		$this->db->where('id', $id);
			if ($this->db->update($this->table_name,$data=array('status'=>0)))
			 {
				return true;
			 }
			return false;
	}
	function delete_staff_tickets_inactive($id)
	{
		$this->db->where('id', $id);
			if ($this->db->update($this->table_name,$data=array('df'=>1,'staff_df'=>0))) {
				return true;
			}
			return false;
	}
	function admin_delete_staff_tickets_inactive_admin($id)
	{
		$this->db->where('id', $id);
			if ($this->db->update($this->table_name,$data=array('df'=>1
			,'admin_df'=>0))) {
				return true;
			}
			return false;
	}
	function get_staff_details($id)
	{
		
		$this->db->select('staff.*');
		$this->db->select('staff_details.gender,staff_details.address,staff_details.postal_code,staff_details.country,staff_details.state,staff_details.join_date,staff_details.end_date,staff_details.dob');
		$this->db->select('department.department');
		$this->db->select('designation.designation');
		$this->db->where('staff.id',$id);
		$this->db->join('department','department.id=staff.depart_id');
		$this->db->join('designation','designation.id=staff.designation_id');
		$this->db->join('staff_details','staff_details.staff_id=staff.id');				 
		$query = $this->db->get('staff')->result_array();
		$i=0;
		foreach($query as $val)
		{
			$this->db->where('qualification.type','staff');
			$this->db->where('qualification.person_id',$val['id']);
			$q_array=$this->db->get('qualification')->result_array();
			$query['qualification'][0]=$q_array;
			$i++;
		}
		/*echo "<pre>";
		print_r($query);
		exit;*/
		return $query;
	}
	function staff_password_change($input,$id)
	{
		$this->db->where('id', $id);
			if ($this->db->update('staff',$input)) {
				return true;
			}
			return false;
	}
	function update_staff_profile($data,$id)
	{
		$this->db->where('id', $id);
			if ($this->db->update('staff',$data)) {
				return true;
			}
			return false;
		
	}
	function update_staff_address($data,$id)
	{
		$this->db->where('id', $id);
			if ($this->db->update('staff_details',$data)) {
				return true;
			}
			return false;
		
	}
	function get_image_details($id)
	{
			$this->db->select('image');
			$this->db->select('staff_details.join_date');
			$this->db->where('staff.id',$id);
			$this->db->join('staff_details','staff_details.staff_id=staff.id');
			$query = $this->db->get('staff')->result_array();
			return $query;
	}
}
