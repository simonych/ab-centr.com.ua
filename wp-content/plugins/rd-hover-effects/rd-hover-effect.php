<?php
/*
Plugin Name: RD Hover Effects
Plugin URI: http://wpexpert24.com/
Description: RD Hover Effects WordPress Plugin is an impressive hover effects powered by pure CSS3. Fully responsive With Mobile Optimized. Easy to use the beautiful amazing Image Hover Effects for your website.
Author: RAKIBUR RAHMAN SAGAR
Author URI: http://wpexpert24.com/
Version: 4.2
*/

//Loading CSS
function rd_hover_effects_style() {
	wp_enqueue_style('main_css', plugins_url( '/css/style.css' , __FILE__ ) );
	wp_enqueue_style('stylesheet_css', plugins_url( '/css/style_com.css' , __FILE__ ) );
	wp_enqueue_style('hover_css', plugins_url( '/css/ohover.css' , __FILE__ ) );
	wp_enqueue_style('gird_boot_css', plugins_url( '/css/rd-hover-gird.css' , __FILE__ ) );	
	wp_enqueue_style('rdresponsive_css', plugins_url( '/css/rdresponsive.css' , __FILE__ ) );	

}
add_action( 'wp_enqueue_scripts', 'rd_hover_effects_style' );

// added widgets filters
add_filter('widget_text', 'do_shortcode');

// Loading VafPress Framework
if(!class_exists('VP_rdhoverAutoLoader')){
// Setup Contants
defined( 'VP_RDHOVER_VERSION' ) or define( 'VP_RDHOVER_VERSION', '2.0' );
defined( 'VP_RDHOVER_URL' )     or define( 'VP_RDHOVER_URL', plugin_dir_url( __FILE__ ) );
defined( 'VP_RDHOVER_DIR' )     or define( 'VP_RDHOVER_DIR', plugin_dir_path( __FILE__ ) );
defined( 'VP_RDHOVER_FILE' )    or define( 'VP_RDHOVER_FILE', __FILE__ );

// Lood Bootstrap
require 'framework/bootstrap.php';

}


// Registering Custom Post
function rd_hover_effects_custom_post() {
	register_post_type( 'rd-hover',
		array(
			'labels' => array(
				'name' => __( 'RD Hov Effect' ),
				'singular_name' => __( 'Hover Effect' ),
				'add_new_item' => __( 'Add New Item' )
			),
			'public' => true,
			'supports' => array('title'),
			'has_archive' => true,
			'rewrite' => array('slug' => 'hover-effects'),
			'menu_icon' => '',
			'menu_position' => 20,
		)
	);
	
}
add_action( 'init', 'rd_hover_effects_custom_post' );

// Registering Custom post's category
function rd_hover_effects_custom_post_taxonomy() {
	register_taxonomy(
		'hover_cat',  
		'rd-hover',
		array(
			'hierarchical'          => true,
			'label'                 => 'RD Category',
			'query_var'             => true,
			'show_admin_column'             => true,
			'rewrite'                       => array(
				'slug'                  => 'rd-category',
				'with_front'    => true
				)
			)
	);
}
add_action( 'init', 'rd_hover_effects_custom_post_taxonomy'); 
require 'admin/icon.php';

// Load Metaboxes 

new VP_Metabox(array
(
			'id'          => 'rdmeta',
			'types'       => array('rd-hover'),
			'title'       => __('Hover Information ', 'vp_textdomain'),
			'priority'    => 'high',
			'template' => VP_RDHOVER_DIR . '/admin/metabox/main.php'
));


// Register Shortcode
function rd_hover_effects_shortcode($atts){
	extract( shortcode_atts( array(

		'category' => '',	
		'style' => '',				
		'effects' => '',				
		'circle_animation' => '',				
		'item_show_row' => '',				
		
	), $atts) );
	
	
	    $q = new WP_Query(
        array('posts_per_page' => -1, 'post_type' => 'rd-hover', 'hover_cat' => $category)
        );
	
		while($q->have_posts()) : $q->the_post();
		$id = get_the_ID();	
		
	
		$rdmeta = vp_metabox('rdmeta.rd-hover', false);
		
	$i = 0;
	
		$output = '<div class="main-wrapper rd-container"><div class="rd-row"><div id="'.$style.'">';
		
		foreach ($rdmeta as $info) {	

		if ($effects=="square" && $style=="style1") {
		
		$output .= '
			<style type="text/css">
			@import url(http://fonts.googleapis.com/css?family='.$google_font.');
			</style>
			<div class="'.$item_show_row.'">
				<div class="rakib-dev rakib-dev-first">
                    <img class="img-responsive" src="'.$info['imgup_1'].'" />
						<div class="mask">
							<h2>'.$info['title'].'</h2>
								<p>'.$info['desc'].'</p>
						<a href="'.$info['link'].'" class="info">'.$info['link_title'].'</a>
					</div>
                </div> 
				</div>
				';
		}
		if ($effects=="square" && $style=="style2") {
		
		$output .= '
			<style type="text/css">
			@import url(http://fonts.googleapis.com/css?family='.$google_font.');
			</style>
		<div class="'.$item_show_row.'">
		<div class="rakib-dev rakib-dev-second">
                    <img src="'.$info['imgup_1'].'" />
                    <div class="mask"></div>
                    <div class="rd_content">
                        <h2>'.$info['title'].'</h2>
                        <p>'.$info['desc'].'</p>
                        <a href="'.$info['link'].'" class="info">'.$info['link_title'].'</a>
                    </div>
                </div>
                </div>
				';
		}
		if ($effects=="square" && $style=="style3") {
		
		$output .= '
			<style type="text/css">
			@import url(http://fonts.googleapis.com/css?family='.$google_font.');
			</style>
			<div class="'.$item_show_row.'">
				<div class="rakib-dev rakib-dev-third">
                    <img src="'.$info['imgup_1'].'" />
						<div class="mask">
							<h2>'.$info['title'].'</h2>
								<p >'.$info['desc'].'</p>
						<a href="'.$info['link'].'" class="info">'.$info['link_title'].'</a>
					</div>
                </div>  
                </div>  
				';
		}
		if ($effects=="square" && $style=="style4") {
		
		$output .= '
			<style type="text/css">
			@import url(http://fonts.googleapis.com/css?family='.$google_font.');
			</style>
			<div class="'.$item_show_row.'">
				<div class="rakib-dev rakib-dev-fourth">
                    <img src="'.$info['imgup_1'].'" />
						<div class="mask">
							<h2>'.$info['title'].'</h2>
								<p >'.$info['desc'].'</p>
						<a href="'.$info['link'].'" class="info">'.$info['link_title'].'</a>
					</div>
                </div>  
                </div>  
				';
		}
		if ($effects=="square" && $style=="style5") {
		
		$output .= '
			<style type="text/css">
			@import url(http://fonts.googleapis.com/css?family='.$google_font.');
			</style>
			<div class="'.$item_show_row.'">
				<div class="rakib-dev rakib-dev-fifth">
                    <img src="'.$info['imgup_1'].'" />
						<div class="mask">
							<h2>'.$info['title'].'</h2>
								<p >'.$info['desc'].'</p>
						<a href="'.$info['link'].'" class="info">'.$info['link_title'].'</a>
					</div>
                </div>  
                </div>  
				';
		}
		if ($effects=="square" && $style=="style6") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style7") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style8") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($$effects=="square" && $style=="style9") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style10") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style11") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style12") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style13") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style14") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style15") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style16") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style17") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style18") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style19") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style20") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style21") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style22") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style23") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style24") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		if ($effects=="square" && $style=="style25") {
		
		$output .= '
		
			<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
				';
		}
		
	// START Carcle STYLE //	
		
		if ($effects=="circle" && $style=="style1") {
		
		$output .= '
				<li class="circle_single">
		        <div class="item-hover circle effect1"><a href="'.$info['link'].'">
                      <div class="spinner"></div>
                      <div class="img"><img src="'.$info['imgup_1'].'" alt="img"></div>
                      <div class="info">
                        <div class="info-back">
                          <h3>'.$info['title'].'</h3>
                          <p>'.$info['desc'].'</p>
                        </div>
               </div></a></div>
			   </li>
				';
		}
		if ($effects=="circle" && $style=="style2") {
				
				$output .= '
					<li class="circle_single">
						  <div class="item-hover circle effect2 '.$circle_animation.'"><a href="'.$info['link'].'">
							  <div class="img"><img src="'.$info['imgup_1'].'" alt="img"></div>
							  <div class="info">
								<h3>'.$info['title'].'</h3>
								<p>'.$info['desc'].'</p>
							  </div></a></div>
					   </li>
						';
				}
		if ($effects=="circle" && $style=="style3") {
				
				$output .= '
						<li class="circle_single">
                     <div class="item-hover circle effect3 '.$circle_animation.'"><a href="'.$info['link'].'">
                      <div class="img"><img src="'.$info['imgup_1'].'" alt="img"></div>
                      <div class="info">
                       <h3>'.$info['title'].'</h3>
                        <p>'.$info['desc'].'</p>
                      </div></a></div>
					   </li>
						';
				}
			if ($effects=="circle" && $style=="style4") {
				
				$output .= '
						<li class="circle_single">
                  <div class="item-hover circle effect4 '.$circle_animation.'"><a href="'.$info['link'].'">
                      <div class="img"><img src="'.$info['imgup_1'].'" alt="img"></div>
                      <div class="info">
                        <h3>'.$info['title'].'</h3>
                        <p>'.$info['desc'].'</p>
                      </div></a></div>
					   </li>
						';
				}
				if ($effects=="circle" && $style=="style5") {
				
				$output .= '
					<li class="circle_single">
                  <div class="item-hover circle effect5"><a href="'.$info['link'].'">
                      <div class="img"><img src="'.$info['imgup_1'].'" alt="img"></div>
                      <div class="info">
                        <div class="info-back">
                          <h3>'.$info['title'].'</h3>
                         <p>'.$info['desc'].'</p>
                        </div>
                      </div></a></div>
					   </li>
						';
				}
					if ($effects=="circle" && $style=="style6") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style7") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style8") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style9") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style10") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style11") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style12") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style13") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style14") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style15") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style16") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style17") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style18") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style19") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style20") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style21") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style22") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style23") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style24") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}
					if ($effects=="circle" && $style=="style25") {
		
				$output .= '
				
					<h1 style="color: red; ">SORRY THIS STYLE ONLY FOR PRO VERSION. IF YOU WANT TO BUY RD HOVER EFFECTS PRO VERSION WITH AWESOME FEATURES PLEASE CLICK HERE <a style="color: blue;" target="_blink" href="http://wpexpert24.com/rd-hover-effects-pro/">CLICK HERE</a></h1>
						';
				}				
		
		
		$i++;
	}
	
	endwhile;
	$output .='</ul></div></div></div>';
	wp_reset_query();
	return $output;
}

add_shortcode('hover', 'rd_hover_effects_shortcode');



//Shortcode Generator 
    function acb_init_shortcodegenerator()
    {
    // Built path to shortcode generator template array file
    //$sg_path = VP_TEAM_DIR() . '/admin/shortcode.php';
    // Initialize the ShortcodeGenerator's object
    $tmpl_sg = array(
    'name' => 'sg_1',
    'template' => VP_RDHOVER_DIR . '/admin/shortcode_generator.php',
    'modal_title' => __( 'Hover Shortcode', 'vp_textdomain'),
    'button_title' => __( 'Hover Shortcode', 'vp_textdomain'),
    'types' => array( 'post', 'page' ),
    'main_image' => VP_RDHOVER_URL . 'images/hover-shortcode.png',
    'sprite_image' => VP_RDHOVER_URL . 'images/hover-shortcode.png',
    //'included_pages' => array( 'appearance_page_vpt_option' ),
    );
    
	$sg = new VP_ShortcodeGenerator($tmpl_sg);
    
	}
	
    // the safest hook to use, since Vafpress Framework may exists in Theme or Plugin
    add_action( 'after_setup_theme', 'acb_init_shortcodegenerator' );
	
	?>