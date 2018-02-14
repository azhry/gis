<?php 

class Login extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->data['nip']	= $this->session->userdata('nip');
		if (isset($this->data['nip']))
		{
			$this->data['id_role'] = $this->session->userdata('id_role');
			if (isset($this->data['id_role']))
			{
				switch ( $this->data['id_role'] )
				{
					case 1:
						redirect('admin');
						exit;

					case 2:
						redirect('kepala-satuan-kerja');
						exit;
				}
			}
		}
	}

	public function index()
	{
		$this->data['title']	= 'Login | ' . $this->title;
		$this->data['content']	= 'login';
		$this->load->view('login', $this->data);
	}

	public function login_process()
	{
		if ($this->POST('login-submit'))
		{
			$this->load->model('login_m');
			$account = $this->login_m->login($this->POST('nip'), md5($this->POST('password')));
			if (!$account)
			{
				$this->flashmsg('<i class="fa fa-warning"></i> NIP atau password salah', 'danger');
			}
		}

		redirect('login');
	}

}