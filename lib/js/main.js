// JQuery Based Local JS Library

// ************************************************************************************************************************
// BEGIN: augment the prototype with basic methods (if methods don't already exist within included libraries)
// ************************************************************************************************************************
Function.prototype.method = function(name, func) {
	if (!this.prototype[name]) {
		this.prototype[name] = func;
	}
};

Number.method('integer', function() {
	return Math[this < 0 ? 'ceil' : 'floor'](this);
});

String.method('trim', function() {
	return this.replace(/^\s+|\s+$/g, '');
});

Number.method('isEven', function() {
	return (this % 2)==0 ? true : false;
});

Number.method('isOdd', function() {
	return (this % 2)==0 ? false : true;
});
// ************************************************************************************************************************
// END: augment the prototype with basic methods (if methods don't already exist within included libraries)
// ************************************************************************************************************************

function removeText(id1,type) { // allows instructions within form fields to be removed onFocus
	var thisElement = $(id1);
	var elname = thisElement.name;
	thisElement.value = '';
	thisElement.onfocus = '';
		
	if (type == 'password') { // since "type" attribute is read only in IE7, rebuild the entire element
		var thisParent = thisElement.parentNode;
		thisParent.innerHTML = '';
		thisParent.innerHTML = '<input id="' + id1 + '" name="' + elname + '" type="password">';
		$(id1).activate(); // javascript standard 'focus()' did not work in IE7, use prototype method instead	
	}
}

/*
---------------------------------------------------------------------------------------------------------------------------
BEGIN: methods to be run on page load
---------------------------------------------------------------------------------------------------------------------------
*/
$(function() {
	
	$("a#settings").fancybox({ 
		'hideOnContentClick': true			
	});
	
	// universal method to show hidden content
	$(".switch").bind('click', function(event){
		
		event.preventDefault();
		
		var wrapperId = this.id.replace('_switch','_wrapper');
				
		$('#' + wrapperId).slideToggle("slow");
		$(this).toggleClass("active");
	});
	
	$('#messages').linkify();
	
});

// turns mesage board urls into links

 var url1 = /(^|&lt;|\s)(www\..+?\..+?)(\s|&gt;|$)/g, url2 = /(^|&lt;|\s)(((https?|ftp):\/\/|mailto:).+?)(\s|&gt;|$)/g,

  linkifyThis = function () {
		  
	var childNodes = this.childNodes,
		i = childNodes.length;
	while(i--) {
	  var n = childNodes[i];
	  if (n.nodeType == 3) {
		var html = $.trim(n.nodeValue);
		if (html) {
		  html = html.replace(/&/g, '&amp;')
					 .replace(/</g, '&lt;')
					 .replace(/>/g, '&gt;')
					 .replace(url1, '$1<a target="_blank" href="http://$2">$2</a>$3')
					 .replace(url2, '$1<a target="_blank" href="$2">$2</a>$5');
		  $(n).after(html).remove();
		}
	  }
	  else if (n.nodeType == 1  &&  !/^(a|button|textarea)$/i.test(n.tagName)) {
		linkifyThis.call(n);
	  }
	}
  };

$.fn.linkify = function () { 
return this.each(linkifyThis);
};
/*
---------------------------------------------------------------------------------------------------------------------------
END: methods to be run on page load
---------------------------------------------------------------------------------------------------------------------------
*/

/******************************************************************************************************************************
BEGIN: messageboard methods
******************************************************************************************************************************/
function datediff(date1,date2,interval) {
    var second=1000, minute=second*60, hour=minute*60, day=hour*24, week=day*7;
    date1 = new Date(date1);
    date2 = new Date(date2);
    var timediff = date2 - date1;
    if (isNaN(timediff)) return NaN;
    switch (interval) {
        case "years": return date2.getFullYear() - date1.getFullYear();
        case "months": return (
            ( date2.getFullYear() * 12 + date2.getMonth() )
            -
            ( date1.getFullYear() * 12 + date1.getMonth() )
        );
        case "weeks"  : return Math.floor(timediff / week);
        case "days"   : return Math.floor(timediff / day); 
        case "hours"  : return Math.floor(timediff / hour); 
        case "minutes": return Math.floor(timediff / minute);
        case "seconds": return Math.floor(timediff / second);
        default: return undefined;
    }
}

var mb = {
	
	interval: -5,
	
	Init: function(id) {
		var $node, postid, post;
		$('#messages li').each( function() {
			var $node = $(this);
			$node.hover(function() { mb.Hover($node, id); }, function() {  });	
		});
		
		$('#edit-form textarea').bind('blur', function() {
									
			mb.Update();
			mb.Close();	
		});
	},
	Get: function(showpage) {
		
		var url = '/messageboard/ajax.php',
		data = { classpath: '/lib/class/class.messageboard.php', method: 'getPosts', showpage: showpage };
		
		$.ajax({
		  type: "GET",
		  url: url,
		  data: data,
		  dataType: "json",
		  success: function(data){ mb.Handler(data) }
		});

	},
	Handler: function(data) {
		$('#index').html(data.indexBox);
		$('#messages').html(data.messages);
		$('#messages').linkify();
		//linkifyThis();
	},
	Hover: function($node, id) {
		
		if ($node.find('span.memberid').text() == id) { 
					
			var date = $node.find('span.date').text();
			var time = $node.find('span.time').text();
			
			var thisDate = new Date();
			var thatDate = new Date(date + " " + time); 
					
			if ( datediff(thisDate, thatDate, 'minutes') > mb.interval ) {
				$node.css({ cursor: 'pointer' })
				.bind('click', function() {
					mb.Open($node);
				})
			}	
		}
	},
	Open: function($node) {
		var pos = $node.offset();	
		var width = $node.outerWidth();
		var height = $node.height();
		var post = $node.find('div').text();
		var postid = $node.attr('id');
		$('#edit-form').css({ top: pos.top, left: pos.left, width: width, height: height, display:'block' })
			.find('input').val(postid).end()
			.find('textarea').val(post).focus();
			
	},
	Close: function() {
		$('#edit-form').css({ display:'none' });
	},
	Update: function() {	
		var arr = $('#edit-form').serializeArray(),
		url = '/messageboard/update.php';		
				
		$.post( url, arr, function() {
			var id = arr[0].value;
			var post = arr[1].value;
			
			$('#' + id).find('div').text(post);
		});	
	}
};
/******************************************************************************************************************************
END: messageboard methods
******************************************************************************************************************************/