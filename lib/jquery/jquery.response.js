//(function($holder) {
	
$holder = $('#result-message');

var message = {
	"success": function(result,message) {
					
		if (result) { var imgSrc = '../images/site/icons/checkmark_32_32x32.png', txt = 'Your info has been e-mailed to you.', txtColor='green'; }
		else { var imgSrc = '../images/site/icons/error_32x32.png', txt = 'Something\'s not right, please try again.', txtColor='red'; }

		$holder.children('div')
			.find('img').attr('src', imgSrc)
			.next('span').css({'color': txtColor}).html(txt).end().end()
		.fadeIn('slow', function() { 
			
			setTimeout( function() {
				$holder.children('div').fadeOut('slow', function() { $(this).find('img').attr('src','').next('span').html(''); });
			}, 2000);	
		});	
	}
}
	
//})();