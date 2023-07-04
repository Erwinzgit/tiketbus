<?php

class Pemesan_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_list($search = FALSE)
	{
		if ($search === FALSE) {
			$query = $this->db->get('pemesan');
			return $query->result();
		}
	}

	public function get_data($info)
	{
		$query = $this->db->get_where('pemesan', array('NoIdentitas' => $info));
		return $query->row();
	}

	public function store()
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

	public function update($id)
	{
		$data = array(
			'NoIdentitas' => $this->input->post('Noidentitas'),
			'NamaPemesan' => $this->input->post('NamaPemesan'),
			'Umur' => $this->input->post('Umur'),
			'JenisKelamin' => $this->input->post('JenisKelamin'),
			'NoTelepon' => $this->input->post('NoTelepon')
		);
		$this->db->where('NoIdentitas', $id);
		return $this->db->update('pemesan', $data);
	}

	public function destroy($id)
	{
		$this->db->where('NoIdentitas', $id);
		$this->db->delete('pemesan');
		return true;
	}

}
