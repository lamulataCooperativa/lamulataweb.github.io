<?php
/**
   * BaseOptions
   * 
   * The parent class that represents an Options Page
   * 
   * @package    DigitalOpium\Spotify;
   * @author     info@digitalopium.com
   */

namespace DigitalOpium\Spotify;

class BaseOptions {


    public function init() {
        
        if (!current_user_can('manage_options'))  {
            wp_die( __('Restricted Access') );
        }
       
        $this->handle_post();
        $this->render_header();
        $this->render_page();
        $this->render_footer();

            
    }


    public function handle_post()
    {
  
    }


    public function render_header($echo = TRUE) {
        
        ?>
        <div class="do-header-container">
            <div class="do-header">
                Spotify Albums
                <div class="nth-company" style="display: inline">
                    Developed by <a href="http://www.digitalopium.com">Digital Opium</a>
                </div>
                
            </div>
            <div class="do-disclaimer">
                Disclaimer:  This plugin is not affiliated with, maintained, authorized, endorsed or sponsored by Spotify or any of its affiliates. This is an independent, unofficial plugin created with the Spotify API.
            </div>

        </div>
        <?php
    }




    // To be overriden in subclasses
    public function render_page()
    {
    }

    // To be overriden in subclasses
    public function render_footer()
    {
        ?>
        <br />
        <br />
        <div class="do-footer">
            <div class="do-description">
                <!-- Documentation and Other Items -->
                <b>DESCRIPTION:</b>
                <p>
                    This is a really simple Spotify plugin with an album widget.  
                    It started off as a Wordpress tutorial on creating your own Wordpress plugin with option pages, instance options and reaching out externally for data on Spotify's REST API.
                    If you are interested in the step-by-step guide on creating this, please take a look at the following:
                    <br />
                    <br />
                    <a href="http://www.digitalopium.com/custom-wordpress-plugin/">Digital Opium - Creating your own Spotify Plugin</a>
                    <br />
                    <br />
                    <i>Should we expand on this?  Add more features against the API or the tutorials on the making of?  Let us know!</i>
                </p>
                <br />
                <b>USAGE:</b>
                <p>
                    <div class="do-usage">API Host:</div>Update this right here on this page, the host URI to the Spotify API (e.g. https://api.spotify.com)<br />
                    <div class="do-usage">Album ID:</div>Update this per Widget Instance (e.g. <b style="color:#336699">1RJDe9Eo8473Kg4pdUVGDM</b> in https://play.spotify.com/album/1RJDe9Eo8473Kg4pdUVGDM)
                </p>
                <br />
                <b>HELP US OUT:</b>
                <p>
                    If this was helpful in any way, the actual plugin, the code, or if you want to see more, please help us out by donating to us.  
                </p>
                <div>
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="3BH84MMQB78B6">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

}
