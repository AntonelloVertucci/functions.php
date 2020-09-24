<?php 

/*
    =============================================
    Backend Footer
    =============================================
*/
function my_footer_admin_left (){
echo '
    <small>Antonello Vertucci | Webdesign</small> |  
    <small style="color:red">PHP '.PHP_VERSION.'</small> |  
    <small style="color:blue;">WP '.get_bloginfo( "version" ).'</small>
    ';
}
add_filter('admin_footer_text', 'my_footer_admin_left');

/*
    =============================================
    Hide Updates notification in WP Backend
    =============================================
*/
function nm_backend_css() {
  echo '<style>
        .update-nag,
        .update-plugins{display: none !important}
        </style>';
}
add_action('admin_head', 'nm_backend_css');


/*
    =============================================
    Disable XML-RPC
    =============================================
*/
add_filter('xmlrpc_enabled', '__return_false');


/*
    =============================================
    Call a navigation menu using a shortcode [menu name="MENUNAME"]
    =============================================
*/
function print_menu_shortcode($atts, $content = null){
    extract(shortcode_atts(array( 'name' => null, ), $atts));
    return wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
}
add_shortcode('menu', 'print_menu_shortcode');


/*
    =============================================
    Add Post Name/Title in Body Class
    =============================================
*/
function av_class_names( $classes ){
    if ( !is_404() ){
        global $post;
        $classes[] = $post->post_name;
        return $classes;
    }else return $classes;
}
add_filter('body_class', 'av_class_names');


/*
    =============================================
    Login error
    =============================================
*/
function av_login_errors($error){
    $pos = strpos($error, 'incorrect');
    if (is_int($pos)){
        $error = "Error...";
    }
    return $error;
}
add_filter('login_errors', 'av_login_errors');


/*
    =============================================
    Remove Wordpress Header Info
    =============================================
*/
function sam_remove_header_info(){ 
    remove_action('wp_head', 'feed_links_extra', 3); 
    remove_action('wp_head', 'rsd_link'); 
    remove_action('wp_head', 'wlwmanifest_link'); 
    remove_action('wp_head', 'wp_generator'); 
    remove_action('wp_head', 'start_post_rel_link'); 
    remove_action('wp_head', 'index_rel_link'); 
    remove_action('wp_head', 'parent_post_rel_link', 10, 0); 
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head',10,0); 
} 
add_action('init', 'sam_remove_header_info');


/*
    =============================================
    Remove 'noreferrer' from target blank links
    =============================================
*/
function custom_wp_targeted_link_rel($rel_values){
    return 'noopener';
}
add_filter('wp_targeted_link_rel', 'custom_wp_targeted_link_rel',999);


/*
    =============================================
    Hide update notifications
    =============================================
*/
function remove_core_updates(){
	global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','remove_core_updates'); //hide updates for WordPress itself
add_filter('pre_site_transient_update_plugins','remove_core_updates'); //hide updates for all plugins
add_filter('pre_site_transient_update_themes','remove_core_updates'); //hide updates for all themes
