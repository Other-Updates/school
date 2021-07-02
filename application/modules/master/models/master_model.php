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
 
class Master_model extends CI_Model{

    private $table_name	= 'master_right';	

	function __construct()
	{
		parent::__construct();

	}
	
	/**
	 * Get all ur_title
	 *
	 * @return	array
	 */
	function get_all_ur_title()
	{
				 
		$query = $this->db->get($this->table_name);
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	
	/**
	 * Get ur_title by id (id)
	 *
	 * @param	int
	 * @return	array
	 */
	function get_staff_by_id($id,$status)
	{
		$this->db->select('add_student,chat,library,transport,fee_details,sharing_note,attendance,assignment,internal_mark,time_table,event,subject');
		$this->db->where('staff_id', $id);
		$this->db->where('staff_type', $status);
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
	function insert_master($data)
	{
		if ($this->db->insert($this->table_name, $data)) {
			$history_id = $this->db->insert_id();
			
			return array('id' => $history_id);
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
	function update_ur_title($id, $data)
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
	function delete_staff_master($id)
	{
		$this->db->where('staff_id', $id);
		$this->db->where('staff_type', 1);
		$this->db->delete($this->table_name);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	function delete_admin_master($id)
	{
		$this->db->where('staff_id', $id);
		$this->db->where('staff_type', 2);
		$this->db->delete($this->table_name);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	
}