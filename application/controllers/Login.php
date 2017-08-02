<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Login extends CI_Controller {

    function __construct() 
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->model('applicant_model');
        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function index() {

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');

        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php?teacher/dashboard', 'refresh');

        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?student/dashboard', 'refresh');

        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/dashboard', 'refresh');

        $this->load->view('backend/login');
    }

    function validateSkype()
     {
         $skype_id = $_POST['data'];
 
         if(strlen($skype_id) >= 5)
         {
             $url = "https://login.live.com/login.srf?wa=wsignin1.0&rpsnv=13&ct=1501278133&rver=6.7.6626.0&wp=MBI_SSL&wreply=https%3A%2F%2Flw.skype.com%2Flogin%2Foauth%2Fproxy%3Fclient_id%3D578134%26redirect_uri%3Dhttps%253A%252F%252Fweb.skype.com%252F%26site_name%3Dlw.skype.com&lc=1033&id=293290&mkt=en-PH&uaid=4b934bab08d2bb881e9fe2515f4bd1bc&psi=skype&lw=1&cobrandid=90010&client_flight=hsu%2CReservedFlight33%2CReservedFlight67&username=". $skype_id;
             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $url);
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false );
                 // This is what solved the issue (Accepting gzip encoding)
             curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");     
             $response = curl_exec($ch);
             curl_close($ch);
             $response = str_replace('<', '&lt;', $response);
             $response = str_replace('>', '&gt;', $response);
             echo strpos($response, '"IfExistsResult":0') != false ? "<img src = https://api.skype.com/users/".$skype_id."/profile/avatar/>" : "invalid";
         }
     }

     function view_teacher_profile($teacher_id)
     {
        
        $teacher_info = $this->db->join('teacher_pro TP', 'T.teacher_id = TP.u_pro_id')->get_where('teacher T' , array(
            'T.teacher_id' => $teacher_id
        ))->result_array();

        foreach ($teacher_info as $row) 
        {
            $full_name  = explode('/', $row['name'] );
            $fullname   = $full_name[0] . ', ' . $full_name[1] . ' ' . substr( $full_name[2] , 0, 1) . '.';    

            $now        = new DateTime();
            $birthday   = new DateTime($row['birthday']);
            $interval   = $now->diff($birthday);
            $age        = $interval->format('%y');
            $gender     = $row['gender'] == 0 ? "Male" : "Female";

            $page_data['page_profile1'] = 
            '
                <div class="content">
                <p style="font-size: 20px;  font-weight: bold;  margin-bottom: .5%;   margin-left: 20px;  color: #2a2829;">' . str_replace('_', ' ', $fullname) . '</p>
                    <div style="width: 100%;">
                        <div class="prof-head1">PERSONAL INFORMATION</div>
                            <div style="background-color: #d4f208;  width: 100%; height: 3px;"></div>
                                <div style="width: 100%; padding: 20px;">
                                    <div class="prof-content"><span>AGE : </span>' . $age . '</div>
                                    <div class="prof-content"><span>GENDER : </span>' . $gender . '</div>
                                    <div class="prof-content"><span>NATIONALITY : </span>' . $this->db->get_where('nationality' , array('nat_id' => $row['nat_id']))->row()->nationality . '</div>
                                    <div class="prof-content"><span>SPEAKS OTHER LANGUAGE : </span>' . $row['speak_other'] . '</div>
                                    <div class="prof-content"><span>INTERNET SERVICE PROVIDER : </span>' . $this->db->get_where('form_isp' , array('isp_id' => $row['isp_id']))->row()->isp_name . '</div>
                                    <div class="prof-content"><span>INTERNET SPEED : </span>' . $this->db->get_where('form_isp_spd' , array('isp_spd_id' => $row['isp_spd_id']))->row()->speed . '</div>
                                    <div class="prof-content"><span>ENGLISH PROFICIENCY TEST : </span>' . $this->db->get_where('form_ept' , array('ept_id' => $row['ept_id']))->row()->type . '</div>
                                    <div class="prof-content"><span>SCORE : </span>' . $row['ept_score'] . '</div>
                            </div>
                    ';

        } // end for each teacher info 1
        $page_data['user_id'] = $teacher_id;
        $page_data['user_type'] = 'teacher';
        $page_data['page_profile'] = $page_data['page_profile1'];
        $page_data['page_name']  = 'Teacher Profile';
        $page_data['page_title'] = 'Book a Class';
        $page_data['include_hf'] = false;

        $this->load->view('backend/profile', $page_data);
     }

    //Ajax login function 
    function ajax_login() 
    {
        $response = array();
        //Recieving post input of email, password from ajax request
        $email = $_POST["email"];
        $password = $_POST["password"];
        $response['submitted_data'] = $_POST;

        //Validating login
        $login_status = $this->validate_login($email, $password);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
            $response['redirect_url'] = '';
        }

        //Replying ajax request with validation response
        echo json_encode($response);
    }

    //Validating login from ajax request
    function validate_login($email = '', $password = '') 
    {
        $credential = array('email' => $email, 'password' => $password);
        // Checking login credential for admin
        $query = $this->db->get_where('admin', $credential);
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('admin_id', $row->admin_id);
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'admin');
            return 'success';
        }

        // Checking login credential for teacher
        $query = $this->db->get_where('teacher', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('teacher_login', '1');
            $this->session->set_userdata('teacher_id', $row->teacher_id);
            $this->session->set_userdata('login_user_id', $row->teacher_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'teacher');
            return 'success';
        }

        // Checking login credential for student
        $query = $this->db->get_where('student', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('student_login', '1');
            $this->session->set_userdata('student_id', $row->student_id);
            $this->session->set_userdata('login_user_id', $row->student_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'student');
            return 'success';
        }

        // Checking login credential for parent
        $query = $this->db->get_where('parent', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('parent_login', '1');
            $this->session->set_userdata('parent_id', $row->parent_id);
            $this->session->set_userdata('login_user_id', $row->parent_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'parent');
            return 'success';
        }

        return 'invalid';
    }

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }


    public function book_class()
    {
        $this->load->view('backend/book');
    }
    
    // PASSWORD RESET BY EMAIL
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    function ajax_forgot_password()
    {
        $resp                   = array();
        $resp['status']         = 'false';
        $email                  = $_POST["email"];
        $reset_account_type     = '';
        //resetting user password here
        $new_password           =   substr( md5( rand(100000000,20000000000) ) , 0,7);
        
        // Checking credential for admin
        $query = $this->db->get_where('admin' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'admin';
            $this->db->where('email' , $email);
            $this->db->update('admin' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        // Checking credential for student
        $query = $this->db->get_where('student' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'student';
            $this->db->where('email' , $email);
            $this->db->update('student' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        // Checking credential for teacher
        $query = $this->db->get_where('teacher' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'teacher';
            $this->db->where('email' , $email);
            $this->db->update('teacher' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        // Checking credential for parent
        $query = $this->db->get_where('parent' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'parent';
            $this->db->where('email' , $email);
            $this->db->update('parent' , array('password' => $new_password));
            $resp['status']         = 'true';
        }

        // send new password to user email  
        $this->email_model->password_reset_email($new_password , $reset_account_type , $email);

        $resp['submitted_data'] = $_POST;

        echo json_encode($resp);
    }

    /*     * *****LOGOUT FUNCTION ****** */

    function logout() 
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }

}
