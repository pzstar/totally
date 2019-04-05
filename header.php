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
        <div id="ht-page">
            <header id="ht-masthead" class="ht-site-header">
                <div class="ht-top-header">
                    <div class="ht-container">
                        <?php 
                        $totally_left_header_text = get_theme_mod('totally_left_header_text', 'Aveneu Park, Starling, Australia');
                        if($totally_left_header_text){
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
                            foreach($totally_social_icons as $totally_social_icon){
                                $totally_social_link = get_theme_mod('totally_'.$totally_social_icon.'_link');
                                echo '<a href="'.esc_url($totally_social_link).'"><i class="fa fa-'.esc_attr($totally_social_icon).'"></i></a>';
                            }
                            ?>
                            </div>
                            
                            <?php
                            if(is_active_sidebar('totally-top-header-widget')){
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
                        if(is_active_sidebar('totally-main-header-widget')){
                            ?>
                            <div class="ht-main-header-widget">
                                <?php dynamic_sidebar('totally-main-header-widget'); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                
                <nav id="ht-site-navigation" class="ht-main-navigation">
                    <div class="ht-container">
                        <div class="ht-nav-wrap ht-clearfix">
                            <div class="toggle-bar"><span></span></div>
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