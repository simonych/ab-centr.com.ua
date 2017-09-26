<?php

function art_content_form_submit($form, &$form_state) {
  $value = $form_state['values']['import_content'];
  variable_set('import_content', $value);
  art_content_clear_previous_import();
  art_content_apply();
  drupal_set_message(t('Import is complete'));
}

function art_vertical_menu_title_process() {
  $parser = art_get_content_parser();
  $sidebars_info = $parser->get_sidebars();
  if ( ! isset( $sidebars_info ) ) {
    return;
  }

  foreach ( $sidebars_info as $sidebar ) {
    foreach ( $sidebar['blocks'] as $block ) {
      if (strpos($block['name'], 'vmenu') !== false) { //proccess VMenu
        return $block['title'];
      }
    }
  }

  return t('Vertical menu');
}

function art_insert_header_footer() {
  $title_exists = false;
  if ($title_exists) {
  $site_name = <<<EOT
null
EOT;
  variable_set('site_name', $site_name);
  }
  $slogan_exists = false;
  if ($slogan_exists) {
  $site_slogan = <<<EOT
null
EOT;
  variable_set('site_slogan', $site_slogan);
  }
  $footer_exists = true;
  $base_path = base_path().'rss.xml';
  if ($footer_exists) {
  $footer = <<<EOT

<a title="RSS" class="art-rss-tag-icon" style="position: absolute; bottom: 13px; left: 6px; line-height: 9px;" href="$base_path"></a>
<div style="position:relative;padding-left:31px;padding-right:10px">
<p><b><a href="/taxonomy/term/10">ООО АБ-Центр.</a></b> У нас <a href="/node/4">Вы можете купить следующие программные продукты на базе 1С предприятия 8:</a> <a href="/node/20">1С Бухгалтерия для Украины (БУ)</a>, <a href="/node/21">1С Управление торговым предприятием (УТП)</a>, <a href="/node/26">1С Управление производственным предприятием (УПП)</a>, <a href="/node/24">1С Управление торговлей (УТ)</a>, 1С Управление небольшой фирмой (УНФ).<br>
<b>Поддержка 1С в Днепропетровске:</b> внедрение, сопровождение 1С, обновление 1С, поддержка 1С, экспорт в МеДок(M.E.Doc) и Бест ЗВИТ, отчеты, <a href="/%D0%BA%D0%B1">импорт из клиент-банков</a>, индивидуальная разработка 1С<br>
<b>Обучение:</b> <a href="/node/17">Индивидуальные курсы пользователя 1С</a>, <a href="/node/96">курсы программирования и администрирования 1С</a></p>
<a href="/node/20" title="1С Бухгалтерия для Украины (БУ)"><br></a>
<p>Copyright © 2012. All Rights Reserved.</p>
</div>

EOT;
  $parser = art_get_content_parser();
  $pages_path = art_get_pages_path($parser);
  variable_set('art_footer', art_modify_content_paths($footer, $pages_path));
  }
}
function art_process_sidebars($parser) {
  $sidebars_info = $parser->get_sidebars();
  if ( ! isset( $sidebars_info ) ) {
    return;
  }

  $pages_path = art_get_pages_path($parser);

  $blocks = array();
  $blocks_head = '';
  foreach ( $sidebars_info as $sidebar ) {
      $region_name = $sidebar['name'] == 'sidebar1' ? 'left' : 'right';
      $sidebar_name = 'sidebar_'.$region_name;
      foreach ( $sidebar['blocks'] as $block ) {
          $content = isset($block['content']) ? $block['content'] : 'New block content';
          $drupal_region = $sidebar_name;
          if (strpos($block['name'], 'vmenu') !== false) //proccess VMenu
            continue;

          $content = art_modify_content_paths($block['content'], $pages_path);
          $blocks[$block['name']] = array(
            'name' => $block['name'],
            'info' => $block['title'],
            'subject' => $block['title'],
            'status' => 1,
            'region' => $drupal_region,
            'weight' => 0,
            'visibility' => BLOCK_VISIBILITY_NOTLISTED,
            'content' => $content,
            'cache' => DRUPAL_NO_CACHE,
          );
          if (isset($block['head'])) {
            $blocks_head .= $block['head'];
          }
      }
  }

  variable_set('blocks_head', $blocks_head);
  return $blocks;
}

function art_content_apply() {
  art_insert_header_footer();

  $parser = art_get_content_parser();
  $pages_info = $parser->get_pages();
  $posts_info = $parser->get_posts();
  $pages_path = art_get_pages_path($parser);
  $posts_nid = art_insert_posts('article', $posts_info, $pages_path);
  $pages_nid = art_insert_posts('page', $pages_info, $pages_path, $posts_nid);
  variable_set('art_node_nids', array_merge($posts_nid, $pages_nid));
}

function art_comment_link($nid) {
  global $user;
  if ($user->uid && user_access('post comments')) {
    return t('<a href="comment/reply/'.$nid.'" title="'.t('Add a new comment to this page.').'">Add new comment</a>');
  }
  if (variable_get('user_register', USER_REGISTER_VISITORS_ADMINISTRATIVE_APPROVAL)) {
    // Users can register themselves.
    return t('<a href="@login">Log in</a> or <a href="@register">register</a> to post comments', array('@login' => url('user/login', array('query' => $destination)), '@register' => url('user/register', array('query' => $destination))));
  }
  // Only admins can add new users, no public registration.
  return t('<a href="@login">Log in</a> to post comments', array('@login' => url('user/login', array('query' => $destination))));
}

/**
 * hook_preprocess allows node_style to override default variables.
 *
 * @param Array $variables
 *   The variables available for overriding.
 * @param String $hook
 *   The section of a Drupal page that the variables might belong to. This can
 *   be page, block, node etc.
 * @return string
 */
function art_content_preprocess(&$variables, $hook) {
  art_content_return_vars($variables, $hook);
}

/**
 * Returns a PHPTemplate variables array based on $hook. Called from node_style.inc.
 *
 * @see _phptemplate_variables
 */
function art_content_return_vars(&$variables, $hook) {
  $art_styles = variable_get('art_styles', NULL);
  $art_head = variable_get('art_head', NULL);
  if ($hook == 'page') {
    if (isset($art_styles)) {
      foreach ($art_styles as $node_id => $art_style) {
        $variables['art_style_'.$node_id] = "\n<style>\n".art_replace_image_sources($art_style)."\n</style>\n";
      }
    }
    if (isset($art_head)) {
      foreach ($art_head as $node_id => $head) {
        $variables['art_head_'.$node_id] = "\n".art_replace_image_sources($head)."\n";
      }
    }
  }
  $variables['art_blocks_head'] = art_replace_image_sources(variable_get('blocks_head', NULL));
  $variables['art_footer'] = variable_get('art_footer', NULL);
  return $variables;
}