<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attendance_report extends MX_Controller {

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
        $this->load->model('batch/batch_model');
        $this->load->model('subject/subject_model');
        $user_det = $this->session->userdata('logged_in');
        $permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
        if ($permission[0]['attendance'] == 0)
            redirect($this->config->item('base_url') . 'admin/index');
    }

    public function index() {
        $this->load->model('group/group_model');
        $this->load->model('student/student_model');
        $this->load->model('semester/semester_model');
        $data['all_batch'] = $this->student_model->get_all_batch();
        $data['all_depart'] = $this->group_model->get_all_department();
        $data['group_det'] = $this->group_model->get_all_group();
        $data['sem_list'] = $this->semester_model->get_semester();
        /* echo "<pre>";
          print_r($data['sem_list']);
          exit; */
        $data['batch'] = $this->batch_model->get_default_batch();
        $data['term'] = $this->subject_model->get_default_term();
        $this->template->write_view('content', 'attendance_report/index', $data);
        $this->template->render();
    }

    public function get_sutent_prs_list() {
        $atten_inputs = $this->input->POST();
        $this->load->model('attendance_report_model');
        $data = $this->attendance_report_model->get_sutent_prs_list($atten_inputs);

        echo $this->load->view('attendance_report/studen_att_per_list', $data);
    }

    public function get_sutent_prs_list_report() {
        $atten_inputs = $this->input->get();
        $this->load->model('attendance_report_model');
        $data = $this->attendance_report_model->get_sutent_prs_list($atten_inputs);
        $data['attn_ins'] = $atten_inputs;
        echo $this->load->view('attendance_report/studen_att_per_list_report', $data);
    }

    public function staff_pwd() {
        $pwd_inputs = $this->input->get();
        $this->load->model('attendence_model');
        $data = $this->attendence_model->staff_pwd($pwd_inputs);

        print_r($data);
    }

    public function insert_attend() {
        $atten_inputs = $this->input->POST();
        $this->load->model('attendence_model');
        $data = $this->attendence_model->insert_attend($atten_inputs);
        echo $data;
    }

    public function get_subj() {
        $atten_inputs = $this->input->POST();
        $this->load->model('attendance_report_model');
        $data['subj_list'] = $this->attendance_report_model->get_subj($atten_inputs);
        echo $this->load->view('attendance_report/subj_res', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
