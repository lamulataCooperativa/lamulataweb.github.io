<?php
/*
Plugin Name: Contact Form by vCita
Plugin URI: http://www.vcita.com
Description: Contact form by vCita proves to increase the number of contact form requests
Version: 4.5.2
Author: vCita.com
Author URI: http://www.vcita.com
*/

/*
*  livesite_main_cf
*
*  @description: controller for main init of LiveSite Plugin
*  @since: 4.0.2
*  @created: 01/10/15
*/

class livesite_main_cf {

    /**
     * Defines the plugin settings for the init instance
     * Is only used in this class for settings relaying
     * @since 0.1.0
     */
    public $old_plugin_settings;

    function __construct() {

        // Low level get option
        $this->old_plugin_settings = get_option( 'livesite_plugin_settings', false );
        $run_plugin = true;

        // If this is not a fresh install
        if ( $this->old_plugin_settings ){

        	// Check if this plugin is not the active one
        	if ( $this->old_plugin_settings['main_module'] != 'form_builder' ){

        		add_action('admin_notices', array($this,'other_plugin_installed'));
        		add_action('admin_init', array($this,'deactivate_plugin'));

        		$run_plugin = false;

        	}

        }

        if ( $run_plugin ){
          $path = plugin_dir_path( __FILE__ );

          require_once( $path . 'plugin_init.php' );

          new ls_plugin_init();
        }


    }

    // Shows message that another plugin is installed
    function other_plugin_installed() {
        $settings = $this->old_plugin_settings;
        $main_module = $settings['main_module'];
        $module_title = $settings['modules'][$main_module]['title'];
        ?>
    	<div id="message" class="error notice is-dismissible">
    		<p>
    			<?php _e('vCita LiveSite Pack is already installed. Please use <a href="'. get_admin_url('', '', 'admin').'plugins.php' .'">'. $module_title .'</a>','livesite'); ?>
    		</p>
    	</div>
    <?php
    }

    function deactivate_plugin() {
    	deactivate_plugins( plugin_basename( __FILE__ ) );
    }

}

new livesite_main_cf();
?>
