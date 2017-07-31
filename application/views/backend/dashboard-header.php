<?php
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	$profile_path = base_url() . 'index.php?'. $this->session->userdata('login_type') . '/view_profile';
?>
<iframe src="http://free.timeanddate.com/clock/i5ttatvw/n145/tlph/fn17/fs16/fccbe70f/tc6d0b70/pct/ftb/pa8/tt0/th1/ta1/tb4" frameborder="0" width="254" height="74" allowTransparency="true" style="position:fixed; z-index:1;"></iframe>
<div class='dashboard-header-menu'>
	<div>
		<ul>
			<li><a href="<?php echo base_url();?>index.php?admin/dashboard">HOME</a></li>
			<li><a href="<?php echo $profile_path;?>">PROFILE</a></li>
			<li><a href="<?php echo base_url();?>index.php?admin/dashboard">DASHBOARD</a></li>
			<li><a href="<?php echo base_url();?>index.php?login/logout">SIGN OUT</a></li>
		</ul>
	</div>
	<div></div>
</div>
<div class='dashboard-header-line'>
</div>
