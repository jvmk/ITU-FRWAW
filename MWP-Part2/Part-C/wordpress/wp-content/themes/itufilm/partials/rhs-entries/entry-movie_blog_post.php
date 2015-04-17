<?php
/**
 * Handles display of a movie blog entry in the sidebar.
 * User: varmarken
 * Date: 17/04/15
 * Time: 20:12
 */
?>
<div class="section-item">
    <div class="thumbnail">
        <div class="thumbnail-content-wrapper">
            <img src="
            <?php
            // Use default profile picture as we do not yet support uploading custom profile pictures.
            echo get_template_directory_uri() . '/images/default-profile-pic.png';
            ?>"
                 alt="Movie Poster">
            <a href="<?php get_the_author_meta('user_url', $post_entry["post_author"]);?>">

                <?php echo get_the_author_meta('display_name', $post_entry["post_author"]) ?>
            </a>


        </div>
    </div>
    <div class="details">
        <div class="details-content-wrapper">
            <a href="<?php print CCTM::filter($post_entry["ID"], 'to_link_href');?>">
                <h4>
                    <?php echo $post_entry["post_title"];?>
                </h4>
            </a>
            <?php
            echo wp_trim_words($post_entry["post_content"], 30, ' [...]');
            ?>
        </div>
    </div>
</div>