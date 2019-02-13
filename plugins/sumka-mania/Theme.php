<?php

require_once "includes/ThemeWoocommerce.php";
require_once "includes/Walker_Catalog.php";

class Theme extends ThemeWoocommerce {

	public function __construct() {
		$this->themeSetup();
		$this->enqueueStyles();
		$this->enqueueScripts();
		$this->customHooks();
			$this->registerWidgets();
		$this->registerNavMenus();
		add_action( 'init', function () {
			//$this->registerTaxonomies();
			//$this->registerPostTypes();
		} );
		add_action( 'plugins_loaded', function () {
			$this->ShopSetup();
			$this->ACF();
			$this->GPSI();
		} );
		add_action( 'woocommerce_update_cart_action_cart_updated', 'on_action_cart_updated', 20, 1 );
		//add_action('wp_ajax_action', [$this, 'method']);
		//add_action('wp_ajax_nopriv_action', [$this, 'method']);
	}

	private function themeSetup() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'widgets' );
		show_admin_bar( false );
	}

	private function enqueueStyles() {
		add_action( 'wp_print_styles', function () {
			wp_register_style( 'main', path() . 'assets/css/main.css' );
			wp_enqueue_style( 'main' );
		} );
		add_action( 'admin_enqueue_scripts', function () {
			//wp_enqueue_style('admin-styles', get_template_directory_uri() . '/assets/css/admin.css');
		} );
	}

	private function enqueueScripts() {
		add_action( 'wp_enqueue_scripts', function () {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', path() . 'assets/node_modules/jquery/dist/jquery.min.js' );
			wp_enqueue_script( 'jquery' );
			wp_register_script( 'bootstrap', path() . 'assets/node_modules/bootstrap/dist/js/bootstrap.bundle.js' );
			wp_enqueue_script( 'bootstrap' );
			wp_register_script( 'fancybox', path() . 'assets/node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.js' );
			wp_enqueue_script( 'fancybox' );
			wp_register_script( 'mask', path() . 'assets/node_modules/jquery.maskedinput/src/jquery.maskedinput.js' );
			wp_enqueue_script( 'mask' );
			wp_register_script( 'main', path() . 'assets/js/main.js' );
			wp_enqueue_script( 'main' );
			 wp_localize_script('main', 'AdminAjax',
				 admin_url('admin-ajax.php')
			 );
		} );
	}

	private function customHooks() {
		add_action( 'admin_menu', function () {
			//remove_menu_page( 'edit-comments.php' );
		} );

		//add_image_size('', 0, 0, ['center', 'center']);
		//add_filter('wpcf7_autop_or_not', '__return_false');
		add_filter( 'body_class', function ( $classes ) {

			return $classes;
		} );

		add_action( 'template_redirect', function () {
			if ( isset( $_POST['remove-all'] ) && $_POST['remove-all'] ) {
				WC()->cart->empty_cart();
				wp_redirect( home_url(), 301 );
			}
		} );
	}

	private function registerNavMenus() {
		add_action( 'after_setup_theme', function () {
			register_nav_menus( array( 'header_menu' => 'Меню в шапке', 'footer_menu' => 'Меню в подвале' ) );
		} );

		add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
			$atts['itemprop'] = 'url';

			return $atts;
		}, 10, 3 );

		if ( ! file_exists( plugin_dir_path( __FILE__ ) . 'includes/wp-bootstrap-navwalker.php' ) ) {
			return new WP_Error( 'wp-bootstrap-navwalker-missing', __( 'It appears the wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
		} else {
			require_once plugin_dir_path( __FILE__ ) . 'includes/wp-bootstrap-navwalker.php';
		}

	}

	private function ACF() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			$main = acf_add_options_page( [
				'page_title' => 'Настройки темы',
				'menu_title' => 'Настройки темы',
				'menu_slug'  => 'theme-general-settings',
				'capability' => 'edit_posts',
				'redirect'   => false,
				'position'   => 2,
				'icon_url'   => 'dashicons-admin-customizer',
			] );
		}
	}

	private function GPSI() {
		require_once "includes/GPSI.php";
	}

	public function breadcrumb() {
		require_once "includes/breadcrumb.php";
		breadcrumbs();
	}

	private function registerWidgets() {
		add_action( 'widgets_init', function () {
			register_sidebar( [
				'name'         => "Правая боковая панель сайта",
				'id'           => 'right-sidebar',
				'description'  => 'Эти виджеты будут показаны в правой колонке сайта',
				'before_title' => '<h1>',
				'after_title'  => '</h1>'
			] );
		} );
	}

	private function registerPostTypes() {
		register_post_type( '', [
			'label'         => null,
			'labels'        => [
				'name'               => 'Номера', // основное название для типа записи
				'singular_name'      => 'Номера', // название для одной записи этого типа
				'add_new'            => 'Добавить номер', // для добавления новой записи
				'add_new_item'       => 'Добавление номера', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование номера', // для редактирования типа записи
				'new_item'           => '', // текст новой записи
				'view_item'          => 'Смотреть номер', // для просмотра записи этого типа.
				'search_items'       => 'Искать номера', // для поиска по этим типам записи
				'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
				'menu_name'          => 'Номера', // название меню
			],
			'public'        => true,
			'menu_position' => 3,
			'menu_icon'     => 'dashicons-admin-home',
			'supports'      => array( 'title', 'editor', 'custom-fields', 'thumbnail' ),
			// 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
			'has_archive'   => true,
			'rewrite'       => [ 'slug' => '' ],
		] );
	}

	private function registerTaxonomies() {
		register_taxonomy( 'gallery_cat', [ 'room' ], [
			'label'       => '', // определяется параметром $labels->name
			'labels'      => [
				'name'              => 'Категории фото',
				'singular_name'     => 'Категории фото',
				'search_items'      => 'Искать Категорию фото',
				'all_items'         => 'Новая Категория фото',
				'view_item '        => 'Смотреть Категорию фото',
				'parent_item'       => 'Родитель Категории фото',
				'parent_item_colon' => 'Родитель Категории фото:',
				'edit_item'         => 'Редактировать Категорию фото',
				'update_item'       => 'Обновить Категорию фото',
				'add_new_item'      => 'Добавить новую Категорию фото',
				'new_item_name'     => 'Категории фото',
				'menu_name'         => 'Категории фото',
			],
			'public'      => true,
			'meta_box_cb' => false,
		] );

	}

}