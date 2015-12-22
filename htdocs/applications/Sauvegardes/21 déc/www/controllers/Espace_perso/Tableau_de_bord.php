<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//session_start(); //we need to call PHP's session object to access it through CI

class Tableau_de_bord extends CI_Controller {

  // const NB_TRAJET_PAR_PAGE = 2;
  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->helper(array('url','assets','form'));
    $this->load->model('Espace_perso_model','Espace_persoManager');
    $this->load->library('form_validation','pagination');
  }

  public function index($page = 'tableau_de_bord')
  {
    if($this->session->userdata('logged_in')) 
    {
      $session_data = $this->session->userdata('logged_in');
      $data['email'] = $session_data['email'];
      $data['id'] = $session_data['id'];

      // Gestion du paragraphe "demandes accomagnement récentes"
      $data_profil= $this->Espace_persoManager->get_profil($data['id']);
      $data['role'] = $data_profil[0]->role;
      $data["results"] = $this->Espace_persoManager->voir_trajet_perso($data['id']);//,$config["per_page"], $page);
        
      // Gestion du paragraphe "accompagnement récents"
      $data['id_candidat']     = $data['id'];
      $ids_trajet  = $this->Espace_persoManager->afficher_trajet($data) ;

      if (!empty($ids_trajet))
      {
        $trajet        = array();
        $data_posteur  = array(); 
        $id_resa       = array() ;
        $statut        = array();
        $Nof_trajet = sizeof($ids_trajet);
        
        for($i =0;$i<= $Nof_trajet-1 ; $i++ )
        {
          $trajet[]       = $this->Espace_persoManager->get_trajet($ids_trajet[$i]->id_trajet);
          $data_posteur[] = $this->Espace_persoManager->get_profil($trajet[$i][0]->id_posteur);
          $id_resa[]      = $ids_trajet[$i]->id ; 
          $statut[]       = $ids_trajet[$i]->statut ; 

        }
        $data['trajet']        = $trajet ;
        $data['data_posteur']  = $data_posteur ;
        $data['id_resa']       = $id_resa;
        $data['statut']        = $statut ; 
      }

      // Chargement de la page
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Espace personnel pour chaque membre';
      $data['menu'] = 'tableau_de_bord' ;
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/Tableau_de_bord/'.$page, $data);
      $this->load->view('templates/footer', $data);
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }
}