<?php

/* ======================================================================= */
/* == Shortcodes ========================================================= */
/* ======================================================================= */

/* 

Author - WPTitans
Description - Contains all the shortcodes used by the hades framework. Use index to search.

== Index =====================
------------------------------

1. Google Map
2. Layouts


==============================

*/

if(!defined('HPATH'))
die(' The File cannot be accessed directly ');


// == Google Map =======================================

function googleMap($atts)
{
	extract(
	  shortcode_atts(array(  
	    "width"=>"300",
	    "height"=>"300",
	    "address" => ''
	), $atts)); 
	
	$address = str_replace(" ","+",$address);
	
	return '<div class="google-map" style="width:'.$width.'px;height:'.($height+10).'px;">
	          <iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.co.in/maps?q='.$address.'&amp;ie=UTF8&amp;hq=&amp;hnear='.$address.'&amp;gl=in&amp;z=11&amp;vpsrc=0&amp;output=embed">              </iframe>
		    </div>';
	
}

add_shortcode("map","googleMap");


// == Layout =======================================

function layoutMaker($atts , $content , $code)
{
	global $helper;
	$hasLast = strpos($code,"_last");
	$add = '';
	if($hasLast) $add = "<div class='clearfix'></div>"; 
	return "<div class='$code clearfix'> ". $helper->customFormat( $content )." </div> $add";
	
}

add_shortcode("one_half","layoutMaker");
add_shortcode("one_half_last","layoutMaker");
add_shortcode("one_third","layoutMaker");
add_shortcode("one_third_last","layoutMaker");
add_shortcode("two_third","layoutMaker");
add_shortcode("two_third_last","layoutMaker");
add_shortcode("one_fourth","layoutMaker");
add_shortcode("one_fourth_last","layoutMaker");
add_shortcode("three_fourth","layoutMaker");
add_shortcode("three_fourth_last","layoutMaker");
add_shortcode("one_fifth","layoutMaker");
add_shortcode("one_fifth_last","layoutMaker");
add_shortcode("four_fifth","layoutMaker");
add_shortcode("four_fifth_last","layoutMaker");
add_shortcode("one_sixth","layoutMaker");
add_shortcode("one_sixth_last","layoutMaker");
add_shortcode("five_sixth","layoutMaker");
add_shortcode("five_sixth_last","layoutMaker");

// == DropCaps =======================================

function dropCaps($atts , $content , $code)
{
	
	return "<span class='$code'> $content </span>";
	
}

add_shortcode("dropcap1","dropCaps");
add_shortcode("dropcap2","dropCaps");
add_shortcode("dropcap3","dropCaps");
add_shortcode("dropcap4","dropCaps");


// == Button =======================================

function buttonMaker($atts , $content , $code)
{
	extract(
	  shortcode_atts(array(  
	    "background"=>"green",
	    "radius"=>"2px",
		"border" => "green",
	    "color" => '#ffffff',
		"link" => "#",
		"size" => "small"
	), $atts)); 
	
	$style = " style = ' background-color:$background; border-radius:$radius; -moz-border-radius:$radius; color:$color; border:1px solid $border; ' ";
	
	return "<a href='$link' $style class='$code $size'> $content </a>";
	
}

add_shortcode("button","buttonMaker");


// == Pre Code =======================================

function preStyle($atts,$content)
{
	global $helper;
	return '<pre  class="brush:js;">'.$helper->customFormat($content,true,false)."</pre>";
}
add_shortcode("pre","preStyle");

// == Modal Boxes =======================================

function createBoxes($atts,$content,$code)
{
	extract(
	  shortcode_atts(array(  
	    "title"=>"Box Title",
		"width" => ""
	    ), $atts));
		
		if($width!="")
		$width = "width:{$width}";
		return "<div class='$code widget-box' style='{$width}'> <h4> $title </h4> <div class='widget-content'> $content </div>   </div>"; 
}

add_shortcode("error_box","createBoxes");
add_shortcode("warning_box","createBoxes");
add_shortcode("success_box","createBoxes");
add_shortcode("information_box","createBoxes");

// == Titan Slider =======================================

function sliderMaker($atts)
{
	extract(
	  shortcode_atts(array(  
	    "name"=>""
	    ), $atts));
	
	$link = '';	
	$sliders = unserialize(get_option(SN."_sliders"));
	$slider = $sliders[$name]; 
	$duration = ((int)$slider["interval"] ) * 1000;
	
	if($slider["type"]=="Accordion Slider")
	$link = "jquery.kwicks.js";
	
	$s = new Orion($name,"testslider",$slider["width"],$slider["height"],$slider["type"],$link,$slider['controls'],$slider['autoplay'],$slider['slides'],$duration,$slider["desc"]);
	return $s->getSlider();
}
add_shortcode('titan_slider','sliderMaker');

// == Recent Posts ========

function createRecentPosts($atts)
{
	extract(
	shortcode_atts(array(  
        "post_type" => "post",
		"class"=> '',
		"id" => '' ,
		"count" => 4 ,
		"excerpt" => true,
		"excerpt_length" =>100
    ), $atts)); 
	
	 global $post;
     global $helper;
	 
	 $myposts = get_posts('numberposts='.$count.'&order=DESC&orderby=post_date&post_type='.$post_type);
     $retour="<div class='recentposts_shortcode'><ul class='clearfix posts' >";
     
	   foreach($myposts as $post) :
             setup_postdata($post);
			$retour.= '<li class="clearfix">';
			  if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) :
			 
			 $id = get_post_thumbnail_id();
			 $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
             $image = $helper->getMUFix($ar[0]);	    	  
				        
	         $retour.= $helper->imageDisplay( $image,140,270,true);
	         
			 endif;    
	             
			          
             $retour.='<h5><a href="'.get_permalink().'">'.the_title("","",false).'</a></h5>';
			 if($excerpt==true)
			$retour.= "<p>".$helper->getShortenContent($excerpt_length,strip_tags(get_the_content()))."</p>";
			 $retour.= "</li>";
        endforeach;
        $retour.='</ul></div> ';
        return $retour;
}

add_shortcode("recentposts","createRecentPosts");

// == Popular Posts ========================

function createPopularPosts($atts,$content)
{
	extract(
	shortcode_atts(array(  
       "post_type" => "post",
		"class"=> '',
		"id" => '' ,
		"count" => 4 ,
		"excerpt" => true,
		"excerpt_length" =>100
    ), $atts)); 
	
	 global $post;
     global $helper;
	 $myposts = get_posts('numberposts='.$count.'&order=DESC&orderby=comment_count&post_type='.$post_type);
      $retour="<div class='popularposts_shortcode'><ul class='clearfix posts'>";
        foreach($myposts as $post) :
             setup_postdata($post);
			
			  if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) :
			 
			 $id = get_post_thumbnail_id();
			 $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
             $image = $helper->getMUFix($ar[0]);	    	  
				        
	         $retour.= $helper->imageDisplay( $image,40,40,true);
	         
			 endif;    
	             
			          
             $retour.='<h5><a href="'.get_permalink().'">'.the_title("","",false).'</a></h5>';
			 if($excerpt==true)
			$retour.= "<p>".$helper->getShortenContent($excerpt_length,strip_tags(get_the_content()))."</p>";
			 $retour.= "</li>";
        endforeach;
        $retour.='</ul></div> ';
        return $retour;
}

add_shortcode("popularposts","createPopularPosts");


// == Posts ===========================

function createPosts($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "post_type" => "post",
		"class"=> '',
		"id" => '' ,
		"count" => 4 ,
		"excerpt" => true,
		"excerpt_length" =>100,
		"author_name" => '',
		"category_name" => '',
		 "tag"=>''
    ), $atts)); 
	
	 global $post;
     global $helper;
	 
	 if($author_name!="")
	 $author_name = "&author_name={$author_name}";
	 
	 if($category_name!="")
	 $category_name = "&category_name={$category_name}";
	 
	 if($tag!="")
	 $tag = "&tag={$tag}";
	 
	if($post_type!="")
	 $post_type = "&post_type={$post_type}";
	 
	 $myposts = get_posts('numberposts='.$count."&order=DESC{$author_name}{$category_name}{$tag}{$post_type}");
      $retour="<div class='posts_shortcode'><ul class='clearfix posts'>";
     
             foreach($myposts as $post) :
             setup_postdata($post);
			
			 $retour.='<li class="clearfix">';	
			 
			  if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) :
			 
			 $id = get_post_thumbnail_id();
			 $ar = wp_get_attachment_image_src( $id , array(9999,9999) );
             $image = $helper->getMUFix($ar[0]);	    	  
				        
	         $retour.= $helper->imageDisplay( $image,40,40,true);
	         
			 endif;    
			          
             $retour.='<h5><a href="'.get_permalink().'">'.the_title("","",false).'</a></h5>';
			 if($excerpt==true)
			$retour.= "<p>".$helper->getShortenContent($excerpt_length,strip_tags(get_the_content()))."</p>";
			 $retour.= "</li>";
        endforeach;
				
				$retour.='</ul></div> ';
        return $retour;
}

add_shortcode("posts","createPosts");

// == Related Posts ===================

function createRelatedPosts($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"class"=> '',
		"count" => 4 ,
		
    ), $atts)); 
	
	global $wpdb, $post, $table_prefix;
    
	$i =0;
   
	if ($post->ID) {
		$retval = '<div class="relatedposts_shortcode'.$class.'"><ul>';
 		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);

		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";

		$related = $wpdb->get_results($q);
 		if ( $related ) {
			foreach($related as $r) {
				$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
				if($i>=$count)
				break;
				
				$i++;
			}
		} else {
			$retval .= '
	<li>No related posts found</li>';
		}
		$retval .= '</ul></div>';
		return $retval;
	}
	return;
}

add_shortcode("relatedposts","createRelatedPosts");


function titan_createYoutube($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "width" => "",
		"height" => "",
		"id" => '' ,
		"sense" => false
		
    ), $atts)); 
	
	
	if( trim($width)=="" || trim($height) == "")
	{
		switch($sense)
		{
		case "full_width" : $height = "350px";
		$width = "100%"; break;
		case "one_third" : $height = "300px";
		$width = "100%"; break;
		case "two_third" : $height = "300px";
		$width = "100%"; break;
		case "one_half" : $height = "300px";
		$width = "100%"; break;
		case "three_fourth" : $height = "300px";
		$width = "100%"; break;
		case "one_fourth" : $height = "200px";
		$width = "100%"; break;
		case "one_fifth" : $height = "150px";
		$width = "100%"; break;
		case "four_fifth" : $height = "320px";
		$width = "100%"; break;
		
		}
	}
	
	$id = stripslashes(strip_tags($id));
	
	$temp = "<iframe title=\"YouTube video player\" width=\"{$width}\" height=\"{$height}\" src=\"http://www.youtube.com/embed/{$id}?wmode=Opaque\" frameborder=\"0\" allowfullscreen ></iframe>";
  
	
	return $temp;
}


add_shortcode("youtube","titan_createYoutube");



function titan_createVimeo($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "width" => "300",
		"height" => "250",
		"id" => '' ,
		"sense" => false
		
    ), $atts)); 
	
	$id = stripslashes(strip_tags($id));
	
	if( trim($width)=="" || trim($height) == "")
	{
		switch($sense)
		{
		case "full_width" : $height = "350px";
		$width = "100%"; break;
		case "one_third" : $height = "300px";
		$width = "100%"; break;
		case "two_third" : $height = "300px";
		$width = "100%"; break;
		case "one_half" : $height = "300px";
		$width = "100%"; break;
		case "three_fourth" : $height = "300px";
		$width = "100%"; break;
		case "one_fourth" : $height = "200px";
		$width = "100%"; break;
		case "one_fifth" : $height = "150px";
		$width = "100%"; break;
		case "four_fifth" : $height = "320px";
		$width = "100%"; break;
		
		}
	}
	
	$temp = "<iframe title=\"Vimeo video player\" width=\"{$width}\" height=\"{$height}\" src=\"http://player.vimeo.com/video/{$id}\" frameborder=\"0\" ></iframe>";
  
	
	return $temp;
}


add_shortcode("vimeo","titan_createVimeo");

function createImageBox($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "align" => 'none' ,
		"class"=> '',
		"id" => '' ,
		"caption" => "",
		"src"=>'',
		"width"=>"300",
		"height"=>"300"
    ), $atts)); 
	
	$content = do_shortcode($content);
	if($id!="")
	$id='id = "$id" ';
	if($caption!="")
	$caption = "<span class='caption'>".$caption."<span>";
	
	$temp = "<div class='imageholder $class' $id style='float:$align;width:{$width}px'> <img src='$src' alt='image' width='{$width}'  height='{$height}' /> $caption </div> ";
	

	
	return $temp;
}

add_shortcode("imagewrapper","createImageBox");


function titan_createVideo($atts)
{
	extract(
	shortcode_atts(array(  
        "width" => "300",
		"height" => "250",
		"src" => '' ,
		"title" => 'video',
		"sense" => false
		
    ), $atts)); 
	
	$id = stripslashes(strip_tags($id));
	
	if( trim($width)=="" || trim($height) == "")
	{
		switch($sense)
		{
		case "full_width" : $height = "450";
		$width = "940"; break;
		case "one_third" : $height = "300";
		$width = "100%"; break;
		case "two_third" : $height = "300";
		$width = "100%"; break;
		case "one_half" : $height = "300";
		$width = "100%"; break;
		case "three_fourth" : $height = "300";
		$width = "100%"; break;
		case "one_fourth" : $height = "200";
		$width = "100%"; break;
		case "one_fifth" : $height = "150";
		$width = "100%"; break;
		case "four_fifth" : $height = "320";
		$width = "100%"; break;
		
		}
	}
	
	// serialization dont work !!
	$trick_src = "$src{titan}$height{titan}$width{titan}$title";
	
	// unique ID 
	$id = 'd'.uniqid();
	
	$temp = "<div id=\"{$id}\">
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
			params.wmode='Opaque';
			params.allowscriptaccess = 'always';
			params.allownetworking = 'all';
			params.base = '';
			var attributes = {};
			attributes.id = 'oxylusflash';
			attributes.align = 'top';
			swfobject.embedSWF('".URL."/sprites/js/main.swf', '{$id}', '$width', '$height','9.0.0', false, flashvars, params, attributes);
		</script>
		
		";
  
	
	return $temp;
}


add_shortcode("video","titan_createVideo");

// == Tab widget =

function createTab($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "title" => 'Tab title'
	    ), $atts)); 
	$content = do_shortcode($content);	
	$tab = $title." <hades> ".$content ."<tabend>";
	return $tab;
}

add_shortcode("tab","createTab");

function createTabWidget($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "title" => 'Tab title'
	    ), $atts)); 
	
	global $helper;	
		
	$data = explode("<tabend>",$helper->customFormat(do_shortcode($content),true,true));
	array_pop($data);
	$i =0;

    $titles = array();
	$contents = array();
	for($i=0;$i<count($data);$i++)
	{
		
			$temp = explode("<hades>",$data[$i]);
			$titles[$i] = $temp[0]; 
			$contents[$i] = $temp[1];
		
	}

   $tab = "<div class='shortcodes-tabs'><ul>";
   
	for($i=0;$i<count($titles);$i++)
	$tab = $tab."<li><a href='#shortcodetabs-{$i}'> $titles[$i] </a></li>";
	
	$tab = $tab."</ul>";
	
	for($i=0;$i<count($contents);$i++)
	$tab = $tab."<div id='shortcodetabs-{$i}'> $contents[$i] </div>	";
	  
	  
   $tab = $tab."</div>";
	
	return $tab;
}
add_shortcode("tabs","createTabWidget");

/* == Accordion Widget ============================= */

function createSection($atts,$content)
{
	extract(
	shortcode_atts(array(  
        "title" => 'Tab title'
	    ), $atts)); 
		$content = do_shortcode($content);
	$tab =  "<h3><a href=\"#\" >$title</a></h3>	<div> $content 	</div>";
	return $tab;
}

add_shortcode("section","createSection");

function createAccordion($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"width"=>"100%"
	    ), $atts)); 
	global $helper;	
	$data = strip_tags(do_shortcode($content),"<a>,<p>,<div>,<h3>");
	$data = "<div class='shortcodes-accordion' style='width:$width'> $data </div>";

	return $data;
}
add_shortcode("accordion","createAccordion");

function createQuotes($atts,$content,$code)
{
	extract(
	shortcode_atts(array(  
       
		"class"=> '',
		"id" => '' ,
		
    ), $atts)); 
	
	if($id!="")
	$id='id = "$id" ';
	
	$temp = "<blockquote class='blockcode $class $code' $id> $content </blockquote>";

	
	return $temp;
}

add_shortcode("quotes","createQuotes");
add_shortcode("quotes_left","createQuotes");
add_shortcode("quotes_right","createQuotes");

function createHighlight($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"style"=> 'style1',
		
		
    ), $atts)); 
	

	
	$temp = "<span class='{$style}-highlight-text'> $content </span>";
  
	
	return $temp;
}


add_shortcode("highlight","createHighlight");

function registerSeparator($atts)
{
	extract(
	shortcode_atts(array( 
		
		
    ), $atts)); 
	
	
	return "<div class='separator'><a href='#'> &uarr; </a></div>";
}


add_shortcode("separator","registerSeparator");

// == Form Builder shortcode ============================


function createcontactform($atts,$content)
{
	extract(
	shortcode_atts(array(  
       
		"id" => '' ,
		"width" => "500px"
    ), $atts)); 
	
	if($id=="")
	{
		return "Invalid ID";
	}
	
	$forms = get_option(SN."_forms");
	
	if(!is_array($forms) ) $forms = array();
	$cform = '' ;
	$test_flag = true; 
	
	foreach($forms as $form)
	{
		if($id == $form["key"]  )
		{
			$cform = $form;$test_flag = false;  break; 
		}
	}
	
	if($test_flag)
	return "Invalid ID";
	
	
	$form = "    
	<div class=\"dynamic_forms clearfix\" style='width:{$width}'> 
	 <div class='loader success-box clearfix'>
          <p> Message Sent ! </p>
     </div>
     <form action='".get_bloginfo('template_url')."/hades_framework/helper/form_request.php' method='post' />
	   <span class='ajax-loading-icon'></span>";
	 
	$name_value = $cform["name_value"];
	$form_element = $cform["form_element"];
	$email_notification_mail = $cform["email_notification_mail"];
	
	$captacha_verification  = $cform["captacha_verification"];
	
	if($cform["email_notification"]!="true") $email_notification_mail = "none";
	$label_values = $cform["label_values"];
	$i =0;
	
	foreach($form_element as $input)
	{
		$label = $label_values[$i];
		$name = $name_value[$i];
		
		if($name=="Click to edit name, optional" || trim($name) == "" )
		{
			$name = $input.$i;
		}
		 
		switch($input)
		{
			case "text" :  $form = $form." <p class='clearfix'>
						    <label for='{$name}'> $label </label>
							<input type='text' value='' name='{$name}' id='{$name}' />
						  </p> ";
			              break;
			case "textarea" :  $form = $form." <p class='clearfix'>
						    <label for='{$name}'> $label </label>
							<textarea name='{$name}' id='{$name}' /></textarea>
						  </p> ";
			              break;
			default :  
			             $form = $form." <p class='clearfix'>
						    <label for='{$name}'> $label </label>
							<select id='{$name}' name='{$name}' >";
						 $options = explode(":",$input);
						 $options = $options[1];
						 $options = explode(",",$options);
						  foreach($options as $option)
							$form = $form."<option value='{$option}'>{$option}</option>";
						 $form = $form."</select></p>";	
						
			              break;			  			  
		}
		$i++;
	}
	// print_r($cform);
	
	if($captacha_verification=="true")
	{
		require(HPATH."/helper/recaptchalib.php");
		$publickey = get_option(SN."_captcha_public_key"); // you got this from the signup page
        $form = $form. recaptcha_get_html($publickey);
	}
	
	
	$form = $form."  <input type='hidden' name='notify_email' value='{$email_notification_mail}' class='notify_email' /><input type='hidden' name='form_key' value='{$id}' class='form_key' /><input type='submit' name='qsubmit' value='Send' class='d_submit' /></form></div>";
	return $form;
}


add_shortcode("contactform","createcontactform");

// == Event Calendar Plugin ==================================

function titan_event_calendar($atts)
{
	
global $post;
global $helper;	
if(isset($_GET["y"]))
  $year =$_GET["y"];
else
  $year = date('Y');

$day = date('j');

if(isset($_GET["nav"]))
{
	if($_GET["nav"]=="next")
	{
		$m = $_GET["month"];
		if($m==12)
		{
			$m =0;
		   $year = $year +1;
		}
		$month = $m+1;
	}
	else
	{
		$m = $_GET["month"];
		if($m==0)
		$m =12;
		if($m==1)
		 $year = $year -1;
		
		$month = $m-1;
	}
}
else
$month = date('n');
$link = get_permalink();

$check =  substr($link, -1);
if($check=="/")
$link = $link."?";



	$cal = " 
	
  <div id=\"titan-calendar-view\">
      <div class=\"topbar clearfix\">
   
           
   
      <div id=\"tswitch\" class='clearfix'>
          <a href=\"{$link}&choice=calendar\" class=\"lactive\">".__("Calendar",'h-framework')."</a>
          <a href=\"{$link}&choice=list\" class=\"rr\">".__("List",'h-framework')."</a> 
      </div>

      <div id=\"title\">
         
		<h6> ".date("F",mktime(0,0,0,$month,1,$year))." $year </h6> 
         
      </div>
      
      
       <a href=\"{$link}&amp;nav=next&amp;month=$month&amp;y=$year\" class='event-next'> ".__("Next","h-framework")." </a> 
        <a href=\"{$link}&amp;nav=prev&amp;month=$month&amp;y=$year\"class='event-prev' > ".__("Previous","h-framework")." </a>  
 
  
      
      </div>
 
     <div id=\"titan_calendar\">
	
		<ul class='clearfix cal_head'>
		<li>".__("Sun","h-framework")."</li>
		<li>".__("Mon","h-framework")."</li>
		<li>".__("Tues","h-framework")."</li>
		<li>".__("Wed","h-framework")."</li>
		<li>".__("Thurs","h-framework")."</li>
		<li>".__("Fri","h-framework")."</li>
		<li>".__("Sat","h-framework")."</li>
		</ul>
       ";


$first_Day = date("w", mktime(0,0,0,$month,1,$year));
$totaldays = date("t",mktime(0,0,0,$month,1,$year));
$temp = $first_Day + $totaldays;
$weeksInMonth = ceil($temp/7);
$counter = 1;
$flag = true;
if($month!=date("n"))
$flag=false;

$week_counter = 0;
$week_date = array();


$rs = array();
query_posts("post_type=events&nopaging=true");

while(have_posts()) : the_post();  
    
   $row = array();	
   $row["start_date"] = get_post_meta($post->ID,"start_date",true);
   $row["title"] = get_the_title();
   $row["permalink"] =  get_permalink();
   $row["hasImage"] =  false;
    if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) 
                       {
							 $id = get_post_thumbnail_id();
							 $ar = wp_get_attachment_image_src( $id, array(9999,9999) );
							  $row["hasImage"] =  true;
							  $row["image"] =  $ar[0];
                       }
   $rs[] = $row;
	
endwhile;




for($i=0;$i<$weeksInMonth;$i++)
{
	
	$cal = $cal. "<ul class='clearfix date_rows'>";
	for($j=0;$j<7;$j++)
	{
		$event_div =  '';
		$show_a = '';
		if(( $counter<=$temp) && ( ($counter + $totaldays) - $temp >0) )
	    {
			
			$cal = $cal. "<li class='hasdate'>";
			if(( $counter - $first_Day ) == date("j") &&$t[1]==$month )
			   $cal = $cal. "<span> ".( $counter - $first_Day )."</span> \n ";
			else
			   $cal = $cal." <span> ".( $counter - $first_Day )."</span> \n ";
		 	
		$count_flag = 0;
			foreach($rs as $row)
			{
				$t = explode("-",$row["start_date"]);
				
				if($t[0]==( $counter - $first_Day )&&$t[1]==$month&&$t[2]==$year)
				{
				
					$count_flag++;
				 $cal = $cal."<div class='event-block'>";	
				 
				if( $row["hasImage"] )
				{
					
				  $src = $helper->getMUFix($row["image"]);
			      $src = $helper->imageDisplay($src,128,127,false,$row["permalink"],1,false,false,'','',false);
			      $cal = $cal. $src;	
				}
					
				$cal = $cal. "<h6><a href='{$row[permalink]}' class='evt-link'> $row[title] </a></h6> <p>".$helper->getShortenContent(80,strip_tags(get_the_content()))." </p> </div>";	
				 	
					
					
					
				}
				
			}
		
		 
		 
			
		
			
			
			
			
		}
	   else
		 $cal = $cal. "<li class='no-date'><div></div>";
		
 $cal = $cal. "</li> \n ";
 // echo $event_div;
		 $counter++;
	}
	$cal = $cal. "</ul> \n ";
	
	
}




$cal = $cal. " 
</div>
</div>" ;
	
	
	return $cal;
}

add_shortcode("event_calendar","titan_event_calendar");

// == Event Calendar List ==================================

function titan_event_list($atts)
{
	
global $post;
global $helper;
global $paged;

if(isset($_GET["y"]))
  $year =$_GET["y"];
else
  $year = date('Y');

$day = date('j');

if(isset($_GET["nav"]))
{
	if($_GET["nav"]=="next")
	{
		$m = $_GET["month"];
		if($m==12)
		{
			$m =0;
		   $year = $year +1;
		}
		$month = $m+1;
	}
	else
	{
		$m = $_GET["month"];
		if($m==0)
		$m =12;
		if($m==1)
		 $year = $year -1;
		
		$month = $m-1;
	}
}
else
$month = date('n');
$link = get_permalink();

$check =  substr($link, -1);
if($check=="/")
$link = $link."?";



	$cal = " 
	
  <div id=\"titan-calendar-view\">
      
 
     <div id=\"titan_list\">
	 <ul class='posts'>
	";



query_posts("post_type=events&posts_per_page=6&paged=".$paged);
$rs = array();
while(have_posts()) : the_post();  
    
 $row = array();	
 $row["start_date"] = get_post_meta($post->ID,"start_date",true);
 $row["ending_date"] = get_post_meta($post->ID,"ending_date",true);
 $row["content"] = $helper->getShortenContent(400, strip_tags(get_the_content()) );
 $row["title"] = get_the_title();
 $row["permalink"] =  get_permalink();
 $row["hasImage"] =  false;
    if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) 
                       {
							 $id = get_post_thumbnail_id();
							 $ar = wp_get_attachment_image_src( $id, array(9999,9999) );
							  $row["hasImage"] =  true;
							  $row["image"] =  $ar[0];
                       }
   $rs[] = $row;
	
endwhile;

function cmp($a, $b){ 
    return strcmp($b['start_date'], $a['start_date']); 
}
usort($rs, "cmp");
$rs = array_reverse($rs);



foreach($rs as $event)
{
	if($event['hasImage']) {
	$img = $helper->getMUFix($event['image']);
	$img = $helper->imageDisplay($img,100,200,false,$event['permalink'],1,false,'','',false);
	}
	else
	$img = '';
	
	$cal = $cal."<li class='clearfix'>
	
	
	<div class='clearfix image-wrapper'> $img </div>
	
	<div class='description'>
	
	<h3> $event[title] </h3>
	<div class='date clearfix'> <small class='starting-date'> $event[start_date]</small>  <small class='ending-date'>$event[ending_date]</small> </div>
	<p> $event[content] </p>
	<a href='$event[permalink]' class='more'> more </a>
	</div>
	
	 </li>";
}

$cal = $cal. "
</ul>
</div>
</div>" ;
	
	
	return $cal;
}

add_shortcode("event_list","titan_event_list");

function createMegatables($atts,$content)
{
	extract(
	shortcode_atts(array(  
       	"id" => '' ,
		
    ), $atts));
	 
	if($id=="")
	{
		$temp = "No ID given";
		return $temp;
	}
	
	
	
	
	global $wpdb;
	$table_db_name = $wpdb->prefix . "megatables";
    $table = $wpdb->get_row("SELECT * FROM $table_db_name where id='$id' ",ARRAY_A);
	if(!$table)
	{
		$temp = "Invalid ID ";
		return $temp;
	
	}
	
	$features = unserialize($table["feature_value"]);
	$plan_name  = unserialize($table["plan_name"]);
	$plan_pricing = unserialize($table["plan_pricing"]);
	$currency = $table["plan_pricing_symbol"];
	$plan_link = unserialize($table["plan_link"]);
	$plan_pricing_suffix = unserialize($table["plan_pricing_suffix"]);
	
	$columns =  unserialize($table["columns"]) ;
	if(!is_array($columns))
	$columns = array();
	
	$featured_index = (int)$table["featured_index"];
	$feature_tag = '';
	
	$class_tag = '';
	$temp = "
<div class='shortcodetable $table[class_name] '>
   
    <div class='plans clearfix'>";
    $i=0; $counter = 0; $classname = '';
    foreach($columns as $column) {
    $feature_tag = '';
	$class_tag = '';
	
	  if($counter==0)
	  $class_tag = 'first';
	  
	  if($counter == count($columns)-1)
	  $class_tag = 'last';
	
	  $classname = "class= 'plan{$counter} $class_tag ' ";
  
	  if($i==($featured_index-1)&&$featured_index!=-1)
	  $classname = "class= 'plan{$counter} featured $class_tag ' ";

      $temp = $temp ."<div $classname > <!-- Start of Plan -->
      
		<ul>
		<li class='plan_name'>$plan_name[$i]</li>
		<li class='currency'>{$currency}$plan_pricing[$i]</li>
		<li  class='description'>$plan_pricing_suffix[$i]</li>
		
        ";

		foreach($column as $row)
		{
			$temp = $temp ."<li> $row </li>";
		}
		
		$temp = $temp ."<li class='sign-button'> <a href='$plan_link[$i]'> $features[$i] </a></li>
		</ul>
		
		</div><!-- End of Plan -->";
          $i++; $counter++;
      }

$temp = $temp."</div></div>";
	
	$temp = stripslashes(  $temp ); 
	
	return $temp;
}

add_shortcode("megatables","createMegatables");