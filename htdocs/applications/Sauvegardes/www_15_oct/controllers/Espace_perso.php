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
      $this->load->view ('templates/navigation_perso',$data);
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
      $data['id'] = $session_data['id'];
      $data_profil= $this->Espace_persoManager->get_profil($data['id_posteur']);
      $data['role'] = $data_profil[0]->role;

      // Vérification du formulaire d'ajout d'un trajet
      $this->form_validation->set_rules('ville_depart','"Ville de départ"','trim|required|min_length[3]');
      $this->form_validation->set_rules('ville_arrivee','"Ville d\'arrivée"','trim|required|min_length[3]');
      $this->form_validation->set_rules('date_trajet','"Date du trajet"','required') ;
      $this->form_validation->set_rules('heure_trajet','"Heure du trajet"','required') ;

      if($this->form_validation->run())
      {   
        // Stockage en bdd du nouveau trajet
        $data                   = array();
        $data['id_posteur']     = $session_data['id'];
        $data_profil            = $this->Espace_persoManager->get_profil($data['id_posteur']);
        $data['role_posteur']   = $data_profil[0]->role;
        $data['ville_depart']   = $this->input->post('ville_depart');
        $data['ville_arrivee']  = $this->input->post('ville_arrivee');
        $data['date_trajet']    = $this->input->post('date_trajet');
        $data['heure_trajet']   = $this->input->post('heure_trajet');
        $data['message']        = $this->input->post('message');
        $data['date_post']      = date('Y-m-d H:i:s');
        $this->Espace_persoManager->ajouter_trajet($data); 
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

      $page = 'propose_trajet';
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Proposer un trajet';
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id_posteur']);
      $this->load->view ('templates/navigation_perso',$data);
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

  public function supprime_trajet($id)
  { 
    if($this->session->userdata('logged_in'))
    {

      $this->Espace_persoManager->supprimer_trajet($id);
      redirect('Espace_perso/propose_trajet', 'refresh');
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }


  public function recherche_trajet($page = 'recherche_trajet')
  {

    // if($this->session->userdata('logged_in'))
    // {
      // récupération des données de session
      $session_data   = $this->session->userdata('logged_in');
      $data['email']  = $session_data['email'];
      $data['id']     = $session_data['id'];

       // Vérification du formulaire d'ajout d'un trajet
      $this->form_validation->set_rules('ville_depart','"Ville de départ"','trim|required|min_length[3]');
      $this->form_validation->set_rules('ville_arrivee','"Ville d\'arrivée"','trim|required|min_length[3]');

      if($this->form_validation->run())
      {  
        $data_profil              = $this->Espace_persoManager->get_profil($data['id']);
        $data['role_rechercheur'] = $data_profil[0]->role;
        $data['ville_depart']     = $this->input->post('ville_depart');
        $data['ville_arrivee']    = $this->input->post('ville_arrivee');
        $data['results']          = $this->Espace_persoManager->rechercher_trajet($data);
        $results = $data['results'] ;
        if(!empty($results))
        {
          $id_posteur  = $results[0]->id_posteur ;
          $data['data_posteur']   = $this->Espace_persoManager->get_profil($id_posteur);
        }
        
      }

      // Pagination
      // $this->load->library('pagination');
      // $config = array();
      // $config["base_url"] = base_url() . "Espace_perso/recherche_trajet";
      // $config["total_rows"] = 
      // $config["per_page"] = 5;
      // $config["uri_segment"] = 3;
      // $this->pagination->initialize($config);

      // Chargement de la page 
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Rechercher un trajet';
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/'.$page, $data);
      $this->load->view('templates/footer', $data); 
    // }
    // else
    // {
    //   //If no session, redirect to login page
    //   redirect('Utilisateur/connexion', 'refresh');
    // }
  }

  public function postule_trajet($id)
  {
    if($this->session->userdata('logged_in'))
    {
      $session_data         = $this->session->userdata('logged_in');
      $data['id_candidat']  = $session_data['id'];
      $data['id_trajet']    = $id ;
      $data['statut']       = 'attente_confirmation' ; 
      $this->Espace_persoManager->postule_trajet($data);
      redirect('Espace_perso/mes_voyages', 'refresh');
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }

  public function mes_voyages($page = 'mes_voyages')
  { 
    if($this->session->userdata('logged_in'))
    {
      // Récupération des donnée du compte
      $session_data = $this->session->userdata('logged_in');
      $data['id_candidat']     = $session_data['id'];
         
      // Récupération des trajets en attente de confirmation
      $data['statut'] = 'attente_confirmation' ; 
      $id_trajet = $this->Espace_persoManager->afficher_trajet($data) ;
      if (!empty($id_trajet))
      {
        $trajet_en_attente    = array();
        $data_posteur_attente = array(); 
        $Nof_trajet = sizeof($id_trajet);
        
        for($i =0;$i<= $Nof_trajet-1 ; $i++ )
        {
          $trajet_en_attente[] = $this->Espace_persoManager->get_trajet($id_trajet[$i]->id_trajet);
          $data_posteur_attente[]      = $this->Espace_persoManager->get_profil($trajet_en_attente[$i][0]->id_posteur);
  
        }

        $data['trajet_en_attente']      = $trajet_en_attente ;
        $data['data_posteur_attente']   = $data_posteur_attente ;
      }

      // Récupération des trajets en attente de confirmation
      $data['statut'] = 'confirme' ; 
      $id_trajet = $this->Espace_persoManager->afficher_trajet($data) ;
      if (!empty($id_trajet))
      {
        $trajet_confirme        = array();
        $data_posteur_confirme   = array(); 
        $Nof_trajet = sizeof($id_trajet);
        
        for($i =0;$i<= $Nof_trajet-1 ; $i++ )
        {
          $trajet_confirme[]        = $this->Espace_persoManager->get_trajet($id_trajet[$i]->id_trajet);
          $data_posteur_confirme[]  = $this->Espace_persoManager->get_profil($trajet_confirme[$i][0]->id_posteur);
  
        }
        $data['trajet_confirme']        = $trajet_confirme ;
        $data['data_posteur_confirme']  = $data_posteur_confirme ; 
      }



      // Chargement de la vue 
       
      
        
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Liste de mes trajets';
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id_candidat']);
      $this->load->view ('templates/navigation_perso',$data);
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
      $session_data   = $this->session->userdata('logged_in');
      $data['email']  = $session_data['email'];
      $data['id']     = $session_data['id'];
      

      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Messagerie personnel en ligne';
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
      $this->load->view ('templates/navigation_perso',$data);
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