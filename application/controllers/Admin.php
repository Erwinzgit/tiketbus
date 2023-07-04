<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->username)) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data_get = $this->admin_model->get_list();
		$data = array(
			'info' => $data_get,
			'activeMenu' => 'admin',
            'title' => 'Admin'
        );
		$this->slice->view('pages.admin.index', $data);
	}

	public function create()
	{
		$data = array(
            'title' => 'Tambah Admin Baru'
        );
		$this->slice->view('pages.admin.form', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('Username', 'Username', 'required|min_length[6]|max_length[15]');
		$this->form_validation->set_rules('Password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('Confirm_Password', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('NamaLengkap', 'Nama Lengkap', 'required|max_length[50]');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('admin/create');
		} else {
			$this->admin_model->store();
			$this->session->set_flashdata('success', 'Admin baru telah ditambahkan');
			redirect('admin');
		}
	}
	
	public function edit($id) {
		$data_get = $this->admin_model->get_data($id);
		if (empty($data_get)) {
			redirect('admin');
		}
		$data = array(
			'info' => $data_get,
            'title' => 'Ubah Admin #'.$id
        );
		$this->slice->view('pages.admin.form', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('Password', 'Password', 'min_length[6]');
		$this->form_validation->set_rules('Confirm_Password', 'Confirm Password', 'matches[password]');
		$this->form_validation->set_rules('NamaLengkap', 'Nama Lengkap', 'required|max_length[50]');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('admin/edit/'.$id);
		} else {
			$this->admin_model->update($id);
			$this->session->set_flashdata('success', 'Admin '.$id.' telah diperbaharui');
			redirect('admin');
		}
	}

	public function destroy($id)
	{
		$this->admin_model->destroy($id);
		$this->session->set_flashdata('success', 'Admin '.$id.' telah terhapus');
		redirect('admin');
	}
}
