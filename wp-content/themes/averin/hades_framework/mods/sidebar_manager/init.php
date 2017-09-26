<?php

/* =================================================================== */
/* == Sidebar Manager ================================================ */
/* =================================================================== */

/*

Author - Abhin Sharma ( WPTitans )

*/



add_action('admin_init', 'sidebarmanager_add_init');
add_action('admin_menu', 'sidebarmanager_add_admin');

function sidebarmanager_add_admin() {
	 	add_submenu_page("elements.php","Sidebar Manager","Sidebar Manager", 'administrator',"sidebar_manager", 'sidebarmanager_admin');
}



function sidebarmanager_add_init() { 
    
	
  
	if(isset($_GET['page'])&&($_GET['page']=='sidebar_manager')){	
	wp_enqueue_script('jquery-ui-sortable');
	}
	


}



function sidebarmanager_admin() {
	  
	  if(!$_GET['page']=='sidebar_manager')
      return;
	  
	  if(isset($_POST["action"])&&$_GET['page']=="sidebar_manager")
	  {
		  $abars =  $_POST["active_sidebars"];
		   $inbars = $_POST["inactive_sidebars"];
		  
		
		   
	  	  update_option(SN."_active_sidebars", $abars);
		  update_option(SN."_inactive_sidebars", $inbars);
	  }
	 
	  $active_sidebars = get_option(SN."_active_sidebars");
	  $inactive_sidebars= get_option(SN."_inactive_sidebars");
	   
	  if(!is_array($active_sidebars))	  $active_sidebars = array();
	  if(!is_array($inactive_sidebars))   $inactive_sidebars = array();
	  
	  if(isset($_POST["action"])) echo '<div class="success_message show"><p><strong>Saved.</strong></p></div>'; ?>
      
       <script type="text/javascript">
    jQuery(function($){
	$(".sidebarmanager .active-sidebars").sortable({ placeholder:'sidebar-holder' ,connectWith: '.inactive-sidebars' 
	,  stop: function(event, ui) { 
	
	if(ui.item.find("input").parents(".ui-sortable").hasClass('inactive-sidebars'))
	ui.item.find("input").attr("name","inactive_sidebars[]"); 
	
	}
	});
	$(".sidebarmanager .inactive-sidebars").sortable({ placeholder:'sidebar-holder' , connectWith: '.active-sidebars'
	,  stop: function(event, ui) { 
	if(ui.item.find("input").parents(".ui-sortable").hasClass('active-sidebars'))
	ui.item.find("input").attr("name","active_sidebars[]"); }
	 });
	
	$(".add-sidebar-button").click(function(){
		
		if(jQuery.trim($("#sidebar_name").val())=="")
		return;
		
		 $(".active-sidebars").append(" <li><span>"+$("#sidebar_name").val()+"</span><input type=\"hidden\" value=\""+$("#sidebar_name").val()+"\" name=\"active_sidebars[]\" /> <a href=\"#\" class=\"delete\"></a></li>");
		 $("#sidebar_name").val("")
		});
	
		
		
		});
    
    </script>
    
     
    <div class="hades_wrap sidebarmanager">
    <div class="hades-panel">
    
    
    
    
    <div class="notice-bar">
    <p>Sidebar Manager : 1.0 </p>
    </div>
    
    <div class="hades-body-panel clearfix" >
    
    <div id="side-panel-wrapper" class="clearfix">
    <form method="post"   action="" class="clearfix" >
    <input name="save" type="submit" value="Save changes" class="hades-primary-button" />  
    
    <div class="upload-area clearfix"> 
    <label for="file_upload">Add Sidebar</label>
    <input id="sidebar_name" name="sidebar_name" type="text" />
    <input name="save" type="button" value="Add" class="add-sidebar-button" /> 
    </div>
    
    <div class="manage-sidebars clearfix">
    
    <div class="active-wrapper clearfix">
    <h4>Active Sidebars</h4> 
    <ul class="active-sidebars">
    <?php foreach($active_sidebars as $bars) : 
    
    echo "<li><a href='#' class='delete' /></a><input type='hidden' name='active_sidebars[]' value='".$bars."'/> <span> ".$bars." </span> </li>";
    
    endforeach; ?>
    </ul>
    </div>
    
    <div class="inactive-wrapper clearfix">
    <h4>Inactive Sidebars</h4> 
    <ul class="inactive-sidebars">
    <?php foreach($inactive_sidebars as $abars) : 
    
    echo "<li><a href='#' class='delete' /></a><input type='hidden' name='inactive_sidebars[]' value='".$abars."'/> <span> ".$abars." </span> </li>";
    
    endforeach; ?>
    </ul>
    </div>
    
    
    </div>
    <input type="hidden" value="save" name="action" />
    </form>
    
    </div>
    
    </div> 
	  
      
	  <?php
	
	
	 }