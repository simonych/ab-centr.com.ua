<?php $region = $block->region;
$enabled_blockRegion = $region != 'content' && $region != 'Menu' && $region != 'vnavigation_left' && $region != 'vnavigation_right'
					&& $region != "banner1" && $region != "banner2" && $region != "banner3"
					&& $region != "banner4" && $region != "banner5" && $region != "banner6"
					&& $region != "extra1" && $region != "extra2" && $region != "footer_message";  ?>
<div class="<?php if (isset($classes)) print $classes; ?>" id="<?php print $block_html_id; ?>"<?php print $attributes; ?>>
<?php if ($enabled_blockRegion) :?>
<div class="art-box art-block">
      <div class="art-box-body art-block-body">
  
<?php endif;?>
    
<?php print render($title_prefix); ?>
	    <?php if (!empty($block->subject)): ?>
			
			<?php if ($enabled_blockRegion) :?>

			<?php endif;?>
			
			<?php echo $block->subject; ?>
			
			<?php if ($enabled_blockRegion) :?>

			<?php endif;?>

	    <?php endif; ?>
<?php print render($title_suffix); ?>

	<?php if ($enabled_blockRegion) :?>
<div class="art-box art-blockcontent">
		    <div class="art-box-body art-blockcontent-body">
		<div class="content"<?php print $content_attributes; ?>>
		
	<?php endif;?>
		
<?php echo $content; ?>

	<?php if($enabled_blockRegion) :?>

		</div>
				<div class="cleared"></div>
		    </div>
		</div>
		

				<div class="cleared"></div>
		    </div>
		</div>
		
	<?php endif;?>
</div>