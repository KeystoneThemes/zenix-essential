<?php
/**
 * Plugin Name: Zenix Essential
 * Description: Essential plugin for Zenix Theme.
 * Plugin URI:  https://keystonethemes.com/
 * Version:     2.4
 * Author:      Keystone Themes
 * Author URI:  https://keystonethemes.com/
 * Text Domain: zenix-essential
 * Elementor tested up to: 3.23.4
 * Elementor Pro tested up to: 3.1
 * Requires Plugins:  elementor
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	define( 'ZENIX_ESSENTIAL', true );
	define( 'ZENIX_ESSENTIAL_VERSION', '1.5' );
	define( 'ZENIX_ESSENTIAL_LITE', true );
	define( 'ZENIX_ESSENTIAL_ROOT', __FILE__ );
	define( 'ZENIX_ESSENTIAL_URL', plugins_url( '/', ZENIX_ESSENTIAL_ROOT ) );
	define( 'ZENIX_ESSENTIAL_ASSETS_URL', ZENIX_ESSENTIAL_URL . 'assets/' );
	define( 'ZENIX_ESSENTIAL_DIR_PATH', plugin_dir_path( ZENIX_ESSENTIAL_ROOT ) );
	define( 'ZENIX_ESSENTIAL_PLUGIN_BASE', plugin_basename( ZENIX_ESSENTIAL_ROOT ) );
	define( 'ZENIX_ESSENTIAL_ITEM_NAME', 'Zenix Essential' );
	define( 'ZENIX_OPTION_KEY', 'zenix_settings' );

/**
 * Main Elementor Hello World Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class ZENIX_ESSENTIAL_Plugin {

	/**
	 * Plugin Version
	 *
	 * @since 1.2.1
	 * @var string The plugin version.
	 */
	const VERSION = '3.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.2';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	public $plugin_slug;

	public $plugin_path;

	public $version;

	public $cache_key;

	public $cache_allowed;

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/helper.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/hook.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/svg.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/admin.class.php');

		add_action( 'admin_menu', [ $this,'register_theme_admin_menu' ] );
		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
		add_action( 'admin_enqueue_scripts',  array( $this, 'admin_enqueue_scripts' )  );
		add_action( 'wp_enqueue_scripts',  array( $this, 'enqueue_scripts' ) , 500  );
		/* Update Plugin */

		$this->plugin_slug   = plugin_basename( __DIR__ );
		$this->plugin_path   = 'zenix-essential/zenix-essential.php';
		$this->version       = ZENIX_ESSENTIAL_VERSION;
		$this->cache_key     = 'zenix_custom_upd';
		$this->cache_allowed = true;

		add_filter( 'plugins_api', array( $this, 'info' ), 20, 3 );
		add_filter( 'site_transient_update_plugins', array( $this, 'update' ) );
		add_action( 'upgrader_process_complete', array( $this, 'purge' ), 10, 2 );
		/* end update plugin */
	}

	public function enqueue_scripts(){

		wp_register_style( 'fontawesome', ZENIX_ESSENTIAL_ASSETS_URL . 'css/all.min.css' );
		wp_register_style( 'zenix-header-preset', ZENIX_ESSENTIAL_ASSETS_URL . 'css/header-preset.css' );
		wp_register_style( 'zenix-landing-page', ZENIX_ESSENTIAL_ASSETS_URL . 'css/landing-page.css' , array(), '0.1.0', 'all');
		wp_register_style( 'zenix-header-offcanvas', ZENIX_ESSENTIAL_ASSETS_URL . 'css/offcanvas.css' );

	}
	public function admin_enqueue_scripts(){

		wp_enqueue_script('zenix-admin', ZENIX_ESSENTIAL_ASSETS_URL . '/js/admin.js', array('jquery'), time(), true);
		$_data = [
			'admin_ajax' => admin_url('admin-ajax.php'),
			'ajax_nonce' => wp_create_nonce('wdb_theme_secure'),
	    ];

	   wp_localize_script( 'zenix-admin', 'zenix_admin_obj', $_data);
	}

	function register_theme_admin_menu() {

		add_menu_page(
			esc_html__( 'Zenix Theme' , 'zenix-essential' ),
			esc_html__( 'Zenix Theme' , 'zenix-essential' ),
			'manage_options',
			'wdb-zenix-theme-parent',
			[$this,'_render_dashboard'],
			ZENIX_ESSENTIAL_ASSETS_URL. 'images/logo-icon.svg',
			6
		);
	}

	public function _render_dashboard(){
		echo '<div id="wdb-user-guider-dashboard" class="wdb-user-guider-dashboard"></div>';
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {
		load_plugin_textdomain('zenix-essential', false, dirname(plugin_basename(__FILE__)) . '/languages');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/packages/minifiy-css.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/packages/codestar-framework/codestar-framework.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/cpt/cpt.php');

		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/optimize-assets.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/custom-fonts.php');

		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/elementor-shortcode.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/sidebar-widgets/init.php');

		if(file_exists(ZENIX_ESSENTIAL_DIR_PATH.'inc/options/settings.init.class.php')){
			include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/options/settings.init.class.php');
		}

		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/cpt/dynamic.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/dynamic-tags/init.php');

		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/notices/init.php');

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );

		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/i-inherits/icon-manager.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/walkernav.elementor.class.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/walkernav.footer.elementor.class.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/wc/init.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/custom-controls/init.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/elementor-template/init.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/sticky.elementor.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/container.elementor.php');
		include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/icons.php');
        include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/mega-menu/init.php');

		if(file_exists(ZENIX_ESSENTIAL_DIR_PATH.'inc/theme-templates.class.php')){
			include_once(ZENIX_ESSENTIAL_DIR_PATH.'inc/theme-templates.class.php');
		}

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'zenix-essential' ),
			'<strong>' . esc_html__( 'Zenix Essential', 'zenix-essential' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'zenix-essential' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'zenix-essential' ),
			'<strong>' . esc_html__( 'Zenix Essential', 'zenix-essential' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'zenix-essential' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'zenix-essential' ),
			'<strong>' . esc_html__( 'Zenix Essential', 'zenix-essential' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'zenix-essential' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function request(){

		$remote = get_transient( $this->cache_key );

		if( false === $remote || ! $this->cache_allowed ) {
			$remote = wp_remote_get(
				'https://keystonethemes.com/wp-json/wdb-plugin/update/info?slug=zenix-essential',
				array(
					'timeout' => 60,
					'headers' => array(
						'Accept' => 'application/json'
					)
				)
			);
			if(
				is_wp_error( $remote )
				|| 200 !== wp_remote_retrieve_response_code( $remote )
				|| empty( wp_remote_retrieve_body( $remote ) )
			) {
				return false;
			}

			set_transient( $this->cache_key, $remote, 12 * HOUR_IN_SECONDS );
		}

		$remote = json_decode( wp_remote_retrieve_body( $remote ) );

		return $remote;

	}


	function info( $res, $action, $args ) {

		// do nothing if you're not getting plugin information right now
		if( 'plugin_information' !== $action ) {
			return $res;
		}

		// do nothing if it is not our plugin
		if( $this->plugin_slug !== $args->slug ) {
			return $res;
		}

		// get updates
		$remote = $this->request();

		if( ! $remote ) {
			return $res;
		}

		$res = new stdClass();

		$res->name           = $remote->name;
		$res->slug           = $remote->slug;
		$res->version        = $remote->version;
		$res->tested         = $remote->tested;
		$res->requires       = $remote->requires;
		$res->author         = $remote->author;
		$res->author_profile = $remote->author_profile;
		$res->download_link  = $remote->download_url;
		$res->trunk          = $remote->download_url;
		$res->requires_php   = $remote->requires_php;
		$res->last_updated   = $remote->last_updated;

		$res->sections = array(
			'description' => $remote->sections->description,
			'installation' => $remote->sections->installation,
			'changelog' => $remote->sections->changelog
		);

		if( ! empty( $remote->banners ) ) {
			$res->banners = array(
				'low' => $remote->banners->low,
				'high' => $remote->banners->high
			);
		}

		return $res;

	}

	public function update( $transient ) {


		if ( empty($transient->checked ) ) {
			return $transient;
		}

		$remote = $this->request();

		if(
			$remote
			&& version_compare( $this->version, $remote->version, '<' )
			&& version_compare( $remote->requires, get_bloginfo( 'version' ), '<=' )
			&& version_compare( $remote->requires_php, PHP_VERSION, '<' )
		) {

			$res                                 = new stdClass();
			$res->slug                           = $this->plugin_slug;
			$res->plugin                         = $this->plugin_path;  // -update-plugin/-update-plugin.php
			$res->new_version                    = $remote->version;
			$res->tested                         = $remote->tested;
			$res->package                        = $remote->download_url;
			$transient->response[ $res->plugin ] = $res;
		}

		return $transient;

	}

	public function purge( $upgrader, $options ){

		if (
			$this->cache_allowed
			&& 'update' === $options['action']
			&& 'plugin' === $options[ 'type' ]
		) {
			// just clean the cache when new plugin version is installed
			delete_transient( $this->cache_key );
		}

	}
}

$_theme = wp_get_theme( 'zenix' );

if($_theme->exists() && 'zenix' == get_option( 'template' )){
	new ZENIX_ESSENTIAL_Plugin();
	if(file_exists(ZENIX_ESSENTIAL_DIR_PATH.'inc/packages/importer/importer.php') && is_admin()){
		$active  = function_exists('zenix_option') ? zenix_option('theme_demo_activate', true) : true;
		if($active){
			include_once ZENIX_ESSENTIAL_DIR_PATH.'inc/packages/importer/importer.php';
		}

	}
}

require_once plugin_dir_path(__FILE__) . 'plugin-update-checker/plugin-update-checker.php';
	use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

	$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/KeystoneThemes/zenix-essential/',
	__FILE__,
	'zenix-essential'
	);

	//Set the branch that contains the stable release.
	$myUpdateChecker->setBranch('main');