<?php
/**
 * Renders a movie blog post entry on the blogs page.
 * User: varmarken
 * Date: 17/04/15
 * Time: 19:06
 */
?>

<article>
    <h1>
        <?php
        // Get the permalink for this news_post.
        $post_entry_permalink = "";
        $is_main_qry = false;
        if(is_array($post_entry)) {
            // CCTM query item.
            // Must use filter.
            $post_entry_permalink = CCTM::filter($post_entry["ID"], 'to_link_href');
        } else {
            // Main loop query item.
            $is_main_qry = true; // for use later on (avoid repeated is_array checks).
            // Simply get permalink from current item.
            $post_entry_permalink = get_post_permalink();
        }
        ?>
        <a href="<?php echo $post_entry_permalink;?>"><?php echo get_the_title($post_entry);?></a>
    </h1>
    <div class="author-block">
        <div class="author-profile-picture">
            <img src="
            <?php
            // As of now there is no profile picture connected to a user.
            // Use dummy placeholder picture.
            echo get_template_directory_uri() . '/images/default-profile-pic.png';
            ?>" alt="Profile picture"/>
        </div>
        <div class="author-data">
            <ul>
                <li><span>
                        Author:
                    </span>
                <?php
                $usrname = "";
                $usr_profile_url = "";
                if ($is_main_qry) {
                    print get_the_author_link();
                } elseif (isset($post_entry['post_author'])) {
                    // TODO this requires a require on the author id apparently (to get the other website).
                }
                ?>
                </li>
                <li>
                    <?php

                    $first_name = "";
                    if($is_main_qry) {
                        $first_name = get_the_author_meta('first_name', get_the_author_ID());
                    } else {
                        $first_name = get_the_author_meta('first_name', $post_entry["post_author"]);
                    }
                    ?>
                    <span>First name: </span><?php print $first_name; ?>
                </li>
                <li>
                    <?php

                    $last_name = "";
                    if($is_main_qry) {
                        $last_name = get_the_author_meta('last_name', get_the_author_ID());
                    } else {
                        $last_name = get_the_author_meta('last_name', $post_entry["post_author"]);
                    }
                    ?>
                    <span>Last name: </span><?php echo $last_name; ?>
                </li>
                <li>
                    <span>Bio: </span>
                    <?php

                    $description = "";
                    if($is_main_qry) {
                        $description = get_the_author_meta('description', get_the_author_ID());
                    } else {
                        $description = get_the_author_meta('description', $post_entry["post_author"]);
                    }
                    ?>
                    <q><?php echo $description;?></q>
                </li>
            </ul>
        </div>

    </div>
    <?php echo the_content($post_entry);?>
</article>