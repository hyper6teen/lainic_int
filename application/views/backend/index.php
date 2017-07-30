<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	$account_type       =	$this->session->userdata('login_type');
?>

<html>
<head>
	<title></title>
	<?php include 'res.php'; ?>
</head>
<body>
	<div class='dashboard-wrapper'>
		<?php include 'dashboard-header.php'; ?>
		<?php include $account_type.'/'.$page_name.'.php';?>
		<?php include 'dashboard-footer.php'; ?>	
	</div>
</body>
</html>