<?php
/**
 * Main template file
 *
 * @package WordPress
 * @subpackage GSC BANK
 * @since GSC BANK 1.0
 */

get_header(); ?>
<div class="news-section container">
	<div class="news-category-section">
		<div class="news-category">
			<div class="news-category-left">
				<?php echo do_shortcode("[qc_category_nav ids='42, 43, 44, 45, 46, 47, 48']"); ?>
			</div>
			<div class="news-category-right">
                <ul class="news-nav">
                    <li class="nav-items"><a href=""><i class="fa-brands fa-twitter"></i></a></li>
                    <li class="nav-items"><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li class="nav-items"><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    <li class="nav-items"><a href=""><i class="fa-brands fa-youtube"></i></a></li>
                </ul>
            </div>
        </div><?php
        $top_posts = get_posts(array(
        	'post_status' => 'publish',
        	'numberposts' => 5
        ));

        $first_top_post = array_shift($top_posts);
        ?><div class="news-area">
        	<div class="news-area-left">
        		<img src="<?php echo get_the_post_thumbnail_url($first_top_post->ID); ?>" />
        		<div class="news-headline">
                    <h2><?php echo esc_html(get_the_title($first_top_post)); ?></h2>
                    <div class="news-share">
                        <span><i class="fa-solid fa-share-nodes"></i><?php echo do_shortcode('[Sassy_Social_Share]') ; ?></span>
                    </div>
                </div>
        	</div>
        	<div class="news-area-right"><?php
        	foreach ($top_posts as $key => $t_post) {
        			?><div class="right-news-section">
                        <img src="<?php echo get_the_post_thumbnail_url($first_top_post->ID); ?>" />
		        		<div class="news-headline">
		                    <h2><?php echo esc_html(get_the_title($first_top_post)); ?></h2>
		                </div>
                    </div><?php
        		}	
        	?></div>
        </div>
    </div>
    <div class="popular-news-section">
    	<div class="popular-news-left">
    		<div class="news-category">
				<div class="news-category-right">
					<h2 class="small-underline-header-txt main-title-blue"><?php _e('Popular news', 'gsc'); ?></h2>
				</div>
				<div class="news-category-left">
					<?php echo do_shortcode("[qc_category_nav ids='42, 43, 44, 45, 46, 47, 48']"); ?>
						
				</div>
	        </div>
	        <div class="news-areas"><?php
	    		$args = array(
				    'post_type' => 'post',
				    'posts_per_page' => 2,
				    'meta_key' => 'popular_post',
				    'meta_value' => true,
				);

				$popular_posts_query = new WP_Query($args);
				if ($popular_posts_query->have_posts()) {
	    			?><div class="news-area-right"><?php
	    			while ($popular_posts_query->have_posts()) {
	    				$popular_posts_query->the_post();
	    				?><div class="right-news-section">
	                        <div class="popuars">
	                            <span><?php _e('Popular', 'gsc'); ?></span>
	                        </div>
	                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
	                        <div class="news-headline">
	                            <h2><?php the_title(); ?></h2>
	                        </div>
	                    </div><?php
	    			}
	    			?></div><?php
	    			wp_reset_postdata();
				}
			?></div>

			<div class="other-news-section"><?php 
				if ( have_posts() ) {

					// Start the loop.
					while ( have_posts() ) {

						the_post();

						get_template_part( 'template-parts/content', get_post_format() );

						
					}

				?><div class="pagination">
					<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'gsc-bank' ); ?></h2>
					<div class="nav-links archive-navigation">
						<?php
						// Previous/next page navigation.
						the_posts_pagination( array(
							'screen_reader_text' => '',
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'gsc-bank' ) . '</span>',
						) );
						?>
					</div><!--.nav-links archive-navigation-->
				</div><?php
				// If no content, include the "No posts found" template.
				} else {
					get_template_part( 'template-parts/content', 'none' );
				}
			?></div>
        </div>
	</div>
</div>
			<div class="<?php echo esc_attr( visualcomposerstarter_get_maincontent_block_class() ) ?>">
				<div class="main-content">
					<div class="archive">
						<?php if ( have_posts() ) :

							// Start the loop.
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_format() );

								// End the loop.
							endwhile;

						?>
							<div class="pagination">
								<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'gsc-bank' ); ?></h2>
								<div class="nav-links archive-navigation">
									<?php
									// Previous/next page navigation.
									the_posts_pagination( array(
										'screen_reader_text' => '',
										'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'gsc-bank' ) . '</span>',
									) );
									?>
								</div><!--.nav-links archive-navigation-->
							</div><!--.pagination-->
						<?php
						// If no content, include the "No posts found" template.
						else :
							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>

					</div><!--.archive-->
				</div><!--.main-content-->
			</div><!--.<?php echo esc_html( visualcomposerstarter_get_maincontent_block_class() ) ?>-->

			<?php if ( visualcomposerstarter_get_sidebar_class() ) :
				get_sidebar();
			endif; ?>

		</div><!--.row-->
	</div><!--.content-wrapper-->
</div><!--.<?php echo esc_html( visualcomposerstarter_get_content_container_class() ); ?>-->
<?php get_footer();
