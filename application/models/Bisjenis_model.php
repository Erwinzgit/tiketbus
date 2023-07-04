<?php

class Bisjenis_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_list($search = FALSE)
	{
		if ($search === FALSE) {
			$query = $this->db->get('bisjenis');
			return $query->result();
		}
	}

	public function get_data($info)
	{
		$query = $this->db->get_where('bisjenis', array('IdBisJenis' => $info));
		return $query->row();
	}

	public function store()
	{
		$data = array(
			'NamaJenis' => $this->input->post('NamaJenis'),
			'Kapasitas' => $this->input->post('Kapasitas'),
			'Harga' => $this->input->post('Harga')
		);
		return $this->db->insert('bisjenis', $data);
	}

	public function update($id)
	{
		$data = array(
			'NamaJenis' => $this->input->post('NamaJenis'),
			'Kapasitas' => $this->input->post('Kapasitas'),
			'Harga' => $this->input->post('Harga')
		);
		$this->db->where('IdBisJenis', $id);
		return $this->db->update('bisjenis', $data);
	}

	public function destroy($id)
	{
		$this->db->where('IdBisJenis', $id);
		$this->db->delete('bisjenis');
		return true;
	}

}
