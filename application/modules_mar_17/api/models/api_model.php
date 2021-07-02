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
 
class Api_model extends CI_Model{

   
     private $table_name	= 'staff_tickets';
	   private $table_name1	= 'chat';
	function __construct()
	{
		parent::__construct();

	}
	function get_unread_tickets_for_admin($id,$read)
	{
		$this->db->select('staff_tickets.id,staff_tickets.name1,staff_tickets.subject,staff_tickets.read');
		$this->db->select('department.department');
		$this->db->select("DATE_FORMAT(staff_tickets.ldt, ('%d %M %Y ')) as ldt");
		$this->db->where('staff_tickets.admin_df',1);
		$this->db->where('staff_tickets.admin_id',$id);
		$this->db->order_by('staff_tickets.id','desc');
		$this->db->join('department','department.id='.$this->table_name.'.department');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	function get_unread_tickets_for_staff($id,$read)
	{
		$this->db->select('staff_tickets.id,staff_tickets.name1,staff_tickets.subject,staff_tickets.read');
		$this->db->select('department.department');
		$this->db->select("DATE_FORMAT(staff_tickets.ldt, ('%d %M %Y ')) as ldt");
		$this->db->order_by('staff_tickets.id','desc');
		$this->db->where('staff_tickets.staff_df',1);
		$this->db->where('staff_tickets.status',0);
		$this->db->where('staff_tickets.staff_id',$id);
		$this->db->join('department','department.id='.$this->table_name.'.department');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	
	
	function get_unread_tickets_for_admin1($id,$read)
	{
		$this->db->select('staff_tickets.id');
		$this->db->where('staff_tickets.read',$read);
		$this->db->where('staff_tickets.status',1);
		$this->db->where('staff_tickets.admin_df',1);
		$this->db->where('staff_tickets.admin_id',$id);
		$this->db->join('department','department.id='.$this->table_name.'.department');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}
		return false;
	}
	function get_unread_tickets_for_staff1($id,$read)
	{
		$this->db->select('staff_tickets.id');
		$this->db->where('staff_tickets.read',$read);
		$this->db->where('staff_tickets.status',0);
		$this->db->where('staff_tickets.staff_df',1);
		$this->db->where('staff_tickets.staff_id',$id);
		$this->db->join('department','department.id='.$this->table_name.'.department');
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}
		return false;
	}
	
	function update_tickets_status_for_admin($id)
	{
		$data=array('read'=>1);
		$this->db->where('id',$id);
		if ($this->db->update($this->table_name, $data)) {
			return true;
		}
		return false;
	}
	function update_tickets_status_for_staff($id)
	{
		
		$data=array('read'=>3);
		$this->db->where('id',$id);
		if ($this->db->update($this->table_name, $data)) {
			return true;
		}
		return false;
	}
	function get_unread_message($user_name)
	{
		//$this->db->limit(7);
		$this->db->select('from,message,sent,recd');
		$this->db->where('to',$user_name);
		$this->db->select("DATE_FORMAT(chat.sent, ('%d %M %Y %h %m %p')) as sent");
		//$this->db->where('recd',0);
		$query = $this->db->get($this->table_name1);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	function get_unread_message_count($user_name)
	{
		
		$this->db->select('from,message,sent');
		$this->db->where('to',$user_name);
		$this->db->where('recd',0);
		$query = $this->db->get($this->table_name1);
		
		return $query->num_rows();
	}
	
}