<?php 

class Progress_m extends MY_Model {

	public function __construct() {

		parent::__construct();
		$this->data['table_name'] 	= 'progress';
		$this->data['primary_key']	= 'id_progress';
	
	}

	public function get_progress( $id_proyek ) {

		$this->load->model( 'proyek_m' );
		$proyek = $this->proyek_m->get_row([ 'id' => $id_proyek ]);
		if ( isset( $proyek ) ) {

			$this->db->select( '*, ((serapan_anggaran / ' . $proyek->anggaran . ') * 100) AS progress' );
			$this->db->from( $this->data['table_name'] );
			$this->db->where([ 'id_proyek' => $id_proyek ]);
			$this->db->order_by( 'periode', 'ASC' );
			$query = $this->db->get();
			return $query->result();

		}

		return false;

	}

}