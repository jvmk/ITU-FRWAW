<?php
/**
 * Handles display of screening information in LHS content area.
 * User: varmarken
 * Date: 17/04/15
 * Time: 02:54
 */
?>
<div class="screening-info">
    <?php
    // Get movie poster URL.
    $imgurl = "";
    $regular = false;
    if(is_array($post_entry) && isset($post_entry["movie_poster"])) {
        // Specialized wp query.
        // Image media is part of the array.
        // Use function to convert media id to url.
        $imgurl = CCTM::filter($post_entry["movie_poster"], 'to_image_src');
    } else {
        // Regular (main) wp query.
        // Can access src uri through get_custom_field.
        $regular = true; // for use later on.
        $imgurl = get_custom_field("movie_poster");
    }
    ?>
    <img src="<?php echo $imgurl;?>"
         class="poster"
         alt="Movie Poster">
    <a href="
    <?php
    if($regular) {
        echo get_post_permalink();
    } else {
        print CCTM::filter($post_entry["ID"], 'to_link_href');
    }?>
        ">
        <h1><?php echo get_the_title($post_entry);?></h1>
    </a>
    <ul class="time-and-place-listing">
        <li>
            <span>When:</span>
            <?php echo $regular ? get_custom_field('event_date:datef', 'Y-m-d') : $post_entry["event_date"];?>,
            <?php echo $regular ? get_custom_field("time") : $post_entry["time"];?>
        </li>
        <li>
            <span>Where:</span>
            <?php echo $regular ? get_custom_field("location") : $post_entry["location"];?>
        </li>
    </ul>
    <span class="crew-comment">
        <?php echo $regular ? get_custom_field("crew_comment") : $post_entry["crew_comment"];?>
    </span>
        <?php echo $regular ? get_custom_field("summary") : $post_entry["summary"];?>
</div>