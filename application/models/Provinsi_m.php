<?php 

class Provinsi_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'provinsi';
		$this->data['primary_key']	= 'id_provinsi';
	}
}