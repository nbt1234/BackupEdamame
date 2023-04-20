<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('getHashedPassword')) {
    function getHashedPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

if (!function_exists('verifyHashedPassword')) {
    function verifyHashedPassword($password, $db_password)
    {
        return password_verify($password, $db_password);
    }
}

if (!function_exists('pre')) {
    function pre($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die;
    }
}

if (!function_exists('url')) {
    function url($data = '')
    {
        echo base_url($data);
    }
}

if (!function_exists('set_all_sess')) {
    function set_all_sess($data)
    {
        $CI = get_instance();
        $CI->session->set_userdata($data);
    }
}

if (!function_exists('sess_site')) {
    function sess_site($status, $value)
    {
        $CI = get_instance();
        $CI->session->set_userdata($status, $value);
    }
}

if (!function_exists('session_get')) {
    function session_get($value)
    {
        $CI = get_instance();
        $session_val = $CI->session->userdata($value);
        return $session_val;
    }
}

if (!function_exists('flash_site')) {
    function flash_site($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}

if (!function_exists('flash_get')) {
    function flash_get($status)
    {
        $CI = get_instance();
        $flash = $CI->session->flashdata($status);
        return $flash;
    }
}

if (!function_exists('getBrowserDetails')) {
    function getBrowserDetails()
    {
        $CI = get_instance();
        $agent = '';

        if ($CI->agent->is_browser()) {
            $agent = $CI->agent->browser() . ' ' . $CI->agent->version();
        } else if ($CI->agent->is_robot()) {
            $agent = $CI->agent->robot();
        } else if ($CI->agent->is_mobile()) {
            $agent = $CI->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}


if (!function_exists('sendMail')) {
    function sendMail($to = '', $from = '', $sub = '', $msg = '', $cc = '', $bcc = '')
    {
        $CI = get_instance();
        $CI->email->set_newline("\r\n");

        $to_email = $CI->db->get_where(EMAIL, array('type' => 'server'))->row_array();

        $email_info = $CI->db->get_where(EMAIL, array('type' => 'smtp'))->row_array();

        if ($email_info['status'] == 1) {
            $email_info = $CI->db->get_where(EMAIL, array('type' => 'server'))->row_array();
        }

        if ($from == '') {
            $CI->email->from($email_info['email'], $email_info['name']);
            // $CI->email->set_header("Reply-To", $from);
        } else {
            $CI->email->from($from);
            // $CI->email->set_header("Reply-To", "testkronbtko2@gmail.com");
        }

        if ($to == '') {
            $CI->email->to($to_email['email']);
        } else {
            $CI->email->to($to);
        }

        if ($cc != '') {
            $CI->email->cc($cc);
        }
        if ($bcc != '') {
            $CI->email->bcc($bcc);
        }

        $CI->email->subject($sub);
        $CI->email->message($msg);
        $email_status = $CI->email->send();
        if ($email_status) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('getBrowserDetails')) {
    function getBrowserDetails()
    {
        $CI = get_instance();
        $agent = '';

        if ($CI->agent->is_browser()) {
            $agent = $CI->agent->browser() . ' ' . $CI->agent->version();
        } else if ($CI->agent->is_robot()) {
            $agent = $CI->agent->robot();
        } else if ($CI->agent->is_mobile()) {
            $agent = $CI->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }
        return $agent;
    }
}

