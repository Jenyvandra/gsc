<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage GSC BANK
 * @since GSC BANK 1.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-preview other-news-detail' ); ?>>

	<img src="<?php echo get_the_post_thumbnail_url(); ?>">
	<div class="other-newa-description"><?php
		$the_content = get_the_content();
		$the_content = strip_shortcodes( $the_content );
        ?><h2><?php the_title(); ?></h2><?php 
        	echo wpautop( wp_trim_words( $the_content, 20, '...' ) );  
    	?><a href="<?php the_permalink(); ?>" class="text-g"><?php _e('Read more','dsc'); ?></a>
    </div><?php
	
	?>
</article><!--.entry-preview-->
