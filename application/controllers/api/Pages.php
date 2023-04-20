<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_controller
{
    public function home_page_data()
    {
        $banner_data = $this->Common_model->get_full_data('img_name', HOME_BANNER, array());

        $result['banner_data'] = base_url('assets/img/pages/banner/' . $banner_data[0]['img_name']);

        $result['recipe_data'] = $this->Common_model->get_full_data('*', RECIPE, array());

        $result['services_data'] = $this->Common_model->get_full_data('heading,content', HOME_SERVICE, array());

        $result['contact_data'] = $this->Common_model->get_full_data('heading,content', HOME_CONTACT, array());

        $result['newsletter_data'] = $this->Common_model->get_full_data('heading,content', HOME_NEWS, array());

        $result['links_data'] = $this->Common_model->get_full_data('link,type', HOME_LINKS, array());

        echo json_encode(['status' => 'success', 'data' => $result]);
    }

    public function get_faqs()
    {
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $faqs_data = $this->Common_model->get_multi_selected_data(FAQ, array('status' => 0));
            if (!empty($faqs_data)) {
                echo json_encode(['status' => 'success', 'data' => $faqs_data]);
            } else {
                echo json_encode(['status' => 'fail', 'msg' => 'No FAQ data found']);
            }
        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
    }

    public function recipe_details_page()
    {
        if (!isset($_POST['recipe_id']) || $_POST['recipe_id'] == null) {
            echo json_encode(['status' => 'fail', 'msg' => 'Some data is missing']);
        } else {
            $recipe_data = $this->Common_model->get_selected_data(RECIPE, array('ID' => trim($_POST['recipe_id'])));

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
                        $recipe_data['flavour'][] = $this->Common_model->get_selected_data(FLAVOUR, array());

                        $recipe_data['flavour'][$i]['flav_perc'] = $flav_perc[$i];
                    }

                    if (!isset($_POST['user_identity']) || $_POST['user_identity'] == null) {
                        echo json_encode(['status' => 'fail', 'msg' => 'User not found']);die;
                    } else {
                        $user_id = trim($_POST['user_identity']);

                        $user_settings = $this->Common_model->get_selected_data(SETTINGS, array('user_id' => $user_id));
                        pre($user_settings);
                        $result['user_settings'] = array('target_nicotine' => $user_settings['default_target_nicotine_amount'],
                                'nic_type' => $user_settings['nic_type'],
                            );
    
                        // if (!empty($user_settings)) {
                            
                        // } else {
                        //     echo json_encode(['status' => 'fail', 'msg' => 'User not found']);
                        // }
                    }

                    $result['nic_data'] = $this->Common_model->get_selected_data(DEF_NIC, array('ID' => 1));

                    $result['stocks'] = $this->Common_model->get_multi_selected_data(STOCK_SET, array());

                    $result['recipe_data'] = $recipe_data;

                    if (!empty($result)) {
                        echo json_encode(['status' => 'success', 'data' => $result]);
                    } else {
                        echo json_encode(['status' => 'fail', 'msg' => 'Some error occured']);
                    }
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'This user is blocked']);
                }

            } else {
                echo json_encode(['status' => 'fail', 'msg' => 'No recipe found']);
            }
        }
    }

}
