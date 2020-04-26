<?php
if (!defined('TOTALLY_VER')) {
    define('TOTALLY_VER', '1.1.2');
}

function totally_dequeue_script() {
    wp_dequeue_script('total-custom');
    wp_dequeue_script('total-fonts');
}

add_action('wp_print_scripts', 'totally_dequeue_script', 100);

function totally_slug_setup() {
    load_child_theme_textdomain( 'totally', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'totally_slug_setup' );

add_action('wp_enqueue_scripts', 'totally_enqueue_scripts');

function totally_enqueue_scripts() {
    wp_enqueue_style('totally-parent-style', get_template_directory_uri() . '/style.css', array(), TOTALLY_VER);
    wp_enqueue_style('totally-style', get_stylesheet_directory_uri() . '/style.css', array('totally-parent-style'), TOTALLY_VER);
    wp_add_inline_style('totally-style', totally_dymanic_styles());
    wp_enqueue_script('totally-custom', get_stylesheet_directory_uri() . '/js/totally-custom.js', array('jquery'), TOTALLY_VER, true);
    wp_enqueue_style('totally-fonts', totally_fonts_url(), array(), NULL);
}

function totally_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Top Header Widget', 'totally'),
        'id' => 'totally-top-header-widget',
        'description' => esc_html__('Add widgets here to appear in your Top Header.', 'totally'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
        'name' => esc_html__('Main Header Widget', 'totally'),
        'id' => 'totally-main-header-widget',
        'description' => esc_html__('Add widgets here to appear in your Top Header.', 'totally'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
}

add_action('widgets_init', 'totally_widgets_init');

add_filter('wp_nav_menu_items', 'totally_add_link', 10, 2);

function totally_add_link($items, $args) {
    if ($args->theme_location == 'primary') {
        $totally_mh_button_text = get_theme_mod('totally_mh_button_text');
        $totally_mh_button_link = get_theme_mod('totally_mh_button_link');

        if ($totally_mh_button_link && $totally_mh_button_text) {
            $items .= '<li class="ht-button-menu"><a href="' . esc_url($totally_mh_button_link) . '">' . esc_html($totally_mh_button_text) . '</a></li>';
        }
    }
    return $items;
}

function totally_fonts_url() {
    $fonts_url = '';
    $fonts = array();
    $subsets = 'latin,latin-ext';

    /*
     * Translators: If there are characters in your language that are not supported
     * by Open Sans, translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Poppins font: on or off', 'totally')) {
        $fonts[] = 'Poppins:300,300i,400,400i,500,700,700i';
    }

    /*
     * Translators: If there are characters in your language that are not supported
     * by Inconsolata, translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Teko font: on or off', 'totally')) {
        $fonts[] = 'Teko:300,400,500,600,700';
    }

    /*
     * Translators: To add an additional character subset specific to your language,
     * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
     */
    $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'totally');

    if ('cyrillic' == $subset) {
        $subsets .= ',cyrillic,cyrillic-ext';
    } elseif ('greek' == $subset) {
        $subsets .= ',greek,greek-ext';
    } elseif ('devanagari' == $subset) {
        $subsets .= ',devanagari';
    } elseif ('vietnamese' == $subset) {
        $subsets .= ',vietnamese';
    }

    if ($fonts) {
        $fonts_url = add_query_arg(array(
            'family' => urlencode(implode('|', $fonts)),
            'subset' => urlencode($subsets),
                ), '//fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

function totally_dymanic_styles() {
    $color = get_theme_mod('total_template_color', '#FFC107');
    $color_rgba = totally_hex2rgba($color, 0.9);
    $totally_titlebar_background = get_theme_mod('totally_titlebar_background', get_stylesheet_directory_uri(). '/images/banner-image.jpg');
    $custom_css = "
        body #ht-site-navigation .ht-nav-wrap, 
        body .ht-portfolio-cat-name:hover, 
        body .ht-portfolio-cat-name.active,
        body .ht-blog-date,
        body .ht-section-title:before,
        body .ht-team-detail,
        body .ht-team-detail:hover,
        body .ht-sticky #ht-site-navigation,
        body .ht-top-header,
        body .ht-main-navigation .ht-menu{background:" . sanitize_hex_color($color) . "}
        body .ht-team-detail{background:" . totally_sanitize_color_alpha($color_rgba) . "}
        body .ht-featured-post h5, body .ht-featured-link a:hover, body .ht-contact-block i{color:" . sanitize_hex_color($color) . "}
        body .ht-main-header{background-image: url(". esc_url($totally_titlebar_background) .")}
    ";

    return totally_css_strip_whitespace($custom_css);
}

function totally_css_strip_whitespace($css) {
    $replace = array(
        "#/\*.*?\*/#s" => "", // Strip C style comments.
        "#\s\s+#" => " ", // Strip excess whitespace.
    );
    $search = array_keys($replace);
    $css = preg_replace($search, $replace, $css);

    $replace = array(
        ": " => ":",
        "; " => ";",
        " {" => "{",
        " }" => "}",
        ", " => ",",
        "{ " => "{",
        ";}" => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} " => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys($replace);
    $css = str_replace($search, $replace, $css);

    return trim($css);
}

function totally_hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if (empty($color))
        return $default;

    //Sanitize $color if "#" is provided 
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }

    //Return rgb(a) color string
    return $output;
}

function totally_sanitize_color_alpha($color) {
    $color = str_replace('#', '', $color);
    if ('' === $color) {
        return '';
    }

    // 3 or 6 hex digits, or the empty string.
    if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', '#' . $color)) {
        // convert to rgb
        $colour = $color;
        if (strlen($colour) == 6) {
            list( $r, $g, $b ) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
        } elseif (strlen($colour) == 3) {
            list( $r, $g, $b ) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);
        return 'rgba(' . join(',', array('r' => $r, 'g' => $g, 'b' => $b, 'a' => 1)) . ')';
    }

    return strpos(trim($color), 'rgb') !== false ? $color : false;
}

function totally_in_range($input, $min, $max) {
    if ($input < $min) {
        $input = $min;
    }
    if ($input > $max) {
        $input = $max;
    }
    return $input;
}

/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer.php';
