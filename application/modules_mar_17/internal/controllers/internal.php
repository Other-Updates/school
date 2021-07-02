<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Internal extends MX_Controller {

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
        $user_det = $this->session->userdata('logged_in');
        $this->load->model('master/master_model');
        $this->load->model('batch/batch_model');
        $this->load->model('subject/subject_model');
        $this->load->model('group/group_model');
        $this->load->model('student/student_model');
        $this->load->model('staff/staff_model');
        $this->load->model('semester/semester_model');
        $this->load->model('internal/internal_model');
        $this->load->model('exam/exam_model');
        $permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
        if ($permission[0]['internal_mark'] == 0)
            redirect($this->config->item('base_url') . 'admin/index');
    }

    public function internal_exam() {
        $this->load->model('group/group_model');
        $this->load->model('student/student_model');
        $this->load->model('staff/staff_model');
        $this->load->model('semester/semester_model');
        $this->load->model('subject/subject_model');
        $user_det = $this->session->userdata('logged_in');
        if ($user_det['staff_type'] == 'admin') {
            //$data['all_batch'] =$this->student_model->get_all_batch();
            $data['all_depart'] = $this->group_model->get_all_department();
            //$data['all_semester']=$this->semester_model->get_semester();
            $data['batch'] = $this->batch_model->get_default_batch();
            $data['term'] = $this->subject_model->get_default_term();
        } else {
            //$data['all_batch'] =$this->subject_model->get_all_batch1($this->user_auth->get_user_id());
            $data['batch'] = $this->batch_model->get_default_batch();
        }
        $this->template->write_view('content', 'internal/internal', $data);
        $this->template->render();
    }

    public function external() {
        $this->template->write_view('content', 'internal/external');
        $this->template->render();
    }

    public function assignment() {
        $this->load->model('group/group_model');
        $this->load->model('student/student_model');
        $this->load->model('staff/staff_model');
        $this->load->model('semester/semester_model');
        //$data['all_batch'] = $this->student_model->get_all_batch();
        $data['all_depart'] = $this->group_model->get_all_department();
        // $data['all_semester'] = $this->semester_model->get_semester();
        $data['batch'] = $this->batch_model->get_default_batch();
        $data['term'] = $this->subject_model->get_default_term();
        $this->template->write_view('content', 'internal/assignment', $data);
        $this->template->render();
    }

    public function attendence() {
        $this->template->write_view('content', 'internal/attendence');
        $this->template->render();
    }

    public function check_internal() {
        $this->load->model('internal/internal_model');
        $this->load->model('student/student_model');
        $data['ajax_val'] = $this->input->post();
        $datas['ajax_val'] = $this->input->post();
        $datas['all_info'] = $this->internal_model->check_internal($data['ajax_val']);
        $data['ajax_val']['int_id'] = $datas['all_info'][0]['id'];
        // $datas['mark_details'] = $this->internal_model->check_internal($data['ajax_val']);
        $data['mark_details'] = $this->internal_model->subject_internal($data['ajax_val']);
        $datas['mark_details'] = $this->internal_model->subject_internal($data['ajax_val']);
        $this->load->model('admin/admin_model');
        $data['mark_info'] = $this->admin_model->get_internal_details();
        if (isset($datas['all_info']) && !empty($datas['all_info'])) {
            $datas['mark_info'] = $this->admin_model->get_internal_details();
            $datas['all_student'] = $this->student_model->get_student_group_by_all_id($data['ajax_val']);
            $datas['ajax_val']['int_id'] = $datas['all_info'][0]['id'];

            echo $this->load->view('internal/update_internal_table', $datas);
        } else {
//            echo '<pre>';
//            print_r($datas);
//            exit;
            $data['all_student'] = $this->student_model->get_student_group_by_all_id($data['ajax_val']);
            echo $this->load->view('internal/create_internal_table', $data);
        }
    }

    public function internal_print($b_id, $d_id, $g_id, $sub_id, $sem_id, $int_id) {
        $this->load->model('internal/internal_model');
        $this->load->model('student/student_model');
        $this->load->model('admin/admin_model');
        $insert = array(
            'batch_id' => $b_id,
            'depart_id' => $d_id,
            'group_id' => $g_id,
            'subject_id' => $sub_id,
            'semester' => $sem_id
        );
        $insert1 = array(
            'select_batch' => $b_id,
            'depart_id' => $d_id,
            'group_id' => $g_id,
            'subject' => $sub_id,
            'select_sem' => $sem_id,
            'int_id' => $int_id
        );
        $datas['ajax_val'] = $insert1;
        $datas['mark_info'] = $this->admin_model->get_internal_details();
        $datas['all_info'] = $this->internal_model->check_internal_for_print($insert);
        $datas['all_student'] = $this->student_model->get_student_group_by_all_id_for_print($insert1);
        $this->template->write_view('content', 'internal/view_internal_print', $datas);
        $this->template->render();
    }

    public function get_all_subject() {
        $this->load->model('time_table/time_table_model');
        $data['ajax_val'] = $this->input->post();
        $data['all_subject'] = $this->time_table_model->get_subject_by_id($data['ajax_val']['select_batch'], $data['ajax_val']['depart_id'], $data['ajax_val']['group_id'], $data['ajax_val']['select_sem']);

        $g_select = '<select id="subject_id" ><option value="0">Select</option>';
        if (isset($data['all_subject']) && !empty($data['all_subject'])) {
            foreach ($data['all_subject'] as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['subject_name'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    function add_internal() {
        $input = $this->input->POST();

        $this->load->model('api/notification_model');
        $this->load->model('subject/subject_model');
        $data['ajax_val'] = $this->input->get();
        $subject = $this->subject_model->get_subject_by_id($data['ajax_val']['subject']);
        $title = 'Subject:' . $subject[0]['subject_name'] . '-Internal Mark Added';
        $session_data = $this->session->userdata('logged_in');
        $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);
        $last_id = $this->notification_model->insert_notification($insert_not);

        $where1 = array('batch_id' => $data['ajax_val']['select_batch'], 'depart_id' => $data['ajax_val']['depart_id'], 'group_id' => $data['ajax_val']['group_id']);


        /* //Time table mail template updated
          $where1=array('student_group.batch_id'=>$data['ajax_val']['select_batch'],'student_group.depart_id'=>$data['ajax_val']['depart_id'],'student_group.group_id'=>$data['ajax_val']['group_id']);
          $all_student_for_email=$this->notification_model->get_all_student_for_email($where1);
          $this->load->library('email');
          foreach($all_student_for_email as $val1)
          {

          $data['title']='[iBoard] Mark Details Added';
          $this->email->from('noreply@email.com', 'iBoard');
          $this->email->to($val1['email_id']);
          $this->email->subject('[iBoard] Mark Details Added');
          $this->email->set_mailtype("html");
          $links='users/internals';
          $input_data['student']=array('name'=>$val1['name'],'created_by'=>$session_data['name'],'time_table_type'=>'mark_details','staff_type'=>'student','links'=>$links);
          $msg = $this->load->view('time_table/time_table_email_formate',$input_data,TRUE);
          $this->email->message($msg);
          $this->email->send();
          }

          $all_student=$this->notification_model->get_all_student($where1);
          $j=0;
          foreach($all_student as $val1)
          {
          $all_student[$j]['notification_id']=$last_id['id'];
          $all_student[$j]['user_type']='student';
          $all_student[$j]['links']='users/internals';
          $all_student[$j]['read']=0;
          unset($all_student[$j]['email_id']);
          $j++;
          }
          $this->notification_model->insert_all_staff($all_student);

         */


        $insert_info = array("batch_id" => $input['select_batch'], "depart_id" => $input['depart_id'], "group_id" => $input['group_id'], "semester" => $input['select_sem'], "subject_id" => $input['subject'], "internal_total" => $input['int_total_val'], "model_total" => $input['model_total_val'], "created_by" => $this->user_auth->get_user_id());
        $this->load->model('internal/internal_model');
        $insert_id = $this->internal_model->insert_all_val($insert_info);
        foreach ($input['student_details'] as $val) {
            $fullval = explode("-", $val);
            $insert_details = array('std_id' => $fullval[0], 'internals' => $fullval[7], 'internals_total' => $fullval[2], 'model' => $fullval[1], 'model_total' => $fullval[3], 'assignment' => $fullval[4], 'attendance' => $fullval[5], 'total' => $fullval[6], 'internal_id' => $insert_id['id'], 'modified' => $this->user_auth->get_user_id());
            $this->internal_model->insert_internal_details($insert_details);
        }
    }

    function update_internal() {
        $input = $this->input->POST();
        $data['ajax_val'] = $this->input->get();
        $this->load->model('api/notification_model');
        $this->load->model('subject/subject_model');
        $subject = $this->subject_model->get_subject_by_id($data['ajax_val']['subject']);
        /* $title='Subject:'.$subject[0]['subject_name'].'-Internal Mark Updated';
          $session_data=$this->session->userdata('logged_in');
          $insert_not=array('notification'=>$title,'user_type'=>$session_data['staff_type'],'user_id'=>$session_data['user_id'],'name'=>$session_data['name']);
          $last_id=$this->notification_model->insert_notification($insert_not);

          $where1=array('batch_id'=>$data['ajax_val']['select_batch'],'depart_id'=>$data['ajax_val']['depart_id'],'group_id'=>$data['ajax_val']['group_id']);
          $all_student=$this->notification_model->get_all_student($where1); */

        /* //Time table mail template updated
          $where1=array('student_group.batch_id'=>$data['ajax_val']['select_batch'],'student_group.depart_id'=>$data['ajax_val']['depart_id'],'student_group.group_id'=>$data['ajax_val']['group_id']);
          $all_student_for_email=$this->notification_model->get_all_student_for_email($where1);
          $this->load->library('email');

          foreach($all_student_for_email as $val1)
          {
          $data['title']='[iBoard] Mark Details Updated';
          $this->email->from('noreply@email.com', 'iBoard');
          $this->email->to($val1['email_id']);
          $this->email->subject('[iBoard] Mark Details Updated');
          $this->email->set_mailtype("html");
          $links='users/internals';
          $input_data['student']=array('name'=>$val1['staff_name'],'created_by'=>$session_data['name'],'time_table_type'=>'mark_details','staff_type'=>'student','links'=>$links);
          $msg = $this->load->view('time_table/time_table_email_formate',$input_data,TRUE);
          $this->email->message($msg);
          $this->email->send();
          }

          $j=0;
          foreach($all_student as $val1)
          {
          echo $all_student[$j]['email_id'];
          $all_student[$j]['notification_id']=$last_id['id'];
          $all_student[$j]['user_type']='student';
          $all_student[$j]['links']='users/internals';
          $all_student[$j]['read']=0;
          unset($all_student[$j]['email_id']);
          $j++;
          }
          $this->notification_model->insert_all_staff($all_student);
         */

        $insert_info = array("batch_id" => $input['select_batch'], "depart_id" => $input['depart_id'], "group_id" => $input['group_id'], "semester" => $input['select_sem'], "subject_id" => $input['subject'], "internal_total" => $input['int_total_val'], "model_total" => $input['model_total_val'], "created_by" => $this->user_auth->get_user_id());
        $this->load->model('internal/internal_model');
        $this->internal_model->update_all_val($insert_info, $input['update_id']);
        $this->internal_model->delete_all_internal_details($input['update_id']);
        foreach ($input['student_details'] as $val) {
            $fullval = '';
            $fullval = explode("-", $val);
            $insert_details = array('std_id' => $fullval[0], 'internals' => $fullval[7], 'internals_total' => $fullval[2], 'model' => $fullval[1], 'model_total' => $fullval[3], 'assignment' => $fullval[4], 'attendance' => $fullval[5], 'total' => $fullval[6], 'internal_id' => $input['update_id'], 'modified' => $this->user_auth->get_user_id(), 'exam_mark' => $fullval[8]);

            $this->internal_model->insert_internal_details($insert_details);
        }
    }

    public function update_complete_status() {
        $this->load->model('internal/internal_model');
        $data = array('complete_status' => 1);
        $update_id = $this->internal_model->update_all_val($data, $this->input->POST('batch_id'));
    }

    public function update_complete_status1() {
        $this->load->model('internal/internal_model');
        $data = array('complete_status' => 2);
        $update_id = $this->internal_model->update_all_val($data, $this->input->POST('batch_id'));
    }

    public function internal_exam_result() {
        $this->load->model('group/group_model');
        $this->load->model('student/student_model');
        $this->load->model('staff/staff_model');
        $this->load->model('semester/semester_model');
        $this->load->model('subject/subject_model');
        $this->load->model('internal/internal_model');

        $user_det = $this->session->userdata('logged_in');
        if ($user_det['staff_type'] == 'admin') {
            // $data['all_batch'] = $this->student_model->get_all_batch();
            $data['all_depart'] = $this->group_model->get_all_department();
            // $data['all_semester'] = $this->semester_model->get_semester();
            $data['batch'] = $this->batch_model->get_default_batch();
            $data['term'] = $this->subject_model->get_default_term();
            $data['all_exam'] = $this->exam_model->get_exam();
        } else {
            //$data['all_batch'] = $this->subject_model->get_all_batch1($this->user_auth->get_user_id());
            $data['batch'] = $this->batch_model->get_default_batch();
            $data['term'] = $this->subject_model->get_default_term();
            $data['all_depart'] = $this->group_model->get_all_department();
            $data['all_exam'] = $this->exam_model->get_exam();
        }


        if ($this->input->post()) {
            $input_data = $this->input->post();

            if (isset($input_data['update_page']) && !empty($input_data['update_page'])) {
                $this->internal_model->delete_external_details($input_data['update_page']);
                $i = 0;
                if (isset($input_data['grate_point']) && !empty($input_data['grate_point'])) {
                    foreach ($input_data['grate_point'] as $std_id => $val) {
                        foreach ($val as $subject_id => $grade) {
                            $insert_data1[$i]['external_id'] = $input_data['update_page'];
                            $insert_data1[$i]['std_id'] = $std_id;
                            $insert_data1[$i]['subject_id'] = $subject_id;
                            $insert_data1[$i]['grade_point'] = $grade;
                            $insert_data1[$i]['practical_mark'] = $input_data['practical_mark'][$std_id][$subject_id];
                            $insert_data1[$i]['total'] = $input_data['total'][$std_id];
                            $insert_data1[$i]['result'] = $input_data['result'][$std_id];
                            $i++;
                        }
                    }
                }
                $this->internal_model->insert_external_details($insert_data1);
                redirect($this->config->item('base_url') . 'internal/internal_exam_result');
            } else {

                $input_data['external']['group_id'] = $input_data['student_group']['group_id'];
                $input_data['external']['exam_id'] = $input_data['student_group']['exam_id'];
                // $input_data['external']['depart_id'] = $input_data['student_group']['depart_id'];
//                echo '<pre>';
//                print_r($input_data);
                //exit;
                $last_id = $this->internal_model->insert_external($input_data['external']);
                $i = 0;
                if (isset($input_data['grate_point']) && !empty($input_data['grate_point'])) {
                    foreach ($input_data['grate_point'] as $std_id => $val) {

                        foreach ($val as $subject_id => $grade) {
                            $insert_data[$i]['external_id'] = $last_id;
                            $insert_data[$i]['std_id'] = $std_id;
                            $insert_data[$i]['subject_id'] = $subject_id;
                            $insert_data[$i]['grade_point'] = $grade;
                            $insert_data[$i]['practical_mark'] = $input_data['practical_mark'][$std_id][$subject_id];
                            $insert_data[$i]['total'] = $input_data['total'][$std_id];
                            $insert_data[$i]['result'] = $input_data['result'][$std_id];
                            $i++;
                        }
                    }
                }
                $this->internal_model->insert_external_details($insert_data);
                redirect($this->config->item('base_url') . 'internal/internal_exam_result');
            }
        }
//        echo '<pre>';
//        print_r($data);
//        exit;
        $this->template->write_view('content', 'internal/external', $data);
        $this->template->render();
    }

    /* for excel college */

    public function get_all_student_with_subject() {
        $input = $this->input->POST();
        $this->load->model('internal/internal_model');
        $datas['all_info'] = $this->internal_model->check_external_mark($input);
        if (isset($datas['all_info']) && !empty($datas['all_info'])) {
            $data['ajax_value'] = $input;
            $data['all_grade'] = $this->internal_model->get_all_student_grade($input, NULL);
            $data['all_subject'] = $this->internal_model->get_all_subject_for_external($input);
            //  $data['all_subject'] = $this->internal_model->get_all_student_internal($input);
            //echo '<pre>';
            //print_r($data);
            //exit;
            echo $this->load->view('internal/update_external_table', $data);
        } else {
            //echo '<pre>';
            //print_r($data);
            //exit;
            $data['all_student'] = $this->internal_model->get_all_student_for_external($input);
            $data['all_subject'] = $this->internal_model->get_all_subject_for_external($input);
            echo $this->load->view('internal/create_external_table', $data);
        }
    }

    public function external_print($batch_id, $depart_id, $group_id, $semester) {
        $this->load->model('internal/internal_model');
        if (is_numeric($batch_id) && is_numeric($depart_id) && is_numeric($group_id) && is_numeric($semester)) {
            $input = array('batch_id' => $batch_id, 'depart_id' => $depart_id, 'group_id' => $group_id, 'semester' => $semester);
            $data['all_grade'] = $this->internal_model->get_all_student_grade($input);
            $data['all_subject'] = $this->internal_model->get_all_subject_for_external($input);
            $data['post_data'] = $input;
            $this->template->write_view('content', 'internal/print_external_table', $data);
            $this->template->render();
        } else {
            redirect($this->config->item('base_url') . 'internal/internal_exam_result');
        }
    }

    public function get_all_group() {
        $this->load->model('student/student_model');
        $this->load->model('subject/subject_model');
        $d_id = $this->input->post();
        $user_det = $this->session->userdata('logged_in');
        if ($user_det['staff_type'] == 'staff')
            $g_array = $this->student_model->get_all_group($d_id['depart_id']);
        else
            $g_array = $this->student_model->get_all_group($d_id['depart_id']);
        $g_select = '<select id="group_id" name="student_group[group_id]" class="mandatory" ><option value="">Select</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    public function student_report() {
        $this->load->model('group/group_model');
        $this->load->model('student/student_model');
        $this->load->model('staff/staff_model');
        $this->load->model('semester/semester_model');
        $this->load->model('subject/subject_model');
        $this->load->model('internal/internal_model');
        $user_det = $this->session->userdata('logged_in');
        //$data['all_batch'] = $this->student_model->get_all_batch();
        $data['all_depart'] = $this->group_model->get_all_department();
        // $data['all_semester'] = $this->semester_model->get_semester();
        $data['batch'] = $this->batch_model->get_default_batch();
        $data['term'] = $this->subject_model->get_default_term();
        $data['all_exam'] = $this->exam_model->get_exam();
        $this->template->write_view('content', 'internal/student_report', $data);
        $this->template->render();
    }

    public function student_report_details() {
        $this->load->model('internal/internal_model');
        $post_data = $this->input->POST();
        $input = array('batch_id' => $post_data['batch_id'], 'depart_id' => $post_data['depart_id'], 'group_id' => $post_data['group_id'], 'semester' => $post_data['semester'], 'exam_id' => $post_data['exam_id']);
        $data['all_grade'] = $this->internal_model->get_all_student_grade($input);
        $data['all_subject'] = $this->internal_model->get_all_subject_for_external($input);
        $data['from_student_report'] = 1;
        $data['post_data'] = $post_data;
        echo $this->load->view('internal/print_external_table', $data);
    }

    public function cgpa_report($batc_id, $depart_id, $group_id, $semester) {
        $this->load->model('internal/internal_model');
        $input = array('student_group.batch_id' => $batc_id, 'student_group.depart_id' => $depart_id, 'student_group.group_id' => $group_id);
        $input1 = array('batch_id' => $batc_id, 'depart_id' => $depart_id, 'group_id' => $group_id);
        $data['all_cgpa'] = $this->internal_model->get_all_cgpa($input, $input1);
        $data['all_sem'] = $this->internal_model->get_all_sem($input1);
        $data['get_info'] = $this->internal_model->get_details($input1);
        $this->template->write_view('content', 'internal/cgpa_report', $data);
        $this->template->render();
    }

    function mark_sheet($user_id) {

        $this->load->model('users/users_model');
        $this->load->model('admin/admin_model');
        $where = array('student_group.student_id' => $user_id);
        $this->load->model('internal/internal_model');
        $data['student_info'] = $this->internal_model->get_all_student_for_users($where);
        $data['all_sem'] = $this->users_model->get_created_sem_by_id1($data['student_info'][0]['batch_id'], $data['student_info'][0]['depart_id'], $data['student_info'][0]['group_id']);
        $data["university_result"] = $this->users_model->get_university_result_by_id1($data['student_info'][0]['batch_id'], $data['student_info'][0]['depart_id'], $data['student_info'][0]['group_id'], $data['student_info'][0]['std_id']);

        //echo '<pre>';
        // print_r($data);
        // exit;

        $this->template->write_view('content', 'internal/student_mark_sheet', $data);
        $this->template->render();
    }

    public function switch_over_students($batc_id, $depart_id, $group_id, $semester) {


        $new_semester_id = ($semester == 1) ? 2 : 1;
        $input = array('batch_id' => $batc_id, 'depart_id' => $depart_id, 'group_id' => $group_id, 'semester' => $semester);
        $students = $this->internal_model->get_all_student_result($input);

        if ($semester == 2) {
            $new_batch_id = $this->internal_model->get_next_batch_id($batc_id);
            $new_class_id = $this->internal_model->get_next_class_id($depart_id);
            //  $new_session_id = $this->internal_model->get_next_session_id($group_id);
        } else {
            $input_data = array('batch_id' => $batc_id, 'depart_id' => $depart_id, 'group_id' => $group_id, 'semester' => $new_semester_id);
            $last_id = $this->internal_model->insert_external($input_data);

            if (isset($students) && !empty($students)) {
                $i = 0;
                foreach ($students[0]['external_details'] as $student) {
                    if (isset($student['grade_details']) && !empty($student['grade_details'])) {
                        foreach ($student['grade_details'] as $val) {
                            $insert_data[$i]['external_id'] = $last_id;
                            $insert_data[$i]['std_id'] = $student['std_id'];
                            $insert_data[$i]['subject_id'] = '';
                            $insert_data[$i]['grade_point'] = '';
                            $insert_data[$i]['practical_mark'] = '';
                            $insert_data[$i]['total'] = '';
                            $insert_data[$i]['result'] = '';
                            $i++;
                        }
                        $this->internal_model->insert_external_details($insert_data);
                        redirect($this->config->item('base_url') . 'internal/internal_exam_result');
                    }
                }
            }
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
