
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_tickets extends MX_Controller {

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
	}
		public function index()
		{
		  $user_det = $this->session->userdata('logged_in');
		  if($user_det['staff_type']=='staff')
		  {
		   $this->load->model('staff_tickets/staff_tickets_model');
		   $data["desg"]=$this->staff_tickets_model->get_all_department($user_det['department_id']);
		   /*echo "<pre>";
		   print_r($data["desg"]);
		   exit;*/
		   $data["adm"]=$this->staff_tickets_model->get_all_admin();
		   $data["list"]=$this->staff_tickets_model->get_staff_tickets($user_det['email']);
		   $data["status"]=1;
		   $this->template->write_view('content','staff_tickets/index',$data);
		   $this->template->render();
        }
      else
      {
        redirect($this->config->item('base_url').'staff_tickets/admin_view');
      }
		}
		
		public function staff_profile()
			{
				$user_det = $this->session->userdata('logged_in');
				$id=$user_det['user_id'];
				$this->load->model('staff_tickets/staff_tickets_model');
				$data["staff_details"]=$this->staff_tickets_model->get_staff_details($id);
				$this->template->write_view('content', 'staff_tickets/staff_profile',$data);
				$this->template->render();
			}
			public function staff_password_change()
			{
				$this->load->model('staff_tickets/staff_tickets_model');
				$user_det = $this->session->userdata('logged_in');
				$id=$user_det['user_id'];
				$new_password=md5($this->input->post('new_password'));
				$input=array('pwd'=>$new_password);
				
				$this->staff_tickets_model->staff_password_change($input,$id);
			}
			public function staff_profile_update()
			{
				$this->load->model('staff_tickets/staff_tickets_model');
				if($this->input->post())
				{
					$user_det = $this->session->userdata('logged_in');
					$id=$user_det['user_id'];
					
					$this->load->helper('text');
					
					$config['upload_path'] = './profile_image/staff/orginal';
					
					$config['allowed_types'] = '*';
					
					$config['max_size']	= '2000';
					
					$this->load->library('upload', $config);
					
					
					if(isset($_FILES) && !empty($_FILES))
					{
						$upload_data['file_name']='';
						$upload_files = $_FILES;
						
						if($upload_files['staff_image']['name']!='')
						{
							$_FILES['staff_image'] = array(
							'name' => $upload_files['staff_image']['name'],
							'type' => $upload_files['staff_image']['type'],
							'tmp_name' => $upload_files['staff_image']['tmp_name'],
							'error' => $upload_files['staff_image']['error'],
							'size' => '2000'
							);	
							
						$this->upload->do_upload('staff_image');
						
						$upload_data = $this->upload->data();
	
						$dest= getcwd()."/profile_image/staff/thumb/" .$upload_data['file_name'];
					
						
					
						$src=$this->config->item("base_url").'profile_image/staff/orginal/'.$upload_data['file_name'];
						
						$this->make_thumb($src,$dest,50);
						}
					}
				
					if($upload_data['file_name']=='')
					{
						
					 $input=array('mobile_no'=>$this->input->post('phone'));
					$input1=array('address'=>$this->input->post('address'));
					
					$this->staff_tickets_model->update_staff_profile($input,$id);
					$this->staff_tickets_model->update_staff_address($input1,$id);
					redirect($this->config->item('base_url').'staff_tickets/staff_profile');
					}
					
					else
					{
					
					$input=array('mobile_no'=>$this->input->post('phone'),'image'=>$upload_data['file_name']);
				   
					$input1=array('address'=>$this->input->post('address'));
					$this->staff_tickets_model->update_staff_profile($input,$id);
					$this->staff_tickets_model->update_staff_address($input1,$id);
					redirect($this->config->item('base_url').'staff_tickets/staff_profile');
					
					}
				
				}
				//redirect($this->config->item('base_url').'staff_tickets/staff_profile');
			}
		//INSERT
		 public function insert_staff_tickets()
		   {
				 $this->load->model('staff_tickets/staff_tickets_model');
				 $user_det = $this->session->userdata('logged_in');
				
				 $input=array('name1'=>$this->input->post('value1'),'email'=>$this->input->post('value2'),'subject'=>$this->input->post('value3'),'priority'=>$this->input->post('value4'),'department'=>$user_det['department_id'],'description'=>$this->input->post('value6'),'admin_id'=>$this->input->post('value7'),'staff_id'=>$this->input->post('value8')); 
				$this->staff_tickets_model->insert_staff_tickets($input);
				$data["desg"]=$this->staff_tickets_model->get_all_department($user_det['department_id']);
				$data["adm"]=$this->staff_tickets_model->get_all_admin();
				$data["list"]=$this->staff_tickets_model->get_staff_tickets($user_det['email']);
			
				$data["status"]=1;  
				echo $this->load->view('view_list',$data); 
		   }
		   //UPDATE
	
	public function update_staff_tickets()
		{
		    $user_det = $this->session->userdata('logged_in');
			$this->load->model('staff_tickets/staff_tickets_model');
			$data["desg"]=$this->staff_tickets_model->get_all_department();
		    $data["adm"]=$this->staff_tickets_model->get_all_admin();
			$id=$this->input->post('value1');
			if($this->input->post('value8')==0)
			$input=array('name1'=>$this->input->post('value2'),'email'=>$this->input->post('value3'),'subject'=>$this->input->post('value4'),'priority'=>$this->input->post('value5'),'department'=>$user_det['department_id'],'description'=>$this->input->post('value7'),'admin_id'=>$this->input->post('value9'),'status'=>$this->input->post('value8'),'read'=>2);
			else
			$input=array('name1'=>$this->input->post('value2'),'email'=>$this->input->post('value3'),'subject'=>$this->input->post('value4'),'priority'=>$this->input->post('value5'),'department'=>$user_det['department_id'],'description'=>$this->input->post('value7'),'admin_id'=>$this->input->post('value9'),'status'=>$this->input->post('value8'));
			$data["status"]=$this->input->post('value8');
			$this->staff_tickets_model->update_staff_tickets($input,$id);
			$data["list"]=$this->staff_tickets_model->get_staff_tickets($user_det['email']);
		
		    echo $this->load->view('view_list',$data);	
	}
		//DELETE
	public function delete_staff_tickets()
	{
		$user_det = $this->session->userdata('logged_in');
		$this->load->model('staff_tickets/staff_tickets_model');
		$id=$this->input->post('value1');
		$this->staff_tickets_model->delete_staff_tickets($id);
		$data["desg"]=$this->staff_tickets_model->get_all_department();
		$data["adm"]=$this->staff_tickets_model->get_all_admin();
		$data["list"]=$this->staff_tickets_model->get_staff_tickets($user_det['email']);
		$data["status"]=0;
		echo $this->load->view('view_list',$data);
	}
	//INACTIVE
	public function delete_staff_tickets_inactive()
	{
		$user_det = $this->session->userdata('logged_in');
		$this->load->model('staff_tickets/staff_tickets_model');
		$id=$this->input->post('value1');
		$this->staff_tickets_model->delete_staff_tickets_inactive($id);
		$data["list"]=$this->staff_tickets_model->get_staff_tickets($user_det['email']);
		
		$data["desg"]=$this->staff_tickets_model->get_all_department($user_det['department_id']);
		$data["adm"]=$this->staff_tickets_model->get_all_admin();
		$data["status"]=0;
		echo $this->load->view('view_list',$data);
		
	}
	//ADMIN VIEW
	public function admin_view()
	{
		 $user_det = $this->session->userdata('logged_in');
		 $this->load->model('staff_tickets/staff_tickets_model');
		 $data["desg"]=$this->staff_tickets_model->get_all_department1();
		 $data["adm"]=$this->staff_tickets_model->get_all_admin();
		$data["details"]=$this->staff_tickets_model->get_admin_tickets($user_det['user_id']);
		// print_r($data);exit;
		 $data["status"]=1;
		 $this->template->write_view('content','staff_tickets/admin_view',$data);
		 $this->template->render();
	}
	public function update_admin_view()
		{
			
		    $user_det = $this->session->userdata('logged_in');
			$this->load->model('staff_tickets/staff_tickets_model');
			$data["desg"]=$this->staff_tickets_model->get_all_department1();
		    $data["adm"]=$this->staff_tickets_model->get_all_admin();
			$id=$this->input->post('value1');
			if($this->input->post('value8')==0)
			$input=array('name1'=>$this->input->post('value2'),'email'=>$this->input->post('value3'),'subject'=>$this->input->post('value4'),'priority'=>$this->input->post('value5'),'description'=>$this->input->post('value7'),'admin_id'=>$this->input->post('value9'),'status'=>$this->input->post('value8'),'read'=>2);
			else
			$input=array('name1'=>$this->input->post('value2'),'email'=>$this->input->post('value3'),'subject'=>$this->input->post('value4'),'priority'=>$this->input->post('value5'),'description'=>$this->input->post('value7'),'admin_id'=>$this->input->post('value9'),'status'=>$this->input->post('value8'));
			$data["status"]=$this->input->post('value8');
			$this->staff_tickets_model->update_staff_tickets($input,$id);
			  $data["details"]=$this->staff_tickets_model->get_admin_tickets($user_det['user_id']);
			
		    echo $this->load->view('admin_view_page',$data);
				
	}
	//DELETE admin
	public function admin_delete_staff_tickets()
	{
		$user_det = $this->session->userdata('logged_in');
		$this->load->model('staff_tickets/staff_tickets_model');
		$id=$this->input->post('value1');
		$this->staff_tickets_model->delete_staff_tickets($id);
		$data["desg"]=$this->staff_tickets_model->get_all_department();
		$data["adm"]=$this->staff_tickets_model->get_all_admin();
		$data["details"]=$this->staff_tickets_model->get_admin_tickets($user_det['user_id']);
		$data["status"]=0;
		echo $this->load->view('admin_view_page',$data);
	}
	//INACTIVE admin
	public function admin_delete_staff_tickets_inactive()
	{
		$user_det = $this->session->userdata('logged_in');
		$this->load->model('staff_tickets/staff_tickets_model');
		$id=$this->input->post('value1');
		$this->staff_tickets_model->admin_delete_staff_tickets_inactive_admin($id);
		$data["details"]=$this->staff_tickets_model->get_admin_tickets($user_det['user_id']);
		$data["desg"]=$this->staff_tickets_model->get_all_department1();
		$data["adm"]=$this->staff_tickets_model->get_all_admin();
		$data["status"]=0;
		/*echo "<pre>";
		print_r($data);
		exit;*/
		echo $this->load->view('admin_view_page',$data);
		
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
