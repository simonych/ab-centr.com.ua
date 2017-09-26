<?php

/* =================================================================== */
/* ==================== Visual Importer Manager ====================== */
/* =================================================================== */

/*

Author - Abhin Sharma ( WPTitans )

*/

add_action('admin_init', 'odin_add_init');
add_action('admin_menu', 'odin_add_admin');

function odin_add_admin() {
	 	add_submenu_page("elements.php","Titan Installer","Titan Installer", 'administrator',"visual_import", 'odin_admin');
}



function odin_add_init() { 
   if(isset($_GET['page'])&&($_GET['page']=='visual_import')){	
	wp_enqueue_style( 'odin-css',HURL.'/mods/odin/css/odin.css',false);
    wp_enqueue_script('odin-js',HURL.'/mods/odin/js/odin.js', array('jquery'), '0.1' );
    }
	
}



function odin_admin() {

global $themename;  
$url = get_admin_url()."admin.php?page=visual_import"; 
include("super_values.php");	  ?>
	  
   
   
  
      
<div class="hades_wrap odin">
  <div id="hades_theme">

    <div class="hades-head clearfix">
       <span id="iloader"></span>
    	
    </div>
    
    <div class="notice-bar">
    <p>Titan Installer: 2.0 </p>
    </div>

<?php if(isset($_GET["stage"])) :

	  switch($_GET["stage"])
	  {
	    case "import" : $gmes = "Demo Content ";   setDemoContent(); break;
		case "settings" : $gmes = "All Settings"; 
			 $upath = explode("wp-content",HPATH);
			 $upath =  $upath[0].'/wp-content/uploads';
		     
			 if(! is_dir($upath) )  mkdir($upath, 0700);
			 setData();
		     break;
	
		
	  }
      
	  endif;
	   ?>
  

   
   
<div id="starter-kit" class="clearfix">
  
  <?php 
    if(isset($gmes) && $gmes!= "" )
  		echo '<div class="highlight2"><p>' .$gmes. __( ' has been activated succesfully   ' , 'h-framework' )  . '</p></div>';
 ?>
  
<h4>Welcome to Titans Installer</h4>
<p>The installer is the perfect solution for everybody who's in a hurry and doesn't have time to read the docs or wait for support. With a few steps your new theme should look exactly like the demo. There are a few thing you need to consider before using this great and powerful function. Each section has it's own explanation, useful links and warnings. Please read them carefully before clicking on any buttons ;)</p>

<p><?php echo $themename;?> is using TimThumb to resize the images.TimThumb requires<a href="http://www.libgd.org/Main_Page" target="blank">the GD library</a>, which is available on any host sever with PHP 4.3+ installed. <em>Please use <a href="http://www.computerhope.com/jargon/a/absopath.htm" target="blank">absolute paths</a> for your script and images and if the images are not showing please set the cache folder permission to 777. Still encountering problems with your images, then please visit this <a href="http://themeforest.net/forums/thread/tim-thumb-problem/32860?page=1#311234">post</a> for help about this topic.</em></p>

<h4>Before you begin here are a few points you need to consider.</h4>
<ul>
<li>- Only use the TitanInstaller on a fresh Install, already have content inside your set-up then use the documentation for a manual guide.
</li>
<li>- Please delete the default page and post, that WordPress creates for you, before you start.</li>
<li>- Don't look at the front-end until all steps are finished, this to avoid confusing.</li>
</ul>
      

  <ul class="helper-tree" >
   <li class="clearfix  <?php if(get_option("titan_install_done")) echo "importer_disabled"; ?>">
      <h4>Import Theme Content</h4>  
      
        <div class="formatted">
        
        
        <div class="highlight">
        <p>Please be warned, activation only works once. Each time you click on the <strong>Activate Theme Content</strong> button the content will duplicates it selves!</p>
        </div>
        
        
        <h5>What will happen after i click on the <strong>Activate Theme Content</strong> button</h5>
        <p>This process is comparable with importing the dummy content by uploading the xml inside the WordPress Importer. Only now you wont have to search for an xml file within the download package and install the importer plugin first. Just one click and your done. </p>
                
        <div class="highlight1">
        <p>Do not close this window until you see the message <strong>All Done!!!</strong></p>
        </div>

      </div>

      <div class="highlight2">
      <p><a href="<?php echo $url."&stage=import"; ?>" id="importer">Click here to Import the Theme's Content.</a></p>
      </div>
   </li>
   
 
   <li class="clearfix ">
      <h4> Activate All Settings </h4>  
    
        <div class="formatted">
   
        
        <h5>What will happen after i've activated the menu settings</h5>
        <p>After you've activated this option the custom menus are added in it's place and will look exactly as the demo set up. Main Menu, Top Menu, Footer Menu and Mega Menu will be acitvated, populated and added to it's proper place.</p>

     
      
      <div class="highlight2">       
      <p><a href="<?php echo $url."&stage=settings"; ?>" class="tbutton">Click here to All Settings</a></p>
      </div>
      
       </div>
    </li>
    
    
  
     
 </ul>
 

 </div> 
</div>
</div> 
	  
      
	  <?php
	
	
	 }