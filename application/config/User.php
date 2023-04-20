<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . './libraries/REST_Controller.php';

class User extends CI_Controller
{
        public function __construct(){
        parent::__construct();
        $this->load->model('Custom_model');
        }

    public function getAge($dob = '')
    {

        $birthDate = $dob;
        //explode the date to get month, day and year
        $birthDate = explode("/", $birthDate);
        //get age from date or birthdate
        $age = (date("md", date("U", @mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
        return $age;
    }

    public function user_login()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            if (!isset($_POST['email']) || trim($_POST['email']) == null || !isset($_POST['password']) || $_POST['password'] == null) {
                echo json_encode(['status' => 'fail', 'msg' => 'Please fill all the fields']);
            } else {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);

                $user_data = array(
                    'email' => $email,
                    'password' => $password,
                );

                $result = $this->User_model->insert_user_login($user_data);
                if ($result == 'invalid') {
                    echo json_encode(['status' => 'fail', 'msg' => 'Invalid mobile or Password']);
                } elseif ($result == 'no_exist') {
                    echo json_encode(['status' => 'fail', 'msg' => 'User does not exist']);
                } elseif ($result == 'block') {
                    echo json_encode(['status' => 'fail', 'msg' => 'This account is blocked']);
                } else {
                    $result['token'] = random_string('alnum', 35);
                    $response = $this->Common_model->update_info(TOKEN, array(), array('user_identity' => $result['euserId']), array('api_token' => $result['token']));

                    if ($result) {
                        echo json_encode(['status' => 'success', 'data' => $result]);
                    } else {
                        echo json_encode(['status' => 'fail', 'msg' => 'Error in token generation']);
                    }
                }
            }
        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
    }

    // USER SIGNUP FUNCTION
    public function user_signup()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if (!isset($_POST['mobile']) || trim($_POST['mobile']) == null || !isset($_POST['first_name']) || trim($_POST['first_name']) == null || !isset($_FILES['image']) || $_FILES['image'] == null) {
                echo json_encode(['status' => 'fail', 'msg' => 'Please fill all the fields']);
            } else {

                $mobile = trim($_POST['mobile']);
                $first_name = trim($_POST['first_name']);
                $last_name = trim($_POST['last_name']);
                $birthday = $_POST['birthday'];
                $gender = trim($_POST['gender']);
                $time = time();
                $fileName = random_string('numeric', 5)."-". $time ."_"'image1';
                // $image =  $_FILES['image']['name'];

                $config['upload_path'] = './site-assets/img/user-avatar/';
                $config['allowed_types'] = 'gif|png|jpeg|jpg';
                $config['file_ext_tolower'] = true;
                $config['file_name'] = $fileName . '.jpg';
                // pre($config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    echo json_encode(['status' => 'fail', 'msg' => 'Error uploading image data']);
                    die;
                    // $error = array('error' => $this->upload->display_errors());
                    // flash_site('error', $error['error']);
                    // redirect(base_url($url));0
                } else {
                    $data = $this->upload->data('file_name');
                }

                $age = $this->getAge($birthday);
                // pre($age);


                $result = $this->Common_model->get_selected_data(K_USERS, array('mobile' => $mobile));
                if (!empty($result)) {
                    echo json_encode(['status' => 'fail', 'msg' => 'User already exists']);
                    die;
                } else {

                    $user_data = array(
                        'mobile' => $mobile,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'birthday' => $birthday,
                        'gender' => $gender,
                        "age" => $age,
                        'image1' => $data,
                    );
                    $result = $this->Common_model->insert_info(K_USERS, $user_data);
                    if ($result) {

                        echo json_encode(['status' => 'success', 'user_data' => $user_data, 'msg' => 'Data inserted successfully']);
                    } else {
                        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
                    }
                }
            }
        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
    }

    public function update_user_profile()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['mobile'])){
                $mobile = trim($_POST['mobile']);
                $user_data['mobile'] = $mobile;
                $user_data['about_me'] = trim($_POST['about_me']);
                $user_data['job_title'] = trim($_POST['job_title']);
                $user_data['company'] = trim($_POST['company']);
                $user_data['school'] = trim($_POST['school']);
                $user_data['birthday'] = trim($_POST['birthday']);
                $user_data['gender'] = trim($_POST['gender']);
            
                for($i=1; $i<=6; $i++){
                    if(!empty($_FILES['image'.$i])){
                       $imagefile[] = 'image'.$i;
                      // echo $i;
                    } 
                }

                
                $result = $this->Common_model-> get_selected_data(K_USERS, array('mobile' => $mobile));
                $filesCount = count($imagefile);
                 // pre($filesCount);
                 // echo $imagefile[0];
                    $time = time();
                for($i=0; $i<$filesCount; $i++){ 
                    $fileName = random_string('numeric', 5)."-". $time ."_".$imagefile[$i];
                    //echo $imagefile[$i];
                    $config['upload_path'] = './site-assets/img/user-avatar/';
                    $config['file_name'] = $fileName. '.jpg';
                    $config['allowed_types'] = 'gif|png|jpeg|jpg';
                    $config['file_ext_tolower'] = true;
                       // echo $imagefile[$i];
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($imagefile[$i])) {
                        $error = array('error' => $this->upload->display_errors());
                        echo json_encode(['status' => 'fail', 'msg' => $error]);
                    } else {
                        $data = $this->upload->data();
                        $user_data[$imagefile[$i]] = $data['file_name'];
                        if(!empty($result[$imagefile[$i]])){
                        unlink('./site-assets/img/user-avatar/'.$result[$imagefile[$i]]);
                        }
                    }
                    
                }
                
                $user_info = $this->Common_model->update_info(K_USERS, $user_data, array('mobile' => $mobile), array());
                if ($user_info) {
                   echo json_encode(['status' => 'success', 'msg' => 'Updated Successfully']);
                } else {
                   echo json_encode(['status' => 'fail', 'msg' => 'Error In  Data Updatation ']);
                }
            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Id Not Found']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
       }          
    }

    public function user_show_or_hide()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['mobile'])){
                $mobile = trim($_POST['mobile']);
                $user_data['mobile'] = $mobile;

                $fields = false;
                if(isset($_POST['hide_me'])){ 
                    $user_data['hide_me'] = trim($_POST['hide_me']);
                    $fields = true;
                }
                if(isset($_POST['hide_age'])){
                    $user_data['hide_age'] = trim($_POST['hide_age']);
                    $fields = true;
                }  
                if(isset($_POST['hide_location'])){
                    $user_data['hide_location'] = trim($_POST['hide_location']);
                    $fields = true;
                }

                if($fields == true){
                    $user_info = $this->Common_model->update_info(K_USERS, $user_data, array('mobile' => $mobile), array());
                    if ($user_info) {
                       echo json_encode(['status' => 'success', 'msg' => 'Updated Successfully']);
                    } else {
                       echo json_encode(['status' => 'fail', 'msg' => 'Error In  Data Updatation ']);
                    }

                } else{
                   echo json_encode(['status' => 'fail', 'msg' => 'Enter Any One Field ']);
                }        
            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Id Not Found']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
       }            
    }

    public function delete_user_profile()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['mobile'])){
                $user_id = trim($_POST['mobile']);
                $user_data = $this->Common_model->get_full_data('', K_USERS, array('block' => 0, 'mobile' => $user_id));
               //pre($user_data);
                if (!empty($user_data)) {
                    $data =
                        array(
                            "block" => 1,
                        );
                    $this->Common_model->update_info(K_USERS, $data, array('mobile' => $user_data[0]['mobile']), array());
                    echo json_encode(['status' => 'success', 'msg' => 'User Deleted Successfully']);
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'Some error occured in getting user info']);
                }
            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Please Enter Id ']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
       }    
    }

    public function delete_user_profile_images()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['mobile'])){
                $mobile = trim($_POST['mobile']);
                $fields = false; 
                for($i=2; $i<=6; $i++){
                    if(isset($_POST['image'.$i])){
                       $imagefile[] = 'image'.$i;
                       $fields=true;
                    } 
                }
                if($fields == true){
                    $result = $this->Common_model-> get_selected_data(K_USERS, array('mobile' => $mobile));

                    $update_true = false;
                    $filesCount = count($imagefile);
                    for($i=0; $i<$filesCount; $i++){
                        if(!empty($imagefile[$i]) && !empty($result[$imagefile[$i]])){
                            unlink('./site-assets/img/user-avatar/'.$result[$imagefile[$i]]);  
                           // echo  $result[$imagefile[$i]];
                            $user_data[$imagefile[$i]] = '';
                            $update_true = true;
                        }   
                    }
                    if($update_true == true){ 
                        $result1 = $this->Common_model->update_info(K_USERS, $user_data, array('mobile' => $mobile), array()); 
                        if($result1){
                            echo json_encode(['status' => 'success', 'msg' => 'Data Deleted Successfully']);
                        } else{
                            echo json_encode(['status' => 'fail', 'msg' => 'Data Could Not Be Deleted']);
                        }
                    }    
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'There Are No Images To Delete ']);
                }          
            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Id Not Found']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }    
    }

    // TO GET NO OF USER WHO LIKE AND DATA OF THE USERS WHO LIKE ME
    public function mymatch()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') { 
            //send data of like    count  like 
            if(isset($_POST['mobile'])){
                $mobile = trim($_POST['mobile']);
                $field_data =  array( 'effect_profile' => $mobile,
                                      'match_profile' => 'false', 
                                      'chat' => 'false', 
                                    );
                $result = $this->Common_model-> get_multi_selected_data(K_LIKE_UNLIKE, $field_data);
                //pre($result);
                $count_records = count($result);
                //pre($count_records);
                 $array_out1 = array();
                 $array_image1 = array();
                for($i=0; $i<$count_records; $i++){
                    $result1 = $this->Common_model-> get_selected_data(K_USERS, array('mobile' => $result[$i]['action_profile']));
                  // pre($result1);
                    $array_out1[] = array( "action_profile" => $result[$i]['action_profile'],
                                                "image1" => htmlentities($result1['image1']),
                                                "first_name" => htmlentities($result1['first_name']),
                                                "last_name" => htmlentities($result1['last_name'])
                                        );
                    $array_image1[] = $result1['image1'];
                }
                //pre($array_out1);
                $userWhoLikeMe =  array("total" => count($array_out1)
                                        );
               // pre($userWhoLikeMe);    
            $output=array( "code" => "200", "msg" => $array_out1 , "myLikes"=>$userWhoLikeMe);
            print_r(json_encode($output, true));
            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Id Not Found']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }      
    }

    public function my_matched_profile()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            //  cross check     if they like to each other       update action_profile = true
            if(isset($_POST['mobile']) && isset($_POST['other_mobile_id'])){
                $mobile = trim($_POST['mobile']);
                $another_mobile = trim($_POST['other_mobile_id']);
                $field_data1 =  array( 'action_profile' => $mobile,
                                       'effect_profile' => $another_mobile,
                                       'match_profile' => 'false', 
                                       'chat' => 'false', 
                                    );
                $result1 = $this->Common_model-> get_selected_data(K_LIKE_UNLIKE, $field_data1);
               // pre($result1);
                if(!empty($result1)){
                    $field_data2 =  array( 'action_profile' => $another_mobile,
                                          'effect_profile' => $mobile,
                                          'match_profile' => 'false', 
                                          'chat' => 'false', 
                                        );
                    $result2 = $this->Common_model-> get_selected_data(K_LIKE_UNLIKE, $field_data2);
                   // pre($result2);
                        if(!empty($result2)){
                            $ids = array($result1['id'], $result2['id']);
                           // pre($ids);                        
                            $info =  array('match_profile' => 'true');  
                            //pre($ids); 
                           $result3 = $this->Custom_model-> update_info_c(K_LIKE_UNLIKE, $info, $ids);
                           if(!empty($result3)){
                             echo json_encode(['status' => 'success', 'msg' => 'Successfuly Updated']);
                           }
                        }
                }
            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Enter Eacebook Id ']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }      
    }

    
    public function unmatch()
    {  
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['mobile']) && isset($_POST['other_mobile_id'])){
                $mobile = trim($_POST['mobile']);
                $other_id = trim($_POST['other_mobile_id']);
                $where1 =  array('action_profile' => $mobile,
                                 'effect_profile' => $other_id
                                );
                $where2 =  array('action_profile' => $other_id,
                                   'effect_profile' => $mobile
                                    );
                //pre($where);
                $result1 = $this->Common_model->get_selected_data(K_LIKE_UNLIKE, $where1);
                $result2 = $this->Common_model->get_selected_data(K_LIKE_UNLIKE, $where2);
                if($result1 && $result2){
                    $result11 = $this->Common_model->data_delete(K_LIKE_UNLIKE, $where1);
                    $result22 = $this->Common_model->data_delete(K_LIKE_UNLIKE, $where2); 
                        if($result11 && $result22){
                            echo json_encode(['status' => 'success', 'msg' => 'Succesfully Updated']);
                        } else {
                           echo json_encode(['status' => 'fail', 'msg' => 'Data Updation Failed']);
                        }     
                } else {
                   echo json_encode(['status' => 'fail', 'msg' => 'Data Not Found ']);
                }    
            } else {
                   echo json_encode(['status' => 'fail', 'msg' => 'Id Not Found ']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
                    
    }



    public function userNearByMe()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['mobile']) && isset($_POST['lat_long']) )
            {
               // pre($_POST);
                $mobile = trim($_POST['mobile']);
                $result = $this->Common_model-> get_multi_selected_data(F_USERS, array());
                $count = count($result);
                //pre($count);
                $blocked_user_id = array();
                for($i=0; $i<$count;$i++){
                    $blocked_user_id[] = $result[$i]['user_id'];
                }
               // pre($blocked_user_id);
                $where =  array('action_profile' => $mobile);
                $result1 = $this->Common_model-> get_multi_selected_data(K_LIKE_UNLIKE, $where, array());
                $count1 = count($result1);
                //pre($result1);
                for($i=0; $i<$count1;$i++){
                    $blocked_user_id[] = $result1[$i]['effect_profile'];
                }
                //pre($blocked_user_id);
                $where =  array('block' => 1);
                $result2 = $this->Common_model-> get_multi_selected_data(K_USERS, $where, array());
                $count2 = count($result2);
               // pre($result1);
                for($i=0; $i<$count2;$i++){
                    $blocked_user_id[] = $result2[$i]['mobile'];
                }
                //pre($blocked_user_id);
                $blocked_user_id[] = $mobile;
                // do not fetch data of user        so add mobile in blocked array
                $where_not_in_ids = $blocked_user_id;      // mobile of block , flag, already like user
                $order = array('by_col' => 'id',
                               'order' => 'ASC'
                               );
                $result3 = $this->Custom_model-> get_multi_selected_data_c('', K_USERS, '', mobile, '', $where_not_in_ids,  $order,'', '');
               // pre($result3);
                $lat_long = $_POST['lat_long'];
                $distance = $_POST['distance'];
                $gender = $_POST['gender'];
                $age_min = $_POST['age_min'];
                $age_max = $_POST['age_max'];
                $version = $_POST['version'];
                $device = $_POST['device'];
                $device_token = $_POST['device_token'];
        
                if($distance=="")
                {
                    $distance="10";
                }
                $mylocation = array();
                $mylocation=explode(",",$lat_long);
               // pre($mylocation);
                $id = array('mobile' => $mobile);
                $info = array( 'lat_long' => $lat_long,
                               'lat' => $mylocation[0],
                               'long' => $mylocation[1],
                               'version' => $version,
                               'device' => $device,
                               'device_token' => $device_token
                              );
                //pre($info);
               $result4 = $this->Common_model-> update_info(K_USERS, $info, $id);
               //pre($result4);
               $mylocation=explode(",",$lat_long);
                if($gender=="all" || $gender==$_POST['gender'])
                {
                    $lat1 = $mylocation[0];
                    $lon1 = $mylocation[1];
     
                    $counts = count($result3);
                    //pre($counts); 
                    $nearByUserfb_id = array();
                    for($i=0; $i<$counts; $i++){
                        $lat2 = $result3[$i]['lat'];
                        $lon2 = $result3[$i]['long'];
                        //pre($result3);
                        $theta = $lon1 - $lon2;
                        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                        $dist = acos($dist);
                        $dist = rad2deg($dist);
                        $miles = $dist * 60 * 1.1515;
                        $kilometer = $miles * 1.609344;
                        if($kilometer<=$distance){
                           if($result3[$i]['age']>$age_min && $result3[$i]['age']<$age_max){
                            //echo $result3[$i]['age'];
                               $nearByUserfb_id[$result3[$i]['mobile']] = $kilometer;
                            }
                            //echo $result3[$i]['mobile']."<br>";
                           // echo $kilometer." ".$result3[$i]['id']."<br>";
                        }

                    } 
                    asort($nearByUserfb_id);
                    //pre($nearByUserfb_id); 
                    $nearByUser_fb_id = array();
                    foreach($nearByUserfb_id as $key => $value){   
                    $nearByUser_fb_id[] = $key;
                    //echo $key;
                    } 
                    //pre($nearByUserfb_id); 
                    //pre($nearByUser_fb_id);
                    $record_limit = 40;
                    $nearByUser_fb_ids = array();
                    for($i=0; $i<$record_limit;$i++){
                      $nearByUser_fb_ids[] = $nearByUser_fb_id[$i];  
                    }
                    //pre($nearByUser_fb_ids);
                    $where_in_ids = $nearByUser_fb_ids;
                    $wherein_notin = 'mobile';
                    $result5 = $this->Custom_model-> get_multi_selected_data_c('', K_USERS, '', mobile, $where_in_ids, '',  '','', '');
                    //pre($result5);
                    $array_out =  array("response" => $result5);
                    $output=array( "code" => "200", "msg"=> $array_out);
                    print_r(json_encode($output, true));
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'Please Enter Gender']);
                }   
            } else {
                echo json_encode(['status' => 'fail', 'msg' => 'JSON Parameters Are Missing']);
            }
        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }     
    }

    public function firstchat()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['mobile']) && isset($_POST['effected_id'])){
                $mobile = $_POST['mobile'];
                $effected_id = $_POST['effected_id'];
                $info = array('chat' => 'true');
                $where1 = array('action_profile' => $mobile,
                               'effect_profile' => $effected_id
                               );
                $result1 = $this->Common_model-> update_info(K_LIKE_UNLIKE, $info, $where1);
                $where2 = array('action_profile' => $effected_id,
                               'effect_profile' => $mobile
                               );
                $result2 = $this->Common_model-> update_info(K_LIKE_UNLIKE, $info, $where2);

                $array_out = array();
                if($result1 && $result2)
                {
                    echo json_encode(['status' => 'success', 'msg' => 'Succesfully Updated']);
                } else{
                    echo json_encode(['status' => 'fail', 'msg' => 'Error in Updation']);
                }
            }    
            else {   
               echo json_encode(['status' => 'fail', 'msg' => 'Please Enter Id']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }      
    }

    public function delete_user()
    {

        $user_id = $_POST['mobile'];

        $user_data = $this->Common_model->get_full_data('', K_USERS, array('block' => 0, 'mobile' => $user_id));

        if (!empty($user_data)) {
            $data =
                array(
                    "block" => 1,
                );
            $this->Common_model->update_info(K_USERS, $data, array('mobile' => $user_data[0]['mobile']), array());


            echo json_encode(['status' => 'success', 'msg' => 'User Deleted Successfully'], REST_Controller::HTTP_OK);
        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Some error occured in getting user info'], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    // TO DELETE USER IMAGES
    public function delete_user_img()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if (isset($_POST['mobile'])) {
                $mobile = trim($_POST['mobile']);
                $fields = false;
                for ($i = 2; $i <= 6; $i++) {
                    if (isset($_POST['image' . $i])) {
                        $imagefile[] = 'image' . $i;
                        $fields = true;
                    }
                }
                if ($fields == true) {
                    $result = $this->Common_model->get_selected_data(K_USERS, array('mobile' => $mobile));
                    // if()
                    $update_true = false;
                    $filesCount = count($imagefile);
                    for ($i = 0; $i < $filesCount; $i++) {
                        if (!empty($imagefile[$i]) && !empty($result[$imagefile[$i]])) {
                            unlink('site-assets/img/user-avatar/' . $result[$imagefile[$i]]);
                            // echo  $result[$imagefile[$i]];
                            $user_data[$imagefile[$i]] = '';
                            $update_true = true;
                        }
                    }
                    if ($update_true == true) {
                        $result1 = $this->Common_model->update_info(K_USERS, $user_data, array('mobile' => $mobile), array());
                        if ($result1) {
                            echo json_encode(['status' => 'success', 'msg' => 'Data Deleted Successfully']);
                        } else {
                            echo json_encode(['status' => 'fail', 'msg' => 'Data Could Not Be Deleted']);
                        }
                    }
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'There Are No Images To Delete ']);
                }
            } else {
                echo json_encode(['status' => 'fail', 'msg' => 'Id Not Found ']);
            }
        } else {
                echo json_encode(['status' => 'fail', 'msg' => 'Unknown Method']);
        }    
    }

    // TO GET USER PROFILE DATA 
    public function get_user_profile()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $user_id = $_POST['mobile'];
            $user_data = $this->Common_model->get_full_data('', K_USERS, array('block' => 0, 'mobile' => $user_id));

            if (!empty($user_data)) {

                $age = $this->getAge($user_data[0]['birthday']);
                // pre($age);
                $data =
                    array(
                        "about_me" => $user_data[0]['about_me'],
                        "job_title" => $user_data[0]['job_title'],
                        "gender" => $user_data[0]['gender'],
                        "birthday" => $user_data[0]['birthday'],
                        "age" => $age,
                        "company" => $user_data[0]['company'],
                        "school" => $user_data[0]['school'],
                        "first_name" => $user_data[0]['first_name'],
                        "last_name" => $user_data[0]['last_name'],
                        "image1" => htmlspecialchars_decode(stripslashes($user_data[0]['image1'])),
                        "image2" => htmlspecialchars_decode(stripslashes($user_data[0]['image2'])),
                        "image3" => htmlspecialchars_decode(stripslashes($user_data[0]['image3'])),
                        "image4" => htmlspecialchars_decode(stripslashes($user_data[0]['image4'])),
                        "image5" => htmlspecialchars_decode(stripslashes($user_data[0]['image5'])),
                        "image6" => htmlspecialchars_decode(stripslashes($user_data[0]['image6'])),
                    );
                echo json_encode(['status' => 'success', 'data' => $data], REST_Controller::HTTP_OK);
            } else {
                echo json_encode(['status' => 'fail', 'msg' => 'Some error occured in getting user info'], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
                echo json_encode(['status' => 'fail', 'msg' => 'Unknown Method']);
        }     
    }

    // REPORT USER FUNCTION
    public function user_report()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $user_id = $_POST['mobile'];
            $my_id = $_POST['my_mobile'];

            $user_data = $this->Common_model->get_full_data('', K_USERS, array('mobile' => $my_id));
            $reported_user_data = $this->Common_model->get_full_data('', K_USERS, array('mobile' => $user_id));

            if (!empty($user_data) && $my_id != '') {
                if (!empty($reported_user_data) && $user_id != '') {
                    $data = array(
                        "user_id" => $user_id,
                        "flag_by" => $my_id,
                    );
                    $this->Common_model->insert_info(F_USERS, $data);

                    echo json_encode(['status' => 'success', 'data' => $data, 'msg' => 'User reported successfully']);
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'Some error occured in getting reported user info']);
                }
            } else {
                echo json_encode(['status' => 'fail', 'msg' => 'Some error occured in getting user info']);
            }
        } else {
                echo json_encode(['status' => 'fail', 'msg' => 'Unknown Method']);
        }      
    }

    // SEND NOTIFICATIONS TO USER BY ADMIN
    public function send_notifications()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $data = $this->session->userdata('item');
            $admin = $this->Common_model->get_selected_data(USERS, array('role_status' => 1));
            $users = json_decode($data['users']);
            $user_count = count($users);
            $send = array(
                'mobile' => $admin['mobile'],
                'title' => $data['title'],
                'message' => $data['message'],
                'users' => $data['users'],
            );

            // $users = implode(',', $users);
            
            // pre($users);
            foreach ($users as $key => $value) {
                # code...
            $url = 'https://fcm.googleapis.com/fcm/send';
            $fields = array (
                    'to' => $value,
                    'notification' => array (
                            "body" => $send['message'],
                            "title" => $send['title'],
                            // "icon" => "myicon"
                    )
            );
            $fields = json_encode ( $fields );
            $headers = array (
                    'Authorization: key=' . "AIzaSyA9vpL9OuX6moOYw-4n3YTSXpoSGQVGnyM",
                    'Content-Type: application/json'
            );

            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $url );
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

            $result = curl_exec ( $ch );
            curl_close ( $ch );
            
            }

            pre($result);
        } else {
                echo json_encode(['status' => 'fail', 'msg' => 'Unknown Method']);
        }      
    }

    

    public function password_forget()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            if (!isset($_POST['email']) || trim($_POST['email']) == null) {
                echo json_encode(['status' => 'fail', 'msg' => 'Please enter your email']);
            } else {
                $email = trim($_POST['email']);
                $key = random_string('numeric', 6);
                $key_expire = date("Y-m-d H:i:s", strtotime("+30 minutes"));
                $result = $this->User_model->user_forget_otp_insertion($email, $key, $key_expire);

                if ($result == 'not_found') {
                    echo json_encode(['status' => 'fail', 'msg' => 'This email id does not exist']);
                } elseif ($result == 'error') {
                    echo json_encode(['status' => 'fail', 'msg' => 'Otp Dend fail']);
                } else {
                    // sendMail($email, '', 'EDAMAME : Forget Password', "Your OTP To Recover Your Password is: $key");
                    echo json_encode(['status' => 'success', 'msg' => ' An OTP is send on your email']);
                }
            }
        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
    }

    public function user_password_forget_otp_verify()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            if (!isset($_POST['otp']) || ($_POST['otp']) == null || !isset($_POST['email']) || trim($_POST['email']) == null) {
                echo json_encode(['status' => 'fail', 'msg' => 'Some data is missing']);
            } else {
                $email = $_POST['email'];
                $entered_otp = $_POST['otp'];

                $users = $this->Common_model->get_selected_data(USERS, array('email' => $email, 'forget_key' => $entered_otp));

                if (count($users) > 0) {
                    $current_time = date("Y-m-d H:i:s");
                    if (strtotime($users['expire_forget_key']) < strtotime($current_time)) {
                        echo json_encode(['status' => 'fail', 'msg' => 'OTP has been Expired']);
                    } else {

                        $this->Common_model->update_info(USERS, array(), array('email' => $email), array('forget_key' => ''));
                        echo json_encode(['status' => 'Success', 'msg' => 'You can change password now']);
                    }
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'OTP is not correct.']);
                }
            }
        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
    }

    public function user_password_reset_verify()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if (
                !isset($_POST['email']) || trim($_POST['email']) == null ||
                !isset($_POST['password']) || trim($_POST['password']) == null ||
                !isset($_POST['confirm_password']) || trim($_POST['confirm_password']) == null
            ) {
                echo json_encode(['status' => 'fail', 'msg' => 'Some data is missing']);
            } else {
                if (strpos($_POST['password'], " ") || strpos($_POST['confirm_password'], " ")) {
                    echo json_encode(['status' => 'fail', 'msg' => 'Password have spaces']);
                } elseif ($_POST['password'] != $_POST['confirm_password']) {
                    echo json_encode(['status' => 'fail', 'msg' => 'Password not matched']);
                } else {
                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);

                    $users = $this->Common_model->get_selected_data(USERS, array('email' => $email));

                    if (count($users) > 0) {
                        $enc_pass = getHashedPassword($password);

                        $users = $this->Common_model->update_info(USERS, array('password' => $enc_pass, 'dec_password' => $password), array('email' => $email), array());
                        echo json_encode(['status' => 'success', 'msg' => 'Password reset Successfully']);
                    } else {
                        echo json_encode(['status' => 'success', 'msg' => 'Email is not matched to our records']);
                    }
                }
            }
        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
    }
    public function user_resend_otp()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            if (!isset($_POST['email']) || trim($_POST['email']) == null) {
                echo json_encode(['status' => 'fail', 'msg' => 'Some data is missing']);
            } else {
                $email = trim($_POST['email']);
                $otp = random_string('numeric', 6);
                $key_expire = date("Y-m-d H:i:s", strtotime("+30 minutes"));

                $users = $this->Common_model->get_selected_data(USERS, array('email' => $email));
                if (count($users) > 0) {
                    $result = $this->Common_model->update_info(USERS, array('forget_key' => $otp, 'expire_forget_key' => $key_expire), array('email' => $email), array());

                    // $mail = sendMail($email, '', 'EDAMAME : Forget Password', "Your OTP To Recover Your Password is: $otp");
                    if (1) {
                        echo json_encode(['status' => 'success', 'msg' => ' An OTP is send on your email']);
                    } else {
                        echo json_encode(['status' => 'fail', 'msg' => ' Error occured in sending OTP']);
                    }
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'Email is not matched to our records']);
                }
            }
        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
    }

}
    