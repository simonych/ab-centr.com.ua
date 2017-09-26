<div class="<?php if (isset($classes)) print $classes; ?>" id="<?php print $block_html_id; ?>"<?php print $attributes; ?>>
  <?php if ($block->subject): ?>
    <h2><?php print $block->subject ?></h2>
  <?php endif;?>
  <div class="content">
    <?php print $content ?>
  </div>
</div>
