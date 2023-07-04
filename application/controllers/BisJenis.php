<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BisJenis extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->username)) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data_get = $this->bisjenis_model->get_list();
		$data = array(
			'info' => $data_get,
			'activeMenu' => 'bisjenis',
            'title' => 'Jenis Bis'
        );
		$this->slice->view('pages.bisjenis.index', $data);
	}

	public function create()
	{
		$data = array(
            'title' => 'Tambah Jenis Bis Baru'
        );
		$this->slice->view('pages.bisjenis.form', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('NamaJenis', 'Nama Jenis Bis', 'required');
		$this->form_validation->set_rules('Kapasitas', 'Kapasitas', 'required');
		$this->form_validation->set_rules('Harga', 'Harga', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('bisjenis/create');
		} else {
			$this->bisjenis_model->store();
			$this->session->set_flashdata('success', 'Jenis Bis baru telah ditambahkan');
			redirect('bisjenis');
		}
	}
	
	public function edit($id) {
		$data_get = $this->bisjenis_model->get_data($id);
		if (empty($data_get)) {
			redirect('bisjenis');
		}
		$data = array(
			'info' => $data_get,
            'title' => 'Ubah Jenis Bis #'.$id
        );
		$this->slice->view('pages.bisjenis.form', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('NamaJenis', 'Nama Jenis Bis', 'required');
		$this->form_validation->set_rules('Kapasitas', 'Kapasitas', 'required');
		$this->form_validation->set_rules('Harga', 'Harga', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('bisjenis/edit/'.$id);
		} else {
			$this->bisjenis_model->update($id);
			$this->session->set_flashdata('success', 'Jenis Bis #'.$id.' telah diperbaharui');
			redirect('bisjenis');
		}
	}

	public function destroy($id)
	{
		$this->bisjenis_model->destroy($id);
		$this->session->set_flashdata('success', 'Jenis Bis #'.$id.' telah terhapus');
		redirect('bisjenis');
	}
}
