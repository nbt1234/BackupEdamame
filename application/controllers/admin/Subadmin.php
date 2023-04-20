<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Admin_controller.php';

class Subadmin extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
    }

    public function index()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'subadmin_section');

        $result['subadmins_data'] = $this->Common_model->get_multi_selected_data(USERS, array('role_status' => 2));

        $page_data['page_title'] = 'SUBADMIN';
        $this->admin_views($page_data, 'subadmin/index', $result);
    }

    public function subadmin_page()
    {
        $page_data['page_title'] = 'SUBADMIN';
        $this->admin_views($page_data, 'subadmin/add-subadmin');
    }

    public function insert_subadmin()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'subadmin_section');

        $this->form_validation->set_rules('username', 'username', 'required|min_length[3]|max_length[20]|is_unique[elr_users.username]', array('is_unique' => 'This username already exist'));
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[elr_users.email]', array('is_unique' => 'This email already exist'));
        $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[15]');
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        $this->form_validation->set_rules('user_block_status', 'status', 'required');

        if ($_FILES['avatar']['name'] == '') {
            $this->form_validation->set_rules('avatar', 'vendor image', 'required');
        }

        if ($this->form_validation->run()) {
            $img_data = $this->admin_img_upload('./site-assets/img/user-avatar/', 'gif|png|jpeg|jpg', 'avatar', 'admin/subadmin-page');

            $config['image_library'] = 'gd2';
            $config['source_image'] = './site-assets/img/user-avatar/' . $img_data['upload_data']['file_name'];
            $config['new_image'] = './site-assets/img/user-avatar/250-200-' . $img_data['upload_data']['file_name'];
            $config['create_thumb'] = false;
            $config['maintain_ratio'] = true;
            $config['width'] = 250;
            $config['height'] = 200;
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            $_POST['avatar'] = $img_data['upload_data']['file_name'];
            $_POST['username'] = ucfirst($_POST['username']);
            $_POST['role_status'] = 2;
            $_POST['password'] = getHashedPassword($_POST['password']);

            $result = $this->Common_model->insert_info(USERS, $_POST, true);

            $this->Common_model->insert_info(SUB_ACCESS, array('subadmin' => $result, 'created_by' => session_get('euserId'), 'access_fields' => '{}'));

            if ($result) {
                flash_site('success', 'Subadmin added successfully');
                redirect(base_url('admin/subadmin-page'));
            } else {
                flash_site('error', 'Error occured in adding subadmin');
                redirect(base_url('admin/subadmin-page'));
            }
        } else {
            $this->subadmin_page();
        }
    }

    public function change_status_subadmin()
    {
        if ($_POST['status'] == 'active') {
            $status_val = 0;
        }
        if ($_POST['status'] == 'inactive') {
            $status_val = 1;
        }

        $result = $this->Common_model->update_info(USERS, array(), array('ID' => $_POST['id'], 'role_status' => 2), array('user_block_status' => $status_val));

        if ($result) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function subadmin_edit($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'subadmin_section');

        $result['subadmin_data'] = $this->Common_model->get_selected_data(USERS, array('ID' => $id));

        $page_data['page_title'] = 'FLAVOUR';
        $this->admin_views($page_data, 'subadmin/edit-subadmin', $result);
    }

    public function subadmin_update($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'subadmin_section');

        $this->form_validation->set_rules('username', 'username', 'required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        $this->form_validation->set_rules('user_block_status', 'status', 'required');
        $this->form_validation->set_rules('password', 'password', 'min_length[6]|max_length[15]');

        $subadmin_info = $this->Common_model->get_selected_data(USERS, array('ID' => $id));

        if ($subadmin_info['username'] != $_POST['username']) {
            $this->form_validation->set_rules('username', 'username', 'is_unique[elr_users.username]', array('is_unique' => 'This username already exist'));
        }

        if ($subadmin_info['email'] != $_POST['email']) {
            $this->form_validation->set_rules('email', 'email', 'is_unique[elr_users.email]', array('is_unique' => 'This email already exist'));
        }

        if ($this->form_validation->run()) {
            if ($_FILES['avatar']['name'] != '') {

                $img_data = $this->admin_img_upload('./site-assets/img/user-avatar/', 'gif|png|jpeg|jpg', 'avatar', 'admin/edit-subadmin/' . $id);

                $config['image_library'] = 'gd2';
                $config['source_image'] = './site-assets/img/user-avatar/' . $img_data['upload_data']['file_name'];
                $config['new_image'] = './site-assets/img/user-avatar/250-200-' . $img_data['upload_data']['file_name'];
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = true;
                $config['width'] = 250;
                $config['height'] = 200;
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                unlink('./site-assets/img/user-avatar/' . $subadmin_info['avatar']);
                unlink('./site-assets/img/user-avatar/250-200-' . $subadmin_info['avatar']);

                $_POST['avatar'] = $img_data['upload_data']['file_name'];
            }

            $_POST['username'] = ucfirst($_POST['username']);
            $_POST['updated_at'] = date('Y-m-d H:i:s');

            if ($_POST['password'] != '') {
                $_POST['password'] = getHashedPassword($_POST['password']);
            } else {
                unset($_POST['password']);
            }

            $result = $this->Common_model->update_info(USERS, $_POST, array('ID' => $id), array());

            if ($result) {
                flash_site('success', 'Subadmin info updated successfully');
                redirect(base_url('admin/edit-subadmin/' . $id));
            } else {
                flash_site('error', 'No changes have done');
                redirect(base_url('admin/edit-subadmin/' . $id));
            }
        } else {
            $this->subadmin_edit($id);
        }
    }

    public function subadmin_delete($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'subadmin_section');

        $result = $this->Common_model->data_delete(USERS, array('ID' => $id, 'role_status' => 2));

        if ($result) {
            flash_site('success', 'Subadmin has deleted successfully');
            redirect(base_url('admin/subadmin'));
        } else {
            flash_site('error', 'Error occured in deleting subadmin');
            redirect(base_url('admin/subadmin'));
        }
    }

    public function subadmin_access_ctrl($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'subadmin_section');

        $result['id'] = $id;

        $result['subadmin_data'] = $this->Common_model->get_selected_data(SUB_ACCESS, array('subadmin' => $id));
// pre($result['subadmin_data']);

        $page_data['page_title'] = 'Subadmin Access';
        $this->admin_views($page_data, 'subadmin/subadmin_access', $result, null);
    }

    public function insert_subadmin_access($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'subadmin_section');

        $user_id = session_get('euserId');

        $subadmin_data = $this->Common_model->get_selected_data(SUB_ACCESS, array('subadmin' => $id));

        if (!isset($_POST['fields'])) {
            $field_data = '{}';
        } else {

            $field_data = json_encode($_POST['fields'], JSON_FORCE_OBJECT);
        }

        $data = array(
            'subadmin' => $id,
            'access_fields' => $field_data,
            'created_by' => $user_id,
        );

        if (count($subadmin_data) > 0) {
            $result = $this->Common_model->update_info(SUB_ACCESS, $data, array('subadmin' => $id), array());
        } else {
            $result = $this->Common_model->insert_info(SUB_ACCESS, $data);
        }

        if ($result) {
            flash_site('success', 'Subadmin Access Granted successfully');
            redirect(base_url('admin/subadmin-access/' . $id));
        } else {
            flash_site('error', 'No changes occured');
            redirect(base_url('admin/subadmin-access/' . $id));
        }
    }

}
