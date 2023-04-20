<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Admin_controller.php';

class Vendors extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
    }

    public function index()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'vendor_section');

        $result['vendors_data'] = $this->Common_model->get_multi_selected_data(VENDOR, array(), array('by_col' => 'created_at', 'order' => 'DESC'));

        $page_data['page_title'] = 'Vendors';
        $this->admin_views($page_data, 'vendors/index', $result);
    }

    public function vendor_page()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'vendor_section');

        $page_data['page_title'] = 'Vendors';
        $this->admin_views($page_data, 'vendors/add-vendor');
    }

    public function insert_vendor()
    {
        $this->subadmin_access_verify(session_get('euserId'), 'vendor_section');

        $this->form_validation->set_rules('vendor_name', 'vendor name', 'required');
        $this->form_validation->set_rules('tag_name', 'tag name', 'required');
        $this->form_validation->set_rules('tag_color', 'tag color', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');

        if ($_FILES['vendor_image']['name'] == '') {
            $this->form_validation->set_rules('vendor_image', 'vendor image', 'required');
        }

        if ($this->form_validation->run()) {
            $img_data = $this->admin_img_upload('./assets/img/vendors/', 'gif|png|jpeg|jpg', 'vendor_image', 'admin/vendor-page');
            
            $_POST['vendor_image'] = $img_data['upload_data']['file_name'];
            $_POST['vendor_name'] = ucfirst($_POST['vendor_name']);
            $_POST['tag_name'] = strtoupper($_POST['tag_name']);

            $result = $this->Common_model->insert_info(VENDOR, $_POST);

            if ($result) {
                flash_site('success', 'Vendor added successfully');
                redirect(base_url('admin/vendor-page'));
            } else {
                flash_site('error', 'Error occured in adding vendor');
                redirect(base_url('admin/vendor-page'));
            }
        } else {
            $this->vendor_page();
        }
    }

    public function change_status_vendor()
    {
        if ($_POST['status'] == 'active') {
            $status_val = 0;
        }
        if ($_POST['status'] == 'inactive') {
            $status_val = 1;
        }

        $result = $this->Common_model->update_info(VENDOR, array(), array('ID' => $_POST['id']), array('status' => $status_val));

        if ($result) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function vendor_edit($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'vendor_section');

        $result['vendor_info'] = $this->Common_model->get_selected_data(VENDOR, array('ID' => $id));

        $page_data['page_title'] = 'Vendors';
        $this->admin_views($page_data, 'vendors/edit-vendor', $result);
    }

    public function vendor_update($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'vendor_section');

        $this->form_validation->set_rules('vendor_name', 'vendor name', 'required');
        $this->form_validation->set_rules('tag_name', 'tag name', 'required');
        $this->form_validation->set_rules('tag_color', 'tag color', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');

        if ($this->form_validation->run()) {

            if ($_FILES['vendor_image']['name'] != '') {
                $vendor_info = $this->Common_model->get_selected_data(VENDOR, array('ID' => $id));
                
                  $img_data = $this->admin_img_upload('./assets/img/vendors/', 'gif|png|jpeg|jpg', 'vendor_image', 'admin/vendor-page/'.$id);
                
                unlink('assets/img/vendors/' . $vendor_info['vendor_image']);

                $_POST['vendor_image'] = $img_data['upload_data']['file_name'];
            }

            $_POST['updated_at'] = date('Y-m-d H:i:s');
            
            $result = $this->Common_model->update_info(VENDOR, $_POST, array('ID' => $id), array());

            if ($result) {
                flash_site('success', 'Vendor info updated successfully');
                redirect(base_url('admin/edit-vendor/' . $id));
            } else {
                flash_site('error', 'No changes have done');
                redirect(base_url('admin/edit-vendor/' . $id));
            }
        } else {
            $this->vendor_edit($id);
        }
    }

    public function vendor_delete($id = '')
    {
        $this->subadmin_access_verify(session_get('euserId'), 'vendor_section');

        $vendor_info = $this->Common_model->get_selected_data(VENDOR, array('ID' => $id));
        unlink('assets/img/vendors/' . $vendor_info['vendor_image']);
        $result = $this->Common_model->data_delete(VENDOR, array('ID' => $id));

        if ($result) {
            flash_site('success', 'Vendor has deleted successfully');
            redirect(base_url('admin/vendors'));
        } else {
            flash_site('error', 'Error occured in deleting vendor');
            redirect(base_url('admin/vendors'));
        }
    }

}
