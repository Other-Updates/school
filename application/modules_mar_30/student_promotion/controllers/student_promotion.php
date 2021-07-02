<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student_promotion extends MX_Controller {

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
        $this->load->model('student_promotion/student_promotion_model');
        $this->load->model('exam/exam_model');
        $permission = $this->master_model->get_staff_by_id($user_det['user_id'], $user_det['staff_type']);
        if ($permission[0]['internal_mark'] == 0)
            redirect($this->config->item('base_url') . 'admin/index');
    }

    public function index() {
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
        //echo "<pre>"; print_r($data['list']); exit;
        $this->template->write_view('content', 'student_promotion/student_promotion', $data);
        $this->template->render();
    }

    public function get_all_student_with_subject() {
        $input = $this->input->POST();
        $this->load->model('internal/internal_model');
        $datas['all_info'] = $this->internal_model->check_external_mark($input);
        if (isset($datas['all_info']) && !empty($datas['all_info'])) {
            $data['ajax_value'] = $input;
            $data['all_grade'] = $this->internal_model->get_all_student_grade($input, NULL);
            $data['all_subject'] = $this->internal_model->get_all_subject_for_external($input);
        }
        echo $this->load->view('student_promotion/student_details', $data);
    }

    public function switch_over_students() {
        $input_data = $this->input->post();
        $batc_id = $input_data['batch_id'];
        $depart_id = $input_data['depart_id'];
        $group_id = $input_data['group_id'];
        $semester = $input_data['semester'];
        $exam_id = $input_data['exam_id'];
        $passed_students = $input_data['passed_students'];
        $all_students = $input_data['all_students'];

        $input = array('batch_id' => $batc_id, 'depart_id' => $depart_id, 'group_id' => $group_id, 'semester' => $semester, 'exam_id' => $exam_id);

        $students = $this->student_promotion_model->get_all_student_result($input);

        $new_batch_id = $this->student_promotion_model->get_next_batch_id($batc_id);
        $new_class_id = $this->student_promotion_model->get_next_class_id($depart_id);
        $new_session_id = $this->student_promotion_model->get_next_section_id($depart_id);

        if (isset($students) && !empty($students)) {
            $i = 0;
            foreach ($students[0]['external_details'] as $key => $student) {
                if ($passed_students == 1) {
                    if (isset($student['grade_details']) && !empty($student['grade_details'])) {

                        $std = $this->student_promotion_model->get_student($student['std_id']);

                        $std_details = $this->student_promotion_model->get_student_details($student['std_id']);

                        $std_grp = $this->student_promotion_model->get_student_group($student['std_id']);

                        $update_s = array('status' => 0);
                        $this->student_promotion_model->update_student($update_s, $student['std_id']);

                        $new_roll_number = $std[0]['std_id'];
                        if (!empty($input_data['new_roll_no'])) {
                            foreach ($input_data['new_roll_no'] as $key1 => $new_roll) {
                                if ($key == $key1) {
                                    $new_roll_number = $new_roll;
                                }
                            }
                        }

                        unset($std[0]['batch_id']);
                        unset($std[0]['terms']);
                        $update_data = $update_data1 = array();
                        $update_data['std_id'] = $new_roll_number;
                        $update_data['regno'] = $std[0]['regno'];
                        $update_data['name'] = $std[0]['name'];
                        $update_data['last_name'] = $std[0]['last_name'];
                        $update_data['gender'] = $std[0]['gender'];
                        $update_data['batch_id'] = $new_batch_id;
                        $update_data['terms'] = 1;
                        $update_data['email_id'] = $std[0]['email_id'];
                        $update_data['pwd'] = $std[0]['pwd'];
                        $update_data['contact_no'] = $std[0]['contact_no'];
                        $update_data['image'] = $std[0]['image'];
                        $update_data['df'] = $std[0]['df'];
                        $update_data['online_status'] = $std[0]['online_status'];
                        $update_data['cover_image'] = $std[0]['cover_image'];
                        $update_data['background_image'] = $std[0]['background_image'];
                        $update_data['student_type'] = $std[0]['student_type'];
                        $update_data['transport'] = $std[0]['transport'];
                        $update_data['hostel'] = $std[0]['hostel'];
                        $update_data['scholarship'] = $std[0]['scholarship'];
                        $update_data['graduate'] = $std[0]['graduate'];
                        $update_data['status'] = 1;
                        $update_data['chat'] = $std[0]['chat'];
                        $std_id = $this->student_promotion_model->insert_student($update_data);

                        unset($std_details[0]['id']);
                        unset($std_details[0]['student_id']);

                        $details = array();
                        $details = $std_details[0];
                        $details['student_id'] = $std_id;
                        $this->student_promotion_model->insert_student_details($details);

                        $update_data1['student_id'] = $std_id;
                        $update_data1['batch_id'] = $new_batch_id;
                        $update_data1['depart_id'] = $new_class_id;
                        $update_data1['group_id'] = $new_session_id;
                        $update_data1['cur_year'] = $std_grp[0]['cur_year'];

                        $this->student_promotion_model->insert_student_group($update_data1);

                        //$student_group = array('batch_id' => $new_batch_id, 'depart_id' => $new_class_id, 'group_id' => $new_session_id);
                        //$this->student_promotion_model->update_student_group($student_group, $student['std_id']);
                    } else {

                        $std = $this->student_promotion_model->get_student($student['std_id']);

                        $std_details = $this->student_promotion_model->get_student_details($student['std_id']);

                        $std_grp = $this->student_promotion_model->get_student_group($student['std_id']);

                        $update_s = array('status' => 0);
                        $this->student_promotion_model->update_student($update_s, $student['std_id']);


                        unset($std[0]['batch_id']);
                        unset($std[0]['terms']);
                        $update_data = $update_data1 = array();
                        $update_data['std_id'] = $std[0]['std_id'];
                        $update_data['regno'] = $std[0]['regno'];
                        $update_data['name'] = $std[0]['name'];
                        $update_data['last_name'] = $std[0]['last_name'];
                        $update_data['gender'] = $std[0]['gender'];
                        $update_data['batch_id'] = $new_batch_id;
                        $update_data['terms'] = 1;
                        $update_data['email_id'] = $std[0]['email_id'];
                        $update_data['pwd'] = $std[0]['pwd'];
                        $update_data['contact_no'] = $std[0]['contact_no'];
                        $update_data['image'] = $std[0]['image'];
                        $update_data['df'] = $std[0]['df'];
                        $update_data['online_status'] = $std[0]['online_status'];
                        $update_data['cover_image'] = $std[0]['cover_image'];
                        $update_data['background_image'] = $std[0]['background_image'];
                        $update_data['student_type'] = $std[0]['student_type'];
                        $update_data['transport'] = $std[0]['transport'];
                        $update_data['hostel'] = $std[0]['hostel'];
                        $update_data['scholarship'] = $std[0]['scholarship'];
                        $update_data['graduate'] = $std[0]['graduate'];
                        $update_data['status'] = 1;
                        $update_data['chat'] = $std[0]['chat'];
                        $std_id = $this->student_promotion_model->insert_student($update_data);

                        unset($std_details[0]['id']);
                        unset($std_details[0]['student_id']);

                        $details = array();
                        $details = $std_details[0];
                        $details['student_id'] = $std_id;
                        $this->student_promotion_model->insert_student_details($details);

                        $update_data1['student_id'] = $std_id;
                        $update_data1['batch_id'] = $new_batch_id;
                        $update_data1['depart_id'] = $std_grp[0]['depart_id'];
                        $update_data1['group_id'] = $std_grp[0]['group_id'];
                        $update_data1['cur_year'] = $std_grp[0]['cur_year'];

                        $this->student_promotion_model->insert_student_group($update_data1);
                    }
                } elseif ($all_students == 1) {
                    $std = $this->student_promotion_model->get_student($student['std_id']);

                    $std_details = $this->student_promotion_model->get_student_details($student['std_id']);

                    $std_grp = $this->student_promotion_model->get_student_group($student['std_id']);

                    $update_s = array('status' => 0);
                    $this->student_promotion_model->update_student($update_s, $student['std_id']);
                    $new_roll_number = $std[0]['std_id'];
                    if (!empty($input_data['new_roll_no'])) {
                        foreach ($input_data['new_roll_no'] as $key1 => $new_roll) {
                            if ($key == $key1) {
                                $new_roll_number = $new_roll;
                            }
                        }
                    }

                    unset($std[0]['batch_id']);
                    unset($std[0]['terms']);
                    $update_data = $update_data1 = array();
                    $update_data['std_id'] = $new_roll_number;
                    $update_data['regno'] = $std[0]['regno'];
                    $update_data['name'] = $std[0]['name'];
                    $update_data['last_name'] = $std[0]['last_name'];
                    $update_data['gender'] = $std[0]['gender'];
                    $update_data['batch_id'] = $new_batch_id;
                    $update_data['terms'] = 1;
                    $update_data['email_id'] = $std[0]['email_id'];
                    $update_data['pwd'] = $std[0]['pwd'];
                    $update_data['contact_no'] = $std[0]['contact_no'];
                    $update_data['image'] = $std[0]['image'];
                    $update_data['df'] = $std[0]['df'];
                    $update_data['online_status'] = $std[0]['online_status'];
                    $update_data['cover_image'] = $std[0]['cover_image'];
                    $update_data['background_image'] = $std[0]['background_image'];
                    $update_data['student_type'] = $std[0]['student_type'];
                    $update_data['transport'] = $std[0]['transport'];
                    $update_data['hostel'] = $std[0]['hostel'];
                    $update_data['scholarship'] = $std[0]['scholarship'];
                    $update_data['graduate'] = $std[0]['graduate'];
                    $update_data['status'] = 1;
                    $update_data['chat'] = $std[0]['chat'];
                    $std_id = $this->student_promotion_model->insert_student($update_data);

                    unset($std_details[0]['id']);
                    unset($std_details[0]['student_id']);

                    $details = array();
                    $details = $std_details[0];
                    $details['student_id'] = $std_id;
                    $this->student_promotion_model->insert_student_details($details);

                    $update_data1['student_id'] = $std_id;
                    $update_data1['batch_id'] = $new_batch_id;
                    $update_data1['depart_id'] = $new_class_id;
                    $update_data1['group_id'] = $new_session_id;
                    $update_data1['cur_year'] = $std_grp[0]['cur_year'];

                    $this->student_promotion_model->insert_student_group($update_data1);
                }
                $i++;
            }
            $update = array();
            $update['complete_status'] = 1;
            $this->student_promotion_model->update_external_status($update, $batc_id, $depart_id, $group_id, $semester);
        }
        redirect($this->config->item('base_url') . 'student_promotion');
    }

}
