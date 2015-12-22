<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//session_start(); //we need to call PHP's session object to access it through CI

class Mes_formations extends CI_Controller {

  // const NB_TRAJET_PAR_PAGE = 2;
  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->helper(array('url','assets','form'));
    $this->load->model('Espace_perso_model','Espace_persoManager');
    $this->load->library('form_validation','pagination');
  }

  public function index($page = 'recherche_formation')
  {
    $this->recherche_formation($page);
  }

  public function recherche_formation($page='recherche_formation')
  {
    if($this->session->userdata('logged_in'))
    {
      //récupération des données de session
      $session_data   = $this->session->userdata('logged_in');
      $data['email']  = $session_data['email'];
      $data['id']     = $session_data['id'];

      // Chargement de la page 
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Rechercher un trajet';
      $data['menu'] = 'mes_formations' ;
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/Mes_formations/'.$page, $data);
      $this->load->view('templates/footer', $data);

    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }

  }

  public function formation_a_venir($page='formation_valide')
  {
    if($this->session->userdata('logged_in'))
    {
      //récupération des données de session
      $session_data   = $this->session->userdata('logged_in');
      $data['email']  = $session_data['email'];
      $data['id']     = $session_data['id'];

      // Chargement de la page 
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Rechercher un trajet';
      $data['menu'] = 'mes_formations' ;
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/Mes_formations/'.$page, $data);
      $this->load->view('templates/footer', $data);

    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }

  }

  public function formation_archive($page='formation_archive')
  {
    if($this->session->userdata('logged_in'))
    {
      //récupération des données de session
      $session_data   = $this->session->userdata('logged_in');
      $data['email']  = $session_data['email'];
      $data['id']     = $session_data['id'];

      // Chargement de la page 
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Rechercher un trajet';
      $data['menu'] = 'mes_formations' ;
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/Mes_formations/'.$page, $data);
      $this->load->view('templates/footer', $data);

    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }


}