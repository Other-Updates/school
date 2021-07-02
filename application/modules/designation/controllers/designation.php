<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Designation extends MX_Controller {

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
		   $this->load->model('designation/designation_model');
		   $data["details"]=$this->designation_model->get_designation();
		   $data["status"]=1;
		   $this->template->write_view('content','designation/index',$data);
		   $this->template->render();
	}
	
	
	 public function insert_designation()
	   {
			$this->load->model('designation/designation_model');
			$input=array('designation'=>$this->input->post('value1')); 
			$this->designation_model->insert_designation($input);
			 $data["details"]=$this->designation_model->get_designation();
			$data["list"]=$this->designation_model->get_designation();
			$data["status"]=1;    
			echo $this->load->view('view_list',$data); 
	   }
	
public function update_designation()
	{
		
			$this->load->model('designation/designation_model');
			$id=$this->input->post('value1');
			{
			$input=array('designation'=>$this->input->post('value2'),'status'=>$this->input->post('value3'));
			$this->designation_model->update_designation($input,$id);
			 $data["details"]=$this->designation_model->get_designation();
			$data["list"]=$this->designation_model->get_designation();
			$data["status"]=$this->input->post('value3');
		    echo $this->load->view('view_list',$data);	
		}
	}
	
	public function delete_designation()
	{
		$this->load->model('designation/designation_model');
		$id=$this->input->post('value1');
		$alert=$this->designation_model->delete_designation_inactive_check($id);
		$i=0;
		if($alert)
		{
		$i=1;
		
		}
		if($i==1)
		{
			echo "<script type='text/javascript'>alert('Designation Assign to some other place so can not In-Active ');</script>";
			
		$data["details"]=$this->designation_model->get_designation();
		$data["list"]=$this->designation_model->get_designation();
		$data["status"]=1;
		echo $this->load->view('view_list',$data);
		}
		else
		{
		$this->designation_model->delete_designation($id);
		 $data["details"]=$this->designation_model->get_designation();
		$data["list"]=$this->designation_model->get_designation();
		$data["status"]=0;
		echo $this->load->view('view_list',$data);
		}
	}
	public function delete_designation_inactive()
	{
		$this->load->model('designation/designation_model');
		$id=$this->input->post('value1');
		$alert=$this->designation_model->delete_designation_inactive_check($id);
		$i=0;
		if($alert)
		{
		$i=1;
		
		}
		if($i==1)
		{
			echo "<script type='text/javascript'>alert('Designation Assign to some other place so can not In-Active ');</script>";
			
		$data["details"]=$this->designation_model->get_designation();
		$data["list"]=$this->designation_model->get_designation();
		$data["status"]=1;
		echo $this->load->view('view_list',$data);
		}
		else
		{		
		$this->designation_model->delete_designation_inactive($id);
		$data["details"]=$this->designation_model->get_designation();
		$data["list"]=$this->designation_model->get_designation();
		$data["status"]=0;
		$data["df"]=1;
		echo $this->load->view('view_list',$data);

		}
	}
	
	public function checking_designation()
	{
		$this->load->model('designation/designation_model');
		$designation=$this->input->post('value1');
		$data=$this->designation_model->checking_designation($designation);
		$i=0;
		if($data)
		{
			$i=1;
		}
		if($i==1)
		{
			echo "Designation Name Already Exist";
		}
	}
	public function checking_Update()
	{
		$this->load->model('designation/designation_model');
		$designation=$this->input->post('value1');
		$id=$this->input->post('value2');
		
		$data=$this->designation_model->checking_Update($designation,$id);
		$i=0;
		if($data)
		{
			$i=1;
		}
		if($i==1)
		{
			echo "Designation Name Already Exist";
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
