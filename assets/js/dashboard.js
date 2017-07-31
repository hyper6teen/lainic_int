
function getMenu(id, user)
{
	
	$(document).ready(function(){

	$('#' + id).click(function(){

		$.ajax({

		//url: 'www.google.com',
	    url: 'index.php?'+ user +'/' + id,
	    
	    success: function(data) {
	     
		    $('.panel-body').html(data);
	    	
	   	}

		});

	});


});


}

