<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student extends MX_Controller {

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
        $this->load->library('email');
        $this->load->model('master/master_model');
        $this->load->model('batch/batch_model');

        $user_det = $this->session->userdata('logged_in');

        $permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
        /* if($permission[0]['add_student']==0)
          redirect($this->config->item('base_url').'admin/index'); */
    }

    public function index() {
        $this->load->model('student/student_model');
        $data['all_student'] = $this->student_model->get_all_student();

        /* echo "<pre>";
          print_r($data['all_student']);
          exit; */
        $this->load->model('group/group_model');
        $this->load->model('student/student_model');
        $this->load->model('staff/staff_model');
        $this->load->model('semester/semester_model');
        $this->load->model('subject/subject_model');
        $user_det = $this->session->userdata('logged_in');

        $data['batch'] = $this->batch_model->get_default_batch();

        if ($user_det['staff_type'] == 'admin') {
            //$data['all_batch'] = $this->student_model->get_all_batch();
            $data['all_depart'] = $this->group_model->get_all_department();
            /* echo "<pre>";
              print_r($data["all_depart"]);
              exit; */
            $data['all_semester'] = $this->semester_model->get_semester();
        } else {
            // $data['all_batch'] = $this->student_model->get_all_batch();
            //$data['all_batch'] =$this->subject_model->get_all_batch1($this->user_auth->get_user_id());
        }

        $this->template->write_view('content', 'student/index', $data);
        $this->template->render();
    }

    public function get_all_department1() {
        $this->load->model('student_model');

        $b_id = $this->input->post();

        $g_array = $this->student_model->get_all_depart_by_batch($b_id['batch_id']);
        $g_select = "<select id='depart_id' name='student_group[depart_id]' class=' mandatory validate dupe' style='width:100px'><option value=''>Select</option>";
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['nickname'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function get_all_department11() {
        $this->load->model('student_model');
        $b_id = $this->input->post();

        $g_array = $this->student_model->get_all_depart_by_batch($b_id['batch_id']);
        $g_select = "<select id='depart_id' name='cols[" . $b_id['cols_no'] . "][" . $b_id['cols_count'] . "][depart_id]' class=' mandatory validate dupe' style='width:100px'><option value=''>Select</option>";
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['nickname'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function add_student() {
        $this->load->model('group/group_model');
        $this->load->model('student_model');
        $this->load->model('staff/staff_model');
        $data['all_batch'] = $this->student_model->get_all_batch();
        $data['all_depart'] = $this->group_model->get_all_department();

        if ($this->input->post()) {




            $this->load->helper('text');

            $config['upload_path'] = './profile_image/student/orginal';

            $config['allowed_types'] = '*';

            $config['max_size'] = '2000';

            $this->load->library('upload', $config);

            $input_data = $this->input->post();

//            $this->load->library('email');
//            $data['title'] = '[iBoard] Account registration';
//            $this->email->from('noreply@email.com', 'iBoard');
//            $this->email->to($input_data['student']['email_id']);
//            $this->email->subject('[iBoard] Account registration');
//            $this->email->set_mailtype("html");
//            $msg = $this->load->view('student/registration_email', $input_data, TRUE);
//            $this->email->message($msg);
//            $this->email->send();
            $upload_data['file_name'] = '';
            if (isset($_FILES) && !empty($_FILES)) {
                $upload_files = $_FILES;
                if ($upload_files['staff_image']['name'] != '') {
                    $_FILES['staff_image'] = array(
                        'name' => $upload_files['staff_image']['name'],
                        'type' => $upload_files['staff_image']['type'],
                        'tmp_name' => $upload_files['staff_image']['tmp_name'],
                        'error' => $upload_files['staff_image']['error'],
                        'size' => 10
                    );

                    $this->upload->do_upload("staff_image");
                    $upload_data = $this->upload->data();
                    $dest = getcwd() . "/profile_image/student/thumb/" . $upload_data['file_name'];
                    $src = $this->config->item("base_url") . 'profile_image/student/orginal/' . $upload_data['file_name'];
                    $this->make_thumb($src, $dest, 50);
                }
            }
            if ($upload_data['file_name'] != '')
                $input_data['student']['image'] = $upload_data['file_name'];
            else
                $input_data['student']['image'] = 'avatar5.png';

            $input_data['student']['pwd'] = md5($input_data['student']['pwd']);

            $insert_user = array('username' => $input_data['student']['name'], 'password' => $input_data['student']['pwd'], 'email' => $input_data['student']['email_id']);


            $insert_id = $this->student_model->insert_student($input_data['student']);


            $this->student_model->insert_users($insert_user);
            if (isset($insert_id) && !empty($insert_id))
                $input_data['student_details']['student_id'] = $insert_id['id'];
            $input_data['student_details']['dob'] = date('Y-m-d', strtotime($input_data['student_details']['dob']));
            $input_data['student_details']['join_date'] = date('Y-m-d', strtotime($input_data['student_details']['join_date']));
            $this->student_model->insert_student_details($input_data['student_details']);
            if (isset($input_data['qualification']['exam']) && !empty($input_data['qualification']['exam'])) {
                foreach ($input_data['qualification']['exam'] as $key => $val) {
                    if (!empty($val)) {
                        $q_array = array('person_id' => $insert_id['id'], 'type' => 3, 'examination' => $input_data['qualification']['exam'][$key], 'borad' => $input_data['qualification']['borad'][$key], 'percentage' => $input_data['qualification']['per'][$key], 'p_year' => $input_data['qualification']['pass'][$key]);
                        $this->staff_model->insert_qualification($q_array);
                    }
                }
            }
            if (isset($insert_id) && !empty($insert_id)) {
                $input_data['student_group']['student_id'] = $insert_id['id'];
                $input_data['student_group']['batch_id'] = $input_data['student']['batch_id'];
            }

            $this->student_model->insert_student_group($input_data['student_group']);
            redirect($this->config->item('base_url') . 'student/');
        }
        $this->template->write_view('content', 'student/add_student', $data);
        $this->template->render();
    }

    public function get_all_group() {
        $this->load->model('student_model');
        $this->load->model('subject/subject_model');
        $d_id = $this->input->post();
        $user_det = $this->session->userdata('logged_in');
        if ($user_det['staff_type'] == 'staff')
            $g_array = $this->student_model->get_all_group($d_id['depart_id']);
        else
            $g_array = $this->student_model->get_all_group($d_id['depart_id']);
        $g_select = '<select id="group_id" name="student_group[group_id]" class="mandatory"><option value="">Select</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function get_all_group1() {
        $this->load->model('student_model');
        $this->load->model('subject/subject_model');
        $d_id = $this->input->post();
        $user_det = $this->session->userdata('logged_in');
        if ($user_det['staff_type'] == 'staff')
            $g_array = $this->student_model->get_all_group($d_id['depart_id']);
        else
            $g_array = $this->student_model->get_all_group($d_id['depart_id']);
        $g_select = '<select id="group_id" name="student_group[group_id]" class="mandatory" style="width:100px"><option value="">Select</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function get_all_group11() {
        $this->load->model('student_model');
        $this->load->model('subject/subject_model');
        $d_id = $this->input->post();
        $user_det = $this->session->userdata('logged_in');
        if ($user_det['staff_type'] == 'staff')
            $g_array = $this->student_model->get_all_group($d_id['depart_id']);
        else
            $g_array = $this->student_model->get_all_group($d_id['depart_id']);
        $g_select = '<select id="group_id" name="cols[' . $d_id['cols_no'] . '][' . $d_id['cols_count'] . '][group_id]" class="mandatory g_id" style="width:100px"><option value="">Select</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function get_all_group_attend() {
        $this->load->model('student_model');
        $d_id = $this->input->post();
        $g_array = $this->student_model->get_all_group($d_id['depart_id']);
        $g_select = '<select id="group_id" name="group_id"><option value="0">Select</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    function view_student($id) {
        $this->load->model('student/student_model');
        $data['student_info'] = $this->student_model->get_student_details_by_id($id);
        if (isset($data['student_info']) && !empty($data['student_info'])) {
            $this->template->write_view('content', 'view_student', $data);
            $this->template->render();
        } else {
            redirect($this->config->item('base_url') . 'student/');
        }
    }

    function update_student($id) {
        $this->load->model('group/group_model');
        $this->load->model('student_model');
        $this->load->model('staff/staff_model');
        $data['all_batch'] = $this->student_model->get_all_batch();
        $data['all_depart'] = $this->group_model->get_all_department();
        $data['student_info'] = $this->student_model->get_student_details_by_id($id);
        $data['all_group'] = $this->student_model->get_all_group($data['student_info'][0]['std_depart_id']);
        if ($this->input->post()) {
            $this->load->helper('text');

            $config['upload_path'] = './profile_image/student/orginal';

            $config['allowed_types'] = '*';

            $config['max_size'] = '2000';

            $this->load->library('upload', $config);

            $input_data = $this->input->post();

            if (isset($_FILES) && !empty($_FILES)) {
                $upload_files = $_FILES;
                if ($upload_files['staff_image']['name'] != '') {
                    $_FILES['staff_image'] = array(
                        'name' => $upload_files['staff_image']['name'],
                        'type' => $upload_files['staff_image']['type'],
                        'tmp_name' => $upload_files['staff_image']['tmp_name'],
                        'error' => $upload_files['staff_image']['error'],
                        'size' => 10
                    );

                    $this->upload->do_upload("staff_image");
                    $upload_data = $this->upload->data();
                    $dest = getcwd() . "/profile_image/student/thumb/" . $upload_data['file_name'];
                    $src = $this->config->item("base_url") . 'profile_image/student/orginal/' . $upload_data['file_name'];
                    $this->make_thumb($src, $dest, 50);
                }
            }
            if (isset($upload_data['file_name']) && !empty($upload_data['file_name']))
                $input_data['student']['image'] = $upload_data['file_name'];

            if ($input_data['student']['pwd'] == '')
                unset($input_data['student']['pwd']);
            else {
                //Email notification
                $user_det = $this->session->userdata('logged_in');
//                $this->load->library('email');
//                $data['title'] = '[iBoard] Password Changed';
//                $this->email->from('noreply@email.com', 'iBoard');
//                $this->email->to($input_data['student']['email_id']);
//                $this->email->subject('[iBoard] Password Changed');
//                $this->email->set_mailtype("html");
//                $input_data1['student'] = array('name' => $input_data['student']['name'], 'created_by' => $user_det['name'], 'pwd' => $input_data['student']['pwd'], 'type' => 'college');
//                $msg = $this->load->view('admin/password_change_email', $input_data1, TRUE);
//                $this->email->message($msg);
//                $this->email->send();
                $input_data['student']['pwd'] = md5($input_data['student']['pwd']);
            }
            if (isset($input_data['student']['pwd']))
                $update_user = array('username' => $input_data['student']['name'], 'password' => $input_data['student']['pwd'], 'email' => $input_data['student']['email_id']);
            else
                $update_user = array('username' => $input_data['student']['name'], 'email' => $input_data['student']['email_id']);

            $this->student_model->update_student($input_data['student'], $id);

            $this->student_model->update_users($update_user, $data['student_info'][0]['email_id']);

            $input_data['student_details']['dob'] = date('Y-m-d', strtotime($input_data['student_details']['dob']));
            $input_data['student_details']['join_date'] = date('Y-m-d', strtotime($input_data['student_details']['join_date']));

            $this->student_model->update_student_details($input_data['student_details'], $id);
            $this->student_model->delete_qualification_by_id($id);
            if (isset($input_data['qualification']['exam']) && !empty($input_data['qualification']['exam'])) {
                foreach ($input_data['qualification']['exam'] as $key => $val) {
                    if (!empty($val)) {
                        $q_array = array('person_id' => $id, 'type' => 3, 'examination' => $input_data['qualification']['exam'][$key], 'borad' => $input_data['qualification']['borad'][$key], 'percentage' => $input_data['qualification']['per'][$key], 'p_year' => $input_data['qualification']['pass'][$key]);
                        $this->staff_model->insert_qualification($q_array);
                    }
                }
            }
            $input_data['student_group']['batch_id'] = $input_data['student']['batch_id'];
            $this->student_model->update_student_group($input_data['student_group'], $id);
            redirect($this->config->item('base_url') . 'student/');
        }
        if (isset($data['student_info']) && !empty($data['student_info'])) {
            $this->template->write_view('content', 'update_student', $data);
            $this->template->render();
        } else {
            redirect($this->config->item('base_url') . 'student/');
        }
    }

    function delete_student($id) {
        $this->load->model('student_model');
        $update_data = array('status' => 0, 'df' => 1);
        $this->student_model->delete_student($update_data, $id);
        redirect($this->config->item('base_url') . 'student/');
    }

    function checking_email_insert() {
        $this->load->model('student/student_model');

        $email = $this->input->post('value1');


        $data = $this->student_model->email_checking_insert($email);
        $i = 0;
        if ($data) {
            $i = 1;
        }

        if ($i == 1) {
            echo "Email ID is already exist";
        }
    }

    function checking_email_update() {
        $this->load->model('student/student_model');
        $st_id = $this->input->post('value2');
        $email = $this->input->post('value1');

        $data = $this->student_model->email_checking_update($st_id, $email);

        $i = 0;
        if ($data) {
            $i = 1;
        }

        if ($i == 1) {
            echo "Email ID is already exist";
        } else {

        }
    }

    function checking_studentid_insert() {
        $this->load->model('student/student_model');

        $student_id = $this->input->post('student_id');

        $data = $this->student_model->checking_studentid_insert($student_id);
        $i = 0;
        if ($data) {
            $i = 1;
        }

        if ($i == 1) {
            echo "Student ID is already exist";
        } else {

        }
    }

    function checking_studentid_update() {

        $this->load->model('student/student_model');
        $s_id = $this->input->post('stid');
        $student_id = $this->input->post('student_id');

        $data = $this->student_model->checking_studentid_update($s_id, $student_id);

        $i = 0;
        if ($data) {
            $i = 1;
        }

        if ($i == 1) {
            echo "Student ID is already exist";
        } else {

        }
    }

    function make_thumb($src, $dest, $desired_width) {

        /* read the source image */


        $source_image = $this->imageCreateFromAny($src); //imagecreatefromjpeg($src);
        $width = imagesx($source_image);
        $height = imagesy($source_image);

        /* find the "desired height" of this thumbnail, relative to the desired width  */
        $desired_height = floor($height * ($desired_width / $width));

        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

        /* copy source image at a resized size */
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

        /* create the physical thumbnail image to its destination */
        imagejpeg($virtual_image, $dest, 100);
    }

    function imageCreateFromAny($filepath) {
        $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
        $allowedTypes = array(
            1, // [] gif
            2, // [] jpg
            3, // [] png
            6   // [] bmp
        );
        if (!in_array($type, $allowedTypes)) {
            return false;
        }
        switch ($type) {
            case 1 :
                $im = imageCreateFromGif($filepath);
                break;
            case 2 :
                $im = imageCreateFromJpeg($filepath);
                break;
            case 3 :
                $im = imageCreateFromPng($filepath);
                break;
            case 6 :
                $im = imageCreateFromBmp($filepath);
                break;
        }
        return $im;
    }

    function get_all_student_for_staff() {
        $this->load->model('student/student_model');
        $data['ajax_val'] = $this->input->post();
        $data['all_student'] = $this->student_model->get_all_student_for_staff($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id']);

        echo $this->load->view('student/view_staff_side', $data);
    }

    function test() {

    }

    function get_all_student_type() {
        $this->load->model('student/student_model');
        $data['ajax_val'] = $this->input->post();
        //echo "<pre>"; print_r($data['ajax_val']); exit;
        $data['all_student'] = $this->student_model->get_all_student_type($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['s_type']);

        echo $this->load->view('student/view_staff_side', $data);
    }

    function get_all_student_hostel() {
        $this->load->model('student/student_model');
        $data['ajax_val'] = $this->input->post();
        //echo "<pre>"; print_r($data['ajax_val']); exit;
        if ($data['ajax_val']['hostel'] == 2) {
            $data['all_student'] = $this->student_model->get_all_student_transport($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], 1);
        } else {
            $data['all_student'] = $this->student_model->get_all_student_hostel($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['hostel']);
        }
        echo $this->load->view('student/view_staff_side', $data);
    }

    function get_all_student_type_hostel() {
        $this->load->model('student/student_model');
        $data['ajax_val'] = $this->input->post();
        //echo "<pre>"; print_r($data['ajax_val']); exit;
        if ($data['ajax_val']['hostel'] == 2) {
            $data['all_student'] = $this->student_model->get_all_student_type_transport($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['s_type'], 1);
        } else {
            $data['all_student'] = $this->student_model->get_all_student_type_hostel($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['s_type'], $data['ajax_val']['hostel']);
        }
        echo $this->load->view('student/view_staff_side', $data);
    }

    public function checking_regno_insert() {
        $this->load->model('student/student_model');
        $regno = $this->input->post('value1');
        $validation = $this->student_model->checking_regno_insert($regno);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Register Number Already Exist";
        }
    }

    public function checking_regno_update() {
        $this->load->model('student/student_model');
        $regno = $this->input->post('value1');
        $id = $this->input->post('value2');
        //echo $regno;
        //echo $id;
        //exit;
        $validation = $this->student_model->checking_regno_update($regno, $id);

        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Register Number Already Exist";
        }
    }

    //student report added for all the report
    public function student_report() {
        $this->template->write_view('content', 'student/student_report');
        $this->template->render();
    }

    public function student_report_ajax() {
        $post_val = $this->input->get();
        $this->load->model('student/student_model');
        $this->load->model('fees/fees_model');
        $this->load->model('hostel/hostel_model');
        $student_id = $this->student_model->get_student_details_by_roll_no($post_val['roll_no']);
        if (isset($student_id) && !empty($student_id)) {
            $data['student_info'] = $this->student_model->get_student_details_by_id($student_id[0]['id']);
            //Exam Report
            $this->load->model('users/users_model');
            $this->load->model('admin/admin_model');
            $where = array('student_group.student_id' => $student_id[0]['id']);
            $this->load->model('internal/internal_model');
            $data1['student_info1'] = $this->internal_model->get_all_student_for_users($where);
            $data1["university_result"] = $this->users_model->get_university_result_by_id1($data1['student_info1'][0]['batch_id'], $data1['student_info1'][0]['depart_id'], $data1['student_info1'][0]['group_id'], $data1['student_info1'][0]['std_id']);
            $data1['from_report'] = 1;
            $data['from_report'] = 1;
            //Fees Details
            $data2['fees_info'] = $this->fees_model->get_student_fees_details($post_val['roll_no']);
            //Hostel Fees
            $data2['my_monthly_fees'] = $this->hostel_model->get_student_monthly_fees($post_val['roll_no']);
            //placment info
            $data2['all_placement'] = $this->users_model->get_all_placement($student_id[0]['id']);
            //Attendance Details
            $data4 = $this->users_model->attendance_dashbord($student_id);
            //Internal Details
            $this->load->model('assignment/assignment_model');
            $this->load->model('users/users_model');
            $this->load->model('semester/semester_model');
            $data3['std_info'] = $data1;
            $data3['all_semester'] = $this->semester_model->get_semester();
            $data3['all_sem'] = $this->users_model->get_created_sem_by_id1($data1['student_info1'][0]['batch_id'], $data1['student_info1'][0]['depart_id'], $data1['student_info1'][0]['group_id']);


            echo $this->load->view('view_student', $data);
            echo $this->load->view('student/student_attendance', $data4);
            echo $this->load->view('student/student_internals', $data3);
            echo $this->load->view('student/student_pay_fees', $data2);

            echo $this->load->view('internal/student_mark_sheet', $data1);
        } else {
            echo "<br/>";
            echo "<b style='margin-left:400px;color:#FF4747;font-size:15px;'>Invalid Roll Number&nbsp;!</b>";
        }
    }

    // internal
    public function get_subject_by_sem_id() {
        $this->load->model('users/users_model');
        $data['ajax_val'] = $this->input->get();
        $data['all_subject'] = $this->users_model->get_subject_by_sem_id($data['ajax_val']['batch_id'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['sem_id']);

        $g_select = '<table><tr><td width="150">Select Subject</td><td><select id="subject_id"><option value="0">Select Subject</option>';
        if (isset($data['all_subject']) && !empty($data['all_subject'])) {
            foreach ($data['all_subject'] as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['subject_name'] . "</option>";
            }
        }
        $g_select = $g_select . '</select></td></table>';
        echo $g_select;
    }

    function get_all_internals_by_id() {
        $this->load->model('users/users_model');

        $data['ajax_val'] = $this->input->get();
        $where = array('internal.batch_id' => $data['ajax_val']['batch_id'], 'internal.depart_id' => $data['ajax_val']['depart_id'], 'internal.group_id' => $data['ajax_val']['group_id'], 'internal.semester' => $data['ajax_val']['sem_id']);
        $data['all_info'] = $this->users_model->get_internal_by_std_id($where, $data['ajax_val']['std_id']);
        echo $this->load->view('student/all_internal_view', $data);
    }

    function get_internal_by_subject_id() {
        $this->load->model('users/users_model');
        $user_info = $this->session->userdata('user_info');
        $data['ajax_val'] = $this->input->get();
        $where = array('internal.batch_id' => $data['ajax_val']['batch_id'], 'internal.depart_id' => $data['ajax_val']['depart_id'], 'internal.group_id' => $data['ajax_val']['group_id'], 'internal.semester' => $data['ajax_val']['sem_id'], 'internal.subject_id' => $data['ajax_val']['subject_id']);
        $data['all_info'] = $this->users_model->get_internal_by_std_id($where, $data['ajax_val']['std_id']);
        echo $this->load->view('student/internal_view', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
