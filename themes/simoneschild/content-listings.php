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

		<h1 class="entry-title"><?php the_title(); ?></h1>
        

            <?php
                /* translators: used between list items, there is a space after the comma */
                $category_list = get_the_category_list( __( ', ', 'simone' ) );

                //if ( simone_categorized_blog() ) {
                    echo '<div class="category-list">' . $category_list . '</div>';
                //}
            ?>
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
            <div class="taxonomies">
                <div class="listings">
                <?php echo get_the_term_list( $post -> ID, 'listing-type', 'Type of Listing: ', ', ', '' ); ?>
                </div>
                <div class="features">
                <?php echo get_the_term_list( $post -> ID, 'features', 'Features: ', ', ', '' ); ?>
                </div>
                <div class="ownership">
                <?php echo get_the_term_list( $post -> ID, 'ownership', 'Type of Ownership: ', ', ', '' ); ?>
                </div>
            </div>
                <?php 
                    if(get_field('municipal_address')){
                        echo '<div class="real-estate">';
                        echo '<h2> Municipal Address: ' . get_field('municipal_address') . '</h2>';
                        echo '</div>';
                    }
                 ?>
                 <?php 
                    if(get_field('municipality')){
                        echo '<div class="real-estate">';
                        echo '<h2>' . get_field('municipality') . '</h2>';
                        echo '</div>';
                    }
                 ?>           

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
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
