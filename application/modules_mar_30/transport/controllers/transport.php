<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transport extends MX_Controller {

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
		$this->load->model('transport/transport_model');
		$data['all_staff']=$this->transport_model->get_all_staff();
		$data['all_cleaner']=$this->transport_model->get_all_cleaner();
		$data["details"]=$this->transport_model->get_transport();
		//echo "<pre>";print_r($data);exit;
		/*echo "<pre>";
		print_r($data);exit;*/
		$data['bus_number']=$this->transport_model->get_all_bus();
		$this->template->write_view('content', 'transport/index',$data);
        $this->template->render();

	}
	
	
	 public function insert_transport()
	   {
			$this->load->model('transport/transport_model');
			$input=array('rto_no'=>$this->input->get('value1'),'bus_no'=>$this->input->get('value2'),'driver_id'=>$this->input->get('value3'),'cleaner_id'=>$this->input->get('value4'));
			$this->transport_model->insert_transport_input($input);
			$data["details"]=$this->transport_model->get_transport();
			$data['bus_number']=$this->transport_model->get_all_bus();
			$data['all_staff']=$this->transport_model->get_all_staff();
		    $data['all_cleaner']=$this->transport_model->get_all_cleaner();
		    echo $this->load->view('view_list',$data);
	   }
	   
	    public function insert1_transport()
	   {
			$this->load->model('transport/transport_model');
			$input=array('root_name'=>$this->input->post('value1'),'source'=>$this->input->post('value2'),'rbus_no'=>$this->input->post('value3')); 
			$this->transport_model->insert1_transport($input);
			$data['bus_number']=$this->transport_model->get_all_bus();
			$data["details"]=$this->transport_model->get_transport();
			echo $this->load->view('list_view',$data); 
	   }
	
public function update_transport()
	{
		
			$this->load->model('transport/transport_model');
			$data['all_staff']=$this->transport_model->get_all_staff();
		    $data['all_cleaner']=$this->transport_model->get_all_cleaner();
			$id=$this->input->post('value1');
			$input=array('rto_no'=>$this->input->post('value2'),'bus_no'=>$this->input->post('value3'),'driver_id'=>$this->input->post('value4'),'cleaner_id'=>$this->input->post('value5'));
			$this->transport_model->update_transport($input,$id);
			$data["details"]=$this->transport_model->get_transport();
			$data['bus_number']=$this->transport_model->get_all_bus();
			$data['all_staff']=$this->transport_model->get_all_staff();
		    $data['all_cleaner']=$this->transport_model->get_all_cleaner();
			echo $this->load->view('view_list',$data);	
	}
	public function update_1_transport()
	{
		
			$this->load->model('transport/transport_model');
			$data['all_staff']=$this->transport_model->get_all_staff();
		    $data['all_cleaner']=$this->transport_model->get_all_cleaner();
			$data["details"]=$this->transport_model->get_transport();
			$id=$this->input->post('value1');
			$input=array('root_name'=>$this->input->post('value2'),'source'=>$this->input->post('value3'),'rbus_no'=>$this->input->post('value4'));
			$this->transport_model->update_1_transport($input,$id);
			$data["details"]=$this->transport_model->get_transport();
			$data['bus_number']=$this->transport_model->get_all_bus();
		    echo $this->load->view('list_view',$data);	
	}
	
	public function bus_root_details()
		{
			$this->load->model('transport/transport_model');
			$data["details"]=$this->transport_model->get_transport();
			$data["root"]=$this->transport_model->get_master_root();
			$data['master_details']=$this->transport_model->master_stage_view();
			//print_r($data['master_details']);exit;
			$data['bus_number']=$this->transport_model->get_all_bus();
		    //echo "<pre>";print_r($data['master_details']);exit;
			
			$this->template->write_view('content', 'transport/bus_root_details',$data);
        	$this->template->render();
		}
		
		function insert_bus_root()
	{
		$this->load->model('transport/transport_model');
		$data["root"]=$this->transport_model->get_master_root();
		$data["details"]=$this->transport_model->get_transport();
		$data['bus_number']=$this->transport_model->get_all_bus();
		$post_val=$this->input->get();
		$map='';
		if(isset($post_val['google_map']) && !empty($post_val['google_map']))
		{
			foreach($post_val['google_map'] as $key=>$value)
			{
				if($value!='')
				{
					$map=$map.$value.',';
				}
			}
		}
		else
			$map='11.00860051288406_76.96609497070312,';
		$this->transport_model->update_google_map_info($post_val['value3'],$map);

		$g_array=explode(",", $post_val['value4']);
		$k_array=explode(",", $post_val['value5']);
		$i=0;
		foreach($g_array as $key=>$val)
		{
			if($val!='')
			{
				$input[$i]['stage_name']=$val;
				$input[$i]['bus_fees']=$k_array[$key];
				$input[$i]['master_bus_id']=$post_val['value1'];
				$input[$i]['master_root_id']=$post_val['value3'];
				$i++;	
			}
		
		}
		$this->transport_model->insert_one_transport($input);
		
		$data["root"]=$this->transport_model->get_master_root();
		$data['master_details']=$this->transport_model->master_stage_view();
		
		echo $this->load->view('transport/bus_root_view',$data);
	}
	
	function update_bus_root()
	{
		
		$this->load->model('transport/transport_model');
		$data["root"]=$this->transport_model->get_master_root();
		$data['bus_number']=$this->transport_model->get_all_bus();
		$post_updat=$this->input->get();
		//echo "<pre>"; print_r($post_updat); exit;
		$this->transport_model->delete_master_stage_row($post_updat['value3']);
		$map='';
		if(isset($post_updat['google_map']) && !empty($post_updat['google_map']))
		{
			foreach($post_updat['google_map'] as $key=>$value)
			{
				if($value!='')
				{
					$map=$map.$value.',';
				}
			}
		}
		else
			$map='11.00860051288406_76.96609497070312,';
		$this->transport_model->update_google_map_info($post_updat['value3'],$map);
		$g_array=explode(",", $post_updat['value4']);
		$k_array=explode(",", $post_updat['value5']);
		$i=0;
		foreach($g_array as $key=>$val)
		{
			if($val!='')
			{
				$data['bus_number']=$this->transport_model->get_all_bus();
				$input[$i]['stage_name']=$val;
				$input[$i]['bus_fees']=$k_array[$key];
				$input[$i]['master_bus_id']=$post_updat['value1'];
				$input[$i]['master_root_id']=$post_updat['value3'];
				$i++;	
			}
		
		}
		$this->transport_model->update_one_transport($input);
		redirect($this->config->item('base_url').'transport/bus_root_details');	
	}
	
	
	function view_transport($id)
	{
		$this->load->model('transport/transport_model');
		$data["details"]=$this->transport_model->get_transport();
		$data['stage_master']=$this->transport_model->get_stage_details($id);
		
		$data['bus_number']=$this->transport_model->get_all_bus();
		if(isset($data['stage_master']) && !empty($data['stage_master']))
		{
		$this->template->write_view('content', 'view_transport',$data);
        $this->template->render();
		}
		else
		{
		redirect($this->config->item('base_url').'transport/bus_root_details');	
		}
	}
	
	function update_transport_stage($id)
	{
		$this->load->model('transport/transport_model');
		$data["details"]=$this->transport_model->get_transport();
		//$data['stage_master']=$this->transport_model->update_stage_details($id);
		$data['stage_master']=$this->transport_model->get_stage_details($id);
		//echo "<pre>";print_r($data['stage_master']);exit;	
		$data['bus_number']=$this->transport_model->get_all_bus();	
		
		if(isset($data['stage_master']) && !empty($data['stage_master']))
		{
		$this->template->write_view('content', 'update_transport',$data);
        $this->template->render();
		}
		else
		{
		redirect($this->config->item('base_url').'transport/bus_root_details');	
		}
		
	}
	
	
	
	public function update_fees_name()
	{
		$this->load->model('transport/transport_model');
		$data['bus_number']=$this->transport_model->get_all_bus();	
		$id_fee=$this->input->get('value1');
		$input=array('master_bus_id'=>$this->input->get('value2'),'route_name'=>$this->input->get('value3'),'source'=>$this->input->get('value4'),'stage_name'=>$this->input->get('value5'),'bus_fees'=>$this->input->get('value6'));
		$t=$this->transport_model->update_fees($input,$id);
		$data['fee_name']=$this->admin_model->get_fees_name();
		$this->template->write_view('content', 'admin/view_all_notification',$data);
	}
	
	
	
	public function update_transport_root()
	{
		
			$this->load->model('transport/transport_model');
			
			$id=$this->input->post('value1');
			
			
			$input=array('master_vehical_id'=>$this->input->post('value2'),'master_root_id'=>$this->input->post('value3'),'master_stage_id'=>$this->input->post('value4'));
			$this->transport_model->update_transport_root($input,$id);
			$data['master_details']=$this->transport_model->master_stage_view();
		    $data['root']=$this->transport_model->get_master_root();
			$data['bus_number']=$this->transport_model->get_all_bus();
		    $data['root_details']=$this->transport_model->master_stage_view();
			$data['rootbus']=$this->transport_model->get_root();
			echo $this->load->view('root_view',$data);	
	}
	public function search_bus_details()
	{
		
			$this->load->model('transport/transport_model');
			$id=$this->input->GET('value1');
			$source=$this->transport_model->search_bus_details($id);
			
           //echo "<pre>";print_r($source);exit;
			$g_select='Route:<td><select id="rname1" name="rname1" class="rname1" >
                 			<option value="">Select</option>';
						
				if(isset($source) && !empty($source))
				{
					foreach($source as $val)
					//print_r($val);exit;
					{    
						$g_select=$g_select."<option value='".$val['id']."'>".$val['root_name']."</option>";
					}
				}
				$g_select=$g_select.'</select>';
				echo "<td>".$g_select;
			}
			public function search_bus_stage()
			{
			$this->load->model('transport/transport_model');
			$id=$this->input->GET('value1');
			
			$source=$this->transport_model->search_bus_stage($id);
          // 
		 
				if(isset($source) && !empty($source))
				{
					foreach($source as $val)
					{ 
						$g_select="<tr><td>Source:</td>"."<td><input type='text' readonly='readonly' name='rname' class='rname' id='rname' value='".$val["source"]."' /></td></tr></table>";

					}
				}
				//$g_select=$g_select;
				echo "<td>".$g_select;
			  
			}
			
			
			
			public function transport_bus_no()
			{
				$this->load->model('transport/transport_model');
				$source = $this->input->get();
				$g_array = $this->transport_model->get_busno($source['source']);
				$k_array = $this->transport_model->get_busno1($source['source']);
				//$a_array = $this->transport_model->get_busno1($source['source']);
				
				$g_select='<table class="form_table"><tr><td width="200">Bus No</td><td>
						<select id="bus_id" name="source_bus" class="bus_class t_port" ><option>Select</option>';
				if(isset($g_array) && !empty($g_array))
				{
					foreach($g_array as $val)
					{  
						
						$g_select=$g_select."<option value='".$val['master_bus_id']."'>".$val['bus_no']."</option>";
						
					}
				}
				$g_select=$g_select.'</select> 
				</td><td><span id="incase" style="color:blue;">*Incase of more than one bus in same route, confirm the Bus No </span>
				</td></tr></table>';
				echo $g_select;
				
				$r_select='<table class="form_table"><tr id="route"><td width="200">Route</td><td>
				<select id="route_id" name="source_name" class="route_class t_port" > <option>Select</option>';
					if(isset($k_array) && !empty($k_array))
					{
						foreach($k_array as $val)
						{  
							
						$r_select=$r_select."<option value='".$val["source"].'(Via)'.$val["root_name"]."'>"
						.$val["source"].'(Via)'.$val["root_name"]."</option>";
							
						}
					}
				$r_select=$r_select.'</select></td></tr></table>';
				echo $r_select;
				
				
				if(isset($k_array) && !empty($k_array))
				{
					foreach($k_array as $val)
					{
						
						$b_select='<table class="form_table"><tr id="amount"><td width="200">Amount</td><td width="200">
						<input type="text" id="amount_id" name="amount_name" class="amount_class t_port" disabled="disabled"  
						value="'.$val["bus_fees"].'"/></td><td><input type="button" name="Edit" value="Edit" 
						class="edit_clas edit_btn btn bg-navy btn-sm"/></td></tr></table></div>';
						
					}
				}
				
				
				echo $b_select;
								
			}
			
			
			public function transport_total()
			{
				$this->load->model('transport/transport_model');
				$source = $this->input->get();
				$data['k_array'] = $this->transport_model->get_busno2($source);
				echo $this->load->view('transport/transport_total',$data);
			}
			
			
			public function transport_addmission()
			{
				$this->load->model('transport/transport_model');	
				//$data['transport_list']=$this->transport_model->get_all_student_from_transport_fees();
				$this->template->write_view('content', 'transport/transport_addmission');
				$this->template->render();
			}
			public function get_student_list()
			{
				$this->load->model('transport/transport_model');
				$tran_std = $this->input->get();
				$data= $this->transport_model->get_student_list1($tran_std);
				foreach($data as $st_rlno)
				{
					echo $st_rlno['std_id']."\n";
				}			
			}
			public function transport_student()
			{
				$post_val=$this->input->get();
				$this->load->model('student/student_model');
				$this->load->model('fees/fees_model');	
				$this->load->model('transport/transport_model');	
				$student_id=$this->student_model->get_student_details_by_roll_no($post_val['roll_no']);
				if(isset($student_id) && !empty($student_id))
				{
				$this->load->model('transport/transport_model');	
				$roll_no = $this->input->get();
				$roll=$roll_no['roll_no'];
				//print_r($roll); exit;
				$data['std_info']=$this->transport_model->get_student_list_trans($roll);
				$data['mas_root']=$this->transport_model->get_all_root();
				$data['bus']=$this->transport_model->get_all_bus1();
				$data['transport_list']=$this->transport_model->get_all_student_from_transport_fees($roll);
				$data['fees_info_trans']=$this->transport_model->get_transport_std_id($roll);
				echo $this->load->view('transport/transport_student_advance',$data);
				}
				else
				{
					echo "<br/>";
					echo "<b style='margin-left:150px;color:#FF4747;font-size:15px;'>Invalid Roll Number&nbsp;!</b>";
				}
				
				
			}
			
			public function transport_amount()
			{
				$this->load->model('transport/transport_model');
				$bus_id = $this->input->get();
				$k_array = $this->transport_model->transport_amount($bus_id);
				
				$r_select='<table class="form_table"><tr><td width="200">Route</td><td>
				<select id="route_id" name="source_name" class="route_class t_port" ><option>select</option>';
					if(isset($k_array) && !empty($k_array))
					{
						foreach($k_array as $val)
						{  
							
						$r_select=$r_select."<option value='".$val["source"].'(Via)'.$val["root_name"]."'>"
						.$val["source"].'(Via)'.$val["root_name"]."</option>";
							
						}
					}
				$r_select=$r_select.'</select></td></tr></table>';
				echo $r_select;
						
						
			}
			
		
			
			public function transport_stage()
			{
				$this->load->model('transport/transport_model');
				$bus_id = $this->input->get();
				//print_r($bus_id); exit;
				$g_array = $this->transport_model->get_stage($bus_id['bus_id']);
				$g_select='<select id="stage_id" name="stage_name" class="Stage_class t_port" >
						<option value="">Select</option>';
				if(isset($g_array) && !empty($g_array))
				{
					foreach($g_array as $val)
					{
						$g_select=$g_select."<option value='".$val['id']."'>".$val['stage_name']."</option>";
					}
				}
				$g_select=$g_select.'</select>';
				echo $g_select;
				
			}
			public function transport_bus_no1()
			{
				$this->load->model('transport/transport_model');
				$source = $this->input->get();
				$g_array = $this->transport_model->get_busno($source['source']);
				$k_array = $this->transport_model->get_busno1($source['source']);
				//$a_array = $this->transport_model->get_busno1($source['source']);
				//print_r($k_array); exit;
				$g_select='<table class="staff_table"><tr><td width="273" >Bus No</td><td class="text_bold">
						<select id="bus_id_update" name="source_bus" class="bus_class_up" ><option>Select</option>';
				if(isset($g_array) && !empty($g_array))
				{
					foreach($g_array as $val)
					{  
						
						$g_select=$g_select."<option value='".$val['master_bus_id']."'>".$val['bus_no']."</option>";
						
					}
				}
				$g_select=$g_select.'</select></td></tr></table>';
				echo $g_select;
				
				
				$r_select='<table class="staff_table"><tr id="route_up"><td width="273" >Route</td><td class="text_bold">
				<select id="route_id_update" name="source_name" class="route_cla route_class_up" ><option>Select</option>';
					if(isset($k_array) && !empty($k_array))
					{
						foreach($k_array as $val)
						{  
							
						$r_select=$r_select."<option value='".$val["source"].'(Via)'.$val["root_name"]."'>"
						.$val["source"].'(Via)'.$val["root_name"]."</option>";
							
						}
					}
				$r_select=$r_select.'</select></td></tr></table>';
				echo $r_select;
				
				
				if(isset($k_array) && !empty($k_array))
				{
					foreach($k_array as $val)
					{
						
						$b_select='<table class="staff_table"><tr id="amount_up">
						<td width="273">Amount</td><td  class="text_bold" width="200"><input type="text" id="amount_id_update" 
						name="amount_name" class="amount_class" disabled="disabled"  
						value="'.$val["bus_fees"].'"/></td><td><input type="button" name="Edit" value="Edit" 
						class="edit_update edit_btn btn bg-navy btn-sm"/></td></tr></table></div>';
						
					}
				}
				echo $b_select;
				
			}
			
			public function transport_amount_update()
			{
				$this->load->model('transport/transport_model');
				$bus_id = $this->input->get();
				$k_array = $this->transport_model->transport_amount($bus_id);
				
				$r_select='<table class="staff_table"><tr><td width="273">Route</td><td class="text_bold">
				<select id="route_id_update" name="source_name" class="route_class t_port" ><option>select</option>';
					if(isset($k_array) && !empty($k_array))
					{
						foreach($k_array as $val)
						{  
							
						$r_select=$r_select."<option value='".$val["source"].'(Via)'.$val["root_name"]."'>"
						.$val["source"].'(Via)'.$val["root_name"]."</option>";
							
						}
					}
				$r_select=$r_select.'</select></td></tr></table>';
				echo $r_select;
			}
			
			public function transport_amount1()
			{
				$this->load->model('transport/transport_model');
				$bus_id = $this->input->get();
				$k_array = $this->transport_model->transport_amount($bus_id);
				//print_r($k_array); exit;
				
					if(isset($k_array) && !empty($k_array))
					{
						foreach($k_array as $val)
						{  //print_r($val); exit;
							
						$g_select='<table class="form_table"><tr><td width="200">Amount</td><td width="200"><input type="text" 
						id="amount_id" name="amount_name" class="amount_class t_port" disabled="disabled"  
						value="'.$val["bus_fees"].'"/></td><td> <input type="button" name="Edit" value="Edit" 
						class="edit_clas edit_btn btn bg-navy btn-sm" /></td></tr></table>';
							
						}
					}
				
					echo $g_select;	
						
			}
			
			public function transport_amount2()
			{
				$this->load->model('transport/transport_model');
				$bus_id = $this->input->get();
				$k_array = $this->transport_model->transport_amount($bus_id);
				//print_r($k_array); exit;
				
					if(isset($k_array) && !empty($k_array))
					{
						foreach($k_array as $val)
						{  //print_r($val); exit;
							
						$g_select='<table class="staff_table"><tr><td width="273">Amount</td><td width="200" class="text_bold"><input type="text" 
						id="amount_id" name="amount_name" class="amount_class t_port" disabled="disabled"  
						value="'.$val["bus_fees"].'"/></td><td> <input type="button" name="Edit" value="Edit" 
						class="edit_update edit_btn btn bg-navy btn-sm" /></td></tr></table>';
							
						}
					}
				
					echo $g_select;	
						
			}
			
			public function amount_cal()
			{
				$this->load->model('transport/transport_model');
				$stage_id = $this->input->get();
				//echo strtotime($stage_id['e_year']); exit;
				$diff = abs(strtotime($stage_id['e_year']) - strtotime($stage_id['f_year']));
				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
				$mon1=$years*12;
				$mon2=$mon1+$months;
				$tot=$mon2*$stage_id['e_amount'];
				$g_select="<input type='text' value='".$tot."' id='t_amount' class='t_class' />";
				echo $g_select;
				
			}
			
			public function insert_transport_fees()
			{
				$this->load->model('transport/transport_model');
				$trans_detail = $this->input->get();
				$roll=$trans_detail['std_reg'];
				//print_r($trans_detail); exit;
				$user_det = $this->session->userdata('logged_in');	
				$input=array('stage'=>$this->input->get('stage'),
				'date_from'=>$this->input->get('date_from'),
				'date_to'=>$this->input->get('date_to'),'bus_id'=>$this->input->get('bus_id'),
				'fdate'=>$this->input->get('fdate'),'tdate'=>$this->input->get('tdate'),
				'amount_id'=>$this->input->get('amount_id'),'route_id'=>$this->input->get('route_id'),
				'a_amt'=>$this->input->get('a_amt'),'reason'=>$this->input->get('reason'),
				'f_days'=>$this->input->get('period'),'get_fine'=>$this->input->get('get_fine'),
				'payment_mode'=>$this->input->get('payment_mode'),'bank_name'=>$this->input->get('bank_name'),
				'bank_dd'=>$this->input->get('bank_dd'),'bank_amount'=>$this->input->get('bank_amount'),
				'total'=>$this->input->get('total'),'period_amount'=>$this->input->get('period_amount'),
				'branch_name'=>$this->input->get('branch_name'),'std_reg'=>$this->input->get('std_reg'),
				'created_by'=>$user_det['user_id'],'staff_type'=>$user_det['staff_type']);
				
								
				$this->transport_model->insert_transport_fees($input);
				
				$data['std_info']=$this->transport_model->get_student_list_trans($roll);
				$data['transport_list']=$this->transport_model->get_all_student_from_transport_fees($roll);
				echo $this->load->view('transport/transport_student_view',$data);
				
			}
			
			public function view_student_transport($id,$val)
			{
			
				$this->load->model('transport/transport_model');
				//$data['std_info']=$this->transport_model->get_student_transport_details($id);
				$data['stud_trans']=$this->transport_model->get_student_transport_view($id,$val);
				//echo "<pre>";print_r($data['stud_trans'][0]['payment_mode']); exit;
				$this->template->write_view('content', 'transport/view_student_transport',$data);
				$this->template->render();
			}
			public function update_student_transport($roll,$id)
			{
				$this->load->model('transport/transport_model');
				$data['stud_trans']=$this->transport_model->get_student_transport_update($roll,$id);
				//echo "<pre>";print_r($data['stud_trans']); exit;
				$data['std_info']=$this->transport_model->get_student_list_trans($roll);
				$data['mas_root']=$this->transport_model->get_all_root();
				$data['bus_no']=$this->transport_model->get_all_bus();
				$data['stage']=$this->transport_model->get_all_stage();
				$this->template->write_view('content', 'transport/update_student_transport',$data);
				$this->template->render();
				
			}
			
			public function update_student_transport1()
			{
				$this->load->model('transport/transport_model');
				$updat_det = $this->input->post();
				//print_r($updat_det); exit;
				$roll=$updat_det['std_reg'];
				$id=$updat_det['id'];
				$user_det = $this->session->userdata('logged_in');	
				$input=array('stage'=>$this->input->post('stage'),'date_from'=>$this->input->post('date_from'),
				'date_to'=>$this->input->post('date_to'),'bus_id'=>$this->input->post('bus_id'),
				'fdate'=>$this->input->post('fmon'),'tdate'=>$this->input->post('tmon'),
				'balz'=>$this->input->post('balz'),'excess'=>$this->input->post('excess'),
				'std_reg'=>$this->input->post('std_reg'),'amt_diff'=>$this->input->post('amt_diff'),
				'amount_id'=>$this->input->post('amount_id'),'route_id'=>$this->input->post('route_id'),
				'a_amt'=>$this->input->post('a_amt'),'reason'=>$this->input->post('reason'),
				'f_days'=>$this->input->post('period'),'get_fine'=>$this->input->post('get_fine'),
				'payment_mode'=>$this->input->post('payment_mode'),'bank_name'=>$this->input->post('bank_name'),
				'bank_dd'=>$this->input->post('bank_dd'),'bank_amount'=>$this->input->post('bank_amount'),
				'total'=>$this->input->post('total'),'period_amount'=>$this->input->post('period_amount'),
				'branch_name'=>$this->input->post('branch_name'),'std_reg'=>$this->input->post('std_reg'),
				'created_by'=>$user_det['user_id'],'staff_type'=>$user_det['staff_type']);
				$this->transport_model->insert_update_fees($input,$roll,$id);
				$data['roll_no']=$updat_det['std_reg'];
				$data['std_info']=$this->transport_model->get_student_list_trans($roll);
				$data['transport_list']=$this->transport_model->get_all_student_from_transport_fees($roll);
				$data['fees_info_trans']=$this->transport_model->get_transport_std_id($roll);
				//redirect($this->config->item('base_url').'transport/transport_student/',$data);
				echo $this->load->view('transport/update_trasnport_view',$data);
			}
			
			public function get_student_list_fees()
			{
				$this->load->model('transport/transport_model');
				$tran_std = $this->input->get();
				$data = $this->transport_model->get_student_list_fees($tran_std);
				//print_r($data); exit;
				foreach($data as $st_rlno)
				{
					echo $st_rlno['std_roll_num']."\n";
				}			
			}
			public function view_student_fees()
			{
				$this->load->model('transport/transport_model');	
				$roll_no = $this->input->get();
				$roll= $this->input->get();
				$data['trans_info']=$this->transport_model->get_student_fees_details($roll_no['roll_no']);
				$data['trans_student']=$this->transport_model->get_student_from_trans($roll_no['roll_no']);
				echo $this->load->view('transport/transport_history',$data);
			}
			public function fees_details($id)
			{
				$this->load->model('transport/transport_model');
				$data['fees_info_trans']=$this->transport_model->get_student_fees_details1($id);
				echo $this->load->view('transport/print_fees_view',$data,TRUE);
			}
			public function get_stage_list()
			{
				$this->load->model('transport/transport_model');
				$tran_stg = $this->input->get();
				//print_r($tran_stg); exit;
				$data= $this->transport_model->get_stage_list($tran_stg);
				foreach($data as $st_rlno)
				{
					echo $st_rlno['stage_name']."\n";
				}			
			}
			public function days()
			{
				$this->load->model('transport/transport_model');
				$stage_id = $this->input->get();
				//echo strtotime($stage_id['e_year']); exit;
				$diff = abs(strtotime($stage_id['today']) - strtotime($stage_id['due']));
				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
				$days="Days=<input type='text' value='".$days."' id='days' class='t_class'  />";
				echo $days;
				
			}
			public function add_duplicate_busno()
			{
			$this->load->model('transport/transport_model');	
			$input=$this->input->post('value1');
			$validation=$this->transport_model->add_duplicate_busno($input);
			//echo $input;exit;
			$i=0; if($validation){$i=1;}if($i==1){echo "Bus Number already Exist";}
		
			}	
			public function update_duplicate_busno()
			{
			$this->load->model('transport/transport_model');	
			$input=$this->input->post('value1');
			$id=$this->input->post('value2');
			$validation=$this->transport_model->update_duplicate_busno($input,$id);
			//echo $input; 
			//echo $id; 
			//exit;
			$i=0; if($validation){$i=1;}if($i==1){echo "Bus Number already Exist";}
		
			}
			public function add_duplicate_route()
			{
			$this->load->model('transport/transport_model');	
			$input1=$this->input->post('value1');
			$input2=$this->input->post('value2');
			$input3=$this->input->post('value3');
			$validation=$this->transport_model->add_duplicate_route($input1,$input2,$input3);
			//echo $input1; 
//			echo $input2;
//			echo $input3;
//			exit;
			$i=0; if($validation){$i=1;}if($i==1){echo "Route and Source Already Allotted for This BusNo";}
		
			}		
			public function add_duplicate_stage()
			{
			$this->load->model('transport/transport_model');	
			$input1=$this->input->post('value1');
			$input2=$this->input->post('value2');
			$validation=$this->transport_model->add_duplicate_stage($input1,$input2);
			/*echo $input1; 
			echo $input2;
			exit;*/
			$i=0; if($validation){$i=1;}if($i==1){echo "This Stage Already Allotted for This BusNo";}
		
			}		
			public function fees_details_transport($roll)
			{
				$this->load->model('transport/transport_model');
				$data['fees_info_trans']=$this->transport_model->get_transport_std_id($roll);	
				echo $this->load->view('transport/print_fees_view',$data,TRUE);
			}
			public function transport_amount_up()
			{
				$this->load->model('transport/transport_model');
				$bus_id = $this->input->get();
				$k_array = $this->transport_model->transport_amount($bus_id);
				
				$r_select='<table class="form_table"><tr><td width="273">Route</td><td>
				<select id="route_id" name="source_name" class="route_class route_class_up" ><option>select</option>';
					if(isset($k_array) && !empty($k_array))
					{
						foreach($k_array as $val)
						{  
							
						$r_select=$r_select."<option value='".$val["source"].'(Via)'.$val["root_name"]."'>"
						.$val["source"].'(Via)'.$val["root_name"]."</option>";
							
						}
					}
				$r_select=$r_select.'</select></td></tr></table>';
				echo $r_select;
			}
			
			public function transport_year()
			{
				$this->load->model('transport/transport_model');
				$std_reg = $this->input->get();
				$data['transport_year'] = $this->transport_model->transport_year($std_reg['std_roll']);
				echo $this->load->view('transport/previous_year',$data);
				
			}
			public function transport_report()
			{
				$this->load->model('transport/transport_model');
				$this->load->model('student/student_model');	
				$data['transport_student_list']=$this->transport_model->get_all_student_from_student();
				$data['all_batch'] =$this->student_model->get_all_batch();
				
				//echo "<pre>";print_r($data); exit;
				$this->template->write_view('content', 'transport/transport_report',$data);
				$this->template->render();
			}
			
			public function get_all_department1()
			{
				$this->load->model('transport/transport_model');
				$this->load->model('student/student_model');
				$b_id=$this->input->post();
				$g_array=$this->student_model->get_all_depart_by_batch($b_id['batch_id']);
				$g_select="<select id='depart_id' name='student_group[depart_id]' class=' mandatory validate dupe' style='width:100px'><option value=''>Select</option>";
				if(isset($g_array) && !empty($g_array))
				{
					foreach($g_array as $val)
					{
						$g_select=$g_select."<option value='".$val['id']."'>".$val['nickname']."</option>";
					}
				}
				$g_select=$g_select.'</select>';
				echo $g_select;
			}
			public function get_all_group1()
			{
				$this->load->model('transport/transport_model');
				$this->load->model('student/student_model');
				$this->load->model('subject/subject_model');
				$d_id=$this->input->post();
				$user_det = $this->session->userdata('logged_in');
				if($user_det['staff_type']=='staff')
				$g_array=$this->student_model->get_all_group($d_id['depart_id']);
				else	
				$g_array=$this->student_model->get_all_group($d_id['depart_id']);
				$g_select='<select id="group_id" name="student_group[group_id]" class="mandatory" style="width:100px"><option value="">Select</option>';
				if(isset($g_array) && !empty($g_array))
				{
					foreach($g_array as $val)
					{
						$g_select=$g_select."<option value='".$val['id']."'>".$val['group']."</option>";
					}
				}
				$g_select=$g_select.'</select>';
				echo $g_select;
			}
			function get_all_student_for_staff()
			{
				$this->load->model('transport/transport_model');
				$data['ajax_val']=$this->input->post();
				$data['transport_student_list']=$this->transport_model->get_all_student_for_staff_transport($data['ajax_val']['select_batch'],$data['ajax_val']['depart_id'],$data['ajax_val']['group_id']);
				//echo "<pre>";print_r($data['all_student']); exit;
				
				echo $this->load->view('transport/trasport_report_view',$data);
			}	
			function get_all_student_type()
			{
				$this->load->model('transport/transport_model');
				$data['ajax_val']=$this->input->post();
				//echo "<pre>"; print_r($data['ajax_val']); exit;
				$data['transport_student_list']=$this->transport_model->get_all_student_type_trans($data['ajax_val']['select_batch'],$data['ajax_val']['depart_id'],$data['ajax_val']['group_id'],$data['ajax_val']['s_type']);
				//echo "<pre>"; print_r($data['all_student']); exit;
				echo $this->load->view('transport/trasport_report_view',$data);
			}
			
			function view_student_transport1()
			{
				$this->load->model('transport/transport_model');
				$data=$this->input->post();
				$roll=$data['std_id'];
				$data['fees_info_trans']=$this->transport_model->get_transport_std_id($roll);
				echo $this->load->view('transport/trasport_report_stdviw_id',$data);
			}
			
			
		}


	   
		
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
