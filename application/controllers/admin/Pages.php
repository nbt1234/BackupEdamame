<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Admin_controller.php';

class Pages extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
    }

// BANNER
    public function banner_home_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        $result['banner_data'] = $this->Common_model->get_selected_data(HOME_BANNER, array('ID' => 1));

        $page_data['page_title'] = 'Home Banner';
        $this->admin_views($page_data, 'pages/home/banner', $result);
    }

    public function insert_banner_home_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        if ($_FILES['img_name']['name'] == '') {
            flash_site('error', 'Please choose an image for banner');
            redirect(base_url('admin/pages/home-page-banner'));
        } else {

            $banner_info = $this->Common_model->get_selected_data(HOME_BANNER, array('ID' => 1));

            $img_data = $this->admin_img_upload('./assets/img/pages/banner/', 'gif|png|jpeg|jpg', 'img_name', 'admin/pages/add-home-page-banner');

            unlink('assets/img/pages/banner/' . $banner_info['img_name']);

            $data['img_name'] = $img_data['upload_data']['file_name'];

            $result = $this->Common_model->update_info(HOME_BANNER, $data, array('ID' => 1));

            if ($result) {
                flash_site('success', 'Banner added successfully');
                redirect(base_url('admin/pages/home-page-banner'));
            } else {
                flash_site('error', 'Error occured in adding banner');
                redirect(base_url('admin/pages/home-page-banner'));
            }
        }
    }

    // SERVICES
    public function services_home_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        $result['service_data'] = $this->Common_model->get_full_data('*', HOME_SERVICE, array());

        $page_data['page_title'] = 'Home Services';
        $this->admin_views($page_data, 'pages/home/services', $result);
    }

    public function insert_services_home_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        $this->form_validation->set_rules('heading1', 'heading', 'required|max_length[30]');
        $this->form_validation->set_rules('heading2', 'heading', 'required|max_length[30]');
        $this->form_validation->set_rules('heading3', 'heading', 'required|max_length[30]');
        $this->form_validation->set_rules('content1', 'content', 'required|max_length[100]');
        $this->form_validation->set_rules('content2', 'content', 'required|max_length[100]');
        $this->form_validation->set_rules('content3', 'content', 'required|max_length[100]');

        if ($this->form_validation->run()) {

            for ($i = 1; $i < 4; $i++) {
                $result[] = $this->Common_model->update_info(HOME_SERVICE, array(), array('ID' => $i), array('heading' => trim($_POST['heading' . $i]), 'content' => trim($_POST['content' . $i])));

            }
            if (in_array(1, $result)) {
                flash_site('success', 'Services content updated successfully');
                redirect(base_url('admin/pages/home-page-services'));
            } else {
                flash_site('error', 'No changes occured in services');
                redirect(base_url('admin/pages/home-page-services'));
            }
        } else {
            $this->services_home_page();
        }
    }

    // CONTACT
    public function contacts_home_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        $result['contact_data'] = $this->Common_model->get_selected_data(HOME_CONTACT, array('ID' => 1));

        $result['newsletter_data'] = $this->Common_model->get_selected_data(HOME_NEWS, array('ID' => 1));

        $result['links_data'] = $this->Common_model->get_full_data('*', HOME_LINKS, array());

        $page_data['page_title'] = 'Home Contact';
        $this->admin_views($page_data, 'pages/home/contact', $result);
    }

    public function insert_contact_home_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        $this->form_validation->set_rules('contact-heading', 'heading', 'required|max_length[30]');
        $this->form_validation->set_rules('contact-data', 'content', 'required|max_length[200]');

        if ($this->form_validation->run()) {

            $result = $this->Common_model->update_info(HOME_CONTACT, array(), array('ID' => 1), array('heading' => trim($_POST['contact-heading']), 'content' => trim($_POST['contact-data'])));

            if ($result) {
                flash_site('success', 'Contact content updated successfully');
                redirect(base_url('admin/pages/home-page-contact'));
            } else {
                flash_site('error', 'No changes occured in contact');
                redirect(base_url('admin/pages/home-page-contact'));
            }
        } else {
            $this->contacts_home_page();
        }
    }

    public function insert_newsletter_home_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        $this->form_validation->set_rules('newsletter-heading', 'heading', 'required|max_length[30]');
        $this->form_validation->set_rules('newsletter-data', 'content', 'required|max_length[200]');

        if ($this->form_validation->run()) {

            $result = $this->Common_model->update_info(HOME_NEWS, array(), array('ID' => 1), array('heading' => trim($_POST['newsletter-heading']), 'content' => trim($_POST['newsletter-data'])));

            if ($result) {
                flash_site('success', 'Newsletter content updated successfully');
                redirect(base_url('admin/pages/home-page-contact'));
            } else {
                flash_site('error', 'No changes occured in newsletter');
                redirect(base_url('admin/pages/home-page-contact'));
            }
        } else {
            $this->contacts_home_page();
        }
    }

    public function insert_links_home_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        if (count(array_filter($_POST)) >= 2) {
            $type = array_keys($_POST);

            for ($i = 0; $i < count($_POST); $i++) {
                $result[] = $this->Common_model->update_info(HOME_LINKS, array(), array('type' => $type[$i]), array('link' => trim($_POST[$type[$i]])));
            }

            if (in_array(1, $result)) {
                flash_site('success', 'Links content updated successfully');
                redirect(base_url('admin/pages/home-page-contact'));
            } else {
                flash_site('error', 'No changes occured in links');
                redirect(base_url('admin/pages/home-page-contact'));
            }
        } else {
            flash_site('error', 'Please add atleast two links');
            redirect(base_url('admin/pages/home-page-contact'));
        }
    }

//CATEGORY
    public function category_home_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        $result['category_data'] = $this->Common_model->get_full_data('*', HOME_CATEGORY, array());

        $page_data['page_title'] = 'Home Category';
        $this->admin_views($page_data, 'pages/home/category', $result);
    }

    public function insert_category_home_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'pages_section');

        $this->form_validation->set_rules('heading1', 'heading', 'required|max_length[30]');

        $this->form_validation->set_rules('content1', 'content', 'required|max_length[100]');

        if ($this->form_validation->run()) {
            $type = array('heading', 'content');
            for ($i = 0; $i < 2; $i++) {
                $result[] = $this->Common_model->update_info(HOME_CATEGORY, array(), array('type' => $type[$i]),
                    array('data' => trim($_POST[$type[$i] . '1'])));
            }

            if (in_array(1, $result)) {
                flash_site('success', 'Category updated successfully');
                redirect(base_url('admin/pages/home-page-category'));
            } else {
                flash_site('error', 'No changes occured in category');
                redirect(base_url('admin/pages/home-page-category'));
            }
        } else {
            $this->category_home_page();
        }
    }
}
