<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Batch extends MX_Controller {

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

        $this->load->model('batch/batch_model');
        $data["list"] = $this->batch_model->get_batch();
        $data["status"] = 1;
        //$data["alumni"]=0;
        $this->template->write_view('content', 'batch/index', $data);
        $this->template->render();
    }

    public function insert_batch() {
        $this->load->model('batch/batch_model');
        $input = array('from' => $this->input->post('value1'), 'status' => 2);
        $this->batch_model->insert_batch($input);
        echo '1';
    }

    public function update_batch() {
        $this->load->model('batch/batch_model');

        $id = $this->input->post('value1');

        $input = array('status' => '1');
        $this->batch_model->update_batch($input, $id);

        $inputs = array('status' => '2');
        $this->batch_model->update_batchs($inputs, $id);
        echo '1';
    }

    public function delete_list() {
        $this->load->model('batch/batch_model');
        $id = $this->input->post('value1');
        $alert = $this->batch_model->delete_batch_inactive($id);

        $this->batch_model->delete_list($id);
        $data["list"] = $this->batch_model->get_batch();
        $data["status"] = 0;
        //$data["alumni"]=0;
        echo $this->load->view('view_list', $data);
    }

    public function delete_batch() {
        $this->load->model('batch/batch_model');
        $id = $this->input->post('value1');
        $alert = $this->batch_model->delete_batch_inactive($id);
        $i = 0;
        if ($alert) {
            $i = 1;
        }

        if ($i == 1) {
            echo "<script type='text/javascript'>alert('Batch Assign to some other place so can not Delete ');</script>";
            $data["list"] = $this->batch_model->get_batch();
            $data["status"] = 1;
            //$data["alumni"]=0;
            echo $this->load->view('view_list', $data);
        } else {

            $this->batch_model->delete_batch($id);
            $data["list"] = $this->batch_model->get_batch();
            $data["status"] = 0;
            //$data["alumni"]=0;
            echo $this->load->view('view_list', $data);
        }
    }

    public function validate_batch() {

        $this->load->model('batch/batch_model');
        //print_r($this->input->post('value1')); exit;
        $fdt = $this->input->post('value1');
        $tdt = $this->input->post('value2');
        $validation = $this->batch_model->validate_batch($fdt, $tdt);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Batch already Exist";
        }
    }

    public function update_validate_batch() {

        $this->load->model('batch/batch_model');
        //print_r($this->input->post('value1')); exit;
        $fdt = $this->input->POST('value1');
        $tdt = $this->input->POST('value2');
        $id = $this->input->POST('value3');

        $validation = $this->batch_model->update_validate_batch($fdt, $tdt, $id);
        $i = 0;
        if ($validation) {
            $i = 1;
        }
        if ($i == 1) {
            echo "Batch already Exist";
        }
    }

    public function get_end_year() {
        $start_year = $this->input->post('value1');
        if ($start_year != "" && !empty($start_year)) {
            $end_year = $start_year + 1;
            $g_select = '<select id="tdate" name="to" class="mandatory to" title="Select Year">
		<option value="" selected="selected">Year</option>';

            for ($i = $end_year; $i < date('Y') + 30; $i++) :

                $g_select = $g_select . "<option value=" . $i . ">" . $i . "</option>";
            endfor;

            $g_select = $g_select . '</select>';

            echo $g_select;
        }
        else {
            $g_select = '<select id="tdate" name="to" class="mandatory to"><option value="" selected="selected">Year</option>';


            $g_select = $g_select . '</select>';

            echo $g_select;
        }
    }

    public function get_end_year_update() {

        $start_year = $this->input->post('value1');


        if ($start_year != "" && !empty($start_year)) {
            $end_year = $start_year + 1;
            $g_select = '<select id="tdate" name="to" class="to form-control mandatory1 mandatory dupe"><option value="" selected="selected">Year</option>';

            for ($i = $end_year; $i < date('Y') + 30; $i++) :

                $g_select = $g_select . "<option value=" . $i . ">" . $i . "</option>";
            endfor;

            $g_select = $g_select . '</select><span class="u_val" style="color:#F00; font-weight:bold"> </span>';

            echo $g_select;
        }
        else {
            $g_select = '<select id="tdate" name="to" class="to form-control mandatory1 mandatory dupe"><option value="" selected="selected">Year</option>';


            $g_select = $g_select . '</select><span class="u_val" style="color:#F00; font-weight:bold"> </span>';

            echo $g_select;
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
