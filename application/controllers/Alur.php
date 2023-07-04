<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alur extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->username)) {
			redirect('auth/login');
		}
	}

	public function pemesan()
	{
		$data = array(
            'title' => 'Alur (Pemesan)'
        );
		$this->slice->view('pages.alur.pemesanan.form_pemesan', $data);
	}

	public function store_pemesan()
	{
		$this->form_validation->set_rules('NoIdentitas', 'Nomor Identitas (KTP)', 'required|max_length[16]');
		$this->form_validation->set_rules('NamaPemesan', 'Nama Pemesan', 'required');
		$this->form_validation->set_rules('Umur', 'Umur', 'required|numeric');
		$this->form_validation->set_rules('JenisKelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('NoTelepon', 'Nomor Telepon', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('alur/pemesanan/pemesan');
		} else {
			$this->alur_model->store_pemesan();
			$alurdata = array(
				'info_alur_pemesan'  => $this->input->post('NoIdentitas')
			);
			$this->session->set_userdata($alurdata);
			$this->session->set_flashdata('success', 'Pemesan berhasil didaftarkan, Silahkan Isi bagian selanjutnya, Pemesanan');
			redirect('alur/pemesanan/pemesanan');
		}
	}

	public function pemesanan()
	{
		if (empty($this->session->info_alur_pemesan)) {
			$this->session->set_flashdata('error', 'Anda harus mengisi formulir secara bertahap');
			redirect('alur/pemesanan/pemesan');
		}
		$data_get1 = $this->alur_model->get_list_jadwal();
		$data_get2 = $this->alur_model->get_data_admin($this->session->idadmin);
		$data = array(
			'info_jadwal' => $data_get1,
			'info_admin' => $data_get2,
            'title' => 'Alur (Pemesanan)'
        );
		$this->slice->view('pages.alur.pemesanan.form_pemesanan', $data);
	}

	public function store_pemesanan()
	{
		$this->form_validation->set_rules('NoIdentitas', 'Nomor Identitas', 'required');
		$this->form_validation->set_rules('IdJadwal', 'Jadwal', 'required');
		$this->form_validation->set_rules('IdAdmin', 'Admin (Karyawan)', 'required');
		$this->form_validation->set_rules('JumlahPenumpang', 'Jumlah Penumpang', 'required');
		$this->form_validation->set_rules('TanggalPesan', 'Tanggal Pesan', 'required');
		$this->form_validation->set_rules('TanggalBerangkat', 'Tanggal Berangkat', 'required');
		$this->form_validation->set_rules('StatusPemesanan', 'Status Pemesanan', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('alur/pemesanan/pemesanan');
		} else {
			$data_alur_idpemesanan = $this->alur_model->store_pemesanan();
			$alurdata = array(
				'info_alur_pemesanan'  => $data_alur_idpemesanan
			);
			$this->session->set_userdata($alurdata);
			$this->session->set_flashdata('success', 'Pemesanan berhasil didaftarkan, Silahkan isi bagian selanjutnya, Pemesanan Kursi');
			redirect('alur/pemesanan/pemesanan_kursi');
		}
	}

	public function pemesanan_kursi()
	{
		if (empty($this->session->info_alur_pemesanan)) {
			$this->session->set_flashdata('error', 'Anda harus mengisi formulir secara bertahap');
			redirect('alur/pemesanan/pemesanan');
		}
		$data_get1 = $this->alur_model->get_list_bis_pesanan_kursi($this->session->info_alur_pemesanan);
		$data_get2 = $this->alur_model->get_data_pemesanan($this->session->info_alur_pemesanan);
		$data_get3 = $this->alur_model->get_list_available_kursi($this->session->info_alur_pemesanan);

		$data = array(
			'info_pesanan_kursi' => $data_get1,
			'info_pemesanan' => $data_get2,
			'info_kursi_tersedia' => $data_get3,
            'title' => 'Alur (Pemesanan Kursi)'
        );
		$this->slice->view('pages.alur.pemesanan.form_pemesanan_kursi', $data);
	}

	public function store_pemesanan_kursi()
	{
		$this->form_validation->set_rules('IdPemesanan', 'Pemesanan', 'required');
		$this->form_validation->set_rules('IdKursi', 'Nomor Kursi', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('alur/pemesanan/pemesanan_kursi');
		} else {
			if ($this->input->post('submitForm') == 'loop') {
				$this->alur_model->store_pemesanan_kursi();
				$this->session->set_flashdata('success', 'Pemesanan Kursi berhasil didaftarkan, Silahkan mendaftarkan Pemesanan Kursi lagi');
				redirect('alur/pemesanan/pemesanan_kursi');
			} else {
				$this->alur_model->store_pemesanan_kursi();
				$this->session->set_flashdata('success', 'Pemesanan Kursi berhasil didaftarkan, Silahkan Isi bagian terakhir, Pembayaran');
				redirect('alur/pemesanan/pembayaran');
			}
		}
	}

	public function pembayaran()
	{
		if (empty($this->session->info_alur_pemesanan)) {
			$this->session->set_flashdata('error', 'Anda harus mengisi formulir secara bertahap');
			redirect('alur/pemesanan/pemesanan_kursi');
		}
		$data_get1 = $this->alur_model->get_data_total_pembayaran($this->session->info_alur_pemesanan);
		$data_get2 = $this->alur_model->get_data_pemesanan($this->session->info_alur_pemesanan);
		$data_get3 = $this->alur_model->get_list_bis_pesanan_kursi($this->session->info_alur_pemesanan);
		$data = array(
			'info_total_bayar' => $data_get1,
			'info_pemesanan' => $data_get2,
			'info_pesanan_kursi' => $data_get3,
            'title' => 'Alur (Pembayaran)'
        );
		$this->slice->view('pages.alur.pemesanan.form_pembayaran', $data);
	}

	public function store_pembayaran()
	{
		$this->form_validation->set_rules('IdPemesanan', 'ID Pemesanan', 'required');
		$this->form_validation->set_rules('TotalBayar', 'Total Bayar', 'required|numeric|max_length[7]');
		$this->form_validation->set_rules('Bayar', 'Bayar', 'required|numeric|max_length[7]');
		$this->form_validation->set_rules('Kembalian', 'Kembalian', 'required|numeric|max_length[7]');
		$this->form_validation->set_rules('Status', 'Status Pembayaran', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('alur/pemesanan/pembayaran');
		} else {
			$this->alur_model->store_pembayaran();
			$alurdata = array('info_alur_pemesanan');
			$this->session->unset_userdata($alurdata);
			$this->session->set_flashdata('success', 'Alur Pemesanan berhasil diproses! Anda dikembalikan ke halaman beranda');
			redirect('');
		}
	}

}
