<?php 
    
	get_header(); 
	$hasSidebar = "";
	
	
	$sidebar = "false";	
	
 
	
	$image_flag = false;
	?>   



<div class="container clearfix page blog <?php echo $hasSidebar; ?>">
      
      <div class="content clearfix">
                 
            <div class="<?php if($sidebar=="true") echo 'two-third-width'; else echo 'full-width';  ?>">
             
          
              <h1 class="custom-font page-heading"><?php the_title(); ?></h1>
              
          <div class="single-content">
              
              
                 <h2 class="not-found"><?php _e( stripslashes(get_option("hades_notfound_title")) , 'h-framework'); ?> </h2>
                 
                 <p class="not-found"><img src=" <?php 
				     if(!get_option("hades_notfound_logo")) echo URL."/images/notfound.png"; 
				     else echo get_option("hades_notfound_logo"); ?>" atl="Page Not Found" title="Page Not Found" />
                 </p>
                 <p class="not-found"> <?php _e( stripslashes(get_option("hades_notfound_text")) , 'h-framework' ); ?> </p>
                 <div class="error-search"><?php get_search_form(); ?></div>
                 
              
               </div> <!-- main content  -->
            
            
                
                                     
            </div>  
            
              <?php  	 wp_reset_query();
		   
			if($sidebar=="true")  
			get_sidebar();  ?>      
                 
      </div>
                  
    
</div> 
    
<?php get_footer(); ?>
      