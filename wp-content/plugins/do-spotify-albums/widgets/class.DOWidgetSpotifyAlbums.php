<?php
/**
   * DOWidgetSpotifyAlbums
   * 
   * The widget that will use the API host option from our plugin classes, and render a Spotify album cover and track listing
   * 
   * @author     info@digitalopium.com
   */
class DOWidgetSpotifyAlbums extends WP_Widget 
{
	var $options;

	// constructor
    function DOWidgetSpotifyAlbums() 
    {
    	// get options
    	$this->options = get_option("doSpotifyOptions");


    	// Description & Slug Options for Widget
    	$widget_ops = array('classname' => 'DOWidgetSpotifyAlbums', 'description' => __('Show a list of Spotify albums', 'wp_widget_plugin'));
		
    	// Widget Form Dimensions
		//$control_ops = array('width' => 400, 'height' => 300);
        $control_ops = array();

		// Set the name of the widget and any options
        parent::WP_Widget(false, $name = __('[Digital Opium] Spotify Albums', 'wp_widget_plugin'), $widget_ops, $control_ops  );

    }



	// widget form creation
	function form($instance) 
	{	

		// Check values
		if( $instance) 
		{
			$txtAlbumId = esc_attr($instance['txtAlbumId']);
		} 
		else 
		{
		    $txtAlbumId = NULL;
		}

		?>
		
		<!-- Options -->
		<div style="padding:20px">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<label for="<?php echo $this->get_field_id('txtAlbumId'); ?>"><?php _e('Album ID', 'wp_widget_plugin'); ?></label>:&#160;
					</td>
					<td>	
						<input class="field-long" id="<?php echo $this->get_field_id('txtAlbumId'); ?>" name="<?php echo $this->get_field_name('txtAlbumId'); ?>" type="text" value="<?php echo $txtAlbumId; ?>" />
					</td>
				</tr>
			</table>
		</div>
		<?php
		
	}


	// widget update
	function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;

	   	$instance['txtAlbumId'] = strip_tags($new_instance['txtAlbumId']);

	    return $instance;
	}


	// widget display
	function widget($args, $instance) 
	{
		extract( $args );


		$txtAlbumId = $instance['txtAlbumId'];
		$spotifyAPIHost = $this->options['doSpotifyAPIHost'];


		echo $before_widget;
		// Display the widget
		echo '<div class="widget-text wp_widget_plugin_box">';

		// Display the Album
		?>

			<!-- Handlebars Template For Events -->

			

			<!-- Template -->
			<script id="<?php echo $this->get_field_id('data-template') ?>" type="text/x-handlebars-template">
				<ul>
					{{#each items}}
					<li>
						{{{Index @index}}}.&#160;&#160;<a href="{{external_urls.spotify}}" target="_blank">{{name}}</a>
					</li>	
					{{/each}}
				</ul>
			</script>

			<div class="album-container">
				<div class="album-cover-gradient">
				</div>
				<div id="<?php echo $this->get_field_id('album-cover') ?>" class="album-cover">
				</div>
				<div id="<?php echo $this->get_field_id('data-container') ?>">
				</div>
			</div>

			<script>
				Handlebars.registerHelper("Index", function(value, options)
				{
				    return parseInt(value) + 1;
				});

				jQuery( document ).ready(function () 
				{
					//https://api.spotify.com/v1/albums/1RJDe9Eo8473Kg4pdUVGDM/
					jQuery.ajax({
							url: 			"<?php echo($spotifyAPIHost) ?>/v1/albums/<?php echo($txtAlbumId) ?>/",
							dataType: 		"json",
							success:  		
								function ( data )
								{
									if ( data && data.images && data.images.length > 0 )
									{

										$albumCover = jQuery("#<?php echo $this->get_field_id('album-cover') ?>");
										$albumCover.css("background-image", "url(" + data.images[0].url + ")");
										var html = data.name;
										if ( data && data.artists && data.artists.length > 0 )
											html += "<br />" + data.artists[0].name;
										$albumCover.html(html);
									}
								},
							error:
								function ( req, status, error )
								{
									$albumCover = jQuery("#<?php echo $this->get_field_id('album-cover') ?>");
									$albumCover.css("background", "#000");
									$albumCover.html("No Album")
								}	
					});


					//https://api.spotify.com/v1/albums/1RJDe9Eo8473Kg4pdUVGDM/tracks
					jQuery.ajax({
							url: 			"<?php echo($spotifyAPIHost) ?>/v1/albums/<?php echo($txtAlbumId) ?>/tracks",
							dataType: 		"json",
							success:  		
								function ( data )
								{
									var source   = jQuery("#<?php echo $this->get_field_id('data-template') ?>").html();
									var template = Handlebars.compile(source);
									var html    = template(data);
									jQuery("#<?php echo $this->get_field_id('data-container') ?>").html( html );
								},
							error:
								function ( req, status, error )
								{
									jQuery("#<?php echo $this->get_field_id('data-container') ?>").html( "No Track Information" );
								}
						});
				});

			</script>

		<?php
		echo '</div>';
		echo $after_widget;
	}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("DOWidgetSpotifyAlbums");'));


