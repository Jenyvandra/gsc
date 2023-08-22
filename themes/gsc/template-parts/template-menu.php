<?php
/**
 * Template Name: Menu
 */
 get_header();
?>
<header class="site-header">
                <div class="container">
                    <div class="wrap">
                        <div class="nav-toggle"><i></i></div>
                      
                        <div class="main-menu">
                            <ul id="main-menu" class="d-flex">
                                <?php
                                // Get the menu items from the WordPress menu
                                $menu_items = wp_get_nav_menu_items('header-menu');

                                foreach ($menu_items as $menu_item) {
                                    // Get the submenu items from the ACF Repeater field
                                    $submenu_items = get_field('sub_menu', $menu_item->ID);

                                    // Check if the current menu item has submenu items
                                    $has_submenu = !empty($submenu_items) && is_array($submenu_items);
                                    $has_dropdown_class = $has_submenu ? 'has-dropdown' : '';

                                    echo '<li class="' . $has_dropdown_class . '">';
                                    
                                    $menu_icon = get_field('menu_icon', $menu_item->ID);
                                    
                                    echo '<a href="' . $menu_item->url . '"><img src="' . $menu_icon. '" >' . $menu_item->title . '</a>';

                                    if ($has_submenu) {
                                        echo '<div class="dropdown-menu dropdown-menu-large">';
                                        echo '<div class="two-col-layout">';
                                        echo '<div class="col8">';

                                        foreach ($submenu_items as $submenu_item) {
                                            echo '<div>';
                                            echo '<h4><a href="' . $submenu_item['sub_menu_title']['url'] . '">' . $submenu_item['sub_menu_title']['title'] . '</a></h4>';
                                            echo '<p>' . $submenu_item['description'] . '</p>';
                                            echo '</div>';
                                        }

                                        echo '</div>';
                                        echo '<div class="col4">';
                                        echo '<img src="' . site_url() . '/wp-content/uploads/nav-image.jpg" alt="">';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    }

                                    echo '</li>';
                                }
                                ?>
                            </ul>
                        </div>


                        <!-- <div class="main-menu">
                            <ul id="main-menu" class="d-flex">
                                <li class='has-dropdown'><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/accounts-nav-1.png" alt="">Accounts</a>
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
                                                <img src="<?php echo site_url(); ?>/wp-content/uploads/nav-image.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class='has-dropdown'><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/loans-nav.png" alt="">Loans</a>
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
                                                <img src="<?php echo site_url(); ?>/wp-content/uploads/nav-image.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class='has-dropdown'><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/lockers-nav.png" alt="">Lockers</a>
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
                                                <img src="<?php echo site_url(); ?>/wp-content/uploads/nav-image.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class='has-dropdown'><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/auto-vault-nav.png" alt="">Auto Vault</a>
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
                                                <img src="<?php echo site_url(); ?>/wp-content/uploads/nav-image.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class='has-dropdown'><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/insurance-nav.png" alt="">Insurance</a>
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
                                                <img src="<?php echo site_url(); ?>/wp-content/uploads/nav-image.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class='has-dropdown'><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/d-banking-nav.png" alt="">Digital Banking</a></li>
                                <li class='has-dropdown'><a href="#"><img src="<?php echo site_url(); ?>/wp-content/uploads/offers-nav.png" alt="">Offers</a>
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
                                                <img src="<?php echo site_url(); ?>/wp-content/uploads/nav-image.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div> -->
                        <div><a href="<?php echo site_url(); ?>/cyber-awareness/" class="btn">Cyber Awareness</a></div>
                    </div>
                </div>
            </header>
<?php
get_footer();
?>