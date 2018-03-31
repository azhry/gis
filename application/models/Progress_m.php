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

	public function get_progress_each_region() {

		$this->load->model( 'proyek_m' );
		$this->load->model( 'kabupaten_m' );
		$this->load->model( 'progress_m' );

		$kabupaten = $this->kabupaten_m->get();
		$result = [];
		foreach ( $kabupaten as $region ) {

			$result []= [
				'id' 		=> $region->id_kabupaten,
				'proyek'	=> [],
				'progress'	=> 0,
				'latitude'	=> $region->latitude,
				'longitude'	=> $region->longitude
			];
			$total_progress = 0;
			$proyek = $this->proyek_m->get([ 'id_kabupaten' => $region->id_kabupaten ]);
			foreach ( $proyek as $row ) {

				$this->db->select( '*, SUM((serapan_anggaran / ' . $row->anggaran . ') * 100) AS progress' );
				$this->db->from( $this->data['table_name'] );
				$this->db->where([ 'id_proyek' => $row->id ]);
				$this->db->order_by( 'periode', 'DESC' );
				// $this->db->limit(1);
				$query = $this->db->get();
				$progress = $query->row();
				if ( isset( $progress ) )
					$total_progress += $progress->progress;
				$row->nama_kabupaten = $region->nama;
				$result[count( $result ) - 1]['proyek'] []= $row;

			}

			$result[count( $result ) - 1]['progress'] = !count( $proyek ) ? 0 : $total_progress / count( $proyek );

		}

		return $result;

	}

}