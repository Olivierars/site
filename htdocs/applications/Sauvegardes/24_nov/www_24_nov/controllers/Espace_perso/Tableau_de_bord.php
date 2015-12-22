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