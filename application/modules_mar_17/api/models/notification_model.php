<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin_model
 *
 * This model represents admin access. It operates the following tables:
 * admin,
 *
 * @package	i2_soft
 * @author	Elavarasan
 */
 
class Notification_model extends CI_Model{

   
     private $table_name	= 'notification';
	 private $table_name1	= 'subject_details';
	  private $table_name2	= 'read_notification';
	    private $table_name3	= 'student_group';
		  private $table_name4	= 'staff';
		    private $table_name5	= 'student';
	function __construct()
	{
		parent::__construct();

	}
	function insert_notification($data)
	{
		if ($this->db->insert($this->table_name, $data)) {
			$insert_id = $this->db->insert_id();
			
			return array('id' => $insert_id);
		}
		return false;
	}
	function get_all_staff($where)
	{
		$this->db->select('staff_id as user_id');
		$this->db->where($where);
		$this->db->group_by('staff_id');
		$query = $this->db->get($this->table_name1);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;	
	}
	function get_all_staff_notice($where)
	{
		$this->db->select('id as user_id');
		$this->db->where($where);
		$this->db->group_by('staff_id');
		$query = $this->db->get($this->table_name4);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;	
	}
	function get_all_staff_for_email($where)
	{
		$this->db->select($this->table_name1.'.staff_id as user_id');
		$this->db->select('staff.email_id,staff.staff_name');
		$this->db->where($where);
		$this->db->join('staff','staff.id='.$this->table_name1.'.staff_id');
		$this->db->group_by($this->table_name1.'.staff_id');
		$query = $this->db->get($this->table_name1);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;	
	}
	function all_staff()
	{
		$this->db->select('id as user_id');
		$query = $this->db->get($this->table_name4);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;	
	}
	function insert_all_staff($data)
	{
		if ($this->db->insert_batch($this->table_name2, $data)) {
		$insert_id = $this->db->insert_id();
		
		return array('id' => $insert_id);
		}
		return false;
	}
	function get_all_student($where)
	{
		$this->db->select('student_id as user_id,email_id');
		$this->db->join('student','student.id='.$this->table_name3.'.student_id');
		$this->db->where($where);
		$query = $this->db->get($this->table_name3);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;	
	}
	function get_all_student1($where)
	{
		$this->db->select('id as user_id,email_id');
		$this->db->where($where);
		$query = $this->db->get($this->table_name5);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;	
	}
	function get_all_student2($roll_no)
	{
		$this->db->select('id as user_id,email_id');
		$this->db->where('std_id',$roll_no);
		$query = $this->db->get($this->table_name5);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;	
	}
	function get_all_student_for_email($where)
	{
		$this->db->select('student_id as user_id');
		$this->db->select('student.email_id,student.name');
		$this->db->select('student.status',1);
		$this->db->where($where);
		$this->db->join('student','student.id='.$this->table_name3.'.student_id');
		$query = $this->db->get($this->table_name3);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;	
	}
	function get_all_public_student()
	{
		$this->db->select('student_id as user_id');
		$query = $this->db->get($this->table_name3);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;	
	}
	function get_unread_notification($id,$type)
	{
		$this->db->limit(7);
		$this->db->select($this->table_name2.'.*');
		$this->db->select($this->table_name2.'.id as update_id');
		$this->db->select('notification.*');
	//$this->db->select("DATE_FORMAT(read_notification.date)");
		$this->db->select("DATE_FORMAT(read_notification.date, ('%d %M %Y ')) as date");
		$this->db->where($this->table_name2.'.read !=',2);
		$this->db->where($this->table_name2.'.user_id',$id);
		$this->db->where($this->table_name2.'.user_type',$type);
		$this->db->where($this->table_name2.'.date < now()');
		$this->db->order_by($this->table_name2.'.id','desc');
		$this->db->join('notification','notification.id='.$this->table_name2.'.notification_id');
		$query = $this->db->get($this->table_name2);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;	
	}
	function get_unread_notification_for_all($id,$type)
	{
		//$this->db->limit(7);
		$this->db->select($this->table_name2.'.*');
		$this->db->select($this->table_name2.'.id as update_id');
		$this->db->select('notification.*');
	//$this->db->select("DATE_FORMAT(read_notification.date)");
		$this->db->select("DATE_FORMAT(read_notification.date, ('%d %M %Y ')) as date");
		$this->db->where($this->table_name2.'.read !=',2);
		$this->db->where($this->table_name2.'.user_id',$id);
		$this->db->where($this->table_name2.'.user_type',$type);
		$this->db->where($this->table_name2.'.date < now()');
		$this->db->order_by($this->table_name2.'.id','desc');
		$this->db->join('notification','notification.id='.$this->table_name2.'.notification_id');
		$query = $this->db->get($this->table_name2);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;	
	}
	function get_unread_notification1($id,$type)
	{
		$this->db->select($this->table_name2.'.*');
		$this->db->select('notification.*');
		$this->db->where($this->table_name2.'.read',0);
		$this->db->where($this->table_name2.'.read !=',2);
		$this->db->where($this->table_name2.'.user_id',$id);
		$this->db->where($this->table_name2.'.user_type',$type);
		$this->db->where($this->table_name2.'.date < now()');
		$this->db->join('notification','notification.id='.$this->table_name2.'.notification_id');
		$query = $this->db->get($this->table_name2);
		
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;	
	}
	function update_notification_status($id)
	{
		$data=array('read'=>1);
		$this->db->where('id',$id);
		if ($this->db->update($this->table_name2, $data)) {
			return true;
		}
		return false;
	}
	function get_all_notification_for_recent($u_id,$type)
	{
		$this->db->select($this->table_name.'.*');
		$this->db->where($this->table_name.'.user_id',$u_id);
		$this->db->where($this->table_name.'.user_type',$type);
		$this->db->where($this->table_name.'.status',1);
		$this->db->order_by($this->table_name.'.id','desc');
		$query = $this->db->get($this->table_name)->result_array();
		$i=0;
		
		foreach($query as $val)
		{
			$this->db->where($this->table_name2.'.notification_id',$val['id']);
			$first = $this->db->get($this->table_name2)->result_array();
			if(isset($first) && !empty($first))
			{
			$query[$i]['links']=$first[0]['links'];
			$query[$i]['date']=$first[0]['date'];
			}
			$i++;
		}
		return $query;	
	}
	function update_notification($id,$data)
	{
		$this->db->where('id',$id);
		if ($this->db->update($this->table_name, $data)) {
			return true;
		}
		return false;
	}
	function get_all_staff_for_arrear()
	{
		$this->db->select('id as user_id');
		$this->db->where('staff_type_id',2);	
		$query = $this->db->get('staff')->result_array();
		return $query;
	}
	function get_all_student_for_arrear($where)
	{
		$this->db->select('student_id as user_id,email_id');
		$this->db->join('student','student.id='.$this->table_name3.'.student_id');
		$this->db->where($where);
		$query = $this->db->get($this->table_name3);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;	
	}
}