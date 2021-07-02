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
 
class Events_model extends CI_Model{

    private $table_name	= 'ur table name';	

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
	function insert_ur_title($data)
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
	function delete_ur_title($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table_name);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	
}