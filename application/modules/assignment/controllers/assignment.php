<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assignment extends MX_Controller {

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
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('master/master_model');
        $this->load->model('batch/batch_model');
        $this->load->model('subject/subject_model');
        $this->load->helper('download');
        $user_det = $this->session->userdata('logged_in');
        $permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
        if ($permission[0]['assignment'] == 0)
            redirect($this->config->item('base_url') . 'admin/index');
    }

    public function index() {
        $user_det = $this->session->userdata('logged_in');

        $staff_id = $user_det['user_id'];
        $this->load->model('assignment/assignment_model');
        $data["batch"] = $this->assignment_model->get_batch();
        $data["semester"] = $this->assignment_model->get_semester();
        $data["department"] = $this->assignment_model->get_department();
        if ($user_det['staff_type'] == 'staff') {
            $data["subject"] = $this->assignment_model->get_subject_by_staff($staff_id);



            if (isset($data["subject"]) && !empty($data["subject"])) {

                $c = count($data["subject"]);

                for ($j = 0; $j < $c; $j++) {

                    $data["list"][] = $this->assignment_model->get_assignment($data["subject"][$j]['id']);
                }
            }
        } else {
            $data["list"] = $this->assignment_model->get_assignment_for_admin();
        }
        /* if(isset($data["list"]) && !empty($data["list"]))
          {
          $user_det = $this->session->userdata('logged_in');
          $staff_id=$user_det['user_id'];
          $department=$data["list"][0]['depart_id'];
          $data["group_list"]=$this->assignment_model->get_group($department);

          if($user_det['staff_type']=='staff')
          {
          $where=array(
          'batch_id'=>$this->input->post('batch'),
          'depart_id'=> $this->input->post('dep_id'),
          'group_id'=> $this->input->post('group_id'),
          'semester_id'=>$this->input->post('sem'),
          'staff_id'=> $staff_id
          );
          }
          else echo "<pre>"; print_r($data); exit;
          {
          $where=array(
          'batch_id'=>$this->input->post('batch'),
          'depart_id'=> $this->input->post('dep_id'),
          'group_id'=> $this->input->post('group_id'),
          'semester_id'=>$this->input->post('sem')
          );
          }
          $data["subject_list"]=$this->assignment_model->get_subject_group($where);
          } */

        $data['batch'] = $this->batch_model->get_default_batch();
        $data['term'] = $this->subject_model->get_default_term();
        $this->template->write_view('content', 'assignment/index', $data);
        $this->template->render();
    }

    public function get_group() {
        $this->load->model('assignment/assignment_model');

        $dep_id = $this->input->post('dep_id');

        $g_array = $this->assignment_model->get_group($dep_id);

        $g_select = '<select id="group_id" name="group_id" class="mandatory1 mandatory"><option value="">Select Section</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';

        echo $g_select;
    }

    public function get_sem() {
        $this->load->model('assignment/assignment_model');

        $batch = $this->input->post('batch');

        $g_array = $this->assignment_model->get_sem($batch);

        $g_select = '<select id="sem" name="sem" class="mandatory1 mandatory"><option value="">Select Semester</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['semester'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';

        echo $g_select;
    }

    public function get_group_for_assignment() {
        $this->load->model('assignment/assignment_model');

        $dep_id = $this->input->post('dep_id');

        $g_array = $this->assignment_model->get_group_for_assignment($dep_id);

        $g_select = '<select id="group_id" name="group_id" class="mandatory1"><option value="">Select Section</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';

        echo $g_select;
    }

    public function get_subject_group() {
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $staff_id = $user_det['user_id'];
        if ($user_det['staff_type'] == 'staff') {
            $where1 = array(
                'batch_id' => $this->input->post('batch'),
                'depart_id' => $this->input->post('dep_id'),
                'group_id' => $this->input->post('group_id'),
                'semester_id' => $this->input->post('sem'),
                'staff_id' => $staff_id
            );
        } else {
            $where1 = array(
                'batch_id' => $this->input->post('batch'),
                'depart_id' => $this->input->post('dep_id'),
                'group_id' => $this->input->post('group_id'),
                'semester_id' => $this->input->post('sem')
            );
        }
        $sub_array = $this->assignment_model->get_subject_group($where1);
        $sub_select = '<select id="subject_id" name="sub_name" class="mandatory1 mandatory"><option value="">Select Subject
		</option>';
        if (isset($sub_array) && !empty($sub_array)) {
            foreach ($sub_array as $val) {
                $sub_select = $sub_select . "<option value='" . $val['id'] . "'>" . $val['subject_name'] . "</option>";
            }
        }
        $sub_select = $sub_select . '</select>';
        echo $sub_select;
    }

    public function get_subject_group_for_assignment() {
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $staff_id = $user_det['user_id'];
        if ($user_det['staff_type'] == 'staff') {
            $where1 = array(
                'subject_details.batch_id' => $this->input->post('batch'),
                'subject_details.depart_id' => $this->input->post('dep_id'),
                'subject_details.group_id' => $this->input->post('group_id'),
                'subject_details.semester_id' => $this->input->post('sem'),
                'subject_details.staff_id' => $staff_id
            );
        } else {
            $where1 = array(
                'subject_details.batch_id' => $this->input->post('batch'),
                'subject_details.depart_id' => $this->input->post('dep_id'),
                'subject_details.group_id' => $this->input->post('group_id'),
                'subject_details.semester_id' => $this->input->post('sem')
            );
        }
        $sub_array = $this->assignment_model->get_subject_group_for_assignment($where1);
        $sub_select = '<select id="subject_id" name="sub_name" class="mandatory1"><option value="">Select Subject
		</option>';
        if (isset($sub_array) && !empty($sub_array)) {
            foreach ($sub_array as $val) {
                $sub_select = $sub_select . "<option value='" . $val['id'] . "'>" . $val['subject_name'] . "</option>";
            }
        }
        $sub_select = $sub_select . '</select>';
        echo $sub_select;
    }

    public function get_assignment_number() {
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $staff_id = $user_det['user_id'];


        $where = array(
            'batch_id' => $this->input->post('batch'),
            'depart_id' => $this->input->post('department'),
            'group_id' => $this->input->post('group'),
            'semester_id' => $this->input->post('sem'),
            'subject_id' => $this->input->post('subject')
        );

        $count_group = $this->assignment_model->get_assignment_number($where);
        $count = $count_group[0]['ass_number'] + 1;
        if ($count == 0) {
            $sub_select = '<input type="text" id="ass" name="ass_number" value="1" readonly="readonly">';
        } else {

            $sub_select = '<input type="text" id="ass" name="ass_number" value=' . $count . ' readonly="readonly">';
        }

        echo $sub_select;
    }

    public function add_assignment() {

        $user_det = $this->session->userdata('logged_in');
        $staff_id = $user_det['user_id'];
        $this->load->model('assignment/assignment_model');
        if ($user_det['staff_type'] == 'staff') {
            //  $data["batch"] = $this->assignment_model->get_batch_staff($staff_id);
            //  $data["semester"] = $this->assignment_model->get_semester_staff($staff_id);
            $data["department"] = $this->assignment_model->get_department_staff($staff_id);
            $data["subject"] = $this->assignment_model->get_subject_by_staff($staff_id);
            /* echo "<pre>";
              print_r($data["batch"]);
              exit; */
        } else {
            //   $data["batch"] = $this->assignment_model->get_batch();
            //   $data["semester"] = $this->assignment_model->get_semester();
            $data["department"] = $this->assignment_model->get_department();
        }

        $data['batch'] = $this->batch_model->get_default_batch();
        $data['term'] = $this->subject_model->get_default_term();

        if (isset($data["subject"]) && !empty($data["subject"])) {
            $data["list"] = $this->assignment_model->get_assignment($data["subject"][0]['id']);
        } else {
            $data["list"] = $this->assignment_model->get_assignment_for_admin();
        }

        if (isset($data["list"]) && !empty($data["list"])) {
            $user_det = $this->session->userdata('logged_in');
            $staff_id = $user_det['user_id'];
            $department = $data["list"][0]['depart_id'];
            $data["group_list"] = $this->assignment_model->get_group($department);
            if ($user_det['staff_type'] == 'admin') {
                $where = array(
                    'batch_id' => $data["list"][0]['batch_id'],
                    'depart_id' => $data["list"][0]['depart_id'],
                    'group_id' => $data["list"][0]['group_id'],
                    'semester_id' => $data["list"][0]['semester_id']
                );
            } else {
                $where = array(
                    'batch_id' => $data["list"][0]['batch_id'],
                    'depart_id' => $data["list"][0]['depart_id'],
                    'group_id' => $data["list"][0]['group_id'],
                    'semester_id' => $data["list"][0]['semester_id'],
                    'staff_id' => $staff_id
                );
            }
            $data["subject_list"] = $this->assignment_model->get_subject_group($where);
        }

        $this->template->write_view('content', 'assignment/add_assignment', $data);
        $this->template->render();
    }

    public function insert_assignment() {
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');

        $staff_id = $user_det['user_id'];
        $staff_type = $user_det['staff_type'];
        //get all students of the particular group






        $this->load->helper('text');

        $config['upload_path'] = './assignment_files/questions';

        $config['allowed_types'] = '*';

        $config['max_size'] = '';

        $this->load->library('upload', $config);

        $upload_data['file_name'] = '';
        if (isset($_FILES) && !empty($_FILES)) {
            $upload_files = $_FILES;
            if ($upload_files['qn_file']['name'] != '') {
                $_FILES['ass_file'] = array(
                    'name' => $upload_files['qn_file']['name'],
                    'type' => $upload_files['qn_file']['type'],
                    'tmp_name' => $upload_files['qn_file']['tmp_name'],
                    'error' => $upload_files['qn_file']['error'],
                    'size' => '2000'
                );


                $this->upload->do_upload('qn_file');

                $upload_data = $this->upload->data();




                $src = $this->config->item("base_url") . 'assignment_files/questions/' . $upload_data['file_name'];
            }
        }
        if ($this->input->post('status') == 1) {
            if ($upload_data['file_name'] != '') {
                $d_date = date("Y-m-d", strtotime($this->input->post('d_date')));

                $input = array('ass_type' => $this->input->post('status'), 'ass_file' => $upload_data['file_name'], 'ass_number' => $this->input->post('ass_number'), 'batch_id' => $this->input->post('batch'), 'semester_id' => $this->input->post('sem'), 'depart_id' => $this->input->post('department'), 'group_id' => $this->input->post('group_id'), 'subject_id' => $this->input->post('sub_name'), 'staff_type' => $staff_type, 'staff_id' => $staff_id, 'question' => $this->input->post('ass_qn'), 'due_date' => $d_date, 'comments' => $this->input->post('comments'), 'total' => $this->input->post('total'));
                $ins_id = $this->assignment_model->insert_assignment($input);
            } else {
                $d_date = date("Y-m-d", strtotime($this->input->post('d_date')));
                $input = array('ass_type' => $this->input->post('status'), 'ass_number' => $this->input->post('ass_number'), 'batch_id' => $this->input->post('batch'), 'semester_id' => $this->input->post('sem'), 'depart_id' => $this->input->post('department'), 'group_id' => $this->input->post('group_id'), 'subject_id' => $this->input->post('sub_name'), 'staff_type' => $staff_type, 'staff_id' => $staff_id, 'question' => $this->input->post('ass_qn'), 'due_date' => $d_date, 'comments' => $this->input->post('comments'), 'total' => $this->input->post('total'));
                $ins_id = $this->assignment_model->insert_assignment($input);
            }
        } else {
            if ($upload_data['file_name'] != '') {
                $d_date = date("Y-m-d", strtotime($this->input->post('d_date')));

                $input = array('ass_type' => $this->input->post('status'), 'ass_file' => $upload_data['file_name'], 'ass_number' => $this->input->post('ass_number'), 'batch_id' => $this->input->post('batch'), 'semester_id' => $this->input->post('sem'), 'depart_id' => $this->input->post('department'), 'group_id' => $this->input->post('group_id'), 'subject_id' => $this->input->post('sub_name'), 'staff_type' => $staff_type, 'staff_id' => $staff_id, 'question' => $this->input->post('ass_qn'), 'due_date' => $d_date, 'comments' => $this->input->post('comments'), 'total' => $this->input->post('total'));
            } else {
                $d_date = date("Y-m-d", strtotime($this->input->post('d_date')));
                $input = array('ass_type' => $this->input->post('status'), 'ass_number' => $this->input->post('ass_number'), 'batch_id' => $this->input->post('batch'), 'semester_id' => $this->input->post('sem'), 'depart_id' => $this->input->post('department'), 'group_id' => $this->input->post('group_id'), 'subject_id' => $this->input->post('sub_name'), 'staff_type' => $staff_type, 'staff_id' => $staff_id, 'question' => $this->input->post('ass_qn'), 'due_date' => $d_date, 'comments' => $this->input->post('comments'), 'total' => $this->input->post('total'));
            }
            $ins_id = $this->assignment_model->insert_assignment($input);
            $where = array(
                'student_group.batch_id' => $this->input->post('batch'),
                'student_group.depart_id' => $this->input->post('department'),
                'student_group.group_id' => $this->input->post('group_id')
            );
            $data["student_id"] = $this->assignment_model->get_students_from_group($where);


            if (isset($ins_id) && !empty($ins_id)) {
                for ($i = 0; $i < count($data["student_id"]); $i++) {
                    $student_data = array('assign_id' => $ins_id['id'], 'std_id' => $data["student_id"][$i]["student_id"]);
                    $this->assignment_model->insert_assignment_details($student_data);
                }
            }
        }

        /* Notification Added */
        $this->load->model('api/notification_model');
        $this->load->model('subject/subject_model');
        $sub_name = $this->subject_model->get_subject_by_id($this->input->post('subject'));

        $title = $sub_name[0]['subject_name'] . ' Assignment-' . $this->input->post('ass_number') . ' Added';
        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);


        if ($this->input->post('group') != 0) {
            $where1 = array('student_group.batch_id' => $this->input->post('batch'), 'student_group.depart_id' => $this->input->post('department'), 'student_group.group_id' => $this->input->post('group'));
            $all_student = $this->notification_model->get_all_student($where1);
        } else {
            $where1 = array('student_group.batch_id' => $this->input->post('batch'), 'student_group.depart_id' => $this->input->post('department'));
            $all_student = $this->notification_model->get_all_student($where1);
        }
        $j = 0;

        if (isset($all_student) && !empty($all_student)) {
            foreach ($all_student as $val1) {
                $all_student[$j]['notification_id'] = $last_id['id'];
                $all_student[$j]['user_type'] = 'student';
                $all_student[$j]['links'] = 'users/student_view';
                $all_student[$j]['read'] = 0;
                unset($all_student[$j]['email_id']);
                $j++;
            }
            $this->notification_model->insert_all_staff($all_student);
        }



        redirect($this->config->item('base_url') . 'assignment/');
    }

    public function view_assignment($id) {
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $staff_id = $user_det['user_id'];

        $data['batch'] = $this->batch_model->get_default_batch();
        $data['term'] = $this->subject_model->get_default_term();
        //$data["batch"] = $this->assignment_model->get_batch();
        //  $data["semester"] = $this->assignment_model->get_semester();
        $data["department"] = $this->assignment_model->get_department();
        $data["view_list"] = $this->assignment_model->view_assignment_by_id($staff_id, $id);
        /* echo "<pre>";
          print_r($data);
          exit; */
        if (isset($data["view_list"]) && !empty($data["view_list"])) {
            $user_det = $this->session->userdata('logged_in');
            $staff_id = $user_det['user_id'];
            $department = $data["view_list"][0]['depart_id'];
            $data["group_list"] = $this->assignment_model->get_group($department);

            if ($user_det['staff_type'] == 'admin') {
                $where = array(
                    'batch_id' => $data["view_list"][0]['batch_id'],
                    'depart_id' => $data["view_list"][0]['depart_id'],
                    'group_id' => $data["view_list"][0]['group_id'],
                    'semester_id' => $data["view_list"][0]['semester_id']
                );
            } else {
                $where = array(
                    'batch_id' => $data["view_list"][0]['batch_id'],
                    'depart_id' => $data["view_list"][0]['depart_id'],
                    'group_id' => $data["view_list"][0]['group_id'],
                    'semester_id' => $data["view_list"][0]['semester_id'],
                    'staff_id' => $staff_id
                );
            }
            $data["subject_list"] = $this->assignment_model->get_subject_group($where);
        }
        $this->template->write_view('content', 'assignment/view_assignment', $data);
        $this->template->render();
    }

    public function update_assignment() {
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $staff_id = $user_det['user_id'];
        if ($this->input->post()) {
            $id = $this->input->post('id');


            $this->load->helper('text');

            $config['upload_path'] = './assignment_files/questions';

            $config['allowed_types'] = '*';

            $config['max_size'] = '';

            $this->load->library('upload', $config);

            $upload_data['file_name'] = '';
            if (isset($_FILES) && !empty($_FILES)) {
                $upload_files = $_FILES;
                if ($upload_files['qn_file']['name'] != '') {
                    $_FILES['ass_file'] = array(
                        'name' => $upload_files['qn_file']['name'],
                        'type' => $upload_files['qn_file']['type'],
                        'tmp_name' => $upload_files['qn_file']['tmp_name'],
                        'error' => $upload_files['qn_file']['error'],
                        'size' => '2000'
                    );


                    $this->upload->do_upload('qn_file');

                    $upload_data = $this->upload->data();




                    $src = $this->config->item("base_url") . 'assignment_files/questions/' . $upload_data['file_name'];
                }
            }
            if ($upload_data['file_name'] != '') {
                $d_date = date("Y-m-d", strtotime($this->input->post('d_date')));

                $input = array('ass_file' => $upload_files['qn_file']['name'], 'batch_id' => $this->input->post('batch'), 'semester_id' => $this->input->post('sem'), 'depart_id' => $this->input->post('department'), 'group_id' => $this->input->post('group_id'), 'subject_id' => $this->input->post('sub_name'), 'staff_id' => $staff_id, 'question' => $this->input->post('ass_qn'), 'due_date' => $d_date, 'comments' => $this->input->post('comments'), 'total' => $this->input->post('total'));
                $this->assignment_model->update_assignment($input, $id);
            } else {
                $d_date = date("Y-m-d", strtotime($this->input->post('d_date')));

                $input = array('batch_id' => $this->input->post('batch'), 'semester_id' => $this->input->post('sem'), 'depart_id' => $this->input->post('department'), 'group_id' => $this->input->post('group_id'), 'subject_id' => $this->input->post('sub_name'), 'staff_id' => $staff_id, 'question' => $this->input->post('ass_qn'), 'due_date' => $d_date, 'comments' => $this->input->post('comments'), 'total' => $this->input->post('total'));
                $this->assignment_model->update_assignment($input, $id);
            }
        }


        /* Notification Added */
        $this->load->model('api/notification_model');
        $this->load->model('subject/subject_model');
        $this->load->model('subject/subject_model');
        $sub_name = $this->subject_model->get_subject_by_id($this->input->post('subject'));
        $title = $sub_name[0]['subject_name'] . ' Assignment Updated';
        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);


        if ($this->input->post('group') != 0) {
            $where1 = array('batch_id' => $this->input->post('batch'), 'depart_id' => $this->input->post('department'), 'group_id' => $this->input->post('group'));
            $all_student = $this->notification_model->get_all_student($where1);
        } else {
            $where1 = array('batch_id' => $this->input->post('batch'), 'depart_id' => $this->input->post('department'));
            $all_student = $this->notification_model->get_all_student($where1);
        }
        $j = 0;


        if (isset($all_student) && !empty($all_student)) {
            foreach ($all_student as $val1) {
                $all_student[$j]['notification_id'] = $last_id['id'];
                $all_student[$j]['user_type'] = 'student';
                $all_student[$j]['links'] = 'users/share_notes_view';
                $all_student[$j]['links'] = 'users/share_notes_view';
                $all_student[$j]['read'] = 0;
                $j++;
            }

            $this->notification_model->insert_all_staff($all_student);
        }
        redirect($this->config->item('base_url') . 'assignment/');
    }

    public function delete_assignment() {
        $this->load->model('assignment/assignment_model');
        $id = $this->input->post('id');
        $this->assignment_model->delete_assignment($id);
        $this->assignment_model->delete_assignment_details($id);
        //
        $user_det = $this->session->userdata('logged_in');

        $staff_id = $user_det['user_id'];
        $this->load->model('assignment/assignment_model');
        $data["batch"] = $this->assignment_model->get_batch();
        $data["semester"] = $this->assignment_model->get_semester();
        $data["department"] = $this->assignment_model->get_department();
        if ($user_det['staff_type'] == 'staff') {
            $data["subject"] = $this->assignment_model->get_subject_by_staff($staff_id);
            if (isset($data["subject"]) && !empty($data["subject"])) {
                $c = count($data["subject"]);

                for ($j = 0; $j < $c; $j++) {

                    $data["list"][] = $this->assignment_model->get_assignment($data["subject"][$j]['id']);
                }
            }
        } else {
            $data["list"] = $this->assignment_model->get_assignment_for_admin();
        }
        /* if(isset($data["view_list"]) && !empty($data["view_list"]))
          {
          $user_det = $this->session->userdata('logged_in');
          $staff_id=$user_det['user_id'];
          $department=$data["view_list"][0]['depart_id'];
          $data["group_list"]=$this->assignment_model->get_group($department);

          if($user_det['staff_type']=='staff')
          {
          $where=array(
          'batch_id'=>$this->input->post('batch'),
          'depart_id'=> $this->input->post('dep_id'),
          'group_id'=> $this->input->post('group_id'),
          'semester_id'=>$this->input->post('sem'),
          'staff_id'=> $staff_id
          );
          }
          else
          {
          $where=array(
          'batch_id'=>$this->input->post('batch'),
          'depart_id'=> $this->input->post('dep_id'),
          'group_id'=> $this->input->post('group_id'),
          'semester_id'=>$this->input->post('sem')
          );
          }
          $data["subject_list"]=$this->assignment_model->get_subject_group($where);
          } */
        echo $this->load->view('list_view', $data);
    }

    // stduent



    public function get_student_assignment_number() {
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $staff_id = $user_det['user_id'];

        $where1 = array(
            'batch_id' => $this->input->post('batch'),
            'depart_id' => $this->input->post('department'),
            'group_id' => $this->input->post('group'),
            'semester_id' => $this->input->post('sem'),
            'subject_id' => $this->input->post('subject'),
        );

        /* echo "<pre>";
          print_r($where1);
          exit; */
        $ass_number = $this->assignment_model->get_student_assignment_number($where1);
        /* echo "<pre>";
          print_r($ass_number);
          exit; */
        $sub_select = '<select id="staff_ass_number" name="sub_name" class="mandatory1"><option value="">Select Assignment</option>';
        if (isset($ass_number) && !empty($ass_number)) {
            foreach ($ass_number as $val) {
                $sub_select = $sub_select . "<option value='" . $val['ass_number'] . "'>" . $val['ass_number'] . "</option>";
            }
        }
        $sub_select = $sub_select . '</select>';
        echo $sub_select;
    }

    public function assignment_upload($ass_id, $student_id) {

        $this->load->model('assignment/assignment_model');
        if (is_numeric($ass_id) && is_numeric($student_id)) {
            $data["enter_mark"] = $this->assignment_model->get_student_assignmnt_for_mark($ass_id, $student_id);
            //echo "<pre>";print_r($data["enter_mark"]); exit;
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
        /* Notification Added */
        $this->load->model('api/notification_model');
        $this->load->model('subject/subject_model');
        $this->load->model('subject/subject_model');

        $title = 'Assignment Mark Updated';
        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);


        $j = 0;

        $all_student[$j]['notification_id'] = $last_id['id'];
        $all_student[$j]['user_id'] = $student_id;
        $all_student[$j]['user_type'] = 'student';
        $all_student[$j]['links'] = 'users/assignment_upload/' . $ass_id;
        $all_student[$j]['read'] = 0;
        $j++;

        $this->notification_model->insert_all_staff($all_student);


        if (isset($data["enter_mark"]) && !empty($data["enter_mark"])) {
            $this->template->write_view('content', 'assignment/assignment_upload', $data);
            $this->template->render();
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
    }

    // staff
    public function staff_view() {
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $staff_id = $user_det['user_id'];
        if ($user_det['staff_type'] == 'staff') {
            $data["subject"] = $this->assignment_model->get_subject_by_staff($staff_id);
        }
        //$data["batch"] = $this->assignment_model->get_batch_for_assignment();
        // $data["semester"] = $this->assignment_model->get_semester_for_assignment();
        $data['batch'] = $this->batch_model->get_default_batch();
        $data['term'] = $this->subject_model->get_default_term();
        $data["department"] = $this->assignment_model->get_department_for_assignment();
        $this->template->write_view('content', 'assignment/staff_view', $data);
        $this->template->render();
    }

    public function get_submitted_assignment_by_subid() {
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $staff_id = $user_det['user_id'];
        $staff_type = $user_det['staff_type'];
        $batch_id = $this->input->post('batch');
        $department_id = $this->input->post('department');
        $group_id = $this->input->post('group');
        $sem_id = $this->input->post('sem');
        $subject_id = $this->input->post('subject');
        $ass_number = $this->input->post('ass_number');


        $data["sub_ass"] = $this->assignment_model->get_submitted_assignment_by_subid($staff_type, $staff_id, $batch_id, $department_id, $group_id, $sem_id, $subject_id, $ass_number);
        //echo "<pre>"; print_r($data["sub_ass"]); exit;
        if ($data['sub_ass'][0]['ass_details'][0]['ass_type'] == 0 && $data['sub_ass'][0]['ass_details'][0]['close_status'] == 0) {
            echo $this->load->view('assignment_view', $data);
        } else if ($data['sub_ass'][0]['ass_details'][0]['ass_type'] == 0 && $data['sub_ass'][0]['ass_details'][0]['close_status'] == 1) {
            echo $this->load->view('assignment_view_closed', $data);
        } else if ($data['sub_ass'][0]['ass_details'][0]['ass_type'] == 1 && $data['sub_ass'][0]['ass_details'][0]['close_status'] == 0) {
            echo $this->load->view('assignment_view_for_upload', $data);
        } else if ($data['sub_ass'][0]['ass_details'][0]['ass_type'] == 1 && $data['sub_ass'][0]['ass_details'][0]['close_status'] == 1) {
            echo $this->load->view('assignment_view_closed_upload', $data);
        }
    }

    public function get_submitted_assignment($id) {
        $this->load->model('assignment/assignment_model');
        $data["sub_assign"] = $this->assignment_model->get_submitted_assignment($id);

        $this->template->write_view('content', 'assignment/assignment_upload', $data);
        $this->template->render();
    }

    public function insert_assignment_mark() {

        $this->load->model('assignment/assignment_model');
        $student_id = $this->input->post('student_id');
        $ass_id = $this->input->post('ass_id');
        $sub_date = $this->input->post('submitted_date');

        if ($sub_date == "" || $sub_date == 0) {
            $marks = array('score' => $this->input->post('ass_marks'));
        } else {
            $sub_date = date('Y-m-d', strtotime($sub_date));
            $marks = array('score' => $this->input->post('ass_marks'), 'sub_date' => $sub_date);
        }
        //$marks=array('score'=>$this->input->post('ass_marks'));
        $data = $this->assignment_model->insert_assignment_mark($student_id, $ass_id, $marks);
        //echo "<pre>"; print_r($data); exit;
        echo "<script type='text/javascript'>window.close();</script>";
        //redirect($this->config->item('base_url').'assignment/staff_view');
    }

    public function insert_mark_for_non_upload() {
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $created_by = $user_det['user_id'];
        $staff_type = $user_det['staff_type'];
        // old data
        $batch_id = $this->input->post('batch');
        $department_id = $this->input->post('department');
        $group_id = $this->input->post('group');
        $sem_id = $this->input->post('sem');
        $subject_id = $this->input->post('subject');
        $ass_number = $this->input->post('ass_number');
        //new data
        $assign_id = $this->input->post('assign_id');
        $student_id = $this->input->post('student_id');
        $mark_arr = $this->input->post('mark_arr');
        $sub_date = $this->input->post('sub_date');

        foreach ($assign_id as $key => $val) {
            $mark_details = array('score' => $mark_arr[$key], 'sub_date' => date('Y-m-d', strtotime($sub_date[$key])), 'created_by' => $created_by, 'modified_id' => $created_by);
            $this->assignment_model->insert_mark_for_non_upload($student_id[$key], $assign_id[$key], $mark_details);
        }

        $data["sub_ass"] = $this->assignment_model->get_submitted_assignment_by_subid($staff_type, $created_by, $batch_id, $department_id, $group_id, $sem_id, $subject_id, $ass_number);
        if ($data['sub_ass'][0]['ass_details'][0]['ass_type'] == 0 && $data['sub_ass'][0]['ass_details'][0]['close_status'] == 0) {
            echo $this->load->view('assignment_view', $data);
        } else if ($data['sub_ass'][0]['ass_details'][0]['ass_type'] == 0) {
            echo $this->load->view('assignment_view_closed', $data);
        } else {
            echo $this->load->view('assignment_view_for_upload', $data);
        }
    }

    function update_close_status() {
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $created_by = $user_det['user_id'];
        $staff_type = $user_det['staff_type'];
        // old data
        $batch_id = $this->input->post('batch');
        $department_id = $this->input->post('department');
        $group_id = $this->input->post('group');
        $sem_id = $this->input->post('sem');
        $subject_id = $this->input->post('subject');
        $ass_number = $this->input->post('ass_number');
        // new data
        $assign_id = $this->input->post('assign_id');
        $status = array('close_status' => 1);
        $this->assignment_model->update_close_status($assign_id, $status);

        $data["sub_ass"] = $this->assignment_model->get_submitted_assignment_by_subid($staff_type, $created_by, $batch_id, $department_id, $group_id, $sem_id, $subject_id, $ass_number);
        if ($data['sub_ass'][0]['ass_details'][0]['ass_type'] == 0 && $data['sub_ass'][0]['ass_details'][0]['close_status'] == 0) {
            echo $this->load->view('assignment_view', $data);
        } else if ($data['sub_ass'][0]['ass_details'][0]['ass_type'] == 0 && $data['sub_ass'][0]['ass_details'][0]['close_status'] == 1) {
            echo $this->load->view('assignment_view_closed', $data);
        } else if ($data['sub_ass'][0]['ass_details'][0]['ass_type'] == 1 && $data['sub_ass'][0]['ass_details'][0]['close_status'] == 0) {
            echo $this->load->view('assignment_view_for_upload', $data);
        } else if ($data['sub_ass'][0]['ass_details'][0]['ass_type'] == 1 && $data['sub_ass'][0]['ass_details'][0]['close_status'] == 1) {
            echo $this->load->view('assignment_view_closed_upload', $data);
        }
    }

    function print_assignment_marks_upload($b_id, $d_id, $g_id, $sem_id, $sub_id, $a_no) {
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $created_by = $user_det['user_id'];
        $staff_type = $user_det['staff_type'];
        if (is_numeric($b_id) && is_numeric($d_id) && is_numeric($g_id) && is_numeric($sem_id) && is_numeric($sub_id) && is_numeric($a_no)) {
            $data["sub_ass"] = $this->assignment_model->get_submitted_assignment_by_subid($staff_type, $created_by, $b_id, $d_id, $g_id, $sem_id, $sub_id, $a_no);
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
        if (isset($data["sub_ass"]) && !empty($data["sub_ass"])) {
            $this->template->write_view('content', 'assignment/print_assignment_marks_upload', $data);
            $this->template->render();
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
    }

    function print_assignment_marks_nonupload($b_id, $d_id, $g_id, $sem_id, $sub_id, $a_no) {
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $created_by = $user_det['user_id'];
        $staff_type = $user_det['staff_type'];
        if (is_numeric($b_id) && is_numeric($d_id) && is_numeric($g_id) && is_numeric($sem_id) && is_numeric($sub_id) && is_numeric($a_no)) {
            $data["sub_ass"] = $this->assignment_model->get_submitted_assignment_by_subid($staff_type, $created_by, $b_id, $d_id, $g_id, $sem_id, $sub_id, $a_no);
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
        if (isset($data["sub_ass"]) && !empty($data["sub_ass"])) {
            $this->template->write_view('content', 'assignment/print_assignment_marks_nonupload', $data);
            $this->template->render();
        } else {
            echo "<script type='text/javascript'>window.close();</script>";
        }
    }

}
