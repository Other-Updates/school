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
 
class Attendence_model extends CI_Model{

    private $table_name	= 'ur table name';	

	function __construct()
	{
		parent::__construct();

	}
	function day_ords($at_inp)
	{
		$dat_e = date('Y-m-d',strtotime($at_inp['dat_e']));		
		$this->db->select('day_ord_no');
		$man_where_con = array('batch_id'=>$at_inp['batch_id'],'semester_id'=>$at_inp['sem_id'],'depart_id'=>$at_inp['dept_id'],'group_id'=>$at_inp['group_id'],'date'=>$dat_e);	

		$atten_las_id = $this->db->get_where('attendance',$man_where_con)->result_array();
		if(isset($atten_las_id[0]['day_ord_no'])){ $day_ord_no = $atten_las_id[0]['day_ord_no']; }else{ $day_ord_no = '0'; }
		
		return $day_ord_no;
		//$now_att_rows = $this->db->get_where('attendance',$man_where_con)->num_rows();
			
	}	
	function get_sutent_hurs_list($atten_inputs)
	{
				
		$this->db->where('student_group.batch_id', $atten_inputs['batch_id']);
		$this->db->where('student_group.group_id', $atten_inputs['group_id']);
		$this->db->select('student_group.*,student.*');	
		$this->db->join('student','student.id = student_group.student_id');		
		$query['stud_list'] = $this->db->get('student_group')->result_array();
		
		$this->db->where('student_group.batch_id', $atten_inputs['batch_id']);
		$this->db->where('student_group.group_id', $atten_inputs['group_id']);
		$this->db->select('student_group.*,student.*');	
		$this->db->join('student','student.id = student_group.student_id');	
		$query['tot_stud'] = $this->db->get('student_group')->num_rows();
		$query['dat_e'] = $atten_inputs['dat_e'];
		
		$this->db->select('details');	
		$this->db->from('mas_college_det');	
		$this->db->where('typ_e','total_hours');
		$query['tot_hou'] = $this->db->get()->result_array();
		
		$this->db->select('*');	
		$this->db->where('batch_id',$atten_inputs['batch_id']);
		$this->db->where('group_id',$atten_inputs['group_id']);	
		
		$query['tot_subj'] = $this->db->get('subject_details')->result_array();
		
		$this->db->select('*');	
		$this->db->where('staff_type_id','2'); //HERE THE staff_type_id = 1 IS HOT COTED FOR THE TEACHING STAFF
		$this->db->where('depart_id',$atten_inputs['dept_id']);	
		
		$query['staff_list'] = $this->db->get('staff')->result_array();	
		
		return $query;

		
	}
	function get_subj_staff($tot_inputs) 
	{
		/*echo "<pre>";
		print_r($tot_inputs);
		exit;*/
				
		$this->db->select('time_table.*,time_table_details.supject_id,subject_details.*,staff.id as stf_id,staff.staff_name');	
		$this->db->where('time_table.batch_id',$tot_inputs['batch_id']);
		$this->db->where('time_table.semester_id',$tot_inputs['sem_id']);
		$this->db->where('time_table.depart_id',$tot_inputs['dept_id']);
		$this->db->where('time_table.group_id',$tot_inputs['group_id']);
		
		$this->db->where('time_table_details.day_order',$tot_inputs['day_ord']);
		$this->db->where('time_table_details.hours',$tot_inputs['hrs_nos']);
		
		$this->db->join('time_table_details','time_table_details.time_table_id=time_table.id');
		$this->db->join('subject_details','subject_details.id=time_table_details.supject_id');
		$this->db->join('staff','staff.id=subject_details.staff_id');
		
		$query = $this->db->get('time_table')->result_array();	
		return $query;
		
	}
	function staff_pwd($pwd_inputs)
	{
		$this->db->select('id');	
		$this->db->where('id',$pwd_inputs['stf_id']);
		$this->db->where('pwd',md5($pwd_inputs['stf_pwd']));			
		$query = $this->db->get('staff')->num_rows();	
		if($query > 0){ return 1; }else{ return 0; }
	}
	function insert_attend($at_inp)
	{
		$cur_date =  $this->user_auth->get_curdate();
		$cur_dt = date("Y-m-d", strtotime($cur_date));
		$cur_time = $this->user_auth->get_curdate_time();
		
		$dat_e = date("Y-m-d", strtotime($at_inp['dat_e']));
		
		$this->db->select('id');
		$man_where_con = array('batch_id'=>$at_inp['batch_id'],'semester_id'=>$at_inp['sem_id'],'depart_id'=>$at_inp['dept_id'],'group_id'=>$at_inp['group_id'],'date'=>$dat_e);	

		$atten_las_id = $this->db->get_where('attendance',$man_where_con)->result_array();
		if(isset($atten_las_id[0]['id'])){ $att_ls_id = $atten_las_id[0]['id']; }
		
		$now_att_rows = $this->db->get_where('attendance',$man_where_con)->num_rows();
		/*echo $now_att_rows;
		exit;*/
		if($now_att_rows<1) //THIS BLOCK WILL EXECUTE WHEN THE FIRST HOURE ATTENDANCE GET PUT
		{
		
			//THIS IS FOR INSERTING THE ATTENDANCE TABLE
			$ins_data=array('batch_id'=>$at_inp['batch_id'],'semester_id'=>$at_inp['sem_id'],'depart_id'=>$at_inp['dept_id'],'group_id'=>$at_inp['group_id'],'date'=>$dat_e,'day_ord_no'=>$at_inp['day_ord'],'tot_strenth'=>$at_inp['tot_strth'],'atten_mod'=>'p','post_dt'=>$cur_time);
			$this->db->insert('attendance', $ins_data);
			$attend_id = $this->db->insert_id();
			
			//THIS IS FOR INSERTING THE ATTENDANCE STAFF TABLE
			$ins_data_1=array('attend_id'=>$attend_id,'staff_id'=>$at_inp['staff_id'],'subj_id'=>$at_inp['subject_id'],'tot_pres'=>$at_inp['pres_strth'],'date'=>$dat_e,'hours_no'=>$at_inp['hour_no'],'post_dt'=>$cur_dt);
			$this->db->insert('attendance_staff_det', $ins_data_1);
			$attend_stf_id = $this->db->insert_id();
			
			//THIS IS FOR INSERTING THE ATTENDANCE STUDENT TABLE
			foreach($at_inp['attend_arr'] as $stud_id)
			{
				$ins_data_2=array('attend_id'=>$attend_id,'atten_staff_det_id'=>$attend_stf_id,'subj_id'=>$at_inp['subject_id'],'std_id'=>$stud_id,'date'=>$dat_e,'hours_no'=>$at_inp['hour_no'],'atten_mode'=>'p','post_dt'=>$cur_dt);
				$this->db->insert('attendance_stud_deta', $ins_data_2);
			}
		}
		else
		{
					
			$this->db->select('id');
			$wher_con = array('attend_id'=>$att_ls_id,'staff_id'=>$at_inp['staff_id'],'subj_id'=>$at_inp['subject_id'],'hours_no'=>$at_inp['hour_no'],'date'=>$dat_e);						
			$atten_stf_las_id = $this->db->get_where('attendance_staff_det',$wher_con)->result_array();					
			
			$now_att_stf_rows = $this->db->get_where('attendance_staff_det',$wher_con)->num_rows();
						
			if(isset($atten_stf_las_id[0]['id'])){ $att_stf_ls_id = $atten_stf_las_id[0]['id']; }
			if($now_att_stf_rows<1)
			{
				//THIS IS FOR INSERTING THE ATTENDANCE STAFF TABLE
				$ins_data_1=array('attend_id'=>$att_ls_id,'staff_id'=>$at_inp['staff_id'],'subj_id'=>$at_inp['subject_id'],'tot_pres'=>$at_inp['pres_strth'],'date'=>$dat_e,'hours_no'=>$at_inp['hour_no'],'post_dt'=>$cur_dt);
				$this->db->insert('attendance_staff_det', $ins_data_1);
				$attend_stf_id = $this->db->insert_id();
				
				//THIS IS FOR INSERTING THE ATTENDANCE STUDENT TABLE
				foreach($at_inp['attend_arr'] as $stud_id)
				{					
					$ins_data_2=array('attend_id'=>$att_ls_id,'atten_staff_det_id'=>$attend_stf_id,'subj_id'=>$at_inp['subject_id'],'std_id'=>$stud_id,'date'=>$dat_e,'hours_no'=>$at_inp['hour_no'],'atten_mode'=>'p','post_dt'=>$cur_dt);
					$this->db->insert('attendance_stud_deta', $ins_data_2);
				}	
			}
			else
			{
				
				$this->db->where('id',$att_stf_ls_id,'attend_id',$att_ls_id);
				$ins_data_1=array('tot_pres'=>$at_inp['pres_strth']);
				$this->db->update('attendance_staff_det', $ins_data_1);
				
				$this->db->where('attend_id', $att_ls_id,'atten_staff_det_id',$atten_stf_las_id,'date',$dat_e);
   				$this->db->delete('attendance_stud_deta');
				
				foreach($at_inp['attend_arr'] as $stud_id)
				{					
					$ins_data_2=array('attend_id'=>$att_ls_id,'atten_staff_det_id'=>$att_stf_ls_id,'subj_id'=>$at_inp['subject_id'],'std_id'=>$stud_id,'date'=>$dat_e,'hours_no'=>$at_inp['hour_no'],'atten_mode'=>'p','post_dt'=>$cur_dt);
					$this->db->insert('attendance_stud_deta', $ins_data_2);
				}		
				
			}
					
		}
		
		return true;		
		
	}
	
	
}