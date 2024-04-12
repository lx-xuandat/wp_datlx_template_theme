<?php

define('DATLX_THEME_PATH', dirname(__FILE__));

/**
 * Theme setup.
 */
function aocuoi_setup() {
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'datlx' ),
			'second' => __( 'Second Menu', 'datlx' ),
			'footer' => __( 'Footer Menu', 'datlx' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

    add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'css/editor-style.css' );
}

add_action( 'after_setup_theme', 'aocuoi_setup' );

/**
 * Enqueue theme assets.
 */
function aocuoi_enqueue_scripts() {
	$theme = wp_get_theme();

	wp_enqueue_style( 'tailpress', aocuoi_asset( 'css/app.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'tailpress', aocuoi_asset( 'js/app.js' ), array(), $theme->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'aocuoi_enqueue_scripts' );

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function aocuoi_asset( $path ) {
	if ( wp_get_environment_type() === 'production' ) {
		return get_stylesheet_directory_uri() . '/' . $path;
	}

	return add_query_arg( 'time', time(),  get_stylesheet_directory_uri() . '/' . $path );
}

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The current item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function aocuoi_nav_menu_add_li_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}

	if ( isset( $args->{"li_class_$depth"} ) ) {
		$classes[] = $args->{"li_class_$depth"};
	}
	
	if ( in_array( 'menu-item-has-children', $item->classes ) ) {
        $classes[] = 'nav-item dropdown';
    }

	return $classes;
}

add_filter( 'nav_menu_css_class', 'aocuoi_nav_menu_add_li_class', 10, 4 );

function add_menu_link_class($atts, $item, $args)
{
    // Kiểm tra xem mục menu có phải là một mục con của menu dropdown không
    if (in_array('menu-item-has-children', $item->classes) && $args->depth === 0) {
        // Nếu là mục cha của menu dropdown, thêm các thuộc tính cho dropdown
        $atts['class'] = 'nav-link nav-item dropdown-toggle';
        $atts['data-bs-toggle'] = 'dropdown';
        $atts['aria-expanded'] = 'false';
    } else {
        // Nếu không phải là mục cha hoặc mục con của menu dropdown, chỉ thêm class cho liên kết
        $atts['class'] = 'nav-link nav-item';
    }

	if ($item->menu_item_parent !== '0') {
        // Nếu là mục con của một mục cha, thêm lớp 'dropdown-item'
        $atts['class'] = 'dropdown-item';
    }

    if($item->current) {
		// echo '<pre>';
		// var_dump($item);
        $atts['class'] .= ' active';
    }

	$args->submenu_class = 'dropdown-menu';

    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The current item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function aocuoi_nav_menu_add_submenu_class( $classes, $args, $depth ) {
	if ( isset( $args->submenu_class ) ) {
		$classes[] = $args->submenu_class;
	}

	if ( isset( $args->{"submenu_class_$depth"} ) ) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'aocuoi_nav_menu_add_submenu_class', 10, 3 );

function info($message) {
    // Đường dẫn tới tệp log (thay đổi đường dẫn tùy thuộc vào nơi bạn muốn lưu log)
    $log_file = __DIR__ . '/file.log';
    
    // Nội dung log
    $log_entry = date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL;

    // Ghi log vào tệp
    file_put_contents($log_file, $log_entry, FILE_APPEND);
}

(function () {
	require __DIR__ . '/vendor/autoload.php';
	new Datlx\Avaocuoi\Main();
})();
