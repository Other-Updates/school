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
 
class Assignment_model extends CI_Model{

    private $table_name	= 'assignment';	
	 private $table_name1= 'subject_details';
	  private $table_name2= 'assignment_details';
	  private $table_name3= 'student_group';
	  private $table_name4= 'staff';
	  private $table_name5= 'batch';
	  private $table_name6= 'department';	

	function __construct()
	{
		parent::__construct();

	}
	
	function get_semester()
	{
		$this->db->select('*');
		$this->db->where('df',0);
		$this->db->where('status',1);
	$query = $this->db->get('semester');
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}	
	}
	function get_semester_staff($staff)
	{
		
		$this->db->select('subject_details.subject_name,nick_name');
		$this->db->select('semester.*');
		$this->db->where('subject_details.df',0);
		$this->db->where('staff_id',$staff);
		$this->db->join('semester','semester.id=subject_details.semester_id');
		$this->db->group_by('semester.id');
		$query = $this->db->get('subject_details')->result_array();
		return $query;
		
	}
	function get_batch()
	{
		
		$this->db->select('*');
		$this->db->where('df',0);
		$this->db->where('status',1);
		$query = $this->db->get('batch')->result_array();
		return $query;
		
	}
	function get_batch_staff($staff)
	{
		
		$this->db->select('subject_details.subject_name,nick_name');
		$this->db->select('batch.*');
		$this->db->where('subject_details.df',0);
		$this->db->where('staff_id',$staff);
		$this->db->join('batch','batch.id=subject_details.batch_id');
		$this->db->group_by('batch.id');
		$query = $this->db->get('subject_details')->result_array();
		return $query;
		
	}
	
	function get_sem($batch)
	{
		
		$this->db->select('subject_details.semester_id');
		$this->db->select('semester.*');
		$this->db->where('subject_details.df',0);
		$this->db->where('batch_id',$batch);
		$this->db->join('semester','semester.id=subject_details.semester_id');
		$this->db->group_by('semester.id');
		$query = $this->db->get('subject_details')->result_array();
		return $query;
		
	}
	
	
	
	// assignment 
	function get_batch_for_assignment()
	{
		$this->db->select('batch.*');
		$this->db->where('batch.df',0);
		$this->db->where('batch.status',1);
		$this->db->where('assignment.status',0);
		$this->db->join('assignment','assignment.batch_id=batch.id');
		$this->db->group_by('batch.id');
		$query = $this->db->get('batch');
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}	
	}
	function get_semester_for_assignment()
	{
		$this->db->select('semester.*');
		$this->db->where('assignment.status',0);
		  $this->db->join('assignment','assignment.semester_id=semester.id');
		  $this->db->group_by('semester.id');
		  $query = $this->db->get('semester')->result_array();
		  /*echo "<pre>";
		print_r($query);
		exit;*/
		  return $query;
	}
	function get_department_for_assignment()
	{
		$this->db->select('department.*');
		$this->db->where('assignment.status',0);
		  $this->db->join('assignment','assignment.depart_id=department.id');
		  $this->db->group_by('department.id');
		  $query = $this->db->get('department')->result_array();
		  /*echo "<pre>";
		print_r($query);
		exit;*/
		  return $query;
	}

	function get_subject_department($where)
	{
		$this->db->select('*');
		
  	$this->db->where($where);
	$query = $this->db->get('subject_details');
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}	
	}
	function get_subject_group($where1)
	{
		$this->db->select('*');
  		$this->db->where($where1);
		$this->db->where('scode !=','');
		$this->db->where('grade_point !=',0);
		$this->db->where('df',0);
		
	$query = $this->db->get('subject_details');
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}	
	}
	function get_subject_group_for_assignment($where1)
	{
		$this->db->select('subject_details.*');
  		$this->db->where($where1);
		$this->db->where('df',0);
		$this->db->join('assignment','assignment.subject_id=subject_details.id');
		$this->db->group_by('subject_details.id');
		$query = $this->db->get('subject_details')->result_array();
		/*echo "<pre>";
		print_r($query);
		exit;*/
			return $query;
		
	}
	function get_department()
	{
		$this->db->select('*');
		
		$this->db->where('df',0);
		$this->db->where('status',1);
	$query = $this->db->get('department');		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
	}
	function get_department_staff($staff)
	{
		
		$this->db->select('subject_details.subject_name,nick_name');
		$this->db->select('department.*');
		$this->db->where('subject_details.df',0);
		$this->db->where('staff_id',$staff);
		$this->db->join('department','department.id=subject_details.depart_id');
		$this->db->group_by('department.id');
		$query = $this->db->get('subject_details')->result_array();
		return $query;
		
	}
	
	function get_group($id)
	{
		$this->db->select('*');
		$this->db->where('depart_id',$id);
		$this->db->where('df',0);
		$this->db->where('status',1);
	$query = $this->db->get('group');
		
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}	
	}
	function get_group_for_assignment($id)
	{
		$this->db->select('group.*');
		$this->db->where('group.depart_id',$id);
		$this->db->where('group.df',0);
		$this->db->where('group.status',1);
		$this->db->join('assignment','assignment.group_id=group.id');
		$this->db->group_by('group.id');
	$query = $this->db->get('group')->result_array();
		
		/*echo "<pre>";
		    print_r($query);
			  exit;*/
			return $query;
		
	}
	function get_assignment_number($where)
	{
		$this->db->select("count(ass_number) as ass_number");
		
  		$this->db->where($where);
		$this->db->where('status',0);
		$query = $this->db->get('assignment')->result_array();
		
		/*echo "<pre>";
		    print_r($query);
			  exit;*/
		return $query;
	}
	function get_assignment($id)
	{ 
		
		  $this->db->select($this->table_name.'.*');
		  $this->db->select('batch.from,batch.to');
		  $this->db->select('staff.staff_name');
		  $this->db->select('subject_details.subject_name,nick_name');
		  $this->db->select('semester.semester');
		  $this->db->select('department.department,nickname');
		  $this->db->where($this->table_name.'.status',0);
		  $this->db->where($this->table_name.'.subject_id',$id);
		  $this->db->join('batch','batch.id='.$this->table_name.'.batch_id');
		  $this->db->join('staff','staff.id='.$this->table_name.'.staff_id');
		 
		  $this->db->join('semester','semester.id='.$this->table_name.'.semester_id');
		  $this->db->join('department','department.id='.$this->table_name.'.depart_id');
		  $this->db->join('subject_details','subject_details.id='.$this->table_name.'.subject_id');
		  $query = $this->db->get($this->table_name)->result_array();
		  $i=0;
		  foreach($query as $row)
		  {
			  if($row['staff_type']=='admin')
			   {
				 $this->db->select('admin.name as name');
				 $this->db->where('id',$row['staff_id']);
				 $query[$i]['staff']=$this->db->get('admin')->result_array(); 
			   }
			     else
				 {
				$this->db->select('staff.staff_name as name');
				 $this->db->where('id',$row['staff_id']);
				 $query[$i]['staff']=$this->db->get('staff')->result_array();
				 }
				 $this->db->select('group.group');
				 $this->db->where('id',$row['group_id']);
				 $query[$i]['group']=$this->db->get('group')->result_array(); 
			  
			 $i++; 
		  }
		//echo "<pre>"; print_r($query); exit;
		  return $query;
	}
	function get_assignment_for_admin()
	{
				 
		  $this->db->select($this->table_name.'.*');
		  $this->db->select('batch.from,batch.to');
		  
		  $this->db->select('subject_details.subject_name,nick_name');
		  $this->db->select('semester.semester');
		  $this->db->select('department.department,nickname');
		  $this->db->where($this->table_name.'.status',0);
		
		  $this->db->join('batch','batch.id='.$this->table_name.'.batch_id');
		  
		 
		  $this->db->join('semester','semester.id='.$this->table_name.'.semester_id');
		  $this->db->join('department','department.id='.$this->table_name.'.depart_id');
		  $this->db->join('subject_details','subject_details.id='.$this->table_name.'.subject_id');
		  $query = $this->db->get($this->table_name)->result_array();
		  $i=0;
		  foreach($query as $row)
		  {
			  if($row['staff_type']=='admin')
			   {
				 $this->db->select('admin.name as name');
				 $this->db->where('id',$row['staff_id']);
				 $query[$i]['staff']=$this->db->get('admin')->result_array(); 
			   }
			     else
				 {
				$this->db->select('staff.staff_name as name');
				 $this->db->where('id',$row['staff_id']);
				 $query[$i]['staff']=$this->db->get('staff')->result_array();
				 }
			  
				 $this->db->select('group.group');
				 $this->db->where('id',$row['group_id']);
				 $query[$i]['group']=$this->db->get('group')->result_array(); 
			  
			 $i++; 
		  }
		  /*echo "<pre>";
		    print_r($query);
			  exit;*/
		
		  return $query;
	}
	function get_assignment_byid($id)
	{
				 
		$this->db->select($this->table_name.'.*');
		  $this->db->select('batch.from,batch.to');
		  $this->db->select('staff.staff_name');
		  //$this->db->select('group.group');
		  $this->db->select('semester.semester');
		  $this->db->select('department.department,nickname');
		  $this->db->where($this->table_name.'.status',0);
		  $this->db->where($this->table_name.'.subject_id',$id);
		  
		  $this->db->join('batch','batch.id='.$this->table_name.'.batch_id');
		  $this->db->join('staff','staff.id='.$this->table_name.'.staff_id');
		  //$this->db->join('group','group.id='.$this->table_name.'.group_id');
		  $this->db->join('semester','semester.id='.$this->table_name.'.semester_id');
		  $this->db->join('department','department.id='.$this->table_name.'.depart_id');
		 // $status=$this->db->query("select assign_id from assignment_details where std_id='$student_id'");
		 //$this->db->where_not_in($this->table_name.'.id',$status);
		  $query = $this->db->get($this->table_name)->result_array();
		   $i=0;
		  foreach($query as $row)
		  {
			  
			  
				 $this->db->select('group.group');
				 $this->db->where('id',$row['group_id']);
				 $query[$i]['group']=$this->db->get('group')->result_array(); 
			  
			 $i++; 
		  }
		  return $query;
	}
	// by assignment id
	function get_assignment_by_id($id)
	{
				 
		$this->db->select($this->table_name.'.*');
		  $this->db->select('batch.from,batch.to');
		  $this->db->select('staff.staff_name');
		  $this->db->select('subject_details.subject_name,nick_name');
		  $this->db->select('semester.semester');
		  $this->db->select('department.department,nickname');
		  $this->db->where($this->table_name.'.status',0);
		  $this->db->where($this->table_name.'.id',$id);
		  
		  $this->db->join('batch','batch.id='.$this->table_name.'.batch_id');
		  $this->db->join('staff','staff.id='.$this->table_name.'.staff_id');
		  $this->db->join('subject_details','subject_details.id='.$this->table_name.'.subject_id');
		  $this->db->join('semester','semester.id='.$this->table_name.'.semester_id');
		  $this->db->join('department','department.id='.$this->table_name.'.depart_id');
		 
		  $query = $this->db->get($this->table_name)->result_array();
		   $i=0;
		  foreach($query as $row)
		  {
			  
			  
				 $this->db->select('group.group');
				 $this->db->where('id',$row['group_id']);
				 $query[$i]['group']=$this->db->get('group')->result_array(); 
			  
			 $i++; 
		  }
		  return $query;
	}
	
	/**
	 * Get ur_title by id (id)
	 *
	 * @param	int
	 * @return	array
	 */
	function get_student_subject($s_id,$sem_id)
	{
		$this->db->select('*');
		$this->db->where('staff_id', $s_id);
		$this->db->where('semester_id', $sem_id);
		$this->db->where('df',0);
		$query = $this->db->get('subject_details')->result_array();
		/*echo "<pre>";
		    print_r($query);
			  exit;*/
		return $query;
	
		
	}
	
	function get_student_assignment_number($where1)
	{
		$this->db->select('*');
  		$this->db->where($where1);
		$this->db->where('status',0);		
	$query = $this->db->get('assignment')->result_array();
		return $query;
	}
	/**
	 * Insert new ur_title
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function insert_assignment($data)
	{
		if ($this->db->insert($this->table_name, $data)) {
			$history_id = $this->db->insert_id();
			
			return array('id' => $history_id);
		}
		return false;
	}
	function view_assignment_by_id($staff_id,$id)
	{
		$this->db->select($this->table_name.'.*');
		  $this->db->select('batch.from,batch.to');
		  $this->db->select('staff.staff_name');
		  $this->db->select('subject_details.subject_name,nick_name');
		  $this->db->select('semester.semester');
		  $this->db->select('department.department,nickname');
		  $this->db->where($this->table_name.'.staff_id',$staff_id);
		  $this->db->where($this->table_name.'.id',$id);
		  $this->db->where($this->table_name.'.status',0);
		  
		  $this->db->join('batch','batch.id='.$this->table_name.'.batch_id');
		  $this->db->join('staff','staff.id='.$this->table_name.'.staff_id');
		 // $this->db->join('group','group.id='.$this->table_name.'.group_id');
		  $this->db->join('semester','semester.id='.$this->table_name.'.semester_id');
		  $this->db->join('department','department.id='.$this->table_name.'.depart_id');
		  $this->db->join('subject_details','subject_details.id='.$this->table_name.'.subject_id');
		  $query = $this->db->get($this->table_name)->result_array();
		  $i=0;
		  foreach($query as $row)
		  {
			  
			  
				 $this->db->select('group.group');
				 $this->db->where('id',$row['group_id']);
				 $query[$i]['group']=$this->db->get('group')->result_array(); 
			  
			 $i++; 
		  }
		
		  return $query;
	}
	/**
	 * Update a ur_title
	 *
	 * @param	array
	 * @param	int
	 * @return	bool
	 */
	function update_assignment($data,$id)
	{
		$this->db->where('id', $id);
		
		if ($this->db->update($this->table_name, $data)) {
			
			return true;
		}
		return false;
	}
	
	/**
	 * Delete a ur_title
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_assignment($id)
	{
		$this->db->where('id', $id);
			
			if ($this->db->update($this->table_name, $data=array('status'=>1))) {
				
				return true;
			}
			return false;
	}
	function delete_assignment_details($id)
	{
		$this->db->where('assign_id', $id);
			
			if ($this->db->update($this->table_name2, $data=array('status'=>1))) {
				
				return true;
			}
			return false;
	}
	function insert_student_assignment($data)
	{
		if ($this->db->insert($this->table_name2, $data)) {
			$history_id = $this->db->insert_id();
			
			return array('id' => $history_id);
		}
		return false;
	}
	function get_student_assignmnt_for_mark($ass_id,$student_id)
	{
		$this->db->select('*');
		
		$this->db->where('student_id',$student_id);
		//$this->db->where('assign_id',$ass_id);
	
		$query = $this->db->get('student_group')->result_array();
		 
		  /*$this->db->join('assignment_details','assignment_details.assign_id='.$this->table_name.'.id');
		  $query = $this->db->get($this->table_name)->result_array();*/
		   
		 
		  foreach($query as $row)
		  {
			 
				 $this->db->select('std_id,name,last_name');
				 $this->db->where('student.id',$student_id);
				 $query[0]['std_details']=$this->db->get('student')->result_array();
				 $this->db->select('from,to');
				   $this->db->where('id',$row['batch_id']);
				   $query[0]['batch'] = $this->db->get('batch')->result_array();
				   $this->db->select('department,nickname');
				   $this->db->where('id',$row['depart_id']);
				   $query[0]['department'] = $this->db->get('department')->result_array();
				   $this->db->select('group');
				   $this->db->where('id',$row['group_id']);
				   $query[0]['group'] = $this->db->get('group')->result_array();
				   $this->db->select('*');
				   $this->db->where('id',$ass_id);
				   $query[0]['ass_details'] = $this->db->get('assignment')->result_array();
			  	   $this->db->select('*');
				   $this->db->where('assign_id',$ass_id);
				   $this->db->where('std_id',$student_id);
				   $query[0]['assign'] = $this->db->get('assignment_details')->result_array();
			 
		  }
		    /*echo "<pre>";
		    print_r($query);
			  exit;*/
		  return $query;
	}
	//$staff_type,$staff_id,$batch_id,$department_id,$group_id,$sem_id,$subject_id,$ass_number
	function get_submitted_assignment_by_subid($staff_type,$staff_id,$batch_id,$department_id,$group_id,$sem_id,$sub_id,$ass_number)
	{
		$this->db->select('*');
		
		$where=array(
				  'batch_id'=>$batch_id,
				  'depart_id'=> $department_id,
				  'group_id'=> $group_id
				  );
  				$this->db->where($where);
		  $this->db->join('batch','batch.id=student_group.batch_id');
		  $this->db->join('department','department.id=student_group.depart_id');
		  
		  $query = $this->db->get('student_group')->result_array();
		   $i=0;
		   foreach($query as $row)
		   {
			   $this->db->select('assignment.id,assignment.total,assignment.question,assignment.ldt,assignment.due_date,assignment.ass_number,assignment.ass_type,assignment.ass_number,assignment.close_status');
			 
			$where=
				  array(
				  'batch_id'=>$batch_id,
				  'depart_id'=> $department_id,
				  'group_id'=> $group_id,
				  
				  'subject_id'=> $sub_id,
				  'ass_number'=>$ass_number,
				  'status'=>0
				  );
			
			 
  				$this->db->where($where);
			
			$query[$i]['ass_details']=$this->db->get('assignment')->result_array(); 
			if(isset($query[$i]['ass_details']) && !empty($query[$i]['ass_details']))
			{
				 $this->db->select('*');
				 $this->db->where('std_id',$row['student_id']);
				 $this->db->where('assign_id',$query[$i]['ass_details'][0]['id']);
				 $query[$i]['ass_file']=$this->db->get('assignment_details')->result_array();
			}
			   $this->db->select('group');
			   $this->db->where('id',$row['group_id']);
			   $query[$i]['group'] = $this->db->get('group')->result_array();
			   $this->db->select('std_id,name,last_name');
			   $where=
				  array(
				  'id'=>$row['student_id'],
				  'df'=> 0,
				  'status'=> 1,
				  
				  );
  				$this->db->where($where);
			   $query[$i]['student'] = $this->db->get('student')->result_array();
			   $this->db->select('id,semester');
			   $this->db->where('id',$sem_id);
			   $query[$i]['semester'] = $this->db->get('semester')->result_array();
			   $this->db->select('id,subject_name,nick_name');
			   $this->db->where('id',$sub_id);
			   $query[$i]['subject'] = $this->db->get('subject_details')->result_array();
			   	$i++;
		   }
		 
		    /*echo "<pre>";
		    print_r($query);
			 exit;*/
		  return $query;
		
	}
	function update_student_assignment($data,$student_id,$id)
	{
		$this->db->where('assign_id', $id);
		$this->db->where('std_id', $student_id);
		if ($this->db->update($this->table_name2, $data)) {
			
			return true;
		}
		return false;
		
	}
	public function insert_assignment_mark($student_id,$ass_id,$marks)
    {
       $this->db->where('assign_id', $ass_id);
		$this->db->where('std_id', $student_id);
		if ($this->db->update($this->table_name2, $marks)) {
			
			return true;
		}
		return false; 
    }
	public function get_subject_by_staff($staff)
	{
		$this->db->select('*');
		$this->db->where('staff_id',$staff);
		$query = $this->db->get('subject_details');
		if ($query->num_rows() >= 1) 
		{
			return $query->result_array();
		}
		
	}
	public function get_students_from_group($where)
	{
		$this->db->select('*');
		$this->db->where($where);
		$query = $this->db->get('student_group');
		if ($query->num_rows() >= 1) 
		{
			return $query->result_array();
		}
	}
	function insert_assignment_details($data)
	{
		if ($this->db->insert($this->table_name2, $data)) {
			$history_id = $this->db->insert_id();
			
			return array('id' => $history_id);
		}
		return false;
	}
	function insert_mark_for_non_upload($student_id,$assign_id,$marks)
	{
		$this->db->where('assign_id', $assign_id);
		$this->db->where('std_id', $student_id);
		if ($this->db->update($this->table_name2, $marks)) {
			
			return true;
		}
		return false; 
	}
	function update_close_status($assign_id,$status)
	{
		$this->db->where('id', $assign_id);
		
		if ($this->db->update($this->table_name, $status)) {
			
			return true;
		}
		return false;
	}
}