<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Admin_controller.php';

class Admin_home extends Admin_controller
{
  public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        
    }
    public function index()
    {
        $total_users = $this->Common_model->get_multi_selected_data(K_USERS, array());
            $result['users_data']['total_users'] =  count($total_users);
        $reported_users = $this->Common_model->get_multi_selected_data(F_USERS, array());
            $result['users_data']['reported_users'] =  count($reported_users);
        $blocked_users = $this->Common_model->get_multi_selected_data(K_USERS, array('block' => 1));
            $result['users_data']['blocked_users'] =  count($blocked_users);    
        //pre($result['users_data']);
        $page_data['page_title'] = 'Dashboard';
        $this->admin_views($page_data, 'dashboard', $result, null);
    }


}