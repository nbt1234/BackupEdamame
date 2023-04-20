<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . './libraries/Front_controller.php';

class Recipes extends Front_controller
{
    public function create_recipes_insert_post()
    {
        if (!isset($_POST['recipe_name']) || $_POST['recipe_name'] == null || !isset($_POST['ingredient_data']) || $_POST['ingredient_data'] == null || !isset($_POST['progress_status']) || $_POST['progress_status'] == null || !isset($_POST['original_status']) || $_POST['original_status'] == null || !isset($_POST['description']) || $_POST['description'] == null || !isset($_POST['note']) || $_POST['note'] == null || !isset($_POST['share_recipe']) || $_POST['share_recipe'] == null || !isset($_POST['shake_vape']) || $_POST['shake_vape'] == null || !isset($_POST['steep_days']) || $_POST['steep_days'] == null || !isset($_POST['vg_perc']) || $_POST['vg_perc'] == null) {
            $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);

        } elseif (!isset($_FILES['recipe_image']) || $_FILES['recipe_image']['name'] == '') {
            $this->response(['status' => 'fail', 'msg' => 'Please choose the image for recipe'], REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {

            $img_data = $this->img_upload_lib('./site-assets/img/recipe-img/', 'gif|png|jpeg|jpg', 'recipe_image', true, '250', '200');

            $recipe_image = $img_data['upload_data']['file_name'];

            $ingredient_data = json_decode($_POST['ingredient_data'], true);

            for ($i = 0; $i < count($ingredient_data); $i++) {
                $ingredient_ids[] = $ingredient_data[$i]['ingredient_id'];
                $ingredient_percs[] = $ingredient_data[$i]['ingredient_perc'];
            }
            $ingredient_id = implode(",", $ingredient_ids);
            $ingredient_perc = implode(",", $ingredient_percs);

            $recipe_data = array(
                'user_id' => trim($_POST['user_identity']),
                'recipe_name' => trim($_POST['recipe_name']),
                'ingredient_id' => trim($ingredient_id),
                'ingredient_perc' => trim($ingredient_perc),
                'progress_status' => trim($_POST['progress_status']),
                'original_status' => trim($_POST['original_status']),
                'description' => trim($_POST['description']),
                'note' => trim($_POST['note']),
                'share_recipe' => trim($_POST['share_recipe']),
                'shake_vape ' => trim($_POST['shake_vape']),
                'steep_days' => trim($_POST['steep_days']),
                'vg_perc' => trim($_POST['vg_perc']),
                'recipe_image' => $recipe_image,
                'calc_status' => 1,
                'cart_status' => 1,
                'status' => 1,
            );

            $result = $this->Common_model->insert_info(RECIPE, $recipe_data, true);

            if ($result) {
                $this->response(['status' => 'success', 'msg' => 'Recipe has been created successfully', 'data' => $result], REST_Controller::HTTP_OK);
            } else {
                $this->response(['status' => 'fail', 'msg' => 'Some error occured in saving recipe'], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function check_coupon_post()
    {
        if (!isset($_POST['coupon_code']) || $_POST['coupon_code'] == null || !isset($_POST['price']) || $_POST['price'] == null) {
            $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {
            $coupon_code = trim(strtoupper($_POST['coupon_code']));
            $user_id = trim($_POST['user_identity']);
            $price = trim($_POST['price']);
            $coupon_info = $this->Common_model->get_selected_data(COUPON, array('status' => 0, 'coupon_code' => $coupon_code));

            if ((empty($coupon_info))) {
                $this->response(['status' => 'fail', 'msg' => 'Invalid coupon code'], REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $coupon_used = $this->Common_model->get_multi_selected_data('elr_coupon_used', array('coupon_id' => $coupon_info['ID']));

                if (count($coupon_used) >= $coupon_info['limit_count']) {
                    $this->response(['status' => 'fail', 'msg' => 'we\'re sorry,but this coupon reached to maximum number of uses'], REST_Controller::HTTP_BAD_REQUEST);
                } else {
                    $coupon_used_by_user = $this->Common_model->get_multi_selected_data('elr_coupon_used', array('coupon_id' => $coupon_info['ID'], 'user_id' => $user_id));
                    if (count($coupon_used_by_user) < $coupon_info['no_of_users']) {
                        if ($coupon_info['dis_type'] == 0) {
                            $price = $price - $coupon_info['discount'];
                        } else {
                            $price = $price - ($price * ($coupon_info['discount'] / 100));
                        }
                        if (strtotime($coupon_info['start_date']) <= strtotime(date('Y-m-d')) && strtotime($coupon_info['end_date']) >= strtotime(date('Y-m-d'))) {
                            $this->response(['status' => 'success', 'msg' => 'Code apply successfully', 'price' => $price], REST_Controller::HTTP_BAD_REQUEST);
                        } else {
                            if (strtotime($coupon_info['start_date']) <= strtotime(date('Y-m-d'))) {
                                $this->response(['status' => 'fail', 'msg' => 'We\'re sorry ,but this coupon code not activated yet'], REST_Controller::HTTP_BAD_REQUEST);
                            } else {
                                $this->response(['status' => 'fail', 'msg' => 'We\'re sorry ,but this coupon code expired'], REST_Controller::HTTP_BAD_REQUEST);
                            }
                        }
                    } else {
                        $this->response(['status' => 'fail', 'msg' => 'We\'re sorry ,but you\'ve reached the maximum uses of this coupon code.'], REST_Controller::HTTP_BAD_REQUEST);
                    }
                }
            }
        }
    }

    public function create_process_recipe_post()
    {
        if (!isset($_POST['size_selection']) || $_POST['size_selection'] == null || !isset($_POST['nicotine_type']) || $_POST['nicotine_type'] == null || !isset($_POST['target']) || $_POST['target'] == null || !isset($_POST['pg_perc_no_nic']) || $_POST['pg_perc_no_nic'] == null || !isset($_POST['vg_perc_no_nic']) || $_POST['vg_perc_no_nic'] == null || !isset($_POST['pg_ml']) || $_POST['pg_ml'] == null || !isset($_POST['vg_ml']) || $_POST['vg_ml'] == null || !isset($_POST['nic_shot_perc']) || $_POST['nic_shot_perc'] == null || !isset($_POST['nic_shot_ml']) || $_POST['nic_shot_ml'] == null || !isset($_POST['recipe_id']) || $_POST['recipe_id'] == null) {
            $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {
            $recipe_data = array(
                'size_selection' => trim($_POST['size_selection']),
                'nicotine_type' => trim($_POST['nicotine_type']),
                'target' => trim($_POST['target']),
                'pg_perc_no_nic' => trim($_POST['pg_perc_no_nic']),
                'vg_perc_no_nic' => trim($_POST['vg_perc_no_nic']),
                'pg_ml' => trim($_POST['pg_ml']),
                'vg_ml' => trim($_POST['vg_ml']),
                'nic_shot_perc' => trim($_POST['nic_shot_perc']),
                'nic_shot_ml ' => trim($_POST['nic_shot_ml']),
                'calc_status' => 0,
                'cart_status' => 1,
                'status' => 1,
            );

            $recipe_id = trim($_POST['recipe_id']);

            $result = $this->Common_model->update_info(RECIPE, $recipe_data, array('ID' => $recipe_id));

            if ($result) {
                $this->response(['status' => 'success', 'msg' => 'Recipe has been saved successfully'], REST_Controller::HTTP_OK);
            } else {
                $this->response(['status' => 'fail', 'msg' => 'No changes occured'], REST_Controller::HTTP_BAD_REQUEST);
            }

        }
    }

    public function my_recipe_single_post()
    {
        if (!isset($_POST['recipe_id']) || $_POST['recipe_id'] == null || !isset($_POST['user_identity']) || $_POST['user_identity'] == null) {
            $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {
            $user_id = trim($_POST['user_identity']);

            $recipe_data = $this->Common_model->get_selected_data(RECIPE, array('ID' => trim($_POST['recipe_id']), 'user_id' => $user_id));

            if (!empty($recipe_data)) {

                $recipe_users = $this->Common_model->get_selected_data(USERS, array('ID' => $recipe_data['user_id'], 'user_block_status' => 0));

                if (!empty($recipe_users)) {
                    $result['recipe_users_details'] = array('user_id' => $recipe_users['ID'],
                        'username' => $recipe_users['username'],
                        'avatar' => base_url('site-assets/img/user-avatar/250-200-' . $recipe_users['avatar']));

                    if ($recipe_users['avatar']) {
                        $result['recipe_users_details']['avatar'] = base_url('site-assets/img/user-avatar/250-200-' . $recipe_users['avatar']);
                    } else {
                        $result['recipe_users_details']['avatar'] = base_url('site-assets/img/default-user.png');
                    }

                    $flav_ids = $recipe_data['ingredient_id'];
                    $flavs_perc = $recipe_data['ingredient_perc'];

                    $flav_id = explode(",", $flav_ids);
                    $flav_perc = explode(",", $flavs_perc);

                    for ($i = 0; $i < count($flav_id); $i++) {
                        $recipe_data['flavour'][] = $this->Common_model->get_selected_data(FLAVOUR, array('ID' => $flav_id[$i]));

                        $recipe_data['flavour'][$i]['flav_perc'] = $flav_perc[$i];
                    }

                    $user_settings = $this->Common_model->get_selected_data(SETTINGS, array('user_id' => $user_id));

                    if (!empty($user_settings)) {
                        $result['user_settings'] = array('target_nicotine' => $user_settings['default_target_nicotine_amount'],
                            'nic_type' => $user_settings['nic_type'],
                        );
                    } else {
                        $this->response(['status' => 'fail', 'msg' => 'User not found'], REST_Controller::HTTP_BAD_REQUEST);
                    }

                    $result['nic_data'] = $this->Common_model->get_selected_data(DEF_NIC, array('ID' => 1));

                    $result['stocks'] = $this->Common_model->get_multi_selected_data(STOCK_SET, array());

                    $result['recipe_data'] = $recipe_data;

                    if (!empty($result)) {
                        $this->response(['status' => 'success', 'data' => $result], REST_Controller::HTTP_OK);
                    } else {
                        $this->response(['status' => 'fail', 'msg' => 'Some error occured'], REST_Controller::HTTP_BAD_REQUEST);
                    }
                } else {
                    $this->response(['status' => 'fail', 'msg' => 'This user is blocked'], REST_Controller::HTTP_BAD_REQUEST);
                }

            } else {
                $this->response(['status' => 'fail', 'msg' => 'No recipe found'], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    // -------------------------user all favourite recipes --------------------------

    public function my_saved_recipes_post()
    {
        if (!isset($_POST['user_identity']) || $_POST['user_identity'] == null || !isset($_POST['pages']) || $_POST['pages'] == null) {
            $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {
            $user_id = trim($_POST['user_identity']);
            $offset = 0;
            $limit = 5;
            $join = array(
                [
                    'table' => FAVS,
                    'value' => (FAVS . '.recipe_id=' . RECIPE . '.ID'),
                    'type' => '',
                ],
            );
            $order = array('by_col' => RECIPE . '.created_at', 'order' => 'DESC');
            $where = FAVS . '.user_id=' . $user_id . ' AND ' . RECIPE . '.status=0';
            $result = $this->Common_model->join_model(RECIPE, $where, $join, '', $order, '', $limit, $offset);
            // pre($result);
            if (!empty($result)) {
                $this->response(['status' => 'success', 'data' => $result], REST_Controller::HTTP_OK);
            } else {
                $this->response(['status' => 'fail', 'msg' => 'No saved recipe found'], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    // ------------------------------get all user recipes ----------------------------------

    public function my_recipe_post()
    {
        if (!isset($_POST['user_identity']) || $_POST['user_identity'] == null) {
            $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {
            $user_id = trim($_POST['user_identity']);
            $offset = 0;
            $limit = 5;
            $order = ['by_col' => 'created_at', 'order' => 'DESC'];
            $where = array('user_id' => $user_id);
            $result = $this->Common_model->get_multi_selected_data(RECIPE, $where, $order, $limit, $offset);
            // pre(count($result));
            if (!empty($result)) {
                $this->response(['status' => 'success', 'data' => $result], REST_Controller::HTTP_OK);
            } else {
                $this->response(['status' => 'fail', 'msg' => 'No recipe found'], REST_Controller::HTTP_BAD_REQUEST);
            }
        }

    }
}
