<?php

class Kursi_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_list($search = FALSE)
	{
		if ($search === FALSE) {
			$query = $this->db->get('kursi');
			return $query->result();
		}
	}

	public function get_data($info)
	{
		$query = $this->db->get_where('kursi', array('IdKursi' => $info));
		return $query->row();
	}

	public function store()
	{
		$data = array(
			'PlatNomor' => $this->input->post('PlatNomor'),
			'NoKursi' => $this->input->post('NoKursi'),
			'StatusKursi' => $this->input->post('StatusKursi')
		);
		return $this->db->insert('kursi', $data);
	}

	public function update($id)
	{
		$data = array(
			'PlatNomor' => $this->input->post('PlatNomor'),
			'NoKursi' => $this->input->post('NoKursi'),
			'StatusKursi' => $this->input->post('StatusKursi')
		);
		$this->db->where('IdKursi', $id);
		return $this->db->update('kursi', $data);
	}

	public function destroy($id)
	{
		$this->db->where('IdKursi', $id);
		$this->db->delete('kursi');
		return true;
	}

	public function store_generate($no)
	{
		$data = array(
			'PlatNomor' => $this->input->post('PlatNomor'),
			'NoKursi' => $no,
			'StatusKursi' => 'Bisa Dipakai'
		);
		return $this->db->insert('kursi', $data);
	}

}
