<?php
/**
 * Created by PhpStorm.
 * User: varmarken
 * Date: 16/04/15
 * Time: 12:15
 */
?>
<div class="main-content">
    <?php
    // Createa a content box for each heading.
    foreach($main_content_left_boxes as $box):
    ?>
        <section>
            <h1 class="box-header">
                <?php
                // Lookup the heading value.
                echo($box["heading"]);
                ?>
            </h1>

        <?php
        // Lookup (by key) wp query containing the posts to display in this section.
        $query = $box["posts"];
        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
            <?php
            // What kind of post is this?
            $post_type = get_post_type($query->post);
            // Find proper entry file from post type.
            $filename = "entry-" . $post_type . ".php";
            $full_path = get_template_directory() . "/partials/lhs-entries/" . $filename;
            // Expose variable containing current post to included scripts.
            $post_entry = $query->post;
            if (file_exists($full_path)) {
                // Designated file containing markup for this kind of entry (post)
                include(locate_template('partials/lhs-entries/'.$filename));
            } else {
                // No designated file, resort to default post display.
                include(locate_template('partials/lhs-entries/entry.php'));
            }
            ?>
        <?php endwhile; endif;?>

        </section>

    <?php endforeach;?>
</div>