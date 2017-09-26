<?php
/**
 * The Call to Action Sidebar
 * @package lavish
 * @since 1.0.0
 */
$default_content = get_theme_mod('hide_default_content', '0');
if ( ! is_active_sidebar( 'cta' ) && (!$default_content)):?>
	<div class="lr_widgets_cta" >
	<div class="container">
        <div class="row">
           	<div class="col-md-12">
           		<div class="align_center" style="padding: 0rem 25%">
<h2><?php echo __('Everything you need', 'lavish');?></h2>
<p><?php echo __('Lavish Pro Themes provides you everything that you need on a WordPress theme, 
	extensive customize options for user-oriented easy use, flat and modern design to capture
	 viewers attention, plenty color options to full fill the choice of yours and many more.', 'lavish');?></p>
<button class="btn"><?php echo __('Download Now', 'lavish');?></button>
</div>
        	</div>
        </div>
    </div>
</div>
<?php elseif(is_active_sidebar( 'cta' ) ):
?>
<div class="lr_widgets_cta" >
	<div class="container">
        <div class="row">
           	<div class="col-md-12">
           		<?php dynamic_sidebar( 'cta' ); ?>
        	</div>
        </div>
    </div>
</div>
<?php else:
    return;
endif;
?>
