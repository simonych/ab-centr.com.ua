<?php 

$path = __FILE__;
$pathwp = explode( 'wp-content', $path );
$wp_url = $pathwp[0];
require_once( $wp_url.'/wp-load.php' );



?>



<div id="visual_plain_panel">
<h2> Stylings </h2>

<?php 
/*
 global $wpdb;
 $output = $wpdb->get_results("SELECT option_name,option_value FROM $wpdb->options WHERE option_name like '".SN."%'",ARRAY_A );
 $output = json_encode($output);
 $output = base64_encode($output);	
 echo "<textarea> $output </textarea>"; 
	*/ ?>

