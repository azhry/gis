<?php 

class Proyek_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'proyek';
		$this->data['primary_key']	= 'id';
	}

	public function get_proyek($cond = '')
	{
		if ((is_array($cond) && count($cond) > 0) or (is_string($cond) && strlen($cond) >= 3))
			$this->db->where($cond);
		$this->db->select('*, provinsi.nama AS nama_provinsi, kabupaten.nama AS nama_kabupaten');
		$this->db->from($this->data['table_name']);
		$this->db->join('provinsi', $this->data['table_name'] . '.id_provinsi = provinsi.id_provinsi');
		$this->db->join('kabupaten', $this->data['table_name'] . '.id_kabupaten = kabupaten.id_kabupaten');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_row_proyek($cond = '')
	{
		if ((is_array($cond) && count($cond) > 0) or (is_string($cond) && strlen($cond) >= 3))
			$this->db->where($cond);
		$this->db->select('*, provinsi.nama AS nama_provinsi, kabupaten.nama AS nama_kabupaten');
		$this->db->from($this->data['table_name']);
		$this->db->join('provinsi', $this->data['table_name'] . '.id_provinsi = provinsi.id_provinsi');
		$this->db->join('kabupaten', $this->data['table_name'] . '.id_kabupaten = kabupaten.id_kabupaten');
		$query = $this->db->get();
		return $query->row();
	}
}