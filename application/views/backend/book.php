
<html>

<head>

<?php
	
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

						</li>
						<li><a href="<?php echo base_url();?>">HOME</a></li>
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

				<?php 
					$this->db->select('teacher_id, name, gender, nat_id, birthday');
        			$teachers = $this->db->get('teacher' )->result_array();

					foreach($teachers as $row):
					
					$nat  = $this->db
                    ->get_where('nationality' , array('nat_id' => $row['nat_id']))
                    ->row()->nationality;

		            $now        = new DateTime();
		            $birthday   = new DateTime($row['birthday']);
		            $interval   = $now->diff($birthday);
		            $age        = $interval->format('%y');

		            $gender = $row['gender'] == 0 ? 'MALE' : 'FEMALE';
		            $firt_name = explode('/', $row['name'] )
				?>

				<a href="<?php echo base_url();?>index.php?login/view_teacher_profile/<?php echo $row['teacher_id'];?>" >
					<img src="<?php echo $this->crud_model->get_image_url('teacher', $row['teacher_id']);?>">
					<div class='teacher-overlay'>
						<div>
							<p><?php echo str_replace('_', ' ', $firt_name[1]); ?></p>
							<p><?php echo $gender . '  ' . $age; ?></p>
						</div>
						<div>
							<?php echo $nat; ?>
						</div>
					</div>
				</a>

				<?php endforeach;?>

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

