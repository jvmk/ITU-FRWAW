<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <title><?php wp_title(' | ', true, 'right'); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>"/>
    <?php wp_head(); ?>
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
            <nav>
                <a href="index.html" class="current-page">Home</a>
                <a href="movies.html">Movies</a>
                <a href="blogs.html">Blogs</a>
                <a href="">About</a>
            </nav>
            <form id="form-login">
                <input type="email" name="email" placeholder="E-mail"/>
                <input type="password" name="password" placeholder="Password"/>
                <input type="submit" value="Sign in"/>
            </form>
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