
<html>

<head>

<?php
	
	$hash = $this->input->post('hash_app');

	$prompt['status'] = '';

	if( $hash != null )
	{
		$get_app = $this->db->where('code', $hash)->get('app_hash')->result_array();

		if($get_app != null)
		{

			if($this->input->post('accept'))
			{	
				$appdata1 = array(
		        'name'		=> $this->input->post('full_name'),
		        'birthday'	=> $this->input->post('b_date'),
		        'gender'	=> $this->input->post('gender'),
		        'nat_id'	=> $this->input->post('nat_id'),
		        'loc_id'	=> $this->input->post('loc_id'),
		        'address'	=> $this->input->post('address'),
		        'email'		=> $this->input->post('email'),
		        'phone'		=> $this->input->post('contact'),
		        'password'	=> substr( $get_app[0]['code'] , 0, 12)
		        );

		        $appdata2 = array(
		        'ept_id'		=> $this->input->post('ept'),
		        'ept_score'		=> $this->input->post('ept_score'),
		        'skype_id'		=> $this->input->post('skype'),
		        'isp_id'		=> $this->input->post('isp'),
		        'isp_spd_id'	=> $this->input->post('isp_spd'),
		        'last_school'	=> $this->input->post('last_sch'),
		        'work_exp'		=> $this->input->post('exp'),
		        'speak_other'	=> $this->input->post('spk_other')
		        );

				$this->applicant_model->processApplicant($get_app[0]['code'], $appdata1, $appdata2,'accepted');

				$prompt['status'] = 'Applicant Accepted';
				$prompt['div']  = 'accepted';
				$prompt['css'] = "alert-box accepted";
				$prompt['font_size'] = "font-size:32px;";
			}
			else
			{

				$appdata1 = array(
		        'name'		=> $this->input->post('full_name'),
		        'email'		=> $this->input->post('email'),
		        'password'	=> substr( $get_app[0]['code'] , 0, 12)
		        );
				$appdata2 = array();

				$this->applicant_model->processApplicant($get_app[0]['code'], $appdata1, $appdata2,'rejected');

				$prompt['status'] = 'Applicant Rejected';
				$prompt['div']  = 'rejected';
				$prompt['css'] = "alert-box rejected";
				$prompt['font_size'] = "font-size:32px;";
			}
		}else
		{
			$prompt['status'] = 'Applicant<br>already proccess';
			$prompt['div']  = 'warning';
			$prompt['css'] = "alert-box warning";
			$prompt['font_size'] = "font-size:32px;";
		}

		$promp_request = "<script>
					var statusPrompt = function()
						{
	    					$( 'div.". $prompt['div'] ."' ).fadeIn( 300 ).delay( 3000 ).fadeOut( 400 );
						};
						setTimeout(statusPrompt, 1000);

					var closeWindow = function()
						{
	    					window.close();
						};
						setTimeout(closeWindow, 5500);
					</script>";
		echo $promp_request;


	} // if hash not null end

	if ($this->session->userdata('application_sent') == 1)
	{
		$this->session->set_userdata('application_sent', '0');

		$prompt['status'] = 'Application sent.<br>please check your email<br>and skype often for a potential interview.<br>Thank you and good luck!';
		$prompt['div']  = 'accepted';
		$prompt['css'] = "alert-box accepted";
		$prompt['font_size'] = "font-size:24px;";

		$promp_request = "<script>
					var statusPrompt = function()
						{
	    					$( 'div.". $prompt['div'] ."' ).fadeIn( 300 ).delay( 10000 ).fadeOut( 400 );
						};
						setTimeout(statusPrompt, 1000);
					</script>";
		echo $promp_request;
	}
	else if($this->session->userdata('application_not_sent') == 1)
	{
		$this->session->set_userdata('application_not_sent', '0');

		$prompt['status'] = 'Application failed to sent.<br> The system might be having some difficulty<br>Or your internet connection is having a problem<br>sending your application form.<br>Please try again later. <br>Sorry for the inconvenience.';
		$prompt['div']  = 'rejected';
		$prompt['css'] = "alert-box rejected";
		$prompt['font_size'] = "font-size:24px;";

		$promp_request = "<script>
					var statusPrompt = function()
						{
	    					$( 'div.". $prompt['div'] ."' ).fadeIn( 300 ).delay( 10000 ).fadeOut( 400 );
						};
						setTimeout(statusPrompt, 1000);
					</script>";
		echo $promp_request;

	}

	$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
?>
	
<title><?php echo $system_title;?></title>

<link rel="stylesheet" type="text/css" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">

<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">
</head>

<script type='text/javascript' src='assets/js/jquery-3.1.1.js'></script>
<script type='text/javascript' src='assets/js/jquery-ui-1.12.1/jquery-ui.js'></script>
<script type="text/javascript" src='assets/js/registration.js'></script>

<script type="text/javascript">
	var baseurl = '<?php echo base_url();?>';
</script>

<body>
	<div class='wrapper'>
		<div id='signin' class='signin'>
			<div class='signin-box'>
				<div class='signin-header'>
					<img src="uploads/logo.png">
					<span></span>
					<span onclick='hideConfirm("signin")' class='fa fa-close'></span>
				</div>
				
				<div class='signin-body'>

				<!--Login Form-->
				<form method="post" role="form" id="form_login">
				
					<div class="form-group">
						
						<div class="input-group">
							<div class="input-group-addon">
								<i class="entypo-user"></i>
							</div>
							<input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" data-mask="email" />
						</div>
						
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="entypo-key"></i>
							</div>
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
						</div>
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block btn-login">
							<i class="entypo-login"></i>
							Login
						</button>
					</div>

				</form>

					<div class="login-bottom-links">
						<a href="<?php echo base_url();?>index.php?login/forgot_password" class="link">
							<?php echo get_phrase('forgot_your_password');?> ?
						</a>
					</div>

				</div>
			</div>
		</div>
		<div class='header'>
			<div class='header-top'>
				<div>
					<ul>
						<li>		
							<div class='<?php echo $prompt['css'];?>' style='<?php echo $prompt['font_size'];?>'> <?php echo $prompt['status'];?> </div>
						</li>
						<li><a href="">HOME</a></li>
						<li><a href="">ABOUT US</a></li>
						<li><a href="">FEES</a></li>
						<li><a href="<?php echo base_url();?>index.php?login/book_class">BOOK A CLASS</a></li>
						<li><a onclick='showConfirm("signin")'>SIGN IN</a></li>
					</ul>

				</div>
				<div>
				</div>
				<div>
				</div>
				<div>
				</div>
			</div>
		</div>
		<div class='landing-header-line'>
		</div>
		<div class='book-body'>
			<div class='book-info'>
				<p>SEARCH FILTER</p>
				<select>
					<option>NATIONALITY</option>
				</select>
				<select>
					<option>AVAILABILITY</option>
				</select>
				<select>
					<option>GENDER</option>
				</select>
				<select>
					<option>POPULARITY</option>
				</select>
				<select>
					<option>AGE</option>
				</select>
				<div></div>
				<p>SEARCH KEYWORD</p>
				<input placeholder='SEARCH KEYWORD HERE' type='text'>
				<input value='SEARCH' type='submit'>
			</div>
			<div class='teacher-list'>
				<a href=""><img src=""></a>
				<a href=""><img src=""></a>
				<a href=""><img src=""></a>
				<a href=""><img src=""></a>
				<a href=""><img src=""></a>
				<a href=""><img src=""></a>
				<a href=""><img src=""></a>
				<a href=""><img src=""></a>
			</div>
		</div>
	</div>

<script src="assets/js/gsap/main-gsap.js"></script>
<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/joinable.js"></script>
<script src="assets/js/resizeable.js"></script>
<script src="assets/js/neon-api.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/neon-login.js"></script>
<script src="assets/js/neon-custom.js"></script>
<script src="assets/js/neon-demo.js"></script>

</body>
</html>

