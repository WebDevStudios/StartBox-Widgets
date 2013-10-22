<?php
/*
Plugin Name: StartBox Widgets
Plugin URI: http://wpstartbox.com/
Description: Powerful widgets for StartBox
Version: 1.0
Author: WebDevStudios.com
Author URI: http://webdevstudios.com
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

class StartBox_Widgets {

	function __construct() {

		// Define plugin constants
		$this->basename			=	plugin_basename( __FILE__ );
		$this->directory_path	=	plugin_dir_path( __FILE__ );
		$this->directory_url	=	plugin_dir_url( __FILE__ );

		// Load translations
		load_plugin_textdomain( 'appp', false, 'startbox-widgets/languages' );

		// Hook in all our important pieces
		add_action( 'plugins_loaded', array( &$this, 'includes' ) );
		add_action( 'widgets_init', array( &$this, 'sb_load_widgets' ) );
		add_action( 'sidebar_admin_setup', array( &$this, 'sb_load_featured_widget_js' ) );

	}

	/**
	 * Include all our important files.
	 */
	function includes() {

		require_once( $this->directory_path . 'inc/featured-content.php' );
		require_once( $this->directory_path . 'inc/search.php' );
		require_once( $this->directory_path . 'inc/social-icons.php' );
		require_once( $this->directory_path . 'inc/tag-cloud.php' );

	}

	/**
	 * Register widgets for use with StartBox themes.
	 *
	 * See individual widget class files for further documentation.
	 *
	 * @since 1.0.0
	 */
	function sb_load_widgets() {

		register_widget( 'SB_Widget_Featured_Content' );
		register_widget( 'SB_Widget_Search' );
		register_widget( 'SB_Widget_Social' );
		register_widget( 'SB_Widget_Tag_Cloud' );

		// unregister the default widgets
		unregister_widget( 'WP_Widget_Search' );
		unregister_widget( 'WP_Widget_Tag_Cloud' );

	}

	/**
	 * Enqueue JavaScript file for Featured Content widget.
	 *
	 * @since 1.0.0
	 */
	function sb_load_featured_widget_js() {

		wp_enqueue_script( 'sb-widgets', plugins_url( 'js/widgets.js', __FILE__ ), array( 'jquery' ) );

	}

}

$GLOBALS['startbox_widgets'] = new StartBox_Widgets();
