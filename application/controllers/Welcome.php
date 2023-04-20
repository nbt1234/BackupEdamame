<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_controller
{

    public function index()
    {
        // $aa = sendMail('testdemo199000@gmail.com','','asd','asd');
        // echo $this->email->print_debugger();
        // echo "***************************";

        // pre($aa);

        // echo "test";
        // $datas = $this->Common_model->get_multi_selected_data('chat_messages', array());

        // $this->db->select('*');
        // $this->db->from('chat_messages');
        // $this->db->order_by('created_at', 'DESC');

        // $data = $this->db->get()->result_array();

        // foreach ($data as $key => $datas) {
        //     $new[$key]['id'] = $datas['id'];
        //     $new[$key]['from_id'] = $datas['from_id'];
        //     $new[$key]['to_id'] = $datas['to_id'];
        //     $new[$key]['chat_room_id'] = $datas['chat_room_id'];
        //     $new[$key]['message'] = $datas['message'];
        //     $new[$key]['is_read'] = $datas['is_read'];
        //     $new[$key]['created_at'] = date('Y-m-d', strtotime($datas['created_at']));
        //     $new[$key]['updated_at'] = $datas['updated_at'];
        // }
        // $arr = array();
		
        // foreach ($new as $key => $item) {
        //     $arr[$item['created_at']][$key] = $item;
        // }

        // pre($arr);

        $this->load->view('aa');
        // $this->load->view('welcome_message');

    }
}
