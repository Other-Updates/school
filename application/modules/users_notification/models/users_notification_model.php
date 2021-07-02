<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Users_notification_model extends CI_Model
{
	private $table_name		= 'read_notification';			
	private $table_name1	= 'student_group';			
	private $table_name2	= 'student';	
	private $table_name3	= 'student_details';	
	private $table_name4	= 'notification';			
	
	
	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
	}
	function update_status($id)
	{
		
		$this->db->where('id', $id);
		if ($this->db->update($this->table_name,$data=array('read'=>1)))
		{
			return true;
		}
		return false;
	}
	function update_remove_status($id)
	{
		
		$this->db->where('id', $id);
		if ($this->db->update($this->table_name,$data=array('read'=>2)))
		{
			return true;
		}
		return false;
	}
	function get_all_student($where)
	{
		$this->db->select('student_details.join_date');
		$this->db->select('student.std_id,student.name,student.last_name,student.gender,student.image,student.id');
		$this->db->where($where);
		$this->db->join('student_details','student_details.student_id='.$this->table_name1.'.student_id');
		$this->db->join('student','student.id='.$this->table_name1.'.student_id');
		$query = $this->db->get($this->table_name1);
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
		
	}

	
	
}
/* End of file users.php */
/* Location: ./application/models/auth/users.php */