<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Admin_controller.php';

class Login extends Admin_controller
{

    public function index()
    {
        // $this->session->sess_destroy();

        $loginStatus = session_get('isLoggedIn');
        if (!isset($loginStatus) || $loginStatus != true) {
            $this->load->view('admin/login');
        } else {
            redirect(base_url('admin/dashboard'));
        }
    }

    public function admin_login_verify()
    {
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run()) {
            $data = array('email' => $_POST['email'], 'password' => $_POST['password']);

            $result = $this->User_model->admin_user_login($data);
            if ($result) {
                set_all_sess($result);
                redirect(base_url('admin/dashboard'));
            } else {
                flash_site('error', 'Invalid Email or Password');
                redirect(base_url('admin'));
            }
        } else {
            $this->index();
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('admin'));
    }

    public function forget_password()
    {
        if (session_get('euserId')) {
            redirect(base_url());
        }

        $this->load->view('admin/forget-password');
    }

    public function verify_forget_password()
    {
        if (session_get('euserId')) {
            redirect(base_url());
        }

        $this->form_validation->set_rules('email', 'email', 'required|valid_email');

        if ($this->form_validation->run()) {
            $email = $this->input->post('email', true);
            $key = random_string('numeric', 6);
            $key_expire = date("Y-m-d H:i:s", strtotime("+30 minutes"));

            $result = $this->User_model->forget_otp_insertion($email, $key, $key_expire);

            if ($result == 'not_found') {
                flash_site('error', 'This email id does not exist');
                redirect(base_url('admin/forget-password'));
            } elseif ($result == 'error') {
                flash_site('error', 'OTP send fail');
                redirect(base_url('admin/forget-password'));
            } else {
                set_all_sess($result);
                sendMail($email, '', 'EDAMAME : Forget Password', "Your OTP To Recover Your Password is: $key");
                flash_site('success', ' An OTP is send on your email');
                redirect(base_url('admin/forget-otp'));
            }
        } else {
            $this->forget_password();
        }
    }

    public function forget_password_otp()
    {
        if (!session_get('fg_otp')) {
            redirect(base_url('admin/forget-password'));
        }
        $this->load->view('admin/forget-otp');
    }

    public function password_forget_otp_verify()
    {
        if (!session_get('fg_otp')) {
            redirect(base_url('admin/forget-password'));
        }
        $this->form_validation->set_rules('otp', 'otp', 'required');

        if ($this->form_validation->run()) {
            $email = session_get('fg_otp');
            $entered_otp = $_POST['otp'];

            $users = $this->Common_model->get_selected_data(USERS, array('email' => $email, 'forget_key' => $entered_otp));

            // pre($users);

            if (count($users) > 0) {
                $current_time = date("Y-m-d H:i:s");
                if (strtotime($users['expire_forget_key']) < strtotime($current_time)) {
                    flash_site('error', 'OTP has been expired');
                    redirect(base_url('admin/forget-otp'));
                } else {

                    $this->Common_model->update_info(USERS, array(), array('email' => $email), array('forget_key' => ''));
                    // $this->session->unset_userdata(array('fg_otp'));
                    flash_site('success', 'You can change your password now');
                    redirect(base_url('admin/recover-password'));
                }
            } else {
                flash_site('error', 'OTP is not correct');
                redirect(base_url('admin/forget-otp'));
            }
        } else {

            $this->forget_password_otp();
        }
    }

    public function password_recover()
    {
        if (session_get('euserId')) {
            redirect(base_url());
        }

        $this->load->view('admin/recover-password');
    }

    public function admin_password_reset_verify()
    {
        if (!session_get('fg_otp')) {
            redirect(base_url('admin/forget-password'));
        }

        $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[15]');
        $this->form_validation->set_rules('confirm_password', 'confirm password', 'required|matches[password]');

        if ($this->form_validation->run()) {
            $email = session_get('fg_otp');
            $password = $_POST['password'];

            $users = $this->Common_model->get_selected_data(USERS, array('email' => $email));

            if (count($users) > 0) {
                $enc_pass = getHashedPassword($password);

                $users = $this->Common_model->update_info(USERS, array('password' => $enc_pass), array('email' => $email), array());
                flash_site('success', 'Password Reset successfully');
                $this->session->unset_userdata(array('fg_otp'));
                redirect(base_url('admin'));
            } else {
                flash_site('error', 'Some error occured');
                redirect(base_url('admin/admin/recover-password'));
            }
        } else {
            $this->password_recover();
        }
    }

    public function admin_resend_otp()
    {
        if (session_get('euserId')) {
            redirect(base_url());
        }

        $email = session_get('fg_otp');
        $otp = random_string('numeric', 6);
        $key_expire = date("Y-m-d H:i:s", strtotime("+30 minutes"));

        $result = $this->Common_model->update_info(USERS, array('forget_key' => $otp, 'expire_forget_key' => $key_expire), array('email' => $email), array());

        $mail = sendMail($email, '', 'EDAMAME : Forget Password', "Your OTP To Recover Your Password is: $otp");

        if ($mail) {
            flash_site('success', 'An OTP is sent to your email');
            redirect(base_url('admin/forget-otp'));
        } else {
            flash_site('error', 'Error occured in sending OTP');
            redirect(base_url('admin/forget-otp'));
        }
    }

    public function denied_access()
    {
        $page_data['page_title'] = 'Access Denied';
        $this->load->view('admin/access-denied', $page_data);
    }

    public function edit_profile()
    {
        if (!session_get('euserId')) {
            redirect(base_url());
        }
        $user_id = session_get('euserId');

        $result['admin_data'] = $this->Common_model->get_selected_data(USERS, array('ID' => $user_id));

        $page_data['page_title'] = 'PROFILE';
        $this->admin_views($page_data, 'edit-admin', $result);
    }
    public function update_profile()
    {
        if (!session_get('euserId')) {
            redirect(base_url());
        }
        $user_id = session_get('euserId');

        $this->form_validation->set_rules('username', 'username', 'required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('mobile', 'mobile', 'required');
        // $this->form_validation->set_rules('user_block_status', 'status', 'required');
        $this->form_validation->set_rules('password', 'password', 'min_length[6]|max_length[15]');

        $admin_info = $this->Common_model->get_selected_data(USERS, array('ID' => $user_id));

        if ($admin_info['username'] != $_POST['username']) {
            $this->form_validation->set_rules('username', 'username', 'is_unique[elr_users.username]', array('is_unique' => 'This username already exist'));
        }

        if ($admin_info['email'] != $_POST['email']) {
            $this->form_validation->set_rules('email', 'email', 'is_unique[elr_users.email]', array('is_unique' => 'This email already exist'));
        }

        if ($this->form_validation->run()) {
            if ($_FILES['avatar']['name'] != '') {

                $img_data = $this->admin_img_upload('./site-assets/img/user-avatar/', 'gif|png|jpeg|jpg', 'avatar', 'admin/edit-admin/' . $user_id);

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

                unlink('./site-assets/img/user-avatar/' . $admin_info['avatar']);
                unlink('./site-assets/img/user-avatar/250-200-' . $admin_info['avatar']);

                $_POST['avatar'] = $img_data['upload_data']['file_name'];
            }

            $_POST['username'] = ucfirst($_POST['username']);
            $_POST['updated_at'] = date('Y-m-d H:i:s');

            if ($_POST['password'] != '') {
                $_POST['password'] = getHashedPassword($_POST['password']);
            } else {
                unset($_POST['password']);
            }

            $result = $this->Common_model->update_info(USERS, $_POST, array('ID' => $user_id), array());

            if ($result) {
                //update session
                $data = array('email' => $_POST['email'], 'password' => $_POST['password']);
                $res = $this->User_model->admin_user_login($data);
                if ($res) {
                    set_all_sess($res);
                }
                // session updated
                flash_site('success', 'admin info updated successfully');
                redirect(base_url('admin/edit-profile/'));
            } else {
                flash_site('error', 'No changes have done');
                redirect(base_url('admin/edit-profile/'));
            }
        } else {
            $this->edit_profile();
        }
    }
}
