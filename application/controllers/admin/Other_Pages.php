<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Admin_controller.php';

class Other_Pages extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
    }

    //CATEGORY
    public function terms_and_condition_home_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        $result['data'] = $this->Common_model->get_selected_data(OTHER_PAGES, array('type' => 'terms'));

        $page_data['page_title'] = 'Terms & Conditions';
        $this->admin_views($page_data, 'pages/other-pages/terms-and-condition', $result);
    }

    public function insert_terms_and_condition_home_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        $this->form_validation->set_rules('heading1', 'heading', 'required|max_length[50]');

        $this->form_validation->set_rules('newsletter-data', 'content', 'required');

        if ($this->form_validation->run()) {
            $result = $this->Common_model->update_info(OTHER_PAGES, array( 'heading' => trim($_POST['heading1']), 'content' => trim($_POST['newsletter-data'])), array('type' => 'terms'), array());
          //  pre($result);

            if ($result) {
                flash_site('success', 'Terms and condition updated successfully');
                redirect(base_url('admin/other-pages/terms-conditions'));
            } else {
                flash_site('error', 'No changes occured in terms and condition');
                redirect(base_url('admin/other-pages/terms-conditions'));
            }
        } else {
            $this->terms_and_condition_home_page();
        }
    }


    public function privacy_policy_home_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        $result['data'] = $this->Common_model->get_selected_data(OTHER_PAGES, array('type' => 'privacy'));

        $page_data['page_title'] = 'Privacy policy';
        $this->admin_views($page_data, 'pages/other-pages/privacy-policy', $result);
    }

    public function privacy_policy_home_pag()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        $this->form_validation->set_rules('heading1', 'heading', 'required|max_length[50]');

        $this->form_validation->set_rules('newsletter-data', 'content', 'required');

        if ($this->form_validation->run()) {
            $result = $this->Common_model->update_info(OTHER_PAGES, array('heading' => trim($_POST['heading1']), 'content' => trim($_POST['newsletter-data'])), array('type' => 'privacy'), array());
          //  pre($result);

            if ($result) {
                flash_site('success', 'Privacy policy updated successfully');
                redirect(base_url('admin/other-pages/privacy-policy'));
            } else {
                flash_site('error', 'No changes occured in privacy policy');
                redirect(base_url('admin/other-pages/privacy-policy'));
            }
        } else {
            $this->privacy_policy_home_page();
        }
    }
}
