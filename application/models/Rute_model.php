<?php

class Rute_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_list($search = FALSE)
	{
		if ($search === FALSE) {
			$query = $this->db->get('rute');
			return $query->result();
		}
	}

	public function get_data($info)
	{
		$query = $this->db->get_where('rute', array('IdRute' => $info));
		return $query->row();
	}

	public function store()
	{
		$data = array(
			'Asal' => $this->input->post('Asal'),
			'Tujuan' => $this->input->post('Tujuan')
		);
		return $this->db->insert('rute', $data);
	}

	public function update($id)
	{
		$data = array(
			'Asal' => $this->input->post('Asal'),
			'Tujuan' => $this->input->post('Tujuan')
		);
		$this->db->where('IdRute', $id);
		return $this->db->update('rute', $data);
	}

	public function destroy($id)
	{
		$this->db->where('IdRute', $id);
		$this->db->delete('rute');
		return true;
	}

}
