<?php
/* 
===================================================================================

   Author      - WPTitans
   Description - Helper Class that initiates all routines.
   Version     - 3.1
   
   Class functions index -
   
   1.  Constructor
   2.  Register Menu
   3.  Register Mega Menus
   4.  Register Scripts 
   5.  Custom Formatter
   6.  MU Fix 
   7.  Image display
   8.  WP Core resizer
   9.  Show Posts
   10. Pagination
   11. Init Sidebars
   12. Register Custom Types
   13. Add Slides Module
   14. Super Sidebars
   15. Dynamic CSS
   16. Include File
   17. Dynamic Footer
   18. Social Stuff
=================================================================================== */

if(!defined('HPATH'))
die(' The File cannot be accessed directly ');

if(!class_exists('Helper')) {

class Helper
{
	
	// == Constructor =================================
	function __construct() {
		global $wpdb,$super_options;
		

//if(get_option(SN."_enable_admin_logo")=="Yes")


function my_custom_login_logo() {
  
   if(get_option(SN."_admin_logo_width")!="") $width = "width:".get_option(SN."_admin_logo_width")."px!important;";
   if(get_option(SN."_admin_logo_height")!="") $height = "height:".get_option(SN."_admin_logo_height")."px!important;";
  	
    echo '<style type="text/css">
        h1 a { background:url('.get_option(SN."_admin_logo").') !important;
		  '.$width.'
		  '.$height.'
		  margin-top:-50px;
		   }
    </style>';

}
add_action('login_head', 'my_custom_login_logo');

		
		
		$resultSet =  $wpdb->get_results("SELECT option_name,option_value FROM $wpdb->options where option_name like '%".SN."%' ",ARRAY_A);
		
		foreach($resultSet as $value)
		$super_options[$value['option_name']] = $value['option_value'];
		
		
		function checkSEp($posts) {
		if ( empty($posts) )
		return $posts;
		
		$found = false;
		$key = '';
		foreach ($posts as $post) {
			
			
		if ( stripos($post->post_content, '[titan_slider') )
		$found = true;
		$key = strstr($post->post_content,'name="');
		$key = substr($key,6);
		$init = strpos($key,'"');
		$key = substr($key,0,$init);
		
		break;
		
		}
		
		if ($found){
			
		   
		 	
			
			
		}
		return $posts;
		}
		add_action('the_posts', 'checkSEp');

		
		$this->registerScripts();
		
		$this->initSidebars();
		
		$this->initSuperSidebars();
		$this->registCustomTypes();
	
		
		if(!is_admin())
		$this->dynamicCSS();
		
		add_filter('widget_text', 'do_shortcode');
        add_theme_support( 'post-thumbnails' );
		function valid_search_form ($form) {
			return str_replace('role="search" ', '', $form);
		}
		add_filter('get_search_form', 'valid_search_form');
		

$portfolio_metabox_data = array(
"name" => "Post Details",
"post_type" => "post",
"context" => 'normal',
"priority" => 'high',
"input_fields" => array(
   
   array( "radio","select","textarea") ,
   array( "Video Feature " ,"Video Type", "Video Code" ) ,
   array("video_thumbnail","video_type","video_code") ,
   array( "Yes,No","Youtube,Vimeo,Dedicated","")

  )

);

$wl = new CustomBox("Portfolio Details",$portfolio_metabox_data);




if ( ! function_exists( 'hades_comment' ) ) :

function hades_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
    
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	    	<div id="comment-<?php comment_ID(); ?>">
            
		        <div class="comment-author vcard clearfix">
			        <?php echo get_avatar( $comment, 80 ); ?>
                    <ul class="date-info clearfix">
			        <li class="clearfix">
					<?php printf( sprintf( '<span class="fn">%s</span>', get_comment_author_link() ) ); ?>
		            <?php if ( $comment->comment_approved == '0' ) : ?>
		                	<em><?php _e( 'Your comment is awaiting moderation.'  , 'h-framework'); ?></em>
			  		<?php endif; ?>
                    
                    <div class="comment-meta commentmetadata">   <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
		        	<?php
				  /* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s' ,'h-framework' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)','h-framework' ), ' ' );
	        		?>
		          </div><!-- .comment-meta .commentmetadata -->
        
                  
                  </li>
                  <li>
                   <div class="comment-body"><?php comment_text(); ?></div>
                  </li>
                  </ul>
                  
                         
        
                </div><!-- .comment-author .vcard -->
		

		

		

		<div class="reply clearfix">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:' , 'h-framework' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)' , 'h-framework'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


function add_titanbutton() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'regiterTitanButtonPlugin');  
     add_filter('mce_buttons', 'registerTitanButton');  
   }  
}  

function registerTitanButton($buttons) {
   array_push($buttons, "button");
   return $buttons;
}
function regiterTitanButtonPlugin($plugin_array) {
   $plugin_array['button'] = HURL.'/js/customcodes.php';
   return $plugin_array;
}

add_action('init', 'add_titanbutton'); 
		}
    
	// == Register Menu ===============================
	
    public function registerMenus($menus)
	{
		

		  if ( function_exists( 'register_nav_menus' ) ) {
			 
			  register_nav_menus($menus);
		  }
	}
   
   // == Register Mega Menus ==========================
   
   public function registerMegamenu()
	{
          include_once('megamenu.php');
	}
  
   // == Register Scripts ==========================
   
   public function registerScripts()
	{
		function addScripts() {
			global $super_options;
			wp_deregister_script('jquery');
			wp_enqueue_script('jquery',URL.'/sprites/js/jquery.js');
			wp_enqueue_script('jquery-prettyphoto',URL.'/sprites/js/jquery.prettyPhoto.js');
			wp_enqueue_script('swf-object',URL.'/sprites/js/swfobject.js');
			wp_enqueue_script('jquery-ui',URL.'/sprites/js/jquery-ui.custom.min.js');
			
			       wp_enqueue_script("admin-colorpicker",HURL."/js/colorpicker.js",array('jquery'),"1.0");
	   wp_enqueue_style("colorpicker-style", HURL."/css/colorpicker.css", false, "1.0", "all");
	   
			// Temp files
		    wp_enqueue_script('accordion',URL.'/sprites/js/jquery.kwicks.js');
		    wp_enqueue_script('jquery-quartz',URL.'/sprites/js/jquery.quartz.js');
			
			wp_enqueue_script('custom',URL.'/sprites/js/custom.js');
			
			wp_enqueue_style('main-style',URL.'/style.css');
			
			
			
			
			
			wp_enqueue_style('prettyphoto',URL.'/sprites/stylesheets/prettyPhoto.css');
			}
		 
		 function addAdminScripts() {
			
			wp_enqueue_script('jquery-global',HURL.'/js/global.js');
			wp_enqueue_script('jquery-ui-datepicker',HURL."/js/jquery.ui.datepicker.min.js","jquery-ui-core",false);
			wp_enqueue_style('global-css',HURL.'/css/global.css');
			}
				
		 if(!is_admin())	
		add_action('init','addScripts');	
        else
		add_action('admin_init','addAdminScripts');	 
	}	
  
   // == Custom Formatter ======================
   
   public function customFormat($content,$strip_tags = false,$shortcode=true){
	    $content = 	stripslashes($content);
	   if($shortcode)
	   $content = do_shortcode( shortcode_unautop( $content ) ); 
	   $content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
	  
	   if($strip_tags)
	     $content = strip_tags($content,"<hades>,<tabend>");
		 
	   return $content;
	   
	   }		
	
	// == MU Fix ===================================
	
	public function getMUFix($src){
	   
	   global $super_options;
	  
	  $resize_opt = trim($super_options[SN."_image_resize"]);
	  
	  
	  $theImageSrc = $src;
                          global $blog_id;
                          if (isset($blog_id) && $blog_id > 0) {
                          $imageParts = explode('/files/', $theImageSrc);
                          if (isset($imageParts[1])) {
                              $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
							   if($resize_opt=="Wordpress Core resizer") return  '/wp-content'.$theImageSrc;	
                          }
						 	
                      }	
					  
	if($resize_opt=="Wordpress Core resizer") return  $src;		
	  		  
	return $theImageSrc;				  
		}   
    
	// == Image display ===================================
	
	public function imageDisplay($src , $height = 250, $width= 250 , $lightbox = false ,$link = '' ,$zc = false ,$imageholder = true ,$description = '',$cd='' , $hoverable = true )
	{
		// echo $description;
		
		global $super_options;
		if($lightbox) $lightbox = 'lightbox';
		
		$resize_opt = trim($super_options[SN."_image_resize"]);
		
		if($resize_opt=="Timthumb" || $resize_opt=="") {
		
		if($hoverable)
		$hoverable = '<span class="hover-image"> <small></small> </span>';
		
		if($link!="")
		$lk = $link;
		else
		{
			$lk = $src;
			if(is_array($cd))
			{
				$lk = URL."/timthumb.php?src=".urlencode($src)."&amp;h=$cd[0]&amp;w=$cd[1]&amp;zc=3";
			}
		}
		
		
			$zc_opt = ($super_options[SN."_timthumb_zc"]=="") ? "Hard Resize" : trim($super_options[SN."_timthumb_zc"]) ;
			$zzc = 0;
			switch($zc_opt)
			{
				case "Hard Resize" : $zzc = 0; break;
				case "Smart crop and resize" : $zzc = 1; break;
				case "Resize Proportionally" : $zzc = 3; break;
				
			}
		
		if($zc)
		$zzc = $zc;
		
		if($imageholder) $imageholder = 'imageholder'; else $imageholder = '';
		
		$image =    " <a href=\"$lk\" class='$imageholder $lightbox' title=''  > $hoverable
			         <img src='".URL."/timthumb.php?src=".urlencode($src)."&amp;h=$height&amp;w=$width&amp;zc=$zzc' alt=''  /> $description</a>";
	
		}
	 else if($resize_opt=="Wordpress Core resizer") {
		
		if($link!="")
		$lk = $link;
		else
		{
			$lk = $src;
			if(is_array($cd))
			{
				$cr_img = $this->wp_resize(NULL,$src,$cd[1],$cd[0]);
				$lk = URL."/timthumb.php?src=".$cr_im["url"]."";
			}
		}
		if($imageholder) $imageholder = 'imageholder'; else $imageholder = '';
		
		$cr_img = $this->wp_resize(NULL,$src,$width,$height);
		
		$image =    " <a href=\"$lk\" class='$imageholder $lightbox' title=''  > 
			         <img src='".$cr_img["url"]."' alt=''  /> $description</a>";
	
	 }
	  else if($resize_opt=="none") {
		
		if($link!="")
		$lk = $link;
		else
		{
			$lk = $src;
			if(is_array($cd))
			{
				
				$lk = $src;
			}
		}
		if($imageholder) $imageholder = 'imageholder'; else $imageholder = '';
		
		
		
		$image =    " <a href=\"$lk\" class='$imageholder $lightbox' title=''  > 
			         <img src='".$src."' alt='' width = '$width' height='$height'  /> $description</a>";
	
	 }
					 
	 return $image;
	}
    
	// == WP Core resizer ==================
	
	public function wp_resize($attach_id = null, $img_url = null, $width, $height, $crop = false) {

  
    // this is an attachment, so we have the ID
    if($attach_id) {

        $image_src = wp_get_attachment_image_src($attach_id, 'full');
        $file_path = get_attached_file($attach_id);

    // this is not an attachment, let's use the image url
    }else if($img_url){

        $file_path = parse_url($img_url);
        $file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];

        $orig_size = getimagesize($file_path);

        $image_src[0] = $img_url;
        $image_src[1] = $orig_size[0];
        $image_src[2] = $orig_size[1];
    }

    $file_info = pathinfo($file_path);
    $extension = '.'. $file_info['extension'];

    // the image path without the extension
    $no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

    $cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

    // checking if the file size is larger than the target size
    // if it is smaller or the same size, stop right here and return
    if ($image_src[1] > $width || $image_src[2] > $height) {

        // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
        if (file_exists($cropped_img_path)) {

            $cropped_img_url = str_replace(basename($image_src[0]), basename($cropped_img_path), $image_src[0]);

            $vt_image = array (
                'url' => $cropped_img_url,
                'width' => $width,
                'height' => $height
            );

            return $vt_image;
        }

        // $crop = false
        if ($crop == false) {

            // calculate the size proportionaly
            $proportional_size = wp_constrain_dimensions($image_src[1], $image_src[2], $width, $height);
            $resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;            

            // checking if the file already exists
            if (file_exists($resized_img_path)) {

                $resized_img_url = str_replace(basename($image_src[0]), basename($resized_img_path), $image_src[0]);

                $vt_image = array (
                    'url' => $resized_img_url,
                    'width' => $proportional_size[0],
                    'height' => $proportional_size[1]
                );

                return $vt_image;
            }
        }

        // no cache files - let's finally resize it
        $new_img_path = image_resize($file_path, $width, $height, $crop);
        $new_img_size = getimagesize($new_img_path);
        $new_img = str_replace(basename($image_src[0]), basename($new_img_path), $image_src[0]);

        // resized output
        $vt_image = array (
            'url' => $new_img,
            'width' => $new_img_size[0],
            'height' => $new_img_size[1]
        );

        return $vt_image;
    }

    // default output - without resizing
    $vt_image = array (
        'url' => $image_src[0],
        'width' => $image_src[1],
        'height' => $image_src[2]
    );

    return $vt_image;
   
  

}
	
	public function breadcrumbs()
	{
		global $super_options;
		 $delimiter = $super_options[SN."_breadcrumb_delimiter"];
  $home =  $super_options[SN."_breadcrumb_home_label"];; // text for the 'Home' link
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div id="breadcrumbs"><div class="inner-breadcrumbs-wrapper  clearfix">';
 
    global $post;
    $homeLink = home_url();
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . __('Archive by category ','h-framework').'"' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . __('Search results for ','h-framework').'"' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . __('Posts tagged','h-framework').' "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . __( 'Articles posted by ','h-framework') . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . __('Error 404','h-framework') . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','h-framework') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div></div>';
 
  }
	}

  // == Show Posts ================================
  
  public function showPosts( $options )
  {
	  global $paged;
			global $post;
			global $more ; 
			extract($options);
			
			$image_width = (!isset($image_width)) ? 255 : $image_width;
			$image_height = (!isset($image_height)) ? 170 : $image_height;
			$thumbnails = (!isset($thumbnails)) ? true : $thumbnails;
			$post_type = (!isset($post_type)) ? 'post' : $post_type;
			$orderby = (!isset($orderby)) ? 'date' : $orderby;
			$content_limit = (!isset($content_limit)) ? 250 : $content_limit;
			$limit = (!isset($limit)) ? 4 : $limit;
			$clear = (!isset($clear)) ? 9999 : $clear;
			$categories = (!isset($categories)) ? false  : $categories;
			$buttonpanel = (!isset($buttonpanel)) ? false  : $buttonpanel;
			$cats = '';
			
			if($categories)
			{
				//portfoliocategories=test&
				$cats = $categories["c_name"]."=".$categories["inputs"]."&";
			}
			
			
			$counter = $clear;
			
			if(isset($limit))
			$limit = "&posts_per_page={$limit}";
			else
			$limit = '';
			
			
			$extras  = (!isset($extras)) ? true : $extras;
		  
		  if(trim($filter)!="")
		  	{
				$filter = "&tax={$filter}";
			}
			$filter ="";
			
           query_posts("{$cats}orderby={$orderby}{$limit}&post_type={$post_type}{$filter}".'&paged='.$paged);
		
			?>
            
		 <ul class="clearfix posts">
          <?php 
	
	        if ( have_posts() ) : while ( have_posts() ) : the_post();
		    
            $more = 0;
			if($counter==0 )
			{
				$counter = $clear; 
				if($separator)
				echo "<li class='blog-separator clearfix'><span class='img-separator'></span> <span class='desc-separator'></span></li>";
			}
	      ?>
                <li class="clearfix <?php echo $label.''.$counter; 
				 $terms  = get_the_terms($post->ID,'portfoliocategories'); 
				 if ( !empty( $terms ) ) {
		  			$out = array();
					foreach ( $terms as $c )
						echo ' '.$c->name;
			
		}
		
				 ?>">
                 <?php 
				
				$vthumb = get_post_meta($post->ID,"video_thumbnail",true);
				
	          	$width = "half";
			  
			  if(trim($vthumb)=="Yes") :
			 
			  $video_type =   trim(get_post_meta($post->ID,"video_type",true));
			  $video_link =  trim(get_post_meta($post->ID,"video_code",true));
			  
			  $code = '';
			  switch($video_type){
					
					case "Dedicated" : $code = do_shortcode("[video src='{$video_link}' height={$image_height} width={$image_width} title='' ]");  break;
					case "Youtube" : 
					 $video_link = explode("v=", $video_link);
				    $code = do_shortcode("[youtube id='{$video_link[1]}' height='{$image_height}' width='{$image_width}' title='' ]");  break;
					case "Vimeo" :  
					$video_link = explode("/", $video_link);
				    $code = do_shortcode("[vimeo id='".$video_link[count($video_link)-1]."' height='{$image_height}' width='{$image_width}' title='' ]");  break;
					
					
					}
			echo "<div class='imageholder'> $code </div>";		
			  elseif (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) && $thumbnails  ) : 
				 
					 $id = get_post_thumbnail_id();
	          	     $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
	    	         $theImageSrc = $this->getMUFix($ar[0]);
					 echo '<div class="imageholder-wrapper clearfix">'.$this->imageDisplay($theImageSrc , $image_height , $image_width , true,  $ar[0],  false , true,'' ,'' ,false);
				 
				    if($extras) : ?> 
						 <div class="extras clearfix"> 
					<div class="extras-avatar"><?php echo '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'.get_avatar( get_the_author_email(), '25' )."</a>"; ?></div>
                    <div class="extras-info">
                     <?php _e( 'Posted on '.get_the_time("l, F d S, Y").' at '.get_the_time("g:i a").' by ' , 'h-framework');  echo '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">'; the_author(); echo '</a>'; ?> 
                      </div>
                      
                       
                       </div>
						
						<?php endif; 
				 echo "</div>";
				
				 ?>
                 
                     
               <?php else: $width = "";  endif; ?>
             
                        
                      <div class="description <?php echo $width;?> clearfix ">
                      
                      <div class="blog-info-wrapper clearfix">
                      
                        <h2 class="custom-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2> 
                       
                               <p>
                                 <?php  
							  global $more;    // Declare global $more (before the loop).
                              $more = 1;
							  $content = get_the_content('');
							  $content = apply_filters('the_content', $content);
                              $content = str_replace(']]>', ']]&gt;', $content);
							  $this->shortenContent( $content_limit ,  strip_tags( $content  ) ); ?>
                             
                              </p>
                            
                            <?php if($buttonpanel) : ?>
                             <div class="button-panel clearfix">                     
         	<a href="<?php the_permalink(); ?>" class="link"> <?php _e('Continue','h-framework'); ?> </a>
         
          <?php   if(trim($vthumb)=="Yes") :
		  
		    $video_type =   trim(get_post_meta($post->ID,"video_type",true));
			$video_link =  trim(get_post_meta($post->ID,"video_code",true));
			  
			  $code = '';
			  switch($video_type){
					
					case "Dedicated" : $code = do_shortcode("[video src='{$video_link}' height='500' width='500'  title='' ]");  break;
					case "Youtube" : 
					 $video_link = explode("v=", $video_link);
				    $code = do_shortcode("[youtube id='{$video_link[1]}' height='500' width='500' title='' ]");  break;
					case "Vimeo" :  
					$video_link = explode("/", $video_link);
				    $code = do_shortcode("[vimeo id='".$video_link[count($video_link)-1]."' height='500' width='500'  title='' ]");  break;
					
					
					}
			 $id = "th".uniqid();
		  ?>
          <a href="#<?php echo $id; ?>" class="lightbox" title="<?php the_title(); ?>"> <?php _e('Play','h-framework'); ?> </a>
          <div class="hide">
          <div id="<?php echo $id; ?>" style='height:500px;width:550px'><?php echo $code; ?></div>
          </div>
          <?php else: ?>
         	<a href="<?php echo $ar[0]; ?>" class="lightbox" title="<?php the_title(); ?>"> <?php _e('Zoom','h-framework'); ?> </a>
          <?php endif; ?>
        
         </div>
                            <?php else : ?>  
                            <?php if($extras) : ?>  <a class="single-comment" href="<?php the_permalink(); ?>#comment" > <?php _e("", 'h-framework');  comments_number('0', '1', '%'); ?></a> <?php endif; ?>
                               <a class="more-link" href="<?php the_permalink() ?>"><?php _e('Continue', 'h-framework'); ?></a>
                              
                            <?php endif; ?>
                            
                      </div>
                               
                               
                        
                       </div>
                </li>
          <?php  $counter--; endwhile; else:
              echo  '<h4>'.__("No posts yet !",'h-framework').'</h4>';
            endif;
        	?>
     </ul>
        <?php
	  
  }	
  
  // == Pagination ================================
  
  function pagination($pages = '', $range = 2)
  {
	  global $super_options;
	  
	  $pagination_type = trim($super_options[SN."_pagination"]);
	
	if($pagination_type=="numbers") :     
  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination clearfix'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
	 
	 endif;
	 
	 if($pagination_type=="next/previous") :
	 
	 echo '<div class="pagination"><div class="inner-pagination-wrapper"><div class="prev">';
	 
	 
	 previous_posts_link("&lt;"); 
	 echo '</div><div class="next">';
	 next_posts_link("&gt;"); 
	 
	 echo '</div></div></div>';
	 
	 endif;
	 
}

 // == Init Sidebars ====================
 
 function initSidebars()
 {
	 
$homebar = array(
  'name' => __('Blog Sidebar','h-framework'),
  'description' => 'Widgets in this area will be shown in the right blog sidebar.',
  'before_widget' => '<div class="sidebar-wrap clearfix">',
  'after_widget' => '</div>',
  'before_title' => '<h3 class="custom-font heading">',
  'after_title' => '</h3>',
);




$sidebars = array($homebar);

if(function_exists('register_sidebar')){
	
	foreach($sidebars as $sidebar)
	register_sidebar($sidebar);

} 

$this->registerDynamicFooter();

global $super_options;
$dynamic_active_sidebars = get_option(SN."_active_sidebars");

if(!is_array($dynamic_active_sidebars)) $dynamic_active_sidebars = array();

foreach($dynamic_active_sidebars as  $widget)
{
	$tid = strtolower ( str_replace(" ","",trim($widget)) );
   $temp_widget = array(
  // 'id' => $tid,
  'name' => $widget,
  'description' => __('This is a dynamic sidebar','h-framework'),
  'before_widget' => '<div class="dynamic-wrap sidebar-wrap clearfix">',
  'after_widget' => '</div>',
  'before_title' => '<h3 class="custom-font heading">',
  'after_title' => '</h3>',
  );
register_sidebar($temp_widget);
}
 
 
 }

	// == Content Shortener ( Outputs directly) ======================================
	
	public function shortenContent($num,$stitle) {
	
	$limit = $num+1;

	$title = str_split($stitle);
	$length = count($title);
	if ($length>=$num) {
	    $title = array_slice( $title, 0, $num);
	    $title = implode("",$title)."...";
	     echo $title;
	  } else {
	    echo $stitle;
	  }
	}
	
	// == Content Shortener ======================================
	
	public function getShortenContent($num,$stitle) {
	
	$limit = $num+1;
  
	  $title = str_split($stitle);
	$length = count($title);
	if ($length>=$num) {
	    $title = array_slice( $title, 0, $num);
	    $title = implode("",$title)."...";
	    return $title;
	  } else {
	    return $stitle;
	  }
	}
	
	// == Register Custom Types =================================
	
	function registCustomTypes()
	{
	

	}

  /// == Add Slides Module =========================================
  
  function addSlidable(){
	  
	  
	  add_action("admin_init", "portfolio_admin_init");
	  
	  function portfolio_admin_init(){
		 
		  
	      add_meta_box("exportfolio_credits_meta", "Upload Extra Projects Images", "exportfolio_credits_meta", "post", "normal", "high");
		//  add_meta_box("exportfolio_credits_meta", "Upload Gallery Images", "exportfolio_credits_meta", "gallery", "normal", "high");
		//  add_meta_box("exportfolio_credits_meta", "Upload Event Images", "exportfolio_credits_meta", "events", "normal", "high");
		  
		  
	  }
	  
	  
	  
	  function exportfolio_credits_meta() {
	      global $post;
	      $custom = get_post_custom($post->ID);
	      $slides = unserialize($custom["gallery_items"][0]);
	 	  if(!$slides) $slides = array( array( "src"=>'' , "link"=>'your link here' ));
	      ?>
	  
	    <div id="hades_gallery" class="slideable">
	 	  
	      <div class="toppanel clearfix">
	          <a href="#" id="addslide" class="button"><?php _e('Add item','h-framework'); ?></a>
	      </div>
	      <div class="slider-lists">
	      <ul>
			  <?php  foreach($slides as $slide) { ?>
              <li class="clearfix contract">
              
              
              <div class="slide-head">
              <a href="#" class="move-icon"></a>
              <a href="#" class="max-slide-button slide-toggle-button"><?php _e('Expand','h-framework'); ?></a>
              <a href="#" class="delete-slide-button removeslide"><?php _e('Delete','h-framework'); ?></a>
              
              
              
              </div>
              <div class="slide-body">
              
              <div class="image-slide">
              <div class="separator clearfix">
              <label for=""><?php _e('Upload Image:','h-framework'); ?></label>
              <input type="text" class="" name="imagesrc[]" value="<?php echo $slide['src'] ?>" />
              <a href="#" class="custom_upload_image_button button"><?php _e('Upload','h-framework'); ?></a>
              </div>     
              <div class="separator clearfix hide">
              <label for=""><?php _e('Image Link:','h-framework'); ?></label>
              <input type="text" class="" name="link_src[]" value="<?php echo $slide['link'] ?>" />
              </div>
              
              </div>
              </div>
              
              <input type="hidden" class="hide_mercury" />
              <input type="hidden" name="slide_type[]" value="upload" class="slide_type" />
              </li>
	      <?php } ?>
	      </ul>
	  
	    </div>
	  </div>
	   <?php
	  }
	  
	  add_action('save_post', 'exportfolio_save_details');
	  
	  function exportfolio_save_details(){
	  global $post;
	  if(isset($_POST['slide_type'])) {
	  
	  $slides = array();
	  
	  foreach ( $_POST['slide_type'] as $key => $value )
	  {
	  $urlimage = $_POST['imagesrc'][$key];
	  $ilink =  $_POST['link_src'][$key];
	  
	  
	  $slides[] = array(
	  'src' => $urlimage,
	  'link' => $ilink ,
	  'type' => $value,
	  'title' => ''
	  );
	  
	  
	  
	  }
	  
	  update_post_meta($post->ID, "gallery_items", $slides);
	  update_post_meta($post->ID, "gallery_column", $_POST['gallery_column']);
	  }
	 
	  }
	  
	  function add_exportfolio_scripts()
	  {
	  wp_enqueue_script('jquery-ui-core');
	  wp_enqueue_script('jquery-ui-sortable');
	  
	  }
	  
	  add_action('admin_init','add_exportfolio_scripts');
	
	
$labels = array(
					  'name' => _x("Events", 'post type general name','h-framework'),
					  'singular_name' => _x("Event", 'post type singular name','h-framework'),
					  'add_new' => _x("Add New", 'book','h-framework'),
					  'add_new_item' => __("Add New Event",'h-framework'),
					  'edit_item' => __("Edit Event",'h-framework'),
					  'new_item' => __("New Event",'h-framework'),
					  'all_items' => __("All Events",'h-framework'),
					  'view_item' => __("View Event",'h-framework'),
					  'search_items' => __("Search Event",'h-framework'),
					  'not_found' =>  __("Not Found",'h-framework'),
					  'not_found_in_trash' => __("Not Found in Trash",'h-framework'), 
					  'parent_item_colon' => "",
					  'menu_name' => __("Events",'h-framework')
				  
					);

 $args = array(
					  'labels' => $labels,
					  'description' => __("Add your events here",'h-framework'),
					  'public' => true,
					  'publicly_queryable' => true,
					  'show_ui' => true,
					  'exclude_from_search' => false,
					  'query_var' => true,
					  'rewrite' => TRUE,
					  'menu_icon' => HURL."/css/i/eicon.png",
					  'rewrite' => true,
					  'capability_type' => 'post',
					  '_edit_link' => 'post.php?post=%d',
					  'rewrite' => array(
                        'slug' => "events" ,
                        'with_front' => FALSE,
                        ),
					  'hierarchical' => false,
					  'menu_position' => null,
					  'supports' =>array('title','editor','author','thumbnail','comments')
					  );
					  					

//$events = new CustomPost("events",$args,"Event Categories");

$event_metabox_data = array(
"name" => "Event Details",
"post_type" => "events",
"context" => 'normal',
"priority" => 'default',
"input_fields" => array(
   
   array( "datepicker","datepicker", "time","time",  "textarea" , "text" , "text" ,  "checkbox" ,  "text" ,  "text" , "text", "text" ) ,
   array( "Event Starting Date","Event Ending Date","Starting Time","Ending Time",   "Address" ,"City" ,"State & Country" , "", "Contact Number", "Event Cost","Booking Button Label","Booking Button Link") ,
   array( "start_date" , "ending_date" ,  "starting_time" , "ending_time" , "address" , "city" , "state" ,  "google_map" , "contact_no" , "event_cost" ,"book_label" ,"book_link" ) ,
   array( "" ,"" ,"" ,"" , "" , "" , ""  ,  "Google Map"  , "" , "" , "" ,"")

  )

);

//$event_metabox = new CustomBox("Event Details",$event_metabox_data);
	  
   } 	
   
   // == Super Sidebars ==========================
   
   function initSuperSidebars()
   {
	 
	  
	  add_action("admin_init", "sidebar_admin_init");
	  
	  function sidebar_admin_init(){
		  
		   global $wpdb;
		  $table_db_name = $wpdb->prefix . "maker";
		  $dynamic_posts = $wpdb->get_results("SELECT * FROM $table_db_name ",ARRAY_A);
		  foreach($dynamic_posts as $post) 
		  {
			$pname =   trim(str_replace(" ","",strtolower(strtolower($post["title"]))));
			add_meta_box("exsidebar_credits_meta", "Layout Details", "exsidebar_credits_meta",$pname, "normal", "high");
	    
		  }
		  
	   //   add_meta_box("exsidebar_credits_meta", "Layout Details", "exsidebar_credits_meta", "portfolio", "normal", "high");
		  add_meta_box("exsidebar_credits_meta", "Layout Details", "exsidebar_credits_meta", "post", "normal", "high");
		  add_meta_box("exsidebar_credits_meta", "Layout Details", "exsidebar_credits_meta", "page", "normal", "high");
		//  add_meta_box("exsidebar_credits_meta", "Layout Details", "exsidebar_credits_meta", "events", "normal", "high");
	  }
	  
	  
	  
	  function exsidebar_credits_meta() {
	      global $post;
	    $sidebar =  get_post_meta($post->ID,"_sidebar",true);
		$dy =  get_post_meta($post->ID,"_dynamic_sidebar",true);
	   
	   if( $sidebar=="")  $sidebar = "full";
	    if( $dy=="")  $dy = "Blog Sidebar";
		
		
	      ?>
	  
	    <div id="hades-layout" class="">
	 	  
          <div id="supersidebars">
          <h2> <?php _e('Page Layout','h-framework'); ?> </h2>
            <ul class="clearfix">
              <li class="full">
                <label for="full"></label><input type="radio" id="full" name="super_sidebar" value="full" <?php if($sidebar=="full") echo "checked='checked'"; ?> /></li>
              <li class="left-sidebar">
                <label for="left-sidebar"></label><input type="radio" id="left-sidebar" name="super_sidebar" value="left-sidebar" <?php if($sidebar=="left-sidebar") echo "checked='checked'"; ?> /></li>
              <li class="right-sidebar">
                <label for="right-sidebar"></label><input type="radio" id="right-sidebar" name="super_sidebar" value="right-sidebar" <?php if($sidebar=="right-sidebar") echo "checked='checked'"; ?> /></li>
              
              <?php if($post->post_type=='disable for now') : ?>
              
              <li class="right-left-sidebars">
                <label for="right-left-sidebar"></label><input type="radio" id="right-left-sidebar" name="super_sidebar" value="right-left-sidebar" <?php if($sidebar=="right-left-sidebar") echo "checked='checked'"; ?>  /></li>
              <li class="right-2-sidebars">
                <label for="right-2-sidebars"></label><input type="radio" id="right-2-sidebars" name="super_sidebar" value="right-2-sidebars" <?php if($sidebar=="right-2-sidebars") echo "checked='checked'"; ?> /></li>
              <li class="left-2-sidebars">
              <label for="left-2-sidebars"></label><input type="radio" id="left-2-sidebars" name="super_sidebar" value="left-2-sidebars" <?php if($sidebar=="left-2-sidebars") echo "checked='checked'"; ?> /></li>
              <?php endif; ?>
            </ul>
           
           <h2> <?php _e('Select Sidebar','h-framework'); ?> </h2> 
            
            <?php 
			 $active_sidebars = get_option(SN."_active_sidebars");
			
			?>
           
        <div class="hades_input clearfix">
        
          <label for="dynamic_sidebar"> <?php _e('Sidebar','h-framework'); ?> </label>
        <select name="dynamic_sidebar" id="dynamic_sidebar">
       
        <?php 
		if(!is_array($active_sidebars)) $active_sidebars = array();
		$active_sidebars[] = "Blog Sidebar";
		
		foreach($active_sidebars as $bar)
		{
			if( $dy == $bar )
			echo "<option selected='selected' value='$bar'>{$bar}</option>";
			else
			echo "<option value='$bar'>{$bar}</option>";
		}
		
		?>
        </select>
        
        </div>
            
            
            
          </div>
        
	    </div>
	   <?php
	  }
	  
	  add_action('save_post', 'exsidebar_save_details');
	  
	  function exsidebar_save_details(){
	  global $post;
	  if(isset($_POST["super_sidebar"]))
	  update_post_meta($post->ID,"_sidebar",$_POST["super_sidebar"]);
	  if(isset($_POST["dynamic_sidebar"]))
	  update_post_meta($post->ID,"_dynamic_sidebar",$_POST["dynamic_sidebar"]);
	  }
	  
	
   }	 

  // == Dynamic CSS ================================
  
  function dynamicCSS() {
	  global $super_options;
	  
	  // == Get the body font ========================
	  
	  $bodyfont = ($super_options[SN.'_body_font']=="") ? "PT Sans" : $super_options[SN.'_body_font'];
	  $req_bodyfont = str_replace(" ","+",$bodyfont);
	  $req_bodyfont = "http://fonts.googleapis.com/css?family={$req_bodyfont}&v2";
	  wp_enqueue_style("body-font",$req_bodyfont);
	  // == Choose the font implementation type ====================
	  
	  $font_option = (!$super_options[SN."_toggle_custom_font"]) ? "Google Webfonts" : $super_options[SN."_toggle_custom_font"];
	   
	   // == For google web fonts ==================================
	   
	  if($font_option=="Google Webfonts") :
	      $customfont = ($super_options[SN.'_custom_font']=="") ? "PT Sans" : $super_options[SN.'_custom_font'];
	      $req_customfont = str_replace(" ","+",$customfont);
	      $req_customfont = "http://fonts.googleapis.com/css?family={$req_customfont}&v2";
	      wp_enqueue_style("custom-font",$req_customfont);
	  endif;
      
	  // == For cufon =============================================
	  
	   if($font_option=="Cufon") :
	      $font_name = ($super_options[SN."_cufon_font"]=="") ? "Androgyne" : $super_options[SN."_cufon_font"] ;
		  $c_check = substr ($font_name,0,7);
		  if($c_check=="custom_")
		    $font_name = "uploaded/".$font_name;
		  else
		    $font_name = $font_name.".font.js";
		  
		    wp_enqueue_script("cufon", URL . "/sprites/js/cufon-yui.js", array('jquery'));
            wp_enqueue_script("cufon-font", URL . "/sprites/js/cufon-fonts/$font_name", array('cufon'));
	   endif;
	 
	 // == Custom Google web font ==================================
	 	
		 	
	   if($super_options[SN.'_custom_g_font_enable']=="true")
		  {
			    $bodyfont = ($super_options[SN.'_custom_g_font']=="") ? "PT Sans" : $super_options[SN.'_custom_g_font'];
	            $req_bodyfont = str_replace(" ","+",$bodyfont);
	            $req_bodyfont = "http://fonts.googleapis.com/css?family={$req_bodyfont}&v2";
		  }
	  
	//  wp_enqueue_style("body-font",$req_bodyfont);
	  
	// Custom Inject ====
	  
	 
	  // Adding dynamic css and js through wp head ===============================
	  
	  function nestedFunc()
	  {
		  global $super_options;
		  
		  // == Body font options ===============
		  $bodyfont = ($super_options[SN.'_body_font']=="") ? "PT Sans" : $super_options[SN.'_body_font'];
		  $body_font_unit = ($super_options[SN.'_body_font_unit']=="") ? "px" : $super_options[SN.'_body_font_unit'];
		  $body_bd_size = ($super_options[SN.'_bd_size']=="") ? "12" : $super_options[SN.'_bd_size'];
		  $body_body_font_style = ($super_options[SN.'_body_font_style']=="") ? "normal" : $super_options[SN.'_body_font_style'];
		//  $body_color = ($super_options[SN.'_color']=="") ? "#333" : "#".$super_options[SN.'_color'];
		  
		  // == Custom font css code ==============
		  $font_option = (!$super_options[SN."_toggle_custom_font"]) ? "Google Webfonts" : $super_options[SN."_toggle_custom_font"];
		  if($font_option=="Google Webfonts") :
		  
		    $customfont = ($super_options[SN.'_custom_font']=="") ? "PT Sans" : $super_options[SN.'_custom_font'];
		    $customfont = ".custom-font{  font-family: '".$customfont."', sans-serif; }";
		  
		    if($super_options[SN.'_custom_g_font_enable']=="true")
		    {
		      $customfont = ($super_options[SN.'_custom_g_font']=="") ? "PT Sans" : $super_options[SN.'_custom_g_font'];
		      $customfont = ".custom-font  {  font-family: '".$customfont."', sans-serif; }";
		    }
		  endif;
		  
		   $fancyfont = ($super_options[SN.'_fancy_font']=="") ? "PT Sans" : $super_options[SN.'_fancy_font'];
		   $fancyfont = " .fancy-title , .posts li .extras li , #home-slider h1  {  font-family: '".$fancyfont."', sans-serif; }";
		  
		   
		  // == Cufon Call ===========================
		  
		  if($font_option=="Cufon") :
		    $script = "<script type='text/javascript'>
	        	Cufon.replace('.custom-font');
		   		 </script> ";
	         echo $script;
		  endif;
		  
		  $h1 = $super_options[SN."_h1_font_size"];
		  $h1 = (!$h1) ? "36px" : $h1."px"; 
		  
		  $h2 =  $super_options[SN."_h2_font_size"];
		  $h2 = (!$h2) ? "32px" : $h2."px"; 
		  
		  $h3 =  $super_options[SN."_h3_font_size"];
		  $h3 = (!$h3) ? "28px" : $h3."px"; 
		  
		  $h4 =  $super_options[SN."_h4_font_size"];
		  $h4 = (!$h4) ? "24px" : $h4."px"; 
		  
		  $h5 =  $super_options[SN."_h5_font_size"];
		  $h5 = (!$h5) ? "18px" : $h5."px"; 
		  
		  $h6 =  $super_options[SN."_h6_font_size"];
		  $h6 = (!$h6) ? "12px" : $h6."px"; 
		  
		  $dyanmic_css = $super_options[SN."_custom_css"];
		
		 
	 
		$linkc = $super_options[SN."_link_font_color"];
		$linkc = (!$linkc) ? "333333" : "#".$linkc; 
		
		$linkhc =  $super_options[SN."_link_hover_font_color"];
		$linkhc = (!$linkhc) ? "777777" : "#".$linkhc; 
		
		$footerlc = $super_options[SN."_footer_link_font_color"];
		$footerlc = (!$footerlc) ? "333333" : "#".$footerlc; 
		
		$footerhc =  $super_options[SN."_footer_hover_link_font_color"];
		$footerhc = (!$footerhc) ? "777777" : "#".$footerhc; 
		
		
	
		 
		  // == CSS code for body font =================
		  
		  $stage_bg_color = '';  $footer_bg_color = ''; $stage_bg_t = '';  $footer_bg_t = '';
		  if($super_options[SN."_stage_bgcolor"]!="") $stage_bg_color = "background-color:#". $super_options[SN."_stage_bgcolor"]; 
		  if($super_options[SN."_footer_bgcolor"]!="") $footer_bg_color = "background-color:#". $super_options[SN."_footer_bgcolor"]; 
		  
		   if($super_options[SN."_stage_bgtexture"]!="") $stage_bg_t = "background-image:url(".URL."/sprites/i/stage_textures/". $super_options[SN."_stage_bgtexture"].".png)"; 
		  if($super_options[SN."_footer_bgtexture"]!="") $footer_bg_t = "background-image:url(".URL."/sprites/i/footer_textures/".$super_options[SN."_footer_bgtexture"].".png)"; 
		  
		   if($super_options[SN."_header_texture"]!="") $bg_opt = "background-image:url(".URL."/sprites/textures/".$super_options[SN."_header_texture"].".png)"; 
		 
		  $body_color  = $super_options[SN."_font_color"];
		
		  
		  $code = "<style type='text/css'> 
		    body , .content {  font-family: '".$bodyfont."', sans-serif; 
			  font-size:{$body_bd_size}{$body_font_unit}; 
			  font-style:{$body_body_font_style}; 
			  
			   }
			  $customfont
			
			div.content div.two-third-width div.single-content , div.content div.two-third-width div.single-content p { color:#{$body_color}!important;}
			
			 .content a { color:{$linkc}!important;  }
.content a:hover { color:{$linkhc}!important ;  }
			
			 .content h1 { font-size:$h1; }
			 .content h2 { font-size:$h2; } 
			 .content h3 { font-size:$h3; }
			 .content h4 { font-size:$h4; }
			 .content h5 { font-size:$h5; }
			 .content h6 { font-size:$h6; } 
             
			 .footer-wrap a { color:{$footerlc}!important;  }
 			.footer-wrap a:hover { color:{$footerhc}!important;  }
 
			 /* == ~~ This is the dynamic CSS ==================== */
			 $dyanmic_css
			 /* == ~~ End of dynamic CSS ========================= */
		
			</style>" ;
		  
		  echo $code;
	  }
	  add_action('wp_head','nestedFunc',10,1);
	  
	  
	  }	 
	 
	 // == Include File ===========================
	 
	 function includeFile($src,$type="js")
	 {
		 if($type=="js")
		   wp_enqueue_script($src,URL.'/sprites/js/'.$src);
		 else	
		   wp_enqueue_style($src.'-style',URL.'/sprites/stylesheets/'.$src);
		 
		 
	 }
	 
	 // == Dynamic Footer =====================
	 
	 function registerDynamicFooter() {
		 
		 $footer_layout = get_option(SN."_footer_layout");
		
		 $count = 3;
		 switch($footer_layout)
		 {
			 case "two-col" : $count = 2 ; break;
			 case "three-col" : $count = 3 ; break;
			 case "four-col" : $count = 4 ; break;
			 case "five-col" : $count = 5 ; break;
			 case "six-col" : $count = 6 ; break;
			 case "one-third" : $count = 2 ; break;
			 case "one-fourth" : $count = 2 ; break;
			 case "one-fifth" : $count = 2 ; break;
			 case "one-sixth" : $count = 2 ; break;
			 
		 }
		 
		for($i=1;$i<=$count;$i++)
		 {
		   $sidebar = array(
						'name' => ("Footer Column $i"),
						'description' => 'Widgets will be shown in the footer.',
						'before_widget' => '<div class="footer-wrap clearfix">',
						'after_widget' => '</div>',
						'before_title' => '<h3 class="custom-font footer-heading">',
						'after_title' => '</h3>',
					  );	 
           
		   register_sidebar($sidebar);
		   
		 }
   }

  // == Social Stuff =====================
  
  function socialStuff() {
	  global $super_options;
	   $option = (!$super_options[SN.'_social_set_style']) ? "Style 1" :  $super_options[SN.'_social_set_style']; ?>


<?php switch($option) { case "Style 1" : ?>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-4ef8b43b23c4fd52"></script>
<!-- AddThis Button END -->

<?php break;  case "Style 2" : ?>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e1ab8527e22cf18"></script>
<!-- AddThis Button END -->
<?php break;  case "Style 3" : ?>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e1ab85c4609993a"></script>
<!-- AddThis Button END -->
<?php break;  case "Style 4" : ?>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_google_plusone"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e1ab864700d5749"></script>
<!-- AddThis Button END -->
<?php break;  case "Style 5" : ?>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=xa-4e1ab86d72fcad27" class="addthis_button_compact">Share</a>
<span class="addthis_separator">|</span>
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e1ab86d72fcad27"></script>
<!-- AddThis Button END -->
<?php break;  case "Style 6" : ?>
<!-- AddThis Button BEGIN -->
<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=xa-4e1ab8776cec852d"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e1ab8776cec852d"></script>
<!-- AddThis Button END -->
<?php break;  case "Style 7" : ?>
<!-- AddThis Button BEGIN -->
<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=xa-4e1ab87e56d51201"><img src="http://s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0"/></a>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e1ab87e56d51201"></script>
<!-- AddThis Button END -->
<?php break;  case "Style 8" : ?>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e1ab886685d8c35"></script>
<!-- AddThis Button END -->
<?php break;  } 
	  
	  }	 
	 
} // End of Class

}

// == Hook to trigger some modules on theme activation ========================= 


function my_theme_activate() {
   
   update_option("SN",SN);
   db_install ();
   
   header("Location: admin.php?page=elements.php&action=save&activation=true");
   
   
}

wp_register_theme_activation_hook('Hades_Plus', 'my_theme_activate');

function wp_register_theme_activation_hook($code, $function) {
    $optionKey="theme_is_activated_" . $code;
    if(!get_option($optionKey)) {
        call_user_func($function);
        update_option($optionKey , 1);
    }
}

 function my_theme_deactivate() {
    // code to execute on theme deactivation
 }

wp_register_theme_deactivation_hook('Hades_Plus', 'my_theme_deactivate');
function wp_register_theme_deactivation_hook($code, $function) {
     $GLOBALS["wp_register_theme_deactivation_hook_function" . $code]=$function;
     $fn=create_function('$theme', ' call_user_func($GLOBALS["wp_register_theme_deactivation_hook_function' . $code . '"]); delete_option("theme_is_activated_' . $code. '");');
     add_action("switch_theme", $fn);
}

function db_install () {
   global $wpdb;
  
   $plugin_maker_version = 1;
   $table_name = $wpdb->prefix . "maker";
   if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
      
      $sql = "CREATE TABLE " . $table_name . " (
	  id varchar(40) NOT NULL ,
	  options text,
	  title varchar(240),
	  custom_post text,
	  custom_fields text,
	  UNIQUE KEY id (id)
	);";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);
      add_option("plugin_maker_version", $plugin_maker_version);

   }
   else
   {
	
	$installed_ver = get_option( "plugin_maker_version" );
    if( $installed_ver != $plugin_maker_version ) {

      $sql = "CREATE TABLE " . $table_name . " (
	  id varchar(40) NOT NULL ,
	  options text,
	  title varchar(240),
	  custom_post text,
	  custom_fields text,
	  UNIQUE KEY id (id)
	 );";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);

      update_option( "plugin_maker_version", $plugin_maker_version);
  }
   }
   
  
   
}

function titan_image_resize($max_width,$max_height,$width,$height)
{

$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 
// New dimensions 
$width = intval($ratiow*$width); 
$height = intval($ratiow*$height); 
	return array( "width" => $width , "height" => $height  );
}