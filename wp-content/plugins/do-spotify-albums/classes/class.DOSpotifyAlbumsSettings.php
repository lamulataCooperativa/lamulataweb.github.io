<?php
/**
   * DOSpotifyAlbumsSettings
   * 
   * The main settings page for our plugin
   * 
   * @package    DigitalOpium\Spotify;
   * @author     info@digitalopium.com
   */
namespace DigitalOpium\Spotify;

class DOSpotifyAlbumsSettings {

	var $core;

    public function __construct($core) {
        $this->core = $core;

        // Create the pages
        add_action('admin_menu', array( &$this, 'create_setting_pages' ));

    }


    function create_setting_pages()
	{
	    // add top level menu page

		new GeneralOptions( $this->core );
		
	}


}