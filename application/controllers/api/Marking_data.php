<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . './libraries/REST_Controller.php';

class Marking_data extends REST_Controller
{
    // function __construct() {
    //     parent::__construct();
    // }

    public function recipe_save_mark_post()
    {
        if (!isset($_POST['user_identity']) || $_POST['user_identity'] == null || !isset($_POST['recipe_id']) || $_POST['recipe_id'] == null || !isset($_POST['status']) || $_POST['status'] == null) {
            $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {
            $user_id = trim($_POST['user_identity']);
            $recipe_id = trim($_POST['recipe_id']);
            $status = trim($_POST['status']);

            $recipe_info = $this->Common_model->get_selected_data(RECIPE, array('ID' => $recipe_id));

            if (empty($recipe_info)) {
                $this->response(['status' => 'fail', 'msg' => 'No recipe found'], REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $fav_info = $this->Common_model->get_selected_data(FAVS, array('user_id' => $user_id, 'recipe_id' => $recipe_id));

                if ($status == 'fav_recipe') {
                    if (count($fav_info) == 0) {
                        $result = $this->Common_model->insert_info(FAVS, ['user_id' => $user_id, 'recipe_id' => $recipe_id]);

                        if ($result) {
                            $this->response(['status' => 'success', 'msg' => 'Recipe has been saved in your recipe book'], REST_Controller::HTTP_OK);
                        } else {
                            $this->response(['status' => 'fail', 'msg' => 'Some error occured in saving recipe'], REST_Controller::HTTP_BAD_REQUEST);
                        }
                    } else {
                        $this->response(['status' => 'fail', 'msg' => 'This recipe is already saved'], REST_Controller::HTTP_BAD_REQUEST);
                    }
                } elseif ($status == 'unfav_recipe') {
                    $result = $this->Common_model->data_delete(FAVS, ['user_id' => $user_id, 'recipe_id' => $recipe_id]);

                    if ($result) {
                        $this->response(['status' => 'success', 'msg' => 'Recipe has been removed from your recipe book'], REST_Controller::HTTP_OK);
                    } else {
                        $this->response(['status' => 'fail', 'msg' => 'Some error occured in removing recipe'], REST_Controller::HTTP_BAD_REQUEST);
                    }
                } else {
                    $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
                }
            }

        }
    }

    // LIKES
    public function recipe_like_mark_post()
    {
        if (!isset($_POST['user_identity']) || $_POST['user_identity'] == null || !isset($_POST['recipe_id']) || $_POST['recipe_id'] == null || !isset($_POST['status']) || $_POST['status'] == null) {
            $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {
            $user_id = trim($_POST['user_identity']);
            $recipe_id = trim($_POST['recipe_id']);
            $status = trim($_POST['status']);

            $recipe_info = $this->Common_model->get_selected_data(RECIPE, array('ID' => $recipe_id));

            if (empty($recipe_info)) {
                $this->response(['status' => 'fail', 'msg' => 'No recipe found'], REST_Controller::HTTP_BAD_REQUEST);
            } else {

                $like_info = $this->Common_model->get_selected_data(LIKES, array('user_id' => $user_id, 'recipe_id' => $recipe_id));

                if ($status == 'like_recipe') {
                    if (count($like_info) == 0) {
                        $result = $this->Common_model->insert_info(LIKES, ['user_id' => $user_id, 'recipe_id' => $recipe_id]);

                        if ($result) {
                            $this->response(['status' => 'success', 'msg' => 'You have sent thanks to this recipe'], REST_Controller::HTTP_OK);
                        } else {
                            $this->response(['status' => 'fail', 'msg' => 'Some error occured in sending thanks'], REST_Controller::HTTP_BAD_REQUEST);
                        }
                    } else {
                        $this->response(['status' => 'fail', 'msg' => 'This recipe is already liked'], REST_Controller::HTTP_BAD_REQUEST);
                    }
                } elseif ($status == 'unlike_recipe') {

                    $result = $this->Common_model->data_delete(LIKES, ['user_id' => $user_id, 'recipe_id' => $recipe_id]);

                    if ($result) {
                        $this->response(['status' => 'success', 'msg' => 'Your thanks is removed'], REST_Controller::HTTP_OK);
                    } else {
                        $this->response(['status' => 'fail', 'msg' => 'Some error occured in removing thanks'], REST_Controller::HTTP_BAD_REQUEST);
                    }
                } else {
                    $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
                }
            }
        }
    }

    // FOLLOW UNFOLLOW
    public function follow_unfollow_user_post()
    {
        if (!isset($_POST['user_identity']) || $_POST['user_identity'] == null || !isset($_POST['following_id']) || $_POST['following_id'] == null || !isset($_POST['status']) || $_POST['status'] == null) {
            $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {
            $user_id = trim($_POST['user_identity']);
            $following_id = trim($_POST['following_id']);
            $status = trim($_POST['status']);

            $following_info = $this->Common_model->get_selected_data(USERS, array('ID' => $following_id));

            if (empty($following_info)) {
                $this->response(['status' => 'fail', 'msg' => 'No user found'], REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $follow_info = $this->Common_model->get_selected_data(FOLLOW, array('follower_id' => $user_id, 'seller_id' => $following_id));

                if ($status == 'follow') {
                    if (count($follow_info) == 0) {
                        $result = $this->Common_model->insert_info(FOLLOW, ['follower_id' => $user_id, 'seller_id' => $following_id]);
                        if ($result) {
                            $this->response(['status' => 'success', 'msg' => 'You are following the user'], REST_Controller::HTTP_OK);
                        } else {
                            $this->response(['status' => 'fail', 'msg' => 'Some error occured in following the user'], REST_Controller::HTTP_BAD_REQUEST);
                        }
                    } else {
                        $this->response(['status' => 'fail', 'msg' => 'You are already following the user'], REST_Controller::HTTP_BAD_REQUEST);
                    }
                } elseif ($status == 'unfollow') {

                    $result = $this->Common_model->data_delete(FOLLOW, ['follower_id' => $user_id, 'seller_id' => $following_id]);

                    if ($result) {
                        $this->response(['status' => 'success', 'msg' => 'You have unfollow the user'], REST_Controller::HTTP_OK);
                    } else {
                        $this->response(['status' => 'fail', 'msg' => 'Some error occured in unfollowing the user'], REST_Controller::HTTP_BAD_REQUEST);
                    }
                } else {
                    $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
                }
            }
        }
    }

    // RATING
    // RATING
    public function recipe_rating_mark_post()
    {
        if (!isset($_POST['user_identity']) || $_POST['user_identity'] == null || !isset($_POST['recipe_id']) || $_POST['recipe_id'] == null || !isset($_POST['rating']) || $_POST['rating'] == null || !isset($_POST['comments'])) {
            $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
        } else {
            $user_id = trim($_POST['user_identity']);
            $recipe_id = trim($_POST['recipe_id']);
            $rating = trim($_POST['rating']);
            $comments = trim($_POST['comments']);
            if ($rating > 5 || $rating < 1) {
                $this->response(['status' => 'fail', 'msg' => 'Some data is missing'], REST_Controller::HTTP_NOT_ACCEPTABLE);
            } else {
                $rating_info = $this->Common_model->get_selected_data(RATING, array('rater_id' => $user_id, 'recipe_id' => $recipe_id));

                if (count($rating_info) == 0) {
                    $result = $this->Common_model->insert_info(RATING, ['rater_id' => $user_id, 'recipe_id' => $recipe_id, 'rating' => $rating, 'comments' => $comments]);

                    if ($result) {
                        $this->response(['status' => 'success', 'msg' => 'You have sent rating to this recipe'], REST_Controller::HTTP_OK);
                    } else {
                        $this->response(['status' => 'fail', 'msg' => 'Some error occured in sending rating'], REST_Controller::HTTP_BAD_REQUEST);
                    }
                } else {
                    $this->response(['status' => 'fail', 'msg' => 'You have already rated this recipe'], REST_Controller::HTTP_BAD_REQUEST);
                }
            }
        }
    }

}
