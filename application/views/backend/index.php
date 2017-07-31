<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	// $system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	// $system_title       =	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
	// $text_align         =	$this->db->get_where('settings' , array('type'=>'text_align'))->row()->description;
	$account_type       =	$this->session->userdata('login_type');
	// $skin_colour        =   $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description;
	// $active_sms_service =   $this->db->get_where('settings' , array('type'=>'active_sms_service'))->row()->description;
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