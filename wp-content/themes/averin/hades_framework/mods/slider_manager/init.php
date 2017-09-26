<?php

/* ======================================================================= */
/* == Titan Slider ======================================================= */
/* ======================================================================= */

/* 

Author - WPTitans
Code Name - Poseiden
Version - 1.2
Description - Creates multiple slides with over 50 + sliders to choose from . Works only on Top of Hades Plus Framework. Code cannot be reused without permission.

*/

if(!defined('HPATH'))
die(' The File cannot be accessed directly ');

if(!class_exists('TitanSlider')) {

class TitanSlider extends Loki {
	
	function __construct () { parent::__construct('TitanSlider');  }
	function manager_admin_init(){	
	global $wpdb , $table_db_name;
	 
	  $sliders = "";
	
	 if(isset($_POST['action']) &&  $_GET['page']=="TITA" ) :
	
	 $sliders = array();
	
	$i = 1;
	
	if(!is_array($_POST['slider']))
	$_POST['slider'] = array();
	
	foreach ( $_POST['slider'] as $key => $value ) :
	
	
	$title = $_POST['slider_title'][$key];
	$width = $_POST['slider_width'][$key];
	$height = $_POST['slider_height'][$key];
	$type = $_POST['slider_type'][$key];
	$interval = $_POST['interval'][$key];
	$autoplay = $_POST["autoplay{$i}"];
	$desc = $_POST["desc{$i}"];
	$cs = $_POST["controls{$i}"];
	
	
	
	 $slide_data = array();
     
	 $slidesdata = $_POST["slide_title{$i}"];
	 if(!is_array( $slidesdata))
	  $slidesdata = array();
	 
	  foreach($slidesdata as $k => $stitle)
	  {
		  $sl = array();
		  $sl["slide_title"] = $stitle;
		  $sl["slide_link"] = $_POST["slide_link{$i}"][$k];
		  $sl["slide_image"] = $_POST["slide_image{$i}"][$k];
		  $sl["description"] = $_POST["description{$i}"][$k];
		  $sl["stage_option"] = "fullstage";
		 $sl["video_url"] = $_POST["video_url{$i}"][$k]; 
		  $sl["media_type"] = $_POST["media_type{$i}"][$k]; 
		 
		  $slide_data[] = $sl;
	  }
	  
	 $sliders[$title] = array(
	 "title" => $title,
	 "width" => $width,
	 "height" => $height ,
	 "type" => $type ,
	 "interval" => $interval ,
	 "autoplay" => $autoplay ,
	 "desc" => $desc ,
	 "controls" => $cs,
	 "slides" => $slide_data
	 
	 ); 
	$i++;
	endforeach;
	
	//echo "<pre>";
//	print_r($sliders);
//	echo "</pre>";
	
  	update_option(SN."_sliders",serialize($sliders));
	
	header("Location: admin.php?page=TITA&saved=true");
    die; 
	
	endif;
	
	 
	 wp_enqueue_script('thickbox');
	 wp_enqueue_style('thickbox');
	 wp_enqueue_script('jquery-ui-sortable');
	 
	 }	
	function manager_admin_wrap(){	
	global $wpdb , $table_db_name;
	
	
	 
	?>
	
    <script type="text/javascript">
	
	jQuery(function($){
		
	    var slider_count ,temp,slide =  $(".slide-list li.hide").first().clone().removeClass('hide');
		var slider   =  $(".custom-list li.hide").first().clone().removeClass('hide');
		$(".custom-list li.hide").first().remove();
	    
		slider_count = $(".custom-list>li").length;
		$("#create_slider").live("click",function(e){ 
		temp = slider.clone();
		var sn = $('#custom_post_name').val();
		
		if(sn=="") { $('#custom_post_name').addClass("error"); return; } else  $('#custom_post_name').removeClass("error");
		
		 $('#custom_post_name').val('');
		temp.find(".heading span").html(sn);
		temp.find('.slider_title').val(sn);
		slider_count++;
		temp.find('.autoplay').attr("name","autoplay"+slider_count);
		temp.find('.desc').attr("name","desc"+slider_count);
		temp.find('.controls').attr("name","controls"+slider_count);
		
		$(".custom-list").append(temp);
		
		});
		$('.slider_title').live('focusout',function(){ if($(this).val()=="") return; $(this).parents("li").find(".heading span").html($(this).val()); });
		$(".add-slide").live("click",function(e){
			temp = slide.clone();
			var magic_index = $('.custom-list>li').index(  $(this).parents('li.clearfix') ) + 1;
			
			
			temp.find('.slide_title').attr("name","slide_title"+magic_index+"[]");
			temp.find('.slide_link').attr("name","slide_link"+magic_index+"[]");
			temp.find('.slide_image').attr("name","slide_image"+magic_index+"[]");
			temp.find('.description').attr("name","description"+magic_index+"[]");
			temp.find('.stage_option').attr("name","stage_option"+magic_index+"[]");
			temp.find('.media_type').attr("name","media_type"+magic_index+"[]");
			temp.find('.video_url').attr("name","video_url"+magic_index+"[]");
			
			
			$(this).parent().next().append(temp);
			e.preventDefault();
			});
	    
		$(".custom-list .heading").live('click',function(){   $(this).next().slideToggle('normal'); });
		$(".delete-slide").live('click',function(e){ e.stopImmediatePropagation();	$(this).parents('li.sslide').fadeOut('normal',function(){ $(this).remove(); });
		  e.preventDefault();  });
        
		});
	
	</script>
	
    <?php if( isset($_GET['saved'])) echo "<div class='success_message show'><p>Slider Saved </p> </div>"; ?>
    <?php if( isset($_GET['deleted'])) echo "<div class='success_message show'><p>Slider Deleted </p> </div>"; ?>
    
    <div class="hades_wrap">
     
     <div class="hades_information"> <p> Note - The Default slider for Home Page <strong>Width</strong> should be <strong>630px</strong> and <strong>Height</strong> should be <strong>300px</strong>. </p></div>
     
     <form method="post" enctype="multipart/form-data" >
      <div class="hades-panel clearfix slidermanager">
       
       <label for="custom_post_name"> Enter Slider Name </label>
       <input type="text" value="" id="custom_post_name" > 
        
       <a href="#" class="button" id="create_slider" > Create </a> 
        <input type="submit" value="Save" class="button-save" name="action" />
        
      </div>
      <div class="hades-panel-body">
      
      
      <ul class='custom-list'>
      <!-- =============================================================================== -->
      <!-- == Clonable List Item ========================================================= -->
      <!-- =============================================================================== -->
      
      <li class='clearfix hide'> 
      
        <div class="heading clearfix">
          <h4>Slider <span></span> <a href="#" class="delete button"> Delete </a></h4>
        </div>
        <div class="slide-body">
      
        <div class="hades_input clearfix">
      <label for=""> Slider Title </label><input type="text" value="500" name="slider_title[]" class="slider_title" >
      </div>
      <div class="hades_input clearfix">
      <label for=""> Width </label><input type="text" value="500" name="slider_width[]" >
      </div>
      <div class="hades_input clearfix">
      <label for=""> Height </label><input type="text" value="300" name="slider_height[]" >
      </div>
      <div class="hades_input clearfix">
      <label for=""> Slider Type </label>
      <select name="slider_type[]" id="">
      <optgroup  label="Sliders">
      <option value="Fade Slider">Fade Slider</option>
      <option value="Scrollable Slider">Scrollable Slider</option>
      <option value="Default Slider">Default Slider</option> 
      <option value="Accordion Slider">Accordion Slider</option>
      <option value="HTML5 Slider">HTML5 Slider</option>
      <option value="jQuery Slider">jQuery Slider</option>
      
      </optgroup>
      <optgroup label="Advance Effects">
      <option value="cubeoutcenter">cubeoutcenter</option>
      <option value="cubegrow">cubegrow</option>
      <option value="stripalternate">stripalternate</option>
      <option value="stripfade">stripfade</option>
      <option value="striphalf">striphalf</option>
      <option value="cubesidegrow">cubesidegrow</option>
      <option value="curtainsleft">curtainsleft</option>
      <option value="curtainsright">curtainsright</option>
      <option value="randombricks">randombricks</option>
      <option value="waveleft">waveleft</option>
      <option value="waveright">waveright</option>
      <option value="randomverticalstrips">randomverticalstrips</option>
      <option value="randomhorizontalstrips">randomhorizontalstrips</option>
      <option value="zigzaghorizontal">zigzaghorizontal</option>
      <option value="zigzagvertical">zigzagvertical</option>
      </optgroup>
      <optgroup label="Blinds Effects"> 
      <option value="blindsleft">blindsleft</option>
      <option value="blindsright">blindsright</option>
      <option value="blindstop">blindstop</option>
      <option value="blindsbottom">blindsbottom</option>
      </optgroup>
      <optgroup label="Mask Effects"> 
      <option value="Maskcube2">Maskcube2 </option>
      <option value="Maskcube">Maskcube</option>
      <option value="Maskvertical">Maskvertical</option>
      <option value="Maskhorizontal"> Maskhorizontal</option>
      <option value="Maskfull"> Maskfull</option>
      <option value="Maskverticalstrip"> Maskverticalstrip</option>
      </optgroup>
      <optgroup label="HTML5 Effects"> 
      <option value="Overlay">Overlay</option>
      <option value="Color Burn">Color Burn</option>
      <option value="Green Channel">Green Channel</option>
      <option value="Blue Channel">Blue Channel</option>
      <option value="Red Channel">Red Channel</option>
      <option value="Green Shade only">Green Shade only</option>
      <option value="Blue Shade only">Blue Shade only</option>
      <option value="Red Shade only">Red Shade only</option>
      </optgroup>
     
      </select>
      </div>
      <div class="hades_input clearfix">
      <label for=""> Interval ( in seconds ) </label><input type="text" value="5" name="interval[]" />
      </div>
      <div class="hades_input clearfix">
      <label for=""> Autoplay </label><input type="checkbox" value="true" name="autoplay" class="autoplay" />
      </div> 
       <div class="hades_input clearfix">
      <label for=""> Show Description </label><input type="checkbox" value="true" name="desc" class="desc" />
      </div> 
      <div class="hades_input clearfix">
      <label for=""> Controls ( not applies to accordion slider ) </label><input type="checkbox" value="true" name="controls" class="controls" />
      </div>       
      
      <div class="sub-panel clearfix">
      
        <div class="heading-panel clearfix"> <a href="#" class="button add-slide"> Add Slide </a> </div>
        <ul class="slide-list">
         <li class="clearfix hide sslide">
        <div class="heading clearfix">
        <h4>Slide <a href="#" class="delete-slide button"> Delete </a></h4>
        </div>
      <div class="slide-body">
      
      <div class="hades_input clearfix">
      <label for="">Slide Title</label><input type="text" name="slide_title0[]" class="slide_title" />
      </div> <div class="hades_input clearfix"> 
      <label for="">Slide Link</label><input type="text" name="slide_link0[]" class="slide_link" />
      </div> <div class="hades_input clearfix"> 
      <label for="">Slide Image</label><input type="text" name="slide_image0[]" class="slide_image" /><a href="#" class="button custom_upload_image_button"> Upload </a>
      </div> <div class="hades_input clearfix"> 
      <label for="">Slide Description</label> <textarea name="description0[]" id="" cols="30" rows="10" class="description"></textarea>
      </div>

        <div class="hades_input clearfix"> 
      <label for="">Media Type( <strong> Applies Only For Default Slider </strong> )</label> 
      <select name="media_type0[]" id="" class="media_type">
      	<option value="image">Image</option>
        <option value="youtube">Youtube</option>
        <option value="vimeo">Vimeo</option>
        <option value="dedicated">Dedicated Video</option>
      </select>
      </div>
       <div class="hades_input clearfix">
      <label for="">Video URL ( <strong> Applies Only For Default Slider </strong> )</label><input type="text" name="video_url0[]" class="video_url" />
      </div>
      
      
      </div>
       <input type="hidden" name="slide[]" value="true" class="slide" />
      </li>
       </ul>
    
     </div>
      </div>
       <input type="hidden" name="slider[]" value="true" />
         </li>
         
         
         <?php 
		 
		 $sliders = unserialize(get_option(SN."_sliders")); $i=1;
		 
		
		 
		 if(!is_array($sliders)) $sliders = array();
         foreach($sliders as $slider) : 
		 ?>
         
          <li class='clearfix'> 
      
        <div class="heading clearfix">
          <h4>Slider <span><?php echo $slider['title']; ?></span> <a href="#" class="delete button"> Delete </a></h4>
        </div>
        <div class="slide-body hide">
      
        <div class="hades_input clearfix">
      <label for=""> Slider Title </label><input type="text" value="<?php echo $slider['title']; ?>" name="slider_title[]" class="slider_title" />
      </div>
      <div class="hades_input clearfix">
      <label for=""> Width </label><input type="text" value="<?php echo $slider['width']; ?>" name="slider_width[]" />
      </div>
      <div class="hades_input clearfix">
      <label for=""> Height </label><input type="text" value="<?php echo $slider['height']; ?>" name="slider_height[]"/>
      </div>
      <div class="hades_input clearfix">
      <label for=""> Slider Type </label>
      <select name="slider_type[]" id="">
      <?php 
	  $slider_effects_array = array("optiongroup_Sliders","Fade Slider","Scrollable Slider","Default Slider","Accordion Slider","HTML5 Slider","jQuery Slider", "optiongroup_Advance Effects" , "cubeoutcenter" , "cubegrow", "stripalternate" ,"stripfade","striphalf","cubesidegrow","curtainsleft","curtainsright" ,"randombricks","waveleft","waveright","randomverticalstrips","randomhorizontalstrips","zigzaghorizontal","zigzagvertical","optiongroup_Blinds Effects","blindsleft","blindsright","blindstop","blindsbottom","optiongroup_Mask Effects","Maskcube2","Maskcube","Maskvertical","Maskhorizontal","Maskfull","Maskverticalstrip","optiongroup_HTML5 Effects","Overlay","Color Burn","Green Channel","Blue Channel","Red Channel","Green Shade only","Blue Shade only","Red Shade only");
	  $str = '';
	  foreach($slider_effects_array as $ef)
	  {
		  $test = explode("_",$ef);
		  if(count($test)>1)
		  {
			  if($test[1]=="Sliders")
			  $str = $str."<optgroup label='$test[1]'> ";
			  else
			  $str = $str."</optgroup><optgroup label='$test[1]'> ";
		  }
		  else
		  {
		  if($slider['type']==$ef)
		  $str = $str."<option value='$ef' selected='selected'>$ef</option>";
		  else
		  $str = $str."<option value='$ef'>$ef</option>";
		  }
	  }
	  echo $str."</optgroup>";
	  ?>
      </select>
      </div>
      <div class="hades_input clearfix">
      <label for=""> Interval ( in seconds ) </label><input type="text" value="<?php echo $slider['interval']; ?>" name="interval[]" />
      </div>
      <div class="hades_input clearfix">
      <label for=""> Autoplay </label><input type="checkbox" value="true" name="autoplay<?php echo $i; ?>" <?php if($slider["autoplay"]=="true") echo "checked='checked'";?> />
      </div> 
       <div class="hades_input clearfix">
      <label for=""> Show Description </label><input type="checkbox" value="true" name="desc<?php echo $i; ?>" <?php if($slider["desc"]=="true") echo "checked='checked'";?> />
      </div> 
      <div class="hades_input clearfix">
      <label for=""> Controls ( not applies to accordion slider ) </label><input type="checkbox" value="true" name="controls<?php echo $i; ?>" <?php if($slider["controls"]=="true") echo "checked='checked'";?>/>
      </div>       
      
      <div class="sub-panel clearfix">
      
        <div class="heading-panel clearfix"> <a href="#" class="button add-slide"> Add Slide </a> </div>
        <ul class="slide-list">
         <?php $slides = $slider['slides'];  foreach($slides as $slide) :?>
         <li class="clearfix sslide">
        <div class="heading clearfix">
        <h4>Slide <a href="#" class="delete-slide button"> Delete </a></h4>
        </div>
      <div class="slide-body hide">
      
      <div class="hades_input clearfix">
      <label for="">Slide Title</label><input type="text" name="slide_title<?php echo $i; ?>[]" class="slide_title" value="<?php echo $slide['slide_title']; ?>" />
      </div> <div class="hades_input clearfix"> 
      <label for="">Slide Link</label><input type="text" name="slide_link<?php echo $i; ?>[]" class="slide_link" value="<?php echo $slide['slide_link']; ?>" />
      </div> <div class="hades_input clearfix"> 
      <label for="">Slide Image</label><input type="text" name="slide_image<?php echo $i; ?>[]" class="slide_image" value="<?php echo $slide['slide_image']; ?>" /><a href="#" class="button custom_upload_image_button"> Upload </a>
      </div> <div class="hades_input clearfix"> 
      <label for="">Slide Description</label> <textarea name="description<?php echo $i; ?>[]" id="" cols="30" rows="10" class="description"><?php echo $slide['description']; ?></textarea>
      </div>
      
    
      
       <div class="hades_input clearfix"> 
      <label for="">Media Type( <strong> Applies Only For Default Slider </strong> )</label> 
      <select name="media_type<?php echo $i; ?>[]" id="" class="media_type">
      	<?php 
		$opts = array("image" => "Image", "youtube" => "Youtube" , "vimeo" =>"Vimeo" , "dedicated" =>"Dedicated Video");
		$str = '';
		foreach($opts as $key => $option )
		{
			 if($slide['media_type']== $key)
		  $str = $str."<option value='$key' selected='selected'>$option</option>";
		  else
		  $str = $str."<option value='$key'>$option</option>";
		}
		echo $str;
		?>
      </select>
      </div>
        <div class="hades_input clearfix">
      <label for="">Video URL ( <strong> Applies Only For Default Slider </strong> )</label><input type="text" name="video_url<?php echo $i; ?>[]" class="video_url" value="<?php echo $slide['video_url']; ?>" />
      </div>
      
      
      
      
      </div>
       <input type="hidden" name="slide[]" value="true" class="slide" />
      </li>
      <?php endforeach; ?>
       </ul>
    
     </div>
      </div>
       <input type="hidden" name="slider[]" value="true" />
         </li>
         <?php $i++; endforeach; ?>
         
         
       </ul>
      </div>
       </form>
    </div>  
	  
      
	  
	  <?php
	

	
	 }	 
	 
	 
	
	
	
	}

}

$c = new TitanSlider();

