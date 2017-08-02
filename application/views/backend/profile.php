<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	
?>

<html>
<head>
	<title><?php echo $page_name;?> | <?php echo $page_title;?></title>
	<?php include 'res.php'; ?>
</head>

<body>
	<?php if($include_hf) {include 'dashboard-header.php';}?>
	<div class='wrapper'>
		<div id='signin' class='signin'>
			<div class='signin-box'>
				<div class='signin-header'>
					<img src='uploads/logo.png'>
					<span></span>
					<span onclick='hideConfirm('signin')' class='fa fa-close'></span>
				</div>
				
				<div class='signin-body'>

				<!--Login Form-->
				<form method='post' role='form' id='form_login'>
				
					<div class='form-group'>
						
						<div class='input-group'>
							<div class='input-group-addon'>
								<i class='entypo-user'></i>
							</div>
							<input type='text' class='form-control' name='email' id='email' placeholder='Email' autocomplete='off' data-mask='email' />
						</div>
						
					</div>
					
					<div class='form-group'>
						<div class='input-group'>
							<div class='input-group-addon'>
								<i class='entypo-key'></i>
							</div>
							<input type='password' class='form-control' name='password' id='password' placeholder='Password' autocomplete='off' />
						</div>
					</div>
					
					<div class='form-group'>
						<button type='submit' class='btn btn-primary btn-block btn-login'>
							<i class='entypo-login'></i>
							Login
						</button>
					</div>

				</form>

					<div class='login-bottom-links'>
						<a href='<?php echo base_url();?>index.php?login/forgot_password' class='link'>
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
						<li><a href='<?php echo base_url();?>'>HOME</a></li>
						<li><a href=''>ABOUT US</a></li>
						<li><a href=''>FEES</a></li>
						<li><a href='<?php echo base_url();?>index.php?login/book_class'>BOOK A CLASS</a></li>
						<li><a onclick='showConfirm('signin')'>SIGN IN</a></li>
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
		<div class='profile-wrapper'>
			<img src='<?php echo $this->crud_model->get_image_url($user_type,$user_id);?>'/>
			<div class='profile-info'>
				<div>PERSONAL INFORMATION</div>
				<div>
					<p>NAME:</p><span>Samuel</span>
				</div>
				<div>
					<p>NAME:</p><span>Samuel</span>
				</div>
				<div>
					<p>NAME:</p><span>Samuel</span>
				</div>
				<div>
					<p>NAME:</p><span>Samuel</span>
				</div>
				<div>
					<p>NAME:</p><span>Samuel</span>
				</div>
				<div>
					<p>NAME:</p><span>Samuel</span>
				</div>
				<div>
					<p>NAME:</p><span>Samuel</span>
				</div>
				<div>
					<p>NAME:</p><span>Samuel</span>
				</div>
			</div>
		</div>
	</div>
          
	
		<?php //echo $page_profile; ?>
		
		
<?php 
	if($include_hf) include 'dashboard-footer.php'; ?>	
</body>
</html>