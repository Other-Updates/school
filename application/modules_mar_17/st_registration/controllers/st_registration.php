<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class St_registration extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');	
	}
	
	public function index()
	{
		   $this->load->model('st_registration/st_registration_model');
		   $data["details"]=$this->st_registration_model->get_st_registration();
		   $data["status"]=1;
		   $this->template->write_view('content','st_registration/index',$data);
		   $this->template->render();
	}
	
	 public function insert_admission()
	   {
			$this->load->model('st_registration/st_registration_model');
			$input=array('admission_form_no'=>$this->input->post('value1'),'student_name'=>$this->input->post('value2'),'address'=>$this->input->post('value3'),'phone_no'=>$this->input->post('value5'),'year'=>$this->input->post('value4'),'email'=>$this->input->post('value6'));
			//print_r($input);exit;
			$this->st_registration_model->insert_admission_set($input);
			$data["details"]=$this->st_registration_model->get_st_registration();
			echo $this->load->view('st_registration/view_list',$data); 
	   }
	    public function update_st_registration()
	   {
			$this->load->model('st_registration/st_registration_model');
			$id=$this->input->post('value7');
			
		   // $id=$inp['value7'];
			//print_r($id);exit;
			$input=array('admission_form_no'=>$this->input->post('value1'),'student_name'=>$this->input->post('value2'),'address'=>$this->input->post('value3'),'phone_no'=>$this->input->post('value4'),'year'=>$this->input->post('value6'),'email'=>$this->input->post('value5'));
			//echo "<pre>";print_r($input);exit;
			//
			//$this->st_registration_model->insert_admission_set($input);
			$data["details"]=$this->st_registration_model->get_st_registration();
			$this->st_registration_model->update_st_registration_model($id,$input);
			echo $this->load->view('st_registration/view_list',$data); 
	   }
	   
	   public function delete_list()
	{
			$this->load->model('st_registration/st_registration_model');
			$id=$this->input->post('value1');
			$this->st_registration_model->delete_st_registration_model($id);
			$data["status"]=1;
			$data["details"]=$this->st_registration_model->get_st_registration();
			echo $this->load->view('view_list',$data);
	}
	//Report code add heare
	public function report()
	{
		   $this->load->model('st_registration/st_registration_model');
		   $data["details"]=$this->st_registration_model->get_st_registration();
		   //$data["det_year"]=$this->st_registration_model->get_st_registration_year($y);
		   $data["status"]=1;
		   $this->template->write_view('content','st_registration/report',$data);
		   $this->template->render();
	}
	public function report_year()
	{
		   $this->load->model('st_registration/st_registration_model');
		    $y=$this->input->post('value1');
			//print_r($y);exit;
		   $data["details"]=$this->st_registration_model->get_st_registration_year($y);
		   $data["status"]=1;
		  echo $this->load->view('view_list',$data);
	}
	public function report_type()
	{
		   $this->load->model('st_registration/st_registration_model');
		    $ty=$this->input->post('value1');
			//$y=$this->input->post('value2');
			
			if($ty==1)
			{
				$data["details"]=$this->st_registration_model->get_st_registration_type();
				//print_r($data);exit;
			}
			else if($ty==2)
			{
				$data["details"]=$this->st_registration_model->get_st_registration_type_not();
				//print_r($data);exit;
			}
			else
			{
			}
		   $data["status"]=1;
		  echo $this->load->view('view_list',$data);
	}
	public function export_all()
	{
		
	  	$this->load->model('st_registration/st_registration_model');
		//print_r($id);exit;
		$data=$this->st_registration_model->get_st_registration();
	    //print_r($data);exit;
		
		$this->load->library('Excel');
		 
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
  		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'S.No');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Application Number');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Student Name');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Address');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Phone Number');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Email');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'Year');
		
		
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(20);
		
        // Set fills
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet(0)->getStyle('A1:G1')->getFill()->getStartColor()->setARGB('3399ff');
		if(isset($data) && !empty($data))
		{
			$i=2;$j=1;
			foreach($data as $stu)
			{
				//echo "<pre>";print_r($stu);exit;
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $j);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $stu["admission_form_no"]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, $stu["student_name"]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, $stu["address"]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $stu["phone_no"]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $stu["email"]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, $stu["year"]);
				
				$i++;$j++;
			}
		}
		// Rename worksheet (worksheet, not filename)
		$objPHPExcel->getActiveSheet()->setTitle('Report');
		
		
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Report.xlsx"');
	
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');	
	
  
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
