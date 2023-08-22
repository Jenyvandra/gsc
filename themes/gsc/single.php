<?php
/**
 * Single
 *
 * @package WordPress
 * @subpackage GSC BANK
 * @since GSC BANK 1.0
 */

get_header();?>
<div class="<?php echo esc_attr( visualcomposerstarter_get_content_container_class() ); ?>">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-md-12">
				<div class="main-content">
					<article class="entry-full-content">
						<div class="d-md-flex py-2 py-md-5 post-single justify-content-between">
							<div class="col-md-8 pt-md-4">
								<h2 class="post-heading"><?php echo get_the_title(); ?></h2>
								<div class="post-single-img"><?php the_post_thumbnail(); ?></div>
								<div class="d-md-flex my-3 post-details"><div class="post-date pr-md-4"><?php echo get_the_date(); ?></div><div class="post-author pl-md-4"><?php echo get_the_author(); ?></div><div class="news-share ml-md-5"><span><i class="fa-solid fa-share-nodes"></i><?php echo do_shortcode('[Sassy_Social_Share]') . __(' Share'); ?></span></div></div>
								<div class="my-4"><?php the_content(); ?></div>
								<div class="news-category-right">
                					<?php echo do_shortcode("[gsc_social_icons]"); ?></div>
							</div>
							<div class="popular-news-right pt-4" id="right-sidebar-blog">
					        	<div class="get-latest">
					                <h2><?php _e('Get Latest news deliver daily', 'gsc'); ?></h2>
					                <div class="news-form-data">
					                    <form class="news-subscribe" accept-charset="UTF-8" action="https://getform.io/f/{your-form-endpoint-goes-here}" method="POST" enctype="multipart/form-data" target="_blank" id="wpform">
					                        <div class="btn-flex">
					                            <div class="email-width"><input class="form-news" type="email" name="email" placeholder="Enter your Email" required="required"></div>
					                            <a href="#"><button class="btn" type="submit"><?php _e('Subscribe', 'gsc'); ?></button></a>
					                        </div>
					                    </form>
					                </div>
					            </div><?php
					        	echo do_shortcode("[gsc_latest_posts max_posts='4']");
					        	echo do_shortcode("[gsc_news_video]");
					        ?></div>
						</div>
					</article><!--.entry-full-content-->
				</div><!--.main-content-->
			</div>
		</div><!--.row-->
	</div><!--.content-wrapper-->
</div><?php 
get_footer();
