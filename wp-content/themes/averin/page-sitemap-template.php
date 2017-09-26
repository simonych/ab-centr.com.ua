<?php
/*
Template Name: Sitemap
*/
?>
<?php 
    
	get_header(); 
	$sidebar = "true";	
	$hasSidebar = "hasRightSidebar";
	?>   



<div class="skeleton clearfix page blog <?php echo $hasSidebar; ?>">
      
      <div class="content clearfix">
                 
            <div class="<?php if($sidebar=="true") echo 'two-third-width'; else echo 'full-width';  ?>">
             
              <?php 	wp_reset_query(); if(have_posts()): while(have_posts()) : the_post(); ?>
              <h1 class="custom-font page-heading"><?php the_title(); ?></h1>
              
              
              <div class="single-sitemap-content"> <?php the_content(); ?> </div> <!-- main content  -->
            
               <?php endwhile; endif; ?>
                
                 <div class="page-list"> 
				 <h4>Pages</h4>
                     <ul class="clearfix"><?php wp_list_pages( array( "title_li"=>"" , "depth" => 1 ) ); ?></ul>
                 </div>
                 
                 <div class="category-list">
               
                 <h4>Categories</h4>
                      <ul class=""><?php wp_list_categories (array(
					  'title_li'           => ''
					  )); ?></ul>
              
              </div>
                                     
            </div>  
            
            
              
              
                 
            
              <?php  	 wp_reset_query();
		   
			if($sidebar=="true")  
			get_sidebar();  ?>      
                 
      </div>
                  
    
</div> 
    
<?php get_footer(); ?>
      