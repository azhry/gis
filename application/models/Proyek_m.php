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
		$this->db->select('*, proyek.latitude AS latitude, proyek.longitude AS longitude, kabupaten.nama AS nama_kabupaten, kecamatan.nama AS nama_kecamatan');
		$this->db->from($this->data['table_name']);
		$this->db->join('kabupaten', $this->data['table_name'] . '.id_kabupaten = kabupaten.id_kabupaten');
		$this->db->join('kecamatan', $this->data['table_name'] . '.id_kecamatan = kecamatan.id_kecamatan');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_row_proyek($cond = '')
	{
		if ((is_array($cond) && count($cond) > 0) or (is_string($cond) && strlen($cond) >= 3))
			$this->db->where($cond);
		$this->db->select('*, kabupaten.nama AS nama_kabupaten, kecamatan.nama AS nama_kecamatan');
		$this->db->from($this->data['table_name']);
		$this->db->join('kabupaten', $this->data['table_name'] . '.id_kabupaten = kabupaten.id_kabupaten');
		$this->db->join('kecamatan', $this->data['table_name'] . '.id_kecamatan = kecamatan.id_kecamatan');
		$query = $this->db->get();
		return $query->row();
	}


	public function get_data_jumlah_proyek() {

		$this->db->select( '*, COUNT(proyek.id) AS jumlah_proyek' );
		$this->db->from( 'kabupaten' );
		$this->db->join( $this->data['table_name'], 'kabupaten.id_kabupaten = ' . $this->data['table_name'] . '.id_kabupaten', 'left' );
		$this->db->group_by( $this->data['table_name'] . '.id_kabupaten' );
		$query = $this->db->get();
		return $query->result();

	}

}