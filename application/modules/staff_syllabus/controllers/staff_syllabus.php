<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_syllabus extends MX_Controller {

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
		 $this->load->database();
	}
	
	public function index()
	{
		$this->load->model('group/group_model');
		$this->load->model('student/student_model');
		$this->load->model('staff/staff_model');
		$this->load->model('notes/notes_model');
		$this->load->model('semester/semester_model');
		$this->load->model('subject/subject_model');
		$this->load->model('staff_syllabus_model');
		$user_det = $this->session->userdata('logged_in');
		if($user_det['staff_type']=='admin')
		{
			$data['all_batch'] =$this->student_model->get_all_batch();
			$data['all_depart']=$this->group_model->get_all_department();
			$data['all_semester']=$this->semester_model->get_semester();
			$data['sub_code']=$this->notes_model->get_sub_code();
			$data['all_syllabus'] =$this->staff_syllabus_model->get_sylla_all();
			 $data["status"]=1;
			//echo "<pre>";	print_r($data['all_syllabus']);exit;
		}
		
		else
		{
			$data['all_batch'] =$this->subject_model->get_all_batch1($this->user_auth->get_user_id());
		}
	 $this->template->write_view('content','staff_syllabus/index',$data);
	 $this->template->render();
	}
	
	public function insert_staff_syllabus()
	{
		    $this->load->model('staff_syllabus/staff_syllabus_model');
			$post_val=$this->input->post();
			$g_array=explode(",", $post_val['value4']);
			$k_array=explode(",", $post_val['value5']);
			$s_array=explode(",", $post_val['value6']);
			
			$i=0;
			foreach($g_array as $key=>$val)
			{
				if($val!='')
				{
					$input[$i]['unit_group']=$val;
					$input[$i]['topic_group']=$k_array[$key];
					$input[$i]['hour_group']=$s_array[$key];
					$input[$i]['batch_id_one']=$post_val['select_batch'];
					$input[$i]['group_id']=$post_val['group_id'];
					$input[$i]['select_se_id']=$post_val['select_sem'];
					$input[$i]['subject_id']=$post_val['subject_id'];
					$input[$i]['depart_id']=$post_val['depart_id'];
					$input[$i]['sub_code_id']=$post_val['sub_code_id'];
				}
				$i++;
				
		}
		 $this->staff_syllabus_model->insert_staff_sylla($input);
		 
		 $data['all_syllabus'] =$this->staff_syllabus_model->get_sylla_all();
		 $data["status"]=1;
			
		echo $this->load->view('staff_syllabus/view_list',$data);
		
	}
		public function search_sub_code()
	{
			$this->load->model('staff_syllabus/staff_syllabus_model');
			$id=$this->input->GET('value1');
			//print_r($id);
			$source=$this->staff_syllabus_model->search_sub($id);
				if(isset($source) && !empty($source))
				{
					foreach($source as $val)
					//print_r($val);exit;
					{    
		$g_select="<input type='text' readonly='readonly' name='sub_code_id' class='sub_code_id' id='sub_code_id' value='".$val["scode"]."' />";
					}
				}
				$g_select=$g_select.'</select>';
				echo "<td>".$g_select;
				}
	
	public function delete_syllabus()
	{
		$this->load->model('staff_syllabus/staff_syllabus_model');
		$id=$this->input->get('value1');
		
		$this->staff_syllabus_model->delete_sylla($id);
		print_r($data);exit;
		//$data['all_syllabus'] =$this->staff_syllabus_model->get_sylla_all();
		echo $this->load->view('staff_syllabus/view_list',$data);
		
	}
	public function get_all_subject()
	{
		$this->load->model('staff_syllabus/staff_syllabus_model');
		$data['ajax_val']=$this->input->post();
		
		$data['all_subject'] =$this->staff_syllabus_model->get_subject_by_id($data['ajax_val']['select_batch'],$data['ajax_val']['depart_id'],$data['ajax_val']['group_id'],$data['ajax_val']['select_sem']);
		print_r($data);exit;
		$g_select='<select id="subject_id" ><option value="0">Select</option>';
		
		if(isset($data['all_subject']) && !empty($data['all_subject']))
		{
			foreach($data['all_subject'] as $val)
			{
				$g_select=$g_select."<option value='".$val['id']."'>".$val['subject_name']."</option>";
			}
		}
		$g_select=$g_select.'</select>';
		echo $g_select;
	}
	
	
		
		function staff_syllabus_view($subject_id)
	{
		$this->load->model('staff_syllabus/staff_syllabus_model');
		$data['all_syllabus_one'] =$this->staff_syllabus_model->get_sylla_all_view($subject_id);
		//print_r($data);
				
		if(isset($data['all_syllabus_one']) && !empty($data['all_syllabus_one']))
		{
		$this->template->write_view('content', 'staff_syllabus/staff_syllabus_view',$data);
        $this->template->render();
		}
		else
		{
		redirect($this->config->item('base_url').'staff_syllabus/staff_syllabus_view');	
		}
	}
	function staff_syllabus_update($subject_id)
	{
		//print_r($subject_id);exit;
		$this->load->model('staff_syllabus/staff_syllabus_model');
			$post_val=$this->input->get();
			$g_array=explode(",", $post_val['value4']);
			$k_array=explode(",", $post_val['value5']);
			$s_array=explode(",", $post_val['value6']);
			
			$i=0;
			foreach($g_array as $key=>$val)
			{
				if($val!='')
				{
					$input[$i]['unit_group']=$val;
					$input[$i]['topic_group']=$k_array[$key];
					$input[$i]['hour_group']=$s_array[$key];
					$input[$i]['batch_id_one']=$post_val['select_batch'];
					$input[$i]['group_id']=$post_val['group_id'];
					$input[$i]['select_se_id']=$post_val['select_sem'];
					$input[$i]['subject_id']=$post_val['subject_id'];
					$input[$i]['depart_id']=$post_val['depart_id'];
					$input[$i]['sub_code_id']=$post_val['sub_code_id'];
				}
				$i++;
				
		}
		 $this->staff_syllabus_model->get_sylla_all_update($subject_id);
		  $data['all_syllabus'] =$this->staff_syllabus_model->get_sylla_all();
		 $data['all_syllabus_one'] =$this->staff_syllabus_model->get_sylla_all_view($subject_id);
		$data['all_syllabus_update'] =$this->staff_syllabus_model->get_sylla_all_update($subject_id);
		//echo "<pre>";print_r($data);exit;
		if(isset($data['all_syllabus_update']) && !empty($data['all_syllabus_update']))
		{
		$this->template->write_view('content', 'staff_syllabus/staff_syllabus_update',$data);
        $this->template->render();
		}
		else
		{
		redirect($this->config->item('base_url').'staff_syllabus');	
		}
		
	}
		
	
	
	
	}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */