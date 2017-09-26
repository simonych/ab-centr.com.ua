/*
*

Author - Abhin Sharma (WPTitans)
Description - Contains global functions

This code cannot be used anywhere without the permission of the Author.

*
*/

// Contains global js rountines for our themes. 

var hadesRountines = {
	
	showloadingIcon : function(){  jQuery('.ajax_loading_icon').css('visibility','visible').animate({opacity:1},'slow');  },
	hideloadingIcon : function(){  jQuery('.ajax_loading_icon').animate({opacity:0},'slow',function(){ $(this).css('visibility','hidden') });  }		
	
	};

jQuery(function($){

/* ========================================================================================================= */	
/* ================================= Code to invoke default WP Uploader ==================================== */	
/* ========================================================================================================= */
	
var pID = jQuery('#post_ID').val(),ed,temp,wp_default_send_to_editor, override = false;

// Listen to click for upload 
jQuery('.custom_upload_image_button').live('click',
       function (e) {
		  temp = jQuery(this); 
		  override = true; // notify we are using the uploading system
		  
		  wp_default_send_to_editor = window.send_to_editor;
		  
          window.send_to_editor = function (html) {
          
		    if(override==true) {
		        imgurl = jQuery('img', html).attr('src');
                temp.prev().val(imgurl);
			    override = false;
		    }
		    else {
			   wp_default_send_to_editor(html);
			     }
			
			tb_remove();
        
		}
      
tb_show('', 'media-upload.php?TB_iframe=true&type=image&width=650&height=500');

return false;
		
		
    });

/* ========================================================================================================= */	
/* == Gallery Functionality ================================================================================ */	
/* ========================================================================================================= */
 
 if($("#exgallery_credits_meta").length>0 || $(".slideable").length>0) {
 
 // Make it before WP Editor
	$("#exgallery_credits_meta").insertBefore("#postdivrich");
	
	var temp,slide = $("#hades_gallery .slider-lists>ul>li:first").clone().removeClass('hide'),hgallery=$("#hades_gallery");
	
	// get a slide and reset it
	slide.find("input[type=text]").val('');
	slide.find("textarea").html('');
	slide.find("img").attr('src','');
	slide.find('.slide-toggle-button').removeClass('max-slide-button').addClass('min-slide-button').html('Collapse');
	
	
	hgallery.find("  .contract .slide-body").hide();
	hgallery.find( ".slider-lists>ul" ).sortable({
			placeholder: "drag-highlight"
		});
		
	hgallery.find("#addslide").click(function(e){
		    temp = slide.clone();
	    	$(".slider-lists>ul").append(temp);
		    e.preventDefault();
		});
		
	hgallery.find(".slide-toggle-button").live('click',function(e){
		temp = $(this);
		
		  $(this).parent().next().slideToggle('normal',function(){ 
	    		if($(this).is(":visible"))
		          temp.html("Collapse").removeClass('max-slide-button').addClass('min-slide-button');
		        else
		          temp.html("Expand").addClass('max-slide-button').removeClass('min-slide-button');
		
		 });
		e.preventDefault();
	});	
			
	hgallery.find(".removeslide").live("click",function(e){
		
		$(this).parents("li").remove();
		
		e.preventDefault();
		});		
	
 }
		
		$('.delete').live('click',function(e){ $(this).parents("li").fadeOut('normal',function(){ $(this).remove();  }); return false; });	

// == Shortcode Importer function ===================


$(".import_shortcode").live("click",function(){
			
			ed = tinyMCE.activeEditor;
			ed.focus();
			ed.execCommand('mceInsertContent', false, $(this).prev().val());
			
			});
	
$(".done_shortcode").live("click",function(){
		  
		 
		  if($(".shortcode_value").val()=="image")
		  {
			   var temp = jQuery("#TB_ajaxContent"),button = "[button borderRadius='"+$("#shortcode_border_radius").val()+"px' background='"+rgb2hex(temp.find("#bgcolorSelector>div").css("background-color"))+"'  border='"+rgb2hex(temp.find("#bgcolorSelector>div").css("background-color"))+"' color='"+rgb2hex(temp.find("#colorSelector>div").css("background-color"))+"' link='"+temp.find("#shortcode_link").val()+"'  size='small'] "+temp.find("#button_title").val()+" [/button] ";
			   
			  ed = tinyMCE.activeEditor;
			ed.focus();
			ed.execCommand('mceInsertContent', false, button);
		  }
		  else if($(".shortcode_value").val()=="list")
		  {
			   var temp = jQuery("#TB_ajaxContent"),button = "[list style='"+temp.find("#shortcode-list-preview").val()+"'] insert your list [/list] ";
			   
			  ed = tinyMCE.activeEditor;
			ed.focus();
			ed.execCommand('mceInsertContent', false, button);
		  }
		   else if($(".shortcode_value").val()=="contact")
		   {
			     var temp = jQuery("#TB_ajaxContent"),form = "[contactform id='"+temp.find("#shortcode-contact-preview").val()+"' /] ";
			 ed = tinyMCE.activeEditor;
			ed.focus();
			ed.execCommand('mceInsertContent', false, form); 
		   }
		     else if($(".shortcode_value").val()=="slider")
		   {
			     var temp = jQuery("#TB_ajaxContent"),form = "[titan_slider name='"+temp.find("#shortcode-contact-preview").val()+"' /] ";
			 ed = tinyMCE.activeEditor;
			ed.focus();
			ed.execCommand('mceInsertContent', false, form); 
		   }
		    else if($(".shortcode_value").val()=="tables")
		   {
			     var temp = jQuery("#TB_ajaxContent"),form = "[megatables id='"+temp.find("#shortcode-contact-preview").val()+"' /] ";
			 ed = tinyMCE.activeEditor;
			ed.focus();
			ed.execCommand('mceInsertContent', false, form); 
		   }
		  
			tb_remove();
		
		});	


$("#shortcode-list-preview").live("change",function(){
	
	$("#list-preview").removeClass();
	$("#list-preview").addClass($(this).val()+" styled");
	
	});
	
if($('.ev_datepicker').length>0)
{
	var temp;
	
	$('.ev_datepicker').datepicker({
		changeMonth: true,
		changeYear: true,
	altFormat: 'dd-mm-yy'  , dateFormat: 'dd-mm-yy'
		});
	
	$("#all_data_event0").click(function(){
		
		if($(this).is(":checked"))
		{
			 temp = $(this).parents('.hades_input').next().hide();
			 temp.next().hide();
		}
		else
		{
			temp = $(this).parents('.hades_input').next().show();
			temp.next().show();
		}
		
		});
		
	$("#recurring0").click(function(){
		
		if(!$(this).is(":checked"))
		{
			 temp = $(this).parents('.hades_input').next().hide();
			
		}
		else
		{
			temp = $(this).parents('.hades_input').next().show();
			
		}
		
		});	
		
		
		if(!$("#recurring0").is(":checked"))
		 $("#recurring0").parents('.hades_input').next().hide();
		else
		 $("#recurring0").parents('.hades_input').next().show();
		
		
		if($("#all_data_event0").is(":checked"))
		{
			 temp = $("#all_data_event0").parents('.hades_input').next().hide();
			 temp.next().hide();
		}
		else
		{
			temp = $("#all_data_event0").parents('.hades_input').next().show();
			temp.next().show();
		}
	
}

});


function rgb2hex(rgb){
 rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
 return "#" +
  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2);
}