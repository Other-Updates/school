<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * History_model
 *
 * This model represents tasker history. It operates the following tables:
 * - history,
 *
 * @package	i2_soft
 * @author	Elavarasan
 */
class Internal_model extends CI_Model {

    private $table_name = 'internal';
    private $table_name1 = 'internal_details';
    private $table_name2 = 'external';
    private $table_name3 = 'external_details';
    private $table_name4 = 'student_group';
    private $table_name5 = 'subject_details';

    function __construct() {
        parent::__construct();
    }

    /**
     * Get all ur_title
     *
     * @return	array
     */
    function get_all_ur_title() {

        $query = $this->db->get($this->table_name);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
        return false;
    }

    /**
     * Get ur_title by id (id)
     *
     * @param	int
     * @return	array
     */
    function check_internal($data) {

        $where = array(
            'batch_id' => $data['select_batch'],
            'depart_id' => $data['depart_id'],
            'group_id' => $data['group_id'],
            'subject_id' => $data['subject'],
            'semester' => $data['select_sem']
        );
        $this->db->where($where);
        $query = $this->db->get($this->table_name);

        if ($query->num_rows() == 1) {
            return $query->result_array();
        }
        return false;
    }

    function subject_internal($data) {

        $where = array(
            'batch_id' => $data['select_batch'],
            'depart_id' => $data['depart_id'],
            'group_id' => $data['group_id'],
            'id' => $data['subject'],
            'semester_id' => $data['select_sem']
        );
        $this->db->where($where);
        $query = $this->db->get($this->table_name5);

        if ($query->num_rows() == 1) {
            return $query->result_array();
        }
        return false;
    }

    /**
     * Insert new ur_title
     *
     * @param	array
     * @param	bool
     * @return	array
     */
    function insert_all_val($data) {
        if ($this->db->insert($this->table_name, $data)) {
            $id = $this->db->insert_id();

            return array('id' => $id);
        }
        return false;
    }

    function update_all_val($data, $id) {
        $this->db->where('id', $id);
        if ($this->db->update($this->table_name, $data)) {

            return true;
        }
        return false;
    }

    /**
     * Update a ur_title
     *
     * @param	array
     * @param	int
     * @return	bool
     */
    function update_ur_title($id, $data) {
        $this->db->where('id', $id);

        if ($this->db->update($this->table_name, $data)) {

            return true;
        }
        return false;
    }

    /**
     * Delete a ur_title
     *
     * @param	int
     * @return	bool
     */
    function delete_all_internal_details($id) {
        $this->db->where('internal_id', $id);
        $this->db->delete($this->table_name1);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    /**
     * Insert new ur_title
     *
     * @param	array
     * @param	bool
     * @return	array
     */
    function insert_internal_details($data) {
        if ($this->db->insert($this->table_name1, $data)) {
            $id = $this->db->insert_id();

            return array('id' => $id);
        }
        return false;
    }

    function check_internal_for_print($data) {
        $this->db->where($data);
        $query = $this->db->get($this->table_name);

        if ($query->num_rows() == 1) {
            return $query->result_array();
        }
        return false;
    }

    /* for excel */

    function check_external_mark($data) {
        $this->db->where($data);
        $query = $this->db->get($this->table_name2);

        if ($query->num_rows() == 1) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_student_for_external($data) {

        $this->db->select('student.id,std_id,name');
        $this->db->where($this->table_name4 . '.batch_id', $data['batch_id']);
        $this->db->where($this->table_name4 . '.depart_id', $data['depart_id']);
        $this->db->where($this->table_name4 . '.group_id', $data['group_id']);
        $this->db->join('student', 'student.id=' . $this->table_name4 . '.student_id');
        $query = $this->db->get($this->table_name4)->result_array();
        return $query;
    }

    function get_all_subject_for_external($data) {

        $this->db->select('id');
        $this->db->where('batch_id', $data['batch_id']);
        $this->db->where('depart_id', $data['depart_id']);
        $this->db->where('group_id', $data['group_id']);
        $this->db->where('semester_id', $data['semester']);

        $this->db->where('time_table_method', 'exam');
        $query = $this->db->get('other_time_tables')->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->where('other_time_table_details.other_time_table_id', $val['id']);
            $this->db->select('subject_details.id as subject_id,subject_details.subject_name,subject_details.grade_point,subject_details.nick_name,subject_details.*');
            $this->db->join('subject_details', 'subject_details.id=other_time_table_details.subject_id');
            $query[$i]['subject'] = $this->db->get('other_time_table_details')->result_array();
            $i++;
        }
        return $query;
    }

    function get_all_cgpa($input, $input1) {
        $this->db->select('*');
        $this->db->select('student.std_id as roll_no,student.name');
        $this->db->where($input);
        $this->db->join('student', 'student.id=' . $this->table_name4 . '.student_id');
        $query = $this->db->get($this->table_name4)->result_array();

        $i = 0;
        foreach ($query as $val) {
            $this->db->select('exam_id,id');
            $this->db->where($input1);
            $query[$i]['exam'] = $this->db->get($this->table_name2)->result_array();
            $j = 0;
            foreach ($query[$i]['exam'] as $val1) {
                $this->db->select('total');
                $this->db->where('external_id', $val1['id']);
                $this->db->where('std_id', $val['student_id']);
                $this->db->group_by('std_id');
                $query[$i]['exam'][$j]['total'] = $this->db->get($this->table_name3)->result_array();
                $j++;
            }
            $i++;
        }
        return $query;
    }

    function get_all_sem($input) {
        $this->db->select('*');
        $this->db->where($input);
        $this->db->join('semester', 'semester.id=' . $this->table_name2 . '.semester');
        $query = $this->db->get($this->table_name2)->result_array();
        return $query;
    }

    function get_all_exam($input) {
        $this->db->select('*');
        $this->db->where($input);
        $this->db->join('exam', 'exam.id=' . $this->table_name2 . '.exam_id');
        $query = $this->db->get($this->table_name2)->result_array();
        return $query;
    }

    function insert_external($data) {
        if ($this->db->insert('external', $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    function insert_external_details($data) {
        if ($this->db->insert_batch('external_details', $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    function get_all_student_grade($data, $id) {
        $this->db->select('external.*');
        $this->db->select('batch.from,to');
        $this->db->select('department.department');
        $this->db->select('group.group');
        $this->db->select('semester.semester');
        $this->db->select('exam.exam');
        $this->db->where('external.batch_id', $data['batch_id']);
        $this->db->where('external.depart_id', $data['depart_id']);
        $this->db->where('external.group_id', $data['group_id']);
        $this->db->where('external.semester', $data['semester']);
        $this->db->where('external.exam_id', $data['exam_id']);
        $this->db->join('batch', 'batch.id=external.batch_id');
        $this->db->join('department', 'department.id=external.depart_id');
        $this->db->join('group', 'group.id=external.group_id');
        $this->db->join('semester', 'semester.id=external.semester');
        $this->db->join('exam', 'exam.id=external.exam_id');
        $query = $this->db->get('external')->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('external_details.std_id');
            $this->db->select('student.std_id as roll_no,student.name');
            $this->db->where('external_id', $val['id']);
            if ($id != '')
                $this->db->where('external_details.std_id', $id);
            $this->db->group_by('std_id');
            $this->db->join('student', 'student.id=external_details.std_id');
            $query[$i]['external_details'] = $this->db->get('external_details')->result_array();
            $j = 0;
            foreach ($query[$i]['external_details'] as $value) {
                $this->db->select('external_details.*');
                $this->db->select('subject_details.grade_point as subject_point,pass_mark,subject_details.practical_mark as practical,practical_pass_mark');
                $this->db->where('external_id', $val['id']);
                $this->db->where('std_id', $value['std_id']);
                $this->db->join('subject_details', 'subject_details.id=external_details.subject_id');
                $query[$i]['external_details'][$j]['grade_details'] = $this->db->get('external_details')->result_array();
                $j++;
            }
            $i++;
        }

        return $query;
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

    function get_next_session_id($id) {
        $this->db->select('id');
        $this->db->where('id >', $id);
        $this->db->order_by('id');
        $this->db->limit(1);
        $query = $this->db->get('group');
        if ($query->num_rows() >= 1) {
            $query = $query->result_array();
            return $query[0]['id'];
        }
    }

    function delete_external_details($id) {
        $this->db->where('external_id', $id);
        $this->db->delete('external_details');

        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function get_details($data) {
        $this->db->select('group.group');
        $this->db->select('department.department');
        $this->db->where('department.id', $data['depart_id']);
        $this->db->where('group.id', $data['group_id']);
        $this->db->join('department', 'department.id=group.depart_id');
        $query = $this->db->get('group')->result_array();
        $j = 0;
        foreach ($query as $value) {
            $this->db->select('batch.from,to');
            $this->db->where('id', $data['batch_id']);
            $query[$j]['batch_info'] = $this->db->get('batch')->result_array();
            $j++;
        }
        return $query;
    }

    function get_all_student_for_users($where) {
        $this->db->select('batch.from,to,batch.id as batch_id');
        $this->db->select('department.department,department.id as depart_id');
        $this->db->select('group.group,group.id as group_id');
        $this->db->select('student_details.dob');
        $this->db->select('student.name as student_name,last_name,student.id as std_id,regno,gender,image');
        $this->db->select('student_group.student_id');
        $this->db->join('student_details', 'student_details.student_id=student_group.student_id');
        $this->db->join('student', 'student.id=student_group.student_id');
        $this->db->join('batch', 'batch.id=student_group.batch_id');
        $this->db->join('department', 'department.id=student_group.depart_id');
        $this->db->join('group', 'group.id=student_group.group_id');
        $this->db->where($where);
        $query = $this->db->get($this->table_name4);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
        return false;
    }

}
