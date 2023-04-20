<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_controller extends CI_Controller
{

    public function admin_views($header_data = '', $view_name = '', $view_data = '', $footer_data = '')
    {
        $this->load->view('admin/header', $header_data);
        $this->load->view('admin/' . $view_name, $view_data);
        $this->load->view('admin/footer', $footer_data);
    }

    public function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != true) {
            redirect(base_url('admin'));
        }
    }

    // $this->subadmin_access_verify(session_get('userId'), 'procedure');

    public function subadmin_access_verify($user_id = '', $page_name = '')
    {
        if (session_get('role') == 2) {
            $subadmin_data = $this->Common_model->get_selected_data(SUB_ACCESS, array('subadmin' => $user_id));

            $subadmin_all_data = $this->Common_model->get_selected_data(USERS, array('ID' => $user_id)); 

            // pre($subadmin_all_data);

            if($subadmin_all_data['user_block_status'] == 0){
                $subadmin_info = json_decode($subadmin_data['access_fields'], true);
                if (isset($subadmin_info) && !in_array($page_name, $subadmin_info)) {
                    redirect(base_url('admin/access-denied'));
                }
            }else{
                redirect(base_url('admin/access-denied'));
            }
            
        }
    }

    public function admin_img_upload($path = '', $format = '', $name = '', $url = '')
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = $format;
        $config['encrypt_name'] = true;
        $config['file_ext_tolower'] = true;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($name)) {
            $error = array('error' => $this->upload->display_errors());
            flash_site('error', $error['error']);
            redirect(base_url($url));
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        return $data;
    }

    public function unique_users_check($data = '', $name = '')
    {
        $username_data = $this->Common_model->get_selected_data(USERS, array('username' => trim($data)));

        $email_data = $this->Common_model->get_selected_data(USERS, array('email' => trim($data)));

        if (!empty($username_data)) {
            $this->form_validation->set_message('unique_users_check', 'This ' . $name . ' already exist');
            return false;
        } elseif (!empty($email_data)) {
            $this->form_validation->set_message('unique_users_check', 'This ' . $name . ' already exist');
            return false;
        } else {
            return true;
        }
    }

}
