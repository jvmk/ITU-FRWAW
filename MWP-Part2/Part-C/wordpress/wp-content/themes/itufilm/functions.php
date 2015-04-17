<?php

add_action( 'pre_get_posts', 'setup_main_query' );
/**
 * Alters the main query to fetch specific posts types for specific pages.
 * @param $query the current wp query
 */
function setup_main_query( $query ) {

    if( is_front_page() && $query->is_main_query() ) {
        // Update the default query for the front page to fetch news posts instead of standard WP posts.
        $query->query_vars['post_type'] = 'news_post';
    }
}

// Enqueue stylesheets
add_action('wp_enqueue_scripts', 'load_styles');
function load_styles() {
    // enqueue general styles (applies to all pages)
    wp_enqueue_style( 'general', get_template_directory_uri()."/css/general.css" );
    // enqueue page specific styles
    if (is_front_page()) {
        // index / home page styles
        wp_enqueue_style('index', get_template_directory_uri()."/css/index.css");
    }
    if (is_page('movies')) {
        // movies page styles
        wp_enqueue_style('movies', get_template_directory_uri()."/css/movies.css");
    }
}

add_action('after_setup_theme', 'itufilm_setup');
function itufilm_setup()
{
    load_theme_textdomain('itufilm', get_template_directory() . '/languages');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    global $content_width;
    if (!isset($content_width)) $content_width = 640;
    register_nav_menus(
        array('main-menu' => __('Main Menu', 'itufilm'))
    );
}

add_action('wp_enqueue_scripts', 'itufilm_load_scripts');
function itufilm_load_scripts()
{
    wp_enqueue_script('jquery');
}

add_action('comment_form_before', 'itufilm_enqueue_comment_reply_script');
function itufilm_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_filter('the_title', 'itufilm_title');
function itufilm_title($title)
{
    if ($title == '') {
        return '&rarr;';
    } else {
        return $title;
    }
}

add_filter('wp_title', 'itufilm_filter_wp_title');
function itufilm_filter_wp_title($title)
{
    return $title . esc_attr(get_bloginfo('name'));
}

add_action('widgets_init', 'itufilm_widgets_init');
function itufilm_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar Widget Area', 'itufilm'),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</li>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

function itufilm_custom_pings($comment)
{
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}

add_filter('get_comments_number', 'itufilm_comments_number');
function itufilm_comments_number($count)
{
    if (!is_admin()) {
        global $id;
        $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}