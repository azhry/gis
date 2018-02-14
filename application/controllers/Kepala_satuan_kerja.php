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
		$this->data['kota']		= $this->proyek_m->get();
		$this->data['title'] 	= 'Dashboard | ' . $this->title;
		$this->data['content']	= 'kepala_satuan_kerja/dashboard';
		$this->template($this->data);
	}

	public function kota()
	{
		$this->load->model('provinsi_m');
		$this->load->model('kabupaten_m');
		$this->load->model('proyek_m');

		if ($this->POST('simpan'))
		{

			$this->data['kota'] = [
				'namobj'		=> $this->POST('namobj'),
				'kl_dat_das'	=> $this->POST('kl_dat_das'),
				'thn_data'		=> $this->POST('thn_data'),
				'id_provinsi'	=> $this->POST('id_provinsi'),
				'id_kabupaten'	=> $this->POST('id_kabupaten'),
				'vol'			=> $this->POST('vol'),
				'biaya'			=> $this->POST('biaya'),
				'latitude'		=> $this->POST('latitude'),
				'longitude'		=> $this->POST('longitude'),
				'remarks'		=> $this->POST('remarks'),
				'metadata'		=> $this->POST('metadata'),
				'lcode'			=> $this->POST('lcode'),
				'fcode'			=> $this->POST('fcode')
			];

			$this->proyek_m->insert($this->data['kota']);
			$this->upload($this->db->insert_id(), '../img', 'foto');

			$this->flashmsg('<i class="fa fa-check"></i> Data kota baru berhasil disimpan');
			redirect('kepala_satuan_kerja/kota');
			exit;
		}

		if ($this->POST('edit') && $this->POST('id'))
		{
			$this->data['kota'] = [
				'namobj'		=> $this->POST('namobj'),
				'kl_dat_das'	=> $this->POST('kl_dat_das'),
				'thn_data'		=> $this->POST('thn_data'),
				'id_provinsi'	=> $this->POST('id_provinsi'),
				'id_kabupaten'	=> $this->POST('id_kabupaten'),
				'vol'			=> $this->POST('vol'),
				'biaya'			=> $this->POST('biaya'),
				'latitude'		=> $this->POST('latitude'),
				'longitude'		=> $this->POST('longitude'),
				'remarks'		=> $this->POST('remarks'),
				'metadata'		=> $this->POST('metadata'),
				'lcode'			=> $this->POST('lcode'),
				'fcode'			=> $this->POST('fcode')
			];

			$this->proyek_m->update($this->POST('id'), $this->data['kota']);
			$this->upload($this->POST('id'), '../img', 'foto');

			$this->flashmsg('<i class="fa fa-check"></i> Data kota berhasil diedit');
			redirect('kepala_satuan_kerja/kota');
			exit;	
		}

		if ($this->POST('get') && $this->POST('id'))
		{
			$this->data['kota'] = $this->proyek_m->get_row(['id' => $this->POST('id')]);
			$provinsi 	= $this->provinsi_m->get();
			$kabupaten 	= $this->kabupaten_m->get();
			$prov 		= [];
			$kab 		= [];
			foreach ($provinsi as $row)
				$prov[$row->id_provinsi] = $row->nama;
			foreach ($kabupaten as $row)
				$kab[$row->id_kabupaten] = $row->nama;
			$this->data['kota']->dropdown_provinsi = form_dropdown('id_provinsi', $prov, $this->data['kota']->id_provinsi, ['class' => 'form-control']);
			$this->data['kota']->dropdown_kabupaten = form_dropdown('id_kabupaten', $kab, $this->data['kota']->id_kabupaten, ['class' => 'form-control']);
			echo json_encode($this->data['kota']);
			exit;
		}

		if ($this->GET('delete') && $this->GET('id'))
		{
			$this->data['id_data'] = $this->GET('id', true);
			$this->proyek_m->delete($this->data['id_data']);
			@unlink(realpath(APPPATH . '../img/' . $this->data['id_data'] . '.jpg'));
			$this->flashmsg('<i class="fa fa-trash"></i> Data kota berhasil dihapus', 'warning');
			redirect('kepala_satuan_kerja/kota');
			exit;	
		}

		$this->data['provinsi']		= $this->provinsi_m->get();
		$this->data['kabupaten']	= $this->kabupaten_m->get();
		$this->data['kota']			= $this->proyek_m->get_proyek();
		$this->data['title']		= 'Data Kota | ' . $this->title;
		$this->data['content']		= 'kepala_satuan_kerja/data_kota';
		$this->template($this->data);	
	}

	public function detail_kota()
	{
		$this->data['id_data'] = $this->uri->segment(3);
		if (!isset($this->data['id_data']))
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Required parameters are missing', 'danger');
			redirect('kepala_satuan_kerja/kota');
			exit;
		}

		$this->load->model('proyek_m');
		$this->data['kota'] = $this->proyek_m->get_row_proyek(['id' => $this->data['id_data']]);
		if (!$this->data['kota'])
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Data kota tidak ditemukan', 'danger');
			redirect('kepala_satuan_kerja/kota');
			exit;
		}

		$this->data['title'] 	= 'Detail Kota | ' . $this->title;
		$this->data['content']	= 'kepala_satuan_kerja/detail_kota';
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


}