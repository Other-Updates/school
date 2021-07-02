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

    private $table_name	= 'events';	
	private $table_name1= 'department';	
//	private $table_name2= 'group';
	private $table_name3='batch';
	private $table_name4='events_view';
		

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
	 function get_events()
	{
		
		$this->db->select('*'); 
		$this->db->where('df',0);
		$this->db->order_by('id','desc');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	 
	 function get_all_events()
	{
		$this->db->select($this->table_name.'.*');
		//$this->db->select('group.group');
		$this->db->select('batch.from,batch.to');
		$this->db->select('department.department');
		$this->db->where($this->table_name.'.df',0);
		$this->db->where($this->table_name.'.status',1);
		$this->db->join('department','department.id='.$this->table_name.'.depart_id',"left");
		$this->db->join('batch','batch.id='.$this->table_name.'.batch_id',"left");	
		//$this->db->join('group','group.id='.$this->table_name.'.group_id',"left");	
		   
		 $query = $this->db->get($this->table_name)->result_array();
		  return $query;

		}	
		
		
		function get_all_batch()
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name3);
		if ($query->num_rows() > 0) {
		return $query->result_array();
		}
		return false;
	}
	
	
	function get_view_events($id)
	{
	
		$this->db->select('*');
		$this->db->select('student.name');
		$this->db->join('student','student.id='.$this->table_name4.'.name',"left");
		$query = $this->db->get($this->table_name4);
		if ($query->num_rows() > 0) {
		return $query->result_array();
		}
		return false;
	}
	
		
/*	function group()
	{
		$this->db->select('*');
		$query = $this->db->get($this->table_name2);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
*/	

function department()
	{
		$this->db->select('*');
		/*$this->db->where('status',1);
		$this->db->where('df',0);*/
		$query = $this->db->get($this->table_name1);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
/*	 function get_all_group($id)
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('depart_id',$id);
		$this->db->where('df',0);
		$query = $this->db->get($this->table_name2);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
*/	
	function view_events($id)
	{
		$this->db->select($this->table_name.'.*');
		//$this->db->select('group.group');
		$this->db->where($this->table_name.'.id',$id);
		$this->db->select('batch.from,batch.to');
		$this->db->select('department.department');
		$this->db->join('department','department.id='.$this->table_name.'.depart_id',"left");
		$this->db->join('batch','batch.id='.$this->table_name.'.batch_id',"left");
		//$this->db->join('group','group.id='.$this->table_name.'.group_id',"left");		 
		$query = $this->db->get($this->table_name)->result_array();
		 $i=0;
		 return $query;
		}
		
		
		function update_events($data,$id)
	{
		
		$this->db->where('id', $id);		
		
		if ($this->db->update($this->table_name,$data))
		 {
			return true;
		}
		
		return false;
	}
	
	
	/**
	 * Get ur_title by id (id)
	 *
	 * @param	int
	 * @return	array
	 */
	/*function get_events_id($id)
	{
		
		$this->db->where('id', $id);
		
		$query = $this->db->get($this->table_name);
		
		if ($query->num_rows() == 1) {
			return $query->result_array();
		}
		return false;
	}
	*/
	
	/**
	 * Insert new ur_title
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function events($data)
		{
		if ($this->db->insert($this->table_name,$data));
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
		/*function insert_events_details($data)
	{
		if ($this->db->insert($this->table_name, $data)) {
			$insert_id = $this->db->insert_id();
			
			return array('id' => $insert_id);
		}
		return false;
	}*/
	
	
	/**
	 * Update a ur_title
	 *
	 * @param	array
	 * @param	int
	 * @return	bool
	 */
	
	/**
	 * Delete a ur_title
	 *
	 * @param	int
	 * @return	bool
	 */
	
	function delete_events($id)
	{
		
		$this->db->where('id', $id);
		
			if ($this->db->update($this->table_name,$data=array('df'=>1,'status'=>0)))
			
		
			{
				return true;
			}
			return false;
}

/*function delete_events_inactive($id)
	{
		$this->db->where('id', $id);
			
			if ($this->db->update($this->table_name,$data=array('df'=>1))) {
				
				return true;
			}
			return false;
	}

*/
	
	 function get_all_events_id($where)
	{
		$this->db->select($this->table_name.'.*');
		$this->db->where($where);
		$this->db->where($this->table_name.'.df',0);
		$this->db->where($this->table_name.'.status',1);
		 $query = $this->db->get($this->table_name)->result_array();
		  return $query;

		}	
		
		function get_alumni($id)
	{
		$this->db->select('*');
		$this->db->where('df',0);
		$this->db->where('status',0);
		$query = $this->db->get($this->table_name3);
		if ($query->num_rows() > 0) {
		return $query->result_array();
		}
		return false;
	}
	}
	

