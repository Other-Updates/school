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
 
class Group_model extends CI_Model{

    private $table_name	= 'group';	
	private $table_name1= 'department';	

	function __construct()
	{
		parent::__construct();

	}
	
	/**
	 * Get all group
	 *
	 * @return	array
	 */
	function get_all_group()
	{
		
		$this->db->select($this->table_name.'.*');
		$this->db->where($this->table_name.'.df',0);
		$this->db->select('department.department');
		$this->db->join('department','department.id='.$this->table_name.'.depart_id');	
		$this->db->order_by('department.department','desc');
		 $data["status"]=1;	 
		 $query = $this->db->get($this->table_name);
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
		/**
	 * Get all group
	 *
	 * @return	array
	 */
	function get_all_department()
	{
		$this->db->where('df',0);
		$this->db->where('status',1);		 
		$query = $this->db->get($this->table_name1);
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	
	/**
	 * Get group by id (id)
	 *
	 * @param	int
	 * @return	array
	 */
	function get_group_by_id($id)
	{
		
		$this->db->where('id', $id);
		
		$query = $this->db->get($this->table_name);
		
		if ($query->num_rows() == 1) {
			return $query->result_array();
		}
		return false;
	}
	
	
	/**
	 * Insert new group
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function insert_group($data)
	{
		if ($this->db->insert($this->table_name, $data)) {
			//$history_id = $this->db->insert_id();	
			//return array('id' => $history_id);
			return true;
		}
		return false;
	}
	
	/**
	 * Update a group
	 *
	 * @param	array
	 * @param	int
	 * @return	bool
	 */
	function update_group($id, $data)
	{
		$this->db->where('id', $id);
		
		if ($this->db->update($this->table_name, $data)) {
			
			return true;
		}
		return false;
	}
	
	/**
	 * Delete a group
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_group($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	function delete_group_inactive($id)
	{
		$this->db->where('id', $id);
			if ($this->db->update($this->table_name,$data=array('df'=>1))) {
				return true;
			}
			return false;
	}
	
	function get_classes($ids)
	{		
		$this->db->where('saff_id', $ids);		
		$query1 = $this->db->get('staff_class');
		if($query1->num_rows() < 1)
		{			
			
			
			$this->db->select('group.*');
			$this->db->select('department.department');
			$this->db->join('department', 'department.id = group.depart_id ');
			$query2 = $this->db->get('group');
			return $query2->result_array();
		}
		else
		{
			$this->db->select('group.*');
			$this->db->select('department.department');
			$this->db->join('department', 'department.id = group.depart_id ');
			$query2 = $this->db->get('group')->result_array();
			
			$i=0;
			foreach($query2 as $val)
			{
				$this->db->where('staff_class.saff_id', $ids);
				$this->db->where('staff_class.group_id',$val['id']);
				$query3 = $this->db->get('staff_class');
				if($query3->num_rows() > 0)
					$query2[$i]['select_flag']=1;
				else
					$query2[$i]['select_flag']=0;	
				$i++;
			}
			$query2['cls_cnt'] = $query1->num_rows();
			
			/*echo "<pre>";		
			print_r($query2);
			exit;*/
		
			return $query2;
		}
		return false;
	}
	
	
	function validate_group($depar,$group)
	{ 
		$this->db->select('*');
		$this->db->where('depart_id',$depar);
		$this->db->where('group',$group);
		$this->db->where('df',0);
		$query=$this->db->get('group');
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
	
		
	}
	function validate_group_update($id,$depart_id,$group)
	{ 
		$this->db->select('*');
		$this->db->where('depart_id',$depart_id);
		$this->db->where('group',$group);
		$this->db->where('id !=',$id);
		$this->db->where('df',0);
		$query=$this->db->get('group');
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
	
		
	}
	function delete_group_inactive_check($id)
	{
		$query = $this->db->query("select a.id from notes a,student_group b,subject_details c where a.group_id='$id' or b.group_id='$id' or c.group_id='$id'");
		/*$this->db->select('subject_details.*');
		$this->db->where('group_id', $id);
		$query = $this->db->get('subject_details');*/
			//print_r($query);exit;
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		
			return false;
	}
	
	/*function get_clas_count()
	{
		
		
	}*/
	
}