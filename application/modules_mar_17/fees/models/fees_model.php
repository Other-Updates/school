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
class Fees_model extends CI_Model {

    private $table_name = 'fees_info';
    private $table_name1 = 'fees_details';
    private $table_name2 = 'master_fees_details';
    private $table_name3 = 'student';
    private $table_name4 = 'student_fees';
    private $table_name5 = 'student_other_fees';

    function __construct() {
        parent::__construct();
    }

    function check_fees($where) {
        $this->db->where($where);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_master_fees() {
        $this->db->where('status', 1);
        $query = $this->db->get($this->table_name2);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function insert_fees_info($data) {
        if ($this->db->insert($this->table_name, $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return false;
    }

    function insert_student_fees($data) {
        if ($this->db->insert($this->table_name4, $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return false;
    }

    function insert_student_fees_details($data) {
        if ($this->db->insert($this->table_name5, $data)) {
            return true;
        }
        return false;
    }

    function insert_fees_details($data) {
        if ($this->db->insert_batch($this->table_name1, $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return false;
    }

    function update_fees_info($id, $data) {
        $this->db->where('id', $id);
        if ($this->db->update($this->table_name, $data)) {
            return true;
        }
        return false;
    }

    function update_student_fees_details($fees_id, $roll_no) {
        $data = array('status' => '0');
        $this->db->where('fees_info_id', $fees_id);
        $this->db->where('roll_no', $roll_no);
        if ($this->db->update($this->table_name5, $data)) {
            return true;
        }
        return false;
    }

    function update_student_fees($fees_id, $roll_no) {
        $data = array('complete_status' => '1');
        $this->db->where('fees_info_id', $fees_id);
        $this->db->where('roll_no', $roll_no);
        if ($this->db->update($this->table_name4, $data)) {
            return true;
        }
        return false;
    }

    function delete_fees_details($id) {
        $this->db->where('fees_info_id', $id);
        if ($this->db->delete($this->table_name1)) {
            return true;
        }
        return false;
    }

    function get_all_sem_fees($billing_type) {
        $this->db->select($this->table_name . '.*');
        $this->db->select('batch.from,batch.to');
        //$this->db->select('semester.semester');
        $this->db->select('department.department');
        $this->db->where($this->table_name . '.status', 1);
        $this->db->or_where($this->table_name . '.status', 2);
        $this->db->or_where($this->table_name . '.status', 3);
        $this->db->where($this->table_name . '.df', 0);
        $this->db->join('batch', 'batch.id=' . $this->table_name . '.batch_id');
        //$this->db->join('semester','semester.id='.$this->table_name.'.semester_id');
        $this->db->join('department', 'department.id=' . $this->table_name . '.depart_id');
        $this->db->where('billing_type', $billing_type);
        $query = $this->db->get($this->table_name)->result_array();
        return $query;
    }

    function get_all_other_fees($billing_type) {
        $this->db->select($this->table_name . '.*');

        $this->db->where($this->table_name . '.df', 0);
        $this->db->where($this->table_name . '.billing_type', $billing_type);
        $query = $this->db->get($this->table_name)->result_array();
        return $query;
    }

    function get_all_sem_fees_by_id($id) {
        $this->db->select($this->table_name . '.*');
        $this->db->select('batch.from,batch.to,batch.id as batch_id');
        //$this->db->select('semester.semester,semester.id as semester_id');
        $this->db->select('department.department,department.id as department_id');
        $this->db->where($this->table_name . '.df', 0);
        $this->db->where($this->table_name . '.id', $id);
        $this->db->join('batch', 'batch.id=' . $this->table_name . '.batch_id');
        //$this->db->join('semester','semester.id='.$this->table_name.'.semester_id');
        $this->db->join('department', 'department.id=' . $this->table_name . '.depart_id');
        $this->db->where('billing_type', 1);
        $query = $this->db->get($this->table_name)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select($this->table_name1 . '.*');
            $this->db->select('master_fees_details.fees_name');
            $this->db->where($this->table_name1 . '.fees_info_id', $val['id']);
            $this->db->join('master_fees_details', 'master_fees_details.id=' . $this->table_name1 . '.master_fees_id');
            $query[$i]['fees_details'] = $this->db->get($this->table_name1)->result_array();
            $i++;
        }
        return $query;
    }

    function get_all_other_fees_by_id($id, $billing_type) {

        $this->db->select($this->table_name . '.*');
        $this->db->where($this->table_name . '.id', $id);
        $this->db->where($this->table_name . '.billing_type', $billing_type);
        /* 		$this->db->where($this->table_name.'.status',1);
          $this->db->or_where($this->table_name.'.status',2);
          $this->db->or_where($this->table_name.'.status',3); */
        $this->db->where($this->table_name . '.df', 0);
        $query = $this->db->get($this->table_name)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select($this->table_name1 . '.*');
            $this->db->select('master_fees_details.fees_name');
            $this->db->where($this->table_name1 . '.fees_info_id', $val['id']);
            $this->db->join('master_fees_details', 'master_fees_details.id=' . $this->table_name1 . '.master_fees_id');
            $query[$i]['fees_details'] = $this->db->get($this->table_name1)->result_array();
            $i++;
        }
        return $query;
    }

    function get_student_fees_details($roll_no) {
        $this->db->select($this->table_name3 . '.id,std_id,name,email_id,student_type,transport,hostel,image');
        $this->db->select('batch.from,batch.to,batch.id as batch_id');
        $this->db->select('department.department,department.id as depart_id');
        $this->db->select('group.group');
        $this->db->where($this->table_name3 . '.std_id', $roll_no);
        $this->db->join('batch', 'batch.id=' . $this->table_name3 . '.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name3 . '.id');
        $this->db->join('group', 'group.id=student_group.group_id');
        $this->db->join('department', 'department.id=student_group.depart_id');
        $query = $this->db->get($this->table_name3)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('fees_info.*');
            $this->db->where('billing_type', 'semester');
            $this->db->where('batch_id', $val['batch_id']);
            $this->db->where('depart_id', $val['depart_id']);
            $this->db->where('status', 2);
            $this->db->where('df', 0);
            $this->db->order_by('fees_info.semester_id', 'desc');
            $query[$i]['exam_info'] = $this->db->get('fees_info')->result_array();
            $j = 0;
            if (isset($query[$i]['exam_info']) && !empty($query[$i]['exam_info'])) {
                foreach ($query[$i]['exam_info'] as $val1) {
                    $this->db->select('amount,reason');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $this->db->where('status', 1);
                    $query[$i]['exam_info'][$j]['edit_amt'] = $this->db->get('student_other_fees')->result_array();

                    $this->db->select('payment_mode,amount,bank_name,barch,cheque_no,created_date,complete_status');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $query[$i]['exam_info'][$j]['payment_history'] = $this->db->get('student_fees')->result_array();
                    $j++;
                }
            }
            if ($val['transport'] == 1) {
                $this->db->select('fees_info.*');
                $this->db->where('billing_type', 'transport');
                //$this->db->where('status',1);
                $this->db->where('df', 0);
                $query[$i]['transport_info'] = $this->db->get('fees_info')->result_array();
            }
            $j = 0;
            if (isset($query[$i]['transport_info']) && !empty($query[$i]['transport_info'])) {
                foreach ($query[$i]['transport_info'] as $val1) {
                    $this->db->select('amount,reason');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $this->db->where('status', 1);
                    $query[$i]['transport_info'][$j]['edit_amt'] = $this->db->get('student_other_fees')->result_array();

                    $this->db->select('payment_mode,amount,bank_name,barch,cheque_no,created_date,complete_status');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $query[$i]['transport_info'][$j]['payment_history'] = $this->db->get('student_fees')->result_array();
                    $j++;
                }
            }
            if ($val['hostel'] == 1) {
                $this->db->select('fees_info.*');
                $this->db->where('billing_type', 'hostel');
                //$this->db->where('status',1);
                $this->db->where('df', 0);
                $query[$i]['hostel_info'] = $this->db->get('fees_info')->result_array();
            }
            $j = 0;
            if (isset($query[$i]['hostel_info']) && !empty($query[$i]['hostel_info'])) {
                foreach ($query[$i]['hostel_info'] as $val1) {
                    $this->db->select('amount,reason');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $this->db->where('status', 1);
                    $query[$i]['hostel_info'][$j]['edit_amt'] = $this->db->get('student_other_fees')->result_array();

                    $this->db->select('payment_mode,amount,bank_name,barch,cheque_no,created_date,complete_status');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $query[$i]['hostel_info'][$j]['payment_history'] = $this->db->get('student_fees')->result_array();
                    $j++;
                }
            }
            $i++;
        }
        return $query;
    }

    function get_all_batch() {
        $this->db->select('batch.id,from,to');
        $this->db->where($this->table_name . '.df', 0);
        $this->db->group_by($this->table_name . '.batch_id');
        $this->db->join('batch', 'batch.id=' . $this->table_name . '.batch_id');
        $query = $this->db->get($this->table_name)->result_array();
        return $query;
    }

    function get_all_department($batch_id) {
        $this->db->select('department.id,department');
        $this->db->where($this->table_name . '.batch_id', $batch_id);
        $this->db->group_by($this->table_name . '.depart_id');
        $this->db->join('department', 'department.id=' . $this->table_name . '.depart_id');
        $query = $this->db->get($this->table_name)->result_array();
        return $query;
    }

    function get_all_sem($depart_id) {
        $this->db->select('semester_id');
        $this->db->where($this->table_name . '.depart_id', $depart_id);
        $this->db->group_by($this->table_name . '.semester_id');
        //$this->db->join('semester','semester.id='.$this->table_name.'.semester_id');
        $query = $this->db->get($this->table_name)->result_array();
        return $query;
    }

    function get_all_group_by_depart_id($depart_id) {
        $this->db->select('id,group');
        $this->db->where($depart_id);
        $query = $this->db->get('group')->result_array();
        return $query;
    }

    function get_all_bill_name($where) {
        $this->db->select('id,bill_name');
        $this->db->where($where);
        $query = $this->db->get($this->table_name)->result_array();
        return $query;
    }

    function get_all_student($where) {
        $this->db->select($this->table_name3 . '.id,std_id,name,student_type,image');
        //$this->db->select('batch.from,batch.to,batch.id as batch_id');
        //$this->db->select('department.department,department.id as depart_id');
        $this->db->select('student_group.batch_id', $where['batch_id']);
        $this->db->select('student_group.depart_id', $where['depart_id']);
        $this->db->select('student_group.group_id', $where['group_id']);
        $this->db->where('student_group.batch_id', $where['batch_id']);
        $this->db->where('student_group.depart_id', $where['depart_id']);
        $this->db->where('student_group.group_id', $where['group_id']);
        if ($where['student_type'] != 3) {
            $this->db->where('student.student_type', $where['student_type']);
        }
        //$this->db->join('batch','batch.id='.$this->table_name3.'.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name3 . '.id');
        //$this->db->join('group','group.id=student_group.group_id');
        //$this->db->join('department','department.id=student_group.depart_id');
        $query = $this->db->get($this->table_name3)->result_array();

        $i = 0;
        foreach ($query as $val) {
            $this->db->select('fees_info.*');
            $this->db->where('billing_type', 'semester');
            $this->db->where('batch_id', $val['batch_id']);
            $this->db->where('depart_id', $val['depart_id']);
            $this->db->where('id', $where['fees_id']);
            //$this->db->where('df',0);
            $this->db->order_by('fees_info.semester_id', 'desc');
            $query[$i]['exam_info'] = $this->db->get('fees_info')->result_array();
            $j = 0;
            if (isset($query[$i]['exam_info']) && !empty($query[$i]['exam_info'])) {
                foreach ($query[$i]['exam_info'] as $val1) {
                    $this->db->select('amount,reason');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $this->db->where('status', 1);
                    $query[$i]['exam_info'][$j]['edit_amt'] = $this->db->get('student_other_fees')->result_array();

                    $this->db->select('payment_mode,amount,bank_name,barch,cheque_no,created_date,complete_status');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $query[$i]['exam_info'][$j]['payment_history'] = $this->db->get('student_fees')->result_array();
                    $j++;
                }
            }

            $i++;
        }
        return $query;
    }

    function get_all_student_for_hostel($where) {
        $this->db->select($this->table_name3 . '.id,std_id,name,student_type,image');
        //$this->db->select('batch.from,batch.to,batch.id as batch_id');
        //$this->db->select('department.department,department.id as depart_id');
        $this->db->select('student_group.batch_id', $where['batch_id']);
        $this->db->select('student_group.depart_id', $where['depart_id']);
        $this->db->select('student_group.group_id', $where['group_id']);
        $this->db->where($this->table_name3 . '.hostel', 1);
        //$this->db->join('batch','batch.id='.$this->table_name3.'.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name3 . '.id');
        //$this->db->join('group','group.id=student_group.group_id');
        //$this->db->join('department','department.id=student_group.depart_id');
        $query = $this->db->get($this->table_name3)->result_array();

        $i = 0;
        foreach ($query as $val) {
            $this->db->select('fees_info.*');
            $this->db->where('billing_type', 'hostel');
            $this->db->where('id', $where['fees_id']);
            //$this->db->where('df',0);
            $this->db->order_by('fees_info.semester_id', 'desc');
            $query[$i]['exam_info'] = $this->db->get('fees_info')->result_array();
            $j = 0;
            if (isset($query[$i]['exam_info']) && !empty($query[$i]['exam_info'])) {
                foreach ($query[$i]['exam_info'] as $val1) {
                    $this->db->select('amount,reason');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $this->db->where('status', 1);
                    $query[$i]['exam_info'][$j]['edit_amt'] = $this->db->get('student_other_fees')->result_array();

                    $this->db->select('payment_mode,amount,bank_name,barch,cheque_no,created_date,complete_status');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $query[$i]['exam_info'][$j]['payment_history'] = $this->db->get('student_fees')->result_array();
                    $j++;
                }
            }

            $i++;
        }
        return $query;
    }

    function get_fees_info($where) {
        $this->db->select('fees_info.*');
        $this->db->where('id', $where['fees_id']);
        $query = $this->db->get('fees_info')->result_array();
        return $query;
    }

    function get_student_fees_details1($roll_no, $fees_id) {
        $this->db->select($this->table_name3 . '.id,std_id,name,email_id,student_type,transport,hostel,image');
        $this->db->select('batch.from,batch.to,batch.id as batch_id');
        $this->db->select('department.department,department.id as depart_id');
        $this->db->select('group.group');
        $this->db->where($this->table_name3 . '.std_id', $roll_no);
        $this->db->join('batch', 'batch.id=' . $this->table_name3 . '.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name3 . '.id');
        $this->db->join('group', 'group.id=student_group.group_id');
        $this->db->join('department', 'department.id=student_group.depart_id');
        $query = $this->db->get($this->table_name3)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('fees_info.*');
            $this->db->where('billing_type', 'semester');
            $this->db->where('batch_id', $val['batch_id']);
            $this->db->where('depart_id', $val['depart_id']);
            $this->db->where('id', $fees_id);
            $this->db->where('df', 0);
            $this->db->order_by('fees_info.semester_id', 'desc');
            $query[$i]['exam_info'] = $this->db->get('fees_info')->result_array();
            $j = 0;
            if (isset($query[$i]['exam_info']) && !empty($query[$i]['exam_info'])) {
                foreach ($query[$i]['exam_info'] as $val1) {
                    $this->db->select('amount,reason');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $this->db->where('status', 1);
                    $query[$i]['exam_info'][$j]['edit_amt'] = $this->db->get('student_other_fees')->result_array();

                    $this->db->select('payment_mode,amount,bank_name,barch,cheque_no,created_date,complete_status');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $query[$i]['exam_info'][$j]['payment_history'] = $this->db->get('student_fees')->result_array();
                    $j++;
                }
            }

            $i++;
        }
        return $query;
    }

    function get_student_fees_details2($roll_no, $fees_id) {
        $this->db->select($this->table_name3 . '.id,std_id,name,email_id,student_type,transport,hostel,image');
        $this->db->select('batch.from,batch.to,batch.id as batch_id');
        $this->db->select('department.department,department.id as depart_id');
        $this->db->select('group.group');
        $this->db->where($this->table_name3 . '.std_id', $roll_no);
        $this->db->join('batch', 'batch.id=' . $this->table_name3 . '.batch_id');
        $this->db->join('student_group', 'student_group.student_id=' . $this->table_name3 . '.id');
        $this->db->join('group', 'group.id=student_group.group_id');
        $this->db->join('department', 'department.id=student_group.depart_id');
        $query = $this->db->get($this->table_name3)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select('fees_info.*');
            $this->db->where('billing_type', 'hostel');
            $this->db->where('id', $fees_id);
            $this->db->where('df', 0);
            $this->db->order_by('fees_info.semester_id', 'desc');
            $query[$i]['exam_info'] = $this->db->get('fees_info')->result_array();
            //echo "<pre>";
            //print_r($query[$i]['exam_info']);
            $j = 0;
            if (isset($query[$i]['exam_info']) && !empty($query[$i]['exam_info'])) {
                foreach ($query[$i]['exam_info'] as $val1) {
                    $this->db->select('amount,reason');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $this->db->where('status', 1);
                    $query[$i]['exam_info'][$j]['edit_amt'] = $this->db->get('student_other_fees')->result_array();

                    $this->db->select('payment_mode,amount,bank_name,barch,cheque_no,created_date,complete_status');
                    $this->db->where('fees_info_id', $val1['id']);
                    $this->db->where('roll_no', $val['std_id']);
                    $query[$i]['exam_info'][$j]['payment_history'] = $this->db->get('student_fees')->result_array();
                    $j++;
                }
            }

            $i++;
        }
        return $query;
    }

    function get_all_sem_fees_by_id2($id) {
        $this->db->select($this->table_name . '.*');

        $this->db->where($this->table_name . '.df', 0);
        $this->db->where($this->table_name . '.id', $id);
        $this->db->where('billing_type', 'hostel');
        $query = $this->db->get($this->table_name)->result_array();
        $i = 0;
        foreach ($query as $val) {
            $this->db->select($this->table_name1 . '.*');
            $this->db->select('master_fees_details.fees_name');
            $this->db->where($this->table_name1 . '.fees_info_id', $val['id']);
            $this->db->join('master_fees_details', 'master_fees_details.id=' . $this->table_name1 . '.master_fees_id');
            $query[$i]['fees_details'] = $this->db->get($this->table_name1)->result_array();
            $i++;
        }
        return $query;
    }

}
