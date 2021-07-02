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
 
class Download_form_model extends CI_Model{

    private $table_name	= 'download_form';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();

	}
	
	/**
	 * Get all ur_title
	 *
	 * @return	array
	 */
	function get_form()
	{
		$this->db->select('*');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	
	function insert_form($data)
	{
		$this->db->insert($this->table_name, $data);
	}
	
	function update_admin($data,$id)
	{
		$this->db->where('id', $id);
			
			if ($this->db->update($this->table_name, $data)) {
				
				return true;
			}
			return false;
	}
	

	function delete_form($id)
	{
		$this->db->where('id', $id);
			
			if ($this->db->delete($this->table_name)) {
				
				return true;
			}
			return false;
		
	}

	
	function delete_batch($id)
	{
		$this->db->where('id', $id);
			
			if ($this->db->update($this->table_name,$data=array('df'=>1))) {
				
				return true;
			}
			return false;
	
		
	}

	function get_form_for_users()
	{
		$this->db->select('*');
		$query = $this->db->get($this->table_name)->result_array();
		$i=0;
		  foreach($query as $row)
		  {
			   if($row['staff_type']=='admin')
			   {
				 $this->db->select('admin.name as name');
				 $this->db->where('id',$row['created_by']);
				 $query[$i]['staff']=$this->db->get('admin')->result_array(); 
			   }
			     else
				 {
				$this->db->select('staff.staff_name as name');
				 $this->db->where('id',$row['created_by']);
				 $query[$i]['staff']=$this->db->get('staff')->result_array();
				 }
			 $i++; 
		  }
		  return $query;
	}

	
}