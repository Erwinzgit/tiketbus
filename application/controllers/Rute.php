<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rute extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->username)) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data_get = $this->rute_model->get_list();
		$data = array(
			'info' => $data_get,
			'activeMenu' => 'rute',
            'title' => 'Rute'
        );
		$this->slice->view('pages.rute.index', $data);
	}

	public function create()
	{
		$data = array(
            'title' => 'Tambah Rute Baru'
        );
		$this->slice->view('pages.rute.form', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('Asal', 'Username', 'required');
		$this->form_validation->set_rules('Tujuan', 'Password', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('rute/create');
		} else {
			$this->rute_model->store();
			$this->session->set_flashdata('success', 'Rute baru telah ditambahkan');
			redirect('rute');
		}
	}
	
	public function edit($id) {
		$data_get = $this->rute_model->get_data($id);
		if (empty($data_get)) {
			redirect('rute');
		}
		$data = array(
			'info' => $data_get,
            'title' => 'Ubah Rute #'.$id
        );
		$this->slice->view('pages.rute.form', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('Asal', 'Username', 'required');
		$this->form_validation->set_rules('Tujuan', 'Password', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('rute/edit/'.$id);
		} else {
			$this->rute_model->update($id);
			$this->session->set_flashdata('success', 'Rute #'.$id.' telah diperbaharui');
			redirect('rute');
		}
	}

	public function destroy($id)
	{
		$this->rute_model->destroy($id);
		$this->session->set_flashdata('success', 'Rute #'.$id.' telah terhapus');
		redirect('rute');
	}
}
