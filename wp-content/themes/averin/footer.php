<?php 
// == ~~ To use native variables global is required ================================
global $super_options,$helper;   
?>

 
  <div id="footer" class="skeleton">
  
  <div class="inner-footer-wrapper clearfix">
   <?php  if(!is_page_template("template-maintenance-page.php") && $super_options[SN."_footer_widgets"]=="Yes") : ?>
     <div class="container clearfix">
     
    
     
     <?php 
	  $footer_layout = $super_options[SN."_footer_layout"];
	  switch($footer_layout)
	  {
	  case "two-col" : 
	  
					  echo '<div class="footer-cols one_half clearfix">';
					    dynamic_sidebar ("Footer Column 1"); 
					  echo "</div>";
					 
					  echo '<div class="footer-cols one_half_last clearfix">';
					    dynamic_sidebar ("Footer Column 2"); 
					  echo "</div>"; 
	  
	  break;
	  case "three-col" : 
	  
					  echo '<div class="footer-cols one_third clearfix">';
					    dynamic_sidebar ("Footer Column 1"); 
					  echo "</div>";
					  
					  echo '<div class="footer-cols one_third clearfix">';
					    dynamic_sidebar ("Footer Column 2"); 
					  echo "</div>";
					 
					  echo '<div class="footer-cols one_third_last clearfix">';
					    dynamic_sidebar ("Footer Column 3"); 
					  echo "</div>"; 
	  
	  break;
	 case "four-col" : 
	  
					  echo '<div class="footer-cols one_fourth clearfix">';
					    dynamic_sidebar ("Footer Column 1"); 
					  echo "</div>";
					  
					  echo '<div class="footer-cols one_fourth clearfix">';
					    dynamic_sidebar ("Footer Column 2"); 
					  echo "</div>";
					 
					  echo '<div class="footer-cols one_fourth clearfix">';
					    dynamic_sidebar ("Footer Column 3"); 
					  echo "</div>";
					  
					  echo '<div class="footer-cols one_fourth_last clearfix">';
					    dynamic_sidebar ("Footer Column 4"); 
					  echo "</div>"; 
	  
	  break;
	  case "five-col" : 
	  
					  echo '<div class="footer-cols one_fifth clearfix">';
					    dynamic_sidebar ("Footer Column 1"); 
					  echo "</div>";
					  
					  echo '<div class="footer-cols one_fifth clearfix">';
					    dynamic_sidebar ("Footer Column 2"); 
					  echo "</div>";
					 
					  echo '<div class="footer-cols one_fifth clearfix">';
					    dynamic_sidebar ("Footer Column 3"); 
					  echo "</div>";
					  
					  echo '<div class="footer-cols one_fifth clearfix">';
					    dynamic_sidebar ("Footer Column 4"); 
					  echo "</div>";
					  
					  echo '<div class="footer-cols one_fifth_last clearfix">';
					    dynamic_sidebar ("Footer Column 5"); 
					  echo "</div>"; 
	  
	  break;
	  case "six-col" : 
	  
					  echo '<div class="footer-cols one_sixth clearfix">';
					    dynamic_sidebar ("Footer Column 1"); 
					  echo "</div>";
					  
					  echo '<div class="footer-cols one_sixth clearfix">';
					    dynamic_sidebar ("Footer Column 2"); 
					  echo "</div>";
					 
					  echo '<div class="footer-cols one_sixth clearfix">';
					    dynamic_sidebar ("Footer Column 3"); 
					  echo "</div>";
					  
					  echo '<div class="footer-cols one_sixth clearfix">';
					    dynamic_sidebar ("Footer Column 4"); 
					  echo "</div>";
					  
					  echo '<div class="footer-cols one_sixth clearfix">';
					    dynamic_sidebar ("Footer Column 5"); 
					  echo "</div>";
					  
					  echo '<div class="footer-cols one_sixth_last clearfix">';
					    dynamic_sidebar ("Footer Column 6"); 
					  echo "</div>"; 
	  
	  break;
	  
	  case "one-third" : 
	  
					  echo '<div class="footer-cols one_third clearfix">';
					    dynamic_sidebar ("Footer Column 1"); 
					  echo "</div>";
					 
					  echo '<div class="footer-cols two_third_last clearfix">';
					    dynamic_sidebar ("Footer Column 2"); 
					  echo "</div>"; 
	  
	  break;
	  case "one-fourth" : 
	  
					  echo '<div class="footer-cols one_fourth clearfix">';
					    dynamic_sidebar ("Footer Column 1"); 
					  echo "</div>";
					 
					  echo '<div class="footer-cols three_fourth_last clearfix">';
					    dynamic_sidebar ("Footer Column 2"); 
					  echo "</div>"; 
	  
	  break;
	  case "one-fifth" : 
	  
					  echo '<div class="footer-cols one_fifth clearfix">';
					    dynamic_sidebar ("Footer Column 1"); 
					  echo "</div>";
					 
					  echo '<div class="footer-cols four_fifth_last clearfix">';
					    dynamic_sidebar ("Footer Column 2"); 
					  echo "</div>"; 
	  
	   break;
	   case "one-sixth" : 
	  
					  echo '<div class="footer-cols one_sixth clearfix">';
					    dynamic_sidebar ("Footer Column 1"); 
					  echo "</div>";
					 
					  echo '<div class="footer-cols five_sixth_last clearfix">';
					    dynamic_sidebar ("Footer Column 2"); 
					  echo "</div>"; 
	  
	  break;
	 
	  
	  }
	 ?>
     
     
     </div>
     <?php endif; ?>
   </div>
   
   <div id="footer-menu">
    <a href="http://www.mafiashare.net" id="bottom-logo"><img src="<?php echo $super_options[SN."_footer_logo"]; ?>" alt="logo" /></a>
             <p class="footer-text"><?php echo $helper->customFormat($super_options[SN."_footer_text"]); ?></p> 
             
             <?php  if(!is_page_template("template-maintenance-page.php") && $super_options[SN."_footer_menu"]=="Yes") : 
                      if(function_exists("wp_nav_menu"))
                      {
                          wp_nav_menu(array(
                                      'theme_location'=>'footer_nav',
                                      'container'=>'ul',
                                      'depth' => 1
                                      )
                                      );
                      }
					  endif;
               ?>
   </div>
</div>


<script type="text/javascript">
<?php 
echo stripslashes($super_options[SN."_tracking_code"]);
?>
</script>
<?php  wp_footer();  ?>
<a href="#" class="back-to-top"></a>
</body>
</html>
