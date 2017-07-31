



<html>
<head>
	<title></title>

	<script type="text/javascript">

	(document).ready(function(){
	var errors = false;
    $('.required').parent().find('.input').on('blur', function() {
        var error_div = $(this).parent().find('.error_message');
        var field_container = $(this).parent();
        if (!$.empty_field_validation($(this).val())) {
            error_div.html('This field is required.');
            error_div.css('display', 'block');
            field_container.addClass('error');
			errors = true;
        } else {
            error_div.html('');
            error_div.css('display', 'none');
            field_container.removeClass('error');
			errors = false;
        }
    });
    $('#email').on('blur', function(){
        var error_div = $(this).parent().find('.error_message');
        var field_container = $(this).parent();
        if (!$.email_validation($(this).val())) {
            error_div.html('Expected Input: email');
            error_div.css('display', 'block');
            field_container.addClass('error');
			errors = true;
        } else {
            error_div.html('');
            error_div.css('display', 'none');
            field_container.removeClass('error');
			errors = false;
        }
    });
	$('#contact_form').submit(function(event) {
		event.preventDefault();
		 $('.required').parent().find('.input').trigger('blur');
        if (!errors)
            $.ajax({
                url: '/echo/json/',
                data: {
                    json: JSON.stringify($(this).serializeObject())
                },
                type: 'post',
                
                success: function(data) {
                    var message = 'Hi '+data.name+'. Your message was sent and received.';
                    $('#after_submit').html(message);
                    $('#after_submit').css('display', 'block');
                },
                error: function() {
                    var message = 'Hi '+data.name+'. Your message could not be sent or received. Please try again later';
                    $('#after_submit').html(message);
                    $('#after_submit').css('display', 'block'); 
                }
            });
		else
			alert("You didn't completed the form correctly. Check it out and try again!");
	});
});

$.empty_field_validation = function(field_value) {
    if (field_value.trim() == '') return false;
    return true;
}
    
$.email_validation = function(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
$.fn.serializeObject = function()
{
   var o = {};
   var a = this.serializeArray();
   $.each(a, function() {
       if (o[this.name]) {
           if (!o[this.name].push) {
               o[this.name] = [o[this.name]];
           }
           o[this.name].push(this.value || '');
       } else {
           o[this.name] = this.value || '';
       }
   });
   return o;
};

</script>
</head>



<style type="text/css">

body{
    width: 414px;
    font-family: Arial;
	font-size: 14px;
}
#after_submit, #email_validation, #name_validation {
    display:none;
}

#after_submit{
    background-color: #c0ffc0;
    line-height: 31px;
    margin-bottom: 10px;
    padding-left: 20px;
    -webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}

label, #after_submit{
	color: #6c6c6c;
}

input{
    line-height: 31px;
}

input, textarea{
    width: 288px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	background-color: rgba(255,255,255,.6);
	border: solid 1px #b6c7cb;
}

#contact_form{
	height: 317px;
	background-color: #e1e9eb;
	border: solid 1px #e5e5e5;
    padding: 10px 20px 50px 20px;
    -webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}

#submit_button{
    width: 109px;
	height: 34px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	background-color: #86c5fa;
	-webkit-box-shadow: inset 0 2px rgba(255,255,255,.29);
	-moz-box-shadow: inset 0 2px rgba(255,255,255,.29);
	box-shadow: inset 0 2px rgba(255,255,255,.29);
	border: solid 1px #77a4cb;
	font-weight: bold;
	color: #fff;
    margin-left: 7px;
}

label.required:after {
  content:'*';
  color:red;
}

.error {
  background-color:#FFDFDF;
  color:red;
}
.error_message{
  font-style: italic;
  font-size: 10px;
}
.row {
  margin:5px;
}


</style>

<body>

	<div id="after_submit"></div>
<form id="contact_form" action="#" method="POST" enctype="multipart/form-data">
  <div class="row">
    <label class="required" for="name">Your name:</label><br />
    <input id="name" class="input" name="name" type="text" value="" size="30" /><br />
    <span id="name_validation" class="error_message"></span>
  </div>
  <div class="row">
    <label class="required" for="email">Your email:</label><br />
    <input id="email" class="input" name="email" type="text" value="" size="30" /><br />
    <span id="email_validation" class="error_message"></span>
  </div>
  <div class="row">
    <label class="required" for="message">Your message:</label><br />
    <textarea id="message" class="input" name="message" rows="7" cols="30"></textarea><br />
    <span id="message_validation" class="error_message"></span>
  </div>
    
    <input id="submit_button" type="submit" value="Send email" />
</form>


</body>



</html>