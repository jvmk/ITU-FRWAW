<?php
/**
 * Handles display of screening information in rhs content area.
 * User: varmarken
 * Date: 17/04/15
 * Time: 00:58
 */
?>
<div class="section-item">
    <div class="thumbnail">
        <div class="thumbnail-content-wrapper">
            <img src="<?php print CCTM::filter($post_entry["movie_poster"], 'to_image_src');?>" alt="Movie Poster">
        </div>
    </div>
    <div class="details">
        <div class="details-content-wrapper">
            <a href="<?php print CCTM::filter($post_entry["ID"], 'to_link_href');?>">
                <h4>
                    <?php echo $post_entry["post_title"];?>
                </h4>
            </a>
            <ul>
                <li>
                    <span>Date and time:</span>
                    <?php echo $post_entry["event_date"]?>,
                    <?php echo $post_entry["time"]?>
                </li>
                <li>
                    <span>Location:</span>
                    <?php echo $post_entry["location"]?>
                </li>

            </ul>
            <?php echo $post_entry["summary"];?>
        </div>
    </div>
</div>