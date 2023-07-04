<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

	public function __construct()
	
	{
		parent::__construct();
		if (empty($this->session->username)) {
			redirect('auth/login');
		}
		$this->load->library('slice');
	$this->load->model('pemesanan_model');
	$this->load->library('form_validation');
	$this->load->model('pemesanan_kursi_model');
	$this->load->model('pembayaran_model');
	}

	public function index()
	{
		$data_get = $this->pemesanan_model->get_list();
		$data = array(
			'info' => $data_get,
			'activeMenu' => 'pemesanan',
            'title' => 'Pemesanan'
        );
		$this->slice->view('pages.pemesanan.index', $data);
	}

	public function create()
	{
		$data = array(
            'title' => 'Tambah Pemesanan Baru'
        );
		$this->slice->view('pages.pemesanan.form', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('NoIdentitas', 'Nomor Identitas', 'required');
		$this->form_validation->set_rules('IdJadwal', 'Jadwal', 'required');
		$this->form_validation->set_rules('IdAdmin', 'Admin (Karyawan)', 'required');
		$this->form_validation->set_rules('JumlahPenumpang', 'Jumlah Penumpang', 'required');
		$this->form_validation->set_rules('TanggalPesan', 'Tanggal Pesan', 'required');
		$this->form_validation->set_rules('TanggalBerangkat', 'Tanggal Berangkat', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('pemesanan/create');
		} else {
			$this->pemesanan_model->store();
			$this->session->set_flashdata('success', 'Pemesanan baru telah ditambahkan');
			redirect('pemesanan');
		}
	}
	
	public function show($id) {
		$data_get = $this->pemesanan_model->get_data($id);
		$data_get2 = $this->pemesanan_kursi_model->get_list($data_get->IdPemesanan);
		$data_get3 = $this->pembayaran_model->get_list();
		if (empty($data_get)) {
			redirect('pemesanan');
		}
		$data = array(
			'info' => $data_get,
			'info2' => $data_get2,
			'info3' => $data_get3,
            'title' => 'Tampil Pemesanan #'.$id
        );
		$this->slice->view('pages.pemesanan.show', $data);
	}

	public function edit($id) {
		$data_get = $this->pemesanan_model->get_data($id);
		if (empty($data_get)) {
			redirect('pemesanan');
		}
		$data = array(
			'info' => $data_get,
            'title' => 'Ubah Pemesanan #'.$id
        );
		$this->slice->view('pages.pemesanan.form', $data);
	}

	public function update($id)
	{
		$this->form_validation->set_rules('NoIdentitas', 'Nomor Identitas', 'required');
		$this->form_validation->set_rules('IdJadwal', 'Jadwal', 'required');
		$this->form_validation->set_rules('IdAdmin', 'Admin (Karyawan)', 'required');
		$this->form_validation->set_rules('JumlahPenumpang', 'Jumlah Penumpang', 'required');
		$this->form_validation->set_rules('TanggalPesan', 'Tanggal Pesan', 'required');
		$this->form_validation->set_rules('TanggalBerangkat', 'Tanggal Berangkat', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('pemesanan/edit/'.$id);
		} else {
			$this->pemesanan_model->update($id);
			$this->session->set_flashdata('success', 'Pemesanan #'.$id.' telah diperbaharui');
			redirect('pemesanan');
		}
	}

	public function destroy($id)
	{
		$this->pemesanan_model->destroy($id);
		$this->session->set_flashdata('success', 'Pemesanan #'.$id.' telah terhapus');
		redirect('pemesanan');
	}

	// --------------------------------------------
	// PEMESANAN KURSI
	// --------------------------------------------

	public function create_kursi($id_pemesanan)
	{
		$data = array(
			'id_pemesanan' => $id_pemesanan,
            'title' => 'Tambah Pemesanan Kursi Baru'
        );
		$this->slice->view('pages.pemesanan.form_kursi', $data);
	}

	public function store_kursi()
	{
		$this->form_validation->set_rules('IdPemesanan', 'Pemesanan', 'required');
		$this->form_validation->set_rules('IdKursi', 'Nomor Kursi', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('pemesanan/kursi/create');
		} else {
			$this->pemesanan_kursi_model->store();
			$this->session->set_flashdata('success', 'Pemesanan Kursi baru telah ditambahkan');
			redirect('pemesanan/show/'.$this->input->post('IdPemesanan'));
		}
	}

	public function edit_kursi($id) {
		$data_get = $this->pemesanan_kursi_model->get_data($id);
		if (empty($data_get)) {
			redirect('pemesanan/kursi');
		}
		$data = array(
			'info' => $data_get,
            'title' => 'Ubah Pemesanan Kursi #'.$id
        );
		$this->slice->view('pages.pemesanan.form_kursi', $data);
	}

	public function update_kursi($id)
	{
		$this->form_validation->set_rules('IdPemesanan', 'Pemesanan', 'required');
		$this->form_validation->set_rules('IdKursi', 'Nomor Kursi', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('pemesanan/kursi/edit/'.$id);
		} else {
			$this->pemesanan_kursi_model->update($id);
			$this->session->set_flashdata('success', 'Pemesanan Kursi #'.$id.' telah diperbaharui');
			redirect('pemesanan/show'.$this->input->post('IdPemesanan'));
		}
	}

	public function destroy_kursi($id)
	{
		$this->pemesanan_kursi_model->destroy($id);
		$this->session->set_flashdata('success', 'Pemesanan Kursi #'.$id.' telah terhapus');
		redirect('pemesanan/show'.$this->input->post('IdPemesanan'));
	}

	// --------------------------------------------
	// PEMBAYARAN
	// --------------------------------------------

	public function create_pembayaran()
	{
		$data = array(
            'title' => 'Tambah Pembayaran Baru'
        );
		$this->slice->view('pages.pembayaran.form', $data);
	}

	public function store_pembayaran()
	{
		$this->form_validation->set_rules('IdPemesanan', 'ID Pemesanan', 'required');
		$this->form_validation->set_rules('TotalBayar', 'Total Bayar', 'required');
		$this->form_validation->set_rules('Status', 'Status', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('pembayaran/create');
		} else {
			$this->pembayaran_model->store();
			$this->session->set_flashdata('success', 'Pembayaran baru telah ditambahkan');
			redirect('pembayaran');
		}
	}
	
}
