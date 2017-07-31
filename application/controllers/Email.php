<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller
{
	function __construct()
	{	
		parent::__construct();
    }

    function send_applicant_info()
    {
            $data = array(
            'full_name'     => $this->input->post('lname') . "/" . $this->input->post('fname') . "/" . $this->input->post('mname'),
            'birth'         => $this->input->post('birth') ,
            'gender'        => $this->input->post('gender') ,
            'nat_id'        => $this->input->post('nationality'),
            'loc_id'        => $this->input->post('location'),
            'email'         => $this->input->post('email'),
            'nat'           => $this->input->post('nationality'),
            'location'      => $this->input->post('location'),
            'address'       => $this->input->post('address'),
            'contact'       => $this->input->post('mobile_no'),
            'skype'         => $this->input->post('skype_id'),
            'tin_num'       => $this->input->post('tax_id'),
            'isp_id'        => $this->input->post('isp'),
            'isp_spd_id'    => $this->input->post('isp_spd'),
            'last_sch'      => $this->input->post('last_school_attended'),
            'exp'           => $this->input->post('work_experience'),
            'ept_id'        => $this->input->post('ept'),
            'ept_score'     => $this->input->post('ept_score'),
            'spk_other'     => $this->input->post('foreign_language') == 1 ? 'YES' : 'NO'
            );
            
            $this->email_model->send_applicant_info($data);
    }


}


?>