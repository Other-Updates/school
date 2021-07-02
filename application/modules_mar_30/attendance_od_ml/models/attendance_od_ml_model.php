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
 
class Attendance_od_ml_model extends CI_Model{

    private $table_name	= 'ur table name';	

	function __construct()
	{
		parent::__construct();

	}
	

	
	function get_sutent_list($atten_inputs) // this is for getting the student list by autocompleate ajax method
	{	
		$this->db->select('*');			
		$this->db->like('std_id',$atten_inputs['q']);   			
		$query= $this->db->get('student')->result_array();	
		return $query;
		
	}
	function get_sutent_list_for_hostel($atten_inputs) // this is for getting the student list by autocompleate ajax method
	{	
		$this->db->select('*');	
		$this->db->where('hostel',1);		
		$this->db->like('std_id',$atten_inputs['q']);   			
		$query= $this->db->get('student')->result_array();	
		/*$i=0;	
		foreach($query as $val)
		{
			$this->db->where('hostel_student_rooms.user_id',$val['id']);	
			$room_check= $this->db->get('hostel_student_rooms')->result_array();
			if(isset($room_check) && !empty($room_check))
			unset($val[$i]);
			$i++;
		}*/
		return $query;
		
	}
	/*function get_lev_type_list() // this is for getting the leave type list
	{
		$this->db->select('*');	
		$get_whe = array('typ_e'=>'leave_types','statu_s'=>'1');		
   			
		$query= $this->db->get_where('mas_college_det',$get_whe)->result_array();	
		return $query;
	}*/
	
	function leave_date_inse($at_inp)
	{
		$cur_date =  $this->user_auth->get_curdate();
		$cur_dt = date("Y-m-d", strtotime($cur_date));
		$cur_time = $this->user_auth->get_curdate_time();
		foreach($at_inp['attend_arr'] as $dat_e1)
		{
			$tm = explode(',',$dat_e1);
			$dat_e = $tm[0];
			$dt_hrs = $tm[1];
			$this->db->select('id');
			$this->db->where('date',$dat_e);
			$num_rws = $this->db->get('attendance')->num_rows();
			if($num_rws>0)
			{
				//THIS IS FOR INSERTING THE ATTENDANCE TABLE
				$ins_data=array('leav_hrs'=>$dt_hrs);
				$this->db->where('date',$dat_e);
				$this->db->update('attendance',$ins_data);
			}
			else
			{
				//THIS IS FOR INSERTING THE ATTENDANCE TABLE
				$ins_data=array('date'=>$dat_e,'atten_mod'=>'h','leav_hrs'=>$dt_hrs,'post_dt'=>$cur_time);
				$this->db->insert('attendance',$ins_data);
			}
			
		}
		return true;
	
	}
	function abs_date_list($intp_vls)
	{
		$this->db->select('student.id,student_group.*');		
		$this->db->where('student.std_id',$intp_vls['rol_no']); 
		$this->db->join('student_group','student_group.student_id=student.id'); 
		$sud_det = $this->db->get('student')->result_array();
		$sem_id = $intp_vls['sem_id'];
		if(isset($sud_det[0]['batch_id']) && !empty($sud_det[0]['batch_id']))
		{
		$this->db->select('*');		
		$whe_cn = array('batch_id'=>$sud_det[0]['batch_id'],'semester_id'=>$sem_id,'depart_id'=>$sud_det[0]['depart_id'],'group_id'=>$sud_det[0]['group_id']);
		$atten_det = $this->db->get_where('attendance',$whe_cn)->result_array();
		$i = 0;
		$abs_dates = array();
		
		foreach($atten_det as $ar_vls)
		{
			$this_wr = array('attend_id'=>$ar_vls['id']); $this_wrst = array('attend_id'=>$ar_vls['id'],'std_id'=>$sud_det[0]['id']);  
			$att_sfdet = $this->db->get_where('attendance_staff_det',$this_wr)->num_rows();
			$att_stdet = $this->db->get_where('attendance_stud_deta',$this_wrst)->num_rows();
			
			if($att_sfdet!=$att_stdet){ $abs_dates[$i]=$ar_vls['date'].",".$ar_vls['id']; $i++; }
				
		}
		/*echo "<pre>";
		print_r($abs_dates);
		exit;*/
		return $abs_dates;
		}
		return false;
			
	}	
	function od_ml_date_inse($at_inp)
	{
		$cur_date =  $this->user_auth->get_curdate();
		$cur_dt = date("Y-m-d", strtotime($cur_date));
		$cur_time = $this->user_auth->get_curdate_time();
		
		$this->db->select('id');
		$this->db->where('std_id',$at_inp['rol_no']);
		$query = $this->db->get('student')->result_array();
		$std_id = $query[0]['id'];
		
		if($at_inp['lv_type_id']==2){ $lev_typ = 'od'; }else if($at_inp['lv_type_id']==3){ $lev_typ = 'ml'; }
		
		$ins_data=array('batch_id'=>$at_inp['batch_id'],'semester_id'=>$at_inp['sem_id'],'stud_id'=>$std_id,'no_of_day'=>$at_inp['sele_cnt'],'atten_mode'=>$lev_typ,'post_dt'=>$cur_time);
		$this->db->insert('atten_od_ml_std',$ins_data);
		$atte_last_id = $this->db->insert_id();	
		$i =0;
		foreach($at_inp['attend_arr'] as $dat_e)
		{
			$hrs = $at_inp['att_hrs_arr'][$i];			
			//THIS IS FOR INSERTING THE ATTENDANCE TABLE
			$ins_data=array('atten_od_ml_std_id'=>$atte_last_id,'stud_id'=>$std_id,'date'=>$dat_e,'hrs'=>$hrs,'post_dt'=>$cur_time);
			$this->db->insert('atten_od_ml_dates',$ins_data);
			$i++;
		}
		return true;
	
	}
	function od_ml_hrs_inse($at_inp)
	{		
		if($at_inp['lv_type_id']==1){ $att_mod = 'od'; }else if($at_inp['lv_type_id']==2){ $att_mod = 'ml'; }
		
		$cur_date =  $this->user_auth->get_curdate();
		$cur_dt = date("Y-m-d", strtotime($cur_date));
				
		foreach($at_inp['attend_arr'] as $saff_id)
		{
			 $arr_vl = explode('-',$saff_id);
			 $stf_id = $arr_vl[0];
			 $subj_id = $arr_vl[1];
		
			$this->db->select('*');
			$this->db->where('id',$stf_id);
			$query = $this->db->get('attendance_staff_det')->result_array();
			//echo $this->db->last_query();
			
			$ins_data_2=array('attend_id'=>$at_inp['atten_id'],'atten_staff_det_id'=>$stf_id,'subj_id'=>$subj_id,'std_id'=>$at_inp['stud_id'],'date'=>$query[0]['date'],'hours_no'=>$query[0]['hours_no'],'atten_mode'=>$att_mod,'post_dt'=>$cur_dt);
			$this->db->insert('attendance_stud_deta', $ins_data_2);
		}
		return true;
			
		
	}
	function stud_name_by_rolno($stud_rono)
	{
		$this->db->select('*');		
		$whe_cn = array('std_id'=>$stud_rono['rol_no']);
		$no = $this->db->get_where('student',$whe_cn)->num_rows();
		if($no>0)
		{
			$atten_det = $this->db->get_where('student',$whe_cn)->result_array();
			return $atten_det[0]['name'];
		}
		else
		{
			return "fail";
		}
	
		
	}
	
	
}