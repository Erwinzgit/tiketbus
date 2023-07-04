<?php

class Alur_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	// ---------------------------------------------
	// PEMESANAN
	// ---------------------------------------------

	public function get_list_jadwal($search = FALSE)
	{
		if ($search === FALSE) {
			$query = $this->db->get('jadwal');
			return $query->result();
		}
	}

	public function get_data_admin($info)
	{
		$query = $this->db->get_where('admin', array('IdAdmin' => $info));
		return $query->row();
	}
	
	// ---------------------------------------------
	// PEMESANAN KURSI
	// ---------------------------------------------

	public function get_list_available_kursi($id, $search = FALSE)
	{
		if ($search === FALSE) {
			$this->db->select('kursi.IdKursi, kursi.NoKursi');
			$this->db->join('bis','kursi.PlatNomor = bis.PlatNomor');
			$this->db->join('jadwal','bis.PlatNomor = jadwal.PlatNomor');
			$this->db->join('pemesanan','jadwal.IdJadwal = pemesanan.IdJadwal');
			$this->db->where('kursi.StatusKursi =', 'Kosong');
			$this->db->where('pemesanan.IdPemesanan =', $id);
			$query = $this->db->get('kursi');
			return $query->result();
		}
	}

	public function get_list_bis_pesanan_kursi($id_pemesanan, $search = FALSE)
	{
		if ($search === FALSE) {
			$SQL = "
					SELECT pemesanan_kursi.IdKursi, kursi.NoKursi
					FROM pemesanan_kursi
						JOIN kursi USING(IdKursi)
					WHERE pemesanan_kursi.IdPemesanan = $id_pemesanan
			";
			$query = $this->db->query($SQL);
			return $query->result();
		}
	}

	public function get_data_pemesanan($id)
	{
		$query = $this->db->get_where('pemesanan', array('IdPemesanan' => $id));
		return $query->row();
	}

	// ---------------------------------------------
	// PEMBAYARAN
	// ---------------------------------------------

	public function get_data_total_pembayaran($id)
	{
		$this->db->select("sum(bisjenis.Harga)+sum(jadwal.BiayaPerjalanan) AS TotalBayar");
		$this->db->join("pemesanan_kursi", "pemesanan.IdPemesanan = pemesanan_kursi.IdPemesanan");
		$this->db->join("jadwal", "pemesanan.IdJadwal = jadwal.IdJadwal");
		$this->db->join("bis", "jadwal.PlatNomor = bis.PlatNomor");
		$this->db->join("bisjenis", "bis.IdBisJenis = bisjenis.IdBisJenis");
		$query = $this->db->get_where('pemesanan', array('pemesanan.IdPemesanan' => $id));
		return $query->row();
	}

	public function store_pemesan()
	{
		$data = array(
			'NoIdentitas' => $this->input->post('NoIdentitas'),
			'NamaPemesan' => $this->input->post('NamaPemesan'),
			'Umur' => $this->input->post('Umur'),
			'JenisKelamin' => $this->input->post('JenisKelamin'),
			'NoTelepon' => $this->input->post('NoTelepon')
		);
		return $this->db->insert('pemesan', $data);
	}

	public function store_pemesanan()
	{
		$data = array(
			'NoIdentitas' => $this->input->post('NoIdentitas'),
			'IdJadwal' => $this->input->post('IdJadwal'),
			'IdAdmin' => $this->input->post('IdAdmin'),
			'JumlahPenumpang' => $this->input->post('JumlahPenumpang'),
			'TanggalPesan' => $this->input->post('TanggalPesan'),
			'TanggalBerangkat' => $this->input->post('TanggalBerangkat'),
			'StatusPemesanan' => $this->input->post('StatusPemesanan')
		);
		$this->db->insert('pemesanan', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function store_pemesanan_kursi()
	{
		$data1 = array(
			'IdPemesanan' => $this->input->post('IdPemesanan'),
			'IdKursi' => $this->input->post('IdKursi')
		);
		$this->db->insert('pemesanan_kursi', $data1);
		$data2 = array(
			'StatusKursi' => 'Terisi'
		);
		$this->db->where('IdKursi', $this->input->post('IdKursi'));
		return $this->db->update('kursi', $data2);
	}

	public function store_pembayaran()
	{
		$data = array(
			'IdPemesanan' => $this->input->post('IdPemesanan'),
			'TotalBayar' => $this->input->post('TotalBayar'),
			'Bayar' => $this->input->post('Bayar'),
			'Kembalian' => $this->input->post('Kembalian'),
			'Status' => $this->input->post('Status')
		);
		return $this->db->insert('pembayaran', $data);
	}
}
