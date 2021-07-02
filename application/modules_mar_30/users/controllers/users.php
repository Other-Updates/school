<?php

session_start();

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends MX_Controller {

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

        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('image_lib');
        $this->load->model('exam/exam_model');
    }

    public function index() {
        $this->load->model('staff/staff_model');
        $this->load->model('student/student_model');
        $this->load->model('master/master_model');
        if ($this->input->post('staff') == 'Login') {
            $login_details = $this->staff_model->get_user_details_by_id($this->input->post('staff_email_id'), md5($this->input->post('staff_pwd')));
            if (isset($login_details) && !empty($login_details)) {
//		$this->session->set_userdata('user_info', $login_details);
//				$user_permission=$this->master_model->get_staff_by_id($login_details[0]['id'],1);
//				$this->session->set_userdata('staff_permission', $user_permission);
//				redirect($this->config->item('base_url').'admin/dashboard');
                $sess_array = array('email' => $login_details[0]['email_id'], 'application' => 'i2_soft', 'user_id' => $login_details[0]['id'], 'name' => $login_details[0]['staff_name'], 'staff_type' => 'staff', 'profile_image' => $login_details[0]['image'], 'department_id' => $login_details[0]['depart_id']);
                $this->session->set_userdata('logged_in', $sess_array);
                $data = array('online_status' => 1);
                $this->staff_model->update_staff($data, $login_details[0]['id']);
                $user_permission = $this->master_model->get_staff_by_id($login_details[0]['id'], 1);
                $this->session->set_userdata('admin_permission', $user_permission);
                redirect($this->config->item('base_url') . 'admin/dashboard');
            } else
                redirect($this->config->item('base_url') . '?login=fail');
        }
        else if ($this->input->post('user') == 'Login') {
            $login_details = $this->student_model->get_user_details_by_id($this->input->post('user_email_id'), md5($this->input->post('user_pwd')));

            if (isset($login_details) && !empty($login_details)) {
                $this->session->set_userdata('user_info', $login_details);
                $data = array('online_status' => 1);
                $this->staff_model->update_staff1($data, $login_details[0]['id']);
                redirect($this->config->item('base_url') . 'users/dashboard');
            } else
                redirect($this->config->item('base_url') . '?login=error');
        }

        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template_login.php');
        $this->template->write_view('content', 'users/index');
        $this->template->render();
    }

    function dashboard() {
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $student_id = $this->session->userdata('user_info');

        $this->load->model('users/users_model');
        $this->load->model('admin/admin_model');
        $user_info = $this->session->userdata('user_info');
        $data = $this->users_model->attendance_dashbord($student_id);
        $data['all_info'] = $this->users_model->get_all_details_by_id1($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id']);
        $where1 = array('internal.batch_id' => $user_info[0]['batch_id'], 'internal.depart_id' => $user_info[0]['depart_id'], 'internal.group_id' => $user_info[0]['group_id']);
        $where2 = array('batch_id' => $user_info[0]['batch_id'], 'depart_id' => $user_info[0]['depart_id'], 'group_id' => $user_info[0]['group_id']);
        $data['sem_info'] = $this->users_model->get_semester_percentage($where1, $where2, $user_info[0]['id']);

        $data["notice"] = $this->users_model->get_notice_for_student();
//        $data["university_result"] = $this->users_model->get_university_result_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], $user_info[0]['id']);
        $data["all_grade"] = $this->users_model->get_university_result_by_id_student($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], $user_info[0]['id']);
//        echo '<pre>';
//        print_r($data);
//        exit;
        $this->template->write_view('content', 'users/dashboard', $data);
        $this->template->render();
    }

    function calendar() {
        $user_info = $this->session->userdata('user_info');
        $this->load->model('student/student_model');
        $this->load->model('users/users_model');
        $this->load->model('events/events_model');
//$all_events=$this->events_model->get_all_events_id();

        $where = array('student_group.batch_id' => $user_info[0]['batch_id'], 'student_group.depart_id' => $user_info[0]['depart_id'], 'student_group.group_id' => $user_info[0]['group_id']);
        $where1 = array('other_time_tables.batch_id' => $user_info[0]['batch_id'], 'other_time_tables.depart_id' => $user_info[0]['depart_id'], 'other_time_tables.group_id' => $user_info[0]['group_id']);

        $all_student = $this->student_model->get_all_student_for_users($where);
        $all_time_table = $this->users_model->get_all_time_table_for_calendar($where1);
//$where1=array('depart_id'=>$user_info[0]['depart_id'],'group_id'=>$user_info[0]['group_id'],'type'=>'Group');
        $where1 = array('depart_id' => $user_info[0]['depart_id'], 'type' => 'Group');
        $where2 = array('depart_id' => $user_info[0]['depart_id'], 'type' => 'Department');
        $where3 = array('type' => 'Public');
        $depart_events = $this->events_model->get_all_events_id($where1);
        $group_events = $this->events_model->get_all_events_id($where2);
        $public_events = $this->events_model->get_all_events_id($where3);
        $final_val = array_merge($depart_events, $group_events, $public_events);
        $this->load->model('admin/admin_model');
        $all_day_order = $this->admin_model->get_all_college_calendar();
        if (isset($all_student) && !empty($all_student)) {
            $list = 'events: [';
            $j = 1;
            if (isset($final_val) && !empty($final_val)) {
                $i = 1;

                foreach ($final_val as $val) {
                    $y = date('Y', strtotime($val['ldt']));
                    $m = date('m', strtotime($val['ldt'])) - 1;
                    $d = date('d', strtotime($val['ldt']));
                    $list = $list . "{";
                    $list = $list . "title: '" . $val['event_name'] . "',";
                    $list = $list . "start: new Date(" . $y . ", " . $m . ", " . $d . "),";
                    $list = $list . "backgroundColor: '#f56954',";
                    $list = $list . "borderColor: '#f56954',";
                    $list = $list . "url: '" . $this->config->item('base_url') . "users/events_view/'";
                    $list = $list . "},";
                    $i++;
                }
            }
            if (isset($all_time_table) && !empty($all_time_table)) {

                foreach ($all_time_table as $val) {

                    $y = date('Y', strtotime($val['date']));
                    $m = date('m', strtotime($val['date'])) - 1;
                    $d = date('d', strtotime($val['date']));
                    $list = $list . "{";
                    if ($val['time_table_method'] == 'internal') {
                        $list = $list . "title: '" . ucfirst($val['time_table_method']) . '-' . $val['time_table_type'] . ': ' . ucfirst($val['subject_name']) . "',";
                        $list = $list . "backgroundColor: 'rgb(223, 93, 186)',";
                    }
                    if ($val['time_table_method'] == 'exam') {
                        $list = $list . "title: 'External - " . ucfirst($val['subject_name']) . "',";
                        $list = $list . "backgroundColor: 'rgb(91, 173, 80)',";
                    }
                    if ($val['time_table_method'] == 'external') {
                        $list = $list . "title: 'Model - " . ucfirst($val['subject_name']) . "',";
                        $list = $list . "backgroundColor: 'rgb(233, 156, 127)',";
                    }
                    $list = $list . "start: '" . $val['date'] . "T" . $val['time_in'] . "',";
                    $list = $list . "end: '" . $val['date'] . "T" . $val['time_out'] . "',";


                    $list = $list . "borderColor: '#fff'";
                    $list = $list . "},";
                }
            }
            if (isset($all_day_order) && !empty($all_day_order)) {
                foreach ($all_day_order as $val) {
                    $y = date('Y', strtotime($val['from']));
                    $m = date('m', strtotime($val['from'])) - 1;
                    $d = date('d', strtotime($val['from']));

                    $y1 = date('Y', strtotime($val['to']));
                    $m1 = date('m', strtotime($val['to'])) - 1;
                    $d1 = date('d', strtotime($val['to']));
                    $list = $list . "{";
                    $list = $list . "title: '" . $val['title'] . "',";
                    $list = $list . "start: new Date(" . $y . ", " . $m . ", " . $d . "),";
                    $list = $list . "end: new Date(" . $y1 . ", " . $m1 . ", " . $d1 . "),";
                    if (strlen($val['title']) < 6)
                        $list = $list . "backgroundColor: '#3a87ad',";
                    else
                        $list = $list . "backgroundColor: 'rgb(91, 173, 80)',";
                    $list = $list . "borderColor: 'rgb(216, 216, 216)'";
                    $list = $list . "},";
                }
            }
            foreach ($all_student as $val1) {
                $y = date('Y');
                $m = date('m', strtotime($val1['dob'])) - 1;
                $d = date('d', strtotime($val1['dob']));
                $count_y = $y;
                for ($x = $y; $x <= $y + 10; $x++) {
                    $list = $list . "{";
                    $list = $list . "title: 'BIRTH DAY-" . $val1['staff_name'] . "',";
                    $list = $list . "start: new Date(" . $x . ", " . $m . ", " . $d . "),";
                    $list = $list . "backgroundColor: 'rgb(84, 201, 156)',";
                    $list = $list . "borderColor: 'rgb(143, 243, 205)'";
//$list=$list."url: '".$this->config->item('base_url').'events/view_events/'.$val['id']."'";
                    $list = $list . "}";
                    if ($count_y != $y + 10) {
                        $list = $list . ",";
                    }
                    $count_y++;
                }
                if ($j != count($all_student)) {
                    $list = $list . ",";
                }
                $j++;
            }
            $list = $list . "]";
        } else
            $list = "events: [
                        {
                            title: '',
                            backgroundColor: '',
                            borderColor: ''
                        }]";
        $data['list'] = $list;
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/calendar', $data);
        $this->template->render();
    }

    function logout() {
        $this->load->model('staff/staff_model');
        $user_det = $this->session->userdata('user_info');
        if (isset($user_det) && !empty($user_det)) {

            $data = array('online_status' => 0);
            $this->staff_model->update_staff1($data, $user_det[0]['id']);
        } else {
            $data = array('online_status' => 0);
            $this->staff_model->update_staff($data, $this->user_auth->get_user_id());
        }
        $this->session->sess_destroy();
        redirect($this->config->item('base_url') . 'users/');
    }

    public function student_view() {
        $this->load->model('assignment/assignment_model');
        $this->load->model('users/users_model');
        $data["semester"] = $this->users_model->get_semester_for_student();
        /* echo "<pre>";
          print_r($data["semester"]);
          exit; */

        $student_id = $this->session->userdata('user_info');

        $where = array(
            'assignment.batch_id' => $student_id[0]['batch_id'],
            'assignment.depart_id' => $student_id[0]['depart_id'],
            'assignment.group_id' => $student_id[0]['group_id']
        );
        $data["last_assign"] = $this->users_model->get_last_assignment($where, $student_id[0]['id']);
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/student_view', $data);
        $this->template->render();
    }

    public function get_student_subject() {

        $this->load->model('users/users_model');
        $student_id = $this->session->userdata('user_info');
        $sem_id = $this->input->post('sem');

        $where = array(
            'subject_details.batch_id' => $student_id[0]['batch_id'],
            'subject_details.depart_id' => $student_id[0]['depart_id'],
            'subject_details.group_id' => $student_id[0]['group_id'],
            'subject_details.semester_id' => $sem_id
        );
        /* echo "<pre>";
          print_r($where);
          exit; */
        $data = $this->users_model->get_student_subject($where);
        /* echo "<pre>";
          print_r($data);
          exit; */
        $sub_select = '<select id="subject_id" name="sub_name" class="mandatory"><option value="">Select</option>';
        if (isset($data) && !empty($data)) {
            foreach ($data as $val) {
                $sub_select = $sub_select . "<option value='" . $val['subject_id'] . "'>" . $val['subject_name'] . "</option>";
            }
        }
        $sub_select = $sub_select . '</select>';
        echo "<label class='field-name'> &nbsp;&nbsp;&nbsp;&nbsp;Subject Name </label> " . $sub_select;
    }

    public function get_student_assignment_number() {
        $this->load->model('users/users_model');
        $student_id = $this->session->userdata('user_info');
        /* echo "<pre>";
          print_r($student_id);
          exit; */
        $where = array(
            'batch_id' => $student_id[0]['batch_id'],
            'depart_id' => $student_id[0]['depart_id'],
            'group_id' => $student_id[0]['group_id'],
            'semester_id' => $this->input->post('sem'),
            'subject_id' => $this->input->post('subject')
        );
        $ass_number = $this->users_model->get_student_assignment_number($where);
        $sub_select = '<select id="student_ass_number" name="sub_name" class="mandatory"><option value="">Select</option>';
        if (isset($ass_number) && !empty($ass_number)) {
            foreach ($ass_number as $val) {
                $sub_select = $sub_select . "<option value='" . $val['ass_number'] . "'>" . $val['ass_number'] . "</option>";
            }
        }
        $sub_select = $sub_select . '</select>';
        echo "<label class='field-name'> &nbsp;&nbsp;&nbsp;&nbsp;Assignment Number</label>" . $sub_select;
    }

    function profile() {
        $this->load->model('users/users_model');
        $user_det = $this->session->userdata('user_info');
        $student_id = $user_det[0]['id'];
        $data["all"] = $this->users_model->get_all_student_details($student_id);
        /* echo "<pre>";
          print_r($data["all"]);
          exit; */
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/profile', $data);
        $this->template->render();
    }

    function time_table() {
        $this->load->model('assignment/assignment_model');
        $this->load->model('users/users_model');
        $user_info = $this->session->userdata('user_info');
        $data['all_info'] = $this->users_model->get_all_details_by_id1($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id']);
        $data['all_sem'] = $this->users_model->get_all_semester_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id']);
        $data['all_subject'] = $this->users_model->get_all_subject_last_timetable($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], $data['all_info'][0]['semester_id']);
        $this->load->model('semester/semester_model');
        $data['all_semester'] = $this->semester_model->get_semester();


        $data['all_info'] = $this->users_model->get_all_details_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], $data['all_info'][0]['semester_id']);
        $data['all_sem'] = $this->users_model->get_created_sem_by_id_error($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'internal');
        $data['all_subject'] = $this->users_model->get_all_subject_last_timetable($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], $data['all_info'][0]['semester_id']);
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/time_table', $data);
        $this->template->render();
    }

    function other_time_table() {
        $this->load->model('assignment/assignment_model');
        $user_info = $this->session->userdata('user_info');

        $this->load->model('users/users_model');
        $this->load->model('semester/semester_model');
        $data['all_semester'] = $this->semester_model->get_semester();
        $user_info = $this->session->userdata('user_info');
        $data['all_info'] = $this->users_model->get_latest_internal_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'internal');
        $data['all_sem'] = $this->users_model->get_created_sem_by_id_error($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'internal');
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/other_time_table', $data);
        $this->template->render();
    }

    function get_time_table() {
        $this->load->model('users/users_model');
        $sem_id = $this->input->POST();
        $user_info = $this->session->userdata('user_info');
        $this->load->model('semester/semester_model');
        $datas['all_semester'] = $this->semester_model->get_semester();


        $datas['all_info'] = $this->users_model->get_all_details_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], $sem_id['sem_id']);
        $datas['all_sem'] = $this->users_model->get_created_sem_by_id_error($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'internal');
        $datas['all_subject'] = $this->users_model->get_all_subject_last_timetable($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], $sem_id['sem_id']);
        echo $this->load->view('users/view_time_table', $datas);
    }

    function get_other_time_table($type) {
        $sem_id = $this->input->POST();
        $this->load->model('time_table/time_table_model');
        $user_info = $this->session->userdata('user_info');
        $this->load->model('users/users_model');
        $this->load->model('semester/semester_model');
        $data['all_semester'] = $this->semester_model->get_semester();
        $user_info = $this->session->userdata('user_info');
        $data['all_info'] = $this->users_model->get_latest_internal_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'internal');
        $data['all_sem'] = $this->users_model->get_created_sem_by_id_error($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'internal');
        $view_data = array('select_batch' => $user_info[0]['batch_id'], 'depart_id' => $user_info[0]['depart_id'], 'group_id' => $user_info[0]['group_id'], 'select_sem' => $sem_id['sem_id'], 'int_id' => $sem_id['int_id'], 'select_type' => $type);

        $data['int_info'] = $this->time_table_model->check_time_table($view_data);
        echo $this->load->view('users/view_other_time_table', $data);
    }

    function get_model_time_table($type) {
        $sem_id = $this->input->POST();
        $this->load->model('time_table/time_table_model');
        $user_info = $this->session->userdata('user_info');
        $this->load->model('users/users_model');
        $this->load->model('semester/semester_model');
        $user_info = $this->session->userdata('user_info');
        $data['all_semester'] = $this->semester_model->get_semester();
        $data['all_info'] = $this->users_model->get_latest_internal_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'exam');
        $data['all_sem'] = $this->users_model->get_created_sem_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'exam');

        $view_data = array('select_batch' => $user_info[0]['batch_id'], 'depart_id' => $user_info[0]['depart_id'], 'group_id' => $user_info[0]['group_id'], 'select_sem' => $sem_id['sem_id'], 'int_id' => 2, 'select_type' => $type);
        $data['int_info'] = $this->time_table_model->check_time_table($view_data);
        echo $this->load->view('users/view_other_time_table', $data);
    }

    function model_time_table() {
        $this->load->model('assignment/assignment_model');
        $this->load->model('users/users_model');
        $this->load->model('semester/semester_model');
        $data['all_semester'] = $this->semester_model->get_semester();
        $user_info = $this->session->userdata('user_info');
        $data['all_info'] = $this->users_model->get_latest_internal_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'external');
        $data['all_sem'] = $this->users_model->get_created_sem_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'external');

        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/model_time_table', $data);
        $this->template->render();
    }

    function exam_time_table() {
        $this->load->model('assignment/assignment_model');
        $this->load->model('users/users_model');
        $this->load->model('semester/semester_model');
        $user_info = $this->session->userdata('user_info');
        $data['all_semester'] = $this->semester_model->get_semester();
        $data['all_info'] = $this->users_model->get_latest_internal_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'exam');
        $data['all_sem'] = $this->users_model->get_created_sem_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'exam');
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/exam_time_table', $data);
        $this->template->render();
    }

    function get_exam_time_table($type) {
        $sem_id = $this->input->POST();
        $this->load->model('time_table/time_table_model');
        $user_info = $this->session->userdata('user_info');
        $this->load->model('users/users_model');
        $this->load->model('semester/semester_model');
        $user_info = $this->session->userdata('user_info');
        $data['all_semester'] = $this->semester_model->get_semester();
        $data['all_info'] = $this->users_model->get_latest_internal_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'exam');
        $data['all_sem'] = $this->users_model->get_created_sem_by_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], 'exam');

        $view_data = array('select_batch' => $user_info[0]['batch_id'], 'depart_id' => $user_info[0]['depart_id'], 'group_id' => $user_info[0]['group_id'], 'select_sem' => $sem_id['sem_id'], 'int_id' => 1, 'select_type' => $type);
        $data['int_info'] = $this->time_table_model->check_time_table($view_data);
        echo $this->load->view('users/view_other_time_table', $data);
    }

    function internals() {
        $this->load->model('assignment/assignment_model');
        $this->load->model('users/users_model');
        $this->load->model('semester/semester_model');

        $data['all_exam'] = $this->exam_model->get_exam();
//	$data['all_info']=$this->users_model->get_latest_internal_by_id($user_info[0]['batch_id'],$user_info[0]['depart_id'],$user_info[0]['group_id'],'exam');

        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/internals', $data);
        $this->template->render();
    }

    function mark_sheet($user_id, $exam_id) {

        $this->load->model('users/users_model');
        $this->load->model('admin/admin_model');
        $where = array('student_group.student_id' => $user_id);
        $this->load->model('internal/internal_model');
        $data['student_info'] = $this->internal_model->get_all_student_for_users($where);
        $data['all_sem'] = $this->users_model->get_created_sem_by_id1($data['student_info'][0]['batch_id'], $data['student_info'][0]['depart_id'], $data['student_info'][0]['group_id']);
        $data["university_result"] = $this->users_model->get_university_result_by_id1($data['student_info'][0]['batch_id'], $data['student_info'][0]['depart_id'], $data['student_info'][0]['group_id'], $data['student_info'][0]['std_id'], $exam_id);

//echo '<pre>';
//print_r($data);
//exit;

        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/student_mark_sheet', $data);
        $this->template->render();
    }

    public function get_subject_by_sem_id() {
        $this->load->model('users/users_model');
        $user_info = $this->session->userdata('user_info');
        $data['ajax_val'] = $this->input->POST();
        $data['all_subject'] = $this->users_model->get_subject_by_sem_id($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], $data['ajax_val']['sem_id']);

        $g_select = '<select id="subject_id"><option value="0">Select Subject</option>';
        if (isset($data['all_subject']) && !empty($data['all_subject'])) {
            foreach ($data['all_subject'] as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['subject_name'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    function get_internal_by_subject_id() {
        $this->load->model('users/users_model');
        $user_info = $this->session->userdata('user_info');

        $data['ajax_val'] = $this->input->POST();
        $where = array('internal.batch_id' => $user_info[0]['batch_id'], 'internal.depart_id' => $user_info[0]['depart_id'], 'internal.group_id' => $user_info[0]['group_id'], 'internal.semester' => $data['ajax_val']['sem_id'], 'internal.subject_id' => $data['ajax_val']['subject_id']);
        $data['all_info'] = $this->users_model->get_internal_by_std_id($where, $user_info[0]['id']);
        echo $this->load->view('users/internal_view', $data);
    }

    function get_all_internals_by_id() {
        $user_info = $this->session->userdata('user_info');
        $this->load->model('internal/internal_model');
        $this->load->model('users/users_model');
        $post = $this->input->POST();

        $data['all_sem'] = $this->users_model->get_created_sem_by_id1($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id']);

        $input = array('batch_id' => $user_info[0]['batch_id'], 'depart_id' => $user_info[0]['depart_id'], 'group_id' => $user_info[0]['group_id'], 'semester' => $data['all_sem'][0]['id'], 'exam_id' => $post['exam_id']);
        $data['all_grade'] = $this->internal_model->get_all_student_grade($input, $user_info[0]['id']);
        $data['all_subject'] = $this->internal_model->get_all_subject_for_external($input);
        $data['all_post'] = $input;
//echo '<pre>';
//print_r($data);
// exit;
        echo $this->load->view('users/all_internal_view1', $data);
//echo $this->load->view('users/all_internal_view',$data);
    }

    function get_internal_by_onload() {
        $this->load->model('users/users_model');
        $user_info = $this->session->userdata('user_info');

        $data['ajax_val'] = $this->input->POST();
        $where = array('internal.batch_id' => $user_info[0]['batch_id'], 'internal.depart_id' => $user_info[0]['depart_id'], 'internal.group_id' => $user_info[0]['group_id']);
        $data['all_info'] = $this->users_model->get_internal_by_std_id_onload($where, $user_info[0]['id']);
        echo $this->load->view('users/all_internal_view', $data);
    }

    public function student_profile_update() {
        $this->load->model('users/users_model');

        $student_id = $this->session->userdata('user_info');
        $id = $student_id[0]['id'];

        $this->load->helper('text');
// image
        $sourceimage = $_FILES['student_image']['tmp_name'];

        $config['upload_path'] = './profile_image/student/orginal';

        $config['allowed_types'] = '*';
        $config['max_size'] = '2000';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $upload_data['file_name'] = '';
        if (isset($_FILES) && !empty($_FILES)) {
            $upload_files = $_FILES;
            if ($upload_files['student_image']['name'] != '') {
                $_FILES['student_image'] = array(
                    'name' => $upload_files['student_image']['name'],
                    'type' => $upload_files['student_image']['type'],
                    'tmp_name' => $upload_files['student_image']['tmp_name'],
                    'error' => $upload_files['student_image']['error'],
                    'size' => '2000'
                );


                $this->upload->do_upload('student_image');

                $upload_data = $this->upload->data();
                $dest = getcwd() . "/profile_image/student/thumb/" . $upload_data['file_name'];


                $src = $this->config->item("base_url") . 'profile_image/student/orginal/' . $upload_data['file_name'];
                $this->make_thumb($src, $dest, 50);
            }
        }
//cover image

        $config['upload_path'] = './cover_image/student/original';

        $config['allowed_types'] = '*';

        $config['max_size'] = '2000';


        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $upload_datac['file_name'] = '';
        if (isset($_FILES) && !empty($_FILES)) {
            $upload_cover = $_FILES;

            if ($upload_cover['cover_image']['name'] != '') {
                $_FILES['cover_image'] = array(
                    'name' => $upload_cover['cover_image']['name'],
                    'type' => $upload_cover['cover_image']['type'],
                    'tmp_name' => $upload_cover['cover_image']['tmp_name'],
                    'error' => $upload_cover['cover_image']['error'],
                    'size' => '2000'
                );

                $upload_cover['cover_image']['name'];

                $this->upload->do_upload('cover_image');

                $upload_datac = $this->upload->data();
                /* echo "<pre>	";
                  print_r($upload_datac);
                  exit; */


                $src1 = $this->config->item("base_url") . 'cover_image/student/original/' . $upload_datac['file_name'];
            }
        }
// backgroud image
        $config['upload_path'] = './background_image/student';

        $config['allowed_types'] = '*';

        $config['max_size'] = '2000';


        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $upload_datab['file_name'] = '';
        if (isset($_FILES) && !empty($_FILES)) {
            $upload_back = $_FILES;

            if ($upload_back['background_image']['name'] != '') {
                $_FILES['background_image'] = array(
                    'name' => $upload_back['background_image']['name'],
                    'type' => $upload_back['background_image']['type'],
                    'tmp_name' => $upload_back['background_image']['tmp_name'],
                    'error' => $upload_back['background_image']['error'],
                    'size' => '2000'
                );

                $upload_back['background_image']['name'];


                $this->upload->do_upload('background_image');

                $upload_datab = $this->upload->data();

                /* echo "<pre>	";
                  print_r($upload_datab);
                  exit; */

                $src1 = $this->config->item("base_url") . 'background_image/student/' . $upload_datab['file_name'];
            }
        }
        if ($upload_data['file_name'] != '' && $upload_datac['file_name'] != '' && $upload_datab['file_name'] != '') {
            $input = array('image' => $upload_data['file_name'], 'cover_image' => $upload_datac['file_name'], 'background_image' => $upload_datab['file_name']);
            $this->users_model->update_student_profile($input, $id);
        } else if ($upload_data['file_name'] != '' && $upload_datac['file_name'] != '' && $upload_datab['file_name'] == '') {
            $input = array('image' => $upload_data['file_name'], 'cover_image' => $upload_datac['file_name']);
            $this->users_model->update_student_profile($input, $id);
        } else if ($upload_data['file_name'] != '' && $upload_datab['file_name'] != '' && $upload_datac['file_name'] == '') {
            $input = array('image' => $upload_data['file_name'], 'background_image' => $upload_datab['file_name']);
            $this->users_model->update_student_profile($input, $id);
        } else if ($upload_datab['file_name'] != '' && $upload_datac['file_name'] != '' && $upload_data['file_name'] == '') {

            $input = array('background_image' => $upload_datab['file_name'], 'cover_image' => $upload_datac['file_name']);
            $this->users_model->update_student_profile($input, $id);
        } else if ($upload_data['file_name'] != '' && $upload_datac['file_name'] == '' && $upload_datab['file_name'] == '') {
            $input = array('image' => $upload_data['file_name']);
            $this->users_model->update_student_profile($input, $id);
        } else if ($upload_datac['file_name'] != '' && $upload_datab['file_name'] == '' && $upload_data['file_name'] == '') {
            $input = array('cover_image' => $upload_datac['file_name']);
            $this->users_model->update_student_profile($input, $id);
        } else if ($upload_datab['file_name'] != '' && $upload_datac['file_name'] == '' && $upload_data['file_name'] == '') {
            $input = array('background_image' => $upload_datab['file_name']);
            $this->users_model->update_student_profile($input, $id);
        } else {

        }
        redirect($this->config->item('base_url') . 'users/profile');
    }

    public function student_password_change() {
        $this->load->model('users/users_model');

        $student_id = $this->session->userdata('user_info');
        $id = $student_id[0]['id'];
        $new_password = md5($this->input->post('new_password'));
        $input = array('pwd' => $new_password);
        $this->users_model->update_student_profile($input, $id);
    }

    public function get_assignment_byid() {
        $this->load->model('users/users_model');
        $student_id = $this->session->userdata('user_info');

        $where = array(
            'assignment.batch_id' => $student_id[0]['batch_id'],
            'assignment.depart_id' => $student_id[0]['depart_id'],
            'assignment.group_id' => $student_id[0]['group_id'],
            'assignment.semester_id' => $this->input->post('sem'),
            'assignment.subject_id' => $this->input->post('subject'),
            'assignment.ass_number' => $this->input->post('ass_number')
        );
        $data["assignment"] = $this->users_model->get_assignment_byid($where, $student_id[0]['id']);

        echo $this->load->view('assignment_view', $data);
    }

    public function assignment_upload($id) {
        $this->load->model('users/users_model');
        $student_id = $this->session->userdata('user_info');
        $student_id = $student_id[0]['id'];

        if (is_numeric($id)) {
            $data["assignment"] = $this->users_model->get_assignment_by_id($id);
            /* echo "<pre>	";
              print_r($data["assignment"]);
              exit; */
            $data["checking"] = $this->users_model->assignment_details_table($student_id, $id);
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
        if (isset($data["assignment"]) && !empty($data["assignment"])) {
            $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
            $this->template->write_view('content', 'users/assignment_upload', $data);
            $this->template->render();
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
    }

    public function insert_student_assignment() {
        $this->load->model('users/users_model');
        $student_id = $this->session->userdata('user_info');

        $student_id = $student_id[0]['id'];

        if ($this->input->post()) {

            $id = $this->input->post('ass_id');

            $this->load->helper('text');

            $config['upload_path'] = './assignment_files';

            $config['allowed_types'] = '*';

            $config['max_size'] = '';

            $this->load->library('upload', $config);

            $upload_data['file_name'] = '';
            if (isset($_FILES) && !empty($_FILES)) {
                $upload_files = $_FILES;
                if ($upload_files['ass_file']['name'] != '') {
                    $_FILES['ass_file'] = array(
                        'name' => $upload_files['ass_file']['name'],
                        'type' => $upload_files['ass_file']['type'],
                        'tmp_name' => $upload_files['ass_file']['tmp_name'],
                        'error' => $upload_files['ass_file']['error'],
                        'size' => '2000'
                    );


                    $this->upload->do_upload('ass_file');

                    $upload_data = $this->upload->data();

                    $dest = getcwd() . "/assignment_files/" . $upload_data['file_name'];


                    $src = $this->config->item("base_url") . 'assignment_files/' . $upload_data['file_name'];
                }
            }

            if ($upload_data['file_name'] != '') {
                $sub_date = date("Y-m-d");
                $input = array('assign_id' => $id, 'std_id' => $student_id, 'file_name' => $upload_files['ass_file']['name'], 'created_by' => $student_id, 'modified_id' => $student_id, 'sub_date' => $sub_date);


                $this->users_model->insert_student_assignment($input);
            }

//redirect($this->config->item('base_url').'users/student_view');
            echo "<script type='text/javascript'>window.close();</script>";
        }
    }

    function make_thumb($src, $dest, $desired_width) {

        /* read the source image */


        $source_image = $this->imageCreateFromAny($src); //imagecreatefromjpeg($src);
        $width = imagesx($source_image);
        $height = imagesy($source_image);

        /* find the "desired height" of this thumbnail, relative to the desired width  */
        $desired_height = floor($height * ($desired_width / $width));

        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

        /* copy source image at a resized size */
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

        /* create the physical thumbnail image to its destination */
        imagejpeg($virtual_image, $dest, 100);
    }

    function imageCreateFromAny($filepath) {
        $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
        $allowedTypes = array(
            1, // [] gif
            2, // [] jpg
            3, // [] png
            6   // [] bmp
        );
        if (!in_array($type, $allowedTypes)) {
            return false;
        }
        switch ($type) {
            case 1 :
                $im = imageCreateFromGif($filepath);
                break;
            case 2 :
                $im = imageCreateFromJpeg($filepath);
                break;
            case 3 :
                $im = imageCreateFromPng($filepath);
                break;
            case 6 :
                $im = imageCreateFromBmp($filepath);
                break;
        }
        return $im;
    }

    function subject_view() {
        $this->load->model('users_model');
        $value = $this->session->userdata('user_info');
        $data["semester"] = $this->users_model->get_semester($value);
        $sem_id = $this->users_model->get_semester_id($value);
        foreach ($sem_id as $key => $val) {
            $s_id = $val["semester_id"];
        }

        $data['sub'] = $this->users_model->get_curent_subject($value, $s_id);
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/subject_view', $data);
        $this->template->render();
    }

    public function attendance() { //THIS IS FOR ATTENDANCE REPORT FOR STUDENTS
        $this->load->model('semester/semester_model');
        $data['sem_list'] = $this->semester_model->get_semester();

        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/attendance', $data);
        $this->template->render();
    }

    public function attendance_list() { //THIS IS FOR ATTENDANCE REPORT FOR STUDENTS
        $sem_id = $this->input->POST();

        $this->load->model('users/users_model');
        $student_id = $this->session->userdata('user_info');
        $student_id['sem_id'] = $sem_id['sem_id'];
        $data["att_det"] = $this->users_model->attendance_list($student_id);
        echo $this->load->view('users/attend_ajax_list', $data);
    }

    function view() {
        $this->load->model('users_model');
        $this->session->userdata('user_info');
        $value = $this->session->userdata('user_info');
        $sem_id = $this->input->post('value1');
        $data['sub'] = $this->users_model->get_subject($sem_id, $value);
        echo $this->load->view('view_list', $data);
    }

    function share_notes_view() {
        $this->load->model('users_model');
        $value = $this->session->userdata('user_info');
        $data["semester"] = $this->users_model->get_semester($value);
//$data["subject"]=$this->users_model->get_notes_subject($value);
        $data['notes_share'] = $this->users_model->share_notes_view($value);
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/share_notes_view', $data);
        $this->template->render();
    }

    function get_notes_by_subject() {
        $this->load->model('users_model');
        $sub_id = $this->input->post('value1');
        $sem_id = $this->input->post('value2');
        $data['notes_share'] = $this->users_model->get_notes_by_subject($sub_id);
        echo $this->load->view('view_notes', $data);
    }

    function chat() {

        $this->load->model('users_model');
        $bg = $this->session->userdata('user_info');
//print_r($bg);
// [batch_id] => 1 [department] => EEE [depart_id] => 1 [group] => A [group_id] => 1
        $batch = $bg[0]['batch_id'];
        $depart = $bg[0]['depart_id'];
        $group = $bg[0]['group_id'];
        $outputData['listOfUsers'] = $this->users_model->getstudentUsers($batch, $depart, $group);

        $userdata = $this->session->all_userdata();


        $outputData['session_dataa'] = $userdata;
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/chat', $outputData);
        $this->template->render();
    }

    function events_view() {
        $this->load->model('users/users_model');
        $value = $this->session->userdata('user_info');
        $data["events"] = $this->users_model->get_events($value);

        $data["public"] = $this->users_model->get_events_public();
        /* echo "<pre>";
          print_r($data["events"]);
          exit; */
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/events_view', $data);
        $this->template->render();
    }

    function events_view_page($id) {
        $this->load->model('users/users_model');
        $user_det = $this->session->userdata('logged_in');
        $student = $this->session->userdata('user_info');
//$details=$this->session->userdata('logged_in');
//echo "<pre>"; print_r($student);exit;
//$this->users_model->insert_event($input);
        if (is_numeric($id)) {
            $data["details"] = $this->users_model->view_events($id);
            $data["participate"] = $this->users_model->check_events($id, $student);
//print_r($data['participate']); exit;
        } else {
            redirect($this->config->item('base_url') . 'users/events_view');
        }
        if (isset($data["details"]) && !empty($data["details"])) {
            $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
            $this->template->write_view('content', 'users/events_view_page', $data);
            $this->template->render();
        } else {
            redirect($this->config->item('base_url') . 'users/events_view');
        }
    }

    public function checking_part() {
        $this->load->model('users/users_model');
        $clck = $this->input->post('value1');
        $data = $this->users_model->checking_partt($clck);
        $i = 0;
        if ($data) {
            $i = 1;
        }
        if ($i == 1) {
            echo "Oops!You Are Already Participated";
        }
    }

    public function participate_check() {
        $this->load->model('users/users_model');
        $input = $this->input->post('eve_id');
        $id = $this->input->post('value2');
//print_r($id);exit;
        $validation = $this->users_model->participate_check($input, $id);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo"You Are Already Participated";
        }
    }

    public function insert_eve() {


        $this->load->model('users/users_model');
        $student = $this->session->userdata('user_info');
        $input = array('name' => $this->input->get('value1'), 'email' => $this->input->get('value2'), 'phone' => $this->input->get('value3'),
            'batch' => $this->input->get('value4'), 'depart' => $this->input->get('value5'), 'group' => $this->input->get('value6'),
            'event_id' => $this->input->get('value7'), 'p_status' => '1');
        $this->users_model->insert_events($input);
        redirect($this->config->item('base_url') . 'users/events_view');



//$res=$this->input->get(); echo "<pre>";print_r($res); exit;
    }

    public function get_all_sem_subje() {
        $this->load->model('users_model');
        $d_id = $this->input->post('value1');
        $value = $this->session->userdata('user_info');
        $g_array = $this->users_model->get_all_sem_subje($d_id, $value);
        $g_select = '<select id="group" name="subject[subject_name]" class="subject value mandatory validate" ><option value="">Select Subject</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['subject_name'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function get_notes_subject() {
        $this->load->model('users_model');
        $d_id = $this->input->post('value1');
        $value = $this->session->userdata('user_info');
    }

    public function fees() {
        $std_info = $this->session->userdata('user_info');
        $this->load->model('fees/fees_model');
        $data['fees_info'] = $this->fees_model->get_student_fees_details($std_info[0]['std_id']);
//        echo "<pre>";
//        print_r($data);
//        exit;
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/pay_fees', $data);
        $this->template->render();
    }

    public function hostel_fees() {
        $std_info = $this->session->userdata('user_info');
        $this->load->model('hostel/hostel_model');
        $this->load->model('users/users_model');
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $data['my_monthly_fees'] = $this->hostel_model->get_student_monthly_fees($std_info[0]['std_id']);
        $data['hostel'] = $this->users_model->get_hostel_admission($std_info[0]['std_id']);
//echo "<pre>"; print_r($data['hostel']); exit;
        $data['room'] = $this->users_model->get_room_details($std_info[0]['id'], $data['hostel'][0]['block_id']);
        $this->template->write_view('content', 'users/monthly_fees_form', $data);
        $this->template->render();
    }

    public function view_fees($id) {
        $std_info = $this->session->userdata('user_info');
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        $data['fees_info'] = $this->fees_model->get_all_sem_fees_by_id($id);
        $data['fees_info1'] = $this->fees_model->get_student_fees_details1($std_info[0]['std_id'], $id);
        $data['balance'] = 1;
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/view_fees', $data);
        $this->template->render();
    }

    public function view_hostel_fees($id) {
        $std_info = $this->session->userdata('user_info');
        $this->load->model('hostel/hostel_model');
        $user_det = $this->session->userdata('logged_in');
        $data['fees_info'] = $this->hostel_model->view_hostel_fees1($id, $std_info[0]['std_id']);
        $data['from_site'] = 1;
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/view_monthly_fees', $data);
        $this->template->render();
    }

    public function placement_list() {
        $this->load->model('users/users_model');
        $user_det = $this->session->userdata('user_info');
        $data['all_placement'] = $this->users_model->get_all_placement($user_det[0]['id']);
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/placement_list', $data);
        $this->template->render();
    }

    public function view_placement($id) {

        $this->load->model('group/group_model');
        $this->load->model('placement/placement_model');
        if ($this->input->post()) {
            $update = array('placement_id' => $this->input->post('placement_id'), 'student_id' => $this->input->post('student_id'));
            $data = array('participation' => 1);
            $this->placement_model->update_student_participation_status($update, $data);
            redirect($this->config->item('base_url') . 'users/placement_list');
        }
        $data['all_depart'] = $this->group_model->get_all_department();
        $data['get_placement'] = $this->placement_model->get_placement_by_id($id);
        $data['placement_id'] = $id;
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/view_placement', $data);
        $this->template->render();
    }

    public function view_page_std_list() {
        $data['get_mark'] = $this->input->POST();
        $this->load->model('users/users_model');
        $this->load->model('placement/placement_model');
        $user_det = $this->session->userdata('user_info');
        $data['participate_status'] = $this->placement_model->get_participate_status($data['get_mark']['id'], $user_det[0]['id']);
        $data['mark'] = $this->users_model->get_percentage_for_placement_in_excel($data['get_mark']);
        echo $this->load->view('users/view_std_list', $data);
    }

    public function plac_test_wel() {
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/placement_test_welc');
        $this->template->render();
    }

    public function plac_test() {
        $std_info = $this->session->userdata('user_info');
        $this->load->model('users_model');
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $data['qus_list'] = $this->users_model->plac_test_model($std_info);
        $this->template->write_view('content', 'users/placement_test', $data);
        $this->template->render();
    }

    public function plac_test_new() {
        $std_info = $this->session->userdata('user_info');
        $this->load->model('users_model');
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $data['qus_list'] = $this->users_model->plac_test_model($std_info);
        $this->template->write_view('content', 'users/placement_test_new', $data);
        $this->template->render();
    }

    public function plac_test_submit() {
        $data['stud_det'] = $this->session->userdata('user_info');

        $this->load->model('users_model');
        $data['qus_ans'] = $this->input->post();
//echo "<pre>"; print_r($data['qus_ans']); exit;
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $data['marks_upt'] = $this->users_model->plac_test_ans($data);
        $data['result_dt'] = 'success';
        $this->template->write_view('content', 'users/placement_test_new', $data);
        $this->template->render();
    }

    public function arrear_time_table() {
        $this->load->model('users/users_model');
        $std_info = $this->session->userdata('user_info');
//echo "<pre>"; print_r($std_info); exit;
        $data['arrear_time'] = $this->users_model->get_arrear_time_table($std_info[0]['depart_id']);
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/arrear_time_table', $data);
        $this->template->render();
    }

    public function download_form() {
        $this->load->model('download_form/download_form_model');
        $data['all_form'] = $this->download_form_model->get_form_for_users();
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/download_form', $data);
        $this->template->render();
    }

    public function video_files() {
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'download_form/users_video_files');
        $this->template->render();
    }

    public function videos() {
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/example');
        $this->template->render();
    }

    public function khan_api_badges() {
        $url = 'http://www.khanacademy.org/api/v1/badges';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
//echo $data;

        $graph_url = "http://www.khanacademy.org/api/v1/badges";
        $user = json_decode(file_get_contents($graph_url));

//$data['batch_list'] = $user;
        $data = array("batch_list" => $user);

        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/batches_list', $data);
        $this->template->render();
    }

    public function khan_api_cat() {
        $url = 'http://www.khanacademy.org/api/v1/badges/categories';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
//echo $data;
        $graph_url = "http://www.khanacademy.org/api/v1/badges/categories";
        $user = json_decode(file_get_contents($graph_url));
//$data['categ_list'] = $user;
        $data = array("categ_list" => $user);

        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/cate_list', $data);
        $this->template->render();
    }

    public function khan_api_exce() {
        $url = 'http://www.khanacademy.org/api/v1/exercises';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
//echo $data;
        $graph_url = "http://www.khanacademy.org/api/v1/exercises";
        $user = json_decode(file_get_contents($graph_url));
//$data['categ_list'] = $user;
        $data = array("excer_list" => $user);
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/exer_list', $data);
        $this->template->render();
    }

    public function khan_api_video() {
        $url = 'http://www.khanacademy.org/api/v1/topictree';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
//echo $data;
        $graph_url = "http://www.khanacademy.org/api/v1/topictree";
        $user = json_decode(file_get_contents($graph_url));
//$data['categ_list'] = $user;
        $data = array("vid_list" => $user);

        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/video_list', $data);
        $this->template->render();
    }

    public function transport_fees() {
        $this->load->model('users/users_model');
        $std_id = $this->session->userdata('user_info');
//print_r($std_id);exit;
        $data['transport'] = $this->users_model->get_all_transport($std_id);
//echo "<pre>";print_r($data);exit;
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/transport_fees', $data);
        $this->template->render();
    }

    public function search_library() {
        $this->load->model('users/users_model');
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/search_library');
        $this->template->render();
    }

    public function my_books() {
        $this->load->model('users/users_model');
        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/user_template.php');
        $this->template->write_view('content', 'users/my_books');
        $this->template->render();
    }

    public function excel() {
        $this->load->model('users/users_model');
        $user_info = $this->session->userdata('user_info');
        $data["all_grade"] = $this->users_model->get_university_result_by_id_student($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], $user_info[0]['id']);
        $this->load->view('users/result_excel', $data);
    }

    public function pdf() {
        $data['report_title'] = 'Exam Report';
        $this->load->model('users/users_model');
        $user_info = $this->session->userdata('user_info');
        $data["all_grade"] = $this->users_model->get_university_result_by_id_student($user_info[0]['batch_id'], $user_info[0]['depart_id'], $user_info[0]['group_id'], $user_info[0]['id']);
        $html = $this->load->view('api/common_pdf_header', $data, TRUE);
        $body = $this->load->view('users/result_pdf', $data, TRUE);
        $mpdf = new mPDF('', 'A4', '0', '"Roboto", "Noto", sans-serif', '15', '15', '28', '10', '5', '3', 'L');
        $mpdf->setTitle('Exam Report');
        $mpdf->SetHTMLHeader($html);
        $mpdf->setFooter('{PAGENO} / {nb}');
        $mpdf->WriteHTML($body);
        $mpdf->Output('Exam_report.pdf', 'D');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */