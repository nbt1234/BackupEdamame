<?php
defined('BASEPATH') or exit('No direct script access allowed');

$CI = &get_instance();
$CI->load->database();

$info = $CI->db->get_where(EMAIL, array('type' => 'smtp'))->row_array();

// pre($info);

$config['mailtype'] = 'html';

if ($info['type'] == 'smtp' && $info['status'] == 0) {
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = $info['smtp_host'];
    $config['smtp_port'] = $info['smtp_port'];
    $config['smtp_user'] = $info['smtp_user'];
    $config['smtp_pass'] = $info['smtp_pass'];
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8';
}
