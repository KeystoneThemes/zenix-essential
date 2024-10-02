<?php
namespace ZenixEssentialApp;

use Elementor\Plugin as ElementorPlugin;
use ZenixEssentialApp\PageSettings\Page_Settings;


/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function after_register_styles() {
		wp_register_style( 'zenix-header-preset', ZENIX_ESSENTIAL_ASSETS_URL . 'css/header-preset.css' );
		wp_register_style( 'zenix-landing-page', ZENIX_ESSENTIAL_ASSETS_URL . 'css/landing-page.css' , array(), '0.1.0', 'all');
		wp_register_style( 'zenix-header-offcanvas', ZENIX_ESSENTIAL_ASSETS_URL . 'css/offcanvas.css' );

	}
	public function widget_scripts() {

		wp_register_script(
			'wdb-lottie-player',
			ZENIX_ESSENTIAL_ASSETS_URL. 'js/lottie-player.js',
			//'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js',
			[],
			false,
			true
		);
		wp_register_script(
			'wdb-lottie-interactivity',
			ZENIX_ESSENTIAL_ASSETS_URL. 'js/lottie-interactivity.min.js',
			//'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js',
			[],
			false,
			true
		);
		wp_register_script( 'wdb-lottie', ZENIX_ESSENTIAL_ASSETS_URL. 'js/widgets/lottie.js' , [ 'wdb-lottie-player','wdb-lottie-interactivity' ], false, true );
		wp_register_script( 'wdb-offcanvas-menu', ZENIX_ESSENTIAL_ASSETS_URL. '/js/widgets/offcanvas-menu.js' , [ 'jquery' ], false, true );
		wp_register_script( 'wdb-sticky-container', ZENIX_ESSENTIAL_ASSETS_URL. 'js/elementor.sticky-section.js' , [ 'jquery'  ], false, true );
		wp_register_script( 'meanmenu', plugins_url( '/assets/js/jquery.meanmenu.min.js', __FILE__ ), array( 'jquery' ), false , true );
		wp_register_script( 'zenix-essential--global-core', plugins_url( '/assets/js/wdb--global-core.min.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'wdb-landing-page', ZENIX_ESSENTIAL_ASSETS_URL. '/js/widgets/landing-page.js' , [ 'jquery' ], false, true );

		$data = [
			'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
			'_wpnonce' => wp_create_nonce( 'zenix--addons-frontend' )
		];
		wp_localize_script( 'zenix-essential--global-core', 'ZENIX_ADDONS_JS', $data );
		wp_enqueue_script( 'zenix-essential--global-core' );

	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_script(
			'wdb--elementor--editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			time(),
			true
		);
	}

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'wdb--elementor--editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {

		//@todo need follow the convention to create widget file
		foreach ( self::get_widgets() as $slug => $data ) {

			// If upcoming don't register.
			if ( $data['is_upcoming'] ) {
				continue;
			}

			if ( $data['is_active'] ) {
				if ( is_dir( __DIR__ . '/widgets/' . $slug ) ) {
					require_once( __DIR__ . '/widgets/' . $slug . '/' . $slug . '.php' );
				} else {
					require_once( __DIR__ . '/widgets/' . $slug . '.php' );
				}


				$class = explode( '-', $slug );
				$class = array_map( 'ucfirst', $class );
				$class = implode( '_', $class );
				$class = 'ZenixEssentialApp\\Widgets\\' . $class;
				ElementorPlugin::instance()->widgets_manager->register( new $class() );
			}
		}

	}
	/**
	 * Get Widgets List.
	 *
	 * @return array
	 */
	public static function get_widgets() {

		return apply_filters( 'zenix-essential/widgets', [
			'header-menu'              => [
				'label'       => __( 'Zenix Navigation', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'header-preset'            => [
				'label'       => __( 'Zenix Header', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'footer-menu'              => [
				'label'       => __( 'Zenix Footer Navigation', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'banner-breadcrumb'        => [
				'label'       => __( 'Zenix Banner Breadcrumb', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'blog-post-tags'           => [
				'label'       => __( 'Zenix Post Tags', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'dropdown'                 => [
				'label'       => __( 'Zenix Dropdown', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'wc-cart-count'            => [
				'label'       => __( 'Zenix Cart Count', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'offcanvas-menu'           => [
				'label'       => __( 'Zenix Offcanvas Menu', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'landing-page'             => [
				'label'       => __( 'Zenix Landing', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'lottie'                   => [
				'label'       => __( 'Zenix Lottie', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-button'            => [
				'label'       => __( 'Zenix Button', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-testimonial'       => [
				'label'       => __( 'Zenix Testimonial', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-testimonial-2'     => [
				'label'       => __( 'Zenix Testimonial 2', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-video-testimonial' => [
				'label'       => __( 'Zenix Video Testimonial', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-posts'             => [
				'label'       => __( 'Zenix Posts', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-video-slider'      => [
				'label'       => __( 'Zenix Video Slider', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-service'           => [
				'label'       => __( 'Zenix Service', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-service-slider'           => [
				'label'       => __( 'Zenix Service Slider', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-case-study-slider' => [
				'label'       => __( 'Zenix Case Study Slider', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-tabs'              => [
				'label'       => __( 'Zenix Tabs', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-gallery'           => [
				'label'       => __( 'Zenix Gallery', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-video'             => [
				'label'       => __( 'Zenix Video', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'wdb-line'                 => [
				'label'       => __( 'Zenix Line', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-progressbar'                 => [
				'label'       => __( 'Zenix Progressbar', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-side-header'                 => [
				'label'       => __( 'Zenix Side Header', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'zenix-toggle-select'                 => [
				'label'       => __( 'Zenix Toggle Select', 'zenix-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
		] );
	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		new Page_Settings();
	}

	function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'weal-coder-addon',
			[
				'title' => esc_html__( 'Zenix', 'zenix-essential' ),
				'icon' => 'fa fa-plug',
			]
		);

		$elements_manager->add_category(
			'wdb-blog-single',
			[
				'title' => esc_html__( 'Zenix Single', 'zenix-essential' ),
				'icon' => 'fa fa-plug',
			]
		);

		$elements_manager->add_category(
			'wdb-blog-search',
			[
				'title' => esc_html__( 'Zenix Blog Search', 'zenix-essential' ),
				'icon' => 'fa fa-plug',
			]
		);

	}

	public function elementor_init() {
		// Its is now safe to include Widgets skins
		require_once( __DIR__ . '/skin//accordion.php' );
		require_once( __DIR__ . '/skin//accordion-two.php' );
		// Register skin
		add_action( 'elementor/widget/accordion/skins_init', function( $widget ) {
		   $widget->add_skin( new Skin\Accordion\Skin_Accordion($widget) );
		   $widget->add_skin( new Skin\Accordion\Skin_Accordion_Two($widget) );
		} );
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
		add_action( 'elementor/elements/categories_registered', [$this,'add_elementor_widget_categories'], 12 );
		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'after_register_styles' ], 12 );


		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );

		$this->add_page_settings_controls();
		add_action( 'elementor/init', [ $this, 'elementor_init' ], 0 );

	}

}

// Instantiate Plugin Class
Plugin::instance();
