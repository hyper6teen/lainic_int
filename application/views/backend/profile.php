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