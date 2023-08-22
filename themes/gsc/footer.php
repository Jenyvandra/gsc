<?php
/**
 * Footer
 *
 * @package WordPress
 * @subpackage GSC BANK
 * @since GSC BANK 1.0
 */


?>

<?php
$footer_page_id = 113;
$footer_page = get_post($footer_page_id);
echo apply_filters('the_content', $footer_page->post_content);

?>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/owl-carousel.min.js"></script>

<script type="text/javascript">
        (function ($) {
            'use strict';
            $('#bankService').owlCarousel({
                loop: true,
                margin: 30,
                nav: true,
                dots: false,
				autoHeight:true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            })

        })(jQuery); 
    </script> 

<script type="text/javascript">
        (function ($) {
            'use strict';
            $('#owl-demo').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                dots: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })
			$( ".owl-next").html('<i class="fa-solid fa-arrow-right" style="color: #fafafa;"></i>');
			$( ".owl-prev").html('<i class="fa-solid fa-arrow-left" style="color: #fafafa;"></i>');

        })(jQuery); 
</script>
<script>
    // Main Navigation
    ( function( $ ) {
        $( '.nav-toggle' ).on( 'click', function ( event ) {
        event.preventDefault();
        event.stopPropagation();
        $( 'body' ).toggleClass( 'menu-open' );
        });
        $( '.site-header .main-menu ul li' ).each( function ( e ) {
        if ( $( this ).hasClass( 'has-dropdown' ) ) {
            $( this ).prepend( '<i class="arrow-down"></i>' );
        }
        });
        $( '.site-header .main-menu ul li .arrow-down' ).on( 'click', function ( event ) {
        event.preventDefault();
        event.stopPropagation();
        if ($( this ).parent( 'li' ).hasClass( 'active-submenu' ) ) {
            $( this ).parent( 'li' ).toggleClass( 'active-submenu' );
        } else {
            $(".site-header .main-menu ul li").removeClass("active-submenu");
            $( this ).parent( 'li' ).addClass( 'active-submenu' );
        }
        });
    } )( jQuery );


    // Toggal
    $(document).ready(function(){
        $(".lang-button").click(function(){
            $(".lang-section").toggle();
        });
        $(".banking-button").click(function(){
            $(".banking-section").toggle();
        });
    });
</script>

<script src="https://kit.fontawesome.com/629dffd7a0.js" crossorigin="anonymous"></script>

<?php if(is_page(309)): ?>

<script src="<?php echo site_url(); ?>/wp-content/themes/gsc-bank/js/emicalc-lib.js"></script>
<script src="<?php echo site_url(); ?>/wp-content/themes/gsc-bank/js/emicalc-main.min.js"></script>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
