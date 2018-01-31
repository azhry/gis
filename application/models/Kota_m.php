<?php 

class Kota_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'kota';
		$this->data['primary_key']	= 'id';
	}
}