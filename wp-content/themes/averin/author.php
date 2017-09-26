<?php 
     
	get_header(); 
	
	$sidebar =    "right-sidebar";
	if($sidebar!="full") :
	
	$hasSidebar = ($sidebar == "right-sidebar") ?	"hasRightSidebar" : "hasLeftSidebar";
	$layout = 'two-third-width'; 
else :
	$layout = 'full-width';
endif;
	
	
	?>   




<div class="skeleton clearfix page blog <?php echo $hasSidebar; ?> author">
      
      <div class="content clearfix">
                 
            <div class="<?php if($sidebar!="full") echo "two-third-width"; else echo "full-width"; ?>">
             
            <?php if(isset($_GET['author_name'])) :
						$curauth = get_userdatabylogin($author_name);
					else :
						$curauth = get_userdata(intval($author));
					endif;
			     ?>
             
              <div class="title">
              <h1 class="custom-font heading">  <?php  _e("All posts from ",'h-framework'); _e( $curauth->display_name,'h-framework' ); ?></h1>
              </div>
              
                <div id="authorbox1" class="clearfix">
                            <div class="author-avatar">
                            <?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' ); }?>  
                            </div>
                <div class="one-half">
                  <?php _e( $curauth->description ); ?>
                </div>
              
              </div>
              
                
            
            <div class="posts">
            
              <ul class="clearfix">
              <?php 
               $query = new WP_Query( 'author='.$curauth->ID.'&paged='.$paged );
              if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();  
              
              $more = 0;
              ?>
                <li class="clearfix">
				  <?php 
                  
                      $width = "half";
                      if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : 
						$id = get_post_thumbnail_id();
						$ar = wp_get_attachment_image_src( $id , array(9999,9999) );
						
						$theImageSrc = $ar[0];
						global $blog_id;
						if (isset($blog_id) && $blog_id > 0) {
						$imageParts = explode('/files/', $theImageSrc);
						if (isset($imageParts[1])) {
						$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
						}
						}
						?>
                 
                        <div class="imageholder">
                        <?php 
						  $theImageSrc = $helper->getMUFix($ar[0]);
                          echo $helper->imageDisplay($theImageSrc , 129 , 129 , false , get_permalink() , false, false,'' ,'' ,false);  
						 ?>
                  
                        </div>
                  <?php else: $width = "";  endif; ?>
                  
                  <div class="description <?php echo $width;?> ">
                       <h2 class="custom-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2> 
                       <p>
                        <?php  
                        global $more;    // Declare global $more (before the loop).
                        $more = 1;
                        $content = get_the_content('');
                        $content = apply_filters('the_content', $content);
                        $content = str_replace(']]>', ']]&gt;', $content);
                        $helper->shortenContent( 200 ,  strip_tags( $content  ) ); ?>
                        
                        <span class="extra"> <?php echo get_the_time("M")." ".get_the_time("d").", ".get_the_time("Y"); ?> - <?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?> </span>    
                       </p>
                   
                   </div>
                  </li>
                  <?php  $i++; endwhile; else:
                  _e( '<h4>No posts yet !</h4>','h-framework' );
                  endif;
                  ?>
              </ul>
            
            </div>
            
            
               <div class="pagination-panel clearfix">
  
                   <!-- Pagination -->
                   
                        <?php $helper->pagination(); ?>
                   
                </div>  
                 
   
                   
            </div>
          
           <?php  
	  wp_reset_query();
	  if($sidebar!="full") 
	  get_sidebar();  
	 ?>     
               
       </div> 
                  
 </div>
    
<?php get_footer(); ?>
      