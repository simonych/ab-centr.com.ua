<?php 

$path = __FILE__;
$pathwp = explode( 'wp-content', $path );
$wp_url = $pathwp[0];
require_once( $wp_url.'/wp-load.php' );

?>
/*
*

Author - Abhin Sharma (WPTitans)
This code cannot be used anywhere without the permission of the Author.

*
*/

/* ========================================================================================================= */	
/* == Options Panel JS  Code =============================================================================== */	
/* ========================================================================================================= */

jQuery(document).ready(function($){
	
	$('#content').css('height',320 + 'px');
});


jQuery(document).ready(function($){  
$('#hades_option_form').jqTransform({imgPath:'../css/i/'}); });

jQuery(function($) {
	
    $("#useful-linklist li").click(function(){
    var link = $(this).find(".link").val();
    window.open(link);
    });
    
	
		   	   
	
	var temp,radio = $(".radio"),path = $("#option_path").val();
	var loading_icon = $(".ajax_loading_icon");
	
	$(".admin-button").click(function(e){
	
    var ed,home_content;

	if ( typeof tinyMCE != 'undefined' && ( ed = tinyMCE.activeEditor ) && !ed.isHidden() ) {
    home_content = ed.getContent();
    ed.focus();
    }
    else
    {
    home_content = $("#content").val();
    }
	$("#hades_home_text").val(home_content);
	
	
	$(".success_message").css({ "visibility":"hidden" , "opacity":0  });
	$('html, body').animate({scrollTop:0}, 'normal',function(){
		loading_icon.css("visibility","visible").animate({ opacity: 1 },"slow");
		
		
		$.post( path , {  action:"save" , values: $("#hades_option_form").serializeArray()  },
			  function(data){
				
				
				 loading_icon.animate({ opacity: 0 },"slow", function(){
					  $(this).css("visibility","hidden")
					  $(".success_message").css("visibility","visible").animate({ opacity:1 , height:40 },"slow",function(){
                      
                      $(".success_message").delay(3000).animate({opacity:0,height:0},'normal',function(){  $(this).css('visibility','hidden'); })
                      
                      });
					 
					 });
				  }
			  );
		
		});
	
	return false;
	});
	
	
	
	 $(".panel-reset").click(function(e){
		 $(".reset-form").submit();
		 e.preventDefault();
		 });
	 
		
	$( "#hades_opts" ).tabs();	
	
	var home_layout = $("#<?php echo SN; ?>_home_layout").val();
	if(home_layout=="")
	home_layout = "full-width";
	
	$(".home-layout").find("."+home_layout).addClass('active');
	
	var footer_layout = $("#hades_footer_layout").val();
	if(footer_layout=="")
	footer_layout = "two-col";
	
	$(".footer-layout").find("."+footer_layout).addClass('active');
	
	var plain_theme = $("#hades_plain_theme").val();
	if(plain_theme=="")
	plain_theme = "azure";
	
	$("#visual_plain_panel ").find("."+plain_theme+" img").addClass('active');
	
	var textured_theme = $("#hades_textured_theme").val();
	if(textured_theme=="")
	textured_theme = "aura";
	
	$("#visual_textured_panel ").find("."+textured_theme+" img").addClass('active');
	
	
	$( ".hades_input .hades_slider" ).each(function(){
		temp = $(this);
		temp.slider({
				value: parseInt(temp.parent().find(".slider-val").val()),
				min: 0,
				max:  parseInt(temp.parent().find(".max-slider-val").val()),
				
				slide: function( event, ui ) {
					$(this).parent().find(".slider-text").val(ui.value);
				}
			});
		
		});
	
   
	 
   $('.colorpickerField1').ColorPicker({

	onSubmit: function(hsb, hex, rgb, el) {

		$(el).val(hex);

		$(el).ColorPickerHide();

	},

	onBeforeShow: function () {
       temp = this;
		$(this).ColorPickerSetColor(this.value);

	},
	
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(300);
		return false;
	},
	onChange: function (hsb, hex, rgb,el) {
		$(temp).val(hex);
		$(temp).parents('.hades_input').find('.colorSelector>div').css('backgroundColor', '#' + hex);
	}

})

.bind('keyup', function(){

	$(this).ColorPickerSetColor(this.value);

});


$("input[name=<?php echo SN; ?>_blurb_button_link]").click(function(){ temp = ($(this).val());
  $('.blurb-options').hide();
  switch(temp)
  {
	  case "Link to a page": $(".b-link").show(); break;
	  case "Custom link": $(".b-custom").show(); break;
	  case "Open in lightbox":$(".b-lightbox").show();  break;
  }

 });

 $('.blurb-options , .h-options').hide();
$("input[name=<?php echo SN; ?>_blurb_button_link]").each(function(){
	
 if($(this).is(":checked"))	
  switch($(this).val())
  {
	  case "Link to a page": $(".b-link").show(); break;
	  case "Custom link": $(".b-custom").show(); break;
	  case "Open in lightbox":$(".b-lightbox").show();  break;
  }
	
	});

$("input[name=<?php echo SN; ?>_stage_option]").each(function(){
	
 if($(this).is(":checked"))	
  switch($(this).val())
  {
	 case "Slider": $(".h-slider").show(); break;
	  case "Static Image": $(".h-upload").show(); break;
	  case "Title": $(".h-title").show(); break;
	  case "Half Stage": $(".h-staged").show(); break;
  }
	
	});
	
	
$("input[name=<?php echo SN; ?>_stage_option]").click(function(){ temp = ($(this).val());
  $('.h-options').hide();
  switch(temp)
  {
	  case "Slider": $(".h-slider").show(); break;
	  case "Static Image": $(".h-upload").show(); break;
	  case "Title": $(".h-title").show(); break;
	  case "Half Stage": $(".h-staged").show(); break;
  }



 });




$(window).load(function(){
	
	 $("#editorcontainer").contents().find("iframe").height(320);

	
	});

$(".home-layout li a").click(function(e){
	$(".home-layout li").removeClass('active');
	$("#<?php echo SN; ?>_home_layout").val($(this).parent().attr('class'));
	$(this).parent().addClass('active'); 
	
	e.preventDefault();
	});

$(".footer-layout li a").click(function(e){
	$(".footer-layout li").removeClass('active');
	$("#hades_footer_layout").val($(this).parent().attr('class'));
	$(this).parent().addClass('active'); 
	
	e.preventDefault();
	});


$("#visual_plain_panel ul li a").click(function(e){
	
	$("#visual_plain_panel li img").removeClass('active');
	$("#hades_plain_theme").val($(this).attr('href'));
	$(this).children("img").addClass('active'); 
	
	e.preventDefault();
	});  

$("#visual_textured_panel ul li a").click(function(e){
	
	$("#visual_textured_panel li img").removeClass('active');
	$("#hades_textured_theme").val($(this).attr('href'));
	$(this).children("img").addClass('active'); 
	
	e.preventDefault();
	});  
 
});

