<?php

/* ======================================================================= */
/* == Slider Maker ================================================== */
/* ======================================================================= */

/* 

Author - WPTitans
Code Name - Orion
Version - 1.0
Description - Creates all types of sliders you name it :P .

*/

if(!defined('HPATH'))
die(' The File cannot be accessed directly ');

if(!class_exists('Orion')) {

// == Class defination begins	=====================================================
  class Orion {
	  
	  private $name;
	  private $id;
	  private $width;
	  private $height;
	  private $slider;
	  private $script;
	  private $controls;
	  private $auto;
	  private $slides;
	  private $markup;
	  private $interval; 
	  private $desc; 
	 
	   // == Constructor ==============================================================
      function __construct($name='None',$id='nn',$width=500,$height=300,$slider='Fade Slider',$script='',$controls = false, $auto = true , $slides = array() , $interval = 5000, $desc = true ){ 
	  
		
		$this->name = $name;
		$this->id = $id;
		$this->width = $width;
		$this->height = $height;
		$this->slider = $slider;
		$this->script = $script;
		$this->controls = $controls;
		$this->auto = $auto;
		$this->slides = $slides;
		$this->interval = $interval;
		$this->desc = $desc;
		
	
	    switch($slider) {
		case "Default Slider" :$this->createDefaultSlider(); break;	
		case "Fade Slider" :$this->createFadeSlider(); break;
		case "Scrollable Slider" :$this->createScrollabeSlider(); break;
	    case "Accordion Slider" : $this->createAccordionSlider(); break;
		case "cubeoutcenter":
		case "cubegrow":
		case "stripalternate":
		case "stripfade" : 
		case "striphalf" :
		case "cubesidegrow" :
		case "curtainsleft" :
		case "curtainsright":
		case "randombricks":
		case "waveleft":
		case "waveright":
		case "randomverticalstrips":
		case "randomhorizontalstrips":
		case "zigzaghorizontal":
		case "zigzagvertical":
		case "blindsleft": 
		case "blindsright":
		case "blindstop":
		case "blindsbottom":
		case "Maskcube2":
		case "Maskcube":
		case "Maskvertical":
		case "Maskhorizontal":
		case "Maskfull":
		case "Maskverticalstrip":
		case "Overlay":
		case "Color Burn":
		case "Green Channel":
		case "Blue Channel":
		case "Red Channel":
		case "Green Shade only":
		case "Blue Shade only":
		case "Red Shade only":
		case "jQuery Slider" :
		case "HTML5 Slider" : $this->createGenericSlider(); break;
		case "3D(flash) Slider" : $this->create3DSlider(); break;
		case "panBottomToTop" :
		case "panLeftToRight" :
		case "panTopToBottom" : 
		case "panRightToLeft" : 
		case "panDiagonalTop" : 
		case "panDiagonalBottom" : 
		case "zoomInTopLeft" : 
		case "zoomOutTopLeft" :
		case "zoomInTopRight" :
		case "zoomInBottomLeft" : 
		case "zoomInBottomRight" :
		case "Ken Burns Slider" : $this->createKenBurnsSlider(); break;
		}
	
	  }
	   
	   function createKenBurnsSlider() {
		  global $helper;
		  
		  $id = $this->id;
		  $width = $this->width;
		  $height = $this->height;
		  $sl = '';
		  $type ='';
		  switch($this->slider)
		  {
			  case "panBottomToTop" : $sl = "0"; $type ='effect'; break;
			  case "panLeftToRight" : $sl = "1"; $type ='effect'; break;
			  case "panTopToBottom" : $sl = "2"; $type ='effect'; break;
			  case "panRightToLeft" : $sl = "3"; $type ='effect'; break;
			  case "panDiagonalTop" : $sl = "4"; $type ='effect'; break;
			  
			  case "panDiagonalBottom" : $sl = "5"; $type ='effect'; break;
			  case "zoomInTopLeft" : $sl = "6"; $type ='effect'; break;
			  case "zoomOutTopLeft" : $sl = "7"; $type ='effect'; break;
			  case "zoomInTopRight" : $sl = "8"; $type ='effect'; break;
			  case "zoomInBottomLeft" : $sl = "9"; $type ='effect'; break;
			  case "zoomInBottomRight" : $sl = "10"; $type ='effect'; break;
		  }
		  
		  
		  $markup = " <ul class='kbslider' style='width:{$width}px;height:{$height}px;' id='$id'>
		 
		  <input type='hidden' value='".$this->controls."' class='controls' />
		  <input type='hidden' value='".$this->auto."' class='autoplay' />
		  <input type='hidden' value='".$this->interval."' class='interval' />
		  <input type='hidden' value='".$sl."' class='$type' />
		  
		  ";
		  
		  foreach($this->slides as $slide)
		  {
			  $markup = $markup."<li><a href='$slide[slide_link]'><img src='$slide[slide_image]' alt='kb-image' /></a></li>";
		  }
		  
		  
		   $markup = $markup."</ul> ";
		   $this->markup = $markup;
		  
		  }
		  
	  
	    function create3DSlider() {
		  global $helper;
		  
		  $id = $this->id;
		  $wf = 10; $hf = 60;
		  if($this->controls!="true")
		  {
			  $hf = 2;
		  }
		  $width = $this->width+$wf;
		  $height = $this->height+$hf;
		  
		  $id = "pc".uniqid();
		
		  $markup = " 
				<script type=\"text/javascript\">
				
				var flashvars = {};
				flashvars.cssSource = \"".URL."/sprites/stylesheets/piecemaker.css\";
				flashvars.xmlSource = \"".HURL."/helper/piecemaker.php?name=".$this->name."\";
				
				var params = {};
				params.play = \"true\";
				params.menu = \"false\";
				params.scale = \"showall\";
				params.wmode = \"transparent\";
				params.allowfullscreen = \"true\";
				params.allowscriptaccess = \"always\";
				params.allownetworking = \"all\";
				swfobject.embedSWF('".URL."/sprites/js/piecemaker.swf', '$id', '{$width}', '{$height}', '10', null, flashvars, params, null);
				
				</script>
				
				<div class=\"piecemaker-wrapper\" style='width:{$width}px;height:".($height)."px;'>
				<div id=\"$id\">
				<a href=\"http://www.adobe.com/go/getflashplayer\">
				  <img src=\"http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif\" alt=\"Get Adobe Flash player\" />
				</a>
				</div>
				</div>
		";
		  
		
		   $this->markup = $markup;
		  
		  }
	  
	  
	  
	    function createGenericSlider() {
		  global $helper;
		  
		  $id = $this->id;
		  $width = $this->width;
		  $height = $this->height;
		  $sl = '';
		  $type ='';
		  switch($this->slider)
		  {
			 
			  case "HTML5 Slider" : $sl = "html5"; $type ='mode'; break;
			  case "jQuery Slider" : $sl = "default"; $type ='mode'; break;
			  case "cubeoutcenter" : $sl = "1"; $type ='effect'; break;
			  case "cubegrow": $sl = "2"; $type ='effect'; break;
			  case "stripalternate": $sl = "3"; $type ='effect'; break;
			  case "stripfade" :  $sl = "4"; $type ='effect'; break;
			  case "striphalf" : $sl = "5"; $type ='effect'; break;
			  case "cubesidegrow" : $sl = "6"; $type ='effect'; break;
			  case "curtainsleft" : $sl = "7"; $type ='effect'; break;
			  case "curtainsright": $sl = "8"; $type ='effect'; break;
			  case "randombricks": $sl = "9"; $type ='effect'; break;
			  case "waveleft": $sl = "10"; $type ='effect'; break;
			  case "waveright": $sl = "11"; $type ='effect'; break;
			  case "randomverticalstrips": $sl = "14"; $type ='effect'; break;
			  case "randomhorizontalstrips": $sl = "15"; $type ='effect'; break;
			  case "zigzaghorizontal": $sl = "18"; $type ='effect'; break;
			  case "zigzagvertical": $sl = "19"; $type ='effect'; break;
			  case "blindsleft":  $sl = "12"; $type ='effect'; break;
			  case "blindsright":$sl = "13"; $type ='effect'; break;
			  case "blindstop": $sl = "16"; $type ='effect'; break;
			  case "blindsbottom": $sl = "17"; $type ='effect'; break;
			  case "Maskcube2": $sl = "20"; $type ='effect'; break;
			  case "Maskcube": $sl = "21"; $type ='effect'; break;
			  case "Maskvertical": $sl = "22"; $type ='effect'; break;
			  case "Maskhorizontal": $sl = "23"; $type ='effect'; break;
			  case "Maskfull": $sl = "24"; $type ='effect'; break;
			  case "Maskverticalstrip": $sl = "25"; $type ='effect'; break;
			  case "Overlay": $sl = "29"; $type ='effect'; break;
			  case "Color Burn": $sl = "30"; $type ='effect'; break;
			  case "Green Channel": $sl = "28"; $type ='effect'; break;
			  case "Blue Channel": $sl = "26"; $type ='effect'; break;
			  case "Red Channel": $sl = "27"; $type ='effect'; break;
			  case "Green Shade only": $sl = "33"; $type ='effect'; break;
			  case "Blue Shade only": $sl = "34"; $type ='effect'; break;
			  case "Red Shade only": $sl = "32"; $type ='effect'; break;
		  }
		  
		  
		  $markup = " <ul class='quartzslider' style='width:{$width}px;height:{$height}px;' id='$id'>
		  
		  <input type='hidden' value='".$this->controls."' class='controls' />
		  <input type='hidden' value='".$this->auto."' class='autoplay' />
		  <input type='hidden' value='".$this->interval."' class='interval' />
		  <input type='hidden' value='".$sl."' class='$type' />
		  
		  ";
		  
		  foreach($this->slides as $slide)
		  {
			    $s_title =''; $s_desc = '';$desc = '';
			   
			   if(trim($slide['slide_title'])!="")
			  $s_title = " <h2>$slide[slide_title] </h2>";
			  
			   if(trim($slide['description'])!="")
			  $s_desc = " <p> $slide[description]</p>";
			  
			  if($this->desc=="true")
			  $desc = stripslashes("<div class='desc'> $s_title $s_desc </div> ");
			  
			  $src = $helper->getMUFix($slide["slide_image"]);
			   $src = $helper->imageDisplay($src,$height,$width,false,$slide["slide_link"],1,false,'','',false);
			   $markup = $markup."<li> $src $desc </li>";
		  }
		  
		  
		   $markup = $markup."</ul> ";
		   $this->markup = $markup;
		  
		  }
		  

	  
	  function createFadeSlider() {
		  global $helper;
		  
		  $id = "fd".uniqid();
		  $width = $this->width;
		  $height = $this->height;
		
		  $markup = " <ul class='fadeslider' style='width:{$width}px;height:{$height}px;' id='$id'>
		  
		  <input type='hidden' value='".$this->controls."' class='controls' />
		  <input type='hidden' value='".$this->auto."' class='autoplay' />
		  <input type='hidden' value='".$this->interval."' class='interval' />
		  
		  ";
		 
		  foreach($this->slides as $slide)
		  {
			    $s_title =''; $s_desc = '';$desc = '';
			   
			   if(trim($slide['slide_title'])!="")
			  $s_title = " <h2>$slide[slide_title] </h2>";
			  
			   if(trim($slide['description'])!="")
			  $s_desc = " <p> $slide[description]</p>";
			  
			  if($this->desc=="true")
			  $desc = stripslashes("<div class='desc'> $s_title $s_desc </div> ");
			  
			  $src = $helper->getMUFix($slide["slide_image"]);
			   $src = $helper->imageDisplay($src,$height,$width,false,$slide["slide_link"],1,false,'','',false);
			   $markup = $markup."<li> $src $desc </li>";
		  }
		  
		  
		  
		   $markup = $markup."</ul> ";
		   $this->markup = $markup;
		  
		  }
	  
	  function createDefaultSlider() {
		  global $helper;
		  
		  $id = "s".uniqid();
		  $width = $this->width;
		  $height = $this->height;
		
		  $markup = " <ul class='stageslider' style='width:{$width}px;height:{$height}px;' id='$id'>
		  
		  <input type='hidden' value='".$this->controls."' class='controls' />
		  <input type='hidden' value='".$this->auto."' class='autoplay' />
		  <input type='hidden' value='".$this->interval."' class='interval' />
		  
		  ";
		 
		  foreach($this->slides as $slide)
		  {
			    $s_title =''; $s_desc = '';$desc = '';
			   
			   if(trim($slide['slide_title'])!="")
			  $s_title = " <h2>$slide[slide_title] </h2>";
			  
			   if(trim($slide['description'])!="")
			  $s_desc = wpautop(" $slide[description]");
			  
			  if($this->desc=="true")
			  $desc = stripslashes("<div class='desc'> $s_title $s_desc  <a href='$slide[slide_link]' class='read-more'>READ MORE</a></div> ");
			  
			
			  $src = '';
			  $video_link = $slide["video_url"];
			  switch($slide['media_type']){
							  
							  case "dedicated" : $src = "<div class='videoholder'><div style='height:{$height}px'>".do_shortcode("[video src='{$video_link}' height={$height} width={$width} title='' ]")."</div></div>";  break;
							  case "youtube" : 
							  $video_link = explode("v=", $video_link);
							  $src = "<div class='videoholder'><div style='height:{$height}px'>".do_shortcode("[youtube id='{$video_link[1]}' height='{$height}' width='{$width}' title='' ]")."</div></div>";  break;
							  case "vimeo" :  
							  $video_link = explode("/", $video_link);
							  $src = "<div class='videoholder'><div style='height:{$height}px'>".do_shortcode("[vimeo id='".$video_link[count($video_link)-1]."' height='{$height}' width='{$width}' title='' ]")."</div></div>";  break;
							  case "image" :   $src = $helper->getMUFix($slide["slide_image"]);
											  $src = $helper->imageDisplay($src,$height,$width,false,$slide["slide_link"],1,false,'','',false); break;
							  
							  }
			  
			   
			
			 
			  $markup = $markup."<li class='$slide[stage_option]'> $src $desc </li>";
		  }
		  
		  
		  
		   $markup = $markup."</ul> ";
		   $this->markup = $markup;
		  
		  }	  
		  
	   function createScrollabeSlider() {
		  global $helper;
		  
		 $id = "ss".uniqid();
		  $width = $this->width;
		  $height = $this->height;
		 
		 if($this->auto=="true")
		 $autoscroll = 'autoscroll';
		 
		  $markup = " <div class='scrollable $autoscroll'  style='width:{$width}px;height:{$height}px;' >
		   <input type='hidden' value='".$this->interval."' class='interval' />
		   <ul class='items' id='$id'>
		  ";
		  
		  foreach($this->slides as $slide)
		  {
			    $s_title =''; $s_desc = '';$desc = '';
			   
			   if(trim($slide['slide_title'])!="")
			  $s_title = " <h2>$slide[slide_title] </h2>";
			  
			   if(trim($slide['description'])!="")
			  $s_desc = " <p> $slide[description]</p>";
			  
			  if($this->desc=="true")
			  $desc = stripslashes("<div class='desc'> $s_title $s_desc </div> ");
			  
			  $src = $helper->getMUFix($slide["slide_image"]);
			   $src = $helper->imageDisplay($src,$height,$width,false,$slide["slide_link"],1,false,'','',false);
			   $markup = $markup."<li> $src $desc </li>";
		  }
		  
		  
		  
		   $markup = $markup."</ul>";
		   
		   
		    if($this->controls=="true") : 
               $markup = $markup.'         <div class="arrow-set clearfix">  <!-- Arrow Set -->
                           <a class="prev" href="#"> &larr; </a>
                           <a class="next" href="#"> &rarr; </a>
                       </div>';
                       
                    endif;  
		   
		     $markup = $markup."</div>";
		   $this->markup = $markup;
		  
		  }
	  
	   function createAccordionSlider() {
		   global $helper;
		  
		  $id = $this->id;
		  $width = $this->width;
		  $height = $this->height;
		
		  $markup = " <div class='kwicks-wrapper' style='width:{$width}px;height:{$height}px;'><ul class='kwicks' style='width:{$width}px;height:{$height}px;' id='$id'>
		  ";
		 $swidth =  $width/( count($this->slides) );
		  
		  foreach($this->slides as $slide)
		  {
			    $s_title =''; $s_desc = '';$desc = '';
			   
			   if(trim($slide['slide_title'])!="")
			  $s_title = " <h2>$slide[slide_title] </h2>";
			  
			   if(trim($slide['description'])!="")
			  $s_desc = " <p> $slide[description]</p>";
			  
			  if($this->desc=="true")
			  $desc = stripslashes("<div class='desc'> $s_title $s_desc </div> ");
			  
			  $src = $helper->getMUFix($slide["slide_image"]);
			   $src = $helper->imageDisplay($src,$height,$width,false,$slide["slide_link"],1,false,'','',false);
			  
			  $markup = $markup."<li style='width:{$swidth}px;height:{$height}px;'> $src $desc </li>";
		  }
		  
		  
		   $markup = $markup."</ul> </div>";
		   $this->markup = $markup;
		  }
		   
	  public function getSlider()
	  {
		  return $this->markup; 
	  }
	  
	   } // == End of Class ==========================
  
}

