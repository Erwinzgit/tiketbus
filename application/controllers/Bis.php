<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bis extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->username)) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data_get = $this->bis_model->get_list();
		$data = array(
			'info' => $data_get,
			'activeMenu' => 'bis',
            'title' => 'Bis'
        );
		$this->slice->view('pages.bis.index', $data);
	}

	public function create()
	{
		$data_get = $this->bisjenis_model->get_list();
		$data = array(
			'info_bisjenis' => $data_get,
            'title' => 'Tambah Bis Baru'
        );
		$this->slice->view('pages.bis.form', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('PlatNomor', 'Plat Nomor (Bis)', 'required');
		$this->form_validation->set_rules('IdBisJenis', 'Bis Jenis', 'required');
		$this->form_validation->set_rules('NamaBis', 'Nama Bis', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('bis/create');
		} else {
			$this->bis_model->store();
			$this->session->set_flashdata('success', 'Bis baru telah ditambahkan');
			redirect('bis');
		}
	}
	
	public function edit($id) {
		$data_get = $this->bis_model->get_data($id);
		$data_get2 = $this->bisjenis_model->get_list();
		if (empty($data_get)) {
			redirect('bis');
		}
		$data = array(
			'info' => $data_get,
			'info_bisjenis' => $data_get2,
            'title' => 'Ubah Bis #'.$id
        );
		$this->slice->view('pages.bis.form', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('PlatNomor', 'Plat Nomor (Bis)', 'required');
		$this->form_validation->set_rules('IdBisJenis', 'Bis Jenis', 'required');
		$this->form_validation->set_rules('NamaBis', 'Nama Bis', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('bis/edit/'.$id);
		} else {
			$this->bis_model->update($id);
			$this->session->set_flashdata('success', 'Bis #'.$id.' telah diperbaharui');
			redirect('bis');
		}
	}

	public function destroy($id)
	{
		$this->bis_model->destroy($id);
		$this->session->set_flashdata('success', 'Bis #'.$id.' telah terhapus');
		redirect('bis');
	}
}
