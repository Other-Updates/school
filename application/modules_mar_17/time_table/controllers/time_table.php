<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Time_table extends MX_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('master/master_model');
        $this->load->model('batch/batch_model');
        $this->load->model('subject/subject_model');
        $user_det = $this->session->userdata('logged_in');
        $permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
        if ($permission[0]['time_table'] == 0)
            redirect($this->config->item('base_url') . 'admin/index');
    }

    public function index() {
        $this->load->model('group/group_model');
        $this->load->model('student/student_model');
        $this->load->model('staff/staff_model');
        $this->load->model('semester/semester_model');
        $this->load->model('subject/subject_model');
        $this->load->model('time_table/time_table_model');
        $user_det = $this->session->userdata('logged_in');

        $data['all_batch'] = $this->student_model->get_all_batch();
        $data['all_depart'] = $this->group_model->get_all_department();
        $data['all_semester'] = $this->semester_model->get_semester();


        $data['batch'] = $this->batch_model->get_default_batch();
        $data['term'] = $this->subject_model->get_default_term();


        $this->template->write_view('content', 'time_table/index', $data);
        $this->template->render();
    }

    public function create_time_table() {
        $this->load->model('time_table/time_table_model');
        $data['ajax_val'] = $this->input->POST();
        $datas['print_id'] = $this->input->POST();
        $datas['all_info'] = $this->time_table_model->get_all_details_by_id($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['select_sem']);

        if (isset($datas['all_info']) && !empty($datas['all_info'])) {
            $datas['all_subject'] = $this->time_table_model->get_subject_by_id1($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['select_sem']);
            echo $this->load->view('time_table/view_table', $datas);
        } else {
            $data['all_subject'] = $this->time_table_model->get_subject_by_id1($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['select_sem']);
            echo $this->load->view('time_table/create_table', $data);
        }
    }

    public function print_time_table($b_id, $d_id, $g_id, $s_id) {
        $this->load->model('time_table/time_table_model');
        if (is_numeric($b_id) && is_numeric($d_id) && is_numeric($g_id) && is_numeric($s_id)) {
            $datas['all_info'] = $this->time_table_model->get_all_details_by_id($b_id, $d_id, $g_id, $s_id);
            $datas['all_subject'] = $this->time_table_model->get_subject_by_id($b_id, $d_id, $g_id, $s_id);
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
        if (isset($datas['all_info']) && !empty($datas['all_info'])) {
            $this->template->write_view('content', 'time_table/view_time_table_for_print', $datas);
            $this->template->render();
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
    }

    public function get_staff_by_subject_id() {
        $this->load->model('time_table/time_table_model');
        $staff_name = $this->time_table_model->get_staff_info($this->input->POST('subject_id'));
        echo $staff_name[0]['staff_name'];
    }

    public function insert_time_table() {
        $this->load->model('time_table/time_table_model');
        $this->load->model('api/notification_model');
        $data['ajax_value'] = $this->input->POST();
        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => 'Class Time Table Added', 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);
        $where = array('batch_id' => $data['ajax_value']['select_batch'], 'depart_id' => $data['ajax_value']['depart_id'], 'group_id' => $data['ajax_value']['group_id'], 'semester_id' => $data['ajax_value']['select_sem']);
        $all_staff = $this->notification_model->get_all_staff($where);
        //Time table mail template added
        $where = array('subject_details.batch_id' => $data['ajax_value']['select_batch'], 'subject_details.depart_id' => $data['ajax_value']['depart_id'], 'subject_details.group_id' => $data['ajax_value']['group_id'], 'subject_details.semester_id' => $data['ajax_value']['select_sem']);
        $all_staff_for_email = $this->notification_model->get_all_staff_for_email($where);
        /* foreach($all_staff_for_email as $val1)
          {
          $links='time_table/print_time_table/'.$data['ajax_value']['select_batch'].'/'.$data['ajax_value']['depart_id'].'/'.$data['ajax_value']['group_id'].'/'.$data['ajax_value']['select_sem'];
          $this->load->library('email');
          $data['title']='[iBoard] Class Time Table Created';
          $this->email->from('noreply@email.com', 'iBoard');
          $this->email->to($val1['email_id']);
          $this->email->subject('[iBoard] Class Time Table Created');
          $this->email->set_mailtype("html");
          $input_data['student']=array('name'=>$val1['staff_name'],'created_by'=>$session_data['name'],'time_table_type'=>'class_time_table','staff_type'=>'staff','links'=>$links);
          $msg = $this->load->view('time_table/time_table_email_formate',$input_data,TRUE);
          $this->email->message($msg);
          $this->email->send();
          } */
        $i = 0;
        foreach ($all_staff as $val1) {
            $all_staff[$i]['notification_id'] = $last_id['id'];
            $all_staff[$i]['user_type'] = 'staff';
            $all_staff[$i]['links'] = 'time_table/print_time_table/' . $data['ajax_value']['select_batch'] . '/' . $data['ajax_value']['depart_id'] . '/' . $data['ajax_value']['group_id'] . '/' . $data['ajax_value']['select_sem'];
            $all_staff[$i]['read'] = 0;
            $i++;
        }
        $this->notification_model->insert_all_staff($all_staff);
        $where1 = array('student_group.batch_id' => $data['ajax_value']['select_batch'], 'student_group.depart_id' => $data['ajax_value']['depart_id'], 'student_group.group_id' => $data['ajax_value']['group_id']);
        $all_student = $this->notification_model->get_all_student($where1);

        //Time table mail template added
        $where1 = array('student_group.batch_id' => $data['ajax_value']['select_batch'], 'student_group.depart_id' => $data['ajax_value']['depart_id'], 'student_group.group_id' => $data['ajax_value']['group_id']);
        $all_student_for_email = $this->notification_model->get_all_student_for_email($where1);
        /* foreach($all_student_for_email as $val1)
          {
          $links='users/time_table';
          $this->load->library('email');
          $data['title']='[iBoard] Class Time Table Created';
          $this->email->from('noreply@email.com', 'iBoard');
          $this->email->to($val1['email_id']);
          $this->email->subject('[iBoard] Class Time Table Created');
          $this->email->set_mailtype("html");
          $input_data['student']=array('name'=>$val1['staff_name'],'created_by'=>$session_data['name'],'time_table_type'=>'class_time_table','staff_type'=>'student','links'=>$links);
          $msg = $this->load->view('time_table/time_table_email_formate',$input_data,TRUE);
          $this->email->message($msg);
          $this->email->send();
          } */
        $j = 0;
        foreach ($all_student as $val1) {
            $all_student[$j]['notification_id'] = $last_id['id'];
            $all_student[$j]['user_type'] = 'student';
            $all_student[$j]['links'] = 'users/time_table';
            $all_student[$j]['read'] = 0;
            unset($all_student[$j]['email_id']);
            $j++;
        }
        $this->notification_model->insert_all_staff($all_student);
        $insert_array = array('batch_id' => $data['ajax_value']['select_batch'], 'depart_id' => $data['ajax_value']['depart_id'], 'group_id' => $data['ajax_value']['group_id'], 'time' => $data['ajax_value']['time_array'], 'semester_id' => $data['ajax_value']['select_sem']);
        $insert_id = $this->time_table_model->insert_time_data($insert_array);
        $i = 1;
        $j = 1;
        $total_days = $this->time_table_model->get_values_by_type('total_day_order');
        $total_hours = $this->time_table_model->get_values_by_type('total_hours');
        foreach ($data['ajax_value']['time_list'] as $val) {
            if ($val != 'Select') {
                $detail_insert_array = array('time_table_id' => $insert_id['id'], 'supject_id' => $val, 'day_order' => $i, 'hours' => $j);
                $this->time_table_model->insert_time_details_data($detail_insert_array);
                if ($j == $total_hours[0]['details']) {
                    $i++;
                    $j = 0;
                }
                $j++;
            }
        }
    }

    public function update_time_table() {
        $this->load->model('time_table/time_table_model');
        $this->load->model('api/notification_model');
        $data['ajax_value'] = $this->input->POST();

        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => 'Class Time Table Modified', 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);
        $where = array('batch_id' => $data['ajax_value']['select_batch'], 'depart_id' => $data['ajax_value']['depart_id'], 'group_id' => $data['ajax_value']['group_id'], 'semester_id' => $data['ajax_value']['select_sem']);
        $all_staff = $this->notification_model->get_all_staff($where);
        //Time table mail template updated
        $where = array('subject_details.batch_id' => $data['ajax_value']['select_batch'], 'subject_details.depart_id' => $data['ajax_value']['depart_id'], 'subject_details.group_id' => $data['ajax_value']['group_id'], 'subject_details.semester_id' => $data['ajax_value']['select_sem']);
        $all_staff_for_email = $this->notification_model->get_all_staff_for_email($where);
        foreach ($all_staff_for_email as $val1) {
            $links = 'time_table/print_time_table/' . $data['ajax_value']['select_batch'] . '/' . $data['ajax_value']['depart_id'] . '/' . $data['ajax_value']['group_id'] . '/' . $data['ajax_value']['select_sem'];
//            $this->load->library('email');
//            $data['title'] = '[iBoard] Class Time Table Updated';
//            $this->email->from('noreply@email.com', 'iBoard');
//            $this->email->to($val1['email_id']);
//            $this->email->subject('[iBoard] Class Time Table Updated');
//            $this->email->set_mailtype("html");
//            $input_data['student'] = array('name' => $val1['staff_name'], 'created_by' => $session_data['name'], 'time_table_type' => 'class_time_table_update', 'staff_type' => 'staff', 'links' => $links);
//            $msg = $this->load->view('time_table/time_table_email_formate', $input_data, TRUE);
//            $this->email->message($msg);
//            $this->email->send();
        }
        $i = 0;
        foreach ($all_staff as $val1) {
            $all_staff[$i]['notification_id'] = $last_id['id'];
            $all_staff[$i]['user_type'] = 'staff';
            $all_staff[$i]['links'] = 'time_table/print_time_table/' . $data['ajax_value']['select_batch'] . '/' . $data['ajax_value']['depart_id'] . '/' . $data['ajax_value']['group_id'] . '/' . $data['ajax_value']['select_sem'];
            $all_staff[$i]['read'] = 0;
            $i++;
        }
        $this->notification_model->insert_all_staff($all_staff);
        $where1 = array('student_group.batch_id' => $data['ajax_value']['select_batch'], 'student_group.depart_id' => $data['ajax_value']['depart_id'], 'student_group.group_id' => $data['ajax_value']['group_id']);
        $all_student = $this->notification_model->get_all_student($where1);

        //Time table mail template updated
        $where1 = array('student_group.batch_id' => $data['ajax_value']['select_batch'], 'student_group.depart_id' => $data['ajax_value']['depart_id'], 'student_group.group_id' => $data['ajax_value']['group_id']);
        $all_student_for_email = $this->notification_model->get_all_student_for_email($where1);
        foreach ($all_student_for_email as $val1) {
//            $links = 'users/time_table';
//            $this->load->library('email');
//            $data['title'] = '[iBoard] Class Time Table Updated';
//            $this->email->from('noreply@email.com', 'iBoard');
//            $this->email->to($val1['email_id']);
//            $this->email->subject('[iBoard] Class Time Table Updated');
//            $this->email->set_mailtype("html");
//            $input_data['student'] = array('name' => $val1['staff_name'], 'created_by' => $session_data['name'], 'time_table_type' => 'class_time_table_update', 'staff_type' => 'student', 'links' => $links);
//            $msg = $this->load->view('time_table/time_table_email_formate', $input_data, TRUE);
//            $this->email->message($msg);
//            $this->email->send();
        }
        $j = 0;
        foreach ($all_student as $val1) {
            $all_student[$j]['notification_id'] = $last_id['id'];
            $all_student[$j]['user_type'] = 'student';
            $all_student[$j]['links'] = 'users/time_table';
            $all_student[$j]['read'] = 0;
            unset($all_student[$j]['email_id']);
            $j++;
        }
        $this->notification_model->insert_all_staff($all_student);


        $insert_array = array('batch_id' => $data['ajax_value']['select_batch'], 'depart_id' => $data['ajax_value']['depart_id'], 'group_id' => $data['ajax_value']['group_id'], 'time' => $data['ajax_value']['time_array'], 'semester_id' => $data['ajax_value']['select_sem'], 'modified_by' => $this->user_auth->get_user_id());
        $this->time_table_model->update_time_data($insert_array, $data['ajax_value']['hide_id']);
        $this->time_table_model->delete_time_table($data['ajax_value']['hide_id']);
        $i = 1;
        $j = 1;
        $total_days = $this->time_table_model->get_values_by_type('total_day_order');
        $total_hours = $this->time_table_model->get_values_by_type('total_hours');
        foreach ($data['ajax_value']['time_list'] as $val) {
            if ($val != 'Select') {
                $detail_insert_array = array('time_table_id' => $data['ajax_value']['hide_id'], 'supject_id' => $val, 'day_order' => $i, 'hours' => $j);
                $this->time_table_model->insert_time_details_data($detail_insert_array);
                if ($j == $total_hours[0]['details']) {
                    $i++;
                    $j = 0;
                }
                $j++;
            }
        }
    }

    public function create_other_time_table() {
        $this->load->model('time_table/time_table_model');
        $data['ajax_val'] = $this->input->POST();

        $data['int_info'] = $this->time_table_model->check_time_table($data['ajax_val']);

        if (isset($data['int_info']) && !empty($data['int_info'])) {
            $data['all_subject'] = $this->time_table_model->get_subject_by_id($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['select_sem']);
            echo $this->load->view('time_table/view_other_table', $data);
        } else {
            $data['all_subject'] = $this->time_table_model->get_subject_by_id($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['select_sem']);
            echo $this->load->view('time_table/create_other_table', $data);
        }
    }

    public function print_other_time_table($b_id, $d_id, $g_id, $s_id, $m_id, $ty_id) {
        $this->load->model('time_table/time_table_model');
        if (is_numeric($b_id) && is_numeric($d_id) && is_numeric($g_id) && is_numeric($s_id) && is_numeric($ty_id)) {
            $data['ajax_val'] = array('batch_id' => $b_id, 'depart_id' => $d_id, 'group_id' => $g_id, 'semester_id' => $s_id, 'time_table_method' => $m_id, 'time_table_type' => $ty_id);
            $data['int_info'] = $this->time_table_model->print_other_time_table($data['ajax_val']);
            $data['all_subject'] = $this->time_table_model->get_subject_by_id($data['ajax_val']['batch_id'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['semester_id']);
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
        if (isset($data['int_info']) && !empty($data['int_info'])) {
            $this->template->write_view('content', 'time_table/view_other_time_table_for_print', $data);
            $this->template->render();
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
    }

    public function insert_other_time_table() {
        $this->load->model('time_table/time_table_model');
        $this->load->model('api/notification_model');
        $data['ajax_val'] = $this->input->POST();
        if ($data['ajax_val']['select_type'] == 1) {
            $links = 'users/other_time_table';
            $links1 = 'time_table/print_other_time_table/' . $data['ajax_val']['select_batch'] . '/' . $data['ajax_val']['depart_id'] . '/' . $data['ajax_val']['group_id'] . '/' . $data['ajax_val']['select_sem'] . '/internal/' . $data['ajax_val']['int_id'];
            $title = 'Internal Time Table Added';
        } else if ($data['ajax_val']['select_type'] == 2) {
            $links = 'users/model_time_table';
            $links1 = 'time_table/print_other_time_table/' . $data['ajax_val']['select_batch'] . '/' . $data['ajax_val']['depart_id'] . '/' . $data['ajax_val']['group_id'] . '/' . $data['ajax_val']['select_sem'] . '/external/' . $data['ajax_val']['int_id'];
            $title = 'Model Time Table Added';
        } else if ($data['ajax_val']['select_type'] == 3) {
            $links = 'users/exam_time_table';
            $links1 = 'time_table/print_other_time_table/' . $data['ajax_val']['select_batch'] . '/' . $data['ajax_val']['depart_id'] . '/' . $data['ajax_val']['group_id'] . '/' . $data['ajax_val']['select_sem'] . '/exam/' . $data['ajax_val']['int_id'];
            $title = 'Exam Time Table Added';
        }

        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);
        $where = array('batch_id' => $data['ajax_val']['select_batch'], 'depart_id' => $data['ajax_val']['depart_id'], 'group_id' => $data['ajax_val']['group_id'], 'semester_id' => $data['ajax_val']['select_sem']);
        $all_staff = $this->notification_model->get_all_staff($where);
        $i = 0;

        //Time table mail template added
        $where = array('subject_details.batch_id' => $data['ajax_val']['select_batch'], 'subject_details.depart_id' => $data['ajax_val']['depart_id'], 'subject_details.group_id' => $data['ajax_val']['group_id'], 'subject_details.semester_id' => $data['ajax_val']['select_sem']);
        $all_staff_for_email = $this->notification_model->get_all_staff_for_email($where);
//        $this->load->library('email');
//        foreach ($all_staff_for_email as $val1) {
//            $data['title'] = '[iBoard]' . $title;
//            $this->email->from('noreply@email.com', 'iBoard');
//            $this->email->to($val1['email_id']);
//            $this->email->subject('[iBoard] ' . $title);
//            $this->email->set_mailtype("html");
//            $input_data['student'] = array('name' => $val1['staff_name'], 'created_by' => $session_data['name'], 'time_table_type' => 'other_time_table', 'staff_type' => 'staff', 'links' => $links1, 'title' => $title);
//            $msg = $this->load->view('time_table/time_table_email_formate', $input_data, TRUE);
//            $this->email->message($msg);
//            $this->email->send();
//        }

        foreach ($all_staff as $val1) {
            $all_staff[$i]['notification_id'] = $last_id['id'];
            $all_staff[$i]['user_type'] = 'staff';
            $all_staff[$i]['links'] = $links1;
            $all_staff[$i]['read'] = 0;
            $i++;
        }
        $this->notification_model->insert_all_staff($all_staff);
        $where1 = array('student_group.batch_id' => $data['ajax_val']['select_batch'], 'student_group.depart_id' => $data['ajax_val']['depart_id'], 'student_group.group_id' => $data['ajax_val']['group_id']);
        $all_student = $this->notification_model->get_all_student($where1);

        //Time table mail template updated
        $where1 = array('student_group.batch_id' => $data['ajax_val']['select_batch'], 'student_group.depart_id' => $data['ajax_val']['depart_id'], 'student_group.group_id' => $data['ajax_val']['group_id']);
        $all_student_for_email = $this->notification_model->get_all_student_for_email($where1);
//        foreach ($all_student_for_email as $val1) {
//            $this->load->library('email');
//            $data['title'] = '[iBoard] ' . $title;
//            $this->email->from('noreply@email.com', 'iBoard');
//            $this->email->to($val1['email_id']);
//            $this->email->subject('[iBoard] ' . $title);
//            $this->email->set_mailtype("html");
//            $input_data['student'] = array('name' => $val1['staff_name'], 'created_by' => $session_data['name'], 'time_table_type' => 'class_time_table_update', 'staff_type' => 'student', 'links' => $links, 'title' => $title);
//            $msg = $this->load->view('time_table/time_table_email_formate', $input_data, TRUE);
//            $this->email->message($msg);
//            $this->email->send();
//        }

        $j = 0;
        foreach ($all_student as $val1) {
            $all_student[$j]['notification_id'] = $last_id['id'];
            $all_student[$j]['user_type'] = 'student';
            $all_student[$j]['links'] = $links;
            $all_student[$j]['read'] = 0;
            unset($all_student[$j]['email_id']);
            $j++;
        }
        $this->notification_model->insert_all_staff($all_student);



        $insert_array = array("batch_id" => $data['ajax_val']['select_batch'], "depart_id" => $data['ajax_val']['depart_id'], "group_id" => $data['ajax_val']['group_id'], "semester_id" => $data['ajax_val']['select_sem'], "time_table_method" => $data['ajax_val']['select_type'], "time_table_type" => $data['ajax_val']['int_id'], "created_by" => $this->user_auth->get_user_id());
        $ints_id = $this->time_table_model->insert_other_time_table($insert_array);
        foreach ($data['ajax_val']['date_arr'] as $key => $val) {
            if (!empty($val)) {
                $val = date('Y-m-d', strtotime($val));
                $insert = array('other_time_table_id' => $ints_id['id'], 'subject_id' => $data['ajax_val']['sub_arr'][$key], 'date' => $val, 'time_in' => $data['ajax_val']['in_arr'][$key], 'time_out' => $data['ajax_val']['out_arr'][$key]);
                $this->time_table_model->insert_other_time_details($insert);
            }
        }
    }

    public function update_other_time_table() {
        $this->load->model('time_table/time_table_model');
        $this->load->model('api/notification_model');
        $data['ajax_val'] = $this->input->POST();

        /* 	if($data['ajax_val']['select_type']==1)
          $title='Internal Time Table Modified';
          else if($data['ajax_val']['select_type']==2)
          $title='External Time Table Modified';
          else if($data['ajax_val']['select_type']==3)
          $title='Exam Time Table Modified'; */
        if ($data['ajax_val']['select_type'] == 1) {
            $links = 'users/other_time_table';
            $links1 = 'time_table/print_other_time_table/' . $data['ajax_val']['select_batch'] . '/' . $data['ajax_val']['depart_id'] . '/' . $data['ajax_val']['group_id'] . '/' . $data['ajax_val']['select_sem'] . '/internal/' . $data['ajax_val']['int_id'];
            $title = 'Internal Time Table Updated';
        } else if ($data['ajax_val']['select_type'] == 2) {
            $links = 'users/model_time_table';
            $links1 = 'time_table/print_other_time_table/' . $data['ajax_val']['select_batch'] . '/' . $data['ajax_val']['depart_id'] . '/' . $data['ajax_val']['group_id'] . '/' . $data['ajax_val']['select_sem'] . '/external/' . $data['ajax_val']['int_id'];
            $title = 'Model Time Table Updated';
        } else if ($data['ajax_val']['select_type'] == 3) {
            $links = 'users/exam_time_table';
            $links1 = 'time_table/print_other_time_table/' . $data['ajax_val']['select_batch'] . '/' . $data['ajax_val']['depart_id'] . '/' . $data['ajax_val']['group_id'] . '/' . $data['ajax_val']['select_sem'] . '/exam/' . $data['ajax_val']['int_id'];
            $title = 'Exam Time Table Updated';
        }
        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);
        $where = array('batch_id' => $data['ajax_val']['select_batch'], 'depart_id' => $data['ajax_val']['depart_id'], 'group_id' => $data['ajax_val']['group_id'], 'semester_id' => $data['ajax_val']['select_sem']);
        $all_staff = $this->notification_model->get_all_staff($where);


        //Time table mail template added
        $where = array('subject_details.batch_id' => $data['ajax_val']['select_batch'], 'subject_details.depart_id' => $data['ajax_val']['depart_id'], 'subject_details.group_id' => $data['ajax_val']['group_id'], 'subject_details.semester_id' => $data['ajax_val']['select_sem']);
        $all_staff_for_email = $this->notification_model->get_all_staff_for_email($where);
//        $this->load->library('email');
//        foreach ($all_staff_for_email as $val1) {
//            $data['title'] = '[iBoard]' . $title;
//            $this->email->from('noreply@email.com', 'iBoard');
//            $this->email->to($val1['email_id']);
//            $this->email->subject('[iBoard] ' . $title);
//            $this->email->set_mailtype("html");
//            $input_data['student'] = array('name' => $val1['staff_name'], 'created_by' => $session_data['name'], 'time_table_type' => 'other_time_table', 'staff_type' => 'staff', 'links' => $links1, 'title' => $title);
//            $msg = $this->load->view('time_table/time_table_email_formate', $input_data, TRUE);
//            $this->email->message($msg);
//            $this->email->send();
//        }
        $i = 0;
        foreach ($all_staff as $val1) {
            $all_staff[$i]['notification_id'] = $last_id['id'];
            $all_staff[$i]['user_type'] = 'staff';
            $all_staff[$i]['links'] = $links1;
            $all_staff[$i]['read'] = 0;
            $i++;
        }
        $this->notification_model->insert_all_staff($all_staff);
        $where1 = array('student_group.batch_id' => $data['ajax_val']['select_batch'], 'student_group.depart_id' => $data['ajax_val']['student_group.depart_id'], 'student_group.group_id' => $data['ajax_val']['group_id']);
        $all_student = $this->notification_model->get_all_student($where1);


        //Time table mail template updated
        $where1 = array('student_group.batch_id' => $data['ajax_val']['select_batch'], 'student_group.depart_id' => $data['ajax_val']['depart_id'], 'student_group.group_id' => $data['ajax_val']['group_id']);
        $all_student_for_email = $this->notification_model->get_all_student_for_email($where1);
//        foreach ($all_student_for_email as $val1) {
//            $this->load->library('email');
//            $data['title'] = '[iBoard] ' . $title;
//            $this->email->from('noreply@email.com', 'iBoard');
//            $this->email->to($val1['email_id']);
//            $this->email->subject('[iBoard] ' . $title);
//            $this->email->set_mailtype("html");
//            $input_data['student'] = array('name' => $val1['name'], 'created_by' => $session_data['name'], 'time_table_type' => 'other_time_table', 'staff_type' => 'student', 'links' => $links1, 'title' => $title);
//            $msg = $this->load->view('time_table/time_table_email_formate', $input_data, TRUE);
//            $this->email->message($msg);
//            $this->email->send();
//        }
        $j = 0;
        foreach ($all_student as $val1) {
            $all_student[$j]['notification_id'] = $last_id['id'];
            $all_student[$j]['user_type'] = 'student';
            $all_student[$j]['links'] = $links;
            $all_student[$j]['read'] = 0;
            unset($all_student[$j]['email_id']);
            $j++;
        }
        $this->notification_model->insert_all_staff($all_student);
        $this->time_table_model->delete_other_time_table($data['ajax_val']['other_time_id']);
        foreach ($data['ajax_val']['date_arr'] as $key => $val) {
            if ($val != '') {
                $val = date('Y-m-d', strtotime($val));
                $insert = array('other_time_table_id' => $data['ajax_val']['other_time_id'], 'subject_id' => $data['ajax_val']['sub_arr'][$key], 'date' => $val, 'time_in' => $data['ajax_val']['in_arr'][$key], 'time_out' => $data['ajax_val']['out_arr'][$key]);
                $this->time_table_model->insert_other_time_details($insert);
            }
        }
    }

    function staff_time_table() {
        $this->load->model('time_table/time_table_model');
        $total_hours = $this->time_table_model->get_values_by_type('total_hours');
        $total_days = $this->time_table_model->get_values_by_type('total_day_order');
        $session_data = $this->session->userdata('logged_in');
        for ($j = 1; $j <= $total_days[0]['details']; $j++) {
            for ($i = 1; $i <= $total_hours[0]['details']; $i++) {
                $check_array = array('day_order' => $j, 'hours' => $i);
                $data['list'][] = $this->time_table_model->get_staff_time_table($check_array, $session_data['user_id']);
            }
        }
        $this->template->write_view('content', 'time_table/staff_time_table', $data);
        $this->template->render();
    }

    public function get_all_group() {
        $this->load->model('student/student_model');
        $this->load->model('subject/subject_model');
        $d_id = $this->input->post();
        $user_det = $this->session->userdata('logged_in');
        if ($user_det['staff_type'] == 'staff')
            $g_array = $this->student_model->get_all_group($d_id['depart_id']);
        else
            $g_array = $this->student_model->get_all_group($d_id['depart_id']);
        $g_select = '<select id="group_id" name="student_group[group_id]" class="mandatory" tabindex="5"><option value="">Select</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    function get_arrear_table() {
        $this->load->model('group/group_model');
        $this->load->model('student/student_model');
        $this->load->model('staff/staff_model');
        $this->load->model('semester/semester_model');
        $this->load->model('subject/subject_model');
        $user_det = $this->session->userdata('logged_in');

        $data['all_batch'] = $this->student_model->get_all_batch();
        $data['all_depart'] = $this->group_model->get_all_department();
        $data['all_semester'] = $this->semester_model->get_semester();
        echo $this->load->view('time_table/arrear_table', $data);
    }

    function get_arrear_subject() {
        $this->load->model('group/group_model');
        $this->load->model('student/student_model');
        $this->load->model('staff/staff_model');
        $this->load->model('semester/semester_model');
        $this->load->model('subject/subject_model');
        $this->load->model('time_table/time_table_model');
        $user_det = $this->session->userdata('logged_in');

        $data['all_batch'] = $this->student_model->get_all_batch();
        $data['all_depart'] = $this->group_model->get_all_department();
        $data['all_semester'] = $this->semester_model->get_semester();
        $department = $this->input->post('department');
        $sem = $this->input->post('sem');

        $g_array = $this->time_table_model->get_arrear_subject($department, $sem);
        $g_select = '<select id="arrear_subject" style="width:300px;"  class="mandatory arrear_subject"><option value="">Select</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['scode'] . "'>" . $val['scode'] . "-" . $val['subject_name'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    function create_arrear_time_table() {
        $this->load->model('group/group_model');
        $this->load->model('student/student_model');
        $this->load->model('staff/staff_model');
        $this->load->model('semester/semester_model');
        $this->load->model('subject/subject_model');
        $this->load->model('time_table/time_table_model');
        $data['all_depart'] = $this->group_model->get_all_department();
        $data['all_semester'] = $this->semester_model->get_semester();
        $depart_id = $this->input->get('depart_id');
        $data['arrear_exam'] = $this->time_table_model->get_arrear_time_table($depart_id);

        if (isset($data['arrear_exam']) && !empty($data['arrear_exam'])) {
            echo $this->load->view('time_table/view_arrear_time_table', $data);
        } else {
            echo $this->load->view('time_table/create_arrear_time_table', $data);
        }
    }

    function insert_arrear_time_table() {

        $this->load->model('time_table/time_table_model');
        $this->load->model('api/notification_model');
        $user_det = $this->session->userdata('logged_in');
        $data['ajax_val'] = $this->input->post();
        //echo "<pre>"; print_r($data['ajax_val']['date_arr']);
        foreach ($data['ajax_val']['date_arr'] as $key => $val) {
            if (!empty($val)) {
                $val = date('Y-m-d', strtotime($val));
                $insert = array('depart_id' => $data['ajax_val']['depart_id'], 'semester_id' => $data['ajax_val']['select_sem'][$key], 'subject_id' => $data['ajax_val']['sub_arr'][$key], 'date_of_exam' => $val, 'in_time' => $data['ajax_val']['in_arr'][$key], 'out_time' => $data['ajax_val']['out_arr'][$key], 'created_by' => $user_det['user_id'], 'user_type' => $user_det['staff_type']);
                $this->time_table_model->insert_arrear_time_table($insert);
            }
        }
        echo "Hi";
        //Notification to staff

        $links = 'time_table/staff_table/staff_view_time_table';
        $title = 'Arrear Exam Time Table Added';
        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);
        $all_staff = $this->notification_model->get_all_staff_for_arrear();

        $i = 0;
        foreach ($all_staff as $val1) {
            $all_staff[$i]['notification_id'] = $last_id['id'];
            $all_staff[$i]['user_type'] = 'staff';
            $all_staff[$i]['links'] = $links;
            $all_staff[$i]['read'] = 0;
            $i++;
        }
        $this->notification_model->insert_all_staff($all_staff);

        // Notification to student
        $links1 = 'users/arrear_time_table';
        $where1 = array('student_group.depart_id' => $data['ajax_val']['depart_id']);
        $all_student = $this->notification_model->get_all_student_for_arrear($where1);
        $j = 0;
        foreach ($all_student as $val1) {
            $all_student[$j]['notification_id'] = $last_id['id'];
            $all_student[$j]['user_type'] = 'student';
            $all_student[$j]['links'] = $links1;
            $all_student[$j]['read'] = 0;
            unset($all_student[$j]['email_id']);
            $j++;
        }
        $this->notification_model->insert_all_staff($all_student);
    }

    function update_arrear_time_table() {
        $this->load->model('time_table/time_table_model');
        $this->load->model('api/notification_model');
        $user_det = $this->session->userdata('logged_in');

        $data['ajax_val'] = $this->input->post();
        //echo "<pre>"; print_r($data['ajax_val']); exit;
        $depart_id = $data['ajax_val']['depart_id'];
        $this->time_table_model->delete_arrear_time_table($depart_id);
        foreach ($data['ajax_val']['date_arr'] as $key => $val) {
            if (!empty($val)) {
                $val = date('Y-m-d', strtotime($val));
                $update = array('depart_id' => $data['ajax_val']['depart_id'], 'semester_id' => $data['ajax_val']['select_sem'][$key], 'subject_id' => $data['ajax_val']['sub_arr'][$key], 'date_of_exam' => $val, 'in_time' => $data['ajax_val']['in_arr'][$key], 'out_time' => $data['ajax_val']['out_arr'][$key], 'created_by' => $user_det['user_id'], 'user_type' => $user_det['staff_type']);
                $this->time_table_model->insert_arrear_time_table($update);
            }
        }
        //Notification to staff

        $links = 'time_table/staff_table/staff_view_time_table';
        $title = 'Arrear Exam Time Table Updated';
        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);
        $all_staff = $this->notification_model->get_all_staff_for_arrear();

        $i = 0;
        foreach ($all_staff as $val1) {
            $all_staff[$i]['notification_id'] = $last_id['id'];
            $all_staff[$i]['user_type'] = 'staff';
            $all_staff[$i]['links'] = $links;
            $all_staff[$i]['read'] = 0;
            $i++;
        }
        $this->notification_model->insert_all_staff($all_staff);

        // Notification to student
        $links1 = 'users/arrear_time_table';
        $where1 = array('student_group.depart_id' => $data['ajax_val']['depart_id']);
        $all_student = $this->notification_model->get_all_student_for_arrear($where1);
        $j = 0;
        foreach ($all_student as $val1) {
            $all_student[$j]['notification_id'] = $last_id['id'];
            $all_student[$j]['user_type'] = 'student';
            $all_student[$j]['links'] = $links1;
            $all_student[$j]['read'] = 0;
            unset($all_student[$j]['email_id']);
            $j++;
        }
        $this->notification_model->insert_all_staff($all_student);
    }

    function new_arrear_time_table() {
        $this->load->model('group/group_model');
        $this->load->model('student/student_model');
        $this->load->model('staff/staff_model');
        $this->load->model('semester/semester_model');
        $this->load->model('subject/subject_model');
        $this->load->model('time_table/time_table_model');
        $depart_id = $this->input->post('depart_id');
        $this->time_table_model->delete_arrear_time_table($depart_id);
        $data['all_depart'] = $this->group_model->get_all_department();
        $data['all_semester'] = $this->semester_model->get_semester();
        echo $this->load->view('time_table/create_arrear_time_table', $data);
    }

    function print_arrear_time_table($depart_id) {
        $this->load->model('time_table/time_table_model');
        $this->load->model('users/users_model');
        if (is_numeric($depart_id)) {
            $data['arrear_time'] = $this->users_model->get_arrear_time_table($depart_id);
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
        if (isset($data['arrear_time']) && !empty($data['arrear_time'])) {
            $this->template->write_view('content', 'time_table/print_arrear_time_table', $data);
            $this->template->render();
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
