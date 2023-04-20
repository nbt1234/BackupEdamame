<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Custom_model extends CI_Model
{

    public function update_info_c($table = '', $info = '', $ids = '')
    {
        $this->db->where_in('id', $ids)->update($table, $info);
        if($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_multi_selected_data_c($select = '', $table = '', $where = '', $wherein_notin = '', $where_in_ids = '', $where_not_in_ids = '', $order = '', $limit = '', $offset = '')
    {
        if(empty($select)){
           $this->db->select('*');
        } else {
            $this->db->select($select);
        }

        $this->db->from($table);
        if(!empty($where)){
        $this->db->where($where);
        }
        if(!empty($where_in_ids) && !empty($wherein_notin)){
        $this->db->where_in($wherein_notin,$where_in_ids);
        }
        if (!empty($where_not_in_ids) && !empty($wherein_notin)) {
            $this->db->where_not_in($wherein_notin, $where_not_in_ids);
        }
        if (!empty($order)) {
            $this->db->order_by($order['by_col'], $order['order']);
        }
        if (!empty($limit)) {
            $this->db->limit($limit, $offset);
        }
        $data = $this->db->get()->result_array();

        if (!empty($data)) {
            return $data;
        } else {
            return array();
        }
    }

     public function get_multi_selected_data_c_advance($select = '', $table = '', $where = '', $wherein_notin = '', $where_in_ids = '', $where_not_in_ids = '', $order = '', $limit = '', $offset = '')
    {
        if(empty($select)){
           $this->db->select('*');
        } else {
            $this->db->select($select);
        }

        $this->db->from($table);
        if(!empty($where)){
        $this->db->where($where);
        }
        if(!empty($where_in_ids) && !empty($wherein_notin)){
        $this->db->where_in($wherein_notin,$where_in_ids);
        }
        if (!empty($where_not_in_ids) && !empty($wherein_notin)) {
            $this->db->where_not_in($wherein_notin, $where_not_in_ids);
        }
        if (!empty($order)) {
            $this->db->order_by($order['by_col'], $order['order']);
        }
        if (!empty($limit)) {
            $this->db->limit($limit, $offset);
        }
        $this->db->join('like_unlike','like_unlike.effect_profile = users.userid');
        $data = $this->db->get()->result_array();

        if (!empty($data)) {
            return $data;
        } else {
            return array();
        }
    }

    public function msg_by_date($userid='')
    {
        $this->db->select('like_unlike.action_type,users.first_name,users.userid,users.image1,users.last_seen,like_unlike.effect_profile,like_unlike.last_msg_time_updated');
        // $this->db->select('*');
        $this->db->from(K_LIKE_UNLIKE);
        $this->db->where('action_profile',$userid);
        $this->db->where('match_profile' ,'true');
        $this->db->order_by('last_msg_time_updated' ,'DESC');

        $this->db->join('users','users.userid=like_unlike.effect_profile');

        $res = $this->db->get()->result_array();
        return $res;
        //pre($res);
    }

    public function userNearMeLikeGetdata($table = '', $where = '', $order = '', $limit = '', $offset = '', $join ='')
    {

        $this->db->select('like_unlike.effect_profile, like_unlike.action_profile, like_unlike.feedback_rating, like_unlike.feedback_review, like_unlike.updated_at, users.userid, users.first_name, users.last_name, ');
        $this->db->from($table);
        $this->db->where($where);
        $this->db->order_by($order['by_col'], $order['order']);
        $this->db->limit($limit, $offset);
        $this->db->join('users','users.userid=like_unlike.action_profile');
        $data = $this->db->get()->result_array();
        return $data;
    }
}    