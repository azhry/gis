<?php 

class Progress_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] 	= 'progress';
		$this->data['primary_key']	= 'id_progress';
	}
}