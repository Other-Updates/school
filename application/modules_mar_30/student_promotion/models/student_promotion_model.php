<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student_promotion_model extends CI_Model {

    private $table_name = 'internal';
    private $table_name1 = 'internal_details';
    private $table_name2 = 'external';
    private $table_name3 = 'external_details';
    private $student = 'student';
    private $student_group = 'student_group';
    private $table_name5 = 'subject_details';

    function __construct() {
        parent::__construct();
    }

    function get_all_student_result($data) {
        $this->db->select('external.*');
        $this->db->select('batch.from,to');
        $this->db->select('department.department');
        $this->db->select('group.group');
        $this->db->select('semester.semester');
        $this->db->where('external.batch_id', $data['batch_id']);
        $this->db->where('external.depart_id', $data['depart_id']);
        $this->db->where('external.group_id', $data['group_id']);
        $this->db->where('external.semester', $data['semester']);
        $this->db->where('external.exam_id', $data['exam_id']);
        $this->db->join('batch', 'batch.id=external.batch_id');
        $this->db->join('department', 'department.id=external.depart_id');
        $this->db->join('group', 'group.id=external.group_id');
        $this->db->join('semester', 'semester.id=external.semester');
        $query = $this->db->get('external')->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('external_details.std_id');
            $this->db->select('student.std_id as roll_no,student.name');
            $this->db->where('external_id', $val['id']);
            $this->db->group_by('std_id');
            $this->db->join('student', 'student.id=external_details.std_id');
            $query[$i]['external_details'] = $this->db->get('external_details')->result_array();
            $j = 0;
            foreach ($query[$i]['external_details'] as $value) {
                $this->db->select('external_details.*');
                $this->db->select('subject_details.grade_point as subject_point,pass_mark,subject_details.practical_mark as practical,practical_pass_mark');
                $this->db->where('external_id', $val['id']);
                $this->db->where('std_id', $value['std_id']);
                $this->db->where('result', 1);
                $this->db->join('subject_details', 'subject_details.id=external_details.subject_id');
                $query[$i]['external_details'][$j]['grade_details'] = $this->db->get('external_details')->result_array();
                $j++;
            }
            $i++;
        }

        return $query;
    }

    function get_student($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->student)->result_array();
        return $query;
    }

    function get_student_group($id) {
        $this->db->where('student_id', $id);
        $query = $this->db->get($this->student_group)->result_array();
        return $query;
    }

    function get_student_details($id) {
        $this->db->where('student_id', $id);
        $query = $this->db->get('student_details')->result_array();
        return $query;
    }

    function insert_student($data) {
        if ($this->db->insert($this->student, $data)) {
            $id = $this->db->insert_id();
            return $id;
        }
        return false;
    }

    function insert_student_details($data) {
        if ($this->db->insert('student_details', $data)) {
            $id = $this->db->insert_id();
            return $id;
        }
        return false;
    }

    function insert_student_group($data) {
        if ($this->db->insert($this->student_group, $data)) {
            $id = $this->db->insert_id();
            return $id;
        }
        return false;
    }

    function update_student($data, $id) {
        $this->db->where('id', $id);
        if ($this->db->update($this->student, $data)) {
            return true;
        }
        return false;
    }

    function update_student_group($data, $id) {
        $this->db->where('student_id', $id);
        if ($this->db->update($this->student_group, $data)) {
            return true;
        }
        return false;
    }

    function get_next_batch_id($id) {
        $this->db->select('id');
        $this->db->where('id >', $id);
        $this->db->order_by('id');
        $this->db->limit(1);
        $query = $this->db->get('batch');
        if ($query->num_rows() >= 1) {
            $query = $query->result_array();
            return $query[0]['id'];
        }
    }

    function get_next_class_id($id) {
        $this->db->select('id');
        $this->db->where('id >', $id);
        $this->db->order_by('id');
        $this->db->limit(1);
        $query = $this->db->get('department');
        if ($query->num_rows() >= 1) {
            $query = $query->result_array();
            return $query[0]['id'];
        }
    }

    function get_next_section_id($id) {
        $this->db->select('id');
        $this->db->where('depart_id >', $id);
        $this->db->order_by('id');
        $this->db->limit(1);
        $query = $this->db->get('group');
        if ($query->num_rows() >= 1) {
            $query = $query->result_array();
            return $query[0]['id'];
        }
    }

    function update_external_status($data, $batc_id, $depart_id, $group_id, $semester) {
        $this->db->where('external.batch_id', $batc_id);
        $this->db->where('external.depart_id', $depart_id);
        $this->db->where('external.group_id', $group_id);
        $this->db->where('external.semester', $semester);
        if ($this->db->update($this->table_name2, $data)) {
            return true;
        }
        return false;
    }

}
