<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Library extends MX_Controller {

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
		$this->load->library('email');
	    $this->load->database();
		$this->load->library('form_validation');
			
	}



public function search_book()
	{
		$this->template->write_view('content', 'library/search_book');
        $this->template->render();  
	}
	public function search_books()
	{
		//echo "<pre>";
		$this->load->model('library/library_model');
		$rack=$this->library_model->get_all_book_rack();
		$input=$this->input->get();
		//echo $input['search_opt'];
		$result=$this->library_model->get_search_result($input);
		$table='<br>';
		//print_r($result);
		if(isset($result) && !empty($result))
		{
			if($input['search_opt']=='books')
			{
				$table=$table.'<table class="table table-bordered table-striped dataTable demo my_table_style">';
				$table=$table.'<thead>';
				$table=$table.'<tr><th>Book NO</th><th>Book Title</th><th>Rack</th><th>Row</th><th>Author Name</th><th>Edition</th><th>Publisher</th><th>Status</th><th>Current User</th><th>Return Date</th></tr>';
				$table=$table.'</thead>';
				foreach($result as $val)
				{
					if($val['status']==1)
						$st='<span class="badge pull-right bg-green">Available</span>';
					else
						$st='<span class="badge pull-right bg-red">Taken</span>';	
					
					$user='-';
					$r_date='-';
					if(isset($val['issue_user'][0]) && !empty($val['issue_user'][0]))
					{
						$user=$val['issue_user'][0]['name'];
						$r_date=$val['issue_user'][0]['return_date'];
					}
					$rack3='';
					if(isset($rack) && !empty($rack))
					{
						foreach ($rack as $rack_val)
						{
							if($val['book_rack']==$rack_val['brid'])
							{
								$rack3=$rack_val['bk_rack'];
							}
						}
					} 
					$table=$table.'<tr><td>'.$val['isbn_no'].'</td><td>'.$val['book_title'].'</td><td>'.$rack3.'</td><td>'.$val['rack_row'].'</td><td>'.$val['author_name'].'</td><td>'.$val['edition'].'</td><td>'.$val['pub_name'].'</td><td>'.$st.'</td><td>'.$user.'</td><td>'.$r_date.'</td></tr>';
				}
				$table=$table.'</table>';
			}
			elseif($input['search_opt']=='cd')
			{
				$table=$table.'<table class="table table-bordered table-striped dataTable my_table_style">';
				$table=$table.'<thead>';
				$table=$table.'<tr><th>CD NO</th><th>CD Title</th><th>Rack</th><th>Row</th><th>Publisher</th><th>Edition</th>
				<th>Status</th><th>Current User</th><td>Return Date</th></tr>';
				$table=$table.'</thead><tbody>';
				foreach($result as $val)
				{
					if($val['status']==1)
						$st='<span class="badge pull-right bg-green">Available</span>';
					else
						$st='<span class="badge pull-right bg-red">Taken</span>';	
					
					$user='-';
					$r_date='-';
					if(isset($val['issue_user'][0]) && !empty($val['issue_user'][0]))
					{
						$user=$val['issue_user'][0]['name'];
						$r_date=$val['issue_user'][0]['return_date'];
					}
					$rack1='';
					if(isset($rack) && !empty($rack))
					{
						foreach ($rack as $rack_val)
						{
							if($val['rack']==$rack_val['brid'])
							{
								$rack1=$rack_val['bk_rack'];
							}
						}
					} 	
					$table=$table.'<tr><td>'.$val['cd_no'].'</td><td>'.$val['cd_title'].'</td><td>'.$rack1.'</td><td>'.$val['row'].'</td><td>'.$val['pub_name'].'</td><td>'.$val['edition'].'</td><td>'.$st.'</td><td>'.$user.'</td><td>'.$r_date.'</td></tr>';
				}
				$table=$table.'</tbody></table>';
			}
			elseif($input['search_opt']=='exam_papers')
			{
				$table=$table.'<table class="table table-bordered table-striped dataTable my_table_style">';
				$table=$table.'<thead>';
				$table=$table.'<tr><th>Exam Paper NO</th><th>Subject</th><th>Rack</th><th>Row</th><th>Publisher</th><th>Status</th><th>Current User</th><th>Return Date</th></tr>';
				$table=$table.'</thead>';
				foreach($result as $val)
				{
					if($val['status']==1)
						$st='<span class="badge pull-right bg-green">Available</span>';
					else
						$st='<span class="badge pull-right bg-red">Taken</span>';	
					
					$user='-';
					$r_date='-';
					if(isset($val['issue_user'][0]) && !empty($val['issue_user'][0]))
					{
						$user=$val['issue_user'][0]['name'];
						$r_date=$val['issue_user'][0]['return_date'];
					}
					$rack2='';
					if(isset($rack) && !empty($rack))
					{
						foreach ($rack as $rack_val)
						{
							if($val['rack']==$rack_val['brid'])
							{
								$rack2=$rack_val['bk_rack'];
							}
						}
					} 		
					$table=$table.'<tr><td>'.$val['exam_no'].'</td><td>'.$val['subject'].'</td><td>'.$rack2.'</td><td>'.$val['row'].'</td><td>'.$val['publisher'].'</td><td>'.$st.'</td><td>'.$user.'</td><td>'.$r_date.'</td></tr>';
				}
				$table=$table.'</table>';
			}
		}
		else
		{
			$table=$table.'No result found.....';
		}
		echo $table;
		//print_r($result);
	}
	function issue_book()
	{
		$this->template->write_view('content', 'library/issue_book');
        $this->template->render();      
	}
	public function get_all_library()
	{
		$atten_inputs = $this->input->get();
			
		$this->load->model('library/library_model');
		$data = $this->library_model->get_all_book_cd_exam_no($atten_inputs);
		
		foreach($data as $st_rlno)
		{
			echo $st_rlno['no']."\n";
		}			
	}
	public function get_all_library1()
	{
		$atten_inputs = $this->input->get();
			
		$this->load->model('library/library_model');
		$data = $this->library_model->get_all_book_cd_exam_no1($atten_inputs);
		//echo "<pre>";
		//print_r($data);
		foreach($data as $st_rlno)
		{
			echo $st_rlno['no']."\n";
		}			
	}
	public function get_book_info()
	{
		$inputs = $this->input->get();
		$this->load->model('library/library_model');
		$data = $this->library_model->get_book_info($inputs['number']);
		if(isset($data) && !empty($data))
		{
			if($data[0]['from']=='books')
			{
				echo '<table class="staff_table1">
					  	<tr><td>Book NO</td><td class="text_bold">'.$data[0]['isbn_no'].'</td></tr>
						<tr><td>Title</td><td class="text_bold">'.$data[0]['book_title'].'</td></tr>
						<tr><td>Author Name</td><td class="text_bold">'.$data[0]['author_name'].'</td></tr>
						<tr><td>Edition</td><td class="text_bold">'.$data[0]['edition'].'</td></tr>
						<tr><td>Price</td><td class="text_bold">'.$data[0]['price'].'</td></tr>
						<tr><td>No of Pages</td><td class="text_bold">'.$data[0]['no_of_pages'].'</td></tr>
						<tr><td>Publisher Name</td><td class="text_bold">'.$data[0]['pub_name'].'</td></tr>
						<tr><td>Publisher Address</td><td class="text_bold">'.$data[0]['pub_address'].'</td></tr>
					  </table>';
			}
			elseif($data[0]['from']=='cd')
			{
				echo '<table class="staff_table1">
					  	<tr><td>CD NO</td><td class="text_bold">'.$data[0]['cd_no'].'</td></tr>
						<tr><td>Title</td><td class="text_bold">'.$data[0]['cd_title'].'</td></tr>
						<tr><td>Edition</td><td class="text_bold">'.$data[0]['edition'].'</td></tr>
						<tr><td>Price</td><td class="text_bold">'.$data[0]['price'].'</td></tr>
						<tr><td>Publisher Name</td><td class="text_bold">'.$data[0]['pub_name'].'</td></tr>
						<tr><td>Publisher Address</td><td class="text_bold">'.$data[0]['pub_address'].'</td></tr>
					  </table>';
			}
			elseif($data[0]['from']=='exam')
			{
				echo '<table class="staff_table1">
					  	<tr><td>Exam Paper NO</td><td class="text_bold">'.$data[0]['exam_no'].'</td></tr>
						<tr><td>Subject</td><td class="text_bold">'.$data[0]['subject'].'</td></tr>
						<tr><td>Year</td><td class="text_bold">'.$data[0]['year'].'</td></tr>
						<tr><td>No of Pages</td><td class="text_bold">'.$data[0]['no_of_page'].'</td></tr>
						<tr><td>Publisher Name</td><td class="text_bold">'.$data[0]['publisher'].'</td></tr>
					  </table>';
			}
		}
		else
		{
			echo 'Details not available...';
		}
	}
	public function get_book_info1()
	{
		$inputs = $this->input->get();
		$no=$inputs['number'];
		
		$this->load->model('library/library_model');
		$data = $this->library_model->get_book_info1($inputs['number']);
		
		
		
		$std_info=$this->library_model->get_std_id_by_book_id($inputs['number']);
		$datas = $this->library_model->get_std_info($std_info[0]['student_id']);
	//	echo "<pre>";
	//	print_r($std_info);
	
		$fine_amt=0;
		echo '<div class="col-lg-6">';
		echo '<div class="box box-danger">';
		echo '<div class="box-header"> <i class="fa fa-book buzz-out"></i> <h3 class="box-title">Student Books</h3></div>';
		echo '<div class="box-body" id="book_info"><b>ROLL NO</b>-('.$std_info[0]['student_id'].')';
        echo '<table class="table table-bordered table-striped dataTable">';
		echo '<thead><tr><td>Book NO</td><td>Title</td><td>Author Name</td><td>Edition</td><td>Price</td><td>Issue Date</td><td>Return Date</td><td>Fine</td></tr></thead><tbody>';
		if(isset($datas['books']) && !empty($datas['books']))
		{
			foreach($datas['books'] as $val)
			{
				$fine1=$this->diff_date($val['return_date'],date('Y-m-d'))*1;
				if($inputs['number']=$val['book_id'])
					$fine_amt=$fine1;
				echo '<tr><td>'.$val['book_id'].'</td><td>'.$val['book_title'].'</td><td>'.$val['author_name'].'</td><td>'.$val['edition'].'</td><td>'.$val['price'].'</td><td>'.$val['issue_date'].'</td><td>'.$val['return_date'].'</td><td style="color:red;">'.$fine1.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="8">No books to return...</td></tr>';	
		echo '</tbody></table>';
		echo '<br>';
		echo '<table class="table table-bordered table-striped dataTable">';
		echo '<thead><tr><td>CD NO</td><td>Title</td><td>Edition</td><td>Price</td><td>Issue Date</td><td>Return Date</td><td>Fine</td></tr></thead><tbody>';
		if(isset($datas['cd']) && !empty($datas['cd']))
		{
			foreach($datas['cd'] as $val1)
			{
				$fine2=$this->diff_date($val1['return_date'],date('Y-m-d'))*1;
				if($inputs['number']=$val1['cd_no'])
					$fine_amt=$fine2;
				echo '<tr><td>'.$val1['cd_no'].'</td><td>'.$val1['cd_title'].'</td><td>'.$val1['edition'].'</td><td>'.$val1['price'].'</td><td>'.$val1['issue_date'].'</td><td>'.$val1['return_date'].'</td><td style="color:red;">'.$fine2.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="8">No CD / DVD to return...</td></tr>';	
		echo '</tbody></table>';
		
		echo '<br>';
		echo '<table class="table table-bordered table-striped dataTable">';
		echo '<thead><tr><td>Exam NO</td><td>Subject</td><td>Year</td><td>No of Pages</td><td>Publisher Name</td><td>Issue Date</td><td>Return Date</td><td>Fine</td></tr></thead><tbody>';
		if(isset($datas['exam']) && !empty($datas['exam']))
		{
			foreach($datas['exam'] as $val2)
			{
				$fine3=$this->diff_date($val2['return_date'],date('Y-m-d'))*1;
				if($inputs['number']=$val2['exam_no'])
					$fine_amt=$fine3;
				echo '<tr><td>'.$val2['exam_no'].'</td><td>'.$val2['subject'].'</td><td>'.$val2['year'].'</td><td>'.$val2['no_of_page'].'</td><td>'.$val2['publisher'].'</td><td>'.$val2['issue_date'].'</td><td>'.$val2['return_date'].'</td><td style="color:red;">'.$fine3.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="8">No Exam paper to return...</td></tr>';	
		echo '</tbody></table>';
        echo '</div>';
		echo '</div>';
		echo '</div>';
		
		echo '<div class="col-lg-6">';
		echo '<div class="box box-danger">';
		echo '<div class="box-header"> <i class="fa fa-book buzz-out"></i> <h3 class="box-title">Details</h3></div>';
		echo '<div class="box-body" id="student_book_list">';
		if(isset($data) && !empty($data))
		{
			if($data[0]['from']=='books')
			{
				echo '<table class="staff_table1" width="100%">
					  	<tr><td width="50%">Book NO</td><td class="text_bold">'.$data[0]['isbn_no'].'</td></tr>
						<tr><td>Title</td><td class="text_bold">'.$data[0]['book_title'].'</td></tr>
						<tr><td>Author Name</td><td class="text_bold">'.$data[0]['author_name'].'</td></tr>
						<tr><td>Edition</td><td class="text_bold">'.$data[0]['edition'].'</td></tr>
						<tr><td>Price</td><td class="text_bold">'.$data[0]['price'].'</td></tr>
						<tr><td>No of Pages</td><td class="text_bold">'.$data[0]['no_of_pages'].'</td></tr>
						<tr><td>Publisher Name</td><td class="text_bold">'.$data[0]['pub_name'].'</td></tr>
						<tr><td>Publisher Address</td><td class="text_bold">'.$data[0]['pub_address'].'</td></tr>
					  </table>';
			}
			elseif($data[0]['from']=='cd')
			{
				echo '<table class="staff_table1" width="100%">
					  	<tr><td width="50%">CD NO</td><td class="text_bold">'.$data[0]['cd_no'].'</td></tr>
						<tr><td>Title</td><td class="text_bold">'.$data[0]['cd_title'].'</td></tr>
						<tr><td>Edition</td><td class="text_bold">'.$data[0]['edition'].'</td></tr>
						<tr><td>Price</td><td class="text_bold">'.$data[0]['price'].'</td></tr>
						<tr><td>Publisher Name</td><td class="text_bold">'.$data[0]['pub_name'].'</td></tr>
						<tr><td>Publisher Address</td><td class="text_bold">'.$data[0]['pub_address'].'</td></tr>
					  </table>';
			}
			elseif($data[0]['from']=='exam')
			{
				echo '<table class="staff_table1" width="100%">
					  	<tr><td width="50%">Exam Paper NO</td><td class="text_bold">'.$data[0]['exam_no'].'</td></tr>
						<tr><td>Subject</td><td class="text_bold">'.$data[0]['subject'].'</td></tr>
						<tr><td>Year</td><td class="text_bold">'.$data[0]['year'].'</td></tr>
						<tr><td>No of Pages</td><td class="text_bold">'.$data[0]['no_of_page'].'</td></tr>
						<tr><td>Publisher Name</td><td class="text_bold">'.$data[0]['publisher'].'</td></tr>
					  </table>';
			}
			echo '<table width="100%">
					  	<tr><td width="50%">Fine</td><td><input type="text" id="fine" value="'.$fine_amt.'"/></td></tr>
						<tr><td>Comments</td><td><input type="text" id="comments" placeholder="if any damnage / add or subtract fine" /></td></tr>
						<tr>
							<td>
								<input type="hidden" id="return_user" value="'.$std_info[0]['student_id'].'"/>
								<input type="hidden" id="return_book" value="'.$no.'"/>
							</td><td><input type="button" class="btn btn-success" id="return_b" value="Return" /></td></tr>
				  </table>';
		}
		else
		{
			echo '<div class="empty_details">Details not available...</div>';
		}
		echo '</div>';
		echo '</div>';
		echo '</div>';
		
	
		
	}
	public function diff_date($ret_date,$cur_date)
	{
		$ts1 = strtotime($ret_date);//return date
		$ts2 = strtotime($cur_date);//current date
		$seconds_diff = $ts2 - $ts1;
	
		if($seconds_diff>0)
		{
			$date_1=$ret_date;
			$date_2=$cur_date;
			$datetime1 = date_create($date_1);
			$datetime2 = date_create($date_2);
			$interval = date_diff($datetime1, $datetime2);
			return  $interval->format('%d');
		}
		else
		return '-';
	}
	public function get_student_info()
	{
		$inputs = $this->input->get();
		$this->load->model('library/library_model');
		$data = $this->library_model->get_std_info($inputs['roll_no']);
		
		
		
		echo '<table class="table table-bordered table-striped dataTable">';
		echo '<thead><tr><td>Book NO</td><td>Title</td><td>Author Name</td><td>Edition</td><td>Price</td><td>Issue Date</td><td>Return Date</td><td>Fine</td></tr></thead>';
		if(isset($data['books']) && !empty($data['books']))
		{
			foreach($data['books'] as $val)
			{
				$fine1=$this->diff_date($val['return_date'],date('Y-m-d'))*1;
				echo '<tbody><tr><td>'.$val['book_id'].'</td><td>'.$val['book_title'].'</td><td>'.$val['author_name'].'</td><td>'.$val['edition'].'</td><td>'.$val['price'].'</td><td>'.$val['issue_date'].'</td><td>'.$val['return_date'].'</td><td style="color:red;">'.$fine1.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="8">No books to return...</td></tr>';	
		echo '</tbody></table>';
		echo '<br>';
		echo '<table class="table table-bordered table-striped dataTable">';
		echo '<thead><tr><td>CD NO</td><td>Title</td><td>Edition</td><td>Price</td><td>Issue Date</td><td>Return Date</td><td>Fine</td></tr></thead>';
		if(isset($data['cd']) && !empty($data['cd']))
		{
			foreach($data['cd'] as $val1)
			{
				$fine2=$this->diff_date($val1['return_date'],date('Y-m-d'))*1;
				echo '<tbody><tr><td>'.$val1['cd_no'].'</td><td>'.$val1['cd_title'].'</td><td>'.$val1['edition'].'</td><td>'.$val1['price'].'</td><td>'.$val1['issue_date'].'</td><td>'.$val1['return_date'].'</td><td style="color:red;">'.$fine2.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="7">No CD / DVD to return...</td></tr>';	
		echo '</tbody></table>';
		
		echo '<br>';
		echo '<table class="table table-bordered table-striped dataTable">';
		echo '<thead><tr><td>Exam NO</td><td>Subject</td><td>Year</td><td>No of Pages</td><td>Publisher Name</td><td>Issue Date</td><td>Return Date</td><td>Fine</td></tr></thead>';
		if(isset($data['exam']) && !empty($data['exam']))
		{
			foreach($data['exam'] as $val2)
			{
				$fine3=$this->diff_date($val2['return_date'],date('Y-m-d'))*1;
				echo '<tbody><tr><td>'.$val2['exam_no'].'</td><td>'.$val2['subject'].'</td><td>'.$val2['year'].'</td><td>'.$val2['no_of_page'].'</td><td>'.$val2['publisher'].'</td><td>'.$val2['issue_date'].'</td><td>'.$val2['return_date'].'</td><td style="color:red;">'.$fine3.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="7">No Exam paper to return...<td></tr>';	
		echo '</tbody></table>';
	}
	public function get_student_info_for_student_side()
	{
		$inputs = $this->input->get();
		$this->load->model('library/library_model');
		$data = $this->library_model->get_std_info_for_student($inputs['roll_no']);
		
		//echo "<pre>";
		//print_r($data);
		
		echo '<table class="table demo my_table_style time_table default footable-loaded footable">';
		echo '<thead><tr><th>Book NO</th><th>Title</th><th>Author Name</th><th>Edition</th><th>Price</th><th>Issue Date</th><th>Return Date</th><th>Returned ON</th><th>Status</th><th>Fine</th></tr></thead><tbody>';
		if(isset($data['books']) && !empty($data['books']))
		{
			foreach($data['books'] as $val)
			{
				
				if(isset($val['returned_on']) && !empty($val['returned_on']))
				{
					$curdate=strtotime($val['returned_on']);
					$mydate=strtotime($val['return_date']);
					if($mydate<$curdate)
					{
						$fine1=$val['fine'];
					}
					else
						$fine1=$val['fine'];
				}else
					$fine1=$this->diff_date($val['return_date'],date('Y-m-d'))*1;	
					
				if($val['status']==1)
					$status='Returned';
				else
					$status='Pending';		
				
				echo '<tr><td>'.$val['book_id'].'</td><td>'.$val['book_title'].'</td><td>'.$val['author_name'].'</td><td>'.$val['edition'].'</td><td>'.$val['price'].'</td><td style="color:green;">'.$val['issue_date'].'</td><td style="color:red;">'.$val['return_date'].'</td><td style="color:red;">'.$val['returned_on'].'</td><td>'.$status.'</td><td style="color:blue;">'.$fine1.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="8">No books taken...</td></tr>';	
		echo '</tbody></table>';
		echo '<br>';
		echo '<table class="table demo my_table_style time_table default footable-loaded footable">';
		echo '<thead><tr><th>CD NO</th><th>Title</th><th>Edition</th><th>Price</th><th>Issue Date</th><th>Return Date</th><th>Returned ON</th><th>Status</th><th>Fine</th></tr></thead><tbody>';
		if(isset($data['cd']) && !empty($data['cd']))
		{
			foreach($data['cd'] as $val1)
			{
				if(isset($val1['returned_on']) && !empty($val1['returned_on']))
				{
					$curdate=strtotime($val1['returned_on']);
					$mydate=strtotime($val1['return_date']);
					if($mydate<$curdate)
					{
						$fine2=$val1['fine'];
					}
					else
						$fine2=$val1['fine'];
					
				}else
					$fine2=$this->diff_date($val1['return_date'],date('Y-m-d'))*1;	
					
				if($val1['status']==1)
					$status1='Returned';
				else
					$status1='Pending';	
				echo '<tr><td>'.$val1['cd_no'].'</td><td>'.$val1['cd_title'].'</td><td>'.$val1['edition'].'</td><td>'.$val1['price'].'</td><td style="color:green;">'.$val1['issue_date'].'</td><td style="color:red;">'.$val1['return_date'].'</td><td style="color:red;">'.$val1['returned_on'].'</td><td>'.$status1.'</td><td style="color:blue;">'.$fine2.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="7">No CD / DVD taken...</td></tr>';	
		echo '</tbody></table>';
		echo '<br>';
		
		echo '<table class="table demo my_table_style time_table default footable-loaded footable">';
		echo '<thead><tr><th>Exam NO</th><th>Subject</th><th>Year</th><th>No of Pages</th><th>Publisher Name</th><th>Issue Date</th><th>Return Date</th><th>Returned ON</th><th>Status</th><th>Fine</th></tr></thead><tbody>';
		if(isset($data['exam']) && !empty($data['exam']))
		{
			foreach($data['exam'] as $val2)
			{
				if(isset($val2['returned_on']) && !empty($val2['returned_on']))
				{
					$curdate=strtotime($val2['returned_on']);
					$mydate=strtotime($val2['return_date']);
					if($mydate<$curdate)
					{
						$fine3=$val2['fine'];
					}
					else
						$fine3=$val2['fine'];
					
					
				}else
					$fine3=$this->diff_date($val2['return_date'],date('Y-m-d'))*1;	
					
				if($val2['status']==1)
					$status2='Returned';
				else
					$status2='Pending';	
				echo '<tr><td>'.$val2['exam_no'].'</td><td>'.$val2['subject'].'</td><td>'.$val2['year'].'</td><td>'.$val2['no_of_page'].'</td><td>'.$val2['publisher'].'</td><td style="color:green;">'.$val2['issue_date'].'</td><td style="color:red;">'.$val2['return_date'].'</td><td style="color:red;">'.$val2['returned_on'].'</td><td>'.$status2.'</td><td style="color:blue;">'.$fine3.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="7">No Exam paper taken...<td></tr>';	
		echo '</tbody></table>';
	}
	function insert_book_issue()
	{
		$inputs = $this->input->get();
		$this->load->model('library/library_model');
		$this->library_model->insert_book_issue($inputs);
		$data = $this->library_model->get_std_info($inputs['student_id']);
	
		echo '<table class="table table-bordered table-striped dataTable">';
		echo '<thead><tr><td>Book NO</td><td>Title</td><td>Author Name</td><td>Edition</td><td>Price</td><td>Issue Date</td><td>Return Date</td><td>Fine</td></tr></thead>';
		if(isset($data['books']) && !empty($data['books']))
		{
			foreach($data['books'] as $val)
			{
				$fine1=$this->diff_date($val['return_date'],date('Y-m-d'))*1;
				echo '<tbody><tr><td>'.$val['book_id'].'</td><td>'.$val['book_title'].'</td><td>'.$val['author_name'].'</td><td>'.$val['edition'].'</td><td>'.$val['price'].'</td><td>'.$val['issue_date'].'</td><td>'.$val['return_date'].'</td><td style="color:red;">'.$fine1.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="8">No books to return...</td></tr>';	
		echo '</tbody></table>';
		echo '<br>';
		echo '<table class="table table-bordered table-striped dataTable">';
		echo '<thead><tr><td>CD NO</td><td>Title</td><td>Edition</td><td>Price</td><td>Issue Date</td><td>Return Date</td><td>Fine</td></tr></thead>';
		if(isset($data['cd']) && !empty($data['cd']))
		{
			foreach($data['cd'] as $val1)
			{
				$fine2=$this->diff_date($val1['return_date'],date('Y-m-d'))*1;
				echo '<tbody><tr><td>'.$val1['cd_no'].'</td><td>'.$val1['cd_title'].'</td><td>'.$val1['edition'].'</td><td>'.$val1['price'].'</td><td>'.$val1['issue_date'].'</td><td>'.$val1['return_date'].'</td><td style="color:red;">'.$fine2.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="8">No CD / DVD to return...</td></tr>';	
		echo '</tbody></table>';
		
		echo '<br>';
		echo '<table class="table table-bordered table-striped dataTable">';
		echo '<thead><tr><td>Exam NO</td><td>Subject</td><td>Year</td><td>No of Pages</td><td>Publisher Name</td><td>Issue Date</td><td>Return Date</td><td>Fine</td></tr></thead>';
		if(isset($data['exam']) && !empty($data['exam']))
		{
			foreach($data['exam'] as $val2)
			{
				$fine3=$this->diff_date($val2['return_date'],date('Y-m-d'))*1;
				echo '<tbody><tr><td>'.$val2['exam_no'].'</td><td>'.$val2['subject'].'</td><td>'.$val2['year'].'</td><td>'.$val2['no_of_page'].'</td><td>'.$val2['publisher'].'</td><td>'.$val2['issue_date'].'</td><td>'.$val2['return_date'].'</td><td style="color:red;">'.$fine3.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="8">No Exam paper to return...</td></tr>';	
		echo '</tbody></table>';
	}
	public function return_book()
	{
		$this->template->write_view('content', 'library/return_book');
        $this->template->render();    
	}
	public function insert_return_book()
	{
		$this->load->model('library/library_model');
		$inputs = $this->input->get();
		$this->library_model->update_return_books($inputs);
		
		$data = $this->library_model->get_book_info1($inputs['book_id']);
		$datas = $this->library_model->get_std_info($inputs['student_id']);
		
		
		
		$fine_amt=0;
		echo '<div class="col-lg-6">';
		echo '<div class="box box-danger">';
		echo '<div class="box-header"> <i class="fa fa-book buzz-out"></i> <h3 class="box-title">Student Books</h3></div>';
		echo '<div class="box-body" id="book_info">';
        echo '<table class="table table-bordered table-striped dataTable">';
		echo '<thead><tr><td>Book NO</td><td>Title</td><td>Author Name</td><td>Edition</td><td>Price</td><td>Issue Date</td><td>Return Date</td><td>Fine</td></tr></thead>';
		if(isset($datas['books']) && !empty($datas['books']))
		{
			foreach($datas['books'] as $val)
			{
				$fine1=$this->diff_date($val['return_date'],date('Y-m-d'))*1;
				if($inputs['number']=$val['book_id'])
					$fine_amt=$fine1;
				echo '<tbody><tr><td>'.$val['book_id'].'</td><td>'.$val['book_title'].'</td><td>'.$val['author_name'].'</td><td>'.$val['edition'].'</td><td>'.$val['price'].'</td><td>'.$val['issue_date'].'</td><td>'.$val['return_date'].'</td><td style="color:red;">'.$fine1.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="8">No books to return...</td></tr>';	
		echo '</tbody></table>';
		echo '<br>';
		echo '<table class="table table-bordered table-striped dataTable">';
		echo '<thead><tr><td>CD NO</td><td>Title</td><td>Edition</td><td>Price</td><td>Issue Date</td><td>Return Date</td><td>Fine</td></tr></thead><tbody>';
		if(isset($datas['cd']) && !empty($datas['cd']))
		{
			foreach($datas['cd'] as $val1)
			{
				$fine2=$this->diff_date($val1['return_date'],date('Y-m-d'))*1;
				if($inputs['number']=$val1['cd_no'])
					$fine_amt=$fine2;
				echo '<tr><td>'.$val1['cd_no'].'</td><td>'.$val1['cd_title'].'</td><td>'.$val1['edition'].'</td><td>'.$val1['price'].'</td><td>'.$val1['issue_date'].'</td><td>'.$val1['return_date'].'</td><td style="color:red;">'.$fine2.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="8">No CD / DVD to return...</td></tr>';	
		echo '</tbody></table>';
		
		echo '<br>';
		echo '<table class="table table-bordered table-striped dataTable">';
		echo '<thead><tr><td>Exam NO</td><td>Subject</td><td>Year</td><td>No of Pages</td><td>Publisher Name</td><td>Issue Date</td><td>Return Date</td><td>Fine</td></tr></thead><tbody>';
		if(isset($datas['exam']) && !empty($datas['exam']))
		{
			foreach($datas['exam'] as $val2)
			{
				$fine3=$this->diff_date($val2['return_date'],date('Y-m-d'))*1;
				if($inputs['number']=$val2['exam_no'])
					$fine_amt=$fine3;
				echo '<tr><td>'.$val2['exam_no'].'</td><td>'.$val2['subject'].'</td><td>'.$val2['year'].'</td><td>'.$val2['no_of_page'].'</td><td>'.$val2['publisher'].'</td><td>'.$val2['issue_date'].'</td><td>'.$val2['return_date'].'</td><td style="color:red;">'.$fine3.'</td></tr>';
			}
		}
		else
			echo '<tr><td colspan="8">No Exam paper to return...</td></tr>';	
		echo '</tbody></table>';
        echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '<div class="col-lg-6">';
		echo '<div class="box box-success">';
		echo '<div class="box-header"> <i class="fa fa-book buzz-out"></i> <h3 class="box-title">Details</h3></div>';
		echo '<div class="box-body" id="student_book_list">';
		if(isset($data) && !empty($data))
		{
			if($data[0]['from']=='books')
			{
				echo '<table class="staff_table1">
					  	<tr><td>Book NO</td><td class="text_bold"><b>'.$data[0]['isbn_no'].'</b></td></tr>
						<tr><td>Title</td><td class="text_bold">'.$data[0]['book_title'].'</td></tr>
						<tr><td>Author Name</td><td class="text_bold">'.$data[0]['author_name'].'</td></tr>
						<tr><td>Edition</td><td class="text_bold">'.$data[0]['edition'].'</td></tr>
						<tr><td>Price</td><td class="text_bold">'.$data[0]['price'].'</td></tr>
						<tr><td>No of Pages</td><td class="text_bold">'.$data[0]['no_of_pages'].'</td></tr>
						<tr><td>Publisher Name</td><td class="text_bold">'.$data[0]['pub_name'].'</td></tr>
						<tr><td>Publisher Address</td><td class="text_bold">'.$data[0]['pub_address'].'</td></tr>
					  </table>';
			}
			elseif($data[0]['from']=='cd')
			{
				echo '<table class="staff_table1">
					  	<tr><td>CD NO</td><td class="text_bold">'.$data[0]['cd_no'].'</td></tr>
						<tr><td>Title</td><td class="text_bold">'.$data[0]['cd_title'].'</td></tr>
						<tr><td>Edition</td><td class="text_bold">'.$data[0]['edition'].'</td></tr>
						<tr><td>Price</td><td class="text_bold">'.$data[0]['price'].'</td></tr>
						<tr><td>Publisher Name</td><td class="text_bold">'.$data[0]['pub_name'].'</td></tr>
						<tr><td>Publisher Address</td><td class="text_bold">'.$data[0]['pub_address'].'</td></tr>
					  </table>';
			}
			elseif($data[0]['from']=='exam')
			{
				echo '<table class="staff_table1">
					  	<tr><td>Exam Paper NO</td><td class="text_bold">'.$data[0]['exam_no'].'</td></tr>
						<tr><td>Subject</td><td class="text_bold">'.$data[0]['subject'].'</td></tr>
						<tr><td>Year</td><td class="text_bold">'.$data[0]['year'].'</td></tr>
						<tr><td>No of Pages</td><td class="text_bold">'.$data[0]['no_of_page'].'</td></tr>
						<tr><td>Publisher Name</td><td class="text_bold">'.$data[0]['publisher'].'</td></tr>
					  </table>';
			}
		
		}
		else
		{
			echo '<div class="empty_details">Details not available...</div>';
		}
		echo '</div>';
		echo '</div>';
		echo '</div>';
		
		
	}































//jaga code add	
//This code for manage books Start
	public function manage_books()
	{
		$this->load->model('library/library_model');
		$data["book_type"]=$this->library_model->get_all_book_type();
		$data["rack"]=$this->library_model->get_all_book_rack();
		$data["all_book"]=$this->library_model->get_all_book_lib();
		//echo "<pre>";print_r($data);exit;
		$this->template->write_view('content', 'library/manage_books',$data);
        $this->template->render();        
	}
	public function insert_manage_book()
	{
		$this->load->model('library/library_model');
		$input=$this->input->post();
		//echo "<pre>";print_r($input);exit;
		$insert=array(
		'acc_no'=>$input['value1'],
		'isbn_no'=>$input['value2'],
		'book_title'=>$input['value3'],
		'book_type_id'=>$input['value4'],
		'author_name'=>$input['value5'],
		'purchase_date'=>$input['value6'],
		'edition'=>$input['value7'],
		'price'=>$input['value8'],
		'no_of_pages'=>$input['value9'],
		'billno'=>$input['value10'],
		'pub_name'=>$input['value11'],
		'pub_address'=>$input['value12'],
		'pub_email'=>$input['value13'],
		'pub_contact_no'=>$input['value14'],
		'book_rack'=>$input['value15'],
		'rack_row'=>$input['value16']);
		$data["book_type"]=$this->library_model->get_all_book_type();
		$data["rack"]=$this->library_model->get_all_book_rack();			
		$this->library_model->insert_manage_book_mo($insert);
		$data["all_book"]=$this->library_model->get_all_book_lib();
		//echo "<pre>";print_r($data['details']);exit;
		echo $this->load->view('book_view_table',$data);
	    //redirect($this->config->item('base_url').'library/manage_book');
	}
	public function edit_book($id)
	{
		//print_r($id);exit;
		$this->load->model('library/library_model');
		$data["book_type"]=$this->library_model->get_all_book_type();
		$data["rack"]=$this->library_model->get_all_book_rack();
		$data["details"]=$this->library_model->get_book_all_by_id($id);
		//echo "<pre>";print_r($data);exit;
		$this->template->write_view('content', 'library/edit_book',$data);
        $this->template->render();        
	}
	public function view_book($id)
	{
		//print_r($id);exit;
		$this->load->model('library/library_model');
		$data["book_type"]=$this->library_model->get_all_book_type();
		$data["rack"]=$this->library_model->get_all_book_rack();
		$data["details"]=$this->library_model->get_book_all_by_id($id);
		//echo "<pre>";print_r($data);exit;
		$this->template->write_view('content', 'library/view_book',$data);
        $this->template->render();        
	}
	public function update_book($id)
	{
		$this->load->model('library/library_model');
		$input=$this->input->post();
		//echo "<pre>";print_r($input);exit;
		$insert=array(
		'acc_no'=>$input['acc_no'],
		'isbn_no'=>$input['isbn_no'],
		'book_title'=>$input['book_title'],
		'book_type_id'=>$input['book_type'],
		'author_name'=>$input['authore'],
		'purchase_date'=>$input['purchase'],
		'edition'=>$input['edition'],
		'price'=>$input['price'],
		'no_of_pages'=>$input['page_no'],
		'billno'=>$input['bill_no'],
		'pub_name'=>$input['publisher'],
		'pub_address'=>$input['publisher_add'],
		'pub_email'=>$input['email_id'],
		'pub_contact_no'=>$input['conta_num'],
		'book_rack'=>$input['select_rack'],
		'rack_row'=>$input['book_row']);
		$data["book_type"]=$this->library_model->get_all_book_type();
		$data["rack"]=$this->library_model->get_all_book_rack();			
		$this->library_model->update_by_book($insert,$id);
		$data["all_book"]=$this->library_model->get_all_book_lib();
		//echo "<pre>";print_r($data);exit;
		 redirect($this->config->item('base_url').'library/manage_books',$data);
	 //  echo $this->load->view('',$data);//echo $this->load->view('book_view_table',$data);
	}
	  public function delete_book()
	{
			$this->load->model('library/library_model');
			$id=$this->input->post('value1');
			//print_r($id);
			$this->library_model->delete_book_by_id($id);
			$data["book_type"]=$this->library_model->get_all_book_type();
		$data["rack"]=$this->library_model->get_all_book_rack();
		$data["all_book"]=$this->library_model->get_all_book_lib();
			echo $this->load->view('book_view_table',$data);
			//redirect($this->config->item('base_url').'library/manage_examination');
	}
	
	
//This code for manage books end	
	
	
	
	
//This code for manage Cd's Start	
	public function manage_cd()
	{
		$this->load->model('library/library_model');
		$data["language"]=$this->library_model->get_all_language();
		$data["category"]=$this->library_model->get_all_category();
		$data["details"]=$this->library_model->get_cd_all();
		//echo "<pre>";print_r($data);exit;
		$data["rack"]=$this->library_model->get_all_book_rack();
		//print_r($data);
		$this->template->write_view('content', 'library/manage_cd',$data);
        $this->template->render();        
	}
	public function insert_manage_cd()
	{
		$this->load->model('library/library_model');
		$input=$this->input->get();
		
		$insert=array(
		'cd_title'=>$input['value1'],
		'book_type_id'=>$input['value2'],
		'lang'=>$input['value3'],
		'cd_no'=>$input['value4'],
		'price'=>$input['value5'],
		'date_of_receipt'=>$input['value6'],
		'date_of_purchase'=>$input['value7'],
		'edition'=>$input['value8'],
		'billno'=>$input['value9'],
		'pub_name'=>$input['value10'],
		'pub_email'=>$input['value11'],
		'pub_address'=>$input['value12'],
		'rack'=>$input['value14'],
		'row'=>$input['value15'],
		'pub_contact_no'=>$input['value13']);
		
		
				
		$this->library_model->insert_manage_cd($insert);
		$data["details"]=$this->library_model->get_cd_all();
		$data["rack"]=$this->library_model->get_all_book_rack();
	    echo $this->load->view('cd_view_table',$data);
	}
	public function edit_cd($id)
	{
		$this->load->model('library/library_model');
		$data["language"]=$this->library_model->get_all_language();
		$data["category"]=$this->library_model->get_all_category();
		$data["details"]=$this->library_model->get_cd_all_by_id($id);
		//echo "<pre>";print_r($data);exit;
		$data["rack"]=$this->library_model->get_all_book_rack();
		//print_r($data);
		$this->template->write_view('content', 'library/edit_cd',$data);
        $this->template->render();        
	}
	public function update_cd($id)
	{
		//echo $id;exit;
		$this->load->model('library/library_model');
		$input=$this->input->post();
		//echo "<pre>";print_r($input);exit;
		//$id=$input['id'];
		$insert=array(
		'cd_title'=>$input['cd_title'],
		'book_type_id'=>$input['category'],
		'lang'=>$input['language'],
		'cd_no'=>$input['cd_no'],
		'price'=>$input['price'],
		'date_of_receipt'=>$input['receipt'],
		'date_of_purchase'=>$input['purchase'],
		'edition'=>$input['editition'],
		'billno'=>$input['bill_number'],
		'pub_name'=>$input['pub_name'],
		'pub_email'=>$input['pub_add'],
		'pub_address'=>$input['email_id'],
		'rack'=>$input['rack'],
		'row'=>$input['row'],
		'pub_contact_no'=>$input['con_num']);
		$this->library_model->update_manage_cd($insert,$id);
		$data["details"]=$this->library_model->get_cd_all();
	    redirect($this->config->item('base_url').'library/manage_cd',$data);	
	}
	 public function delete_cd()
	{
			$this->load->model('library/library_model');
			$id=$this->input->post('value1');
			//print_r($id);
			$this->library_model->delete_cd_by_id($id);
			$data["details"]=$this->library_model->get_cd_all();
			echo $this->load->view('cd_view_table',$data);
			//redirect($this->config->item('base_url').'library/manage_examination');
	}
	
	
	
//This code for manage Cd's end	
// this code for Examination Paper Code Start	
	public function manage_examination()
	{
		$this->load->model('library/library_model');
		$data["details"]=$this->library_model->get_paper_all();
		$data["rack"]=$this->library_model->get_all_book_rack();
		$this->template->write_view('content', 'library/manage_examination',$data);
        $this->template->render();        
	}
	public function insert_manage_expr()
	{
		$this->load->model('library/library_model');
		$input=$this->input->post();
		$data["rack"]=$this->library_model->get_all_book_rack();
		$insert=array('exam_no'=>$input['value5'],'subject'=>$input['value1'],'year'=>$input['value2'],'no_of_page'=>$input['value3'],'publisher'=>$input['value4'],'rack'=>$input['value6'],'row'=>$input['value7']);
		$this->library_model->insert_manage_expr_mo($insert);
		$data["details"]=$this->library_model->get_paper_all();
	    echo $this->load->view('ex_view_table',$data);
	}
	public function update_paper()
	{
		$this->load->model('library/library_model');
		$input=$this->input->post();
		$id=$input['value1'];
		$data["rack"]=$this->library_model->get_all_book_rack();
		//print_r($id);exit;
		$insert=array('exam_no'=>$input['value6'],'subject'=>$input['value2'],'year'=>$input['value3'],'no_of_page'=>$input['value4'],'publisher'=>$input['value5'],'rack'=>$input['value7'],'row'=>$input['value8']);
		$this->library_model->update_manage_expr_mo($insert,$id);
		$data["details"]=$this->library_model->get_paper_all();
		echo $this->load->view('ex_view_table',$data);
		//print_r($input);exit;
	}
	
	   public function delete_exam_paper()
	{
			$this->load->model('library/library_model');
			$id=$this->input->post('value1');
			//print_r($id);
			$this->library_model->delete_exam_paper_by_id($id);
			$data["details"]=$this->library_model->get_paper_all();
			echo $this->load->view('ex_view_table',$data);
			//redirect($this->config->item('base_url').'library/manage_examination');
	}
	
	
//jaga code end here	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */