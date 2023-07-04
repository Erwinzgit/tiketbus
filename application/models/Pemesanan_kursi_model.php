<?php

class Pemesanan_kursi_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_list($search = FALSE)
	{
		if ($search === FALSE) {
			$query = $this->db->get('pemesanan_kursi');
			return $query->result();
		}
	}

	public function get_data($info)
	{
		$query = $this->db->get_where('pemesanan', array('IdPemesanan' => $info));
		return $query->row();
	}
}