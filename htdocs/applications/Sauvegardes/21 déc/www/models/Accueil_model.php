<?php

class Accueil_model extends CI_Model
{
	private $table = 'utilisateur';

	public function ajouter_contact($data)
	{
		$this->db->insert('contact',$data);

	}

	public function get_profil($id)
	{	
		$table = 'utilisateur';
		return $this->db->select()
				->from($table)
				->where('id', $id)
				->get()
				->result();
	}

	public function rechercher_trajet($data)
	{
		$table = 'trajet';
		return $this->db->select('`id`,`id_posteur`,`ville_depart`, `ville_arrivee`,`date_trajet`' ,false)
				->from($table)
				->where('ville_depart', $data['ville_depart'])
				->where('ville_arrivee', $data['ville_arrivee'])
				// ->where('role_posteur !=',$data['role_rechercheur'])								
				->order_by('date_trajet')
				->get()
				->result();
	}

}