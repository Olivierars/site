<?php

class Utilisateur_model extends CI_Model
{
	private $table = 'utilisateur';
	
	public function ajouter_utilisateur($nom,$prenom,$email,$mdp,$role)
	{
		// Hachage du mot de passe
		$pass_hache = sha1($_POST['mdp']);
		//$pass_hache = $mdp ;

		// Insertion
		return $this->db->set(array('nom' 		=> $nom,
				    				'prenom' 	=> $prenom,
				    				'email'		=> $email,
				    				'mdp'		=> $pass_hache,
				    				'role'		=> $role))
			->set('date_inscription', 'NOW()', false)
			->set('statut','"active"',false)
			->insert($this->table);

	}
	
	public function modifier_utilisateur($nom,$prenom,$mail,$mdp,$role,$statut)
	{
		
		
	}
	
	public function userLogin($email,$mdp)
	{
		// Hachage du mot de passe

		$pass_hache = sha1($_POST['mdp']);
		$query = $this->db-> select('id, email, mdp')
   						-> from('utilisateur')
   						-> where('email', $email)
   						-> where('mdp', $pass_hache)
   						-> limit(1)
						-> get();

	   if($query -> num_rows() == 1)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
				
	}
}

?>
