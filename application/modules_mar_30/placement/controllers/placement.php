<?php

session_start();

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Placement extends MX_Controller {

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
		$this->load->library('image_lib');
		
	
	}
	public function index()
	{
		$this->load->model('group/group_model');
		$this->load->model('placement/placement_model');
		$this->load->model('student/student_model');
		if($this->input->post())
		{			
			
			$input=$this->input->post();
			$session_data=$this->session->userdata('logged_in');
			$insert_interview=array(
									'batch_id'=>$input['batch_id'],
									'department'=>$input['department'],
									'percentage'=>$input['percentage'],
									'company_name'=>$input['company_name'],
									'venue'=>$input['venue'],
									'date'=>$input['reservation'],
									'comments'=>$input['company_comment'],
									'salary'=>$input['salary'],
									'arrear'=>$input['arrear'],
									'created_dy'=>$session_data['user_id'],
									'staff_type'=>$session_data['staff_type']
									);
			$insert_id=$this->placement_model->insert_interview($insert_interview);						
			$i=0;
			if(isset($input['std_id']) && !empty($input['std_id']))
			{
				foreach($input['std_id'] as $key=>$val)
				{
					$insert_more_details[$i]['student_id']=$val;
					$insert_more_details[$i]['placement_id']=$val;
					$i++;
				}
			}
			$this->placement_model->insert_more_interview_details($i);	
			redirect($this->config->item('base_url').'placement/placement_list');
		}
		
		$data['all_depart']=$this->group_model->get_all_department();
		$data['all_batch'] =$this->student_model->get_all_batch();
		$this->template->write_view('content', 'index',$data);
        $this->template->render();	
	}
	public function view_std_list()
	{
		$data['get_mark']=$this->input->POST();
		$this->load->model('users/users_model');
		//$data['mark']=$this->users_model->get_percentage_for_placement($data['get_mark']);
		$data['mark']=$this->users_model->get_percentage_for_placement_in_excel($data['get_mark']);
		echo $this->load->view('placement/std_list',$data);
	}
	
	public function placement_list()
	{
		$this->load->model('placement/placement_model');
		$data['all_placement']=$this->placement_model->get_all_placement();
		$this->template->write_view('content', 'placement/placement_list',$data);
        $this->template->render();	
	}
	public function edit_placement($id)
	{
		$this->load->model('group/group_model');
		$this->load->model('placement/placement_model');
		$this->load->model('student/student_model');
		if($this->input->post())
		{			
			$input=$this->input->post();
			$session_data=$this->session->userdata('logged_in');
			$insert_interview=array(
									'batch_id'=>$input['batch_id'],
									'department'=>$input['department'],
									'percentage'=>$input['percentage'],
									'company_name'=>$input['company_name'],
									'venue'=>$input['venue'],
									'date'=>$input['reservation'],
									'comments'=>$input['company_comment'],
									'salary'=>$input['salary'],
									'arrear'=>$input['arrear'],
									'created_dy'=>$session_data['user_id'],
									'staff_type'=>$session_data['staff_type']
									);
			$insert_id=$this->placement_model->update_interview($insert_interview,$id);		
			$i=0;
			$this->placement_model->delete_other_interview_details($id);
			if(isset($input['std_id']) && !empty($input['std_id']))
			{
				foreach($input['std_id'] as $key=>$val)
				{
					$insert_more_details[$i]['student_id']=$val;
					$insert_more_details[$i]['placement_id']=$insert_id;
					$i++;
				}
			}
			$this->placement_model->insert_more_interview_details($i);				
			redirect($this->config->item('base_url').'placement/placement_list');
		}
		$data['all_depart']=$this->group_model->get_all_department();
		$data['all_batch'] =$this->student_model->get_all_batch();
		$data['get_placement']=$this->placement_model->get_placement_by_id($id);
		$data['placement_id']=$id;
		/*echo "<pre>";
		print_r($data);exit;*/
		$this->template->write_view('content', 'placement/edit_placement',$data);
        $this->template->render();
	}
	public function edit_std_list()
	{
		$data['get_mark']=$this->input->POST();
		$this->load->model('users/users_model');
		$this->load->model('placement/placement_model');
		$data['get_placement']=$this->placement_model->get_placement_by_id($data['get_mark']['id']);
	
		//$data['mark']=$this->users_model->get_percentage_for_placement($data['get_mark']);
		$data['mark']=$this->users_model->get_percentage_for_placement_in_excel($data['get_mark']);
		
		echo $this->load->view('placement/edit_std_list',$data);
	}
	public function view_page_std_list()
	{
		$data['get_mark']=$this->input->POST();
		$this->load->model('users/users_model');
		$this->load->model('placement/placement_model');
		$data['get_placement']=$this->placement_model->get_placement_by_id($data['get_mark']['id']);
		$data['mark']=$this->users_model->get_percentage_for_placement_in_excel($data['get_mark']);
		echo $this->load->view('placement/view_std_list',$data);
	}
	public function view_placement($id)
	{
		$this->load->model('group/group_model');
		$this->load->model('placement/placement_model');
		$data['all_depart']=$this->group_model->get_all_department();
		$data['get_placement']=$this->placement_model->get_placement_by_id($id);
		$data['placement_id']=$id;
		$this->template->write_view('content', 'placement/view_placement',$data);
        $this->template->render();
	}
	public function update_placed_status()
	{
		$data['get_mark']=$this->input->POST();
		$this->load->model('users/users_model');
		$this->load->model('placement/placement_model');
		$where=array('id'=>$data['get_mark']['p_std_id']);
		$data1=array('placed'=>1);
		$this->placement_model->update_student_participation_status($where,$data1);
		
		$data['get_placement']=$this->placement_model->get_placement_by_id($data['get_mark']['id']);
		$data['mark']=$this->users_model->get_percentage_for_placement($data['get_mark']);
		$data['from']='placed';
		echo $this->load->view('placement/view_std_list',$data);
	}
}
	 

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */