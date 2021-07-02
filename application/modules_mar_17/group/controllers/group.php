<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {

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
		$this->load->model('group_model');
		$data['g_list']=$this->group_model->get_all_group();
		
		$data['all_depart']=$this->group_model->get_all_department();
		 $data["status"]=1;
		$this->template->write_view('content', 'group/index',$data);
        $this->template->render();
	}
	function insert_group()
	{
		$this->load->model('group_model');
		$data["status"]=1;
		$post_val=$this->input->post();
		$g_array=explode(",", $post_val['group']);
		 $data["status"]=1;
		foreach($g_array as $val)
		{
			if($val!='')
			{
				$insert=array('depart_id'=>$post_val['depart_id'],'group'=>$val);
				$this->group_model->insert_group($insert);
			}
		}
		$data['all_depart']=$this->group_model->get_all_department();
		$data['g_list']=$this->group_model->get_all_group();
		echo $this->load->view('group/list_view',$data);
		
		
		
	}
	function update_group()
	{
		$this->load->model('group_model');
		
		$postval=$this->input->post();
		$alert=$this->group_model->delete_group_inactive_check($postval);
		
		$i=0;
		if($alert)
		{
		$i=1;
		}
		if($i==1)
		{
			echo "<script language='javascript'> alert('Group is assigned to someother fields'); </script>";
			$data['all_depart']=$this->group_model->get_all_department();
			$data['g_list']=$this->group_model->get_all_group();
			$data["status"]=1;
			echo $this->load->view('group/list_view',$data);
		}
		else
		{
		
		$data['all_depart']=$this->group_model->get_all_department();
		$update_data=array('depart_id'=>$postval['udepart_id'],'group'=>$postval['update_group'],'status'=>$postval['update_status']);
		$this->group_model->update_group($postval['update_id'],$update_data);
		$data['g_list']=$this->group_model->get_all_group();
		 $data["status"]=$postval['update_status'];
		echo $this->load->view('group/list_view',$data);
		}
	}
	function update_status_group()
	{
		$this->load->model('group_model');
		$postval=$this->input->post('update_id');
		$alert=$this->group_model->delete_group_inactive_check($postval);
		
		$i=0;
		if($alert)
		{
		$i=1;
		}
		if($i==1)
		{
			echo "<script language='javascript'> alert('Group is assigned to someother fields'); </script>";
			$data['all_depart']=$this->group_model->get_all_department();
			$data['g_list']=$this->group_model->get_all_group();
			$data["status"]=1;
			echo $this->load->view('group/list_view',$data);
		}
		else
		{
		$update_data=array('status'=>0);
		$this->group_model->update_group($postval['update_id'],$update_data);
		$data['all_depart']=$this->group_model->get_all_department();
		$data['g_list']=$this->group_model->get_all_group();
		$data["status"]=0;
		echo $this->load->view('group/list_view',$data);	
	}
	}
	 function delete_group_inactive()
	{
		$this->load->model('group_model');
		$postval=$this->input->post('value1');
		$alert=$this->group_model->delete_group_inactive_check($postval);
		
		$i=0;
		if($alert)
		{
		$i=1;
		}
		if($i==1)
		{
			echo "<script language='javascript'> alert('Group is assigned to someother fields'); </script>";
			$data['all_depart']=$this->group_model->get_all_department();
			$data['g_list']=$this->group_model->get_all_group();
			$data["status"]=1;
			echo $this->load->view('group/list_view',$data);
		}
		else
		{
			$this->group_model->delete_group_inactive($postval);
			$data['all_depart']=$this->group_model->get_all_department();
			$data['g_list']=$this->group_model->get_all_group();
			$data["status"]=0;
			echo $this->load->view('group/list_view',$data);
		}
		
		
		
	}
	 function group_validate()
	{
		$this->load->model('group_model');
		$depar=$this->input->post('val2');
		$group=$this->input->post('val1');
		$validation=$this->group_model->validate_group($depar,$group);
		$i=0; if($validation){$i=1;}if($i==1){echo "Section already Exist";}
		
	}
	function group_validate_update()
	{
		$this->load->model('group_model');
		$id=$this->input->post('id');
		$depart_id=$this->input->post('dep_id');
		$group=$this->input->post('group');
		$validation=$this->group_model->validate_group_update($id,$depart_id,$group);
		$i=0; if($validation){$i=1;}if($i==1){echo "Section already Exist";}
		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
