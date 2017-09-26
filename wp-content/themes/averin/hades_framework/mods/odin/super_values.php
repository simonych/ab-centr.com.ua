<?php 


// == Set all setings =====================

function setData()
{
	setMenus();
	setDemoOptions();
	setWidgets();
	setMedia();
}

// == Set media ==========================================

function setMedia()
{
	$p_slides =   array ( 
	   "src" => URL."/sprites/i/default.jpg",
	   "link" => "",  "description" => "" , "type" => "upload" , 
	   "title" => "" );
	 
	 $path = __FILE__;
     $pathwp = explode( 'wp-content', $path );
     $wp_url = $pathwp[0]."wp-content/uploads/default.jpg";

	 $cstatus =   copy( TEMPLATEPATH."/sprites/i/default.jpg",  $wp_url  );
	
	 $wp_query = new WP_Query("post_type=post&posts_per_page=-1");
	 
	 while ( $wp_query->have_posts() ) : $wp_query->the_post();
	 
	 $id =  get_the_ID();
	 
	 if($cstatus) {
	 
	 $filename = "default.jpg";
	 $wp_filetype = wp_check_filetype(basename($filename), null );
     $attachment = array(
     'post_mime_type' => $wp_filetype['type'],
     'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
     'post_content' => '',
     'post_status' => 'inherit'
      );
      $attach_id = wp_insert_attachment( $attachment, $filename, $id );
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
      wp_update_attachment_metadata( $attach_id, $attach_data );
      set_post_thumbnail($id,   $attach_id );
	 }
	 
	 
	endwhile;
	
	
}

// == Set Widgets =========================================
function setWidgets()
{


$sidebars = get_option("sidebars_widgets");
$sidebars["sidebar-1"] = array("search-2","twitterrsscount-2","custombox-2","popularpost-2","viewedpost-2","recent-comments-2");
$sidebars["sidebar-2"] = array ( "twitter_widget-2" , "feedburnersubscribe-2");
$sidebars["sidebar-3"] = array ( "categories-2" , "links-2");
$sidebars["sidebar-4"] = array ( "tag_cloud-2" , "contactform-2");

      
update_option("sidebars_widgets",$sidebars);

$search = get_option("widget_search");	
$search[2] =array("title" => "");
$search["_multiwidget"] =   1 ;
update_option("widget_search",$search);


$twitter_rss = get_option("widget_twitterrsscount");	
$twitter_rss[2] =array("twitter_id" => "envatowebdev", "feedburner_address" => "http://feeds.feedburner.com/nettuts" , "title" => "" , "default_rss_count" => "85,318" );
$twitter_rss["_multiwidget"] =   1 ;
update_option("widget_twitterrsscount",$twitter_rss);

$custom_box = get_option("widget_custombox");	
$custom_box[2] =array(
	"link" => "",
	"description" => "Fusce feugiat posuere congue. Etiam laoreet odio nec eros interdum laoreet. Aliquam ullamcorper porttitor sapien, eget vulputate dui interdum id. Vivamus et eros magna. 

Nam sed justo id leo lobortis accumsan. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.",
	"title" => "About us",
	"intro_image_link" => ""
	
	
	);
 			 
$custom_box["_multiwidget"] =   1 ;
update_option("widget_custombox",$custom_box);
		
	
$popposts = get_option("widget_popularpost");	
$popposts[2] = array(
"title" => "Popular Posts",
"count" => "5");
$popposts["_multiwidget"] =   1 ;
update_option("widget_popularpost",$popposts);

$viewed = get_option("widget_viewedpost");	
$viewed[2] = array(
"title" => "Most Viewed",
"count" => "5");
$viewed["_multiwidget"] =   1 ;
update_option("widget_viewedpost",$viewed);



$twitter = get_option("widget_twitter_widget");	
$twitter[2] =array("title" => "Latest from Twitter" , "username" => "WPTitan", "tweet_count" => 3);
$twitter["_multiwidget"] =   1 ;
update_option("widget_twitter_widget",$twitter);


$feeds = get_option("widget_feedburnersubscribe");	
$feeds[2] =array("link" => "nettuts" , "description" => "Sed diam metus, porttitor eget viverra vel, posuere eget purus. Donec libero nunc, ornare quis ultricies non, viverra eu metus. Vestibulum pulvinar, lorem sit amet eleifend pulvinar, purus augue congue quam.", "title" => "Subscribe to our feeds" );
$feeds["_multiwidget"] =   1 ;
update_option("widget_feedburnersubscribe",$feeds);


$categories = get_option("widget_categories");	
$categories[2] =array("title" => "Categories" , "count" => "1", "hierarchical" => "0" , "dropdown" =>"0");
$categories["_multiwidget"] =   1 ;
update_option("widget_categories",$categories);		
		
	
$links = get_option("widget_links");	
$links[2] = array( "images" => 1 , "name" => 1 , "description" =>  0 ,"rating" => 0, "category" => 0);
$links["_multiwidget"] =   1 ;
update_option("widget_links",$links);		

$tags = get_option("widget_tag_cloud");	
$tags[2] = array( "title" => "Tags " , "taxonomy" => "post_tag");
$tags["_multiwidget"] =   1 ;
update_option("widget_tag_cloud",$tags);	


$contact = get_option("widget_contactform");	
$contact[2] = array(
"title" => "Quick Contact",
"email" => "test@testingemail.com",
 "messsage" =>""

);
$contact["_multiwidget"] =   1 ;
update_option("widget_contactform",$contact);

}
function setMenus()
{
	$gmes = "Menus ";
	global $wpdb;
    $table_db_name = $wpdb->prefix . "terms";
    $rows = $wpdb->get_results("SELECT * FROM $table_db_name where name='Footer Menu' OR name='Main Menu' OR name='Top Menu'",ARRAY_A);
    $menu_ids = array();
	foreach($rows as $row)
	$menu_ids[$row["name"]] = $row["term_id"] ; 

    set_theme_mod( 'nav_menu_locations', array_map( 'absint', array( 'top_nav' => $menu_ids['Top Menu'] , 'primary_nav' =>$menu_ids['Main Menu'] ,'footer_nav' => $menu_ids['Footer Menu']) ) );
	$items = wp_get_nav_menu_items( $menu_ids['Main Menu']); 
	
	$i = 0;
	foreach($items as $item)
	{
		if($item->title=="Home")
		{
			$item->url = home_url();
		}
		if($item->title=="Mega Menu")
		{
			update_post_meta($item->ID,"menu-item-megamenu-".$item->ID,"on");
			update_post_meta($item->ID,"menu-item-megamenu-layout-".$item->ID,"column");
		}
		if($item->title=="Powered by WPTitans")
		{
			update_post_meta($item->ID,"menu-item-textbox-".$item->ID,"<p>Ut ut egestas mi. Suspendisse scelerisque ante mattis est condimentum at hendrerit massa volutpat. Morbi dapibus feugiat ipsum, a mattis velit pharetra in.</p><p>
Aliquam mattis egestas sapien eu eleifend. Maecenas condimentum euismod libero, in egestas ipsum venenatis pharetra.</p>");
			update_post_meta($item->ID,"menu-item-enable-textbox-".$item->ID,"on");
		
		}
		if($item->title=="About Dagda")
		{
			update_post_meta($item->ID,"menu-item-textbox-".$item->ID,"<p>Ut ut egestas mi. Suspendisse scelerisque ante mattis est condimentum at hendrerit massa volutpat. Morbi dapibus feugiat ipsum, a mattis velit pharetra in.</p><p>
Aliquam mattis egestas sapien eu eleifend. Maecenas condimentum euismod libero, in egestas ipsum venenatis pharetra.</p>");
			update_post_meta($item->ID,"menu-item-enable-textbox-".$item->ID,"on");
		
		}
		
	}
	
}

// == Set Media Content ==============================================

function setMediaContent() {

 $gmes = "Media Items ( portfolios and galleries ) ";
	 
	  $p_slides =   array ( 
	   "src" => URL."sprites/i/demo.png",
	   "link" => "",  "description" => "" , "type" => "upload" , 
	   "title" => "" );
	 
	  $cstatus =   copy( TEMPLATEPATH."/images/demo.png",  $wp_url  );
	 
	  $wp_query = new WP_Query("post_type=portfolio&posts_per_page=-1");
	 
	  while ( $wp_query->have_posts() ) : $wp_query->the_post();
	 
		   $no = rand(2,7);
		   $portfolio_slides = array();
		   for($i=0;$i<$no;$i++)
		   $portfolio_slides[] = $p_slides;
	 
		   $id =  get_the_ID();
		   update_post_meta($id,"gallery_items",$portfolio_slides);
	 
		   if($cstatus) {
		   
		   $filename = "demo.png";
		   $wp_filetype = wp_check_filetype(basename($filename), null );
		   $attachment = array(
		   'post_mime_type' => $wp_filetype['type'],
		   'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
		   'post_content' => '',
		   'post_status' => 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $filename, $id );
			
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			
			$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
			wp_update_attachment_metadata( $attach_id, $attach_data );
			set_post_thumbnail($id,   $attach_id );
		   }
	 
	 
	endwhile;
	
	
}

// == Enable Demo Content ===========================

function setDemoContent()
{
	if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
	require_once ABSPATH . 'wp-admin/includes/import.php';
    $importer_error = false;
	
	if ( !class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		if ( file_exists( $class_wp_importer ) )
		{
			require_once($class_wp_importer);
		}
		else
		{
			$importer_error = true;
		}
    }
	
	if ( !class_exists( 'WP_Import' ) ) {
	  $class_wp_import = HPATH . '/mods/odin/importer/wordpress-importer.php';
	  if ( file_exists( $class_wp_import ) )
	  require_once($class_wp_import);
	  else
	  $importerError = true;
	  
    }

	  if($importer_error)
	  {
		  die("Error in import :(");
	  }
	  else
	  {
		  if ( class_exists( 'WP_Import' )) 
		  {
			  include_once('importer/odin-import-class.php');
		  }
		  
		  
		  if(!is_file(HPATH."/mods/odin/dummy.xml"))
		  {
			  echo "The XML file containing the dummy content is not available or could not be read in <pre>".HPATH."</pre><br/> You might want to try to set the file permission to chmod 777.<br/>If this doesn't work please use the wordpress importer and import the XML file from hades_framework -> mods -> odin folder , dummy.xml manually <a href='/wp-admin/import.php'>here.</a>";
		  }
		  else
		  {
	  
			  $wp_import = new odin_wp_import();
			  $wp_import->fetch_attachments = true;
			  $wp_import->import(HPATH."/mods/odin/dummy.xml");
			  $wp_import->saveOptions();
			
		  }
	  }
   
   
    
}


function setDemoOptions() {

$theme_options = " W3sib3B0aW9uX25hbWUiOiJoYWRlc19zbGlkZXMiLCJvcHRpb25fdmFsdWUiOiJhOjQ6e2k6MDthOjY6e3M6MzpcInNyY1wiO3M6NTQ6XCJodHRwOlwvXC93cHRpdGFucy5jb21cL2F2ZXJpblwvZmlsZXNcLzIwMTFcLzA3XC9yZWFkeXdwMzIucG5nXCI7czo0OlwibGlua1wiO3M6MTpcIiNcIjtzOjExOlwiZGVzY3JpcHRpb25cIjtzOjA6XCJcIjtzOjQ6XCJ0eXBlXCI7czo2OlwidXBsb2FkXCI7czoyOlwiaWRcIjtzOjA6XCJcIjtzOjU6XCJ0aXRsZVwiO3M6MDpcIlwiO31pOjE7YTo2OntzOjM6XCJzcmNcIjtzOjU5OlwiaHR0cDpcL1wvd3B0aXRhbnMuY29tXC9hdmVyaW5cL2ZpbGVzXC8yMDExXC8wN1wvc2lkZWJhcm1hbmFnZXIucG5nXCI7czo0OlwibGlua1wiO3M6MTpcIiNcIjtzOjExOlwiZGVzY3JpcHRpb25cIjtzOjA6XCJcIjtzOjQ6XCJ0eXBlXCI7czo2OlwidXBsb2FkXCI7czoyOlwiaWRcIjtzOjA6XCJcIjtzOjU6XCJ0aXRsZVwiO3M6MDpcIlwiO31pOjI7YTo2OntzOjM6XCJzcmNcIjtzOjU1OlwiaHR0cDpcL1wvd3B0aXRhbnMuY29tXC9hdmVyaW5cL2ZpbGVzXC8yMDExXC8wN1wvc21hcnRzZW5zZS5wbmdcIjtzOjQ6XCJsaW5rXCI7czoxOlwiI1wiO3M6MTE6XCJkZXNjcmlwdGlvblwiO3M6MDpcIlwiO3M6NDpcInR5cGVcIjtzOjY6XCJ1cGxvYWRcIjtzOjI6XCJpZFwiO3M6MDpcIlwiO3M6NTpcInRpdGxlXCI7czowOlwiXCI7fWk6MzthOjY6e3M6MzpcInNyY1wiO3M6NTY6XCJodHRwOlwvXC93cHRpdGFucy5jb21cL2F2ZXJpblwvZmlsZXNcLzIwMTFcLzA3XC9mb3JtYnVpbGRlci5wbmdcIjtzOjQ6XCJsaW5rXCI7czoxOlwiI1wiO3M6MTE6XCJkZXNjcmlwdGlvblwiO3M6MTQ2OlwiTWF1cmlzIG5vbiBhbnRlIG1hZ25hLiBFdGlhbSBlZ2VzdGFzIHNlbSB2ZWwganVzdG8gbHVjdHVzIGludGVyZHVtLiBEdWlzIGVnZXQgcGxhY2VyYXQgdHVycGlzLiBEb25lYyBzY2VsZXJpc3F1ZSBzdXNjaXBpdCBuaXNsIHNpdCBhbWV0IHBoYXJldHJhLiBcIjtzOjQ6XCJ0eXBlXCI7czo2OlwidXBsb2FkXCI7czoyOlwiaWRcIjtzOjA6XCJcIjtzOjU6XCJ0aXRsZVwiO3M6NDI6XCIgRG9uZWMgc2NlbGVyaXNxdWUgc3VzY2lwaXQgbmlzbCBzaXQgYW1ldCBcIjt9fSJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19mb290ZXJfbGlua19mb250X2NvbG9yIiwib3B0aW9uX3ZhbHVlIjoiYWFhYWFhIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2N1c3RvbV9nX2ZvbnRfZW5hYmxlIiwib3B0aW9uX3ZhbHVlIjoiZmFsc2UifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfY3VzdG9tX2dfZm9udCIsIm9wdGlvbl92YWx1ZSI6IiJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19iYW5uZXJfdHlwZSIsIm9wdGlvbl92YWx1ZSI6IkltYWdlIEJhbm5lciJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19iYW5uZXJfaW1nMSIsIm9wdGlvbl92YWx1ZSI6Imh0dHA6XC9cL3dwdGl0YW5zLmNvbVwvYXZlcmluXC93cC1jb250ZW50XC90aGVtZXNcL2F2ZXJpblwvaW1hZ2VzXC90b3AtYmFubmVyLnBuZyJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19iYW5uZXJfbGluazEiLCJvcHRpb25fdmFsdWUiOiJodHRwOlwvXC90aGVtZWZvcmVzdC5uZXQifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfYmFubmVyX2ltZzIiLCJvcHRpb25fdmFsdWUiOiJodHRwOlwvXC93cHRpdGFucy5jb21cL2F2ZXJpblwvZmlsZXNcLzIwMTFcLzA3XC81MzgxNC0xMzAwMTcwMjg4LnBuZyJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19iYW5uZXJfbGluazIiLCJvcHRpb25fdmFsdWUiOiJodHRwOlwvXC90aGVtZWZvcmVzdC5uZXQifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfYmFubmVyX2ltZzMiLCJvcHRpb25fdmFsdWUiOiJodHRwOlwvXC93cHRpdGFucy5jb21cL2F2ZXJpblwvZmlsZXNcLzIwMTFcLzA3XC81OTc5OC0xMzA0NjAzODk0LnBuZyJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19iZ19jdXN0b20iLCJvcHRpb25fdmFsdWUiOiJmYWxzZSJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19iZ19jdXN0b21fdGV4dHVyZSIsIm9wdGlvbl92YWx1ZSI6IiJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19sb2dvIiwib3B0aW9uX3ZhbHVlIjoiaHR0cDpcL1wvd3B0aXRhbnMuY29tXC9hdmVyaW5cL2ZpbGVzXC8yMDExXC8wN1wvbG9nbzEucG5nIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2ZhdmljbyIsIm9wdGlvbl92YWx1ZSI6Imh0dHA6XC9cL3dwdGl0YW5zLmNvbVwvYXZlcmluXC93cC1jb250ZW50XC90aGVtZXNcL2F2ZXJpblwvaW1hZ2VzXC9mYXZpY28uaWNvIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2ZlZWRidXJuZXIiLCJvcHRpb25fdmFsdWUiOiJodHRwOlwvXC9mZWVkcy5mZWVkYnVybmVyLmNvbVwveW91cklEIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2ZlZWRidXJuZXJfZW1haWwiLCJvcHRpb25fdmFsdWUiOiJodHRwOlwvXC9mZWVkYnVybmVyLmdvb2dsZS5jb21cL2ZiXC9hXC9tYWlsdmVyaWZ5P3VyaT15b3VySUQifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfYXBpX2tleSIsIm9wdGlvbl92YWx1ZSI6IiJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19jYXB0Y2hhX3B1YmxpY19rZXkiLCJvcHRpb25fdmFsdWUiOiIifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfY2FwdGNoYV9wcml2YXRlX2tleSIsIm9wdGlvbl92YWx1ZSI6IiJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19mb290ZXJfY29sdW1ucyIsIm9wdGlvbl92YWx1ZSI6IjQgQ29sdW1ucyJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19nYSIsIm9wdGlvbl92YWx1ZSI6IiAgdmFyIF9nYXEgPSBfZ2FxIHx8IFtdO1xyXG4gIF9nYXEucHVzaChbXFwnX3NldEFjY291bnRcXCcsIFxcJ1VBLTI0NDczOTcwLTFcXCddKTtcclxuICBfZ2FxLnB1c2goW1xcJ19zZXREb21haW5OYW1lXFwnLCBcXCcud3B0aXRhbnMuY29tXFwnXSk7XHJcbiAgX2dhcS5wdXNoKFtcXCdfdHJhY2tQYWdldmlld1xcJ10pO1xyXG5cclxuICAoZnVuY3Rpb24oKSB7XHJcbiAgICB2YXIgZ2EgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KFxcJ3NjcmlwdFxcJyk7IGdhLnR5cGUgPSBcXCd0ZXh0XC9qYXZhc2NyaXB0XFwnOyBnYS5hc3luYyA9IHRydWU7XHJcbiAgICBnYS5zcmMgPSAoXFwnaHR0cHM6XFwnID09IGRvY3VtZW50LmxvY2F0aW9uLnByb3RvY29sID8gXFwnaHR0cHM6XC9cL3NzbFxcJyA6IFxcJ2h0dHA6XC9cL3d3d1xcJykgKyBcXCcuZ29vZ2xlLWFuYWx5dGljcy5jb21cL2dhLmpzXFwnO1xyXG4gICAgdmFyIHMgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5VGFnTmFtZShcXCdzY3JpcHRcXCcpWzBdOyBzLnBhcmVudE5vZGUuaW5zZXJ0QmVmb3JlKGdhLCBzKTtcclxuICB9KSgpO1xyXG5cclxuIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2Zvb3Rlcl9ib3R0b21fdGV4dCIsIm9wdGlvbl92YWx1ZSI6Ilx1MDBhOSAyMDExIFx1MDBiNyBBdmVyaW4gV29yZFByZXNzIE1hZ2F6aW5lIFRoZW1lIFx1MDBiNyBBbGwgUmlnaHRzIFJlc2VydmVkIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX25vdGZvdW5kX3RpdGxlIiwib3B0aW9uX3ZhbHVlIjoiIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX25vdGZvdW5kX2xvZ28iLCJvcHRpb25fdmFsdWUiOiJodHRwOlwvXC93cHRpdGFucy5jb21cL2F2ZXJpblwvd3AtY29udGVudFwvdGhlbWVzXC9hdmVyaW5cL2ltYWdlc1wvbm90Zm91bmQucG5nIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX25vdGZvdW5kX3RleHQiLCJvcHRpb25fdmFsdWUiOiIifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfYXV0b19mZWF0dXJlX3NsaWRlciIsIm9wdGlvbl92YWx1ZSI6InRydWUifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfZW5hYmxlX2ZlYXR1cmVfc2xpZGVyIiwib3B0aW9uX3ZhbHVlIjoidHJ1ZSJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19mZWF0dXJlX3NsaWRlciIsIm9wdGlvbl92YWx1ZSI6Ik5pdm8gU2xpZGVyIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2ZlYXR1cmVfc2xpZGVyX2R1cmF0aW9uIiwib3B0aW9uX3ZhbHVlIjoiMzAwMCJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19hdXRob3JfYmlvIiwib3B0aW9uX3ZhbHVlIjoidHJ1ZSJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19wb3B1bGFyIiwib3B0aW9uX3ZhbHVlIjoidHJ1ZSJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19wb3B1bGFyX25vIiwib3B0aW9uX3ZhbHVlIjoiNCJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19zb2NpYWxfc2V0Iiwib3B0aW9uX3ZhbHVlIjoidHJ1ZSJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc190d2l0dGVyX2lkIiwib3B0aW9uX3ZhbHVlIjoiIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2ZiX2lkIiwib3B0aW9uX3ZhbHVlIjoiIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2FkX2VuYWJsZSIsIm9wdGlvbl92YWx1ZSI6ImZhbHNlIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2FkX2xpbmsiLCJvcHRpb25fdmFsdWUiOiIifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfYWRfaW1hZ2VfbGluayIsIm9wdGlvbl92YWx1ZSI6Imh0dHA6XC9cL3dwdGl0YW5zLmNvbVwvYXZlcmluXC93cC1jb250ZW50XC90aGVtZXNcL2F2ZXJpblwvaW1hZ2VzXC9hZHM0Njg2MC5qcGcifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfdG9nZ2xlX2N1c3RvbV9mb250Iiwib3B0aW9uX3ZhbHVlIjoiR29vZ2xlIFdlYmZvbnRzIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2N1c3RvbV9mb250Iiwib3B0aW9uX3ZhbHVlIjoiRHJvaWQgU2FucyJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19jdWZvbl9mb250Iiwib3B0aW9uX3ZhbHVlIjoiQWNpZCJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19ib2R5X2ZvbnQiLCJvcHRpb25fdmFsdWUiOiJQVCBTYW5zIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2ZvbnRfY29sb3IiLCJvcHRpb25fdmFsdWUiOiI3Nzc3NzcifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfbGlua19mb250X2NvbG9yIiwib3B0aW9uX3ZhbHVlIjoiMzMzMzMzIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2xpbmtfaG92ZXJfZm9udF9jb2xvciIsIm9wdGlvbl92YWx1ZSI6Ijc3Nzc3NyJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19iYW5uZXJfbGluazMiLCJvcHRpb25fdmFsdWUiOiJodHRwOlwvXC90aGVtZWZvcmVzdC5uZXQifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfYmFubmVyX2ltZzQiLCJvcHRpb25fdmFsdWUiOiJodHRwOlwvXC93cHRpdGFucy5jb21cL2F2ZXJpblwvZmlsZXNcLzIwMTFcLzA3XC82NjA2NS0xMzA4OTM1MDU1LmpwZyJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19wb3J0Zm9saW9fbGltaXQiLCJvcHRpb25fdmFsdWUiOiIyNTAifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfZmxpY2tyX2tleSIsIm9wdGlvbl92YWx1ZSI6IiJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19mbGlja3JfbmFtZSIsIm9wdGlvbl92YWx1ZSI6IiJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19oZWFkZXJfdGV4dHVyZSIsIm9wdGlvbl92YWx1ZSI6InJhc3Rlci10ZXh0dXJlIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2hlYWRlcl9iZ19jb2xvciIsIm9wdGlvbl92YWx1ZSI6ImYwZjBmMCJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc193aWRnZXRfdGV4dHVyZSIsIm9wdGlvbl92YWx1ZSI6Im5vaXNlLXRleHR1cmUifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfd2lkZ2V0X2JnX2NvbG9yIiwib3B0aW9uX3ZhbHVlIjoiNTU1NTU1In0seyJvcHRpb25fbmFtZSI6ImhhZGVzX3BvcnRmb2xpb190ZXh0dXJlIiwib3B0aW9uX3ZhbHVlIjoibm9pc2UtdGV4dHVyZSJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19wb3J0Zm9saW9fYmdfY29sb3IiLCJvcHRpb25fdmFsdWUiOiI1NTU1NTUifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfc2lkZWJhcl9hbGlnbiIsIm9wdGlvbl92YWx1ZSI6IlJpZ2h0In0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2Jhbm5lcl9saW5rNCIsIm9wdGlvbl92YWx1ZSI6Imh0dHA6XC9cL3RoZW1lZm9yZXN0Lm5ldCJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19iYW5uZXJfaW1nNSIsIm9wdGlvbl92YWx1ZSI6Imh0dHA6XC9cL3dwdGl0YW5zLmNvbVwvYXZlcmluXC9maWxlc1wvMjAxMVwvMDdcLzYyNjE5LTEzMDY1MTc4NzMucG5nIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2Jhbm5lcl9saW5rNSIsIm9wdGlvbl92YWx1ZSI6Imh0dHA6XC9cL3RoZW1lZm9yZXN0Lm5ldCJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19iYW5uZXJfbGltaXQiLCJvcHRpb25fdmFsdWUiOiI1In0seyJvcHRpb25fbmFtZSI6ImhhZGVzX3NvY2lhbF9zZXRfc3R5bGUiLCJvcHRpb25fdmFsdWUiOiJTdHlsZSAyIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2JkX3NpemUiLCJvcHRpb25fdmFsdWUiOiIxMiJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19oMSIsIm9wdGlvbl92YWx1ZSI6IjI0In0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2gyIiwib3B0aW9uX3ZhbHVlIjoiMjAifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfaDMiLCJvcHRpb25fdmFsdWUiOiIxNiJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19oNCIsIm9wdGlvbl92YWx1ZSI6IjE0In0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2g1Iiwib3B0aW9uX3ZhbHVlIjoiMTIifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfaDYiLCJvcHRpb25fdmFsdWUiOiIxMCJ9LHsib3B0aW9uX25hbWUiOiJoYWRlc19zaWRlYmFyX3RpdGxlIiwib3B0aW9uX3ZhbHVlIjoiMTYifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfZm9vdGVyX3RpdGxlIiwib3B0aW9uX3ZhbHVlIjoiMTYifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfYWRzX3NlbnNlIiwib3B0aW9uX3ZhbHVlIjoiIn0seyJvcHRpb25fbmFtZSI6ImhhZGVzX2Zvb3Rlcl9ob3Zlcl9saW5rX2ZvbnRfY29sb3IiLCJvcHRpb25fdmFsdWUiOiJmZmZmZmYifSx7Im9wdGlvbl9uYW1lIjoiaGFkZXNfZW5hYmxlX3NsaWRlcl9kZXNjIiwib3B0aW9uX3ZhbHVlIjoiZmFsc2UifV0= ";

$theme_options = base64_decode($theme_options);	
$theme_options = str_replace("hades","AVE",$theme_options);
$input = json_decode($theme_options,true);

	
foreach($input as $key => $val)
update_option($val["option_name"],$val["option_value"]);

$slider_options = array("jQuery Slider","Nivo Slider","Accordion Slider","HTML5 Slider","Fade Slider");

$sliders = array();


for($i=1;$i<9;$i++)
{
	$sl = array();
	for($j=0;$j<5;$j++)
	{
		$sl[] =  array
                        (
						 "media_type" => "image",
						 "stage_option" => $opts[rand(0,2)],
                            "slide_title" => "Pellentesque nec cursus nisl.",
                            "slide_link" => "#",
                            "slide_image" => URL."/sprites/i/default.jpg",
                            "description" => "Vestibulum accumsan tristique massa, ac aliquam augue volutpat eget. Donec justo eros, gravida tristique ornare sit amet, rhoncus a leo. Nulla facilisi. Integer rutrum nisl eros. "
                        );
	}
	
	$sliders["Slider {$i}"] = array(
	        "title" => "Slider {$i}",
            "width" => 630,
            "height" => 305,
            "type" => $slider_options[$i-1],
            "interval" => "5",
            "autoplay" => "true",
			"desc" => "true",
            "controls" => "true" ,
			"slides" => $sl
	);
}
 
 
$force_option = array(

SN."_active_sidebars" =>  array ( "Right Sidebar" ,"Right Sidebar 2","Right Sidebar 1 "),
SN."_logo" => URL."/sprites/i/logo.png",
SN."_stage_option" => "Slider",
SN."_home_slider" => "Slider 1",
SN."_forms" => array(),
SN."_sliders" => serialize($sliders),
SN."_footer_layout" => "three-col",
SN."_home_layout" => "hasRightSidebar",
SN."_home_sidebar" => "Blog Sidebar"
);
	
	foreach($force_option as $k => $v)
    update_option($k,$v);	
	

 
 		
}