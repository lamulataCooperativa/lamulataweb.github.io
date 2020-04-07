<?php
/**
   * DOSpotifyAlbums - Digital Opium Spotify Albums
   * 
   * Main Class for the entire plugin setup
   * 
   * @package    DigitalOpium\Spotify;
   * @author     info@digitalopium.com
   */

namespace DigitalOpium\Spotify;

class DOSpotifyAlbums {


	var $options;		// array of options


	public function __construct() {


		add_action( 'init', array($this,'init'));

		// Admin Actions
		if ( is_admin() )
		{ 
			// sets msOptions array
            $this->options = get_option("doSpotifyOptions");

			new DOSpotifyAlbumsSettings($this);
		}
	}


	/*
	* Initialize any class items
	*/
	public function init() {
		//wp_enqueue_script('jquery');
	}


	/*
	* Called when the plugin is activated
	*/
	public function activate() {
    	//update_option($this->option_name, $this->data);
	}

	/*
	* Called when the plugin is deactivated
	*/
	public function deactivate() {
	    //delete_option($this->option_name);
	}
	


}