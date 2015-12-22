<?php

class Accueil_model extends CI_Model
{
	private $table = 'email';

	public function ajouter_contact($data)
	{
		$this->db->insert('contact',$data);

	}


}