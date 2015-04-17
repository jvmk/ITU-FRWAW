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
                'orderby'           => 'event_date',
                'order'             => 'ASC',
                'limit'             => 1
            );
            // Run query.
            $Q = new GetPostsQuery();
            $featured_screenings = $Q->get_posts($featured_screening_query_args);
            foreach ($featured_screenings as $screening): ?>
            #banner {
                background-image: url("<?php print CCTM::filter($screening["banner_img"], 'to_image_src')?>");
            }
            <?php endforeach?>
    </style>
</head>
<body <?php body_class(); ?>>

<div id="top-bar">
    <header class="contentwrapper"> <!-- Begin navigation bar. Use of class constraints width to page width. -->
        <div class="header-lhs">
            <a href="<?php echo esc_url(home_url('/')); ?>" alt="Go to front page"><img src="<?php echo get_template_directory_uri()."/images/logo.png";?>" /></a>
        </div>
        <!-- align the menu links and login to the right edge of the page -->
        <div class="header-rhs">
            <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container' => 'nav', 'container_class' => 'main-menu collapsed')); ?>
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
        // Print the event details in the featured screening banner.
        foreach($featured_screenings as $screening):
        ?>
            <!-- Link that allows the user to click anywhere on the image background. -->
            <a href="<?php echo $screening["permalink"]?>" alt="Screening details"><span></span></a>
            <div id="banner-event">
                <span id="banner-event-title"><?php echo $screening["post_title"];?></span><br/>
                <span id="banner-event-date"><?php echo $screening["event_date"];?></span><br/>
                <span id="banner-event-location"><?php echo $screening["location"]?></span>
            </div>
        <?php endforeach; ?>
    </div> <!-- End promo banner -->
