<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * History_model
 *
 * This model represents tasker history. It operates the following tables:
 * - history,
 *
 * @package	i2_soft
 * @author	Elavarasan
 */
class Subject_model extends CI_Model {

    private $table_name = 'subject_details';
    private $table_name3 = 'staff_details';
    private $table_name1 = 'batch';
    private $table_name2 = 'group';
    private $table_name4 = 'department';
    private $table_name5 = 'semester';
    private $table_name6 = 'staff';
    private $table_name7 = 'master_right';

    function __construct() {
        parent::__construct();
    }

    function get_subject() {
        $this->db->select('*');
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
        return false;
    }

    function insert_subject($data) {
        if ($this->db->insert($this->table_name, $data)) {
            return true;
        }
        return false;
    }

    function get_all_subject($user) {
        //print_r($user); exit;
        $this->db->select($this->table_name . '.*');
        $this->db->select('batch.from,batch.to');
        $this->db->select('staff.staff_name');
        $this->db->select('group.group');
        $this->db->select('semester.semester');
        $this->db->select('department.department,nickname');
        $this->db->where($this->table_name . '.created_user', $user['user_id']);
        $this->db->where($this->table_name . '.staff_type', $user['staff_type']);
        $this->db->where($this->table_name . '.df', 0);
        $this->db->join('batch', 'batch.id=' . $this->table_name . '.batch_id');
        $this->db->join('staff', 'staff.id=' . $this->table_name . '.staff_id');
        $this->db->join('group', 'group.id=' . $this->table_name . '.group_id', 'left');
        $this->db->join('semester', 'semester.id=' . $this->table_name . '.semester_id');
        $this->db->join('department', 'department.id=' . $this->table_name . '.depart_id');

        $query = $this->db->get($this->table_name)->result_array();

        $i = 0;
        foreach ($query as $grp) {
            $this->db->select('group.group');
            $this->db->select('group.id');
            $this->db->where('depart_id', $grp['depart_id']);
            $query[$i]['get_group'] = $this->db->get('group')->result_array();
            $i++;
        }

        return $query;
        print_r($query);
        exit;
    }

    function get_all_subject_for_staff($user) {
        $this->db->select('*');
        $this->db->select('department.department,nickname');
        $this->db->select('group.group');
        $this->db->select('semester.semester');
        $this->db->where($this->table_name . '.staff_id', $user['user_id']);
        $this->db->where($this->table_name . '.df', 0);
        $this->db->join('department', 'department.id=' . $this->table_name . '.depart_id');
        $this->db->join('group', 'group.id=' . $this->table_name . '.group_id');
        $this->db->join('semester', 'semester.id=' . $this->table_name . '.semester_id');
        $query = $this->db->get($this->table_name)->result_array();
        //echo "<pre>"; print_r($query); exit;
        return $query;
    }

    function get_all_batch() {
        $this->db->select('*');
        $this->db->where('df', 0);
        $this->db->where('status', 1);
        $query = $this->db->get($this->table_name1);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_batch1($id) {
        $this->db->select('batch.*');
        $this->db->where($this->table_name . '.staff_id', $id);
        $this->db->group_by($this->table_name . '.batch_id');
        $this->db->join('batch', 'batch.id=' . $this->table_name . '.batch_id');
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function staff() {
        $this->db->select('*');
        $this->db->where('df', 0);
        $this->db->where('status', 1);
        $query = $this->db->get($this->table_name6);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function department() {
        $this->db->select('*');
        $this->db->where('df', 0);
        $this->db->where('status', 1);
        $query = $this->db->get($this->table_name4);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function group() {
        $this->db->select('*');
        $this->db->where('df', 0);
        $this->db->where('status', 1);
        $query = $this->db->get($this->table_name2);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function semester() {
        $this->db->select('*');
        $this->db->where('df', 0);
        $this->db->where('status', 1);
        $query = $this->db->get($this->table_name5);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_default_term() {
        $this->db->select('*');
        $this->db->where('status', 1);
        $query = $this->db->get($this->table_name5);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function delete_subject($id) {
        $this->db->where('id', $id);

        if ($this->db->update($this->table_name, $data = array('df' => 1))) {

            return true;
        }
        return false;
    }

    function update_subject($data, $id) {
        $this->db->where('id', $id);


        if ($this->db->update($this->table_name, $data)) {

            return true;
        }
        return false;
    }

    function get_all_group($id) {
        $this->db->select('*');
        $this->db->where('df', 0);
        $this->db->where('status', 1);
        $this->db->where('depart_id', $id);
        $this->db->where('status', 1);
        $query = $this->db->get($this->table_name2);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_gp($id) {
        $this->db->select('*');
        $this->db->where('df', 0);
        $this->db->where('status', 1);
        $this->db->where('depart_id', $id);
        $query = $this->db->get($this->table_name2);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_staff($id) {

        $this->db->select('*');
        $this->db->where('df', 0);
        $this->db->where('status', 1);
        $this->db->where('staff_type_id !=', 3);
        $this->db->where('depart_id', $id);
        $query = $this->db->get($this->table_name6);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_staff_update($d_id) {
        $this->db->select('*');
        $this->db->where('staff_type_id !=', 3);
        $this->db->where('depart_id', $d_id);
        $query = $this->db->get($this->table_name6);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_sta($id) {
        $this->db->select('*');
        $this->db->where('df', 0);
        $this->db->where('status', 1);
        $this->db->where('depart_id', $id);
        $query = $this->db->get($this->table_name6);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    /* 	function avoid_delete_subject()
      {
      $this->db->select('*');

      $query = $this->db->get('table_name');

      if ($query->num_rows() >= 1) {
      return $query->result_array();
      }
      }
     */

    function get_subject_by_id($id) {
        $this->db->select('subject_name');
        $this->db->where('id', $id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function staff_subject($ip) {
        //print_r($ip); exit;
        $this->db->select('*');
        $this->db->select('group.group');
        $this->db->select('staff.staff_name');
        $this->db->select('department.department,nickname');

        $this->db->where($ip);

        $this->db->join('group', 'group.id=' . $this->table_name . '.group_id', 'left');
        $this->db->join('department', 'department.id=' . $this->table_name . '.depart_id');
        $this->db->join('staff', 'staff.id=' . $this->table_name . '.staff_id');
        $query = $this->db->get('subject_details')->result_array();
        //echo "<pre>";print_r($query); exit;
        return $query;
    }

    function get_all_depart_by_batch($b_id) {
        $user_det = $this->session->userdata('logged_in');

        $this->db->select('department.*');
        $this->db->group_by('depart_id');
        $this->db->where('batch_id', $b_id);
        //$this->db->where('staff_id',$this->user_auth->get_user_id());
        $this->db->join('department', 'department.id=student_group.depart_id');
        $query = $this->db->get('student_group')->result_array();
        //echo "<pre>";print_r($query); exit;
        return $query;
    }

    function get_all_depart_by_batch_internal($b_id) {
        $user_det = $this->session->userdata('logged_in');
        if ($user_det['staff_type'] == 'staff') {
            $this->db->select('department.*');
            $this->db->group_by('depart_id');
            $this->db->where('batch_id', $b_id);
            $this->db->where('staff_id', $this->user_auth->get_user_id());
            $this->db->join('department', 'department.id=subject_details.depart_id');
            $query = $this->db->get('subject_details')->result_array();
            //echo "<pre>";print_r($query); exit;
            return $query;
        } else {
            $this->db->select('department.*');
            $this->db->group_by('depart_id');
            $this->db->where('batch_id', $b_id);
            //$this->db->where('staff_id',$this->user_auth->get_user_id());
            $this->db->join('department', 'department.id=subject_details.depart_id');
            $query = $this->db->get('subject_details')->result_array();
            //echo "<pre>";print_r($query); exit;
            return $query;
        }
    }

    function get_all_sem_by_batch($b_id) {
        $user_det = $this->session->userdata('logged_in');
        if ($user_det['staff_type'] == 'staff') {
            $this->db->select('semester.*');
            $this->db->group_by('semester_id');
            $this->db->where('batch_id', $b_id);
            $this->db->where('staff_id', $this->user_auth->get_user_id());
            $this->db->join('semester', 'semester.id=' . $this->table_name . '.semester_id');
            $query = $this->db->get($this->table_name)->result_array();
            return $query;
        } else {
            $this->db->select('semester.*');
            $this->db->group_by('semester_id');
            $this->db->where('batch_id', $b_id);
            //$this->db->where('staff_id',$this->user_auth->get_user_id());
            $this->db->join('semester', 'semester.id=' . $this->table_name . '.semester_id');
            $query = $this->db->get($this->table_name)->result_array();
            return $query;
        }
    }

    function get_all_group1($id) {
        $this->db->select('group.*');
        $this->db->where($this->table_name . '.depart_id', $id);
        $this->db->group_by('group_id');
        $this->db->where('staff_id', $this->user_auth->get_user_id());
        $this->db->join('group', 'group.id=' . $this->table_name . '.group_id');
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_master($user) {
        $this->db->select('staff_type');
        $this->db->select('staff_id');
        $this->db->select('subject');
        $this->db->where('staff_id', $user['user_id']);
        $query = $this->db->get('master_right')->result_array();
        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    function validate_subject($input) {
        $this->db->select('*');
        $this->db->where('scode', $input['scode']);
        $this->db->where('subject_name', $input['subject_name']);
        $this->db->where('batch_id', $input['batch_id']);
        $this->db->where('depart_id', $input['depart_id']);
        $this->db->where('group_id', $input['group_id']);
        $this->db->where('staff_id', $input['staff_id']);
        $this->db->where('semester_id', $input['semester_id']);
        $this->db->where('df', 0);
        $query = $this->db->get('subject_details');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function update_validate_subject($input, $id) {

        $this->db->select('*');
        $this->db->where('scode', $input['scode']);
        $this->db->where('id !=', $id);
        $this->db->where('subject_name', $input['subject_name']);
        $this->db->where('batch_id', $input['batch_id']);
        $this->db->where('depart_id', $input['depart_id']);
        $this->db->where('group_id', $input['group_id']);
        //$this->db->where('staff_id',$input['staff_id']);
        $this->db->where('semester_id', $input['semester_id']);
        $this->db->where('df', 0);
        $query = $this->db->get('subject_details');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function validate_dupli_subject($input) {
        //echo "<pre>"; print_r($input); exit;
        $this->db->select('*');

        //$this->db->where('subject_name',$input['subject_name']);
        $this->db->where('batch_id', $input['batch_id']);
        $this->db->where('depart_id', $input['depart_id']);
        $this->db->where('group_id', $input['group_id']);
        //$this->db->where('staff_id',$input['staff_id']);
        $this->db->where('semester_id', $input['semester_id']);
        $this->db->where('subject_name', $input['subject_name']);
        $this->db->where('df', 0);

        //$this->db->where('nick_name', $input['nick_name']);

        $query = $this->db->get('subject_details')->result_array();
        //echo "<pre>"; print_r($query); exit;

        return $query;
    }

    function validate_dupli_nickname($input) {
        //echo "<pre>"; print_r($input); exit;
        $this->db->select('*');

        //$this->db->where('subject_name',$input['subject_name']);
        $this->db->where('batch_id', $input['batch_id']);
        $this->db->where('depart_id', $input['depart_id']);
        $this->db->where('group_id', $input['group_id']);
        //$this->db->where('staff_id',$input['staff_id']);
        $this->db->where('semester_id', $input['semester_id']);
        $this->db->where('nick_name', $input['nick_name']);
        $this->db->where('df', 0);

        //$this->db->where('nick_name', $input['nick_name']);

        $query = $this->db->get('subject_details')->result_array();
        //echo "<pre>"; print_r($query); exit;

        return $query;
    }

    function validate_dupli_subcode($input) {
        //echo "<pre>"; print_r($input); exit;
        $this->db->select('*');

        //$this->db->where('subject_name',$input['subject_name']);
        $this->db->where('batch_id', $input['batch_id']);
        $this->db->where('depart_id', $input['depart_id']);
        $this->db->where('group_id', $input['group_id']);
        //$this->db->where('staff_id',$input['staff_id']);
        $this->db->where('semester_id', $input['semester_id']);
        $this->db->where('scode', $input['scode']);
        $this->db->where('df', 0);

        //$this->db->where('nick_name', $input['nick_name']);

        $query = $this->db->get('subject_details')->result_array();
        //echo "<pre>"; print_r($query); exit;

        return $query;
    }

    function update_validate_dupli_sub($input, $id) {
        //echo "<pre>"; print_r($input); exit;
        $this->db->select('*');

        //$this->db->where('subject_name',$input['subject_name']);
        $this->db->where('batch_id', $input['batch_id']);
        $this->db->where('depart_id', $input['depart_id']);
        $this->db->where('group_id', $input['group_id']);
        //$this->db->where('staff_id',$input['staff_id']);
        $this->db->where('semester_id', $input['semester_id']);
        $this->db->where('subject_name', $input['subject_name']);
        $this->db->where('id !=', $id);
        $this->db->where('df', 0);

        //$this->db->where('nick_name', $input['nick_name']);

        $query = $this->db->get('subject_details')->result_array();
        //echo "<pre>"; print_r($query); exit;

        return $query;
    }

    function update_validate_dupli_nickname($input, $id) {
        //echo "<pre>"; print_r($input); exit;
        $this->db->select('*');

        //$this->db->where('subject_name',$input['subject_name']);
        $this->db->where('batch_id', $input['batch_id']);
        $this->db->where('depart_id', $input['depart_id']);
        $this->db->where('group_id', $input['group_id']);
        //$this->db->where('staff_id',$input['staff_id']);
        $this->db->where('semester_id', $input['semester_id']);
        $this->db->where('nick_name', $input['nick_name']);
        $this->db->where('id !=', $id);
        $this->db->where('df', 0);

        //$this->db->where('nick_name', $input['nick_name']);

        $query = $this->db->get('subject_details')->result_array();
        //echo "<pre>"; print_r($query); exit;

        return $query;
    }

    function update_validate_dupli_subcode($input, $id) {
        //echo "<pre>"; print_r($input); exit;
        $this->db->select('*');

        //$this->db->where('subject_name',$input['subject_name']);
        $this->db->where('batch_id', $input['batch_id']);
        $this->db->where('depart_id', $input['depart_id']);
        $this->db->where('group_id', $input['group_id']);
        //$this->db->where('staff_id',$input['staff_id']);
        $this->db->where('semester_id', $input['semester_id']);
        $this->db->where('scode', $input['scode']);
        $this->db->where('id !=', $id);
        $this->db->where('df', 0);

        //$this->db->where('nick_name', $input['nick_name']);

        $query = $this->db->get('subject_details')->result_array();
        //echo "<pre>"; print_r($query); exit;

        return $query;
    }

    function department_staff($user) {
        $this->db->select('depart_id');
        $this->db->select('department.id');
        $this->db->select('department.department,nickname');
        $this->db->where('staff_id', $user['user_id']);
        $this->db->group_by('department');
        $this->db->where($this->table_name . '.df', 0);
        //$this->db->where($this->table_name.'.status',1);
        $this->db->join('department', 'department.id=' . $this->table_name . '.depart_id');
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

}
