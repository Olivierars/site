<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateur extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		
		//	Chargement des ressources pour tout le contrôleur
		$this->load->database();
		$this->load->helper(array('url','assets','form'));
		$this->load->model('Utilisateur_model','UtilisateurManager');
		$this->load->library('form_validation');
	}

	public function index($page = 'connexion')
	{
		$this->connexion($page);
	}

	public function connexion($page = 'connexion')
	{
    	 	$data['title'] = ucfirst($page); // Capitalize the first letter
    	 	$data['description'] =  'Page de connexion à son espace membre';
    	 	$this->load->view ('templates/navigation');
    	 	$this->load->view('templates/header', $data);
    	 	$this->load->view('pages/Utilisateur/'.$page, $data);
    	 	$this->load->view('templates/footer', $data);
    }

	public function verif_login()
	{
	 	$this->form_validation->set_rules('email', '"Identifiant"', 'trim|required');
	 	$this->form_validation->set_rules('mdp', '"Mot de passe"', 'trim|required|callback_check_database');

	 	if($this->form_validation->run() == FALSE)
	 	{
    	// Chargement de la page de login 
	 		// !!!!!!!! Tester si un include ou require ne fait pas le même taf 
	 		$page = 'connexion';
			$data['title'] = ucfirst($page); // Capitalize the first letter
			$data['description'] =  'Page de connexion à son espace membre';
			$this->load->view ('templates/navigation');
			$this->load->view('templates/header', $data);
			$this->load->view('pages/Utilisateur/'.$page, $data);
			$this->load->view('templates/footer', $data);	
		}
		else
		{
           	//Go to private area
			redirect('Espace_perso/Tableau_de_bord', 'refresh'); 
		}	    
	}

	public function check_database($mdp)
	{
   		//Field validation succeeded.  Validate against database
		$email = $this->input->post('email');

   		//query the database
		$result = $this->UtilisateurManager->userLogin($email, $mdp);

		if($result)
		{
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array(
					'id' => $row->id,
					'email' => $row->email
					);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_database', 'Email et/ou mot de passe incorrect');
			return false;
		}
	}

	public function inscription($page = 'inscription')
	{
    	// Vérification que la page existe
		if ( ! file_exists(APPPATH.'/views/pages/Utilisateur/'.$page.'.php')) {show_404();}

        //$this->load->library('form_validation');  
		$this->form_validation->set_error_delimiters('<p class="form_erreur">', '</p>');
		
		//	Mise en place des règles de validation du formulaire d'inscription
		$this->form_validation->set_rules('nom', 	'"Nom"', 						'trim|required');
		$this->form_validation->set_rules('prenom', '"Prenom"', 					'trim|required');
		$this->form_validation->set_rules('email', 	'"Email"', 						'trim|required|valid_email|is_unique[Utilisateur.email]');
		$this->form_validation->set_rules('mdp', 	'"Mot de passe"',				'trim|required|matches[mdp2]');
		$this->form_validation->set_rules('mdp2', 	'"Confirmation mot de passe"', 	'trim|required');
		$this->form_validation->set_rules('role', 	'"Role"', 						'trim|required');

		
		if($this->form_validation->run())
		{
			$this->UtilisateurManager->ajouter_utilisateur(	$this->input->post('nom'),
				$this->input->post('prenom'),
				$this->input->post('email'),
				$this->input->post('mdp'),
				$this->input->post('role'));

			$page = 'confirm_inscrip';
			$data['title'] = ucfirst($page); // Capitalize the first letter
			$data['description'] =  'Confirmation de l\'inscription';
			$this->load->view ('templates/navigation');
			$this->load->view('templates/header', $data);
			$this->load->view('pages/Utilisateur/'.$page, $data);
			$this->load->view('templates/footer', $data);
		}
		else
		{	
			// Retour a la page d'inscription 
			$data['title'] = ucfirst($page); // Capitalize the first letter
			$data['description'] =  'Formulaire d\'inscription';
			$this->load->view ('templates/navigation');
			$this->load->view('templates/header', $data);
			$this->load->view('pages/Utilisateur/'.$page, $data);
			$this->load->view('templates/footer', $data);	

		}  
	}

	public function desinscription($page = 'desinscription')
	{
	}

	public function deconnexion($page = 'deconnexion')
	{
		$this->session->unset_userdata('logged_in');
    	session_destroy();
    	redirect('Accueil/accueil', 'refresh');
	}

	public function mdp_perdu($page = 'mdp_perdu')
	{
		$page = 'mdp_perdu';
		$data['title'] = ucfirst($page); // Capitalize the first letter
		$data['description'] =  'Formulaire pour récupération de son mot de passe';
		$this->load->view ('templates/navigation');
		$this->load->view('templates/header', $data);
		$this->load->view('pages/Utilisateur/'.$page, $data);
		$this->load->view('templates/footer', $data);	
	}

}
?>