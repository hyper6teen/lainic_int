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
			<?php while(current($panels)){ ?>

				<li><div class='sidebar-menu'><?php echo key($panels); ?>
				<span class='fa fa-angle-down'></span>
				</div>
				<ul class='sidebar-dropdown'>
					<?php foreach ($panels[key($panels)] as $option): ?>
						<li><a href='<?php echo $option ?>.php'><?php echo array_search($option, $panels[key($panels)]); ?></a></li>
					<?php endforeach ?>
				</ul>
			</li>
			<?php next($panels); } ?>
		</ul>
	</div>
	<div class='sidebar-footer'>
		<div></div>
		<div></div>
	</div>
</div>