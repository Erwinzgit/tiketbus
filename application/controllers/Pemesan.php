<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->username)) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data_get = $this->pemesan_model->get_list();
		$data = array(
			'info' => $data_get,
			'activeMenu' => 'pemesan',
            'title' => 'Pemesan'
        );
		$this->slice->view('pages.pemesan.index', $data);
	}

	public function create()
	{
		$data = array(
            'title' => 'Tambah Pemesan Baru'
        );
		$this->slice->view('pages.pemesan.form', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('NoIdentitas', 'Nomor Identitas (KTP)', 'required|max_length[16]');
		$this->form_validation->set_rules('NamaPemesan', 'Nama Pemesan', 'required');
		$this->form_validation->set_rules('Umur', 'Umur', 'required|numeric');
		$this->form_validation->set_rules('JenisKelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('NoTelepon', 'Nomor Telepon', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('pemesan/create');
		} else {
			$this->pemesan_model->store();
			$this->session->set_flashdata('success', 'Pemesan baru telah ditambahkan');
			redirect('pemesan');
		}
	}
	
	public function edit($id) {
		$data_get = $this->pemesan_model->get_data($id);
		if (empty($data_get)) {
			redirect('pemesan');
		}
		$data = array(
			'info' => $data_get,
            'title' => 'Ubah Pemesan #'.$id
        );
		$this->slice->view('pages.pemesan.form', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('NoIdentitas', 'Nomor Identitas (KTP)', 'required|max_length[16]');
		$this->form_validation->set_rules('Umur', 'Umur', 'required|numeric');
		$this->form_validation->set_rules('JenisKelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('NoTelepon', 'Nomor Telepon', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('pemesan/edit/'.$id);
		} else {
			$this->pemesan_model->update($id);
			$this->session->set_flashdata('success', 'Pemesan '.$id.' telah diperbaharui');
			redirect('pemesan');
		}
	}

	public function destroy($id)
	{
		$this->pemesan_model->destroy($id);
		$this->session->set_flashdata('success', 'Pemesan '.$id.' telah terhapus');
		redirect('pemesan');
	}
}
