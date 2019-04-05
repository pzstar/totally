<?php

function totally_dequeue_script() {
    wp_dequeue_script('total-custom');
    wp_dequeue_script('total-fonts');
}

add_action('wp_print_scripts', 'totally_dequeue_script', 100);

add_action('wp_enqueue_scripts', 'totally_enqueue_scripts');

function totally_enqueue_scripts() {
    wp_enqueue_style('totally-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('totally-style', get_stylesheet_directory_uri() . '/style.css', array('totally-parent-style'), '1.0');
    wp_add_inline_style('totally-style', totally_dymanic_styles());
    wp_enqueue_script('totally-custom', get_stylesheet_directory_uri() . '/js/totally-custom.js', array('jquery'), '1.0', true);
    wp_enqueue_style('totally-fonts', totally_fonts_url(), array(), null);
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
    if ('off' !== _x('on', 'Poppins font: on or off', 'total')) {
        $fonts[] = 'Poppins:300,300i,400,400i,500,700,700i';
    }

    /*
     * Translators: If there are characters in your language that are not supported
     * by Inconsolata, translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Teko font: on or off', 'total')) {
        $fonts[] = 'Teko:300,400,500,600,700';
    }

    /*
     * Translators: To add an additional character subset specific to your language,
     * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
     */
    $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'total');

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
        body .ht-top-header{background:{$color}}
        body .ht-team-detail{background:{$color_rgba}}
        body .ht-featured-post h5, body .ht-featured-link a:hover{color:{$color}}
        body .ht-main-header{background-image: url({$totally_titlebar_background})}
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

add_filter('pt-ocdi/import_files', 'totally_demo_import_files', 100);

function totally_demo_import_files($array) {
    return array(
        array(
            'import_file_name' => 'Totally Demo Import',
            'local_import_file' => trailingslashit(get_stylesheet_directory()) . 'demo-data/totally-content.xml',
            'local_import_widget_file' => trailingslashit(get_stylesheet_directory()) . 'demo-data/totally-widgets.wie',
            'local_import_customizer_file' => trailingslashit(get_stylesheet_directory()) . 'demo-data/totally-customizer.dat',
            'import_preview_image_url' => 'https://i0.wp.com/themes.svn.wordpress.org/totally/1.0.0/screenshot.png',
            'preview_url' => 'http://demo.hashthemes.com/totally'
        )
    );
}

add_action( 'wp_head', 'totally_remove_actions', 10 );
function totally_remove_actions(){
    remove_action('pt-ocdi/after_import', 'total_after_import_setup');
}

add_action('pt-ocdi/after_import', 'totally_after_import_setup', 30);

function totally_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by('name', 'Primary Menu', 'nav_menu');

    set_theme_mod('nav_menu_locations', array(
        'primary' => $main_menu->term_id,
            )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title('Home Page');
    $blog_page_id = get_page_by_title('Blog');

    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_page_id->ID);
    update_option('page_for_posts', $blog_page_id->ID);
}

/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer.php';
