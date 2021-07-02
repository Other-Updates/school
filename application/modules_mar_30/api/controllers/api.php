<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MX_Controller {

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
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');
	    $this->load->database();
		$this->load->library('form_validation');
			
	}
	
	public function get_notification()
	{
		$this->load->model('api/api_model');
		$this->load->model('api/notification_model');
		$user_det = $this->session->userdata('logged_in');
		
		if($user_det['staff_type']=='admin')
		{
			$unread_tickets=$this->api_model->get_unread_tickets_for_admin($this->user_auth->get_user_id(),0);
			$unread_tickets_count=$this->api_model->get_unread_tickets_for_admin1($this->user_auth->get_user_id(),0);
			
		}
		if($user_det['staff_type']=='staff')
		{
			
			$unread_tickets=$this->api_model->get_unread_tickets_for_staff($this->user_auth->get_user_id(),2);	
			$unread_tickets_count=$this->api_model->get_unread_tickets_for_staff1($this->user_auth->get_user_id(),2);	
		}
		if(empty($user_det))
		{
			$user_det = $this->session->userdata('user_info');
			$unread_notification=$this->notification_model->get_unread_notification($user_det[0]['id'],'student');
			$unread_notification_count=$this->notification_model->get_unread_notification1($user_det[0]['id'],'student');
		}
		else
		{
			$unread_notification=$this->notification_model->get_unread_notification($this->user_auth->get_user_id(),$user_det['staff_type']);
			$unread_notification_count=$this->notification_model->get_unread_notification1($this->user_auth->get_user_id(),$user_det['staff_type']);
		}
		if(isset($user_det['staff_type']))
		{
			if($user_det['staff_type']=='staff' || $user_det['staff_type']=='admin')
			{
				$get_unread_message=$this->api_model->get_unread_message($this->user_auth->get_username());
				$get_unread_message_count=$this->api_model->get_unread_message_count($this->user_auth->get_username());
			}
		}
		else
		{
			$get_unread_message=$this->api_model->get_unread_message($user_det[0]['name']);
			
			$get_unread_message_count=$this->api_model->get_unread_message_count($user_det[0]['name']);
		}
		
		$result=compact('unread_tickets','unread_notification','get_unread_message','get_unread_message_count','unread_tickets_count','unread_notification_count');
		echo json_encode($result);	
	}
	public function change_tickets_status($id)
	{
		$user_det = $this->session->userdata('logged_in');
		$this->load->model('api/api_model');
		if($user_det['staff_type']=='admin')
		{
			$links='staff_tickets/admin_view';
			$this->api_model->update_tickets_status_for_admin($id);
		}
		else
		{
			$links='staff_tickets';
			$this->api_model->update_tickets_status_for_staff($id);
		}
		echo json_encode($links);	
	}
	public function change_read_status($id)
	{
		$this->load->model('api/notification_model');
		$this->notification_model->update_notification_status($id);
		echo json_encode('enter');	
		
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
