<?php 

$stage_option = ($super_options[SN."_stage_option"]!="") ? $super_options[SN."_stage_option"] : "Slider";
$sidebar = ($super_options[SN."_home_layout"]!="") ? $super_options[SN."_home_layout"] : "full-width";
$items_limit = $super_options[SN."_posts_item_limit"];
$items_limit =  (!$items_limit) ? 6 : $items_limit ; 

get_header(); 
?>   


<div class="skeleton clearfix page blog ">
      
     
      
      <div class="content clearfix <?php echo $sidebar; ?>">
                 
            <div class="<?php if($sidebar!="full-width") echo "two-third-width"; else echo "full-width";  ?>">
             
            
             <?php 
		
		switch($stage_option)
		{
			case "Slider" : 
				$sliders = unserialize(get_option(SN."_sliders"));
	         $slider = $sliders[$super_options[SN."_home_slider"]]; 
			
			 $home_slider = new Orion(
			       $slider["title"],"homeslider",
				   $slider["width"],$slider["height"],
				   $slider["type"],'',$slider['controls'],
				   $slider['autoplay'],$slider['slides'],
				   ( ((int)$slider["interval"] ) * 1000 )
				   ,$slider["desc"]
				   );
	         echo '<div class="slider-wrapper-shade"><a href="" class="toggle-switch inactive"></a>'.$home_slider->getSlider()."</div>";
			 break;
			 
			 case "Static Image" :  
			 $image = $helper->getMUFix($super_options[SN."_home_static_image"]);
			 echo '<div class="homepage-static-image nohover">'.$helper->imageDisplay($image,400,630,true,$super_options[SN."_home_static_image"],1,false,'','',false)."</div>";
			 break;
			 
			 case "Title" :  
			 $title = stripslashes($super_options[SN."_home_title"]);
			 echo '<h1 class="custom-font">'.$title."</h1>";
			 break;
			 
			
			  case "none" : echo'<div class="no-stage"></div>';  break;
		}
		
		?>
        
         
            
            
            <div class="posts posts-home">
            
              <ul class="clearfix">
              <?php 
              query_posts( "&posts_per_page={$items_limit}&paged=".$paged);
              if ( have_posts() ) : while ( have_posts() ) : the_post();
              
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
                  <?php else: $width = "full-post";  endif; ?>
                  
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
                        <br />
                        <span class="date"> <?php echo get_the_time("M")." ".get_the_time("d").", ".get_the_time("Y"); ?> </span> 
                        <span class="comment"> <a href=" <?php comments_link(); ?> " title="<?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?>"><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></a> </span>  
                          
                       </p>
                   
                   </div>
                  </li>
                  <?php   endwhile; else:
                  _e( '<p class="notice-box">No posts yet !</p>','h-framework' );
                  endif;
                  ?>
              </ul>
            
            </div>
            
            
             <div class="pagination-panel clearfix">
  
                  <?php $helper->pagination(); ?>
                  
                  
               </div>  
                 
   
                   
            </div>
          
            
            
           <?php  
	  wp_reset_query();
	  if($sidebar!="full-width") 
	  get_sidebar();  
	 ?> 
               
       </div> 
         
 </div>
    
<?php get_footer(); ?>
      