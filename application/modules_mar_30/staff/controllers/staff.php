<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staff extends MX_Controller {

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
        $this->load->library('email');

        $this->load->library('form_validation');
        $this->load->model('master/master_model');
        $user_det = $this->session->userdata('logged_in');
        if ($user_det['staff_type'] != 'admin')
            redirect($this->config->item('base_url') . 'admin/index');
    }

    public function index() {
        $this->load->model('staff/staff_model');
        $data['staff_type'] = $this->staff_model->get_all_staff_type();
        $data['all_staff'] = $this->staff_model->get_all_staff();
        $data['all_department'] = $this->staff_model->department();

        //echo "<pre>"; print_r($data['staff_type']); exit;
        $this->template->write_view('content', 'staff/index', $data);
        $this->template->render();
    }

    public function add_staff() {
        $this->load->model('group/group_model');
        $this->load->model('staff/staff_model');
        $data['staff_type'] = $this->staff_model->get_all_staff_type();
        if ($this->input->post()) {
            $this->load->helper('text');

            $config['upload_path'] = './profile_image/staff/orginal';

            $config['allowed_types'] = '*';

            $config['max_size'] = '2000';

            $this->load->library('upload', $config);

            $input_data = $this->input->post();

//			$this->load->library('email');
//			$data['title']='[iBoard] Account registration';
//			$this->email->from('noreply@email.com', 'iBoard');
//			$this->email->to($input_data['staff']['email_id']);
//			$this->email->subject('[iBoard] Account registration');
//			$this->email->set_mailtype("html");
//			$input_data1['student']=array('name'=>$input_data['staff']['staff_name'],'email_id'=>$input_data['staff']['email_id'],'pwd'=>$input_data['staff']['pwd']);
//
//			$msg = $this->load->view('student/registration_email',$input_data1,TRUE);
//			$this->email->message($msg);
//			$this->email->send();



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
                    $dest = getcwd() . "/profile_image/staff/thumb/" . $upload_data['file_name'];
                    $src = $this->config->item("base_url") . 'profile_image/staff/orginal/' . $upload_data['file_name'];
                    $this->make_thumb($src, $dest, 50);
                }
            }
            if ($upload_data['file_name'] != '')
                $input_data['staff']['image'] = $upload_data['file_name'];
            else
                $input_data['staff']['image'] = 'avatar5.png';
            $input_data['staff']['pwd'] = md5($input_data['staff']['pwd']);
            $insert_id = $this->staff_model->insert_staff($input_data['staff']);
            if (isset($insert_id) && !empty($insert_id))
                $input_data['staff_details']['staff_id'] = $insert_id['id'];

            $input_data['staff_details']['dob'] = date('Y-m-d', strtotime($input_data['staff_details']['dob']));
            $input_data['staff_details']['join_date'] = date('Y-m-d', strtotime($input_data['staff_details']['join_date']));
            if (isset($input_data['staff_details']['end_date']) && !empty($input_data['staff_details']['end_date'])) {
                $input_data['staff_details']['end_date'] = date('Y-m-d', strtotime($input_data['staff_details']['end_date']));
            }

            $this->staff_model->insert_staff_details($input_data['staff_details']);
            if (isset($input_data['qualification']['exam']) && !empty($input_data['qualification']['exam'])) {
                foreach ($input_data['qualification']['exam'] as $key => $val) {
                    if (!empty($val)) {
                        $q_array = array('person_id' => $insert_id['id'], 'type' => 2, 'examination' => $input_data['qualification']['exam'][$key], 'borad' => $input_data['qualification']['borad'][$key], 'percentage' => $input_data['qualification']['per'][$key], 'p_year' => $input_data['qualification']['pass'][$key]);
                        $this->staff_model->insert_qualification($q_array);
                    }
                }
            }
            redirect($this->config->item('base_url') . 'staff/');
        }
        $data['all_depart'] = $this->group_model->get_all_department();
        $data['all_design'] = $this->staff_model->get_all_designation();
        $this->template->write_view('content', 'staff/add_staff', $data);
        $this->template->render();
    }

    function view_staff($id) {
        $this->load->model('staff/staff_model');
        $data['staff_info'] = $this->staff_model->view_all_staff_details($id);
        if (isset($data['staff_info']) && !empty($data['staff_info'])) {
            $this->template->write_view('content', 'staff/view_staff', $data);
            $this->template->render();
        } else {
            redirect($this->config->item('base_url') . 'staff/');
        }
    }

    function update_staff($id) {
        $this->load->model('staff/staff_model');
        $this->load->model('group/group_model');
        $data['all_depart'] = $this->group_model->get_all_department();
        $data['all_design'] = $this->staff_model->get_all_designation();

        $data['staff_type'] = $this->staff_model->get_all_staff_type();
        if ($this->input->post()) {
            $this->load->helper('text');

            $config['upload_path'] = './profile_image/staff/orginal';

            $config['allowed_types'] = '*';

            $config['max_size'] = '2000';

            $this->load->library('upload', $config);

            $input_data = $this->input->post();
            $upload_data['file_name'] = '';
            if (isset($_FILES) && !empty($_FILES)) {
                $upload_files = $_FILES;
                if ($upload_files['staff_image']['name'] != '') {
                    $_FILES['staff_image'] = array(
                        'name' => $upload_files['staff_image']['name'],
                        'type' => $upload_files['staff_image']['type'],
                        'tmp_name' => $upload_files['staff_image']['tmp_name'],
                        'error' => $upload_files['staff_image']['error'],
                        'size' => '2000'
                    );
                    $this->upload->do_upload("staff_image");
                    $upload_data = $this->upload->data();
                    $dest = getcwd() . "/profile_image/staff/thumb/" . $upload_data['file_name'];
                    $src = $this->config->item("base_url") . 'profile_image/staff/orginal/' . $upload_data['file_name'];
                    $this->make_thumb($src, $dest, 50);
                }
            }
            if ($upload_data['file_name'] != '')
                $input_data['staff']['image'] = $upload_data['file_name'];
            if ($input_data['staff']['pwd'] == '')
                unset($input_data['staff']['pwd']);
            else {
                //Email notification
//                $user_det = $this->session->userdata('logged_in');
//                $this->load->library('email');
//                $data['title'] = '[iBoard] Password Changed';
//                $this->email->from('noreply@email.com', 'iBoard');
//                $this->email->to($input_data['staff']['email_id']);
//                $this->email->subject('[iBoard] Password Changed');
//                $this->email->set_mailtype("html");
//                $input_data['student'] = array('name' => $input_data['staff']['staff_name'], 'created_by' => $user_det['name'], 'pwd' => $input_data['staff']['pwd'], 'type' => 'college');
//                $msg = $this->load->view('admin/password_change_email', $input_data, TRUE);
//                $this->email->message($msg);
//                $this->email->send();

                $input_data['staff']['pwd'] = md5($input_data['staff']['pwd']);
            }
            $insert_id = $this->staff_model->update_staff($input_data['staff'], $id);

            $input_data['staff_details']['dob'] = date('Y-m-d', strtotime($input_data['staff_details']['dob']));
            $input_data['staff_details']['join_date'] = date('Y-m-d', strtotime($input_data['staff_details']['join_date']));
            $input_data['staff_details']['end_date'] = date('Y-m-d', strtotime($input_data['staff_details']['end_date']));

            $this->staff_model->update_staff_details($input_data['staff_details'], $id);
            $this->staff_model->delete_qualification_by_id($id);
            if (isset($input_data['qualification']['exam']) && !empty($input_data['qualification']['exam'])) {
                foreach ($input_data['qualification']['exam'] as $key => $val) {
                    if (!empty($val)) {
                        $q_array = array('person_id' => $id, 'type' => 2, 'examination' => $input_data['qualification']['exam'][$key], 'borad' => $input_data['qualification']['borad'][$key], 'percentage' => $input_data['qualification']['per'][$key], 'p_year' => $input_data['qualification']['pass'][$key]);
                        $this->staff_model->insert_qualification($q_array);
                    }
                }
            }
            redirect($this->config->item('base_url') . 'staff/');
        }

        $data['staff_info'] = $this->staff_model->view_all_staff_details($id);
        if (isset($data['staff_info']) && !empty($data['staff_info'])) {
            $this->template->write_view('content', 'staff/edit_staff', $data);
            $this->template->render();
        } else {
            redirect($this->config->item('base_url') . 'staff/');
        }
    }

    function delete_staff($id) {
        $this->load->model('staff/staff_model');
        $update_data = array('status' => 0, 'df' => 1);
        $this->staff_model->delete_staff($update_data, $id);
        redirect($this->config->item('base_url') . 'staff/');
    }

    function checking_email_insert() {
        $this->load->model('staff/staff_model');

        $email = $this->input->post('value1');

        $data = $this->staff_model->email_checking_insert($email);

        $i = 0;
        if ($data) {
            $i = 1;
        }

        if ($i == 1) {
            echo "Email ID is already exist";
        } else {

        }
    }

    function checking_email_update() {
        $this->load->model('staff/staff_model');
        $s_id = $this->input->post('value2');

        $email = $this->input->post('value1');
        $data = $this->staff_model->checking_email_update($s_id, $email);
        $i = 0;
        if ($data) {
            $i = 1;
        }

        if ($i == 1) {
            echo "Email ID is already exist";
        }
    }

    function checking_staffid_insert() {
        $this->load->model('staff/staff_model');

        $staff_id = $this->input->post('staff_id');

        $data = $this->staff_model->checking_staffid_insert($staff_id);
        $i = 0;
        if ($data) {
            $i = 1;
        }

        if ($i == 1) {
            echo "Staff ID is already exist";
        } else {

        }
    }

    function checking_staffid_update() {
        $this->load->model('staff/staff_model');
        $id = $this->input->post('value2');
        $staff_id = $this->input->post('value1');
        $data = $this->staff_model->checking_staffid_update($id, $staff_id);
        //print_r($data); exit;

        $i = 0;
        if ($data) {
            $i = 1;
        }

        if ($i == 1) {
            echo "Staff ID is already exist";
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

    function select_all_staff() /* THIS IS FOR GETTING ALL THE STAFF LIST */ {
        $this->load->model('staff/staff_model');
        $data['staf_det'] = $this->staff_model->select_all_staff();

        $this->template->write_view('content', 'staff_class/index', $data);
        $this->template->render();

        /* echo '<pre>';
          print_r($data);
          exit; */
    }

    function get_depat_staff() {

        $this->load->model('staff/staff_model');
        $d_id = $this->input->post('depart_id');
        $data['staff'] = $this->staff_model->staff_depart_wise($d_id);

        echo $this->load->view('staff_view', $data);
    }

    function get_depat_staff_all() {

        $this->load->model('staff/staff_model');
        $d_id = $this->input->post('depart_id');
        $data['staff'] = $this->staff_model->staff_depart_wise_all($d_id);

        echo $this->load->view('staff_view', $data);
    }

    function get_depat_staff_all_type() {

        $this->load->model('staff/staff_model');
        $d_id = $this->input->post('depart_id');
        $staff_type = $this->input->post('staff_type');
        $data['staff'] = $this->staff_model->staff_depart_wise_all_type($d_id, $staff_type);

        echo $this->load->view('staff_view', $data);
    }

    function get_staff_depat_type1() {

        $this->load->model('staff/staff_model');
        $d_id = $this->input->post('depart_id');
        $staff_type = $this->input->post('staff_type');

        $data['staff'] = $this->staff_model->get_staff_depat_type1($d_id, $staff_type);

        echo $this->load->view('staff_view', $data);
    }

    function import_staff() {
        $this->load->model('staff/staff_model');
        $this->load->model('student/student_model');
        if ($this->input->post()) {
            $is_success = 0;
            if (!empty($_FILES['staff_data'])) {
                $config['upload_path'] = './attachement/staff/';
                $config['allowed_types'] = '*';
                $config['max_size'] = '10000';
                $this->load->library('upload', $config);
                $random_hash = substr(str_shuffle(time()), 0, 3) . strrev(mt_rand(100000, 999999));
                $extension = pathinfo($_FILES['staff_data']['name'], PATHINFO_EXTENSION);
                $new_file_name = 'staff_' . $random_hash . '.' . $extension;
                $_FILES['staff_data'] = array(
                    'name' => $new_file_name,
                    'type' => $_FILES['staff_data']['type'],
                    'tmp_name' => $_FILES['staff_data']['tmp_name'],
                    'error' => $_FILES['staff_data']['error'],
                    'size' => $_FILES['staff_data']['size']
                );
                $config['file_name'] = $new_file_name;
                $this->upload->initialize($config);

                $this->upload->do_upload('staff_data');
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
                $file = base_url() . 'attachement/staff/' . $file_name;
                $handle = fopen($file, 'r');
                if ($file != NULL) {
                    while ($row_data = fgetcsv($handle)) {
                        $name = $row_data[0];
                        $staff_id = $row_data[1];
                        $gender = $row_data[2];
                        $doj = $row_data[3];
                        $class = $row_data[4];
                        $designation = $row_data[5];
                        $staff_type = $row_data[6];
                        $email = $row_data[7];
                        $password = $row_data[8];
                        $dob = $row_data[9];
                        $mobile = $row_data[10];
                        $address = $row_data[11];
                        $state = $row_data[12];
                        $country = $row_data[13];
                        $postal_code = $row_data[14];
                        $depart_id = $this->staff_model->get_all_depart_id_by_name($class);
                        $desig_id = $this->staff_model->get_all_designation_id_by_name($designation);
                        $staff_type_id = $this->staff_model->get_staff_type_id_by_name($staff_type);

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
                        if (empty($desig_id)) {
                            $desg_details = array(
                                'department' => $designation,
                                'ldt' => date('Y-m-d H:i:s'),
                                'df' => 0,
                                'status' => 1
                            );
                            $desig_id = $this->staff_model->insert_designation($desg_details);
                            $desig_id = $desig_id['id'];
                        }
                        if (empty($staff_type_id)) {
                            $staff_type_details = array(
                                'staff_type' => $staff_type,
                                'created_date' => date('Y-m-d H:i:s'),
                                'statu_s' => 1
                            );
                            $staff_type_id = $this->staff_model->insert_staff_type($staff_type_details);
                            $staff_type_id = $staff_type_id['id'];
                        }


                        if ($name != '') {
                            $staff_data = array(
                                'staff_name' => $name,
                                'staff_id' => $staff_id,
                                'email_id' => $email,
                                'pwd' => md5($password),
                                'mobile_no' => $mobile,
                                'depart_id' => $depart_id,
                                'designation_id' => $desig_id,
                                'staff_type_id' => $staff_type_id,
                                'df' => 0,
                                'online_status' => 0,
                            );
                            //$insert_user = array('username' => $name, 'password' => md5($password), 'email' => $parent_email);
                            $insert_id = $this->staff_model->insert_staff($staff_data);

                            if (isset($insert_id) && !empty($insert_id)) {
                                $staff_details = array(
                                    'address' => $address,
                                    'join_date' => date('Y-m-d', strtotime($doj)),
                                    'state' => $state,
                                    'country' => $country,
                                    'postal_code' => $postal_code,
                                    'dob' => date('Y-m-d', strtotime($dob)),
                                    'gender' => $gender,
                                    'staff_id' => $insert_id['id'],
                                );
                                $this->staff_model->insert_staff_details($staff_details);
                            }
                        }
                    }
                }
                $is_success = 1;
            }
            if ($is_success) {
                redirect($this->config->item('base_url') . 'staff');
            }
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
