<?php

/* =================================================================== */
/* ========================== Font Manager =========================== */
/* =================================================================== */

/*

Author - Abhin Sharma ( WPTitans )

*/

add_action('admin_init', 'fontmanager_add_init');
add_action('admin_menu', 'fontmanager_add_admin');

function fontmanager_add_admin() {
	 	add_submenu_page("elements.php","Font Manager","Font Manager", 'administrator',"font_manager", 'fontmanager_admin');
}



function fontmanager_add_init() { 
    
	$path = URL;
  
	if(isset($_GET['page'])&&($_GET['page']=='font_manager')){	
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_style( 'uploadify-css',$path.'/sprites/js/uploadify/uploadify.css',false);
	wp_enqueue_script('uploadify-swfobject',$path.'/sprites/js/swfobject.js', array('jquery'), '0.1' );
	wp_enqueue_script('uploadify',$path.'/sprites/js/uploadify/jquery.uploadify.min.js', array('jquery'), '0.1' );
	
	}
	

}

function init_uploadify()
{
	$path = URL;
	?>
	
    <script type="text/javascript">
	jQuery(document).ready(function($) {
		  var name ;
		  var path = '<?php echo $path ?>/sprites/js/cufon-fonts/';
		  jQuery('#file_upload').uploadify({
		  'swf' : '<?php echo $path ?>/sprites/js/uploadify/uploadify.swf',
		  'uploader' : '<?php echo $path ?>/sprites/js/uploadify/uploadify.php',
		  'cancelImage' : '<?php echo $path ?>/sprites/js/uploadify/cancel.png',
		  'fileTypeExts' : '*.js',
		  'onUploadSuccess' : function(stats){
			  
			  if(jQuery.trim(stats.name)=="")
			  return;
			  
			  name = "custom_"+stats.name;
			  jQuery(".uploaded-fonts").append("<p class='clearfix'><a href='#' class='delete' /></a><input type='hidden' name='font_name[]' value='"+name+"'/> <span> "+stats.name+" </span> </p>");
			  
			  },
		  'multi':true,
		  'auto' : true
		  });
		  
		  
$(".uploaded-fonts a.delete").live("click",function(e){
		$(this).parent().remove();
		e.preventDefault();
		});

	});
    </script>

	
	<?php
}
if(isset($_GET['page'])&&($_GET['page']=='font_manager'))
add_action("admin_head","init_uploadify");

function fontmanager_admin() {
   
	if(isset($_POST["action"]))
	{
		$arr_font = $_POST["font_name"];
		update_option(SN."_custom_fonts", $arr_font);
	}
	$custom_fonts = get_option(SN."_custom_fonts");
	if(!is_array($custom_fonts))  $custom_fonts = array();
	
   if(isset($_POST["action"])) echo '<div class="success_message"><p><strong>Saved.</strong></p></div>'; ?>
      
  <div class="hades_wrap fontmanager">
    <div class="hades-panel">
    
    <div class="notice-bar">
    <p>Font Manager : 1.0 </p>
    </div>
    
    <div class="hades-panel-body clearfix">
      <p class="hades_information"><?php _e('To add a font first ','h-framework');?><a href="http://cufon.shoqolate.com/generate/">http://cufon.shoqolate.com/generate/</a> <?php _e(', convert the font into cufon javascript file and upload it here.','h-framework');?></p> 
    
    <div id="font-panel-wrapper" class="clearfix">
        <form method="post"  enctype="multipart/form-data" action="" class="clearfix" >
          
          <div class="clearfix">
            <input name="save" type="submit" value="Save changes" class="hades-primary-button" />  
          </div>
          
        
          <div class="upload-area clearfix"> 
            <label for="file_upload"><?php _e('Upload Cufon Font','h-framework');?></label>
            <input id="file_upload" name="file_upload" type="file" />
          </div>
        
          <div class="uploaded-fonts">
			<?php foreach($custom_fonts as $fonts) : 
            $key = substr ($fonts,7); 
            echo "<p class='clearfix'><a href='#' class='delete' /></a><input type='hidden' name='font_name[]' value='".$fonts."'/> <span> ".$key." </span> </p>";
            
            endforeach; ?>
          </div>
          
          <input type="hidden" value="save" name="action" />
        </form>
    
    </div>
  
  </div> 
	  
      
	  <?php
	
	
	 }