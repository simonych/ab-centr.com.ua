<?php 

$hasSidebar = "";
$sidebar =    get_post_meta($post->ID,'_sidebar',true);
$sidebar = (trim($sidebar)=="") ? "full" : $sidebar; // ~~ For pages existing prior to theme activation should have full width by default ~   

if($sidebar!="full") :
	
	$hasSidebar = ($sidebar == "right-sidebar") ?	"hasRightSidebar" : "hasLeftSidebar";
	$layout = 'two-third-width'; 
else :
	$layout = 'full-width';
endif;

    
get_header(); 
$image_flag = false;
	?>   



<div class="skeleton clearfix page blog <?php echo $hasSidebar; ?>">
      
      <div class="content clearfix">
                 
            <div class="<?php if($sidebar!="full") echo "two-third-width"; else echo "full-width"; ?>">
             
              <?php 	wp_reset_query(); if(have_posts()): while(have_posts()) : the_post(); ?>
              <h1 class="custom-font page-heading"><?php the_title(); ?></h1>
              
              
              <?php    	if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {	?>  
              <div class="single-image clearfix">
                      <?php 
							  
							  $id = get_post_thumbnail_id();
							  $ar = wp_get_attachment_image_src( $id, array(9999,9999) );
							  $theImageSrc = $ar[0];
							  global $blog_id;
							  if (isset($blog_id) && $blog_id > 0) {
							  $imageParts = explode('/files/', $theImageSrc);
							  if (isset($imageParts[1])) {
								  $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
							  }
							  } ?>
							  <a href="<?php echo $ar[0]; ?>" class="lightbox">
							  <?php 
							  if($sidebar=="true")                  
							  echo "<img src='".URL."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h=303&amp;w=632' alt='singleimage' />";
							  else      
							  echo "<img src='".URL."/timthumb.php?src=".urlencode($theImageSrc)."&amp;h=360&amp;w=980' alt='singleimage' />";
							  
							  ?></a>
              </div>
                      
                      
              <?php } ?>  <div class="single-content"> <?php the_content(); ?> </div> <!-- main content  -->
            
               <?php endwhile; endif; ?>
                
                                     
            </div>  
            
               <?php  
	  wp_reset_query();
	  if($sidebar!="full") 
	  get_sidebar();  
	 ?>   
                 
      </div>
                  
    
</div> 
    
<?php get_footer(); ?>
      