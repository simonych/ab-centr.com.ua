<?php

/* ======================================================================= */
/* == Titan Slider ======================================================= */
/* ======================================================================= */

/* 

Author - WPTitans
Code Name - Poseiden
Version - 1.0
Description - Creates multiple slides with over 50 + sliders to choose from . Works only on Top of Hades Plus Framework. Code cannot be reused without permission.

*/

if(!defined('HPATH'))
die(' The File cannot be accessed directly ');

if(!class_exists('TestimonialManager')) {

class TestimonialManager extends Loki {
	
	function __construct () { parent::__construct('Testimonial');  }
	function manager_admin_init(){	
	global $wpdb , $table_db_name;
	 
	  $sliders = "";
	
	 if(isset($_POST['action']) &&  $_GET['page']=="TEST" ) :
	
	 $sliders = array();
	
	$i = 1;
	foreach ( $_POST['slider'] as $key => $value ) :
	
	$name = $_POST['cname'][$key];
	$description = $_POST['description'][$key];
	$link = $_POST['link'][$key];
	
	  
	 $sliders[] = array(
	 "name" => $name,
	 "description" => $description,
	 "link" => $link ,
	
	 ); 
	$i++;
	endforeach;
	
	
	
	
   	update_option(SN."_testimonials",serialize($sliders));
	header("Location: admin.php?page=TEST&saved=true");
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
		
	    var slider_count ,temp;
		var slider   =  $(".custom-list li.hide").first().clone().removeClass('hide');
		$(".custom-list li.hide").first().remove();
	    
		$("#create_slider").live("click",function(e){ 
		
		temp = slider.clone();
		$(".custom-list").append(temp);
		e.preventDefault();
		});
		$(".custom-list .heading").live('click',function(){   $(this).next().slideToggle('normal'); });
		
		$(".custom-list").sortable();
		});
	
	</script>
	
    <?php if( isset($_GET['saved'])) echo "<div class='success_message show'><p>Testimonial Saved </p> </div>"; ?>
    <?php if( isset($_GET['deleted'])) echo "<div class='success_message show'><p>Testimonial Deleted </p> </div>"; ?>
    
    <div class="hades_wrap">
     <form method="post" enctype="multipart/form-data" >
   
      <div class="hades-panel-body">
      
      <div class="hades-panel clearfix">
      <a href="#" id="create_slider" class="button"> Add </a>
      <input type="submit" value="Save" class="button-save" name="action" />
      </div>
      
      <ul class='custom-list'>
      <!-- =============================================================================== -->
      <!-- == Clonable List Item ========================================================= -->
      <!-- =============================================================================== -->
      
      <li class='clearfix hide'> 
      
        <div class="heading clearfix">
          <h4>Testimonial <a href="#" class="delete button"> Delete </a></h4>
        </div>
        <div class="slide-body">
      
        <div class="hades_input clearfix">
      <label for=""> Name </label><input type="text" value="" name="cname[]" class="name" >
      </div>
        <div class="hades_input clearfix">
      <label for=""> Link </label><input type="text" value="" name="link[]" class="link" >
      </div>
        <div class="hades_input clearfix">
      <label for=""> Description </label><textarea name="description[]" id="" cols="30" rows="10"></textarea>
      </div>
     
     </div>
       <input type="hidden" name="slider[]" value="true" />
         </li>
         
         
         <?php 
		 
		 $sliders = unserialize(get_option(SN."_testimonials")); $i=1;
		 if(!is_array($sliders)) $sliders = array();
         foreach($sliders as $slider) : 
		 ?>
         
          <li class='clearfix '> 
      
        <div class="heading clearfix">
          <h4>Testimonial <a href="#" class="delete button"> Delete </a></h4>
        </div>
        <div class="slide-body hide">
      
        <div class="hades_input clearfix">
      <label for=""> Name </label><input type="text" value="<?php echo $slider["name"];?>" name="cname[]" class="name" >
      </div>
        <div class="hades_input clearfix">
      <label for=""> Link </label><input type="text" value="<?php echo $slider["link"];?>" name="link[]" class="link" >
      </div>
        <div class="hades_input clearfix">
      <label for=""> Description </label><textarea name="description[]" id="" cols="30" rows="10"><?php echo $slider["description"];?></textarea>
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

$c = new TestimonialManager();

