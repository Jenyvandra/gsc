<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package borrow
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	
<?php global $borrow_option; ?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	
	<?php if(is_page(309)): ?>
	<link href="<?php echo site_url(); ?>/wp-content/themes/gsc-bank/css/widget.css" rel="stylesheet">
	<?php endif; ?>

	
     <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8BQRZMMMBV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8BQRZMMMBV');
</script>

    <!-- Favicons
    ================================================== -->
    <?php borrow_custom_favicon(); ?>

<?php wp_head(); ?>
</head>
<body <?php // body_class(); ?>>
	
	
	
	<!-- ################  START CHAIRMAN's MESSAGE ######################### -->
	
	<?php   if ( is_page(34) ) { 
?>
 <div id="slideoutprofile">
     <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/03/gsc_chairmen.gif" style=" width:180px; height:180px;" alt="sidetabindex" />
     <div id="slideout_innerprofile">
     <div class="slide-out-divprofile">
    
The cooperative sector has been playing distinct and significant role in the process of socio-economic development of the country. Therefore, cooperatives have been accepted as the best agency for agricultural credit with their organizational potential to reach millions of farmers and thereby establish the grass-root contacts. Cooperatives are a major economic force in developed countries and a powerful business model in developing ones.
<a href="about-us/#chairmans-message" class="btn btn-xs btn-primary " style="padding:4px 14px 4px; float:right;">View more</a>	
		</div>
  </div>
</div>


<?php } elseif( is_page(124) ) {

?>
 <div class="option one"></div>

<?php } 
else {
echo  '<div class="option one"></div>';
}

?>
	
	
	<!-- ################  END CHAIRMAN's MESSAGE ######################### -->
	
	
	
	<!-- ################  START APPLY NOR (LEFT SIDE) ########################## -->
	<div id="slideout">
  <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/02/gsc-apply-button.png" alt="sidetabindex" />
  <div id="slideout_inner">
     <div class="slide-out-div">
           <div class="widget-footer">

<ul class="listnone">
<li><a href="#" class="popmake-4219">Account</a></li>
<li><a href="#" class="popmake-4219">Fixed Deposit</a></li>
<li><a href="#" class="popmake-4219">RuPay Debit Card</a></li>
<li><a href="#" class="popmake-4219">Home Loan</a></li>
<li><a href="#" class="popmake-4219">Vehicle Loan</a></li>
</ul>
			</div>
        </div>
   </div>
</div>
<!-- ################  END APPLY NOR (LEFT SIDE) ######################### -->

	
<!-- ################  START FIXED DEPOSITS BLOCKS ######################### -->
	
	<div id="slidetabindexout">
    <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/02/fd-rates.png" alt="sidetabindex" />
    <div id="slidetabindexout_inner">
    <div class="slideindextab-out-div">
    <div class="lender-listing">
    <div class="lender-rate-box">
    <div class="lender-ads-rate" style="border-bottom: 1px solid #d0caca;">
    <small>Fixed Deposit</small>
    <h3 class="lender-rate-value">7.25%</h3>
	<small>Individual (365 Days)</small>
    </div>
    <div class="lender-compare-rate" style="border-bottom: 1px solid #d0caca;">
    <h3 class="lender-rate-value">7.75%</h3>
	<small>Senior Citizen (365 Days)</small>
    </div>
    </div>
    <a href="<?php echo site_url(); ?>/fixed-recurring-deposit/" style="margin-left: 94px;" class="btn-link text-center"> More Rates</a>
     <div class="lender-actions popmake-4219">
	 <a href="#" class="btn btn-primary btn-block">Apply Now</a>
	</div>
    </div>
	</div>
	</div>
    </div>
	
	<!-- ################  END FIXED DEPOSITS BLOCKS ######################### -->
	

	
	
	<div id="reversing" class="animation360"> 
			<a href="<?php echo site_url(); ?>/offers/">
			    <img src="<?php echo site_url(); ?>/wp-content/uploads/2019/12/Symbole_3.png" width="100px" height="200px" class="popmap" alt="offer-logo">
			</a>
	     </div>
	<script type="text/javascript">

jQuery(document).ready(function() {

    setTimeout(function() {
        popupoffer()
    }, 2000);
});
function popupoffer() {
    if (jQuery("#reversing").hasClass("offerreverse")) {
        jQuery('#reversing').removeClass('offerreverse').addClass('animation360');
        error();
    } else if (jQuery("#reversing").hasClass("animation360")) {
        jQuery('#reversing').removeClass('animation360').addClass('offerreverse');
        error();
    }
}
function error() {
    setTimeout(function() {
        popupoffer()
    }, 3000);

}

</script>
	
<?php if(isset($borrow_option['theme_layout']) and $borrow_option['theme_layout']=="boxed_version" ){ ?>
<!-- Open .boxed-wrapper -->
<div class="boxed-wrapper">
<?php } ?>

<?php 
    if(isset($borrow_option['version_type']) and $borrow_option['version_type']=="header2" ){
        get_template_part('framework/headers/header-2'); 
    }elseif(isset($borrow_option['version_type']) and $borrow_option['version_type']=="header3" ){
        get_template_part('framework/headers/header-3'); 
    }elseif(isset($borrow_option['version_type']) and $borrow_option['version_type']=="header_bank" ){
        get_template_part('framework/headers/header-bank'); 
    }else{ 
?>

	
<!-- header close -->
	
	<div class="header-top">
			<div class="top">
				<div class="container">
				<?php $logo = get_field( 'header_logo', 'option' ); ?>
					<div class="logo"><a href="<?php echo site_url();?>" rel="home"><img src="<?php echo site_url(); ?>/wp-content/uploads/2019/12/gsc-bank-logo-1.png" class="attachment-full size-full" alt="" loading="lazy" /></a> </div>
					<div class="topnav">
						
						<ul>
							<li><a href="#">About Us</a></li>
							<li><a href="#">Chairman's Message</a></li>
							<li><a href="#">Contact Us</a></li>
						</ul> 
						
					</div>
					<div class="header-right">
						<ul class="links">
							<li><a href="#">Branch Locator</a></li>
							<li><a href="#">Social media QR  <img src="https://team4.devhostserver.com/gscbank/wp-content/uploads/qr-small.png" width="16" height="17" alt=""></a></li>
						</ul>
						<div class="btn-group">
						
							<a href="#" class="btn lang-button">English <img src="https://team4.devhostserver.com/gscbank/wp-content/uploads/download-arrow.png" alt=""></a> 
							<span class="lang-section" style="display:none ;">
								<ul>
								<li>
									<?php echo do_shortcode('[gtranslate]'); ?>
								</li>
									<!-- <li><a href="#">Gujarati</a></li>
									<li><a href="#">Hindi</a></li> -->
								</ul>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="bottom">
				<div class="container">
					<div class="search-sec">
						<form>
							<input type="text" name="s" id="s" value="Search" class="form-control" onblur="if(this.value=='')this.value='Search'" onfocus="if(this.value=='Search')this.value=''" required/>
        	                            <input type="hidden" value="submit" />
							<button type="submit"  alt="" style="position:absolute;  top: 8px; right: 15px; border: 0; cursor: pointer;width: 16px;height: 16px; padding: 0; margin: 0;  background-image: url('https://team4.devhostserver.com/gscbank/wp-content/uploads/search-icon.png');" 	>
						</form>

    
					</div>
					<div class="right">	
						<div class="whatsapp-b">
							<a href="#">WhatsApp Banking</a>
						</div>
						<div class="banking-b">
							<a href="#" class="banking-button">Internet Banking</a>
							<ul class="banking-section" style="display: none;">
								<li><a href="#"><img src="<?php bloginfo('template_url'); ?>/assets/images/r-banking-icon.png" alt=""> Retail Banking</a></li>
								<li><a href="#"><img src="<?php bloginfo('template_url'); ?>/assets/images/c-banking-icon.png" alt=""> Corporate Banking</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
	</div>
		
		
		
		 <header class="site-header">
		<div class="container">
			<div class="wrap">
				<div class="nav-toggle"><i></i></div>
				<div class="main-menu">
					<ul id="main-menu" class="d-flex">
						<li class='has-dropdown'><a href="#"><img src="https://team4.devhostserver.com/gscbank/wp-content/uploads/accounts-nav.png" alt="">Accounts</a>
							<div class="dropdown-menu dropdown-menu-large">
								<div class="two-col-layout">
									<div class="col8">
										<div>
											<h4><a href="#">Internet Banking</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Mobile Banking</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Bharat BillPay</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">UPI</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">RTGS/NEFT</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">IMPS</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Positive Pay</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
									</div>
									<div class="col4">
										<img src="<?php bloginfo('template_url'); ?>/assets/images/nav-image.jpg" alt="">
									</div>
								</div>
							</div>
						</li>
						<li class='has-dropdown'><a href="#"><img src="https://team4.devhostserver.com/gscbank/wp-content/uploads/loans-nav.png" alt="">Loans</a>
							<div class="dropdown-menu dropdown-menu-large">
								<div class="two-col-layout">
									<div class="col8">
										<div>
											<h4><a href="#">Internet Banking</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Mobile Banking</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Bharat BillPay</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">UPI</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">RTGS/NEFT</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">IMPS</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Positive Pay</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
									</div>
									<div class="col4">
										<img src="<?php bloginfo('template_url'); ?>/assets/images/nav-image.jpg" alt="">
									</div>
								</div>
							</div>
						</li>
						<li class='has-dropdown'><a href="#"><img src="https://team4.devhostserver.com/gscbank/wp-content/uploads/lockers-nav.png" alt="">Lockers</a>
							<div class="dropdown-menu dropdown-menu-large">
								<div class="two-col-layout">
									<div class="col8">
										<div>
											<h4><a href="#">Internet Banking</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Mobile Banking</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Bharat BillPay</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">UPI</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">RTGS/NEFT</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">IMPS</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Positive Pay</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
									</div>
									<div class="col4">
										<img src="<?php bloginfo('template_url'); ?>/assets/images/nav-image.jpg" alt="">
									</div>
								</div>
							</div>
						</li>
						<li class='has-dropdown'><a href="#"><img src="https://team4.devhostserver.com/gscbank/wp-content/uploads/auto-vault-nav.png" alt="">Auto Vault</a>
							<div class="dropdown-menu dropdown-menu-large">
								<div class="two-col-layout">
									<div class="col8">
										<div>
											<h4><a href="#">Internet Banking</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Mobile Banking</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Bharat BillPay</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">UPI</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">RTGS/NEFT</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">IMPS</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Positive Pay</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
									</div>
									<div class="col4">
										<img src="<?php bloginfo('template_url'); ?>/assets/images/nav-image.jpg" alt="">
									</div>
								</div>
							</div>
						</li>
						<li class='has-dropdown'><a href="#"><img src="https://team4.devhostserver.com/gscbank/wp-content/uploads/insurance-nav.png" alt="">Insurance</a>
							<div class="dropdown-menu dropdown-menu-large">
								<div class="two-col-layout">
									<div class="col8">
										<div>
											<h4><a href="#">Internet Banking</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Mobile Banking</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Bharat BillPay</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">UPI</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">RTGS/NEFT</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">IMPS</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Positive Pay</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
									</div>
									<div class="col4">
										<img src="<?php bloginfo('template_url'); ?>/assets/images/nav-image.jpg" alt="">
									</div>
								</div>
							</div>
						</li>
						<li class='has-dropdown'><a href="#"><img src="https://team4.devhostserver.com/gscbank/wp-content/uploads/d-banking-nav.png" alt="">Digital Banking</a></li>
						<li class='has-dropdown'><a href="#"><img src="https://team4.devhostserver.com/gscbank/wp-content/uploads/offers-nav.png" alt="">Offers</a>
							<div class="dropdown-menu dropdown-menu-large">
								<div class="two-col-layout">
									<div class="col8">
										<div>
											<h4><a href="#">Internet Banking</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Mobile Banking</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Bharat BillPay</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">UPI</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">RTGS/NEFT</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">IMPS</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
										<div>
											<h4><a href="#">Positive Pay</a></h4>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit Lorem dolor</p>
										</div>
									</div>
									<div class="col4">
										<img src="<?php bloginfo('template_url'); ?>/assets/images/nav-image.jpg" alt="">
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div><a href="#" class="btn">Cyber Awareness</a></div>
			</div>
		</div>
	</header>
		
		
	
<div class="collapse searchbar" id="searchbar">
  <div class="search-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div class="input-group">
                <input type="text" class="search-query form-control" name="s" placeholder="<?php echo esc_html_e('Search for...','borrow'); ?>" value="<?php echo get_search_query() ?>">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="submit"><?php echo esc_html_e('Go!','borrow'); ?></button>
                </span> 
            </div>
            <!-- /input-group -->
          </form>
        </div>
            <!-- /.col-lg-6 -->
      </div>
    </div>
  </div>
  <a class="search-close" role="button" data-toggle="collapse" href="#searchbar" aria-expanded="true"><i class="fa fa-close"></i></a>
</div>

<?php if($borrow_option['top_head']==true){ ?>
  <div class="top-bar">
    <!-- top-bar -->
    <div class="container">
      <div class="row">
      <?php if($borrow_option['header_text']!=''){ ?>
        <div class="col-md-4"><!-- hidden-xs hidden-sm -->
            <p class="mail-text"><?php echo htmlspecialchars_decode(do_shortcode($borrow_option['header_text'])); ?></p>
        </div>
        <?php } ?>
      <?php if($borrow_option['header_right']!=''){ ?>
        <div class="col-md-8 col-sm-12 text-right col-xs-12">
            <div class="top-nav"> 
              <?php echo htmlspecialchars_decode(do_shortcode($borrow_option['header_right'])); ?>
            </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
<?php } ?>

<div class="header <?php borrow_header_class();  ?>">
  <div class="container">
    <div class="row">
      <div class="col-md-2 "> <!--col-sm-12 col-xs-6 text-center  -->
        <!-- logo -->
        <div class="logo">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php if($borrow_option['logo']['url'] != ''){ ?>
                <img src="<?php echo esc_url($borrow_option['logo']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
            <?php }else{ ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php echo get_bloginfo( 'name' ); ?>">
            <?php } ?>   
          </a>
        </div>
      </div>
      <div class="col-md-8"> <!--col-sm-12 col-xs-12  -->
        <div id="navigation">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '' ) ); ?>
        </div>
      </div>
      <div class="col-md-2 hidden-sm">
          <!-- search -->
         <!-- <div class="search-nav"> <a class="search-btn" role="button" data-toggle="collapse" href="#searchbar" aria-expanded="false"><i class="fa fa-search"></i></a> </div>-->
		  <div class="search-nav"> 
			  <a href="https://dccbinb.com/OnlineGSCB" target="_blank" class="search-btn" role="button">Internet Banking Login</a> </div>
		  
		  
      </div>
    </div>
  </div>
</div>
<?php } ?>
	
  <!--	############  Start Notification ###########  
	
	<marquee style=" color:red; padding-top: 7px;font-weight: 500;font-size: 17px;letter-spacing: 1px;">
	To serve you better, we are upgrading our SFMS systems. As a part of this activity, RTGS/NEFT Services will not be available on 12 June'21 from 00:30 to 12:00 afternoon. We sincerely regret the inconvenience caused.
	</marquee>-->
	
<!--	############ End  Notification ###########  -->	
	
	