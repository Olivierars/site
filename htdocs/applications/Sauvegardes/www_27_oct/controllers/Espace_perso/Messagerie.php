<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//session_start(); //we need to call PHP's session object to access it through CI

class Messagerie extends CI_Controller {

  // const NB_TRAJET_PAR_PAGE = 2;
  public function __construct()
  {
    parent::__construct();

    $this->load->database();
    $this->load->helper(array('url','assets','form'));
    $this->load->model('Espace_perso_model','Espace_persoManager');
    $this->load->library('form_validation','pagination');
  }

  public function index($page = 'messages_en_cours')
  {
    $this->messages_en_cours($page);
  }

  public function messages_en_cours($page = 'messages_en_cours')
  {

    if($this->session->userdata('logged_in'))
    {
      $session_data   = $this->session->userdata('logged_in');
      $data['email']  = $session_data['email'];
      $data['id']     = $session_data['id'];

      // Obtention des id trajet  du candidat (si expéditeur ou destinataire)
      $liste_id_trajet_brute = $this->Espace_persoManager->get_id_trajet_messages($data['id']);
      $Nof_trajet_temp = sizeof($liste_id_trajet_brute);
      $liste_id_trajet_temp = array();
      $data_trajet_temp = array();
      for($k=0 ; $k < $Nof_trajet_temp ; $k++)
      {
        if(!in_array($liste_id_trajet_brute[$k]->id_trajet, $liste_id_trajet_temp))
        {
          $liste_id_trajet_temp[] = $liste_id_trajet_brute[$k]->id_trajet;
          $data_trajet_temp[] = $this->Espace_persoManager->get_trajet($liste_id_trajet_brute[$k]->id_trajet) ;
        }
      }
      $liste_id_trajet  = $liste_id_trajet_temp;
      $data_trajet      = $data_trajet_temp ;

             
      $Nof_trajet       = sizeof($liste_id_trajet);

      // Vecteur de stockage des introlocuteurs et message pour chaque trajet 
      $liste_id_interloc  = array();
      $data_interloc      = array();
      $liste_id_messages  = array();
      $data_messages      = array();

      // Boucle sur tous les trajets auquel je fais parti pour récupérer les interlocuteurs
      for($i = 0 ; $i <= $Nof_trajet-1 ; $i++)
      {
        // Récupération des interlocuteurs de ces trajets
        $liste_id_interloc_brute = $this->Espace_persoManager->get_id_interloc_messages($liste_id_trajet[$i],$data['id']);
        $Nof_interloc_brut = sizeof($liste_id_interloc_brute);
        // print_r($liste_id_interloc_brute);
        $liste_id_interloc_temp = array();
        $data_interloc_temp     = array();

        // Boucle sur tous les interlocuteurs 
        for($m = 0 ; $m <= $Nof_interloc_brut-1; $m++)
        {
          if($liste_id_interloc_brute[$m]->id_exped == $data['id'] AND !in_array($liste_id_interloc_brute[$m]->id_dest, $liste_id_interloc_temp) ) 
          {
            $liste_id_interloc_temp[] =  $liste_id_interloc_brute[$m]->id_dest ;
            $data_interloc_temp[]     = $this->Espace_persoManager->get_profil($liste_id_interloc_brute[$m]->id_dest);

          }
          if($liste_id_interloc_brute[$m]->id_dest == $data['id'] AND !in_array($liste_id_interloc_brute[$m]->id_exped, $liste_id_interloc_temp) ) 
          {
            $liste_id_interloc_temp[] =  $liste_id_interloc_brute[$m]->id_exped ; 
            $data_interloc_temp[]     = $this->Espace_persoManager->get_profil($liste_id_interloc_brute[$m]->id_exped);

          }

        }

        // stockage de la liste $i des interlociteurs du trajet #i
        $liste_id_interloc[$i]  = $liste_id_interloc_temp;
        $data_interloc[$i]      = $data_interloc_temp ;
        
        $Nof_interloc = sizeof($liste_id_interloc[$i]);

        // Boucle sur les interlocuteurs du trajet #i pour récupérer les messages 
        for($j = 0 ; $j <= $Nof_interloc-1 ; $j++)
        {   
          
          $liste_id_messages_brute = $this->Espace_persoManager->get_id_messages($liste_id_trajet[$i],$liste_id_interloc[$i][$j],$data['id']);
          
          $Nof_message_brut = sizeof($liste_id_messages_brute);
          $liste_id_messages_temp = array();
          $data_message_temp      = array();

          // boucle sur tous les messages de l'interlocuteurs #j du trajet #i 
          for($k = 0 ; $k <= $Nof_message_brut-1 ; $k++)
          {
            if(!in_array($liste_id_messages_brute[$k]->id, $liste_id_messages_temp))
            {
              $liste_id_messages_temp[] = $liste_id_messages_brute[$k]->id ;
              $data_message_temp[]      = $this->Espace_persoManager->get_messages( $liste_id_messages_brute[$k]->id );
              
            }
          }  

          $liste_id_messages[$i][$j]  = $liste_id_messages_temp;
          $data_message[$i][$j]       = $data_message_temp ;  

          
        }
      }
      // echo "<br> TRajet # " ;
      // print_r($liste_id_trajet);
      // echo "<br>";
      // print_r($data_trajet);
      // echo "<br>";
      // echo "<br>";

      // echo "<br> interlocuteurs de ce trajet " ;
      // print_r($liste_id_interloc);
      // echo "<br>";
      // echo "<br>";

      // print_r($data_interloc);
      // echo "<br>";
      // echo "<br>";

      // echo "<br> messages de ces interlocutteurs " ; 
      // print_r($liste_id_messages);
      // echo "<br>";
      // print_r($data_message);



      // Chargement de le page html
      $data['liste_id_trajet'] = $liste_id_trajet;
      $data['liste_id_interloc'] = $liste_id_interloc ;
      $data['liste_id_messages'] = $liste_id_messages ;
      $data['data_trajet'] = $data_trajet ;
      $data['data_interloc'] = $data_interloc ;
      $data['data_message'] = $data_message ;
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Messages en cours';
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/Messagerie/'.$page, $data);
      $this->load->view('templates/footer', $data); 
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    }
  }

   public function messages_archives($page = 'messages_archives')
  {

    
  }

  public function repondre()
  {

    if($this->session->userdata('logged_in'))
    {
      $session_data     = $this->session->userdata('logged_in');
      $data['email']    = $session_data['email'];
      $data['id']       = $session_data['id'];
      
      // $indice_trajet    = $this->input->post('indice_trajet');
      // $indice_interloc  = $this->input->post('indice_interloc');

      $data_post       = $this->input->post() ;
      print_r($data_post);
      // print_r($id);
      // $nof_interloc     = $this->input->post('nof_interloc') ;

      // Récupération des données
      // for($i=0 ; $i<=$nof_trajet ; $i++)
      // {
        // print_r($this->input->post());
        // print_r("Interlocuteur ".$indice_interloc);
        // print_r("Trajet".$indice_trajet);
        // print_r($indice);
        // print_r($_POST["btn".$indice_trajet.$indice_interloc]);


        for ($indice_trajet = 0 ; $indice_trajet <= $nof_trajet ;  $indice_trajet++ )
        {
          for($indice_interloc = 0 ; $indice_interloc <= $nof_interloc ; $indice_trajet++)
          {
            if (!empty($_POST["btn".$indice_trajet.$indice_interloc]))
            { 
            $data_message['date_creation'] = date('Y-m-d H:i:s');
            $data_message['sujet'] = $this->input->post('sujet'.$indice_trajet.$indice_interloc);
            $data_message['texte'] = $this->input->post('message'.$indice_trajet.$indice_interloc);
            $data_message['id_exped'] = $this->input->post('id_exped'.$indice_trajet.$indice_interloc);
            $data_message['id_dest'] = $this->input->post('id_dest'.$indice_trajet.$indice_interloc);
            $data_message['id_trajet'] = $this->input->post('id_trajet'.$indice_trajet.$indice_interloc); 
            print_r($data_message) ;
            
            $this->Espace_persoManager->ajouter_message($data_message);

            // redirect('Espace_perso/Messagerie/messages_en_cours', 'refresh');
            }
          }
        }
        
      // } 
      
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    } 
  }


  public function confirm_envoi_message($page = 'confirm_envoi_message')
  {

    if($this->session->userdata('logged_in'))
    {
      $session_data   = $this->session->userdata('logged_in');
      $data['email']  = $session_data['email'];
      $data['id']     = $session_data['id'];
      

      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Confirmation d\'envoi de massage';
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
      $this->load->view ('templates/navigation_perso',$data);
      $this->load->view('templates/header', $data);
      $this->load->view('pages/Espace_perso/Messagerie/'.$page, $data);
      $this->load->view('templates/footer', $data); 
      
    }
    else
    {
      //If no session, redirect to login page
      redirect('Utilisateur/connexion', 'refresh');
    } 
  }
}