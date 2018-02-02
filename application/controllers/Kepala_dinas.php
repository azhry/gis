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
		$this->load->model('kota_m');
		
		$this->data['kota']		= $this->kota_m->get_by_order('id', 'DESC');
		$this->data['title']	= 'Data Kota | ' . $this->title;
		$this->data['content']	= 'kepala_dinas/data_kota';
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
		$this->data['kota'] = $this->kota_m->get_row(['id' => $this->data['id_data']]);
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

}