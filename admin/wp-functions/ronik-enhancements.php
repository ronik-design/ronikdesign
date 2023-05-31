<?php

// Disable Gutenberg editor for specific post type
function ronikdesigns_prefix_disable_gutenberg($current_status, $post_type)
{
    $f_disable_gutenberg = get_field('disable_gutenberg_posttype', 'option');
    if ($f_disable_gutenberg) {
        foreach ($f_disable_gutenberg as $key => $disable_gutenberg) {
            if ($post_type === $disable_gutenberg) return false;
        }
    }
    return $current_status;
}
add_filter('use_block_editor_for_post_type', 'ronikdesigns_prefix_disable_gutenberg', 10, 2);


// Auto Add parameters for vimeo iframe
function ronikdesigns_auto_add_vimeo_args($provider, $url, $args)
{
    if (strpos($provider, '//vimeo.com/') !== false) {
        $args = array(
            'title' => 0,
            'byline' => 0,
            'portrait' => 0,
            'badge' => 0,
            'sidedock' => 0,
            'controls' => 0,
            'allow' => 'autoplay',
            'muted' => 0,
            'loop' => 1,
        );
        $provider = add_query_arg($args, $provider);
    }
    return $provider;
}
add_filter('oembed_fetch_url', 'ronikdesigns_auto_add_vimeo_args', 10, 3);


// remove heartbeat monitor error
add_filter('ronikdesigns_wpe_heartbeat_allowed_pages', function ($pages) {
    global $pagenow;
    $pages[] =  $pagenow;
    return $pages;
});


// Add class to menu items.
function ronikdesigns_add_menu_link_class($atts, $item, $args)
{
    if (property_exists($args, 'link_class')) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'ronikdesigns_add_menu_link_class', 1, 3);


// Modify Header for page
function ronikdesigns_last_modified_header($headers)
{
    //Check if we are in a single post of any type (archive pages has not modified date)
    if (is_singular() && !is_admin()) {
        $post_id = get_queried_object_id();
        if ($post_id) {
            header("Last-Modified: " . get_the_modified_time("D, d M Y H:i:s", $post_id));
        }
    }
}
add_action('template_redirect', 'ronikdesigns_last_modified_header');


// Enable WP Login Style
function ronikdesigns_wpb_login_logo()
{
    $theme      = wp_get_theme();
    $version    = $theme->get('version');
    $assets_dir = get_stylesheet_directory_uri();
    wp_enqueue_style('ronik-login', $assets_dir . '/admin-scripts/css/wp-admin.css', array(), $version);

?>
    <style type="text/css">
         #login .video, .login .video{
            position: absolute;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }
        #login .video #background-video, .login .video #background-video{
            position: relative;
            width: 150%;
            height: 150%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #login h1 a,
        .login h1 a {
            /* background-image: url(http://path/to/your/custom-logo.png); */
            height: 100px;
            width: 300px;
            background-size: 300px 100px;
            background-repeat: no-repeat;
            padding-bottom: 10px;
        }
        
        /* Lets fix the weird input issue */
        #user_login, #user_pass {
            padding: 0 10px;
            width: calc(100% - 20px);
        }        

        .login .button.wp-hide-pw{
            right: -20px !important;
        }

        #wp-submit{
            padding: 10px;
            border: none;
            background-color: blue;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            opacity: 1;
            transition: all .4s;
        }
        #wp-submit:hover{
            opacity: .5;
        }


    </style>
    <div class="video">
        <iframe id="background-video" src="https://player.vimeo.com/video/391604277?background=1"></iframe>
    </div>
<?php }
add_action('login_enqueue_scripts', 'ronikdesigns_wpb_login_logo');
