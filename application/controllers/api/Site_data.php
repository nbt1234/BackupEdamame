<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site_data extends CI_controller
{

    public function get_flavour_recipe()
    {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $flavour_data = $this->Common_model->get_multi_selected_data(FLAVOUR, array('status' => 0));

            if (!empty($flavour_data)) {
                echo json_encode(['status' => 'success', 'data' => $flavour_data]);
            } else {
                echo json_encode(['status' => 'fail', 'msg' => 'No flavour found']);
            }
        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
    }

    public function get_flavours_page_data()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            if (!isset($_POST['page']) || $_POST['page'] == null) {
                echo json_encode(['status' => 'fail', 'msg' => 'Some data is missing']);

            } else {
                $offset = $_POST['page'];

                $flavour_data = $this->Common_model->join_model(
                    FLAVOUR,
                    array('elr_flavour.status' => 0),
                    array(array('table' => VENDOR, 'value' => ' elr_flavour.vendor_id = elr_vendor.ID', 'type' => '')),
                    'elr_vendor.*,elr_flavour.*', array('by_col' => 'elr_flavour.created_at', 'order' => 'DESC'), [], 3, $offset
                );

                foreach ($flavour_data as $key => $value) {
                    $used_count = $this->Common_model->find_set(RECIPE, $value['ID'], 'count(*) as count', 'ingredient_id', array('status' => 0));
                    $flavour_data[$key]['used_count'] = $used_count[0]['count'];
                }

                if (!empty($flavour_data)) {
                    echo json_encode(['status' => 'success', 'data' => $flavour_data]);
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'No flavour data found']);
                }
            }
        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
    }

    public function flavours_search_data()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            if (!isset($_POST['page']) || $_POST['page'] == null || !isset($_POST['flavour']) || $_POST['flavour'] == null) {
                echo json_encode(['status' => 'fail', 'msg' => 'Some data is missing']);
            } else {
                $offset = $_POST['page'];
                $flavour_name = $_POST['flavour'];

                $all_flavour_data = $this->Common_model->join_model(
                    FLAVOUR,
                    array('elr_flavour.status' => 0),
                    array(array('table' => VENDOR, 'value' => ' elr_flavour.vendor_id = elr_vendor.ID', 'type' => '')),
                    'elr_vendor.*,elr_flavour.*', array('by_col' => 'elr_flavour.created_at', 'order' => 'DESC')
                );

                $flavour_data = $this->Common_model->join_model(
                    FLAVOUR,
                    array('elr_flavour.status' => 0),
                    array(array('table' => VENDOR, 'value' => ' elr_flavour.vendor_id = elr_vendor.ID', 'type' => '')),
                    'elr_vendor.*,elr_flavour.*', array('by_col' => 'elr_flavour.created_at', 'order' => 'DESC'), [], 3, $offset, array('like_column' => 'elr_flavour.flavour_name', 'srch_text' => $flavour_name)
                );

                foreach ($all_flavour_data as $key => $value) {
                    $used_count = $this->Common_model->find_set(RECIPE, $value['ID'], 'count(*) as count', 'ingredient_id', array('status' => 0));
                    $all_flavour_data[$key]['used_count'] = $used_count[0]['count'];
                }

                foreach ($flavour_data as $key => $value) {
                    foreach ($all_flavour_data as $all_key => $all_value) {
                        if ($all_value['ID'] == $value['ID']) {
                            $flavour_data[$key]['used_count'] = $all_value['used_count'];
                        }
                    }
                }
                
                if (!empty($flavour_data)) {
                    echo json_encode(['status' => 'success', 'data' => $flavour_data]);
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'No flavour data found']);
                }
            }

        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
    }
    public function show_all_recipies()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if (!isset($_POST['page']) || $_POST['page'] == null)
            {
                echo json_encode(['status' => 'fail', 'msg' => 'Some data is missing']);
            }else{
                $row=$_POST['page']*5;
                $recipes=$this->Common_model->get_full_data('ID,recipe_name,description,recipe_image','elr_recipes',array(),array('by_col' => 'elr_recipes.created_at', 'order' => 'DESC'),5,$row);
                foreach($recipes as $key=>$imgdata)
                {
                    $recipes[$key]['recipe_image']=base_url('site-assets/img/recipe-img/').$recipes[$key]['recipe_image'];
                }
                
                if(!empty($recipes))
                {
                    echo json_encode(['status' => 'success', 'data' => $recipes]);
                }else{
                    echo json_encode(['status' => 'fail', 'msg' => 'No data found']);
                }
            }

        }
    }
}
