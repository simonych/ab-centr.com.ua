<?php
$vars = get_defined_vars();
$view = get_artx_drupal_view();
$view->print_head($vars);
if (isset($page))
foreach (array_keys($page) as $name)
$$name = & $page[$name];
$art_sidebar_left = isset($sidebar_left) && !empty($sidebar_left) ? $sidebar_left : NULL;
$art_sidebar_right = isset($sidebar_right) && !empty($sidebar_right) ? $sidebar_right : NULL;
if (!isset($vnavigation_left)) $vnavigation_left = NULL;
if (!isset($vnavigation_right)) $vnavigation_right = NULL;
$tabs = (isset($tabs) && !(empty($tabs))) ? '<ul class="arttabs_primary">'.render($tabs).'</ul>' : NULL;
$tabs2 = (isset($tabs2) && !(empty($tabs2))) ?'<ul class="arttabs_secondary">'.render($tabs2).'</ul>' : NULL;
?>

<div id="art-main">
<?php if (!empty($navigation) || !empty($extra1) || !empty($extra2)): ?>
<nav class="art-nav">
     
    <?php if (!empty($extra1)) : ?>
<div class="art-hmenu-extra1"><?php echo render($extra1); ?></div>
<?php endif; ?>
<?php if (!empty($extra2)) : ?>
<div class="art-hmenu-extra2"><?php echo render($extra2); ?></div>
<?php endif; ?>
<?php if (!empty($navigation)) : ?>
<?php echo render($navigation); ?>
<?php endif; ?>
</nav><?php endif; ?>

<header class="art-header"><?php if (!empty($art_header)) { echo render($art_header); } ?>


    <div class="art-shapes">
<div class="art-textblock art-object1201519387" data-left="28.49%">
        <div class="art-object1201519387-text-container">
        <div class="art-object1201519387-text">&nbsp; <span style="font-size: 24px; line-height: 24px; ">1С:Франчайзи&nbsp;</span>ООО "АБ-Центр"</div>
    </div>
    
</div><div class="art-textblock art-object988282451" data-left="27.79%">
        <div class="art-object988282451-text-container">
        <div class="art-object988282451-text">&nbsp; Сертифицированный партнер фирмы 1С в Днепропетровске&nbsp;</div>
    </div>
    
</div><div class="art-textblock art-object1399935282" data-left="25.59%">
        <div class="art-object1399935282-text-container">
        <div class="art-object1399935282-text">&nbsp; продажа, установка, внедрение и сопровождение<br>&nbsp; "1С:Предприятие для управления и учета</div>
    </div>
    
</div><div class="art-textblock art-object1989411883" data-left="100%">
        <div class="art-object1989411883-text-container">
        <div class="art-object1989411883-text">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; тел: (0562) 35-35-33, 35-05-35<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; тел.факс: (0562) 35-35-44<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (068) 021-99-91 (Киевстар)<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (066) 948 80 78 (МТС)<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; адрес: г. Днепропетровск ул.XXII Партсъезда д.50, 2-й этаж, офис 3</div>
    </div>
    
</div>
            </div>



<div class="art-textblock art-object831640589" data-left="99.46%">
    <?php if (!empty($search_box)) { echo render($search_box); } ?>
</div>
                
                    
</header>
<div class="art-sheet clearfix">
            <?php if (!empty($banner1)) { echo '<div id="banner1">'.render($banner1).'</div>'; } ?>
<?php echo art_placeholders_output(render($top1), render($top2), render($top3)); ?>
<div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <?php if (!empty($art_sidebar_left) || !empty($vnavigation_left)) : ?>
<div class="art-layout-cell art-sidebar1"><?php echo render($vnavigation_left); ?>
<?php echo render($art_sidebar_left); ?>
</div><?php endif; ?>
                        <div class="art-layout-cell art-content"><?php if (!empty($banner2)) { echo '<div id="banner2">'.render($banner2).'</div>'; } ?>
<?php if ((!empty($user1)) && (!empty($user2))) : ?>
<table class="position" cellpadding="0" cellspacing="0" border="0">
<tr valign="top"><td class="half-width"><?php echo render($user1); ?></td>
<td><?php echo render($user2); ?></td></tr>
</table>
<?php else: ?>
<?php if (!empty($user1)) { echo '<div id="user1">'.render($user1).'</div>'; }?>
<?php if (!empty($user2)) { echo '<div id="user2">'.render($user2).'</div>'; }?>
<?php endif; ?>
<?php if (!empty($banner3)) { echo '<div id="banner3">'.render($banner3).'</div>'; } ?>

<?php if (!empty($breadcrumb)): ?>
<article class="art-post art-article">
                                
                                                
                <div class="art-postcontent"><?php { echo $breadcrumb; } ?>
</div>
                                
                

</article><?php endif; ?>
<?php $art_post_position = strpos(render($content), "art-postcontent"); ?>
<?php if (($is_front) || (isset($node) && isset($node->nid))): ?>

<?php if (!empty($tabs) || !empty($tabs2)): ?>
<article class="art-post art-article">
                                
                                                
                <div class="art-postcontent"><?php if (!empty($tabs)) { echo $tabs.'<div class="cleared"></div>'; }; ?>
<?php if (!empty($tabs2)) { echo $tabs2.'<div class="cleared"></div>'; } ?>
</div>
                                
                

</article><?php endif; ?>

<?php if (!empty($mission) || !empty($help) || !empty($messages) || !empty($action_links)): ?>
<article class="art-post art-article">
                                
                                                
                <div class="art-postcontent"><?php if (isset($mission) && !empty($mission)) { echo '<div id="mission">'.$mission.'</div>'; }; ?>
<?php if (!empty($help)) { echo render($help); } ?>
<?php if (!empty($messages)) { echo $messages; } ?>
<?php if (isset($action_links) && !empty($action_links)): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
</div>
                                
                

</article><?php endif; ?>

<?php if ($art_post_position === FALSE): ?>
<article class="art-post art-article">
                                
                                                
                <div class="art-postcontent"><?php endif; ?>
<?php echo art_content_replace(render($content)); ?>
<?php if ($art_post_position === FALSE): ?>
</div>
                                
                

</article><?php endif; ?>

<?php else: ?>

<article class="art-post art-article">
                                
                                                
                <div class="art-postcontent"><?php print render($title_prefix); ?>
<?php if (!empty($title)): print '<h1'. ($tabs ? ' class="with-tabs"' : '') .'>'. $title .'</h1>'; endif; ?>
<?php print render($title_suffix); ?>
<?php if (!empty($tabs)) { echo $tabs.'<div class="cleared"></div>'; }; ?>
<?php if (!empty($tabs2)) { echo $tabs2.'<div class="cleared"></div>'; } ?>
<?php if (isset($mission) && !empty($mission)) { echo '<div id="mission">'.$mission.'</div>'; }; ?>
<?php if (!empty($help)) { echo render($help); } ?>
<?php if (!empty($messages)) { echo $messages; } ?>
<?php if (isset($action_links) && !empty($action_links)): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
<?php if ($art_post_position): ?>
      </div>
    </article>
  <?php echo art_content_replace(render($content)); ?>
<?php else: ?>
  <?php echo art_content_replace(render($content)); ?>
</div>
                                
                

</article>
<?php endif; ?>
<?php endif; ?>

<?php if (!empty($banner4)) { echo '<div id="banner4">'.render($banner4).'</div>'; } ?>
<?php if ((!empty($user3)) && (!empty($user4))) : ?>
<table class="position" cellpadding="0" cellspacing="0" border="0">
<tr valign="top"><td class="half-width"><?php echo render($user3); ?></td>
<td><?php echo render($user4); ?></td></tr>
</table>
<?php else: ?>
<?php if (!empty($user3)) { echo '<div id="user3">'.render($user3).'</div>'; }?>
<?php if (!empty($user4)) { echo '<div id="user4">'.render($user4).'</div>'; }?>
<?php endif; ?>
<?php if (!empty($banner5)) { echo '<div id="banner5">'.render($banner5).'</div>'; } ?>
</div>
                    </div>
                </div>
            </div><?php echo art_placeholders_output(render($bottom1), render($bottom2), render($bottom3)); ?>
<?php if (!empty($banner6)) { echo '<div id="banner6">'.render($banner6).'</div>'; } ?>

    </div>
<footer class="art-footer">
  <div class="art-footer-inner"><?php
$footer = render($footer_message);
if (isset($footer) && !empty($footer) && (trim($footer) != '')) { echo $footer; } // From Drupal structure
elseif (!empty($art_footer) && (trim($art_footer) != '')) { echo $art_footer; } // From Artisteer Content module
else { // HTML from Artisteer preview
ob_start(); ?>

<div class="art-content-layout">
    <div class="art-content-layout-row">
    <div class="art-layout-cell" style="width: 33%">
        <p><a title="RSS" class="art-rss-tag-icon" style="position: absolute; bottom: 13px; left: 6px; line-height: 9px;" href="<?php echo $base_path?>rss.xml"></a></p>
        <div style="position: relative; padding-right: 10px; padding-left: 31px;">
        <p><b><a href="/taxonomy/term/10">ООО АБ-Центр.</a></b>&nbsp;</p>
        <p>У нас <a href="/node/4">Вы можете купить следующие программные продукты на базе 1С предприятия 8:</a>&nbsp;</p>
        <p>         </p>
        <ul>
        <li><a href="/node/20">1С Бухгалтерия для Украины (БУ)</a></li>
        <li><a href="/node/21">1С Управление торговым предприятием (УТП)</a></li>
        <li><a href="/node/21"></a><a href="/node/26">1С Управление производственным предприятием (УПП)</a></li>
        <li><a href="/node/26"></a><a href="/node/24">1С Управление торговлей (УТ)</a></li>
        <li><a href="/node/24"></a>1С Управление небольшой фирмой (УНФ).</li>
        </ul>
        <p>         </p>
        <p><br></p>
        </div>
    </div><div class="art-layout-cell" style="width: 34%">
        <p><b>Поддержка 1С в Днепропетровске:</b>&nbsp;</p>
        <p>         </p>
        <ul>
        <li>внедрение, сопровождение 1С</li>
        <li>обновление 1С, поддержка 1С</li>
        <li>экспорт в МеДок(M.E.Doc) и Бест ЗВИТ</li>
        <li>отчеты,&nbsp;<a href="/%D0%BA%D0%B1">импорт из клиент-банков</a></li>
        <li><a href="/%D0%BA%D0%B1"></a>индивидуальная разработка 1С<br></li>
        </ul>
         <b><br>
         Обучение:</b>&nbsp;
        <p>         </p>
        <p>         </p>
        <ul>
        <li><a href="/node/17">индивидуальные курсы пользователя 1С</a></li>
        <li><a href="/node/96">курсы программирования и администрирования 1С</a><br></li>
        </ul>
        <p>         </p>
        <p><br></p>
        <p><br></p>
        <p style="text-align: center;">Copyright © 2012. All Rights Reserved.<br></p>
    </div><div class="art-layout-cell" style="width: 33%">
        <p><span style="font-family: Tahoma;">Адрес:</span></p>
        <p><span style="font-family: Tahoma;">г. Днепропетровск&nbsp;</span></p>
        <p><span style="font-family: Tahoma;">ул.XXII Партсъезда д.50, 2-й этаж, офис 3</span></p>
         <span style="font-family: Tahoma;"><br>
         тел: <span style="font-weight: bold;">(0562) 35-35-33, 35-05-35</span></span><span style="font-family: Tahoma;"><br></span>
        <p><span style="font-family: Tahoma;">тел.факс <span style="font-weight: bold;">(0562) 35-35-44</span></span></p>
        <br>
    </div>
    </div>
</div>

  <?php
  $footer = str_replace('%YEAR%', date('Y'), ob_get_clean());
  echo art_replace_image_path($footer);
}
?>
<?php if (!empty($copyright)) { echo '<div id="copyright">'.render($copyright).'</div>'; } ?>
</div>
</footer>

</div>


<?php $view->print_closure($vars); ?>
