<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accueil extends CI_Controller 
{

	private $data = array();

	public function __construct()
	{
		parent::__construct();
		
		$this->load->database();
        $this->load->helper(array('url','assets','form'));
        $this->load->model('Accueil_model','AccueilManager');
        $this->load->library('form_validation');
    }

    public function index($page = 'accueil')
    {
      $this->accueil($page);
    }

    public function accueil($page = 'accueil')
    {
        if ( ! file_exists(APPPATH.'/views/pages/Accueil/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['description'] =  'Page d\'acceuil';
        $this->load->view('templates/header', $data);
        $this->load->view ('templates/navigation');
        $this->load->view('pages/Accueil/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function a_propos($page = 'a_propos')
    {
    	if ( ! file_exists(APPPATH.'/views/pages/Accueil/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['description'] =  'Description du projet associatif';
        $this->load->view ('templates/navigation');
        $this->load->view('templates/header', $data);
        $this->load->view('pages/Accueil/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function equipe($page = 'equipe')
    {
      if ( ! file_exists(APPPATH.'/views/pages/Accueil/'.$page.'.php'))
      {
                // Whoops, we don't have a page for that!
        show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['description'] =  'Présentation de l\'equipe';
        $this->load->view ('templates/navigation');
        $this->load->view('templates/header', $data);
        $this->load->view('pages/Accueil/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function contact($page = 'contact')
    {
        if ( ! file_exists(APPPATH.'/views/pages/Accueil/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
            show_404();
        }

        $this->form_validation->set_rules('nom','"Nom"','trim|required|min_length[3]');
        $this->form_validation->set_rules('email','"Email"','trim|required|valid_email');
        $this->form_validation->set_rules('demande','"Demande"','required') ;

        if($this->form_validation->run())
        {   
        // Stockage en bdd
            $data = array(
                'nom' => $this->input->post('nom'),
                'email' => $this->input->post('email'),
                'demande' => $this->input->post('demande'),
                'date_envoi'=>date('Y-m-d H:i:s'));

            $this->AccueilManager->ajouter_contact($data);

            // envoi du mail 
            extract($_POST);  // récupère tout le poste et les variable sont directement appelées $pseudo sans mettre $data['pseudo']
            $this->email->from($email,$nom);
            $this->email->to('olivier.arsacb@gmail.com');
            $this->email->subject('Contact association');
            $this->email->message($demande);
            $this->email->send();

            // Affichage de la page de confirmation    
            $page = 'confirm_contact';
            $data['title'] = ucfirst($page); // Capitalize the first letter
            $data['description'] =  'Validation de contact';
            $this->load->view('templates/navigation');
            $this->load->view('templates/header', $data);
            $this->load->view('pages/Accueil/'.$page, $data);
            $this->load->view('templates/footer', $data);  

        }
        else
        {

            $data['title'] = ucfirst($page); // Capitalize the first letter
            $data['description'] =  'Formulaire de contact';
            $this->load->view ('templates/navigation');
            $this->load->view('templates/header', $data);
            $this->load->view('pages/Accueil/'.$page, $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function plan($page = 'plan')
    {
        if ( ! file_exists(APPPATH.'/views/pages/Accueil/'.$page.'.php'))
        {
           // Whoops, we don't have a page for that!
            show_404();
        }

        if($this->session->userdata('logged_in')) 
        {
            $data['bouton_retour'] = 1 ; 
        }  

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['description'] =  'Plan du site';
        $this->load->view ('templates/navigation');
        $this->load->view('templates/header', $data);
        $this->load->view('pages/Accueil/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function faq($page = 'faq')
    {
        if ( ! file_exists(APPPATH.'/views/pages/Accueil/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['description'] =  'Foire aux questions';
        $this->load->view ('templates/navigation');
        $this->load->view('templates/header', $data);
        $this->load->view('pages/Accueil/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function reglement($page = 'reglement')
    {
        if ( ! file_exists(APPPATH.'/views/pages/Accueil/'.$page.'.php'))
        {
           // Whoops, we don't have a page for that!
            show_404();
        }

        if($this->session->userdata('logged_in')) 
        {
            $data['bouton_retour'] = 1 ; 
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['description'] =  'Reglement de l\'association' ;
        $this->load->view ('templates/navigation');
        $this->load->view('templates/header', $data);
        $this->load->view('pages/Accueil/'.$page, $data);
        $this->load->view('templates/footer', $data); 
    }

    public function liens_utiles($page = 'liens_utiles')
    {
        if ( ! file_exists(APPPATH.'/views/pages/Accueil/'.$page.'.php'))
        {
           // Whoops, we don't have a page for that!
            show_404();
        }

        if($this->session->userdata('logged_in')) 
        {
            $data['bouton_retour'] = 1 ; 
        }  

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['description'] =  'Plan du site';
        $this->load->view ('templates/navigation');
        $this->load->view('templates/header', $data);
        $this->load->view('pages/Accueil/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    
}
?>