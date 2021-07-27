<?php
/**
 * The header for our theme.
 *
 * @package Totally
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <div id="ht-page">
            <a class="skip-link screen-reader-text" href="#ht-content"><?php esc_html_e('Skip to content', 'totally'); ?></a>
            <header id="ht-masthead" class="ht-site-header">
                <div class="ht-top-header">
                    <div class="ht-container">
                        <?php
                        $totally_left_header_text = get_theme_mod('totally_left_header_text', 'Aveneu Park, Starling, Australia');
                        if ($totally_left_header_text) {
                            ?>
                            <div class="ht-left-header">
                                <?php echo wp_kses_post($totally_left_header_text); ?>
                            </div>
                        <?php } ?>

                        <?php
                        $totally_social_icons = array('facebook', 'twitter', 'instagram', 'youtube', 'pinterest', 'linkedin');
                        ?>
                        <div class="ht-right-header">
                            <div class="ht-top-header-social-icons">
                                <?php
                                foreach ($totally_social_icons as $totally_social_icon) {
                                    $totally_social_link = get_theme_mod('totally_' . $totally_social_icon . '_link');
                                    if ($totally_social_link) {
                                        echo '<a href="' . esc_url($totally_social_link) . '" target="_blank"><i class="fa fa-' . esc_attr($totally_social_icon) . '"></i></a>';
                                    }
                                }
                                ?>
                            </div>

                            <?php
                            if (is_active_sidebar('totally-top-header-widget')) {
                                ?>
                                <div class="ht-top-header-widget">
                                    <?php dynamic_sidebar('totally-top-header-widget'); ?>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>

                <div class="ht-middle-header">
                    <div class="ht-container">
                        <div id="ht-site-branding">
                            <?php
                            if (function_exists('has_custom_logo') && has_custom_logo()) :
                                the_custom_logo();
                            else :
                                if (is_front_page()) :
                                    ?>
                                    <h1 class="ht-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                                <?php else : ?>
                                    <p class="ht-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                                <?php endif; ?>
                                <p class="ht-site-description"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('description'); ?></a></p>
                            <?php endif; ?>
                        </div><!-- .site-branding -->

                        <?php
                        if (is_active_sidebar('totally-main-header-widget')) {
                            ?>
                            <div class="ht-main-header-widget">
                                <?php dynamic_sidebar('totally-main-header-widget'); ?>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="ht-site-contact-info">
                                <?php
                                $totally_hci_icon1 = get_theme_mod('totally_hci_icon1', 'fa fa-envelope');
                                $totally_hci_header1 = get_theme_mod('totally_hci_header1', esc_html__('Email Us', 'totally'));
                                $totally_hci_text1 = get_theme_mod('totally_hci_text1', 'info@yourdomain.com');

                                if ($totally_hci_header1 || $totally_hci_text1) {
                                    echo '<div class="ht-contact-block">';
                                    echo '<i class="' . esc_attr($totally_hci_icon1) . '"></i>';

                                    echo '<div class="ht-contact-block-text">';
                                    if ($totally_hci_header1) {
                                        echo '<h4>' . esc_html($totally_hci_header1) . '</h4>';
                                    }

                                    if ($totally_hci_text1) {
                                        echo '<p>' . esc_html($totally_hci_text1) . '</p>';
                                    }
                                    echo '</div></div>';
                                }

                                $totally_hci_icon2 = get_theme_mod('totally_hci_icon2', 'fa fa-phone');
                                $totally_hci_header2 = get_theme_mod('totally_hci_header2', esc_html__('Call Us', 'totally'));
                                $totally_hci_text2 = get_theme_mod('totally_hci_text2', '+01 3434320324');


                                if ($totally_hci_header2 || $totally_hci_text2) {
                                    echo '<div class="ht-contact-block">';
                                    echo '<i class="' . esc_attr($totally_hci_icon2) . '"></i>';

                                    echo '<div class="ht-contact-block-text">';
                                    if ($totally_hci_header1) {
                                        echo '<h4>' . esc_html($totally_hci_header2) . '</h4>';
                                    }

                                    if ($totally_hci_text2) {
                                        echo '<p>' . esc_html($totally_hci_text2) . '</p>';
                                    }
                                    echo '</div></div>';
                                }

                                $totally_hci_icon3 = get_theme_mod('totally_hci_icon3', 'fa fa-map-pin');
                                $totally_hci_header3 = get_theme_mod('totally_hci_header3', esc_html__('Find Us', 'totally'));
                                $totally_hci_text3 = get_theme_mod('totally_hci_text3', '234 Littleton Street');

                                if ($totally_hci_header3 || $totally_hci_text3) {
                                    echo '<div class="ht-contact-block">';
                                    echo '<i class="' . esc_attr($totally_hci_icon3) . '"></i>';

                                    echo '<div class="ht-contact-block-text">';
                                    if ($totally_hci_header3) {
                                        echo '<h4>' . esc_html($totally_hci_header3) . '</h4>';
                                    }

                                    if ($totally_hci_text3) {
                                        echo '<p>' . esc_html($totally_hci_text3) . '</p>';
                                    }
                                    echo '</div></div>';
                                }
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <nav id="ht-site-navigation" class="ht-main-navigation">
                    <div class="ht-container">
                        <div class="ht-nav-wrap ht-clearfix">
                            <a href="#" class="toggle-bar"><span></span></a>
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'container_class' => 'ht-menu ht-clearfix',
                                'menu_class' => 'ht-clearfix',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'fallback_cb' => false
                            ));
                            ?>
                        </div>
                    </div>
                </nav><!-- #ht-site-navigation -->
            </header><!-- #ht-masthead -->

            <div id="ht-content" class="ht-site-content ht-clearfix">