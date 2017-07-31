<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skype_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
       /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->load->library('Skypephp_loader');
    }

    function verifySkype($username)
    {
        $profile ='';
        $skype = new Skype('ennan16', 'cpfmb5g1ex9t');
        
        $profile = $skype->readMyProfile();

        if(!$skype->logout())
        {
            
            $skype->logout();
        }

        return $profile;
    }


}

