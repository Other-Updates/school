<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download_form extends MX_Controller {

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
		$this->load->library('session');
	}
	
	public function index()
	{
	  $this->load->model('download_form_model');	
	  if($this->input->post())
	  {
		 
		  
		   $this->load->helper('text');
			
			$config['upload_path'] = './download_form_files/';
			
			$config['allowed_types'] = '*';
			
			$config['max_size']	= '2000';
			
			$this->load->library('upload', $config);
			
			$input_data=$this->input->post();

			if(isset($_FILES) && !empty($_FILES))
			{
				$upload_files = $_FILES;
				if($upload_files['staff_image']['name']!='')
				{
				$_FILES['staff_image'] = array(
				'name' => $upload_files['staff_image']['name'],
				'type' => $upload_files['staff_image']['type'],
				'tmp_name' => $upload_files['staff_image']['tmp_name'],
				'error' => $upload_files['staff_image']['error'],
				'size' => 10
				);	
				
				$this->upload->do_upload("staff_image");
				$upload_data = $this->upload->data();
				}
			}
			$user_det = $this->session->userdata('logged_in');
			$input_data['file_name']=$upload_data['file_name'];
			$input_data['staff_type']=$user_det['staff_type'];
			$input_data['created_by']=$user_det['user_id'];
			$this->download_form_model->insert_form($input_data);
		
			
			redirect($this->config->item('base_url').'download_form/');
	  }	
	  $data['all_form']=$this->download_form_model->get_form();
	  $this->template->write_view('content','download_form/index',$data);
	  $this->template->render();
 	}
	function delete_form($id)
	{
		$this->load->model('download_form_model');	
		$this->download_form_model->delete_form($id);
		redirect($this->config->item('base_url').'download_form/');
	}
	public function video_files()
	{
		$this->template->write_view('content','download_form/video_files');
	 	 $this->template->render();
	}
	public function videos()
	{
		$this->template->write_view('content','download_form/example');
	 	 $this->template->render();
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
