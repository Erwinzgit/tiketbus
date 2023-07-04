<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kursi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->username)) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data_get1 = $this->kursi_model->get_list();
		$data_get2 = $this->bis_model->get_list();
		$data = array(
			'info' => $data_get1,
			'info_bis' => $data_get2,
			'activeMenu' => 'kursi',
            'title' => 'Kursi'
        );
		$this->slice->view('pages.kursi.index', $data);
	}

	public function create()
	{
		$data_get = $this->bis_model->get_list();
		$data = array(
			'info_bis' => $data_get,
            'title' => 'Tambah Kursi Baru'
        );
		$this->slice->view('pages.kursi.form', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('PlatNomor', 'Plat Nomor (Bis)', 'required');
		$this->form_validation->set_rules('NoKursi', 'Nomor Kursi', 'required');
		$this->form_validation->set_rules('StatusKursi', 'Status Kursi', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('kursi/create');
		} else {
			$this->kursi_model->store();
			$this->session->set_flashdata('success', 'Kursi baru telah ditambahkan');
			redirect('kursi');
		}
	}
	
	public function edit($id) {
		$data_get = $this->kursi_model->get_data($id);
		if (empty($data_get)) {
			redirect('kursi');
		}
		$data = array(
			'info' => $data_get,
            'title' => 'Ubah Kursi #'.$id
        );
		$this->slice->view('pages.kursi.form', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('PlatNomor', 'Plat Nomor (Bis)', 'required');
		$this->form_validation->set_rules('NoKursi', 'Nomor Kursi', 'required');
		$this->form_validation->set_rules('StatusKursi', 'Status Kursi', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('kursi/edit/'.$id);
		} else {
			$this->kursi_model->update($id);
			$this->session->set_flashdata('success', 'Kursi #'.$id.' telah diperbaharui');
			redirect('kursi');
		}
	}

	public function destroy($id)
	{
		$this->kursi_model->destroy($id);
		$this->session->set_flashdata('success', 'Kursi #'.$id.' telah terhapus');
		redirect('kursi');
	}

	public function generate()
    {
		$this->form_validation->set_rules('Total', 'Jumlah Kursi', 'required');
		$this->form_validation->set_rules('PlatNomor', 'Plat Nomor (Bis)', 'required');

        for ($j = 1; $j <= $this->input->post('total'); $j++) {
            $this->kursi_model->store_generate($j);
		}
		$this->session->set_flashdata('success', 'Kursi dengan jumlah ('.$this->input->post('total').') untuk Bis ('.$this->input->post('PlatNomor').') berhasil dibuat');
        redirect('kursi');
    }

}
