<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//session_start(); //we need to call PHP's session object to access it through CI

class Profil extends CI_Controller {

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
    $this->profil($page);
  }

}