<!doctype html> <!-- Start of page HTML5 enabled -->
<head> <!-- Start of head  -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>
	 <?php
					    if(is_home()) echo bloginfo(__('name') , 'h-framework' );
					    elseif(is_category()) {
					         _e('Browsing the Category ' , 'h-framework' );
					          wp_title(' ', true, '');
					  } elseif(is_archive()) wp_title('', true,'');
					    elseif(is_search())  echo __( 'Search Results for' , 'h-framework' ).$s;
					    elseif(is_404())     _e( '404 - Page got lost!'  , 'h-framework');
					    else                 bloginfo(__('name' , 'h-framework')); wp_title(__('-' , 'h-framework'), true, '');
					  
      ?></title>
	
     <link rel="shortcut icon" href="<?php echo get_option(SN."_favicon"); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" /><!-- Feed  -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) )      wp_enqueue_script( 'comment-reply' );
		     wp_head(); ?>
    
    <!--[if IE 9]>
            <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/sprites/stylesheets/ie9.css" />
        <![endif]-->  
        <!--[if IE 8]>
            <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/sprites/stylesheets/ie8.css" />
        <![endif]-->  
     <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>/sprites/stylesheets/ie7.css" />
        <![endif]-->  
                 
</head> <!-- End of Head -->
 
<body> <!-- Start of body  -->


<div class="top-section clearfix">
  <div class="skeleton">
   <?php 
     global $super_options;
            if(function_exists("wp_nav_menu"))
            {
                wp_nav_menu(array(
                            'theme_location'=>'top_nav',
                            'container'=>'',
                            'depth' => 3,
                            'container_class' => 'clearfix',
                            'menu_id' => 'topmenu')
                            );
            }
        ?>
        
        <ul id="top-social-menu">
          <li class="twitter"> <a href="http://twitter.com/#!/<?php echo get_option("hades_twitter_id"); ?>">Follow Us</a> </li>
          <li class="fb"> <a href="http://facebook.com/<?php echo get_option("hades_fb_id"); ?>">Become a Fan</a> </li>
          <li class="rss"> <a href="<?php if(!get_option("hades_feedburner")) bloginfo('rss2_url'); else echo "http://feeds.feedburner.com/".trim(get_option("hades_feedburner")); ?>">Subscribe</a> </li>
        </ul>
   </div>
  
</div>


<div id="top-bar" class="clearfix skeleton" >
 <a href="<?php echo home_url(); ?>" id="logo"><img src="<?php echo $super_options[SN."_logo"]; ?>" alt="logo" /></a>
 
 <?php if($super_options[SN."_banner_enable"]=="true" || $super_options[SN."_banner_enable"]=="")include(HPATH."/helper/topbanner.php"); ?>  
   


</div>


<div id="main-menu" class="skeleton">     
    <?php 
            if(function_exists("wp_nav_menu"))
            {
                wp_nav_menu(array(
                            'theme_location'=>'primary_nav',
                            'container'=>'',
                            'depth' => 2,
                            'container_class' => 'clearfix',
                            'menu_id' => 'menu')
                            );
            } 
        ?>
</div>      