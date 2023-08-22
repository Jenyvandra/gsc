<?php

/*LATEST NEW & UPDATES*/

function display_dynamic_posts($atts) {
    $atts = shortcode_atts(array(
        'limit' => 4, // Default limit is 5
    ), $atts);

    ob_start();

    // Query the posts
    $query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => $atts['limit'],
    ));
echo '<marquee direction="up" class="home-marquee">';
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_date = get_the_date('Y-m-d');
            $post_title = get_the_title();
            $post_content = get_the_excerpt();
            ?>
            <ul class="home-latest-posts marquee-container">
                <li class="main-sml-title-blue"><a href="<?php the_permalink(); ?>"><?php echo $post_title; ?></a></li>
                <li class="main-sml-content-dark">
                    Source: <?php echo get_the_excerpt(); ?>&nbsp; |&nbsp;
                    Date: <?php echo $post_date; ?>
                </li>
            </ul>
            <?php
        }
		echo '</marquee>';
        wp_reset_postdata();
    }

    return ob_get_clean();
}
add_shortcode('dynamic_posts', 'display_dynamic_posts');






/*SLIDER SHORT CODE*/

function custom_slider_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => -1, // Default value: display all items
    ), $atts);

    ob_start();
    ?>
    <div id="owl-demo" class="owl-carousel owl-theme">
        <?php
        $slider_posts = get_posts(array(
            'post_type' => 'slider', // Replace 'slider' with the slug of your custom post type
            'posts_per_page' => $atts['limit'], // Retrieve the specified number of slider posts
            'order' => 'ASC'
        ));

        if ($slider_posts) {
            foreach ($slider_posts as $slider_post) {
                $image_url = get_the_post_thumbnail_url($slider_post->ID, 'full');
                ?>
                <div class="item">
                    <img src="<?php echo $image_url; ?>" alt="">
                    
                </div>
                <?php
            }
        }
        ?>
    </div>
    <?php
    $output_string = ob_get_contents();
    ob_end_clean();

    return $output_string;
}

add_shortcode('custom_slider', 'custom_slider_shortcode');


/*Event Gallery*/

function event_gallery_shortcode($atts) {
    ob_start();

    // Parse the attributes
    $atts = shortcode_atts(array(
        'post_type' => 'eventgallery',
        'limit' => -1, // Default to display all posts
    ), $atts);

    // Query the event gallery posts
    $event_gallery_query = new WP_Query(array(
        'post_type' => $atts['post_type'],
        'posts_per_page' => $atts['limit'],
    ));

    // Check if there are any event gallery posts
    if ($event_gallery_query->have_posts()) {
        while ($event_gallery_query->have_posts()) {
            $event_gallery_query->the_post();
            ?>
            <a href="<?php echo the_permalink(); ?>" class="event-gallery-link">
            <div class="bg-blue-gallery-card">
                <div>
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Image">
                </div>
                <div>
                    <h4><?php the_title(); ?></h4>
                    <p><?php echo get_the_date('d/m/Y'); ?></p>
                </div>
            </div>
            </a>
            <?php
        }
    } else {
        echo 'No event galleries found.';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('event_gallery', 'event_gallery_shortcode');

