<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subject extends MX_Controller {

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
        $this->load->model('batch/batch_model');
    }

    public function index() {
        $this->load->model('subject/subject_model');
        /* 			 $data["list"]=$this->subject_model->get_subject();
         */ $data['all_batch'] = $this->subject_model->get_all_batch();
        $data['all_staff'] = $this->subject_model->staff();
        $data['all_department'] = $this->subject_model->department();
        $data['all_group'] = $this->subject_model->group();
        $data['all_semester'] = $this->subject_model->semester();

        $user = $this->session->userdata('logged_in');
        $data['master'] = $this->subject_model->get_all_master($user);


        $data['user'] = $this->session->userdata('logged_in');
        $user = $this->session->userdata('logged_in');

        $data['sub_department'] = $this->subject_model->department_staff($user);
        $data['all_view'] = $this->subject_model->get_all_subject($user);

        $data['batch'] = $this->batch_model->get_default_batch();
        $data['term'] = $this->subject_model->get_default_term();
        if ($user['staff_type'] == 'staff') {
            $data['sub_view'] = $this->subject_model->get_all_subject_for_staff($user);
        }

        $this->template->write_view('content', 'subject/index', $data);
        $this->template->render();
    }

    public function insert_subject() {
        $this->load->model('subject/subject_model');
        $this->load->model('api/notification_model');
        $data['all_batch'] = $this->subject_model->get_all_batch();
        $data['all_staff'] = $this->subject_model->staff();
        $data['all_department'] = $this->subject_model->department();
        $data['all_group'] = $this->subject_model->group();
        $data['all_semester'] = $this->subject_model->semester();
        $user = $this->session->userdata('logged_in');
        $data['master'] = $this->subject_model->get_all_master($user);

        $title = $this->input->post('value6') . ' Added For You';
        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);

        $all_student[0]['notification_id'] = $last_id['id'];
        $all_student[0]['user_type'] = 'staff';
        $all_student[0]['links'] = 'subject';
        $all_student[0]['read'] = 0;
        $all_student[0]['user_id'] = $this->input->post('value5');

        $this->notification_model->insert_all_staff($all_student);
        // notification to student

        $where1 = array('student_group.batch_id' => $this->input->post('value1'), 'student_group.depart_id' => $this->input->post('value2'), 'student_group.group_id' => $this->input->post('value3'));
        $all_student = $this->notification_model->get_all_student($where1);

        $j = 0;
        if (isset($all_student) && !empty($all_student)) {
            foreach ($all_student as $val1) {
                $all_student[$j]['notification_id'] = $last_id['id'];
                $all_student[$j]['user_type'] = 'student';
                $all_student[$j]['links'] = 'users/subject_view/' . $last_id['id'];
                $all_student[$j]['read'] = 0;
                unset($all_student[$j]['email_id']);
                $j++;
            }
            $this->notification_model->insert_all_staff($all_student);
        }
        $check_practical = $this->input->post('check_practical');
        if ($check_practical == 1) {
            $input = array('batch_id' => $this->input->post('value1'), 'subject_name' => $this->input->post('value6'), 'depart_id' => $this->input->post('value2'), 'group_id' => $this->input->post('value3'), 'staff_id' => $this->input->post('value5'), 'cur_year' => $this->input->post('value7'),
                'semester_id' => $this->input->post('value4'), 'scode' => $this->input->post('value8'), 'grade_point' => $this->input->post('grade'), 'nick_name' => $this->input->post('value9'), 'staff_type' => $session_data['staff_type'], 'pass_mark' => $this->input->post('pass_mark'), 'practical_pass_mark' => $this->input->post('practical_pass_mark'), 'practical_mark' => $this->input->post('practical_mark'), 'check_practical' => $this->input->post('check_practical'), 'created_user' => $session_data['user_id']);
        } else {
            $input = array('batch_id' => $this->input->post('value1'), 'subject_name' => $this->input->post('value6'), 'depart_id' => $this->input->post('value2'),
                'group_id' => $this->input->post('value3'), 'staff_id' => $this->input->post('value5'), 'cur_year' => $this->input->post('value7'),
                'semester_id' => $this->input->post('value4'), 'scode' => $this->input->post('value8'), 'grade_point' => $this->input->post('grade'), 'nick_name' => $this->input->post('value9'), 'staff_type' => $session_data['staff_type'], 'pass_mark' => $this->input->post('pass_mark'),
                'created_user' => $session_data['user_id']);
        }

        $validation = $this->subject_model->validate_subject($input);

        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo 'Subject already Exist';
            $data['all_view'] = $this->subject_model->get_all_subject($user);
            echo $this->load->view('view_list', $data);
        } else {
            $this->subject_model->insert_subject($input);
            $data['all_view'] = $this->subject_model->get_all_subject($user);
            echo $this->load->view('view_list', $data);
        }
    }

    public function delete_subject() {

        $this->load->model('subject/subject_model');
        $user = $this->session->userdata('logged_in');
        $id = $this->input->post('value1');
        $this->subject_model->delete_subject($id);
        $data['all_view'] = $this->subject_model->get_all_subject($user);
        $data['all_batch'] = $this->subject_model->get_all_batch();
        $data['all_staff'] = $this->subject_model->staff();
        $data['all_department'] = $this->subject_model->department();
        $data['all_group'] = $this->subject_model->group();
        $data['all_semester'] = $this->subject_model->semester();
        $data['master'] = $this->subject_model->get_all_master($user);
        //echo "<pre>"; print_r($data['all_view']); exit;
        echo $this->load->view('view_list', $data);
    }

    public function update_subject() {
        $this->load->model('api/notification_model');

        $this->load->model('subject/subject_model');
        $this->load->model('internal/internal_model');

        $data['all_batch'] = $this->subject_model->get_all_batch();
        $data['all_staff'] = $this->subject_model->staff();
        $data['all_department'] = $this->subject_model->department();
        $data['all_group'] = $this->subject_model->group();
        $data['all_semester'] = $this->subject_model->semester();
        $user = $this->session->userdata('logged_in');
        $data['master'] = $this->subject_model->get_all_master($user);

        $title = $this->input->post('value2') . ' Modified For You';
        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);

        $all_student[0]['notification_id'] = $last_id['id'];
        $all_student[0]['user_type'] = 'staff';
        $all_student[0]['links'] = 'subject';
        $all_student[0]['read'] = 0;
        $all_student[0]['user_id'] = $this->input->post('value5');

        $this->notification_model->insert_all_staff($all_student);

        $id = $this->input->post('value1');

        $input = array('batch_id' => $this->input->post('value4'), 'subject_name' => $this->input->post('value2'),
            'depart_id' => $this->input->post('value7'), 'nick_name' => $this->input->post('value9'),
            'group_id' => $this->input->post('value5'),
            'semester_id' => $this->input->post('value6'), 'scode' => $this->input->post('value8'));

        $validation = $this->subject_model->update_validate_subject($input, $id);

        $i = 0;
        if ($validation) {
            $i = 1;
        }
        if ($i == 1) {
            echo '<p align="center" style="color:red;font-size:14px ">Subject already Exist</p>';
            $data['all_view'] = $this->subject_model->get_all_subject($user);
            echo $this->load->view('view_list', $data);
        } else {

            $check_practical = $this->input->post('check_practical');
            if ($check_practical == 1) {
                $input = array('batch_id' => $this->input->post('value4'), 'subject_name' => $this->input->post('value2'),
                    'depart_id' => $this->input->post('value7'), 'nick_name' => $this->input->post('value9'),
                    'group_id' => $this->input->post('value5'), 'staff_id' => $this->input->post('value3'),
                    'semester_id' => $this->input->post('value6'), 'scode' => $this->input->post('value8'),
                    'grade_point' => $this->input->post('grade'), 'pass_mark' => $this->input->post('pass_mark'), 'practical_pass_mark' => $this->input->post('practical_pass_mark'), 'practical_mark' => $this->input->post('practical_mark'), 'check_practical' => $this->input->post('check_practical'));
            } else {
                $input = array('batch_id' => $this->input->post('value4'), 'subject_name' => $this->input->post('value2'),
                    'depart_id' => $this->input->post('value7'), 'nick_name' => $this->input->post('value9'),
                    'group_id' => $this->input->post('value5'), 'staff_id' => $this->input->post('value3'),
                    'semester_id' => $this->input->post('value6'), 'scode' => $this->input->post('value8'),
                    'grade_point' => $this->input->post('grade'), 'pass_mark' => $this->input->post('pass_mark'), 'check_practical' => $this->input->post('check_practical'), 'practical_pass_mark' => NULL, 'practical_mark' => NULL);
            }

            $this->subject_model->update_subject($input, $id);
            //  $data['all_view'] = $this->subject_model->get_all_subject($user);
            //  echo $this->load->view('view_list', $data);
        }
    }

    public function get_all_group() {
        $this->load->model('subject_model');
        $data['all_batch'] = $this->subject_model->get_all_batch();
        $data['all_staff'] = $this->subject_model->staff();
        $data['all_department'] = $this->subject_model->department();
        $data['all_group'] = $this->subject_model->group();
        $data['all_semester'] = $this->subject_model->semester();
        $d_id = $this->input->post();
        $g_array = $this->subject_model->get_all_group($d_id['depart_id']);
        $g_select = '<select id="group1" name="student_group[group_id]" class="grp  mandatory " ><option value="">Select</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function get_all_staff() {

        $this->load->model('subject_model');
        $data['all_batch'] = $this->subject_model->get_all_batch();
        $data['all_staff'] = $this->subject_model->staff();
        $data['all_department'] = $this->subject_model->department();
        $data['all_group'] = $this->subject_model->group();
        $data['all_semester'] = $this->subject_model->semester();
        $d_id = $this->input->post();
        $g_array = $this->subject_model->get_all_staff($d_id['depart_id']);
        $g_select = '<select id="staff" name="student_staff" class="u_group mandatory validate dupe" ><option value="">Select Staff</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['staff_name'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function get_all_gp() {
        $this->load->model('subject_model');
        $data['all_batch'] = $this->subject_model->get_all_batch();
        $data['all_staff'] = $this->subject_model->staff();
        $data['all_department'] = $this->subject_model->department();
        $data['all_group'] = $this->subject_model->group();
        $data['all_semester'] = $this->subject_model->semester();
        $d_id = $this->input->post();
        $g_array = $this->subject_model->get_all_gp($d_id['depart_id']);

        $g_select = '<select id="group" name="student_group[group_id]" class="mandatory u_val u_group" ><option value="">Select</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function get_update_staff() {
        $this->load->model('subject_model');
        $data['all_batch'] = $this->subject_model->get_all_batch();
        $data['all_staff'] = $this->subject_model->staff();
        $data['all_department'] = $this->subject_model->department();
        $data['all_group'] = $this->subject_model->group();
        $data['all_semester'] = $this->subject_model->semester();
        $d_id = $this->input->post();

        $g_array = $this->subject_model->get_all_staff($d_id['depart_id']);
        $g_select = '<select id="staff" name="student_staff" class="u_staff mandatory validate dupe" ><option value="">Select Staff</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['staff_name'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function staff_subject() {
        $this->load->model('subject_model');
        $data['all_batch'] = $this->subject_model->get_all_batch();
        $data['all_staff'] = $this->subject_model->staff();
        $data['all_department'] = $this->subject_model->department();
        $data['all_group'] = $this->subject_model->group();
        $data['all_semester'] = $this->subject_model->semester();
        $user = $this->session->userdata('logged_in');
        //$master=$this->subject_model->get_all_master($user);
        //foreach($master as $key=> $val)
        $ip = array('subject_details.batch_id' => $this->input->post('value1'), 'subject_details.depart_id' => $this->input->post('value2'),
            'subject_details.group_id' => $this->input->post('value3'), 'subject_details.semester_id' => $this->input->post('value4'));
        /* else
          if($user['staff_type']=='admin' || $val['subject']==1)
          {
          $ip=array('subject_details.batch_id'=>$this->input->post('value1'),'subject_details.depart_id'=>$this->input->post('value2'),
          'subject_details.group_id'=>$this->input->post('value3'),'subject_details.semester_id'=>$this->input->post('value4'));

          } */

        $data['sub_view'] = $this->subject_model->staff_subject($ip);
        // print_r($ip);
        //exit;
        echo $this->load->view('sub_view', $data);
        //$data['all_view'] =$this->subject_model->get_all_subject();
    }

    public function get_all_department() {
        $this->load->model('subject_model');
        $b_id = $this->input->post();

        $g_array = $this->subject_model->get_all_depart_by_batch($b_id['batch_id']);
        $g_select = "<select id='depart_id' name='student_group[depart_id]' class=' mandatory validate dupe'><option value=''>Select</option>";
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['department'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function get_all_department_internal() {
        $this->load->model('subject_model');
        $b_id = $this->input->post();

        $g_array = $this->subject_model->get_all_depart_by_batch_internal($b_id['batch_id']);
        $g_select = "<select id='depart_id' name='student_group[depart_id]' class=' mandatory validate dupe'><option value=''>Select</option>";
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['department'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function get_all_sem() {
        $this->load->model('subject_model');
        $b_id = $this->input->post();
        $g_array = $this->subject_model->get_all_sem_by_batch($b_id['batch_id']);
        $g_select = '<select id="select_sem" name="external[semester]"  class="ajax_class  mandatory validate"><option value="">Select</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['semester'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    /* public function validate_subject()
      {
      $this->load->model('subject_model');
      //print_r($this->input->post('value1')); exit;
      $input=array('batch_id'=>$this->input->post('value1'),'subject_name'=>$this->input->post('value6'), 'depart_id'=>$this->input->post('value2'),
      'group_id'=>$this->input->post('value3'),'staff_id'=>$this->input->post('value5'), 'cur_year'=>$this->input->post('value7'),
      'semester_id'=>$this->input->post('value4'),'scode'=>$this->input->post('value8'));
      $validation=$this->subject_model->validate_subject($input);
      $i=0; if($validation){$i=1;}if($i==1){echo "Subject already Exist";}
      } */

    public function checking_deplicate_sub() {
        $this->load->model('subject_model');
        //print_r($this->input->post('value1')); exit;
        $input = array('batch_id' => $this->input->post('value1'), 'depart_id' => $this->input->post('value2'),
            'group_id' => $this->input->post('value3'), 'semester_id' => $this->input->post('value4'), 'subject_name' => $this->input->post('value6'));
        //echo "<pre>"; print_r($input); exit;
        $validation = $this->subject_model->validate_dupli_subject($input);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Subject is already Exist";
        }
    }

    public function checking_deplicate_nick() {
        $this->load->model('subject_model');
        //print_r($this->input->post('value1')); exit;
        $input = array('batch_id' => $this->input->post('value1'), 'depart_id' => $this->input->post('value2'),
            'group_id' => $this->input->post('value3'), 'semester_id' => $this->input->post('value4'), 'nick_name' => $this->input->post('value6'));
        //echo "<pre>"; print_r($input); exit;
        $validation = $this->subject_model->validate_dupli_nickname($input);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Nickname is already Exist";
        }
    }

    public function checking_deplicate_scode() {
        $this->load->model('subject_model');
        //print_r($this->input->post('value1')); exit;
        $input = array('batch_id' => $this->input->post('value1'), 'depart_id' => $this->input->post('value2'),
            'group_id' => $this->input->post('value3'), 'semester_id' => $this->input->post('value4'), 'scode' => $this->input->post('value6'));
        //echo "<pre>"; print_r($input); exit;
        $validation = $this->subject_model->validate_dupli_subcode($input);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Subject Code is already Exist";
        }
    }

    public function update_checking_deplicate_sub() {
        $this->load->model('subject_model');
        //print_r($this->input->post('value1')); exit;
        $id = $this->input->post('id');

        $input = array('batch_id' => $this->input->post('batch'), 'depart_id' => $this->input->post('department'),
            'group_id' => $this->input->post('group'), 'semester_id' => $this->input->post('semester'), 'subject_name' => $this->input->post('subject'));
        //echo "<pre>"; print_r($input); exit;
        $validation = $this->subject_model->update_validate_dupli_sub($input, $id);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Subject is already Exist";
        }
    }

    public function update_checking_deplicate_nick() {
        $this->load->model('subject_model');
        $id = $this->input->post('id');
        $input = array('batch_id' => $this->input->post('batch'), 'depart_id' => $this->input->post('department'),
            'group_id' => $this->input->post('group'), 'semester_id' => $this->input->post('semester'), 'nick_name' => $this->input->post('nick'));
        //echo "<pre>"; print_r($input); exit;
        $validation = $this->subject_model->update_validate_dupli_nickname($input, $id);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Nickname is already Exist";
        }
    }

    public function update_checking_deplicate_scode() {
        $this->load->model('subject_model');
        $id = $this->input->post('id');
        $input = array('batch_id' => $this->input->post('batch'), 'depart_id' => $this->input->post('department'),
            'group_id' => $this->input->post('group'), 'semester_id' => $this->input->post('semester'), 'scode' => $this->input->post('scode'));
        //echo "<pre>"; print_r($input); exit;
        $validation = $this->subject_model->update_validate_dupli_subcode($input, $id);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Subject Code is already Exist";
        }
    }

    public function get_all_staff_update() {
        $this->load->model('subject_model');
        $d_id = $this->input->post('depart_id');
        $g_array = $this->subject_model->get_all_staff_update($d_id);
        $g_select = '<br/><select id="staff" name="student_staff" class="u_staff mandatory validate" ><option value="">Select Staff</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['staff_name'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    function import_subject() {
        $this->load->model('subject_model');
        $this->load->model('student/student_model');
        $this->load->model('batch/batch_model');
        $this->load->model('api/notification_model');
        $batch = $this->batch_model->get_default_batch();
        $term = $this->subject_model->get_default_term();
        if ($this->input->post()) {
            $is_success = 0;
            if (!empty($_FILES['subject_data'])) {
                $config['upload_path'] = './attachement/subject/';
                $config['allowed_types'] = '*';
                $config['max_size'] = '10000';
                $this->load->library('upload', $config);
                $random_hash = substr(str_shuffle(time()), 0, 3) . strrev(mt_rand(100000, 999999));
                $extension = pathinfo($_FILES['subject_data']['name'], PATHINFO_EXTENSION);
                $new_file_name = 'subject_' . $random_hash . '.' . $extension;
                $_FILES['subject_data'] = array(
                    'name' => $new_file_name,
                    'type' => $_FILES['subject_data']['type'],
                    'tmp_name' => $_FILES['subject_data']['tmp_name'],
                    'error' => $_FILES['subject_data']['error'],
                    'size' => $_FILES['subject_data']['size']
                );
                $config['file_name'] = $new_file_name;
                $this->upload->initialize($config);

                $this->upload->do_upload('subject_data');
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
                $file = base_url() . 'attachement/subject/' . $file_name;
                $handle = fopen($file, 'r');
                if ($file != NULL) {
                    while ($row_data = fgetcsv($handle)) {
                        $class = $row_data[0];
                        $section = $row_data[1];
                        $subject = $row_data[2];
                        $nick_name = $row_data[3];
                        $sub_code = $row_data[4];
                        $staff_class = $row_data[5];
                        $staff = $row_data[6];
                        $total_mark = $row_data[7];
                        $pass_mark = $row_data[8];
                        $practical_mark = $row_data[9];
                        $practical_pass_mark = $row_data[10];


                        $depart_id = $this->student_model->get_all_depart_id_by_name($class);

                        if (empty($depart_id)) {
                            $dept_details = array(
                                'department' => $class,
                                'nickname' => $class,
                                'ldt' => date('Y-m-d H:i:s'),
                                'status' => 1
                            );
                            $dept_id = $this->student_model->insert_department($dept_details);
                            $depart_id = $dept_id['id'];
                        }
                        $staff_depart_id = $this->student_model->get_all_depart_id_by_name($staff_class);

                        if (empty($staff_depart_id)) {
                            $staffdept_details = array(
                                'department' => $staff_class,
                                'nickname' => $staff_class,
                                'ldt' => date('Y-m-d H:i:s'),
                                'status' => 1
                            );
                            $staff_dept_id = $this->student_model->insert_department($staffdept_details);
                            $staff_depart_id = $staff_dept_id['id'];
                        }

                        $staff_id = $this->subject_model->get_staff_id_by_name($staff, $staff_depart_id);

                        $group_id = $this->student_model->get_all_group_id_by_name($section, $depart_id);
                        if (empty($group_id)) {
                            $group_details = array(
                                'depart_id' => $depart_id,
                                'group' => $section,
                                'ldt' => date('Y-m-d H:i:s'),
                                'status' => 1
                            );
                            $grp_id = $this->student_model->insert_group($group_details);
                            $group_id = $grp_id['id'];
                        }

                        if ($subject != '') {

                            $title = $subject . ' Added For You';
                            $session_data = $this->session->userdata('logged_in');
                            $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
                            $last_id = $this->notification_model->insert_notification($insert_not);

                            $all_student[0]['notification_id'] = $last_id['id'];
                            $all_student[0]['user_type'] = 'staff';
                            $all_student[0]['links'] = 'subject';
                            $all_student[0]['read'] = 0;
                            $all_student[0]['user_id'] = $staff_id;

                            $this->notification_model->insert_all_staff($all_student);
                            // notification to student

                            $where1 = array('student_group.batch_id' => $batch[0]['id'], 'student_group.depart_id' => $depart_id, 'student_group.group_id' => $group_id);
                            $all_student = $this->notification_model->get_all_student($where1);

                            $j = 0;
                            if (isset($all_student) && !empty($all_student)) {
                                foreach ($all_student as $val1) {
                                    $all_student[$j]['notification_id'] = $last_id['id'];
                                    $all_student[$j]['user_type'] = 'student';
                                    $all_student[$j]['links'] = 'users/subject_view/' . $last_id['id'];
                                    $all_student[$j]['read'] = 0;
                                    unset($all_student[$j]['email_id']);
                                    $j++;
                                }
                                $this->notification_model->insert_all_staff($all_student);
                            }
//			    $check_practical = $this->input->post('check_practical');
//			    if ($check_practical == 1) {
//				$input = array('batch_id' => $this->input->post('value1'), 'subject_name' => $this->input->post('value6'), 'depart_id' => $this->input->post('value2'), 'group_id' => $this->input->post('value3'), 'staff_id' => $this->input->post('value5'), 'cur_year' => $this->input->post('value7'),
//				    'semester_id' => $this->input->post('value4'), 'scode' => $this->input->post('value8'), 'grade_point' => $this->input->post('grade'), 'nick_name' => $this->input->post('value9'), 'staff_type' => $session_data['staff_type'], 'pass_mark' => $this->input->post('pass_mark'), 'practical_pass_mark' => $this->input->post('practical_pass_mark'), 'practical_mark' => $this->input->post('practical_mark'), 'check_practical' => $this->input->post('check_practical'), 'created_user' => $session_data['user_id']);
//			    } else {

                            if ($practical_mark != '')
                                $check_practical = 1;
                            else
                                $check_practical = 0;
                            $input = array(
                                'batch_id' => $batch[0]['id'],
                                'subject_name' => $subject,
                                'depart_id' => $depart_id,
                                'group_id' => $group_id,
                                'staff_id' => $staff_id,
                                'semester_id' => $term[0]['id'],
                                'scode' => $sub_code,
                                'grade_point' => $total_mark,
                                'nick_name' => $nick_name,
                                'staff_type' => $session_data['staff_type'],
                                'pass_mark' => $pass_mark,
                                'check_practical' => $check_practical,
                                'practical_mark' => $practical_mark,
                                'practical_pass_mark' => $practical_pass_mark,
                                'created_user' => $session_data['user_id']
                            );
                            //}

                            $validation = $this->subject_model->validate_subject($input);

                            $i = 0;
                            if ($validation) {
                                $i = 1;
                            }if ($i != 1) {
                                $this->subject_model->insert_subject($input);
                            }
                        }
                    }
                }
                $is_success = 1;
            }
            if ($is_success) {
                redirect($this->config->item('base_url') . 'subject');
            }
        }
    }

    /* 	public function get_all_group()
      {
      $this->load->model('student_model');
      $d_id=$this->input->post();
      $g_array=$this->subject_model->get_all_group($d_id['depart_id']);
      $g_select='<select id="group_id" name="student_group[group_id]" ><option value="0">Select</option>';
      if(isset($g_array) && !empty($g_array))
      {
      foreach($g_array as $val)
      {
      $g_select=$g_select."<option value='".$val['id']."'>".$val['group']."</option>";
      }
      }
      $g_select=$g_select.'</select>';
      echo $g_select;

      /*echo "<pre>";
      print_r($this->input->post('value1'));
      exit;
      }
     */





    /*
      public function view_subject($id)
      {
      $this->load->model('subject/subject_model');
      $data['all_view'] =$this->subject_model->get_all_subject();
      echo $this->load->view('view_list',$data);

      } */
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */