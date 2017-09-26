<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');

function mytheme_add_admin() {
	
	global $themename, $shortname, $options;
 	
	if ( isset($_GET['page']) &&  $_GET['page'] == basename(__FILE__) &&   isset($_GET['activation']))
	{
		$force_options = array(
		
		        SN."_body_font" => "PT Sans",
				SN."_custom_font" => "PT Sans",
				SN."_fancy_font" => "Dancing Script",
		
		);
		
		foreach ($options as $value) 
		{
			if(!get_option($value['id']))
			update_option( $value['id'],  $value['std']  );
		}
		foreach ($force_options as $key => $v ) 
		{
			if(!get_option($key))
			update_option( $key,  $v  );
		}
		
		
		$appendable = '&activated=true';
		header("Location: admin.php?page=elements.php&saved=true{$appendable}");
		die;
	}
	
	if ( isset($_GET['page']) &&  $_GET['page'] == basename(__FILE__) ) {
 		if ( isset($_REQUEST['action']) &&  'save' == $_REQUEST['action'] ) {
 			
			foreach ($options as $value) 
			update_option( $value['id'], $_REQUEST[ $value['id'] ] );
			
 			foreach ($options as $value) {
		
				if( isset( $_REQUEST[ $value['id'] ] ) ) { 
				update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
				} 
				else {				
				 delete_option( $value['id'] );
				}
			
		 }
 		header("Location: admin.php?page=elements.php&saved=true");
		die;
 	} 
	else if(  isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
			delete_option( $value['id'] ); }
 		header("Location: admin.php?page=elements.php&reset=true");
		die;
 		}
	}
 	add_menu_page($themename, $themename." Options", 'administrator', basename(__FILE__), 'mytheme_admin', HURL."/css/i/icon.png");
}



function mytheme_add_init() {

	
	
	if(isset($_GET['page'])&&$_GET['page']=='elements.php')
	{
	   wp_deregister_script('jquery-ui-tabs');
	   wp_enqueue_script("jquery-ui-widget", HURL."/js/jquery.ui.widget.min.js", array('jquery','jquery-ui-core'), "1.0");
	   wp_enqueue_script("jquery-ui-tabs", HURL."/js/jquery.ui.tabs.min.js",array('jquery','jquery-ui-core','jquery-ui-widget'), "1.0");
       wp_enqueue_script("jquery-ui-mouse", HURL."/js/jquery.ui.mouse.min.js",array('jquery','jquery-ui-core','jquery-ui-widget'), "1.0");
	   wp_enqueue_script("jquery-ui-slider", HURL."/js/jquery.ui.slider.min.js",array('jquery','jquery-ui-core','jquery-ui-widget','jquery-ui-mouse'), "1.0");
	   wp_enqueue_script("jquery-jqtransform", HURL."/js/jquery.jqtransform.js",array('jquery'), "1.0");
	   wp_enqueue_script("hadesscript", HURL."/js/hades_script.php", array('jquery','jquery-ui-tabs','jquery-ui-slider','jquery-jqtransform'), "1.0");
	   wp_enqueue_script("admin-colorpicker",HURL."/js/colorpicker.js",array('jquery'),"1.0");
	   wp_enqueue_style("colorpicker-style", HURL."/css/colorpicker.css", false, "1.0", "all");
	   wp_enqueue_style("themeoptions-css", HURL."/css/hades.css", false, "1.0", "all");
	   wp_enqueue_style("jqtransform-css", HURL."/css/jqtransform.css", false, "1.0", "all");
	   
	   wp_enqueue_script("thickbox");
	   wp_enqueue_style("thickbox");
	 }
	
}


function mytheme_admin() {

// == Global variable scope declaration and variable declaration ============================
 
global $themename, $shortname, $options;
$i=0; 

?> 

<div class="success_message"><p><strong> Theme Settings Saved ! </strong></p></div> <?php
if ( isset($_REQUEST['reset']) ) echo '<div class="hades_information"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
?>

<?php if(isset($_GET['activated'])) : ?>

<div class="success_message show"><p> Welcome to <?php echo $themename; ?>, if you have a fresh install goto <a href="<?php echo get_admin_url()."admin.php?page=visual_import";?>">Titan Installer</a> located in side menu last menu item and set up site in matter of minutes. If you have already content present, be sure to read the docs and enjoy the theme. </p>  </div>		

<?php endif;?>

<div class="hades_wrap">
    <div id="hades_theme">
         <div class="hades-head clearfix">
              <span class="ajax_loading_icon"></span>
              <input type="hidden" value="<?php echo HURL."/option_panel/ajax.php" ?>" id="option_path" />
              
            
              
         </div>
        
         <div class="notice-bar">
              <p>Option Panel Version : 6.2 </p>
         </div>
    
    <div id="hades_opts" class="clearfix">
  
      <ul id="themenav" class="clearfix">
      
      
       
	  <?php
	
		foreach ($options as $value)
		{
			if($value['type']=="section") { ?>
			<li>
                <a href="#<?php echo str_replace(" ","",$value['name']); ?>" id="menu_<?php echo str_replace(" ","",$value['name']); ?>"> 
                    <?php _e( $value['name'], 'h-framework'); ?>
                </a>
            </li>
            <?php  }  
		}
	   ?>
       
    
       
       
      </ul>
      
      
     <div id="panel-wrapper" class="clearfix">
       
        <form method="post"  enctype="multipart/form-data" action="" class="clearfix" id="hades_option_form" >
    
     	<?php 
		$newoptions  = $options; // php 4.4 fix
		$sidemenu_Flag = true; $description = '';
		foreach ($newoptions as $value) {
			switch ( $value['type'] ) {
 				case "open":?> <?php $sidemenu_Flag = true; 
					  break; 
 				case "close": $description = ''; ?> </div></div></div>
					  <?php break;
 			
  				case 'text': ?>
  						
							<div class="hades_input clearfix  <?php echo $value['parentClass']; ?>">
								<label for="<?php echo $value['id']; ?>"><?php _e( $value['name'] , 'h-framework'); ?></label>
 								<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
 							
                            <?php if($value['desc']!="") { ?>
                            <small><span>  <?php _e( $value['desc'] , 'h-framework'); ?></span></small>
 						    <?php } ?>
                            
                             <?php if($value['custom']!="") { ?>
                            <div>  <?php _e( $value['custom']); ?></div>
 						    <?php } ?>
                            
                            </div>
                         <?php break;
				case 'include' : include($value['std']);		 
				break;		 
				case 'custom' : echo ($value['std']);		 
				break;		 
				case 'upload' : ?>
                 <div class="hades_input hades_image_upload clearfix <?php echo $value['parentClass']; ?>"> 
                 <label for="<?php echo $value['id']; ?>"><?php _e( $value['name'], 'h-framework'); ?></label>
                 <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
                 <a href="#" class="custom_upload_image_button button">Upload Image</a>
                 
                  <?php if($value['desc']!="") { ?>
                            <small><span>  <?php _e( $value['desc'], 'h-framework'); ?></span></small>
 						    <?php } ?>
                  <?php if($value['custom']!="") { ?>
                            <div  class="custom-block">  <?php _e( $value['custom']); ?></div>
 						    <?php } ?>
                  </div>  
          
          <?php break;		 
				case 'colorpickerfield' : ?>
				<div class="hades_input clearfix  <?php echo $value['parentClass']; ?>">
								<label for="<?php echo $value['id']; ?>"><?php _e( $value['name'], 'h-framework'); ?></label>
                <div class="colorSelector" ><div style="background-color:#<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>"></div></div><input type="text"  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="colorpickerField1 width-small" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
               <small class="cicon"></small> 
               
                 <?php if($value['desc']!="") { ?>
                            <small><span>  <?php _e( $value['desc'], 'h-framework'); ?></span></small>
 						    <?php } ?>
                            
                              <?php if($value['custom']!="") { ?>
                            <div  class="custom-block">  <?php _e( $value['custom']); ?></div>
 						    <?php } ?>
 						    </div>
                <?php
				break;		 
				case 'slider': ?>
							<div class="hades_input clearfix  <?php echo $value['parentClass']; ?>">
								<label for="<?php echo $value['id']; ?>"><?php _e( $value['name'] , 'h-framework'); ?></label>
                                <div class="hades_slider" ></div>
                                <input type="hidden" class="slider-val"  value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
                                <input type="hidden" class="max-slider-val"  value="<?php if($value["max"]=="") echo 500; else echo $value["max"]; ?>" />
                                 
 								<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>"class='slider-text' /><h6 class="slider-suffix"><?php if(isset( $value['suffix'])) echo $value['suffix']; ?></h6>
 							  <?php if($value['desc']!="") { ?>
                             <small><span>  <?php _e( $value['desc'], 'h-framework'); ?></span></small>
 						    <?php } ?>
                            
                              <?php if($value['custom']!="") { ?>
                            <div  class="custom-block">  <?php _e( $value['custom']); ?></div>
 						    <?php } ?>
 						    </div>
                         <?php break;
						 		 
 				case 'textarea': ?>
								<div class="hades_input clearfix  <?php echo $value['parentClass']; ?>">
									<label for="<?php echo $value['id']; ?>"><?php _e( $value['name'], 'h-framework'); ?></label>
 									<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 									  <?php if($value['desc']!="") { ?>
                             <small><span>  <?php _e( $value['desc'], 'h-framework'); ?></span></small>
 						    <?php } ?>
                            
                              <?php if($value['custom']!="") { ?>
                            <div  class="custom-block">  <?php _e( $value['custom']); ?></div>
 						    <?php } ?>
                                 </div>
								 <?php break;
								 
 				case 'select': ?>
				<div class="hades_input clearfix  <?php echo $value['parentClass']; ?> ">
				<label for="<?php echo $value['id']; ?>"><?php _e( $value['name'], 'h-framework'); ?></label>
				<div class="select-wrapper clearfix">
                <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $key => $option) { ?>
  				  <option <?php
				  $tester = $option;
				  if($value['keyed']) $tester = $key; 
				  if (!get_option( $value['id'] )) {  if ( $value['std'] == $option)  echo 'selected="selected"'; }
				  else if (get_option( $value['id'] ) == $tester) { echo 'selected="selected"'; }
				  
				     if($value['keyed']) echo "value = '$key' ";  
				   ?>
                   ><?php echo $option; ?></option><?php } ?>
				  </select>
                </div>
				 <?php if($value['desc']!="") { ?>
                            <small><span>  <?php _e( $value['desc'], 'h-framework'); ?></span></small>
 				   <?php } ?>
                   
                     <?php if($value['custom']!="") { ?>
                            <div  class="custom-block">  <?php _e( $value['custom']); ?></div>
 						    <?php } ?>
				</div>
						<?php break;
 				case "checkbox": ?>
				<div class="hades_input clearfix  <?php echo $value['parentClass']; ?>">
                 
                  <label for="<?php echo $value['id']; ?>"><?php _e( $value['name'], 'h-framework'); ?></label>
                  
                  <div class="check-group">
                 <?php $temp = 0; foreach ($value['options'] as $option) {  $checked = ""; ?>
                 <p class='clearfix'>
				 <label for="<?php echo $value['id'].$temp; ?>"><?php _e( $option, 'h-framework'); ?></label>
				 
				 <?php
				 if(!get_option($value['id'])) { 
				 
				 foreach($value['std'] as $std)
				  if($std==$option){ $checked = "checked=\"checked\""; } 
				  
				  }
				 else if(get_option($value['id'])==$option){ $checked = "checked=\"checked\""; } else{ $checked = "";} ?>
                 
				 <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id'].$temp++; ?>" value="<?php echo $option ?>" <?php echo $checked; ?> />   
                 </p>             
                 <?php } ?>
                 
                 </div>
                 
				 <?php if($value['desc']!="") { ?>
                            <small><span>  <?php _e( $value['desc'], 'h-framework'); ?></span></small>
 						    <?php } ?>
 								
                               <?php if($value['custom']!="") { ?>
                            <div  class="custom-block">  <?php _e( $value['custom']); ?></div>
 						    <?php } ?>   
                               </div>
								<?php break; 
				
				case "radio": ?>
				<div class="hades_input clearfix  <?php echo $value['parentClass']; ?> ">
                 
                  <label for="<?php echo $value['id']; ?>"><?php _e( $value['name'], 'h-framework'); ?></label>
                  
                  <div class="check-group">
                 <?php $temp = 0; foreach ($value['options'] as $option) {  $checked = ""; ?>
                 <p class='clearfix'>
				 <label for="<?php echo $value['id'].$temp; ?>"><?php _e( $option, 'h-framework'); ?></label>
				 
				 <?php
				 if(!get_option($value['id'])) { if(($value['std'])==$option){ $checked = "checked=\"checked\""; } }
				 else if(get_option($value['id'])==$option){ $checked = "checked=\"checked\""; } else{ $checked = "";} ?>
                 
				 <input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id'].$temp++; ?>" value="<?php echo $option ?>" <?php echo $checked; ?> />   
                 </p>             
                 <?php } ?>
                 </div>
                 
				 <?php if($value['desc']!="") { ?>
                            <small><span>  <?php _e( $value['desc'], 'h-framework'); ?></span></small>
 						    <?php } ?>
 								
                                  <?php if($value['custom']!="") { ?>
                            <div  class="custom-block">  <?php _e( $value['custom']); ?></div>
 						    <?php } ?>
                               </div>
								<?php break; 
												
				case "help": ?>
								<div class="hades_input clearfix help">
									<iframe id="<?php echo $value['id']; ?>" src="<?php echo $value['src']; ?>">
                                    
                                    </iframe>
 								</div>
								<?php break; 
								
												
				case "toggle": ?>
				<div class="hades_input clearfix  <?php echo $value['parentClass']; ?> ">
                  <label><?php _e( $value['name'] , 'h-framework'); 
									if(get_option($value['id'])!="")
										{ $checker = get_option($value['id']); }
									else
										{ $checker = $value['std'];  }
									?></label>
                                
                 <div class="radio">
					<input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>1"  
					<?php  if($checker=="true") echo "checked=\"checked\""; ?> value="true" /><label for="<?php echo $value['id']; ?>1">ON</label>
					<input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>2" 
				    <?php  if($checker=="false") echo "checked=\"checked\""; ?>  value="false"/><label for="<?php echo $value['id']; ?>2">OFF</label>
				 </div>
                
                  <?php if($value['desc']!="") { ?>
                             <small><span>  <?php _e( $value['desc'] , 'h-framework'); ?></span></small>
 						    <?php } ?>
                              <?php if($value['custom']!="") { ?>
                            <div class="custom-block">  <?php _e( $value['custom']); ?></div>
 						    <?php } ?>
 			   	  </div> <?php break; 
				
				  				
				case "section": $i++; ?>
				<div class="hades_section" id="<?php echo str_replace(" ","",$value['name']); $section_name = str_replace(" ","",$value['name']); ?>" ><!-- Start of the section  -->
					<div class="hades_options"> <!-- Start of hades option  --> <?php break;
				case "information" : echo "<div class='subpanel clearfix'>"; 
				$description = " <div class=\"hades_information\"><a href='#' class='info-icon'></a><p> ".__($value["description"], 'h-framework')."</p></div>"; ?>
			
				<?php
				break; 
				case "subtitle" : 		 
				 echo '<div class="subtitle-heading"><a href="#'.$value['id'].'">'.__($value['name'], 'h-framework').'</a></div>';
				 echo "<div class='hades_subpanel' id='$value[id]' > "; 
				?>
				
				<?php
				break;
				case "close_subtitle" :$sidemenu_Flag = false; ?> 
			    <span class="top-panel clearfix">
                    <input name="save<?php echo $i; ?>" type="submit" value="Save changes" class="admin-button button-primary" />  
                    <input name="reset" type="button" value="RESET" class="panel-reset button"/>
                </span> 
				
				<?php echo "</div>"; break;					
     }
  }
?>
	<input type="hidden" name="action" value="save" />
  </div>
</form>
  <form method="post" class="reset-form">
              <input type="hidden" name="action" value="reset" />
   </form>
                 
  </div>
</div> 

<?php } ?>