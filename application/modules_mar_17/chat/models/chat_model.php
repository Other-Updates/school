<?php
class Chat_model extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */
	 
	function __Construct()
    {
        parent::__Construct();
    }
	
	
	// --------------------------------------------------------------------
		
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getUsers($conditions=array('status'=>1),$fields='')
	 {
	 	
		parent::__construct(); 
		
		
		if(count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->from('staff');

		$this->db->order_by("staff.online_status", "asc");

		
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('staff.id,staff.staff_name,staff.email_id,staff.online_status,staff.image');
		
		$result = $this->db->get();
		
		return $result;
		

      }//End of getUsers Function
	 
	 
	 function getadminUsers($conditions=array('status'=>1),$fields='')
	 {
	 	
		parent::__construct(); 
		
		
		if(count($conditions)>0)		
	 		$this->db->where($conditions);
			
			
			//
			
		$this->db->from('admin');

		$this->db->order_by("admin.online_status", "asc");

		
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('admin.id,admin.name,admin.email_id,admin.online_status,admin.image');
		
		$result = $this->db->get();
		
		return $result;
		

      }//End of getUsers Function
	  
	  
	  
	   function getstudentUsers($conditions=array('status'=>1),$fields='')
	 {
	 	
		parent::__construct(); 
		
		
		if(count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->from('student');

		$this->db->order_by("student.online_status", "asc");

		
		if($fields!='')
				$this->db->select($fields);
		else 		
	 		$this->db->select('student.id,student.name,student.email_id,student.online_status,student.image');
		
		$result = $this->db->get();
		
		return $result;
		

      }//End of getUsers Function
	  
	  
	  
	 
	 
	 
	 
	 
	 
	 
	 
	 // --------------------------------------------------------------------
				
	/**
	 * Get getLoggedInUser
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	  function getLoggedInUser() 
	  {

	 	$user = '';

			$condition = array('student.std_id'=>$this->session->userdata('ucode'));
			$fields    = 'student.std_id,student.name,student.email_id,student.online_status';
			
			$query = $this->getUsers($condition,$fields);
			
			if($query->num_rows()>0)
			{
				$user = $query->row();				
			}
			
		return $user;
	 }//End of getDecryptedString Function
	 
	 
	 // --------------------------------------------------------------------
	  
	  
		
	/**
	 * Update users
	 *
	 * @access	private
	 * @param	array	an associative array of insert values
	 * @return	void
	 */
	 function updateUser($updateKey=array(),$updateData=array())
	 {
	    $this->db->update('student',$updateData,$updateKey);
		 
	 }//End of editGroup Function 
	 
	//-----------------------------------------------------------------------------------
	 
	 
	 	
	/**
	 * Set Style for the flash messages
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message 
	 * @return	string	flash message with proper style
	 */
	 function flash_message($type,$message)
	 {
	 	switch($type)
		{
			case 'success':
					$data = '<div class="message"><div class="success">'.$message.'</div></div>';
					break;
			case 'error':
					$data = '<div class="message"><div class="error">'.$message.'</div></div>';
					break;		
		}
		return $data;
	 }//End of flash_message Function
	 
	  
}