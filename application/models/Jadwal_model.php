<?php

class Jadwal_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_list($search = FALSE)
	{
		if ($search === FALSE) {
			$query = $this->db->get('jadwal');
			return $query->result();
		}
	}

	public function get_data($info)
	{
		$query = $this->db->get_where('jadwal', array('IdJadwal' => $info));
		return $query->row();
	}

	public function store()
	{
		$data = array(
			'IdRute' => $this->input->post('IdRute'),
			'PlatNomor' => $this->input->post('PlatNomor'),
			'Waktu' => $this->input->post('Waktu'),
			'BiayaPerjalanan' => $this->input->post('BiayaPerjalanan')
		);
		return $this->db->insert('jadwal', $data);
	}

	public function update($id)
	{
		$data = array(
			'IdRute' => $this->input->post('IdRute'),
			'PlatNomor' => $this->input->post('PlatNomor'),
			'Waktu' => $this->input->post('Waktu'),
			'BiayaPerjalanan' => $this->input->post('BiayaPerjalanan')
		);
		$this->db->where('IdJadwal', $id);
		return $this->db->update('jadwal', $data);
	}

	public function destroy($id)
	{
		$this->db->where('IdJadwal', $id);
		$this->db->delete('jadwal');
		return true;
	}

}
