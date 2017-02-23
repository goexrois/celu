<?php
// function celu_theme() {
//   $items = array();
//
//   $items['user_login_block'] = array(
//     'render element' => 'form',
//     'path' => drupal_get_path('theme', 'celu') . '/templates',
//     'template' => 'user-login-block',
//     'preprocess functions' => array(
//        'celu_preprocess_user_login_block'
//     ),
//   );
//   $items['user_register_form'] = array(
//     'render element' => 'form',
//     'path' => drupal_get_path('theme', 'celu') . '/templates',
//     'template' => 'user-register-form',
//     'preprocess functions' => array(
//       'celu_preprocess_user_register_form'
//     ),
//   );
//   $items['user_pass'] = array(
//     'render element' => 'form',
//     'path' => drupal_get_path('theme', 'celu') . '/templates',
//     'template' => 'user-pass',
//     'preprocess functions' => array(
//       'celu_preprocess_user_pass'
//     ),
//   );
//   return $items;
// }
//
// function celu_preprocess_user_login_block(&$variables) {
//   $variables['intro_text'] = t('This is my awesome login form');
//   $form['name']['#value'] =   $form['name']['#title'] ;
//   $form['pass']['#value'] =   $form['pass']['#title'] ;
//
// }

function celu_preprocess_html(&$vars) {
  $viewport = array(
  '#tag' => 'meta',
  '#attributes' => array(
    'name' => 'viewport',
    'content' => 'width=device-width, initial-scale=1',
  ),
);

drupal_add_html_head($viewport, 'viewport');

}



function celu_menu_link__navigation($variables)
{
  //$element = &$variables['element'];

  // If there is a image uploaded to the menu item, replace the title with the
  // image.
  if (isset($variables['element']['#localized_options']['content']['image'])) {
    $image = file_load($variables['element']['#localized_options']['content']['image']);
    $image_info = image_get_info($image->uri);

    $image_markup = theme_image(array(
        'path' => $image->uri,
        'width' => $image_info['width'],
        'height' => $image_info['height'],
        'attributes' => array(),
      )
    );

    $variables['element']['#localized_options']['html'] = true;
    //$title = '<span>'.$variables['element']['#title'].'</span>' ;
    $variables['element']['#title'] = $image_markup.$variables['element']['#original_link']['link_title'];


  }

  return theme_menu_link($variables);
}

function celu_breadcrumb($variables) {
  $output = '' ;
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    // Adding the title of the current page to the breadcrumb.
    $breadcrumb[] = drupal_get_title();

    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.

    $output .= '' . implode(' > ', $breadcrumb) . '';
    return $output;
  }
}


function celu_preprocess_page(&$vars) {
  if (isset($vars['main_menu'])) {
    $vars['main_menu'] = theme('links__system_main_menu', array(
      'links' => $vars['main_menu'],
      'attributes' => array(
        'class' => array('links', 'main-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Main menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['main_menu'] = FALSE;
  }
  if (isset($vars['secondary_menu'])) {
    $vars['secondary_menu'] = theme('links__system_secondary_menu', array(
      'links' => $vars['secondary_menu'],
      'attributes' => array(
        'class' => array('links', 'secondary-menu', 'clearfix'),
      ),
      'heading' => array(
        'text' => t('Secondary menu'),
        'level' => 'h2',
        'class' => array('element-invisible'),
      )
    ));
  }
  else {
    $vars['secondary_menu'] = FALSE;
  }
}


/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function celu_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

/**
 * Override or insert variables into the node template.
 */
function celu_preprocess_node(&$variables) {
  $node = $variables['node'];
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
}
?>
