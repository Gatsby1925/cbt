$(document).ready(function(){
	$('#login').submit(function(e){
		var email = this.email.value;
		var password = this.password.value;

		if(email=='' || password==''){
			$('.err_message').css('display','block');
			$('.err_message_text').text('Please fill all the fields!');
			e.preventDefault();
		}
	});

	$('#register').submit(function(e){
		var fname = this.fname.value;
		var lname = this.lname.value;
		var email = this.email.value;
		var password = this.password.value;
		var cpassword = this.cpassword.value;
		var agreed = this.agree.checked;

		if(email=='' || password=='' || fname=='' || lname==''|| cpassword==''){
			$('.err_message').css('display','block');
			$('.err_message_text').text('Please fill all the fields!');
			e.preventDefault();
		}else{
			if(!agreed){
				$('.err_message').css('display','block');
				if(password!=cpassword){
					$('.err_message_text').text('Passwords aren\'t matching.');
				}else{
					$('.err_message_text').text('You must agree to our terms and conditions.');
				}
				e.preventDefault();
			}
		}
	});

	$('.dismiss_message').click(function(){
		$('.err_message').fadeOut();
	});
});