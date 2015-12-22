<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//session_start(); //we need to call PHP's session object to access it through CI

class Trajet extends CI_Controller {

  // const NB_TRAJET_PAR_PAGE = 2;
  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->helper(array('url','assets','form'));
    $this->load->model('Espace_perso_model','Espace_persoManager');
    $this->load->library('form_validation','pagination');
  }

  public function index($id)
  {

    $this->trajet($id);
  }


  public function trajet($id)
  {
    if($this->session->userdata('logged_in'))
    {
      $session_data         = $this->session->userdata('logged_in');
      $data['id_candidat']  = $session_data['id'];
      $data['id_trajet']    = $id ;



      // Chargement de la page 
      $page = 'trajet';
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Détail du trajet';
      $data['data_trajet'] = $this->Espace_persoManager->get_trajet($data['id_trajet']);
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id_candidat']);
      $id_posteur = $data['data_trajet'][0]->id_posteur;
      $data['data_posteur'] =  $this->Espace_persoManager->get_profil($id_posteur);
      $data['menu'] = 'mes_reservations' ; 
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/Trajet/'.$page, $data);
      $this->load->view('templates/footer', $data);
            
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }

  }