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
 
class Seat_model extends CI_Model{

    private $table_name	= 'exam_hall';	
	private $table_name1	= 'exam_hall_details';
	function __construct()
	{
		parent::__construct();

	}

	function get_all_std_total($where)
	{
		$this->db->select('student_id');
		$this->db->where($where);
		$query=$this->db->get('student_group')->result_array();
		//echo "<pre>";
		//print_r($query);
		$i=0;
		foreach($query as $val)
		{
			$this->db->select('std_id');
			$this->db->where('std_id',$val['student_id']);
			$std=$this->db->get('exam_hall_details')->result_array();
			
			if(isset($std[0]['std_id']) && !empty($std[0]['std_id']))
			{
				//print_r($std);
				unset($query[$i]);
			}
			$i++;
		}
		//print_r(count($query));
		return count($query);
	}
	function insert_hall($hall)
	{
		$this->db->insert($this->table_name, $hall);
		$hall_id = $this->db->insert_id();
		return $hall_id;
	}
	function get_available_std($where,$hall_id)
	{
		
		//echo $hall_id;
		
		$this->db->select('student.id,student.std_id,student_group.batch_id,student_group.depart_id,student_group.group_id');
		$this->db->where('student_group.batch_id',$where['batch_id']);
		$this->db->where('student_group.depart_id',$where['depart_id']);
		$this->db->where('student_group.group_id',$where['group_id']);
		$this->db->join('student','student.id=student_group.student_id');
		$query=$this->db->get('student_group')->result_array();
		//echo "<pre>";
		//print_r($query);
		$i=1;
		$arra_list=array();
		foreach($query as $val)
		{
			$this->db->select('exam_hall_details.std_id');
			$this->db->where("exam_hall_details.std_id",$val['id']);
			$std_det=$this->db->get('exam_hall_details')->result_array();
			if(empty($std_det) && $i<=$where['set_seat'])
			{
				$c=$this->session->userdata('seat_no');
				$arra_list[]=array('hall_id'=>$hall_id,'batch_id'=>$val['batch_id'],'depart_id'=>$val['depart_id'],'group_id'=>$val['group_id'],'std_id'=>$val['id'],'std_no'=>$val['std_id'],'cols_no'=>$where['cols_no'],'seat_no'=>'S'.$c);
				
				$this->session->set_userdata('seat_no',$c+1);
				
				$i++;
			}
		}
		if(isset($arra_list) && !empty($arra_list))
			$this->db->insert_batch($this->table_name1, $arra_list);
		
	}
	public function get_all_exam_hall($id=NULL)
	{
		$this->db->where("status",1);
		if(isset($id) && !empty($id))
		{
			$this->db->where("id",$id);
		}
		$query=$this->db->get('exam_hall')->result_array();
		$i=0;
		foreach($query as $val)
		{
			$this->db->select('exam_hall_details.cols_no');
			$this->db->where("exam_hall_details.hall_id",$val['id']);
			$this->db->group_by("exam_hall_details.cols_no");
			$seat_info=$this->db->get('exam_hall_details')->result_array();
		//	print_r($seat_info);
			foreach($seat_info as $cols)
			{
				$this->db->select('exam_hall_details.std_id,std_no,seat_no');
				$this->db->where("exam_hall_details.hall_id",$val['id']);
				$this->db->where("exam_hall_details.cols_no",$cols['cols_no']);
				$this->db->order_by("exam_hall_details.id",'desc');
				$seat_info1=$this->db->get('exam_hall_details')->result_array();
				$query[$i]['column'][$cols['cols_no']]=$seat_info1;
				//echo $cols['cols_no'];
			}
			
			$i++;
		}
		return $query;
	}
	public function delete_room($id)
	{
		$this->db->where("id",$id);
		$this->db->delete('exam_hall');
		
		$this->db->where("hall_id",$id);
		$this->db->delete('exam_hall_details');
	}
}