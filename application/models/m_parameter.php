<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_parameter extends CI_Model
{
    function __construct()
    {
        parent::__construct();

        // Load Second DB
        $this->db2 = $this->load->database('second', TRUE);
    }

    // fn Get Parameter from Database "ms_parameter"
    public function get_class()
    {
        $query = "SELECT * FROM ms_parameter GROUP BY class";
        $result = $this->db2->query($query);
        return $result->result();
    }

    // fn Get Parameter PT from Database "ms_parameter"
    public function get_pt()
    {
        $query = "SELECT * FROM ms_parameter WHERE class = 'pt' ORDER BY explanation ASC";
        $result = $this->db2->query($query);
        return $result->result();
    }

    // fn Get Parameter Dept from Database "ms_parameter"
    public function get_dept()
    {
        $query = "SELECT * FROM ms_parameter WHERE class = 'department'";
        $result = $this->db2->query($query);
        return $result->result();
    }
}
