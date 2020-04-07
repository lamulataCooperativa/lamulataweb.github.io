<?php
/*
Plugin Name: Digital Opium - Spotify Album
Plugin URI: https://wordpress.org/plugins/do-spotify-albums
Description: This plugin is written to use the Spotify API and retrieve album information for use in a widget.	
Version: 1.0
Author: Digital Opium
Author URI: http://www.digitalopium.com/custom-wordpress-plugin/
License: GPL2
*/

namespace DigitalOpium\Spotify;
define('NS', __NAMESPACE__ . '\\');

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Spotify Plugin used with Wordpress';
	exit;
}

define( 'DOSPOTIFYALBUMS_PLUGIN_VERSION', '1.0' );
define( 'DOSPOTIFYALBUMS_PLUGIN_FILE', __FILE__ );
define( 'DOSPOTIFYALBUMS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );


// ADMIN MENUS & OPTIONS
require_once( DOSPOTIFYALBUMS_PLUGIN_DIR . 'classes/admin/class.BaseOptions.php');
require_once( DOSPOTIFYALBUMS_PLUGIN_DIR . 'classes/admin/class.GeneralOptions.php');

// WIDGETS
require_once( DOSPOTIFYALBUMS_PLUGIN_DIR . 'widgets/class.DOWidgetSpotifyAlbums.php' );

// MAIN CLASSES
require_once( DOSPOTIFYALBUMS_PLUGIN_DIR . 'classes/class.DOSpotifyAlbums.php' );
require_once( DOSPOTIFYALBUMS_PLUGIN_DIR . 'classes/class.DOSpotifyAlbumsSettings.php' );

// Queue up our scripts and stylesheets
wp_enqueue_script('handlebars', plugin_dir_url(__FILE__) . 'js/handlebars-v4.0.5.js');
wp_enqueue_style('main_css', plugin_dir_url(__FILE__) . 'css/main.css');


// Initialize the Plugin
$core = new DOSpotifyAlbums();






