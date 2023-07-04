<?php

class Admin_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_list($search = FALSE)
	{
		if ($search === FALSE) {
			$query = $this->db->get('admin');
			return $query->result();
		}
	}

	public function do_login()
	{
		$this->db->where('Username', $this->input->post('Username'));
		$this->db->where('Password', md5($this->input->post('Password')));
		$query = $this->db->get('admin');
		return $query->row();
	}

	public function get_data($info)
	{
		$query = $this->db->get_where('admin', array('Username' => $info));
		return $query->row();
	}

	public function store()
	{
		$data = array(
			'Username' => $this->input->post('Username'),
			'Password' => md5($this->input->post('Password')),
			'NamaLengkap' => $this->input->post('NamaLengkap')
		);
		return $this->db->insert('admin', $data);
	}

	public function update($id)
	{
		if (empty($this->input->post('Password'))) {
			$data = array(
				'NamaLengkap' => $this->input->post('NamaLengkap')
			);
		} else {
			$data = array(
				'Password' => md5($this->input->post('Password')),
				'Nama_Lengkap' => $this->input->post('Nama_Lengkap')
			);
		}
		$this->db->where('Username', $id);
		return $this->db->update('admin', $data);
	}

	public function destroy($id)
	{
		$this->db->where('Username', $id);
		$this->db->delete('admin');
		return true;
	}
	
}
