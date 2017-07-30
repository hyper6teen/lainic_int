<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	
?>

<html>
<head>
	<title><?php echo $page_name;?> | <?php echo $page_title;?></title>
	<?php include 'res.php'; ?>
</head>

<body>
	<?php include 'dashboard-header.php'; ?>

<div class='panel-profile'>
          
	<div class='profile'>
		<div class="default-rect profile-rect"></div>
		<section class="pre-header container">
			<div class="prompt-title">
			</div>
			<div class="prof-pic">
				<img class="img-responsive img-circle" src='<?php echo $this->crud_model->get_image_url($user_type,$user_id);?>'/>
			</div>
		</section>
		<?php echo $page_profile; ?>
	</div>
</div>

<?php include 'dashboard-footer.php'; ?>	
</body>
</html>