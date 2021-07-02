<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff_attendence extends MX_Controller {

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
        $this->load->model('master/master_model');
        $user_det = $this->session->userdata('logged_in');
        $permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
        if ($permission[0]['attendance'] == 0)
            redirect($this->config->item('base_url') . 'admin/index');
    }

    public function index() {
        $data = array();
        $this->load->model('staff_attendence/staff_attendence_model');
        if ($this->input->post()) {
            $input = $this->input->post();
            $data['staff_attendance'] = $this->staff_attendence_model->get_staff_attendance_by_date($input['date']);
            $data['date'] = $input['date'];
        } else {
            $data['staff_attendance'] = $this->staff_attendence_model->get_staff_attendance_by_date(date('Y-m-d'));
            $data['date'] = date('Y-m-d');
        }
        $this->template->write_view('content', 'staff_attendence/index', $data);
        $this->template->render();
    }

    public function live_entry() {
        $this->load->model('staff_attendence/staff_attendence_model');
        $this->staff_attendence_model->insert_staff_attendance($_GET);
    }

    public function update_staff_attendance() {
        $input = $this->input->get();
        $this->load->model('staff_attendence/staff_attendence_model');
        $in = array('staff_id' => $input['staff_id'], 'access_card_no' => $input['access_card_no'], 'date' => $input['st_date'], 'time' => $input['in_time']);
        $out = array('staff_id' => $input['staff_id'], 'access_card_no' => $input['access_card_no'], 'date' => $input['st_date'], 'time' => $input['out_time']);
        $this->staff_attendence_model->insert_staff_attendance($in);
        $this->staff_attendence_model->insert_staff_attendance($out);
        $date_1 = $input['in_time'];
        $date_2 = $input['out_time'];
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        echo $interval->format('%h:%i');
    }

    public function staff_attendance_report() {
        $data = array();
        $this->load->model('staff_attendence/staff_attendence_model');
        $data['date'] = '';
        if ($this->input->post()) {
            $input = $this->input->post();
            $data['date'] = '01-' . $input['month'];
            $list = array();
            $month = date('m', strtotime('01-' . $input['month']));
            $year = date('Y', strtotime('01-' . $input['month']));

            for ($d = 1; $d <= 31; $d++) {
                $time = mktime(12, 0, 0, $month, $d, $year);
                if (date('m', $time) == $month)
                    $list[] = date('Y-m-d', $time);
            }

            $data['report'] = $this->staff_attendence_model->report($list);
            $data['all_days'] = $list;
        }
        $this->template->write_view('content', 'staff_attendence/staff_attendance_report', $data);
        $this->template->render();
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */