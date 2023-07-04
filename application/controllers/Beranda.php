<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->username)) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data_get1 = $this->beranda_model->get_data_total_pemesanan();
		$data_get2 = $this->beranda_model->get_data_total_jadwal();
		$data_get3 = $this->beranda_model->get_data_total_bis();
		$data_get4 = $this->beranda_model->get_list_keberangkatan();
		$data = array(
			'info_total_pemesanan' => $data_get1,
			'info_total_jadwal' => $data_get2,
			'info_total_bis' => $data_get3,
			'info_keberangkatan' => $data_get4,
			'activeMenu' => 'beranda',
            'title' => 'Beranda'
        );
		$this->slice->view('pages.beranda', $data);
	}

	public function info_show($id)
	{
		$data_get1 = $this->beranda_model->get_data_keberangkatan($id);
		$data_get2 = $this->beranda_model->get_list_pesanan_kursi($id);
		$data = array(
			'info_detail' => $data_get1,
			'info_pesanan_kursi' => $data_get2,
            'title' => 'Tampil Informasi Pemesanan Keberangkatan #'.$id
        );
		$this->slice->view('pages.info_show', $data);
	}

	public function info_confirm($id)
	{
		$this->beranda_model->confirm_keberangkatan($id);
		$this->session->set_flashdata('success', 'Pemesanan #'.$id.' telah dikonfirmasi. Status kursi telah diperbaharui!');
		redirect('');
	}

}
