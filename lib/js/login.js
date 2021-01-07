var login = {
	'Init': function() {
		
		var text; 
		
		$('input[name="username"], input[name="password"]').each( function() {
			
			$node = $(this);
			
			text = $node.attr('title'); 
			$node.val(text);
		})
		.focus( function() { login.Focus($(this)); });
		
		$('input[name="username"], input[name="password"]').bind('textchange', function(event) { validate($(this)); });
			
		$('a').fancybox({
			'width': 300,
			'height': 250
		});

		window.onload = function() {
			$('.background').fadeIn('slow'); 
		};
		
	},
	
	'Focus': function($node) {
		
		if ($node.val()== $node.attr('title'))  { $node.val(''); }
		
		//var className = $node.attr('class').split(' ');
		
		if ($node.attr('class')=='password') {
					
			var html = '<input type="password" name="password" />';  
			$node.after(html).remove();
			$('input[name="password"]').focus().bind('textchange', function(event) { validate($(this)); });;
		} 
	}
};

var retrieve = {

	'Init': function() {
		
		$('input[name="email"], input[name="value"]').each( function() {
				
			$node = $(this);
			
			text = $node.attr('title');
			$node.val(text);
			
		}).live('focus', function() { retrieve.Focus($(this)); });
		
		//.focus( function() { retrieve.Focus($(this)); });
		
		$('input[name="value"]').bind('textchange', function(event) { validate($(this)); });
		
		$('#retrieval-form input[type="button"]').bind('click', function() { 
			retrieve.Get($('#retrieval-form'));
		});		
		// $('#retrieval-form').bind('submit', function() { retrieve.Get($(this)) });
	},
	'Focus': function($node) {
		
		if ($node.val()== $node.attr('title')) $node.val('');
			
		if ($node.attr('class')=='password') {
			//alert('class is password')		
			var html = '<input type="password" name="value" />';  
			$node.after(html).remove();
			$('input[name="value"]').focus().bind('textchange', function(event) { validate($(this)); });
		}
	}, 
	'Get': function($form) {
			
		var data = {
			'classpath': '/lib/class/class.credentials.php',
			'method': 'retrieve',
			'email': $form.find('input[name="email"]').val(), 
			'value': $form.find('input[name="value"]').val(),
			'task': $form.find('input[name="task"]').val()
		};
		
		$.ajax({
			url: '/login/ajax.php',
			data: data,
			success: function(data) {
				retrieve.Handler(data);
			},
			dataType: 'json'
		});
	},
	'Handler': function(result) {		
				
		$holder = $('#result-message');
				
		if (result == true) { var imgSrc = '../images/site/icons/checkmark_32_32x32.png', txt = 'An e-mail has been sent to you.', txtColor='green'; }
		else { var imgSrc = '../images/site/icons/error_32x32.png', txt = 'Please try again.', txtColor='red'; }

		$holder.children('div')
			.find('img').attr('src', imgSrc)
			.next('span').css({'color': txtColor}).html(txt).end().end()
		.fadeIn('slow', function() { 
			
			setTimeout( function() {
				$holder.children('div').fadeOut('slow', function() { $(this).find('img').attr('src','').next('span').html(''); });
			}, 2000);	
		});	
	}	
};

var validate = function($node) {	
				
	var str = $node.val(),
	url = '/login/ajax.php',
	data = {classpath: '/lib/class/class.security.php', method: 'alphanumeric', str: str};
	
	$.ajax({
		url: url,
		data: data,
		success: function(data) {
			if (data) $node.removeClass('flagged');
			else $node.addClass('flagged');
		},
		dataType: 'json'
	});		
};