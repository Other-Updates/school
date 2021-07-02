<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hostel extends MX_Controller {

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
    }

    function room_allocation() {
        $this->template->write_view('content', 'hostel/room_allocation');
        $this->template->render();
    }

    public function get_student_list() {
        $atten_inputs = $this->input->POST();

        $this->load->model('attendance_od_ml/attendance_od_ml_model');
        $data = $this->attendance_od_ml_model->get_sutent_list_for_hostel($atten_inputs);
        foreach ($data as $st_rlno) {
            echo $st_rlno['std_id'] . "\n";
        }
    }

    public function get_student_list1() {
        $atten_inputs = $this->input->POST();

        $this->load->model('hostel/hostel_model');
        $data = $this->hostel_model->get_sutent_list_for_hostel1_last($atten_inputs);
        foreach ($data as $st_rlno) {
            echo $st_rlno['std_id'] . "\n";
        }
    }

    public function get_student_list2() {
        $atten_inputs = $this->input->POST();

        $this->load->model('hostel/hostel_model');
        $data = $this->hostel_model->get_sutent_list_for_hostel1($atten_inputs);
        foreach ($data as $st_rlno) {
            echo $st_rlno['std_id'] . "\n";
        }
    }

    public function view_student_fees() {
        $this->load->model('hostel/hostel_model');
        $roll_no = $this->input->POST();
        $data['checking'] = $this->hostel_model->checking_student_admission($roll_no['roll_no']);
        //echo "<pre>"; print_r($data); exit;
        if (isset($data['checking']) && !empty($data['checking'])) {
            $data['std_info'] = $this->hostel_model->get_student_hostel_details($roll_no['roll_no']);
            $data['all_room'] = $this->hostel_model->get_all_hostel_room($data['std_info'][0]['gender'], $data['checking'][0]['block_id']);
            $info = array('batch_id' => $data['std_info'][0]['batch_id'], 'depart_id' => $data['std_info'][0]['depart_id'], 'group_id' => $data['std_info'][0]['group_id']);
            $data['suggested_room'] = $this->hostel_model->get_all_suggested_room_room($data['std_info'][0]['gender'], $data['std_info'][0]['id'], $info, $data['checking'][0]['block_id']);
            //echo "<pre>"; print_r($data); exit;
            echo $this->load->view('hostel/student_hostel_details', $data);
        } else {
            echo "<br/>";
            echo "<b style='margin-left:265px;color:#FF4747;font-size:15px;'>Admission not done yet&nbsp;!</b>";
        }
    }

    public function get_all_seat_by_room() {
        $this->load->model('hostel/hostel_model');
        $room_id = $this->input->POST();
        $data['roll_no'] = $room_id['roll_no'];
        $data['seat_info'] = $this->hostel_model->get_all_seat_by_room_id($room_id['room_id']);
        echo $this->load->view('hostel/seat_arrangement', $data);
    }

    public function insert_seat() {
        $this->load->model('hostel/hostel_model');
        $user_det = $this->session->userdata('logged_in');
        $insert = $this->input->POST();

        $data['roll_no'] = $insert['roll_no'];
        $insert['created_by'] = $user_det['user_id'];
        $insert['staff_type'] = $user_det['staff_type'];
        unset($insert['roll_no']);
        $this->hostel_model->delete_user_by_id($insert['user_id']);
        $this->hostel_model->insert_seat($insert);

        $data['seat_info'] = $this->hostel_model->get_all_seat_by_room_id($insert['room_id']);
        echo $this->load->view('hostel/seat_arrangement', $data);
    }

    public function replace_seat() {
        $this->load->model('hostel/hostel_model');
        $user_det = $this->session->userdata('logged_in');
        $insert = $this->input->POST();
        $data['roll_no'] = $insert['roll_no'];
        $insert['created_by'] = $user_det['user_id'];
        $insert['staff_type'] = $user_det['staff_type'];
        $this->hostel_model->delete_user_by_id_for_user_id($insert['user_id']);
        unset($insert['roll_no']);
        $this->hostel_model->delete_user_by_id1($insert['seat_id']);
        unset($insert['seat_id']);
        $this->hostel_model->insert_seat($insert);
        $data['seat_info'] = $this->hostel_model->get_all_seat_by_room_id($insert['room_id']);
        echo $this->load->view('hostel/seat_arrangement', $data);
    }

    public function insert_advance_amt() {
        $this->load->model('hostel/hostel_model');
        $user_det = $this->session->userdata('logged_in');
        $insert = $this->input->POST();
        $insert['created_by'] = $user_det['user_id'];
        $insert['staff_type'] = $user_det['staff_type'];
        $this->hostel_model->insert_advance($insert);
    }

    public function add_hostel() {
        $this->load->model('hostel/hostel_model');
        $this->template->write_view('content', 'hostel/add_hostel');
        $this->template->render();
    }

    public function inset_hostel() {
        $this->load->model('hostel/hostel_model');
        $insert = $this->input->POST();
        $user_det = $this->session->userdata('logged_in');
        $insert['created_by'] = $user_det['user_id'];
        $insert['staff_type'] = $user_det['staff_type'];
        $this->hostel_model->insert_hostel($insert);
        echo $this->load->view('hostel/view_hostel');
    }

    public function update_hostel() {
        $this->load->model('hostel/hostel_model');
        $user_det = $this->session->userdata('logged_in');
        $id = $this->input->post('id');
        $update = array('block' => $this->input->post('block'), 'block_for' => $this->input->post('block_for'), 'total_amount' => $this->input->post('total_amount'), 'per_day' => $this->input->post('per_day'), 'hostel_type' => $this->input->post('hostel_type'), 'created_by' => $user_det['user_id'], 'staff_type' => $user_det['staff_type']);

        $this->hostel_model->update_hostel($update, $id);
        echo $this->load->view('hostel/view_hostel');
    }

    public function admission() {
        $this->load->model('hostel/hostel_model');
        $this->load->model('api/notification_model');
        if ($this->input->post()) {

            $insert = $this->input->post();
            $insert['admission_date'] = date('Y-m-d', strtotime($insert['admission_date']));
            $user_det = $this->session->userdata('logged_in');
            $insert['created_by'] = $user_det['user_id'];
            $insert['staff_type'] = $user_det['staff_type'];
            $this->hostel_model->insert_advance($insert);
            //
            $all_student = $this->notification_model->get_all_student2($insert['roll_no']);
            $title = 'Hostel Admission Successfully Finished';
            $session_data = $this->session->userdata('logged_in');
            $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
            $last_id = $this->notification_model->insert_notification($insert_not);
            $paths = 'users/hostel_fees/';
            $all_student[0]['notification_id'] = $last_id['id'];
            $all_student[0]['user_type'] = 'student';
            $all_student[0]['links'] = $paths;
            unset($all_student[0]['email_id']);
            $all_student[0]['read'] = 0;

            $this->notification_model->insert_all_staff($all_student);
            //
            redirect($this->config->item('base_url') . 'hostel/admission_list');
        }
        $this->load->model('hostel/hostel_model');
        $this->template->write_view('content', 'hostel/admission');
        $this->template->render();
    }

    public function admission_list() {
        $this->load->model('hostel/hostel_model');
        $data['advance'] = $this->hostel_model->get_all_student_advance();
        //echo "<pre>";print_r($data);exit;
        $this->template->write_view('content', 'hostel/admission_list', $data);
        $this->template->render();
    }

    public function room_allocation_list() {
        $this->load->model('hostel/hostel_model');
        $data['advance'] = $this->hostel_model->get_all_student_room_details();

        $this->template->write_view('content', 'hostel/room_allocation_list', $data);
        $this->template->render();
    }

    public function view_student_hostel_details($id, $hostel) {

        $this->load->model('hostel/hostel_model');
        $data['hostel_details'] = $this->hostel_model->view_student_hostel_details($id, $hostel);
        $this->template->write_view('content', 'hostel/view_student_hostel_details', $data);
        $this->template->render();
    }

    public function student_admission() {
        $this->load->model('hostel/hostel_model');
        $roll_no = $this->input->POST();

        $data['std_info'] = $this->hostel_model->get_student_hostel_details($roll_no['roll_no']);

        if (isset($data['std_info']) && !empty($data['std_info'])) {
            $data['hostel_name'] = $this->hostel_model->get_all_hostel($data['std_info'][0]['gender']);

            $data['checking'] = $this->hostel_model->checking_student_admission($roll_no['roll_no']);

            if (isset($data['checking']) && !empty($data['checking'])) {
                $data['std_info1'] = $this->hostel_model->get_student_admission_details($roll_no['roll_no']);

                echo $this->load->view('hostel/update_student_admission_form', $data);
            } else {
                echo $this->load->view('hostel/student_admission_form', $data);
            }
        } else {
            echo "<br/>";
            echo "<b style='margin-left:265px;color:#FF4747;font-size:15px;'>Result not found&nbsp;!</b>";
        }
    }

    public function view_student_admission($id) {
        $this->load->model('hostel/hostel_model');
        $data['std_info'] = $this->hostel_model->get_student_admission_details($id);
        $this->template->write_view('content', 'hostel/view_student_admission_form', $data);
        $this->template->render();
    }

    public function update_student_admission($id) {
        $this->load->model('hostel/hostel_model');

        $data['std_info1'] = $this->hostel_model->get_student_admission_details($id);
        $data['hostel_name'] = $this->hostel_model->get_all_hostel($data['std_info1'][0]['gender']);

        $this->template->write_view('content', 'hostel/update_student_admission_form', $data);
        $this->template->render();
    }

    public function update_student_admission_error() {
        $this->load->model('hostel/hostel_model');
        $this->load->model('api/notification_model');
        $user_det = $this->session->userdata('logged_in');
        $update = $this->input->post();
        $roll_no = $update['roll_no'];
        $adm_date = date('Y-m-d', strtotime($update['admission_date']));
        $update_arr = array('block_id' => $update['block_id'], 'amount' => $update['amount'], 'admission_date' => $adm_date, 'start_year' => $update['start_year'], 'end_year' => $update['end_year'], 'created_by' => $user_det['user_id'], 'staff_type' => $user_det['staff_type']);

        $this->hostel_model->update_student_admission($update_arr, $roll_no);
        //
        $all_student = $this->notification_model->get_all_student2($roll_no);
        $title = 'Hostel Admission Updfated Successfully';
        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);
        $paths = 'users/hostel_fees/';
        $all_student[0]['notification_id'] = $last_id['id'];
        $all_student[0]['user_type'] = 'student';
        $all_student[0]['links'] = $paths;
        unset($all_student[0]['email_id']);
        $all_student[0]['read'] = 0;

        $this->notification_model->insert_all_staff($all_student);
        //
        redirect($this->config->item('base_url') . 'hostel/admission_list');
    }

    public function get_amount_by_hostel_id() {
        $this->load->model('hostel/hostel_model');
        $h_id = $this->input->POST();
        $data['amt_info'] = $this->hostel_model->get_advance_amt($h_id['h_id']);
        echo "<input type='text' id='std_advance' style='float:left' name='amount' readonly='readonly' value='" . $data['amt_info'][0]['total_amount'] . "'>";
        if ($data['amt_info'][0]['hostel_type'] == 1) {
            echo " ( Rs " . $data['amt_info'][0]['per_day'] . " / Day )";
        }
        echo " <input type='button' value='Edit' id='edit_adv_amt' class='btn bg-navy btn-sm' title='Edit' style='float:left;margin-left:10px;margin-top: -1px;'>";
    }

    public function monthly_fees_list() {
        $this->load->model('hostel/hostel_model');
        $data['monthly_fees'] = $this->hostel_model->get_all_monthly_fees();

        $this->template->write_view('content', 'hostel/monthly_fees_list', $data);
        $this->template->render();
    }

    public function add_monthly_fees() {
        $this->load->model('hostel/hostel_model');
        $user_det = $this->session->userdata('logged_in');
        if ($this->input->post()) {
            $insert = $this->input->post();
            $insert['hostel_monthly_fees']['from_date'] = date('Y-m-d', strtotime($insert['hostel_monthly_fees']['from_date']));
            $insert['hostel_monthly_fees']['due_date'] = date('Y-m-d', strtotime($insert['hostel_monthly_fees']['due_date']));
            $insert['hostel_monthly_fees']['created_by'] = $user_det['user_id'];
            $insert['hostel_monthly_fees']['staff_type'] = $user_det['staff_type'];
            $insert_id = $this->hostel_model->insert_monthly_fees($insert['hostel_monthly_fees']);

            foreach ($insert['bill_name'] as $key => $val) {
                if ($val != "") {
                    $insert_details = array('monthly_fees_id' => $insert_id['id'], 'bill_name' => $val, 'amount' => $insert['amount'][$key]);
                    $this->hostel_model->insert_monthly_fees_details($insert_details);
                }
            }
            redirect($this->config->item('base_url') . 'hostel/monthly_fees_list');
        }
        $this->load->model('hostel/hostel_model');
        $data['hostel_info'] = $this->hostel_model->get_all_hostel_details1();
        $this->template->write_view('content', 'hostel/add_monthly_fees', $data);
        $this->template->render();
    }

    public function view_monthly_fees($id) {
        $this->load->model('hostel/hostel_model');
        $data['monthly_fees'] = $this->hostel_model->get_monthly_fees_details($id);
        $this->template->write_view('content', 'hostel/view_monthly_fees', $data);
        $this->template->render();
    }

    public function update_monthly_fees($id) {
        $this->load->model('hostel/hostel_model');
        $user_det = $this->session->userdata('logged_in');
        if ($this->input->post()) {
            $from_date = date('Y-m-d', strtotime($this->input->post('from_date')));
            $due_date = date('Y-m-d', strtotime($this->input->post('due_date')));
            $m_id = $this->input->post('m_id');
            $this->hostel_model->delete_monthly_fees($m_id);
            $update = array('block_id' => $this->input->post('block_id'), 'month' => $this->input->post('fees_month'), 'year' => $this->input->post('fees_year'), 'no_of_days' => $this->input->post('no_of_days'), 'no_of_student' => $this->input->post('no_of_student'), 'total_amount' => $this->input->post('total_amount'), 'per_head' => $this->input->post('per_head'), 'per_day' => $this->input->post('per_day'), 'fine_type' => $this->input->post('fine_type'), 'fine_option' => $this->input->post('fine_option'), 'fine_amount' => $this->input->post('fine_amount'), 'block_id' => $this->input->post('block_id'), 'from_date' => $from_date, 'due_date' => $due_date, 'block_id' => $this->input->post('block_id'), 'created_by' => $user_det['user_id'], 'staff_type' => $user_det['staff_type']);
            $update_id = $this->hostel_model->update_monthly_fees($update, $m_id);
            $update_amount = $this->input->post();
            foreach ($this->input->post('bill_name') as $key => $val) {
                if ($val != "") {
                    $update_details = array('monthly_fees_id' => $m_id, 'bill_name' => $val, 'amount' => $update_amount['amount'][$key]);
                    $this->hostel_model->insert_monthly_fees_details($update_details);
                }
            }
            redirect($this->config->item('base_url') . 'hostel/monthly_fees_list');
        }
        $data['hostel_info'] = $this->hostel_model->get_all_hostel_details();
        $data['monthly_fees'] = $this->hostel_model->get_monthly_fees_details($id);
        $this->template->write_view('content', 'hostel/update_monthly_fees', $data);
        $this->template->render();
    }

    public function get_no_of_student_by_hostel_id() {
        $this->load->model('hostel/hostel_model');
        $h_id = $this->input->POST();
        $count = $this->hostel_model->get_no_of_student($h_id['h_id']);
        echo $count;
    }

    public function add_room() {
        $this->load->model('hostel/hostel_model');
        /* $input=array('block_id'=>$this->input->post('value1'),'room_name'=>$this->input->post('value2'),'no_of_seat'=>$this->input->post('value3'));
          $this->hostel_model->insert_hostel($input); */
        $data["hostel_info"] = $this->hostel_model->get_hostel();
        $data["list"] = $this->hostel_model->get_hostel_details();
        $this->template->write_view('content', 'hostel/add_room', $data);
        $this->template->render();
    }

    public function insert_room() {
        $this->load->model('hostel/hostel_model');
        $user_det = $this->session->userdata('logged_in');
        $input = array('block_id' => $this->input->post('value1'), 'room_name' => $this->input->post('value2'),
            'no_of_seat' => $this->input->post('value3'), 'created_user' => $user_det['user_id'], 'staff_type' => $user_det['staff_type']);

        $this->hostel_model->insert_room($input);
        $data["hostel_info"] = $this->hostel_model->get_hostel();
        $data["list"] = $this->hostel_model->get_hostel_details();
        echo $this->load->view('hostel/add_room_list', $data);
    }

    public function checking_Update() {
        $this->load->model('hostel/hostel_model');
        $id = $this->input->post('value1');
        $block_id = $this->input->post('value2');
        $room_name = $this->input->post('value3');
        $no_of_seat = $this->input->post('value4');
        $data = $this->hostel_model->checking_Update($block_id, $room_name, $no_of_seat);
        $i = 0;
        if ($data) {
            $i = 1;
        }
        if ($i == 1) {
            echo "Hostel Name Already Exist";
        }
    }

    public function update_room() {
        $this->load->model('hostel/hostel_model');
        $id = $this->input->post('value1');

        $input = array('block_id' => $this->input->post('value2'), 'room_name' => $this->input->post('value3'),
            'no_of_seat' => $this->input->post('value4'));
        $this->hostel_model->update_room($input, $id);
        $data["list"] = $this->hostel_model->get_hostel_details();
        $data["hostel_info"] = $this->hostel_model->get_hostel();
        echo $this->load->view('add_room_list', $data);
    }

    public function pay_monthly_fees() {
        $this->template->write_view('content', 'hostel/pay_monthly_fees');
        $this->template->render();
    }

    public function monthly_fees_form() {
        $this->load->model('hostel/hostel_model');
        $roll_no = $this->input->POST();
        $data['my_monthly_fees'] = $this->hostel_model->get_student_monthly_fees($roll_no['roll_no']);
        if (isset($data['my_monthly_fees']) && !empty($data['my_monthly_fees'])) {
            echo $this->load->view('hostel/monthly_fees_form', $data);
        } else {
            echo "<br/>";
            echo "<b style='margin-left:265px;color:#FF4747;font-size:15px;'>Result not found&nbsp;!</b>";
        }
    }

    public function insert_monthly_fees_form() {
        $this->load->model('hostel/hostel_model');
        $insert = $this->input->POST();
        $this->hostel_model->insert_student_monthly_fees($insert);
        $data['my_monthly_fees'] = $this->hostel_model->get_student_monthly_fees($insert['roll_no']);
        echo $this->load->view('hostel/monthly_fees_form', $data);
    }

    public function hostel_report() {
        $this->load->model('hostel/hostel_model');
        $data['hostel_name'] = $this->hostel_model->get_all_hostel_name_for_report();
        $this->template->write_view('content', 'hostel/hostel_report', $data);
        $this->template->render();
    }

    public function get_year() {
        $this->load->model('hostel/hostel_model');
        $insert = $this->input->POST();
        $year = $this->hostel_model->get_all_year_by_hostel_id($insert['h_id']);
        $g_select = '<select id="year"><option value="">Select</option>';
        if (isset($year) && !empty($year)) {
            foreach ($year as $val) {
                $g_select = $g_select . "<option value='" . $val['year'] . "'>" . $val['year'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function get_month() {
        $this->load->model('hostel/hostel_model');
        $insert = $this->input->POST();
        $year = $this->hostel_model->get_all_month_by_hostel_id($insert['h_id'], $insert['year']);
        $g_select = '<select id="month"><option value="">Select</option>';
        if (isset($year) && !empty($year)) {
            $month_arr = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
            foreach ($year as $val) {

                foreach ($month_arr as $key => $val1) {
                    if ($key + 1 == $val['month'])
                        $month = $val1;
                }
                $g_select = $g_select . "<option value='" . $val['month'] . "'>" . $month . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function get_student_list_for_report() {
        $this->load->model('hostel/hostel_model');
        $insert = $this->input->POST();
        $data['student_list'] = $this->hostel_model->get_monthly_report($insert);
        /* echo "<pre>";
          print_r($data['student_list']);
          exit; */
        echo $this->load->view('hostel/monthly_fees_student_report_form', $data, TRUE);
    }

    public function print_hostel_fees($id, $std_info) {
        $this->load->model('hostel/hostel_model');
        $data['fees_info'] = $this->hostel_model->view_hostel_fees1($id, $std_info);

        echo $this->load->view('users/view_monthly_fees', $data);
    }

    public function add_duplicate_hostel() {
        $this->load->model('hostel/hostel_model');
        $input = $this->input->post('value1');
        $validation = $this->hostel_model->add_duplicate_hostel($input);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Hostel Name already Exist";
        }
    }

    public function update_duplicate_hostel() {
        $this->load->model('hostel/hostel_model');
        $input = $this->input->post('value1');
        $id = $this->input->post('value2');
        $validation = $this->hostel_model->update_duplicate_hostel($input, $id);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Hostel Name already Exist";
        }
    }

    public function check_duplicate_room() {
        $this->load->model('hostel/hostel_model');
        $hostelname = $this->input->post('value1');
        $roomno = $this->input->post('value2');
        $validation = $this->hostel_model->check_duplicate_room($hostelname, $roomno);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "This Room No Already Allotted For This Hostel";
        }
    }

    public function check_update_duplicate_room() {
        $this->load->model('hostel/hostel_model');
        $hostelname = $this->input->post('value1');
        $roomno = $this->input->post('value2');
        $id = $this->input->post('value3');
        $validation = $this->hostel_model->check_update_duplicate_room($hostelname, $roomno, $id);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "This Room No Already Allotted For This Hostel";
        }
    }

    public function non_dividing_hostel_report() {
        $this->load->model('hostel/hostel_model');
        $data['hostel_name'] = $this->hostel_model->get_all_hostel_details2();
        $this->template->write_view('content', 'hostel/non_dividing_hostel_report', $data);
        $this->template->render();
    }

    public function get_non_dividing_student_report() {
        $h_id = $this->input->get();
        $this->load->model('hostel/hostel_model');
        $data['non_report'] = $this->hostel_model->non_dividing_student_report($h_id['h_id']);
        echo $this->load->view('hostel/non_dividing_hostel_student_list', $data);
    }

    public function hostel_search() {
        $this->load->model('hostel/hostel_model');
        $hostel_name = $this->input->post('hostel_name');
        $data["hostel_info"] = $this->hostel_model->get_hostel();
        $data["list"] = $this->hostel_model->get_hostel_details_by_hostel($hostel_name);
        $data["count_all"] = $this->hostel_model->get_total_hostel_details($hostel_name);
        echo $this->load->view('hostel/hostel_count_view.php', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
