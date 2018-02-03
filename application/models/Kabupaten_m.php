<?php 

class Kabupaten_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'kabupaten';
		$this->data['primary_key']	= 'id_kabupaten';
	}
}