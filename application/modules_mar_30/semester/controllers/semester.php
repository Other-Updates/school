<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class semester extends MX_Controller {

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
        $this->load->model('semester/semester_model');
        $data["details"] = $this->semester_model->get_semester();
        $data["status"] = 1;
        $this->template->write_view('content', 'semester/index', $data);
        $this->template->render();
    }

    public function insert_semester() {
        $this->load->model('semester/semester_model');
        $input = array('semester' => $this->input->post('value1'));
        $this->semester_model->insert_semester($input);
        $data["details"] = $this->semester_model->get_semester();
        $data["list"] = $this->semester_model->get_semester();
        $data["status"] = 1;
        echo $this->load->view('view_list', $data);
    }

    public function update_semester() {

        $this->load->model('semester/semester_model');
        $id = $this->input->post('value1');

        $input = array('status' => '1');
        $this->semester_model->update_semester($input, $id);

        $inputs = array('status' => '2');
        $this->semester_model->update_semesters($inputs, $id);
        echo '1';
    }

    public function delete_semester() {
        $this->load->model('semester/semester_model');
        $id = $this->input->post('value1');
        $alert = $this->semester_model->delete_semester_inactive_check($id);
        $i = 0;
        if ($alert) {
            $i = 1;
        }
        if ($i == 1) {
            echo "<script type='text/javascript'>alert('Semester Assign to some other place so can not In-Active ');</script>";

            $data["details"] = $this->semester_model->get_semester();
            $data["list"] = $this->semester_model->get_semester();
            $data["status"] = 1;
            echo $this->load->view('view_list', $data);
        } else {
            $this->semester_model->delete_semester($id);
            $data["details"] = $this->semester_model->get_semester();
            $data["list"] = $this->semester_model->get_semester();
            $data["status"] = 0;
            echo $this->load->view('view_list', $data);
        }
    }

    public function delete_semester_inactive() {
        $this->load->model('semester/semester_model');
        $id = $this->input->post('value1');
        $alert = $this->semester_model->delete_semester_inactive_check($id);
        $i = 0;
        if ($alert) {
            $i = 1;
        }
        if ($i == 1) {
            echo "<script type='text/javascript'>alert('Semester Assign to some other place so can not In-Active ');</script>";

            $data["details"] = $this->semester_model->get_semester();
            $data["list"] = $this->semester_model->get_semester();
            $data["status"] = 1;
            echo $this->load->view('view_list', $data);
        } else {
            $this->semester_model->delete_semester_inactive($id);
            $data["details"] = $this->semester_model->get_semester();
            $data["list"] = $this->semester_model->get_semester();
            $data["status"] = 0;
            $data["df"] = 1;
            echo $this->load->view('view_list', $data);
        }
    }

    public function checking_semester() {
        $this->load->model('semester/semester_model');
        $semester = $this->input->post('value1');
        $data = $this->semester_model->checking_semester($semester);
        $i = 0;
        if ($data) {
            $i = 1;
        }
        if ($i == 1) {
            echo "Semester Name Already Exist";
        }
    }

    public function checking_Update() {
        $this->load->model('semester/semester_model');
        $semester = $this->input->post('value1');
        $id = $this->input->post('value2');

        $data = $this->semester_model->checking_Update($semester, $id);
        $i = 0;
        if ($data) {
            $i = 1;
        }
        if ($i == 1) {
            echo "Semester Name Already Exist";
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
