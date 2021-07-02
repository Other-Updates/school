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
class Batch_model extends CI_Model {

    private $table_name = 'batch';
    private $table_name2 = 'subject_details';
    private $table_name3 = 'student';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all ur_title
     *
     * @return	array
     */
    function get_batch() {
        $this->db->select('*');
        //$this->db->where('df',0);
        $this->db->order_by('id', 'desc');
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
    /* 	function get_ur_title_by_id($id)
      {

      $this->db->where('id', $id);

      $query = $this->db->get($this->table_name);

      if ($query->num_rows() == 1) {
      return $query->result_array();
      }
      return false;
      }
     */

    /**
     * Insert new ur_title
     *
     * @param	array
     * @param	bool
     * @return	array
     */
    function insert_batch($data) {
        $this->db->insert($this->table_name, $data);
    }

    function update_admin($data, $id) {
        $this->db->where('id', $id);

        if ($this->db->update($this->table_name, $data)) {

            return true;
        }
        return false;
    }

    function get_default_batch() {
        $this->db->select('*');
        $this->db->where('status', 1);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function delete_list($id) {
        $this->db->where('id', $id);

        if ($this->db->update($this->table_name, $data = array('status' => 0))) {

            return true;
        }
        return false;
    }

    function delete_batch_inactive($id) {
        $query = $this->db->query("select a.id from student a,assignment b,time_table c,attendance d,subject_details e where a.batch_id='$id' or b.batch_id='$id' or c.batch_id='$id' or d.batch_id='$id' or e.batch_id='$id'");
        //$this->db->update($this->table_name3, $data=array('status'=>0,'df'=>1));
        /* $this->db->select('subject_details.*');
          $this->db->where('batch_id', $id);
          $query = $this->db->get($this->table_name2);
          //print_r($query);exit; */
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }

        return false;
    }

    function delete_batch($id) {
        $this->db->where('id', $id);

        if ($this->db->update($this->table_name, $data = array('df' => 1))) {

            return true;
        }
        return false;
    }

    function update_batch($data, $id) {
        $this->db->where('id', $id);

        if ($this->db->update($this->table_name, $data)) {

            return true;
        }
        return false;
    }

    function update_batchs($data, $id) {
        $this->db->where('id != ', $id);
        if ($this->db->update($this->table_name, $data)) {
            return true;
        }
        return false;
    }

    /* function update_alumni($inp,$id)
      {
      $this->db->where('id', $id);

      if ($this->db->update($this->table_name, $inp=array('status'=>2))) {

      return true;
      }
      return false;
      } */

    function validate_batch($ftd, $tdt) {
        $this->db->select('*');
        $this->db->where('from', $ftd);
        $this->db->where('to', $tdt);
        $this->db->where('df', 0);
        $query = $this->db->get('batch');
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

    function update_validate_batch($fdt, $tdt, $id) {
        $this->db->select('*');
        $this->db->where('id !=', $id);
        $this->db->where('from', $fdt);
        $this->db->where('to', $tdt);
        $this->db->where('df', 0);
        $query = $this->db->get('batch');
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
    }

}
