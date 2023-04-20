<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Admin_controller.php';

class Settings extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
    }

 

    // EMAIL SETTINGS

    public function email_setting()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'settings_section');

        $result['smtp'] = $this->Common_model->get_selected_data(EMAIL, array('ID' => 1, 'type' => 'smtp'));
        $result['server'] = $this->Common_model->get_selected_data(EMAIL, array('ID' => 2, 'type' => 'server'));

        $page_data['page_title'] = 'E-mail setting';
        $this->admin_views($page_data, 'settings/email-setting', $result);
    }

    public function email_smtp_insert()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'settings_section');

        $this->form_validation->set_rules('smtp_host', 'SMTP Host', 'required');
        $this->form_validation->set_rules('smtp_port', 'SMTP Port', 'required');
        $this->form_validation->set_rules('smtp_user', 'SMTP User', 'required|valid_email');
        $this->form_validation->set_rules('smtp_pass', 'password', 'required');
        $this->form_validation->set_rules('smtp_name', 'name', 'required|min_length[3]|max_length[20]');

        if ($this->form_validation->run()) {

            $data = array(
                'smtp_host' => trim($_POST['smtp_host']),
                'smtp_port' => trim($_POST['smtp_port']),
                'smtp_user' => trim($_POST['smtp_user']),
                'smtp_pass' => trim($_POST['smtp_pass']),
                'name' => trim($_POST['smtp_name']),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            if (isset($_POST['smtp-status'])) {
                $data['status'] = '0';
            }

            $result = $this->Common_model->update_info(EMAIL, $data, array('ID' => 1, 'type' => 'smtp'), array());

            if ($result) {
                flash_site('success', 'SMTP settings updated successfully');
                redirect(base_url('admin/settings/email_setting'));
            } else {
                flash_site('error', 'No changes have done');
                redirect(base_url('admin/settings/email_setting'));
            }
        } else {
            $this->email_setting();
        }
    }

    public function email_server_insert()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'settings_section');

        $this->form_validation->set_rules('username', 'User name', 'required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');

        if ($this->form_validation->run()) {

            $data = array(
                'name' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->Common_model->update_info(EMAIL, $data, array('ID' => 2, 'type' => 'server'), array());

            if ($result) {
                flash_site('success', 'server Settings updated successfully');
                redirect(base_url('admin/settings/email_setting'));
            } else {
                flash_site('error', 'No changes have done');
                redirect(base_url('admin/settings/email_setting'));
            }
        } else {
            $this->email_setting();
        }
    }

    // PAYMENTS SETTINGS

    public function payment_settings_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'settings_section');

        $result['paypal_status'] = $this->Common_model->get_selected_data(PAY_STATUS, array('type' => 'paypal'));

        $result['revolut_status'] = $this->Common_model->get_selected_data(PAY_STATUS, array('type' => 'revolut'));

        $result['paypal_mode'] = $this->Common_model->get_selected_data(PAY_MODE, array('type' => 'paypal'));

        $page_data['page_title'] = 'Payment Settings';
        $this->admin_views($page_data, 'settings/payments', $result);
    }

    public function payment_status()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'settings_section');

        if (isset($_POST['paypal_status']) || $_POST['paypal_status'] != null) {

            $paypal_status = array('status' => 0);

            $result = $this->Common_model->update_info(PAY_STATUS, $paypal_status, array('type' => 'paypal'));
            if ($result) {
                flash_site('success', 'Settings updated successfully');
            }
            // pre('$result');
        } else {
            $paypal_status = array('status' => 1);

            $result = $this->Common_model->update_info(PAY_STATUS, $paypal_status, array('type' => 'paypal'));
            if ($result) {
                flash_site('success', 'Settings updated successfully');
            }
        }

        if (isset($_POST['revolut_status']) || $_POST['revolut_status'] != null) {
            $revolut_status = array('status' => 0);

            $result = $this->Common_model->update_info(PAY_STATUS, $revolut_status, array('type' => 'revolut'));
            if ($result) {
                flash_site('success', 'Settings updated successfully');
            }
            // pre($result);
        } else {
            $revolut_status = array('status' => 1);

            $result = $this->Common_model->update_info(PAY_STATUS, $revolut_status, array('type' => 'revolut'));
            if ($result) {
                flash_site('success', 'Settings updated successfully');
            }
        }
        redirect(base_url('admin/settings/payments'));
    }

    public function paypal_payment_mode()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'settings_section');

        $this->form_validation->set_rules('paypal_client_id', 'client id', 'required');
        $this->form_validation->set_rules('paypal_secret_id', 'secret id', 'required');

        if ($this->form_validation->run()) {
            $details = array('paypal_client_id' => trim($_POST['paypal_client_id']),
                'paypal_secret_id' => trim($_POST['paypal_secret_id']),
            );

            $data = array(
                'details' => json_encode($details),
            );

            if (isset($_POST['paypal_mode']) || $_POST['paypal_mode'] != null) {
                $data['status'] = 0;
            } else {
                $data['status'] = 1;
            }

            $result = $this->Common_model->update_info(PAY_MODE, $data, array('ID' => 1, 'type' => 'paypal'), array());

            if ($result) {
                flash_site('success', 'Paypal settings updated successfully');
                redirect(base_url('admin/settings/payments'));
            } else {
                flash_site('error', 'No changes have done');
                redirect(base_url('admin/settings/payments'));
            }
        } else {
            $this->payment_settings_page();
        }
    }

}
