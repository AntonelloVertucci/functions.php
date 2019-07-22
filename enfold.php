<?php 

// Remove Avia Framework debug information 
if(!function_exists('avia_debugging_info')){
  function avia_debugging_info() {}
}

// Remove the Import Dummy Data button (Demo)
add_theme_support('avia_disable_dummy_import');

// Backend Style 
add_action('admin_head', 'my_custom_enfold');
function my_custom_enfold() {
  echo '<style>
    #pr-logo{display:none}
    .avia_options_page_sidebar .avia_header{background-size:60px; background-position:center; background-image: url('. get_stylesheet_directory_uri() .'/img/n-logo.png); background-repeat:no-repeat}
    } 
  </style>';
}

// Shortcode Display Breadcrump 
function nm_breadcrump_func( $atts ){
    global $avia_config;
    return avia_breadcrumbs(array('separator' => '/', 'before' => 'Sie befinden sich hier', 'richsnippet' => true));
}
add_shortcode( 'nm_breadcrump', 'nm_breadcrump_func' );

// Breadcrump remove Trail before
add_filter('avia_breadcrumbs_args', 'remove_trail_before', 50, 1);
function remove_trail_before($args){
    $args['before'] = '';
    return $args;
}

// Replace Portfolio name in menu admin
add_filter('avf_portfolio_cpt_args', 'avf_portfolio_cpt_args_mod');
function avf_portfolio_cpt_args_mod($args) {
    $args['labels']['name'] = 'Produkte';
    return $args;
}

// Modify/Overwrite Enfold shortcode
add_filter('avia_load_shortcodes', 'avia_include_shortcode_template', 15, 1);
function avia_include_shortcode_template($paths)
{
    $template_url = get_stylesheet_directory();
        array_unshift($paths, $template_url.'/shortcodes/');

    return $paths;
}

// Remove time from the enfold latest news widget
add_filter('avia_widget_time', 'change_avia_date_format', 10, 2);
function change_avia_date_format($date, $function) {
  $output = get_option('date_format');
  return $output;
}

// Disable Portfolio 
add_action('after_setup_theme', 'remove_portfolio');
function remove_portfolio() {
    remove_action('init', 'portfolio_register');
}

?>
