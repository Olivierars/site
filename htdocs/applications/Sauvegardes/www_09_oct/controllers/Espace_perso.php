<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//session_start(); //we need to call PHP's session object to access it through CI

class Espace_perso extends CI_Controller {

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

  public function profil($page = 'profil')    
  {

    if($this->session->userdata('logged_in')) 
    {
      $session_data = $this->session->userdata('logged_in');
      $data['email'] = $session_data['email'];
      $data['id'] = $session_data['id'];
      
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);

      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Espace personnel pour chaque membre';
      $this->load->view ('templates/navigation_perso');
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/'.$page, $data);
      $this->load->view('templates/footer', $data);
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }

  public function propose_trajet($g_nb_trajet = 1)
  { 
    if($this->session->userdata('logged_in'))
    {
      // Récupération des donnée du compte
      $session_data = $this->session->userdata('logged_in');
      $data['id_posteur']     = $session_data['id'];


      // Vérification du formulaire d'ajout d'un trajet
      $this->form_validation->set_rules('ville_depart','"Ville de départ"','trim|required|min_length[3]');
      $this->form_validation->set_rules('ville_arrivee','"Ville d\'arrivée"','trim|required|min_length[3]');
      $this->form_validation->set_rules('date_trajet','"Date du trajet"','required') ;
      $this->form_validation->set_rules('heure_trajet','"Heure du trajet"','required') ;

      if($this->form_validation->run())
      {   
        // Stockage en bdd du nouveau trajet
        $data                   =array();
        $data['id_posteur']     = $session_data['id'];
        $data['ville_depart']   = $this->input->post('ville_depart');
        $data['ville_arrivee']  = $this->input->post('ville_arrivee');
        $data['date_trajet']    = $this->input->post('date_trajet');
        $date['heure_trajet']   = strtotime($this->input->post('heure_trajet'));
        $data['date_post']      = date('Y-m-d H:i:s');
      }
      
      
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = base_url() . "Espace_perso/propose_trajet";
        $config["total_rows"] = $this->Espace_persoManager->compter_trajet_perso($data['id_posteur']);
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Espace_persoManager->voir_trajet_perso($data['id_posteur'],$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        // $data['description'] = 'Mes trajets';
        // $this->load->view ('templates/navigation_perso');
        // $this->load->view('templates/header', $data);
        // $this->load->view("pages/Espace_perso/mes_trajets", $data);
        // $this->load->view('templates/footer', $data);

      
      

      // $this->load->library('pagination');

      // $data = array();
      
      // $data['id_posteur'] = $session_data['id'];
      // $data['email'] = $session_data['email'];
      // $nb_trajet_total = $this->Espace_persoManager->compter_trajet_perso($data['id_posteur']);

      // if($g_nb_trajet > 1)
      // {
      //   if($g_nb_trajet <= $nb_trajet_total)
      //   {
      //     $nb_trajet = intval($g_nb_trajet);
      //   }
      //   else{ 
      //     $nb_trajet = 1;
      //   }
      // }
      // else
      // {
      //   $nb_trajet = 1;
      // } 


      // //Mise en place de la pagination
      // $this->pagination->initialize(array('base_url' => base_url() . 'Espace_perso/propose_trajet/',
      //   'total_rows' => $nb_trajet_total,
      //   'per_page' => self::NB_TRAJET_PAR_PAGE,
      //   'uri_segment'=>3)); 
      
      // $data['pagination'] = $this->pagination->create_links();


      // $data['nb_trajets'] = $nb_trajet_total;
      // $data['trajets'] = $this->Espace_persoManager->voir_trajet_perso($data['id_posteur'],self::NB_TRAJET_PAR_PAGE, $nb_trajet-1);
      $page = 'propose_trajet';
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Proposer un trajet';
      
      $this->load->view ('templates/navigation_perso');
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/'.$page, $data);
      $this->load->view('templates/footer', $data);   
      
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }
  
  public function liste_trajet()
  {
     if($this->session->userdata('logged_in'))
    {
      $session_data   = $this->session->userdata('logged_in');
      $id_posteur     = $session_data['id'];


      $this->load->library('pagination');
      $config = array();
      $config["base_url"] = base_url() . "Espace_perso/liste_trajet";
      $config["total_rows"] = $this->Espace_persoManager->compter_trajet_perso($id_posteur);
      $config["per_page"] = 20;
      $config["uri_segment"] = 3;
      $this->pagination->initialize($config);

      $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      $data["results"] = $this->Espace_persoManager->voir_trajet_perso($id_posteur,$config["per_page"], $page);
      $data["links"] = $this->pagination->create_links();

      $data['description'] = 'Mes trajets';
      $this->load->view ('templates/navigation_perso');
      $this->load->view('templates/header', $data);
      $this->load->view("pages/Espace_perso/mes_trajets", $data);
      $this->load->view('templates/footer', $data);


    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }

  public function recherche_trajet($page = 'recherche_trajet')
  {

    if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      $data['email'] = $session_data['email'];

      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Rechercher un trajet';
      $this->load->view ('templates/navigation_perso');
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/'.$page, $data);
      $this->load->view('templates/footer', $data); 
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }

  public function messagerie($page = 'messagerie')
  {

    if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      $data['email'] = $session_data['email'];

      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Messagerie personnel en ligne';
      $this->load->view ('templates/navigation_perso');
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/'.$page, $data);
      $this->load->view('templates/footer', $data); 
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }

}

?>