<?php
/**
 * Outputs the single post content. Displayed by single.php.
 *
 * @package Simone
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
    if (has_post_thumbnail()) {
        echo '<div class="single-post-thumbnail clear">';
        echo '<div class="image-shifter">';
        the_post_thumbnail();
        echo '</div>';
        echo '</div>';
    }
    ?>

	<header class="entry-header clear">

            <?php
                /* translators: used between list items, there is a space after the comma */
                $category_list = get_the_category_list( __( ', ', 'simone' ) );

                if ( simone_categorized_blog() ) {
                    echo '<div class="category-list">' . $category_list . '</div>';
                }
            ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
                    <?php simone_posted_on(); ?>
                    <?php
                    if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
                        echo '<span class="comments-link">';
                        comments_popup_link( __( 'Leave a comment', 'simone' ), __( '1 Comment', 'simone' ), __( '% Comments', 'simone' ) );
                        echo '</span>';
                    }
                    ?>
                    <?php edit_post_link( __( 'Edit', 'simone' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>
        <?php 
                if(get_field('info_box_content')){
                    echo '<div class="info-box">';
                        echo '<h1>' . get_field('info_box_title') . '</h1>';
                        the_field('info_box_content');
                    echo '</div>';
                }
                
         ?>

        <?php 
            $posts = get_field ('related_posts');

            if ($posts) {
                echo '<h1>Further Reading</h1>';
                echo '<ul class="related-list">';
                foreach ($posts as $post ) :
                        setup_postdata( $post );
                    echo '<li><a href="' . get_the_permalink() . '">';
                    echo '<h3>' . get_the_title() . '</h3>';
                    the_excerpt();
                    echo '</a></li>';
                endforeach;
                echo '</ul>';
                wp_reset_postdata();
            }
         ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'simone' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			echo get_the_tag_list( '<ul><li><i class="fa fa-tag"></i>', '</li><li><i class="fa fa-tag"></i>', '</li></ul>' );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
