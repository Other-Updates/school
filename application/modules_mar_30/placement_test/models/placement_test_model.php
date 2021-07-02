
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * History_model
 *
 * This model represents tasker history. It operates the following tables:
 * - history,
 *
 * @package	i2_soft
 * @author	Elavarasan
 */
 
class Placement_test_model extends CI_Model{

    private $table_name	= 'ur table name';
	private $table_name1= 'placement_ques';
	private $table_name2= 'placement_qus_dept';	
	private $table_name3= 'multi_choice_questions';
	private $table_name4= 'multi_choice_answers';
	private $table_name5= 'answer_choice';

	function __construct()
	{
		parent::__construct();

	}
	

	
	function get_ques_type_list() // this is for getting the master questions type
	{	
		$this->db->select('*');			
		$this->db->where('status','1'); 
		//$this->db->where('del_flg',0);
		//$this->db->where($this->table_name.'.del_flg',0);  			
		$query= $this->db->get('mas_ques_type')->result_array();	
		return $query;
		
	}
	function get_ques_list() // this is for getting the questions list
	{	
		$this->db->select('*');	
		$this->db->where($this->table_name1.'.del_flg','0');
		$query= $this->db->get('placement_ques')->result_array();
		return $query;		
	}
		
	function inse_ques_model($qus_inp)
	{
		
		$cur_date =  $this->user_auth->get_curdate();
		$cur_dt = date("Y-m-d", strtotime($cur_date));
		$cur_time = $this->user_auth->get_curdate_time();
		
		//echo "<pre>"; print_r($qus_inp); exit;
		
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
		if($qus_inp['q_type']==1)
		{
		if($upload_data['file_name']!='')
			$qus_inp['img_name']=$upload_data['file_name'];
		else
			$qus_inp['img_name']='no_image';
		
		$ins_data=array('batch_id'=>$qus_inp['batch_id'],'question_type'=>$qus_inp['q_type'],'question_s'=>$qus_inp['quest'],'ques_img_name'=>$qus_inp['img_name'],'answe_r'=>$qus_inp['answ'],'post_dt'=>$cur_time);
		$this->db->insert('placement_ques', $ins_data);	
		$plc_qus_id = $this->db->insert_id();	
		
		foreach($qus_inp['dept_id'] as $dep_id)
		{
			$ins_dat=array('plac_ques_id'=>$plc_qus_id,'depart_id'=>$dep_id,'post_dt'=>$cur_time);
			$this->db->insert('placement_qus_dept', $ins_dat);	
		}
		
		$in_arr = array($qus_inp['choice_1'],$qus_inp['choice_2'],$qus_inp['choice_3'],$qus_inp['choice_4']);
		for($i=0;$i<=3;$i++)
		{
			$ins_data_choice=array('plac_ques_id'=>$plc_qus_id,'choice'=>$in_arr[$i],'option_val'=>$i,'post_dt'=>$cur_time);
			$this->db->insert('answer_choice', $ins_data_choice);	
		}
		}
		else if($qus_inp['q_type']==2)
		{
			if($upload_data['file_name']!='')
			$qus_inp['img_name']=$upload_data['file_name'];
		else
			$qus_inp['img_name']='no_image';
		
		$ins_data=array('batch_id'=>$qus_inp['batch_id'],'question_type'=>$qus_inp['q_type'],'question_s'=>$qus_inp['quest'],'ques_img_name'=>$qus_inp['img_name'],'answe_r'=>$qus_inp['answer_puzzle'],'post_dt'=>$cur_time);
		$this->db->insert('placement_ques', $ins_data);	
		$plc_qus_id = $this->db->insert_id();	
		
		foreach($qus_inp['dept_id'] as $dep_id)
		{
			$ins_dat=array('plac_ques_id'=>$plc_qus_id,'depart_id'=>$dep_id,'post_dt'=>$cur_time);
			$this->db->insert('placement_qus_dept', $ins_dat);	
		}

		}
		else
		{
			if($upload_data['file_name']!='')
			$qus_inp['img_name']=$upload_data['file_name'];
		else
			$qus_inp['img_name']='no_image';
		
		$ins_data=array('batch_id'=>$qus_inp['batch_id'],'question_type'=>$qus_inp['q_type'],'question_s'=>$qus_inp['quest'],'ques_img_name'=>$qus_inp['img_name'],'post_dt'=>$cur_time);
		$this->db->insert('placement_ques', $ins_data);	
		$plc_qus_id = $this->db->insert_id();
		
		foreach($qus_inp['dept_id'] as $dep_id)
		{
			$ins_dat=array('plac_ques_id'=>$plc_qus_id,'depart_id'=>$dep_id,'post_dt'=>$cur_time);
			$this->db->insert('placement_qus_dept', $ins_dat);	
		}
		foreach($qus_inp['multi_ques'] as $key=>$val)
		{
		$ins_data_choice=array('place_quest_id'=>$plc_qus_id,'multi_question'=>$val,'multi_answers'=>$qus_inp['m_ans'][$key]);
		$this->db->insert('multi_choice_questions', $ins_data_choice);	
		$multi_ques_id = $this->db->insert_id();
			$j=0;
			foreach($qus_inp['m_choice'][$key] as $key1=>$val1)
			{
			$multi_data_choice=array('place_quest_id'=>$plc_qus_id,'multi_question_id'=>$multi_ques_id,'multi_options'=>$j,'multi_choice'=>$val1);
				$this->db->insert('multi_choice_answers', $multi_data_choice);
				$j++;
			}
		}
		
		}
		return true;
	
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
	
	function stud_name_by_rolno($stud_rono)
	{
		$this->db->select('*');		
		$whe_cn = array('std_id'=>$stud_rono['rol_no']);
		$no = $this->db->get_where('student',$whe_cn)->num_rows();
		if($no>0)
		{
			$atten_det = $this->db->get_where('student',$whe_cn)->result_array();
			return $atten_det[0]['name'];
		}
		else
		{
			return "fail";
		}	
		
	}
	
	function get_stud_result()
	{
		$this->db->select('*');		
		$this->db->where('del_flg','0');	
		$this->db->where('status','1');   			
		$query= $this->db->get('place_test_resul')->result_array();	
		return $query;
	}
	
	
	function update_ques_model($id)
		{
		
		$update_data=array('batch_id'=>$data['batch_id'],'question_s'=>$data['quest'],'ques_img_name'=>$data['img_name'],'answe_r'=>$data['answ']);
		$this->db->update('placement_ques', $update_data);	
		//$plc_qus_id = $this->db->update_id();	
		$this->db->where('id', $id);		
		// $this->db->last_query();
		
	
		
		foreach($qus_upd['dept_id'] as $dep_id)
		{
			$update_data=array('plac_ques_id'=>$plc_qus_id,'depart_id'=>$dep_id,'post_dt'=>$cur_time);
			$this->db->update('placement_qus_dept', $update_data);	
		}
		
		$up_arr = array($qus_upd['choice_1'],$qus_upd['choice_2'],$qus_upd['choice_3'],$qus_upd['choice_4']);
		for($i=0;$i<=3;$i++)
		{
			$up_data_choice=array('plac_ques_id'=>$plc_qus_id,'choice'=>$up_arr[$i],'option_val'=>$i,'post_dt'=>$cur_time);
			$this->db->update('answer_choice', $up_data_choice);	
		}
		
		
		if ($this->db->update($this->table_name1,$update_data))
		 {
			return true;
		}
		
		return false;
		}
	
	
	
	function delete_placement($id)
	{
		
		$this->db->where('id', $id);
			if ($this->db->update($this->table_name1,$data=array("del_flg"=>'1',)))
		
			{
				return true;
			}
			return false;
}
	function get_ques_list_by_id($p_id) // this is for getting the questions list
	{	
		$this->db->select('*');	
		$this->db->where($this->table_name1.'.del_flg','0');
		$this->db->where($this->table_name1.'.id',$p_id);
		$query= $this->db->get('placement_ques')->result_array();
		return $query;		
	}
	
	function delete_departments($p_id)
	{
		$this->db->where('plac_ques_id', $p_id);
		$this->db->delete($this->table_name2);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	function delete_sub_questions($p_id)
	{
		$this->db->where('place_quest_id', $p_id);
		$this->db->delete($this->table_name3);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	function delete_sub_question_choices($p_id)
	{
		$this->db->where('place_quest_id', $p_id);
		$this->db->delete($this->table_name4);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	function delete_options($p_id)
	{
		$this->db->where('plac_ques_id', $p_id);
		$this->db->delete($this->table_name5);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	function update_sub_question($data,$id)
	{
		
		$this->db->where('id', $id);
		
			if ($this->db->update($this->table_name1, $data)) 
			{
				
				return true;
			}
			return false;
	}
	function update_department($data)
	{
		if ($this->db->insert($this->table_name2, $data)) {
			$id = $this->db->insert_id();
			
			return array('id' => $id);
		}
		return false;
	}
	function update_questions_sub($data)
	{
		if ($this->db->insert($this->table_name3, $data)) {
			$id = $this->db->insert_id();
			
			return array('id' => $id);
		}
		return false;
	}
	function update_answer_choice($data)
	{
		$this->db->insert($this->table_name5, $data);
	}
}