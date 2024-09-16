<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['m_user', 'm_parameter']);
        $this->load->library(['form_validation', 'fungsi']);
    }

    // fn Edit Profile
    public function edit_profile($id)
    {
        $this->form_validation->set_rules('username', 'Username', 'min_length[5]|callback_username_check');
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[5]');
            $this->form_validation->set_rules(
                'pass-conf',
                'Confirmation Password',
                'matches[password]',
                array('matches' => 'The Password and %s do not match')
            );
        }
        if ($this->input->post('pass-conf')) {
            $this->form_validation->set_rules(
                'pass-conf',
                'Confirmation Password',
                'matches[password]',
                array('matches' => 'The Password and %s do not match')
            );
        }
        $this->form_validation->set_message('min_length', '{field} must be at least 5 characters long!');
        if ($this->form_validation->run() == FALSE) {
            $query = $this->m_user->get($id);
            if ($query->num_rows() > 0) {
                $data['gr'] = $this->m_user->get_group();
                $data['pt'] = $this->m_parameter->get_pt();
                $data['dp'] = $this->m_parameter->get_dept();
                $data['row'] = $query->row();
                $this->load->view('template/header');
                $this->load->view('template/navbar');
                $this->load->view('user/edit_profile', $data);
                $this->load->view('template/footer');
            } else {
                echo "<script>alert('Data cannot be found');";
                echo "window.location='" . site_url('home') . "';</script>";
            }
        } else {
            $post = $this->input->post(null, TRUE);

            $params = array('ses_name', 'ses_jbtn');
            $this->session->unset_userdata($params);

            $params = array(
                'ses_name' => $post['fullname'],
                'ses_jbtn' => $post['position']
            );
            $this->session->set_userdata($params);

            $this->m_user->edit_profile($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'success message');
            }
            echo "<script>window.location='" . site_url('home') . "';</script>";
        }
    }

    // fn Check Username
    function username_check()
    {
        $post = $this->input->post(null, TRUE);
        $this->db2 = $this->load->database('second', TRUE);
        $query = $this->db2->query("SELECT * FROM ms_user WHERE username ='$post[username]' AND id != '$post[id]'");
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('username_check',  'Sorry, {field} already exists!');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
