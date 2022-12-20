<?php
function wpdocs_theme_name_scripts()
{
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css', [], '');
    wp_enqueue_style('bootstrap js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js', [], '');  
    wp_enqueue_style('css', get_template_directory_uri() . "/assets/css/index.css", [], '');
    wp_enqueue_script('javascript', get_template_directory_uri() . "/assets/js/main.js", [], '', true);
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css');
    wp_enqueue_style( 'Karla_font', 'https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet', false );
    wp_enqueue_style( 'Cairo_Play_font', 'https://fonts.googleapis.com/css2?family=Cairo+Play:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet', false );  
}

add_action('wp_enqueue_scripts', 'wpdocs_theme_name_scripts');


function remove_admin_login_header()
{ //Haalt witte balk weg in header
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');

add_filter('show_admin_bar', '__return_false');

add_filter('use_block_editor_for_post', '__return_false');
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library');
});

function register_my_menus()
{
    register_nav_menus(
        [
            'header-menu' => __('Header Menu'),
            'extra-menu' => __('Extra Menu'),
        ]
    );
}
add_action('init', 'register_my_menus');

function register_menus()
{

    register_nav_menus(
        array(
            'primary-menu' => _('Primary Menu'),
            'your-preferred-menu-location-id' => _('Title of your menu location'),
        )
    );
}

add_image_size( 'ilias-full', 1920, 1920 );
add_image_size( 'logo', 110, 110 );
add_image_size( 'very-small', 30, 30 );

