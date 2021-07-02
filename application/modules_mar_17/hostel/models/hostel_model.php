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
 
class Hostel_model extends CI_Model{

    private $table_name	= 'fees_info';	
	private $table_name1= 'fees_details';	
	private $table_name2= 'master_fees_details';	
	private $table_name3= 'student';	
	private $table_name4= 'student_fees';	
	private $table_name5= 'student_other_fees';	
	private $table_name6= 'master_hostel_block';	
	private $table_name7= 'hostel_rooms';	
	private $table_name8= 'hostel_student_rooms';	
	private $table_name9= 'master_hostel_advance';	
	private $table_name10= 'hostel_student_advance';	
	private $table_name11= 'hostel_monthly_fees';	
	private $table_name12= 'hostel_monthly_fees_details';	
	private $table_name13= 'hostel_student_monthly_fees';

	function __construct()
	{
		parent::__construct();

	}
	
	function get_student_hostel_details($roll_no)
	{
		$this->db->select($this->table_name3.'.*');
		$this->db->select('student_details.*');
		$this->db->select('batch.from,batch.to,batch.id as batch_id');
		$this->db->select('department.department,department.nickname,department.id as depart_id');
		$this->db->select('group.group,group.id as group_id');
		$this->db->where($this->table_name3.'.std_id',$roll_no);
		$this->db->join('batch','batch.id='.$this->table_name3.'.batch_id');	
		$this->db->join('student_group','student_group.student_id='.$this->table_name3.'.id');
		$this->db->join('group','group.id=student_group.group_id');		
		$this->db->join('department','department.id=student_group.depart_id');	 
		$this->db->join('student_details','student_details.student_id='.$this->table_name3.'.id');	 
		$query = $this->db->get($this->table_name3)->result_array();
		
		return $query;
	}
	function get_all_hostel_room($gender,$block)
	{
		$this->db->select($this->table_name6.'.*');
		$this->db->select('hostel_rooms.id,room_name');
		$this->db->where($this->table_name6.'.block_for',$gender);
		$this->db->where($this->table_name6.'.id',$block);
		$this->db->join('hostel_rooms','hostel_rooms.block_id='.$this->table_name6.'.id');	
		$query = $this->db->get($this->table_name6)->result_array();
		return $query;
	}
	function get_all_suggested_room_room($gender,$std_id,$info,$block)
	{
		$this->db->select($this->table_name6.'.*');
		$this->db->select('hostel_rooms.id,room_name,no_of_seat');
		$this->db->where($this->table_name6.'.block_for',$gender);
		$this->db->where($this->table_name6.'.id',$block);
		$this->db->join('hostel_rooms','hostel_rooms.block_id='.$this->table_name6.'.id');	
		$query = $this->db->get($this->table_name6)->result_array();
		$j=0;
		foreach($query as $val)
		{
			for($i=1;$i<=$val['no_of_seat'];$i++)
			{
				$this->db->where($this->table_name8.'.room_id',$val['id']);
				$this->db->where($this->table_name8.'.seat_no','seat'.$i);	 
				$available=$this->db->get($this->table_name8)->result_array();
				if(empty($available))
				$query[$j]['seat_available']='available';
				
				$this->db->select('student.name');
				$this->db->where($this->table_name8.'.room_id',$val['id']);
				$this->db->where($this->table_name8.'.seat_no','seat'.$i);
				
				$this->db->where('batch.id',$info['batch_id']);
				$this->db->where('department.id',$info['depart_id']);
				$this->db->where('group.id',$info['group_id']);
				
				$this->db->join('student','student.id='.$this->table_name8.'.user_id');
				$this->db->join('student_group','student_group.student_id='.$this->table_name8.'.user_id');		
				$this->db->join('batch','batch.id=student_group.batch_id');		
				$this->db->join('department','department.id=student_group.depart_id');	
				$this->db->join('group','group.id=student_group.group_id');		
				$available_for_same_section = $this->db->get($this->table_name8)->result_array();
				if(isset($available_for_same_section) && !empty($available_for_same_section))
				$query[$j]['same_section']='available';
				
			}
			$j++;
		}
		//echo "<pre>"; print_r($query); exit;
		return $query;
	
	}
	function get_all_seat_by_room_id($room_id)
	{
		$this->db->select($this->table_name7.'.*');
		$this->db->where('id',$room_id);
		$query = $this->db->get($this->table_name7)->result_array();
		//echo "<pre>"; print_r($query); exit;
		$j=0;
		for($i=1;$i<=$query[0]['no_of_seat'];$i++)
		{
		
			$this->db->select('student.name,student.id,student.std_id');
			$this->db->select('batch.from,to');
			$this->db->select('department.department,department.nickname');
			$this->db->select('group.group');
			$this->db->select($this->table_name8.'.id as seat_id');
			$this->db->where($this->table_name8.'.room_id',$query[0]['id']);
			$this->db->where($this->table_name8.'.seat_no','seat'.$i);
			$this->db->join('student','student.id='.$this->table_name8.'.user_id');
			$this->db->join('student_group','student_group.student_id='.$this->table_name8.'.user_id');		
			$this->db->join('batch','batch.id=student_group.batch_id');		
			$this->db->join('department','department.id=student_group.depart_id');	
			$this->db->join('group','group.id=student_group.group_id');		
			 
			$query[0]['seat_info'][] = $this->db->get($this->table_name8)->result_array();
			$j++;
		}
		//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	function delete_user_by_id($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete($this->table_name8);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	function delete_user_by_id1($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table_name8);	
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	function delete_user_by_id_for_user_id($id)
	{
		$this->db->where('user_id', $id);
		$this->db->delete($this->table_name8);	
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	
	function insert_seat($data)
	{
		if ($this->db->insert($this->table_name8, $data)) {
			$id = $this->db->insert_id();
			
			return array('id' => $id);
		}
		return false;
	}
	function update_hostel($data,$id)
	{
		$this->db->where('id', $id);
		
			if ($this->db->update($this->table_name6, $data)) {
				
				return true;
			}
			return false;
	}
	function get_room_id($id)
	{
		$this->db->select('room_id');
		$this->db->where('user_id',$id);	 
		return $this->db->get($this->table_name8)->result_array();
	}
	function get_advance_amt_check()
	{
		$this->db->select('*');	 
		return $this->db->get($this->table_name9)->result_array();
	}
	function insert_advance($data)
	{
		if ($this->db->insert($this->table_name10, $data)) {
			$id = $this->db->insert_id();
			
			return array('id' => $id);
		}
		return false;
	}
	function update_student_admission($data,$id)
	{
		$this->db->where('roll_no', $id);
		
			if ($this->db->update($this->table_name10, $data)) {
				
				return true;
			}
			return false;
	}
	function get_advance_amt_by_roll_no($id)
	{
		$this->db->select('amount');
		$this->db->where('roll_no',$id);	 
		return $this->db->get($this->table_name10)->result_array();
	}
	function insert_hostel($data)
	{
		$this->db->insert($this->table_name6,$data);
	}
	
	function get_all_hostel_details()
	{
		$this->db->select('*');	
		//$this->db->where('hostel_type',0);
		$this->db->order_by('id','desc');
		return $this->db->get($this->table_name6)->result_array();
	}
	function get_all_hostel_details1()
	{
		$this->db->select('*');	
		$this->db->where('hostel_type',0);
		$this->db->order_by('id','desc');
		return $this->db->get($this->table_name6)->result_array();
	}
	function get_all_hostel_details2()
	{
		$this->db->select('*');	
		$this->db->where('hostel_type',1);
		$this->db->order_by('id','desc');
		return $this->db->get($this->table_name6)->result_array();
	}
	function get_all_hostel($gender)
	{
		$this->db->select('*');
		$this->db->where('block_for',$gender);	 
		return $this->db->get($this->table_name6)->result_array();
	}
	function get_advance_amt($id)
	{
		$this->db->select('total_amount,per_day,hostel_type');
		$this->db->where('id',$id);	 
		return $this->db->get($this->table_name6)->result_array();
	}
	function checking_student_admission($roll_no)
	{
		$this->db->select('*');
		$this->db->where('roll_no',$roll_no);	 
		return $this->db->get($this->table_name10)->result_array();
	}
	
	function get_all_student_advance()
	{
		$this->db->select($this->table_name10.'.*');
		$this->db->select('student.id,std_id,name,email_id,student_type,image');
		$this->db->select('batch.from,batch.to,batch.id as batch_id');
		$this->db->select('department.department,department.nickname,department.id as depart_id');
		$this->db->select('group.group');
		$this->db->select('master_hostel_block.block as hostel_name');
		$this->db->join('student','student.std_id='.$this->table_name10.'.roll_no');
		$this->db->join('batch','batch.id=student.batch_id');	
		$this->db->join('student_group','student_group.student_id=student.id');
		$this->db->join('group','group.id=student_group.group_id');		
		$this->db->join('department','department.id=student_group.depart_id');	
		$this->db->join('master_hostel_block','master_hostel_block.id='.$this->table_name10.'.block_id'); 
		$query= $this->db->get($this->table_name10)->result_array();
		//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	function get_all_student_room_details()
	{
		$this->db->select($this->table_name10.'.*');
		$this->db->select('student.id,std_id,name,email_id,student_type,image');
		$this->db->select('batch.from,batch.to,batch.id as batch_id');
		$this->db->select('department.department,department.nickname,department.id as depart_id');
		$this->db->select('group.group');
		$this->db->select('master_hostel_block.block as hostel_name,master_hostel_block.id as hostel_id');
		$this->db->select('hostel_student_rooms.seat_no,user_id');
		$this->db->select('hostel_rooms.room_name');
		$this->db->join('student','student.std_id='.$this->table_name10.'.roll_no');
		$this->db->join('batch','batch.id=student.batch_id');	
		$this->db->join('student_group','student_group.student_id=student.id');
		$this->db->join('hostel_student_rooms','hostel_student_rooms.user_id=student.id');
		$this->db->join('hostel_rooms','hostel_rooms.id=hostel_student_rooms.room_id');
		$this->db->join('group','group.id=student_group.group_id');		
		$this->db->join('department','department.id=student_group.depart_id');	
		$this->db->join('master_hostel_block','master_hostel_block.id='.$this->table_name10.'.block_id'); 
		return $this->db->get($this->table_name10)->result_array();
	}
	function get_sutent_list_for_hostel($atten_inputs) // this is for getting the student list by autocompleate ajax method
	{	
		$this->db->select('*');	
		$this->db->where('hostel',1);		
		$this->db->like('std_id',$atten_inputs['q']);
		$this->db->where('master_hostel_block.hostel_type',0);		  
		$this->db->join('hostel_student_advance','hostel_student_advance.roll_no=student.std_id');
		$this->db->join('master_hostel_block','master_hostel_block.id=hostel_student_advance.block_id'); 			
		$query= $this->db->get('student')->result_array();	
		return $query;
	}
	function get_sutent_list_for_hostel1($atten_inputs) // this is for getting the student list by autocompleate ajax method
	{	
		$this->db->select('*');	
		$this->db->where('hostel',1);		
		$this->db->like('std_id',$atten_inputs['q']);
		$this->db->where('master_hostel_block.hostel_type',0);		  
		$this->db->join('hostel_student_advance','hostel_student_advance.roll_no=student.std_id');
		$this->db->join('master_hostel_block','master_hostel_block.id=hostel_student_advance.block_id'); 			
		$query= $this->db->get('student')->result_array();	
		return $query;
	}
	function get_sutent_list_for_hostel1_last($atten_inputs) // this is for getting the student list by autocompleate ajax method
	{	
		$this->db->select('*');	
		$this->db->where('hostel',1);		
		$this->db->like('std_id',$atten_inputs['q']);
		//$this->db->where('master_hostel_block.hostel_type',0);		  
		$this->db->join('hostel_student_advance','hostel_student_advance.roll_no=student.std_id');
		$this->db->join('master_hostel_block','master_hostel_block.id=hostel_student_advance.block_id'); 			
		$query= $this->db->get('student')->result_array();	
		return $query;
	}
	function get_sutent_list_for_hostel2($atten_inputs) // this is for getting the student list by autocompleate ajax method
	{	
		$this->db->select('*');	
		$this->db->where('hostel',1);		
		$this->db->like('std_id',$atten_inputs['q']);
		$this->db->where('master_hostel_block.hostel_type',0);		  
		$this->db->join('hostel_student_advance','hostel_student_advance.roll_no=student.std_id');
		$this->db->join('master_hostel_block','master_hostel_block.id=hostel_student_advance.block_id'); 			
		$query= $this->db->get('student')->result_array();	
		return $query;
	}
	function get_no_of_student($id)
	{
		$this->db->where('block_id',$id);	 
		return $this->db->get($this->table_name10)->num_rows();
	}
	
	function get_hostel()
	{
		$this->db->select('*');
		/*$this->db->select('master_hostel_block.block');
		$this->db->join('master_hostel_block','master_hostel_block.id='.$this->table_name7.'.block_id');*/ 
		$query = $this->db->get($this->table_name6);
			if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}


	function get_room()
	{
		$this->db->select('*');
		/*$this->db->select('master_hostel_block.block');
		$this->db->join('master_hostel_block','master_hostel_block.id='.$this->table_name7.'.block_id');*/
		$query = $this->db->get($this->table_name7);
			if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
function checking_Update($id,$block_id,$room_name,$no_of_seat)
	{
		$this->db->select('*');
		$this->db->where('block',$id);
		$this->db->where('id !=', $id);
		$query = $this->db->get($this->table_name6);
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	
	}
	
	
	function insert_room($data)
	{
		$this->db->insert($this->table_name7,$data);
	}
function update_room($data,$id)
	{
	  $this->db->where('id',$id);
	   if ($this->db->update($this->table_name7, $data)){
		return true;
	   }
	   return false;
	}
	
	function get_hostel_details()
	{
		$this->db->select($this->table_name7.'.*');
		$this->db->select('master_hostel_block.block');
		$this->db->join('master_hostel_block','master_hostel_block.id='.$this->table_name7.'.block_id'); 
		$query= $this->db->get($this->table_name7)->result_array();
	//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	
	function get_hostel_room()
	{
		$this->db->select('*');
		$query = $this->db->get($this->table_name7);
			if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}

	function insert_monthly_fees($data)
	{
		if ($this->db->insert($this->table_name11, $data)) {
			$id = $this->db->insert_id();
			
			return array('id' => $id);
		}
		return false;
	}
	function insert_monthly_fees_details($data)
	{
		if ($this->db->insert($this->table_name12, $data)) {
			return true;
		}
		return false;
	}
	function get_all_monthly_fees()
	{
		$this->db->select($this->table_name11.'.*');
		$this->db->select('master_hostel_block.block');
		$this->db->join('master_hostel_block','master_hostel_block.id='.$this->table_name11.'.block_id'); 
		return $this->db->get($this->table_name11)->result_array();
	}
	function get_student_monthly_fees($roll_no)
	{
		$this->db->select($this->table_name10.'.*');
		$this->db->select('master_hostel_block.block');
		$this->db->join('master_hostel_block','master_hostel_block.id='.$this->table_name10.'.block_id'); 
		$this->db->where($this->table_name10.'.roll_no',$roll_no);
		$query=$this->db->get($this->table_name10)->result_array();
		$i=0;
		foreach($query as $val)
		{
			$this->db->select($this->table_name11.'.*');
			$this->db->where($this->table_name11.'.block_id',$val['block_id']);
			$query[$i]['monthly_fees']=$this->db->get($this->table_name11)->result_array();
			$j=0;
			foreach($query[$i]['monthly_fees'] as $val1)
			{
				$this->db->select($this->table_name13.'.*');
				$this->db->where($this->table_name13.'.monthly_fees_id',$val1['id']);
				$this->db->where($this->table_name13.'.roll_no',$roll_no);
				$query[$i]['monthly_fees'][$j]['payment_details']=$this->db->get($this->table_name13)->result_array();
				$j++;
			}
			$i++;
		}
		return $query;
	}
	function insert_student_monthly_fees($data)
	{
		if ($this->db->insert($this->table_name13, $data)) {
			return true;
		}
		return false;
	}

	function get_student_admission_details($id)
	{
		$this->db->select($this->table_name3.'.*');
		$this->db->select('hostel_student_advance.*');
		$this->db->select('student_details.*');
		$this->db->select('batch.from,batch.to,batch.id as batch_id');
		$this->db->select('department.department,department.nickname,department.id as depart_id');
		$this->db->select('group.group,group.id as group_id');
		$this->db->where($this->table_name3.'.std_id',$id);
		$this->db->join('batch','batch.id='.$this->table_name3.'.batch_id');	
		$this->db->join('student_group','student_group.student_id='.$this->table_name3.'.id');
		$this->db->join('group','group.id=student_group.group_id');		
		$this->db->join('department','department.id=student_group.depart_id');	 
		$this->db->join('student_details','student_details.student_id='.$this->table_name3.'.id');	
		$this->db->join('hostel_student_advance','hostel_student_advance.roll_no='.$this->table_name3.'.std_id');
		$query = $this->db->get($this->table_name3)->result_array();
		$i=0;
		foreach($query as $val)
		{
			$this->db->select('master_hostel_block.block,hostel_type,per_day');
			$this->db->where('master_hostel_block.id',$val['block_id']);
			$query[$i]['block']=$this->db->get('master_hostel_block')->result_array(); 
			$i++;
		}
		//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	function get_all_hostel_name_for_report()
	{
		$this->db->select('master_hostel_block.block,master_hostel_block.id');
		$this->db->group_by($this->table_name11.'.block_id');
		$this->db->join('master_hostel_block','master_hostel_block.id='.$this->table_name11.'.block_id'); 
		return $this->db->get($this->table_name11)->result_array();
	}
	function get_all_year_by_hostel_id($id)
	{
		$this->db->select('year');
		$this->db->where('block_id',$id);
		$this->db->group_by('year');
		return $this->db->get($this->table_name11)->result_array();
	}
	function get_all_month_by_hostel_id($id,$year)
	{
		$this->db->select('month');
		$this->db->where('block_id',$id);
		$this->db->where('year',$year);
		return $this->db->get($this->table_name11)->result_array();
	}
	function get_monthly_report($data)
	{
		$this->db->select($this->table_name11.'.*');
		$this->db->where($this->table_name11.'.block_id',$data['h_id']);
		$this->db->where($this->table_name11.'.month',$data['month']);
		$this->db->where($this->table_name11.'.year',$data['year']);
		$this->db->select('master_hostel_block.block,master_hostel_block.hostel_type');
		$this->db->join('master_hostel_block','master_hostel_block.id='.$this->table_name11.'.block_id'); 
		$query=$this->db->get($this->table_name11)->result_array();
		
		$i=0;
		foreach($query as $val)
		{
			$this->db->select('roll_no');
			$this->db->select('student.name,image');
			$this->db->select('hostel_student_rooms.seat_no');
			$this->db->select('hostel_rooms.room_name');
			$this->db->select('hostel_student_advance.amount as advance_amount');
			$this->db->join('student','student.std_id=hostel_student_advance.roll_no');
			$this->db->select('batch.from,batch.to');
			$this->db->select('department.department,department.nickname');
			$this->db->select('group.group');
			$this->db->join('batch','batch.id=student.batch_id');	
			$this->db->join('student_group','student_group.student_id=student.id');
			$this->db->join('group','group.id=student_group.group_id');		
			$this->db->join('department','department.id=student_group.depart_id');
			
			$this->db->join('hostel_student_rooms','hostel_student_rooms.user_id=student.id');	
			$this->db->join('hostel_rooms','hostel_rooms.id=hostel_student_rooms.room_id');	
			$this->db->where('hostel_student_advance.block_id',$val['block_id']);
			$query[$i]['roll_no']=$this->db->get('hostel_student_advance')->result_array();
			$j=0;
			foreach($query[$i]['roll_no'] as $val1)
			{
				$this->db->select('*');
				$this->db->where('hostel_student_monthly_fees.monthly_fees_id',$val['id']);
				$this->db->where('hostel_student_monthly_fees.roll_no',$val1['roll_no']);	
				$query[$i]['roll_no'][$j]['payment_details']=$this->db->get('hostel_student_monthly_fees')->result_array();
				$j++;
			} 
			$i++;
			
		}
		return $query;
	}

	function view_hostel_fees1($id,$roll_no)
	{
		$this->db->select('master_hostel_block.block,master_hostel_block.id');
		$this->db->select($this->table_name11.'.*');
		$this->db->where($this->table_name11.'.id',$id);
		$this->db->join('master_hostel_block','master_hostel_block.id='.$this->table_name11.'.block_id'); 
		$query=$this->db->get($this->table_name11)->result_array();
		$j=0;
		foreach($query as $val1)
		{
			$this->db->select($this->table_name13.'.*');
			$this->db->where($this->table_name13.'.monthly_fees_id',$val1['id']);
			$this->db->where($this->table_name13.'.roll_no',$roll_no);
			$query[$j]['monthly_fees']=$this->db->get($this->table_name13)->result_array();
			$j++;
		}
		return $query;
	}

	function get_monthly_fees_details($id)
	{
		$this->db->select($this->table_name11.'.*');
		$this->db->select('master_hostel_block.block');
		$this->db->where($this->table_name11.'.id',$id);
		$this->db->join('master_hostel_block','master_hostel_block.id='.$this->table_name11.'.block_id');	
		$query = $this->db->get($this->table_name11)->result_array();
		$i=0;
		foreach($query as $val)
			{
				$this->db->select('*');
				$this->db->where('hostel_monthly_fees_details.monthly_fees_id',$val['id']);
					
				$query[$i]['bill_details']=$this->db->get('hostel_monthly_fees_details')->result_array();
				$i++;
			} 
		//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	function delete_monthly_fees($m_id)
	{
		$this->db->where('monthly_fees_id', $m_id);
		$this->db->delete($this->table_name12);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}
	function update_monthly_fees($data,$id)
	{
		$this->db->where('id', $id);
		
			if ($this->db->update($this->table_name11, $data)) {
				
				return array('id' => $id);
			}
			return false;
	}
	function view_student_hostel_details($id,$hostel)
	{
		$this->db->select($this->table_name3.'.*');
		$this->db->select('student_details.*');
		$this->db->select('hostel_student_rooms.room_id,block_id,seat_no');
		$this->db->select('batch.from,batch.to,batch.id as batch_id');
		$this->db->select('department.department,department.nickname,department.id as depart_id');
		$this->db->select('group.group,group.id as group_id');
		$this->db->where($this->table_name3.'.id',$id);
		$this->db->join('batch','batch.id='.$this->table_name3.'.batch_id');	
		$this->db->join('student_group','student_group.student_id='.$this->table_name3.'.id');
		$this->db->join('group','group.id=student_group.group_id');		
		$this->db->join('department','department.id=student_group.depart_id');
		$this->db->join('student_details','student_details.student_id='.$this->table_name3.'.id');
		$this->db->join('hostel_student_rooms','hostel_student_rooms.user_id='.$this->table_name3.'.id');	 
		$query = $this->db->get($this->table_name3)->result_array();
		$i=0;
		foreach($query as $val)
			{
				$this->db->select('hostel_rooms.room_name');
				$this->db->where('hostel_rooms.id',$val['room_id']);
				$query[$i]['room']=$this->db->get('hostel_rooms')->result_array();
				$this->db->select('master_hostel_block.block');
				$this->db->where('master_hostel_block.id',$hostel);
				$query[$i]['block']=$this->db->get('master_hostel_block')->result_array();
				$i++;
			} 
		//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	function add_duplicate_hostel($input)
	{
		
		$this->db->select('*');
		$this->db->where('block',$input);
		$query=$this->db->get('master_hostel_block');
			
			if ($query->num_rows() >= 1) {
				return $query->result_array();
			}
	}
	function update_duplicate_hostel($input,$id)
	{
		
		$this->db->select('*');
		$this->db->where('block',$input);
		$this->db->where('id !=',$id);
		$query=$this->db->get('master_hostel_block');
			
			if ($query->num_rows() >= 1) {
				return $query->result_array();
			}
	}
	
	function check_duplicate_room($hostelname,$roomno)
	{
		/*echo $hostelname;
		echo $roomno;
		exit;*/
		$this->db->select('*');
		$this->db->where('block_id',$hostelname);
		$this->db->where('room_name',$roomno);
		$query=$this->db->get('hostel_rooms');
		//print_r($query);exit;	
			if ($query->num_rows() >= 1) {
				return $query->result_array();
			}
		
	}
	function non_dividing_student_report($h_id)
	{
		$this->db->select($this->table_name10.'.*');
		$this->db->select('hostel_rooms.room_name,hostel_student_rooms.seat_no');
		$this->db->select('master_hostel_block.per_day');
		$this->db->select('student.name,image,std_id');	
		$this->db->select('batch.from,batch.to,batch.id as batch_id');
		$this->db->select('department.nickname');
		$this->db->select('group.id,group');
		$this->db->where($this->table_name10.'.block_id',$h_id);
		$this->db->join('master_hostel_block','master_hostel_block.id='.$this->table_name10.'.block_id');	
		$this->db->join('student','student.std_id='.$this->table_name10.'.roll_no');
		$this->db->join('student_group','student_group.student_id=student.id');
		$this->db->join('batch','batch.id=student_group.batch_id');	
		$this->db->join('group','group.id=student_group.group_id');
		$this->db->join('department','department.id=student_group.depart_id'); 
		$this->db->join('hostel_student_rooms','hostel_student_rooms.user_id=student.id'); 
		$this->db->join('hostel_rooms','hostel_rooms.id=hostel_student_rooms.room_id'); 
		$query = $this->db->get($this->table_name10)->result_array();
		return $query;
	}

}
