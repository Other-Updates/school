<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events extends MX_Controller {

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
        /* <!--$permission=$this->master_model->get_staff_by_id($user_det['user_id'],$user_det['staff_type']);
          if($permission[0]['event']==0)
          redirect($this->config->item('base_url').'admin/index');	--> */
    }

    public function index() {
        $this->load->model('events/events_model');
        $data['all_batch'] = $this->events_model->get_all_batch();
        $data["details"] = $this->events_model->get_all_events();
        $data['batch'] = $this->batch_model->get_default_batch();
        $data['term'] = $this->subject_model->get_default_term();
        $this->template->write_view('content', 'events/index', $data);
        $this->template->render();
    }

    public function add_events() {
        $this->load->model('events/events_model');
        $user_det = $this->session->userdata('logged_in');
        $data['all_batch'] = $this->events_model->get_all_batch();
        $data['all_depart'] = $this->events_model->department();
        $data['batch'] = $this->batch_model->get_default_batch();
        $data['term'] = $this->subject_model->get_default_term();
        $this->load->model('api/notification_model');
        if ($this->input->post()) {
            $this->load->helper('text');

            $config['upload_path'] = './profile_image/events/orginal';

            $config['allowed_types'] = '*';

            $config['max_size'] = '2000';

            $this->load->library('upload', $config);

            $input_data = $this->input->post();

            /* if($input_data['type']=='department')
              {
              $where1=array(
              'type'=>$this->$input_data('type'),
              'batch_id'=>$this->$input_data('batch_id'),
              'depart_id'=>$this->input->post('depart_id'),
              'event_name'=>$this->input->post('event_name'),
              'date'=>$this->input->post('date'),
              'venue'=>$this->input->post('venue'),
              );
              }

              else
              {
              $where1=array(
              'type'=>$this->input->post('type'),
              'event_name'=>$this->input->post('event_name'),
              'date'=>$this->input->post('date'),
              'venue'=>$this->input->post('venue'),
              );
              } */

            if (isset($_FILES) && !empty($_FILES)) {

                $upload_files = $_FILES;
                $_FILES['image_name'] = array(
                    'name' => $upload_files['image_name']['name'],
                    'type' => $upload_files['image_name']['type'],
                    'tmp_name' => $upload_files['image_name']['tmp_name'],
                    'error' => $upload_files['image_name']['error'],
                    'size' => 10
                );
                $this->upload->do_upload("image_name");
                $upload_data = $this->upload->data();
                $dest = getcwd() . "/profile_image/events/thumb/" . $upload_data['file_name'];
                $src = $this->config->item("base_url") . 'profile_image/events/orginal/' . $upload_data['file_name'];
            }

            if ($upload_data['file_name'] != '')
                $input_data['image'] = $upload_data['file_name'];
            else
                $input_data['image'] = 'events.png';
            $ins_id = $this->events_model->events($input_data);
            //$inter=$this->events_model->where($where1);
            $title = 'Events Added';
            $session_data = $this->session->userdata('logged_in');
            $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);


            $last_id = $this->notification_model->insert_notification($insert_not);

            /* if($input_data['group_id']!=0)
              {
              $where1=array('depart_id'=>$input_data['depart_id'],'group_id'=>$input_data['group_id']);
              $where11=array('student_group.depart_id'=>$data['ajax_val']['depart_id'],'student_group.group_id'=>$input_data['group_id']);
              $all_student=$this->notification_model->get_all_student($where1);
              }
              else  $input_data['group_id']==0 && */
            if ($input_data['depart_id'] != '' && $input_data['type'] == 'department') {
                $where1 = array('student_group.depart_id' => $input_data['depart_id']);
                $where11 = array('student_group.depart_id' => $input_data['depart_id']);
                $all_student = $this->notification_model->get_all_student($where1);
            } else {
                $where11 = array('student_group.depart_id !=' => 100000);
                $all_student = $this->notification_model->get_all_public_student();
            }
            $all_staff = $this->notification_model->all_staff();

            //Time table mail template updated
            $links2 = 'users/events_view_page/' . $ins_id;
            $all_student_for_email = $this->notification_model->get_all_student_for_email($where11);
            /* foreach($all_student_for_email as $val1)
              {
              $this->load->library('email');
              $data['title']='[iBoard] '.$title;
              $this->email->from('noreply@email.com', 'iBoard');
              $this->email->to($val1['email_id']);
              $this->email->subject('[iBoard] '.$title);
              $this->email->set_mailtype("html");
              $input_data['student']=array('name'=>$val1['name'],'created_by'=>$session_data['name'],'time_table_type'=>'other_time_table','staff_type'=>'student','links'=>$links2,'title'=>$title);
              $msg = $this->load->view('time_table/time_table_email_formate',$input_data,TRUE);
              $this->email->message($msg);
              $this->email->send();
              }
             */

            $j = 0;
            foreach ($all_student as $val1) {
                $all_student[$j]['notification_id'] = $last_id['id'];
                $all_student[$j]['user_type'] = 'student';
                $all_student[$j]['links'] = 'users/events_view_page/' . $ins_id;
                $all_student[$j]['read'] = 0;
                unset($all_student[$j]['email_id']);

                $j++;
            }
            $this->notification_model->insert_all_staff($all_student);
            $i = 0;


            //Time table mail template added
            $where = array('subject_details.batch_id !=' => 100000);
            $all_staff_for_email = $this->notification_model->get_all_staff_for_email($where);

            $this->load->library('email');
            $links1 = 'events/view_events/' . $ins_id;
            /* foreach($all_staff_for_email as $val1)
              {
              $data['title']='[iBoard]'.$title;
              $this->email->from('noreply@email.com', 'iBoard');
              $this->email->to($val1['email_id']);
              $this->email->subject('[iBoard] '.$title);
              $this->email->set_mailtype("html");
              $input_data['student']=array('name'=>$val1['staff_name'],'created_by'=>$session_data['name'],'time_table_type'=>'other_time_table','staff_type'=>'staff','links'=>$links1,'title'=>$title);
              $msg = $this->load->view('time_table/time_table_email_formate',$input_data,TRUE);
              $this->email->message($msg);
              $this->email->send();
              } */

            foreach ($all_staff as $val1) {
                $all_staff[$i]['notification_id'] = $last_id['id'];
                $all_staff[$i]['user_type'] = 'staff';
                $all_staff[$i]['links'] = 'events/view_events/' . $ins_id;
                $all_staff[$i]['read'] = 0;
                unset($all_staff[$i]['email_id']);
                $i++;
            }
            $this->notification_model->insert_all_staff($all_staff);

            redirect($this->config->item('base_url') . 'events/');
        }
        $this->template->write_view('content', 'events/add_events', $data);
        $this->template->render();
    }

    public function get_all_group() {
        $this->load->model('events');
        $d_id = $this->input->post();
        $g_array = $this->student_model->get_all_group($d_id['depart_id']);
        $g_select = '<select id="group_id" name="student_group[group_id]"><option value="0">Select</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['group'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
    }

    function view_events($id) {
        $this->load->model('events/events_model');
        $value = $this->session->userdata('user_info');
        if (is_numeric($id)) {
            $data['events_info'] = $this->events_model->view_events($id);
            $data['students'] = $this->events_model->get_view_events($id);
        } else {
            redirect($this->config->item('base_url') . 'events/');
        }
        if (isset($data['events_info']) && !empty($data['events_info'])) {
            $this->template->write_view('content', 'events/view_events', $data);
            $this->template->render();
        } else {
            redirect($this->config->item('base_url') . 'events/');
        }
    }

    function update_view($id) {
        $this->load->model('events/events_model');
        //$data['all_group']=$this->events_model->group();
        if (is_numeric($id)) {
            $data['events_info'] = $this->events_model->view_events($id);
            if ($data['events_info'] . "[type]") {
                $data['all_depart'] = $this->events_model->department();
                // $data['all_batch'] = $this->events_model->get_all_batch();
                $data['batch'] = $this->batch_model->get_default_batch();
            } else {
                echo "";
            }
        } else {
            redirect($this->config->item('base_url') . 'events/');
        }
        if (isset($data['events_info']) && !empty($data['events_info'])) {

            $this->template->write_view('content', 'events/update_events', $data);
            $this->template->render();
        } else {
            redirect($this->config->item('base_url') . 'events/');
        }
    }

    function updateevent() {
        $this->load->model('events/events_model');
        //$this->load->model('group/group_model');
        $this->load->model('api/notification_model');
        if ($this->input->post()) {
            $this->load->helper('text');
            $config['upload_path'] = './profile_image/events/orginal';
            $config['allowed_types'] = '*';
            $config['max_size'] = '2000';
            $this->load->library('upload', $config);
            $upload_data['file_name'] = '';
            if (isset($_FILES) && !empty($_FILES)) {
                $upload_files = $_FILES;
                if ($upload_files['image_name']['name'] != '') {
                    $_FILES['image_name'] = array(
                        'name' => $upload_files['image_name']['name'],
                        'type' => $upload_files['image_name']['type'],
                        'tmp_name' => $upload_files['image_name']['tmp_name'],
                        'error' => $upload_files['image_name']['error'],
                        'size' => 10
                    );
                    $this->upload->do_upload("image_name");
                    $upload_data = $this->upload->data();
                    $dest = getcwd() . "/profile_image/events/thumb/" . $upload_data['file_name'];
                    $src = $this->config->item("base_url") . 'profile_image/events/orginal/' . $upload_data['file_name'];
                    $this->make_thumb($src, $dest, 50);
                }
                if ($upload_data['file_name'] != '')
                    $input_data['image'] = $upload_data['file_name'];
                unset($input_data['file_name']);
            }
            /* --Notification Added-- */
            $input_data = $this->input->post();
            $title = 'Events Updated';
            $session_data = $this->session->userdata('logged_in');
            $insert_not = array('notification' => $title, 'user_type' => $session_data['staff_type'], 'user_id' => $session_data['user_id'], 'name' => $session_data['name']);

            $last_id = $this->notification_model->insert_notification($insert_not);

            if ($input_data['group_id'] != 0) {
                $where1 = array('depart_id' => $input_data['depart_id'], 'group_id' => $input_data['group_id']);
                $all_student = $this->notification_model->get_all_student($where1);
            } else if ($input_data['group_id'] == 0 && $input_data['depart_id'] != '' && $input_data['type'] == 'department') {
                $where1 = array('depart_id' => $input_data['depart_id']);
                $all_student = $this->notification_model->get_all_student($where1);
            } else {
                $all_student = $this->notification_model->get_all_public_student();
            }
            $j = 0;
            foreach ($all_student as $val1) {
                $all_student[$j]['notification_id'] = $last_id['id'];
                $all_student[$j]['user_type'] = 'student';
                $all_student[$j]['links'] = 'users/events_view_page';
                $all_student[$j]['read'] = 0;
                unset($all_student[$j]['email_id']);
                $j++;
            }
            $this->notification_model->insert_all_staff($all_student);
            /* --Notification End-- */

            /* if($upload_data['file_name']!='')
              $input_data['image']=$upload_data['file_name'];
              unset($input_data['file_name']);
              if($input_data['staff']['pwd']=='')
              unset($input_data['staff']['pwd']);
              else
              $input_data['image']='events.png'; */
            $data['ued'] = $this->input->post();
            $event_date = date('Y-m-d', strtotime($data['ued']['date']));
            //echo "<pre>"; print_r($data['ued']); exit;
            $id = $data['ued']['id'];
            if ($upload_data['file_name'] != '') {
                $data['imagename'] = $_FILES['image_name'];
                $data['image'] = $upload_data['file_name'];
                $updatedata = array('depart_id' => $data['ued']['depart_id'], 'batch_id' => $data['ued']['batch_id'], /* 'group_id'=>$grp, */ 'image' => $upload_data['file_name'], 'event_name' => $data['ued']['event_name'], 'type' => $data['ued']['type'], 'venue' => $data['ued']['venue'], 'date' => $event_date);
            } else {
                $updatedata = array('depart_id' => $data['ued']['depart_id'], 'batch_id' => $data['ued']['batch_id'], 'event_name' => $data['ued']['event_name'], 'type' => $data['ued']['type'], 'venue' => $data['ued']['venue'], 'date' => $event_date);
            }
            //echo "<pre>"; print_r($data); exit;
            $this->events_model->update_events($updatedata, $id);
            $this->template->write_view('content', 'events/update_events', $data);
            redirect($this->config->item('base_url') . 'events/');
        }
    }

    /* --Notification Added-- */
    /* $input_data=$this->input->post();
      $title='Events Updated';
      $session_data=$this->session->userdata('logged_in');
      $insert_not=array('notification'=>$title,'user_type'=>$session_data['staff_type'],'user_id'=>$session_data['user_id'],'name'=>$session_data['name']);

      $last_id=$this->notification_model->insert_notification($insert_not);

      if($input_data['group_id']!=0)
      {
      $where1=array('depart_id'=>$input_data['depart_id'],'group_id'=>$input_data['group_id']);
      $all_student=$this->notification_model->get_all_student($where1);
      }
      else if($input_data['group_id']==0 && $input_data['depart_id']!='' && $input_data['type']=='department')
      {
      $where1=array('depart_id'=>$input_data['depart_id']);
      $all_student=$this->notification_model->get_all_student($where1);
      }
      else
      {
      $all_student=$this->notification_model->get_all_public_student();
      }
      $j=0;
      foreach($all_student as $val1)
      {
      $all_student[$j]['notification_id']=$last_id['id'];
      $all_student[$j]['user_type']='student';
      $all_student[$j]['links']='users/share_notes_view';
      $all_student[$j]['read']=0;
      $j++;
      }
      $this->notification_model->insert_all_staff($all_student); */
    /* --Notification End-- */


    /* ?>
      public function get_group_update()
      {
      $this->load->model('events/events_model');
      $dep_id=$this->input->post('d_id');
      $g_array=$this->events_model->group($id);
      $g_select='<select class="u_group_id" name="group_id" ><option value="0">Select</option>';
      if(isset($g_array) && !empty($g_array))
      {
      foreach($g_array as $val)
      {
      $g_select=$g_select."<option value='".$val['id']."'>".$val['group']."</option>";
      }
      }
      $g_select=$g_select.'</select>';
      echo "Group".$g_select;
      }
      <?php */

    function delete_events() {
        $this->load->model('events/events_model');
        $id = $this->input->post('value1');
        $this->events_model->delete_events($id);
        $data["details"] = $this->events_model->get_all_events();
        $data["status"] = 0;
        echo $this->load->view('view_list', $data);
    }

    public function get_alumni() {
        $this->load->model('events_model');
        $b_id = $this->input->post();
        $g_array = $this->events_model->get_alumni($b_id['batch_id']);
        $g_select = '<br/><select id="batch_id" name="batch_id" ><option value="" selected="selected">Select Alumni</option>';
        if (isset($g_array) && !empty($g_array)) {
            foreach ($g_array as $val) {
                $g_select = $g_select . "<option value='" . $val['id'] . "'>" . $val['from'] . '-' . $val['to'] . "</option>";
            }
        }
        $g_select = $g_select . '</select>';
        echo $g_select;
        //$i=0; if($alm){$i=1;}if($i==0){echo "";}
    }

    /* function delete_events_inactive()
      {
      $this->load->model('events/events_model');
      $id=$this->input->post('value1');
      $this->events_model->delete_events_inactive($id);
      $data["details"]=$this->events_model->get_events();
      $data["status"]=0;
      echo $this->load->view('view_list',$data);

      } */

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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
