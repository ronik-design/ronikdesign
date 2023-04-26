<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.ronikdesign.com/
 * @since      1.0.0
 *
 * @package    Ronikdesign
 * @subpackage Ronikdesign/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ronikdesign
 * @subpackage Ronikdesign/includes
 * @author     Kevin Mancuso <kevin@ronikdesign.com>
 */
class Ronikdesign_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		function ronikdesigns_add_custom_page() {
			$page_exist = get_page_by_title('2fa');
			if(!$page_exist){
				// Create post object
				$my_post = array(
					'post_title'    => wp_strip_all_tags( '2fa' ),
					'post_content'  => '2fa',
					'post_status'   => 'publish',
					'post_author'   => 1,
					'post_type'     => 'page',
					// Assign page template
					'page_template'  => dirname( __FILE__ , 2).'/custom-templates/2fa-template.php'
				);
				// Insert the post into the database
				wp_insert_post( $my_post );
			}
			$page_exist2 = get_page_by_title('Password Reset');
			if(!$page_exist2){
				// Create post object
				$my_post2 = array(
					'post_title'    => wp_strip_all_tags( 'Password Reset' ),
					'post_content'  => 'password-reset',
					'post_status'   => 'publish',
					'post_author'   => 1,
					'post_type'     => 'page',
					// Assign page template
					'page_template'  => dirname( __FILE__ , 2).'/custom-templates/password_reset-template.php'
				);
				// Insert the post into the database
				wp_insert_post( $my_post2 );
			}
		}
		ronikdesigns_add_custom_page();

	}

}
