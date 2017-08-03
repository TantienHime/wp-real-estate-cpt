<?php 
/*
 * Display 3 random listings at the top of the page
 */		
 
$args = array(
		'post_type' => 'listings',
		'posts_per_page' => 3,
		'orderby' => 'rand'
	);

$listings = new WP_Query ($args);

echo '<aside id="listings" class="clear">';
while ( $listings->have_posts() ) : $listings->the_post();
    echo '<div class="listing">';
    echo '<figure class="listing-thumb">';
    the_post_thumbnail('medium');
    echo '</figure>';
    echo '<h1 class="entry-title">' . get_the_title() . '</h1>';
    echo '<div class="entry-content">';
    the_content();
    echo '</div>';
    echo '</div>';
endwhile;
echo '</aside>';


wp_reset_query();
 ?>
