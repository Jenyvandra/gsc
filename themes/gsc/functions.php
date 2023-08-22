<?php
/**
 * Functions
 *
 * @package WordPress
 * @subpackage GSC BANK
 * @since GSC BANK 1.0
 */

define( 'VISUALCOMPOSERSTARTER_VERSION', '3.3' );

if ( ! function_exists( 'visualcomposerstarter_setup' ) ) :
	/**
	 * Theme setup
	 */
	function visualcomposerstarter_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'gsc-bank', get_template_directory() . '/languages' );

		/*
		 * Define sidebars
		 */
		define( 'VISUALCOMPOSERSTARTER_PAGE_SIDEBAR',                     'vct_overall_site_page_sidebar' );
		define( 'VISUALCOMPOSERSTARTER_POST_SIDEBAR',                     'vct_overall_site_post_sidebar' );
		define( 'VISUALCOMPOSERSTARTER_ARCHIVE_AND_CATEGORY_SIDEBAR',     'vct_overall_site_aac_sidebar' );
		define( 'VISUALCOMPOSERSTARTER_DISABLE_HEADER',                   'vct_overall_site_disable_header' );
		define( 'VISUALCOMPOSERSTARTER_DISABLE_FOOTER',                   'vct_overall_site_disable_footer' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable custom logo
		 */
		add_theme_support( 'custom-logo' );

		/*
		 * Enable custom background
		 */
		add_theme_support( 'custom-background', array(
			'default-color' => '#ffffff',
		) );

		visualcomposerstarter_set_old_styles();
		visualcomposerstarter_set_old_content_size();

		/*
		 * Feed Links
		 */
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-formats', array( 'gallery', 'video', 'image' ) );

		add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		if ( get_theme_mod( 'vct_overall_site_featured_image', true ) === true ) {
			add_theme_support( 'post-thumbnails' );
		}

		add_image_size( 'visualcomposerstarter-featured-loop-image', 848, 0 );
		add_image_size( 'visualcomposerstarter-featured-loop-image-full', 1140, 0 );
		add_image_size( 'visualcomposerstarter-featured-single-image-boxed', 1170, 0 );
		add_image_size( 'visualcomposerstarter-featured-single-image-full', 1920, 0 );

		/*
		 * Set the default content width.
		 */
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 848;
		}

		/*
		 * This theme uses wp_nav_menu() in two locations.
		 */
		register_nav_menus( array(
			'primary'       => esc_html__( 'Primary Menu', 'gsc-bank' ),
			'secondary'     => esc_html__( 'Footer Menu', 'gsc-bank' ),
		) );

		/*
		 * Comment reply
		 */
		add_action( 'comment_form_before', 'visualcomposerstarter_enqueue_comments_reply' );

		/*
		 * ACF Integration
		 */

		if ( class_exists( 'acf' ) && function_exists( 'register_field_group' ) ) {
			$vct_acf_page_options = array(
				'id' => 'acf_page-options',
				'title' => esc_html__( 'Page Options', 'gsc-bank' ),
				'fields' => array(
					array(
						'key' => 'field_589f5a321f0bc',
						'label' => esc_html__( 'Sidebar Position', 'gsc-bank' ),
						'name' => 'sidebar_position',
						'type' => 'select',
						'instructions' => esc_html__( 'Select specific sidebar position.', 'gsc-bank' ),
						'choices' => array(
							'default' => esc_html__( 'Default', 'gsc-bank' ),
							'none' => esc_html__( 'None', 'gsc-bank' ),
							'left' => esc_html__( 'Left', 'gsc-bank' ),
							'right' => esc_html__( 'Right', 'gsc-bank' ),
						),
						'default_value' => get_theme_mod( VISUALCOMPOSERSTARTER_PAGE_SIDEBAR, 'none' ),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array(
						'key' => 'field_589f55db2faa9',
						'label' => esc_html__( 'Hide Page Title', 'gsc-bank' ),
						'name' => 'hide_page_title',
						'type' => 'checkbox',
						'choices' => array(
							1 => esc_html__( 'Yes', 'gsc-bank' ),
						),
						'default_value' => '',
						'layout' => 'vertical',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'page',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array(
					'position' => 'side',
					'layout' => 'default',
					'hide_on_screen' => array(),
				),
				'menu_order' => 0,
			);

			$vct_acf_post_options = array(
				'id' => 'acf_post-options',
				'title' => esc_html__( 'Post Options', 'gsc-bank' ),
				'fields' => array(
					array(
						'key' => 'field_589f5b1d656ca',
						'label' => esc_html__( 'Sidebar Position', 'gsc-bank' ),
						'name' => 'sidebar_position',
						'type' => 'select',
						'instructions' => esc_html__( 'Select specific sidebar position.', 'gsc-bank' ),
						'choices' => array(
							'default' => esc_html__( 'Default', 'gsc-bank' ),
							'none' => esc_html__( 'None', 'gsc-bank' ),
							'left' => esc_html__( 'Left', 'gsc-bank' ),
							'right' => esc_html__( 'Right', 'gsc-bank' ),
						),
						'default_value' => get_theme_mod( VISUALCOMPOSERSTARTER_POST_SIDEBAR, 'none' ),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array(
						'key' => 'field_589f5b9a56207',
						'label' => esc_html__( 'Hide Post Title', 'gsc-bank' ),
						'name' => 'hide_page_title',
						'type' => 'checkbox',
						'choices' => array(
							1 => esc_html__( 'Yes', 'gsc-bank' ),
						),
						'default_value' => '',
						'layout' => 'vertical',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'post',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array(
					'position' => 'side',
					'layout' => 'default',
					'hide_on_screen' => array(),
				),
				'menu_order' => 0,
			);

			if ( ! get_theme_mod( VISUALCOMPOSERSTARTER_DISABLE_HEADER, false ) ) {
				$vct_acf_page_options['fields'][] = array(
					'key' => 'field_58c800e5a7722',
					'label' => 'Disable Header',
					'name' => 'disable_page_header',
					'type' => 'checkbox',
					'choices' => array(
						1 => esc_html__( 'Yes', 'gsc-bank' ),
					),
					'default_value' => '',
					'layout' => 'vertical',
				);

				$vct_acf_post_options['fields'][] = array(
					'key' => 'field_58c7e3f0b7dfb',
					'label' => 'Disable Header',
					'name' => 'disable_post_header',
					'type' => 'checkbox',
					'choices' => array(
						1 => esc_html__( 'Yes', 'gsc-bank' ),
					),
					'default_value' => '',
					'layout' => 'vertical',
				);
			}

			if ( ! get_theme_mod( VISUALCOMPOSERSTARTER_DISABLE_FOOTER, false ) ) {
				$vct_acf_page_options['fields'][] = array(
					'key' => 'field_58c800faa7723',
					'label' => 'Disable Footer',
					'name' => 'disable_page_footer',
					'type' => 'checkbox',
					'choices' => array(
						1 => esc_html__( 'Yes', 'gsc-bank' ),
					),
					'default_value' => '',
					'layout' => 'vertical',
				);

				$vct_acf_post_options['fields'][] = array(
					'key' => 'field_58c7e40db7dfc',
					'label' => 'Disable Footer',
					'name' => 'disable_post_footer',
					'type' => 'checkbox',
					'choices' => array(
						1 => esc_html__( 'Yes', 'gsc-bank' ),
					),
					'default_value' => '',
					'layout' => 'vertical',
				);
			}
			register_field_group( $vct_acf_page_options );
			register_field_group( $vct_acf_post_options );
		} // End if().

		/**
		 * Customizer settings.
		 */
		require get_template_directory() . '/inc/customizer/class-visualcomposerstarter-fonts.php';
		require get_template_directory() . '/inc/customizer/class-visualcomposerstarter-customizer.php';
		require get_template_directory() . '/inc/hooks.php';
		new VisualComposerStarter_Fonts();
		new VisualComposerStarter_Customizer();

	}
endif; /* visualcomposerstarter_setup */

add_action( 'after_setup_theme', 'visualcomposerstarter_setup' );

if ( ! function_exists( 'visualcomposerstarter_style_switch_toggle_acf' ) ) {
	/**
	 *  Style Switch Toggle function
	 */
	function visualcomposerstarter_style_switch_toggle_acf() {
		$screen = get_current_screen();
		if ( isset( $screen->base ) && 'post' === $screen->base ) {
			$font_uri = VisualComposerStarter_Fonts::vct_theme_get_google_font_uri( array( 'Open Sans' ) );
			wp_register_style( 'visualcomposerstarter-toggle-acf-fonts', $font_uri );
			wp_enqueue_style( 'visualcomposerstarter-toggle-acf-fonts' );

			wp_register_style( 'visualcomposerstarter-toggle-acf-style', get_template_directory_uri() . '/css/toggle-switch.css', array(), false );
			wp_enqueue_style( 'visualcomposerstarter-toggle-acf-style' );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'visualcomposerstarter_style_switch_toggle_acf' );

if ( ! function_exists( 'visualcomposerstarter_script_switch_toggle_acf' ) ) {
	/**
	 *  Script Switch Toggle function
	 */
	function visualcomposerstarter_script_switch_toggle_acf() {
		$screen = get_current_screen();
		if ( isset( $screen->base ) && 'post' === $screen->base ) {
			wp_register_script( 'visualcomposerstarter-toggle-acf-script', get_template_directory_uri() . '/js/toggle-switch-acf.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'visualcomposerstarter-toggle-acf-script' );
		}
	}
}

add_action( 'admin_enqueue_scripts', 'visualcomposerstarter_script_switch_toggle_acf' );

if ( ! function_exists( 'visualcomposerstarter_enqueue_comments_reply' ) ) {
	/**
	 * Ajax Comment Reply
	 */
	function visualcomposerstarter_enqueue_comments_reply() {
		if ( get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/shortcode.php';
require get_template_directory() . '/inc/cpt.php';

/*
 * Add Next Page Button to WYSIWYG editor
 */

add_filter( 'mce_buttons', 'visualcomposerstarter_page_break' );

if ( ! function_exists( 'visualcomposerstarter_page_break' ) ) {
	/**
	 * Add page break
	 *
	 * @param string[] $mce_buttons Add page break.
	 *
	 * @return array
	 */
	function visualcomposerstarter_page_break( $mce_buttons ) {
		$pos = array_search( 'wp_more', $mce_buttons, true );

		if ( false !== $pos ) {
			$buttons = array_slice( $mce_buttons, 0, $pos );
			$buttons[] = 'wp_page';
			$mce_buttons = array_merge( $buttons, array_slice( $mce_buttons, $pos ) );
		}

		return $mce_buttons;
	}
}

if ( ! function_exists( 'visualcomposerstarter_style' ) ) {
	/**
	 * Enqueues styles.
	 *
	 * @since GSC BANK 1.0
	 */
	function visualcomposerstarter_style() {

		if ( get_theme_mod( 'vct_overall_site_enable_bootstrap', false ) === true ) {
			/* Bootstrap stylesheet */
			wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', array(), '3.3.7' );
		}

		/* Add GSC BANK Font */



		wp_register_style( 'visualcomposerstarter-font', get_template_directory_uri() . '/css/vc-font/gsc-bank-font.min.css', array(), VISUALCOMPOSERSTARTER_VERSION );

		
		
		
// 		wp_register_style( 'header-style', get_template_directory_uri() . 'header.css', array(), VISUALCOMPOSERSTARTER_VERSION );

		
		if ( is_home() || is_archive() || 'gallery' === get_post_format() || ( is_front_page() && 'posts' === get_option( 'show_on_front' ) ) ) {
			/* Slick slider stylesheet */
			wp_register_style( 'slick-style', get_template_directory_uri() . '/css/styles/slick.min.css', array(), '1.6.0' );
			wp_enqueue_style( 'slick-style' );
		}

		/* General theme stylesheet */
		wp_register_style( 'visualcomposerstarter-general', get_template_directory_uri() . '/css/styles/style.min.css', array(), VISUALCOMPOSERSTARTER_VERSION );

		if ( class_exists( 'WooCommerce' ) ) {
			/* Woocommerce stylesheet */
			wp_register_style( 'visualcomposerstarter-woocommerce', get_template_directory_uri() . '/css/woocommerce/woocommerce.min.css', array(), VISUALCOMPOSERSTARTER_VERSION );
			wp_enqueue_style( 'visualcomposerstarter-woocommerce' );
		}

		/* Stylesheet with additional responsive style */
		wp_register_style( 'visualcomposerstarter-responsive', get_template_directory_uri() . '/css/styles/responsive.min.css', array(), VISUALCOMPOSERSTARTER_VERSION );

		/* Theme stylesheet */
		wp_register_style( 'visualcomposerstarter-style', get_stylesheet_uri() );

		/* Font options */
		$fonts = array(
			get_theme_mod( 'vct_fonts_and_style_body_font_family', 'Roboto, sans-serif' ),
			get_theme_mod( 'vct_fonts_and_style_h1_font_family', 'Montserrat' ),
			get_theme_mod( 'vct_fonts_and_style_h2_font_family', 'Montserrat' ),
			get_theme_mod( 'vct_fonts_and_style_h3_font_family', 'Montserrat' ),
			get_theme_mod( 'vct_fonts_and_style_h4_font_family', 'Montserrat' ),
			get_theme_mod( 'vct_fonts_and_style_h5_font_family', 'Montserrat' ),
			get_theme_mod( 'vct_fonts_and_style_h6_font_family', 'Montserrat' ),
			get_theme_mod( 'vct_fonts_and_style_buttons_font_family', 'Montserrat' ),
		);

		$font_uri = VisualComposerStarter_Fonts::vct_theme_get_google_font_uri( $fonts );

		/* Load Google Fonts */
		wp_register_style( 'visualcomposerstarter-fonts', $font_uri, array(), null, 'screen' );

		/* Enqueue styles */
		if ( get_theme_mod( 'vct_overall_site_enable_bootstrap', false ) === true ) {
			wp_enqueue_style( 'bootstrap' );
		}
		wp_enqueue_style( 'visualcomposerstarter-font' );
		wp_enqueue_style( 'visualcomposerstarter-general' );
		wp_enqueue_style( 'visualcomposerstarter-responsive' );
		wp_enqueue_style( 'visualcomposerstarter-style' );
		wp_enqueue_style( 'visualcomposerstarter-fonts' );
	}
}// End if().
add_action( 'wp_enqueue_scripts', 'visualcomposerstarter_style' );


if ( ! function_exists( 'visualcomposerstarter_script' ) ) {
	/**
	 * Enqueues scripts.
	 *
	 * @since GSC BANK 1.0
	 */
	function visualcomposerstarter_script() {

		if ( get_theme_mod( 'vct_overall_site_enable_bootstrap', false ) === true ) {
			/* Bootstrap Transition JS */
			wp_register_script( 'bootstrap-transition', get_template_directory_uri() . '/js/bootstrap/transition.min.js', array( 'jquery-core' ), '3.3.7', true );

			/* Bootstrap Transition JS */
			wp_register_script( 'bootstrap-collapser', get_template_directory_uri() . '/js/bootstrap/collapse.min.js', array( 'jquery-core' ), '3.3.7', true );
		}

		if ( is_home() || is_archive() || 'gallery' === get_post_format() || ( is_front_page() && 'posts' === get_option( 'show_on_front' ) ) ) {
			/* Slick Slider JS */
			wp_register_script( 'slick-js', get_template_directory_uri() . '/js/slick/slick.min.js', array( 'jquery-core' ), '1.6.0', true );
			wp_enqueue_script( 'slick-js' );
		}

		/* Main theme JS functions */
		wp_register_script( 'visualcomposerstarter-script', get_template_directory_uri() . '/js/functions.min.js', array( 'jquery-core' ), VISUALCOMPOSERSTARTER_VERSION, true );

		

		wp_localize_script( 'visualcomposerstarter-script', 'visualcomposerstarter', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'visualcomposerstarter' ),
			'woo_coupon_form' => get_theme_mod( 'woocommerce_coupon_from', false ),
		) );

		/* Enqueue scripts */
		if ( get_theme_mod( 'vct_overall_site_enable_bootstrap', false ) === true ) {
			wp_enqueue_script( 'bootstrap-transition' );
			wp_enqueue_script( 'bootstrap-collapser' );
		}

		wp_enqueue_script( 'visualcomposerstarter-script' );
	}
}// End if().
add_action( 'wp_enqueue_scripts', 'visualcomposerstarter_script' );

if ( ! function_exists( 'visualcomposerstarter_customizer_live_preview' ) ) {
	/**
	 * Used by hook: 'customize_preview_init'
	 *
	 * @see add_action('customize_preview_init',$func)
	 */
	function visualcomposerstarter_customizer_live_preview() {
		wp_enqueue_script( 'visualcomposerstarter-themecustomizer', get_template_directory_uri() . '/js/customize-preview.min.js', array(
			'jquery',
			'customize-preview',
		), '', true );
	}
}
add_action( 'customize_preview_init', 'visualcomposerstarter_customizer_live_preview' );

if ( ! function_exists( 'visualcomposerstarter_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param Classes $classes Classes list.
	 *
	 * @return array
	 */
	function visualcomposerstarter_body_classes( $classes ) {
		$classes[] = 'visualcomposerstarter';

		/* Sandwich color */
		if ( get_theme_mod( 'vct_header_sandwich_style', '#333333' ) === '#FFFFFF' ) {
			$classes[] = 'sandwich-color-light';
		}

		/* Header Style */
		if ( get_theme_mod( 'vct_header_position', 'top' ) === 'sandwich' ) {
			$classes[] = 'menu-sandwich';
		}

		/* Menu position */
		if ( get_theme_mod( 'vct_header_sticky_header', false ) === true ) {
			$classes[] = 'fixed-header';
		}

		/* Navbar background */
		if ( get_theme_mod( 'vct_header_reserve_space_for_header', true ) === false ) {
			$classes[] = 'navbar-no-background';
		}

		/* Width of header-area */
		if ( get_theme_mod( 'vct_header_top_header_width', 'boxed' ) === 'full_width' ) {
			$classes[] = 'header-full-width';
		} elseif ( get_theme_mod( 'vct_header_top_header_width', 'boxed' ) === 'full_width_boxed' ) {
			$classes[] = 'header-full-width-boxed';
		}

		/* Width of content-area */
		if ( get_theme_mod( 'vct_overall_content_area_size', 'boxed' ) === 'full_width' ) {
			$classes[] = 'content-full-width';
		}

		/* Height of featured image */
		if ( get_theme_mod( 'vct_overall_site_featured_image_height', 'auto' ) === 'full_height' ) {
			$classes[] = 'featured-image-full-height';
		}

		if ( get_theme_mod( 'vct_overall_site_featured_image_height', 'auto' ) === 'custom' ) {
			$classes[] = 'featured-image-custom-height';
		}

		if ( false === visualcomposerstarter_is_the_header_displayed() ) {
			$classes[] = 'header-area-disabled';
		}
		if ( false === visualcomposerstarter_is_the_footer_displayed() ) {
			$classes[] = 'footer-area-disabled';
		}

		return $classes;
	}
}// End if().
add_filter( 'body_class', 'visualcomposerstarter_body_classes' );

if ( ! function_exists( 'visualcomposerstarter_give_linked_images_class' ) ) {
	/**
	 *  Give linked images class
	 *
	 * @param string $html Html.
	 * @since GSC BANK 1.2
	 * @return mixed
	 */
	function visualcomposerstarter_give_linked_images_class( $html ) {
		$classes = 'image-link'; // separated by spaces, e.g. 'img image-link'.

		$patterns = array();
		$replacements = array();

		// Matches img tag wrapped in anchor tag where anchor has existing classes contained in double quotes.
		$patterns[0] = '/<a([^>]*)class="([^"]*)"([^>]*)>\s*<img([^>]*)>\s*<\/a>/';
		$replacements[0] = '<a\1class="' . $classes . ' \2"\3><img\4></a>';

		// Matches img tag wrapped in anchor tag where anchor has existing classes contained in single quotes.
		$patterns[1] = '/<a([^>]*)class=\'([^\']*)\'([^>]*)>\s*<img([^>]*)>\s*<\/a>/';
		$replacements[1] = '<a\1class="' . $classes . ' \2"\3><img\4></a>';

		// Matches img tag wrapped in anchor tag where anchor tag has no existing classes.
		$patterns[2] = '/<a(?![^>]*class)([^>]*)>\s*<img([^>]*)>\s*<\/a>/';
		$replacements[2] = '<a\1 class="' . $classes . '"><img\2></a>';

		$html = preg_replace( $patterns, $replacements, $html );

		return $html;
	}
}
add_filter( 'the_content', 'visualcomposerstarter_give_linked_images_class' );

/*
 * Register sidebars
 */
register_sidebar(
	array(
		'name'          => esc_html__( 'Sidebar', 'gsc-bank' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'gsc-bank' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	)
);

register_sidebar(
	array(
		'name'          => esc_html__( 'Menu Area', 'gsc-bank' ),
		'id'            => 'menu',
		'description'   => esc_html__( 'Add widgets here to appear in menu area.', 'gsc-bank' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	)
);
if ( ! function_exists( 'visualcomposerstarter_footer_1' ) ) {
	/**
	 * Footer area 1.
	 *
	 * @return array
	 */
	function visualcomposerstarter_footer_1() {
		return array(
			'name' => esc_html__( 'Footer Widget Column 1', 'gsc-bank' ),
			'id' => 'footer',
			'description' => esc_html__( 'Add widgets here to appear in your footer.', 'gsc-bank' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		);
	}
}
if ( ! function_exists( 'visualcomposerstarter_footer_2' ) ) {
	/**
	 * Footer area 2.
	 *
	 * @return array
	 */
	function visualcomposerstarter_footer_2() {
		return array(
			'name' => esc_html__( 'Footer Widget Column 2', 'gsc-bank' ),
			'id' => 'footer-2',
			'description' => esc_html__( 'Add widgets here to appear in your footer.', 'gsc-bank' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		);
	}
}
if ( ! function_exists( 'visualcomposerstarter_footer_3' ) ) {
	/**
	 * Footer area 3.
	 *
	 * @return array
	 */
	function visualcomposerstarter_footer_3() {
		return array(
			'name' => esc_html__( 'Footer Widget Column 3', 'gsc-bank' ),
			'id' => 'footer-3',
			'description' => esc_html__( 'Add widgets here to appear in your footer.', 'gsc-bank' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		);
	}
}
if ( ! function_exists( 'visualcomposerstarter_footer_4' ) ) {
	/**
	 * Footer area 4.
	 *
	 * @return array
	 */
	function visualcomposerstarter_footer_4() {
		return array(
			'name' => esc_html__( 'Footer Widget Column 4', 'gsc-bank' ),
			'id' => 'footer-4',
			'description' => esc_html__( 'Add widgets here to appear in your footer.', 'gsc-bank' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		);
	}
}

add_action( 'widgets_init',             'visualcomposerstarter_all_widgets' );
add_action( 'admin_bar_init',           'visualcomposerstarter_widgets' );

if ( ! function_exists( 'visualcomposerstarter_all_widgets' ) ) {
	/**
	 * All widgets.
	 */
	function visualcomposerstarter_all_widgets() {
		/**
		 * Register all zones for availability in customizer
		 */
		register_sidebar(
			visualcomposerstarter_footer_1()
		);
		register_sidebar(
			visualcomposerstarter_footer_2()
		);
		register_sidebar(
			visualcomposerstarter_footer_3()
		);
		register_sidebar(
			visualcomposerstarter_footer_4()
		);
	}
}

if ( ! function_exists( 'visualcomposerstarter_widgets' ) ) {
	/**
	 * Widgets handler
	 */
	function visualcomposerstarter_widgets() {
		unregister_sidebar( 'footer' );
		unregister_sidebar( 'footer-2' );
		unregister_sidebar( 'footer-3' );
		unregister_sidebar( 'footer-4' );
		if ( get_theme_mod( 'vct_footer_area_widget_area', false ) ) {
			$footer_columns = intval( get_theme_mod( 'vct_footer_area_widgetized_columns', 1 ) );
			if ( $footer_columns >= 1 ) {
				register_sidebar(
					visualcomposerstarter_footer_1()
				);
			}

			if ( $footer_columns >= 2 ) {
				register_sidebar(
					visualcomposerstarter_footer_2()
				);
			}

			if ( $footer_columns >= 3 ) {
				register_sidebar(
					visualcomposerstarter_footer_3()
				);
			}
			if ( 4 === $footer_columns ) {
				register_sidebar(
					visualcomposerstarter_footer_4()
				);
			}
		}

	}
}// End if().

if ( ! function_exists( 'visualcomposerstarter_is_the_header_displayed' ) ) {
	/**
	 * Is header displayed
	 *
	 * @return bool
	 */
	function visualcomposerstarter_is_the_header_displayed() {
		if ( get_theme_mod( VISUALCOMPOSERSTARTER_DISABLE_HEADER, false ) ) {
			return false;
		} elseif ( function_exists( 'get_field' ) ) {
			if ( is_page() && ! ( function_exists( 'is_shop' ) && is_shop() ) ) {
				return ! get_field( 'field_58c800e5a7722' );
			} elseif ( function_exists( 'is_shop' ) && is_shop() && get_option( 'woocommerce_shop_page_id' ) ) {
				return ! get_field( 'field_58c800e5a7722', get_option( 'woocommerce_shop_page_id' ) );
			} elseif ( is_singular() ) {
				return ! get_field( 'field_58c7e3f0b7dfb' );
			} else {
				return true;
			}
		} else {
			return true;
		}
	}
}

if ( ! function_exists( 'visualcomposerstarter_is_the_footer_displayed' ) ) {
	/**
	 * Is footer displayed.
	 *
	 * @return bool
	 */
	function visualcomposerstarter_is_the_footer_displayed() {
		if ( get_theme_mod( VISUALCOMPOSERSTARTER_DISABLE_FOOTER, false ) ) {
			return false;
		} elseif ( function_exists( 'get_field' ) ) {
			if ( is_page() && ! ( function_exists( 'is_shop' ) && is_shop() ) ) {
				return ! get_field( 'field_58c800faa7723' );
			} elseif ( function_exists( 'is_shop' ) && is_shop() && get_option( 'woocommerce_shop_page_id' ) ) {
				return ! get_field( 'field_58c800faa7723', get_option( 'woocommerce_shop_page_id' ) );
			} elseif ( is_singular() ) {
				return ! get_field( 'field_58c7e40db7dfc' );
			} else {
				return true;
			}
		} else {
			return true;
		}
	}
}

if ( ! function_exists( 'visualcomposerstarter_get_header_container_class' ) ) {
	/**
	 * Get header container class.
	 *
	 * @return string
	 */
	function visualcomposerstarter_get_header_container_class() {
		if ( get_theme_mod( 'vct_header_top_header_width', 'boxed' ) === 'full_width' ) {
			return 'container-fluid';
		} else {
			return 'container';
		}
	}
}

if ( ! function_exists( 'visualcomposerstarter_get_header_image_container_class' ) ) {
	/**
	 * Get header image container class.
	 *
	 * @return string
	 */
	function visualcomposerstarter_get_header_image_container_class() {
		if ( get_theme_mod( 'vct_overall_site_featured_image_width', 'full_width' ) === 'full_width' ) {
			return 'container-fluid';
		} else {
			return 'container';
		}
	}
}

if ( ! function_exists( 'visualcomposerstarter_get_content_container_class' ) ) {
	/**
	 * Get contant container class
	 *
	 * @return string
	 */
	function visualcomposerstarter_get_content_container_class() {
		if ( 'full_width' === get_theme_mod( 'vct_overall_content_area_size', 'boxed' ) ) {
			return 'container-fluid';
		} else {
			return 'container';
		}
	}
}

if ( ! function_exists( 'visualcomposerstarter_check_needed_sidebar' ) ) {
	/**
	 * Check needed sidebar
	 *
	 * @return string
	 */
	function visualcomposerstarter_check_needed_sidebar() {
		if ( is_page() && ! ( function_exists( 'is_shop' ) && is_shop() ) ) {
			return VISUALCOMPOSERSTARTER_PAGE_SIDEBAR;
		} elseif ( function_exists( 'is_shop' ) && is_shop() ) {
			return VISUALCOMPOSERSTARTER_PAGE_SIDEBAR;
		} elseif ( is_singular() ) {
			return VISUALCOMPOSERSTARTER_POST_SIDEBAR;
		} elseif ( is_archive() || is_category() || is_search() || is_front_page() || is_home() ) {
			return VISUALCOMPOSERSTARTER_ARCHIVE_AND_CATEGORY_SIDEBAR;
		} else {
			return 'none';
		}
	}
}

if ( ! function_exists( 'visualcomposerstarter_specify_sidebar' ) ) {
	/**
	 * Specify sidebar
	 *
	 * @return null
	 */
	function visualcomposerstarter_specify_sidebar() {
		if ( is_page() ) {
			$value = function_exists( 'get_field' ) ? get_field( 'field_589f5a321f0bc' ) : null;
		} elseif ( is_singular() ) {
			$value = function_exists( 'get_field' ) ? get_field( 'field_589f5b1d656ca' ) : null;
		} elseif ( ( is_archive() || is_category() || is_search() || is_front_page() || is_home() ) && ! ( function_exists( 'is_shop' ) && is_shop() ) ) {
			if ( is_front_page() ) {
				$value = function_exists( 'get_field' ) ? get_field( 'field_589f5a321f0bc', get_option( 'page_on_front' ) ) : null;
			} elseif ( is_home() ) {
				$value = function_exists( 'get_field' ) ? get_field( 'field_589f5a321f0bc', get_option( 'page_for_posts' ) ) : null;
			} else {
				$value = get_theme_mod( visualcomposerstarter_check_needed_sidebar(), 'none' );
			}
		} elseif ( function_exists( 'is_shop' ) && is_shop() && get_option( 'woocommerce_shop_page_id' ) ) {
			$value = function_exists( 'get_field' ) ? get_field( 'field_589f5a321f0bc', get_option( 'woocommerce_shop_page_id' ) ) : null;
		} else {
			$value = null;
		}

		$value = apply_filters( 'visualcomposerstarter_specify_sidebar', $value );

		if ( 'default' === $value ) {
			return get_theme_mod( visualcomposerstarter_check_needed_sidebar(), 'none' );
		} else {
			$specify_setting = function_exists( 'get_field' ) ? $value : null;
			if ( $specify_setting ) {
				return $specify_setting;
			} else {
				return get_theme_mod( visualcomposerstarter_check_needed_sidebar(), 'none' );
			}
		}
	}
}// End if().

if ( ! function_exists( 'visualcomposerstarter_is_the_title_displayed' ) ) {
	/**
	 * Is the title displayed
	 *
	 * @return bool
	 */
	function visualcomposerstarter_is_the_title_displayed() {
		if ( function_exists( 'get_field' ) ) {
			if ( is_page() && ! ( function_exists( 'is_shop' ) && is_shop() ) ) {
				return (bool) ! get_field( 'field_589f55db2faa9' );
			} elseif ( function_exists( 'is_shop' ) && is_shop() && get_option( 'woocommerce_shop_page_id' ) ) {
				return (bool) ! get_field( 'field_589f55db2faa9', get_option( 'woocommerce_shop_page_id' ) );
			} elseif ( is_singular() ) {
				return (bool) ! get_field( 'field_589f5b9a56207' );
			} else {
				return true;
			}
		} else {
			return true;
		}
	}
}

if ( ! function_exists( 'visualcomposerstarter_get_maincontent_block_class' ) ) {
	/**
	 * Get main content block class
	 *
	 * @return string
	 */
	function visualcomposerstarter_get_maincontent_block_class() {
		switch ( visualcomposerstarter_specify_sidebar() ) {
			case 'none':
				return 'col-md-12';
			case 'left':
				return 'col-md-9 col-md-push-3';
			case 'right':
				return 'col-md-9';
			default:
				return 'col-md-12';
		}
	}
}

if ( ! function_exists( 'visualcomposerstarter_get_sidebar_class' ) ) {
	/**
	 * Get sidebar class
	 *
	 * @return bool|string
	 */
	function visualcomposerstarter_get_sidebar_class() {
		switch ( visualcomposerstarter_specify_sidebar() ) {
			case 'none':
				return false;
			case 'left':
				return 'col-md-3 col-md-pull-9';
			case 'right':
				return 'col-md-3';
			default:
				return false;
		}
	}
}

if ( ! function_exists( 'visualcomposerstarter_inline_styles' ) ) {
	/**
	 * Inline styles.
	 */
	function visualcomposerstarter_inline_styles() {
		$css = '';

		// Fonts and style.
		$css .= '
	/*Body fonts and style*/
	body,
	#main-menu ul li ul li,
	.comment-content cite,
	.entry-content cite,
	.visualcomposerstarter legend
	 { font-family: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_font_family', 'Roboto' ) ) . '; }
	 body,
	 .sidebar-widget-area a:hover, .sidebar-widget-area a:focus,
	 .sidebar-widget-area .widget_recent_entries ul li:hover, .sidebar-widget-area .widget_archive ul li:hover, .sidebar-widget-area .widget_categories ul li:hover, .sidebar-widget-area .widget_meta ul li:hover, .sidebar-widget-area .widget_recent_entries ul li:focus, .sidebar-widget-area .widget_archive ul li:focus, .sidebar-widget-area .widget_categories ul li:focus, .sidebar-widget-area .widget_meta ul li:focus { color: ' . get_theme_mod( 'vct_fonts_and_style_body_primary_color', '#555555' ) . '; }
	  .comment-content table,
	  .entry-content table { border-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_primary_color', '#555555' ) ) . '; }
	  .entry-full-content .entry-author-data .author-biography,
	  .entry-full-content .entry-meta,
	  .nav-links.post-navigation a .meta-nav,
	  .search-results-header h4,
	  .entry-preview .entry-meta li,
	  .entry-preview .entry-meta li a,
	  .entry-content .gallery-caption,
	  .comment-content blockquote,
	  .entry-content blockquote,
	  .wp-caption .wp-caption-text,
	  .comments-area .comment-list .comment-metadata a { color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_secondary_text_color', '#777777' ) ) . '; }
	  .comments-area .comment-list .comment-metadata a:hover,
	  .comments-area .comment-list .comment-metadata a:focus { border-bottom-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_secondary_text_color', '#777777' ) ) . '; }
	  a,
	  .comments-area .comment-list .reply a,
	  .comments-area span.required,
	  .comments-area .comment-subscription-form label:before,
	  .entry-preview .entry-meta li a:hover:before,
	  .entry-preview .entry-meta li a:focus:before,
	  .entry-preview .entry-meta li.entry-meta-category:hover:before,
	  .entry-content p a:hover,
	  .entry-content ol a:hover,
	  .entry-content ul a:hover,
	  .entry-content table a:hover,
	  .entry-content datalist a:hover,
	  .entry-content blockquote a:hover,
	  .entry-content dl a:hover,
	  .entry-content address a:hover,
	  .entry-content p a:focus,
	  .entry-content ol a:focus,
	  .entry-content ul a:focus,
	  .entry-content table a:focus,
	  .entry-content datalist a:focus,
	  .entry-content blockquote a:focus,
	  .entry-content dl a:focus,
	  .entry-content address a:focus,
	  .entry-content ul > li:before,
	  .comment-content p a:hover,
	  .comment-content ol a:hover,
	  .comment-content ul a:hover,
	  .comment-content table a:hover,
	  .comment-content datalist a:hover,
	  .comment-content blockquote a:hover,
	  .comment-content dl a:hover,
	  .comment-content address a:hover,
	  .comment-content p a:focus,
	  .comment-content ol a:focus,
	  .comment-content ul a:focus,
	  .comment-content table a:focus,
	  .comment-content datalist a:focus,
	  .comment-content blockquote a:focus,
	  .comment-content dl a:focus,
	  .comment-content address a:focus,
	  .comment-content ul > li:before,
	  .sidebar-widget-area .widget_recent_entries ul li,
	  .sidebar-widget-area .widget_archive ul li,
	  .sidebar-widget-area .widget_categories ul li,
	  .sidebar-widget-area .widget_meta ul li { color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_active_color', '#557cbf' ) ) . '; }     
	  .comments-area .comment-list .reply a:hover,
	  .comments-area .comment-list .reply a:focus,
	  .comment-content p a,
	  .comment-content ol a,
	  .comment-content ul a,
	  .comment-content table a,
	  .comment-content datalist a,
	  .comment-content blockquote a,
	  .comment-content dl a,
	  .comment-content address a,
	  .entry-content p a,
	  .entry-content ol a,
	  .entry-content ul a,
	  .entry-content table a,
	  .entry-content datalist a,
	  .entry-content blockquote a,
	  .entry-content dl a,
	  .entry-content address a { border-bottom-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_active_color', '#557cbf' ) ) . '; }    
	  .entry-content blockquote, .comment-content { border-left-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_active_color', '#557cbf' ) ) . '; }
	  
	  html, #main-menu ul li ul li { font-size: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_font_size', '16px' ) ) . ' }
	  body, #footer, .footer-widget-area .widget-title { line-height: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_line_height', '1.7' ) ) . '; }
	  body {
		letter-spacing: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_letter_spacing', '0.01rem' ) ) . ';
		font-weight: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_weight', '400' ) ) . ';
		font-style: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_font_style', 'normal' ) ) . ';
		text-transform: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_capitalization', 'none' ) ) . ';
	  }
	  
	  .comment-content address,
	  .comment-content blockquote,
	  .comment-content datalist,
	  .comment-content dl,
	  .comment-content ol,
	  .comment-content p,
	  .comment-content table,
	  .comment-content ul,
	  .entry-content address,
	  .entry-content blockquote,
	  .entry-content datalist,
	  .entry-content dl,
	  .entry-content ol,
	  .entry-content p,
	  .entry-content table,
	  .entry-content ul {
		margin-top: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_margin_top', '0' ) ) . ';
		margin-bottom: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_margin_bottom', '1.5rem' ) ) . ';
	  }
	  
	  /*Buttons font and style*/
	  .comments-area .form-submit input[type=submit],
	  .blue-button { 
			background-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_background_color', '#557cbf' ) ) . '; 
			color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_text_color', '#f4f4f4' ) ) . ';
			font-family: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_font_family', 'Montserrat' ) ) . ';
			font-size: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_font_size', '16px' ) ) . ';
			font-weight: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_weight', '400' ) ) . ';
			font-style: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_font_style', 'normal' ) ) . ';
			letter-spacing: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_letter_spacing', '0.01rem' ) ) . ';
			line-height: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_line_height', '1' ) ) . ';
			text-transform: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_capitalization', 'none' ) ) . ';
			margin-top: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_margin_top', '0' ) ) . ';
			margin-bottom: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_margin_bottom', '0' ) ) . ';
	  }
	  .comments-area .form-submit input[type=submit]:hover,
	  .comments-area .form-submit input[type=submit]:focus,
	  .blue-button:hover, .blue-button:focus, 
	  .entry-content p a.blue-button:hover { 
			background-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_background_hover_color', '#3c63a6' ) ) . '; 
			color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_text_hover_color', '#f4f4f4' ) ) . '; 
	  }
	  
	  .nav-links.archive-navigation .page-numbers {
	        background-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_background_color', '#557cbf' ) ) . '; 
			color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_text_color', '#f4f4f4' ) ) . ';
	  }
	  
	  .nav-links.archive-navigation a.page-numbers:hover, 
	  .nav-links.archive-navigation a.page-numbers:focus, 
	  .nav-links.archive-navigation .page-numbers.current {
	        background-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_background_hover_color', '#3c63a6' ) ) . '; 
			color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_text_hover_color', '#f4f4f4' ) ) . '; 
	  }
	  .visualcomposerstarter #review_form #respond .form-submit .submit
	   {
	  		background-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_background_color', '#557cbf' ) ) . '; 
			color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_text_color', '#f4f4f4' ) ) . ';
			font-family: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_font_family', 'Montserrat' ) ) . ';
			font-size: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_font_size', '16px' ) ) . ';
			font-weight: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_weight', '400' ) ) . ';
			font-style: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_font_style', 'normal' ) ) . ';
			letter-spacing: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_letter_spacing', '0.01rem' ) ) . ';
			line-height: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_line_height', '1' ) ) . ';
			text-transform: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_capitalization', 'none' ) ) . ';
			margin-top: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_margin_top', '0' ) ) . ';
			margin-bottom: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_margin_bottom', '0' ) ) . ';
	  }
	  .visualcomposerstarter #review_form #respond .form-submit .submit:hover,
	  .visualcomposerstarter #review_form #respond .form-submit .submit:focus { 
			background-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_background_hover_color', '#3c63a6' ) ) . '; 
			color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_text_hover_color', '#f4f4f4' ) ) . '; 
	  }
	';

		// Headers font and style.
		$css .= '
	/*Headers fonts and style*/
	.header-widgetised-area .widget_text,
	 #main-menu > ul > li > a, 
	 .entry-full-content .entry-author-data .author-name, 
	 .nav-links.post-navigation a .post-title, 
	 .comments-area .comment-list .comment-author,
	 .comments-area .comment-list .reply a,
	 .comments-area .comment-form-comment label,
	 .comments-area .comment-form-author label,
	 .comments-area .comment-form-email label,
	 .comments-area .comment-form-url label,
	 .comment-content blockquote,
	 .entry-content blockquote { font-family: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_font_family', 'Montserrat' ) ) . '; }
	.entry-full-content .entry-author-data .author-name,
	.entry-full-content .entry-meta a,
	.nav-links.post-navigation a .post-title,
	.comments-area .comment-list .comment-author,
	.comments-area .comment-list .comment-author a,
	.search-results-header h4 strong,
	.entry-preview .entry-meta li a:hover,
	.entry-preview .entry-meta li a:focus { color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_text_color', '#333333' ) ) . '; }
	
	.entry-full-content .entry-meta a,
	.comments-area .comment-list .comment-author a:hover,
	.comments-area .comment-list .comment-author a:focus,
	.nav-links.post-navigation a .post-title { border-bottom-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_text_color', '#333333' ) ) . '; }

	 
	 h1 {
		color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_text_color', '#333333' ) ) . ';
		font-family: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_font_family', 'Montserrat' ) ) . ';
		font-size: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_font_size', '42px' ) ) . ';
		font-weight: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_weight', '400' ) ) . ';
		font-style: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_font_style', 'normal' ) ) . ';
		letter-spacing: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_letter_spacing', '0.01rem' ) ) . ';
		line-height: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_line_height', '1.1' ) ) . ';
		margin-top: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_margin_top', '0' ) ) . ';
		margin-bottom: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_margin_bottom', '2.125rem' ) ) . ';
		text-transform: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_capitalization', 'none' ) ) . ';  
	 }
	 h1 a {color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_active_color', '#557cbf' ) ) . ';}
	 h1 a:hover, h1 a:focus {color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h1_active_color', '#557cbf' ) ) . ';}
	 h2 {
		color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h2_text_color', '#333333' ) ) . ';
		font-family: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h2_font_family', 'Montserrat' ) ) . ';
		font-size: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h2_font_size', '36px' ) ) . ';
		font-weight: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h2_weight', '400' ) ) . ';
		font-style: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h2_font_style', 'normal' ) ) . ';
		letter-spacing: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h2_letter_spacing', '0.01rem' ) ) . ';
		line-height: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h2_line_height', '1.1' ) ) . ';
		margin-top: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h2_margin_top', '0' ) ) . ';
		margin-bottom: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h2_margin_bottom', '0.625rem' ) ) . ';
		text-transform: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h2_capitalization', 'none' ) ) . ';  
	 }
	 h2 a {color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h2_active_color', '#557cbf' ) ) . ';}
	 h2 a:hover, h2 a:focus {color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h2_active_color', '#557cbf' ) ) . ';}
	 h3 {
		color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h3_text_color', '#333333' ) ) . ';
		font-family: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h3_font_family', 'Montserrat' ) ) . ';
		font-size: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h3_font_size', '30px' ) ) . ';
		font-weight: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h3_weight', '400' ) ) . ';
		font-style: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h3_font_style', 'normal' ) ) . ';
		letter-spacing: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h3_letter_spacing', '0.01rem' ) ) . ';
		line-height: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h3_line_height', '1.1' ) ) . ';
		margin-top: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h3_margin_top', '0' ) ) . ';
		margin-bottom: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h3_margin_bottom', '0.625rem' ) ) . ';
		text-transform: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h3_capitalization', 'none' ) ) . ';  
	 }
	 h3 a {color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h3_active_color', '#557cbf' ) ) . ';}
	 h3 a:hover, h3 a:focus {color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h3_active_color', '#557cbf' ) ) . ';}
	 h4 {
		color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h4_text_color', '#333333' ) ) . ';
		font-family: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h4_font_family', 'Montserrat' ) ) . ';
		font-size: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h4_font_size', '22px' ) ) . ';
		font-weight: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h4_weight', '400' ) ) . ';
		font-style: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h4_font_style', 'normal' ) ) . ';
		letter-spacing: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h4_letter_spacing', '0.01rem' ) ) . ';
		line-height: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h4_line_height', '1.1' ) ) . ';
		margin-top: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h4_margin_top', '0' ) ) . ';
		margin-bottom: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h4_margin_bottom', '0.625rem' ) ) . ';
		text-transform: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h4_capitalization', 'none' ) ) . ';  
	 }
	 h4 a {color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h4_active_color', '#557cbf' ) ) . ';}
	 h4 a:hover, h4 a:focus {color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h4_active_color', '#557cbf' ) ) . ';}
	 h5 {
		color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h5_text_color', '#333333' ) ) . ';
		font-family: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h5_font_family', 'Montserrat' ) ) . ';
		font-size: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h5_font_size', '22px' ) ) . ';
		font-weight: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h5_weight', '400' ) ) . ';
		font-style: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h5_font_style', 'normal' ) ) . ';
		letter-spacing: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h5_letter_spacing', '0.01rem' ) ) . ';
		line-height: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h5_line_height', '1.1' ) ) . ';
		margin-top: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h5_margin_top', '0' ) ) . ';
		margin-bottom: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h5_margin_bottom', '0.625rem' ) ) . ';
		text-transform: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h5_capitalization', 'none' ) ) . ';  
	 }
	 h5 a {color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h5_active_color', '#557cbf' ) ) . ';}
	 h5 a:hover, h5 a:focus {color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h5_active_color', '#557cbf' ) ) . ';}
	 h6 {
		color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h6_text_color', '#333333' ) ) . ';
		font-family: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h6_font_family', 'Montserrat' ) ) . ';
		font-size: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h6_font_size', '16px' ) ) . ';
		font-weight: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h6_weight', '400' ) ) . ';
		font-style: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h6_font_style', 'normal' ) ) . ';
		letter-spacing: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h6_letter_spacing', '0.01rem' ) ) . ';
		line-height: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h6_line_height', '1.1' ) ) . ';
		margin-top: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h6_margin_top', '0' ) ) . ';
		margin-bottom: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h6_margin_bottom', '0.625rem' ) ) . ';
		text-transform: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h6_capitalization', 'none' ) ) . ';  
	 }
	 h6 a {color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h6_active_color', '#557cbf' ) ) . ';}
	 h6 a:hover, h6 a:focus {color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_h6_active_color', '#557cbf' ) ) . ';}
	';

		/*
		 * Do not need to check the value of $header_and_menu_area_background in this condition,
		 * because it (condition) is completely depends on the value of `vct_header_reserve_space_for_header`.
		 */
		if ( true === get_theme_mod( 'vct_header_reserve_space_for_header', true ) ) {
			$header_and_menu_area_background = get_theme_mod( 'vct_header_background', '#ffffff' );

			/*
			 * For backward compatibility, set header's background-color to `transparent` only if:
			 * 1. The user set `vct_header_background_type` setting to `default` in Customizer.
			 * 2. The user did not change settings related to header color in Customizer.
			 *
			 * Note: do not use a default value for `get_theme_mod` in this case!
			 */
			$header_background_type = get_theme_mod( 'vct_header_background_type' );
			if ( 'default' === $header_background_type ) {
				$header_and_menu_area_background = 'transparent';
			} elseif ( empty( $header_background_type ) && '#ffffff' === $header_and_menu_area_background ) {
				$header_and_menu_area_background = 'transparent';
			}

			$css .= '
		/*Header and menu area background color*/
		#header .navbar .navbar-wrapper,
		body.navbar-no-background #header .navbar.fixed.scroll,
		body.header-full-width-boxed #header .navbar,
		body.header-full-width #header .navbar {
			background-color: ' . esc_html( $header_and_menu_area_background ) . ';
		}
		
		@media only screen and (min-width: 768px) {
			body:not(.menu-sandwich) #main-menu ul li ul { background-color: ' . esc_html( $header_and_menu_area_background ) . '; }
		}
		body.navbar-no-background #header .navbar {background-color: transparent;}
		';
		}

		$header_and_menu_area_text_color = get_theme_mod( 'vct_header_text_color', '#555555' );
		if ( '#555555' !== $header_and_menu_area_text_color ) {
			$css .= '
		/*Header and menu area text color*/
		#header { color: ' . esc_html( $header_and_menu_area_text_color ) . ' }
		
		@media only screen and (min-width: 768px) {
			body:not(.menu-sandwich) #main-menu ul li,
			body:not(.menu-sandwich) #main-menu ul li a,
			body:not(.menu-sandwich) #main-menu ul li ul li a { color:  ' . esc_html( $header_and_menu_area_text_color ) . ' }
		}
		';
		}

		$header_and_menu_area_text_active_color = get_theme_mod( 'vct_header_text_active_color', '#333333' );
		if ( '#333333' !== $header_and_menu_area_text_active_color ) {
			$css .= '
		/*Header and menu area active text color*/
		#header a:hover {
			color: ' . esc_html( $header_and_menu_area_text_active_color ) . ';
			border-bottom-color: ' . esc_html( $header_and_menu_area_text_active_color ) . ';
		}
		
		@media only screen and (min-width: 768px) {
			body:not(.menu-sandwich) #main-menu ul li a:hover,
			body:not(.menu-sandwich) #main-menu ul li.current-menu-item > a,
			body:not(.menu-sandwich) #main-menu ul li ul li a:focus, body:not(.menu-sandwich) #main-menu ul li ul li a:hover,
			body:not(.menu-sandwich) .sandwich-color-light #main-menu>ul>li.current_page_item>a,
			body:not(.menu-sandwich) .sandwich-color-light #main-menu>ul ul li.current_page_item>a {
				color: ' . esc_html( $header_and_menu_area_text_active_color ) . ';
				border-bottom-color: ' . esc_html( $header_and_menu_area_text_active_color ) . ';
			}
		}
		';
		}

		$header_padding = get_theme_mod( 'vct_header_padding', '25px' );
		if ( '25px' !== $header_padding ) {
			$css .= '
		/* Header padding */

		.navbar-wrapper { padding: ' . esc_html( $header_padding ) . ' 15px; }
		';
		}

		$header_sandwich_icon_color = get_theme_mod( 'vct_header_sandwich_icon_color', '#ffffff' );
		if ( '#ffffff' !== $header_sandwich_icon_color ) {
			$css .= '
			.navbar-toggle .icon-bar {background-color: ' . esc_html( $header_sandwich_icon_color ) . ';}
		';
		}

		$header_and_menu_area_menu_hover_background = get_theme_mod( 'vct_header_menu_hover_background', '#eeeeee' );
		if ( '#eeeeee' !== $header_and_menu_area_menu_hover_background ) {
			$css .= '
		/*Header and menu area menu hover background color*/
		@media only screen and (min-width: 768px) { body:not(.menu-sandwich) #main-menu ul li ul li:hover > a { background-color: ' . esc_html( $header_and_menu_area_menu_hover_background ) . '; } }
		';
		}

		// Featured image custom height.
		$vct_featured_image_custom_height = get_theme_mod( 'vct_overall_site_featured_image_custom_height', '400px' );
		if ( is_numeric( $vct_featured_image_custom_height ) ) {
			$vct_featured_image_custom_height .= 'px';
		}
		if ( get_theme_mod( 'vct_overall_site_featured_image_height', 'auto' ) === 'custom' ) {
			$css .= '
		/*Featured image custom height*/
		.header-image .fade-in-img { height: ' . esc_html( $vct_featured_image_custom_height ) . '; }
		';

		}

		$content_area_background = get_theme_mod( 'vct_overall_site_content_background', '#ffffff' );
		if ( '#ffffff' !== $content_area_background ) {
			$css .= '
		/*Body background*/
		body { background-color: ' . esc_html( $content_area_background ) . '; }
		';
		}

		$content_area_comments_background = get_theme_mod( 'vct_overall_site_comments_background', '#f4f4f4' );
		if ( '#f4f4f4' !== $content_area_comments_background ) {
			$css .= '
		/*Comments background*/
		.comments-area { background-color: ' . esc_html( $content_area_comments_background ) . '; }
		';
		}

		$content_area_tag_background = get_theme_mod( 'vct_overall_site_tag_background', '#eeeeee' );
		if ( '#eeeeee' !== $content_area_tag_background ) {
			$css .= '
		/*Tag background*/
		.entry-tags a { background-color: ' . esc_html( $content_area_tag_background ) . '; }
		';
		}

		$content_area_tag_hover_background = get_theme_mod( 'vct_overall_site_tag_hover_background', '#557cbf' );
		if ( '#557cbf' !== $content_area_tag_hover_background ) {
			$css .= '
		/*Tag hover background*/
		.entry-tags a:hover { background-color: ' . esc_html( $content_area_tag_hover_background ) . '; }
		';
		}

		$content_area_tag_color = get_theme_mod( 'vct_overall_site_tag_color', '#777777' );
		if ( '#777777' !== $content_area_tag_color ) {
			$css .= '
		/*Tag color*/
		.entry-tags a { color: ' . esc_html( $content_area_tag_color ) . '; }
		';
		}

		$content_area_tag_hover_color = get_theme_mod( 'vct_overall_site_tag_hover_color', '#ffffff' );
		if ( '#ffffff' !== $content_area_tag_hover_color ) {
			$css .= '
		/*Tag hover color*/
		.entry-tags a:hover { color: ' . esc_html( $content_area_tag_hover_color ) . '; }
		';
		}

		$footer_area_background = get_theme_mod( 'vct_footer_area_background', '#333333' );
		if ( '#333333' !== $footer_area_background ) {
			// Work out if hash given.
			$hex = str_replace( '#', '', $footer_area_background );

			// HEX TO RGB.
			$rgb = array( hexdec( substr( $hex,0,2 ) ), hexdec( substr( $hex,2,2 ) ), hexdec( substr( $hex,4,2 ) ) );
			// CALCULATE.
			for ( $i = 0; $i < 3; $i++ ) {
				$rgb[ $i ] = round( $rgb[ $i ] * 1.1 );

				// In case rounding up causes us to go to 256.
				if ( $rgb[ $i ] > 255 ) {
					$rgb[ $i ] = 255;
				}
			}
			// RBG to Hex.
			$hex = '';
			for ( $i = 0; $i < 3; $i++ ) {
				// Convert the decimal digit to hex.
				$hex_digit = dechex( $rgb[ $i ] );
				// Add a leading zero if necessary.
				if ( strlen( $hex_digit ) === 1 ) {
					$hex_digit = '0' . $hex_digit;
				}
				// Append to the hex string.
				$hex .= $hex_digit;
			}
			$footer_widget_area_background = '#' . $hex;
			$css .= '
		/*Footer area background color*/
		#footer { background-color: ' . esc_html( $footer_area_background ) . '; }
		.footer-widget-area { background-color: ' . esc_html( $footer_widget_area_background ) . '; }
		';
		}

		$footer_area_text_color = get_theme_mod( 'vct_footer_area_text_color', '#777777' );
		if ( '#777777' !== $footer_area_text_color ) {
			$css .= '
		/*Footer area text color*/
		#footer,
		#footer .footer-socials ul li a span {color: ' . esc_html( $footer_area_text_color ) . '; }
		';
		}

		$footer_area_text_active_color = get_theme_mod( 'vct_footer_area_text_active_color', '#ffffff' );
		if ( '#ffffff' !== $footer_area_text_active_color ) {
			$css .= '
		/*Footer area text active color*/
		#footer a,
		#footer .footer-socials ul li a:hover span { color: ' . esc_html( $footer_area_text_active_color ) . '; }
		#footer a:hover { border-bottom-color: ' . esc_html( $footer_area_text_active_color ) . '; }
		';
		}

		if ( class_exists( 'WooCommerce' ) ) {
			$css .= '
			/* WooCommerce */
			#add_payment_method .cart-collaterals .cart_totals table small,
			.woocommerce-cart .cart-collaterals .cart_totals table small,
			.woocommerce-checkout .cart-collaterals .cart_totals table small,
			.visualcomposerstarter.woocommerce-cart .woocommerce .cart-collaterals .cart_totals .cart-subtotal td,
			.visualcomposerstarter.woocommerce-cart .woocommerce .cart-collaterals .cart_totals .cart-subtotal th,
			.visualcomposerstarter.woocommerce-cart .woocommerce table.cart,
			.visualcomposerstarter.woocommerce .woocommerce-ordering,
			.visualcomposerstarter.woocommerce .woocommerce-result-count,
			.visualcomposerstarter.woocommerce-account .woocommerce-MyAccount-content a.button
			{ font-family: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_body_font_family', 'Roboto' ) ) . '; }
			.visualcomposerstarter.woocommerce-cart .woocommerce table.cart .product-name a
			{ color: ' . get_theme_mod( 'vct_fonts_and_style_body_primary_color', '#555555' ) . '; }
			.visualcomposerstarter .products .added_to_cart {
			  font-family: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_font_family', 'Montserrat' ) ) . ';
			}
			.visualcomposerstarter.woocommerce nav.woocommerce-pagination ul li .page-numbers {
			  background-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_background_color', '#557cbf' ) ) . '; 
			  color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_text_color', '#f4f4f4' ) ) . ';
			}
			.visualcomposerstarter.woocommerce nav.woocommerce-pagination ul li .page-numbers:hover, 
			.visualcomposerstarter.woocommerce nav.woocommerce-pagination ul li .page-numbers:focus, 
			.visualcomposerstarter.woocommerce nav.woocommerce-pagination ul li .page-numbers.current {
			  background-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_background_hover_color', '#3c63a6' ) ) . '; 
			  color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_text_hover_color', '#f4f4f4' ) ) . '; 
			}
			.visualcomposerstarter.woocommerce button.button,
			.visualcomposerstarter.woocommerce a.button.product_type_simple,
			.visualcomposerstarter.woocommerce a.button.product_type_grouped,
			.visualcomposerstarter.woocommerce a.button.product_type_variable,
			.visualcomposerstarter.woocommerce a.button.product_type_external,
			.visualcomposerstarter .woocommerce .buttons a.button.wc-forward,
			.visualcomposerstarter .woocommerce #place_order,
			.visualcomposerstarter .woocommerce .button.checkout-button,
			.visualcomposerstarter .woocommerce .button.wc-backward,
			.visualcomposerstarter .woocommerce .track_order .button,
			.visualcomposerstarter .woocommerce .vct-thank-you-footer a,
			.visualcomposerstarter .woocommerce .woocommerce-EditAccountForm .button,
			.visualcomposerstarter .woocommerce .woocommerce-MyAccount-content a.edit,
			.visualcomposerstarter .woocommerce .woocommerce-mini-cart__buttons.buttons a,
			.visualcomposerstarter .woocommerce .woocommerce-orders-table__cell .button,
			.visualcomposerstarter .woocommerce a.button,
			.visualcomposerstarter .woocommerce button.button
			{
			  background-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_background_color', '#557cbf' ) ) . '; 
			  color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_text_color', '#f4f4f4' ) ) . ';
			  font-family: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_font_family', 'Montserrat' ) ) . ';
			  font-size: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_font_size', '16px' ) ) . ';
			  font-weight: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_weight', '400' ) ) . ';
			  font-style: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_font_style', 'normal' ) ) . ';
			  letter-spacing: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_letter_spacing', '0.01rem' ) ) . ';
			  line-height: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_line_height', '1' ) ) . ';
			  text-transform: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_capitalization', 'none' ) ) . ';
			  margin-top: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_margin_top', '0' ) ) . ';
			  margin-bottom: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_margin_bottom', '0' ) ) . ';
			}
			.visualcomposerstarter.woocommerce button.button.alt.disabled {
			  background-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_background_color', '#557cbf' ) ) . '; 
			  color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_text_color', '#f4f4f4' ) ) . ';
			}
			.visualcomposerstarter.woocommerce a.button:hover,
			.visualcomposerstarter.woocommerce a.button:focus,
			.visualcomposerstarter.woocommerce button.button:hover,
			.visualcomposerstarter.woocommerce button.button:focus,
			.visualcomposerstarter .woocommerce #place_order:hover,
			.visualcomposerstarter .woocommerce .button.checkout-button:hover,
			.visualcomposerstarter .woocommerce .button.wc-backward:hover,
			.visualcomposerstarter .woocommerce .track_order .button:hover,
			.visualcomposerstarter .woocommerce .vct-thank-you-footer a:hover,
			.visualcomposerstarter .woocommerce .woocommerce-EditAccountForm .button:hover,
			.visualcomposerstarter .woocommerce .woocommerce-MyAccount-content a.edit:hover,
			.visualcomposerstarter .woocommerce .woocommerce-mini-cart__buttons.buttons a:hover,
			.visualcomposerstarter .woocommerce .woocommerce-orders-table__cell .button:hover,
			.visualcomposerstarter .woocommerce a.button:hover,
			.visualcomposerstarter .woocommerce #place_order:focus,
			.visualcomposerstarter .woocommerce .button.checkout-button:focus,
			.visualcomposerstarter .woocommerce .button.wc-backward:focus,
			.visualcomposerstarter .woocommerce .track_order .button:focus,
			.visualcomposerstarter .woocommerce .vct-thank-you-footer a:focus,
			.visualcomposerstarter .woocommerce .woocommerce-EditAccountForm .button:focus,
			.visualcomposerstarter .woocommerce .woocommerce-MyAccount-content a.edit:focus,
			.visualcomposerstarter .woocommerce .woocommerce-mini-cart__buttons.buttons a:focus,
			.visualcomposerstarter .woocommerce .woocommerce-orders-table__cell .button:focus,
			.visualcomposerstarter .woocommerce a.button:focus
			{ 
			  background-color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_background_hover_color', '#3c63a6' ) ) . '; 
			  color: ' . esc_html( get_theme_mod( 'vct_fonts_and_style_buttons_text_hover_color', '#f4f4f4' ) ) . '; 
			}
			';

			$price_tag_color = get_theme_mod( 'woo_price_tag_color', '#2b4b80' );
			$css .= '
			.visualcomposerstarter.woocommerce ul.products li.product .price,
			.visualcomposerstarter.woocommerce div.product p.price,
			.visualcomposerstarter.woocommerce div.product p.price ins,
			.visualcomposerstarter.woocommerce div.product span.price,
			.visualcomposerstarter.woocommerce div.product span.price ins,
			.visualcomposerstarter.woocommerce.widget .quantity,
			.visualcomposerstarter.woocommerce.widget del,
			.visualcomposerstarter.woocommerce.widget ins,
			.visualcomposerstarter.woocommerce.widget span.woocommerce-Price-amount.amount,
			.visualcomposerstarter.woocommerce p.price ins,
			.visualcomposerstarter.woocommerce p.price,
			.visualcomposerstarter.woocommerce span.price,
			.visualcomposerstarter.woocommerce span.price ins,
			.visualcomposerstarter .woocommerce.widget span.amount,
			.visualcomposerstarter .woocommerce.widget ins {
			  color: ' . esc_html( $price_tag_color ) . '
			}
			';

			$old_price_tag_color = get_theme_mod( 'woo_old_price_tag_color', '#d5d5d5' );
			$css .= '
			.visualcomposerstarter.woocommerce span.price del,
			.visualcomposerstarter.woocommerce p.price del,
			.visualcomposerstarter.woocommerce p.price del span,
			.visualcomposerstarter.woocommerce span.price del span,
			.visualcomposerstarter .woocommerce.widget del,
			.visualcomposerstarter .woocommerce.widget del span.amount,
			.visualcomposerstarter.woocommerce ul.products li.product .price del {
			  color: ' . esc_html( $old_price_tag_color ) . '
			}
			';

			$cart_color = get_theme_mod( 'woo_cart_color', '#2b4b80' );
			$cart_text_color = get_theme_mod( 'woo_cart_text_color', '#fff' );
			$css .= '
			.visualcomposerstarter .vct-cart-items-count {
			  background: ' . esc_html( $cart_color ) . ';
			  color: ' . esc_html( $cart_text_color ) . ';
			}
			.visualcomposerstarter .vct-cart-wrapper svg g>g {
			  fill: ' . esc_html( $cart_color ) . ';
			}
			';

			$link_color = get_theme_mod( 'woo_link_color', '#d5d5d5' );
			$css .= '
			.visualcomposerstarter.woocommerce div.product .entry-categories a,
			.visualcomposerstarter.woocommerce div.product .woocommerce-tabs ul.tabs li a
			{
			  color: ' . esc_html( $link_color ) . ';
			}
			';

			$link_hover_color = get_theme_mod( 'woo_link_hover_color', '#2b4b80' );
			$css .= '
			.visualcomposerstarter.woocommerce div.product .entry-categories a:hover,
			.visualcomposerstarter.woocommerce-cart .woocommerce table.cart .product-name a:hover,
			.visualcomposerstarter.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
			.visualcomposerstarter.woocommerce div.product .entry-categories a:focus,
			.visualcomposerstarter.woocommerce-cart .woocommerce table.cart .product-name a:focus,
			.visualcomposerstarter.woocommerce div.product .woocommerce-tabs ul.tabs li a:focus,
			{
			  color: ' . esc_html( $link_hover_color ) . ';
			}
			';

			$link_active_color = get_theme_mod( 'woo_link_active_color', '#2b4b80' );
			$css .= '
			.visualcomposerstarter.woocommerce div.product .woocommerce-tabs ul.tabs li.active a
			{
			  color: ' . esc_html( $link_active_color ) . ';
			}
			.visualcomposerstarter.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:before
			{
			  background: ' . esc_html( $link_active_color ) . ';
			}
			';

			$outline_button_color = get_theme_mod( 'woo_outline_button_color', '#4e4e4e' );
			$css .= '
			.woocommerce button.button[name="update_cart"],
		    .button[name="apply_coupon"],
		    .vct-checkout-button,
		    .woocommerce button.button:disabled, 
		    .woocommerce button.button:disabled[disabled]
			{
			  color: ' . esc_html( $outline_button_color ) . ';
			}
			';

			$price_filter_widget_color = get_theme_mod( 'woo_price_filter_widget_color', '#2b4b80' );
			$css .= '
			.visualcomposerstarter .woocommerce.widget.widget_price_filter .ui-slider .ui-slider-handle,
			.visualcomposerstarter .woocommerce.widget.widget_price_filter .ui-slider .ui-slider-range
			{
			  background-color: ' . esc_html( $price_filter_widget_color ) . ';
			}
			';

			$widget_links_color = get_theme_mod( 'woo_widget_links_color', '#000' );
			$css .= '
			.visualcomposerstarter .woocommerce.widget li a
			{
			  color: ' . esc_html( $widget_links_color ) . ';
			}
			';

			$widget_links_hover_color = get_theme_mod( 'woo_widget_links_hover_color', '#2b4b80' );
			$css .= '
			.visualcomposerstarter .woocommerce.widget li a:hover,
			.visualcomposerstarter .woocommerce.widget li a:focus
			{
			  color: ' . esc_html( $widget_links_hover_color ) . ';
			}
			';

			$delete_icon_color = get_theme_mod( 'woo_delete_icon_color', '#d5d5d5' );
			$css .= '
			.visualcomposerstarter.woocommerce-cart .woocommerce table.cart a.remove:before,
			.visualcomposerstarter .woocommerce.widget .cart_list li a.remove:before,
			.visualcomposerstarter.woocommerce-cart .woocommerce table.cart a.remove:after,
			.visualcomposerstarter .woocommerce.widget .cart_list li a.remove:after
			{
			  background-color: ' . esc_html( $delete_icon_color ) . ';
			}
			';
		}// End if().

		wp_add_inline_style( 'visualcomposerstarter-style', $css );
	}
}// End if().
add_action( 'wp_enqueue_scripts', 'visualcomposerstarter_inline_styles' );

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'visualcomposerstarter_register_required_plugins' );

if ( ! function_exists( 'visualcomposerstarter_register_required_plugins' ) ) {
	/**
	 * Register the required plugins for this theme.
	 */
	function visualcomposerstarter_register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 */
		$plugins = array();

		if ( ! class_exists( 'acf' ) ) {
			$plugins[] = array(
				'name' => 'Advanced Custom Fields',
				'slug' => 'advanced-custom-fields',
				'required' => false,
			);
		}

		$plugins[] = array(
			'name' => 'Visual Composer Website Builder',
			'slug' => 'visualcomposer',
			'required' => false,
		);

		/*
		 * Array of configuration settings. Amend each line as needed.
		 */
		$config = array(
			'id'           => 'gsc-bank',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);
		tgmpa( $plugins, $config );
	}
}// End if().

if ( ! function_exists( 'visualcomposerstarter_set_old_content_size' ) ) {
	/**
	 *  For backward compatibility for background
	 *
	 * @deprecated 1.3
	 * BC for older users
	 */
	function visualcomposerstarter_set_old_styles() {
		if ( get_theme_mod( 'vct_overall_site_bg_color' ) ) {
			set_theme_mod( 'background_color', str_replace( '#', '', get_theme_mod( 'vct_overall_site_bg_color' ) ) );
			remove_theme_mod( 'vct_overall_site_bg_color' );
		}

		if ( get_theme_mod( 'vct_overall_site_enable_bg_image' ) ) {

			set_theme_mod( 'background_attachment', 'scroll' );
			set_theme_mod( 'background_image', esc_url_raw( get_theme_mod( 'vct_overall_site_bg_image' ) ) );
			if ( 'repeat' === get_theme_mod( 'vct_overall_site_bg_image_style' ) ) {
				set_theme_mod( 'background_repeat', 'repeat' );
			} else {
				set_theme_mod( 'background_repeat', 'no-repeat' );
				set_theme_mod( 'background_size', esc_html( get_theme_mod( 'vct_overall_site_bg_image_style' ) ) );
			}

			remove_theme_mod( 'vct_overall_site_bg_image' );
			remove_theme_mod( 'vct_overall_site_bg_image_style' );
			remove_theme_mod( 'vct_overall_site_enable_bg_image' );
		}
	}
}

if ( ! function_exists( 'visualcomposerstarter_set_old_content_size' ) ) {
	/**
	 * For backward compatibility content area size
	 *
	 * @deprecated 2.0.4
	 */
	function visualcomposerstarter_set_old_content_size() {
		if ( get_theme_mod( 'vct_content_area_size' ) ) {
			set_theme_mod( 'vct_overall_content_area_size', get_theme_mod( 'vct_content_area_size' ) );
			remove_theme_mod( 'vct_content_area_size' );
		}
	}
}

if ( ! function_exists( 'visualcomposerstarter_support' ) ) {
	/**
	 *  WooCommerce support
	 */
	function visualcomposerstarter_support() {
		add_theme_support( 'woocommerce' );
	}

	add_action( 'after_setup_theme', 'visualcomposerstarter_support' );

}
if ( ! function_exists( 'visualcomposerstarter_woo_setup' ) ) {
	/**
	 *  WooCommerce single product gallery
	 */
	function visualcomposerstarter_woo_setup() {
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
}
add_action( 'after_setup_theme', 'visualcomposerstarter_woo_setup' );

if ( ! function_exists( 'visualcomposerstarter_woo_categories' ) ) {
	/**
	 *  WooCommerce single product categories layout
	 */
	function visualcomposerstarter_woo_categories() {
		global $product;
		// @codingStandardsIgnoreLine
		echo wc_get_product_category_list( $product->get_id(), ' ', '<div class="entry-categories"><span class="screen-reader-text">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'gsc-bank' ) . '</span>', '</div>' );
	}
}
add_action( 'woocommerce_single_product_summary', 'visualcomposerstarter_woo_categories', 1 );

if ( ! function_exists( 'visualcomposerstarter_woo_tags' ) ) {
	/**
	 * WooCommerce single product tags layout
	 */
	function visualcomposerstarter_woo_tags() {
		global $product;
		// @codingStandardsIgnoreLine
		echo wc_get_product_tag_list( $product->get_id(), ' ', '<div class="entry-tags"><span class="screen-reader-text">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'gsc-bank' ) . '</span>', '</div>' );
	}
}
add_action( 'woocommerce_single_product_summary', 'visualcomposerstarter_woo_tags', 65 );

if ( ! function_exists( 'visualcomposerstarter_woo_format_sale_price' ) ) {
	/**
	 * WooCommerce single product price layout
	 *
	 * @param product $price layout.
	 * @param product $regular_price number.
	 * @param product $sale_price number.
	 * @return string
	 */
	function visualcomposerstarter_woo_format_sale_price( $price, $regular_price, $sale_price ) {
		$price = '<ins>' . ( is_numeric( $sale_price ) ? wc_price( $sale_price ) : $sale_price ) . '</ins> <del>' . ( is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price ) . '</del>';

		return $price;
	}
}
add_filter( 'woocommerce_format_sale_price', 'visualcomposerstarter_woo_format_sale_price', 10, 3 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );

if ( ! function_exists( 'visualcomposerstarter_woo_sale_flash' ) ) {
	/**
	 * WooCommerce single product sale flash layout
	 *
	 * @param single $post data.
	 * @param single $product data.
	 * @return string
	 */
	function visualcomposerstarter_woo_sale_flash( $post, $product ) {
		$sale = <<<HTML
 <span class="onsale vct-sale">
	<svg width="48px" height="48px" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Product-Open" transform="translate(-20.000000, -24.000000)" fill-rule="nonzero" fill="#FAC917">
                <g id="Image" transform="translate(0.000000, 4.000000)">
                    <g id="Discount" transform="translate(20.000000, 20.000000)">
                        <ellipse id="Oval" cx="17.5163" cy="19.8834847" rx="2.04" ry="2.00245399"></ellipse>
                        <ellipse id="Oval" cx="30.4763" cy="28.011092" rx="2.04" ry="2.00245399"></ellipse>
                        <path d="M47.2963,26.5975951 L46.5563,25.606184 C45.7563,24.5264294 45.7363,23.0638528 46.5263,21.9644663 L47.2463,20.9632393 C48.3463,19.4319509 47.8363,17.3018896 46.1463,16.408638 L45.0463,15.8294969 C43.8463,15.2012761 43.1863,13.8859387 43.4163,12.5607853 L43.6263,11.3534233 C43.9463,9.50802454 42.5363,7.80004908 40.6263,7.72152147 L39.3763,7.67244172 C38.0163,7.61354601 36.8363,6.71047853 36.4563,5.42458896 L36.1063,4.24667485 C35.5763,2.44053988 33.5563,1.50802454 31.7963,2.25403681 L30.6463,2.7350184 C29.3963,3.26507975 27.9363,2.95096933 27.0263,1.94974233 L26.1963,1.0368589 C24.9263,-0.357006135 22.6963,-0.347190184 21.4363,1.0761227 L20.6163,1.99882209 C19.7163,3.00986503 18.2663,3.34360736 17.0063,2.83317791 L15.8463,2.36201227 C14.0763,1.64544785 12.0763,2.61722699 11.5663,4.42336196 L11.2363,5.61109202 C10.8763,6.90679755 9.7163,7.82949693 8.3563,7.89820859 L7.1063,7.96692025 C5.1963,8.07489571 3.8163,9.80250307 4.1663,11.6479018 L4.3963,12.8552638 C4.6463,14.1706012 4.0063,15.4957546 2.8163,16.1436074 L1.7263,16.7423804 C0.0563,17.6552638 -0.4237,19.7951411 0.7063,21.3067975 L1.4463,22.2982086 C2.2463,23.3779632 2.2663,24.8405399 1.4763,25.9399264 L0.7563,26.9411534 C-0.3437,28.4724417 0.1663,30.6025031 1.8563,31.4957546 L2.9563,32.0748957 C4.1563,32.7031166 4.8163,34.018454 4.5863,35.3436074 L4.3763,36.5509693 C4.0563,38.3963681 5.4663,40.1043436 7.3763,40.1828712 L8.6263,40.2319509 C9.9863,40.2908466 11.1663,41.1939141 11.5463,42.4798037 L11.8963,43.6577178 C12.4263,45.4638528 14.4463,46.3963681 16.2063,45.6503558 L17.3563,45.1693742 C18.6063,44.6393129 20.0663,44.9534233 20.9763,45.9546503 L21.8063,46.8675337 C23.0863,48.2613988 25.3163,48.2515828 26.5663,46.8282699 L27.3863,45.9055706 C28.2863,44.8945276 29.7363,44.5607853 30.9963,45.0712147 L32.1563,45.5423804 C33.9263,46.2589448 35.9263,45.2871656 36.4363,43.4810307 L36.7663,42.2933006 C37.1263,40.9975951 38.2863,40.0748957 39.6463,40.006184 L40.8963,39.9374724 C42.8063,39.8294969 44.1863,38.1018896 43.8363,36.2564908 L43.6063,35.0491288 C43.3563,33.7337914 43.9963,32.408638 45.1863,31.7607853 L46.2763,31.1620123 C47.9463,30.2589448 48.4263,28.1190675 47.2963,26.5975951 Z M12.5863,19.8834847 C12.5863,17.213546 14.7863,15.0540368 17.5063,15.0540368 C20.2263,15.0540368 22.4263,17.213546 22.4263,19.8834847 C22.4263,22.5534233 20.2263,24.7129325 17.5063,24.7129325 C14.7863,24.7129325 12.5863,22.5436074 12.5863,19.8834847 Z M18.4563,32.3399264 C18.0363,32.8405399 17.2763,32.9092515 16.7663,32.4969816 L16.7663,32.4969816 C16.2563,32.0847117 16.1863,31.3386994 16.6063,30.8380859 L29.5163,15.5742822 C29.9363,15.0736687 30.6963,15.0049571 31.2063,15.417227 C31.7163,15.8294969 31.7863,16.5755092 31.3663,17.0761227 L18.4563,32.3399264 Z M30.4763,32.8405399 C27.7563,32.8405399 25.5563,30.6810307 25.5563,28.011092 C25.5563,25.3411534 27.7563,23.1816442 30.4763,23.1816442 C33.1963,23.1816442 35.3963,25.3411534 35.3963,28.011092 C35.3963,30.6810307 33.1963,32.8405399 30.4763,32.8405399 Z" id="Shape"></path>
                    </g>
                </g>
            </g>
        </g>
    </svg>
</span>
HTML;

		return $sale;
	}
}
add_filter( 'woocommerce_sale_flash', 'visualcomposerstarter_woo_sale_flash', 10, 2 );

if ( ! function_exists( 'visualcomposerstarter_woo_cart_count' ) ) {
	/**
	 * Update cart woocommerce cart item count
	 */
	function visualcomposerstarter_woo_cart_count() {
		if ( function_exists( 'WC' ) ) {
			echo esc_html( WC()->cart->get_cart_contents_count() );
		}
		die;
	}
}
add_action( 'wp_ajax_visualcomposerstarter_woo_cart_count', 'visualcomposerstarter_woo_cart_count' );
add_action( 'wp_ajax_nopriv_visualcomposerstarter_woo_cart_count', 'visualcomposerstarter_woo_cart_count' );

if ( ! function_exists( 'visualcomposerstarter_woo_variable_container' ) ) {
	/**
	 * Add variable container
	 *
	 * @param dropdown $html content.
	 * @return string
	 */
	function visualcomposerstarter_woo_variable_container( $html ) {
		return '<div class="vct-variable-container">' . $html . '</div>';
	}
}
add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'visualcomposerstarter_woo_variable_container' );

if ( ! function_exists( 'visualcomposerstarter_woo_hide_page_title' ) ) {
	/**
	 * Removes the "shop" title on the main shop page
	 *
	 * @access public
	 * @return bool
	 */
	function visualcomposerstarter_woo_hide_page_title() {
		return visualcomposerstarter_is_the_title_displayed();
	}
}
add_filter( 'woocommerce_show_page_title', 'visualcomposerstarter_woo_hide_page_title' );

// Move payments after customer details.
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20 );

if ( ! function_exists( 'visualcomposerstarter_strpos_array' ) ) {
	/**
	 * Strpos for arrays
	 *
	 * @param $haystack
	 * @param $needle
	 * @return false|int
	 */
	function visualcomposerstarter_strpos_array( $haystack, $needle ) {
		if ( ! is_array( $needle ) ) {
			$needle = array( $needle );
		}
		foreach ( $needle as $what ) {
			$pos = strpos( $haystack, $what );
			if ( false !== $pos ) {
				return $pos;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'visualcomposerstarter_js_defer_parsing' ) ) {
	/**
	 * Add defer to selected js files
	 *
	 * @param $url
	 * @return array|mixed|string|string[]
	 */
	function visualcomposerstarter_js_defer( $url ) {
		if ( is_user_logged_in() ) {
			return $url;
		}

		if ( visualcomposerstarter_strpos_array( $url, array(
			'functions.min.js',
			'slick.min.js',
		) ) ) {
			return str_replace( ' src', ' defer src', $url );
		}

		return $url;
	}

	add_filter( 'script_loader_tag', 'visualcomposerstarter_js_defer', 10 );
}

/**
 * This shortcode is used to display the category navigation of posts
 * Date: 02-08-2023
 */
add_shortcode("gsc_category_nav", "gsc_category_nav");
function gsc_category_nav($attr) {

	if(is_admin()) {
		return;
	}

	$args = array(
		'hide_empty' => false,
		'taxonomy' => 'category',
		'number' => 7,
	);

	if(isset($attr['ids']) && !empty($attr['ids'])) {
		$args['include'] = explode(",", trim($attr['ids']));
	}

	$categories = get_categories($args);

	ob_start();
	
	?><ul class="news-nav">
		<li class="nav-items" data-term-id="0"><a href="#"><?php _e("All News", "gsc"); ?></a></li><?php
	foreach ($categories as $key => $category) {
		?><li class="nav-items" data-term-id="<?php echo esc_html($category->term_id); ?>"><a href="<?php echo get_term_link($category); ?>"><?php echo esc_html($category->name); ?></a></li><?php
	}
	?></ul><?php

	return ob_get_clean();
}

/**
 * This shortcode is used to display the featured posts
 * Date: 03-08-2023
 */
add_shortcode("gsc_featured_posts", "gsc_featured_posts");
function gsc_featured_posts($attr) {
	
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'post',
		'meta_key' => 'featured_post',
	    'meta_value' => true,
	);

	if(isset($attr['max_posts']) && !empty($attr['max_posts'])) {
		$args['posts_per_page'] = $attr['max_posts'];
	}

	if(isset($attr['cat_id']) && !empty($attr['cat_id']) && is_numeric($attr['cat_id'])) {
		$args['cat'] = $attr['cat_id'];
	}

	$featured_posts_query = new WP_Query($args);
	ob_start();
	if ($featured_posts_query->have_posts()) {
		?><div class="feature-news-section">
			<div class="popular-news-left get-latest-news">
                <div class="news-category">
                    <div class="news-category-right">
                        <h2 class="small-underline-header-txt main-title-blue"><?php _e("Featured News", 'gsc'); ?></h2>
                    </div>
                    <div class="news-category-left"></div>
                </div>
            </div>
            <div class="feature-news"><?php
	        	while ($featured_posts_query->have_posts()) {
					$featured_posts_query->the_post();
					?><article class="feature-news-deatil news-<?php echo get_the_ID(); ?>">
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>"></a>
                        <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                    </article><?php
				}
	        ?></div>
        </div><?php
		wp_reset_postdata();
	}
	return ob_get_clean();
}

/**
 * This shortcode is used to get latest posts
 * Date: 03-08-2023
 */
add_shortcode("gsc_latest_posts", "gsc_latest_posts");
function gsc_latest_posts($attr) {
	if(is_admin()) {
		return;
	}

	$args = array(
		'post_type'      => 'post', // You can change this to other post types if needed.
	    'post_status'    => 'publish',
	    'orderby'        => 'date',
	    'order'          => 'DESC',
	);

	if(isset($attr['max_posts']) && !empty($attr['max_posts'])) {
		$args['posts_per_page'] = $attr['max_posts'];
	}

	$latest_posts_query = new WP_Query($args);
	ob_start();
	if ($latest_posts_query->have_posts()) {
		?><div class="news-category">
            <div class="news-category-right">
                <h2 class="small-underline-header-txt main-title-blue"><?php _e('Latest news', 'gsc'); ?></h2>
            </div>
            <div class="news-category-left"></div>
        </div>
        <div class="other-news-section">
        	<div class="other-news"><?php
	        	while ($latest_posts_query->have_posts()) {
	        		$latest_posts_query->the_post();
	        		?><article class="other-news-detail">
	                    <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"></a>
	                    <div class="other-newa-description">
	                        <h2><?php the_title(); ?></h2>
	                       <a href="<?php the_permalink(); ?>" class="text-g"><?php _e('Read more', 'gsc'); ?></a>
	                    </div>
                    </article><?php
	        	}
            ?></div>
        </div><?php

	}
	return ob_get_clean();

}

add_action("wp_enqueue_scripts", "gsc_enqueu_blog_scripts");
function gsc_enqueu_blog_scripts() {
	wp_enqueue_script("gsc-blog", get_stylesheet_directory_uri()."/js/gsc-blog.js", array('jquery'), '1.2');
	wp_localize_script("gsc-blog", 'gsc_obj', array('ajax_url' => admin_url("admin-ajax.php")));
}

add_shortcode("gsc_blogs","gsc_blogs");
function gsc_blogs($attr) {
	if(is_admin()) {
		return;
	}
	$args = array(
    	'post_status' => 'publish',
    	'numberposts' => 5
    );

    if(isset($attr['ids']) && !empty($attr['ids'])) {
    	$args['post__in'] = explode(",", trim($attr['ids']));
    }
	$top_posts = get_posts($args);
	$first_top_post = array_shift($top_posts);
	ob_start();
	?><div class="news-area">
    	<div class="news-area-left">
    		<a href="<?php echo get_permalink($first_top_post->ID); ?>"><img src="<?php echo get_the_post_thumbnail_url($first_top_post->ID); ?>" /></a>
    		<div class="news-headline">
                <a href="<?php echo get_permalink($first_top_post->ID); ?>"><h2><?php echo esc_html(get_the_title($first_top_post)); ?></h2></a>
                <div class="news-share">
                    <span><i class="fa-solid fa-share-nodes"></i><?php echo do_shortcode('[Sassy_Social_Share url="' . get_permalink($first_top_post->ID) . '"]') ; ?></span>
                </div>
            </div>
    	</div>
    	<div class="news-area-right"><?php
    	foreach ($top_posts as $key => $t_post) {
    			?><div class="right-news-section">
                    <a href="<?php echo get_permalink($t_post->ID); ?>"><img src="<?php echo get_the_post_thumbnail_url($t_post->ID); ?>" /></a>
	        		<div class="news-headline">
	                    <a href="<?php echo get_permalink($t_post->ID); ?>"><h2><?php echo esc_html(get_the_title($t_post)); ?></h2></a>
	                </div>
                </div><?php
    		}	
    	?></div>
    </div><?php
    return ob_get_clean();
}

add_action("wp_ajax_nopriv_gsc_get_category_filtered_posts", "gsc_get_category_filtered_posts");
add_action("wp_ajax_gsc_get_category_filtered_posts", "gsc_get_category_filtered_posts");
function gsc_get_category_filtered_posts() {
	$term_id = $_POST['term_id'];

	$popular_posts = '';
	// ob_start();
	// // echo do_shortcode("[gsc_popular_posts max_posts='2' cat_id='".$term_id."']");
	// function==
	$popular_posts = gsc_popular_posts(array('max_posts' => 2, 'cat_id' => $term_id));

	$other_news = "";
	ob_start();
	$args = array(
		"post_status" => 'publish',
		"posts_per_page" => 4,
		"paged" => 1
	);

	if(!empty($term_id)) {
		$args['cat'] = $term_id;
	}
	$news = new WP_Query($args);


	if ( $news->have_posts() ) {

		// Start the loop.
		while ( $news->have_posts() ) {

			$news->the_post();
			
			get_template_part( 'template-parts/content', get_post_format() );

			
		}

		?><div class="pagination">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'gsc-bank' ); ?></h2>
			<div class="nav-links archive-navigation">
				<?php
				// Previous/next page navigation.
				echo paginate_links(array(
			        'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			        'format'    => '?paged=%#%',
			        'current'   => max( 1, get_query_var('paged') ),
			        'total'     => $news->max_num_pages,
			        'prev_text' => __('&laquo; Previous'),
			        'next_text' => __('Next &raquo;'),
			        'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'gsc-bank' ) . '</span>',
			    ));
				?>
			</div><!--.nav-links archive-navigation-->
		</div><?php
		wp_reset_postdata();
		// If no content, include the "No posts found" template.
	} else {
		get_template_part( 'template-parts/content', 'none' );
	}

	$other_news = ob_get_clean();

	$featured_news = "";
	// ob_start();
	// echo do_shortcode("[gsc_featured_posts max_posts='3' cat_id='".$term_id."']");
	$featured_news = gsc_featured_posts(array('max_posts' => 3, 'cat_id' => $term_id));

	wp_send_json(array('popular_news' => $popular_posts, 'other_news' => $other_news, 'featured_news' => $featured_news));
	die();

}

add_shortcode("gsc_popular_posts", "gsc_popular_posts");
function gsc_popular_posts($attr) {


	$args = array(
	    'post_type' => 'post',
	    'meta_key' => 'popular_post',
	    'meta_value' => true,
	);

	if(isset($attr['max_posts']) && !empty($attr['max_posts']) && is_numeric($attr['max_posts'])) {
		$args['posts_per_page'] = $attr['max_posts'];
	}

	if(isset($attr['cat_id']) && !empty($attr['cat_id']) && is_numeric($attr['cat_id'])) {
		$args['cat'] = $attr['cat_id'];
	}

	ob_start();
	$popular_posts_query = new WP_Query($args);
	if ($popular_posts_query->have_posts()) {
		?><div class="news-area-right"><?php
		while ($popular_posts_query->have_posts()) {
			$popular_posts_query->the_post();
			?><article class="right-news-section">
                <div class="popuars">
                    <span><?php _e('Popular', 'gsc'); ?></span>
                </div>
                <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"></a>
                <div class="news-headline">
                    <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                </div>
            </article><?php
		}
		?></div><?php
		wp_reset_postdata();
	}
	return ob_get_clean();
}

add_action("wp_ajax_gsc_load_posts", "gsc_load_posts");
add_action("wp_ajax_nopriv_gsc_load_posts", "gsc_load_posts");
function gsc_load_posts() {
	$term_id = $_POST['term_id'];
	$page = $_POST['page'];

	$other_news = "";
	$args = array(
		"post_status" => 'publish',
		"posts_per_page" => 4,
		"paged" => $page
	);

	if(!empty($term_id)) {
		$args['cat'] = $term_id;
	}

	$news = new WP_Query($args);

	ob_start();

	if ( $news->have_posts() ) {

		// Start the loop.
		while ( $news->have_posts() ) {

			$news->the_post();
			
			get_template_part( 'template-parts/content', get_post_format() );

			
		}

		?><div class="pagination">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'gsc-bank' ); ?></h2>
			<div class="nav-links archive-navigation">
				<?php
				// Previous/next page navigation.
				echo paginate_links(array(
			        'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			        'format'    => '?paged=%#%',
			        'current'   => max( $page, get_query_var('paged') ),
			        'total'     => $news->max_num_pages,
			        'prev_text' => __('&laquo; Previous'),
			        'next_text' => __('Next &raquo;'),
			        'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'gsc-bank' ) . '</span>',
			    ));
				?>
			</div><!--.nav-links archive-navigation-->
		</div><?php
		wp_reset_postdata();
		// If no content, include the "No posts found" template.
	} else {
		get_template_part( 'template-parts/content', 'none' );
	}

	$other_news = ob_get_clean();
	wp_send_json(array("other_news" => $other_news));
	die();
}

add_action("acf/init", "gsc_register_theme_options_page");
function gsc_register_theme_options_page() {
	if( function_exists('acf_add_options_page') ) {
    
	    acf_add_options_page(array(
	        'page_title'    => 'Theme Options',
	        'menu_title'    => 'Theme Options',
	        'menu_slug'     => 'theme-general-settings',
	        'capability'    => 'edit_posts',
	        'redirect'      => false
	    ));

	}
}

add_shortcode("gsc_news_video", "gsc_news_video");
function gsc_news_video() {
	if(is_admin()) {
		return;
	}

	ob_start();
	?><div class="news-video">
        <div class="popular-news-left get-latest-news ">
            <div class="news-category">
                <div class="news-category-right">
                    <h2 class="small-underline-header-txt main-title-blue"><?php _e('Latest Video','gsc-bank'); ?></h2>
                </div>
                <div class="news-category-left">
                </div>
            </div>
        </div>
        <?php the_field("latest_news_video", "option"); ?>
    </div><?php
	return ob_get_clean();
}

add_shortcode("gsc_social_icons", "gsc_social_icons");
function gsc_social_icons() {
	if(is_admin()) {
		return;
	}
	ob_start();
	$social_icons = get_field("social_icons", "option");
	?><ul class="news-nav"><?php
		foreach ($social_icons as $key => $social) {
        	?><li class="nav-items"><a href="<?php echo $social['url']; ?>" target="_blank"><img src="<?php echo $social['icon']; ?>" /></a></li><?php
		}
        
    ?></ul><?php
    return ob_get_clean();
}

function gsc_filter_search_to_posts($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search) {
            // Limit the search to only posts
            $query->set('post_type', 'post');
        }
    }
}
add_action('pre_get_posts', 'gsc_filter_search_to_posts');

function wpb_custom_new_menu() {
	register_nav_menu('header-menu',__( 'Header Menu' ));
	register_nav_menu('header-top-left-menu',__( 'Header Top Left Menu' ));
	register_nav_menu('header-top-right-menu',__( 'Header Top Right Menu' ));
	register_nav_menu('loan-menu',__( 'Loan Menu' ));
  register_nav_menu('loan-menu',__( 'Loan Menu' ));
  register_nav_menu('account-menu',__( 'Account Menu' ));
  register_nav_menu('insurance-menu',__( 'Insurance Menu' ));
  register_nav_menu('aboutus-menu',__( 'Aboutus Menu' ));	
}
add_action( 'init', 'wpb_custom_new_menu' );

add_shortcode("gsc_financial_statistics_table", "gsc_financial_statistics_table");
function gsc_financial_statistics_table() {
	global $post;

	if(is_admin()) {
		return;
	}

	$yearly_performance = get_field("yearly_performance", $post->ID);
	if(empty($yearly_performance)) {
		return;
	}
	$share_capital = array();
	$reserves_and_other_funds = array();
	$total_advances = array();
	$deposits = array();
	$profit__loss = array();
	$dividend = array();

	$yearsArr = array();
	foreach ($yearly_performance as $key => $performance) {
		$year = $performance['year'];
		$yearsArr[] = $year;
		$share_capital[$year] = $performance['share_capital'];
		$reserves_and_other_funds[$year] = $performance['reserves_and_other_funds'];
		$total_advances[$year] = $performance['total_advances'];
		$deposits[$year] = $performance['deposits'];
		$profit__loss[$year] = $performance['profit__loss'];
		$dividend[$year] = $performance['dividend'];
	}

	$PerformanceArr = array(
		'share_capital' => $share_capital,
		'reserves_and_other_funds' => $reserves_and_other_funds,
		'total_advances' => $total_advances,
		'deposits' => $deposits,
		'profit__loss' => $profit__loss,
		'dividend' => $dividend,
	);

	$labels = array(
		'share_capital' => __("Share Capital", "gsc-bank"),
		'reserves_and_other_funds' => __("Reserves and Other Funds", "gsc-bank"),
		'total_advances' => __("Total Advances", "gsc-bank"),
		'deposits' => __("Share Capital", "gsc-bank"),
		'profit__loss' => __("Deposits", "gsc-bank"),
		'dividend' => __("Dividend", "gsc-bank"),
	);
	ob_start();
	?><div class="wpb_wrapper">
		<canvas id="gsc_financial_chart"></canvas>
		<table id="customers">
			<thead>
				<tr>
					<th scope="col">SR NO.</th>
					<th scope="col">PARTICULARS</th><?php
					foreach ($yearsArr as $key => $year) {
						?><th scope="col"><?php echo esc_html($year); ?></th><?php	
					}
				?></tr>
			</thead>
			<tbody><?php
			$count = 1;
			foreach ($PerformanceArr as $key => $performance) {
				?><tr>
					<td><?php echo $count; ?></td>
					<td><?php echo $labels[$key]; ?></td><?php
					foreach ($yearsArr as $key2 => $year) {
						?><td><?php echo $performance[$year]; ?></td><?php
					}
					
				?></tr><?php
				$count++;
			}
			?></tbody>
		</table>
	</div><?php
	return ob_get_clean();

}

add_shortcode("gsc_financial_balancesheet_table", "gsc_financial_balancesheet_table");
function gsc_financial_balancesheet_table() {
	global $post;
	if(is_admin()) {
		return;
	}

	$previous_year = get_field("previous_year", $post->ID);
	$current_year = get_field("current_year", $post->ID);

	ob_start();
	?><div class="wpb_wrapper">
    	<table id="customers">
            <thead>
                <tr>
                    <th scope="col"><?php _e("PARTICULARS", "gsc-bank");?></th>
                    <th scope="col"><?php _e('PREVIOUS YEAR', 'gsc-bank'); ?></th>
                    <th scope="col"><?php _e('CURRENT YEAR','gsc-bank');?></th>
                </tr>
            </thead>
            <tbody>
				<tr>
					<td><?php _e("BALANCE SHEET","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['balance_sheet']); ?></td>
					<td><?php echo esc_html($current_year['balance_sheet']); ?></td>
				</tr>
				<tr>
					<td><?php _e("CAPITAL","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['capital']); ?></td>
					<td><?php echo esc_html($current_year['capital']); ?></td>
				</tr>
				<tr>
					<td><?php _e("RESERVES & SURPLUS","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['reserves_&_surplus']); ?></td>
					<td><?php echo esc_html($current_year['reserves_&_surplus']); ?></td>
				</tr>
				<tr>
					<td><?php _e("DEPOSITS","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['deposits']); ?></td>
					<td><?php echo esc_html($current_year['deposits']); ?></td>
				</tr>
				<tr>
					<td><?php _e("BORROWINGS","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['borrowings']); ?></td>
					<td><?php echo esc_html($current_year['borrowings']); ?></td>
				</tr>
				<tr>
					<td><?php _e("OTHER LIABILITIES","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['other_liabilities']); ?></td>
					<td><?php echo esc_html($current_year['other_liabilities']); ?></td>
				</tr>
			</tbody>
			<thead>
				<tr>
					<th scope="col"><?php _e("TOTAL LIABILITIES","gsc-bank"); ?></th><?php
						$total_liabilities_previous = floatval($previous_year['capital']) + floatval($previous_year['reserves_&_surplus']) + floatval($previous_year['deposits']) + floatval($previous_year['borrowings']) + floatval($previous_year['other_liabilities']);

						$total_liabilities_current = floatval($current_year['capital']) + floatval($current_year['reserves_&_surplus']) + floatval($current_year['deposits']) + floatval($current_year['borrowings']) + floatval($current_year['other_liabilities']);
					?><th scope="col"><?php echo $total_liabilities_previous; ?></th>
					<th scope="col"><?php echo $total_liabilities_current; ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php _e("CASH AND BANK BALANCES","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['cash_and_bank_balances']); ?></td>
					<td><?php echo esc_html($current_year['cash_and_bank_balances']); ?></td>
				</tr>
				<tr>
					<td><?php _e("INVESTMENTS","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['investments']); ?></td>
					<td><?php echo esc_html($current_year['investments']); ?></td>
				</tr>
				<tr>
					<td><?php _e("LOANS AND ADVANCES","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['loans_and_advances']); ?></td>
					<td><?php echo esc_html($current_year['loans_and_advances']); ?></td>
				</tr>
				<tr>
					<td><?php _e("OTHER ASSETS","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['other_assets']); ?></td>
					<td><?php echo esc_html($current_year['other_assets']); ?></td>
				</tr>
			</tbody>
			<thead>
				<tr>
					<th scope="col"><?php _e("TOTAL ASSETS","gsc-bank"); ?></th><?php
						$total_assets_previous = floatval($previous_year['cash_and_bank_balances']) + floatval($previous_year['investments']) + floatval($previous_year['deposits']) + floatval($previous_year['loans_and_advances']) + floatval($previous_year['other_assets']);

						$total_assets_current = floatval($current_year['cash_and_bank_balances']) + floatval($current_year['investments']) + floatval($current_year['deposits']) + floatval($current_year['loans_and_advances']) + floatval($current_year['other_assets']);
					?><th scope="col"><?php echo $total_assets_previous; ?></th>
					<th scope="col"><?php echo $total_assets_current; ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><strong class="text-g"><?php _e("PROFIT & LOSS ACCOUNT","gsc-bank"); ?></strong></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><?php _e("INTEREST INCOME","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['interest_income']); ?></td>
					<td><?php echo esc_html($current_year['interest_income']); ?></td>
				</tr>
				<tr>
					<td><?php _e("OTHER INCOME","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['other_income']); ?></td>
					<td><?php echo esc_html($current_year['other_income']); ?></td>
				</tr>
			</tbody>
			<thead>
				<tr>
					<th scope="col"><?php _e("TOTAL ASSETS","gsc-bank"); ?></th><?php
						$total_income_previous = floatval($previous_year['interest_income']) + floatval($previous_year['other_income']);

						$total_income_current = floatval($current_year['interest_income']) + floatval($current_year['other_income']);
					?><th scope="col"><?php echo esc_html($total_income_previous); ?></th>
					<th scope="col"><?php echo esc_html($total_income_current); ?></th>
				</tr>
			</thead>
			<tbody>
				
				<tr>
					<td><?php _e("INTEREST EXPENDITURE","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['interest_expenditure']); ?></td>
					<td><?php echo esc_html($current_year['interest_expenditure']); ?></td>
				</tr>
				<tr>
					<td><?php _e("OTHER EXPENDITURE","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['other_expenditure']); ?></td>
					<td><?php echo esc_html($current_year['other_expenditure']); ?></td>
				</tr>
			</tbody>
			<thead>
				<tr>
					<th scope="col"><?php _e("TOTAL EXPENDITURE","gsc-bank"); ?></th><?php
						$total_expenditure_previous = floatval($previous_year['interest_expenditure']) + floatval($previous_year['other_expenditure']);

						$total_expenditure_current = floatval($current_year['interest_expenditure']) + floatval($current_year['other_expenditure']);
					?><th scope="col"><?php echo esc_html($total_expenditure_previous); ?></th>
					<th scope="col"><?php echo esc_html($total_expenditure_current); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php _e("PROFIT/LOSS","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['profit__loss']); ?></td>
					<td><?php echo esc_html($current_year['profit__loss']); ?></td>
				</tr>
			</tbody>
			<thead>
				<tr>
					<th scope="col"><?php _e("OTHER WORKING RESULT","gsc-bank"); ?></th>
					<th scope="col"><?php echo ''; ?></th>
					<th scope="col"><?php echo ''; ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php _e("CD RATIO (%)","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['cd_ratio']); ?></td>
					<td><?php echo esc_html($current_year['cd_ratio']); ?></td>
				</tr>
				<tr>
					<td><?php _e("RECOVERY PERFORMANCE (%)","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['recovery_performance_']); ?></td>
					<td><?php echo esc_html($current_year['recovery_performance_']); ?></td>
				</tr>
				<tr>
					<td><?php _e("GROSS NPAS","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['gross_npas']); ?></td>
					<td><?php echo esc_html($current_year['gross_npas']); ?></td>
				</tr>
				<tr>
					<td><?php _e("NET NPAS","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['net_npas']); ?></td>
					<td><?php echo esc_html($current_year['net_npas']); ?></td>
				</tr>
				<tr>
					<td><?php _e("% OF GROSS NPAS TO TOTAL ADVANCES","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['%_of_gross_npas_to_total_advances']); ?></td>
					<td><?php echo esc_html($current_year['%_of_gross_npas_to_total_advances']); ?></td>
				</tr>
				<tr>
					<td><?php _e("% OF NET NPAS TO NET LOANS","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['%_of_net_npas_to_net_loans']); ?></td>
					<td><?php echo esc_html($current_year['%_of_net_npas_to_net_loans']); ?></td>
				</tr>
				<tr>
					<td><?php _e("CAPITAL ADEQUACY RATIO (%)","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['capital_adequency_ratio']); ?></td>
					<td><?php echo esc_html($current_year['capital_adequency_ratio']); ?></td>
				</tr>
				<tr>
					<td><?php _e("NET WORTH","gsc-bank"); ?></td>
					<td><?php echo esc_html($previous_year['net_worth']); ?></td>
					<td><?php echo esc_html($current_year['net_worth']); ?></td>
				</tr>
			</tbody>
        </table>
    </div><?php
	return ob_get_clean();
}

add_action("wp_enqueue_scripts", "gsc_enqueueu_chart_scripts");
function gsc_enqueueu_chart_scripts() {
	global $post;
	$labels = array(
		'share_capital' => __("Share Capital", "gsc-bank"),
		'reserves_and_other_funds' => __("Reserves and Other Funds", "gsc-bank"),
		'total_advances' => __("Total Advances", "gsc-bank"),
		'deposits' => __("Share Capital", "gsc-bank"),
		'profit__loss' => __("Deposits", "gsc-bank"),
		'dividend' => __("Dividend", "gsc-bank"),
	);

	$yearly_performance = get_field("yearly_performance", $post->ID);
	if(empty($yearly_performance)) {
		return;
	}
	$share_capital = array();
	$reserves_and_other_funds = array();
	$total_advances = array();
	$deposits = array();
	$profit__loss = array();
	$dividend = array();

	$yearsArr = array();
	foreach ($yearly_performance as $key => $performance) {
		$year = $performance['year'];
		$yearsArr[] = $year;
		$share_capital[$year] = $performance['share_capital'];
		$reserves_and_other_funds[$year] = $performance['reserves_and_other_funds'];
		$total_advances[$year] = $performance['total_advances'];
		$deposits[$year] = $performance['deposits'];
		$profit__loss[$year] = $performance['profit__loss'];
		$dividend[$year] = $performance['dividend'];
	}

	$PerformanceArr = array(
		'share_capital' => $share_capital,
		'reserves_and_other_funds' => $reserves_and_other_funds,
		'total_advances' => $total_advances,
		'deposits' => $deposits,
		'profit__loss' => $profit__loss,
		'dividend' => $dividend,
	);

	if(has_shortcode($post->post_content, 'gsc_financial_statistics_table')) {
		wp_enqueue_script("chart-table", get_stylesheet_directory_uri()."/js/chart/chart.js", array('jquery'), '4.4.3', true);
		wp_enqueue_script("gsc-chart", get_stylesheet_directory_uri()."/js/gsc-chart.js", array('jquery'), '1.0', true);
		wp_localize_script("gsc-chart", "gsc_obj", array("year_labels" => $yearsArr, 'share_capital' => array_values($share_capital), 'reserves_and_other_funds' => array_values($reserves_and_other_funds), 'total_advances' => array_values($total_advances), 'deposits' => array_values($deposits), 'profit__loss' => array_values($profit__loss)));
	}
}

/*Unclaimed Accounts*/

function mynewlearnshotcode()
{
?>
<h3>Search for details of unclaimed accounts</h3>
	<form  method="GET" action="">
    <input type="text" class="custom-search" placeholder="Search Name" value="" name="fs" required="">
    <input type="text" class="custom-search" placeholder="Search Address" value="" name="ss" >
	<input type="submit" name="submit" class="btn btn-primary btn-sm " value="Search">
    </form>
<?php
       if(isset($_REQUEST['submit'])){
		
		$search = $_GET['fs'];
		$ssearch = $_GET['ss'];
	    global $wpdb;
        $result = $wpdb->get_results ( "SELECT * FROM cust_data  where (`accout_name`  LIKE '%".$search."%'  AND `address_one`  LIKE '%".$ssearch."%' ) OR (`accout_name`  LIKE '%".$search."%' 
		                              AND  `address_four`  LIKE '%".$ssearch."%' ) OR (`accout_name`  LIKE '%".$search."%' 
		                              AND  `address_two`  LIKE '%".$ssearch."%' ) OR (`accout_name`  LIKE '%".$search."%' 
		                              AND  `address_three`  LIKE '%".$ssearch."%' ) ");
         
		 echo  '<table class="table table-bordered "><thead>';
		 echo '<tr><th class="">Name</th><th class="">Address</th>';		
		 
		 foreach ( $result as $print )
		 {
	     echo "<tr ><td>$print->accout_name</td><td>$print->address_one "," $print->address_two "," $print->address_three "," $print->address_four</td></tr>";
         }
	     echo '</thead>';
		 echo '</table>';
         if (empty($result)) 
		 { 
	      echo 'No results found'; 
         }
    }
}	
add_shortcode('insetfirst','mynewlearnshotcode');

