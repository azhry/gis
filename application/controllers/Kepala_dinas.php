<?php 

class Kepala_dinas extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->data['nip'] 	= $this->session->userdata('nip');
		$this->data['role']	= $this->session->userdata('role');
		if (!isset($this->data['nip'], $this->data['role']))
		{
			$this->session->sess_destroy();
			redirect('login');
			exit;
		}

		if ($this->data['role'] != 'kepala dinas')
		{
			$this->session->sess_destroy();
			redirect('login');
			exit;
		}
	}

	public function index()
	{
		$this->load->model('jalan_m');
		$this->data['jalan']	= $this->jalan_m->get();

		$this->load->model('kota_m');
		$this->data['kota']		= $this->kota_m->get();
		$this->data['title'] 	= 'Dashboard | ' . $this->title;
		$this->data['content']	= 'kepala_dinas/dashboard';
		$this->template($this->data);
	}

	public function jalan()
	{
		$this->load->model('jalan_m');
		$this->data['jalan']	= $this->jalan_m->get_by_order('id_data', 'DESC');
		$this->data['title']	= 'Data Jalan | ' . $this->title;
		$this->data['content']	= 'kepala_dinas/data_jalan';
		$this->template($this->data);	
	}

	public function unduh_laporan_jalan()
	{
		$this->load->model('jalan_m');
		$this->data['jalan'] = $this->jalan_m->get_by_order('id_data', 'DESC');
		$html = $this->load->view('kepala_dinas/laporan_jalan', $this->data, true);
		$file_name = date('YmdHis') . ' - Laporan Jalan.pdf';
		$this->load->library('m_pdf');
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($file_name, 'D');
	}

	public function kota()
	{
		$this->load->model('provinsi_m');
		$this->load->model('kabupaten_m');
		$this->load->model('kota_m');

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

			$this->kota_m->insert($this->data['kota']);
			$this->upload($this->db->insert_id(), '../img', 'foto');

			$this->flashmsg('<i class="fa fa-check"></i> Data kota baru berhasil disimpan');
			redirect('kepala_dinas/kota');
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

			$this->kota_m->update($this->POST('id'), $this->data['kota']);
			$this->upload($this->POST('id'), '../img', 'foto');

			$this->flashmsg('<i class="fa fa-check"></i> Data kota berhasil diedit');
			redirect('kepala_dinas/kota');
			exit;	
		}

		if ($this->POST('get') && $this->POST('id'))
		{
			$this->data['kota'] = $this->kota_m->get_row(['id' => $this->POST('id')]);
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
			$this->kota_m->delete($this->data['id_data']);
			@unlink(realpath(APPPATH . '../img/' . $this->data['id_data'] . '.jpg'));
			$this->flashmsg('<i class="fa fa-trash"></i> Data kota berhasil dihapus', 'warning');
			redirect('kepala_dinas/kota');
			exit;	
		}

		$this->data['provinsi']		= $this->provinsi_m->get();
		$this->data['kabupaten']	= $this->kabupaten_m->get();
		$this->data['kota']			= $this->kota_m->get_kota();
		$this->data['title']		= 'Data Kota | ' . $this->title;
		$this->data['content']		= 'kepala_dinas/data_kota';
		$this->template($this->data);	
	}

	public function detail_kota()
	{
		$this->data['id_data'] = $this->uri->segment(3);
		if (!isset($this->data['id_data']))
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Required parameters are missing', 'danger');
			redirect('kepala_dinas/kota');
			exit;
		}

		$this->load->model('kota_m');
		$this->data['kota'] = $this->kota_m->get_row_kota(['id' => $this->data['id_data']]);
		if (!$this->data['kota'])
		{
			$this->flashmsg('<i class="fa fa-warning"></i> Data kota tidak ditemukan', 'danger');
			redirect('kepala_dinas/kota');
			exit;
		}

		$this->data['title'] 	= 'Detail Kota | ' . $this->title;
		$this->data['content']	= 'kepala_dinas/detail_kota';
		$this->template($this->data);
	}

	public function peta_proyek()
	{
		$this->load->model('kota_m');
		$this->data['kota']		= $this->kota_m->get_kota();
		$this->data['title']	= 'Peta Proyek | ' . $this->title;
		$this->data['content']	= 'kepala_dinas/peta_proyek';
		$this->template($this->data);
	}


}