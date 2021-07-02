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
class Staff_attendence_model extends CI_Model{

    private $table_name	= 'staff_attendance';	
	private $table_name1= 'staff';	
	function __construct()
	{
		parent::__construct();
	}
	function insert_staff_attendance($data)
	{
		$this->db->insert($this->table_name,$data);
	}
	function get_staff_attendance_by_date($date)
	{
		$this->db->select('*');
		//$this->db->order_by('staff_name','asc');
		$query = $this->db->get($this->table_name1)->result_array();
		$i=0;
		foreach($query as $val)
		{
			$this->db->select($this->table_name.'.*');
			$this->db->limit(1);
			$this->db->where($this->table_name.'.staff_id',$val['staff_id']);
			$this->db->where($this->table_name.'.date',date('Y-m-d',strtotime($date)));
			$query[$i]['in_time']=$this->db->get($this->table_name)->result_array();
			
			
			$this->db->select($this->table_name.'.*');
			$this->db->limit(1);
			$this->db->where($this->table_name.'.staff_id',$val['staff_id']);
			$this->db->order_by($this->table_name.'.id','desc');
			$this->db->where($this->table_name.'.date',date('Y-m-d',strtotime($date)));
			$query[$i]['out_time']=$this->db->get($this->table_name)->result_array();
			
			
			$i++;
		}
		//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	function report($months)
	{
		$this->db->select('*');
		$this->db->order_by('staff_name','asc');
		$query = $this->db->get($this->table_name1)->result_array();
		$i=0;
		foreach($query as $val)
		{
			$list=array();
			foreach($months as $month)
			{
				$this->db->select($this->table_name.'.time');
				$this->db->limit(1);
				$this->db->where($this->table_name.'.staff_id',$val['staff_id']);
				$this->db->where($this->table_name.'.date',date('Y-m-d',strtotime($month)));
				$list[$month]['in_time']=$this->db->get($this->table_name)->result_array();
				
				
				$this->db->select($this->table_name.'.time');
				$this->db->limit(1);
				$this->db->where($this->table_name.'.staff_id',$val['staff_id']);
				$this->db->order_by($this->table_name.'.id','desc');
				$this->db->where($this->table_name.'.date',date('Y-m-d',strtotime($month)));
				$list[$month]['out_time']=$this->db->get($this->table_name)->result_array();
			}
			$query[$i]['month_list']=$list;
			$i++;
		}
		return $query;
	}
}