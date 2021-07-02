<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Department extends MX_Controller {

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
		   $this->load->model('department/department_model');
		   $data["details"]=$this->department_model->get_department();
		   $data["status"]=1;
		   $this->template->write_view('content','department/index',$data);
		   $this->template->render();
	}
	
	
	 public function insert_department()
	   {
			$this->load->model('department/department_model');
			$input=array('department'=>$this->input->post('value1'),'nickname'=>$this->input->post('value2'));
			$this->department_model->insert_department($input);
			 $data["details"]=$this->department_model->get_department(); // echo "<pre>";print_r($data);exit;
			$data["list"]=$this->department_model->get_department();
			$data["status"]=1;    
			echo $this->load->view('view_list',$data); 
	   }
	
public function update_department()
	{
		
			$this->load->model('department/department_model');
			$id=$this->input->post('value1');
			$alert=$this->department_model->delete_department_inactive_check($id);
		$i=0;
		if($alert)
		{
		$i=1;
		
		}
		if($i==1)
		{
			echo "<script type='text/javascript'>alert('Department Assign to some other place so can not be Update ');</script>";

			
		$data["details"]=$this->department_model->get_department();
		$data["list"]=$this->department_model->get_department();
		$data["status"]=1;
		echo $this->load->view('view_list',$data);
		}
		else
		{
			$input=array('department'=>$this->input->post('value2'),'status'=>$this->input->post('value3'),'nickname'=>$this->input->post('value4'));
			$this->department_model->update_department($input,$id);
			 $data["details"]=$this->department_model->get_department();
			$data["list"]=$this->department_model->get_department();
			$data["status"]=$this->input->post('value3');
		    echo $this->load->view('view_list',$data);	
	}
	}
	
	public function delete_department()
	{
		$this->load->model('department/department_model');
		$id=$this->input->post('value1');
		$alert=$this->department_model->delete_department_inactive_check($id);
		$i=0;
		if($alert)
		{
		$i=1;
		
		}
		if($i==1)
		{
			echo "<script type='text/javascript'>alert('Department Assign to some other place so can not In-Active ');</script>";

			
		$data["details"]=$this->department_model->get_department();
		$data["list"]=$this->department_model->get_department();
		$data["status"]=1;
		echo $this->load->view('view_list',$data);
		}
		else
		{
		$this->department_model->delete_department($id);
		 $data["details"]=$this->department_model->get_department();
		$data["list"]=$this->department_model->get_department();
		$data["status"]=0;
		echo $this->load->view('view_list',$data);
		}
	}
	public function delete_department_inactive()
	{
		$this->load->model('department/department_model');
		$id=$this->input->post('value1');
		$alert=$this->department_model->delete_department_inactive_check($id);
		$i=0;
		if($alert)
		{
		$i=1;
		
		}
		if($i==1)
		{
			echo "<script type='text/javascript'>alert('Department Assign to some other place so can not In-Active ');</script>";

			
		$data["details"]=$this->department_model->get_department();
		$data["list"]=$this->department_model->get_department();
		$data["status"]=1;
		echo $this->load->view('view_list',$data);
		}
		else
		{
		$this->department_model->delete_department_inactive($id);
		$data["details"]=$this->department_model->get_department();
		$data["list"]=$this->department_model->get_department();
		$data["status"]=0;
		$data["df"]=1;
		echo $this->load->view('view_list',$data);
		}
	}
	
	public function checking_department()
	{
		$this->load->model('department/department_model');
		$department=$this->input->post('value1');
		$data=$this->department_model->checking_department($department);
		$i=0;
		if($data)
		{
			$i=1;
		}
		if($i==1)
		{
			echo "Department Name Already Exist";
		}
	}
	public function checking_nickname()
	{
		$this->load->model('department/department_model');
		$nick_name=$this->input->post('nick_name');
		$data=$this->department_model->checking_nickname($nick_name);
		$i=0;
		if($data)
		{
			$i=1;
		}
		if($i==1)
		{
			echo "Nick Name Already Exist";
		}
	}
	public function checking_nickname_update()
	{
		$this->load->model('department/department_model');
		$nick_name=$this->input->post('nick_name');
		$id=$this->input->post('id');
		$data=$this->department_model->checking_nickname_update($nick_name,$id);
		$i=0;
		if($data)
		{
			$i=1;
		}
		if($i==1)
		{
			echo "Nick Name Already Exist";
		}
	}
	public function checking_Update()
	{
		$this->load->model('department/department_model');
		$department=$this->input->post('value1');
		$id=$this->input->post('value2');
		$data=$this->department_model->checking_Update($department,$id);
		$i=0;
		if($data)
		{
			$i=1;
		}
		if($i==1)
		{
			echo "Department Name Already Exist";
		}
	}
	
	
	}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
