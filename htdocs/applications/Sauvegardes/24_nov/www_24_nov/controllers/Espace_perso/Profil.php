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

  public function index($page = 'mon_profil')
  {
    $this->mon_profil($page);
  }

  public function mon_profil($page = 'mon_profil')
  {
    $session_data   = $this->session->userdata('logged_in');
    $data['email']  = $session_data['email'];
    $data['id']     = $session_data['id'];
    
    $data['title'] = ucfirst($page); // Capitalize the first letter
    $data['description'] = 'Profil personnel';
    $data['menu'] = 'profil' ; 
    $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
    $this->load->view ('templates/navigation_perso',$data);
    $this->load->view('templates/header', $data);
    $this->load->view('pages/Espace_perso/Profil/'.$page, $data);
    $this->load->view('templates/footer', $data); 
    
  }

  public function modif_profil($page = 'modif_profil')
  {
    $session_data   = $this->session->userdata('logged_in');
    $data['email']  = $session_data['email'];
    $data['id']     = $session_data['id'];
    
    
    // Vérification du formulaire de modification des donnees du profil 
      $this->form_validation->set_rules('prenom','"Prenom"','trim|required|min_length[3]');
      $this->form_validation->set_rules('nom','"Nom"','trim|required|min_length[3]');
      $this->form_validation->set_rules('email','"Adresse email"','required') ;
      $this->form_validation->set_rules('texte_pres','"Texte de présentation"','required') ;

      if($this->form_validation->run())
      {   

        $donnes_form = $this->input->post();
        $data = json_encode($donnes_form['type_handi']) ; 
        $donnes_form['type_handi']= $data; 

        // Stockage des modif en BDD
        $donnes_form['id'] = $session_data['id'];
        $this->Espace_persoManager->modif_profil($donnes_form); 
      }

    redirect('Espace_perso/Profil/mon_profil', 'refresh');
    
  }

  public function photo_profil($page = 'photo_profil')
  {
    $session_data   = $this->session->userdata('logged_in');
    $data['email']  = $session_data['email'];
    $data['id']     = $session_data['id'];

    $data['title'] = ucfirst($page); // Capitalize the first letter
    $data['description'] = 'Photo de profil';
    $data['menu'] = 'profil' ; 
    $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
    $this->load->view ('templates/navigation_perso',$data);
    $this->load->view('templates/header', $data);
    $this->load->view('pages/Espace_perso/Profil/'.$page, array('error' => ' ' ));
    $this->load->view('templates/footer', $data); 
    
  }

  public function do_upload()
  {
    $session_data   = $this->session->userdata('logged_in');
    $data['email']  = $session_data['email'];
    $data['id']     = $session_data['id'];

    $config['upload_path']    = '../assets/images/photos_profil';
    $config['allowed_types']  = 'gif|jpg|png|pdf';
    $config['max_size']       = '100';
    $config['max_width']      = '1024';
    $config['max_height']     = '768';
    $config['file_name']      = 'photo_profil_'.$data['id'] ; 
    $config['overwrite']      = TRUE ; 


    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload())
    {
    
      $error = array('error' => $this->upload->display_errors());

      $page = 'photo_profil';
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Photo de profil';
      $data['menu'] = 'profil' ; 
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/Profil/'.$page, $error);
      $this->load->view('templates/footer', $data); 
    
    }
    else
    {

      $data = array('upload_data' => $this->upload->data());

      $page = 'upload_success';
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Photo de profil chargée avec succes';
      $data['menu'] = 'profil' ; 
      $data['id']     = $session_data['id'];
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/Profil/'.$page, $data);
      $this->load->view('templates/footer', $data);
    }

  }


}