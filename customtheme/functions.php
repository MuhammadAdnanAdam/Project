<?php
// Enable support for title tag (SEO optimization)
add_theme_support('title-tag');

// Enable support for post thumbnails
add_theme_support('post-thumbnails');

// Register primary navigation
register_nav_menus(array(
    'primary-menu' => __('Primary Menu', 'custom-theme'),
));

// Remove wordpress version
remove_action('wp_head', 'wp_generator');
function remove_wordpress_version()
{
    return '';
}
add_filter('the_generator', 'remove_wordpress_version');

// Enqueue necessary styles and scripts for optimal theme performance
function custom_scripts()
{
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/sass/style.css');
    wp_enqueue_style('bootstrap-css', "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css");
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', ['jquery'], 1, true);
    // wp_enqueue_script('popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', ['jquery'], 1, true);
    // wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', ['jquery'], 1, true);
}
add_action('wp_enqueue_scripts', 'custom_scripts');

// Enable support for custom login logo
function custom_login_logo()
{
    echo '<style type="text/css">
        #login h1 a {
            background-image: url(' . get_template_directory_uri() . '/assets/img/logo.png) !important;
            background-size: auto !important;
            width: 100% !important;
            height: 80px !important;
        }
    </style>';
}
add_action('login_head', 'custom_login_logo');

// Enable support for custom post type
function my_custom_post_type()
{
    register_post_type('projects', array(
        'labels' => array(
            'name' => __('Projects', 'custom-theme'),
            'singular_name' => __('Projects', 'custom-theme'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
    ));
}
add_action('init', 'my_custom_post_type');

/**
 * Register Custom Navigation Walker
 */
function register_navwalker()
{
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

function prefix_modify_nav_menu_args($args)
{
    return array_merge($args, array(
        'walker' => new WP_Bootstrap_Navwalker(),
    ));
}
add_filter('wp_nav_menu_args', 'prefix_modify_nav_menu_args');
add_filter('nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3);


/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute($atts, $item, $args)
{
    if (is_a($args->walker, 'WP_Bootstrap_Navwalker')) {
        if (array_key_exists('data-toggle', $atts)) {
            unset($atts['data-toggle']);
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}

// Custom Api
function register_custom_api_endpoints()
{
    register_rest_route('custom/v1', '/projects/', array(
        'methods' => 'GET',
        'callback' => 'get_projects_list',
    ));
}
add_action('rest_api_init', 'register_custom_api_endpoints');


function get_projects_list(WP_REST_Request $request)
{
    $args = array(
        'post_type' => 'projects',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    );

    $projects = new WP_Query($args);

    if ($projects->have_posts()) {
        $data = [];

        while ($projects->have_posts()) {
            $projects->the_post();

            $start_date = get_field('project_start_date');
            $end_date = get_field('project_end_date');


            $data[] = array(
                'title' => get_the_title(),
                'url' => get_permalink(),
                'start_date' => $start_date ? $start_date : 'N/A',
                'end_date' => $end_date ? $end_date : 'N/A',
            );
        }

        wp_reset_postdata();

        return new WP_REST_Response($data, 200);
    } else {
        return new WP_REST_Response('No projects found', 404);
    }
}

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'     => 'Theme Options',
        'menu_title'    => 'Theme Options',
        'menu_slug'     => 'theme-options',
        'capability'    => 'edit_posts',
        'redirect'        => false,
        'parent_slug' => '',
        'position' => false,
        'icon_url' => false,
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Header',
        'menu_title'    => 'Header',
        'menu_slug'     => 'theme-options-header',
        'capability'    => 'edit_posts',
        'redirect'        => false,
        'parent_slug' => 'theme-options',
        'position' => false,
        'icon_url' => false,
        'redirect' => false
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Footer',
        'menu_title'    => 'Footer',
        'menu_slug'     => 'theme-options-footer',
        'capability'    => 'edit_posts',
        'redirect'        => false,
        'parent_slug' => 'theme-options',
        'position' => false,
        'icon_url' => false,
        'redirect' => false
    ));
}
