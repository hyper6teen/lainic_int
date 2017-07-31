
function showConfirm(id)
{
	var div = document.getElementById(id);
	div.style.visibility = "visible";
}

function hideConfirm(id)
{
	var div = document.getElementById(id);
	div.style.visibility = "hidden"
}

function changeAppPage(changevalue)
{
	var div;
	var div2;
	var div3;
	
	if (changevalue === "afp1") 
	{
		div = document.getElementById(changevalue);
		div.style.display = 'block';
		div2 = document.getElementById('afp2');
		div2.style.display = 'none';
		div3 = document.getElementById('afp3');
		div3.style.display = 'none';
		
	}
	else if (changevalue === "afp2") 
	{

		div = document.getElementById(changevalue);
		div.style.display = 'block';
		div2 = document.getElementById('afp1');
		div2.style.display = 'none';
		div3 = document.getElementById('afp3');
		div3.style.display = 'none';

	}
	else if (changevalue === "afp3") {

		div = document.getElementById(changevalue);
		div.style.display = 'block';
		div2 = document.getElementById('afp1');
		div2.style.display = 'none';
		div3 = document.getElementById('afp2');
		div3.style.display = 'none';

	}
}


$(document).ready(function(){

	var valid;
	var valid2;
	var valid_skype;

	$('#skype').focusout(function(){

		$.ajax({
			url: baseurl + 'index.php?login/validateSkype',
			method: 'post',
			data: {data: $("input#skype").val()},
			cache: false,
			beforeSend:function()
			{
        		$('#valid').html('<img src="uploads/skype_loading.gif"/>');
    		},complete: function()
    		{
        		
    		},success:function(data)
			{
				if(data === 'invalid')
				{
					$('#skype').addClass('invalid-skype');
					$('#valid').addClass('rejected');
					$('#valid').removeClass('img-responsive img-circle');
					valid_skype = false;
					$('#valid').html('skype account dont exist').fadeIn( 300 ).delay( 5000 ).fadeOut( 400 );
				} 
				else 
				{
					$('#skype').removeClass('invalid-skype');
					$('#valid').removeClass('rejected');
					$('#valid').addClass('img-responsive img-circle');
					$('#valid').html(data).fadeIn( 300 ).delay( 5000 ).fadeOut( 400 );
					valid_skype = true;
				}
			}
		});

	});


	$('.application-form-page-1').keyup(function(){

		valid = 'false';

		$('.req1').each(function(){

			if ($(this).val() === '') 
			{
				valid = 'false';
				return false;
			}
			else
			{
				valid = 'true';
			}

		});
		

		if (valid === 'false') {

			$('#n1').addClass('disabled-btn');
			$(".nav-1 > span").css('background-color', '#d3d3d3');
			$(".nav-2 > span:nth-child(1)").css('background', '#d3d3d3');
			$('#c1').removeClass('check');
		}

		else if(valid === 'true')
		{
			$('#n1').removeClass('disabled-btn');
			$(".nav-1 > span").css('background-color', '#6d0b70');
			$(".nav-2 > span:nth-child(1)").css('background', '-webkit-linear-gradient(left, #6d0b70  , #d3d3d3');
			$('#c1').addClass('check');
			if (valid2 === 'true') {
				$(".nav-2 > span:nth-child(1)").css('background', '#6d0b70');
			}
		}

	});

	$('.application-form-page-1').change(function(){

		valid = 'false';

		$('.req1').each(function(){

			if ($(this).val() === '') {

				valid = 'false';
				return false;
			}
			else
			{
				valid = 'true';
				
			}

		});


		if (valid === 'false') {

			$('#n1').addClass('disabled-btn');
			$(".nav-1 > span").css('background-color', '#d3d3d3');
			$(".nav-2 > span:nth-child(1)").css('background', '#d3d3d3');
			$('#c1').removeClass('check');

		}

		else if(valid === 'true')
		{
			$('#n1').removeClass('disabled-btn');
			$(".nav-1 > span").css('background-color', '#6d0b70');
			$(".nav-2 > span:nth-child(1)").css('background', '-webkit-linear-gradient(left, #6d0b70  , #d3d3d3');
			$('#c1').addClass('check');
			if (valid2 === 'true') {
				$(".nav-2 > span:nth-child(1)").css('background', '#6d0b70');
			}
		}

	});


	$('.application-form-page-2').keyup(function(){

		valid2 = 'false';

		$('.req2').each(function(){

			if ($(this).val() === '') {

				valid2 = 'false';
				return false;
			}
			else
			{
				valid2 = 'true';
				
			}

		});

		if (valid2 === 'false') {

			$('#n2').addClass('disabled-btn');
			$(".nav-2 > span").css('background-color', '#d3d3d3');
			$(".nav-2 > span:nth-child(1)").css('background', '-webkit-linear-gradient(left, #6d0b70  , #d3d3d3');
			$(".nav-3 > span:nth-child(1)").css('background', '#d3d3d3');
			$('#c2').removeClass('check');
		}

		else if(valid2 === 'true')
		{
			$('#n2').removeClass('disabled-btn');
			$(".nav-2 > span").css('background-color', '#6d0b70');
			$(".nav-2 > span:nth-child(1)").css('background', '#6d0b70');
			$(".nav-3 > span:nth-child(1)").css('background', '-webkit-linear-gradient(left, #6d0b70  , #d3d3d3');
			$('#c2').addClass('check');
		}

	});


	$('.application-form-page-2').change(function(){

		valid2 = 'false';

		$('.req2').each(function(){

			if ($(this).val() === '') {

				valid2 = 'false';
				return false;
			}
			else
			{
				valid2 = 'true';
				
			}

		});


		if (valid2 === 'false') {

			$('#n2').addClass('disabled-btn');
			$(".nav-2 > span").css('background-color', '#d3d3d3');
			$(".nav-2 > span:nth-child(1)").css('background', '-webkit-linear-gradient(left, #6d0b70  , #d3d3d3');
			$(".nav-3 > span:nth-child(1)").css('background', '#d3d3d3');
			$('#c2').removeClass('check');
		}

		else if(valid2 === 'true')
		{
			$('#n2').removeClass('disabled-btn');
			$(".nav-2 > span").css('background-color', '#6d0b70');
			$(".nav-2 > span:nth-child(1)").css('background', '#6d0b70');
			$(".nav-3 > span:nth-child(1)").css('background', '-webkit-linear-gradient(left, #6d0b70  , #d3d3d3');
			$('#c2').addClass('check');
		}

	});


	$('.application-form-page-2').keyup(function(){

		valid2 = 'false';

		$('.req2').each(function(){

			if ($(this).val() === '') {

				valid2 = 'false';
				return false;
			}
			else
			{
				valid2 = 'true';
				
			}

		});


		if (valid2 === 'false') {

			$('#n2').addClass('disabled-btn');
			$(".nav-2 > span").css('background-color', '#d3d3d3');
			$(".nav-2 > span:nth-child(1)").css('background', '-webkit-linear-gradient(left, #6d0b70  , #d3d3d3');
			$(".nav-3 > span:nth-child(1)").css('background', '#d3d3d3');
			$('#c2').removeClass('check');
		}

		else if(valid2 === 'true')
		{
			$('#n2').removeClass('disabled-btn');
			$(".nav-2 > span").css('background-color', '#6d0b70');
			$(".nav-2 > span:nth-child(1)").css('background', '#6d0b70');
			$(".nav-3 > span:nth-child(1)").css('background', '-webkit-linear-gradient(left, #6d0b70  , #d3d3d3');
			$('#c2').addClass('check');
		}

	});


	$('.application-form-page-2').change(function(){

		valid2 = 'false';

		$('.req2').each(function(){

			if ($(this).val() === '') {

				valid2 = 'false';
				return false;
			}
			else
			{
				valid2 = 'true';
				
			}

		});

		if (valid2 === 'false') {

			$('#n2').addClass('disabled-btn');
			$(".nav-2 > span").css('background-color', '#d3d3d3');
			$(".nav-2 > span:nth-child(1)").css('background', '-webkit-linear-gradient(left, #6d0b70  , #d3d3d3');
			$(".nav-3 > span:nth-child(1)").css('background', '#d3d3d3');
			$('#c2').removeClass('check');
		}

		else if(valid2 === 'true')
		{
			$('#n2').removeClass('disabled-btn');
			$(".nav-2 > span").css('background-color', '#6d0b70');
			$(".nav-2 > span:nth-child(1)").css('background', '#6d0b70');
			$(".nav-3 > span:nth-child(1)").css('background', '-webkit-linear-gradient(left, #6d0b70  , #d3d3d3');
			$('#c2').addClass('check');
		}

	});


});