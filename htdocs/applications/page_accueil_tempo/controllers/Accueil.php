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

        $this->form_validation->set_rules('email','"Email"','required|min_length[3]');
        
        if($this->form_validation->run())
        { 
            $data                   = array();
            $data['email']          = $this->input->post('email');
            $data['date_ajout']      = date('Y-m-d H:i:s');
            $this->AccueilManager->ajouter_contact($data); 
            

        }



        $data['title'] = "Handivalise" ;//ucfirst($page); // Capitalize the first letter
        $data['description'] =  'Page d\'accueil';
        $this->load->view('templates/header', $data);
        $this->load->view('pages/Accueil/'.$page, $data);
        $this->load->view('templates/footer', $data);

    }

    public function stockage_email()
    {
       


    }

}
?>