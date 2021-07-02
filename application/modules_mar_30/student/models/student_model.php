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
class Student_model extends CI_Model {

    private $table_name = 'student';
    private $table_name1 = 'batch';
    private $table_name2 = 'group';
    private $table_name3 = 'student_details';
    private $table_name4 = 'student_group';
    private $table_name5 = 'assignment';
    private $table_name6 = 'assignment_details';
    private $table_name7 = 'internal_details';
    private $table_name8 = 'users';
    private $table_name9 = 'subject_details';
    private $table_name10 = 'department';

    function __construct() {
        parent::__construct();
    }

    /**
     * Get all ur_title
     *
     * @return	array
     */
    function get_all_student() {
        $this->db->select($this->table_name . '.*');
        $this->db->limit(20, 0);
        //$this->db->where('std_id',$std_id);
        $this->db->order_by("id", "DESC");
        //$this->db->order_by("UPPER(std_id)","desc");
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department,nickname');
        $this->db->select('student_group.depart_id as std_depart_id');
        $this->db->select('student_group.group_id as std_group_id');
        $this->db->where($this->table_name . '.df', 0);
        $this->db->where($this->table_name . '.status', 1);
        $this->db->join('batch', 'batch.id=' . $this->table_name . '.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name . '.id');
        $this->db->join('department', 'department.id=student_group.depart_id');

        $query = $this->db->get($this->table_name)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('group.group');
            $this->db->where('id', $val['std_group_id']);
            $this->db->where('depart_id', $val['std_depart_id']);
            $query[$i]['std_group'] = $this->db->get('group')->result_array();
            $i++;
        }
        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    /**
     * Get ur_title by id (id)
     *
     * @param	int
     * @return	array
     */
    function get_student_details_by_id($id) {

        $this->db->select($this->table_name . '.*');
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department');
        $this->db->select('student_group.depart_id as std_depart_id');
        $this->db->select('student_group.group_id as std_group_id');
        $this->db->select('student_details.*');
        $this->db->where($this->table_name . '.df', 0);
        //$this->db->where($this->table_name.'.status',1);
        $this->db->where($this->table_name . '.id', $id);
        $this->db->join('batch', 'batch.id=' . $this->table_name . '.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name . '.id');
        $this->db->join('department', 'department.id=student_group.depart_id');
        $this->db->join('student_details', 'student_details.student_id=' . $this->table_name . '.id');

        $query = $this->db->get($this->table_name)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('group.group');
            $this->db->where('id', $val['std_group_id']);
            $this->db->where('depart_id', $val['std_depart_id']);
            $query[$i]['std_group'] = $this->db->get('group')->result_array();
            $this->db->where('qualification.type', 'student');
            $this->db->where('qualification.person_id', $val['id']);
            $q_array = $this->db->get('qualification')->result_array();
            $query['qualification'][0] = $q_array;
            $i++;
        }
        return $query;
    }

    /**
     * Insert new ur_title
     *
     * @param	array
     * @param	bool
     * @return	array
     */
    function get_student_group_by_all_id($data) {

        $this->db->select('student.id,std_id,name');
        $this->db->where($this->table_name4 . '.batch_id', $data['select_batch']);
        $this->db->where($this->table_name4 . '.depart_id', $data['depart_id']);
        $this->db->where($this->table_name4 . '.group_id', $data['group_id']);
        $this->db->join('student', 'student.id=' . $this->table_name4 . '.student_id');
        $query = $this->db->get($this->table_name4)->result_array();

        $i = 0;
        foreach ($query as $val) {
            $this->db->select($this->table_name5 . '.total');
            $this->db->select('assignment_details.score');
            /* 	$this->db->where($this->table_name5.'.batch_id', $data['select_batch']);
              $this->db->where($this->table_name5.'.depart_id', $data['depart_id']);
              $this->db->where($this->table_name5.'.group_id', $data['group_id']);
              $this->db->where($this->table_name5.'.subject_id', $data['subject']); */
            $where = array($this->table_name5 . '.batch_id' => $data['select_batch'], $this->table_name5 . '.depart_id' => $data['depart_id'], $this->table_name5 . '.group_id' => $data['group_id'], $this->table_name5 . '.subject_id' => $data['subject']);
            $this->db->where($where);
            $this->db->where('assignment_details.std_id', $val['id']);
            $this->db->join('assignment_details', 'assignment_details.assign_id=' . $this->table_name5 . '.id');
            $query[$i]['assignment'] = $this->db->get($this->table_name5)->result_array();

            $this->db->where($this->table_name7 . '.internal_id', $data['int_id']);
            $this->db->where($this->table_name7 . '.std_id', $val['id']);
            $query[$i]['internal_details'] = $this->db->get($this->table_name7)->result_array();
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
    function update_ur_title($id, $data) {
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
    function delete_ur_title($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function get_all_batch() {
        $this->db->select('*');
        $this->db->where('status', 1);
        $this->db->where('df', 0);
        $query = $this->db->get($this->table_name1);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_group($id) {
        $this->db->select('*');
        $this->db->where('status', 1);
        $this->db->where('depart_id', $id);
        $this->db->where('df', 0);
        $query = $this->db->get($this->table_name2);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function insert_student($data) {
        if ($this->db->insert($this->table_name, $data)) {
            $id = $this->db->insert_id();

            return array('id' => $id);
        }
        return false;
    }

    function insert_group($data) {
        if ($this->db->insert($this->table_name2, $data)) {
            $id = $this->db->insert_id();

            return array('id' => $id);
        }
        return false;
    }

    function insert_department($data) {
        if ($this->db->insert($this->table_name10, $data)) {
            $id = $this->db->insert_id();

            return array('id' => $id);
        }
        return false;
    }

    function insert_users($data) {
        if ($this->db->insert($this->table_name8, $data)) {
            $id = $this->db->insert_id();

            return array('id' => $id);
        }
        return false;
    }

    function insert_student_details($data) {
        if ($this->db->insert($this->table_name3, $data)) {
            $insert_id = $this->db->insert_id();

            return array('id' => $insert_id);
        }
        return false;
    }

    function insert_student_group($data) {
        if ($this->db->insert($this->table_name4, $data)) {
            $insert_id = $this->db->insert_id();

            return array('id' => $insert_id);
        }
        return false;
    }

    function update_student($data, $id) {
        $this->db->where('id', $id);
        if ($this->db->update($this->table_name, $data)) {
            $id = $this->db->insert_id();

            return array('id' => $id);
        }
        return false;
    }

    function delete_student($data, $id) {
        $this->db->where('id', $id);
        if ($this->db->update($this->table_name, $data)) {
            $id = $this->db->insert_id();

            return array('id' => $id);
        }
        return false;
    }

    function update_users($data, $email_id) {
        $this->db->where('email', $email_id);
        if ($this->db->update($this->table_name8, $data)) {
            $id = $this->db->insert_id();

            return array('id' => $id);
        }
        return false;
    }

    function update_student_details($data, $id) {
        $this->db->where('student_id', $id);
        if ($this->db->update($this->table_name3, $data)) {
            $insert_id = $this->db->insert_id();

            return array('id' => $insert_id);
        }
        return false;
    }

    function update_student_group($data, $id) {
        $this->db->where('student_id', $id);
        if ($this->db->update($this->table_name4, $data)) {
            $insert_id = $this->db->insert_id();

            return array('id' => $insert_id);
        }
        return false;
    }

    function delete_qualification_by_id($id) {
        $this->db->where('qualification.type', 'student');
        $this->db->where('qualification.person_id', $id);
        $this->db->delete('qualification');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function email_checking_insert($email) {
        $query = $this->db->query("select a.id from student a,admin b,staff c where a.df=0 and a.status=1  and  a.email_id='$email' or b.df=0 and b.status=1 and b.email_id='$email' or c.df=0 and c.status=1 and c.email_id='$email'");

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function email_checking_update($id, $email) {
        $query = $this->db->query("select a.id from student a,admin b,staff c where a.id!='$id' and a.df=0 and a.status=1  and  a.email_id='$email' or b.df=0 and b.status=1 and b.email_id='$email' or c.df=0 and c.status=1 and c.email_id='$email'");

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function checking_studentid_insert($student_id) {

        $query = $this->db->query("select a.id from student a,staff b where a.df=0 and a.status=1 and  a.std_id='$student_id' or b.df=0 and b.status=1 and b.staff_id='$student_id'");
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function checking_studentid_update($id, $student_id) {

        $query = $this->db->query("select a.id from student a,staff b where a.id!='$id' and a.df=0 and a.status=1 and  a.std_id='$student_id' or b.df=0 and b.status=1 and b.staff_id='$student_id'");

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function get_user_details_by_id($email, $pwd) {
        $this->db->select($this->table_name . '.id,std_id,name,last_name,email_id,contact_no,image,chat,student_type,transport,hostel');

        $this->db->select('student_details.dob,country,parent_no,join_date,parent_name');

        $this->db->select('batch.from,to,batch.id as batch_id');
        $this->db->select('department.department,department.id as depart_id');
        $this->db->select('group.group,group.id as group_id');

        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name . '.id');
        $this->db->join('student_details', 'student_details.student_id=' . $this->table_name . '.id');

        $this->db->join('batch', 'batch.id=student_group.batch_id');
        $this->db->join('department', 'department.id=student_group.depart_id');
        $this->db->join('group', 'group.id=student_group.group_id');
        $this->db->where($this->table_name . '.df', 0);
        $this->db->where($this->table_name . '.status', 1);
        $this->db->where('email_id', $email);
        $this->db->or_where('std_id', $email);
        $this->db->where('pwd', $pwd);
        $query = $this->db->get($this->table_name);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_student_for_calendar($staff_id) {
        $this->db->select('student_details.dob');
        $this->db->select('student.name as staff_name');
        $this->db->select('department.department,department.nickname');
        $this->db->select('student_group.student_id');
        $this->db->join('student_group', 'student_group.group_id=' . $this->table_name9 . '.group_id');
        $this->db->join('student_details', 'student_details.student_id=student_group.student_id');
        $this->db->join('student', 'student.id=student_group.student_id');
        $this->db->join('department', 'department.id=student_group.depart_id');
        $this->db->where($this->table_name9 . '.id', $staff_id);
        $query = $this->db->get($this->table_name9);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
        return false;
    }

    function get_student_group_by_all_id_for_print($data) {

        $this->db->select('student.id,std_id,name');
        $this->db->where($this->table_name4 . '.batch_id', $data['select_batch']);
        $this->db->where($this->table_name4 . '.depart_id', $data['depart_id']);
        $this->db->where($this->table_name4 . '.group_id', $data['group_id']);
        $this->db->join('student', 'student.id=' . $this->table_name4 . '.student_id');
        $query = $this->db->get($this->table_name4)->result_array();

        $i = 0;
        foreach ($query as $val) {
            $this->db->select($this->table_name5 . '.total');
            $this->db->select('assignment_details.score');
            /* 	$this->db->where($this->table_name5.'.batch_id', $data['select_batch']);
              $this->db->where($this->table_name5.'.depart_id', $data['depart_id']);
              $this->db->where($this->table_name5.'.group_id', $data['group_id']);
              $this->db->where($this->table_name5.'.subject_id', $data['subject']); */
            $where = array($this->table_name5 . '.batch_id' => $data['select_batch'], $this->table_name5 . '.depart_id' => $data['depart_id'], $this->table_name5 . '.group_id' => $data['group_id'], $this->table_name5 . '.subject_id' => $data['subject']);
            $this->db->where($where);
            $this->db->where('assignment_details.std_id', $val['id']);
            $this->db->join('assignment_details', 'assignment_details.assign_id=' . $this->table_name5 . '.id');
            $query[$i]['assignment'] = $this->db->get($this->table_name5)->result_array();

            $this->db->where($this->table_name7 . '.internal_id', $data['int_id']);
            $this->db->where($this->table_name7 . '.std_id', $val['id']);
            $query[$i]['internal_details'] = $this->db->get($this->table_name7)->result_array();
            $i++;
        }
        return $query;
    }

    function get_all_student_for_users($where) {
        $this->db->select('student_details.dob');
        $this->db->select('student.name as staff_name');
        $this->db->select('student_group.student_id');
        $this->db->join('student_details', 'student_details.student_id=student_group.student_id');
        $this->db->join('student', 'student.id=student_group.student_id');
        $this->db->where($where);
        $query = $this->db->get($this->table_name4);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_student_for_staff($batch, $depart, $group) {
        $this->db->select($this->table_name . '.*');
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department,nickname');
        $this->db->select('student_group.depart_id as std_depart_id');
        $this->db->select('student_group.group_id as std_group_id');
        $this->db->where($this->table_name . '.df', 0);
        $this->db->where($this->table_name . '.status', 1);

        $this->db->where('student_group.batch_id', $batch);
        $this->db->where('student_group.depart_id', $depart);
        $this->db->where('student_group.group_id', $group);


        $this->db->join('batch', 'batch.id=' . $this->table_name . '.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name . '.id');
        $this->db->join('department', 'department.id=student_group.depart_id');

        $query = $this->db->get($this->table_name)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('group.group');
            $this->db->where('id', $val['std_group_id']);
            $this->db->where('depart_id', $val['std_depart_id']);
            $query[$i]['std_group'] = $this->db->get('group')->result_array();
            $i++;
        }
        return $query;
    }

    function get_all_depart_by_batch($b_id) {
        $user_det = $this->session->userdata('logged_in');

        $this->db->select('department.*');
        $this->db->group_by('student_group.depart_id');
        $this->db->where('student_group.batch_id', $b_id);
        //$this->db->where('staff_id',$this->user_auth->get_user_id());
        $this->db->join('department', 'department.id=student_group.depart_id');
        $query = $this->db->get('student_group')->result_array();
        //echo "<pre>";print_r($query); exit;
        return $query;
    }

    function get_all_depart_id_by_name($depart) {
        $this->db->select('id');
        $this->db->where('LCASE(department)', trim(strtolower($depart)));
        $this->db->or_where('LCASE(nickname)', trim(strtolower($depart)));
        $query = $this->db->get('department')->result_array();
        //echo "<pre>";print_r($query); exit;
        return $query[0]['id'];
    }

    function get_all_group_id_by_name($group, $depart_id) {
        $this->db->select('id');
        $this->db->where('LCASE(`group`)', trim(strtolower($group)));
        $this->db->where('depart_id', $depart_id);
        $query = $this->db->get('group')->result_array();
        //echo "<pre>";print_r($query); exit;
        return $query[0]['id'];
    }

    function get_all_batch_id_by_name($batch) {
        $this->db->select('id');
        $this->db->where('from', $batch);
        $query = $this->db->get('batch')->result_array();
        echo $this->db->last_query();
        return $query[0]['id'];
    }

    function get_all_student_type($batch, $depart, $group, $type) {

        $this->db->select($this->table_name . '.*');
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department,nickname');
        $this->db->select('student_group.depart_id as std_depart_id');
        $this->db->select('student_group.group_id as std_group_id');
        $this->db->where($this->table_name . '.df', 0);
        $this->db->where($this->table_name . '.status', 1);
        $this->db->where($this->table_name . '.student_type', $type);
        $this->db->where('student_group.batch_id', $batch);
        $this->db->where('student_group.depart_id', $depart);
        $this->db->where('student_group.group_id', $group);


        $this->db->join('batch', 'batch.id=' . $this->table_name . '.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name . '.id');
        $this->db->join('department', 'department.id=student_group.depart_id');

        $query = $this->db->get($this->table_name)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('group.group');
            $this->db->where('id', $val['std_group_id']);
            $this->db->where('depart_id', $val['std_depart_id']);
            $query[$i]['std_group'] = $this->db->get('group')->result_array();
            $i++;
        }
        //echo "<pre>"; print_r($query); exit;
        return $query;
    }

    function get_all_student_hostel($batch, $depart, $group, $hostel) {

        $this->db->select($this->table_name . '.*');
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department,nickname');
        $this->db->select('student_group.depart_id as std_depart_id');
        $this->db->select('student_group.group_id as std_group_id');
        $this->db->where($this->table_name . '.df', 0);
        $this->db->where($this->table_name . '.status', 1);
        $this->db->where($this->table_name . '.hostel', $hostel);
        $this->db->where('student_group.batch_id', $batch);
        $this->db->where('student_group.depart_id', $depart);
        $this->db->where('student_group.group_id', $group);


        $this->db->join('batch', 'batch.id=' . $this->table_name . '.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name . '.id');
        $this->db->join('department', 'department.id=student_group.depart_id');

        $query = $this->db->get($this->table_name)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('group.group');
            $this->db->where('id', $val['std_group_id']);
            $this->db->where('depart_id', $val['std_depart_id']);
            $query[$i]['std_group'] = $this->db->get('group')->result_array();
            $i++;
        }
        //echo "<pre>"; print_r($query); exit;
        return $query;
    }

    function get_all_student_transport($batch, $depart, $group, $transport) {

        $this->db->select($this->table_name . '.*');
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department,nickname');
        $this->db->select('student_group.depart_id as std_depart_id');
        $this->db->select('student_group.group_id as std_group_id');
        $this->db->where($this->table_name . '.df', 0);
        $this->db->where($this->table_name . '.status', 1);
        $this->db->where($this->table_name . '.transport', $transport);
        $this->db->where('student_group.batch_id', $batch);
        $this->db->where('student_group.depart_id', $depart);
        $this->db->where('student_group.group_id', $group);


        $this->db->join('batch', 'batch.id=' . $this->table_name . '.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name . '.id');
        $this->db->join('department', 'department.id=student_group.depart_id');

        $query = $this->db->get($this->table_name)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('group.group');
            $this->db->where('id', $val['std_group_id']);
            $this->db->where('depart_id', $val['std_depart_id']);
            $query[$i]['std_group'] = $this->db->get('group')->result_array();
            $i++;
        }
        //echo "<pre>"; print_r($query); exit;
        return $query;
    }

    function get_all_student_type_hostel($batch, $depart, $group, $type, $hostel) {

        $this->db->select($this->table_name . '.*');
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department,nickname');
        $this->db->select('student_group.depart_id as std_depart_id');
        $this->db->select('student_group.group_id as std_group_id');
        $this->db->where($this->table_name . '.df', 0);
        $this->db->where($this->table_name . '.status', 1);
        $this->db->where($this->table_name . '.student_type', $type);
        $this->db->where($this->table_name . '.hostel', $hostel);
        $this->db->where('student_group.batch_id', $batch);
        $this->db->where('student_group.depart_id', $depart);
        $this->db->where('student_group.group_id', $group);


        $this->db->join('batch', 'batch.id=' . $this->table_name . '.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name . '.id');
        $this->db->join('department', 'department.id=student_group.depart_id');

        $query = $this->db->get($this->table_name)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('group.group');
            $this->db->where('id', $val['std_group_id']);
            $this->db->where('depart_id', $val['std_depart_id']);
            $query[$i]['std_group'] = $this->db->get('group')->result_array();
            $i++;
        }
        //echo "<pre>"; print_r($query); exit;
        return $query;
    }

    function get_all_student_type_transport($batch, $depart, $group, $type, $transport) {

        $this->db->select($this->table_name . '.*');
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department,nickname');
        $this->db->select('student_group.depart_id as std_depart_id');
        $this->db->select('student_group.group_id as std_group_id');
        $this->db->where($this->table_name . '.df', 0);
        $this->db->where($this->table_name . '.status', 1);
        $this->db->where($this->table_name . '.student_type', $type);
        $this->db->where($this->table_name . '.transport', $transport);
        $this->db->where('student_group.batch_id', $batch);
        $this->db->where('student_group.depart_id', $depart);
        $this->db->where('student_group.group_id', $group);


        $this->db->join('batch', 'batch.id=' . $this->table_name . '.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name . '.id');
        $this->db->join('department', 'department.id=student_group.depart_id');

        $query = $this->db->get($this->table_name)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('group.group');
            $this->db->where('id', $val['std_group_id']);
            $this->db->where('depart_id', $val['std_depart_id']);
            $query[$i]['std_group'] = $this->db->get('group')->result_array();
            $i++;
        }
        //echo "<pre>"; print_r($query); exit;
        return $query;
    }

    function checking_regno_insert($regno) {
        //print_r($regno); exit;
        $this->db->select('*');
        $this->db->where('regno', $regno);
        $query = $this->db->get('student');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function checking_regno_update($regno, $id) {

        $this->db->select('*');
        $this->db->where('regno', $regno);
        $this->db->where('id !=', $id);
        $query = $this->db->get('student')->result_array();
        //echo "<pre>"; print_r($query); exit;
        return $query;
    }

    function get_student_details_by_roll_no($roll_no) {
        $this->db->select('id');
        $this->db->where('std_id', $roll_no);
        $query = $this->db->get('student');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

}
