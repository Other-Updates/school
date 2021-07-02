<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exam extends MX_Controller {

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
    }

    public function index() {
        $this->load->model('exam/exam_model');
        $data["details"] = $this->exam_model->get_exam();
        $data["status"] = 1;
        $this->template->write_view('content', 'exam/index', $data);
        $this->template->render();
    }

    public function insert_exam() {
        $this->load->model('exam/exam_model');
        $input = array('exam' => $this->input->post('value1'));
        $this->exam_model->insert_exam($input);
        $data["details"] = $this->exam_model->get_exam();
        $data["list"] = $this->exam_model->get_exam();
        $data["status"] = 1;
        echo $this->load->view('view_list', $data);
    }

    public function update_exam() {

        $this->load->model('exam/exam_model');
        $id = $this->input->post('value1');
        {
            $input = array('exam' => $this->input->post('value2'), 'status' => $this->input->post('value3'));
            $this->exam_model->update_exam($input, $id);
            $data["details"] = $this->exam_model->get_exam();
            $data["list"] = $this->exam_model->get_exam();
            $data["status"] = $this->input->post('value3');
            echo $this->load->view('view_list', $data);
        }
    }

    public function delete_exam() {
        $this->load->model('exam/exam_model');
        $id = $this->input->post('value1');
        $alert = $this->exam_model->delete_exam_inactive_check($id);
        $i = 0;
        if ($alert) {
            $i = 1;
        }
        if ($i == 1) {
            echo "<script type='text/javascript'>alert('Designation Assign to some other place so can not In-Active ');</script>";

            $data["details"] = $this->exam_model->get_exam();
            $data["list"] = $this->exam_model->get_exam();
            $data["status"] = 1;
            echo $this->load->view('view_list', $data);
        } else {
            $this->exam_model->delete_exam($id);
            $data["details"] = $this->exam_model->get_exam();
            $data["list"] = $this->exam_model->get_exam();
            $data["status"] = 0;
            echo $this->load->view('view_list', $data);
        }
    }

    public function delete_exam_inactive() {
        $this->load->model('exam/exam_model');
        $id = $this->input->post('value1');
        $alert = $this->exam_model->delete_exam_inactive_check($id);
        $i = 0;
        if ($alert) {
            $i = 1;
        }
        if ($i == 1) {
            echo "<script type='text/javascript'>alert('Designation Assign to some other place so can not In-Active ');</script>";

            $data["details"] = $this->exam_model->get_exam();
            $data["list"] = $this->exam_model->get_exam();
            $data["status"] = 1;
            echo $this->load->view('view_list', $data);
        } else {
            $this->exam_model->delete_exam_inactive($id);
            $data["details"] = $this->exam_model->get_exam();
            $data["list"] = $this->exam_model->get_exam();
            $data["status"] = 0;
            $data["df"] = 1;
            echo $this->load->view('view_list', $data);
        }
    }

    public function checking_exam() {
        $this->load->model('exam/exam_model');
        $exam = $this->input->post('value1');
        $data = $this->exam_model->checking_exam($exam);
        $i = 0;
        if ($data) {
            $i = 1;
        }
        if ($i == 1) {
            echo "Designation Name Already Exist";
        }
    }

    public function checking_Update() {
        $this->load->model('exam/exam_model');
        $exam = $this->input->post('value1');
        $id = $this->input->post('value2');

        $data = $this->exam_model->checking_Update($exam, $id);
        $i = 0;
        if ($data) {
            $i = 1;
        }
        if ($i == 1) {
            echo "Designation Name Already Exist";
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
