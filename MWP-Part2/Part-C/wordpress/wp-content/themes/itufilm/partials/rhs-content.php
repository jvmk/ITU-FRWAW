<?php
/**
 * Created by PhpStorm.
 * User: varmarken
 * Date: 16/04/15
 * Time: 23:51
 */
?>
<div class="sidebar">
    <?php
    // Createa a content box for each heading.
    foreach($rhs_content_boxes as $box):
        ?>
        <section>
            <h1 class="box-header">
                <?php
                // Lookup the heading value.
                echo($box["heading"]);
                ?>
            </h1>

            <?php
            // Lookup (by key) the posts to display in this section/under this heading.
            $items = $box["items"];
            foreach($items as $item): ?>

                <?php
                // What kind of post is this?
                $post_type = $item["post_type"];
                // Find proper entry file from post type.
                $filename = "entry-" . $post_type . ".php";
                $full_path = get_template_directory() . "/partials/rhs-entries/" . $filename;
                // Expose variable containing current post to included scripts.
                $post_entry = $item;
                if (file_exists($full_path)) {
                    // Designated file containing markup for this kind of entry (post)
                    include(locate_template('partials/rhs-entries/'.$filename));
                } else {
                    // No designated file, resort to default post display.
                    include(locate_template('partials/rhs-entries/entry.php'));
                }
                ?>

            <?php endforeach;?>

        </section>

    <?php endforeach;?>
</div>