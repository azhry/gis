<?php 

class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('proyek_m');
		$this->load->model( 'progress_m' );
		$this->data['proyek']	= $this->proyek_m->get_proyek();
		$this->load->view('peta_proyek', $this->data);
	}

}