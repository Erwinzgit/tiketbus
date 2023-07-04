<?php

class Pemesanan_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_list($search = FALSE)
	{
		if ($search === FALSE) {
			$query = $this->db->get('pemesanan');
			return $query->result();
		}
	}

	public function get_data($info)
	{
		$query = $this->db->get_where('pemesanan', array('IdPemesanan' => $info));
		return $query->row();
	}

	public function store()
	{
		$data = array(
			'NoIdentitas' => $this->input->post('NoIdentitas'),
			'IdJadwal' => $this->input->post('IdJadwal'),
			'IdAdmin' => $this->input->post('JenisKelamin'),
			'JumlahPenumpang' => $this->input->post('JumlahPenumpang'),
			'TanggalPesan' => $this->input->post('TanggalPesan'),
			'TanggalBerangkat' => $this->input->post('TanggalBerangkat')
		);
		return $this->db->insert('pemesanan', $data);
	}

	public function update($id)
	{
		$data = array(
			'NoIdentitas' => $this->input->post('NoIdentitas'),
			'IdJadwal' => $this->input->post('IdJadwal'),
			'IdAdmin' => $this->input->post('JenisKelamin'),
			'JumlahPenumpang' => $this->input->post('JumlahPenumpang'),
			'TanggalPesan' => $this->input->post('TanggalPesan'),
			'TanggalBerangkat' => $this->input->post('TanggalBerangkat')
		);
		$this->db->where('IdPemesanan', $id);
		return $this->db->update('pemesanan', $data);
	}

	public function destroy($id)
	{
		$this->db->where('IdPemesanan', $id);
		$this->db->delete('pemesanan');
		return true;
	}

	// --------------------------------------------
	// PEMESANAN KURSI
	// --------------------------------------------

	public function get_list_kursi($search = FALSE)
	{
		if ($search === FALSE) {
			$query = $this->db->get('pemesanan_kursi');
			return $query->result();
		}
	}

	public function get_data_kursi($info)
	{
		$query = $this->db->get_where('pemesanan_kursi', array('IdPemesananKursi' => $info));
		return $query->row();
	}

	public function store_kursi()
	{
		$data = array(
			'IdPemesanan' => $this->input->post('IdPemesanan'),
			'IdKursi' => $this->input->post('IdKursi')
		);
		return $this->db->insert('pemesanan_kursi', $data);
	}

	public function update_kursi($id)
	{
		$data = array(
			'IdPemesanan' => $this->input->post('IdPemesanan'),
			'IdKursi' => $this->input->post('IdKursi')
		);
		$this->db->where('IdPemesananKursi', $id);
		return $this->db->update('pemesanan_kursi', $data);
	}

	public function destroy_kursi($id)
	{
		$this->db->where('IdPemesananKursi', $id);
		$this->db->delete('pemesanan_kursi');
		return true;
	}

	// --------------------------------------------
	// PEMBAYARAN
	// --------------------------------------------

	public function get_data_pembayaran($info)
	{
		$query = $this->db->get_where('pembayaran', array('IdPemesanan' => $info));
		return $query->row();
	}

	public function store_pembayaran()
	{
		$data = array(
			'IdPemesanan' => $this->input->post('IdPemesanan'),
			'TotalBayar' => $this->input->post('TotalBayar'),
			'Status' => $this->input->post('Status')
		);
		return $this->db->insert('pembayaran', $data);
	}

}
