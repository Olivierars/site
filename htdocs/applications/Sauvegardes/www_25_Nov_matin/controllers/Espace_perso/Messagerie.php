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

      // Obtention des id interlocuteur du candidat
      $liste_id_interloc_brute = $this->Espace_persoManager->get_id_interloc_messages($data['id']);
      $Nof_interloc_brut = sizeof($liste_id_interloc_brute);
      $liste_id_interloc_temp = array();
      $data_interloc_temp     = array();

      for($k=0 ; $k < $Nof_interloc_brut ; $k++)
      {
        if($liste_id_interloc_brute[$k]->id_exped == $data['id'] AND !in_array($liste_id_interloc_brute[$k]->id_dest, $liste_id_interloc_temp) ) 
        {
          $liste_id_interloc_temp[] =  $liste_id_interloc_brute[$k]->id_dest ;
          $data_interloc_temp[]     = $this->Espace_persoManager->get_profil($liste_id_interloc_brute[$k]->id_dest);
        }
        if($liste_id_interloc_brute[$k]->id_dest == $data['id'] AND !in_array($liste_id_interloc_brute[$k]->id_exped, $liste_id_interloc_temp) ) 
        {
          $liste_id_interloc_temp[] =  $liste_id_interloc_brute[$k]->id_exped ; 
          $data_interloc_temp[]     = $this->Espace_persoManager->get_profil($liste_id_interloc_brute[$k]->id_exped);
        }
      }
      
      // Stockage de la liste des interlocuteurs 
      $liste_id_interloc  = $liste_id_interloc_temp;
      $data_interloc      = $data_interloc_temp ;
      
      $Nof_interloc = sizeof($liste_id_interloc);

      // Vecteur de stockage des trajets et message pour chaque interlocuteurs 
      $liste_id_trajet  = array();
      $data_trajet      = array();
      $liste_id_messages  = array();
      $data_messages      = array();

      // Boucle sur tous les interlocuteurs avec qui j'achange pour récupérer les trajets
      for($i = 0 ; $i <= $Nof_interloc-1 ; $i++)
      {
        // Obtention des id trajet de chaque interlocuteur
        $liste_id_trajet_brute = $this->Espace_persoManager->get_id_trajet_messages($data['id'],$liste_id_interloc[$i]);
        $Nof_trajet_temp = sizeof($liste_id_trajet_brute);
        $liste_id_trajet_temp = array();
        $data_trajet_temp     = array();

        // Boucle sur tous les trajets 
        for($m = 0 ; $m <= $Nof_trajet_temp-1; $m++)
        {
          if(!in_array($liste_id_trajet_brute[$m]->id_trajet, $liste_id_trajet_temp))
          {
            $liste_id_trajet_temp[] = $liste_id_trajet_brute[$m]->id_trajet;
            $data_trajet_temp[] = $this->Espace_persoManager->get_trajet($liste_id_trajet_brute[$m]->id_trajet) ;
          }

        }

        // stockage de la liste des trajets de l'interlocuteur #i 
        $liste_id_trajet[$i]  = $liste_id_trajet_temp;
        $data_trajet[$i]      = $data_trajet_temp ;
         
        $Nof_trajet       = sizeof($liste_id_trajet[$i]);
        

        // Boucle sur les trajets de l'interlocuteur #i pour récupérer les messages 
        for($j = 0 ; $j <= $Nof_trajet-1 ; $j++)
        {   
          
          $liste_id_messages_brute = $this->Espace_persoManager->get_id_messages($data['id'],$liste_id_interloc[$i],$liste_id_trajet[$i][$j]);
          
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
      // echo "<br> interlocuteurs de ce trajet " ;
      // echo "<br> TRajet # " ;
      // print_r($liste_id_interloc);
      // echo "<br>";
      // print_r($data_interloc);
      // echo "<br>";
      // echo "<br>";

      // echo "<br> TRajet " ;
      // print_r($liste_id_trajet);
      // echo "<br>";
      // echo "<br>";

      // print_r($data_trajet);
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
      $data['menu'] = 'messagerie' ; 
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

    if($this->session->userdata('logged_in'))
    {
      $session_data   = $this->session->userdata('logged_in');
      $data['email']  = $session_data['email'];
      $data['id']     = $session_data['id'];

      // Obtention des id interlocuteur du candidat
      $liste_id_interloc_brute = $this->Espace_persoManager->get_id_interloc_messages($data['id']);
      $Nof_interloc_brut = sizeof($liste_id_interloc_brute);
      $liste_id_interloc_temp = array();
      $data_interloc_temp     = array();

      for($k=0 ; $k < $Nof_interloc_brut ; $k++)
      {
        if($liste_id_interloc_brute[$k]->id_exped == $data['id'] AND !in_array($liste_id_interloc_brute[$k]->id_dest, $liste_id_interloc_temp) ) 
        {
          $liste_id_interloc_temp[] =  $liste_id_interloc_brute[$k]->id_dest ;
          $data_interloc_temp[]     = $this->Espace_persoManager->get_profil($liste_id_interloc_brute[$k]->id_dest);
        }
        if($liste_id_interloc_brute[$k]->id_dest == $data['id'] AND !in_array($liste_id_interloc_brute[$k]->id_exped, $liste_id_interloc_temp) ) 
        {
          $liste_id_interloc_temp[] =  $liste_id_interloc_brute[$k]->id_exped ; 
          $data_interloc_temp[]     = $this->Espace_persoManager->get_profil($liste_id_interloc_brute[$k]->id_exped);
        }
      }
      
      // Stockage de la liste des interlocuteurs 
      $liste_id_interloc  = $liste_id_interloc_temp;
      $data_interloc      = $data_interloc_temp ;
      
      $Nof_interloc = sizeof($liste_id_interloc);

      // Vecteur de stockage des trajets et message pour chaque interlocuteurs 
      $liste_id_trajet  = array();
      $data_trajet      = array();
      $liste_id_messages  = array();
      $data_messages      = array();

      // Boucle sur tous les interlocuteurs avec qui j'achange pour récupérer les trajets
      for($i = 0 ; $i <= $Nof_interloc-1 ; $i++)
      {
        // Obtention des id trajet de chaque interlocuteur
        $liste_id_trajet_brute = $this->Espace_persoManager->get_id_trajet_messages($data['id'],$liste_id_interloc[$i]);
        $Nof_trajet_temp = sizeof($liste_id_trajet_brute);
        $liste_id_trajet_temp = array();
        $data_trajet_temp     = array();

        // Boucle sur tous les trajets 
        for($m = 0 ; $m <= $Nof_trajet_temp-1; $m++)
        {
          if(!in_array($liste_id_trajet_brute[$m]->id_trajet, $liste_id_trajet_temp))
          {
            $liste_id_trajet_temp[] = $liste_id_trajet_brute[$m]->id_trajet;
            $data_trajet_temp[] = $this->Espace_persoManager->get_trajet($liste_id_trajet_brute[$m]->id_trajet) ;
          }

        }

        // stockage de la liste des trajets de l'interlocuteur #i 
        $liste_id_trajet[$i]  = $liste_id_trajet_temp;
        $data_trajet[$i]      = $data_trajet_temp ;
         
        $Nof_trajet       = sizeof($liste_id_trajet[$i]);
        

        // Boucle sur les trajets de l'interlocuteur #i pour récupérer les messages 
        for($j = 0 ; $j <= $Nof_trajet-1 ; $j++)
        {   
          
          $liste_id_messages_brute = $this->Espace_persoManager->get_id_messages($data['id'],$liste_id_interloc[$i],$liste_id_trajet[$i][$j]);
          
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
      // echo "<br> interlocuteurs de ce trajet " ;
      // echo "<br> TRajet # " ;
      // print_r($liste_id_interloc);
      // echo "<br>";
      // print_r($data_interloc);
      // echo "<br>";
      // echo "<br>";

      // echo "<br> TRajet " ;
      // print_r($liste_id_trajet);
      // echo "<br>";
      // echo "<br>";

      // print_r($data_trajet);
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
      $data['menu'] = 'messagerie' ;
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

   public function conversation($id_interloc)
  {

    if($this->session->userdata('logged_in'))
    {
      $session_data   = $this->session->userdata('logged_in');
      $data['email']  = $session_data['email'];
      $data['id']     = $session_data['id'];

      // Obtention des id trajet de chaque interlocuteur
      $liste_id_trajet_brute = $this->Espace_persoManager->get_id_trajet_messages($data['id'],$id_interloc);
      $Nof_trajet_temp = sizeof($liste_id_trajet_brute);
      $liste_id_trajet_temp = array();
      $data_trajet_temp     = array();

      // Boucle sur tous les trajets pour stockage sans doublon et obtention des data des trajets 
      for($m = 0 ; $m <= $Nof_trajet_temp-1; $m++)
      {
        if(!in_array($liste_id_trajet_brute[$m]->id_trajet, $liste_id_trajet_temp))
        {
          $liste_id_trajet_temp[] = $liste_id_trajet_brute[$m]->id_trajet;
          $data_trajet_temp[] = $this->Espace_persoManager->get_trajet($liste_id_trajet_brute[$m]->id_trajet) ;
        }
      }

      // stockage de la liste des trajets de l'interlocuteur 
      $liste_id_trajet  = $liste_id_trajet_temp;
      $data_trajet      = $data_trajet_temp ;
      $Nof_trajet       = sizeof($liste_id_trajet);
      
      // Boucle sur les trajets de l'interlocuteur pour récupérer les messages 
      for($j = 0 ; $j <= $Nof_trajet-1 ; $j++)
      {   
        $liste_id_messages_brute = $this->Espace_persoManager->get_id_messages($data['id'],$id_interloc,$liste_id_trajet[$j]);
        
        $Nof_message_brut = sizeof($liste_id_messages_brute);
        $liste_id_messages_temp = array();
        $data_message_temp      = array();

        // boucle sur tous les messages de l'interlocuteurs du trajet #i 
        for($k = 0 ; $k <= $Nof_message_brut-1 ; $k++)
        {
          if(!in_array($liste_id_messages_brute[$k]->id, $liste_id_messages_temp))
          {
            $liste_id_messages_temp[] = $liste_id_messages_brute[$k]->id ;
            $data_message_temp[]      = $this->Espace_persoManager->get_messages( $liste_id_messages_brute[$k]->id );
          }
        }  

        $liste_id_messages[$j]  = $liste_id_messages_temp;
        $data_message[$j]       = $data_message_temp ; 
      }
      
  
      // Chargement de le page html
      $data['liste_id_trajet'] = $liste_id_trajet;
      // $data['liste_id_interloc'] = $liste_id_interloc ;
      $data['liste_id_messages'] = $liste_id_messages ;
      $data['data_trajet'] = $data_trajet ;
      $data['data_message'] = $data_message ;
      $page = 'conversation';
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['description'] = 'Messages en cours';
      $data['menu'] = 'messagerie' ;
      $data['data_profil'] = $this->Espace_persoManager->get_profil($data['id']);
      $data['data_interloc'] = $this->Espace_persoManager->get_profil($id_interloc);
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

  public function repondre()
  {

    if($this->session->userdata('logged_in'))
    {
      $session_data     = $this->session->userdata('logged_in');
      $data['email']    = $session_data['email'];
      $data['id']       = $session_data['id'];

      // Vérification du formulaire d'ajout d'un trajet
      $this->form_validation->set_rules('message','"Message"','trim|required|min_length[3]');
      $this->form_validation->set_rules('id_trajet','"Trajet"','required');

      if($this->form_validation->run())
      {
        $data_message['date_creation'] = date('Y-m-d H:i:s');
        $data_message['texte'] = $this->input->post('message');
        $data_message['id_exped'] = $this->input->post('id_exped');
        $data_message['id_dest'] = $this->input->post('id_dest');
        $data_message['id_trajet'] = $this->input->post('id_trajet'); 
        // print_r($data_message);
        $this->Espace_persoManager->ajouter_message($data_message);

        redirect('Espace_perso/Messagerie/messages_en_cours/', 'refresh');
      }

      $id_interloc = $this->input->post('id_dest');
      redirect('Espace_perso/Messagerie/conversation/'.$id_interloc, 'refresh');

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
      $data['menu'] = 'messagerie' ;
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