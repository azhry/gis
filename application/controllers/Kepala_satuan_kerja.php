<?php 

class Kepala_satuan_kerja extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->data['nip'] 		= $this->session->userdata('nip');
		$this->data['id_role']	= $this->session->userdata('id_role');
		if (!isset($this->data['nip'], $this->data['id_role']))
		{
			$this->session->sess_destroy();
			redirect('login');
			exit;
		}

		if ($this->data['id_role'] != 2)
		{
			$this->session->sess_destroy();
			redirect('login');
			exit;
		}
	}

	public function index()
	{
		$this->load->model('proyek_m');
		$this->data['proyek']	= $this->proyek_m->get();
		$this->data['title'] 	= 'Dashboard | ' . $this->title;
		$this->data['content']	= 'kepala_satuan_kerja/dashboard';
		$this->template($this->data);
	}

	public function proyek()
	{
		$this->load->model('provinsi_m');
		$this->load->model('kabupaten_m');
		$this->load->model('proyek_m');

		if ($this->GET('delete') && $this->GET('id'))
		{
			$this->data['id_data'] = $this->GET('id', true);
			$this->proyek_m->delete($this->data['id_data']);
			@unlink(realpath(APPPATH . '../img/' . $this->data['id_data'] . '.jpg'));
			$this->flashmsg('<i class="fa fa-trash"></i> Data proyek berhasil dihapus', 'warning');
			redirect('kepala_satuan_kerja/proyek');
			exit;	
		}

		$this->data['provinsi']		= $this->provinsi_m->get();
		$this->data['kabupaten']	= $this->kabupaten_m->get();
		$this->data['proyek']			= $this->proyek_m->get_proyek();
		$this->data['title']		= 'Data Proyek | ' . $this->title;
		$this->data['content']		= 'kepala_satuan_kerja/data_proyek';
		$this->template($this->data);	
	}

	public function tambah_proyek() {

		$this->load->model( 'proyek_m' );
		$this->load->model( 'provinsi_m' );
		$this->load->model( 'kabupaten_m' );

		if ( $this->POST( 'submit' ) ) {

			$this->data['proyek'] = [
				'namobj'		=> $this->POST('namobj'),
				'kl_dat_das'	=> $this->POST('kl_dat_das'),
				'thn_data'		=> $this->POST('thn_data'),
				'id_provinsi'	=> $this->POST('id_provinsi'),
				'id_kabupaten'	=> $this->POST('id_kabupaten'),
				'vol'			=> $this->POST('vol'),
				'biaya'			=> $this->POST('biaya'),
				'latitude'		=> $this->POST('latitude'),
				'longitude'		=> $this->POST('longitude'),
			];

			$this->proyek_m->insert($this->data['proyek']);
			$this->upload($this->db->insert_id(), '../img', 'foto');

			$this->flashmsg('<i class="fa fa-check"></i> Data proyek baru berhasil disimpan');
			redirect('kepala_satuan_kerja/proyek');
			exit;

		}

		$this->data['provinsi']		= $this->provinsi_m->get();
		$this->data['kabupaten']	= $this->kabupaten_m->get();
		$this->data['title']		= 'Tambah Data Proyek | ' . $this->title;
		$this->data['content']		= 'kepala_satuan_kerja/tambah_proyek';
		$this->template( $this->data );

	}

	public function edit_proyek() {

		$this->data['id_data']	= $this->uri->segment( 3 );
		if (!isset($this->data['id_data']))
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Required parameters are missing', 'danger');
			redirect('kepala_satuan_kerja/proyek');
			exit;
		}

		$this->load->model('proyek_m');
		$this->data['proyek'] = $this->proyek_m->get_row_proyek(['id' => $this->data['id_data']]);
		if (!$this->data['proyek'])
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Data proyek tidak ditemukan', 'danger');
			redirect('kepala_satuan_kerja/proyek');
			exit;
		}

		if ($this->POST('submit'))
		{
			$this->data['proyek'] = [
				'namobj'		=> $this->POST('namobj'),
				'kl_dat_das'	=> $this->POST('kl_dat_das'),
				'thn_data'		=> $this->POST('thn_data'),
				'id_provinsi'	=> $this->POST('id_provinsi'),
				'id_kabupaten'	=> $this->POST('id_kabupaten'),
				'vol'			=> $this->POST('vol'),
				'biaya'			=> $this->POST('biaya'),
				'latitude'		=> $this->POST('latitude'),
				'longitude'		=> $this->POST('longitude')
			];

			$this->proyek_m->update($this->data['id_data'], $this->data['proyek']);
			$this->upload($this->data['id_data'], '../img', 'foto');

			$this->flashmsg('<i class="fa fa-check"></i> Data proyek berhasil diedit');
			redirect('kepala_satuan_kerja/edit-proyek/' . $this->data['id_data']);
			exit;	
		}

		$this->load->model( 'provinsi_m' );
		$this->load->model( 'kabupaten_m' );

		$this->data['provinsi']		= $this->provinsi_m->get();
		$this->data['kabupaten']	= $this->kabupaten_m->get();
		$this->data['title'] 		= 'Edit Proyek | ' . $this->title;
		$this->data['content']		= 'kepala_satuan_kerja/edit_proyek';
		$this->template($this->data);

	}

	public function detail_proyek()
	{
		$this->data['id_data'] = $this->uri->segment(3);
		if (!isset($this->data['id_data']))
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Required parameters are missing', 'danger');
			redirect('kepala_satuan_kerja/proyek');
			exit;
		}

		$this->load->model('proyek_m');
		$this->data['proyek'] = $this->proyek_m->get_row_proyek(['id' => $this->data['id_data']]);
		if (!$this->data['proyek'])
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Data proyek tidak ditemukan', 'danger');
			redirect('kepala_satuan_kerja/proyek');
			exit;
		}

		$this->data['title'] 	= 'Detail proyek | ' . $this->title;
		$this->data['content']	= 'kepala_satuan_kerja/detail_proyek';
		$this->template($this->data);
	}

	public function peta_proyek()
	{
		$this->load->model('proyek_m');
		$this->data['proyek']	= $this->proyek_m->get_proyek();
		$this->data['title']	= 'Peta Proyek | ' . $this->title;
		$this->data['content']	= 'kepala_satuan_kerja/peta_proyek';
		$this->template($this->data);
	}

	public function grafik_proyek()
	{
		$this->load->model('kabupaten_m');
		$this->load->model('proyek_m');

		$this->data['kabupaten']	= $this->kabupaten_m->get();
		$this->data['title']		= 'Data Proyek | ' . $this->title;
		$this->data['content']		= 'kepala_satuan_kerja/grafik';
		$this->template($this->data);	
	}
}