<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//session_start(); //we need to call PHP's session object to access it through CI

class Mes_reservations extends CI_Controller {

  // const NB_TRAJET_PAR_PAGE = 2;
  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->helper(array('url','assets','form'));
    $this->load->model('Espace_perso_model','Espace_persoManager');
    $this->load->library('form_validation','pagination');
  }

  public function index($page = 'recherche_trajet')
  {

    $this->recherche_trajet($page);
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
      $data['compteur'] = 0 ; 


      if($this->form_validation->run())
      {  
        $data_profil              = $this->Espace_persoManager->get_profil($data['id']);
        $data['role_rechercheur'] = $data_profil[0]->role;
        $data['ville_depart']     = $this->input->post('ville_depart');
        $data['ville_arrivee']    = $this->input->post('ville_arrivee');
        $data['compteur']         = $this->input->post('compteur') ;
        $data['results']          = $this->Espace_persoManager->rechercher_trajet($data);
        $results = $data['results'] ;
        if(!empty($results))
        {
          $id_posteur  = $results[0]->id_posteur ;
          $data['data_posteur']   = $this->Espace_persoManager->get_profil($id_posteur);
        }
        
      }

      //Pagination
      $this->load->library('pagination');
      $config = array();
      $config["base_url"] = base_url() . "Espace_perso/Mes_reservations/recherche_trajet";
      $config["total_rows"] = 
      $config["per_page"] = 5;
      $config["uri_segment"] = 3;
      $this->pagination->initialize($config);

      // Chargement de la page 
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Rechercher un trajet';
      $data['menu'] = 'mes_reservations' ; 
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/Mes_reservations/'.$page, $data);
      $this->load->view('templates/footer', $data); 
    
  }

  public function postule_trajet($id_trajet)
  {
    if($this->session->userdata('logged_in'))
    {
      $session_data         = $this->session->userdata('logged_in');

      $this->form_validation->set_rules('message','"Message"','required') ;

      if($this->form_validation->run())
      {   
        
        // Création d'un nouveau lien dans la table candidat_vs_trajet
        $data['statut']       = 'attente_confirmation' ;
        $data['id_candidat']  = $session_data['id'];
        $data['id_trajet']    = $id_trajet ;
        $this->Espace_persoManager->postule_trajet($data);

        // Création d'un message dans la table message :
        $data_trajet = $this->Espace_persoManager->get_trajet($id_trajet) ;
        // print_r($data_trajet);
        $date       = strtotime($data_trajet[0]->date_trajet);
        $date_trajet  = date('d/m/y',$date);
        $heure_trajet   = date('H:i',$date);
        $data_message['sujet']    = "Trajet ".$data_trajet[0]->ville_depart." >> ".$data_trajet[0]->ville_arrivee." le ".$date_trajet." à ". $heure_trajet ;
        $data_message['texte']    = $this->input->post('message');
        $data_message['id_exped'] = $session_data['id'];
        $data_message['id_dest']  = $data_trajet[0]->id_posteur ;
        $data_message['id_trajet'] = $id_trajet ;
        $data_message['date_creation'] = date('Y-m-d H:i:s');

        $this->Espace_persoManager->ajouter_message($data_message);
        
        // Affichage de la page de confirmation    
          $page = 'confirm_envoi_message';
          $data['title'] = ucfirst($page); // Capitalize the first letter
          $data['description'] =  'Validation de contact';   
          $data['menu'] = 'mes_reservations' ; 
          $data['id'] = $session_data['id'];
          $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
          $this->load->view('templates/navigation_perso',$data);
          $this->load->view('templates/header', $data);
          $this->load->view('pages/Espace_perso/Messagerie/'.$page, $data);
          $this->load->view('templates/footer', $data);       }
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
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
      $this->load->view('pages/Espace_perso/Mes_reservations/'.$page, $data);
      $this->load->view('templates/footer', $data);
            
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }

  public function en_cours($page = 'en_cours')
  { 
    if($this->session->userdata('logged_in'))
    {
      // Récupération des donnée du compte
      $session_data = $this->session->userdata('logged_in');
      $data['id_candidat']     = $session_data['id'];

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

      // Chargement de la vue 
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Liste de mes réservations en cours';
      $data['menu'] = 'mes_reservations' ; 
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id_candidat']);
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/Mes_reservations/'.$page, $data);
      $this->load->view('templates/footer', $data);
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }

  public function archives($page = 'archives')
  {
    if($this->session->userdata('logged_in'))
    {
      // Récupération des donnée du compte
      $session_data = $this->session->userdata('logged_in');
      $data['id_candidat']     = $session_data['id'];

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

      // Chargement de la vue 
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Liste de mes réservations en cours';
      $data['menu'] = 'mes_reservations' ; 
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id_candidat']);
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/Mes_reservations/'.$page, $data);
      $this->load->view('templates/footer', $data);
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }

  public function annule_reservation($id)
  {
    if($this->session->userdata('logged_in'))
    {

      $this->Espace_persoManager->annuler_reservation($id);
      redirect('Espace_perso/Mes_reservations/attente_confirmation', 'refresh');
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }
  
}