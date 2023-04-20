<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Admin_controller.php';

class Users extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('Custom_model');
    }

    public function send_notifications($data)
    {
           // $users = $this->session->userdata('item');
           $users = $data;
            $admin = $this->Common_model->get_selected_data(USERS, array('role_status' => 1));
            $reciepents = $users['users'];
            $reciepents = json_decode($reciepents);
            $data = $this->Custom_model->get_multi_selected_data_c('device_token',K_USERS, array('block' => 0), 'email',$reciepents);
            $data = json_decode(json_encode($data));
            $data = array_column($data, 'device_token');
            $send = array(
               // 'userid' => $admin['userid'],
                'title' => $users['title'],
                'message' => $users['message'],
            );
          //  pre($data);
            foreach ($data as $key => $value) {
            $url = 'https://fcm.googleapis.com/fcm/send';
            $fields = array (
                    'to' => $value,
                    'notification' => array (
                            "body" => $send['message'],
                            "title" => $send['title'],
                            // "icon" => "myicon"
                    )
            );
           // pre($fields);
            $fields = json_encode ( $fields );
            $headers = array (
                    'Authorization: key=' . "AAAAhtSmBYc:APA91bHUXjbPcQcVyRVLCtdv0dT1PlclYCY_3M6QDVOxTPZvbS3gskdDCJWsml3Rzfex_th2cO_f-ArrUe0iHcOuV7wcmRaCYQzRWhswlyn3-GxntmMApmOUVZZqPBQf8p1xlIt7W1yT",
                    'Content-Type: application/json'
            );
            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $url );
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
            $result = curl_exec ( $ch );
           // pre($result);
            return $result;
            curl_close ( $ch );
            }   
    }


    // ALL USERS 
    public function index()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'users_section');

        $result['users_data'] = $this->Common_model->get_multi_selected_data(K_USERS, array('profile_type' => 'user'));
        // $result['users_data'] = $this->Common_model->get_multi_selected_data(USERS, array('role_status' => 3));

        // pre($result);
        $page_data['page_title'] = 'USERS';
        $this->admin_views($page_data, 'users/index', $result);
    }

    public function blocked_users()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'users_section');

        $result['users_data'] = $this->Common_model->get_multi_selected_data(K_USERS, array('profile_type' => 'user', 'block' =>1));
        // $result['users_data'] = $this->Common_model->get_multi_selected_data(USERS, array('role_status' => 3));

        // pre($result);
        $page_data['page_title'] = 'USERS';
        $this->admin_views($page_data, 'users/blocked-users', $result);
    }


    public function reported()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'users_section');
        $result1 = $this->Common_model->get_multi_selected_data(F_USERS, array());
        $result = array();
        $count = count($result1);
        for ($i = 0; $i < $count; $i++) {
            $result2 = $this->Common_model->get_selected_data(K_USERS, array('userid' => $result1[$i]['user_id']));
            $result['users_data'][$i]['userid'] =  $result2['userid'];
            $result['users_data'][$i]['email'] =  $result2['email'];
            $result['users_data'][$i]['name'] = $result2['first_name'] . " " . $result2['last_name'];
            $result['users_data'][$i]['user_block_status'] =  $result2['block'];
            $result3 = $this->Common_model->get_selected_data(K_USERS, array('userid' => $result1[$i]['flag_by']));
            $result['users_data'][$i]['reported_by'] = $result3['first_name'] . " " . $result3['last_name'];
        }
        $page_data['page_title'] = 'REPORTED USERS';
        $this->admin_views($page_data, 'users/reported', $result);
    }



    // NOTIFICATIONS FOR USERS 

    public function notifications() 
    {
        $this->subadmin_access_verify(session_get('euserId'), 'users_section');

        $result['users_data'] = $this->Common_model->get_multi_selected_data(K_USERS, array('profile_type' => 'user'));

        // pre($result);
        $page_data['page_title'] = 'NOTIFICATIONS FOR USERS';
        $this->admin_views($page_data, 'users/notification', $result);
    }


    public function send_notification()
    {   
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('message', 'message', 'required|max_length[200]');
        // $this->form_validation->set_rules('mobile[]', 'user', 'required');
        
        if ($this->form_validation->run()) {
            $users = json_encode($_POST['userid'], true);
            $data = array(
                'title' => $_POST['title'],
                'message' => $_POST['message'],
                'users' => $users,
            );

           // $this->session->set_userdata('item', $data);
            $result = $this->send_notifications($data);
            // $this->User->send_notifications($data);
            // pre($result);
            flash_site('success', 'Notifications Sent Successfully');
            redirect(base_url('admin/dashboard'));
            
    
        } else {
            $this->notifications();
        }
    }



    // FAKE USERS 

    // public function inbox()
    // {
    //     $this->subadmin_access_verify(session_get('euserId'), 'users_section');

    //     $result['users_data'] = $this->Common_model->get_multi_selected_data(USERS, array('role_status' => 3));

    //     // pre($result);
    //     $page_data['page_title'] = 'USER';
    //     $this->admin_views($page_data, 'users/inbox', $result);
    // }

    // FAKE USERS 

    // public function under_review()
    // {
    //     $this->subadmin_access_verify(session_get('euserId'), 'users_section');

    //     $result['users_data'] = $this->Common_model->get_multi_selected_data(USERS, array('role_status' => 3));

    //     // pre($result);
    //     $page_data['page_title'] = 'USERS UNDER REVIEW';
    //     $this->admin_views($page_data, 'users/under_review', $result);
    // }




    public function change_status_user()
    {
        if ($_POST['status'] == 'active') {
            $status_val = 0;
        }
        if ($_POST['status'] == 'inactive') {
            $status_val = 1;
        }

        $result = $this->Common_model->update_info(K_USERS, array(), array('userid' => $_POST['userid'], 'profile_type' => 'user'), array('block' => $status_val));

        if ($result) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function user_delete($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'users_section');

        $result = $this->Common_model->data_delete(USERS, array('ID' => $id, 'role_status' => 3));

        if ($result) {
            flash_site('success', 'User has deleted successfully');
            redirect(base_url('admin/all-users'));
        } else {
            flash_site('error', 'Error occured in deleting user');
            redirect(base_url('admin/all-users'));
        }
    }

    public function user_edit($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'users_section');

        $result['user_data'] = $this->Common_model->get_selected_data(USERS, array('ID' => $id));
        $page_data['page_title'] = 'USER-EDIT';
        $this->admin_views($page_data, 'users/edit-user', $result);
    }

    public function update_user($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'users_section');

        $this->form_validation->set_rules('bio', 'Bio', 'max_length[200]');
        $this->form_validation->set_rules('status', 'status', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('username', 'username', 'required|max_length[25]');
        $this->form_validation->set_rules('mobile', 'mobile', 'numeric|max_length[13]|min_length[9]');
        if ($this->form_validation->run()) {
            $user = array(
                'email' => $_POST['email'],
                'username' => ucfirst($_POST['username']),
                'mobile' => $_POST['mobile'],
                'bio' => $_POST['bio'],
                'user_block_status' => $_POST['status'],
                'updated_at' => date('Y-m-d H:i:s'),
            );
            if ($_FILES['avatar']['name'] != '') {
                $img_data = $this->admin_img_upload('./site-assets/img/user-avatar/', 'gif|png|jpeg|jpg', 'avatar', 'admin/user-page', true, '250', '200');
                $result = $this->Common_model->get_selected_data(USERS, array('ID' => $id));
                unlink('./site-assets/img/user-avatar/' . $result['avatar']);
                unlink('./site-assets/img/user-avatar/250-200' . $result['avatar']);
                $user['avatar'] = $img_data['upload_data']['file_name'];
            }
            $result = $this->Common_model->update_info(USERS, $user, array('ID' => $id), array());

            if ($result) {
                flash_site('success', 'User info updated successfully');
                redirect(base_url('admin/edit-user/' . $id));
            } else {
                flash_site('error', 'No changes have done');
                redirect(base_url('admin/edit-user/' . $id));
            }
        } else {
            $this->user_edit($id);
        }
    }

    public function viewprofile($userid=''){
       $userid =  $this->uri->segment('3');
       $result['user_data'] = $this->Common_model->get_selected_data(K_USERS,array('userid' => $userid));
       if($result['user_data']['mbti'] == "ISTJ"){
        $result['user_data']['mbti'] = "The Inspector";
       }else if($result['user_data']['mbti'] == "ISTP"){
        $result['user_data']['mbti'] = "The Crafter";
       }else if($result['user_data']['mbti'] == "ISFJ"){
        $result['user_data']['mbti'] = "The Protector";
        }else if($result['user_data']['mbti'] == "ISFP"){
        $result['user_data']['mbti'] = "The Artist";
        }else if($result['user_data']['mbti'] == "INFJ"){
        $result['user_data']['mbti'] = "The Advocate";
        }else if($result['user_data']['mbti'] == "INFP"){
        $result['user_data']['mbti'] = "The Mediator";
        }else if($result['user_data']['mbti'] == "INTJ"){
        $result['user_data']['mbti'] = "The Architect";
         }else if($result['user_data']['mbti'] == "INTP"){
        $result['user_data']['mbti'] = "The Thinker";
         }else if($result['user_data']['mbti'] == "ESTP"){
        $result['user_data']['mbti'] = "The Persuader";
         }else if($result['user_data']['mbti'] == "ESTJ"){
        $result['user_data']['mbti'] = "The Director";
         }else if($result['user_data']['mbti'] == "ESFP"){
        $result['user_data']['mbti'] = "The Performer";
         }else if($result['user_data']['mbti'] == "ESFJ"){
        $result['user_data']['mbti'] = "The Caregiver";
         }else if($result['user_data']['mbti'] == "ENFP"){
        $result['user_data']['mbti'] = "The Champion";
         }else if($result['user_data']['mbti'] == "ENFJ"){
        $result['user_data']['mbti'] = "The Giver";
         }else if($result['user_data']['mbti'] == "ENTP"){
        $result['user_data']['mbti'] = "The Debater";
         }else if($result['user_data']['mbti'] == "ENTJ"){
        $result['user_data']['mbti'] = "The Commander";
        }
       //pre($result);
       $page_data['page_title'] = 'VIEW-PROFILE';
       $this->admin_views($page_data, 'users/view-profile', $result);

    }
}
