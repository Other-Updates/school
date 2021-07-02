<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seat extends MX_Controller {

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
		$user_det = $this->session->userdata('logged_in');
		$this->load->model('master/master_model');
		$permission=$this->master_model->get_staff_by_id($user_det['user_id'],$user_det['staff_type']);
		if($permission[0]['internal_mark']==0)
		redirect($this->config->item('base_url').'admin/index');	
	}
	
	public function seat_arrangment()
	{
		$data=array();
		$this->load->model('seat/seat_model');
		$this->load->model('student/student_model');
		$data['all_batch'] =$this->student_model->get_all_batch();
		$data['all_exam_hall'] =$this->seat_model->get_all_exam_hall();
		$this->template->write_view('content', 'index',$data);
        $this->template->render();
	}
	public function seat_view_room($id)
	{
		$data=array();
		$this->load->model('seat/seat_model');
		$this->load->model('student/student_model');
		$data['all_batch'] =$this->student_model->get_all_batch();
		$data['all_exam_hall'] =$this->seat_model->get_all_exam_hall($id);
		$this->template->write_view('content', 'seat_view_room',$data);
        $this->template->render();
	}
	public function create_seat_layout()
	{
		$input=$this->input->get();
		$this->load->model('student/student_model');
		$data['all_batch'] =$this->student_model->get_all_batch();
		$data['post_data'] =$input;
		echo $this->load->view('seat/create_seat_layout',$data,true);
		exit;
	}
	public function seat_delete()
	{
		$input=$this->input->post();
		$this->load->model('seat/seat_model');
		$this->seat_model->delete_room($input['id']);
		redirect($this->config->item('base_url').'seat/seat_arrangment');	
	}
	public function seat_layout_view()
	{
		$input=$this->input->get();
		$this->load->model('student/student_model');
		$data['post_data'] =$input;
		echo $this->load->view('seat/seat_layout_view',$data,true);
	}
	public function get_all_std()
	{
		$input=$this->input->get();
		$this->load->model('seat/seat_model');
		$total_std=$this->seat_model->get_all_std_total($input);
		echo $total_std;
	}
	public function get_all_seat_view()
	{
		$input=$this->input->get();
		
	}
	public function insert_seat()
	{
		$input=$this->input->post();
		$this->load->model('seat/seat_model');
		//echo "<pre>";
		//print_r($input);
		
		$this->session->set_userdata('seat_no',1);
		//exit;
		$hall_id=$this->seat_model->insert_hall($input['hall']);
		foreach($input['cols'] as $cols_id=>$val)
		{
			foreach($val as $ds)
			{
				$this->seat_model->get_available_std($ds,$hall_id);
			}
			
		}
		$this->session->unset_userdata('seat_no');
		redirect($this->config->item('base_url').'seat/seat_arrangment');	
		//exit;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
