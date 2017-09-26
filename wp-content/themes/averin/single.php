<?php 

if(is_singular('message')) die('Message Cannot be Accessed !');
    
	get_header(); 
	
	$hasSidebar = "";
$sidebar =    get_post_meta($post->ID,'_sidebar',true);
$sidebar = (trim($sidebar)=="") ? "right-sidebar" : $sidebar; // ~~ For pages existing prior to theme activation should have right sidebar by default ~   

if($sidebar!="full") :
	
	$hasSidebar = ($sidebar == "right-sidebar") ?	"hasRightSidebar" : "hasLeftSidebar";
	$layout = 'two-third-width'; 
	$width = 630; $height = 309;
else :
	$layout = 'full-width'; $width = 980; $height = 409;
endif;
	$image_flag = false;
	$vthumb = trim(get_post_meta($post->ID,"video_thumbnail",true));
	?>   



<div class="skeleton clearfix page single <?php echo $hasSidebar; ?>"> <!-- Start of main container  -->
      
      <div class="content clearfix"> <!-- Start of main content  -->
                 
            <div class="<?php if($sidebar!="full") echo "two-third-width"; else echo "full-width"; ?>"> <!-- Start of content  -->
             
              <?php 	wp_reset_query(); if(have_posts()): while(have_posts()) : the_post(); ?> <!-- query begins  -->
              
         <?php 
		 
		  if(trim($vthumb)=="Yes") :
			
						$video_type =  trim(get_post_meta($post->ID,"video_type",true));
						$video_link =  trim(get_post_meta($post->ID,"video_code",true));
			  
			  
						$code = '';
						switch($video_type){
							  
							  case "Dedicated" : $code = do_shortcode("[video src='{$video_link}' height={$height} width={$width} title='' ]");  break;
							  case "Youtube" : 
							  $video_link = explode("v=", $video_link);
							  $code = do_shortcode("[youtube id='{$video_link[1]}' height='{$height}' width='{$width}' title='' ]");  break;
							  case "Vimeo" :  
							  $video_link = explode("/", $video_link);
							  $code = do_shortcode("[vimeo id='".$video_link[count($video_link)-1]."' height='{$height}' width='{$width}' title='' ]");  break;
							  
							  
							  }
						echo "<div class='imageholder'> $code </div>";		
						
						elseif (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())   ) :
                       
							 $id = get_post_thumbnail_id();
							 $ar = wp_get_attachment_image_src( $id, array(9999,9999) );
							 $theImageSrc = $helper->getMUFix($ar[0]);
                             $code = $helper->imageDisplay($theImageSrc , $height , $width , true , $ar[0] , false, false,'' ,'' ,false);  
						
						echo "<div class='imageholder'> $code </div>";		
						
						endif; ?>
		 
		 
		 
              <h1 class="custom-font heading"><?php the_title(); ?></h1>
              
              <p class="meta-data">  <!-- Meta data below title  -->
                by <span><?php the_author_posts_link() ?></span> on 
			       <span><?php echo get_the_date("F j, Y"); ?> </span> with
                   <span><?php comments_number('0 Comments','1 Comments','% Comments'); ?></span> in
              
              <?php  $cats = wp_get_post_categories( $post->ID );
					 $str = ' '; $temp = false;
					 
					 foreach($cats as $c)
						{
					 	 $cat = get_category( $c );
						 $link = get_category_link( $c );
							if(!$temp)
								 {
									 
									 $str = $str."  <a href=' $link' >".$cat->name."</a>";
									 $temp = true;
								 }
							 else
							  $str = $str." , <a href=' $link' >".$cat->name."</a>";
					  }
						echo  "<span>$str</span>"; ?>
                            
              
              </p>
                      
                      
               <div class="single-content"> <?php the_content(); ?> </div> <!-- main content  -->
             
              <div class="bottom-info"> <!-- meta data below the content -->
               
              <?php echo human_time_diff(get_the_time('U'), current_time('timestamp'));  _e(' ago by','h-framework'); the_author_posts_link(); _e('in','h-framework'); ?>  <?php echo $str; _e('You can follow any responses to this entry through the','h-framework'); ?> |  <a href="<?php 
			  bloginfo('rss_url') ?>"><?php _e('RSS feed','h-framework') ?></a>. <?php _e('You can leave a response, or trackback from your own site.','h-framework') ?></div>
             
             
              <!-- ===================== Social sharing via add this ======================== -->
             
               <?php if(get_option("hades_social_set")==""||get_option("hades_social_set")=="true") { ?>     
         <div class="social-stuff clearfix">
                 <?php $helper->socialStuff(); ?> 
         </div>  
        <?php } ?>  
              
         
         
          <?php if(get_option("hades_author_bio")=="" || get_option("hades_author_bio")=="true") { ?>                    
                  <div id="authorbox" class="clearfix">  
                            <div class="author-avatar">
                            <?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' ); }?>  
                            </div>
                            <div class="authortext">  
                             <h6><?php _e('About ','h-framework'); the_author_posts_link(); ?></h6>  
                             <p><?php the_author_meta('description'); ?></p>  
                             
                                  <ul class="right clearfix"><li> <a href="<?php the_author_url();?> "> <?php _e('Website','h-framework'); ?> </a>  <a href="<?php bloginfo('url'); ?>/author/<?php echo strtolower(get_the_author()); ?>"> <?php _e('more of this author','h-framework'); ?> </a></li> </ul>
                          
                          </div>  
              </div>
       <?php }?>  
       
       
       
         <?php if( (get_option("hades_popular")==""||get_option("hades_popular")=="true" )) { ?>    
             
           <div class="related-posts">   
           <h2><?php _e('Related Posts','h-framework'); ?></h2>   
              <ul class="clearfix" >
            			<?php 
						$i = 0;
						
						$tags = wp_get_post_tags($post->ID);
						if ($tags) {
							$tag_ids = array();
							foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
							$args=array(
							'tag__in' => $tag_ids,
							'post__not_in' => array($post->ID),
							'posts_per_page'=>5, // Number of related posts that will be shown.
							'caller_get_posts'=>1
							);
						}

						
						$popPosts = new WP_Query( $args );
					  
						while ($popPosts->have_posts()) : $popPosts->the_post();  $more = 0;?>
                        
                        <li class="clearfix" >
                        	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                            <div class="image">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(100,125)); ?></a>
                              
                            </div><!--image-->
                              <h2><?php the_title();?></h2>
                            <?php endif; ?>
                        </li>
                        
                        
                        <?php if($i>=3) break; $i++; endwhile; ?>
                        
                        <?php wp_reset_query(); ?>

                    </ul>
        
		</div>
        
           
     <?php }?>   
     
          <div id="comments_template">
              <?php comments_template(); ?>
          </div>  
            
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
      