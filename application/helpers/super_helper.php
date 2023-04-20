<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
function isAdmin() {
	$CI = get_instance();
	if($CI->session->userdata('role')=='1'){
		return true;
	}else{
		return false;
	}
}

function isSubadmin() {
	$CI = get_instance();
	if($CI->session->userdata('role')=='2'){
		return true;
	}else{
		return false;
	}
}

function access_denied() {
	redirect(base_url('admin/access-denied'));
}






?>