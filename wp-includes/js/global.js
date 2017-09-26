jQuery(document).ready(function($) {
    // Внутри этой функции $() будет работать как синоним jQuery()
	
	// Drop list to content articles
	var dropItem = 0;
	$('article.dropInfo').each(function(){
		dropItem++;
		var article = this;	
		var title = $(article).find('.art-postmetadataheader')[0];	
		var icons = $(article).find('.art-postheadericons')[0];	
		var content = $(article).find('.art-postcontent')[0];
		
		if(1 == dropItem){
			$(article).addClass('active');
			
			$(content).show();
			$(icons).show();
		} else {
			$(content).hide();
			$(icons).hide();
		}
		
		$(title).click(function(){
			displayInfo(article);
			return false;
		});
		
	});
	function displayInfo(article){
		$('article.dropInfo').each(function(){
			var elem = this;
			var icons = $(elem).find('.art-postheadericons')[0];	
			var content = $(elem).find('.art-postcontent')[0];
			
			if(elem == article){
				if($(elem).hasClass('active')){
					$(content).hide();
					$(icons).hide();
					$(elem).removeClass('active');
				} else {
					$(content).show();
					$(icons).show();
					$(elem).addClass('active');
				}				
			} else {
				$(content).hide();
				$(icons).hide();
				$(elem).removeClass('active');
			}
		});
	}
	
	// Left Menu
	$('#menu-left-menu li ul' )
	.hide()
	.click(function(event) {
		event.stopPropagation();
	});

	$('#menu-left-menu li').toggle(function() {
		var ul = $(this).find('> ul');
		ul.slideDown();
		$(this).addClass('open');
		if(!ul[0]){
			var a = $(this).find('a');
			location.href = $(a).attr('href');
		}
	}, function() {
		$(this).find('> ul').slideUp();
		$(this).removeClass('open');
	});
	
	var thisPageItem = $('#menu-left-menu').find('a[href="' + window.location.href + '"]')[0];
	if(thisPageItem){
		$(thisPageItem).addClass('active');
		activeMenuItem(thisPageItem)
	}
	function activeMenuItem(item){
		var parentLI = $(item).parent();
		if($(parentLI).is('li')){
			parentLI.addClass('open');
			parentLI.parent().slideDown();
			activeMenuItem(parentLI.parent())
		}
		
	}
});