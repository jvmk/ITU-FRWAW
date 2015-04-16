<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <title><?php wp_title(' | ', true, 'right'); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>"/>
    <?php wp_head(); ?>
    <style type="text/css">
        /* Background image is added dynamically. */
        /* Hence it cannot be set in stylesheets and must be added here using php. */
        <?php
            // Query args for fetching the featured screening.
            $featured_screening_query_args = array(
                'post_type'			=> 'screening',
                'posts_per_page'	=> 1,
                'meta_key'			=> 'event_date',
                'orderby'			=> 'meta_value',
                'order'				=> 'ASC'
            );
            // Get featured screening.
            $posts = get_posts($featured_screening_query_args);
            foreach($posts as $post): ?>
        #banner {
            background-image: url("<?php echo get_custom_field('banner_img');?>");
        }
        <?php endforeach; ?>
    </style>
</head>
<body <?php body_class(); ?>>
<!--<div id="wrapper" class="hfeed">-->
<!--    <header id="header" role="banner">-->
<!--        <section id="branding">-->
<!--            <div id="site-title">--><?php //if (!is_singular()) {
//                    echo '<h1>';
//                } ?><!--<a href="--><?php //echo esc_url(home_url('/')); ?><!--"-->
<!--                       title="--><?php //esc_attr_e(get_bloginfo('name'), 'itufilm'); ?><!--"-->
<!--                       rel="home">--><?php //echo esc_html(get_bloginfo('name')); ?><!--</a>--><?php //if (!is_singular()) {
//                    echo '</h1>';
//                } ?><!--</div>-->
<!--            <div id="site-description">--><?php //bloginfo('description'); ?><!--</div>-->
<!--        </section>-->
<!--        <nav id="menu" role="navigation">-->
<!--            <div id="search">-->
<!--                --><?php //get_search_form(); ?>
<!--            </div>-->
<!--            --><?php //wp_nav_menu(array('theme_location' => 'main-menu')); ?>
<!--        </nav>-->
<!--    </header>-->
<!--    <div id="container">-->

<div id="top-bar">
    <header class="contentwrapper"> <!-- Begin navigation bar. Use of class constraints width to page width. -->
        <div class="header-lhs">
            <a href="<?php echo esc_url(home_url('/')); ?>" alt="Go to front page"><img src="<?php echo get_template_directory_uri()."/images/logo.png";?>" /></a>
        </div>
        <!-- align the menu links and login to the right edge of the page -->
        <div class="header-rhs">
            <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container' => 'nav', 'container_class' => 'main-menu')); ?>
<!--            <nav>-->
<!--                <a href="index.html" class="current-page">Home</a>-->
<!--                <a href="movies.html">Movies</a>-->
<!--                <a href="blogs.html">Blogs</a>-->
<!--                <a href="">About</a>-->
<!--            </nav>-->
<!--            <form id="form-login">-->
<!--                <input type="email" name="email" placeholder="E-mail"/>-->
<!--                <input type="password" name="password" placeholder="Password"/>-->
<!--                <input type="submit" value="Sign in"/>-->
<!--            </form>-->
        </div>
        <div class="header-rhs-collapse">
            <div id="btn-menu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
        </div>
    </header> <!-- End navigation bar -->
</div>

<div id="content" class="contentwrapper">

    <div id="banner"> <!-- Begin promo banner -->
        <?php
        // Rerun featured screening query for safe measures (avoid errors from overwriting posts variable).
        $posts = get_posts($featured_screening_query_args);
        foreach($posts as $post):
        ?>
            <!-- Link that allows the user to click anywhere on the image background. -->
            <a href="<?php echo get_permalink($post)?>" alt="Screening details"><span></span></a>
            <div id="banner-event">
                <span id="banner-event-title"><?php echo get_post_field('post_title', $post);?></span><br/>
                <span id="banner-event-date"><?php echo get_custom_field('event_date');?></span><br/>
                <span id="banner-event-location"><?php echo get_custom_field('location')?></span>
            </div>
        <?php endforeach; ?>
    </div> <!-- End promo banner -->