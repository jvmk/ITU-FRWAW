<?php
/**
 * Handles display of partner information in the rhs content area.
 * User: varmarken
 * Date: 17/04/15
 * Time: 13:21
 */?>

<div class="section-item">
<!--    <div class="thumbnail">-->
<!--        <div class="thumbnail-content-wrapper">-->
<!--            <a href="--><?php //echo $post_entry["partner_url"];?><!--">-->
<!--                <img src="--><?php //print CCTM::filter($post_entry["partner_logo"], 'to_image_src');?><!--" alt="Partner Logo">-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
    <div class="partner-logo-wrapper">
        <img src="<?php print CCTM::filter($post_entry["partner_logo"], 'to_image_src');?>" alt="Partner Logo">
    </div>
    <div class="partner-info-wrapper">
        <a href="<?php echo $post_entry["partner_url"];?>">
            <h4>
                <?php echo $post_entry["partner_name"];?>
            </h4>
        </a>
        <?php echo $post_entry["post_content"];?>
    </div>
    <!--    <div class="details">-->
<!--        <div class="details-content-wrapper">-->
<!--            <a href="--><?php //echo $post_entry["partner_url"];?><!--">-->
<!--                <h4>-->
<!--                    --><?php //echo $post_entry["partner_name"];?>
<!--                </h4>-->
<!--            </a>-->
<!--            --><?php //echo $post_entry["post_content"];?>
<!--        </div>-->
<!--    </div>-->
</div>