<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		if (!empty($this->session->username)) {
			redirect('');
		}
		$data = array(
            'title' => 'Masuk'
        );
		$this->slice->view('pages.auth.login', $data);
	}

	public function do_login()
	{
		$this->form_validation->set_rules('Username', 'Username', 'required');
		$this->form_validation->set_rules('Password', 'Password', 'required');

		$login = $this->admin_model->do_login();
		if ($login > 0) {
			$data_session = array(
				'idadmin' => $login->IdAdmin,
				'username' => $login->Username
			);
			$this->session->set_userdata($data_session);
			redirect('beranda');
		} else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('auth/login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}
}
