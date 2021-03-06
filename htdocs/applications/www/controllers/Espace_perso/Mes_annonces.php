<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//session_start(); //we need to call PHP's session object to access it through CI

class Mes_annonces extends CI_Controller {

  // const NB_TRAJET_PAR_PAGE = 2;
  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->helper(array('url','assets','form'));
    $this->load->model('Espace_perso_model','Espace_persoManager');
    $this->load->library('form_validation','pagination');
  }

  public function index($page = 'profil')
  {
    $this->propose_trajet();
  }

  public function propose_trajet($g_nb_trajet = 1)
  { 
    if($this->session->userdata('logged_in'))
    {
      // Récupération des donnée du compte
      $session_data 		= $this->session->userdata('logged_in');
      $data['id_posteur']   = $session_data['id'];
      $data['id'] 			= $session_data['id'];
      $data_profil			= $this->Espace_persoManager->get_profil($data['id_posteur']);
      $data['role'] 		= $data_profil[0]->role;

      // Vérification du formulaire d'ajout d'un trajet
      $this->form_validation->set_rules('ville_depart','"Ville de départ"','trim|required|min_length[3]');
      $this->form_validation->set_rules('ville_arrivee','"Ville d\'arrivée"','trim|required|min_length[3]');
      $this->form_validation->set_rules('date_trajet','"Date du trajet"','required') ;
      $this->form_validation->set_rules('heure_trajet','"Heure du trajet"','required') ;

      if($this->form_validation->run())
      {   
        // Stockage en bdd du nouveau trajet
        // print_r($this->input->post());
        $data                   = array();
        $data['id_posteur']     = $session_data['id'];
        $data_profil            = $this->Espace_persoManager->get_profil($data['id_posteur']);
        $data['role_posteur']   = $data_profil[0]->role;
        $data['ville_depart']   = $this->input->post('ville_depart');
        $data['ville_arrivee']  = $this->input->post('ville_arrivee');
        $date_trajet    		    = $this->input->post('date_trajet');
        $heure_trajet   		    = $this->input->post('heure_trajet');
        $data['date_trajet']  	= $date_trajet." ".$heure_trajet;
        $data['message']        = $this->input->post('message');
        $data['date_post']      = date('Y-m-d H:i:s');
        $this->Espace_persoManager->ajouter_trajet($data); 
        redirect('Espace_perso/Mes_annonces/a_venir', 'refresh');
      }
      
      $page = 'propose_trajet';
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['menu'] = 'mes_annonces' ; 
      $data['description'] = 'Proposer un trajet';
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id_posteur']);
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/Mes_annonces/'.$page, $data);
      $this->load->view('templates/footer', $data);   
      
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }

  public function a_venir($page='a_venir')
  { 
    if($this->session->userdata('logged_in'))
    {
		// Récupération des donnée du compte
		$session_data = $this->session->userdata('logged_in');
		$data['id_posteur']     = $session_data['id'];
    $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id_posteur']);

		// Pagination 
		// $this->load->library('pagination');
		// $config = array();
		// $config["base_url"] = base_url() . "Espace_perso/Mes_annonces/propose_trajet";
		// $config["total_rows"] = $this->Espace_persoManager->compter_trajet_perso($data['id_posteur']);
		// $config["per_page"] = 5;
		// $config["uri_segment"] = 3;
		// $this->pagination->initialize($config);
		// $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    // $data["links"] = $this->pagination->create_links();


		$data["results"] = $this->Espace_persoManager->voir_trajet_perso($data['id_posteur']);//,$config["per_page"], $page);

    $Nof_trajet = sizeof($data["results"]);
    $Nof_candidats = array();

    for($i = 0 ; $i < $Nof_trajet ; $i ++)
    { 
      $data['results'][$i]->data_trajet   = $this->Espace_persoManager->get_trajet($data['results'][$i]->id);
      $data['results'][$i]->Nof_candidats = $this->Espace_persoManager->get_nbre_candidat($data['results'][$i]->id);
      $data['results'][$i]->ids_candidats = $this->Espace_persoManager->get_ids_candidat($data['results'][$i]->id);
      
      for($j = 0 ; $j<$data['results'][$i]->Nof_candidats ; $j++)
      {
        $data['data_profil_public'][$j] = $this->Espace_persoManager->get_profil($data['results'][$i]->ids_candidats[$j]->id_candidat);
      }

    }

		$data['title'] = ucfirst($page); // Capitalize the first letter
		$data['description'] = 'Proposition de trajet a venir';
    $data['menu'] = 'mes_annonces' ; 
		$this->load->view ('templates/navigation_perso',$data);
		$this->load->view('templates/header', $data);
		$this->load->view('pages/Espace_perso/Mes_annonces/'.$page, $data);
		$this->load->view('templates/footer', $data);   

    }
    else
    {
      	redirect('Utilisateur/connexion', 'refresh');
    }
  }

  public function archives($page = 'archives')
  { 
    if($this->session->userdata('logged_in'))
    {
    	// Récupération des donnée du compte
    	$session_data = $this->session->userdata('logged_in');
    	$data['id_posteur']     = $session_data['id'];
    	$data_profil= $this->Espace_persoManager->get_profil($data['id_posteur']);
    	$data['role'] = $data_profil[0]->role;

		  // Pagination 
    	// $this->load->library('pagination');
    	// $config = array();
    	// $config["base_url"] = base_url() . "Espace_perso/Mes_annonces/propose_trajet";
    	// $config["total_rows"] = $this->Espace_persoManager->compter_trajet_perso($data['id_posteur']);
    	// $config["per_page"] = 5;
    	// $config["uri_segment"] = 3;
     // 	$this->pagination->initialize($config);

    	// $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    	$data["results"] = $this->Espace_persoManager->voir_trajet_perso($data['id_posteur']);//,$config["per_page"], $page);
    	// $data["links"] = $this->pagination->create_links();

    	$data['title'] = ucfirst($page); // Capitalize the first letter
    	$data['description'] = 'Proposition de trajet archivées';
    	$data['data_profil'] = $this->Espace_persoManager->get_profil($data['id_posteur']);
      $data['menu'] = 'mes_annonces' ; 
    	$this->load->view ('templates/navigation_perso',$data);
    	$this->load->view('templates/header', $data);
    	$this->load->view('pages/Espace_perso/Mes_annonces/'.$page, $data);
    	$this->load->view('templates/footer', $data);   
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }





  public function supprime_trajet($id)
  { 
    if($this->session->userdata('logged_in'))
    {

      $this->Espace_persoManager->supprimer_trajet($id);
      redirect('Espace_perso/Mes_annonces/a_venir', 'refresh');
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }

}
