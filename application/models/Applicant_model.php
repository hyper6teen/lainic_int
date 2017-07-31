<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Applicant_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

	function processApplicant( $hash_code ='', array $data1, array $data2,  $app_status='')
    {

        if($app_status =='accepted')
        {
            $this->db->insert('teacher', $data1);
            $teacher_id = $this->db->insert_id();
            $data2['u_pro_id'] = $teacher_id;
            $this->db->insert('teacher_pro', $data2);

            $user_account['full_name'] = $data1['name'];
            $user_account['email'] = $data1['email'];
            $user_account['pass'] = $data1['password'];

            $this->email_model->send_applicant_status($user_account,"accepted");
            $this->removeAppHash( $hash_code );
        }
        else
        {
        	$user_account['full_name'] = $data1['name'];
            $user_account['email'] = $data1['email'];
            $user_account['pass'] = $data1['password'];

        	$this->email_model->send_applicant_status($user_account,"rejected");
        	$this->removeAppHash( $hash_code );
        }
    }

    function removeAppHash($hash_code = '')
    {
        $this->db->where('code' , $hash_code);
        $this->db->delete('app_hash');
    }

}

?>