=== Plugin Name ===
Contributors: digitalopium
Donate link: http://www.digitalopium.com/
Tags: spotify, albums, api, tutorial, ajax, options, widget
Requires at least: 4.6
Tested up to: 4.6
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The Spotify Albums plugin provides a widget where you can specify any Spotify album ID and it will retrieve the album cover and list of tracks for your Wordpress blog.

== Description ==

From a User Perspective:

The Spotify Albums plugin lets you interact with the Spotify API and leverage the Album functionality.  
The plugin will get the album cover art and also a list of tracks given the album ID and render it within a widget. 
Since this is the initial version, it leverages the open Spotify API and does not yet require any OAuth Key for now.


From a Wordpress Plugin Developer Perspective:

The Spotify Albums plugin was written alongside a series of step-by-step tutorials on Digital Opium.  
Aside from your usual hello-world type tutorials, we have decided to use a rather popular software's API, Spotify, 
and demonstrate a few key areas in Wordpress Plugin Development:

	-Options page in the Dashboard and saving/retrieving options
	-Widget setup including the unique naming of client-side names/ids/functions to allow for multiple instances
	-Leveraging the Wordpress pre-included version of jQuery and performing AJAX calls
	-To be extended at the request of users.
	-Use of PHP Namespaces

Through this approach, not only will they have a simple to use plugin but if they desire, they can also learn from it, extend and write their own.




== Installation ==

1. Upload the plugin files to the "<your-wordpress-directory>/wp-content/plugins/do-spotify-albums" directory, 
   or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Dashboard side-menu's Spotify Albums options page to configure the API Host.  (e.g. https://api.spotify.com)
4. After setting the API Host, add the "Digital Opium - Spotify Albums" widget to your desired location:
		
		i.e.
			-Using the Widgets page in the Themes & Appearance settings
			-Leveraging the PageBuilder plugin which allows widgets to be added to page/posts.


== Frequently Asked Questions ==

Q:  How come it's so basic, what about other features, settings?

A:  This was intended as a tutorial so the initial version is more focused.  If more features are desired, feel free to leave a comment on the Wordpress plugins site or visit http://www.digitalopium.com and leave us some feedback in the forums.  



== Screenshots ==

1. Example of what the Spotify Album widget will look like, 3 different albums and their album cover along with track list.
2. Spotify Albums plugin options page in the Dashboard
3. Configuration for the Widget instance


== Changelog ==

= 1.0 =
* Initial version.
