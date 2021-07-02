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
 
class Transport_model extends CI_Model{

    private $table_name	= 'master_vehical';
	private $table_name1	= 'staff';	
	private $table_name2 = 'master_root';
	private $table_name3 = 'master_stage';
	private $table_name4 = 'bus_root_details';
	private $table_name10 = 'transport_fees';
	private $table_name11 = 'student';
	private $table_name12 = 'master_root';
	private $table_name13 = 'master_stage';
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();

	}
	function get_all_staff()
	{
		$this->db->select($this->table_name1.'.*');
		$this->db->select('designation.designation');
		$this->db->where('designation.designation','Driver');
		//$this->db->where('designation.designation','Clener');
		$this->db->join('designation','designation.id='.$this->table_name1.'.designation_id');
		$query = $this->db->get($this->table_name1);
		/*echo"<pre>";
		print_r($query);
		exit;*/
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	function get_all_cleaner()
	{
		$this->db->select($this->table_name1.'.*');
		$this->db->select('designation.designation');
		
		$this->db->where($this->table_name1.'.df', 0);
	    //$this->db->where('designation.designation','cleaner');
		$this->db->join('designation','designation.id='.$this->table_name1.'.designation_id');
		$query = $this->db->get($this->table_name1);
		/*echo"<pre>";
		print_r($query->result_array());
		exit;*/
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	function get_all_bus()
	{		
		$this->db->select($this->table_name2.'.*');
		//$this->db->group_by('bus_no'); 
		$this->db->select('master_vehical.bus_no');
		$this->db->join('master_vehical','master_vehical.id='.$this->table_name2.'.rbus_no');
		$query = $this->db->get($this->table_name2);
		/*echo "<pre>";
		print_r($query->result_array());
		exit;*/
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		}
		return false;
	}
	function get_root()
	{
		$this->db->select($this->table_name4.'.*');
		$this->db->select('bus_root_details.master_vehical_id');
	    $this->db->join('bus_root_details','bus_root_details.id='.$this->table_name4.'.rbus_no');
		$query = $this->db->get($this->table_name4);
		/*echo"<pre>";
		print_r($query->result_array());
		exit;*/
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	function insert_transport_input($data)
	{
		
		$query=$this->db->insert($this->table_name, $data);
		
		
		//return false;

	}
	function insert1_transport($data)
	{
		if ($this->db->insert($this->table_name2, $data)) {
			$options_id = $this->db->insert_id();
			return array('id' => $options_id);
		}
		
		return false;

	}
	function update_google_map_info($id,$data)
	{
	  $this->db->where('id', $id);
	  $data=array('map_details'=>$data);
	   if ($this->db->update($this->table_name2, $data)) {
		return true;
	   }
	   return false;
	}
	function get_map_info($id)
	{
	 $this->db->select('map_details');
	  $this->db->where('id', $id);
	   $query=$this->db->get($this->table_name2);
		return $query->result_array();
	  
	}
	function get_master_root()
	{
		$this->db->select($this->table_name2.'.*');
		$query = $this->db->get($this->table_name2)->result_array();
		return $query;
	}
	
	
	function get_transport()
	{
		$this->db->select($this->table_name.'.*');
		$query = $this->db->get($this->table_name)->result_array();
		$i=0;
		foreach($query as $val)
		{
			$this->db->select('staff.staff_name as driver');
			$this->db->where('id',$val['driver_id']);
			$query[$i]['driver'] = $this->db->get('staff')->result_array();
			$this->db->select('staff.staff_name as cleaner');
			$this->db->where('id',$val['cleaner_id']);
			$query[$i]['cleaner'] = $this->db->get('staff')->result_array();
			$i++;
		}
		//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	
	
	function master_stage_view()
	{
		
		$this->db->select($this->table_name3.'.*');
		$this->db->select_max('bus_fees');
		$this->db->group_by('master_stage.master_root_id'); 
		$this->db->select('master_root.id,root_name,source');
		$this->db->select('master_vehical.bus_no');
	    $this->db->join('master_root','master_root.id='.$this->table_name3.'.master_bus_id');
		$this->db->join('master_vehical','master_vehical.id='.$this->table_name3.'.master_bus_id');
		
		$query = $this->db->get($this->table_name3)->result_array();
		//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	
	
	function insert_one_transport($data)
	{
		
		if ($this->db->insert_batch($this->table_name3, $data)){
			return true;
		}
		return false;
	}
	function update_one_transport($input)
	{
		 $this->db->where('master_root_id',$input[0]['master_root_id']);
   		 $this->db->delete($this->table_name3); 
		 if ($this->db->insert_batch($this->table_name3, $input)) {
			return true;
		}
		return false;
			
	}
	
	
	
	function insert_bus_root_detail($data)
	{
		if ($this->db->insert($this->table_name3, $data)) {
			$options_id = $this->db->insert_id();
			return array('id' => $options_id);
			//print_r($options_id);exit;
		}
		
		return false;
	}
	/* Update a ur_title
	 * @param	array
	 * @param	int
	 * @return	bool
	 */
function update_1_transport($data,$id)
	{
	  $this->db->where('id', $id);
	   if ($this->db->update($this->table_name2, $data)) {
		return true;
	   }
	   return false;
	}
	function update_transport($data,$id)
	{
	  $this->db->where('id', $id);
	   if ($this->db->update($this->table_name, $data)) {
		return true;
	   }
	   return false;
	}
	function update_transport_stage($data,$id)
	{
	  $this->db->where('id', $id);
	   if ($this->db->update($this->table_name3, $data)) {
		return true;
	   }
	   return false;
	}
	function update_transport_root($data,$id)
	{
	  $this->db->where('id', $id);
	   if ($this->db->update($this->table_name3, $data)) {
		return true;
	   }
	   return false;
	}
	function search_bus_details($id)
	{
		
		$this->db->select($this->table_name2.'.*');
	    $this->db->where('rbus_no', $id);
		$query = $this->db->get($this->table_name2)->result_array();
		return $query;
	}
	function search_bus_stage($id)
	{
		
		$this->db->select($this->table_name2.'.*');
	    $this->db->where('id', $id);
		$query = $this->db->get($this->table_name2)->result_array();
		//echo "<pre>";print_r($query);exit;
		return $query;
	}
	
	function update_fees($data,$id_fee)
	{
	
		$this->db->where('id', $id_fee);
		
			if ($this->db->update($this->table_name5, $data)) 
			{
				
				return true;
			}
			return false;
	}
	function get_stage_details($id)
	{
		
		$this->db->select($this->table_name3.'.*');
	    $this->db->where('master_root_id', $id);
		$this->db->select('master_root.root_name,source');
		$this->db->select('master_vehical.bus_no');
	    $this->db->join('master_vehical','master_vehical.id='.$this->table_name3.'.master_bus_id');
	    $this->db->join('master_root','master_root.id='.$this->table_name3.'.master_bus_id','rbus_no');
		$query = $this->db->get($this->table_name3)->result_array();
		return $query;
	}
	function update_stage_details($id)
	{
		
		$this->db->select($this->table_name3.'.*');
	    $this->db->where('master_bus_id', $id);
		$this->db->select('master_vehical.bus_no');
	    $this->db->join('master_vehical','master_vehical.id='.$this->table_name3.'.master_bus_id');
		$query = $this->db->get($this->table_name3)->result_array();
		return $query;
	}
	function get_all_student_from_transport_fees($roll)
	{
		
		$this->db->select($this->table_name10.'.*');
		$this->db->select('student.id as s_id,std_id,name,email_id,student_type,image');
		$this->db->select('batch.from,batch.to,batch.id as batch_id');
		$this->db->select('department.department,department.nickname,department.id as depart_id');
		$this->db->select('group.group');
		$this->db->select('master_vehical.bus_no');
		$this->db->where('histroy', 1);
		$this->db->where('std_reg',$roll);
		$this->db->join('student','student.std_id='.$this->table_name10.'.std_reg');
		$this->db->join('batch','batch.id=student.batch_id');	
		$this->db->join('student_group','student_group.student_id=student.id');
		$this->db->join('department','department.id=student_group.depart_id');	
		$this->db->join('group','group.id=student_group.group_id');
		$this->db->join('master_vehical','master_vehical.id='.$this->table_name10.'.bus_id'); 
		$query= $this->db->get($this->table_name10)->result_array();
		return $query;
	}
	
	function get_student_list($tran_std) // this is for getting the student list by autocompleate ajax method
	{	
		$this->db->select('std_id');	
		$this->db->where('transport',1);
		$this->db->like('std_id',$tran_std['q']); 
		$this->db->group_by('std_id',$tran_std['q']); 
		$this->db->join('transport_fees','transport_fees.std_roll_num != student.std_id'); 	
		$query= $this->db->get('student')->result_array();
		return $query;	
			
	}
	function get_student_list1($tran_std) // this is for getting the student list by autocompleate ajax method
	{	
		$this->db->select('*');	
		$this->db->where('transport',1);
		$this->db->like('std_id',$tran_std['q']); 
		$this->db->group_by('std_id',$tran_std['q']);  
		$query= $this->db->get('student')->result_array();
		return $query;	
			
	}
	
	
	function get_student_list_trans($roll)
	{
	
		$this->db->select($this->table_name11.'.*');
		$this->db->select('student_details.*');
		$this->db->select('batch.from,batch.to,batch.id as batch_id');
		$this->db->select('department.department,department.nickname,department.id as depart_id');
		$this->db->select('group.group,group.id as group_id');
		$this->db->where($this->table_name11.'.std_id',$roll);
		$this->db->join('batch','batch.id='.$this->table_name11.'.batch_id');	
		$this->db->join('student_group','student_group.student_id='.$this->table_name11.'.id');
		$this->db->join('group','group.id=student_group.group_id');		
		$this->db->join('department','department.id=student_group.depart_id');	 
		$this->db->join('student_details','student_details.student_id='.$this->table_name11.'.id');	 
		$query = $this->db->get($this->table_name11)->result_array();
		return $query;
		
	}
	function get_all_root()
	{
		$this->db->select($this->table_name12.'.*');
		$query = $this->db->get($this->table_name12)->result_array();
		return $query;
		
	}
	function get_busno($source)
	{
		
		$this->db->select($this->table_name13.'.*'); 
		$this->db->select('master_vehical.bus_no');
		$this->db->where($this->table_name13.'.stage_name',$source);
		$this->db->order_by('master_bus_id', 'DESC');
		$this->db->join('master_vehical','master_vehical.id='.$this->table_name13.'.master_bus_id');
		$query = $this->db->get($this->table_name13)->result_array();
		//print_r($query); exit;
		return $query;
		
	}
	function get_busno1($source)
	{
		
		$this->db->select($this->table_name13.'.*'); 
		$this->db->select('master_vehical.bus_no');
		$this->db->select('master_root.root_name,source');
		$this->db->where($this->table_name13.'.stage_name',$source);
		$this->db->join('master_vehical','master_vehical.id='.$this->table_name13.'.master_bus_id');
		$this->db->join('master_root','master_root.id='.$this->table_name13.'.master_root_id');	
		$query = $this->db->get($this->table_name13)->result_array();
		//print_r($query); exit;
		return $query;
		
	}
	
	function get_busno2($source)
	{
		
		$this->db->select($this->table_name13.'.*'); 
		$this->db->select('master_vehical.bus_no');
		$this->db->select('master_root.root_name,source');
		$this->db->where($this->table_name13.'.stage_name',$source['stage']);
		$this->db->where($this->table_name13.'.master_bus_id',$source['bus_id']);
		$this->db->join('master_vehical','master_vehical.id='.$this->table_name13.'.master_bus_id');
		$this->db->join('master_root','master_root.id='.$this->table_name13.'.master_root_id');	
		$query = $this->db->get($this->table_name13)->result_array();
		//print_r($query); exit;
		return $query;
		
	}
	
	function get_stage($bus_id)
	{
		
		$this->db->select($this->table_name13.'.*');
		//$this->db->select('master_vehical.bus_no');
		$this->db->where($this->table_name13.'.master_bus_id',$bus_id);
		//$this->db->join('master_vehical','master_vehical.id='.$this->table_name12.'.rbus_no');	
		$query = $this->db->get($this->table_name13)->result_array();
		//print_r($query); exit;
		return $query;
		
	}
	function transport_amount($bus_id)
	{
		//print_r($bus_id); exit;
		$this->db->select('*');
		$this->db->select('master_root.root_name,source');
		$this->db->where($this->table_name13.'.master_bus_id',$bus_id['bus_id']);
		$this->db->where($this->table_name13.'.stage_name',$bus_id['stage']);
		$this->db->join('master_root','master_root.id='.$this->table_name13.'.master_root_id');	
		$query = $this->db->get($this->table_name13)->result_array();
		//print_r($query); exit;
		return $query;
	}
	function insert_transport_fees($data)
	{
		
		$this->db->insert($this->table_name10, $data);
		$id=$this->db->insert_id(); 
		return $id;
		
	}
	
	function get_student_transport_details($id)
	{
		$this->db->select($this->table_name11.'.*');
		//$this->db->select('hostel_student_advance.*');
		$this->db->select('student_details.*');
		$this->db->select('batch.from,batch.to,batch.id as batch_id');
		$this->db->select('department.department,department.nickname,department.id as depart_id');
		$this->db->select('group.group,group.id as group_id');
		$this->db->where($this->table_name11.'.std_id',$id);
		$this->db->join('batch','batch.id='.$this->table_name11.'.batch_id');	
		$this->db->join('student_group','student_group.student_id='.$this->table_name11.'.id');
		$this->db->join('group','group.id=student_group.group_id');		
		$this->db->join('department','department.id=student_group.depart_id');	 
		$this->db->join('student_details','student_details.student_id='.$this->table_name11.'.id');	
		//$this->db->join('hostel_student_advance','hostel_student_advance.roll_no='.$this->table_name3.'.std_id');
		$query = $this->db->get($this->table_name11)->result_array();
		/*$i=0;
		foreach($query as $val)
		{
			$this->db->select('master_hostel_block.block,hostel_type,per_day');
			$this->db->where('master_hostel_block.id',$val['block_id']);
			$query[$i]['block']=$this->db->get('master_hostel_block')->result_array(); 
			$i++;
		}*/
		//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	
	function get_student_transport_view($id, $val)
	{
		
		$this->db->select($this->table_name10.'.*');
		//$this->db->select('master_stage.stage_name');
		$this->db->select('master_vehical.bus_no');
		$this->db->where($this->table_name10.'.std_reg',$id);
		$this->db->where($this->table_name10.'.id',$val);
		//$this->db->join('master_stage','master_stage.id='.$this->table_name10.'.stage'); 
		$this->db->join('master_vehical','master_vehical.id='.$this->table_name10.'.bus_id');
		//$this->db->join('hostel_student_advance','hostel_student_advance.roll_no='.$this->table_name3.'.std_id');
		$query = $this->db->get($this->table_name10)->result_array();
		return $query;
	}
	function get_student_transport_update($roll,$id)
	{
		
		$this->db->select($this->table_name10.'.*');
		//$this->db->select('master_stage.stage_name');
		$this->db->select('master_vehical.bus_no');
		$this->db->where($this->table_name10.'.std_reg',$roll);
		$this->db->where($this->table_name10.'.id',$id);
		//$this->db->join('master_stage','master_stage.id='.$this->table_name10.'.stage'); 
		$this->db->join('master_vehical','master_vehical.id='.$this->table_name10.'.bus_id');
		//$this->db->join('hostel_student_advance','hostel_student_advance.roll_no='.$this->table_name3.'.std_id');
		$query = $this->db->get($this->table_name10)->result_array();
		return $query;
	}
	
	function get_root1()
	{
		$this->db->select($this->table_name4.'.*');
		$this->db->select('bus_root_details.master_vehical_id');
	    $this->db->join('bus_root_details','bus_root_details.id='.$this->table_name4.'.rbus_no');
		$query = $this->db->get($this->table_name4);
		/*echo"<pre>";
		print_r($query->result_array());
		exit;*/
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	function get_all_stage()
	{
		$this->db->select($this->table_name3.'.*');
		$query = $this->db->get($this->table_name3)->result_array();
		return $query;
		
	}
	function insert_update_fees($input,$roll,$id)
	{
		$a=1;
		$this->db->where('std_reg', $roll);
		$this->db->where('id', $id);
		$this->db->where('histroy',$a);
		$q=$this->db->update($this->table_name10, $data=array('histroy'=>0));
				
		if($q)
		{
			$res=$this->db->insert($this->table_name10, $input);
		}
		if ($res) 
		{
			return true;
		}
		return false;
	}
	function get_student_list_fees($tran_std) // this is for getting the student list by autocompleate ajax method
	{	
		//print_r($tran_std); exit;
		$this->db->select('*');			
		$this->db->like('std_roll_num',$tran_std['q']);
		$this->db->group_by('std_roll_num',$tran_std['q']);    			
		$query= $this->db->get('transport_fees')->result_array();
		
		return $query;
		
		//$this->db->group_by($t);  
	}
	function get_student_fees_details($roll_no)
	{
		
		$this->db->select($this->table_name11.'.id,std_id,name,email_id,student_type,transport,hostel,image');
		$this->db->select('batch.from,batch.to,batch.id as batch_id');
		$this->db->select('department.department,department.id as depart_id');
		$this->db->select('group.group');
		$this->db->where('std_id',$roll_no);
		$this->db->join('batch','batch.id='.$this->table_name11.'.batch_id');	
		$this->db->join('student_group','student_group.student_id='.$this->table_name11.'.id');
		$this->db->join('group','group.id=student_group.group_id');		
		$this->db->join('department','department.id=student_group.depart_id');	  
		$query = $this->db->get($this->table_name11)->result_array();
		return $query;
	}
	function get_all_student_from_student()
	{
		
		$this->db->select($this->table_name11.'.id,std_id,name,email_id,student_type,transport,hostel,
		image,contact_no,last_name');
		$this->db->select('batch.from,batch.to,batch.id as batch_id');
		$this->db->select('department.department,department.id as depart_id');
		$this->db->select('group.group');
		$this->db->select('department.nickname');
		$this->db->where('transport',1);
		$this->db->join('batch','batch.id='.$this->table_name11.'.batch_id');	
		$this->db->join('student_group','student_group.student_id='.$this->table_name11.'.id');
		$this->db->join('group','group.id=student_group.group_id');		
		$this->db->join('department','department.id=student_group.depart_id');	  
		$query = $this->db->get($this->table_name11)->result_array();
		return $query;
	}
	
	
	function get_student_from_trans($roll_no)
	{
		
		$this->db->select('*');
		$this->db->select('master_root.root_name,source');
		$this->db->select('master_stage.stage_name');
		$this->db->where('std_roll_num',$roll_no);
		$this->db->join('master_root','master_root.id='.$this->table_name10.'.route_id');
		$this->db->join('master_stage','master_stage.id='.$this->table_name10.'.stage_id1');
		$query=$this->db->get($this->table_name10)->result_array();
		return $query;
		
	}
	function get_student_fees_details1($id)
	{
		
		$this->db->select('*');
		$this->db->select('master_root.root_name,source');
		$this->db->select('master_stage.stage_name');
		$this->db->where('std_roll_num',$id);
		$this->db->join('master_root','master_root.id='.$this->table_name10.'.route_id');
		$this->db->join('master_stage','master_stage.id='.$this->table_name10.'.stage_id1');
		$query=$this->db->get($this->table_name10)->result_array();
		return $query;
		
	}
	function get_stage_list($tran_stg) // this is for getting the student list by autocompleate ajax method
	{	
		$this->db->select('*');	
		//$this->db->where('transport',1);
		$this->db->like('stage_name',$tran_stg['q']); 
		$this->db->group_by('stage_name',$tran_stg['q']);  
		$query= $this->db->get('master_stage')->result_array();
		return $query;	
	}
function add_duplicate_busno($input)
 {
 //echo $input;
 //exit;
 $this->db->select('*');
 $this->db->where('bus_no',$input);
 $query=$this->db->get('master_vehical');
  
  if ($query->num_rows() >= 1) {
   return $query->result_array();
  }
 }
	

 function update_duplicate_busno($input,$id)
 {
 //echo $input;
 //echo $id;
 //exit;
 $this->db->select('*');
 $this->db->where('bus_no',$input);
 $this->db->where('id !=',$id);
 $query=$this->db->get('master_vehical')->result_array();
  
  
   return $query;
  }
  function add_duplicate_route($input1,$input2,$input3)
 {
 //echo $input;
 //exit;
 $this->db->select('*');
 $this->db->where('root_name',$input1);
 $this->db->where('source',$input2);
 $this->db->where('rbus_no',$input3);
 $query=$this->db->get('master_root');
  
  if ($query->num_rows() >= 1) {
   return $query->result_array();
  }
 }
 function add_duplicate_stage($input1,$input2)
 {
 
 $this->db->select('*');
 $this->db->where('master_bus_id',$input1);
 $this->db->where('master_root_id',$input2);
 $query=$this->db->get('master_stage');
  
  if ($query->num_rows() >= 1) {
   return $query->result_array();
  }
 }

  
  
 function get_all_bus1()
	{
		$this->db->select($this->table_name.'.*');
		$query = $this->db->get($this->table_name)->result_array();
		return $query;
	}
	function get_transport_std_id($roll)
	{
		
		$this->db->select($this->table_name10.'.*');
		$this->db->select('student.id as s_id,std_id,name,email_id,student_type,image');
		$this->db->select('batch.from,batch.to,batch.id as batch_id');
		$this->db->select('department.department,department.nickname,department.id as depart_id');
		$this->db->select('group.group');
		$this->db->select('master_vehical.bus_no');
		$this->db->where('std_reg',$roll);
		$this->db->join('student','student.std_id='.$this->table_name10.'.std_reg');
		$this->db->join('batch','batch.id=student.batch_id');	
		$this->db->join('student_group','student_group.student_id=student.id');
		$this->db->join('department','department.id=student_group.depart_id');	
		$this->db->join('group','group.id=student_group.group_id');
		$this->db->join('master_vehical','master_vehical.id='.$this->table_name10.'.bus_id'); 
		$query= $this->db->get($this->table_name10)->result_array();
		return $query;
	}
	
	function transport_year($roll)
	{
		$this->db->select($this->table_name10.'.*');
		$this->db->where('std_reg',$roll);
		$query= $this->db->get($this->table_name10)->result_array();
		return $query;
	}
	
	function delete_master_stage_row($id)
	{
		$this->db->where('master_root_id', $id);
		$this->db->delete($this->table_name3);
		
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}	
	
	function get_all_student_for_staff_transport($batch,$depart,$group)
	{
		$this->db->select($this->table_name11.'.*');
		$this->db->select('batch.from,batch.to');
		$this->db->select('department.department,nickname');
		$this->db->select('student_group.depart_id as std_depart_id');
		$this->db->select('student_group.group_id as std_group_id');
		$this->db->select('group.group');
		$this->db->where($this->table_name11.'.df',0);		
		$this->db->where($this->table_name11.'.status',1);
		$this->db->where($this->table_name11.'.transport',1);
		$this->db->where('student_group.batch_id',$batch);
		$this->db->where('student_group.depart_id',$depart);
		$this->db->where('student_group.group_id',$group);
		
		
		$this->db->join('batch','batch.id='.$this->table_name11.'.batch_id');	
		$this->db->join('student_group','student_group.student_id='.$this->table_name11.'.id');		
		$this->db->join('department','department.id=student_group.depart_id');	 
		$this->db->join('group','group.id=student_group.group_id');		 
		$query = $this->db->get($this->table_name11)->result_array();
		$i=0;
		foreach($query as $val)
		{
			$this->db->select('group.group');
			$this->db->where('id',$val['std_group_id']);	
			$this->db->where('depart_id',$val['std_depart_id']);
			$query[$i]['std_group']=$this->db->get('group')->result_array();	
			$i++;
		}
		return $query;
	}
	
	function get_all_student_type_trans($batch,$depart,$group,$type)
	{
		
		$this->db->select($this->table_name11.'.*');
		$this->db->select('batch.from,batch.to');
		$this->db->select('group.group');
		$this->db->select('department.department,nickname');
		$this->db->select('student_group.depart_id as std_depart_id');
		$this->db->select('student_group.group_id as std_group_id');
		$this->db->where($this->table_name11.'.df',0);		
		$this->db->where($this->table_name11.'.status',1);
		$this->db->where($this->table_name11.'.transport',1);
		$this->db->where($this->table_name11.'.student_type',$type);
		//$this->db->where($this->table_name11.'.hostel',$hostel);
		$this->db->where('student_group.batch_id',$batch);
		$this->db->where('student_group.depart_id',$depart);
		$this->db->where('student_group.group_id',$group);
		
		
		$this->db->join('batch','batch.id='.$this->table_name11.'.batch_id');	
		$this->db->join('student_group','student_group.student_id='.$this->table_name11.'.id');		
		$this->db->join('department','department.id=student_group.depart_id');	
		$this->db->join('group','group.id=student_group.group_id');	 
		 		 
		$query = $this->db->get($this->table_name11)->result_array();
		$i=0;
		foreach($query as $val)
		{
			$this->db->select('group.group');
			$this->db->where('id',$val['std_group_id']);	
			$this->db->where('depart_id',$val['std_depart_id']);
			$query[$i]['std_group']=$this->db->get('group')->result_array();	
			$i++;
		}
		//echo "<pre>"; print_r($query); exit;
		return $query;
	}
	function get_student_details_by_roll_no($roll_no)
	{
		$this->db->select('id');
		$this->db->where('std_id',$roll_no);
		$query=$this->db->get('student');
			
			if ($query->num_rows() >= 1) {
				return $query->result_array();
			}
	}
		
}
