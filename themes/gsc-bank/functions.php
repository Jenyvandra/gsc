<?php
/**
 * Borrow Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package borrow
 */

if ( ! class_exists( 'ReduxFramewrk' ) ) {
    require_once( get_template_directory() . '/framework/sample-config.php' );
	function removeDemoModeLink() { // Be sure to rename this function to something more unique
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
		}
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
		}
	}
	add_action('init', 'removeDemoModeLink');
}

if ( ! function_exists( 'borrow_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function borrow_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Borrow Theme, use a find and replace
	 * to change 'borrow' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'borrow', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' ); 

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'borrow' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'audio',
		'image',
		'video',
		'quote',
		'gallery',
	) );	
	
}
endif; // borrow_setup
add_action( 'after_setup_theme', 'borrow_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function borrow_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'borrow_content_width', 640 );
}
add_action( 'after_setup_theme', 'borrow_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function borrow_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'borrow' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Appears in the sidebar section of the site.', 'borrow' ),  
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer One Widget Area', 'borrow' ),
		'id'            => 'footer-area-1',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'borrow' ),
		'before_widget' => '<div id="%1$s" class=" %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Two Widget Area', 'borrow' ),
		'id'            => 'footer-area-2',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'borrow' ),
		'before_widget' => '<div id="%1$s" class=" %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Three Widget Area', 'borrow' ),
		'id'            => 'footer-area-3',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'borrow' ),
		'before_widget' => '<div id="%1$s" class=" %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Fourth Widget Area', 'borrow' ),
		'id'            => 'footer-area-4',
		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'borrow' ),
		'before_widget' => '<div id="%1$s" class=" %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) ); 

}
add_action( 'widgets_init', 'borrow_widgets_init' );

/**
 * Enqueue Google fonts.
 */
function borrow_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $poppins = _x( 'on', 'Poppins font: on or off', 'borrow' );

    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $merriweather = _x( 'on', 'Merriweather font: on or off', 'borrow' );
    
 
    if ( 'off' !== $poppins || 'off' !== $merriweather ) {
        $font_families = array();
  
 
        if ( 'off' !== $poppins ) {
            $font_families[] = 'Poppins:300,400,500,600,700';
        } 

        if ( 'off' !== $merriweather ) {
            $font_families[] = 'Merriweather:300,300i,400,400i,700,700i';
        } 

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}


/**
 * Enqueue scripts and styles.
 */
function borrow_scripts() {
	global $borrow_option;
	$gmap_api = $borrow_option['gmap_api'];
	$protocol = is_ssl() ? 'https' : 'http';

	// Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'gsc-bank-fonts', borrow_fonts_url(), array(), null );

    /** All frontend css files **/ 
    wp_enqueue_style( 'gsc-bank-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');
    wp_enqueue_style( 'gsc-bank-font-awesome', get_template_directory_uri().'/css/font-awesome.min.css');
    wp_enqueue_style( 'gsc-bank-flat-font', get_template_directory_uri().'/css/flat-font-icons/css/fontello.css');
    wp_enqueue_style( 'gsc-bank-fontello', get_template_directory_uri().'/css/fontello/fontello.css');
    wp_enqueue_style( 'gsc-bank-flaticon', get_template_directory_uri().'/css/flaticon.css');
    wp_enqueue_style( 'gsc-bank-animsition', get_template_directory_uri().'/css/animsition.min.css'); 
    wp_enqueue_style( 'gsc-bank-owl-carousel', get_template_directory_uri().'/css/owl.carousel.css');
    wp_enqueue_style( 'gsc-bank-owl-theme', get_template_directory_uri().'/css/owl.theme.css');
    wp_enqueue_style( 'gsc-bank-owl-transitions', get_template_directory_uri().'/css/owl.transitions.css');
    wp_enqueue_style( 'gsc-bank-popup', get_template_directory_uri().'/css/magnific-popup.css');
    wp_enqueue_style( 'gsc-bank-simple-slider', get_template_directory_uri().'/css/simple-slider.css');
    wp_enqueue_style( 'gsc-bank-jquery-ui', get_template_directory_uri().'/css/jquery-ui.css');
	wp_enqueue_style( 'call-now', get_template_directory_uri().'/css/call-now.css');
	
	
	

	wp_enqueue_style( 'borrow-style', get_stylesheet_uri() );	

	/** All frontend javascript files **/ 
	
	

	
	
	wp_enqueue_script( 'borrow-modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'borrow-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20151228', true );

	if($borrow_option['preload-switch']!=false){
        wp_enqueue_script("borrow-jpreLoader", get_template_directory_uri()."/js/royal_preloader.min.js",array(),false,false);
    }

	wp_enqueue_script( "gsc-bank-gmap", "$protocol://maps.googleapis.com/maps/api/js?key=$gmap_api",array('jquery'), '20151228',true);

	wp_enqueue_script( 'gsc-bank-menumaker', get_template_directory_uri() . '/js/menumaker.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'gsc-bank-animsition', get_template_directory_uri() . '/js/animsition.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'gsc-bank-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'gsc-bank-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'gsc-bank-magnific', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'gsc-bank-easing', get_template_directory_uri() . '/js/jquery.easing.min.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'gsc-bank-isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'gsc-bank-simpleslider', get_template_directory_uri() . '/js/simple-slider.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'gsc-bank-jquery-ui', get_template_directory_uri() . '/js/jquery-ui.js', array('jquery'), '20151228', true );
	// UPDATE 6-2018
	wp_enqueue_script( 'gsc-bank-niceselect', get_template_directory_uri() . '/js/jquery.nice-select.min.js', array('jquery'), '20151228', true );
	wp_enqueue_script( 'gsc-bank-fastclick', get_template_directory_uri() . '/js/fastclick.js', array('jquery'), '20151228', true );

	wp_enqueue_script( 'gsc-bank-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '20151228', true );
		
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'borrow_scripts' );

function borrow_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'borrow_mime_types');

//Code Visual Composer.
// Add new Param in Row
if(function_exists('vc_add_param')){
	vc_add_param(
		'vc_row',
		array(
			"type" => "dropdown",
			"heading" => esc_html__('Setup Full width For Row.', 'borrow'),
			"param_name" => "fullwidth",
			"value" => array(   
			                esc_html__('No', 'borrow') => 'no',  
			                esc_html__('Yes', 'borrow') => 'yes',                                                                                
			              ),
			"description" => esc_html__("Select Full width for row : yes or not, Default: No fullwidth", "borrow"),      
        )
    );
    vc_add_param('vc_column',array(
      "type" => "checkbox",
      "heading" => esc_html__('Box Column', 'borrow'),
      "param_name" => "box",
      "value" => "",
      "description" => esc_html__("Section Overlay", 'borrow'), 
      ) 
  	); 
    vc_add_param('vc_column',array(
      "type" => "colorpicker",
      "heading" => esc_html__('Backgound color Box', 'borrow'),
      "param_name" => "bgcolor",
      "value" => "",
      "description" => esc_html__("Select color", 'borrow'), 
      ) 
  	); 	  
}

if(function_exists('vc_remove_param')){
	vc_remove_param( "vc_row", "full_width" );      
}

/**
 * Implement the Custom Meta Boxs.
 */
require get_parent_theme_file_path( '/framework/meta-boxes.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/framework/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_parent_theme_file_path( '/framework/widget/recent-post.php' );

/**
 * Require plugins install for this theme.
 *
 * @since Borrow 1.0
 */
require get_parent_theme_file_path( '/framework/plugin-requires.php' );

/** customize theme option for color **/
require get_parent_theme_file_path( '/framework/color.php' );
/* Generate Quote Ticket */
function genTicketString() {
    $length = 4;
	$month = date('M');
    $characters = "012345678987654321123456789";
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters)-1)];
    }
    return strtoupper($month).'-'.$string;
}
add_shortcode('quoteticket', 'genTicketString');
add_filter('wpcf7_autop_or_not', '__return_false');



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



function mycode()
{
	?>
	
	 <marquee style="font-size:14px;" scrollamount="8" onmouseover="this.stop();"
           onmouseout="this.start();">2. KYC is one time exercise while dealing in securities markets-once KYC is done through a SEBI registered intermediary (Broker, DP, Mutual Fund etc.), you need not undergo the same process again when you approach another intermediary.</marquee>
<?php 

}	
add_shortcode('leftright','mycode');

function mycodeone()
{
	?>
	
	 <marquee style="font-size:14px;" scrollamount="8" onmouseover="this.stop();"
           onmouseout="this.start();">1. Prevent unauthorized transactions in your account Update your mobile numbers, Email IDs with your stock brokers. Receive information of your transactions directly from Exchange on your mobile, Email at the end of the day Issued in the interest of Investors. Prevent Unauthorized Transactions in your demat account Update your Mobile Number with your Depository Participant. Receive alerts on your Registered Mobile for all debit and other important transactions in your demat account directly from CDSL/NSDL on the same day issued in the interest of investors.</marquee>
<?php 

}	
add_shortcode('leftrightsecond','mycodeone');




require get_parent_theme_file_path( '/inc/cpt.php' );
require get_parent_theme_file_path( '/inc/shortcode.php' );


?>