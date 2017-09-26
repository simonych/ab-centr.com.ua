
<div class="art-footer-text">
	<div class="block">
		<div class="title"><a href="<?php echo get_permalink(1968);?>">Продукты 1С</a></div>
		<ul class="blockList">
			<li><a href="<?php echo get_permalink(2090);?>"><?php echo get_the_title(2090);?></a></li>
			<li><a href="<?php echo get_permalink(2098);?>"><?php echo get_the_title(2098);?></a></li>
			<li><a href="<?php echo get_permalink(2096);?>"><?php echo get_the_title(2096);?></a></li>
			<li><a href="<?php echo get_permalink(2199);?>"><?php echo get_the_title(2199);?></a></li>
			<li><a href="<?php echo get_permalink(2102);?>"><?php echo get_the_title(2102);?></a></li>
			<li><a href="<?php echo get_permalink(2094);?>"><?php echo get_the_title(2094);?></a></li>
			<li><a href="<?php echo get_permalink(2100);?>"><?php echo get_the_title(2100);?></a></li>
			<li><a href="<?php echo get_permalink(2583);?>"><?php echo get_the_title(2583);?></a></li>
		</ul>
	</div>
	<div class="block">
		<div class="title"><a href="<?php echo get_permalink(2032);?>">Отраслевые решения</a></div>
		<ul class="blockList">
			<li><a href="<?php echo get_permalink(2394);?>"><?php echo get_the_title(2394);?></a></li>
			<li><a href="<?php echo get_permalink(2384);?>"><?php echo get_the_title(2384);?></a></li>
			<li><a href="<?php echo get_permalink(2382);?>"><?php echo get_the_title(2382);?></a></li>
			<li><a href="<?php echo get_permalink(2386);?>"><?php echo get_the_title(2386);?></a></li>
		</ul>
	</div>
	<div class="block">
		<div class="title"><a href="<?php echo get_permalink(2036);?>">Услуги</a></div>
		<ul class="blockList">
			<li><a href="<?php echo get_permalink(2043);?>"><?php echo get_the_title(2043);?></a></li>
			<li><a href="<?php echo get_permalink(2661);?>"><?php echo get_the_title(2661);?></a></li>
			<li><a href="<?php echo get_permalink(2046);?>"><?php echo get_the_title(2046);?></a></li>
			<li><a href="<?php echo get_permalink(2660);?>"><?php echo get_the_title(2660);?></a></li>
			<li><a href="<?php echo get_permalink(2040);?>"><?php echo get_the_title(2040);?></a></li>
		</ul>
	</div>
	<div class="block">
		<div class="title"><a href="<?php echo get_permalink(2046);?>">Обучение</a></div>
		<ul class="blockList">
			<li><a href="<?php echo get_permalink(2483);?>"><?php echo get_the_title(2483);?></a></li>
		</ul>
	</div>
</div>
<div class="clearfix"></div>
<?php
global $theme_sidebars;
$places = array();
foreach ($theme_sidebars as $sidebar){
    if ($sidebar['group'] !== 'footer')
        continue;
    $widgets = theme_get_dynamic_sidebar_data($sidebar['id']);
    if (!is_array($widgets) || count($widgets) < 1)
        continue;
    $places[$sidebar['id']] = $widgets;
}
$place_count = count($places);
$needLayout = ($place_count > 1);
if (theme_get_option('theme_override_default_footer_content')) {
    if ($place_count > 0) {
        $centred_begin = '<div class="art-center-wrapper"><div class="art-center-inner">';
        $centred_end = '</div></div><div class="clearfix"> </div>';
        if ($needLayout) { ?>
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <?php 
        }
        foreach ($places as $widgets) { 
            if ($needLayout) { ?>
            <div class="art-layout-cell art-layout-cell-size<?php echo $place_count; ?>">
            <?php 
            }
            $centred = false;
            foreach ($widgets as $widget) {
                 $is_simple = ('simple' == $widget['style']);
                 if ($is_simple) {
                     $widget['class'] = implode(' ', array_merge(explode(' ', theme_get_array_value($widget, 'class', '')), array('art-footer-text')));
                 }
                 if (false === $centred && $is_simple) {
                     $centred = true;
                     echo $centred_begin;
                 }
                 if (true === $centred && !$is_simple) {
                     $centred = false;
                     echo $centred_end;
                 }
                 theme_print_widget($widget);
            } 
            if (true === $centred) {
                echo $centred_end;
            }
            if ($needLayout) {
           ?>
            </div>
        <?php 
            }
        } 
        if ($needLayout) { ?>
    </div>
</div>
        <?php 
        }
    }
?>
<div class="art-footer-text">
<?php
global $theme_default_options;
echo do_shortcode(theme_get_option('theme_override_default_footer_content') ? theme_get_option('theme_footer_content') : theme_get_array_value($theme_default_options, 'theme_footer_content'));
} else { 
?>
<div class="art-footer-text">

<p><a href="#">Link1</a> | <a href="#">Link2</a> | <a href="#">Link3</a></p>
<p>Copyright © 2014. All Rights Reserved.</p>
  
<?php } ?>

</div>
