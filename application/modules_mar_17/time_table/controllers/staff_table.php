<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff_table extends MX_Controller {

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

    function staff_view_time_table() {
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
        $this->template->write_view('content', 'time_table/staff_view_time_table', $data);
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

    public function print_time_table() {
        $this->load->model('time_table/time_table_model');
        $data['ajax_val'] = $this->input->post();
        $datas['all_info'] = $this->time_table_model->get_all_details_by_id($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['select_sem']);
        $datas['all_subject'] = $this->time_table_model->get_subject_by_id($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['select_sem']);

        echo $this->load->view('time_table/view_time_table_for_print', $datas);
    }

    public function print_other_time_table() {
        $this->load->model('time_table/time_table_model');
        $data['ajax_val'] = $this->input->post();
        $m_id = 0;
        ;
        //echo "<pre>"; print_r($data['ajax_val']); exit;
        if ($data['ajax_val']['select_type'] == 1) {
            $m_id = "internal";
        } else if ($data['ajax_val']['select_type'] == 2) {
            $m_id = "external";
        } else if ($data['ajax_val']['select_type'] == 3) {
            $m_id = "exam";
        }
        //echo $m_id; exit;
        $data['ajax_val1'] = array('batch_id' => $data['ajax_val']['select_batch'], 'depart_id' => $data['ajax_val']['depart_id'], 'group_id' => $data['ajax_val']['group_id'], 'semester_id' => $data['ajax_val']['select_sem'], 'time_table_method' => $m_id, 'time_table_type' => $data['ajax_val']['int_id']);
        //echo "<pre>"; print_r($data['ajax_val1']); exit;
        $data['int_info'] = $this->time_table_model->print_other_time_table($data['ajax_val1']);
        $data['all_subject'] = $this->time_table_model->get_subject_by_id($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['select_sem']);

        echo $this->load->view('time_table/view_other_time_table_for_print', $data);
    }

    function print_arrear_time_table() {
        $this->load->model('time_table/time_table_model');
        $this->load->model('users/users_model');
        $data['ajax_val'] = $this->input->post();
        //echo "<pre>"; print_r($data['ajax_val']); exit;
        $data['arrear_time'] = $this->users_model->get_arrear_time_table($data['ajax_val']['depart_id']);
        echo $this->load->view('time_table/print_arrear_time_table', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
