<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Board extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index() {
        $this->load->model('board/board_model');
        $data["details"] = $this->board_model->get_board();
        $data["status"] = 1;
        $this->template->write_view('content', 'board/index', $data);
        $this->template->render();
    }

    public function insert_board() {
        $this->load->model('board/board_model');
        $input = array('board_type' => $this->input->post('value1'));
        $this->board_model->insert_board($input);
        $data["details"] = $this->board_model->get_board();
        $data["list"] = $this->board_model->get_board();
        $data["status"] = 1;
        echo $this->load->view('view_list', $data);
    }

    public function update_board() {

        $this->load->model('board/board_model');
        $id = $this->input->post('value1');
        {
            $input = array('board_type' => $this->input->post('value2'), 'status' => $this->input->post('value3'));

            $this->board_model->update_board($input, $id);
            $data["details"] = $this->board_model->get_board();
            $data["list"] = $this->board_model->get_board();
            $data["status"] = $this->input->post('value3');
            echo $this->load->view('view_list', $data);
        }
    }

    public function delete_board() {
        $this->load->model('board/board_model');
        $id = $this->input->post('value1');
        $alert = $this->board_model->delete_board_inactive_check($id);
        $i = 0;
        if ($alert) {
            $i = 1;
        }
        if ($i == 1) {
            echo "<script type='text/javascript'>alert('Board Assign to some other place so can not In-Active ');</script>";

            $data["details"] = $this->board_model->get_board();
            $data["list"] = $this->board_model->get_board();
            $data["status"] = 1;
            echo $this->load->view('view_list', $data);
        } else {
            $this->board_model->delete_board($id);
            $data["details"] = $this->board_model->get_board();
            $data["list"] = $this->board_model->get_board();
            $data["status"] = 0;
            echo $this->load->view('view_list', $data);
        }
    }

    public function delete_board_inactive() {
        $this->load->model('board/board_model');
        $id = $this->input->post('value1');
        $alert = $this->board_model->delete_board_inactive_check($id);
        $i = 0;
        if ($alert) {
            $i = 1;
        }
        if ($i == 1) {
            echo "<script type='text/javascript'>alert('Board Assign to some other place so can not In-Active ');</script>";

            $data["details"] = $this->board_model->get_board();
            $data["list"] = $this->board_model->get_board();
            $data["status"] = 1;
            echo $this->load->view('view_list', $data);
        } else {
            $this->board_model->delete_board_inactive($id);
            $data["details"] = $this->board_model->get_board();
            $data["list"] = $this->board_model->get_board();
            $data["status"] = 0;
            $data["df"] = 1;
            echo $this->load->view('view_list', $data);
        }
    }

    public function checking_board() {
        $this->load->model('board/board_model');
        $board = $this->input->post('value1');
        $data = $this->board_model->checking_board($board);
        $i = 0;
        if ($data) {
            $i = 1;
        }
        if ($i == 1) {
            echo "Board Name Already Exist";
        }
    }

    public function checking_Update() {
        $this->load->model('board/board_model');
        $board = $this->input->post('value1');
        $id = $this->input->post('value2');

        $data = $this->board_model->checking_Update($board, $id);
        $i = 0;
        if ($data) {
            $i = 1;
        }
        if ($i == 1) {
            echo "Board Name Already Exist";
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
