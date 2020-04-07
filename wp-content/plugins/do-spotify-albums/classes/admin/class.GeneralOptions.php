<?php
/**
   * GeneralOptions
   * 
   * The sub class that extends BaseOptions page, and represents our main options page
   * 
   * @package    DigitalOpium\Spotify;
   * @author     info@digitalopium.com
   */
namespace DigitalOpium\Spotify;


class GeneralOptions extends BaseOptions {


    var $core;

    public function __construct($core) {
        $this->core = $core;


        if ( !isset($this->core->options['doSpotifyAPIHost'] ) )
        {
            // if we don't have a value initially for the API Host, set it here
            $this->core->options['doSpotifyAPIHost'] = 'https://api.spotify.com';
            update_option( 'doSpotifyOptions', $this->core->options );
        }


        // Main Menu Grouping (shares the same slug as the first submenu)
        add_menu_page(
            'Spotify Albums Options',           // Page Title
            'Spotify Albums',                   // Side Menu Title
            'manage_options',                   // capabilities/rights
            'idDOGeneralMenu',                  // slug
            array($this, 'init')                // callback
        );


    }


    public function handle_post()
    {
             
        
        if ( isset($_POST['update']) && $_POST['update'] == "do-form-update" ) 
        {
            $value = $_POST['doSpotifyAPIHost'];

            if ( isset($value) )
            {
                $this->core->options['doSpotifyAPIHost'] = $value;
                update_option( 'doSpotifyOptions', $this->core->options );
            }

        } 
        
    }



    // Overriden from the Base Class
    public function render_page()
    {
        ?>
        <div class="wrap">
            <div class="page-header"><?= esc_html(get_admin_page_title()); ?></div>
            <div class="page-container">
                <form action="" method="post">
                    <input type="hidden" name="update" value="do-form-update" />
                    <div>
                        <span class="do-form-label">API Host</span>
                        <input type="text" id="doSpotifyAPIHost" name="doSpotifyAPIHost" style="width: 300px" value="<?php echo $this->core->options['doSpotifyAPIHost'] ?>" />
                    </div>
                    <div class="do-btn-container">
                        <input class="wp-core-ui button-primary" id="btnSubmit" name="btnSubmit" type="submit" value="Save Settings" />
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
    

}
