<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Admin_model
 *
 * This model represents admin access. It operates the following tables:
 * admin,
 *
 * @package	i2_soft
 * @author	Elavarasan
 */
class Admin_model extends CI_Model {

    private $table_name = 'admin';
    private $table_name1 = 'designation';
    private $table_name2 = 'mark_details';
    private $table_name3 = 'college_calenar';
    private $table_name4 = 'notice_board';
    private $table_name5 = 'master_fees_details';

    function __construct() {
        parent::__construct();
    }

    function check_login($email, $password) {
        $this->db->select('designation.designation');
        $this->db->select('admin.*');
        $this->db->join('designation', 'designation.id=admin.designation_id');
        $query = $this->db->get_where('admin', array('email_id' => $email, 'pwd' => md5($password), 'admin.status' => '1', 'admin.df' => 0));
        if ($query->num_rows() == 1) {
            $data = array('online_status' => 1);
            $this->db->where('email_id', $email);

            $this->db->update('admin', $data);
            return $query->result();
        } else {
            return false;
        }
    }

    function logoutupdate($username) {
        $data = array('online_status' => 0);
        $this->db->where('email_id', $username);
        $this->db->update('admin', $data);
    }

    function insert_admin($data) {
        $this->db->insert($this->table_name, $data);
    }

    function insert_fees_name($data) {

        $this->db->insert($this->table_name5, $data);
    }

    function get_fees_name() {
        $this->db->select($this->table_name5 . '.*');
        $query = $this->db->get($this->table_name5);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function update_fees($data, $id_fee) {

        $this->db->where('id', $id_fee);

        if ($this->db->update($this->table_name5, $data)) {

            return true;
        }
        return false;
    }

    function update_admin($data, $id) {
        $this->db->where('id', $id);

        if ($this->db->update($this->table_name, $data)) {

            return true;
        }
        return false;
    }

    function insert_internal_details($data) {

        if ($this->db->insert($this->table_name2, $data)) {

            return true;
        }
        return false;
    }

    function get_internal_details() {
        $this->db->select($this->table_name2 . '.*');
        $query = $this->db->get($this->table_name2);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function admin_password_change($input, $id) {
        $this->db->where('id', $id);
        if ($this->db->update('admin', $input)) {
            return true;
        }
        return false;
    }

    function admin_password_change_social($input, $id) {
        $this->db->where('id', $id);
        if ($this->db->update('admin', $input)) {
            return true;
        }
        return false;
    }

    function update_admin_profile($data, $id) {
        $this->db->where('id', $id);

        if ($this->db->update($this->table_name, $data)) {

            return true;
        }
        return false;
    }

    function delete_admin_active($id) {
        $this->db->where('id', $id);

        if ($this->db->update($this->table_name, $data = array('status' => 0))) {

            return true;
        }
        return false;
    }

    function delete_admin_inactive($id) {
        $this->db->where('id', $id);

        if ($this->db->update($this->table_name, $data = array('df' => 1, 'status' => 0))) {

            return true;
        }
        return false;
    }

    function get_single_admin($id) {
        $this->db->select($this->table_name . '.*');

        $this->db->select('designation.designation');

        $this->db->join('designation', 'designation.id=' . $this->table_name . '.designation_id');
        $this->db->where('admin.id', $id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_admin() {
        $this->db->select($this->table_name . '.*');

        $this->db->select('designation.designation');

        $this->db->join('designation', 'designation.id=' . $this->table_name . '.designation_id');
        $this->db->where('admin.df', 0);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_designation() {
        $this->db->select('*');
        $this->db->where('df', 0);
        $this->db->where('status', 1);
        $query = $this->db->get('designation');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function get_all_admin_for_master() {
        $this->db->select($this->table_name . '.id,name');
        $this->db->where('status', 1);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function email_checking_insert($email) {
        $query = $this->db->query("select a.id from admin a,student b,staff c where a.df=0 and a.status=1  and  a.email_id='$email' or b.df=0 and b.status=1 and b.email_id='$email' or c.df=0 and c.status=1 and c.email_id='$email'");

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function email_checking_update($id, $email) {
        $query = $this->db->query("select a.id from admin a,student b,staff c where a.id!='$id' and a.df=0 and a.status=1  and  a.email_id='$email' or b.df=0 and b.status=1 and b.email_id='$email' or c.df=0 and c.status=1 and c.email_id='$email'");

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function update_internal_details($data) {
        if ($this->db->update($this->table_name2, $data)) {
            return true;
        }
        return false;
    }

    function get_image_details($id) {
        $this->db->select('image');
        $this->db->where('id', $id);
        $this->db->where('df', 0);
        $query = $this->db->get('admin');

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function add_day_order($data) {
        if ($this->db->insert($this->table_name3, $data)) {
            return true;
        }
        return false;
    }

    function get_all_college_calendar() {
        $this->db->select('title,from,to');
        $query = $this->db->get($this->table_name3);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function delete_day_order($where) {
        $this->db->where($where);
        $query = $this->db->delete($this->table_name3);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function get_department($user_det) {
        if ($user_det['staff_type'] == 'admin') {
            $this->db->select('*');
            $this->db->where('df', 0);
            $this->db->where('status', 1);
            $query = $this->db->get('department');
        } else {
            $this->db->select('*');
            $this->db->where('df', 0);
            $this->db->where('status', 1);
            //$this->db->where('id',$user_det['department_id']);
            $query = $this->db->get('department');
        }
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function insert_notice($data) {
        if ($this->db->insert($this->table_name4, $data)) {
            $history_id = $this->db->insert_id();

            return array('id' => $history_id);
        }
        return false;
    }

    function get_notice() {
        $current_date = date('Y-m-d');

        $this->db->select('notice_board.*');


        $this->db->where('notice_board.notice_to >=', $current_date);
        $this->db->where('notice_board.status', 0);
        $this->db->order_by('notice_board.id', 'desc');
        $query = $this->db->get($this->table_name4)->result_array();
        $i = 0;
        foreach ($query as $row) {
            if ($row['staff_type'] == 'admin') {
                $this->db->select('admin.name as name');
                $this->db->where('id', $row['created_by']);
                $query[$i]['staff'] = $this->db->get('admin')->result_array();
            } else {
                $this->db->select('staff.staff_name as name');
                $this->db->where('id', $row['created_by']);
                $query[$i]['staff'] = $this->db->get('staff')->result_array();
            }
            $this->db->select('department.department');
            $this->db->where('id', $row['depart_id']);
            $query[$i]['department'] = $this->db->get('department')->result_array();
            $this->db->select('group.group');
            $this->db->where('id', $row['group_id']);
            $query[$i]['group'] = $this->db->get('group')->result_array();

            $i++;
        }
        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    function get_notice_for_staff() {
        $current_date = date('Y-m-d');

        $this->db->select('notice_board.*');
        $this->db->where('notice_board.notice_to >=', $current_date);
        $this->db->where('notice_board.status', 0);

        //$this->db->where("(notice_board.notice_type=1 OR notice_board.notice_type=0 OR notice_board.view_type=0 OR notice_board.view_type=2 OR notice_board.view_type=3)", NULL, FALSE);
        $this->db->order_by('notice_board.id', 'desc');
        $query = $this->db->get('notice_board')->result_array();
        $i = 0;
        foreach ($query as $row) {
            if ($row['staff_type'] == 'admin') {
                $this->db->select('admin.name as name');
                $this->db->where('id', $row['created_by']);
                $query[$i]['staff'] = $this->db->get('admin')->result_array();
            } else {
                $this->db->select('staff.staff_name as name');
                $this->db->where('id', $row['created_by']);
                $query[$i]['staff'] = $this->db->get('staff')->result_array();
            }
            $this->db->select('department.department');
            $this->db->where('id', $row['depart_id']);
            $query[$i]['department'] = $this->db->get('department')->result_array();
            $this->db->select('group.group');
            $this->db->where('id', $row['group_id']);
            $query[$i]['group'] = $this->db->get('group')->result_array();

            $i++;
        }
        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    function delete_notice($id) {
        $this->db->where('id', $id);

        if ($this->db->update($this->table_name4, $data = array('status' => 1))) {

            return true;
        }
        return false;
    }

    function get_all_students() {
        $this->db->select('id');
        $count = $this->db->get('student')->num_rows();
        if ($count) {
            return $count;
        }
        return false;
    }

    function get_all_std_attendance() {
        $today = date('Y-m-d');
        $this->db->select('std_id');
        $this->db->where("date = '" . $today . "'");
        $this->db->group_by("std_id");
        $count = $this->db->get('attendance_stud_deta')->num_rows();
        if ($count) {
            return $count;
        }
        return false;
    }

    function get_all_staff() {
        $this->db->select('id');
        $count = $this->db->get('staff')->num_rows();
        if ($count) {
            return $count;
        }
        return false;
    }

    function attendance_staff_det() {
        $today = date('Y-m-d');
        $this->db->select('staff_id');
        $this->db->where("date = '" . $today . "'");
        $this->db->group_by("staff_id");
        $this->db->where('staff_id !=', '0');
        $count = $this->db->get('staff_attendance')->num_rows();
        if ($count) {
            return $count;
        }
        return false;
    }

    function get_all_subjects() {
        $this->db->select('id');
        $count = $this->db->get('subject_details')->num_rows();
        if ($count) {
            return $count;
        }
        return false;
    }

    function get_all_day_order_count() {
        $today = date('Y-m-d');
        $this->db->select('title');
        $this->db->or_where("from >= '" . $today . "'");
        $count = $this->db->get('college_calenar')->num_rows();
        if ($count) {
            return $count;
        }
        return false;
    }

    function get_all_day_orders() {
        $today = date('Y-m-d');
        $this->db->select('title');
        $this->db->where("from = '" . $today . "'");
        //   $this->db->or_where("to = '" . $today . "'");
        $count = $this->db->get('college_calenar')->num_rows();
        if ($count) {
            return $count;
        }
        return false;
    }

    function today_events($batch) {
        $today = date('Y-m-d');
        $this->db->select('id');
        $this->db->where("batch_id", $batch);
        $this->db->where("date = '" . $today . "'");
        $count = $this->db->get('events')->num_rows();
        if ($count) {
            return $count;
        }
        return false;
    }

    function get_all_events($batch) {
        $this->db->select('id');
        $this->db->where("batch_id", $batch);
        $count = $this->db->get('events')->num_rows();
        if ($count) {
            return $count;
        }
        return false;
    }

}
