<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin_model
 *
 * This model represents admin access. It operates the following tables:
 * admin,
 *
 * @package	i2_soft
 * @author	Elavarasan
 */
 
class Library_model extends CI_Model{

   
     private $table_name	= 'admin';	
	 private $table_name1	= 'designation';
	 private $table_name2	= 'mark_details';
	 private $table_name3	= 'college_calenar';
	 private $table_name4	= 'notice_board';
	 private $table_name5	= 'library_exam_papers';
	 private $table_name6	= 'library_books';
	 private $table_name7	= 'library_cd';
	 private $table_name8	= 'lib_book_type';
	 private $table_name9	= 'library_book_rack';
	 private $table_name10	= 'library_book_language';
	 private $table_name11	= 'lib_book_category';
	function __construct()
	{
		parent::__construct();

	}
	//Search booking @author Elavarasan
	function get_search_result($data)
	{
		
		if($data['search_opt']=='books')
		{
			$this->db->select('*');		 
			$this->db->like('book_title',$data['search_value']);
			$this->db->or_like('isbn_no',$data['search_value']);
			$this->db->or_like('author_name',$data['search_value']);
			$this->db->or_like('pub_name',$data['search_value']);		
			$this->db->or_like('pub_address',$data['search_value']);		 
			$query = $this->db->get('library_books')->result_array();
			$i=0;
			foreach($query as $val)
			{
				$this->db->select('library_issue.*,student.name');		 
				$this->db->where('book_id',$val['isbn_no']); 
				$this->db->where('library_issue.status',1); 
				$this->db->join('student','student.std_id=library_issue.student_id'); 
				$query[$i]['issue_user'] = $this->db->get('library_issue')->result_array();
				$i++;
			}
			return $query;
		}
		else if($data['search_opt']=='cd')
		{
			$this->db->select('*');		 
			$this->db->like('cd_title',$data['search_value']);
			$this->db->or_like('edition',$data['search_value']);
			$this->db->or_like('pub_name',$data['search_value']);
			$this->db->or_like('pub_address',$data['search_value']);		 
			$query = $this->db->get('library_cd')->result_array();
			$i=0;
			foreach($query as $val)
			{
				$this->db->select('library_issue.*,student.name');		 
				$this->db->where('book_id',$val['cd_no']); 
				$this->db->where('library_issue.status',1); 
				$this->db->join('student','student.std_id=library_issue.student_id'); 
				$query[$i]['issue_user'] = $this->db->get('library_issue')->result_array();
				$i++;
			}
			return $query;
		}
		else if($data['search_opt']=='exam_papers')
		{
			$this->db->select('*');		 
			$this->db->like('exam_no',$data['search_value']);
			$this->db->or_like('subject',$data['search_value']);
			$this->db->or_like('year',$data['search_value']);
			$this->db->or_like('publisher',$data['search_value']);			 
			$query = $this->db->get('library_exam_papers')->result_array();
			$i=0;
			foreach($query as $val)
			{
				$this->db->select('library_issue.*,student.name');		 
				$this->db->where('book_id',$val['exam_no']); 
				$this->db->where('library_issue.status',1); 
				$this->db->join('student','student.std_id=library_issue.student_id'); 
				$query[$i]['issue_user'] = $this->db->get('library_issue')->result_array();
				$i++;
			}
			return $query;
		}
	}
	function get_all_book_cd_exam_no($atten_inputs)
	{
		$this->db->select('isbn_no as no');			
		$this->db->like('isbn_no',$atten_inputs['q']); 
		$this->db->where('status',1);       			
		$query1= $this->db->get('library_books')->result_array();	
		//print_r($query1);
		$this->db->select('cd_no as no');			
		$this->db->like('cd_no',$atten_inputs['q']);   	
		$this->db->where('status',1);    		
		$query2= $this->db->get('library_cd')->result_array();
		//print_r($query2);
		$this->db->select('exam_no as no');			
		$this->db->like('exam_no',$atten_inputs['q']);  
		$this->db->where('status',1);     			
		$query3= $this->db->get('library_exam_papers')->result_array();	
		//print_r($query3);
		return array_merge($query1,$query2,$query3);
	}
	function get_all_book_cd_exam_no1($atten_inputs)
	{
		$this->db->select('isbn_no as no');			
		$this->db->like('isbn_no',$atten_inputs['q']); 
		$this->db->where('status',2);       			
		$query1= $this->db->get('library_books')->result_array();	
		//print_r($query1);
		$this->db->select('cd_no as no');			
		$this->db->like('cd_no',$atten_inputs['q']);   	
		$this->db->where('status',2);    		
		$query2= $this->db->get('library_cd')->result_array();
		//print_r($query2);
		$this->db->select('exam_no as no');			
		$this->db->like('exam_no',$atten_inputs['q']);  
		$this->db->where('status',2);     			
		$query3= $this->db->get('library_exam_papers')->result_array();	
		//print_r($query3);
		return array_merge($query1,$query2,$query3);
	}
	function get_std_id_by_book_id($b_id)
	{
		$this->db->select('student_id');			
		$this->db->where('book_id',$b_id);    
		$this->db->where('status',1);    			
		return $this->db->get('library_issue')->result_array();	
	}
	function get_book_info($no)
	{
		$this->db->select('*');			
		$this->db->where('isbn_no',$no);    
		$this->db->where('status',1);    			
		$query1= $this->db->get('library_books')->result_array();	
		if(isset($query1) && !empty($query1))
		{
			$query1[0]['from']='books';
			return $query1;
		}
		//print_r($query1);
		$this->db->select('*');			
		$this->db->where('cd_no',$no);   	
		$this->db->where('status',1);  		
		$query2= $this->db->get('library_cd')->result_array();
		if(isset($query2) && !empty($query2))
		{
			$query2[0]['from']='cd';
			return $query2;
		}
		//print_r($query2);
		$this->db->select('*');			
		$this->db->where('exam_no',$no);  
		$this->db->where('status',1);   			
		$query3= $this->db->get('library_exam_papers')->result_array();	
		if(isset($query3) && !empty($query3))
		{
			$query3[0]['from']='exam';
			return $query3;
		}
	}
	function get_book_info1($no)
	{
		$this->db->select('*');			
		$this->db->where('isbn_no',$no);    
		$this->db->where('status',2);    			
		$query1= $this->db->get('library_books')->result_array();	
		if(isset($query1) && !empty($query1))
		{
			$query1[0]['from']='books';
			return $query1;
		}
		//print_r($query1);
		$this->db->select('*');			
		$this->db->where('cd_no',$no);   	
		$this->db->where('status',2);  		
		$query2= $this->db->get('library_cd')->result_array();
		if(isset($query2) && !empty($query2))
		{
			$query2[0]['from']='cd';
			return $query2;
		}
		//print_r($query2);
		$this->db->select('*');			
		$this->db->where('exam_no',$no);  
		$this->db->where('status',2);   			
		$query3= $this->db->get('library_exam_papers')->result_array();	
		if(isset($query3) && !empty($query3))
		{
			$query3[0]['from']='exam';
			return $query3;
		}
	}
	public function get_std_info($std_no)
	{
		$re_arr=array();
		$this->db->select('*');			
		$this->db->where('library_issue.student_id',$std_no);  
		$this->db->where('library_books.status',2); 
		$this->db->where('library_issue.status',1);   	
		$this->db->join('library_books','library_books.isbn_no=library_issue.book_id'); 		
		$query1= $this->db->get('library_issue')->result_array();	
		$re_arr['books']=$query1;
		
		
		//print_r($query1);
		$this->db->select('*');			
		$this->db->where('library_issue.student_id',$std_no);  
		$this->db->where('library_cd.status',2);  
		$this->db->where('library_issue.status',1);    	
		$this->db->join('library_cd','library_cd.cd_no=library_issue.book_id'); 		
		$query2= $this->db->get('library_issue')->result_array();	
		$re_arr['cd']=$query2;
		
		
		//print_r($query2);
		$this->db->select('*');			
		$this->db->where('library_issue.student_id',$std_no);  
		$this->db->where('library_exam_papers.status',2);   
		$this->db->where('library_issue.status',1);   	
		$this->db->join('library_exam_papers','library_exam_papers.exam_no=library_issue.book_id'); 		
		$query3= $this->db->get('library_issue')->result_array();	
		$re_arr['exam']=$query3;
		
		return $re_arr;
	}
	public function get_std_info_for_student($std_no)
	{
		$re_arr=array();
		$this->db->select('*');			
		$this->db->where('library_issue.student_id',$std_no);  
		$this->db->join('library_books','library_books.isbn_no=library_issue.book_id'); 		
		$query1= $this->db->get('library_issue')->result_array();	
		$re_arr['books']=$query1;
		
		
		//print_r($query1);
		$this->db->select('*');			
		$this->db->where('library_issue.student_id',$std_no);  
		$this->db->join('library_cd','library_cd.cd_no=library_issue.book_id'); 		
		$query2= $this->db->get('library_issue')->result_array();	
		$re_arr['cd']=$query2;
		
		
		//print_r($query2);
		$this->db->select('*');			
		$this->db->where('library_issue.student_id',$std_no);  
		$this->db->join('library_exam_papers','library_exam_papers.exam_no=library_issue.book_id'); 		
		$query3= $this->db->get('library_issue')->result_array();	
		$re_arr['exam']=$query3;
		
		return $re_arr;
	}
	public function insert_book_issue($insert_data)
	{
		
		$this->db->insert('library_issue',$insert_data);
		
		$this->db->where('isbn_no',$insert_data['book_id']);
		$this->db->update('library_books',array('status'=>2));
		
		$this->db->where('cd_no',$insert_data['book_id']);
		$this->db->update('library_cd',array('status'=>2));
		
		$this->db->where('exam_no',$insert_data['book_id']);
		$this->db->update('library_exam_papers',array('status'=>2));
		
	}
	public function update_return_books($update_data)
	{
		$this->db->where('student_id',$update_data['student_id']);
		$this->db->where('book_id',$update_data['book_id']);
		$this->db->where('status',1);
		$this->db->update('library_issue',array('returned_on'=>date('d-m-Y'),'fine'=>$update_data['fine'],'comments'=>$update_data['comments'],'status'=>2));
		
		$this->db->where('status',2);
		$this->db->where('isbn_no',$update_data['book_id']);
		$this->db->update('library_books',array('status'=>1));
		
		$this->db->where('status',2);
		$this->db->where('cd_no',$update_data['book_id']);
		$this->db->update('library_cd',array('status'=>1));
		
		$this->db->where('status',2);
		$this->db->where('exam_no',$update_data['book_id']);
		$this->db->update('library_exam_papers',array('status'=>1));
		
	}
	//End comments
	function get_all_library_books()
	{
		$this->db->select('*');	
		$this->db->where('df',1);		 
		$query = $this->db->get('library_books')->result_array();
		return $query;
	}
	
//jaga code add	
//this is for Manage Exam Paper-------------------------------------------
	function insert_manage_expr_mo($data)
	{
		//print_r($data);exit;
		$query=$this->db->insert('library_exam_papers', $data);
		
		return $query;		
		
	}
	function get_paper_all()
	{
		$this->db->select('*');	
		$this->db->where('ds',0);		 
		$query = $this->db->get('library_exam_papers')->result_array();
		return $query;
		
	}
	
	function update_manage_expr_mo($data,$id)
	{
		$this->db->where('id',$id);
		
			if ($this->db->update('library_exam_papers', $data)) 
			{
				
				return true;
			}
			return false;
	}
	
	function delete_exam_paper_by_id($id)
	{
		$this->db->where('id', $id);
			
			if ($this->db->update($this->table_name5, $data=array('ds'=>1))) {
				
				return true;
			}
			return false;
		
	}
	//this is for Manage Book-------------------------------------------------
	function get_all_book_type()
	{
		$this->db->select('*');	
		//$this->db->where('ds',0);		 
		$query = $this->db->get('lib_book_type')->result_array();
		return $query;
	}
	
	function get_all_book_rack()
	{
		$this->db->select('*');	
		//$this->db->where('ds',0);		 
		$query = $this->db->get('library_book_rack')->result_array();
		return $query;
		
	}
	function get_all_book_lib()//get all book in library
	{
		$this->db->select('library_books.*');
		$this->db->select('lib_book_type.btid,book_type');
		$this->db->select(' library_book_rack.brid,bk_rack');
		$this->db->join('library_book_rack','library_book_rack.brid=library_books.book_rack');
		$this->db->join('lib_book_type','lib_book_type.btid=library_books.book_type_id');
		$this->db->where('library_books.status',1);	
		$query = $this->db->get($this->table_name6);
		//print_r($query->result_array());exit;
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
	}
	function get_book_all_by_id($id)//get all book in library
	{
		$this->db->select('library_books.*');
		$this->db->where('library_books.id',$id);
		
		$this->db->select('lib_book_type.btid,book_type');
		$this->db->select(' library_book_rack.brid,bk_rack');
		$this->db->join('library_book_rack','library_book_rack.brid=library_books.book_rack');
		$this->db->join('lib_book_type','lib_book_type.btid=library_books.book_type_id');
		$query = $this->db->get($this->table_name6);
		//print_r($query->result_array());exit;
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
	}
	
	function update_by_book($data,$id)
{
	$this->db->where('id',$id);
		
			if ($this->db->update('library_books', $data)) 
			{
				
				return true;
			}
			return false;
	
}
	
	function insert_manage_book_mo($data)
	{
		//print_r($data);exit;
		$query=$this->db->insert('library_books', $data);
		return $query;		
		
	}
	
	//Manage cd code start
	function get_all_language()
	{
		$this->db->select('*');	
		//$this->db->where('ds',0);		 
		$query = $this->db->get('library_book_language')->result_array();
		return $query;
		
	}
	function get_all_category()
	{
		$this->db->select('*');	
		//$this->db->where('ds',0);		 
		$query = $this->db->get('lib_book_category')->result_array();
		return $query;
		
	}
	function insert_manage_cd($data)
	{
		//print_r($data);exit;
		$query=$this->db->insert('library_cd', $data);
		
		return $query;		
		
	}
	function get_cd_all()
	{
		$this->db->select('library_cd.*');
		$this->db->select('library_cd.id,lang_type');	
		$this->db->select(' library_book_rack.brid,bk_rack');
		$this->db->where('ds',0);
		$this->db->join('library_book_rack','library_book_rack.brid=library_cd.rack');
		$this->db->join('library_book_language','library_book_language.id=library_cd.lang');
		//$this->db->where('ds',0);
		$query = $this->db->get('library_cd')->result_array();
		return $query;
		
	}
	function get_cd_all_by_id($id)
	{
		
		$this->db->select('library_cd.*');	
		$this->db->where('library_cd.id',$id);
		$this->db->select('library_book_rack.brid,bk_rack');
		$this->db->select('library_book_language.id as lid,lang_type');
		$this->db->join('library_book_rack','library_book_rack.brid=library_cd.rack');
		$this->db->join('library_book_language','library_book_language.id=library_cd.lang');
						 
		$query = $this->db->get('library_cd')->result_array();
		return $query;
		
	}
	function update_manage_cd($data,$id)
{
	$this->db->where('id',$id);
		
			if ($this->db->update('library_cd', $data)) 
			{
				
				return true;
			}
			return false;
	
}
	
	function delete_cd_by_id($id)
	{
		$this->db->where('id', $id);
			
			if ($this->db->update($this->table_name7, $data=array('ds'=>1))) {
				
				return true;
			}
			return false;
		
	}
	
	
	
	
	
	
//jaga	code end
	function insert_library_stock($data)
	{
		if ($this->db->insert('library_book_stock', $data)) {
			$id = $this->db->insert_id();
			
			return array('id' => $id);
		}
		return false;
	}
	
	function get_library_stocks()
	{
		$this->db->select('library_book_stock.*');
		$this->db->select('library_books.book_name');	
		$this->db->join('library_books','library_books.id=library_book_stock.book_id','left');	 
		$query = $this->db->get('library_book_stock')->result_array();
		return $query;
	}
	
	function update_library_books($data,$id)
	{
	
		$this->db->where('id', $id);
		
			if ($this->db->update('library_books', $data)) 
			{
				
				return true;
			}
			return false;
	}
	function delete_book_by_id($id)
	{
		$this->db->where('id', $id);
			
			if ($this->db->update($this->table_name6, $data=array('status'=>0))) {
				
				return true;
			}
			return false;
		
	}
	
	
}