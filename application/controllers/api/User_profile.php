<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . './libraries/Front_controller.php';

class User_profile extends Front_controller
{
    public function update_user_profile_post()
    {
        $user_id = $_POST['user_identity'];
        if ($_FILES['avatar']['name'] != '') {
            $img_data = $this->img_upload_lib('./site-assets/img/user-avatar/', 'gif|png|jpeg|jpg', 'avatar', true, '250', '200');

            $_POST['avatar'] = $img_data['upload_data']['file_name'];
        }

        $user_data = array('username' => trim($_POST['username']),
            'bio' => trim($_POST['bio']),
            'mobile' => trim($_POST['mobile']),
        );

        isset($_POST['avatar']) ? $user_data['avatar'] = $img_data['upload_data']['file_name'] : '';

        $user_info = $this->Common_model->update_info(USERS, $user_data, array('ID' => $user_id), array());

        if ($user_info) {
            $this->response(['status' => 'success', 'msg' => 'User info submitted successfully'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['status' => 'fail', 'msg' => 'No changes occured in your profile'], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function get_user_profile_post()
    {
        $user_id = $_POST['user_identity'];

        $user_data = $this->Common_model->get_full_data('email,username,mobile,bio,created_at,avatar', USERS, array('user_block_status' => 0, 'ID' => $user_id));

        if (!empty($user_data)) {
            $user_data[0]['avatar'] = base_url('site-assets/img/user-avatar/250-200-') . $user_data[0]['avatar'];
            $this->response(['status' => 'success', 'data' => $user_data], REST_Controller::HTTP_OK);
        } else {
            $this->response(['status' => 'fail', 'msg' => 'Some error occured in getting user info'], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function change_user_password_post()
    {
        $user_id = trim($_POST['user_identity']);
        $old_pass = trim($_POST['old_pass']);
        $new_pass = trim($_POST['new_pass']);
        $confirm_pass = trim($_POST['confirm_pass']);

        if ($new_pass == $confirm_pass) {
            $user_info = $this->Common_model->get_selected_data(USERS, array('ID' => $user_id));

            if (!empty($user_info)) {
                if (verifyHashedPassword($old_pass, $user_info['password'])) {

                    $pass_array = array('password' => getHashedPassword($new_pass), 'dec_password' => $new_pass);

                    $user_info = $this->Common_model->update_info(USERS, $pass_array, array('ID' => $user_id));

                    if ($user_info) {
                        $this->response(array('status' => 'success', 'msg' => 'Password updated successfully'), REST_Controller::HTTP_OK);
                    } else {
                        $this->response(['status' => 'fail', 'msg' => 'Some error occured in getting user info'], REST_Controller::HTTP_BAD_REQUEST);
                    }
                } else {
                    $this->response(['status' => 'fail', 'msg' => 'Old password does not match'], REST_Controller::HTTP_BAD_REQUEST);
                }
            } else {
                $this->response(['status' => 'fail', 'msg' => 'User does not match to our records'], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response(['status' => 'fail', 'msg' => 'Confirm password does not match'], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    //USER ADDRESS API

    public function update_user_address_post()
    {
        if (!isset($_POST['user_identity']) || $_POST['user_identity'] == null || !isset($_POST['billing_address']) || $_POST['billing_address'] == null || !isset($_POST['shipping_address']) || $_POST['shipping_address'] == null) {
            $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {
            $user_id = trim($_POST['user_identity']);

            $data = array(
                'user_id' => $user_id,
                'billing_address' => trim($_POST['billing_address']),
                'shipping_address' => trim($_POST['shipping_address']),
                'city' => trim($_POST['city']),
                'country' => trim($_POST['country']),
                'postcode' => trim($_POST['postcode']),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $user_address = $this->Common_model->get_selected_data(ADDRESS, array('user_id' => $user_id));
            if (count($user_address)) {
                $result = $this->Common_model->update_info(ADDRESS, $data, array('user_id' => $user_id), array());
            } else {
                $result = $this->Common_model->insert_info(ADDRESS, $data, array());
            }
            if ($result) {
                $this->response(['status' => 'success', 'msg' => 'Your address update successfully'], REST_Controller::HTTP_OK);
            } else {
                $this->response(['status' => 'fail', 'msg' => 'No changes occured'], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }



}
