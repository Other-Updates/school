<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller {

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
        $this->load->library('session');
        $this->load->library('email');
        $this->load->database();
        $this->load->library('form_validation');
    }

    public function index() {

        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/admin_template_login.php');
        $this->template->write_view('content', 'admin/index');
        $this->template->render();
    }

    public function admin_profile() {
        $admin_id = $this->user_auth->get_user_id();
        $this->load->model('admin/admin_model');
        $data["desg"] = $this->admin_model->get_all_designation();
        $data["list"] = $this->admin_model->get_single_admin($admin_id);
        $this->template->write_view('content', 'admin/admin_profile', $data);
        $this->template->render();
    }

    public function admin_password_change() {
        $this->load->model('admin/admin_model');
        $user_det = $this->session->userdata('logged_in');
        $id = $user_det['user_id'];
        $new = $this->input->post('new_password');
        $new_password = md5($this->input->post('new_password'));
        $input = array('pwd' => $new_password);
        $links = '';
        $this->load->library('email');
        $data['title'] = '[iBoard] Password Changed';
//        $this->email->from('noreply@email.com', 'iBoard');
//        $this->email->to($user_det['email']);
//        $this->email->subject('[iBoard] Password Changed');
//        $this->email->set_mailtype("html");
//        $input_data['student'] = array('name' => $user_det['name'], 'created_by' => $user_det['name'], 'from' => 'admin', 'pwd' => $new, 'type' => 'college');
//        $msg = $this->load->view('admin/password_change_email', $input_data, TRUE);
//        $this->email->message($msg);
//        $this->email->send();
        $this->admin_model->admin_password_change($input, $id);
    }

    public function admin_password_change_social() {
        $this->load->model('admin/admin_model');
        $user_det = $this->session->userdata('logged_in');
        $id = $user_det['user_id'];
        $new_password = md5($this->input->post('new_password'));
        /* echo "<script type='text/javascript'>alert($new_password);</script>";
          exit; */

        $new = $this->input->post('new_password');
        $input = array('password' => $new_password);
        $links = '';
//        $this->load->library('email');
//        $data['title'] = '[iBoard] Password Changed';
//        $this->email->from('noreply@email.com', 'iBoard');
//        $this->email->to($user_det['email']);
//        $this->email->subject('[iBoard] Password Changed');
//        $this->email->set_mailtype("html");
//        $input_data['student'] = array('name' => $user_det['name'], 'created_by' => $user_det['name'], 'from' => 'admin', 'pwd' => $new, 'type' => 'social');
//        $msg = $this->load->view('admin/password_change_email', $input_data, TRUE);
//        $this->email->message($msg);
//        $this->email->send();
        $this->admin_model->admin_password_change_social($input, $id);
    }

    // send feed back
    public function send_feedback() {

        $user_det = $this->session->userdata('logged_in');

        $this->load->library('email');

//        $data['title'] = '[iBoard] Send Feedback';
//        $this->email->from('noreply@email.com', 'iBoard');
//        $list = array('ashwin.i2sts@gmail.com', 'pranav.i2sts@gmail.com', 'prince.ella@gmail.com');
//        $this->email->to($list);
//        $this->email->subject('[iBoard] Feed Back');
//        $this->email->set_mailtype("html");
//        $input_data['feedback'] = array('from' => $user_det['email'], 'name' => $user_det['name'], 'feedback' => $this->input->post('feedback'));
//        $msg = $this->load->view('admin/feed_back_form', $input_data, TRUE);
//
//        $this->email->message($msg);
//        $this->email->send();
//
//        $feedback_msg = "Thanks for sending the Feed back, We will get back to you within 48 hours by iBoard";
//        $this->email->from('noreply@email.com', 'iBoard');
//        $this->email->to($user_det['email']);
//        $this->email->subject('[iBoard] Acknowledgement');
//        $this->email->message($feedback_msg);
//        $this->email->send();


        echo "success";
    }

    public function admin_profile_update() {
        $this->load->model('admin/admin_model');


        if ($this->input->post()) {
            $id = $this->user_auth->get_user_id();


            $data["list"] = $this->admin_model->get_single_admin($id);
            $this->load->helper('text');

            $config['upload_path'] = './profile_image/admin/original';

            $config['allowed_types'] = '*';

            $config['max_size'] = '2000';

            $this->load->library('upload', $config);

            $upload_data['file_name'] = '';
            if (isset($_FILES) && !empty($_FILES)) {
                $upload_files = $_FILES;
                if ($upload_files['admin_image']['name'] != '') {
                    $_FILES['admin_image'] = array(
                        'name' => $upload_files['admin_image']['name'],
                        'type' => $upload_files['admin_image']['type'],
                        'tmp_name' => $upload_files['admin_image']['tmp_name'],
                        'error' => $upload_files['admin_image']['error'],
                        'size' => '2000'
                    );



                    $this->upload->do_upload('admin_image');

                    $upload_data = $this->upload->data();

                    $dest = getcwd() . "/profile_image/admin/thumb/" . $upload_data['file_name'];


                    $src = $this->config->item("base_url") . 'profile_image/admin/original/' . $upload_data['file_name'];
                    $this->make_thumb($src, $dest, 50);
                }
            }
            if ($upload_data['file_name'] != '') {
                $input_data['admin']['image'] = $upload_data['file_name'];
                //$insert_id=$this->admin_model->update_admin_profile($input_data['admin'],$id);

                $input = array('username' => $this->input->post('username'), 'name' => $this->input->post('username'), 'designation_id' => $this->input->post('designation'), 'email_id' => $this->input->post('email'), 'phone_no' => $this->input->post('phone'), 'address' => $this->input->post('address'), 'image' => $upload_data['file_name']);
                $this->admin_model->update_admin_profile($input, $id);


                redirect($this->config->item('base_url') . 'admin/admin_profile');
            } else {

                $input = array('username' => $this->input->post('username'), 'name' => $this->input->post('username'), 'designation_id' => $this->input->post('designation'), 'email_id' => $this->input->post('email'), 'phone_no' => $this->input->post('phone'), 'address' => $this->input->post('address'));
                $this->admin_model->update_admin_profile($input, $id);
                redirect($this->config->item('base_url') . 'admin/admin_profile');
            }
        }
        $this->template->write_view('content', 'admin/admin_profile', $data);
        $this->template->render();
    }

    public function verify() {
        $this->load->model('admin/admin_model');
        $this->load->model('master/master_model');
        $email = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('upass'));

        $result = $this->admin_model->check_login($email, $password);
        if ($result) {
            foreach ($result as $row) {
                $sess_array = array('email' => $row->email_id, 'application' => 'i2_soft', 'user_id' => $row->id, 'name' => $row->name, 'staff_type' => 'admin', 'profile_image' => $row->image);
                $this->session->set_userdata('logged_in', $sess_array);
                $user_permission = $this->master_model->get_staff_by_id($row->id, 2);
                $this->session->set_userdata('admin_permission', $user_permission);
                $d_ion = $row->designation;
            }


            if (strtolower($d_ion) == 'super admin') {
                redirect($this->config->item('base_url') . 'admin/dashboard');
                echo $d_ion;
            } else {
                redirect($this->config->item('base_url') . 'admin/dashboard');
            }
        } else {
            redirect($this->config->item('base_url') . 'admin?check=fail');
        }
    }

    public function super_admin_dashboard() {

        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/super_admin_dashboard.php');
        $this->template->render();
    }

    public function dashboard() {
        $this->load->model('events/events_model');
        $this->load->model('staff/staff_model');
        $this->load->model('student/student_model');
        $this->load->model('api/notification_model');
        $this->load->model('department/department_model');
        $this->load->model('batch/batch_model');
        $this->load->model('admin/admin_model');

        $data['all_department'] = $this->department_model->get_all_student_by_department();
        $all_events = $this->events_model->get_all_events();

        $data['students'] = $this->admin_model->get_all_students();

        $data['s_attend'] = $this->admin_model->get_all_std_attendance();

        $data['staff'] = $this->admin_model->get_all_staff();

        $data['s_staff'] = $this->admin_model->attendance_staff_det();
        $data['day_order'] = $this->admin_model->get_all_day_order_count();
        $data['day'] = $this->admin_model->get_all_day_orders();

        $data['batch'] = $batch = $this->batch_model->get_default_batch();
        $data['events'] = $this->admin_model->get_all_events($batch[0]['id']);
        $data['event'] = $this->admin_model->today_events($batch[0]['id']);


        $data['subject'] = $this->admin_model->get_all_subjects();

        $user_det = $this->session->userdata('logged_in');
        $data['all_notification'] = $this->notification_model->get_all_notification_for_recent($user_det['user_id'], $user_det['staff_type']);

        $all_day_order = $this->admin_model->get_all_college_calendar();
        if ($user_det['staff_type'] == 'admin')
            $all_staff = $this->staff_model->get_all_staff_for_calendar();
        else
            $all_staff = $this->student_model->get_all_student_for_calendar($user_det['user_id']);

        if (isset($all_staff) && !empty($all_staff)) {
            $list = 'events: [';
            $j = 1;


            if (isset($all_day_order) && !empty($all_day_order)) {
                foreach ($all_day_order as $val) {
                    $y = date('Y', strtotime($val['from']));
                    $m = date('m', strtotime($val['from'])) - 1;
                    $d = date('d', strtotime($val['from']));

                    $y1 = date('Y', strtotime($val['to']));
                    $m1 = date('m', strtotime($val['to'])) - 1;
                    $d1 = date('d', strtotime($val['to']));
                    $list = $list . "{";
                    $list = $list . "title: '" . $val['title'] . "',";
                    $list = $list . "start: new Date(" . $y . ", " . $m . ", " . $d . "),";
                    $list = $list . "end: new Date(" . $y1 . ", " . $m1 . ", " . $d1 . "),";
                    if (strlen($val['title']) < 6)
                        $list = $list . "backgroundColor: '#3a87ad',";
                    else
                        $list = $list . "backgroundColor: 'rgb(91, 173, 80)',";
                    $list = $list . "borderColor: 'rgb(216, 216, 216)'";
                    $list = $list . "},";
                }
            }
            if (isset($all_events) && !empty($all_events)) {
                $i = 1;

                foreach ($all_events as $val) {
                    $y = date('Y', strtotime($val['date']));
                    $m = date('m', strtotime($val['date'])) - 1;
                    $d = date('d', strtotime($val['date']));
                    $list = $list . "{";
                    $list = $list . "title: '" . $val['event_name'] . "',";
                    $list = $list . "start: new Date(" . $y . ", " . $m . ", " . $d . "),";
                    $list = $list . "backgroundColor: '#f56954',";
                    $list = $list . "borderColor: '#f56954',";
                    $list = $list . "url: '" . $this->config->item('base_url') . 'events/view_events/' . $val['id'] . "'";
                    $list = $list . "},";
                    $i++;
                }
            }
            foreach ($all_staff as $val) {
                $y = date('Y');
                $m = date('m', strtotime($val['dob'])) - 1;
                $d = date('d', strtotime($val['dob']));
                $count_y = $y;
                for ($x = $y; $x <= $y + 10; $x++) {
                    $list = $list . "{";
                    $list = $list . "title: 'BIRTH DAY " . $val['staff_name'] . "-" . $val['nickname'] . "',";
                    $list = $list . "start: new Date(" . $x . ", " . $m . ", " . $d . "),";
                    $list = $list . "backgroundColor: 'rgb(84, 201, 156)',";
                    $list = $list . "borderColor: 'rgb(143, 243, 205)'";
                    //$list=$list."url: '".$this->config->item('base_url').'events/view_events/'.$val['id']."'";
                    $list = $list . "}";
                    if ($count_y != $y + 10) {
                        $list = $list . ",";
                    }
                    $count_y++;
                }
                if ($j != count($all_staff)) {
                    $list = $list . ",";
                }
                $j++;
            }
            $list = $list . "]";
        } else
            $list = "events: [
                        {
                            title: '',
                            backgroundColor: '',
                            borderColor: ''
                        }]";
        //print_r(count($all_events));
        $data['list'] = $list;
        /* events: [
          {
          title: 'All Day Event',
          start: new Date(y, m, 1),
          backgroundColor: "#f56954", //red
          borderColor: "#f56954" //red
          },
          ] */

        $this->template->write_view('content', 'admin/dashboard', $data);
        $this->template->render();
    }

    public function update_notification() {
        $this->load->model('api/notification_model');
        $u_id = $this->input->post();
        $data = array('status' => 0);
        $this->notification_model->update_notification($u_id['note_id'], $data);
        echo "success";
    }

    public function logout() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $email = $session_data['email'];
            $this->load->model('admin/admin_model');
            $result = $this->admin_model->logoutupdate($email);
            $session_data = $this->session->userdata('logged_in');

            $this->session->unset_userdata('logged_in', 'for_placement', 'for_placement_dept');
            $this->session->sess_destroy();
            if ($session_data['staff_type'] == 'admin')
                redirect($this->config->item('base_url') . 'admin/');
            else
                redirect($this->config->item('base_url'));
        }
    }

    public function manage_admin() {
        $this->load->model('admin/admin_model');
        $data["desg"] = $this->admin_model->get_all_designation();

        $data["list"] = $this->admin_model->get_all_admin();
        $data["status"] = 1;
        $this->template->write_view('content', 'admin/manage_admin', $data);
        $this->template->render();
    }

    public function insert_admin() {
        $password = md5($this->input->post('value3'));
        $this->load->model('admin/admin_model');
        $input = array('username' => $this->input->post('value1'), 'password' => $password, 'name' => $this->input->post('value1'), 'designation_id' => $this->input->post('value7'), 'email_id' => $this->input->post('value2'), 'pwd' => $password, 'phone_no' => $this->input->post('value4'), 'address' => $this->input->post('value6'), 'status' => $this->input->post('value5'));


        $this->admin_model->insert_admin($input);
        $data["list"] = $this->admin_model->get_all_admin();

        $data["status"] = $this->input->post('value5');
        $data["desg"] = $this->admin_model->get_all_designation();



        echo $this->load->view('list_view', $data);
        /* $input_data['student']=array('name'=>$this->input->post('value1'),'email_id'=>$this->input->post('value2'),'pwd'=>$this->input->post('value3'),'from'=>1);
          $this->load->library('email');
          $data['title']='[iBoard] Account registration';
          $this->email->from('noreply@email.com', 'iBoard');
          $this->email->to($this->input->post('value2'));
          $this->email->subject('[iBoard] Account registration');
          $this->email->set_mailtype("html");
          $msg = $this->load->view('student/registration_email',$input_data,TRUE);
          $this->email->message($msg);
          $this->email->send(); */
    }

    public function update_admin($id) {
        $this->load->model('admin/admin_model');
        if ($this->input->post()) {
            $id = $this->input->post('aid');

            $password = $this->input->post('password');

            if ((!$password) && empty($password)) {
                $input = array('username' => $this->input->post('name'), 'name' => $this->input->post('name'), 'designation_id' => $this->input->post('designation'), 'email_id' => $this->input->post('email'), 'phone_no' => $this->input->post('phone'), 'address' => $this->input->post('address'), 'status' => $this->input->post('status'));
            } else {
                $pass = md5($password);
                //Email notification
                $user_det = $this->session->userdata('logged_in');
//                $this->load->library('email');
//                $data['title'] = '[iBoard] Password Changed';
//                $this->email->from('noreply@email.com', 'iBoard');
//                $this->email->to($user_det['email']);
//                $this->email->subject('[iBoard] Password Changed');
//                $this->email->set_mailtype("html");
//                $input_data['student'] = array('name' => $user_det['name'], 'created_by' => $user_det['name'], 'from' => 'admin', 'pwd' => $password, 'type' => 'college');
//                $msg = $this->load->view('admin/password_change_email', $input_data, TRUE);
//                $this->email->message($msg);
//                $this->email->send();
                $input = array('username' => $this->input->post('name'), 'password' => $pass, 'name' => $this->input->post('name'), 'designation_id' => $this->input->post('designation'), 'email_id' => $this->input->post('email'), 'pwd' => $pass, 'phone_no' => $this->input->post('phone'), 'status' => $this->input->post('status'), 'address' => $this->input->post('address'));
            }
            $this->admin_model->update_admin($input, $id);
            redirect($this->config->item('base_url') . 'admin/manage_admin/');
        }
        $data["desg"] = $this->admin_model->get_all_designation();
        $data["list_admin"] = $this->admin_model->get_single_admin($id);
        if (isset($data["list_admin"]) && !empty($data["list_admin"])) {
            $this->template->write_view('content', 'admin/update_admin', $data);
            $this->template->render();
        } else {
            redirect($this->config->item('base_url') . 'admin/manage_admin');
        }
    }

    public function delete_admin_active() {
        $this->load->model('admin/admin_model');
        $id = $this->input->post('value1');
        $this->admin_model->delete_admin_active($id);
        $data["list"] = $this->admin_model->get_all_admin();
        $data["desg"] = $this->admin_model->get_all_designation();
        $data["status"] = 0;
        echo $this->load->view('list_view', $data);
    }

    public function delete_admin_inactive() {
        $this->load->model('admin/admin_model');
        $id = $this->input->post('value1');
        $this->admin_model->delete_admin_inactive($id);
        $data["list"] = $this->admin_model->get_all_admin();
        $data["status"] = 0;
        echo $this->load->view('list_view', $data);
    }

    public function deactivate_admin() {
        $this->load->model('admin/admin_model');
        $deactivate_id = $this->input->post('d_id');
        $this->admin_model->delete_admin_inactive($deactivate_id);
        redirect($this->config->item('base_url') . 'admin/logout');
    }

    public function checking_email_insert() {
        $this->load->model('admin/admin_model');

        $email = $this->input->post('value1');


        $data = $this->admin_model->email_checking_insert($email);
        $i = 0;
        if ($data) {
            $i = 1;
        }

        if ($i == 1) {
            echo "Email ID is already exist";
        }
    }

    function checking_email_update() {
        $this->load->model('admin/admin_model');

        $aid = $this->input->post('value2');
        $email = $this->input->post('value1');
        $data = $this->admin_model->email_checking_update($aid, $email);
        /* print_r($data);
          exit; */
        $i = 0;
        if ($data) {
            $i = 1;
        }

        if ($i == 1) {
            echo "Email ID is already exist";
        }
    }

    function checking_email_admin() {
        $this->load->model('admin/admin_model');
        $user_det = $this->session->userdata('logged_in');
        $aid = $user_det['user_id'];
        $email = $this->input->post('value1');
        $data = $this->admin_model->email_checking_update($aid, $email);
        /* print_r($data);
          exit; */
        $i = 0;
        if ($data) {
            $i = 1;
        }

        if ($i == 1) {
            echo "Email ID is already exist";
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

    public function college_mark_details() {
        $this->load->model('admin/admin_model');
        if ($this->input->post()) {
            $input = $this->input->post();
            if (isset($input['internal_details']['added_by']))
                $this->admin_model->insert_internal_details($input['internal_details']);
            else
                $this->admin_model->update_internal_details($input['internal_details']);
            redirect($this->config->item('base_url') . 'admin/college_mark_details');
        }
        $data['int_info'] = $this->admin_model->get_internal_details();
        $this->template->write_view('content', 'admin/college_mark_details', $data);
        $this->template->render();
    }

    public function college_fees_details() {
        $this->load->model('admin/admin_model');
        //$data['int_info']=$this->admin_model->get_internal_details();
        $data['fee_name'] = $this->admin_model->get_fees_name();
        //echo "<pre>"; print_r($data['fee_name']); exit;
        $this->template->write_view('content', 'admin/college_fees_details', $data);
        $this->template->render();
    }

    public function fees_details() {
        $this->load->model('admin/admin_model');
        $user_det = $this->session->userdata('logged_in');
        $data = array('fees_name' => $this->input->post('value'), 'status' => $this->input->post('value1'), 'created_by' => $user_det['user_id'], 'staff_type' => $user_det['staff_type']);
        $this->admin_model->insert_fees_name($data);
        $data['fee_name'] = $this->admin_model->get_fees_name();
        echo $this->load->view('fees_view', $data);
    }

    public function college_calendar() {
        $this->load->model('admin/admin_model');
        $all_day_order = $this->admin_model->get_all_college_calendar();
        if (isset($all_day_order) && !empty($all_day_order)) {
            $list = 'events: [';
            $j = 1;
            foreach ($all_day_order as $val) {
                $y = date('Y', strtotime($val['from']));
                $m = date('m', strtotime($val['from'])) - 1;
                $d = date('d', strtotime($val['from']));

                $y1 = date('Y', strtotime($val['to']));
                $m1 = date('m', strtotime($val['to'])) - 1;
                $d1 = date('d', strtotime($val['to']));
                $list = $list . "{";
                $list = $list . "title: '" . $val['title'] . "',";
                $list = $list . "start: new Date(" . $y . ", " . $m . ", " . $d . "),";
                $list = $list . "end: new Date(" . $y1 . ", " . $m1 . ", " . $d1 . "),";
                if (strlen($val['title']) < 6)
                    $list = $list . "backgroundColor: '#3a87ad',";
                else
                    $list = $list . "backgroundColor: 'rgb(91, 173, 80)',";
                $list = $list . "borderColor: 'rgb(216, 216, 216)'";
                $list = $list . "}";
                if ($j != count($all_day_order)) {
                    $list = $list . ",";
                }
                $j++;
            }
            $list = $list . "]";
        } else
            $list = "events: [
                        {
                            title: '',
                            backgroundColor: '',
                            borderColor: ''
                        }]";

        $data['list'] = $list;
        $this->template->write_view('content', 'admin/college_calendar', $data);
        $this->template->render();
    }

    public function add_calendar() {
        $this->load->model('admin/admin_model');
        $insert = array('title' => $this->input->get('title_name'), 'from' => $this->input->get('start_date'), 'to' => $this->input->get('end_date'), 'created_by' => $this->user_auth->get_user_id());
        $this->admin_model->add_day_order($insert);
    }

    public function delete_calendar() {
        $this->load->model('admin/admin_model');
        $details = $this->input->get();
        if ($details['end_date'] == '')
            $details['end_date'] = $details['start_date'];
        $where = array('from' => $details['start_date'], 'to' => $details['end_date']);
        $this->admin_model->delete_day_order($where);
    }

    public function notice() {
        $this->load->model('admin/admin_model');
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $staff_id = $user_det['user_id'];
        $data["department"] = $this->admin_model->get_department($user_det);
        if ($user_det['staff_type'] == "staff") {
            $data["notice"] = $this->admin_model->get_notice_for_staff();
        } else {
            $data["notice"] = $this->admin_model->get_notice();
        }
        $this->template->write_view('content', 'admin/notice', $data);
        $this->template->render();
    }

    public function insert_notice() {
        $this->load->model('admin/admin_model');
        $this->load->model('assignment/assignment_model');
        $user_det = $this->session->userdata('logged_in');
        $staff_id = $user_det['user_id'];
        // file upload

        $this->load->helper('text');

        $config['upload_path'] = './notice';

        $config['allowed_types'] = '*';

        $config['max_size'] = '2000';

        $this->load->library('upload', $config);

        $upload_data['file_name'] = '';
        if (isset($_FILES) && !empty($_FILES)) {
            $upload_files = $_FILES;
            if ($upload_files['notice_file']['name'] != '') {
                $_FILES['notice_file'] = array(
                    'name' => $upload_files['notice_file']['name'],
                    'type' => $upload_files['notice_file']['type'],
                    'tmp_name' => $upload_files['notice_file']['tmp_name'],
                    'error' => $upload_files['notice_file']['error'],
                    'size' => '2000'
                );



                $this->upload->do_upload('notice_file');

                $upload_data = $this->upload->data();
                $src = $this->config->item("base_url") . 'notice/' . $upload_data['file_name'];
            }
        }
        //
        if ($this->input->post('type') == 0) {
            $from = date("Y-m-d", strtotime($this->input->post('from_date')));
            $to = date("Y-m-d", strtotime($this->input->post('to_date')));
            if ($upload_data['file_name'] != '') {
                $input = array('notice_from' => $from, 'notice_to' => $to, 'notice' => $this->input->post('notice'), 'notice_file' => $upload_data['file_name'], 'notice_type' => $this->input->post('type'), 'view_type' => $this->input->post('notice_to'), 'created_by' => $staff_id, 'staff_type' => $user_det['staff_type']);
            } else {
                $input = array('notice_from' => $from, 'notice_to' => $to, 'notice' => $this->input->post('notice'), 'notice_type' => $this->input->post('type'), 'view_type' => $this->input->post('notice_to'), 'created_by' => $staff_id, 'staff_type' => $user_det['staff_type']);
            }
            $this->admin_model->insert_notice($input);
        } else {
            $from = date("Y-m-d", strtotime($this->input->post('from_date')));
            $to = date("Y-m-d", strtotime($this->input->post('to_date')));
            if ($upload_data['file_name'] != '') {
                $input = array('depart_id' => $this->input->post('department'), 'group_id' => $this->input->post('group_id'), 'notice_from' => $from, 'notice_to' => $to, 'notice' => $this->input->post('notice'), 'notice_file' => $upload_data['file_name'], 'notice_type' => $this->input->post('type'), 'view_type' => $this->input->post('notice_to'), 'created_by' => $staff_id, 'staff_type' => $user_det['staff_type']);
            } else {
                $input = array('depart_id' => $this->input->post('department'), 'group_id' => $this->input->post('group_id'), 'notice_from' => $from, 'notice_to' => $to, 'notice' => $this->input->post('notice'), 'notice_type' => $this->input->post('type'), 'view_type' => $this->input->post('notice_to'), 'created_by' => $staff_id, 'staff_type' => $user_det['staff_type']);
            }
            $this->admin_model->insert_notice($input);
        }



        // notification
        $ins_data = $this->input->post();
        //echo "<pre>"; print_r($ins_data); exit;
        $this->load->model('api/notification_model');
        $this->load->model('subject/subject_model');
        $title = 'Notice Board Added';
        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);

        if ($ins_data['type'] == 0) {
            $where = array('depart_id !=' => 100000);
            $where1 = array('depart_id !=' => 100000);

            // changes in notification
            if ($ins_data['notice_to'] == 2 || $ins_data['notice_to'] == 3) {
                $all_staff = $this->notification_model->get_all_staff_notice($where);
                //echo "<pre>"; print_r($all_staff); exit;
                $i = 0;
                foreach ($all_staff as $val1) {
                    $all_staff[$i]['notification_id'] = $last_id['id'];
                    $all_staff[$i]['user_type'] = 'staff';
                    $all_staff[$i]['links'] = 'admin/notice';
                    $all_staff[$i]['read'] = 0;
                    $all_staff[$i]['date'] = $from;
                    $i++;
                }
                $this->notification_model->insert_all_staff($all_staff);
            }
            if ($ins_data['notice_to'] == 1 || $ins_data['notice_to'] == 3) {
                $all_student = $this->notification_model->get_all_student($where1);

                $j = 0;
                foreach ($all_student as $val1) {
                    $all_student[$j]['notification_id'] = $last_id['id'];
                    $all_student[$j]['user_type'] = 'student';
                    $all_student[$j]['links'] = 'users/dashboard';
                    $all_student[$j]['read'] = 0;
                    $all_student[$j]['date'] = $from;
                    unset($all_student[$j]['email_id']);
                    $j++;
                }
                $this->notification_model->insert_all_staff($all_student);
            }
        } else {
            if ($ins_data['group'] != '') {
                $where = array('depart_id' => $ins_data['department'], 'group_id' => $ins_data['group']);
                $where1 = array('depart_id' => $ins_data['department'], 'group_id' => $ins_data['group']);
            } else {
                $where = array('depart_id' => $ins_data['department']);
                $where1 = array('depart_id' => $ins_data['department']);
            }
            if ($ins_data['notice_to'] == 2 || $ins_data['notice_to'] == 3) {
                $all_staff = $this->notification_model->get_all_staff_notice($where);
                $i = 0;
                foreach ($all_staff as $val1) {
                    $all_staff[$i]['notification_id'] = $last_id['id'];
                    $all_staff[$i]['user_type'] = 'staff';
                    $all_staff[$i]['links'] = 'admin/notice';
                    $all_staff[$i]['read'] = 0;
                    $all_staff[$i]['date'] = $from;
                    $i++;
                }
                $this->notification_model->insert_all_staff($all_staff);
            }
            if ($ins_data['notice_to'] == 1 || $ins_data['notice_to'] == 3) {
                $all_student = $this->notification_model->get_all_student($where1);
                $j = 0;
                foreach ($all_student as $val1) {
                    $all_student[$j]['notification_id'] = $last_id['id'];
                    $all_student[$j]['user_type'] = 'student';
                    $all_student[$j]['links'] = 'users/dashboard';
                    $all_student[$j]['read'] = 0;
                    $all_student[$j]['date'] = $from;
                    unset($all_student[$j]['email_id']);
                    $j++;
                }
                $this->notification_model->insert_all_staff($all_student);
            }
        }

        redirect($this->config->item('base_url') . 'admin/notice');
    }

    public function delete_notice() {
        $this->load->model('admin/admin_model');
        $this->load->model('assignment/assignment_model');
        $notice_id = $this->input->post('nid');
        $this->admin_model->delete_notice($notice_id);
        $data["department"] = $this->assignment_model->get_department();
        $data["notice"] = $this->admin_model->get_notice();
        echo $this->load->view('notice_list', $data);
    }

    public function download_db() {
        $this->load->dbutil();

        $prefs = array(
            'format' => 'sql',
            'ignore' => array('group'),
            'filename' => 'my_db_backup.sql'
        );


        $backup = & $this->dbutil->backup($prefs);

        $db_name = 'backup-on-' . date("Y-m-d-H-i-s") . '.sql';
        $save = $this->config->item("base_url") . 'backup/' . $db_name;

        $this->load->helper('file');
        write_file($save, $backup);


        $this->load->helper('download');
        force_download($db_name, $backup);
    }

    public function test() {
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment; filename=\"export_" . date("Y-m-d") . ".xls\"");
        header("Content-Transfer-Encoding: binary");
        header("Pragma: no-cache");
        header("Expires: 0");
    }

    public function view_all_notification() {
        $this->load->model('api/notification_model');
        $user_det = $this->session->userdata('logged_in');
        $data['unread_notification'] = $this->notification_model->get_unread_notification1($user_det['user_id'], $user_det['staff_type']);
        //print_r($data['unread_notification']); exit;
        $this->template->write_view('content', 'admin/view_all_notification', $data);
        $this->template->render();
    }

    public function get_group() {
        $this->load->model('assignment/assignment_model');

        $dep_id = $this->input->post('dep');

        $g_array = $this->assignment_model->get_group($dep_id);

        $g_select = '<select id="group_id" name="group_id" class="mandatory1 group_id"><option value="">Select Section</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select> <span style="color:red;" id="group_error" class="errormessage"></span>';

        echo $g_select;
    }

    public function update_fees_name() {
        $this->load->model('admin/admin_model');
        $id_fee = $this->input->get('value1');
        $input = array('fees_name' => $this->input->get('value2'), 'status' => $this->input->get('value3'));
        //print_r($input); exit;
        $t = $this->admin_model->update_fees($input, $id_fee);
        $data['fee_name'] = $this->admin_model->get_fees_name();
        $this->template->write_view('content', 'admin/view_all_notification', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */