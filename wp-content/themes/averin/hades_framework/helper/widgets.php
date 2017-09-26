<?php

/* ======================================================================= */
/* == Widgets ============================================================ */
/* ======================================================================= */

/* 

Author - WPTitans
Description - Contains all the widgets used by the hades framework. Use index to search.

== Index =====================
------------------------------

1.  Google Map 
2.  Custom Box
3.  Twitter 
4.  Facebook Like
5.  Flickr 
6.  Super Post
7.  Ads 125 x 125px
8.  Ads 300px
9.  Mini Slideshow
10. Contact Form
11. Video 

==============================

*/

if(!defined('HPATH'))
die(' The File cannot be accessed directly ');

// == Google Map =====================

class GoogleMap extends WP_Widget {
	
	function GoogleMap() {
		 /* Widget settings. */
		 $widget_ops = array( 'classname' => 'GoogleMap', 'description' => __( 'Add google map.' ,'h-framework'));

		 /* Widget control settings. */
		 $control_ops = array( "width"=>200);
		 parent::WP_Widget(false,__( "Google map" ,'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			$instance['title']= strip_tags($new_instance['title']); 
			$instance['map_width']= strip_tags($new_instance['map_width']); 
			$instance['map_height']= strip_tags($new_instance['map_height']); 
			$instance['address']= strip_tags($new_instance['address']); 
			return $instance;
	}
	function form($instance) {
		 
		$title = esc_attr($instance['title']);
		$width = esc_attr($instance['map_width']);
		$height = esc_attr($instance['map_height']);
		$address = esc_attr($instance['address']);
		
		if($width=="") $width = 300;
		if($height=="") $height = 250;
		?>
        
       
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('map_width'); ?>"> <?php _e('Map Width','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('map_width'); ?>" name="<?php echo $this->get_field_name('map_width'); ?>" type="text" value="<?php echo $width; ?>" />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('map_height'); ?>"> <?php _e('Map Height','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('map_height'); ?>" name="<?php echo $this->get_field_name('map_height'); ?>" type="text" value="<?php echo $height; ?>" />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('address'); ?>"> <?php _e('Enter Address','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" />
		</p>
        
     
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$title = esc_attr($instance['title']);
	$width = esc_attr($instance['map_width']);
	$height = esc_attr($instance['map_height']);
	$address = esc_attr($instance['address']);
	
	echo $before_widget;
		
	if($title!="")
	echo $before_title." ".$instance['title'].$after_title;
	echo do_shortcode('[map width="'.$width.'" height="'.$height.'" address="'.$address.'" /]');
	echo $after_widget; 
		
		}
	
	

	}

add_action('widgets_init', create_function('', 'return
register_widget("GoogleMap");'));

// == Custom Box ============================

class CustomBoxWidget extends WP_Widget {
	
	function CustomBoxWidget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'CustomBox', 'description' => __(' Create a custom text box with read more link and image.','h-framework') );

		/* Widget control settings. */
		$control_ops = array(  );
		 parent::WP_Widget(false,__("CustomBox",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			$instance['link']= $new_instance['link']; 
			$instance['label']= $new_instance['label']; 
			$instance['description']= $new_instance['description'];
			$instance['title']= strip_tags($new_instance['title']);
			$instance['intro_image_link']= strip_tags($new_instance['intro_image_link']);
			return $instance;
	}
	function form($instance) {
		 
		$link = esc_attr($instance['link']);
		$label = esc_attr($instance['label']);
		$description = $instance['description'];
		$title = esc_attr($instance['title']); 
		$intro_image_link = esc_attr($instance['intro_image_link']); 
		
		if(trim($label)=="") $label = 'more &rarr;';
		?>
    
       
       	 <p class="hades-custom ">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" type="text" />
		</p>
         <p class="hades-custom ">
			<label for="<?php echo $this->get_field_id( 'intro_image_link' ); ?>"><?php _e('Intro Image Link: ( if empty image not will appear )', 'h-framework') ?></label>
            <p class="clearfix">
			<input class="widefat widget_text" id="<?php echo $this->get_field_id( 'intro_image_link' ); ?>" name="<?php echo $this->get_field_name( 'intro_image_link' ); ?>" value="<?php echo $instance['intro_image_link']; ?>" type="text" /> <a href="#" class="button custom_upload_image_button"> Upload </a>
            </p>
		</p>

		<!-- Embed Code: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e('Text', 'h-framework') ?></label>
			<textarea  class="widefat" style="height:200px;" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo  $instance['description']; ?></textarea>
		</p>
		
		 <p class="hades-custom">
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Link:( if empty link will not appear )', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" type="text" />
		</p>
        
        <p class="hades-custom">
			<label for="<?php echo $this->get_field_id( 'label' ); ?>"><?php _e('Label for button', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'label' ); ?>" name="<?php echo $this->get_field_name( 'label' ); ?>" value="<?php echo $instance['label']; ?>" type="text" />
		</p>
		
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$link = esc_attr($instance['link']);
	$label = esc_attr($instance['label']);
	$description = $instance['description'];
	$title = esc_attr($instance['title']); 
	$intro_image_link = esc_attr($instance['intro_image_link']); 
	
	echo $before_widget;
	
	if($title!="")
	echo "<h3 class='heading custom-font custom-box-title'> ".$instance['title'].'</h3>';
		
	if(trim($intro_image_link)=="")
	$img = '';
	else
	$img = "<img src='{$intro_image_link}' alt='custom-box-image' />";
		
	echo " <div class='clearfix custom-box-content'> $img  ".wpautop($description)." </div>  ";
		
	if(trim($link)!="")
	echo "<a href='{$link}' class='more custom-box-more'> $label </a>";
		
	echo  $after_widget;
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("CustomBoxWidget");'));

// == Twitter ================================================= 

class Twitter_Widget extends WP_Widget {
    function __construct() {
        $params = array(
	    'description' => 'Display and cache recent tweets to your readers.',
	    'name' => 'Display Your Tweets'
        );
        
        // id, name, params
        parent::__construct('Twitter_Widget', '', $params);
    }
    
    public function form($instance) {
        extract($instance);
        ?>
        
        <p>
	    <label for="<?php echo $this->get_field_id('title');?>">Title: </label>
	    <input type="text"
		class="widefat"
		id="<?php echo $this->get_field_id('title'); ?>"
		name="<?php echo $this->get_field_name('title'); ?>"
		value="<?php if ( isset($title) ) echo esc_attr($title); ?>" />
        </p>
        
        <p>
	    <label for="<?php echo $this->get_field_id('username'); ?>">Twitter Username:</label>
	    
	    <input class="widefat"
		type="text"
		id="<?php echo $this->get_field_id('username'); ?>"
		name="<?php echo $this->get_field_name('username'); ?>"
		value="<?php if ( isset($username) ) echo esc_attr($username); ?>" />
        </p>
        
        <p>
	    <label for="<?php echo $this->get_field_id('tweet_count'); ?>">
		<?php _e('Number of Tweets to Retrieve:','h-framework'); ?>
	    </label>
	     
	    <input
		type="number"
		class="widefat"
		style="width: 40px;"
		id="<?php echo $this->get_field_id('tweet_count');?>"
		name="<?php echo $this->get_field_name('tweet_count');?>"
		min="1"
		max="10"
		value="<?php echo !empty($tweet_count) ? $tweet_count : 5; ?>" />
        </p>
        <?php
    }
    
    // What the visitor sees...
    public function widget($args, $instance) {
	extract($instance);
        extract( $args );
        
        if ( empty($title) ) $title = 'Recent Tweets';
        
        $data = $this->twitter($tweet_count, $username);
        if ( false !== $data && isset($data->tweets) ) {
            echo $before_widget;
		echo $before_title;
		    echo $title;
		echo $after_title;

		echo '<ul class="latest-tweets"><li>' . implode('</li><li>', $data->tweets) . '</li></ul>';
            echo $after_widget;
        }
    }
    
    private function twitter($tweet_count, $username)
    {
        if ( empty($username) ) return;
        
        $tweets = get_transient('recent_tweets_widget');
        if ( !$tweets ||
	    $tweets->username !== $username ||
	    $tweets->tweet_count !== $tweet_count )
	{
	    return $this->fetch_tweets($tweet_count, $username);
	}
        return $tweets;
    }
    
    private function fetch_tweets($tweet_count, $username)
    {
	$tweets = wp_remote_get("http://twitter.com/statuses/user_timeline/$username.json");
	
	$tweets = @json_decode($tweets['body']);

	// An error retrieving from the Twitter API?
	if ( isset($tweets->error) ) return false;

	$data = new StdClass();
	$data->username = $username;
	$data->tweet_count = $tweet_count;

	foreach($tweets as $tweet) {
	    if ( $tweet_count-- === 0 ) break;
	    $data->tweets[] = $this->filter_tweet( $tweet->text );
	}

	set_transient('recent_tweets_widget', $data, 60 * 5); // five minutes
	return $data;
    }

    private function filter_tweet($tweet)
    {
        // Username links
        $tweet = preg_replace('/(http[^\s]+)/im', '<a href="$1">$1</a>', $tweet);
        $tweet = preg_replace('/@([^\s]+)/i', '<a href="http://twitter.com/$1">@$1</a>', $tweet);
        // URL links
        return $tweet;
    }
    
}

// Here we gooooooo! (Mario voice)
add_action('widgets_init', 'register_Twitter_Widget');
function register_Twitter_Widget()
{
    register_widget('Twitter_Widget');
}

// == Facebook Like ==============================

class FBLike extends WP_Widget {
	
	function FBLike() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'FBLike', 'description' => __('Add facebook Like box to your sidebar.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200);
		 parent::WP_Widget(false,__("Facebook Like Box",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['fb_link']= strip_tags($new_instance['fb_link']); 
			$instance['width']= strip_tags($new_instance['width']);
			$instance['title']= strip_tags($new_instance['title']);
			$instance['show_friends']= $new_instance['show_friends'];
			$instance['fb_header']= $new_instance['fb_header'];
			$instance['fb_stream']= $new_instance['fb_stream'];
			
			 
			return $instance;
	}
	function form($instance) {
		 
		$fb = esc_attr($instance['fb_link']);
		$title = esc_attr($instance['title']);
		$width = $instance['width'];
		$friends = $instance['show_friends'];
		$header = $instance['fb_header'];
		$stream = $instance['fb_stream'];
		
		if($fb==""&&get_option("ami_fb_id"))
		$fb = get_option("ami_fb_id");
		
		
		 ?>
        
        
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('fb_link'); ?>"> <?php _e('Add facebook page link','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('fb_link'); ?>" name="<?php echo $this->get_field_name('fb_link'); ?>" type="text" value="<?php echo $fb; ?>" />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('width'); ?>"> <?php _e('Width','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('show_friends'); ?>"> <?php _e('Show friends','h-framework'); ?> </label>
		<input id="<?php echo $this->get_field_id('show_friends'); ?>" name="<?php echo $this->get_field_name('show_friends'); ?>" type="checkbox" value="true" <?php if($friends) echo "checked='checked'"; ?> />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('fb_header'); ?>"> <?php _e('Show Head','h-framework'); ?> </label>
		<input id="<?php echo $this->get_field_id('fb_header'); ?>" name="<?php echo $this->get_field_name('fb_header'); ?>" type="checkbox" value="true" <?php if($header) echo "checked='checked'"; ?> />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('fb_stream'); ?>"> <?php _e('Show Stream','h-framework'); ?> </label>
		<input id="<?php echo $this->get_field_id('fb_stream'); ?>" name="<?php echo $this->get_field_name('fb_stream'); ?>" type="checkbox" value="true" <?php if($stream) echo "checked='checked'"; ?> />
		</p>
        
        
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
		$fb = esc_attr($instance['fb_link']);
		$title = esc_attr($instance['title']);
		$width = $instance['width'];
		$friends = $instance['show_friends'];
		$header= $instance['fb_header'];
		$stream= $instance['fb_stream'];
	
		echo $before_widget;
		if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		?>
		
        <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
        <fb:like-box href="<?php echo $fb; ?>" width="<?php echo $width; ?>" show_faces="<?php if($friends) echo $friends; else echo 'false'; ?>" stream="<?php if($stream) echo $stream; else echo 'false'; ?>" header="<?php if($header) echo $header; else echo 'false'; ?>"  ></fb:like-box>
        
		<?php
			echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("FBLike");'));

// == Flickr ===========================================


class Flickr extends WP_Widget {
	
	function Flickr() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Flickr', 'description' => __('Display pictures from flickr feed.','h-framework') );

		/* Widget control settings. */
		$control_ops = array(  );
		 parent::WP_Widget(false,__("Flickr Widget",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['profile_id']= strip_tags($new_instance['profile_id']); 
			$instance['photo_nos']= strip_tags($new_instance['photo_nos']); 
			$instance['title']= strip_tags($new_instance['title']); 
			return $instance;
	}
	function form($instance) {
		 
		$id = esc_attr($instance['profile_id']);
		$nos = esc_attr($instance['photo_nos']);
		$title = esc_attr($instance['title']);
		 ?>
       
       <p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('profile_id'); ?>"> <?php _e('Flickr Profile Name','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('profile_id'); ?>" name="<?php echo $this->get_field_name('profile_id'); ?>" type="text" value="<?php echo $id; ?>" />
		</p>
        <p> 
        <label for="<?php echo $this->get_field_id('photo_nos'); ?>"> <?php _e('No of Photos to display','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('photo_nos'); ?>" name="<?php echo $this->get_field_name('photo_nos'); ?>" type="text" value="<?php echo $nos; ?>" />
		</p>
		
       <?php
		
		 }
	function widget($args, $instance) { 
	include_once(HPATH."/helper/phpFlickr.php");
	extract($args); 
	
	$id = esc_attr($instance['profile_id']); 
	$nos = esc_attr($instance['photo_nos']); 
	
	$key = get_option(SN."_flickr_key");
    $flickr_name = esc_attr($instance['profile_id']); ;    
		
		
		 $title = $instance['title'];
		
		echo $before_widget; 
		
			if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
	
	  if(!$key) { echo '<p class="info"> No API KEY ADDED </p>'; } 
	  
	  else { 
  
  $f = new phpFlickr($key);
  $person = $f->people_findByUsername($flickr_name);
  $photos_url = $f->urls_getUserPhotos($person['id']);
  $photos = $f->people_getPublicPhotos($person['id'], NULL, NULL, 16); ?>
  
  <div class="flickr-images">
  <?php 
  $counter = 0;
  foreach ((array)$photos['photos']['photo'] as $photo) { 
   if($counter==$nos)
   break;
 
   $theImageSrc = $f->buildPhotoURL($photo, "thumbnail");
   echo "<a href='http://www.flickr.com/photos/" . $photo['owner'] . "/" . $photo['id'] . "/' ><img src='".($theImageSrc)."' alt=\"".$photos_url.$photo["id"]."\" title='$photo[title]' /></a>";
 
   $counter++;
   }
 echo "	</div> ";		  
			}  
	
		echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("Flickr");'));

/* == Suport Post ============================== */


class SuperPost extends WP_Widget {
	
	function SuperPost() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'SuperPost', 'description' => __('Show Popular or Recent posts from Blog, Portfolio , Gallery and your dynamic custom posts.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200);
		 parent::WP_Widget(false,__("Super Posts",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			$instance['count']= strip_tags($new_instance['count']); 
			$instance['title']= strip_tags($new_instance['title']); 
			$instance['post_type']= strip_tags($new_instance['post_type']); 
			$instance['post_filter']= strip_tags($new_instance['post_filter']); 
			$instance['excerpt']= strip_tags($new_instance['excerpt']); 
			return $instance;
	}
	function form($instance) {
		 
		$count = esc_attr($instance['count']);
		$title = $instance['title'];
		$post_type = $instance['post_type'];	
		$post_filter = $instance['post_filter'];	
		$excerpt = $instance['excerpt'];	
	    $excerpt = trim($excerpt=="") ? 90 : $excerpt ;
		 ?>
        
        <p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('post_type'); ?>"> <?php _e('Post Type','h-framework'); ?> </label>
		<select name="<?php echo $this->get_field_name('post_type'); ?>" id="<?php echo $this->get_field_id('post_type'); ?>">
		 <?php 
		 $array = array("blog","portfolio","gallery","events");
		 foreach($array as $val){
		 
		 if($val==$post_type)
		 echo "<option value='$val' selected>$val</option>";
		 else
		 echo "<option value='$val'>$val</option>";
		 
		 }
		 ?>
        </select>
		</p>
        
         <p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('post_filter'); ?>"> <?php _e('Blog Posts Filter','h-framework'); ?> </label>
		<select name="<?php echo $this->get_field_name('post_filter'); ?>" id="<?php echo $this->get_field_id('post_filter'); ?>">
		 <?php 
		 $array = array("popular","recent","featured");
		 foreach($array as $val){
		 
		 if($val==$post_type)
		 echo "<option value='$val' selected>$val</option>";
		 else
		 echo "<option value='$val'>$val</option>";
		 
		 }
		 ?>
        </select>
		</p>
        
        
        <p class="hades-custom-media"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        
		<p class="hades-custom-media"> 
        <label for="<?php echo $this->get_field_id('count'); ?>"> <?php _e('Number of posts to display','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
		</p>
        
        <p class="hades-custom-media"> 
        <label for="<?php echo $this->get_field_id('excerpt'); ?>"> <?php _e('Enter excerpt Words Limit','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('excerpt'); ?>" name="<?php echo $this->get_field_name('excerpt'); ?>" type="text" value="<?php echo $excerpt; ?>" />
		</p>
		
           
       
        
        
<?php
		
		 }
	function widget($args, $instance) { 
	global $helper;
	global $more;
	extract($args); 
	$post_type = $instance['post_type'];	
	$post_filter = $instance['post_filter'];
	$excerpt = $instance['excerpt'];	
	$count = esc_attr($instance['count']);
	$title = esc_attr($instance['title']);
		
	echo $before_widget;
	if($title!="")
	echo $before_title." ".$instance['title'].$after_title;
		
		?>

   <ul class="widget-posts clearfix" >
                          
    <?php 
    $popPosts = new WP_Query();
    
	if($post_type=="blog") $post_type = "post"; 
    
    if($post_filter=="popular")
	$filter = "&orderby=comment_count";
	else if($post_filter=="recent")
	$filter = "&orderby=date";
	else if($post_filter=="featured")
	$filter = "&tag=featured";
	
	$popPosts->query('post_type='.$post_type.'&showposts='.$count.'&'.$filter);
	
    while ($popPosts->have_posts()) : $popPosts->the_post();  $more = 0; ?>
    
    <li class="clearfix" >
    
     
      <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
      <div class="image">
      <?php 
            $id = get_post_thumbnail_id();
            $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
            echo $helper->imageDisplay( $helper->getMUFix($ar[0])  ,  65 , 65 , false , $ar[0] ,  "1"  ); 
      ?>
      </div><!--image-->
      <?php endif; ?>
    
      <div class="description">
          <h5 class="custom-font"><a href="<?php the_permalink(); ?>"><?php $this->shortenContent(50,strip_shortcodes( get_the_title() )); ?></a></h5>
         <p class='clearfix'> <?php $this->shortenContent($excerpt,strip_tags(get_the_content())); ?></p>
         
      </div><!--details-->
    </li>
    
    <?php endwhile; ?>
    
    <?php wp_reset_query(); ?>

    </ul>
					
					
		<?php
			echo $after_widget; 
		
		}
		
	function shortenContent($num,$stitle) {
	
	$limit = $num+1;
	if (!strnatcmp(phpversion(),'5.2.10') >= 0) 
	$title = str_split($stitle);
	else
	$title = $this->str_split_php4_utf8($stitle);
	$length = count($title);
	if ($length>=$num) {
	    $title = array_slice( $title, 0, $num);
	    $title = implode("",$title)."...";
	    echo $title;
	  } else {
	    echo  $stitle;
	  }
	}
	
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("SuperPost");'));


// == Ads 125 x 125px ========================================


class Ads125 extends WP_Widget {
	
	function Ads125() {
		/* Widget settings. */
			$widget_ops = array( 'classname' => 'Ads125', 'description' => __('Create a ad slot with dimension 125 by 125px.','h-framework') );
		/* Widget control settings. */
			$control_ops = array( 'width' => 200, 'height' => 300);
		
			$this->WP_Widget(false,__("Create Ad 125x125",'h-framework'),$widget_ops,$control_ops); }
	
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			$instance['title']= strip_tags($new_instance['title']); 
		
			for($i=1;$i<9;$i++) {
			$instance['image_url'.$i]= strip_tags($new_instance['image_url'.$i]); 
			$instance['url'.$i]= strip_tags($new_instance['url'.$i]); 
			}
			
		
			return $instance;
	}
	function form($instance) {
		 
		$imgurl = array($instance['image_url1'],$instance['image_url2'],$instance['image_url3'],$instance['image_url4'],$instance['image_url5'],$instance['image_url6'],$instance['image_url7'],$instance['image_url8']);
		$url = array($instance['url1'],$instance['url2'],$instance['url3'],$instance['url4'],$instance['url5'],$instance['url6'],$instance['url7'],$instance['url8']);
     
		?>
		<p> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
        
		<?php
		for($i=0;$i<8;$i++) {
		?>
        
        
                <p<?php if($i==0) echo ' class="hades-custom"';  ?>> 
                <label for="<?php echo $this->get_field_id('image_url'.($i+1)); ?>"> <?php _e('Ad Image URL '.($i+1),'h-framework'); ?> </label>
                <input class="widefat" id="<?php echo $this->get_field_id('image_url'.($i+1)); ?>" name="<?php echo $this->get_field_name('image_url'.($i+1)); ?>" type="text" value="<?php echo $imgurl[$i]; ?>" />
                </p>
                
                <p> 
                <label for="<?php echo $this->get_field_id('url'.($i+1)); ?>"> <?php _e('Ad Link URL '.($i+1),'h-framework'); ?> </label>
                <input class="widefat" id="<?php echo $this->get_field_id('url'.($i+1)); ?>" name="<?php echo $this->get_field_name('url'.($i+1)); ?>" type="text" value="<?php echo $url[$i]; ?>" />
                </p>
		
       
<?php
		}
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$imgurl = array($instance['image_url1'],$instance['image_url2'],$instance['image_url3'],$instance['image_url4'],$instance['image_url5'],$instance['image_url6'],$instance['image_url7'],$instance['image_url8']);
		$url = array($instance['url1'],$instance['url2'],$instance['url3'],$instance['url4'],$instance['url5'],$instance['url6'],$instance['url7'],$instance['url8']);
	    $title = $instance['title'];
		
		echo $before_widget; 
		
		if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		
		?>
		
        <ul class="ads125 clearfix">
       		<?php for($i=0;$i<8;$i++) { 
			
			 if( $imgurl[$i]!="" && $url[$i]!="" ) {
			?>
                 <li> <a href="<?php echo $url[$i] ?>"><img src="<?php echo $imgurl[$i] ?>" alt="<?php echo $url[$i] ?>" /></a> </li>
           <?php 
		         }
			}
		    ?>
        </ul>
		
		<?php
		 	echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("Ads125");'));

/* == Ads 300px ======================= */

class Ads300 extends WP_Widget {
	
	function Ads300() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Ads300', 'description' => __('Create a ad slot with dimension 300 by 300px.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 300 );
		 $this->WP_Widget(false,__("Create Ad 300x250",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['title']= strip_tags($new_instance['title']); 
			$instance['image_url']= strip_tags($new_instance['image_url']); 
			$instance['url']= strip_tags($new_instance['url']); 
			return $instance;
	}
	function form($instance) {
		 
		$imgurl = esc_attr($instance['image_url']);
		$url = $instance['url']; ?>
       
       <p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
        
		<p> 
        <label for="<?php echo $this->get_field_id('image_url'); ?>"> <?php _e('Ad Image URL','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo $imgurl; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('url'); ?>"> <?php _e('Ad Link','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
		</p>
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$img = esc_attr($instance['image_url']); 
	$url = $instance['url'];
	 $title = $instance['title'];
		
		echo $before_widget; 
		
		if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		echo "<a href='$url' class='ads300' ><img src='$img' alt='image' /> </a>"; 
		echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("Ads300");'));



/* == Contact Form Widget ======================= */

class ContactForm extends WP_Widget {
	
	function ContactForm() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ContactForm', 'description' => __( 'Create a quick contact form.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( "width"=>200);
		 parent::WP_Widget(false,__( "Create Quick Contact Form" ,'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['title']= strip_tags($new_instance['title']); 
			$instance['email']= strip_tags($new_instance['email']); 
			$instance['messsage']= strip_tags($new_instance['messsage']); 
			
			return $instance;
	}
	function form($instance) {
		 
		$title = esc_attr($instance['title']);
		$email = esc_attr($instance['email']);
	
		 ?>
        
       
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('email'); ?>"> <?php _e('Email','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
		</p>
  
        
     
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$title = esc_attr($instance['title']); 
	$email = $instance['email'];
	
	
	
	
		echo $before_widget; 
		
			if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		
		if(isset($_POST['qsubmit']))
	   {	
	    	
			$to = $_POST["email"];
			$msg = "Message from ".$_POST["qname"]." email ".$_POST["qemail"]." . Message : ".$_POST["qmsg"];
			
			wp_mail($to, 'Message', ''.$msg ); 
	   }
		?>
        <div class="dynamic_forms clearfix">
           
          <?php if(isset($_POST['qsubmit']))  echo ' <p class="highlight">message sent !</p>'; ?>
           
          <form action='<?php echo HURL."/helper/form_request.php" ?>' method='post' class="clearfix">
          <div class="loader success-box clearfix">
          <p> Message Sent ! </p>
          </div>
          <span class="ajax-loading-icon"></span>
          
           <p class='clearfix'>
              <input type="text" name="qname" class="qname" value="Enter name" />
              </p>
              <p class='clearfix'>
              <input type="text" name="qemail" class="qemail" value="Enter email" />
             </p>
             <p class='clearfix'>
              <textarea name="qmsg" class="qmsg" rows="" cols="">Message</textarea>
             </p>
              
              <input type='hidden' name='notify_email' value='<?php echo $email; ?>' class='notify_email' />
              <input type="hidden" id="ajax_contact_path" value="<?php echo HURL."/helper/contact_request.php"; ?>" />
              <input type="submit" name="qsubmit" value="Send" class="d_submit" />
          </form>
        </div>
        
        <?php
		
		
		echo $after_widget; 
		
		}
	
	


	}

add_action('widgets_init', create_function('', 'return
register_widget("ContactForm");'));


class Video extends WP_Widget {
	
	function Video() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'Video', 'description' => __('Create a video widget.','h-framework') );

		/* Widget control settings. */
		$control_ops = array(  );
		 parent::WP_Widget(false,__("Video",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			$instance['video_code']= $new_instance['video_code']; 
			$instance['description']= strip_tags($new_instance['description']);
			$instance['title']= strip_tags($new_instance['title']);
			$instance['height']= strip_tags($new_instance['height']);
			$instance['width']= strip_tags($new_instance['width']);
			return $instance;
	}
	function form($instance) {
		 
		$code = esc_attr($instance['video_code']);
		$description = esc_attr($instance['description']);
		$title = esc_attr($instance['title']);
		$width = esc_attr($instance['width']);
		$height = esc_attr($instance['height']); 
		
		
		?>
    
       
       	 <p class="hades-custom">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Embed Code: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'video_code' ); ?>"><?php _e('Video Code (Add url for dedicated and youtube and ID for vimeo) ', 'h-framework') ?></label>
			<textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id( 'video_code' ); ?>" name="<?php echo $this->get_field_name( 'video_code' ); ?>"><?php echo  $instance['video_code']; ?></textarea>
		</p>
		
		<!-- Description: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e('Short Description:', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" value="<?php echo stripslashes( $instance['description'] ); ?>" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Set Width:', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo stripslashes( $instance['width'] ); ?>" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Set Height:', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo stripslashes( $instance['height'] ); ?>" />
		</p>
		
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$code = $instance['video_code'];
	$description = esc_attr($instance['description']);
	$title = esc_attr($instance['title']);
	$width = esc_attr($instance['width']);
	$height = esc_attr($instance['height']);
	
		echo $before_widget;
	if($title!="")
		echo $before_title." ".$title .$after_title;
		
		$trick_src = "$code<titan>$height<titan>$width<titan>$title";
		 $temp = "<div id=\"videoowidget\">
			<a href=\"http://www.adobe.com/go/getflashplayer\">
				<img border=\"0\" src=\"http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif\" alt=\"Get Adobe Flash player\" />
			</a>
		</div>
		<script type='text/javascript'>
			// DOCUMENTATION: http://code.google.com/p/swfobject/wiki/documentation
			var flashvars = {};
			flashvars.xmlFile = '".HURL."/helper/request_video.php?src={$trick_src}'; 
			var params = {};
			params.scale = 'noscale';
			params.salign = 'tl';
			params.bgcolor = '#000000';
			params.seamlesstabbing = 'false';
			params.swliveconnect = 'true';
			params.allowfullscreen = 'true';
			params.allowscriptaccess = 'always';
			params.allownetworking = 'all';
			params.base = '';
			var attributes = {};
			attributes.id = 'oxylusflash';
			attributes.align = 'top';
			swfobject.embedSWF('".URL."/sprites/js/main.swf', 'videoowidget', '{$width}', '{$height}','9.0.0', false, flashvars, params, attributes);
		</script>
		
		";
  
			
			
		echo "<div class='video-widget'> $temp  <p> $description </p> </div>";
		
		echo  $after_widget;
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("Video");'));





class TwitterRSSCount extends WP_Widget {
	
	function TwitterRSSCount() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'TwitterRSSCount', 'description' => __('Show total rss subscribers and twitter followers.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200);
		 parent::WP_Widget(false,__("RSS and twitter count",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['twitter_id']= strip_tags($new_instance['twitter_id']); 
			$instance['feedburner_address']= $new_instance['feedburner_address'];
			$instance['title']= strip_tags($new_instance['title']);
			$instance['default_rss_count']= strip_tags($new_instance['default_rss_count']);

			 
			return $instance;
	}
	function form($instance) {
		 
		$twitter = esc_attr($instance['twitter_id']);
		$title = esc_attr($instance['title']);
		$feedburner = $instance['feedburner_address'];
		$default_rss_count = $instance['default_rss_count'];
		
		if ($default_rss_count=="")
		$default_rss_count = "100";
		
		 ?>
        
        
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('twitter_id'); ?>"> <?php _e('Enter Twitter username','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $twitter; ?>" />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('feedburner_address'); ?>"> <?php _e('Feedburner ID','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('feedburner_address'); ?>" name="<?php echo $this->get_field_name('feedburner_address'); ?>" type="text" value="<?php echo $feedburner; ?>" />
		</p>
        
        <p> 
        <label for="<?php echo $this->get_field_id('default_rss_count'); ?>"> <?php _e('Default RSS Count','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('default_rss_count'); ?>" name="<?php echo $this->get_field_name('default_rss_count'); ?>" type="text" value="<?php echo $default_rss_count; ?>" />
		</p>
        
        
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
		$twitter = esc_attr($instance['twitter_id']);
		$title = esc_attr($instance['title']);
		$feedburner = $instance['feedburner_address'];
		$default_rss_count = $instance['default_rss_count'];
	
		echo $before_widget; 
			if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		?>
		
     
		 <div class="clearfix rss-widget">
        <ul>
            <li class="rss-count"><span class="custom-font">subscribers</span>
            <h5 class="custom-font"><?php
			$rsscount =  $this->getRSSCount($feedburner);
			if($rsscount==0||$rsscount=="")
			$rsscount = $default_rss_count;
			 _e( $rsscount ,'h-framework') ;  ?></h5></li>
            <li class="divider"><h2> &amp; </h2></li>
            <li class="twitter-count"><span class="custom-font">followers</span>
            <h5 class="custom-font"><?php
			$twitcount = $this->getTwitterCount($twitter);
			if(!is_numeric($twitcount)||$twitcount==0)
			$twitcount = 100;
			 _e( $twitcount ,'h-framework') ;  ?></h5></li>
        </ul>
      
      </div>
	  
	  
		<?php	echo $after_widget; 
		
		}
		
	function getTwitterCount($uname)
	{
		$twit = @file_get_contents('http://twitter.com/users/show/'.$uname.'.xml');
		$begin = '<followers_count>'; $end = '</followers_count>';
		$page = $twit;
		$parts = explode($begin,$page);
		$page = $parts[1];
		$parts = explode($end,$page);
		$tcount = $parts[0];
		if($tcount == '') { $tcount = '0'; }
		return $tcount;
	}
	
	
	function getRSSCount($uname)
	{
		// RSS Code
		$theurl = @file_get_contents('https://feedburner.google.com/api/awareness/1.0/GetFeedData?uri='. $uname);
		
		$begin = 'circulation="'; $end = '"';
		$page = $theurl;
		$parts = explode($begin,$page);
		$page = $parts[1];
		$parts = explode($end,$page);
		$fbcount = $parts[0];
		if($fbcount == '0' || $fbcount == '' ) { $fbcount = 0; }
		return $fbcount;
	}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("TwitterRSSCount");'));



class PaypalButton extends WP_Widget {
	
	function PaypalButton() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'PaypalButton', 'description' => __('Create a paypal payment button.','h-framework') );

		/* Widget control settings. */
		$control_ops = array(  );
		 parent::WP_Widget(false,__("Paypal Button",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['paypal_id']= strip_tags($new_instance['paypal_id']); 
			$instance['amount']= strip_tags($new_instance['amount']); 
			$instance['button_title']= strip_tags($new_instance['button_title']);
			$instance['title']= strip_tags($new_instance['title']);
			return $instance;
	}
	function form($instance) {
		 
		$paypalemail = esc_attr($instance['paypal_id']);
		$amount = esc_attr($instance['amount']);
		$button_title = esc_attr($instance['button_title']);
		$title = esc_attr($instance['title']); 
		
		if($title=="") $title = "Buy me a coffee";
		if($button_title=="") $button_title = "Donate";
		
		?>
       
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('paypal_id'); ?>"> <?php _e('Enter Paypal ID','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('paypal_id'); ?>" name="<?php echo $this->get_field_name('paypal_id'); ?>" type="text" value="<?php echo $paypalemail; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('amount'); ?>"> <?php _e('Enter Amount($)','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('amount'); ?>" name="<?php echo $this->get_field_name('amount'); ?>" type="text" value="<?php echo $amount; ?>" />
		</p>
        
        <p> 
        <label for="<?php echo $this->get_field_id('button_title'); ?>"> <?php _e('Button Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('button_title'); ?>" name="<?php echo $this->get_field_name('button_title'); ?>" type="text" value="<?php echo $button_title; ?>" />
		</p>
        
        <p> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php  echo $title; ?>" />
		</p>
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$paypalemail = esc_attr($instance['paypal_id']);
	$amount = esc_attr($instance['amount']);
	$button_title = esc_attr($instance['button_title']);
	$title = esc_attr($instance['title']); 
	
		echo $before_widget; 
			if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		
		?>
		
        <div class="paypal-button">
        <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                  <input type="hidden" name="cmd" value="_xclick" />
                  <input type="hidden" name="business" value="<?php echo $paypalemail; ?>" />
                  <input type="hidden" name="currency_code" value="USD" />
                  <input type="hidden" name="item_name" value="Donation" />
                  <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
                  
                  <input type="submit" name="submit" alt="<?php echo $button_title; ?>" value="<?php echo $button_title; ?>" class="paypal-button" />
        </form>
		</div>
		<?php
		 	echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("PaypalButton");'));


class FeedburnerSubscribe extends WP_Widget {
	
	function FeedburnerSubscribe() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'FeedburnerSubscribe', 'description' => __('Usage: Megamenu, sidebars and dynamic widgetized areas . Create a custom text box with read more link.','h-framework') );

		/* Widget control settings. */
		$control_ops = array(  );
		 parent::WP_Widget(false,__("FeedburnerSubscribe",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			$instance['link']= $new_instance['link']; 
			$instance['description']= $new_instance['description'];
			$instance['title']= strip_tags($new_instance['title']);
			
			return $instance;
	}
	function form($instance) {
		 
		$link = esc_attr($instance['link']);
		$description = $instance['description'];
		$title = esc_attr($instance['title']); 
		
		
		
		?>
    
       
       	 <p class="hades-custom">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" type="text" />
		</p>
        
          <p class="hades-custom">
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Feedburner ID', 'h-framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" type="text" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e('Text', 'h-framework') ?></label>
			<textarea  class="widefat" style="height:200px;" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo  $instance['description']; ?></textarea>
		</p>
		
		
		
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
	$link = esc_attr($instance['link']);
		$description = $instance['description'];
		$title = esc_attr($instance['title']); 
		
		echo $before_widget."<div class='feedburner-widget'>";
	if($title!="")
		echo " <h4 class='custom-font'> ".$title."</h4>";
		echo "<p> $description </p>";
		echo "<form class='clearfix' action=\"http://feedburner.google.com/fb/a/mailverify\" method=\"post\" target=\"popupwindow\" onsubmit=\"window.open('http://feedburner.google.com/fb/a/mailverify?uri={$link}', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true\">
		    <input type=\"text\" name=\"email\"/>
		    <input type=\"hidden\" value=\"{$link}\" name=\"uri\"/>
			<input type=\"hidden\" name=\"loc\" value=\"en_US\"/>
			<input type=\"submit\" value=\"Subscribe\" />
			</form>
		";	       
		
		echo  "</div>".$after_widget;
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("FeedburnerSubscribe");'));


// == Facebook Like ==============================

class FBComment extends WP_Widget {
	
	function FBComment() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'FBComment', 'description' => __('Add facebook comment box to your sidebar.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200);
		 parent::WP_Widget(false,__("Facebook Comment Box",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			
			$instance['fb_link']= strip_tags($new_instance['fb_link']); 
			$instance['width']= strip_tags($new_instance['width']);
			$instance['title']= strip_tags($new_instance['title']);
			$instance['no_posts']= $new_instance['no_posts'];
			
			 
			return $instance;
	}
	function form($instance) {
		 
		$fb = esc_attr($instance['fb_link']);
		$title = esc_attr($instance['title']);
		$width = $instance['width'];
		$no_posts = $instance['no_posts'];
		
				 ?>
        
        
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        <p> 
        <label for="<?php echo $this->get_field_id('fb_link'); ?>"> <?php _e('Add facebook page link','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('fb_link'); ?>" name="<?php echo $this->get_field_name('fb_link'); ?>" type="text" value="<?php echo $fb; ?>" />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('width'); ?>"> <?php _e('Width','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
		</p>
        
         <p> 
        <label for="<?php echo $this->get_field_id('no_posts'); ?>"> <?php _e('No of Posts','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('no_posts'); ?>" name="<?php echo $this->get_field_name('no_posts'); ?>" type="text" value="<?php echo $no_posts; ?>" />
		</p>
        
    
        
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
		$fb = esc_attr($instance['fb_link']);
		$title = esc_attr($instance['title']);
		$width = $instance['width'];
		$no_posts = $instance['no_posts'];
		
		echo $before_widget;
		if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		?>
		
        <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=165111413574616";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-href="<?php echo $fb ?>" data-num-posts="<?php echo $no_posts ?>" data-width="<?php echo $width ?>"></div>

        
		<?php
			echo $after_widget; 
		
		}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("FBComment");'));
?>