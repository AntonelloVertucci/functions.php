<?php 

/*
    =============================================
    Call a navigation menu using a shortcode [menu name="MENUNAME"]
    =============================================
*/

add_shortcode('menu', 'print_menu_shortcode');
function print_menu_shortcode($atts, $content = null) {
    extract(shortcode_atts(array( 'name' => null, ), $atts));
    return wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
}


/*
    =============================================
    Add Post Name/Title in Body Class
    =============================================
*/

add_filter('body_class', 'av_class_names');
function av_class_names( $classes ) 
{
    global $post;
    $classes[] = $post->post_name;
    return $classes;
}


/*
    =============================================
    Login error
    =============================================
*/

add_filter('login_errors', 'av_login_errors');
function av_login_errors($error){
    $pos = strpos($error, 'incorrect');
    if (is_int($pos)){
        $error = "Error...";
    }
    return $error;
}


/*
    =============================================
    Remove Wordpress Header Info
    =============================================
*/

add_action('init', 'sam_remove_header_info');
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


?>
