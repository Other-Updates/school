<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MX_Controller {

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
		$this->load->model('group/group_model');
		$this->load->model('admin/admin_model');
		$data['all_depart']=$this->group_model->get_all_department();
		$data['all_admin']=$this->admin_model->get_all_admin_for_master();
		$this->template->write_view('content', 'master/index',$data);
        $this->template->render();	
	}
	public function get_all_staff()
	{
		$this->load->model('staff/staff_model');
		$d_id=$this->input->POST();		
		$g_array=$this->staff_model->get_all_staff_by_depart_id($d_id['depart_id']);
		$g_select='<select id="staff_id" name="master[staff_id]" ><option value="0">Select</option>';
		if(isset($g_array) && !empty($g_array))
		{
			foreach($g_array as $val)
			{
				$g_select=$g_select."<option value='".$val['id']."'>".$val['staff_name']."</option>";
			}
		}
		$g_select=$g_select.'</select>';
		echo $g_select;
	}
	public function add_staff_master()
	{
		$this->load->model('master/master_model');
		$list=$this->input->post('staff_info');	
		$insert_array=array('staff_id'=>$list[1],'staff_type'=>1,'add_student'=>$list[2],'event'=>$list[3],'time_table'=>$list[4],'internal_mark'=>$list[5],'assignment'=>$list[6],'attendance'=>$list[7],'sharing_note'=>$list[8],'fee_details'=>$list[9],'library'=>$list[10],'transport'=>$list[11],'chat'=>$list[12],'subject'=>$list[13]);
		$this->master_model->delete_staff_master($list[1]);
		$this->master_model->insert_master($insert_array);
	}
	public function add_admin_master()
	{
		$this->load->model('master/master_model');
		$list=$this->input->POST('admin_info');
		echo "<pre>";
		print_r($list);	
		$insert_array=array('staff_id'=>$list[1],'staff_type'=>2,'add_student'=>$list[2],'event'=>$list[3],'time_table'=>$list[4],'internal_mark'=>$list[5],'assignment'=>$list[6],'attendance'=>$list[7],'sharing_note'=>$list[8],'fee_details'=>$list[9],'library'=>$list[10],'transport'=>$list[11],'chat'=>$list[12],'subject'=>$list[13]);
		$this->master_model->delete_admin_master($list[1]);
		$this->master_model->insert_master($insert_array);
	}
	public function get_staff_master()
	{
		$this->load->model('master/master_model');
		$staff_id=$this->input->POST('staff_id');
		$data['staff_info']=$this->master_model->get_staff_by_id($staff_id,1);
		echo $this->load->view('master/staff_table',$data);
		
	}
	public function get_admin_master()
	{
		$this->load->model('master/master_model');
		$staff_id=$this->input->POST('staff_id');
		$data['staff_info']=$this->master_model->get_staff_by_id($staff_id,2);
		echo $this->load->view('master/admin_table',$data);
		
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
