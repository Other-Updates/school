<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fees extends MX_Controller {

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
        $this->load->model('batch/batch_model');
        $this->load->model('subject/subject_model');
    }

    public function create() {
        $this->load->model('group/group_model');
        $this->load->model('student/student_model');
        $this->load->model('semester/semester_model');
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        //$data['all_batch'] = $this->student_model->get_all_batch();
        $data['all_depart'] = $this->group_model->get_all_department();
        //$data['all_semester'] = $this->semester_model->get_semester();
        $data['all_batch'] = $this->batch_model->get_default_batch();
        $data['all_semester'] = $this->subject_model->get_default_term();
        if ($this->input->post()) {
            $input = $this->input->post();
            $input['fees_info']['from_date'] = date("Y-m-d", strtotime($input['fees_info']['from_date']));
            $input['fees_info']['due_date'] = date("Y-m-d", strtotime($input['fees_info']['due_date']));
            $input['fees_info']['created_by'] = $user_det['user_id'];
            $input['fees_info']['staff_type'] = $user_det['staff_type'];
            $input['fees_info']['billing_type'] = 1;
            $insert_id = $this->fees_model->insert_fees_info($input['fees_info']);
            $insert = array();
            if (isset($input['fees_details']['master_fees_id']) && !empty($input['fees_details']['master_fees_id'])) {
                $i = 0;

                foreach ($input['fees_details']['master_fees_id'] as $key => $val) {
                    $insert[$i]['master_fees_id'] = $val;
                    $insert[$i]['fees_info_id'] = $insert_id;
                    if (empty($input['fees_details']['master_option'][$key]))
                        $input['fees_details']['master_option'][$key] = 'off';
                    $insert[$i]['master_option'] = $input['fees_details']['master_option'][$key];
                    $insert[$i]['amount'] = $input['fees_details']['amount'][$key];
                    $i++;
                }
            }
            $this->fees_model->insert_fees_details($insert);
            redirect($this->config->item('base_url') . 'fees/exam_fees');
        }
        $this->template->write_view('content', 'fees/create', $data);
        $this->template->render();
    }

    public function check_fees_info() {
        $this->load->model('fees/fees_model');
        $where = $this->input->POST();
        $where['status'] = 1;
        $data['master_fees'] = $this->fees_model->get_all_master_fees();
        echo $this->load->view('fees/add_fees_info', $data);
    }

    public function exam_fees() {
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        $data['all_sem_fees'] = $this->fees_model->get_all_sem_fees(1);
        $this->template->write_view('content', 'fees/exam_fees', $data);
        $this->template->render();
    }

    public function update_fees_view($id) {
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        $data['fees_info'] = $this->fees_model->get_all_sem_fees_by_id($id);
        if ($this->input->post()) {
            $input = $this->input->post();

            $input['fees_info']['from_date'] = date("Y-m-d", strtotime($input['fees_info']['from_date']));
            $input['fees_info']['due_date'] = date("Y-m-d", strtotime($input['fees_info']['due_date']));
            $input['fees_info']['created_by'] = $user_det['user_id'];
            $input['fees_info']['billing_type'] = 1;
            $input['fees_info']['staff_type'] = $user_det['staff_type'];
            $this->fees_model->update_fees_info($id, $input['fees_info']);
            $this->fees_model->delete_fees_details($id);
            $insert = array();
            if (isset($input['fees_details']['master_fees_id']) && !empty($input['fees_details']['master_fees_id'])) {
                $i = 0;

                foreach ($input['fees_details']['master_fees_id'] as $key => $val) {
                    $insert[$i]['master_fees_id'] = $val;
                    $insert[$i]['fees_info_id'] = $id;
                    if (empty($input['fees_details']['master_option'][$key]))
                        $input['fees_details']['master_option'][$key] = 'off';
                    $insert[$i]['master_option'] = $input['fees_details']['master_option'][$key];
                    $insert[$i]['amount'] = $input['fees_details']['amount'][$key];
                    $i++;
                }
            }
            $this->fees_model->insert_fees_details($insert);
            redirect($this->config->item('base_url') . 'fees/exam_fees');
        }
        $this->template->write_view('content', 'fees/update_exam_fees', $data);
        $this->template->render();
    }

    public function update_exam_fees_view($id, $status, $path) {
        $this->load->model('fees/fees_model');
        $input = array('status' => $status);
        $this->load->model('api/notification_model');
        $this->fees_model->update_fees_info($id, $input);
        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => 'Fees Added', 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        if ($path == 'exam_fees') {
            $data['balance'] = 1;
            $data['fees_info'] = $this->fees_model->get_all_sem_fees_by_id($id);
            $paths = 'users/view_fees/' . $id;
            $where1 = array('student_group.batch_id' => $data['fees_info'][0]['batch_id'], 'student_group.depart_id' => $data['fees_info'][0]['batch_id']);
            $all_student = $this->notification_model->get_all_student($where1);
        } else {
            $data['fees_info'] = $this->fees_model->get_all_sem_fees_by_id2($id);
            $data['balance'] = 2;
            $paths = 'users/view_hostel_fees/' . $id;
            $where1 = array('hostel' => 1);
            $all_student = $this->notification_model->get_all_student1($where1);
        }
        $last_id = $this->notification_model->insert_notification($insert_not);
        $j = 0;
//        $this->load->library('email');
//        $config['protocol'] = 'sendmail';
//        $config['mailpath'] = '/usr/sbin/sendmail';
//        $config['charset'] = 'iso-8859-1';
//        $config['wordwrap'] = TRUE;
//        $this->email->initialize($config);
        foreach ($all_student as $val1) {
//            $this->email->from('noreply@email.com', 'iBoard');
//            $this->email->to($all_student[$j]['email_id']);
//            $this->email->subject('[iBoard] Fees Added');
//            $this->email->set_mailtype("html");
//            $msg = $this->load->view('fees/exam_fees_view', $data, TRUE);
//            $this->email->message($msg);
//            $this->email->send();

            unset($all_student[$j]['email_id']);
            $all_student[$j]['notification_id'] = $last_id['id'];
            $all_student[$j]['user_type'] = 'student';
            $all_student[$j]['links'] = $paths;
            $all_student[$j]['read'] = 0;
            $j++;
        }
        $this->notification_model->insert_all_staff($all_student);
        redirect($this->config->item('base_url') . 'fees/' . $path);
    }

    public function exam_fees_view($id) {
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        $data['fees_info'] = $this->fees_model->get_all_sem_fees_by_id($id);
        $this->template->write_view('content', 'fees/exam_fees_view', $data);
        $this->template->render();
    }

    public function hostel_fees() {
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        $data['all_sem_fees'] = $this->fees_model->get_all_other_fees(2);
        $this->template->write_view('content', 'fees/hostel_fees', $data);
        $this->template->render();
    }

    public function add_hostel_fees() {
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        if ($this->input->post()) {
            $input = $this->input->post();
            $input['fees_info']['from_date'] = date("Y-m-d", strtotime($input['fees_info']['from_date']));
            $input['fees_info']['due_date'] = date("Y-m-d", strtotime($input['fees_info']['due_date']));
            $input['fees_info']['created_by'] = $user_det['user_id'];
            $input['fees_info']['billing_type'] = 2;
            $input['fees_info']['staff_type'] = $user_det['staff_type'];
            $insert_id = $this->fees_model->insert_fees_info($input['fees_info']);
            $insert = array();
            if (isset($input['fees_details']['master_fees_id']) && !empty($input['fees_details']['master_fees_id'])) {
                $i = 0;

                foreach ($input['fees_details']['master_fees_id'] as $key => $val) {
                    $insert[$i]['master_fees_id'] = $val;
                    $insert[$i]['fees_info_id'] = $insert_id;
                    if (empty($input['fees_details']['master_option'][$key]))
                        $input['fees_details']['master_option'][$key] = 'off';
                    $insert[$i]['master_option'] = $input['fees_details']['master_option'][$key];
                    $insert[$i]['amount'] = $input['fees_details']['amount'][$key];
                    $i++;
                }
            }
            $this->fees_model->insert_fees_details($insert);
            redirect($this->config->item('base_url') . 'fees/hostel_fees');
        }
        $this->load->model('fees/fees_model');
        $data['master_fees'] = $this->fees_model->get_all_master_fees();
        $this->template->write_view('content', 'fees/add_hostel_fees', $data);
        $this->template->render();
    }

    public function update_hostel_fees_view($id) {
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        $data['fees_info'] = $this->fees_model->get_all_other_fees_by_id($id, 2);
        if ($this->input->post()) {
            $input = $this->input->post();

            $input['fees_info']['from_date'] = date("Y-m-d", strtotime($input['fees_info']['from_date']));
            $input['fees_info']['due_date'] = date("Y-m-d", strtotime($input['fees_info']['due_date']));
            $input['fees_info']['created_by'] = $user_det['user_id'];
            $input['fees_info']['billing_type'] = 2;
            $input['fees_info']['staff_type'] = $user_det['staff_type'];
            $this->fees_model->update_fees_info($id, $input['fees_info']);
            $this->fees_model->delete_fees_details($id);
            $insert = array();
            if (isset($input['fees_details']['master_fees_id']) && !empty($input['fees_details']['master_fees_id'])) {
                $i = 0;

                foreach ($input['fees_details']['master_fees_id'] as $key => $val) {
                    $insert[$i]['master_fees_id'] = $val;
                    $insert[$i]['fees_info_id'] = $id;
                    if (empty($input['fees_details']['master_option'][$key]))
                        $input['fees_details']['master_option'][$key] = 'off';
                    $insert[$i]['master_option'] = $input['fees_details']['master_option'][$key];
                    $insert[$i]['amount'] = $input['fees_details']['amount'][$key];
                    $i++;
                }
            }
            $this->fees_model->insert_fees_details($insert);
            redirect($this->config->item('base_url') . 'fees/hostel_fees');
        }
        $this->template->write_view('content', 'fees/update_hostel_fees', $data);
        $this->template->render();
    }

    public function hostel_fees_view($id) {
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        $data['fees_info'] = $this->fees_model->get_all_other_fees_by_id($id, 2);
        $this->template->write_view('content', 'fees/hostel_fees_view', $data);
        $this->template->render();
    }

    public function transport_fees() {
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        $data['all_sem_fees'] = $this->fees_model->get_all_other_fees(3);
        $this->template->write_view('content', 'fees/transport_fees', $data);
        $this->template->render();
    }

    public function add_transport_fees() {
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        if ($this->input->post()) {
            $input = $this->input->post();
            $input['fees_info']['from_date'] = date("Y-m-d", strtotime($input['fees_info']['from_date']));
            $input['fees_info']['due_date'] = date("Y-m-d", strtotime($input['fees_info']['due_date']));
            $input['fees_info']['created_by'] = $user_det['user_id'];
            $input['fees_info']['staff_type'] = $user_det['staff_type'];
            $input['fees_info']['billing_type'] = 3;
            $insert_id = $this->fees_model->insert_fees_info($input['fees_info']);
            $insert = array();
            if (isset($input['fees_details']['master_fees_id']) && !empty($input['fees_details']['master_fees_id'])) {
                $i = 0;

                foreach ($input['fees_details']['master_fees_id'] as $key => $val) {
                    $insert[$i]['master_fees_id'] = $val;
                    $insert[$i]['fees_info_id'] = $insert_id;
                    if (empty($input['fees_details']['master_option'][$key]))
                        $input['fees_details']['master_option'][$key] = 'off';
                    $insert[$i]['master_option'] = $input['fees_details']['master_option'][$key];
                    $insert[$i]['amount'] = $input['fees_details']['amount'][$key];
                    $i++;
                }
            }
            $this->fees_model->insert_fees_details($insert);
            redirect($this->config->item('base_url') . 'fees/transport_fees');
        }
        $this->load->model('fees/fees_model');
        $data['master_fees'] = $this->fees_model->get_all_master_fees();
        $this->template->write_view('content', 'fees/add_transport_fees', $data);
        $this->template->render();
    }

    public function update_transport_fees_view($id) {
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        $data['fees_info'] = $this->fees_model->get_all_other_fees_by_id($id, 3);
        if ($this->input->post()) {
            $input = $this->input->post();

            $input['fees_info']['from_date'] = date("Y-m-d", strtotime($input['fees_info']['from_date']));
            $input['fees_info']['due_date'] = date("Y-m-d", strtotime($input['fees_info']['due_date']));
            $input['fees_info']['created_by'] = $user_det['user_id'];
            $input['fees_info']['billing_type'] = 3;
            $input['fees_info']['staff_type'] = $user_det['staff_type'];
            $this->fees_model->update_fees_info($id, $input['fees_info']);
            $this->fees_model->delete_fees_details($id);
            $insert = array();
            if (isset($input['fees_details']['master_fees_id']) && !empty($input['fees_details']['master_fees_id'])) {
                $i = 0;

                foreach ($input['fees_details']['master_fees_id'] as $key => $val) {
                    $insert[$i]['master_fees_id'] = $val;
                    $insert[$i]['fees_info_id'] = $id;
                    if (empty($input['fees_details']['master_option'][$key]))
                        $input['fees_details']['master_option'][$key] = 'off';
                    $insert[$i]['master_option'] = $input['fees_details']['master_option'][$key];
                    $insert[$i]['amount'] = $input['fees_details']['amount'][$key];
                    $i++;
                }
            }
            $this->fees_model->insert_fees_details($insert);
            redirect($this->config->item('base_url') . 'fees/transport_fees');
        }
        $this->template->write_view('content', 'fees/update_transport_fees_view', $data);
        $this->template->render();
    }

    public function transport_fees_view($id) {
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        $data['fees_info'] = $this->fees_model->get_all_other_fees_by_id($id, 3);
        $this->template->write_view('content', 'fees/transport_fees_view', $data);
        $this->template->render();
    }

    public function pay() {
        $this->template->write_view('content', 'fees/pay');
        $this->template->render();
    }

    public function get_student_list() {
        $atten_inputs = $this->input->get();

        $this->load->model('attendance_od_ml/attendance_od_ml_model');
        $data = $this->attendance_od_ml_model->get_sutent_list($atten_inputs);
        foreach ($data as $st_rlno) {
            echo $st_rlno['std_id'] . "\n";
        }
    }

    public function view_student_fees() {

        //echo $this->load->view('fees/pay_fees');
//		$this->load->model('fees/fees_model');
//		$roll_no = $this->input->get();
//		$data['fees_info']=$this->fees_model->get_student_fees_details($roll_no['roll_no']);
//		echo $this->load->view('fees/pay_fees',$data);

        $this->load->model('fees/fees_model');
        $roll_no = $this->input->POST();
        $data['fees_info'] = $this->fees_model->get_student_fees_details($roll_no['roll_no']);
        //echo '<pre>';
        ///print_r($data);
        //exit;
        echo $this->load->view('fees/pay_fees', $data);
    }

    public function insert_fees() {
        $this->load->model('fees/fees_model');
        $this->load->model('api/notification_model');
        $insert = $this->input->POST();
        if ($insert['amount'] == '') {
            $insert['amount'] = $insert['c_amount'];
            unset($insert['c_amount']);
        } else
            unset($insert['c_amount']);
        if ($insert['edit_amt'] != 0) {
            $insert_edit = array('fees_info_id' => $insert['fees_info_id'], 'roll_no' => $insert['roll_no'], 'amount' => $insert['edit_amt'], 'reason' => $insert['edit_text'], 'status' => 1);
            $this->fees_model->update_student_fees_details($insert['fees_info_id'], $insert['roll_no']);
            $this->fees_model->insert_student_fees_details($insert_edit);
        }
        $all_student = $this->notification_model->get_all_student2($insert['roll_no']);
        //email notification
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');



        //notification
        $check_insert = 0;
        if ($insert['exam_type'] == 'semester') {
            $check_insert = 1;
            $data['balance'] = 1;
            $paths = 'users/view_fees/' . $insert['fees_info_id'];
        } else {
            $paths = 'users/view_hostel_fees/' . $insert['fees_info_id'];
        }

        $session_data = $this->session->userdata('logged_in');
        unset($all_student[0]['email_id']);
        unset($insert['exam_type']);
        $insert_not = array('notification' => 'Rs ' . $insert['amount'] . ' Amount Paid Successfully', 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);
        $all_student[0]['notification_id'] = $last_id['id'];
        $all_student[0]['user_type'] = 'student';
        $all_student[0]['links'] = $paths;
        $all_student[0]['read'] = 0;

        $this->notification_model->insert_all_staff($all_student);


        unset($insert['edit_amt']);
        unset($insert['edit_text']);
        $user_det = $this->session->userdata('logged_in');
        $insert['created_by'] = $user_det['user_id'];
        $insert['staff_type'] = $user_det['staff_type'];
        $this->fees_model->insert_student_fees($insert);
        if ($check_insert == 1) {
            $data['balance'] = 1;
            $data['fees_info'] = $this->fees_model->get_all_sem_fees_by_id($insert['fees_info_id']);
            $data['fees_info1'] = $this->fees_model->get_student_fees_details1($insert['roll_no'], $insert['fees_info_id']);
        } else {
            $data['fees_info'] = $this->fees_model->get_all_sem_fees_by_id2($insert['fees_info_id']);
            $data['fees_info1'] = $this->fees_model->get_student_fees_details2($insert['roll_no'], $insert['fees_info_id']);
        }
//        $this->load->library('email');
//        $config['protocol'] = 'sendmail';
//        $config['mailpath'] = '/usr/sbin/sendmail';
//        $config['charset'] = 'iso-8859-1';
//        $config['wordwrap'] = TRUE;
//        $this->email->initialize($config);
//        $this->email->from('noreply@email.com', 'iBoard');
//        $this->email->to($data['fees_info1'][0]['email_id']);
//        $this->email->subject('[iBoard] Fees Added');
//        $this->email->set_mailtype("html");
//        $msg = $this->load->view('users/email_fees_view', $data, TRUE);
//        $this->email->message($msg);
//        $this->email->send();

        $data['fees_info'] = $this->fees_model->get_student_fees_details($insert['roll_no']);
        echo $this->load->view('fees/pay_fees', $data);
    }

    public function insert_fees1() {
        $this->load->model('fees/fees_model');
        $this->load->model('api/notification_model');
        $insert = $this->input->POST();
        if ($insert['amount'] == '') {
            $insert['amount'] = $insert['c_amount'];
            unset($insert['c_amount']);
        } else
            unset($insert['c_amount']);
        if ($insert['edit_amt'] != 0) {
            $insert_edit = array('fees_info_id' => $insert['fees_info_id'], 'roll_no' => $insert['roll_no'], 'amount' => $insert['edit_amt'], 'reason' => $insert['edit_text'], 'status' => 1);
            $this->fees_model->update_student_fees_details($insert['fees_info_id'], $insert['roll_no']);
            $this->fees_model->insert_student_fees_details($insert_edit);
        }
        $all_student = $this->notification_model->get_all_student2($insert['roll_no']);
        //email notification
        $this->load->model('fees/fees_model');
        $user_det = $this->session->userdata('logged_in');
        $check_insert = 0;
        if ($insert['exam_type'] == 'semester') {
            $check_insert = 1;
            $paths = 'users/view_fees/' . $insert['fees_info_id'];
        } else
            $paths = 'users/view_hostel_fees/' . $insert['fees_info_id'];

        $session_data = $this->session->userdata('logged_in');
        unset($all_student[0]['email_id']);
        unset($insert['exam_type']);
        $insert_not = array('notification' => 'Rs ' . $insert['amount'] . ' Amount Paid Successfully and Payment Completed', 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);
        $all_student[0]['notification_id'] = $last_id['id'];
        $all_student[0]['user_type'] = 'student';
        $all_student[0]['links'] = $paths;
        $all_student[0]['read'] = 0;

        $this->notification_model->insert_all_staff($all_student);
        unset($insert['edit_amt']);
        unset($insert['edit_text']);
        $user_det = $this->session->userdata('logged_in');
        $insert['created_by'] = $user_det['user_id'];
        $insert['staff_type'] = $user_det['staff_type'];
        $this->fees_model->insert_student_fees($insert);
        $this->fees_model->update_student_fees($insert['fees_info_id'], $insert['roll_no']);

        if ($check_insert == 1) {
            $data['balance'] = 1;
            $data['fees_info'] = $this->fees_model->get_all_sem_fees_by_id($insert['fees_info_id']);
            $data['fees_info1'] = $this->fees_model->get_student_fees_details1($insert['roll_no'], $insert['fees_info_id']);
        } else {
            $data['fees_info'] = $this->fees_model->get_all_sem_fees_by_id2($insert['fees_info_id']);
            $data['fees_info1'] = $this->fees_model->get_student_fees_details2($insert['roll_no'], $insert['fees_info_id']);
        }
//        $this->load->library('email');
//        $config['protocol'] = 'sendmail';
//        $config['mailpath'] = '/usr/sbin/sendmail';
//        $config['charset'] = 'iso-8859-1';
//        $config['wordwrap'] = TRUE;
//        $this->email->initialize($config);
//        $this->email->from('noreply@email.com', 'iBoard');
//        $this->email->to($data['fees_info1'][0]['email_id']);
//        $this->email->subject('[iBoard] Fees Added');
//        $this->email->set_mailtype("html");
//        $msg = $this->load->view('users/email_fees_view', $data, TRUE);
//        $this->email->message($msg);
//        $this->email->send();

        $data['fees_info'] = $this->fees_model->get_student_fees_details($insert['roll_no']);
        echo $this->load->view('fees/pay_fees', $data);
    }

    public function fees_details($id, $roll_no, $status) {
        $this->load->model('fees/fees_model');
        if ($status == 'semester') {
            $data['balance'] = 1;
            $data['fees_info'] = $this->fees_model->get_all_sem_fees_by_id($id);
            $data['fees_info1'] = $this->fees_model->get_student_fees_details1($roll_no, $id);
        } else {
            $data['fees_info'] = $this->fees_model->get_all_sem_fees_by_id2($id);
            $data['fees_info1'] = $this->fees_model->get_student_fees_details2($roll_no, $id);
        }
        echo $this->load->view('users/print_fees_view', $data, TRUE);
    }

    public function report() {
        $this->load->model('fees/fees_model');
        $data['all_batch'] = $this->fees_model->get_all_batch();
        $this->template->write_view('content', 'fees/exam_fees_report', $data);
        $this->template->render();
    }

    public function get_department_by_batch() {
        $batch_id = $this->input->POST('batch_id');
        $this->load->model('fees/fees_model');
        $data['all_department'] = $this->fees_model->get_all_department($batch_id);
        $g_select = '<select id="depart"><option value="">Select</option>';
        if (isset($data['all_department']) && !empty($data['all_department'])) {
            foreach ($data['all_department'] as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['department'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    function get_sem_by_depart() {
        $depart_id = $this->input->POST('depart_id');
        $this->load->model('fees/fees_model');
        $data['all_sem'] = $this->fees_model->get_all_sem($depart_id);
        $g_select = '<select id="semester"><option value="">Select</option>';
        if (isset($data['all_sem']) && !empty($data['all_sem'])) {
            foreach ($data['all_sem'] as $val) {
                $g_select = $g_select . "<option value='" . $val['semester_id'] . "'>Year-" . $val['semester_id'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    function get_all_fees_name() {
        $where = $this->input->POST();
        $this->load->model('fees/fees_model');
        $data['all_bill'] = $this->fees_model->get_all_bill_name($where);
        $g_select = '<table><tr><td width="221">Bill Name</td><td><select id="all_bill"><option value="">Select</option>';
        if (isset($data['all_bill']) && !empty($data['all_bill'])) {
            foreach ($data['all_bill'] as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['bill_name'] . "</option>";
            }
        }
        $g_select = $g_select . '</select></td><tr></table>';
        echo $g_select;
    }

    function get_all_group() {
        $where = $this->input->POST();
        $this->load->model('fees/fees_model');
        $data['all_group'] = $this->fees_model->get_all_group_by_depart_id($where);
        $g_select = '<select id="group"><option value="">Select</option>';
        if (isset($data['all_group']) && !empty($data['all_group'])) {
            foreach ($data['all_group'] as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    function get_all_student() {
        $where = $this->input->POST();
        $this->load->model('fees/fees_model');
        $data['all_student'] = $this->fees_model->get_all_student($where);
        $data['fees_info'] = $this->fees_model->get_fees_info($where);
        $data['payment_status'] = $where['payment_status'];
        echo $this->load->view('fees/student_fees_report', $data);
    }

    function get_all_student_for_hostel() {
        $where = $this->input->POST();
        $this->load->model('fees/fees_model');
        $data['all_student'] = $this->fees_model->get_all_student_for_hostel($where);
        $data['fees_info'] = $this->fees_model->get_fees_info($where);
        echo $this->load->view('fees/student_fees_report', $data);
    }

    function get_year() {

    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
