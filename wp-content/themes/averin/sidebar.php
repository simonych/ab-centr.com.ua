 <div class="sidebar" id="sidebar"><!-- start of one-third column -->

<?php 
    $dsidebar = get_post_meta($post->ID,'_dynamic_sidebar',true);
  
 
   
   
	if ( $dsidebar!="none" && trim($dsidebar)!="" && ! is_front_page() ) {
			dynamic_sidebar ($dsidebar); 
	}
	else  {
	 dynamic_sidebar ("Blog Sidebar"); 
	}

	
	?>  
</div><!-- end of one-third column -->