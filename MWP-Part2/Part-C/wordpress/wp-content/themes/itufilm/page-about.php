<?php
/**
 * Created by PhpStorm.
 * User: varmarken
 * Date: 17/04/15
 * Time: 12:16
 */?>
<?php get_header(); ?>
<div class="main-content">
    <section>
        <h1 class="box-header">Organization</h1>
        <article>
            <h1>Student Driven and Free of Charge</h1>
            <img src="<?php echo get_template_directory_uri() . '/images/logo.png';?>">
            <p>
                ITU.film is a student driven organization, <and></and> was formed in 2010.
                All crew members are passionate film enthusiasts.
            </p>
            <p>
                We know that you if you are a student, you are most likely on a tight budget.
                We think that everyone deserves to enjoy the cinema experience, and hence all screening events are free.
                Money should not be an issue if you enjoy watching films!
            </p>
            <p>
                Faculty members are also very welcome to attend the ITU.film screenings!
            </p>
        </article>
    </section>
</div>
<?php

// Now produce the secondary (right hand side) content...
// First build a query for fetching the ITU.film partners.
// (Note the slight difference between the arguments passed to the templates: whereas the LHS content is given a query
// argument, the RHS (below) is given a list of posts, i.e. the result of running a query)
$partners_query_args = array(
    'post_type'			=> 'partner',
    'orderby'           => 'partner_name',
    'order'             => 'ASC',
    'limit'             => 10
);
$partners_query = new GetPostsQuery();
$partners = $partners_query->get_posts($partners_query_args);
$rhs_content_boxes = array(
    array(
        'heading' => 'Partners',
        'items' => $partners
    )
);
// Parse the result to template in charge of printing it.
include(locate_template('partials/rhs-content.php'));
?>

<?php get_footer(); ?>