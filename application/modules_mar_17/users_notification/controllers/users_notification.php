<?php

session_start();

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_notification extends MX_Controller {

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
	public function all_notification()
	{	
		$this->load->model('api/notification_model');
		$user_det = $this->session->userdata('user_info');
		$data['unread_notification']=$this->notification_model->get_unread_notification_for_all($user_det[0]['id'],'student');
		$this->template->set_master_template('../../themes/'.$this->config->item("active_template").'/user_template.php');
		$this->template->write_view('content', 'users_notification/index',$data);
        $this->template->render();	
	}
	public function class_mate()
	{	
		$this->load->model('users_notification/users_notification_model');
		$user_det = $this->session->userdata('user_info');
	
		$where=array("student_group.batch_id"=>$user_det[0]['batch_id'],"student_group.depart_id"=>$user_det[0]['depart_id'],"student_group.group_id"=>$user_det[0]['group_id']);
		$data['all_student']=$this->users_notification_model->get_all_student($where);
		$this->template->set_master_template('../../themes/'.$this->config->item("active_template").'/user_template.php');
		$this->template->write_view('content', 'users_notification/class_mate',$data);
        $this->template->render();	
	}
	public function update_status()
	{
		$this->load->model('users_notification/users_notification_model');
		$u_id=$this->input->POST();
		$this->users_notification_model->update_status($u_id['update_id']);
		echo 'success';
	}
	public function update_remove_status()
	{
		$this->load->model('users_notification/users_notification_model');
		$u_id=$this->input->POST();
		$this->users_notification_model->update_remove_status($u_id['update_id']);
		echo 'success';
	}
	
	
}
	 

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */