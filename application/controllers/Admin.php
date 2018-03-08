<?php 

class Admin extends MY_Controller
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

		if ($this->data['id_role'] != 1)
		{
			$this->session->sess_destroy();
			redirect('login');
			exit;
		}

	}

	public function index()
	{
		$this->load->model('pegawai_m');
		$this->load->model('proyek_m');
		$this->load->model('kabupaten_m');
		$this->load->model('provinsi_m');
		$this->data['pegawai']	= $this->pegawai_m->get();
		$this->data['proyek']	= $this->proyek_m->get();
		$this->data['kabupaten']= $this->kabupaten_m->get();
		$this->data['provinsi']	= $this->provinsi_m->get();
		$this->data['title'] 	= 'Dashboard | ' . $this->title;
		$this->data['content']	= 'admin/dashboard';
		$this->template($this->data);
	}

	public function pegawai() {

		$this->load->model( 'pegawai_m' );

		if ($this->GET('delete') && $this->GET('nip'))
		{
			$this->data['nip'] = $this->GET('nip', true);
			$this->pegawai_m->delete($this->data['nip']);
			$this->flashmsg('<i class="fa fa-trash"></i> Data pegawai berhasil dihapus', 'warning');
			redirect('admin/pegawai');
			exit;	
		}

		$this->data['pegawai']	= $this->pegawai_m->get();
		$this->data['title']	= 'Data Pegawai | ' . $this->title;
		$this->data['content']	= 'admin/data_pegawai';
		$this->template( $this->data, 'admin' );

	}

	public function tambah_pegawai() {

		$this->load->model( 'pegawai_m' );
		$this->load->model( 'role_m' );

		if ( $this->POST( 'submit' ) ) {

			$this->data['pegawai'] = [
				'nip'		=> $this->POST( 'nip' ),
				'nama'		=> $this->POST( 'nama' ),
				'jabatan'	=> $this->POST( 'jabatan' ),
				'email'		=> $this->POST( 'email' ),
				'nomor_hp'	=> $this->POST( 'nomor_hp' ),
				'password'	=> md5( $this->POST( 'password' ) ),
				'id_role'	=> $this->POST( 'id_role' )
			];

			$this->pegawai_m->insert( $this->data['pegawai'] );
			$this->flashmsg( 'Data berhasil disimpan' );
			redirect( 'admin/pegawai' );
			exit;

		}

		$this->data['role']		= $this->role_m->get();
		$this->data['title']	= 'Tambah Pegawai | ' . $this->title;
		$this->data['content']	= 'admin/tambah_pegawai';
		$this->template( $this->data, 'admin' );

	}

	public function edit_pegawai() {

		$this->data['nip']	= $this->uri->segment( 3 );
		if ( !isset( $this->data['nip'] ) ) {

			$this->flashmsg( 'Required parameter is missing', 'danger' );
			redirect( 'admin/pegawai' );
			exit;

		}

		$this->load->model( 'pegawai_m' );
		$this->data['pegawai']	= $this->pegawai_m->get_row([ 'nip' => $this->data['nip'] ]);
		if ( !isset( $this->data['pegawai'] ) ) {

			$this->flashmsg( 'Data tidak ditemukan', 'danger' );
			redirect( 'admin/pegawai' );
			exit;			

		}

		$this->load->model( 'role_m' );

		if ( $this->POST( 'submit' ) ) {

			$this->data['pegawai'] = [
				'nip'		=> $this->POST( 'nip' ),
				'nama'		=> $this->POST( 'nama' ),
				'jabatan'	=> $this->POST( 'jabatan' ),
				'email'		=> $this->POST( 'email' ),
				'nomor_hp'	=> $this->POST( 'nomor_hp' ),
				'id_role'	=> $this->POST( 'id_role' )
			];

			$password = $this->POST( 'password' );
			if ( !empty( $password ) ) $this->data['pegawai']['password'] = md5( $password );

			$this->pegawai_m->update( $this->data['nip'], $this->data['pegawai'] );
			$this->flashmsg( 'Data berhasil diedit' );
			redirect( 'admin/edit-pegawai/' . $this->POST( 'nip' ) );
			exit;

		}

		$this->data['role']		= $this->role_m->get();
		$this->data['title']	= 'Edit Pegawai | ' . $this->title;
		$this->data['content']	= 'admin/edit_pegawai';
		$this->template( $this->data, 'admin' );

	}

	public function detail_pegawai()
	{
		$this->data['nip'] = $this->uri->segment(3);
		if (!isset($this->data['nip']))
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Required parameters are missing', 'danger');
			redirect('admin/pegawai');
			exit;
		}

		$this->load->model('pegawai_m');
		$this->data['pegawai'] = $this->pegawai_m->get_row(['nip' => $this->data['nip']]);
		if (!isset($this->data['pegawai']))
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Data pegawai tidak ditemukan', 'danger');
			redirect('admin/pegawai');
			exit;	
		}

		$this->data['title']	= 'Detail Pegawai | ' . $this->title;
		$this->data['content']	= 'admin/detail_pegawai';
		$this->template($this->data);
	}

	public function proyek()
	{
		$this->load->model('kabupaten_m');
		$this->load->model('proyek_m');

		if ($this->GET('delete') && $this->GET('id'))
		{
			$this->data['id_data'] = $this->GET('id', true);
			$this->proyek_m->delete($this->data['id_data']);
			@unlink(realpath(APPPATH . '../img/' . $this->data['id_data'] . '.jpg'));
			$this->flashmsg('<i class="fa fa-trash"></i> Data proyek berhasil dihapus', 'warning');
			redirect('admin/proyek');
			exit;	
		}

		$this->data['kabupaten']	= $this->kabupaten_m->get();
		$this->data['proyek']			= $this->proyek_m->get_proyek();
		$this->data['title']		= 'Data Proyek | ' . $this->title;
		$this->data['content']		= 'admin/data_proyek';
		$this->template($this->data);	
	}

	public function tambah_proyek() {

		$this->load->model( 'proyek_m' );
		$this->load->model( 'kabupaten_m' );
		$this->load->model( 'kecamatan_m' );

		if ( $this->POST( 'submit' ) ) {

			$this->data['proyek'] = [
				'namobj'					=> $this->POST('namobj'),
				'kl_dat_das'				=> $this->POST('kl_dat_das'),
				'thn_data'					=> $this->POST('thn_data'),
				'id_kecamatan'				=> $this->POST( 'id_kecamatan' ),
				'id_kabupaten'				=> $this->POST('id_kabupaten'),
				'vol'						=> $this->POST('vol'),
				'anggaran'					=> $this->POST('anggaran'),
				'latitude'					=> $this->POST('latitude'),
				'longitude'					=> $this->POST('longitude'),
				'tanggal_selesai'			=> $this->POST('tanggal_selesai'),
				'tanggal_mulai'				=> $this->POST('tanggal_mulai')
			];

			$this->proyek_m->insert($this->data['proyek']);
			$this->upload($this->db->insert_id(), '../img', 'foto');

			$this->flashmsg('<i class="fa fa-check"></i> Data proyek baru berhasil disimpan');
			redirect('admin/proyek');
			exit;

		}

		if ( $this->GET( 'id_kabupaten' ) ) {

			$kecamatan = $this->kecamatan_m->get([ 'id_kabupaten' => $this->GET( 'id_kabupaten' ) ]);
			echo json_encode( $kecamatan );
			exit;

		}

		$this->data['kabupaten']	= $this->kabupaten_m->get();
		$this->data['title']		= 'Tambah Data Proyek | ' . $this->title;
		$this->data['content']		= 'admin/tambah_proyek';
		$this->template( $this->data );

	}

	public function edit_proyek() {

		$this->data['id_data']	= $this->uri->segment( 3 );
		if (!isset($this->data['id_data']))
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Required parameters are missing', 'danger');
			redirect('admin/proyek');
			exit;
		}

		$this->load->model('proyek_m');
		$this->data['proyek'] = $this->proyek_m->get_row_proyek(['id' => $this->data['id_data']]);
		if (!$this->data['proyek'])
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Data proyek tidak ditemukan', 'danger');
			redirect('admin/proyek');
			exit;
		}

		if ($this->POST('submit'))
		{
			$this->data['proyek'] = [
				'namobj'					=> $this->POST('namobj'),
				'kl_dat_das'				=> $this->POST('kl_dat_das'),
				'thn_data'					=> $this->POST('thn_data'),
				'id_kecamatan'				=> $this->POST('id_kecamatan'),
				'id_kabupaten'				=> $this->POST('id_kabupaten'),
				'vol'						=> $this->POST('vol'),
				'anggaran'					=> $this->POST('anggaran'),
				'latitude'					=> $this->POST('latitude'),
				'longitude'					=> $this->POST('longitude'),
				'tanggal_selesai'			=> $this->POST('tanggal_selesai'),
				'tanggal_mulai'				=> $this->POST('tanggal_mulai')
			];

			$this->proyek_m->update($this->data['id_data'], $this->data['proyek']);
			$this->upload($this->data['id_data'], '../img', 'foto');

			$this->flashmsg('<i class="fa fa-check"></i> Data proyek berhasil diedit');
			redirect('admin/edit-proyek/' . $this->data['id_data']);
			exit;	
		}

		$this->load->model( 'kecamatan_m' );
		$this->load->model( 'kabupaten_m' );

		$this->data['kecamatan']	= $this->kecamatan_m->get([ 'id_kabupaten' => $this->data['proyek']->id_kabupaten ]);
		$this->data['kabupaten']	= $this->kabupaten_m->get();
		$this->data['title'] 		= 'Edit Proyek | ' . $this->title;
		$this->data['content']		= 'admin/edit_proyek';
		$this->template($this->data);

	}

	public function detail_proyek()
	{
		$this->data['id_data'] = $this->uri->segment(3);
		if (!isset($this->data['id_data']))
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Required parameters are missing', 'danger');
			redirect('admin/proyek');
			exit;
		}

		$this->load->model('proyek_m');
		$this->data['proyek'] = $this->proyek_m->get_row_proyek(['id' => $this->data['id_data']]);
		if (!$this->data['proyek'])
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Data proyek tidak ditemukan', 'danger');
			redirect('admin/proyek');
			exit;
		}

		$this->load->model( 'progress_m' );
		$this->data['progress']	= $this->progress_m->get_progress( $this->data['id_data'] );
		$this->data['title'] 	= 'Detail proyek | ' . $this->title;
		$this->data['content']	= 'admin/detail_proyek';
		$this->template($this->data);
	}

	public function peta_proyek()
	{
		$this->load->model('proyek_m');
		$this->data['proyek']	= $this->proyek_m->get_proyek();
		$this->data['title']	= 'Peta Proyek | ' . $this->title;
		$this->data['content']	= 'admin/peta_proyek';
		$this->template($this->data);
	}

	// public function provinsi()
	// {
	// 	$this->load->model('provinsi_m');

	// 	if ($this->POST('simpan'))
	// 	{

	// 		$this->data['provinsi'] = [
	// 			'nama'		=> $this->POST('nama')
	// 		];

	// 		$this->provinsi_m->insert($this->data['provinsi']);

	// 		$this->flashmsg('<i class="fa fa-check"></i> Data provinsi baru berhasil disimpan');
	// 		redirect('admin/provinsi');
	// 		exit;
	// 	}

	// 	if ($this->POST('edit') && $this->POST('id_provinsi'))
	// 	{
	// 		$this->data['provinsi'] = [
	// 			'nama'		=> $this->POST('nama')
	// 		];

	// 		$this->provinsi_m->update($this->POST('id_provinsi'), $this->data['provinsi']);

	// 		$this->flashmsg('<i class="fa fa-check"></i> Data provinsi berhasil diedit');
	// 		redirect('admin/provinsi');
	// 		exit;	
	// 	}

	// 	if ($this->POST('get') && $this->POST('id_provinsi'))
	// 	{
	// 		$this->data['provinsi'] = $this->provinsi_m->get_row(['id_provinsi' => $this->POST('id_provinsi')]);
	// 		echo json_encode($this->data['provinsi']);
	// 		exit;
	// 	}

	// 	if ($this->GET('delete') && $this->GET('id_provinsi'))
	// 	{
	// 		$this->data['id_data'] = $this->GET('id_provinsi', true);
	// 		$this->provinsi_m->delete($this->data['id_data']);
	// 		$this->flashmsg('<i class="fa fa-trash"></i> Data provinsi berhasil dihapus', 'warning');
	// 		redirect('admin/provinsi');
	// 		exit;	
	// 	}

	// 	$this->data['provinsi']		= $this->provinsi_m->get();
	// 	$this->data['title']		= 'Data Provinsi | ' . $this->title;
	// 	$this->data['content']		= 'admin/data_provinsi';
	// 	$this->template($this->data);	
	// }

	public function kabupaten()
	{
		$this->load->model('kabupaten_m');

		if ($this->POST('simpan'))
		{

			$this->data['kabupaten'] = [
				'nama'		=> $this->POST('nama')
			];

			$this->kabupaten_m->insert($this->data['kabupaten']);

			$this->flashmsg('<i class="fa fa-check"></i> Data kabupaten baru berhasil disimpan');
			redirect('admin/kabupaten');
			exit;
		}

		if ($this->POST('edit') && $this->POST('id_kabupaten'))
		{
			$this->data['kabupaten'] = [
				'nama'		=> $this->POST('nama')
			];

			$this->kabupaten_m->update($this->POST('id_kabupaten'), $this->data['kabupaten']);

			$this->flashmsg('<i class="fa fa-check"></i> Data kabupaten berhasil diedit');
			redirect('admin/kabupaten');
			exit;	
		}

		if ($this->POST('get') && $this->POST('id_kabupaten'))
		{
			$this->data['kabupaten'] = $this->kabupaten_m->get_row(['id_kabupaten' => $this->POST('id_kabupaten')]);
			echo json_encode($this->data['kabupaten']);
			exit;
		}

		if ($this->GET('delete') && $this->GET('id_kabupaten'))
		{
			$this->data['id_data'] = $this->GET('id_kabupaten', true);
			$this->kabupaten_m->delete($this->data['id_data']);
			$this->flashmsg('<i class="fa fa-trash"></i> Data kabupaten berhasil dihapus', 'warning');
			redirect('admin/kabupaten');
			exit;	
		}

		$this->data['kabupaten']		= $this->kabupaten_m->get();
		$this->data['title']		= 'Data kabupaten | ' . $this->title;
		$this->data['content']		= 'admin/data_kabupaten';
		$this->template($this->data);	
	}


	public function progress() {

		$this->data['id_proyek'] = $this->uri->segment(3);
		if ( !isset( $this->data['id_proyek'] ) ) {

			redirect( 'admin/proyek' );
			exit;

		}
		$this->load->model( 'progress_m' );

		if ($this->GET('delete') && $this->GET('id_progress'))
		{
			$this->data['id_progress'] = $this->GET('id_progress', true);
			$this->progress_m->delete($this->data['id_progress']);
			$this->flashmsg('<i class="fa fa-trash"></i> Data progress berhasil dihapus', 'warning');
			redirect('admin/progress/'.$this->data['id_proyek']);
			exit;	
		}

		$this->data['progress']	= $this->progress_m->get(['id_proyek' => $this->data['id_proyek']]);
		$this->data['title']	= 'Data Progress | ' . $this->title;
		$this->data['content']	= 'admin/data_progress';
		$this->template( $this->data, 'admin' );

	}

	public function tambah_progress() {

		$this->load->model( 'progress_m' );

		$this->data['id_proyek'] = $this->uri->segment(3);

		if ( !isset( $this->data['id_proyek'] ) ) {

			$this->flashmsg( 'Required parameter is missing', 'danger' );
			redirect( 'admin/proyek/');
			exit;

		}

		if ( $this->POST( 'submit' ) ) {

			$this->data['progress'] = [
				'id_proyek'			=> $this->data['id_proyek'],
				'serapan_anggaran'	=> $this->POST( 'serapan_anggaran' ),
				'periode'			=> $this->POST( 'periode' )
			];

			$this->progress_m->insert( $this->data['progress'] );
			$this->flashmsg( 'Data berhasil disimpan' );
			redirect( 'admin/progress/'.$this->data['id_proyek'] );
			exit;

		}

		$this->data['id_proyek']= $this->data['id_proyek'];
		$this->data['title']	= 'Tambah Progress | ' . $this->title;
		$this->data['content']	= 'admin/tambah_progress';
		$this->template( $this->data, 'admin' );

	}

	public function edit_progress() {

		$this->load->model( 'progress_m' );

		$this->data['id_progress']	= $this->uri->segment( 3 );
		$this->data['progress']		= $this->progress_m->get_row([ 'id_progress' => $this->data['id_progress'] ]);

		$this->data['id_proyek'] = $this->data['progress']->id_proyek;

		if ( !isset( $this->data['id_progress'] ) ) {

			$this->flashmsg( 'Required parameter is missing', 'danger' );
			redirect( 'admin/detail-proyek/'.$id_proyek );
			exit;

		}

		$this->load->model( 'progress_m' );
		if ( !isset( $this->data['progress'] ) ) {

			$this->flashmsg( 'Data tidak ditemukan', 'danger' );
			redirect( 'admin/detail-proyek/'.$id_proyek );
			exit;			

		}

		if ( $this->POST( 'submit' ) ) {

			$this->data['progress'] = [
				'serapan_anggaran'	=> $this->POST( 'serapan_anggaran' ),
				'periode'			=> $this->POST( 'periode' )
			];

			$this->progress_m->update( $this->data['id_progress'], $this->data['progress'] );
			$this->flashmsg( 'Data berhasil diedit' );
			redirect( 'admin/progress/' . $this->data['id_proyek'] );
			exit;

		}


		$this->data['title']	= 'Edit Progress | ' . $this->title;
		$this->data['content']	= 'admin/edit_progress';
		$this->template( $this->data, 'admin' );

	}

	public function kecamatan() {

		$this->load->model('kecamatan_m');

		if ($this->POST('simpan'))
		{

			$this->data['kecamatan'] = [
				'nama'		=> $this->POST('nama'),
				'id_kabupaten'	=> $this->POST( 'id_kabupaten' )
			];

			$this->kecamatan_m->insert($this->data['kecamatan']);

			$this->flashmsg('<i class="fa fa-check"></i> Data kecamatan baru berhasil disimpan');
			redirect('admin/kecamatan');
			exit;
		}

		if ($this->POST('edit') && $this->POST('id_kecamatan'))
		{
			$this->data['kecamatan'] = [
				'nama'			=> $this->POST('nama'),
				'id_kabupaten'	=> $this->POST( 'id_kabupaten' )
			];

			$this->kecamatan_m->update($this->POST('id_kecamatan'), $this->data['kecamatan']);

			$this->flashmsg('<i class="fa fa-check"></i> Data kecamatan berhasil diedit');
			redirect('admin/kecamatan');
			exit;	
		}

		$this->load->model( 'kabupaten_m' );
		$this->data['kabupaten']	= $this->kabupaten_m->get();

		if ($this->POST('get') && $this->POST('id_kecamatan'))
		{
			$this->data['kecamatan'] = $this->kecamatan_m->get_row(['id_kecamatan' => $this->POST('id_kecamatan')]);
			$kabupaten_opt = [];
			foreach ( $this->data['kabupaten'] as $row ) $kabupaten_opt[$row->id_kabupaten] = $row->nama;
			$this->data['kecamatan']->dropdown = form_dropdown( 'id_kabupaten', $kabupaten_opt, $this->data['kecamatan']->id_kabupaten, [ 'class' => 'form-control' ] );
			echo json_encode($this->data['kecamatan']);
			exit;
		}

		if ($this->GET('delete') && $this->GET('id_kecamatan'))
		{
			$this->data['id_data'] = $this->GET('id_kecamatan', true);
			$this->kecamatan_m->delete($this->data['id_data']);
			$this->flashmsg('<i class="fa fa-trash"></i> Data kecamatan berhasil dihapus', 'warning');
			redirect('admin/kecamatan');
			exit;	
		}

		$this->data['kecamatan']	= $this->kecamatan_m->get();
		$this->data['title']		= 'Data Kecamatan | ' . $this->title;
		$this->data['content']		= 'admin/data_kecamatan';
		$this->template($this->data);

	}

}