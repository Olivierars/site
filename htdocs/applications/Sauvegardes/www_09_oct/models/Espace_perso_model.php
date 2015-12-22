<?php

class Espace_perso_model extends CI_Model
{


// TRAJET ----------------------------------------------------
	public function ajouter_trajet($data)
	{
		$table = 'trajet';
		$this->db->insert($table,$data);
	}


	public function voir_trajet_perso($id_posteur,$nb, $debut)  // $id_posteur a ajouter comme condition dans la recherche
	{
		$table = 'trajet';
		return $this->db->select('`id`,`ville_depart`, `ville_arrivee`,`date_trajet`,`heure_trajet`' ,false)  // DATE_FORMAT(`date_trajet`,\'%d/%m/%Y \') AS \'date_trajet\'
				->from($table)
				->where('id_posteur', $id_posteur)				
				->order_by('date_trajet')
				->limit($nb, $debut)
				->get()
				->result();
	}

	public function compter_trajet_perso($id_posteur)  //$id_posteur
	{
		$table = 'trajet';
		$this->db->where('id_posteur', $id_posteur);
		$this->db->from($table);
		return $this->db->count_all_results();
	}

	public function compter_trajet()
	{
		$table = 'trajet';
		return $this->db->count_all($this->table);
	}

	public function rechercher_trajet($ville_depart,$ville_arrivee)
	{
		$table = 'trajet';
		return $this->db->select('`id_posteur`,`ville_depart`, `ville_arrivee`,`date_trajet`' ,false)
				->from($table)
				->where('ville_depart', $ville_depart)
				->where('ville_arrivee', $ville_arrivee)								
				->order_by('date_trajet')
				->get()
				->result();
	}

	public function get_profil($id)
	{	
		$table = 'utilisateur';
		return $this->db->select('`nom`,`prenom`, `email`,`role`' ,false)
				->from($table)
				->where('id', $id)
				->get()
				->result();
	}

// MESSAGE ----------------------------------------------------

	public function ajouter_message($data)
	{
		$table = 'message';
		$this->db->insert($this->table,$data);

	}

	public function voir_message()
	{
		$table = 'message';

	}

	public function compter_message()
	{
		$table = 'message';
		return $this->db->count_all($this->table);
	}
}