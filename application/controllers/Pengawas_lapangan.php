<?php 

class Pengawas_lapangan extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('jalan_m');
		$this->data['jalan']	= $this->jalan_m->get();
		$this->data['title'] 	= 'Dashboard | ' . $this->title;
		$this->data['content']	= 'pengawas_lapangan/dashboard';
		$this->template($this->data);
	}

	public function jalan()
	{
		$this->load->model('jalan_m');
		$this->data['jalan']	= $this->jalan_m->get_by_order('id_data', 'DESC');
		$this->data['title']	= 'Data Jalan | ' . $this->title;
		$this->data['content']	= 'pengawas_lapangan/data_jalan';
		$this->template($this->data);	
	}

	public function unduh_laporan_jalan()
	{
		$this->load->model('jalan_m');
		$this->data['jalan'] = $this->jalan_m->get_by_order('id_data', 'DESC');
		$html = $this->load->view('pengawas_lapangan/laporan_jalan', $this->data, true);
		$file_name = date('YmdHis') . ' - Laporan Jalan.pdf';
		$this->load->library('m_pdf');
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($file_name, 'D');
	}
}