function PyraxApp(appViewID, appView) {
	
	var appView = JSON.parse(decodeURIComponent(appView));
	if(appView.template == 'undefined') return false;

	var templatePrefix = '#template_';
	var templateHTML = $(templatePrefix + appView.template).html();
	var inputMethod = 'html';	
	var loader = '<i class="fa fa-spinner fa-spin"></i>';

	function init() {
	

		setEventListeners();

		$('body').prepend($(loader).hide().addClass('ajaxLoader'));
		
		$('#' + appViewID).html(Mustache.render(templateHTML, appView.data));
		History.pushState({template: appView.template}, appView.template, window.location.href);
		$( document ).trigger( "pageChange", appView);
		
		
		return;
		
	}
	
	function setEventListeners() {
	
		$(document).on('loadFail', function() {
			
		});
		
	
	    History.Adapter.bind(window,'statechange',function(){
			var targetID 	= appViewID;
	        var State = History.getState();
	        loadLink(State.cleanUrl, State.data.template, targetID, inputMethod);
	    });
	    
	   	$(document).on('click touchstart','a',function(event) {
			if(template = $(this).attr('data-template')) {
				var newhref = $(this).attr('href');
				History.pushState({template: template}, template, newhref);
				event.preventDefault();
			} else {
				// For safari web apps
				event.preventDefault();
				window.location = $(this).attr("href");
			}
		});
		
		$(document).on("submit", "form", function(event){
			var $form = $(this);
		    if((template = $form.attr('data-template')) && (targetID = $form.attr('data-target'))) {
		    	event.preventDefault();
			    postForm($form, template, targetID);
			}
		});

	}
	
	function postForm($form, template, targetID) {
	
		var target = $('#'+ targetID);
		var templateHTML = $(templatePrefix + template).html();
		var inputMethod = $form.attr('data-inputMethod') || inputMethod;
		var submit = $("button", $form);	
		var formLoader = '<i class="fa fa-spinner fa-spin"></i>';
		
		$.ajax({
            "url": $form.attr("action"),
            "data": $form.serialize(),
            "type": $form.attr("method"),
	            beforeSend: function( xhr ) {
					submit.attr('disabled', 'disabled');
					$(":input", $form).attr('disabled', 'disabled');					
					submit.attr('data-text', submit.html());
					submit.html(formLoader)

				},
            	success: function(data){
            		
            		$form.trigger("reset");
					$(":input", $form).removeAttr('disabled');
	                data = JSON.parse(data);
	                if(targetID == appViewID) {
	                	History.pushState({template: data.template}, data.template, data.pageUrl);
	                	window.scrollTo(0, 0);
	                } else {
		                var html = Mustache.render(templateHTML, data.data);
		                target[inputMethod](html);
	                }
				},
				fail: function() {
					alert("Something went wrong, sorry.");
				},
				complete: function() {
					submit.removeAttr('disabled');
					submit.html(submit.attr('data-text'));					
				}
        });
        
	}

	function takingLong() {
	    $(".ajaxLoader").fadeIn(40);
	}
	
	function takingTooLong(href) {
		window.location = href;
	}
	
	function ajaxSuccess() {
		$(".ajaxLoader").hide();
	}
	
	function loadLink(href, template, targetID, inputMethod) {
		
		var target = $('#'+ targetID);
		var templateHTML = $(templatePrefix + template).html();
        
        var timer = setTimeout(takingLong, 80);
        var timerTooLong = setTimeout(function() {
        	takingTooLong(href);
        }, 4000);
        
		$('#'+ targetID).fadeOut(60);
		
		$.ajax({
	        "url": href,
	    	success: function(data){
	    			try {
						var data = JSON.parse(data);
						var html = Mustache.render(templateHTML, data.data);
						if(targetID == appViewID) window.scrollTo(0, 0);
						
						target[inputMethod](html).fadeIn(70);
						$( document ).trigger( "pageChange", data);
					}
					catch(e) {
						console.log(e);
						History.back();
						$(document).trigger('loadFail');
					}
					
					ajaxSuccess();
					clearTimeout(timer);
					clearTimeout(timerTooLong);
					
			},
			error: function() {
				History.back();
				$(document).trigger('loadFail');
			},
			complete: function() {
				return;					
			}
		});
	}

	init();
	
}