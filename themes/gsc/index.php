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
	<div class="search-bar">
		<h1 class="blog-page-heading">GSC Bank <span>NEWS</span></h1>
		<!-- Another variation with a button -->
	    <div class="form-group has-search">
	        <span class="fa fa-search form-control-feedback"></span>
	        <input type="text" class="form-control" placeholder="Search" action="<?php echo get_site_url();?>">
	    </div>
	</div>
	<div class="news-category-section">
		<div class="news-category">
			<div class="news-category-left">
				<?php echo do_shortcode("[gsc_category_nav ids='42, 43, 44, 45, 46, 47, 48']"); ?>
			</div>
			<div class="news-category-right">
                <?php echo do_shortcode("[gsc_social_icons]"); ?>
            </div>
        </div><?php
        	echo do_shortcode("[gsc_blogs ids='87222, 87211, 87200, 87202, 87219']");
    ?></div>
    <div class="popular-news-section">
    	<div class="popular-news-left">
    		<div class="news-category">
				<div class="news-category-right">
					<h2 class="small-underline-header-txt main-title-blue"><?php _e('Popular news', 'gsc'); ?></h2>
				</div>
				<div class="news-category-left">
					<?php echo do_shortcode("[gsc_category_nav ids='42, 43, 45, 44, 46']"); ?>
						
				</div>
	        </div>
	        <div class="news-areas"><?php
	    		echo do_shortcode("[gsc_popular_posts max_posts='2']");
			?></div>

			<div class="other-news-section">
				<div class="other-news"><?php 
					$posts = new WP_Query(array(
						'post_type' => 'post',
						'numberposts' => 4
					));
					if ( $posts->have_posts() ) {

						// Start the loop.
						while ( $posts->have_posts() ) {

							$posts->the_post();
							
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
			<?php echo do_shortcode("[gsc_featured_posts max_posts='3']"); ?>
        </div>
        <div class="popular-news-right" id="right-sidebar-blog">
        	<div class="get-latest">
                <h2><?php _e('Get Latest news deliver daily', 'gsc'); ?></h2>
                <div class="news-form-data">
                    <form class="news-subscribe" accept-charset="UTF-8" action="https://getform.io/f/{your-form-endpoint-goes-here}" method="POST" enctype="multipart/form-data" target="_blank" id="wpform">
                        <div class="btn-flex">
                        	
                        	<?php
	    						echo do_shortcode("[contact-form-7 id='87853' title='newsletter']");
							?>
                            <!-- <div class="email-width"><input class="form-news" type="email" name="email" placeholder="Enter your Email" required="required"></div>
                            <a href="#"><button class="btn" type="submit"><?php //_e('Subscribe', 'gsc'); ?></button></a> -->
                        </div>
                    </form>
                </div>
            </div><?php
        	echo do_shortcode("[gsc_latest_posts max_posts='4']");
        	echo do_shortcode("[gsc_news_video]");
        ?></div>
	</div>
</div>
<?php get_footer();
