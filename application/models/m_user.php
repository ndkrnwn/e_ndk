<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_user extends CI_Model
{
    function __construct()
    {
        parent::__construct();

        // Load Second DB
        $this->db2 = $this->load->database('second', TRUE);
    }

    // fn Login 
    public function login($post)
    {
        $this->db2->select('*');
        $this->db2->from('ms_user');
        $this->db2->where('username', $post['username']);
        $this->db2->where('password', md5($post['password']));
        $query = $this->db2->get();
        return $query;
    }

    // fn Get Parameter Group from Database "ms_parameter"
    public function get_group()
    {
        $query = "SELECT * FROM ms_parameter WHERE class = 'group'";
        $result = $this->db2->query($query);
        return $result->result();
    }

    // fn Get Data User from Database "ms_user"
    public function get_data($id = null)
    {
        $this->db2->select('a.*,  b.explanation as group_name, c.explanation as dept_name, d.explanation as pt_name');
        $this->db2->from('ms_user a');
        if ($id != null) {
            $this->db2->where('ms_user.id', $id);
        }
        $this->db2->join('ms_parameter as b', 'a.group = b.code');
        $this->db2->join('ms_parameter as c', 'a.dept_code = c.code');
        $this->db2->join('ms_parameter as d', 'a.pt = d.code');
        $query = $this->db2->get();
        return $query;
    }

    // fn Get Data User from Database "ms_user"
    public function get($id = null)
    {
        $this->db2->select('*');
        $this->db2->from('ms_user');
        if ($id != null) {
            $this->db2->where('ms_user.id', $id);
        }
        $query = $this->db2->get();
        return $query;
    }

    // fn Edit Profile
    public function edit_profile($post)
    {
        $params['name'] = $post['fullname'];
        $params['nik'] = $post['nik'] != "" ? $post['nik'] : null;
        $params['position'] = $post['position'] != "" ? $post['position'] : null;

        $params['pt'] = $post['pt'];
        if (!empty($post['password'])) {
            $params['password'] = md5($post['password']);
        }
        $this->db2->where('id', $post['id']);
        $this->db2->update('ms_user', $params);
    }
}
