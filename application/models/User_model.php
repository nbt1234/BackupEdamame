<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function admin_user_login($data = '')
    {
        $this->db->select('*');
        $this->db->from(USERS);
        $this->db->where('email', trim($data['email']));
        $this->db->where('role_status <>', 3);
        // $this->db->or_where('role_status', 2);
        $this->db->where('user_block_status', 0);

        $info = $this->db->get()->row_array();

        if (!empty($info)) {
            if (verifyHashedPassword(trim($data['password']), $info['password'])) {
                $sessionArray = array(
                    'euserId' => $info['ID'],
                    'role' => $info['role_status'],
                    'user_email' => $info['email'],
                    'isLoggedIn' => true,
                );
                return $sessionArray;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function forget_otp_insertion($email = '', $otp = '', $key_expire = '')
    {

        $this->db->select('*');
        $this->db->from(USERS);
        $this->db->where('email', $email);
        $this->db->where('role_status <>', 3);

        $info = $this->db->get()->row_array();

        if (!empty($info)) {
            $this->db->set('forget_key', $otp);
            $this->db->set('expire_forget_key', $key_expire);
            $this->db->where('email', $email);
            $this->db->update(USERS);

            if ($this->db->affected_rows()) {
                $otp = array('fg_otp' => $email);
                return $otp;
            } else {
                return 'error';
            }
        } else {
            return 'not_found';
        }
    }

    // --------------------------------FRONT USER--------------------------------

    public function insert_user_signup($data = '')
    {
        $this->db->select('*');
        $this->db->from(K_USERS);
        $this->db->where('social_id', $data['social_id']);
        // $this->db->or_where('username', $data['username']);
        $info = $this->db->get()->row_array();
        if(!empty($info)){
            if ($info['email'] == $data['email']) {
                return 'user_exist';
            }
        } else {
                $this->db->insert(K_USERS, $data);
                return $this->db->insert_id();
        }     
    }

    public function insert_user_login($data = '')
    {
        $this->db->select('*');
        $this->db->from(USERS);
        $this->db->where('email', $data['email']);
        $this->db->where('role_status', 3);
        $this->db->or_where('username', $data['email']);
        $info = $this->db->get()->row_array();

        if (!empty($info)) {
            if ($info['user_block_status'] == 1) {
                return 'block';
            }
            if (verifyHashedPassword($data['password'], $info['password'])) {
                $sessionArray = array(
                    'euserId' => $info['ID'],
                    'user_email' => $info['email'],
                    'username' => $info['username'],
                    'isLoggedIn' => true,
                );
                return $sessionArray;
            } else {
                return 'invalid';
            }
        } else {
            return 'no_exist';
        }
    }

    public function user_forget_otp_insertion($email = '', $otp = '', $key_expire = '')
    {

        $this->db->select('*');
        $this->db->from(USERS);
        $this->db->where('email', $email);
        $this->db->where('role_status', 3);

        $info = $this->db->get()->row_array();

        if (!empty($info)) {
            $this->db->set('forget_key', $otp);
            $this->db->set('expire_forget_key', $key_expire);
            $this->db->where('email', $email);
            $this->db->update(USERS);

            if ($this->db->affected_rows()) {
                $otp = array('fg_otp' => $email);
                return $otp;
            } else {
                return 'error';
            }
        } else {
            return 'not_found';
        }
    }

}
