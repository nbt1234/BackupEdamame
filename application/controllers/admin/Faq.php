<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Admin_controller.php';

class Faq extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
    }

    public function index()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'subadmin_section');

        $result['faqs_data'] = $this->Common_model->get_multi_selected_data(FAQ, array());

        $page_data['page_title'] = 'FAQ';
        $this->admin_views($page_data, 'faq/index', $result);
    }

    public function change_faq_status()
    {
        if ($_POST['status'] == 'active') {
            $status_val = 0;
        }
        if ($_POST['status'] == 'inactive') {
            $status_val = 1;
        }

        $result = $this->Common_model->update_info(FAQ, array(), array('ID' => $_POST['id']), array('status' => $status_val));

        if ($result) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
    // ADD FAQ
    public function faq_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'faq_section');

        $page_data['page_title'] = 'ADD FAQ';
        $this->admin_views($page_data, 'faq/add-faq');
    }

    public function insert_faq()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'faq_section');

        $this->form_validation->set_rules('question', 'question', 'required');
        $this->form_validation->set_rules('answer', 'answer', 'required');
        // $this->form_validation->set_rules('faq_code', 'faq code', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');

        if ($this->form_validation->run()) {

            $_POST['question']=trim($_POST['question']);
            $_POST['answer']=trim($_POST['answer']);
            $result = $this->Common_model->insert_info(FAQ, $_POST);

            if ($result) {
                flash_site('success', 'FAQ added successfully');
                redirect(base_url('admin/faq-page'));
            } else {
                flash_site('error', 'Error occured in adding faq');
                redirect(base_url('admin/faq-page'));
            }
        } else {
            $this->faq_page();
        }
    }
    // EDIT AND DELETE
    public function faq_edit($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'faq_section');

        $result['faq_info'] = $this->Common_model->get_selected_data(FAQ, array('ID' => $id));
        $page_data['page_title'] = 'FAQ';
        $this->admin_views($page_data, 'faq/edit-faq', $result);
    }

    public function faq_update($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'faq_section');

        $this->form_validation->set_rules('question', 'question', 'required');
        $this->form_validation->set_rules('answer', 'answer', 'required');
        // $this->form_validation->set_rules('faq_code', 'faq code', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');

        if ($this->form_validation->run()) {
            
            $_POST['question']=trim($_POST['question']);
            $_POST['answer']=trim($_POST['answer']);

            $result = $this->Common_model->update_info(FAQ, $_POST, array('ID' => $id), array());

            if ($result) {
                flash_site('success', 'FAQ updated successfully');
                redirect(base_url('admin/edit-faq/' . $id));
            } else {
                flash_site('error', 'No changes have done');
                redirect(base_url('admin/edit-faq/' . $id));
            }
        } else {
            $this->faq_edit($id);
        }
    }

    public function faq_delete($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'faq_section');

        $result = $this->Common_model->data_delete(FAQ, array('ID' => $id));

        if ($result) {
            flash_site('success', 'FAQ deleted successfully');
            redirect(base_url('admin/faq'));
        } else {
            flash_site('error', 'Error occured in deleting FAQ');
            redirect(base_url('admin/faq'));
        }
    }


}
