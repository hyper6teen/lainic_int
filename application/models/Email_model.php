<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
       /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->load->library('Phpmailer_loader');
    }

	function send_applicant_info(array $data)
	{
		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		//full name
		$dbData['name']			= str_replace(' ', '_', $data['full_name']);
		$dbData['address'] 		= str_replace(' ', '_', $data['address']);
        $dbData['last_school'] 	= str_replace(' ', '_', $data['last_sch']);
        $dbData['work_exp']  	= str_replace(' ', '_', $data['exp']);

        $full_name 	= explode('/', $data['full_name'] );
        $fullname 	= $full_name[0] . ', ' . $full_name[1] . ' ' . substr( $full_name[2] , 0, 1) . '.';
        
        //age computation
        $now      	= new DateTime();
        $birthday 	= new DateTime($data['birth']);
        $interval 	= $now->diff($birthday);
        $age 		= $interval->format('%y');

        //get names from database base on id's

        $db_form['nat_name'] 	= $this ->db
					            -> select('nationality')
					            ->where('nat_id', $data['nat_id'] ) 
					            ->limit(1)->get('nationality')
					            ->result_array()[0]['nationality'];

        $db_form['loc_name'] 	= $this ->db
					            -> select('loc_name')
					            ->where('loc_id', $data['loc_id'] )
					            ->limit(1)->get('form_loc')
					            ->result_array()[0]['loc_name'];

        $db_form['isp_name'] 	= $this ->db
					            -> select('isp_name')
					            ->where('isp_id', $data['isp_id'] )
					            ->limit(1)->get('form_isp')
					            ->result_array()[0]['isp_name'];

        $db_form['isp_speed'] 	= $this ->db
					            -> select('speed')
					            ->where('isp_spd_id', $data['isp_spd_id'] )
					            ->limit(1)->get('form_isp_spd')
					            ->result_array()[0]['speed'];

        $db_form['ept'] 		= $this ->db
					            -> select('type')
					            ->where('ept_id', $data['ept_id'] )
					            ->limit(1)->get('form_ept')
					            ->result_array()[0]['type'];

        $date = date( "D M d, Y G:i", time() );
        $hash_code = $data['full_name'] . $date;
        $app_hash['code'] = md5( $hash_code );

        $html['data'] = '
                <input name="full_name" type="hidden" value=' . $dbData['name'] . '>
                <input name="email" type="hidden" value=' . $data['email'] . '>
                <input name="b_date" type="hidden" value=' . $data['birth'] . '>
                <input name="gender" type="hidden" value=' . $data['gender'] . '>
                <input name="nat_id" type="hidden" value=' . $data['nat_id'] . '>
                <input name="loc_id" type="hidden" value=' . $data['loc_id'] . '>
                <input name="address" type="hidden" value=' . $dbData['address'] . '>
                <input name="contact" type="hidden" value=' . $data['contact'] . '>
                <input name="skype" type="hidden" value=' . $data['skype'] . '>
                <input name="tin_num" type="hidden" value=' . $data['tin_num'] . '>
                <input name="isp" type="hidden" value=' . $data['isp_id'] . '>
                <input name="isp_spd" type="hidden" value=' . $data['isp_spd_id'] . '>
                <input name="last_sch" type="hidden" value=' . $dbData['last_school'] . '>
                <input name="exp" type="hidden" value=' . $dbData['work_exp'] . '>
                <input name="ept" type="hidden" value=' . $data['ept_id'] . '>
                <input name="ept_score" type="hidden" value=' . $data['ept_score'] . '>
                <input name="spk_other" type="hidden" value=' . $data['spk_other'] . '>
                <input name="hash_app" type="hidden" value=' . $app_hash['code'] . '>
            ';

        $html['body'] = '<div style="width: 600px;  margin: 0 auto; overflow: hidden;">
                        <div style="display: inline-block; margin-top: 20px;    background-color: #6d0b70; padding-left: 15px; padding-right: 15px;">
                            <p style="font-size: 25px;  font-weight: bold;  color: #d4f208;">LAINIC International LTD</p>
                            <p style="font-size: 15px;  color: #d4f208;">APPLICANT FORM</p>
                        </div>
                        <p style="font-size: 20px;  font-weight: bold;  margin-top: 20px;   margin-left: 20px;  color: #2a2829;">' . $fullname . '</p>
                        <p style="font-size: 14px;  text-decoration: underline; color: #6d0b70; margin-top: 5px;    margin-left: 20px;  margin-bottom: 20px;">' . $data['email'] . '</p>
                        <div style="width: 100%;">
                            <div style="background-color: #d4f208;  color: #6d0b70; width: 40%; height: 5%; font-size: 15px;    text-align: center; font-weight: bold;">PERSONAL INFORMATION</div>
                            <div style="background-color: #d4f208;  width: 100%;    height: 3px;"></div>
                            <div style="width: 100%;    padding: 20px;">
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">AGE: </span>' . $age . '</div>
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">GENDER: </span>' . $data['gender'] . '</div>
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">NATIONALITY: </span>' . $db_form['nat_name'] . '</div>
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">LOCATION: </span>' . $db_form['loc_name'] . '</div>
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">MOBILE NO.: </span>' . $data['contact'] . '</div>
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">SKYPE ID: </span>' . $data['skype'] . '</div>
                                <div style="display: inline-block;  width: 100%;    font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">COMPLETE ADDRESS: </span> ' . $data['address'] . '
                                </div>
                            </div>
                        </div>

                        <div style="width: 100%;">
                            <div style="background-color: #d4f208;  color: #6d0b70; width: 40%; height: 5%; font-size: 15px;    text-align: center; font-weight: bold; float: right;">ADDITIONAL INFORMATION</div>
                            <div style="background-color: #d4f208;  width: 100%;    height: 3px; margin-bottom: 55px;"></div>
                            <div style="width: 100%;    padding: 20px;">
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">TIN NO.: </span>' . $data['tin_num'] . '</div>
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">ISP: </span>' . $db_form['isp_name'] . '</div>
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">INTERNET SPEED: </span>' . $db_form['isp_speed'] . '</div>
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">LAST SCHOOL ATTENDED: </span>' . $data['last_sch'] . '</div>
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">WORK EXPERIENCE: </span>' . $data['exp'] . '</div>
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">ENGLISH PROFICIENCY TEST: </span>' . $db_form['ept'] . '</div>
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">SCORE: </span>' . $data['ept_score'] . '</div>
                                <div style="display: inline-block;  width: 49.5%;   font-size: 12px;    margin-bottom: 15px;"><span style="font-weight: bold;">SPEAKS OTHER LANGUAGE: </span>' . $data['spk_other'] . '</div>
                            </div>
                        </div>
                        <div style="email-body-right">    
                        </div>

                        <form action="localhost/lainic_int/" method="post">

                        ' . $html['data'] . '

                        <div style="margin-top: 20px;   width: 100%; text-align: center; margin-bottom: 20px;">
                            <input name="accept" type="submit" value="ACCEPT"  style="background-color: #dc1041;   padding: 7px;   padding-left: 30px; padding-right: 30px;    border-radius: 10px;    color: #FFFFFF; text-decoration: none;  font-size: 20px;  margin-bottom: 30px;">
                            <input name="reject" type="submit" value="REJECT"  style="background-color: #dc1041;   padding: 7px;   padding-left: 30px; padding-right: 30px;    border-radius: 10px;    color: #FFFFFF; text-decoration: none;  font-size: 20px;  margin-bottom: 30px;">
                        </div>

                        </form>
                    </div>
            ';
		$this->do_email( $html['body'] , 'ennan16@gmail.com' , 'lianic@ploeduglobal.com','Applicant ( ' . $fullname . ' )', $app_hash);
	}

	function send_applicant_status(array $userAccount, $status)
	{

		$full_name = explode('/', $userAccount['full_name'] );
        $fullname = $full_name[0] . ', ' . $full_name[1];


        if($status == 'accepted')
        {

        	$html['msg'] = 'Congratulations ' . $fullname .', you have been accepted as on of our teachers! Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

			$html['user_info'] = '<div style="width: 100%;">
				<div style="background-color: #d4f208;	color: #6d0b70;	width: 40%;	height: 5%;	font-size: 15px;	text-align: center;	font-weight: bold;">ACCOUNT INFORMATION</div>
				<div style="background-color: #d4f208;	width: 100%;	height: 3px;"></div>
					<div style="width: 100%;	padding: 20px;">
					<div style="display: inline-block;	width: 49.5%;	font-size: 12px;	margin-bottom: 15px;"><span style="font-weight: bold;">USERNAME : </span>' . $userAccount['email'] . '</div>
					<div style="display: inline-block;	width: 49.5%;	font-size: 12px;	margin-bottom: 15px;"><span style="font-weight: bold;">PASSWORD: </span>' . $userAccount['pass'] . '</div>
					</div>
				</div>
			</div>
			<div style="margin-top: 20px;	width: 100%;	text-align: center;	margin-bottom: 20px;">
				<a href="localhost/lainic_int" style="background-color: #dc1041;	padding: 7px;	padding-left: 30px;	padding-right: 30px;	border-radius: 10px;	color: #FFFFFF;	text-decoration: none;	font-size: 20px;	margin-bottom: 30px;" href="">SIGN IN</a>
			</div>';

        }
        else
        {
        	$html['msg'] = $fullname .', We are sorry to hear that you did not pass our assessment. but you could still apply after 3 months from this date. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

			$html['user_info'] = ' ';
        }


		$html['body'] ='<style type="text/css">
		*{
			padding: 0px;	margin: 0px;	list-style: none;	font-family: "Arial";
		}

		</style>

		<div style="width: 600px;	margin: 0 auto;	overflow: hidden;">
			<div style="display: inline-block; margin-top: 20px;	background-color: #6d0b70; padding-left: 15px; padding-right: 15px;">
				<p style="font-size: 25px;	font-weight: bold;	color: #d4f208;">LAINIC International LTD</p>
				<p style="font-size: 15px;	color: #d4f208;">APPLICATION STATUS</p>
			</div>
			<p style="margin-top: 20px; margin-bottom: 20px; margin-left: 10px; margin-right: 10px;">
			
			' . $html['msg'] . '
			</p>
			
			' . $html['user_info'] . '
			

		</div>';

		$this->do_email( $html['body'] , $userAccount['email'] , 'lianic@ploeduglobal.com','Lainic Application Status', 'app_status');

	}


	function do_email($html='', $recipient=NULL, $from=NULL, $title = '', $hashCode)
	{
		$mail = new PHPMailer();
		$mail->isMail();
        //$mail->isSMTP();
        $mail->Host = 'gator4113.hostgator.com';
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'lainic@ploeduglobal.com';                 // SMTP username
        $mail->Password = 'lainic123';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;
		
		$mail->setFrom( $from, $title );
        $mail->addAddress( $recipient, $title );     // Add a recipient    
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $title;
        $mail->Body    = $html;
        $mail->AltBody = $html;

        if( $mail->send() )
        {	
        	if($hashCode != 'app_status')
        	{
        		$this->db->insert('app_hash', $hashCode);
            	$this->session->set_userdata('application_sent', '1');
            	redirect(base_url(), 'refresh');
        	}
            
        } 
        else 
        {
        	$this->session->set_userdata('application_not_sent', '1');
        	//echo 'Mailer Error: ' . $mail->ErrorInfo;
        		redirect(base_url(), 'refresh');
            
        }
		
		//echo $this->email->print_debugger();
	}

	function password_reset_email($new_password = '' , $account_type = '' , $email = '')
	{
		$query = $this->db->get_where($account_type , array('email' => $email));
		if($query->num_rows() > 0)
		{
			
			$email_msg	=	"Your account type is : ".$account_type."<br />";
			$email_msg	.=	"Your password is : ".$new_password."<br />";
			$email_sub	=	"Password reset request";
			$email_to	=	$email;
			//$this->do_email($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{	
			return false;
		}
	}


}

