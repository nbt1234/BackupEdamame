<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Admin_controller.php';

class Coupon extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
    }

    public function index()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'coupon_section');
        $result['coupons_data'] = $this->Common_model->get_multi_selected_data(COUPON, array());

        $page_data['page_title'] = 'COUPON';
        $this->admin_views($page_data, 'coupon/index', $result);
    }

    public function coupon_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'coupon_section');

        $result['coupons_data'] = $this->Common_model->get_multi_selected_data(COUPON, array());

        $page_data['page_title'] = 'COUPON';
        $this->admin_views($page_data, 'coupon/add-coupon', $result);
    }

    public function insert_coupon()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'coupon_section');

        $this->form_validation->set_rules('coupon_name', 'coupon name', 'required|min_length[6]|max_length[10]');
        $this->form_validation->set_rules('coupon_code', 'coupon code', 'required|min_length[6]|max_length[10]|is_unique[elr_coupon.coupon_code]');
        $this->form_validation->set_rules('discount', 'coupon', 'required|numeric');
        $this->form_validation->set_rules('no_of_users', 'limit', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');
        $this->form_validation->set_rules('type', 'discount type', 'required');
        

        if ($this->form_validation->run()) {

            $coupon_info = array(
            'coupon_name' => ucfirst($_POST['coupon_name']), 
            'coupon_code' =>trim(strtoupper($_POST['coupon_code'])),
            'discount' => $_POST['discount'],
            'limit_count' => $_POST['limit_count'],
            'no_of_users' => $_POST['no_of_users'],
            'dis_type' => $_POST['type'],
            'status' => $_POST['status'],
            'start_date'=>$_POST['start_date'],
            'end_date'=>$_POST['end_date']
            );
            // $uses_coupons=array(
            //     'coupon_code' =>trim(strtoupper($_POST['coupon_code'])),
            //     'reminder_limit_count' => $_POST['no_of_users'],
            // );
            $result = $this->Common_model->insert_info(COUPON, $coupon_info);
            // $result = $this->Common_model->insert_info('elr_coupon_uses', $uses_coupons);

            if ($result) {
                flash_site('success', 'Coupon added successfully');
                redirect(base_url('admin/coupon-page'));
            } else {
                flash_site('error', 'Error occured in adding coupon');
                redirect(base_url('admin/coupon-page'));
            }
        } else {
            $this->coupon_page();
        }
    }

    public function change_status_coupon()
    {
        if ($_POST['status'] == 'active') {
            $status_val = 0;
        }
        if ($_POST['status'] == 'inactive') {
            $status_val = 1;
        }

        $result = $this->Common_model->update_info(COUPON, array(), array('ID' => $_POST['id']), array('status' => $status_val));

        if ($result) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function coupon_edit($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'coupon_section');

        $result['coupon_info'] = $this->Common_model->get_selected_data(COUPON, array('ID' => $id));

        $page_data['page_title'] = 'COUPON';
        $this->admin_views($page_data, 'coupon/edit-coupon', $result);
    }

    public function coupon_update($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'coupon_section');

        $this->form_validation->set_rules('coupon_name', 'coupon name', 'required|min_length[6]|max_length[10]');
        $this->form_validation->set_rules('discount', 'coupon', 'required|numeric');
        $this->form_validation->set_rules('no_of_users', 'limit', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('status', 'status', 'required');

        if ($this->form_validation->run()) {

            $coupon_info = array('coupon_name' => ucfirst($_POST['coupon_name']), 'discount' => $_POST['discount'],
            'no_of_users' => $_POST['no_of_users'],
            'status' => $_POST['status'],
            'updated_at' => date('Y-m-d H:i:s')
        );

        $result = $this->Common_model->update_info(COUPON, $coupon_info, array('ID' => $id), array());

            if ($result) {
                flash_site('success', 'Coupon info updated successfully');
                redirect(base_url('admin/edit-coupon/' . $id));
            } else {
                flash_site('error', 'No changes have done');
                redirect(base_url('admin/edit-coupon/' . $id));
            }
        } else {
            $this->coupon_edit($id);
        }
    }

    public function coupon_delete($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'coupon_section');

        $result = $this->Common_model->data_delete(COUPON, array('ID' => $id));

        if ($result) {
            flash_site('success', 'Coupon has deleted successfully');
            redirect(base_url('admin/coupon'));
        } else {
            flash_site('error', 'Error occured in deleting coupon');
            redirect(base_url('admin/coupon'));
        }
    }

}
