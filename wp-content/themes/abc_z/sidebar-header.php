<?php theme_print_sidebar('header-widget-area'); ?>



    <div class="art-shapes">

            </div>
<?php if(theme_get_option('theme_header_show_headline')): ?>
	<?php $headline = theme_get_option('theme_'.(is_home()?'posts':'single').'_headline_tag'); ?>
	<<?php echo $headline; ?> class="art-headline" data-left="13.42%">
    <a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a>
</<?php echo $headline; ?>>
<?php endif; ?>

<?php theme_print_sidebar('header-CONTROL-ID-widget-area','<div class="art-positioncontrol art-positioncontrol-1805469212" id="CONTROL-ID" data-left="17.41%">', '</div>'); ?>
<?php theme_print_sidebar('header-CONTROL-ID-2-widget-area','<div class="art-positioncontrol art-positioncontrol-1043714943" id="CONTROL-ID-2" data-left="84.43%">', '</div>'); ?>
<?php theme_print_sidebar('header-CONTROL-ID-1-widget-area','<div class="art-positioncontrol art-positioncontrol-64249161" id="CONTROL-ID-1" data-left="99.35%">', '</div>'); ?>



                
                    
