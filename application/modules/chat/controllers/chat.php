<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends MX_Controller {

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
	public $outputData;		//Holds the output data for each view
	public $loggedInUser;
	
	function __construct()
	{
		parent::__construct();	
		$this->load->helper('url');
	    $this->load->library('session');
	    $this->load->database();
		$this->load->model('master/master_model');
		$user_det = $this->session->userdata('logged_in');
		$permission=$this->master_model->get_staff_by_id($user_det['user_id'],$user_det['staff_type']);
		if($permission[0]['chat']==0)
		redirect($this->config->item('base_url').'admin/index');	
	}
	public function index()
	{
		$this->load->model('chat_model');
		$this->outputData['listOfUsers']= $this->chat_model->getUsers();
		$userdata  = $this->session->all_userdata();
		$this->outputData['session_dataa'] = $userdata;
		//$this->load->view('userList',$this->outputData);
		$this->template->write_view('content', 'userList',$this->outputData);
		$this->template->render();
		
		
	}
	
	public function adminchat()
	{
		$this->load->model('chat_model');
		$userdata  = $this->session->all_userdata();
	
		
		$this->outputData['listOfUsers']= $this->chat_model->getadminUsers();
		
		$this->outputData['session_dataa'] = $userdata;
		//$this->load->view('userList',$this->outputData);
		$this->template->write_view('content', 'adminList',$this->outputData);
		$this->template->render();
		
		
	} 
	
	public function studentchat()
	{
		$this->load->library('session');
	    $this->load->database();
		$this->load->model('chat_model');
		$userdata  = $this->session->all_userdata();
	
		
		
		$this->outputData['listOfUsers']= $this->chat_model->getstudentUsers();
		
		$this->outputData['session_dataa'] = $userdata;
		//$this->load->view('userList',$this->outputData);
		$this->template->write_view('content', 'studentList',$this->outputData);
		$this->template->render();
		
		
	} 
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
