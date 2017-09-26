<?php 

/* 

======================================================================================
== Hades Option Panel ================================================================
======================================================================================

Version 6.1 
Authors - WPTitans

Current Elements -
--------------------------------------------------------
  1.  Text Box            =  ( code => text ) Creates a text box. 
  2.  Text Area           =  ( code => textarea) Creates a textarea 
  3.  Checkboxes          =  ( code => checkbox) Creates checkboxes
  4.  Radio buttons       =  ( code => radio) Creates Radio buttons
  5.  Slider              =  ( code => slider) Creates a numeric slider
  6.  Color picker        =  ( code => colorpicker) Creates a color picker with a supporting textbox
  7.  Drop down lists     =  ( code => select) Creates a dropdown list
  8.  Toggle              =  ( code => toggle) Creates a Yes/No radio button set
  9.  Includes            =  ( code => include) Adds a way to include advance panels
  10. Sub Panel Activated =  ( code => subtitle) Ability to create nested panels
  11. Upload              =  ( code => upload) Creates an upload box
  12. Help                =  ( code => help) Creates a inframe which can be link to pages.
  13. Custom Block        =  ( code => custom) Allows to add custom blocks in panels/
======================================================================================

*/

// == ~~ Get Sliders ===============

$ex_sliders = unserialize(get_option(SN."_sliders"));
$sliders = array();

if(!is_array($ex_sliders)) $ex_sliders = array("No Sliders");
foreach($ex_sliders as $slider) $sliders[] = $slider['title']; 

$active_sidebars = get_option(SN."_active_sidebars");
if(!is_array($active_sidebars )) $active_sidebars = array();
$active_sidebars[] = "Blog Sidebar";

global $wpdb;
$table_db_name = $wpdb->prefix . "megatables";
$tables = $wpdb->get_results("SELECT id,table_name FROM $table_db_name ",ARRAY_A);
$table_array = array("none"=>"None");
 foreach($tables as $table )
 $table_array[$table['id']] = $table["table_name"];


/* ====================================================================================== */
/* == General Settings Panel ============================================================ */
/* ====================================================================================== */

$options[]   = array( 
		           "name" => "General Settings",
	  	           "type" => "section"
		          );
$options[]   = array( 
			      "name" => $themename." Options",
			      "type" => "information",
			      "description" => ""
		           );
		  				  
$options[]   = array( "type" => "open");

		  

	
/* == Sub Panel Begins ================================================================== */

$options[]   = array(
				   "name" => "Basic Settings" , 
				   "type"=>"subtitle" , 
				   "id"=>"basic"
					 );

$options[]   = array(
                  "name" => "Logo Upload",
				  "desc" => "upload your logo here.",
				  "id" => $shortname."_logo",
				  "type" => "upload",
				  "std" => URL."/sprites/i/logo.png"	 
				  );

$options[]   = array(
                  "name" => "Favicon Upload",
				  "desc" => "upload your logo here.",
				  "id" => $shortname."_favicon",
				  "type" => "upload",
				  "std" => "your upload path",
				  "parentClass" => "h-advance"	 
				  );				  
				   
$options[]   = array(
                 "name" => "Tracking Code",
	             "desc" => "Add your Google Analytics code or some other, this will be in footer inside <strong>script tags.</strong>.",
	             "id" => $shortname."_tracking_code",
	             "type" => "textarea",
	             "std" => ""	 
				  );	


$options[]   = array(
                 "name" => "Custom Css Code",
	             "desc" => "Quick way of adding css style to your site.",
	             "id" => $shortname."_custom_css",
	             "type" => "textarea",
	             "std" => ""	 
				  );

			  				  
$options[]   = array("type"=>"close_subtitle");

/* == Sub Panel Ends ===================================================================== */
	




/* == Sub Panel Begins =================================================================== */

$options[]   = array(
				   "name" => "Misc" , 
				   "type"=>"subtitle" , 
				   "id"=>"misc"
					 );

$options[]   = array( 
				  "name" => "Pagination Style",
				  "desc" => "select pagination style here.",
				  "id" => $shortname."_pagination",
				  "type" => "select",
				  "options" => array("numbers","next/previous"),
				  "std" => "numbers",
				  "parentClass" => "h-advance"
				 );


$options[]   = 	array( 
						"name" => "Enter your feedburner ID",
						"desc" => "Add the ID from your FeedBurner account in here.",
						"id" => $shortname."_feedburner",
						"type" => "text",
						"std" => "http://feeds.feedburner.com/yourID"
					);
							
				
$options[]   =   array( "name" => "Google API Key",
					"desc" => "Required for the Smart Sense url shortener to work. For more details <a href='http://code.google.com/apis/loader/signup.html'>visit</a> Google for more info about there API",
					"id" => $shortname."_api_key",
					"type" => "text",
					"std" =>  "" );				 				 				 		 				
				
$options[]   = array("type"=>"close_subtitle");

/* == Sub Panel Ends ===================================================================== */
/* == Sub Panel Begins =================================================================== */

$options[]   = array(
						"name" => "&rarr; Top 768px x 90px Banner Settings " , 
						"type"=>"subtitle", 
						"id"=>"topbanner"
					  );
				
$options[]   = 	array( 
						"name" => "Show Banner",
						"desc" => "Enable / disable top banner here.",
						"id" => $shortname."_banner_enable",
						"type" => "toggle",
						"std" => "true"
					  );
									
$options[]   = 	array( 
						"name" => "Banner Type",
						"desc" => "Select between adsense banner or our custom build banner slider.",
						"id" => $shortname."_banner_type",
						"type" => "select",
						"options" => array("Image Banner",  "Adsense"),
						"std" => "Image Banner"
					  );	
					  
				
$options[]   = 	array( 
						"name" => "Enter Google adsense code(including script tags)",
						"desc" => "Enter your adsense banner code here.",
						"id" => $shortname."_ads_sense",
						"type" => "textarea",
						"std" => ""
						);
						
						
				
$options[]   = 	array( 
						"name" => "Image 1 source",
						"desc" => "Upload image 1 with size 768 x 90px. ",
						"id" => $shortname."_banner_img1",
						"type" => "upload",
						"std" => URL."/images/top-banner.png"
					);
$options[]   = 	array( 
						"name" => "Image 1 link",
						"desc" => "Add your iimage 1 link here text here.",
						"id" => $shortname."_banner_link1",
						"type" => "text",
						"std" => ""
						);	
				
				
$options[]   = array( 
						"name" => "Image 2 source",
						"desc" => "Upload image 2 with size 768 x 90px. ",
						"id" => $shortname."_banner_img2",
						"type" => "upload",
						"std" => URL."/images/top-banner.png"
					);
$options[]   = array( 
						"name" => "Image 2 link",
						"desc" => "Add your iimage 2 link here text here.",
						"id" => $shortname."_banner_link2",
						"type" => "text",
						"std" => ""
						);	
								
$options[]   = 	array( 
						"name" => "Image 3 source",
						"desc" => "Upload image 3 with size 768 x 90px. ",
						"id" => $shortname."_banner_img3",
						"type" => "upload",
						"std" => URL."/images/top-banner.png"
					);
$options[]   = array( 
						"name" => "Image 3 link",
						"desc" => "Add your iimage 3 link here text here.",
						"id" => $shortname."_banner_link3",
						"type" => "text",
						"std" => ""
						);	
							
				
				
$options[]   = array( 
						"name" => "Image 4 source",
						"desc" => "Upload image 4 with size 768 x 90px. ",
						"id" => $shortname."_banner_img4",
						"type" => "upload",
						"std" => URL."/images/top-banner.png"
					);
$options[]   = 	array( 
						"name" => "Image 4 link",
						"desc" => "Add your iimage 4 link here text here.",
						"id" => $shortname."_banner_link4",
						"type" => "text",
						"std" => ""
						);	
										
				
$options[]   = array( 
						"name" => "Image 5 source",
						"desc" => "Upload image 5 with size 768 x 90px. ",
						"id" => $shortname."_banner_img5",
						"type" => "upload",
						"std" => URL."/images/top-banner.png"
					);
$options[]   = 	array( 
						"name" => "Image 5 link",
						"desc" => "Add your iimage 5 link here text here.",
						"id" => $shortname."_banner_link5",
						"type" => "text",
						"std" => ""
						);
												
$options[]   = 	array("name"=>"Rotator Duration",
			          "desc"=>"set the duration here",
			     	   "id" => $shortname."_banner_limit",
				       "type"=>"slider",
				       "max"=>60,
				       "std"=>3,
				        "suffix"=>"seconds");		
					  
					  	
$options[]   =   array("type"=>"close_subtitle");

/* == Sub Panel Ends ===================================================================== */
$options[]   = array("type"=>"close");

/* ====================================================================================== */
/* == General Settings Panel Ends ======================================================= */
/* ====================================================================================== */
					 
					 
/* ====================================================================================== */
/* == Home Page Panel =================================================================== */
/* ====================================================================================== */

$options[]   = array( 
		           "name" => "Home Page",
	  	           "type" => "section"
		          );
$options[]   = array( 
		          "name" => $themename." Options",
		    	  "type" => "information",
		      	  "description" => "In this option panel your able to change the basic setting. Just follow the info besides the functions and you will be ready in a snap."
		  );
		  				  
$options[]   = array( "type" => "open");

		  
/* == Sub Panel Begins =================================================================== */

$options[]   = array(
				   "name" => "Stage Section" , 
				   "type"=>"subtitle" , 
				   "id"=>"homestage"
					 );


$options[]   = array( 
				  "name" => "Home Page Intro",
				  "desc" => "you can select the layout of top stage here.",
				  "id" => $shortname."_stage_option",
				  "type" => "radio",
				  "options" => array("Slider","Static Image", "Title","none"),
				  "std" => "Half Text half Staged Image"
				  );

$options[]   = array( 
				  "name" => "Select Slider",
				  "desc" => "select the slider.",
				  "id" => $shortname."_home_slider",
				  "type" => "select",
				  "options" => $sliders,
				  "parentClass" => "h-slider h-options",
				  "std" => "Slider"
				  );

$options[]   = array(
                  "name" => "Upload Image",
				  "desc" => "upload the image to be shown on intro on Home page.",
				  "id" => $shortname."_home_static_image",
				  "type" => "upload",
				  "parentClass" => "h-upload h-options",
				  "std" => ""
                  );	

$options[]   = array(
                  "name" => "Add Title",
				  "desc" => "Add the title to be shown on home page.",
				  "id" => $shortname."_home_title",
				  "type" => "text",
				  "parentClass" => "h-title h-options",
				  "std" => "Your Title"
                  );	


				  				  		
										
$options[]   = array("type"=>"close_subtitle");

/* == Sub Panel Ends ===================================================================== */

/* == Sub Panel Begins =================================================================== */

$options[]   = array(
				   "name" => "Home Page Layout" , 
				   "type"=>"subtitle" , 
				   "id"=>"homelayout"
					 );

$options[]   = array(
				   "name" => "Home layout", 
				   "type"=>"include", 
				   "std"=> HPATH."/option_panel/adv_mods/home_layout.php"
					  );
					  
$options[]   = array( 
				  "name" => "Home Sidebar",
				  "desc" => "you can select the sidebar of home page here.",
				  "id" => $shortname."_home_sidebar",
				  "type" => "select",
				  "options" => $active_sidebars,
				  "std" => "Blog Sidebar"
				  );

					  
$options[]   = array("type"=>"close_subtitle");
					  
/* == Sub Panel Ends ===================================================================== */
	






$options[]   = array("type"=>"close");

/* ====================================================================================== */
/* == Home Page Panel Ends ============================================================== */
/* ====================================================================================== */
					 
/* ====================================================================================== */
/* == Typography Panel ================================================================== */
/* ====================================================================================== */

$options[]   = array( 
		           "name" => "Typography Settings",
	  	           "type" => "section"
		          );
$options[]   = array( 
		          "name" => $themename." Options",
		    	  "type" => "information",
		      	  "description" => "In this option panel your able to change the typography related settings.."
		  );
		  				  
$options[]   = array( "type" => "open");

		  
/* == Sub Panel Begins =================================================================== */

$options[]   = array(
				   "name" => "Body Font & Custom Font Settings" , 
				   "type"=>"subtitle" , 
				   "id"=>"bodytypo"
					 );



$options[]   = array(
						"name" => "Typography Panel File", 
						"type"=>"include", 
						"std"=> HPATH."/option_panel/adv_mods/typo.php"
					  );
										
$options[]   = array("type"=>"close_subtitle");

/* == Sub Panel Ends ===================================================================== */
	

$options[]   = array(
				   "name" => "Heading's Font Settings" , 
				   "type"=>"subtitle" , 
				   "id"=>"bodytypo"
					 );



$options[]   = array(
                  "name"=>"H1 Font Size",
			      "desc"=>"h1 font size.",
			      "id" => $shortname."_h1_font_size",
				  "type"=>"slider",
				  "max"=>108,
				  "std"=>36,
				  "suffix"=>"px"
					 );

$options[]   = array(
                  "name"=>"H2 Font Size",
			      "desc"=>"h2 font size.",
			      "id" => $shortname."_h2_font_size",
				  "type"=>"slider",
				  "max"=>108,
				  "std"=>32,
				  "suffix"=>"px"
					);

$options[]   = array(
                  "name"=>"H3 Font Size",
			      "desc"=>"h3 font size.",
			      "id" => $shortname."_h3_font_size",
				  "type"=>"slider",
				  "max"=>108,
				  "std"=>28,
				  "suffix"=>"px",
				  "parentClass" => "h-advance"
					 );

$options[]   = array(
                  "name"=>"H4 Font Size",
			      "desc"=>"h4 font size.",
			      "id" => $shortname."_h4_font_size",
				  "type"=>"slider",
				  "max"=>108,
				  "std"=>24,
				  "suffix"=>"px",
				  "parentClass" => "h-advance"
					 );
					 					 					 
$options[]   = array(
                  "name"=>"H5 Font Size",
			      "desc"=>"h5 font size.",
			      "id" => $shortname."_h5_font_size",
				  "type"=>"slider",
				  "max"=>108,
				  "std"=>18,
				  "suffix"=>"px",
				  "parentClass" => "h-advance"
					 );

$options[]   = array(
                  "name"=>"H6 Font Size",
			      "desc"=>"h6 font size.",
			      "id" => $shortname."_h6_font_size",
				  "type"=>"slider",
				  "max"=>108,
				  "std"=>13,
				  "suffix"=>"px",
				  "parentClass" => "h-advance"
					 );
					 					 										
$options[]   = array("type"=>"close_subtitle");

$options[]   = array("type"=>"close");

/* ====================================================================================== */
/* == Typography Ends =================================================================== */
/* ====================================================================================== */
					 
/* ====================================================================================== */
/* == Footer Panel ====================================================================== */
/* ====================================================================================== */

$options[]   = array( 
		           "name" => "Footer",
	  	           "type" => "section"
		          );
$options[]   = array( 
		          "name" => $themename." Options",
		    	  "type" => "information",
		      	  "description" => "In this option panel your able to change the footer related settings.."
		  );
		  				  
$options[]   = array( "type" => "open");

		  
/* == Sub Panel Begins =================================================================== */

$options[]   = array(
				   "name" => "Footer Settings" , 
				   "type"=>"subtitle" , 
				   "id"=>"fsettings"
					 );

				   
$options[]   = array( 
				  "name" => "Show Footer Widgets column area",
				  "desc" => "toogle display of footer widgets.",
				  "id" => $shortname."_footer_widgets",
				  "type" => "radio",
				  "options" => array("Yes","No"),
				  "std" => "Yes"
				   );
				   

$options[]   = array(
						"name" => "Footer Panel File", 
						"type"=>"include", 
						"std"=> HPATH."/option_panel/adv_mods/footer.php"
					  );

$options[]   = array( 
				  "name" => "Show Footer Menu",
				  "desc" => "toogle display of footer menu.",
				  "id" => $shortname."_footer_menu",
				  "type" => "radio",
				  "options" => array("Yes","No"),
				  "std" => "Yes",
				  "parentClass" => "h-advance"
				   );

$options[]   = array(
                  "name" => "Footer Logo Upload",
				  "desc" => "upload your footer logo here.",
				  "id" => $shortname."_footer_logo",
				  "type" => "upload",
				  "std" => URL."/sprites/i/logo-bottom.png"	 
				  );


$options[]   = array( 
				  "name" => "Footer Text",
				  "desc" => "footer text.",
				  "id" => $shortname."_footer_text",
				  "type" => "text",
				  "std" => "",
				  "parentClass" => "h-advance"
				   );
				   				   										
$options[]   = array("type"=>"close_subtitle");

/* == Sub Panel Ends ===================================================================== */
	


$options[]   = array("type"=>"close");

/* ====================================================================================== */
/* == Footer Ends ======================================================================= */
/* ====================================================================================== */

/* ====================================================================================== */
/* == Media Panel ======================================================================= */
/* ====================================================================================== */

$options[]   = array( 
		           "name" => "Media Settings",
	  	           "type" => "section"
		          );
$options[]   = array( 
		          "name" => $themename." Options",
		    	  "type" => "information",
		      	  "description" => "In this option panel your able to change the media related settings.."
		  );
		  				  
$options[]   = array( "type" => "open");

		  
/* == Sub Panel Begins =================================================================== */

$options[]   = array(
				   "name" => "Image Resizing" , 
				   "type"=>"subtitle" , 
				   "id"=>"imageresizing"
					 );


$options[]   = array( 
				  "name" => "Image resizing",
				  "desc" => "select the method you want for image resizing.",
				  "id" => $shortname."_image_resize",
				  "type" => "radio",
				  "options" => array("Timthumb","Wordpress Core resizer", "none"),
				  "std" => "Timthumb"
				   );	

$options[]   = array( 
				  "name" => "Timbthumb Cropping Options",
				  "desc" => "select the method you want for image resizing.",
				  "id" => $shortname."_timthumb_zc",
				  "type" => "radio",
				  "options" => array("Hard Resize","Smart crop and resize", "Resize Proportionally"),
				  "std" => "Smart crop and resize",
				  "parentClass" => "h-advance"
				   );	


										
$options[]   = array("type"=>"close_subtitle");

/* == Sub Panel Ends ===================================================================== */


$options[]   = array("type"=>"close");

/* ====================================================================================== */
/* == Media Ends ======================================================================== */
/* ====================================================================================== */	

/* ====================================================================================== */
/* == Blog Panel ======================================================================== */
/* ====================================================================================== */

$options[]   = array( 
		           "name" => "Blog Settings",
	  	           "type" => "section"
		          );
$options[]   = array( 
		          "name" => $themename." Options",
		    	  "type" => "information",
		      	  "description" => "In this option panel your able to change the media related settings.."
		  );
		  				  
$options[]   = array( "type" => "open");

		  
/* == Sub Panel Begins =================================================================== */

$options[]   = array(
				   "name" => "Blog Layout" , 
				   "type"=>"subtitle" , 
				   "id"=>"bloglayout"
					 );


	
$options[] = array(
                  "name"=>"Posts Items Limit",
			      "desc"=>"set your items per page limit here",
				   "id" => $shortname."_posts_item_limit",
				   "type"=>"slider",
				   "max"=>50,
				   "std"=>6,
				   "suffix"=>"Items");	
					  	
$options[]   = 	array( 
						"name" => "Show Author BIO",
						"desc" => "Don't you need an Author Bio then just disable it here.",
						"id" => $shortname."_author_bio",
						"type" => "toggle",
						"std" => "true"
					  );
					
$options[]   = 	array( 
						"name" => "Show Related Posts",
						"desc" => "Want to show your related posts? Then enable them here.",
						"id" => $shortname."_popular",
						"type" => "toggle",
						"std" => "true"
					  );

$options[]   = 	array( 
						"name" => "Enable AddThis Social Set",
						"desc" => "Enable or disable the retweet button below the post.",
						"id" => $shortname."_social_set",
						"type" => "toggle",
						"std" => "true"
					  );
$options[]   = 	 array( 
						"name" => "Set AddThis Icon Style",
						"desc" => "In here you can decide which icon style you want.",
						"id" => $shortname."_social_set_style",
						"type" => "select",
						"std" => "Google Webfonts",
						"options" => array( "Style 1","Style 2","Style 3","Style 4","Style 5","Style 6","Style 7","Style 8" ),
				  "parentClass" => "h-advance"
					  );
	
					  								  	
$options[]   = 	  array("type"=>"close_subtitle");

/* == Sub Panel Ends ===================================================================== */
	


$options[]   = array("type"=>"close");

/* ====================================================================================== */
/* == Blog Ends ========================================================================= */
/* ====================================================================================== */					 

/* ====================================================================================== */
/* == Events Panel ====================================================================== */
/* ====================================================================================== 

$options[]   = array( 
		           "name" => "Events Settings",
	  	           "type" => "section"
		          );
$options[]   = array( 
		          "name" => $themename." Options",
		    	  "type" => "information",
		      	  "description" => "In this option panel your able to change the event related settings.."
		  );
		  				  
$options[]   = array( "type" => "open");

		  
/* == Sub Panel Begins =================================================================== 

$options[]   = array(
				   "name" => "Calendar Layout" , 
				   "type"=>"subtitle" , 
				   "id"=>"event"
					 );




										
$options[]   = array("type"=>"close_subtitle");

/* == Sub Panel Ends ===================================================================== 
	


$options[]   = array("type"=>"close");

 ====================================================================================== */
/* == Events Ends ======================================================================= */
/* ====================================================================================== */		

/* ====================================================================================== */
/* == Visual Panel ====================================================================== */
/* ====================================================================================== */

$options[]   = array( 
		           "name" => "Visual Panel",
	  	           "type" => "section"
		          );
$options[]   = array( 
		          "name" => $themename." Options",
		    	  "type" => "information",
		      	  "description" => "In this option panel your able to change the visual related settings.."
		  );
		  				  
$options[]   = array( "type" => "open");

		  
/* == Sub Panel Begins =================================================================== */

$options[]   = array(
				   "name" => "Visual Settings" , 
				   "type"=>"subtitle" , 
				   "id"=>"visual_premade_simple"
					 );

$options[]   = array( 
						  "name" => "Theme's Background Texture",
						  "desc" => "Select a different texture here.",
						  "id" => $shortname."_header_texture",
						  "type" => "select",
						  "options" => array("waves-texture","raster-texture","diagonal-texture","diamond-textures","morse-texture","checker-texture", "tile-texture" ,"noise-texture" , "bow-texture" , "threaded-texture" , "disco-texture" , "tartan-texture",'none'),
						  "std" => "waves-texture" 
				  	 ); 
					 
$options[]   = array( 
						"name" => "Custom Background Texture On/Off",
						"desc" => "Don't like the ones we've made then ad your own by activating this option and upload your own image below.",
						"id" => $shortname."_bg_custom",
						"type" => "toggle",
						"std" => "false"
					  );
			
$options[]   =  array( 
						"name" => "Upload Background texture",
						"desc" => "You can upload your background texture here, make sure the above selection is activated.",
						"id" => $shortname."_bg_custom_texture",
						"type" => "upload",
						"std" => ""
						);
													
$options[]   =  array( 
						"name" => "Body Font Color",
						"desc" => "Your able to change the color for the body font here.",
						"id" => $shortname."_font_color",
						"type" => "colorpickerfield",
						"std" => "303030"
						);
													
$options[]   = array( 
						"name" => "Link Font Color",
						"desc" => "Your able to change the color for the link font here.",
						"id" => $shortname."_link_font_color",
						"type" => "colorpickerfield",
						"std" => "333333"
						);
												
$options[]   =  array( 
						"name" => "Link Hover Font Color",
						"desc" => "Your able to change the color for the link font on hover here.",
						"id" => $shortname."_link_hover_font_color",
						"type" => "colorpickerfield",
						"std" => "777777"
						);
																		
$options[]   =  array( 
						"name" => "Footer Link Color",
						"desc" => "Your able to change the color for the footer link .",
						"id" => $shortname."_footer_link_font_color",
						"type" => "colorpickerfield",
						"std" => "aaaaaa"
						);
			
$options[]   = array( 
						"name" => "Footer Link Color",
						"desc" => "Your able to change the color for the footer link .",
						"id" => $shortname."_footer_hover_link_font_color",
						"type" => "colorpickerfield",
						"std" => "ffffff"
						);				  
			
$options[]   = array("type"=>"close_subtitle");

/* == Sub Panel Ends ===================================================================== */
	


$options[]   = array("type"=>"close");

/* ====================================================================================== */
/* == Visual Ends ======================================================================= */
/* ====================================================================================== */		

/* ====================================================================================== */
/* == Advance Panel ====================================================================== */
/* ====================================================================================== */

$options[]   = array( 
		           "name" => "Advance Panel",
	  	           "type" => "section"
		          );
$options[]   = array( 
		          "name" => $themename." Options",
		    	  "type" => "information",
		      	  "description" => "In this option panel your able to change the advance related settings.."
		  );
		  				  
$options[]   = array( "type" => "open");

		  
/* == Sub Panel Begins =================================================================== */

$options[]   = array(
				   "name" => "Advance" , 
				   "type"=>"subtitle" , 
				   "id"=>"adv"
					 );
					 
$options[]   = array( 
				  "name" => "Admin Login Logo Enable",
				  "desc" => "Enable / Disable admin logo .",
				  "id" => $shortname."_enable_admin_logo",
				  "type" => "radio",
				  "options" => array("Yes","No"),
				  "std" => "No"
				   );	

$options[]   =	array( 
						"name" => "Admin Logo Area Width",
						"desc" => "set the width of logo holer here.",
						"id" => $shortname."_admin_logo_width",
						"type" => "text",
						"std" => ""
						);	
$options[]   =	array( 
						"name" => "Admin Logo Area Height",
						"desc" => "set the height of logo holer here.",
						"id" => $shortname."_admin_logo_height",
						"type" => "text",
						"std" => ""
						);	
												
$options[]   = array(
                  "name" => "Admin Login Logo Upload",
				  "desc" => "upload your wp admin logo here.",
				  "id" => $shortname."_admin_logo",
				  "type" => "upload",
				  "std" => "your upload path"	 
				  );


				  										
$options[]   = array("type"=>"close_subtitle");

/* == Sub Panel Ends ===================================================================== */
	
$options[]   =  array(
						"name" => "&rarr; 404 Not Found" , 
						"type"=>"subtitle" , 
						"id"=>"notfound"
						);	
$options[]   =	array( 
						"name" => "404 page title here",
						"desc" => "Add your 404 text here.",
						"id" => $shortname."_notfound_title",
						"type" => "text",
						"std" => ""
						);		
					
$options[]   =	array( 
						"name" => "404 image URL",
						"desc" => "Upload your 404 image.  ",
						"id" => $shortname."_notfound_logo",
						"type" => "upload",
						"std" => URL."/sprites/i/notfound.png"
					);	
				
	
$options[]   =	array( 
						"name" => "404 page text here",
						"desc" => "Add your 404 text here.",
						"id" => $shortname."_notfound_text",
						"type" => "textarea",
						"std" => ""
						);		
                
$options[]   =	array("type"=>"close_subtitle");
/* == Sub Panel Ends ===================================================================== */

$options[]   = array("type"=>"close");

/* ====================================================================================== */
/* == Advance Ends ====================================================================== */
/* ====================================================================================== */		

/* ====================================================================================== */
/* == Translation Panel ====================================================================== */
/* ====================================================================================== */

$options[]   = array( 
		           "name" => "Translation",
	  	           "type" => "section"
		          );
$options[]   = array( 
		          "name" => $themename." Options",
		    	  "type" => "information",
		      	  "description" => "Translation manunal for the theme.."
		  );
		  				  
$options[]   = array( "type" => "open");

		  


$options[]   = array(
						"name" => "Translation File", 
						"type"=>"include", 
						"std"=> HPATH."/option_panel/adv_mods/translate.php"
					  );




$options[]   = array("type"=>"close");