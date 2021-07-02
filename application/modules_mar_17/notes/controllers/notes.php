<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notes extends MX_Controller {

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
        $user_det = $this->session->userdata('logged_in');
        $permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
        if ($permission[0]['sharing_note'] == 0)
            redirect($this->config->item('base_url') . 'admin/index');
    }

    public function index() {
        $this->load->model('notes_model');
        $data['all_department'] = $this->notes_model->department();
        $data['all_group'] = $this->notes_model->group();
        $data['all_subject'] = $this->notes_model->subject();
        $data['all_semester'] = $this->notes_model->semester();
        $data['all_batch'] = $this->notes_model->batch();
        $user_det = $this->session->userdata('logged_in');
        $data['list'] = $this->notes_model->get_all_notes($user_det);
        $data['batch'] = $this->batch_model->get_default_batch();
        $data['term'] = $this->subject_model->get_default_term();
        //echo "<pre>"; print_r($data['list']); exit;
        $this->template->write_view('content', 'notes/index', $data);
        $this->template->render();
    }

    public function insert_notes() {
        $this->load->model('notes_model');
        $this->load->model('api/notification_model');
        $user_det = $this->session->userdata('logged_in');
        if ($this->input->post()) {
            $this->load->helper('text');

            $config['upload_path'] = './profile_image/notes/original';

            $config['allowed_types'] = '*';

            $config['max_size'] = '200000';

            $this->load->library('upload', $config);

            $upload_data['file_name'] = '';

            if (isset($_FILES) && !empty($_FILES)) {
                $upload_files = $_FILES;
                if ($upload_files['notes_image']['name'] != '') {
                    $_FILES['notes_share'] = array(
                        'name' => $upload_files['notes_image']['name'],
                        'type' => $upload_files['notes_image']['type'],
                        'tmp_name' => $upload_files['notes_image']['tmp_name'],
                        'error' => $upload_files['notes_image']['error'],
                        'size' => '2000'
                    );
                    $this->upload->do_upload('notes_image');

                    $upload_data = $this->upload->data();
                }
            }


            if ($upload_data['file_name'] != '')
                $input_data['notes']['image'] = $upload_data['file_name'];
            else
                $input_data['notes']['image'] = 'avatar.jpg';
            $input_post = $this->input->post();
            //echo "<pre>"; print_r($input_post['student_group']['group_id']); exit;
            $input = array('subject_id' => $input_post['student_subject'], 'note_title' => $input_post['notes'],
                'depart_id' => $input_post['student_depart'], 'group_id' => $input_post['student_group']['group_id'],
                'image' => $upload_data['file_name'], 'created_user' => $input_post['user'], 'modified_user' => $input_post['user'],
                'batch' => $input_post['batch'], 'semester' => $input_post['semester'],
                'staff_type' => $user_det['staff_type']);

            //$input['group_id']=$input['group_id']['group_id'];
            //$input['subject_id']=$input['subject_id']['subject_id'];
            //echo "<pre>"; print_r($input); exit;
            $this->notes_model->insert_notes($input);

            $g = $this->input->post('student_group');


            $title = 'Notes Added';
            $session_data = $this->session->userdata('logged_in');
            $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
            $last_id = $this->notification_model->insert_notification($insert_not);


            if ($g['group_id'] != 0) {
                $where1 = array('student_group.batch_id' => $this->input->post('batch'), 'student_group.depart_id' => $this->input->post('student_depart'), 'student_group.group_id' => $g['group_id']);
                $all_student = $this->notification_model->get_all_student($where1);
                $where2 = array('student_group.batch_id' => $this->input->post('batch'), 'student_group.depart_id' => $this->input->post('student_depart'), 'student_group.group_id' => $g['group_id']);
            } else {
                $where1 = array('student_group.batch_id' => $this->input->post('batch'), 'student_group.depart_id' => $this->input->post('student_depart'));
                $all_student = $this->notification_model->get_all_student($where1);
                $where2 = array('student_group.batch_id' => $this->input->post('batch'), 'student_group.depart_id' => $this->input->post('student_depart'));
            }
            //Time table mail template updated

            $all_student_for_email = $this->notification_model->get_all_student_for_email($where2);
            $links1 = 'users/share_notes_view';
//            $this->load->library('email');
//            foreach ($all_student_for_email as $val1) {
//                $data['title'] = '[iBoard] Notes Added';
//                $this->email->from('noreply@email.com', 'iBoard');
//                $this->email->to($val1['email_id']);
//                $this->email->subject('[iBoard] Notes Added');
//                $this->email->set_mailtype("html");
//                $input_data['student'] = array('name' => $val1['name'], 'created_by' => $session_data['name'], 'time_table_type' => 'other_time_table', 'staff_type' => 'student', 'links' => $links1, 'title' => $title);
//                $msg = $this->load->view('time_table/time_table_email_formate', $input_data, TRUE);
//                $this->email->message($msg);
//                $this->email->send();
//            }
            $j = 0;
            foreach ($all_student as $val1) {
                $all_student[$j]['notification_id'] = $last_id['id'];
                $all_student[$j]['user_type'] = 'student';
                $all_student[$j]['links'] = 'users/share_notes_view';
                $all_student[$j]['read'] = 0;
                unset($all_student[$j]['email_id']);
                $j++;
            }
            $this->notification_model->insert_all_staff($all_student);



            redirect($this->config->item('base_url') . 'notes/');
        }
    }

    public function get_all_group() {
        $this->load->model('notes_model');
        $data['all_subject'] = $this->notes_model->subject();
        $data['all_department'] = $this->notes_model->department();
        $data['all_group'] = $this->notes_model->group();
        $d_id = $this->input->post();
        $g_array = $this->notes_model->get_all_group($d_id['depart_id']);
        $g_select = '<td width="143">Section</td><td width="5%"><select id="group" name="student_group[group_id]" class="group mandatory" ><option value="">Select Section</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select></td><td>&nbsp;</td>';
        echo $g_select;
    }

    public function get_all_sub() {
        $this->load->model('notes_model');
        $dep = $this->input->post('value1');
        $grp = $this->input->post('value2');
        $sem = $this->input->post('value3');
        $bat = $this->input->post('value4');
        $sub_array = $this->notes_model->get_all_subject($dep, $grp, $sem, $bat);
        //echo "<pre>"; print_r($sub_array); exit;
        $sub_select = '<td width="147">Subject</td><td width=""><select id="subject_id" name="student_subject"  class="subject mandatory" ><option value="">Select Subject</option>';
        if (isset($sub_array) && !empty($sub_array)) {
            foreach ($sub_array as $val) {
                $sub_select = $sub_select . "<option value='" . $val['id'] . "'>" . $val['subject_name'] . "</option>";
            }
        }
        $sub_select = $sub_select . '</select></td><td></td><td></td>';
        echo $sub_select;
    }

    public function delete_notes() {

        $this->load->model('notes/notes_model');
        $id = $this->input->post('value1');
        $this->notes_model->delete_notes($id);
        $user_det = $this->session->userdata('logged_in');
        $data["list"] = $this->notes_model->get_all_notes($user_det);
        echo $this->load->view('view_list', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
