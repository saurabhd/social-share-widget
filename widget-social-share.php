<?php

/*
	Plugin Name: Widget Social Share (WSS)
	Plugin URI: http://www.addwebsolution.com
	Description: It displays links to Facebook, Twitter and RSS feeds.This plugin is for created as demo.
	Tags: social, share, widget, widget social share
	Version: 1.0
	Author: Addweb Solution Pvt. Ltd.	
	Author URI: https://profiles.wordpress.org/addweb-solution-pvt-ltd
	License: License: GPLv2 or later

*/

function wss_social_networks_install() {

	$wss_defaults_array = array( 'wss_title' => 'Follow Me', 'wss_facebook' => '', 'wss_twitter' => '', 'wss_plus' => '' );
	update_option ('wss_defaults', $wss_defaults_array);
}

class wss_link_to_social_networks extends WP_Widget {

	function wss_link_to_social_networks() {

	$widget_options = array(

	'classname' => 'wss_link_to_social_networks',

	'description' => __('Displays Links to Facebook, Twitter and RSS Feeds') );

	// Call the parent class WP_Widget

	//parent::WP_Widget('wss_link_to_social_networks', 'wss Social Network Links', $widget_options);
	parent::__construct('wss_link_to_social_networks', 'wss Social Network Links', $widget_options);
	
	}

	function widget($args, $instance)
	{

		extract( $args, EXTR_SKIP );

		$wss_title = ( get_option( 'wss_title') ) ? get_option( 'wss_title' ) : 'Follow Me';

		$wss_facebook = ( get_option( 'wss_facebook') ) ? get_option( 'wss_facebook' ) : '';

		$wss_twitter = ( get_option( 'wss_twitter') ) ? get_option( 'wss_twitter' ) : '';

		$wss_plus = ( get_option( 'wss_plus') ) ? get_option( 'wss_plus' ) : '';
		 
		?>

		<?php echo $before_widget; ?>

		<?php echo $before_title . $wss_title . $after_title; ?>

		<?php

		$wss_plus_icon = plugins_url( 'icons/google_plus.png' , __FILE__ );

		$wss_facebook_icon = plugins_url( 'icons/facebook.png' , __FILE__ );

		$wss_twitter_icon = plugins_url( 'icons/twitter.png' , __FILE__ );

		?>

		<a href="http://www.twitter.com/<?php echo $instance['wss_twitter']; ?>"><img src="<?php echo $wss_twitter_icon; ?>" height="50px" width="50px"></a>


		<a href="http://www.facebook.com/<?php echo $instance['wss_facebook']; ?>"><img src="<?php echo $wss_facebook_icon; ?>" height="50px" width="50px"></a>


		<a href="http://plus.google.com/<?php echo $instance['wss_plus']; ?>"><img src="<?php echo $wss_plus_icon; ?>" height="50px" width="50px"></a>


		<?php echo $after_widget; ?>
	<?php } 

	// Pass the new widget values contained in $new_instance and update saves

	// everything for you

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['wss_title'] = strip_tags( $new_instance['wss_title'] );

		$instance['wss_facebook'] = strip_tags( $new_instance['wss_facebook'] );

		$instance['wss_twitter'] = strip_tags( $new_instance['wss_twitter'] );

		$instance['wss_plus'] = strip_tags( $new_instance['wss_plus'] );

		return $instance;

	}
	
	function form($instance) {

		// Set all of the default values for the widget

		$wss_defaults = array( 'wss_title' => 'Follow Me', 'wss_facebook' => '', 'wss_twitter' => '', 'wss_plus' => '' );

		// Grab any widget values that have been saved and merge them into an

		// array with wp_parse_args

		$instance = wp_parse_args( (array) $instance, $wss_defaults );

		$wss_title = $instance['wss_title'];

		$wss_facebook = $instance['wss_facebook'];

		$wss_twitter = $instance['wss_twitter'];

		$wss_plus = $instance['wss_plus'];

		?>

		<p>Title: <input class="wsssocialLinks" name="<?php echo $this->get_field_name( 'wss_title' ); ?>" type="text" value="<?php echo esc_attr( $wss_title ); ?>" /></p>

		<p>Facebook ID: <input class="wsssocialLinks" name="<?php echo $this->get_field_name( 'wss_facebook' ); ?>" type="text" value="<?php echo esc_attr( $wss_facebook ); ?>" /></p>

		<p>Twitter ID: <input class="wsssocialLinks" name="<?php echo $this->get_field_name( 'wss_twitter' ); ?>" type="text" value="<?php echo esc_attr( $wss_twitter ); ?>" /></p>

		<p>Google Plus ID: <input class="wsssocialLinks" name="<?php echo $this->get_field_name( 'wss_plus' ); ?>" type="text" value="<?php echo esc_attr( $wss_plus ); ?>" /></p>

		<?php

		settings_fields( 'wss_social_network_vars' );

		update_option('wss_title', $wss_title);

		update_option('wss_facebook', $wss_facebook);

		update_option('wss_twitter', $wss_twitter);

		update_option('wss_plus', $wss_plus);

	}

}

	function wss_link_to_social_networks_init() {

		// Registers a new widget to be used in your WordPress theme

		register_widget('wss_link_to_social_networks');
	}

	// Creates the variable options needed for the plugin and settings page

	// Allows me to access widget options from any other function

	function wss_register_options() { 

	register_setting( 'wss_social_network_vars', 'wss_title' );

	register_setting( 'wss_social_network_vars', 'wss_twitter' );

	register_setting( 'wss_social_network_vars', 'wss_facebook' );

	register_setting( 'wss_social_network_vars', 'wss_plus' );

	}

	// Creates the settings page for the plugin

	function wss_social_networks_settings() {
	?>
	<div>

		<h3><?php _e( 'wss Social Network Widget Options', 'wss_link_to_social_networks') ?></h3><br />

		<form method="post" action="options.php">

		<?php settings_fields( "wss_social_network_vars" ); ?>

		<?php _e('Title', 'wss_link_to_social_networks') ?>

		<input type="text" name="wss_title" value="<?php echo get_option('wss_title'); ?>" /><br />

		<?php _e('Twitter ID', 'wss_link_to_social_networks') ?>

		<input type="text" name="wss_twitter" value="<?php echo get_option('wss_twitter'); ?>" /><br />

		<?php _e('Facebook ID', 'wss_link_to_social_networks') ?>

		<input type="text" name="wss_facebook" value="<?php echo get_option('wss_facebook'); ?>" /><br />

		<?php _e('Google plus Id', 'wss_link_to_social_networks') ?>

		<input type="text" name="wss_plus" value="<?php echo get_option('wss_plus'); ?>" /><br />

		<input type="submit" value="<?php _e('Submit', 'wss_link_to_social_networks'); ?>" />

		</form>

	</div>
<?php
}



function wss_social_networks_create_menu() {
	
	add_menu_page( 'wss Social Networks', 'wss Settings', 'administrator', __FILE__, 'wss_social_networks_settings' );

} // End of the function wss_social_networks_create_menu

function wss_social_networks_create_submenu() {
	//add_options_page( 'wss Social Networks', 'wss Settings', 'administrator', __FILE__, 'wss_social_networks_settings', plugins_url( 'icons/Social-Media-Logo.png', __FILE__) );

	add_options_page( 'wss Social Networks', 'wss Settings', 'administrator', __FILE__, 'wss_social_networks_settings');
} 

add_action('widgets_init', 'wss_link_to_social_networks_init');

// Creates a top level menu in your dashboards left sidebar

add_action( 'admin_menu', 'wss_social_networks_create_menu' );

// Create a submenu item under settings

add_action( 'admin_menu', 'wss_social_networks_create_submenu' );

// Call the function that we create all of the options for the plugin being

// title, facebook and twitter

add_action( 'admin_init', 'wss_register_options' );

?>