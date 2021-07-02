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
 
class Attendance_report_model extends CI_Model{

    private $table_name	= 'ur table name';	

	function __construct()
	{
		parent::__construct();

	}
	
	function get_subj($aten_in)
	{		
		$this->db->select('*');
		$whr_con = array("batch_id"=>$aten_in['batch_id'],"semester_id"=>$aten_in['sem_id'],"depart_id"=>$aten_in['dept_id'],"group_id"=>$aten_in['group_id']);
		$qer = $this->db->get_where('subject_details',$whr_con)->result_array();
		return $qer;		
	}
	function get_sutent_prs_list($atten_inputs)
	{
		/*echo "<pre>";
		print_r($atten_inputs);
		exit;*/
		
		$this->db->where('student_group.batch_id', $atten_inputs['batch_id']);
		$this->db->where('student_group.group_id', $atten_inputs['group_id']);
		$this->db->select('student_group.*,student.*');	
		$this->db->join('student','student.id = student_group.student_id');		
		$query['stud_list'] = $this->db->get('student_group')->result_array();
		
				
		$fm_date = date('Y-m-d', strtotime($atten_inputs['fm_date']));
		$to_date = date('Y-m-d', strtotime($atten_inputs['to_date']));
		
		$query['fm_date'] = $fm_date;
		$query['to_date'] = $to_date;
		
		$this->db->select('id');	
		$atten_wr = array('batch_id'=>$atten_inputs['batch_id'],'semester_id'=>$atten_inputs['sem_id'],'depart_id'=>$atten_inputs['dept_id'],'group_id'=>$atten_inputs['group_id'],'date >=' =>$fm_date,'date <='=>$to_date);		
				
		$query['tot_days'] = $this->db->get_where('attendance',$atten_wr)->result_array();
		/*echo $this->db->last_query();
		echo "<pre>";
		print_r($query['tot_days']);*/
		$tot_hr = 0;
		foreach($query['tot_days'] as $att_ids)
		{
			$this->db->select("COUNT(id) AS hour_count");
			$this->db->from("attendance_staff_det");
			$this->db->where("attend_id", $att_ids['id']);
			
			if($atten_inputs['subj_id']!='all'){ $this->db->where("subj_id", $atten_inputs['subj_id']); }
			
			$qer = $this->db->get()->result_array();
			$tot_hr = $tot_hr + $qer[0]['hour_count'];			
		}
		$query['tot_hrs'] = $tot_hr;
		$query['subj_id'] = $atten_inputs['subj_id'];
		return $query;  
	}
	
	
	
	
}