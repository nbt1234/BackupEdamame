<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '../system/core/Model.php';

class CI_Db_lib extends CI_Model
{
    public function verify_exist_email($table = '', $where = '')
    {
        $data = $this->db->get_where($table, $where)->result_array();

        if (!empty($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_full_data($fields = '', $table = '', $where = '', $order = '', $limit = '', $offset = '')
    {
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->where($where);
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

    public function get_selected_data($table = '', $where = '')
    {
        $data = $this->db->get_where($table, $where)->result_array();
        if (!empty($data)) {
            return $data[0];
        } else {
            return array();
        }
    }

    public function get_multi_selected_data($table = '', $where = '', $order = '', $limit = '', $offset = '')
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
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

    public function insert_info($table = '', $info = '', $insert_id = false)
    {
        $this->db->insert($table, $info);
        if ($this->db->affected_rows()) {
            if ($insert_id == true) {
                return $this->db->insert_id();
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function update_info($table = '', $info = '', $where = '', $set = array())
    {
        $this->db->set($set)->where($where)->update($table, $info);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function data_delete($table = '', $where = '')
    {
        $this->db->delete($table, $where);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function count_data($table = '', $where = '')
    {
        $this->db->select('count(*) as count');
        $this->db->from($table);

        if (!empty($where)) {
            $this->db->where($where);
        }

        $data = $this->db->get()->result_array();

        if (!empty($data)) {
            return $data[0];
        } else {
            return array();
        }
    }

    public function batch_insert($table = '', $data = '')
    {
        $this->db->insert_batch($table, $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function batch_update($table = '', $data = '',$where='')
    {
        $this->db->update_batch($table, $data, $where);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function join_model($table = '', $where = array(), $join = '', $select = '*', $order = array(), $or_where = array(), $limit = '', $offset = '')
    {
        $this->db->select($select);
        $this->db->from($table);

        if (!empty($where)) {
            $this->db->where($where);
        }

        if (!empty($or_where)) {
            $this->db->or_where($or_where);
        }

        if (!empty($order)) {
            $this->db->order_by($order['by_col'], $order['order']);
        }
        if (!empty($limit)) {
            $this->db->limit($limit, $offset);
        }

        for ($i = 0; $i < count($join); $i++) {
            $this->db->join($join[$i]['table'], $join[$i]['value'], $join[$i]['type']);
        }

        $data = $this->db->get()->result_array();
        if (!empty($data)) {
            return $data;
        } else {
            return array();
        }
    }

}
