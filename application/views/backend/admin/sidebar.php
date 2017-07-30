<?php

$panels = ['Accounts' => ['Account Requests' => 'creacc',
						'View Accounts' => 'vieacc'], 
			'Teachers' => ['View All' => 'option1',
						'Penalty Reports' => 'option2'], 
			'Students' =>['Viaw All' => 'option1',
						'Option2' => 'option2'], 
			'Documents' => ['Materials' => 'option1',
						'Categories' => 'option2',
						'Reports' => 'option3'],
			];

?>
<div class='sidebar'>
	<div class='sidebar-header'>
		<div>Menu</div>
		<div></div>
	</div>
	<div class='sidebar-body'>
		<ul>
			<li>
				<div class='sidebar-menu'>Student
				<span class='fa fa-angle-down'></span>
				</div>
				<ul class='sidebar-dropdown'>
						<li><a href='#'>Add Student</a></li>
						<li><a href='#'>Student Information</a></li>
				</ul>
			</li>
			<li>
				<div class='sidebar-menu'>Teacher
				<span class='fa fa-angle-down'></span>
				</div>
				<ul class='sidebar-dropdown'>
						<li><a href='#'>View All</a></li>
						<li><a href='#'>Penalty Reports</a></li>
				</ul>
			</li>
			<li>
				<div class='sidebar-menu'>Subscription
				<span class='fa fa-angle-down'></span>
				</div>
				<ul class='sidebar-dropdown'>
						<li><a href='#'>Manage Plans</a></li>
				</ul>
			</li>
			<li>
				<div class='sidebar-menu'>Materials
				<span class='fa fa-angle-down'></span>
				</div>
				<ul class='sidebar-dropdown'>
						<li><a href='#'>Add Material</a></li>
						<li><a href='#'>View All</a></li>
				</ul>
			</li>
			<li>
				<div class='sidebar-menu'>Noticeboard
				<span class='fa fa-angle-down'></span>
				</div>
				<ul class='sidebar-dropdown'>
				</ul>
			</li>
			<li>
				<div class='sidebar-menu'>Accounting
				<span class='fa fa-angle-down'></span>
				</div>
				<ul class='sidebar-dropdown'>
						<li><a href='#'>Create Student Payment</a></li>
						<li><a href='#'>Student Payments</a></li>
						<li><a href='#'>Teacher Salary</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div class='sidebar-footer'>
		<div></div>
		<div></div>
	</div>
</div>