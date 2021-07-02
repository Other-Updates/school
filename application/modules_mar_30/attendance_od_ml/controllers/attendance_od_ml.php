<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attendance_od_ml extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));		
		$this->load->library('session');		
		$this->load->library('form_validation');	
		$this->load->model('master/master_model');
		$user_det = $this->session->userdata('logged_in');
		$permission=$this->master_model->get_staff_by_id($user_det['user_id'],$user_det['staff_type']);
		if($permission[0]['attendance']==0)
		redirect($this->config->item('base_url').'admin/index');		
	}
	
	public function index()
	{
		$this->load->model('group/group_model');
		$this->load->model('student/student_model');
		$this->load->model('semester/semester_model');
		$this->load->model('staff/staff_model');
		$this->load->model('attendance_od_ml_model');
		$data['all_batch'] = $this->student_model->get_all_batch();
		$data['sem_list']=$this->semester_model->get_semester();
		
		//$data['leav_type'] = $this->attendance_od_ml_model->get_lev_type_list();
		/*echo "<pre>";
		print_r($data['leav_type']);
		exit;*/
				
		$data['staff_det']=$this->staff_model->select_all_staff(1);
		$this->template->write_view('content','attendance_od_ml/index',$data);
        $this->template->render();	
	}
	public function get_sutent_list()
	{
		$atten_inputs = $this->input->POST();
			
		$this->load->model('attendance_od_ml_model');
		$data = $this->attendance_od_ml_model->get_sutent_list($atten_inputs);
		foreach($data as $st_rlno)
		{
			echo $st_rlno['std_id']."\n";
		}			
	}
	public function get_date_list()
	{
		$data['ids'] = $this->input->POST();
		echo $this->load->view('attendance_od_ml/date_list_ajax',$data);
	}
	public function abs_date_list()
	{
		$leav_inputs = $this->input->POST();
		$this->load->model('attendance_od_ml_model');
		$data['date_list'] = $this->attendance_od_ml_model->abs_date_list($leav_inputs);
		echo $this->load->view('attendance_od_ml/abs_date_list_ajax',$data);
	}
	public function get_date_hrs_list()
	{
		$data['ids'] = $this->input->POST();
		echo $this->load->view('attendance_od_ml/date_hrs_list_ajax',$data);
	}
	public function leave_date_inse()
	{
		$this->load->model('attendance_od_ml_model');
		$leav_inputs = $this->input->POST();
		$leav_sts = $this->attendance_od_ml_model->leave_date_inse($leav_inputs);
		echo $leav_sts;	
	}
	public function od_ml_date_inse()
	{
		$this->load->model('attendance_od_ml_model');
		$leav_inputs = $this->input->POST();
		$leav_sts = $this->attendance_od_ml_model->od_ml_date_inse($leav_inputs);
		echo $leav_sts;	
	}	
	public function od_ml_hrs_inse()
	{
		$this->load->model('attendance_od_ml_model');
		$leav_inputs = $this->input->POST();
		$leav_sts = $this->attendance_od_ml_model->od_ml_hrs_inse($leav_inputs);
		echo $leav_sts;	
	}
	public function stud_name_by_rolno()
	{
		$this->load->model('attendance_od_ml_model');
		$std_rono = $this->input->POST();
		$reslt = $this->attendance_od_ml_model->stud_name_by_rolno($std_rono);
		echo $reslt;	
	}		
		
	
	

	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
