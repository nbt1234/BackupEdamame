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
        $birthDate = explode("/", $birthDate);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
        return $age;
    }

    public function get_device_token($ids){ 
        //$ids = array($userid, $another_userid);
        $select = array('device_token');
        $get_friends_device_token = $this->Custom_model->get_multi_selected_data_c($select, K_USERS, '', 'userid', $ids);
        $tokens = array();
        for($i=0; $i<count($get_friends_device_token); $i++){
           $tokens[] = $get_friends_device_token[$i]['device_token'];
        }
         return $tokens;
    } 

    public function getNearByUserDistance($where3, $distance, $lat, $long, $where_not_in_ids, $records_per_page, $page_offset){
        $this->db->where($where3);
        $this->db->where_not_in('userid', $where_not_in_ids);
        $this->db->select("*, round(( 3959 * acos( cos( radians($lat) ) * cos( radians( users.lat ) ) * cos( radians( users.long ) - radians($long) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) )*1.609344) AS distance");                         
        $this->db->having('distance <= ' . $distance);                     
        $this->db->order_by('distance');            
        $this->db->from('users');
        $this->db->limit($records_per_page, $page_offset);
        $res = $this->db->get()->result_array();
        return $res;
    }

    public function getNearByUserCount($where3, $distance , $lat, $long, $where_not_in_ids){
        $this->db->where($where3);
        $this->db->where_not_in('userid', $where_not_in_ids);
        $this->db->select("*, round(( 3959 * acos( cos( radians($lat) ) * cos( radians( users.lat ) ) * cos( radians( users.long ) - radians($long) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) )*1.609344) AS distance");                         
        $this->db->having('distance <= ' . $distance);                     
        $this->db->order_by('distance');            
        $this->db->from('users');
        $total = $this->db->get()->result_array();
        $totalCount = count($total);
        return $totalCount;
    }           

    function push_notification($title='',$message='', $tockens=''){  
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array (
                'notification' => array (
                       "title"=> $title,
                       "body"=>$message
                ),
                // 'to' =>$tockens[0]
                'registration_ids' => $tockens
        );
        // pre($fields);
        $fields = json_encode ( $fields );
        // pre($fields);
        // print_r($fields);die;
        $headers = array (
                'Authorization: key=' . "AAAAhtSmBYc:APA91bHUXjbPcQcVyRVLCtdv0dT1PlclYCY_3M6QDVOxTPZvbS3gskdDCJWsml3Rzfex_th2cO_f-ArrUe0iHcOuV7wcmRaCYQzRWhswlyn3-GxntmMApmOUVZZqPBQf8p1xlIt7W1yT",
                'Content-Type: application/json'
        );

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

        $result = curl_exec ( $ch );
        // pre($result);
        return $result;
        curl_close ( $ch );
    }

    public function user_login_check(){
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if (isset($_POST['social_id']) && trim($_POST['social_id']) != null
                && isset($_POST['device_token']) && trim($_POST['device_token']) != null){
                $social_id = trim($_POST['social_id']); 
                $device_token = trim($_POST['device_token']);
                $userdata = $this->Common_model->get_selected_data(K_USERS, array('social_id'=>$social_id));
                if($userdata){
                    if($userdata['block'] == 0){
                        $update_status = $this->Common_model->update_info(K_USERS, array('device_token' => $device_token),array('social_id'=>$social_id));
                        $data = $this->Common_model->get_selected_data(K_USERS, array('social_id'=>$social_id));
                      //  pre($data);
                        echo json_encode(['status' => 'success', 'msg' => 'login','data'=>$data]);
                        die();
                    } else {
                        echo json_encode(['status' => 'fail', 'msg' => 'block']);
                        die();
                    }
                }
                else
                {
                   echo json_encode(['status' => 'success', 'msg' => 'signup']);
                    die();
                }
            }
            else {
            echo json_encode(['status' => 'fail', 'msg' => 'Please Enter Paremeters']);
            }
        }
        else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
    }
   
    public function user_signup()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            if (isset($_POST['social_id']) && trim($_POST['social_id']) != null
                && isset($_POST['device_token']) && trim($_POST['device_token']) != null 
                && isset($_POST['first_name']) && trim($_POST['first_name']) != null 
                && isset($_POST['last_name']) && trim($_POST['last_name']) != null 
                && isset($_POST['email']) && trim($_POST['email']) != null 
                && isset($_POST['birthday']) && trim($_POST['birthday']) != null 
                && isset($_POST['gender']) && trim($_POST['gender']) != null
                && isset($_POST['lat_long']) && trim($_POST['lat_long']) != null

                // && isset($_POST['industry']) && trim($_POST['industry']) != null
                // && isset($_POST['profile_url']) && trim($_POST['profile_url']) != null
                // && isset($_POST['interest']) && trim($_POST['interest']) != null
                // && isset($_POST['positions']) && trim($_POST['positions']) != null
                // && isset($_POST['summary']) && trim($_POST['summary']) != null
                // && isset($_POST['educations']) && trim($_POST['educations']) != null
                // && isset($_POST['relationship_type']) && trim($_POST['relationship_type']) != null
                // && isset($_POST['height']) && trim($_POST['height']) != null
                // && isset($_POST['mbti']) && trim($_POST['mbti']) != null
                // && isset($_POST['star_sign']) && trim($_POST['star_sign']) != null
                // && isset($_POST['political_view']) && trim($_POST['political_view']) != null
                // && isset($_POST['religion']) && trim($_POST['religion']) != null
                // && isset($_POST['exercise']) && trim($_POST['exercise']) != null
                // && isset($_POST['drinking']) && trim($_POST['drinking']) != null
                // && isset($_POST['smoking']) && trim($_POST['smoking']) != null
               )
            {
                // pre($_FILES);
                    $social_id = trim($_POST['social_id']); 
                    $lat_long = trim($_POST['lat_long']);
                    $device_token = trim($_POST['device_token']);

                    $birthday = $_POST['birthday'];
                    $age = $this->getAge($birthday);

                    $latitude_longitude = explode(",",$lat_long);

                   
                    $user_data = array(
                        'social_type' => 'linkedin',
                        'social_id' => $social_id, 
                        'device_token' => trim($_POST['device_token']),
                        'first_name' => trim($_POST['first_name']),
                        'last_name' => trim($_POST['last_name']),
                        'email' => trim($_POST['email']),
                        'birthday' => $birthday,
                        'gender' =>  trim($_POST['gender']),
                        'age' => $age,
                        'lat_long' => $lat_long,
                        'lat' => $latitude_longitude[0],
                        'long' => $latitude_longitude[1],
                    );
                    
                    
                    if(isset($_POST['industry']) && trim($_POST['industry']) != null){
                        $user_data['industry'] = trim($_POST['industry']);
                    }
                    if(isset($_POST['profile_url']) && trim($_POST['profile_url']) != null){
                        $user_data['profile_url'] = trim($_POST['profile_url']);
                    } 
                    if(isset($_POST['interest']) && trim($_POST['interest']) != null){
                        $user_data['interest'] = trim($_POST['interest']);
                    } 
                    if(isset($_POST['positions']) && trim($_POST['positions']) != null){
                        $user_data['positions'] = trim($_POST['positions']);
                    }    
                    if(isset($_POST['summary']) && trim($_POST['summary']) != null){
                        $user_data['summary'] = trim($_POST['summary']);
                    }
                    if(isset($_POST['educations']) && trim($_POST['educations']) != null){    
                        $user_data['educations'] = trim($_POST['educations']);
                    } 
                    if(isset($_POST['relationship_type']) && trim($_POST['relationship_type']) != null){    
                        $user_data['relationship_type'] = trim($_POST['relationship_type']);
                    } 
                    if(isset($_POST['basic_info'])){
                       $user_data['basic_info'] = $_POST['basic_info'];
                    }
                    if(isset($_POST['height']) && trim($_POST['height']) != null){    
                        $user_data['height'] = trim($_POST['height']);
                    }
                    if(isset($_POST['mbti']) && trim($_POST['mbti']) != null){        
                        $user_data['mbti'] = trim($_POST['mbti']);
                    }
                    if(isset($_POST['star_sign']) && trim($_POST['star_sign']) != null){      
                        $user_data['star_sign'] = trim($_POST['star_sign']);
                    }
                    if(isset($_POST['political_view']) && trim($_POST['political_view']) != null){          
                        $user_data['political_view'] = trim($_POST['political_view']);
                    }
                    if(isset($_POST['religion']) && trim($_POST['religion']) != null){          
                        $user_data['religion'] = trim($_POST['religion']);
                    }
                    if(isset($_POST['exercise']) && trim($_POST['exercise']) != null){          
                        $user_data['exercise'] = trim($_POST['exercise']);
                    }
                    if(isset($_POST['drinking']) && trim($_POST['drinking']) != null){          
                        $user_data['drinking'] = trim($_POST['drinking']);
                    }
                    if(isset($_POST['smoking']) && trim($_POST['smoking']) != null){          
                        $user_data['smoking'] = trim($_POST['smoking']);
                    }    
                
                    
                    if($_FILES) {
                         $imagefile=array();
                        for($i=1; $i<=3; $i++){
                            if(!empty($_FILES['image'.$i]['name'])){
                               $imagefile[] = 'image'.$i;
                            } 
                        }
                       
                        $filesCount = count($imagefile);
                            $time = time();
                        for($i=0; $i<$filesCount; $i++){ 
                            $fileName = random_string('numeric', 5)."-". $time ."_".$imagefile[$i];
                            $config['upload_path'] = './site-assets/img/user-avatar/';
                            $config['file_name'] = $fileName. '.jpg';
                            $config['allowed_types'] = 'gif|png|jpeg|jpg';
                            $config['file_ext_tolower'] = true;
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload($imagefile[$i])) {
                                $error = array('error' => $this->upload->display_errors());
                                echo json_encode(['status' => 'fail', 'msg' => $error]);
                            } else {
                                $data = $this->upload->data();
                                $user_data[$imagefile[$i]] = $data['file_name'];
                            }
                        }
                    }    
                    $result = $this->User_model->insert_user_signup($user_data);
                   // pre($result);
                    if ($result) {
                        if($result=="user_exist"){
                            $userdata = $this->Common_model->get_selected_data(K_USERS, array('social_id'=>$social_id));
                            if($userdata['block'] == 0){
                               // pre("no bl");
                                $update_info = $this->Common_model->update_info(K_USERS, array('device_token' => $device_token),array('social_id'=>$social_id));
                                $user_info = $this->Common_model->get_selected_data(K_USERS, array('social_id'=>$social_id));
                                echo json_encode(['status' => 'success', 'message' => 'login', 'response' => $user_info]);
                            } else {
                                echo json_encode(['status' => 'fail', 'msg' => 'block']);
                                die();
                            }
                        } else {
                            $userdata = $this->Common_model->get_selected_data(K_USERS, array('social_id'=>$social_id));
                            echo json_encode(['status' => 'success',  'message' => 'signup', 'response' => $userdata]);
                        }
                    } else {
                        echo json_encode(['status' => 'fail', 'msg' => 'An Error Occured In Signup/login']);
                    }
            } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Please Enter Paremeters']);
            }
        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
    }
    
   public function update_user_profile()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['userid']) && trim($_POST['userid']) != null){
                
                $userid = trim($_POST['userid']);
                $user_data['userid'] = $userid;

                $result = $this->Common_model-> get_selected_data(K_USERS, array('userid' => $userid));
                //pre($result);
                if(!empty($result)){
                   
                    if(isset($_POST['first_name'])){
                        $user_data['first_name'] = $_POST['first_name'];
                    }
                    if(isset($_POST['last_name'])){
                        $user_data['last_name'] = $_POST['last_name'];
                    }
                    if(isset($_POST['birthday'])){
                        $user_data['birthday'] = $_POST['birthday'];
            
                        $age = $this->getAge(trim($_POST['birthday']));
                        $user_data['age'] = $age;
                    }
                    if(isset($_POST['industry'])){
                       $user_data['industry'] = $_POST['industry'];
                    }
                    if(isset($_POST['profile_url'])){
                       $user_data['profile_url'] = $_POST['profile_url'];
                    }
                    if(isset($_POST['interest'])){
                       $user_data['interest'] = $_POST['interest'];
                    }
                    if(isset($_POST['positions'])){
                       $user_data['positions'] = $_POST['positions'];
                    }
                    if(isset($_POST['summary'])){
                       $user_data['summary'] = $_POST['summary'];
                    }
                    if(isset($_POST['educations'])){
                       $user_data['educations'] = $_POST['educations'];
                    }
                    if(isset($_POST['basic_info'])){
                       $user_data['basic_info'] = $_POST['basic_info'];
                    }
                    if(isset($_POST['gender'])){
                       $user_data['gender'] = trim($_POST['gender']);
                    }
                    if(isset($_POST['lat_long'])){
                       $user_data['lat_long'] = trim($_POST['lat_long']);
        
                       $latitude_longitude = explode(",",trim($_POST['lat_long']));
                       $user_data['lat'] = $latitude_longitude[0];
                       $user_data['long'] = $latitude_longitude[1];
                    }
                    if(isset($_POST['height'])){
                       $user_data['height'] = $_POST['height'];
                    }
                    if(isset($_POST['relationship_type'])){
                        $user_data['relationship_type'] = $_POST['relationship_type'];
                    }
                    if(isset($_POST['mbti'])){
                       $user_data['mbti'] = $_POST['mbti'];
                    }
                    if(isset($_POST['star_sign'])){
                       $user_data['star_sign'] = $_POST['star_sign'];
                    }
                    if(isset($_POST['political_view'])){
                       $user_data['political_view'] = $_POST['political_view'];
                    }
                    if(isset($_POST['religion'])){
                       $user_data['religion'] = $_POST['religion'];
                    }
                    if(isset($_POST['exercise'])){
                       $user_data['exercise'] = $_POST['exercise'];
                    }
                    if(isset($_POST['drinking'])){
                       $user_data['drinking'] = $_POST['drinking'];
                    }
                    if(isset($_POST['smoking'])){
                      $user_data['smoking'] = $_POST['smoking'];
                    }

                    $user_info = $this->Common_model->update_info(K_USERS, $user_data, array('userid' => $userid), array());
                    $userdata = $this->Common_model->get_selected_data(K_USERS, array('userid'=> $userid));
                    echo json_encode(['status' => 'success', 'msg' => 'Updated Successfully', 'response' => $userdata]);
                    die();
                } else {
                       echo json_encode(['status' => 'fail', 'msg' => 'Please Enter Correct userid']);
                }    

            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Please Enter userid']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown Method']);
       }          
    }
   
    public function delete_user_profile_images()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['userid'])){
                $userid = trim($_POST['userid']);
                $res = $this->Common_model->get_selected_data(K_USERS, array('userid' => $userid));
                if(!empty($res)){
                    if(isset($_POST['image'])){
                        $imagefile = $_POST['image'];
                        $result = $this->Common_model-> get_selected_data(K_USERS, array('userid' => $userid));
                        if(!empty($result[$imagefile])){
                            unlink('./site-assets/img/user-avatar/'.$result[$imagefile]);  
                            $user_data[$imagefile] = '';
                        
                            $this->Common_model->update_info(K_USERS, $user_data, array('userid' => $userid), array()); 
                            echo json_encode(['status' => 'success', 'msg' => 'Image Deleted Successfully']); 
                        } 
                    } else {
                        echo json_encode(['status' => 'fail', 'msg' => 'Enter Correct Data']);
                    } 
                } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Enter Correct userid']);
                }         

            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'userid Not Found']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }    
    }

    public function update_user_profile_images(){
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['userid'])){
                $userid = trim($_POST['userid']);
                $result = $this->Common_model-> get_selected_data(K_USERS, array('userid' => $userid));
                if($result){
                    //pre($_FILES);
                    if(isset($_FILES['image1']['name'])){
                        $imagefile = "image1";
                    } 
                    
                    if(isset($_FILES['image2']['name'])){
                        $imagefile = "image2";
                    }

                    if(isset($_FILES['image3']['name'])){
                        $imagefile ="image3";
                    } 

                    if($imagefile){  
                        $time = time();
                        $fileName = random_string('numeric', 5)."-". $time ."_".$imagefile;
                        $config['upload_path'] = './site-assets/img/user-avatar/';
                        $config['file_name'] = $fileName. '.jpg';
                        $config['allowed_types'] = 'gif|png|jpeg|jpg';
                        $config['file_ext_tolower'] = true;
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload($imagefile)) {
                            $error = array('error' => $this->upload->display_errors());
                            echo json_encode(['status' => 'fail', 'msg' => $error]);
                        } else {
                            $data = $this->upload->data();
                        }
        
                        $user_data[$imagefile] = $data['file_name'];
                        if(!empty($result[$imagefile])){
                            unlink('./site-assets/img/user-avatar/'.$result[$imagefile]);
                        }
                        $user_info = $this->Common_model->update_info(K_USERS, $user_data, array('userid' => $userid), array());
                        $data = $this->Common_model->get_selected_data(K_USERS, array('userid'=> $userid));
                    
                        $userdata[$imagefile] = $data[$imagefile];
                        echo json_encode(['status' => 'success', 'msg' => 'Image Updated Successfully', 'response' => $userdata]);
                        die();    
                    
                    }    
                } else{
                    echo json_encode(['status' => 'fail', 'msg' => 'Enter Correct userid']);
                }     
            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'userid Not Found']);
            }    

        } else {
           echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }         
    }

    public function userNearByMe()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['userid']) && $_POST['userid'] != null
                && isset($_POST['lat_long']) && $_POST['lat_long'] != null
                && isset($_POST['version']) && $_POST['version'] != null
                && isset($_POST['device']) && $_POST['device'] != null
                && isset($_POST['device_token']) && $_POST['device_token'] != null

                && isset($_POST['records_per_page']) && $_POST['records_per_page'] != null
                && isset($_POST['page_index']) && $_POST['page_index'] != null

                && isset($_POST['distance'])
                && isset($_POST['gender'])
                && isset($_POST['age_min'])
                && isset($_POST['age_max'])
                
                && isset($_POST['relationship_type'])
                && isset($_POST['mbti'])
                && isset($_POST['star_sign'])
                && isset($_POST['religion'])
                && isset($_POST['drinking'])
                && isset($_POST['smoking'])
                && isset($_POST['political_view'])
              )
            {
                $userid = trim($_POST['userid']);
                $lat_long = trim($_POST['lat_long']);
                $version = trim($_POST['version']);
                $device = trim($_POST['device']);
                $device_token = trim($_POST['device_token']);

                $records_per_page = trim($_POST['records_per_page']);
               // $page_index = trim($_POST['page_index']);
               // $page_offset = $records_per_page*$page_index;
                $page_offset = trim($_POST['page_index']);

                
                if(isset($_POST['distance']) && $_POST['distance'] != null){
                    $distance = trim($_POST['distance']);
                } else {
                    $distance = 10;
                }
                if(isset($_POST['gender']) && $_POST['gender'] != null){
                   $where3['gender'] = trim($_POST['gender']);
                }
                if(isset($_POST['age_min']) && $_POST['age_min'] != null && isset($_POST['age_max']) && $_POST['age_max'] != null){
                   $age_min = trim($_POST['age_min']);
                   $age_max = trim($_POST['age_max']);
                   $where3['age >='] = $age_min;
                   $where3['age <='] = $age_max;
                  // pre($where3);
                }
              // pre($where3);
                if(isset($_POST['relationship_type']) && $_POST['relationship_type'] != null){
                    $where3['relationship_type'] = trim($_POST['relationship_type']);
                } 
                if(isset($_POST['mbti']) && $_POST['mbti'] != null){
                    $where3['mbti'] = trim($_POST['mbti']);
                } 
                if(isset($_POST['star_sign']) && $_POST['star_sign'] != null){
                     $where3['star_sign'] = trim($_POST['star_sign']);
                } 
                if(isset($_POST['religion']) && $_POST['religion'] != null){
                    $where3['religion'] = trim($_POST['religion']);
                } 
                if(isset($_POST['drinking']) && $_POST['drinking'] != null){
                   $where3['drinking'] = trim($_POST['drinking']);
                } 
                if(isset($_POST['smoking']) && $_POST['smoking'] != null){
                    $where3['smoking'] = trim($_POST['smoking']);
                } 
                if(isset($_POST['political_view']) && $_POST['political_view'] != null){
                    $where3['political_view'] = trim($_POST['political_view']);
               } 
                $result = $this->Common_model-> get_selected_data(K_USERS, array('userid' => $userid));
                if(!empty($result)){
                    if($result['block'] == 0){
                        $mylocation=explode(",",$lat_long);
                        $lat = $mylocation[0];
                        $long = $mylocation[1];
                        $id = array('userid' => $userid);
                        $info = array( 'lat_long' => $lat_long,
                                        'lat' => $mylocation[0],
                                        'long' => $mylocation[1],
                                        'version' => $version,
                                        'device' => $device,
                                        'device_token' => $device_token
                                       );
                        $result4 = $this->Common_model-> update_info(K_USERS, $info, $id);

                        $result = $this->Common_model-> get_multi_selected_data(F_USERS, array());
                        $count = count($result);
                        $blocked_user_id = array();
                        for($i=0; $i<$count;$i++){
                            $blocked_user_id[] = $result[$i]['user_id'];
                        }
                        $where1 =  array('action_profile' => $userid);
                        $result1 = $this->Common_model-> get_multi_selected_data(K_LIKE_UNLIKE, $where1, array());
                        $count1 = count($result1);
                        for($i=0; $i<$count1;$i++){
                            $blocked_user_id[] = $result1[$i]['effect_profile'];
                        }
                        $blocked_user_id[] = $userid;
                       // pre($blocked_user_id);
                        $where_not_in_ids = $blocked_user_id;      //  flag, already like user, self
                        $where3['hide_me'] = 0;    // not add hidden users
                        $where3['block'] = 0;   // not add block users
                        $totalCount = $this->getNearByUserCount($where3, $distance, $lat, $long, $where_not_in_ids);    
                        $res = $this->getNearByUserDistance($where3, $distance, $lat, $long, $where_not_in_ids, $records_per_page, $page_offset); 
                        for($i=0; $i< count($res); $i++){
                            $userid = $res[$i]['userid'];
                            $order = array('by_col' => 'updated_at',
                                            'order' => 'DESC',
                                            );
                            $field_data =  array( 'effect_profile' => $userid,
                                              'action_type' => 'like',
                                              'match_profile' => 'true', 
                                              'chat' => 'true',
                                              'feedback' => 2,
                                              'block' => 0, 
                                              'hide_me' =>0,
                                            );
                            $result = $this->Custom_model-> userNearMeLikeGetdata(K_LIKE_UNLIKE, $field_data, $order, '3', '');
                            // pre($result);
                            // die();
                            $res[$i]['letestUserWhoLiked'] =  $result;                            
                        } 

                        if(!empty($res)){
                            echo json_encode(['status' => 'success', 'totalCount' => $totalCount, 'response' => $res]);
                        } else {
                            echo json_encode(['status' => 'fail' , 'response' => ' Data Not Available']); 
                        }
                    } else {
                        echo json_encode(['status' => 'fail', 'msg' => 'block']);
                        die();
                    }    

                } else {
                       echo json_encode(['status' => 'fail', 'response' => ' Enter Correct userid']); 
                }        
            } else {
                echo json_encode(['status' => 'fail', 'msg' => 'Parameters Are Missing']);
            }
        } else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }     
    }




     public function user_report()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $user_id = $_POST['userid'];
            $my_id = $_POST['my_userid'];
             $data = array(
                        "user_id" => $user_id,
                    );
            $report_data = $this->Common_model->get_full_data('', F_USERS, $data);
            if(empty($report_data)){
                $user_data = $this->Common_model->get_full_data('', K_USERS, array('userid' => $my_id));
                $reported_user_data = $this->Common_model->get_full_data('', K_USERS, array('userid' => $user_id));
                if (!empty($user_data) && $my_id != '') {
                    if (!empty($reported_user_data) && $user_id != '') {
                        $data = array(
                            "user_id" => $user_id,
                            "flag_by" => $my_id,
                        );
                        $this->Common_model->insert_info(F_USERS, $data);

                        echo json_encode(['status' => 'success', 'response' => $data, 'msg' => 'User reported successfully']);
                    } else {
                        echo json_encode(['status' => 'fail', 'msg' => 'Some error occured in getting reported user info']);
                    }
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'Some error occured in getting user info']);
                }
            }else{
                echo json_encode(['status' => 'fail', 'msg' => 'User already reported']);
            }
        }else {
            echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }
    }

    public function my_matched_profile()
    {
    
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['userid']) && trim($_POST['userid']) != null &&  isset($_POST['other_id']) && trim($_POST['other_id']) != null &&  isset($_POST['like_dis']) && trim($_POST['like_dis']) != null )
            {
                $userid = trim($_POST['userid']);
                $another_userid = trim($_POST['other_id']);

                $res_user = $this->Common_model->get_selected_data(K_USERS, array('userid' => $userid));
                

                if(!empty($res_user)){
                    $res_another = $this->Common_model->get_selected_data(K_USERS, array('userid' => $another_userid));
                    if(!empty($res_another)){

                        $like_dis = trim($_POST['like_dis']);
                        if($like_dis == "like" || $like_dis == "dislike"){
                            $field_data =  array( 'action_profile' => $userid,
                                                   'effect_profile' => $another_userid,
                                                   'action_type' => $like_dis,
                                                   'effected' => 'true',
                                                   'match_profile' => 'false', 
                                                   'chat' => 'false', 
                                                );
                            $field_data1 =  array( 'action_profile' => $userid,
                                                   'effect_profile' => $another_userid
                                                );
                            $field_data2 =  array( 'action_profile' => $another_userid,
                                                    'effect_profile' => $userid 
                                                  );
                            $result1 = $this->Common_model-> get_selected_data(K_LIKE_UNLIKE, $field_data1);
                            $result2 = $this->Common_model-> get_selected_data(K_LIKE_UNLIKE, $field_data2);

                            if(empty($result1) && empty($result2)){
                               $status_insert = $this->Common_model->insert_info(K_LIKE_UNLIKE, $field_data);
                               if($status_insert){
                                    if($like_dis=="like"){
                                        $ids = array($another_userid);
                                        $tokens = $this->get_device_token($ids);
                                       // pre($tokens);
                                        $title = "You got a Like";
                                        $message = "Someone liked your Profile";
                                        $this->push_notification($title, $message, $tokens);
                                    }    
                                    echo json_encode(['status' => 'success', 'msg' => 'User '.$like_dis.' Successfully', 'match'=> 'false']);
                                } else {
                                    echo json_encode(['status' => 'fail', 'msg' => 'Error in Data Insert']);
                                }
                                    
                            }
                            else if(empty($result1) && !empty($result2)){
                                $status_insert = $this->Common_model->insert_info(K_LIKE_UNLIKE, $field_data);
                                if($status_insert){
                                    if($result2['action_type'] == "like" && $like_dis == "like"){
                                        $info =  array('match_profile' => 'true');  
                                        $result3 = $this->Common_model-> update_info(K_LIKE_UNLIKE, $info, $field_data1);
                                        $result4 = $this->Common_model-> update_info(K_LIKE_UNLIKE, $info, $field_data2);

                                        $ids = array($userid, $another_userid);
                                        $tokens = $this->get_device_token($ids);
                                        // pre($tokens);
                                        $title = "You got a Match";
                                        $message = "congrat's you got a matched.";
                                        $this->push_notification($title, $message, $tokens);
                                        echo json_encode(['status' => 'success',  'msg' => 'User '.$like_dis.' Successfully', 'match'=> 'true']);
                                        
                                    } else {
                                        if($result2['action_type'] == "like" && $like_dis == "dislike"){
                                           echo json_encode(['status' => 'success', 'msg' => 'You Disliked' , 'match'=> 'false']);
                                        }
                                        else if($result2['action_type'] == "dislike" && $like_dis == "like"){
                                            $ids = array($another_userid);
                                            $tokens = $this->get_device_token($ids);
                                            // pre($tokens);
                                            $title = "You got a Like";
                                            $message = "Someone liked your Profile";
                                            $status = $this->push_notification($title, $message, $tokens);
                                            echo json_encode(['status' => 'success', 'msg' => 'You Liked' , 'match'=> 'false']);
                                        }  
                                        else if($result2['action_type'] == "dislike" && $like_dis == "dislike"){
                                           echo json_encode(['status' => 'success', 'msg' => 'User '.$like_dis.' Successfully' , 'match'=> 'false']);
                                        } 
                                    }
                                } else {
                                    echo json_encode(['status' => 'fail', 'msg' => 'Error in Data Insert']);
                                }         
                            } 
                            else if(!empty($result1) && empty($result2)){
                                if($result1['action_type']){
                                    $user_data = array('action_type' => $like_dis); 
                                    $update_info = $this->Common_model->update_info(K_LIKE_UNLIKE, $user_data, $field_data1, array());
                                    if($update_info && $result1['action_type']=="dislike" && $like_dis=="like"){
                                        $ids = array($another_userid);
                                        $tokens = $this->get_device_token($ids);
                                        // pre($tokens);
                                        $title = "You got a Like";
                                        $message = "Someone liked your Profile";
                                        $this->push_notification($title, $message,$tokens);
                                        echo json_encode(['status' => 'success',  'msg' =>  'User '.$like_dis.' Successfully', 'match'=> 'false']);
                                    } else if($update_info && $result1['action_type']=="like" && $like_dis=="dislike"){
                                        echo json_encode(['status' => 'success',  'msg' =>  'User '.$like_dis.' Successfully', 'match'=> 'false']);
                                    } else {
                                        echo json_encode(['status' => 'success', 'msg' =>  'User Already '.$like_dis, 'match'=> 'false']);
                                    }
                                }    
                            } 
                           // pre("okkkkk"); 
                            else if(!empty($result1) && !empty($result2)){          
                                if($result1['action_type'] == "dislike" && $result2['action_type'] == "like" && $like_dis == "like"){
                                   // pre("okk1");
                                    $user_data = array('action_type' => $like_dis);              
                                    $status_update1 = $this->Common_model->update_info(K_LIKE_UNLIKE, $user_data, array('id' => $result1['id']), array());
                                    $user_data1 = array('match_profile' =>'true');
                                    $ids = array($result1['id'],$result2['id']);    
                                    $status_update2 = $this->Custom_model->update_info_c(K_LIKE_UNLIKE, $user_data1, $ids, array());            
                                    if($status_update1 && $status_update2){
                                        $ids = array($userid, $another_userid);
                                        $tokens = $this->get_device_token($ids);
                                        // pre($tokens);
                                        $title = "You got a Match";
                                        $message = "congrat's you got a matched.";
                                        $status = $this->push_notification($title, $message,$tokens);
                                        echo json_encode(['status' => 'success',  'msg' =>  'User '.$like_dis.' Successfully', 'match'=> 'true']);
                                    } else {
                                        echo json_encode(['status' => 'success', 'msg' => 'User Already '.$like_dis]);
                                    }  

                                }

                                else if($result1['action_type'] == "like" && $result2['action_type'] == "like" && $like_dis == "dislike"){
                                    $user_data = array('action_type' => $like_dis);              
                                    $user_info = $this->Common_model->update_info(K_LIKE_UNLIKE, $user_data, array('id' => $result1['id']), array());
                                 // pre("okk2");
                                    $user_data1 = array('match_profile' =>'false');
                                    $ids = array($result1['id'],$result2['id']);    
                                    $user_info = $this->Custom_model->update_info_c(K_LIKE_UNLIKE, $user_data1, $ids, array());
                                    echo json_encode(['status' => 'success', 'msg' =>  'User '.$like_dis.' Successfully', 'match'=> 'false']);
                                } else {
                                    if(($result1['action_type'] == "like" || $result1['action_type'] == "dislike") && ($result2['action_type'] == "dislike")){    
                                       $user_data = array('action_type' => $like_dis);
                                       $user_info = $this->Common_model->update_info(K_LIKE_UNLIKE, $user_data, $field_data1, array());
                                       //pre("okk3");
                                        if ($like_dis == "like" && $user_info) {
                                            $ids = array($another_userid);
                                            $tokens = $this->get_device_token($ids);
                                           // pre($tokens);
                                            $title = "You got a Like";
                                            $message = "Someone liked your Profile";
                                            $this->push_notification($title, $message, $tokens);
                                            echo json_encode(['status' => 'success', 'msg' =>  'User '.$like_dis.' Successfully', 'match'=> 'false']);
                                        }    
                                         else if($like_dis == "dislike" && $user_info){
                                            echo json_encode(['status' => 'success', 'msg' => 'User '.$like_dis.' Successfully', 'match'=> 'false']); 
                                        } else {    
                                            echo json_encode(['status' => 'success', 'msg' =>  'User Already '.$like_dis, 'match'=> 'false']);
                                        }
                                    }
                                    else if(($result1['action_type'] == "dislike")  && ($result2['action_type'] == "dislike") && ($like_dis == "like")){    
                                       $user_data = array('action_type' => $like_dis);
                                       $user_info = $this->Common_model->update_info(K_LIKE_UNLIKE, $user_data, $field_data1, array());
                                      // pre("okk4");
                                        $ids = array($another_userid);
                                        $tokens = $this->get_device_token($ids);
                                       // pre($tokens);
                                        $title = "You got a Like";
                                        $message = "Someone liked your Profile";
                                        $this->push_notification($title, $message, $tokens);
                                       // pre($status);
                                        //notification end
                                        if($user_info){
                                            echo json_encode(['status' => 'success', 'msg' => 'You Liked', 'match'=> 'false']);
                                        } else {    
                                        echo json_encode(['status' => 'success', 'msg' => 'Error In Data Updation', 'match'=> 'false']);
                                        }
                                    }  
                                    else {
                                        echo json_encode(['status' => 'success', 'msg' => 'User Already '.$like_dis]);
                                    }
                                }      
                            }
                        } else {
                           echo json_encode(['status' => 'fail', 'msg' => 'Enter Correct Value Of Field']);
                        }
                    } else{
                       echo json_encode(['status' => 'fail', 'msg' => 'User not Found (Enter Correct other_id)']);
                    }    
                } else{
                    echo json_encode(['status' => 'fail', 'msg' => 'User not Found (Enter Correct userid)']);
                }        

            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Enter Fields']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }     
    }

//------------ do not delete this finction---------this is special function--------this function counts total likes and dislike-------------store in database------------------------------

    // public function my_matched_profile()
    // {
    
    //     if($this->input->server('REQUEST_METHOD') === 'POST') {
    //         if(isset($_POST['userid']) && trim($_POST['userid']) != null &&  isset($_POST['other_id']) && trim($_POST['other_id']) != null &&  isset($_POST['like_dis']) && trim($_POST['like_dis']) != null )
    //         {
    //             $userid = trim($_POST['userid']);
    //             $another_userid = trim($_POST['other_id']);

    //             $res_user = $this->Common_model->get_selected_data(K_USERS, array('userid' => $userid));
                

    //             if(!empty($res_user)){
    //                 $res_another = $this->Common_model->get_selected_data(K_USERS, array('userid' => $another_userid));
    //                 if(!empty($res_another)){

    //                     $like_dis = trim($_POST['like_dis']);
    //                     if($like_dis == "like" || $like_dis == "dislike"){
    //                         $field_data =  array( 'action_profile' => $userid,
    //                                                'effect_profile' => $another_userid,
    //                                                'action_type' => $like_dis,
    //                                                'effected' => 'true',
    //                                                'match_profile' => 'false', 
    //                                                'chat' => 'false', 
    //                                             );
    //                         $field_data1 =  array( 'action_profile' => $userid,
    //                                                'effect_profile' => $another_userid
    //                                             );
    //                         $field_data2 =  array( 'action_profile' => $another_userid,
    //                                                 'effect_profile' => $userid 
    //                                               );
    //                         $result1 = $this->Common_model-> get_selected_data(K_LIKE_UNLIKE, $field_data1);
    //                         $result2 = $this->Common_model-> get_selected_data(K_LIKE_UNLIKE, $field_data2);

    //                         if(empty($result1) && empty($result2)){
    //                            $status_insert = $this->Common_model->insert_info(K_LIKE_UNLIKE, $field_data);
    //                            if($status_insert){

    //                                     if($like_dis =="like"){
    //                                        $ids = array($another_userid);
    //                                        $tokens = $this->get_device_token($ids);
    //                                       // pre($tokens);
    //                                        $title = "You got a Like";
    //                                        $message = "Someone liked your Profile";
    //                                        $status = $this->push_notification($title, $message, $tokens);
    
    //                                        $info = array('like_count' => $res_another['like_count']+1);        
    //                                     }else if($like_dis =="dislike"){
    //                                         $info = array('dislike_count' => $res_another['dislike_count']+1);
    //                                     }
    //                                     $where = array('userid' => $another_userid);
    //                                     $this->Common_model->update_info(K_USERS, $info, $where);

    //                                     
    //                                     // pre($status);
    //                                     //notification end
    //                                     if($status){
    //                                        echo json_encode(['status' => 'success', 'msg' => 'User '.$like_dis.' Successfully', 'match'=> 'false']);
    //                                     } 
                                    
    //                             } else {
    //                                     echo json_encode(['status' => 'fail', 'msg' => 'Error in Data Insert']);
    //                             }
                                    
    //                         }
    //                         else if(empty($result1) && !empty($result2)){
    //                             $status_insert = $this->Common_model->insert_info(K_LIKE_UNLIKE, $field_data);
    //                             if($status_insert){
    //                                 if($result2['action_type'] == "like" && $like_dis == "like"){
    //                                     $info =  array('match_profile' => 'true');  
    //                                     $result3 = $this->Common_model-> update_info(K_LIKE_UNLIKE, $info, $field_data1);
    //                                     $result4 = $this->Common_model-> update_info(K_LIKE_UNLIKE, $info, $field_data2);
                                         
    //                                     $info = array('like_count' => $res_another['like_count']+1);
    //                                     $where = array('userid' => $another_userid);
    //                                     $this->Common_model->update_info(K_USERS, $info, $where);

    //                                     $ids = array($userid, $another_userid);
    //                                     $tokens = $this->get_device_token($ids);
    //                                     // pre($tokens);
    //                                     $title = "You got a Match";
    //                                     $message = "congrat's you got a matched.";
    //                                     $status = $this->push_notification($title, $message, $tokens);
    //                                     // pre($status);
    //                                     //notification end

    //                                     if($status){
    //                                        echo json_encode(['status' => 'success',  'msg' => 'User '.$like_dis.' Successfully', 'match'=> 'true']);
    //                                     }
    //                                 } else {
    //                                     if($result2['action_type'] == "like" && $like_dis == "dislike"){
                                        
    //                                     $info = array('dislike_count' => $res_another['dislike_count']+1);
    //                                     $where = array('userid' => $another_userid);
    //                                     $this->Common_model->update_info(K_USERS, $info, $where);

    //                                        echo json_encode(['status' => 'success', 'msg' => 'You Disliked' , 'match'=> 'false']);
    //                                     }
    //                                     else if($result2['action_type'] == "dislike" && $like_dis == "like"){

    //                                         $info = array('like_count' => $res_another['like_count']+1);
    //                                         $where = array('userid' => $another_userid);
    //                                         $this->Common_model->update_info(K_USERS, $info, $where);

    //                                         $ids = array($another_userid);
    //                                         $tokens = $this->get_device_token($ids);
    //                                         // pre($tokens);
    //                                         $title = "You got a Like";
    //                                         $message = "Someone liked your Profile";
    //                                         $status = $this->push_notification($title, $message, $tokens);
    //                                         echo json_encode(['status' => 'success', 'msg' => 'You Liked' , 'match'=> 'false']);
    //                                     }  
    //                                     else if($result2['action_type'] == "dislike" && $like_dis == "dislike"){
    //                                        echo json_encode(['status' => 'success', 'msg' => 'User '.$like_dis.' Successfully' , 'match'=> 'false']);
    //                                     } 
    //                                 }
    //                             } else {
    //                                     echo json_encode(['status' => 'fail', 'msg' => 'Error in Data Insert']);
    //                             }         
    //                         } 
    //                         else if(!empty($result1) && empty($result2)){
    //                             if($result1['action_type']){
    //                                 $user_data = array('action_type' => $like_dis); 
    //                                 $update_info = $this->Common_model->update_info(K_LIKE_UNLIKE, $user_data, $field_data1, array());
    //                                 if($update_info && $result1['action_type']=="dislike" && $like_dis=="like"){

    //                                     $info = array('like_count' => $res_another['like_count']+1,
    //                                                   'dislike_count' => $res_another['dislike_count']-1);
    //                                     $where = array('userid' => $another_userid);
    //                                     $this->Common_model->update_info(K_USERS, $info, $where);

    //                                     $ids = array($another_userid);
    //                                     $tokens = $this->get_device_token($ids);
    //                                     // pre($tokens);
    //                                     $title = "You got a Like";
    //                                     $message = "Someone liked your Profile";
    //                                     $status = $this->push_notification($title, $message,$tokens);
    //                                     // pre($status);
    //                                     //notification end
                                      
    //                                     if($status){
    //                                        echo json_encode(['status' => 'success',  'msg' =>  'User '.$like_dis.' Successfully', 'match'=> 'false']);
    //                                     }
    //                                 } else if($update_info && $result1['action_type']=="like" && $like_dis=="dislike"){
    //                                     $info = array('like_count' => $res_another['like_count']-1,
    //                                                   'dislike_count' => $res_another['dislike_count']+1);
    //                                     $where = array('userid' => $another_userid);
    //                                     $this->Common_model->update_info(K_USERS, $info, $where);
    //                                     echo json_encode(['status' => 'success',  'msg' =>  'User '.$like_dis.' Successfully', 'match'=> 'false']);
                                        
    //                                 } else {
    //                                     echo json_encode(['status' => 'success', 'msg' =>  'User Already '.$like_dis, 'match'=> 'false']);
    //                                 }
    //                             }    
    //                         } 
                           
    //                          else if(!empty($result1) && !empty($result2)){          
    //                             if($result1['action_type'] == "dislike" && $result2['action_type'] == "like" && $like_dis == "like"){
    //                                // pre("okk1");
    //                                 $user_data = array('action_type' => $like_dis);              
    //                                 $status_update1 = $this->Common_model->update_info(K_LIKE_UNLIKE, $user_data, array('id' => $result1['id']), array());
    //                                 $user_data1 = array('match_profile' =>'true');
    //                                 $ids = array($result1['id'],$result2['id']);    
    //                                 $status_update2 = $this->Custom_model->update_info_c(K_LIKE_UNLIKE, $user_data1, $ids, array());            
    //                                 if($status_update1 && $status_update2){

    //                                     $info = array('like_count' => $res_another['like_count']+1,
    //                                                   'dislike_count' => $res_another['dislike_count']-1);
    //                                     $where = array('userid' => $another_userid);
    //                                     $this->Common_model->update_info(K_USERS, $info, $where);

    //                                     $ids = array($userid, $another_userid);
    //                                     $tokens = $this->get_device_token($ids);
    //                                     // pre($tokens);
    //                                     $title = "You got a Match";
    //                                     $message = "congrat's you got a matched.";
    //                                     $status = $this->push_notification($title, $message,$tokens);
    //                                     // pre($status);
    //                                     //notification end

    //                                     if($status){
    //                                        echo json_encode(['status' => 'success',  'msg' =>  'User '.$like_dis.' Successfully', 'match'=> 'true']);
    //                                     } 
    //                                 } else {
    //                                     echo json_encode(['status' => 'success', 'msg' => 'User Already '.$like_dis]);
    //                                 }  

    //                             }

    //                             else if($result1['action_type'] == "like" && $result2['action_type'] == "like" && $like_dis == "dislike"){
    //                                 $user_data = array('action_type' => $like_dis);              
    //                                 $user_info = $this->Common_model->update_info(K_LIKE_UNLIKE, $user_data, array('id' => $result1['id']), array());
    //                              // pre("okk2");
    //                                 $user_data1 = array('match_profile' =>'false');
    //                                 $ids = array($result1['id'],$result2['id']);    
    //                                 $user_info = $this->Custom_model->update_info_c(K_LIKE_UNLIKE, $user_data1, $ids, array());

    //                                 $info = array('like_count' => $res_another['like_count']-1,
    //                                               'dislike_count' => $res_another['dislike_count']+1);
    //                                 $where = array('userid' => $another_userid);
    //                                 $this->Common_model->update_info(K_USERS, $info, $where);

    //                                 echo json_encode(['status' => 'success', 'msg' =>  'User '.$like_dis.' Successfully', 'match'=> 'false']);
    //                             } else if(($result1['action_type'] == "like") && ($result2['action_type'] == "dislike") && ($like_dis == "dislike")){    
    //                                $user_data = array('action_type' => $like_dis);
    //                                $user_info = $this->Common_model->update_info(K_LIKE_UNLIKE, $user_data, $field_data1, array());
    //                               // pre("okk3");
    //                                     $info = array('like_count' => $res_another['like_count']-1,
    //                                                   'dislike_count' => $res_another['dislike_count']+1);
    //                                     $where = array('userid' => $another_userid);
    //                                     $this->Common_model->update_info(K_USERS, $info, $where);
    //                                     echo json_encode(['status' => 'success', 'msg' =>  'User '.$like_dis.' Successfully', 'match'=> 'false']);    
    //                             }
    //                             else if(($result1['action_type'] == "dislike")  && ($result2['action_type'] == "dislike") && ($like_dis == "like")){  
    //                                // pre("ok4");  
    //                                $user_data = array('action_type' => $like_dis);
    //                                $user_info = $this->Common_model->update_info(K_LIKE_UNLIKE, $user_data, $field_data1, array());

    //                                 $info = array('like_count' => $res_another['like_count']+1,
    //                                               'dislike_count' => $res_another['dislike_count']-1);
    //                                 $where = array('userid' => $another_userid);
    //                                 $this->Common_model->update_info(K_USERS, $info, $where);

    //                                 $ids = array($another_userid);
    //                                 $tokens = $this->get_device_token($ids);
    //                                // pre($tokens);
    //                                 $title = "You got a Like";
    //                                 $message = "Someone liked your Profile";
    //                                 $status = $this->push_notification($title, $message, $tokens);
    //                                // pre($status);
    //                                 //notification end
    //                                 if($user_info){
    //                                     echo json_encode(['status' => 'success', 'msg' => 'You '.$like_dis.' Successfully', 'match'=> 'false']);
    //                                 } else {    
    //                                      echo json_encode(['status' => 'success', 'msg' => 'Error In Data Updation', 'match'=> 'false']);
    //                                 }
    //                             }  
    //                             else {
    //                                 echo json_encode(['status' => 'success', 'msg' => 'User Already '.$like_dis]);
    //                             }
                                 
    //                         }
    //                     } else {
    //                        echo json_encode(['status' => 'fail', 'msg' => 'Enter Correct Value Of Field']);
    //                     }
    //                 } else{
    //                    echo json_encode(['status' => 'fail', 'msg' => 'User not Found (Enter Correct other_id)']);
    //                 }    
    //             } else{
    //                 echo json_encode(['status' => 'fail', 'msg' => 'User not Found (Enter Correct userid)']);
    //             }        

    //         } else{
    //             echo json_encode(['status' => 'fail', 'msg' => 'Enter Fields']);
    //         }
    //     } else {
    //     echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
    //     }     
    // }
 //---------------------------------------------- do not delete this finction-----------------------------------------this is special function--------------------------------------   

     public function mylikes()    
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') { 
            if(isset($_POST['userid']) && trim($_POST['userid'])!=null){
                $userid = trim($_POST['userid']);
                $field_data1 =  array('action_profile' => $userid,
                                      'action_type' => 'like',
                                      'effected' => 'true'
                                     );
                $res = $this->Common_model->get_selected_data(K_USERS, array('userid' => $userid));
                if(!empty($res)){
                    $select = array('effect_profile');
                    $result_data = $this->Common_model->get_full_data($select, K_LIKE_UNLIKE, $field_data1);
                   // pre($result_data);
                    $userid_id = array();
                    for($i=0;$i < count($result_data);$i++){
                        $userid_id[] = $result_data[$i]['effect_profile'];
                    }
                   // pre($userid_id);
                    if(!empty($result_data)){
                        // $select = array("userid", "social_id", "first_name","last_name","last_seen","birthday","age","gender","about_me","lat_long","lat", "long", "job_title", "company", "school", "image1", "image2", "image3", "like_count", "dislike_count", "hide_me", "block", "purchased", "version","device","profile_type","device_token","subscription_datetime","promoted","promoted_mins", "promoted_date", "hide_age", "hide_location", "created");

                        $friend_data = $this->Custom_model->get_multi_selected_data_c('*', K_USERS, '', 'userid', $userid_id);
                        $where = array('userid' => $userid);
                        $user_data = $this->Common_model->get_selected_data(K_USERS, $where);
                        //pre($user_data);
                        $lat_long = $user_data['lat_long'];
                        $mylocation=explode(",",$lat_long);
                        $lat1 = $mylocation[0];
                        $lon1 = $mylocation[1];
                        $lat1 = (double)$lat1;
                        $lon1 = (double)$lon1;
                        for($i=0; $i<count($friend_data);$i++){
                            $lat_long_fri = $friend_data[$i]['lat_long'];
                            $mylocation1=explode(",",$lat_long_fri);
                            $lat2 = $mylocation1[0];
                            $lon2 = $mylocation1[1];
                            $lat2 = (double)$lat2;
                            $lon2 = (double)$lon2;
                            $theta = $lon1 - $lon2;
                            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                            $dist = acos($dist);
                            $dist = rad2deg($dist);
                            $miles = $dist * 60 * 1.1515;
                            $kilometer = $miles * 1.609344;
                            $friend_data[$i]['distanse'] = round($kilometer);
                        }
                            echo json_encode(['status' => 'success', 'response' => $friend_data]);
                    } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'No Likes Found']);
                    } 
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'Enter Correct userid']);
                }      
            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Enter Id']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }      
    }


    public function whoLikesMe($userid){
       
        // $field_data =  array( 'effect_profile' => $userid,
        //                               'action_type' => 'like',
        //                               'match_profile' => 'false', 
        //                               'chat' => 'false', 
        //                             );
        // $result = $this->Common_model-> get_multi_selected_data(K_LIKE_UNLIKE, $field_data);
        // $count_records = count($result);
        //  $ids = array();
        // for($i=0; $i<$count_records; $i++){
        //     $ids[] = $result[$i]['action_profile'];
        // }
        // $where = array('block' => 0);
        // $where_in_notin = array('userid');
        // $where_in_ids = $ids;
        // $result_likes = array();
        // if(!empty($where_in_ids)){
        //     $result_likes = $this->Custom_model->get_multi_selected_data_c('*',K_USERS, $where, 'userid', $where_in_ids);
        // }
        // return $result_likes;

        $field_data =  array( 'effect_profile' => $userid,
                                      'action_type' => 'like',
                                      'match_profile' => 'false', 
                                      'chat' => 'false', 
                                    );
        $result = $this->Common_model-> get_multi_selected_data(K_LIKE_UNLIKE, $field_data);


        $field_data_dis =  array( 'action_profile' => $userid,
                                      'action_type' => 'dislike',
                                      'match_profile' => 'false', 
                                      'chat' => 'false', 
                                    );
        $result_dislike = $this->Common_model-> get_multi_selected_data(K_LIKE_UNLIKE, $field_data_dis);
        $count_records_dislike = count($result_dislike);
         $ids_dis = array();
        for($i=0; $i<$count_records_dislike; $i++){
            $ids_dis[] = $result_dislike[$i]['effect_profile'];
        }

        $count_records = count($result);
         $ids = array();
        for($i=0; $i<$count_records; $i++){
            $ids[] = $result[$i]['action_profile'];
        }
        $where = array('block' => 0);
        $where_in_notin = array('userid');
        $where_in_ids = $ids;
        $result_likes = array();
        if(!empty($where_in_ids)){
            $result_likes = $this->Custom_model->get_multi_selected_data_c('*',K_USERS, $where, 'userid', $where_in_ids, $ids_dis);
        }    
        return $result_likes;
    }

    public function myMatch(){
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['userid']) && trim($_POST['userid'])!=null){

                $field_data =  array( 'effect_profile' => $_POST['userid'],
                                  	'action_type' => 'like',
                                  	'match_profile' => 'true', 
                                 	// 'chat' => 'false', 
                                );
                    $result = $this->Common_model-> get_multi_selected_data(K_LIKE_UNLIKE, $field_data);
                    // $result = $this->Common_model-> get_mymatch( $field_data);

                    $count_records = count($result);
                     $ids = array();
                    for($i=0; $i<$count_records; $i++){
                        $ids[] = $result[$i]['action_profile'];
                    }
                    $where = array('block' => 0);
                    $where_in_notin = array('userid');
                    $where_in_ids = $ids;
                    $result_myMatch = array();
                    if(!empty($where_in_ids)){
                        $result_myMatch = $this->Custom_model->get_multi_selected_data_c('*',K_USERS, $where, 'userid', $where_in_ids);
                    
                        if($result_myMatch){     //     likes+dislikes both
                            $whoMatchTotal =  count($result_myMatch);
                            foreach($result_myMatch as $key => $row){
                                
                                $where_data=array('action_profile'=>$_POST['userid'],'effect_profile'=>$row['userid']);
                               
                                $result_data = $this->Common_model->get_selected_data('like_unlike',$where_data);
                                if($result_data['chat'] !=null){

                                    $result_myMatch[$key]['chat'] = $result_data['chat'];
                                    $result_myMatch[$key]['feedback'] = $result_data['feedback'];

                                    
                                }else{
                                    $result_myMatch[$key]['chat'] = 'false';
                                    $result_myMatch[$key]['feedback'] = 0;


                                }
                                
                            }

                        //     $data = array(
                        //     	'result' => $result,
                        //     	'result_myMatch' => $result_myMatch
                        //     	);
                        // pre($data);

                        
                            echo json_encode(['status' => 'success', 'response' => $result_myMatch,'myMatchTotal' => $whoMatchTotal]);

                        }else{
                            echo json_encode(['status' => 'fail', 'msg' => 'Enter Correct userid']);
                        }
                    }else{
                        echo json_encode(['status' => 'success', 'response' => [],'myMatchTotal' => 0]);

                    }

            }else{
                echo json_encode(['status' => 'fail', 'msg' => 'Id Not Found']);    
            }
        }else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }  
        
    }

    public function myLikesAndMatch()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') { 
            if(isset($_POST['userid']) && trim($_POST['userid'])!=null){
                $userid = trim($_POST['userid']);
                $res = $this->Common_model->get_selected_data(K_USERS, array('userid' => $userid));
                if(!empty($res)){
            
                    $whoLikesMe = $this->whoLikesMe($userid);     //     likes+dislikes both
                    $whoLikesMeTotal =  count($whoLikesMe);

                    /*
                    $result_data = array('myLikes' => $whoLikesMe,
                                         'myLikesTotal' => $whoLikesMeTotal,
                    );*/
                    echo json_encode(['status' => 'success', 'response' => $whoLikesMe,'myLikesTotal'=> $whoLikesMeTotal]);
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'Enter Correct userid']);
                }       
            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Id Not Found']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }      
    }

    public function get_user_profile()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $user_id = $_POST['userid'];
            $user_data = $this->Common_model->get_selected_data(K_USERS, array('userid' => $user_id));
            if (!empty($user_data)) {
                echo json_encode(['status' => 'success', 'response' => $user_data]);
            } else {
                echo json_encode(['status' => 'fail', 'msg' => 'Enter Correct userid']);
            }
        } else {
                echo json_encode(['status' => 'fail', 'msg' => 'Unknown Method']);
        }     
    }

    public function user_show_or_hide()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['userid']) && trim($_POST['userid']) != null){
                if( (isset($_POST['hide_me']) && trim($_POST['hide_me']) != null)
                    || (isset($_POST['hide_age']) && trim($_POST['hide_age']) != null)
                    || (isset($_POST['hide_location']) && trim($_POST['hide_location']) != null)

                    || (isset($_POST['hide_birthday']) && trim($_POST['hide_birthday']) != null)
                    || (isset($_POST['hide_position']) && trim($_POST['hide_position']) != null)
                    || (isset($_POST['hide_education']) && trim($_POST['hide_education']) != null)
                    || (isset($_POST['hide_height']) && trim($_POST['hide_height']) != null)
                    || (isset($_POST['hide_industrial_id']) && trim($_POST['hide_industrial_id']) != null)
                ){

                    $userid = trim($_POST['userid']);
                    //$user_data['userid'] = $userid;
                    $userdata = $this->Common_model->get_selected_data(K_USERS, array('userid' => $userid));
                    if($userdata){
                        if(isset($_POST['hide_me']) && trim($_POST['hide_me']) != null){ 
                            $user_data['hide_me'] = trim($_POST['hide_me']);
                        }
                        if(isset($_POST['hide_age']) && trim($_POST['hide_age']) != null){
                            $user_data['hide_age'] = trim($_POST['hide_age']);  
                        }  
                        if(isset($_POST['hide_location']) && trim($_POST['hide_location']) != null){
                            $user_data['hide_location'] = trim($_POST['hide_location']); 
                        }

                        if(isset($_POST['hide_birthday']) && trim($_POST['hide_birthday']) != null){
                            $user_data['hide_birthday'] = trim($_POST['hide_birthday']); 
                        }
                        if(isset($_POST['hide_position']) && trim($_POST['hide_position']) != null){
                            $user_data['hide_position'] = trim($_POST['hide_position']); 
                        }
                        if(isset($_POST['hide_education']) && trim($_POST['hide_education']) != null){
                            $user_data['hide_education'] = trim($_POST['hide_education']); 
                        }
                        if(isset($_POST['hide_height']) && trim($_POST['hide_height']) != null){
                            $user_data['hide_height'] = trim($_POST['hide_height']); 
                        }
                        if(isset($_POST['hide_industry']) && trim($_POST['hide_industry']) != null){
                            $user_data['hide_industry'] = trim($_POST['hide_industry']); 
                        }

                        if(isset($_POST['hide_gender']) && trim($_POST['hide_gender']) != null){
                            $user_data['hide_gender'] = trim($_POST['hide_gender']); 
                        }
                        if(isset($_POST['hide_interest']) && trim($_POST['hide_interest']) != null){
                            $user_data['hide_interest'] = trim($_POST['hide_interest']); 
                        }
                        if(isset($_POST['hide_basic_info']) && trim($_POST['hide_basic_info']) != null){
                            $user_data['hide_basic_info'] = trim($_POST['hide_basic_info']); 
                        }
                        if(isset($_POST['hide_relationship_type']) && trim($_POST['hide_relationship_type']) != null){
                            $user_data['hide_relationship_type'] = trim($_POST['hide_relationship_type']); 
                        }
                        if(isset($_POST['hide_mbti']) && trim($_POST['hide_mbti']) != null){
                            $user_data['hide_mbti'] = trim($_POST['hide_mbti']); 
                        }
                        if(isset($_POST['hide_star_sign']) && trim($_POST['hide_star_sign']) != null){
                            $user_data['hide_star_sign'] = trim($_POST['hide_star_sign']); 
                        }
                        if(isset($_POST['hide_political_view']) && trim($_POST['hide_political_view']) != null){
                            $user_data['hide_political_view'] = trim($_POST['hide_political_view']); 
                        }
                        if(isset($_POST['hide_religion']) && trim($_POST['hide_religion']) != null){
                            $user_data['hide_religion'] = trim($_POST['hide_religion']); 
                        }
                        if(isset($_POST['hide_excercise']) && trim($_POST['hide_excercise']) != null){
                            $user_data['hide_excercise'] = trim($_POST['hide_excercise']); 
                        }
                        if(isset($_POST['hide_drinking']) && trim($_POST['hide_drinking']) != null){
                            $user_data['hide_drinking'] = trim($_POST['hide_drinking']); 
                        }
                        if(isset($_POST['hide_smoking']) && trim($_POST['hide_smoking']) != null){
                            $user_data['hide_smoking'] = trim($_POST['hide_smoking']); 
                        }
                        if(isset($_POST['hide_profile_url']) && trim($_POST['hide_profile_url']) != null){
                            $user_data['hide_profile_url'] = trim($_POST['hide_profile_url']); 
                        }
                        
                    
                        $user_info = $this->Common_model->update_info(K_USERS, $user_data, array('userid' => $userid), array());
                        $show_hide_data = $this->Common_model->get_selected_data(K_USERS, array('userid' => $userid));
                        echo json_encode(['status' => 'success', 'msg' => "Updated Successfully" , 'response' => $show_hide_data]);
                    } else {
                        echo json_encode(['status' => 'fail', 'msg' => 'User not found']);
                    }
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'Please Enter Field']);
                }                
            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Id Not Found']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
       }            
    }

    public function feedback(){
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['userid']) && trim($_POST['userid']) != null
               && isset($_POST['other_id']) && trim($_POST['other_id']) != null
               && isset($_POST['feedback']) && trim($_POST['feedback']) != null)
            {
                $userid = trim($_POST['userid']);
                $other_id = trim($_POST['other_id']);
                $feedback = trim($_POST['feedback']);
                $userdata = $this->Common_model->get_selected_data(K_USERS, array('userid' => $userid));
                if($userdata){
                    $other_userdata = $this->Common_model->get_selected_data(K_USERS, array('userid' => $other_id));
                    if($other_userdata){
                        if($_POST['feedback']==1){
                            $data = array('feedback' => $feedback);
                            $where = array('action_profile' => $userid,
                                           'effect_profile' => $other_id,
                                          // 'chat' => "true",
                                            );
                            $this->Common_model->update_info(K_LIKE_UNLIKE, $data, $where, array());
                            echo json_encode(['status' => 'success', 'msg' => "Feedback Updated Successfully" , 'response' => $feedback]);
                        } else {
                            echo json_encode(['status' => 'fail', 'msg' => 'Enter Correct Values Of Feedback(like 1)']);
                        }
                    } else {
                        echo json_encode(['status' => 'fail', 'msg' => 'Other User not found']);
                    }    
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'User not found']);
                }        
            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Paremeters Not Found']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }            
    }

    // public function feedbackReview(){
    //     if($this->input->server('REQUEST_METHOD') === 'POST') {
    //         if(isset($_POST['userid']) && trim($_POST['userid']) != null
    //            && isset($_POST['other_id']) && trim($_POST['other_id']) != null
    //            && isset($_POST['feedback_review']) && trim($_POST['feedback_review']) != null)
    //         {
    //             $userid = trim($_POST['userid']);
    //             $other_id = trim($_POST['other_id']);
    //             $feedback_review = trim($_POST['feedback_review']);
    //             $userdata = $this->Common_model->get_selected_data(K_USERS, array('userid' => $userid));
    //             if($userdata){
    //                 $other_userdata = $this->Common_model->get_selected_data(K_USERS, array('userid' => $other_id));
    //                 if($other_userdata){
    //                     $data = array('feedback_review' => $feedback_review);
    //                     $where = array('action_profile' => $userid,
    //                                    'effect_profile' => $other_id,
    //                                    'chat' => "true",
    //                                     );
                       
    //                     $this->Common_model->update_info(K_LIKE_UNLIKE, $data, $where , array());
    //                     echo json_encode(['status' => 'success', 'msg' => "feedback review Updated Successfully"]);
    //                 } else {
    //                     echo json_encode(['status' => 'fail', 'msg' => 'Other User not found']);
    //                 }    
    //             } else {
    //                 echo json_encode(['status' => 'fail', 'msg' => 'User not found']);
    //             }   
    //         } else{
    //             echo json_encode(['status' => 'fail', 'msg' => 'Paremeters Not Found']);
    //         }
    //     } else {
    //     echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
    //     }            
    // }

    // public function feedbackRating(){
    //     if($this->input->server('REQUEST_METHOD') === 'POST') {
    //         if(isset($_POST['userid']) && trim($_POST['userid']) != null
    //            && isset($_POST['other_id']) && trim($_POST['other_id']) != null
    //            && isset($_POST['feedback_rating']) && trim($_POST['feedback_rating']) != null)
    //         {
    //             $userid = trim($_POST['userid']);
    //             $other_id = trim($_POST['other_id']);
    //             $feedback_rating = trim($_POST['feedback_rating']);

    //             $userdata = $this->Common_model->get_selected_data(K_USERS, array('userid' => $userid));
    //             if($userdata){
    //                 $other_userdata = $this->Common_model->get_selected_data(K_USERS, array('userid' => $other_id));
    //                 if($other_userdata){
    //                     $data = array('feedback_rating' => $feedback_rating);
    //                     $where = array('action_profile' => $userid,
    //                                        'effect_profile' => $other_id,
    //                                        'chat' => "true",
    //                                         );
                           
    //                     $this->Common_model->update_info(K_LIKE_UNLIKE, $data, $where , array());
    //                     echo json_encode(['status' => 'success', 'msg' => "feedback Rating Updated Successfully"]);
    //                 } else {
    //                     echo json_encode(['status' => 'fail', 'msg' => 'Other User not found']);
    //                 }    
    //             } else {
    //                 echo json_encode(['status' => 'fail', 'msg' => 'User not found']);
    //             }   
    //         } else{
    //             echo json_encode(['status' => 'fail', 'msg' => 'Paremeters Not Found']);
    //         }
    //     } else {
    //     echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
    //     }            
    // }


    public function feedbackRatingReview(){
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['userid']) && trim($_POST['userid']) != null
               && isset($_POST['other_id']) && trim($_POST['other_id']) != null
               && isset($_POST['feedback_rating'])
               && isset($_POST['feedback_review']))
              
            {
                $userid = trim($_POST['userid']);
                $other_id = trim($_POST['other_id']);
                $feedback_rating = trim($_POST['feedback_rating']);
                $feedback_review = trim($_POST['feedback_review']);

                $userdata = $this->Common_model->get_selected_data(K_USERS, array('userid' => $userid));
                if($userdata){
                    $other_userdata = $this->Common_model->get_selected_data(K_USERS, array('userid' => $other_id));
                    if($other_userdata){
                        $data = array('feedback_rating' => $feedback_rating,
                                      'feedback_review' => $feedback_review,
                                      'feedback' => 2);
                        $where = array('action_profile' => $userid,
                                           'effect_profile' => $other_id,
                                          // 'chat' => "true",
                                            );
                           
                        $this->Common_model->update_info(K_LIKE_UNLIKE, $data, $where , array());
                        echo json_encode(['status' => 'success', 'msg' => "feedback Updated Successfully"]);
                    } else {
                        echo json_encode(['status' => 'fail', 'msg' => 'Other User not found']);
                    }    
                } else {
                    echo json_encode(['status' => 'fail', 'msg' => 'User not found']);
                }   
            } else{
                echo json_encode(['status' => 'fail', 'msg' => 'Paremeters Not Found or parem values must not empty']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }            
    }

    public function firstchat()
    {
        if($this->input->server('REQUEST_METHOD') === 'POST') {
            if(isset($_POST['userid']) && trim($_POST['userid']) != null 
                && isset($_POST['another_id']) && trim($_POST['another_id']) != null){
                
                $userid = $_POST['userid'];
                $effected_id = $_POST['another_id'];
                $info = array('chat' => 'true');
                $where1 = array('action_profile' => $userid,
                               'effect_profile' => $effected_id,
                               'action_type' => 'like',
                              // 'match_profile' =>'true'
                               );
                $result1 = $this->Common_model-> update_info(K_LIKE_UNLIKE, $info, $where1);
                $where2 = array('action_profile' => $effected_id,
                               'effect_profile' => $userid,
                               'action_type' => 'like',
                              // 'match_profile' =>'true'
                               );
                $result2 = $this->Common_model-> update_info(K_LIKE_UNLIKE, $info, $where2);
                $array_out = array();
                if($result1 && $result2)
                {
                    echo json_encode(['status' => 'success', 'msg' => 'Succesfully Updated']);
                } else{
                    echo json_encode(['status' => 'fail', 'msg' => 'Request Already Sent']);
                }
            }    
            else {   
               echo json_encode(['status' => 'fail', 'msg' => 'Please Enter Id']);
            }
        } else {
        echo json_encode(['status' => 'fail', 'msg' => 'Unknown method']);
        }      
    }



















}
