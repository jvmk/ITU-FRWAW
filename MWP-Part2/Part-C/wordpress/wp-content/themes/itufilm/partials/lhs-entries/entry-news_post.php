<?php
/**
 * Created by PhpStorm.
 * User: varmarken
 * Date: 16/04/15
 * Time: 18:11
 */
?>
<article>
    <h1>
        <?php echo get_the_title($post_entry);?>
    </h1>
    <?php
    // Get the url for the image for the news post.
    $imgurl = "";
    if(is_array($post_entry) && isset($post_entry["news_post_img"])) {
        // Specialized wp query.
        // Image media is part of the array.
        // Use function to convert media id to url.
        $imgurl = CCTM::filter($post_entry["news_post_img"], 'to_image_src');
    } else {
        // Regular (main) wp query.
        // Can access src uri through get_custom_field.
        $imgurl = get_custom_field("news_post_img");
    }
    // Now add the image to the html.
    ?>
    <img src="<?php print $imgurl?>">
    <?php echo the_content($post_entry);?>
</article>