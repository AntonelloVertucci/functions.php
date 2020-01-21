<?php 

/* Debug modus */
function builder_set_debug(){
  return "debug";
}
add_action('avia_builder_mode', "builder_set_debug");

/* Remove Avia Framework debug information */
if(!function_exists('avia_debugging_info')){
  function avia_debugging_info() {}
}

/* Remove the Import Dummy Data button (Demo) */
add_theme_support('avia_disable_dummy_import');

/* Backend Style */
function my_custom_enfold(){
  echo '<style>
    #pr-logo{display:none}
    .avia_options_page_sidebar .avia_header{background-size:60px; background-position:center; background-image: url('. get_stylesheet_directory_uri() .'/img/n-logo.png); background-repeat:no-repeat}
    } 
  </style>';
}
add_action('admin_head', 'my_custom_enfold');

/* Shortcode Display Breadcrump */
function nm_breadcrump_func( $atts ){
    global $avia_config;
    return avia_breadcrumbs(array('separator' => '/', 'before' => 'Sie befinden sich hier', 'richsnippet' => true));
}
add_shortcode( 'nm_breadcrump', 'nm_breadcrump_func' );

/* Breadcrump remove Trail before */
function remove_trail_before($args){
    $args['before'] = '';
    return $args;
}
add_filter('avia_breadcrumbs_args', 'remove_trail_before', 50, 1);

/* Replace Portfolio name in menu admin */
function avf_portfolio_cpt_args_mod($args){
    $args['labels']['name'] = 'Produkte';
    return $args;
}
add_filter('avf_portfolio_cpt_args', 'avf_portfolio_cpt_args_mod');

/* Modify/Overwrite Enfold shortcode */
function avia_include_shortcode_template($paths){
    $template_url = get_stylesheet_directory();
    array_unshift($paths, $template_url.'/shortcodes/');
    return $paths;
}
add_filter('avia_load_shortcodes', 'avia_include_shortcode_template', 15, 1);

/* Remove time from the enfold latest news widget */
function change_avia_date_format($date, $function){
  $output = get_option('date_format');
  return $output;
}
add_filter('avia_widget_time', 'change_avia_date_format', 10, 2);

/* Disable Portfolio */
function remove_portfolio(){
    remove_action('init', 'portfolio_register');
}
add_action('after_setup_theme', 'remove_portfolio');

/* Disable Enfold Image generation */
function ava_image_sizes(){ 
    remove_image_size('masonry');
    remove_image_size('magazine');
    remove_image_size('widget');
    remove_image_size('featured');
    remove_image_size('featured_large');
    remove_image_size('extra_large');
    remove_image_size('portfolio_small');
    remove_image_size('gallery');
    remove_image_size('entry_with_sidebar');
    remove_image_size('entry_without_sidebar');
    remove_image_size('square');
}
add_action( 'after_setup_theme', 'ava_image_sizes', 11 );


