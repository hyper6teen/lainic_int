<div class='admin-panel'>
    <?php  include 'navigation.php';?>
    <div class='admin-panel-body'>
        <div class='panel-body-header'>
            <p class='panel-body-title'><span>VIEW </span>ALL TEACHERS</p>
        </div>
    <div class='panel-body'> 
    	<table class='teacher-table' id="teacher-table">
	   		<thead>
		        <tr>
		            <th>ID</th>
		            <th>Name</th>
		            <th>Gender</th>
		            <th>Nationality</th>
		            <th>Location</th>
		            <th>Email</th>
		            <th>Contact No.</th>
		        </tr>
		    </thead>
		    <tbody>
		       	<?php for ($i=0; $i < 100; $i++) {?> 
		       		<tr>
		            <td>201211388</td>
		            <td>Samuel Marvin Aguilos</td>
		            <td>Male</td>
		            <td>Filipino</td> 
		            <td>Philippines</td>
		            <td>samuel103195@gmail.com</td>
		            <td>09281129681</td>
		        </tr>
		       	<?php } ?>
		    </tbody>
		</table>
  
 
 <!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
    </div>
    <div class='panel-body-footer'></div>
    </div>
</div>
  <script type="text/javascript">

  +$(document).ready(function(){
 +    $('#teacher-table').DataTable();
 +});
  
 +</script>