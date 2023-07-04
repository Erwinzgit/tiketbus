<?php

class Beranda_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_data_total_pemesanan()
	{
		$query = $this->db->count_all_results('pemesanan');
		return $query;
	}

	public function get_data_total_jadwal()
	{
		$query = $this->db->count_all_results('jadwal');
		return $query;
	}

	public function get_data_total_bis()
	{
		$query = $this->db->count_all_results('bis');
		return $query;
	}

	public function get_list_keberangkatan()
	{
		$this->db->select("jadwal.IdJadwal, pemesanan.IdPemesanan, jadwal.Waktu, rute.Asal, rute.Tujuan, jadwal.PlatNomor");
		$this->db->from("jadwal");
		$this->db->join("pemesanan", "pemesanan.IdJadwal = jadwal.IdJadwal");
		$this->db->join("rute", "jadwal.IdRute = rute.IdRute");
		$this->db->where("pemesanan.TanggalBerangkat =", date('Y-m-d'));
		$this->db->where("pemesanan.StatusPemesanan =", "Dipesan");
		$this->db->group_by("jadwal.IdJadwal");
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_keberangkatan($id_jadwal)
	{
		$this->db->select("jadwal.IdJadwal, pemesanan.IdPemesanan, jadwal.Waktu, rute.Asal, rute.Tujuan, jadwal.PlatNomor");
		$this->db->from("jadwal");
		$this->db->join("pemesanan", "pemesanan.IdJadwal = jadwal.IdJadwal");
		$this->db->join("rute", "jadwal.IdRute = rute.IdRute");
		$this->db->where("pemesanan.TanggalBerangkat =", date('Y-m-d'));
		$this->db->distinct("jadwal.IdJadwal");
		$this->db->where("jadwal.IdJadwal =", $id_jadwal);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_list_pesanan_kursi($id_jadwal)
	{
		$this->db->select("pemesan.NoIdentitas, pemesan.NamaPemesan, kursi.NoKursi");
		$this->db->from("pemesanan_kursi");
		$this->db->join("pemesanan", "pemesanan_kursi.IdPemesanan = pemesanan.IdPemesanan");
		$this->db->join("pemesan", "pemesanan.NoIdentitas = pemesan.NoIdentitas");
		$this->db->join("kursi", "pemesanan_kursi.IdKursi = kursi.IdKursi");
		$this->db->where("pemesanan.TanggalBerangkat =", date('Y-m-d'));
		$this->db->where("pemesanan.IdJadwal =", $id_jadwal);
		$query = $this->db->get();
		return $query->result();
	}

	public function confirm_keberangkatan($id_jadwal)
	{
		// Update semua pemesanan yang berkaitan dengan isi id jadwal
		$data1 = array(
			'StatusPemesanan' => 'Sudah Dilayani'
		);
		$query1 = $this->db->where('IdJadwal =', $id_jadwal);
		$query1->update('pemesanan', $data1);

		// Ambil semua pemesanan dengan 1 atau beberapa pemesanan kursi
		$result1 = $query1->get('pemesanan')->result();

		// Perulangan data pemesanan kursi
		foreach($result1 as $data_result1) {
			// cari data pemesanan kursi (bisa 1 atau lebih)
			$query2 = $this->db->get_where('pemesanan_kursi', array('IdPemesanan' => $data_result1->IdPemesanan));
			$data2 = $query2->result();
			$data3 = array(
				'StatusKursi' => 'Kosong'
			);
			// Perulangan data kursi
			foreach($data2 as $data_result2) {
				$query3 = $this->db->where('IdKursi', $data_result2->IdKursi);
				$query3->update('kursi', $data3);
			}
		}
		return true;
	}

}
