<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Users_model extends CI_Model {

    private $table_name = 'users';   // user accounts
    private $table_name1 = 'time_table';
    private $table_name2 = 'time_table_details';
    private $table_name3 = 'other_time_tables';
    private $table_name4 = 'other_time_table_details';
    private $table_name5 = 'internal';
    private $table_name6 = 'assignment';
    private $table_name7 = 'assignment_details';
    private $table_name8 = 'student';
    private $tabe_name6 = 'semester';
    private $tabe_name7 = 'subject_details';
    private $tabe_name8 = 'staff';
    private $tabe_name9 = 'notes';
    private $tabe_name10 = 'events';
    private $table_name11 = 'internal_details';
    private $table_name12 = 'events_view';
    private $table_name13 = 'placement';
    private $table_name14 = 'placement_student';
    private $table_name15 = 'external';
    private $table_name16 = 'external_details';
    private $table_name17 = 'transport_fees';

    function __construct() {
        parent::__construct();
        $ci = & get_instance();
    }

    function get_all_details_by_id($batch, $depart_id, $group_id, $sem_id) {
        $this->db->where('batch_id', $batch);
        $this->db->where('depart_id', $depart_id);
        $this->db->where('group_id', $group_id);
        $this->db->where('semester_id', $sem_id);
        $query = $this->db->get($this->table_name1)->result_array();
        foreach ($query as $val) {
            $this->db->select($this->table_name2 . '.*');
            $this->db->select('subject_details.subject_name,nick_name,grade_point');
            $this->db->where('time_table_id', $val['id']);
            $this->db->join('subject_details', 'subject_details.id=' . $this->table_name2 . '.supject_id');
            $query[0]['time_info'] = $this->db->get($this->table_name2)->result_array();
        }
        return $query;
    }

    function get_all_details_by_id1($batch, $depart_id, $group_id) {
        $this->db->select('*');
        $this->db->where('batch_id', $batch);
        $this->db->where('depart_id', $depart_id);
        $this->db->where('group_id', $group_id);
        //$this->db->select('*,MAX(semester_id)');
        $this->db->order_by('id', "desc");
        $this->db->limit(1);
        //$this->db->where('`id` IN (SELECT MAX(`semester_id`) FROM `time_table`)', NULL, FALSE);
        $query = $this->db->get($this->table_name1)->result_array();
        foreach ($query as $val) {
            $this->db->select($this->table_name2 . '.*');
            $this->db->select('subject_details.subject_name,nick_name,grade_point');
            $this->db->where('time_table_id', $val['id']);
            $this->db->join('subject_details', 'subject_details.id=' . $this->table_name2 . '.supject_id');
            $query[0]['time_info'] = $this->db->get($this->table_name2)->result_array();
        }
        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    function get_latest_internal_by_id($batch, $depart_id, $group_id, $type) {
        $this->db->select('*');
        $this->db->where('batch_id', $batch);
        $this->db->where('depart_id', $depart_id);
        $this->db->where('group_id', $group_id);
        $this->db->where('time_table_method', $type);
        $this->db->order_by('id', "desc");
        $this->db->limit(1);
        //$this->db->where('`id` IN (SELECT MAX(`time_table_type`) FROM `other_time_tables`)', NULL, FALSE);
        //$this->db->where('`id` IN (SELECT MAX(`semester_id`) FROM `other_time_tables`)', NULL, FALSE);
        $query = $this->db->get($this->table_name3)->result_array();
        foreach ($query as $val) {
            $this->db->select('semester.semester');
            $this->db->where('id', $val['semester_id']);
            $query[0]['sem'] = $this->db->get('semester')->result_array();
            $this->db->select($this->table_name4 . '.*');
            $this->db->select('subject_details.subject_name,nick_name,grade_point');
            $this->db->where('other_time_table_id', $val['id']);
            $this->db->join('subject_details', 'subject_details.id=' . $this->table_name4 . '.subject_id');
            $query[0]['time_info'] = $this->db->get($this->table_name4)->result_array();
        }
        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    function get_all_semester_by_id($batch, $depart_id, $group_id) {
        $this->db->select('semester.id,semester');
        $this->db->where('batch_id', $batch);
        $this->db->where('depart_id', $depart_id);
        $this->db->where('group_id', $group_id);
        $this->db->join('semester', 'semester.id=' . $this->table_name1 . '.semester_id');
        $query = $this->db->get($this->table_name1)->result_array();
        return $query;
    }

    function get_created_sem_by_id($batch, $depart_id, $group_id, $type) {
        $this->db->select('semester.id,semester');
        $this->db->where('batch_id', $batch);
        $this->db->where('depart_id', $depart_id);
        $this->db->where('group_id', $group_id);
        $this->db->where('time_table_method', $type);
        //$this->db->select('MAX(other_time_tables.semester_id),MAX(other_time_tables.time_table_type)');
        $this->db->join('semester', 'semester.id=' . $this->table_name3 . '.semester_id');
        $this->db->group_by($this->table_name3 . '.semester_id');
        $query = $this->db->get($this->table_name3)->result_array();
        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    function get_created_sem_by_id_error($batch, $depart_id, $group_id, $type) {
        //echo "<pre>"; echo $batch; exit;
        $this->db->select('semester.id,semester');
        $this->db->where('batch_id', $batch);
        $this->db->where('depart_id', $depart_id);
        $this->db->where('group_id', $group_id);
        $this->db->where('time_table_method', $type);
        //$this->db->select('MAX(other_time_tables.semester_id),MAX(other_time_tables.time_table_type)');
        $this->db->join('semester', 'semester.id=' . $this->table_name3 . '.semester_id');
        $this->db->group_by($this->table_name3 . '.semester_id');
        $query = $this->db->get($this->table_name3)->result_array();
        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    function get_created_sem_by_id1($batch, $depart_id, $group_id) {
        $this->db->select('semester.id,semester.semester');
        $this->db->where('batch_id', $batch);
        $this->db->where('depart_id', $depart_id);
        $this->db->where('group_id', $group_id);
        $this->db->group_by($this->table_name5 . '.semester');
        $this->db->join('semester', 'semester.id=' . $this->table_name5 . '.semester');
        $query = $this->db->get($this->table_name5)->result_array();
        return $query;
    }

    function get_subject_by_sem_id($batch, $depart_id, $group_id, $sem_id) {
        $this->db->select('subject_details.id,subject_details.subject_name,subject_details.nick_name,subject_details.grade_point');
        $this->db->where($this->table_name5 . '.batch_id', $batch);
        $this->db->where($this->table_name5 . '.depart_id', $depart_id);
        $this->db->where($this->table_name5 . '.group_id', $group_id);
        $this->db->where($this->table_name5 . '.semester', $sem_id);
        $this->db->join('subject_details', 'subject_details.id=' . $this->table_name5 . '.subject_id');
        $query = $this->db->get($this->table_name5)->result_array();
        return $query;
    }

    function get_internal_by_std_id($where, $std_id) {
        $this->db->select($this->table_name5 . '.*');
        $this->db->select('internal_details.*');
        $this->db->select('subject_details.subject_name,nick_name,grade_point');
        $this->db->select('semester.semester,semester.id as semester_id');
        $this->db->where($where);
        $this->db->where('internal_details.std_id', $std_id);
        $this->db->join('subject_details', 'subject_details.id=' . $this->table_name5 . '.subject_id');
        $this->db->join('semester', 'semester.id=' . $this->table_name5 . '.semester');
        $this->db->join('internal_details', 'internal_details.internal_id=' . $this->table_name5 . '.id');
        $query = $this->db->get($this->table_name5)->result_array();
        $i = 0;
        foreach ($query as $val) {

            $this->db->select('external_details.grade,external_details.total_cgb');
            $this->db->where('external.batch_id', $val['batch_id']);
            $this->db->where('external.depart_id', $val['depart_id']);
            $this->db->where('external.group_id', $val['group_id']);
            $this->db->where('external.semester', $val['semester_id']);
            $this->db->where('external_details.std_id', $val['std_id']);
            $this->db->where('external_details.subject_id', $val['subject_id']);
            $this->db->join('external_details', 'external_details.external_id=external.id');
            $query[$i]['subject_grade'] = $this->db->get('external')->result_array();
            $i++;
        }
        return $query;
    }

    function get_internal_by_std_id_onload($where, $std_id) {
        $this->db->select($this->table_name5 . '.*');
        $this->db->select('internal_details.*');
        $this->db->select('subject_details.subject_name,nick_name,grade_point');
        $this->db->select('semester.semester');
        $this->db->where($where);
        $this->db->where('internal_details.std_id', $std_id);
        $this->db->select('MAX(internal.semester)');
        $this->db->join('subject_details', 'subject_details.id=' . $this->table_name5 . '.subject_id');
        $this->db->join('semester', 'semester.id=' . $this->table_name5 . '.semester');
        $this->db->join('internal_details', 'internal_details.internal_id=' . $this->table_name5 . '.id');
        $query = $this->db->get($this->table_name5)->result_array();
        return $query;
    }

    function get_student_subject($where) {

        $this->db->select('*');

        $this->db->where($where);
        $this->db->where('df', 0);
        $this->db->join('assignment', 'assignment.subject_id=subject_details.id');
        $this->db->group_by('subject_name');
        $query = $this->db->get('subject_details')->result_array();
        return $query;
    }

    function get_student_assignment_number($where) {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->where('status', 0);
        $query = $this->db->get('assignment')->result_array();
        return $query;
    }

    // by subject id
    function get_assignment_byid($where, $std_id) {
        $this->db->select('assignment.*');

        $this->db->where($where);
        $this->db->where('assignment.status', 0);
        $query = $this->db->get('assignment')->result_array();
        $i = 0;
        foreach ($query as $row) {
            $this->db->select('group.group');
            $this->db->where('id', $row['group_id']);
            $query[$i]['group'] = $this->db->get('group')->result_array();
            $this->db->select('department.department');
            $this->db->where('id', $row['depart_id']);
            $query[$i]['department'] = $this->db->get('department')->result_array();
            if ($row['ass_type'] == 0) {
                $this->db->select('assignment_details.score');
                $this->db->where('assignment_details.std_id', $std_id);
                $this->db->where('assignment_details.assign_id', $row['id']);
                $query[$i]['assignment_details'] = $this->db->get('assignment_details')->result_array();
            } else {
                $this->db->select('assignment_details.score');
                $this->db->where('assignment_details.std_id', $std_id);
                $this->db->where('assignment_details.assign_id', $row['id']);
                $query[$i]['assignment_details'] = $this->db->get('assignment_details')->result_array();
            }
            $i++;
        }

        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    function get_assignment_by_id($id) {
        $this->db->select($this->table_name6 . '.*');
        $this->db->select('batch.from,batch.to');
        $this->db->select('subject_details.subject_name,nick_name,grade_point');
        $this->db->select('semester.semester');
        $this->db->select('department.department');
        $this->db->where($this->table_name6 . '.status', 0);
        $this->db->where($this->table_name6 . '.id', $id);
        $this->db->join('batch', 'batch.id=' . $this->table_name6 . '.batch_id');
        $this->db->join('subject_details', 'subject_details.id=' . $this->table_name6 . '.subject_id');
        $this->db->join('semester', 'semester.id=' . $this->table_name6 . '.semester_id');
        $this->db->join('department', 'department.id=' . $this->table_name6 . '.depart_id');
        $query = $this->db->get($this->table_name6)->result_array();
        $i = 0;
        foreach ($query as $row) {
            if ($row['staff_type'] == 'admin') {
                $this->db->select('admin.name as name');
                $this->db->where('id', $row['staff_id']);
                $query[$i]['staff'] = $this->db->get('admin')->result_array();
            } else {
                $this->db->select('staff.staff_name as name');
                $this->db->where('id', $row['staff_id']);
                $query[$i]['staff'] = $this->db->get('staff')->result_array();
            }
            $this->db->select('group.group');
            $this->db->where('id', $row['group_id']);
            $query[$i]['group'] = $this->db->get('group')->result_array();
            $i++;
        }
        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    function insert_student_assignment($data) {
        if ($this->db->insert($this->table_name7, $data)) {
            $history_id = $this->db->insert_id();
            return array('id' => $history_id);
        }
        return false;
    }

    function assignment_details_table($student_id, $ass_id) {
        $this->db->select('*');
        $this->db->where('std_id', $student_id);
        $this->db->where('assign_id', $ass_id);
        $query = $this->db->get('assignment_details');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    //profile

    function get_all_student_details($id) {
        $this->db->select($this->table_name8 . '.*');
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department');
        $this->db->select('student_group.depart_id as std_depart_id');
        $this->db->select('student_group.group_id as std_group_id');
        $this->db->select('student_details.*');
        $this->db->where($this->table_name8 . '.df', 0);
        //$this->db->where($this->table_name.'.status',1);
        $this->db->where($this->table_name8 . '.id', $id);
        $this->db->join('batch', 'batch.id=' . $this->table_name8 . '.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name8 . '.id');
        $this->db->join('department', 'department.id=student_group.depart_id');
        $this->db->join('student_details', 'student_details.student_id=' . $this->table_name8 . '.id');
        $query = $this->db->get($this->table_name8)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('group.group');
            $this->db->where('id', $val['std_group_id']);
            $this->db->where('depart_id', $val['std_depart_id']);
            $query[$i]['std_group'] = $this->db->get('group')->result_array();
            $this->db->where('qualification.type', 'student');
            $this->db->where('qualification.person_id', $val['student_id']);
            $q_array = $this->db->get('qualification')->result_array();
            $query['qualification'][0] = $q_array;
            $i++;
        }

        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    function update_student_profile($data, $id) {
        $this->db->where('id', $id);
        if ($this->db->update($this->table_name8, $data)) {
            return true;
        }
        return false;
    }

    function get_image_details($id) {
        $this->db->select('image,cover_image,background_image,chat,regno');
        $this->db->where('id', $id);
        $query = $this->db->get('student')->result_array();
        return $query;
    }

    function get_semester($value) {
        $this->db->select($this->tabe_name6 . '.*');
        foreach ($value as $key => $val) {
            $batch_id = $val["batch_id"];
            $depart_id = $val["depart_id"];
            $std_id = $val["std_id"];
            $group_id = $val["group_id"];
        }
        $this->db->where('depart_id', $depart_id);
        $this->db->where('batch_id', $batch_id);
        $this->db->where('group_id', $group_id);
        $this->db->join('semester', 'semester.id=' . $this->tabe_name7 . '.semester_id');
        $this->db->group_by($this->tabe_name7 . '.semester_id');
        $query = $this->db->get('subject_details');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_curent_subject($value, $s_id) {
        foreach ($value as $key => $val) {
            $batch_id = $val["batch_id"];
            $depart_id = $val["depart_id"];
            $group_id = $val["group_id"];
        }

        $this->db->select('staff.staff_name');
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department');
        $this->db->select('semester.semester');
        $this->db->select($this->tabe_name7 . '.subject_name');
        $this->db->select($this->tabe_name7 . '.nick_name');
        $this->db->select($this->tabe_name7 . '.scode');
        $this->db->select($this->tabe_name7 . '.grade_point');
        $this->db->where($this->tabe_name7 . '.semester_id', $s_id);
        $this->db->where($this->tabe_name7 . '.depart_id', $depart_id);
        $this->db->where($this->tabe_name7 . '.group_id', $group_id);
        $this->db->where($this->tabe_name7 . '.batch_id', $batch_id);
        $this->db->join('staff', 'staff.id=' . $this->tabe_name7 . '.staff_id');
        $this->db->join('batch', 'batch.id=' . $this->tabe_name7 . '.batch_id');
        $this->db->join('department', 'department.id=' . $this->tabe_name7 . '.depart_id');
        $this->db->join('semester', 'semester.id=' . $this->tabe_name7 . '.semester_id');
        $query = $this->db->get($this->tabe_name7);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_semester_id($value) {
        foreach ($value as $key => $val) {
            $batch_id = $val["batch_id"];
            $depart_id = $val["depart_id"];
            $group_id = $val["group_id"];
        }

        //$this->db->select($this->tabe_name7.'.*');
        $this->db->select($this->tabe_name7 . '.semester_id');
        $this->db->group_by($this->tabe_name7 . '.semester_id');
        $this->db->select_max('semester_id');
        $this->db->where($this->tabe_name7 . '.group_id', $group_id);
        $this->db->where($this->tabe_name7 . '.depart_id', $depart_id);
        $this->db->where($this->tabe_name7 . '.batch_id', $batch_id);
        $query = $this->db->get($this->tabe_name7)->result_array();
        return $query;
    }

    function get_subject($sem_id, $value) {
        foreach ($value as $key => $val) {
            $batch_id = $val["batch_id"];
            $depart_id = $val["depart_id"];
            $group_id = $val["group_id"];
            $std_id = $val["std_id"];
        }
        $this->db->select($this->tabe_name7 . '.subject_name');
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department');
        $this->db->select('semester.semester');
        $this->db->select('staff.staff_name');
        $this->db->select($this->tabe_name7 . '.subject_name');
        $this->db->select($this->tabe_name7 . '.nick_name');
        $this->db->select($this->tabe_name7 . '.scode');
        $this->db->select($this->tabe_name7 . '.grade_point');
        $this->db->where($this->tabe_name7 . '.depart_id', $depart_id);
        $this->db->where($this->tabe_name7 . '.group_id', $group_id);
        $this->db->where($this->tabe_name7 . '.batch_id', $batch_id);
        $this->db->where($this->tabe_name7 . '.semester_id', $sem_id);
        $this->db->join('staff', 'staff.id=' . $this->tabe_name7 . '.staff_id');
        $this->db->join('batch', 'batch.id=' . $this->tabe_name7 . '.batch_id');
        $this->db->join('department', 'department.id=' . $this->tabe_name7 . '.depart_id');
        $this->db->join('semester', 'semester.id=' . $this->tabe_name7 . '.semester_id');
        $query = $this->db->get($this->tabe_name7);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_notes_subject($value) {
        foreach ($value as $key => $val) {
            $batch_id = $val["batch_id"];
            $depart_id = $val["depart_id"];
            $group_id = $val["group_id"];
        }
        $this->db->select($this->tabe_name7 . '.subject_name');
        $this->db->select($this->tabe_name7 . '.nick_name');
        $this->db->select($this->tabe_name7 . '.grade_point');
        $this->db->select($this->tabe_name7 . '.id');
        $this->db->where($this->tabe_name7 . '.depart_id', $depart_id);
        $this->db->where($this->tabe_name7 . '.batch_id', $batch_id);
        $this->db->where($this->tabe_name7 . '.group_id', $group_id);
        $query = $this->db->get($this->tabe_name7);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function share_notes_view($value) {
        //echo "<pre>";print_r($value); exit;
        foreach ($value as $key => $val) {
            $batch_id = $val["batch_id"];
            $depart_id = $val["depart_id"];
            $group_id = $val["group_id"];
        }
        $this->db->order_by('id', 'desc');
        $this->db->limit(10);
        $this->db->select($this->tabe_name9 . '.*');
        $this->db->select('subject_details.subject_name,nick_name,grade_point');
        //$this->db->select('staff.staff_name');
        $this->db->where($this->tabe_name9 . '.df', 0);
        $this->db->where($this->tabe_name9 . '.depart_id', $depart_id);
        $this->db->where($this->tabe_name9 . '.batch', $batch_id);
        $this->db->where($this->tabe_name9 . '.group_id', $group_id);
        $this->db->join('subject_details', 'subject_details.id=' . $this->tabe_name9 . '.subject_id');
        //$this->db->join('staff','staff.id='.$this->tabe_name9.'.created_user');
        $query = $this->db->get($this->tabe_name9)->result_array();
        $i = 0;
        foreach ($query as $row) {
            if ($row['staff_type'] == 'admin') {
                $this->db->select('admin.name as staff_name');
                $this->db->where('id', $row['created_user']);
                $query[$i]['staff'] = $this->db->get('admin')->result_array();
            } else {
                $this->db->select('staff.staff_name as staff_name');
                $this->db->where('id', $row['created_user']);
                $query[$i]['staff'] = $this->db->get('staff')->result_array();
            }
            $i++;
        }
        //echo "<pre>";print_r($query); exit;
        return $query;
    }

    function get_notes_by_subject($sub_id) {

        $this->db->select($this->tabe_name9 . '.*');
        $this->db->select('subject_details.subject_name,nick_name');
        $this->db->where($this->tabe_name9 . '.df', 0);
        $this->db->where($this->tabe_name9 . '.subject_id', $sub_id);
        $this->db->join('subject_details', 'subject_details.id=' . $this->tabe_name9 . '.subject_id');
        $query = $this->db->get($this->tabe_name9)->result_array();
        $i = 0;
        foreach ($query as $row) {
            if ($row['staff_type'] == 'admin') {
                $this->db->select('admin.name as staff_name');
                $this->db->where('id', $row['created_user']);
                $query[$i]['staff'] = $this->db->get('admin')->result_array();
            } else {
                $this->db->select('staff.staff_name as staff_name');
                $this->db->where('id', $row['created_user']);
                $query[$i]['staff'] = $this->db->get('staff')->result_array();
            }


            $i++;
        }
        return $query;
    }

    function attendance_list($stud_det) { //THIS IS FOR ATTENDANCE REPORT FOR STUDENTS
        $query['stud_details'] = $stud_det;
        /* echo "<pre>";
          print_r($stud_det);
          exit; */
        $this->db->order_by('date', 'desc');
        $this->db->select('*');
        //$wher_con = array('batch_id'=>$stud_det[0]['batch_id'],'semester_id'=>$stud_det['sem_id'],'depart_id'=>$stud_det[0]['depart_id'],'group_id'=>$stud_det[0]['group_id']);
        $this->db->where('batch_id', $stud_det[0]['batch_id']);
        $this->db->where('semester_id', $stud_det['sem_id']);
        $this->db->where('depart_id', $stud_det[0]['depart_id']);
        $this->db->where('group_id', $stud_det[0]['group_id']);
        $this->db->or_where('atten_mod', 'h');

        $query['day_list'] = $this->db->get_where('attendance')->result_array();
        return $query;
    }

    function attendance_dashbord($stud_det) {

        $this->db->group_by('attendance.semester_id');
        $this->db->where('attendance_stud_deta.std_id', $stud_det[0]['id']);
        $query['stud_det'] = $stud_det;
        $this->db->select('attendance.semester_id,attendance_stud_deta.attend_id,semester.semester');
        $this->db->join('attendance_stud_deta', 'attendance.id = attendance_stud_deta.attend_id');
        $this->db->join('semester', 'attendance.semester_id = semester.id');
        $query['day_list'] = $this->db->get('attendance')->result_array();


        /* echo $this->db->last_query();
          echo "<pre>";
          print_r($query['day_list']);
          exit; */
        return $query;
    }

    function get_events($value) {
        foreach ($value as $key => $val) {
            $depart_id = $val["depart_id"];
            $batch_id = $val["batch_id"];
        }
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department');
        //$this->db->select('events_view.p_status,event_id');
        $this->db->select($this->tabe_name10 . '.*');
        $this->db->where($this->tabe_name10 . '.status', 1);
        $this->db->where($this->tabe_name10 . '.depart_id', $depart_id);
        $this->db->where($this->tabe_name10 . '.batch_id', $batch_id);
        //$this->db->where('status',1);
        //$this->db->join('events_view','events_view.event_id='.$this->tabe_name10.'.id');
        $this->db->join('department', 'department.id=' . $this->tabe_name10 . '.depart_id');
        $this->db->join('batch', 'batch.id=' . $this->tabe_name10 . '.batch_id');
        $query = $this->db->get($this->tabe_name10)->result_array();
        /* echo "<pre>";
          print_r($query);
          exit; */
        /* $i=0;
          foreach($query as $row)
          {
          if($row['staff_type']=='admin')
          {
          $this->db->select('admin.name as name,admin.image as image');
          //$this->db->where('id',$row['created_by']);
          $query[$i]['staff']=$this->db->get('admin')->result_array();
          }
          else
          {
          $this->db->select('staff.staff_name as name,staff.image as image');
          // $this->db->where('id',$row['created_by']);
          $query[$i]['staff']=$this->db->get('staff')->result_array();
          }
          $i++;

          } */

        return $query;
    }

    function get_events_public() {

        $this->db->select('*');
        $this->db->where($this->tabe_name10 . '.status', 1);
        $this->db->where($this->tabe_name10 . '.depart_id', 0);
        $this->db->where($this->tabe_name10 . '.batch_id', 0);
        //$this->db->where('status',1);
        $query = $this->db->get($this->tabe_name10)->result_array();
        return $query;
    }

    function view_events($id) {
        $this->db->select('events.*');
        $this->db->where('events.id', $id);
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department');
        $this->db->join('department', 'department.id=events.depart_id', "left");
        $this->db->join('batch', 'batch.id=events.batch_id', "left");
        $query = $this->db->get('events')->result_array();

        return $query;
    }

    function check_events($id, $student) {
        $this->db->select('events_view.*');
        $this->db->where('event_id', $id);
        $this->db->where('name', $student[0]['id']);
        $query = $this->db->get('events_view')->result_array();

        return $query;
    }

    function participate_check($input, $id) {
        $this->db->select('*');
        $this->db->where('event_id', $input);
        $this->db->where('name', $id);
        //print_r($id);exit;
        //$this->db->where($this->tabe_name12.'.status',1);
        $query = $this->db->get($this->table_name12);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    /* function checking_partt($clck)
      {
      $this->db->select('*');
      $this->db->where('event_id',$clck);
      $query = $this->db->get($this->table_name12);
      if ($query->num_rows() >= 1) {
      return $query->result_array();
      }
      } */

    function insert_events($data) {
        $this->db->select('*');
        $this->db->where('name', $data['name']);
        $this->db->where('event_id', 1);
        $query = $this->db->insert($this->table_name12, $data);
        return $query;
    }

    /* chat */

    function getstudentUsers($batch, $depart, $group, $conditions = array(), $fields = '') {

        if (count($conditions) > 0)
            $this->db->where($conditions);
        $this->db->from('student');
        $this->db->order_by("student.online_status", "asc");

        if ($fields != '')
            $this->db->select($fields);
        else
            $this->db->select('student.id,student.name,student.image,student.email_id,student.online_status');

        $result = $this->db->get();


        return $result;
    }

    function get_semester_for_student() {
        $this->db->select('semester.*');
        $this->db->where('assignment.status', 0);
        $this->db->join('assignment', 'assignment.semester_id=semester.id');
        $this->db->group_by('semester.id');
        $query = $this->db->get('semester')->result_array();
        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    function get_last_assignment($where, $std_id) {
        $this->db->select('assignment.*');

        $this->db->select('subject_details.subject_name');
        $this->db->where($where);
        $this->db->where('assignment.status', 0);
        $this->db->order_by('assignment.id', "desc");
        $this->db->limit(1);

        $this->db->join('subject_details', 'subject_details.id=assignment.subject_id');
        $query = $this->db->get('assignment')->result_array();
        $i = 0;
        foreach ($query as $row) {
            $this->db->select('group.group');
            $this->db->where('id', $row['group_id']);
            $query[$i]['group'] = $this->db->get('group')->result_array();
            $this->db->select('department.department');
            $this->db->where('id', $row['depart_id']);
            $query[$i]['department'] = $this->db->get('department')->result_array();
            if ($row['ass_type'] == 0) {
                $this->db->select('assignment_details.score');
                $this->db->where('assignment_details.std_id', $std_id);
                $this->db->where('assignment_details.assign_id', $row['id']);
                $query[$i]['assignment_details'] = $this->db->get('assignment_details')->result_array();
            } else {
                $this->db->select('assignment_details.score');
                $this->db->where('assignment_details.std_id', $std_id);
                $this->db->where('assignment_details.assign_id', $row['id']);
                $query[$i]['assignment_details'] = $this->db->get('assignment_details')->result_array();
            }
            $i++;
        }

        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    function get_semester_percentage($data, $data1, $user_id) {
        $this->db->select('sum(internal_details.total) as sem_type');
        $this->db->select('semester.semester,semester.id as sem_id');
        $this->db->where($data);
        $this->db->group_by('internal.semester');
        $this->db->order_by('internal.semester', 'desc');
        $this->db->where('internal_details.std_id', $user_id);
        $this->db->join('internal_details', 'internal_details.internal_id=internal.id');
        $this->db->join('semester', 'semester.id=internal.semester');
        $query = $this->db->get($this->table_name5)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->where($data1);
            $this->db->where('subject_details.semester_id', $val['sem_id']);
            $query[$i]['subject_count'] = $this->db->get('subject_details')->num_rows();
            $i++;
        }
        return $query;
    }

    function get_semester_max($data) {
        $this->db->select('max(internal.semester) as max_sem_id');
        $this->db->where($data);
        $this->db->where('internal_details.std_id', $this->user_auth->get_user_id());
        $this->db->join('internal_details', 'internal_details.internal_id=internal.id');
        $query = $this->db->get($this->table_name5)->result_array();
        return $query;
    }

    function get_all_time_table_for_calendar($data) {
        $this->db->select($this->table_name3 . '.time_table_method,time_table_type');
        $this->db->select('other_time_table_details.date,time_in,time_out');
        $this->db->select('subject_details.subject_name');
        $this->db->where($data);
        $this->db->join('other_time_table_details', 'other_time_table_details.other_time_table_id=' . $this->table_name3 . '.id');
        $this->db->join('subject_details', 'subject_details.id=other_time_table_details.subject_id');
        $query = $this->db->get($this->table_name3)->result_array();
        return $query;
    }

    function get_notes_semester() {
        $this->db->select('*');
        $this->db->where($this->tabe_name6 . '.df', 0);
        $query = $this->db->get($this->tabe_name6);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_sem_subje($d_id, $value) {
        foreach ($value as $key => $val) {
            $batch_id = $val["batch_id"];
            $depart_id = $val["depart_id"];
            $group_id = $val["group_id"];
        }
        $this->db->select($this->tabe_name7 . '.subject_name');
        $this->db->select($this->tabe_name7 . '.nick_name');
        $this->db->select($this->tabe_name7 . '.id');
        $this->db->where($this->tabe_name7 . '.semester_id', $d_id);
        $this->db->where($this->tabe_name7 . '.depart_id', $depart_id);
        $this->db->where($this->tabe_name7 . '.batch_id', $batch_id);
        $this->db->where($this->tabe_name7 . '.group_id', $group_id);
        $query = $this->db->get($this->tabe_name7)->result_array();
        return $query;
    }

    function get_notice_for_student() {
        $current_date = date('Y-m-d');

        $this->db->select('notice_board.*');
        $this->db->where('notice_board.notice_to >=', $current_date);
        $this->db->where('notice_board.status', 0);
        $this->db->where('notice_board.view_type !=', 2);
        $where = '(notice_board.notice_type=1 or notice_board.notice_type = 0 or notice_board.view_type=0 or notice_board.view_type=1 or notice_board.view_type=3)';
        $this->db->where($where);
        $this->db->order_by('notice_board.id', "desc");
        //$this->db->where("notice_board.notice_type=1 OR notice_board.notice_type=0 OR notice_board.view_type=0 OR notice_board.view_type=1 OR notice_board.view_type=3");

        $query = $this->db->get('notice_board')->result_array();
        $i = 0;
        foreach ($query as $row) {
            if ($row['staff_type'] == 'admin') {
                $this->db->select('admin.name as name,admin.image as image');
                $this->db->where('id', $row['created_by']);
                $query[$i]['staff'] = $this->db->get('admin')->result_array();
            } else {
                $this->db->select('staff.staff_name as name,staff.image as image');
                $this->db->where('id', $row['created_by']);
                $query[$i]['staff'] = $this->db->get('staff')->result_array();
            }
            $this->db->select('department.department');
            $this->db->where('id', $row['depart_id']);
            $query[$i]['department'] = $this->db->get('department')->result_array();
            $this->db->select('group.group');
            $this->db->where('id', $row['group_id']);
            $query[$i]['group'] = $this->db->get('group')->result_array();

            $i++;
        }
        /* echo "<pre>";
          print_r($query);
          exit; */
        return $query;
    }

    function get_percentage_for_placement($data) {
        $this->db->select($this->table_name11 . '.std_id');
        $this->db->select('student.name,image,contact_no,student.std_id as roll_no');
        $this->db->select('group.group');
        $this->db->group_by('internal_details.std_id');
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department');
        if ($data['depart_id'] != '' || $data['depart_id'] != 0)
            $this->db->where('department.id', $data['depart_id']);
        $this->db->select('student_group.depart_id as std_depart_id');
        $this->db->select('student_group.group_id as std_group_id');
        $this->db->join('student', 'student.id=' . $this->table_name11 . '.std_id');
        $this->db->join('student_group', 'student_group.student_id=student.id');
        $this->db->join('batch', 'batch.id=student_group.batch_id');
        $this->db->join('group', 'group.id=student_group.group_id');
        $this->db->join('department', 'department.id=student_group.depart_id');
        $query = $this->db->get($this->table_name11)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->where('std_id', $val['std_id']);
            $query[$i]['student'] = $this->db->get($this->table_name11)->result_array();
            $i++;
        }
        return $query;
    }

    //for excel collegeg
    function get_percentage_for_placement_in_excel($data) {
        $this->db->select($this->table_name16 . '.std_id');
        $this->db->select('student.name,image,contact_no,student.std_id as roll_no');
        $this->db->select('group.group');
        $this->db->group_by($this->table_name16 . '.std_id');
        $this->db->select('batch.from,batch.to');
        $this->db->select('department.department');
        if ($data['depart_id'] != '' || $data['depart_id'] != 0)
            $this->db->where('department.id', $data['depart_id']);

        $this->db->where('batch.id', $data['batch_id']);

        $this->db->select('student_group.depart_id as std_depart_id');
        $this->db->select('student_group.group_id as std_group_id');
        $this->db->join('student', 'student.id=' . $this->table_name16 . '.std_id');
        $this->db->join('student_group', 'student_group.student_id=student.id');
        $this->db->join('batch', 'batch.id=student_group.batch_id');
        $this->db->join('group', 'group.id=student_group.group_id');
        $this->db->join('department', 'department.id=student_group.depart_id');
        $query = $this->db->get($this->table_name16)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->where('std_id', $val['std_id']);
            $query[$i]['student'] = $this->db->get($this->table_name16)->result_array();
            $i++;
        }
        return $query;
    }

    function get_all_placement($std_id) {

        $this->db->select($this->table_name13 . '.*');
        $this->db->select('placement_student.participation,placed');
        $this->db->where('placement_student.student_id', $std_id);
        $this->db->join('placement_student', 'placement_student.placement_id=placement.id');
        $query = $this->db->get($this->table_name13)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('count(placement_student.id) as eligibility_student');
            $this->db->where('placement_student.placement_id', $val['id']);
            $query[$i]['eligibility_student'] = $this->db->get($this->table_name14)->result_array();

            $this->db->select('count(placement_student.id) as interested_student');
            $this->db->where('placement_student.placement_id', $val['id']);
            $this->db->where('placement_student.participation', 1);
            $query[$i]['interested_student'] = $this->db->get($this->table_name14)->result_array();

            $this->db->select('count(placement_student.id) as placed_student');
            $this->db->where('placement_student.placement_id', $val['id']);
            $this->db->where('placement_student.placed', 1);
            $query[$i]['placed_student'] = $this->db->get($this->table_name14)->result_array();
            $i++;
        }
        return $query;
    }

    function plac_test_model($inp_data) {
        /* 		echo "<pre>";
          print_r($inp_data);
          exit; */


        $this->db->select('*');
        $this->db->where('depart_id', $inp_data[0]['depart_id']);
        $this->db->where('placement_ques.status', '1');
        $this->db->where('placement_ques.del_flg', '0');
        $this->db->join('placement_ques', 'placement_ques.id=placement_qus_dept.plac_ques_id');
        $this->db->order_by('id', 'RANDOM');
        $query = $this->db->get('placement_qus_dept')->result_array();
        return $query;
    }

    function plac_test_ans($inp_data) {
        $cur_date = $this->user_auth->get_curdate();
        $cur_dt = date("Y-m-d", strtotime($cur_date));
        $cur_time = $this->user_auth->get_curdate_time();

        $stud_det = $this->session->userdata('user_info');
        $this->db->select('*');
        $this->db->where('stud_id', $stud_det[0]['id']);
        $this->db->where('status', '1');
        $tot_row = $this->db->get('place_test_resul')->num_rows();
        $c = count($inp_data['qus_ans']['q_type']);

        if ($tot_row < 1) {
            $marks = 0;
            $marks1 = 0;
            $marks2 = 0;
            $j = 0;
            $attn = 0;
            $attn1 = 0;
            $attn2 = 0;
            for ($r = 0; $r < $c; $r++) {

                if ($inp_data['qus_ans']['q_type'][$r] == 1) {

                    $marks = 0;
                    $j = 0;
                    $this->db->select('*');
                    $this->db->where('status', '1');
                    $this->db->order_by('id', 'RANDOM');
                    $query = $this->db->get('placement_ques')->result_array();
                    foreach ($query as $row_val) {
                        $i = $row_val['id'];

                        if (isset($inp_data['qus_ans']['choice'][$i])) {
                            $j++;
                            $attn++;
                            if ($inp_data['qus_ans']['choice'][$i] == $row_val['answe_r']) {
                                $marks = $marks + 1;
                            }
                        }
                    }
                } else if ($inp_data['qus_ans']['q_type'][$r] == 2) {
                    $marks1 = 0;
                    $j = 0;
                    $attn1 = 0;
                    $this->db->select('*');
                    $this->db->where('status', '1');
                    $this->db->order_by('id', 'RANDOM');
                    $query1 = $this->db->get('placement_ques')->result_array();
                    foreach ($query1 as $row_val) {
                        $y = $row_val['id'];

                        if (isset($inp_data['qus_ans']['puzzle_answer'][$y])) {
                            $j++;
                            $attn1++;
                            if (strtolower($inp_data['qus_ans']['puzzle_answer'][$y]) == strtolower($row_val['answe_r'])) {
                                $marks1 = $marks1 + 1;
                            }
                        }
                    }
                } else if ($inp_data['qus_ans']['q_type'][$r] == 3) {
                    $marks2 = 0;
                    $j = 0;
                    $attn2 = 0;
                    $this->db->select('*');
                    $this->db->where('status', '0');
                    $this->db->order_by('id', 'RANDOM');
                    $query2 = $this->db->get('multi_choice_questions')->result_array();
                    //echo "<pre>"; print_r($query2); exit;
                    foreach ($query2 as $row_val) {
                        $z = $row_val['id'];

                        if (isset($inp_data['qus_ans']['multi_answer'][$z])) {
                            $j++;
                            $attn2++;
                            if ($inp_data['qus_ans']['multi_answer'][$z] == $row_val['multi_answers']) {
                                $marks2 = $marks2 + 1;
                            }
                        }
                    }
                }
            }
            $total_marks = $marks + $marks1 + $marks2;
            $attn_ques = $attn + $attn1 + $attn2;
            if ($j > 0) {
                $ins_data_ans = array('stud_id' => $inp_data['stud_det'][0]['id'], 'upt_mark' => $total_marks, 'atten_ques' => $attn_ques, 'time_limt' => $inp_data['qus_ans']['tm'], 'post_dt' => $cur_time);
                //echo "<pre>"; print_r($ins_data_ans); exit;
                $this->db->insert('place_test_resul', $ins_data_ans);
            }
        }
        return true;
    }

    function get_university_result_by_id($batch_id, $depart_id, $group_id, $user_id) {
        $this->db->select($this->table_name15 . '.*');
        $this->db->select('semester.semester as semester_name');
        $this->db->group_by($this->table_name15 . '.semester');
        $this->db->where($this->table_name15 . '.depart_id', $depart_id);
        $this->db->where($this->table_name15 . '.batch_id', $batch_id);
        $this->db->where($this->table_name15 . '.group_id', $group_id);
        $this->db->join('semester', 'semester.id=' . $this->table_name15 . '.semester');
        $query = $this->db->get($this->table_name15)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select($this->table_name16 . '.*');
            $this->db->select('subject_details.subject_name,subject_details.nick_name,subject_details.grade_point as subject_point');
            $this->db->where($this->table_name16 . '.external_id', $val['id']);
            $this->db->where($this->table_name16 . '.std_id', $user_id);
            $this->db->join('subject_details', 'subject_details.id=' . $this->table_name16 . '.subject_id');
            $query[$i]['subject_info'] = $this->db->get($this->table_name16)->result_array();
            $i++;
        }
        return $query;
    }

    function get_university_result_by_id1($batch_id, $depart_id, $group_id, $user_id) {
        $this->db->select($this->table_name15 . '.*');
        $this->db->select('semester.semester as semester_name');
        $this->db->group_by($this->table_name15 . '.semester');
        $this->db->where($this->table_name15 . '.depart_id', $depart_id);
        $this->db->where($this->table_name15 . '.batch_id', $batch_id);
        $this->db->where($this->table_name15 . '.group_id', $group_id);
        $this->db->join('semester', 'semester.id=' . $this->table_name15 . '.semester');
        $query = $this->db->get($this->table_name15)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select($this->table_name16 . '.*');
            $this->db->select('subject_details.scode,subject_details.subject_name,subject_details.nick_name,subject_details.grade_point as subject_mark,subject_details.practical_mark as sub_practical_mark,subject_details.check_practical,subject_details.pass_mark,subject_details.practical_pass_mark');
            $this->db->where($this->table_name16 . '.external_id', $val['id']);
            $this->db->where($this->table_name16 . '.std_id', $user_id);
            $this->db->join('subject_details', 'subject_details.id=' . $this->table_name16 . '.subject_id');
            $query[$i]['subject_info'] = $this->db->get($this->table_name16)->result_array();
            $i++;
        }
        return $query;
    }

    function get_arrear_time_table($d_id) {
        $this->db->select('*');
        $this->db->where('depart_id', $d_id);
        $query = $this->db->get('arrear_time_table')->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('subject_details.subject_name,nick_name,scode');
            $this->db->select('department.department');
            $this->db->select('semester.semester');
            $this->db->where('subject_details.scode', $val['subject_id']);
            $this->db->join('semester', 'semester.id=subject_details.semester_id');
            $this->db->join('department', 'department.id=subject_details.depart_id');
            $query[$i]['subject_info'] = $this->db->get('subject_details')->result_array();
            $i++;
        }
        //echo "<pre>"; print_r($query); exit;
        return $query;
    }

    function get_all_subject_last_timetable($batch_id, $department_id, $group_id, $semester_id) {
        $this->db->select('*');
        $where = array(
            'batch_id' => $batch_id,
            'depart_id' => $department_id,
            'group_id' => $group_id,
            'semester_id' => $semester_id
        );
        $this->db->where($where);
        $query = $this->db->get('subject_details')->result_array();
        //echo "<pre>"; print_r($query); exit;
        return $query;
    }

    function get_hostel_admission($id) {
        $this->db->select('student.name');
        $this->db->select('hostel_student_advance.*');
        $this->db->where('student.std_id', $id);
        $this->db->join('hostel_student_advance', 'hostel_student_advance.roll_no=student.std_id');
        $query = $this->db->get('student')->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('master_hostel_block.block,hostel_type,per_day');
            $this->db->where('master_hostel_block.id', $val['block_id']);
            $query[$i]['block'] = $this->db->get('master_hostel_block')->result_array();
            $i++;
        }
        //echo "<pre>"; print_r($query); exit;
        return $query;
    }

    function get_room_details($id, $hostel) {

        $this->db->select('student.name');

        $this->db->select('hostel_student_rooms.room_id,block_id,seat_no');


        $this->db->where('student.id', $id);
        $this->db->join('hostel_student_rooms', 'hostel_student_rooms.user_id=student.id');
        $query = $this->db->get('student')->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('hostel_rooms.room_name');
            $this->db->where('hostel_rooms.id', $val['room_id']);
            $query[$i]['room'] = $this->db->get('hostel_rooms')->result_array();
            $this->db->select('master_hostel_block.block');
            $this->db->where('master_hostel_block.id', $hostel);
            $query[$i]['block'] = $this->db->get('master_hostel_block')->result_array();
            $i++;
        }
        //echo "<pre>"; print_r($query); exit;
        return $query;
    }

    public function get_all_transport($std_id) {

        $this->db->select('student.std_id');
        $this->db->select($this->table_name17 . '.*');
        $this->db->where($this->table_name17 . '.std_reg');
        $this->db->join('student', 'std_id=' . $this->table_name17 . '.std_reg');
        //$this->db->where('std_reg',$std_id);
        $query = $this->db->get($this->table_name17)->result_array();
        // echo "<pre>"; print_r($query); exit;
        return $query;
    }

}

function get_events($value) {
    foreach ($value as $key => $val) {
        $depart_id = $val["depart_id"];
        $batch_id = $val["batch_id"];
    }
    $this->db->select('batch.from,batch.to');
    $this->db->select('department.department');
    $this->db->select('events_view.p_status,event_id');
    $this->db->select($this->tabe_name10 . '.*');
    $this->db->where($this->tabe_name10 . '.status', 1);
    $this->db->where($this->tabe_name10 . '.depart_id', $depart_id);
    $this->db->where($this->tabe_name10 . '.batch_id', $batch_id);
    //$this->db->where('status',1);
    $this->db->join('events_view', 'events_view.event_id=' . $this->tabe_name10 . '.id');
    $this->db->join('department', 'department.id=' . $this->tabe_name10 . '.depart_id');
    $this->db->join('batch', 'batch.id=' . $this->tabe_name10 . '.batch_id');
    $query = $this->db->get($this->tabe_name10)->result_array();
    return $query;
}

/* End of file users.php */
/* Location: ./application/models/auth/users.php */