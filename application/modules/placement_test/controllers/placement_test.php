<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Placement_test extends MX_Controller {

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
		$this->load->model('master/master_model');
		$user_det = $this->session->userdata('logged_in');
		$permission=$this->master_model->get_staff_by_id($user_det['user_id'],$user_det['staff_type']);
		if($permission[0]['attendance']==0)
		redirect($this->config->item('base_url').'admin/index');		
	}
	
	public function index()
	{
		$this->load->model('group/group_model');
		$this->load->model('student/student_model');
		$this->load->model('semester/semester_model');
		$this->load->model('placement_test_model');
		$data['all_batch'] = $this->student_model->get_all_batch();
		$data['qus_type']=$this->placement_test_model->get_ques_type_list();
		$data['qus_list']=$this->placement_test_model->get_ques_list();
		$data['all_depart'] = $this->group_model->get_all_department();
		/*echo "<pre>";
		print_r($data['qus_type']);
		exit;*/
		$this->template->write_view('content','placement_test/index',$data);
        $this->template->render();	
	}
	public function placement_test_questions()
	{
		$this->load->model('group/group_model');
		$this->load->model('student/student_model');
		$this->load->model('semester/semester_model');
		$this->load->model('placement_test_model');
		$data['all_batch'] = $this->student_model->get_all_batch();
		$data['qus_type']=$this->placement_test_model->get_ques_type_list();
		$data['qus_list']=$this->placement_test_model->get_ques_list();
		$data['all_depart'] = $this->group_model->get_all_department();
		$data['test_data']=$this->session->userdata("for_placement");
		
		$data['test_dep']=$this->session->userdata("for_placement_dept");
		//echo "<pre>"; print_r($data['test_data']); exit;
		$this->template->write_view('content','placement_test/placement_test_questions',$data);
        $this->template->render();	
	}
	public function inse_ques()
	{
		$ques_inputs = $this->input->post();
		//echo "<pre>"; print_r($ques_inputs); exit;
		$this->load->model('placement_test_model');		
		$data = $this->placement_test_model->inse_ques_model($ques_inputs);		
		$data_to_be_used=array('batch'=>$ques_inputs['batch_id'],'q_type'=>$ques_inputs['q_type']);
		$this->session->set_userdata('for_placement',$data_to_be_used);
		// session department
		foreach($ques_inputs['dept_id'] as $dep_id)
		{
			$dep[]=array('depart_id'=>$dep_id);	
			
		}
		//echo "<pre>"; print_r($dep); exit;
		$this->session->set_userdata('for_placement_dept',$dep);
		redirect($this->config->item('base_url').'placement_test/placement_test_questions');
	}
	public function get_stud_result()
	{
		$this->load->model('placement_test_model');		
		$data['stud_res'] = $this->placement_test_model->get_stud_result();		
		$this->template->write_view('content','placement_test/place_test_result',$data);
        $this->template->render();	
	}
	public function stud_name_by_rolno()
	{
		$this->load->model('attendance_od_ml_model');
		$std_rono = $this->input->POST();
		$reslt = $this->attendance_od_ml_model->stud_name_by_rolno($std_rono);
		echo $reslt;	
	}		
	
	public function update_options()
	{
		
		$this->load->model('placement_test_model');
		$cur_date =  $this->user_auth->get_curdate();
		$cur_dt = date("Y-m-d", strtotime($cur_date));
		$cur_time = $this->user_auth->get_curdate_time();
		$option_data=$this->input->post();
		$upload_data['file_name']='';
		if(isset($_FILES) && !empty($_FILES))
		{
			//file upload configuration starts here
				
			$config['upload_path'] = './quest_img';			
			$config['allowed_types'] = '*';			
			$config['max_size']	= '2000';			
			$this->load->library('upload', $config);
			//file upload configuration endS here
						
			$upload_files = $_FILES;
			if($upload_files['ques_img']['name']!='')
			{
				$_FILES['ques_img'] = array(
				'name' => $upload_files['ques_img']['name'],
				'type' => $upload_files['ques_img']['type'],
				'tmp_name' => $upload_files['ques_img']['tmp_name'],
				'error' => $upload_files['ques_img']['error'],
				'size' => 10
				);	
						
				$str_ext1 = substr($_FILES['ques_img']['name'], strrpos($_FILES['ques_img']['name'], '.') + 1);
				$fext1 = strtolower($str_ext1);
												
				$this->upload->do_upload("ques_img");
				$upload_data = $this->upload->data();
				$dest= getcwd()."/quest_img/thumb/".$upload_data['file_name'];
				$src=$this->config->item("base_url").'quest_img/'.$upload_data['file_name'];
						
   				$this->make_thumb($src,$dest,50);
			}
		}
			$this->placement_test_model->delete_departments($option_data['question_id']);
			$this->placement_test_model->delete_options($option_data['question_id']);
			if($upload_data['file_name']!='')
			{
			$option_data['img_name']=$upload_data['file_name'];
			$upd_data=array('batch_id'=>$option_data['batch_id'],'question_s'=>$option_data['quest'],'ques_img_name'=>$option_data['img_name'],'answe_r'=>$option_data['answ'],'post_dt'=>$cur_time);
			}
			else
			{
			$upd_data=array('batch_id'=>$option_data['batch_id'],'question_s'=>$option_data['quest'],'answe_r'=>$option_data['answ'],'post_dt'=>$cur_time);
			}
			$this->placement_test_model->update_sub_question($upd_data,$option_data['question_id']);
		foreach($option_data['dept_ido'] as $dep_id)
			{
			$update_dep=array('plac_ques_id'=>$option_data['question_id'],'depart_id'=>$dep_id,'post_dt'=>$cur_time);
			$this->placement_test_model->update_department($update_dep);	
			}
			
			foreach($option_data['choices'] as $key=>$val)
			{
				$up_data_choice=array('plac_ques_id'=>$option_data['question_id'],'choice'=>$val,'option_val'=>$key,'post_dt'=>$cur_time);
				$this->placement_test_model->update_answer_choice($up_data_choice);	
			}
		redirect($this->config->item('base_url').'placement_test/placement_test_questions');
			
	}
		
	function delete_options()
	{
		$this->load->model('placement_test/placement_test_model');	
		$id=$this->input->post('value1');//echo "<pre>";print_r($id);exit;
		$this->placement_test_model->delete_placement($id);//echo "<pre>";print_r($id);exit;
		$data['qus_list']=$this->placement_test_model->get_ques_list();
		//echo $this->load->view('placement_test_result',$data);
		echo "Deleted Successfully";
	}
	function delete_puzzle_question()
	{
		$this->load->model('placement_test/placement_test_model');	
		$id=$this->input->post('id');//echo "<pre>";print_r($id);exit;
		$this->placement_test_model->delete_placement($id);//echo "<pre>";print_r($id);exit;
		$data['qus_list']=$this->placement_test_model->get_ques_list();
		//echo $this->load->view('placement_test_result',$data);
		echo "Deleted Successfully";
	}
	function delete_sub_question()
	{
		$this->load->model('placement_test/placement_test_model');	
		$id=$this->input->post('id');//echo "<pre>";print_r($id);exit;
		$this->placement_test_model->delete_placement($id);//echo "<pre>";print_r($id);exit;
		$data['qus_list']=$this->placement_test_model->get_ques_list();
		//echo $this->load->view('placement_test_result',$data);
		echo "Deleted Successfully";
	}
	public function update_sub_questions($p_id)
	{
		$this->load->model('group/group_model');
		$this->load->model('student/student_model');
		$this->load->model('semester/semester_model');
		$this->load->model('placement_test_model');
		$data['all_batch'] = $this->student_model->get_all_batch();
		$data['qus_type']=$this->placement_test_model->get_ques_type_list();
		$data['qus_list']=$this->placement_test_model->get_ques_list_by_id($p_id);
		$data['all_depart'] = $this->group_model->get_all_department();
		if($this->input->post())
		{
			$sub_ques=$this->input->post();
			$upload_data['file_name']='';
		if(isset($_FILES) && !empty($_FILES))
		{
			//file upload configuration starts here
				
			$config['upload_path'] = './quest_img';			
			$config['allowed_types'] = '*';			
			$config['max_size']	= '2000';			
			$this->load->library('upload', $config);
			//file upload configuration endS here
						
			$upload_files = $_FILES;
			if($upload_files['ques_img']['name']!='')
			{
				$_FILES['ques_img'] = array(
				'name' => $upload_files['ques_img']['name'],
				'type' => $upload_files['ques_img']['type'],
				'tmp_name' => $upload_files['ques_img']['tmp_name'],
				'error' => $upload_files['ques_img']['error'],
				'size' => 10
				);	
						
				$str_ext1 = substr($_FILES['ques_img']['name'], strrpos($_FILES['ques_img']['name'], '.') + 1);
				$fext1 = strtolower($str_ext1);
												
				$this->upload->do_upload("ques_img");
				$upload_data = $this->upload->data();
				$dest= getcwd()."/quest_img/thumb/".$upload_data['file_name'];
				$src=$this->config->item("base_url").'quest_img/'.$upload_data['file_name'];
						
   				$this->make_thumb($src,$dest,50);
			}
		}
			$this->placement_test_model->delete_departments($p_id);
			$this->placement_test_model->delete_sub_questions($p_id);
			$this->placement_test_model->delete_sub_question_choices($p_id);
		$cur_date =  $this->user_auth->get_curdate();
		$cur_dt = date("Y-m-d", strtotime($cur_date));
		$cur_time = $this->user_auth->get_curdate_time();
		if($upload_data['file_name']!='')
		{
			$sub_ques['img_name']=$upload_data['file_name'];
			$upd_data=array('batch_id'=>$sub_ques['batch_id'],'question_s'=>$sub_ques['quest'],'ques_img_name'=>$sub_ques['img_name'],'post_dt'=>$cur_time);
		}
		else
		{
			$upd_data=array('batch_id'=>$sub_ques['batch_id'],'question_s'=>$sub_ques['quest'],'post_dt'=>$cur_time);
		}
		
		$upd_data=array('batch_id'=>$sub_ques['batch_id'],'question_s'=>$sub_ques['quest'],'ques_img_name'=>$sub_ques['img_name'],'post_dt'=>$cur_time);
			$this->placement_test_model->update_sub_question($upd_data,$sub_ques['question_id']);
			// update dep
			foreach($sub_ques['dept_id'] as $dep_id)
			{
			$update_dep=array('plac_ques_id'=>$sub_ques['question_id'],'depart_id'=>$dep_id,'post_dt'=>$cur_time);
			$this->placement_test_model->update_department($update_dep);	
			}
			foreach($sub_ques['multi_ques'] as $key=>$val)
			{
			$update_data_choice=array('place_quest_id'=>$sub_ques['question_id'],'multi_question'=>$val,'multi_answers'=>$sub_ques['m_ans'][$key]);
			$this->placement_test_model->update_questions_sub($update_data_choice);	
			$multi_ques_id = $this->db->insert_id();
			$j=0;
			foreach($sub_ques['m_choice'][$key] as $key1=>$val1)
			{
			$multi_data_choice=array('place_quest_id'=>$sub_ques['question_id'],'multi_question_id'=>$multi_ques_id,'multi_options'=>$j,'multi_choice'=>$val1);
				$this->db->insert('multi_choice_answers', $multi_data_choice);
				$j++;
			}
		}
			redirect($this->config->item('base_url').'placement_test/placement_test_questions');
		}
		
		$this->template->write_view('content','placement_test/update_sub_questions',$data);
        $this->template->render();
	}
	function update_puzzle()
	{
		$this->load->model('placement_test_model');
		$update_data=$this->input->post();
		$upload_data['file_name']='';
		if(isset($_FILES) && !empty($_FILES))
		{
			//file upload configuration starts here
				
			$config['upload_path'] = './quest_img';			
			$config['allowed_types'] = '*';			
			$config['max_size']	= '2000';			
			$this->load->library('upload', $config);
			//file upload configuration endS here
						
			$upload_files = $_FILES;
			if($upload_files['ques_img']['name']!='')
			{
				$_FILES['ques_img'] = array(
				'name' => $upload_files['ques_img']['name'],
				'type' => $upload_files['ques_img']['type'],
				'tmp_name' => $upload_files['ques_img']['tmp_name'],
				'error' => $upload_files['ques_img']['error'],
				'size' => 10
				);	
						
				$str_ext1 = substr($_FILES['ques_img']['name'], strrpos($_FILES['ques_img']['name'], '.') + 1);
				$fext1 = strtolower($str_ext1);
												
				$this->upload->do_upload("ques_img");
				$upload_data = $this->upload->data();
				$dest= getcwd()."/quest_img/thumb/".$upload_data['file_name'];
				$src=$this->config->item("base_url").'quest_img/'.$upload_data['file_name'];
						
   				$this->make_thumb($src,$dest,50);
			}
		}
		$this->placement_test_model->delete_departments($update_data['question_id']);
		$cur_date =  $this->user_auth->get_curdate();
		$cur_dt = date("Y-m-d", strtotime($cur_date));
		$cur_time = $this->user_auth->get_curdate_time();
		if($upload_data['file_name']!='')
		{
			$update_data['img_name']=$upload_data['file_name'];
			$upd_data=array('batch_id'=>$update_data['batch_id'],'question_s'=>$update_data['quest'],'ques_img_name'=>$update_data['img_name'],'answe_r'=>$update_data['updatep_answer'],'post_dt'=>$cur_time);
		}
		else
		{
			$upd_data=array('batch_id'=>$update_data['batch_id'],'question_s'=>$update_data['quest'],'answe_r'=>$update_data['updatep_answer'],'post_dt'=>$cur_time);
		}
		
		
			$this->placement_test_model->update_sub_question($upd_data,$update_data['question_id']);
		foreach($update_data['dept_id'] as $dep_id)
			{
			$update_dep=array('plac_ques_id'=>$update_data['question_id'],'depart_id'=>$dep_id,'post_dt'=>$cur_time);
			$this->placement_test_model->update_department($update_dep);	
			}
		redirect($this->config->item('base_url').'placement_test/placement_test_questions');
	}
	function make_thumb($src, $dest, $desired_width) 
	{

		/* read the source image */
		
		
		$source_image = $this->imageCreateFromAny($src);//imagecreatefromjpeg($src);
		$width = imagesx($source_image);
		$height = imagesy($source_image);
		
		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height * ($desired_width / $width));
		
		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
		
		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
		
		/* create the physical thumbnail image to its destination */
		imagejpeg($virtual_image, $dest,100);
	}
	
	function imageCreateFromAny($filepath) { 
		$type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize() 
		$allowedTypes = array( 
			1,  // [] gif 
			2,  // [] jpg 
			3,  // [] png 
			6   // [] bmp 
		); 
		if (!in_array($type, $allowedTypes)) { 
			return false; 
		} 
		switch ($type) { 
			case 1 : 
				$im = imageCreateFromGif($filepath); 
			break; 
			case 2 : 
				$im = imageCreateFromJpeg($filepath); 
			break; 
			case 3 : 
				$im = imageCreateFromPng($filepath); 
			break; 
			case 6 : 
				$im = imageCreateFromBmp($filepath); 
			break; 
		}    
		return $im;  
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
