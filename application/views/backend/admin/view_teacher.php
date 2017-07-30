<script type="text/javascript">

$(document).ready(function(){
    $('#teacher-table').DataTable();
});

</script>
<div class='admin-panel'>
    <?php  include 'navigation.php';?>
    <div class='admin-panel-body'>
        <div class='panel-body-header'>
            <p class='panel-body-title'><span>ADD</span>ACCOUNT</p>
        </div>
    <div class='panel-body'> 
    	<table id='teacher-table'>
    		<th>Name</th>
    		<th>Age</th>
    		<th>Sex</th>
    	</table>
    </div>
    <div class='panel-body-footer'></div>
    </div>
</div>
