<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    // fn Index
    public function login()
    {
        check_already_login();
        $data['title'] = 'Login Page';
        $this->load->view('auth', $data);
    }

    //  fn Process Login
    public function proses()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])) {
            $this->load->model('m_user');
            $query = $this->m_user->login($post);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $params = array(
                    'ses_id' => $row->id,
                    'ses_group' => $row->group,
                    'ses_name' => $row->name,
                    'ses_uname' => $row->username,
                    'ses_jbtn' => $row->position,
                    'ses_dept' => $row->dept_code
                );
                $this->session->set_userdata($params);
                $this->session->set_flashdata('login', 'login message');
                echo "<script>
						window.location='" . site_url('home') . "';
					</script>";
            } else {
                $this->session->set_flashdata('failed', 'failed');
                echo "<script>window.location='" . site_url('auth/login') . "';</script>";
            }
        }
    }

    //  fn Process Logout
    public function logout()
    {
        $params = array('ses_id', 'ses_group', 'ses_name', 'ses_jbtn', 'ses_uname', 'ses_dept');
        $this->session->unset_userdata($params);
        echo "<script>
		window.location='" . site_url('auth/login') . "';
		</script>";
    }
}
