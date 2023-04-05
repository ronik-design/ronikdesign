<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.ronikdesign.com/
 * @since      1.0.0
 *
 * @package    Ronikdesign
 * @subpackage Ronikdesign/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ronikdesign
 * @subpackage Ronikdesign/admin
 * @author     Kevin Mancuso <kevin@ronikdesign.com>
 */
class Ronikdesign_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ronikdesign_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ronikdesign_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/ronikdesign-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ronikdesign_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ronikdesign_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script($this->plugin_name.'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js', array(), null, true);
		$scriptName = $this->plugin_name.'jquery';


		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/ronikdesign-admin.js', array($scriptName), $this->version, false);
		// Ajax & Nonce
		wp_localize_script($this->plugin_name, 'wpVars', array(
			'ajaxURL' => admin_url('admin-ajax.php'),
			'nonce'	  => wp_create_nonce('ajax-nonce')
		));
	}
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function acf_enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ronikdesign_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ronikdesign_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script($this->plugin_name.'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js', array(), null, true);
		$scriptName = $this->plugin_name.'jquery';


		wp_enqueue_script($this->plugin_name . '-acf', plugin_dir_url(__FILE__) . 'js/acf/admin.js', array($scriptName), $this->version, false);
	}




	/**
	 * Ronik Customs CSP.
	 */
	function my_acf_op_init()
	{
		// Check function exists.
		if (function_exists('acf_add_options_page')) {
			// Add parent.
			$parent = acf_add_options_page(array(
				'page_title'  => __('Developer General Settings'),
				'menu_title'  => __('Developer Settings'),
				'menu_slug'     => 'developer-settings',
				// 'parent_slug' => $parent['menu_slug'],
				'redirect'    => false,
			));
			// Add sub page.
			$child = acf_add_options_page(array(
				'page_title'  => __('Code Template'),
				'menu_title'  => __('Code Template'),
				'menu_slug'     => 'code-template',
				'parent_slug' => $parent['menu_slug'],
			));
		}
	}
	function my_acf_op_init_fields()
	{
		// Include the ACF Fields
		foreach (glob(dirname(__FILE__) . '/acf-fields/*.php') as $file) {
			include $file;
		}
	}

	function my_acf_op_functions()
	{
		// if( class_exists('ACF') ){
		// 	return;
		// }

		// Include the Script Optimizer.
		foreach (glob(dirname(__FILE__) . '/script-optimizer/*.php') as $file) {
			include $file;
		}
		// Include the Spam Blocker.
		foreach (glob(dirname(__FILE__) . '/spam-blocker/*.php') as $file) {
			include $file;
		}
		// Include the Wp Cleaner.
		foreach (glob(dirname(__FILE__) . '/wp-cleaner/*.php') as $file) {
			include $file;
		}
		// Include the Wp Functions.
		foreach (glob(dirname(__FILE__) . '/wp-functions/*.php') as $file) {
			include $file;
		}
		// Include the two-factor-auth.
		// foreach (glob(dirname(__FILE__) . '/two-factor-auth/*.php') as $file) {
		// 	include $file;
		// }
		// Include the password reset.
		foreach (glob(dirname(__FILE__) . '/password-reset/*.php') as $file) {
			include $file;
		}
	}


	/**
	 * Enable SVG as a mime type for uploads.
	 * @param array $mimes
	 * @return string
	 */
	function roniks_add_svg_mime_types($mimes): array
	{
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	/**
	 * Remove menus from clients.
	 */
	function remove_menus()
	{
		$curr_user = wp_get_current_user();
		$curr_id = 'user_' . $curr_user->id;
		$curr_experience = get_field('global_user_experience', $curr_id);

		// We check user roles.
		$allowed_roles = array('administrator');
		if (!array_intersect($allowed_roles, $curr_user->roles)) {
			// Code here for allowed roles
			remove_menu_page('acf-options-developer-settings');
		}
		if ($curr_experience !== 'advanced') {
			remove_menu_page('index.php'); //Dashboard  
			remove_menu_page('options-general.php'); //Settings  
			remove_menu_page('tools.php'); //Tools  
			remove_menu_page('edit.php?post_type=acf-field-group');  //Hide ACF Field Groups  
			remove_menu_page('themes.php'); //Appearance  
			remove_menu_page('plugins.php'); //Plugins
			remove_menu_page('acf-options-developer-settings');
		}
	}


	/**
	 * Init Page Migration, Basically swap out the original link with the new link.
	 */
	function ajax_do_init_page_migration()
	{
		if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
			wp_send_json_error('Security check failed', '400');
			wp_die();
		}
		// Check if user is logged in.
		if (!is_user_logged_in()) {
			return;
		}
		$f_url_migration = get_field('page_url_migration', 'options');
		if ($f_url_migration) {
			foreach ($f_url_migration as $key => $url_migration) {
				// CHECK if both fields are populated.
				if ($url_migration['original_link'] && $url_migration['new_link']) {
					// Lets convert the given url to post ids.
					$original_link = url_to_postid($url_migration['original_link']['url']);
					$new_link = url_to_postid($url_migration['new_link']['url']);
					// Check if 0 is present in the both variables. url_to_postid return Post ID, or 0 on failure.
					if ($original_link !== 0 && $new_link !== 0) {
						$original_post_slug = get_post_field('post_name', $original_link);
						// First we have to draft the orginal link and change the post_name.
						wp_update_post(array(
							'ID'    =>  $original_link,
							'post_name' => $original_post_slug . '-drafted',
							'post_status' => array('draft'),
						));
						// Second we have to take the $original_post_slug and remove the -drafted string
						$modified_original_post_slug = str_ireplace('-drafted', '', $original_post_slug);
						wp_update_post(array(
							'ID'    =>  $new_link,
							'post_name' => $modified_original_post_slug,
							'post_status' => 'publish', // Change to publish status.
							'post_password' => '' // This is critical we empty the password value for it to become no longer private.
						));
						// This will be our way for logging post migration status.
						update_option('options_page_url_migration_' . $key . '_migration-status', 'Success: Before rerunning please remove any successful rows!');
					} else {
						update_option('options_page_url_migration_' . $key . '_migration-status', 'Failure: Please check the provided url!');
					}
				} else {
					update_option('options_page_url_migration_' . $key . '_migration-status', 'Failure: Please check the provided url!');
				}
			}
		} else {
			// If no rows are found send the error message!
			wp_send_json_error('No rows found!');
		}
		// Send sucess message!
		wp_send_json_success('Done');
	}






	/**
	 * Init Unused Media Migration.
	 */
	function ajax_do_init_unused_media_migration()
	{
		if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
			wp_send_json_error('Security check failed', '400');
			wp_die();
		}
		// Check if user is logged in.
		if (!is_user_logged_in()) {
			return;
		}

		function recursive_delete($number){
			$offsetValue = $number * 20;
			// This will allow us to collect all the image ids.
			$image_ids = array();
			$image_ids_two = array();

			// We receive all the attachments that does not have a post_parent.
			error_log(print_r('Attachment Check' , true));
			$attachments = get_posts( array(
				'post_type' => 'attachment',
				// 'posts_per_page' => 2,
				'offset' => $offsetValue,
				'numberposts' => 20, // Do not add more then 150.
				'fields' => 'ids',
				'post_parent' => 0,
				'post_mime_type' => array(
					"jpg" => "image/jpeg",
					"jpeg" => "image/jpeg",
					"jpe" => "image/jpeg",
					"gif" => "image/gif",
					"png" => "image/png",
				),
			));
			if ($attachments) {
				foreach ($attachments as $attachmentID){
					$image_ids[] = $attachmentID;
				}
			}
			// Lets output all the missing image ids.
			error_log(print_r($image_ids , true));
			error_log(print_r('Looping through all IDS.' , true));
			if($image_ids){
				foreach($image_ids as $key => $image_id){
					// lets get the image ID. Search through the wp_posts data table. This is not ideal, but is the only good way to search for imageid for gutenberg blocks.
					error_log(print_r('Image ID wp_posts Check' , true));
					$args_id = array(
						// 'fields' => 'ids',
						'post_type'  => 'any',
						'post_status'  => 'any',
						'posts_per_page' => -1,
						's'  => ':'.$image_id,
					);
					$f_postsid = get_posts( $args_id );
					if($f_postsid){
						foreach($f_postsid as $key => $posts){
							if($posts->ID){
								// error_log(print_r($image_id , true));
								// Lets remove the found image from the array.
								if (($key = array_search($image_id, $image_ids)) !== false) {
									unset($image_ids[$key]);
								}
								error_log(print_r('Image ID wp_posts Check Found missing ID: '.$image_id , true));
							}
						}
					}
					$image_ids = array_values(array_filter($image_ids)); // 'reindex' array to cleanup...
					sleep(.25);

					// error_log(print_r($image_ids , true));
					// lets get the attached file name. Search through the wp_posts data table. This is not ideal, but is the only good way to search for imageid for gutenberg blocks. Plus any images that are inserted into posts manually.
					error_log(print_r('Attached file wp_posts Check' , true));
					$f_attached_file = get_attached_file( $image_id );
					$pieces = explode('/', $f_attached_file ) ;
					$args_attached = array(
						'post_type'  => 'any',
						'post_status'  => 'any',
						'posts_per_page' => -1,
						's'  => end($pieces),
					);
					$f_postsattached = get_posts( $args_attached );
					if($f_postsattached){
						foreach($f_postsattached as $key => $posts){
							if($posts->ID){
								// error_log(print_r($image_id , true));
								// Lets remove the found image from the array.
								if (($key = array_search($image_id, $image_ids)) !== false) {
									unset($image_ids[$key]);
								}
								error_log(print_r('Attached file wp_posts Check Found missing ID: '.$image_id , true));
							}
						}
					}
					$image_ids = array_values(array_filter($image_ids)); // 'reindex' array to cleanup...
					sleep(.25);

					// error_log(print_r($image_ids , true));
					// Lets Search through all posts for the featured thumbnail.
					error_log(print_r('Featured Image Check' , true));
					$args = array(
						'post_type'  => 'any',
						'post_status'  => 'any',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
								'key' => '_thumbnail_id',
								'value' => $image_id,
								'compare' => '=='
							)
						),
					);
					$f_posts = get_posts( $args );
					if($f_posts){
						foreach($f_posts as $key => $posts){
							if($posts->ID){
								// Lets remove the found image from the array.
								if (($key = array_search($image_id, $image_ids)) !== false) {
									unset($image_ids[$key]);
								}
								error_log(print_r('Featured Image Check Found missing ID: '.$image_id , true));
							}
						}
					}
					$image_ids = array_values(array_filter($image_ids)); // 'reindex' array to cleanup...
					sleep(.25);

					// error_log(print_r($image_ids , true));
					// This part is critical we check all the postmeta for any image ids in the acf serialized array. AKA any repeater fields or gallery fields.
					error_log(print_r('Postmeta ACF Repeater Check' , true));
					$argstwo = array(
						'fields' => 'ids',
						'post_type'  => 'any',
						'post_status'  => 'any',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
							'value' => sprintf(':"%s";', $image_id),
							'compare' => 'LIKE',
							)
						),
					);
					$f_poststwo = get_posts( $argstwo );
					if($f_poststwo){
						foreach($f_poststwo as $key => $posts){
							if($posts->ID){
								error_log(print_r($image_id , true));
								// Lets remove the found image from the array.
								if (($key = array_search($image_id, $image_ids)) !== false) {
									unset($image_ids[$key]);
								}
								error_log(print_r('Acf serialized array ID, Check Found missing ID: '.$image_id , true));
							}
						}
					}
					$image_ids = array_values(array_filter($image_ids)); // 'reindex' array to cleanup...
					sleep(.25);

					// error_log(print_r($image_ids , true));
					// This part is critical we check all the postmeta for any image ids in the acf serialized array. AKA any repeater fields or gallery fields.
					error_log(print_r('Postmeta ACF Repeater Check attached file.' , true));
					$argsthree = array(
						'fields' => 'ids',
						'post_type'  => 'any',
						'post_status'  => 'any',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
								'value' => sprintf(':"%s";', get_attached_file($image_id)),
								'compare' => 'LIKE',
							)
						),
					);
					$f_poststhree = get_posts( $argsthree );
					if($f_poststhree){
						foreach($f_poststhree as $key => $posts){
							if($posts->ID){
								error_log(print_r($image_id , true));
								// Lets remove the found image from the array.
								if (($key = array_search($image_id, $image_ids)) !== false) {
									unset($image_ids[$key]);
								}
								error_log(print_r('Acf serialized array attached, Check Found missing ID: '.$image_id , true));
							}
						}
					}
					$image_ids = array_values(array_filter($image_ids)); // 'reindex' array to cleanup...
					sleep(.25);

					// error_log(print_r($image_ids , true));
					// This part is critical we check all the postmeta for any image ids in the meta value
					error_log(print_r('Postmeta ACF Check' , true));
					$argsfour = array(
						'fields' => 'ids',
						'post_type'  => 'any',
						'post_status'  => 'any',
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
							'value' => $image_id,
							'compare' => '==',
							)
						),
					);
					$f_postsfour = get_posts( $argsfour );
					if($f_postsfour){
						foreach($f_postsfour as $key => $posts){
							if($posts->ID){
								// error_log(print_r($image_id , true));
								// Lets remove the found image from the array.
								if (($key = array_search($image_id, $image_ids)) !== false) {
									unset($image_ids[$key]);
								}
								error_log(print_r('Acf postmeta, Check Found missing ID: '.$image_id , true));
							}
						}
					}
					$image_ids = array_values(array_filter($image_ids)); // 'reindex' array to cleanup...
					sleep(.25);

					// This part is critical we check all the php files within the active theme directory.
					error_log(print_r('PHP file check.' , true));
					$image_ids_two[] = receiveAllFiles($image_id);
				}
			}

			$image_ids_cleaned1 = array_values(array_filter($image_ids)); // 'reindex' array to cleanup...
			$image_ids_cleaned2 = array_values(array_filter($image_ids_two)); // 'reindex' array to cleanup...
			$result = array_diff($image_ids_cleaned1, $image_ids_cleaned2);

			// $result = $image_ids_cleaned1;

			return array_values(array_filter($result));
		}
		// Warning this script will slow down the entire server. Use only a small amount at a time.
		// foreach (range(0, 1) as $number) {
		// 	recursive_delete($number);
		// }
		$f_results = recursive_delete(0);
		error_log(print_r('recursive_delete Completed' , true));

		if($f_results){
			// Get the array count..
			update_option( 'options_page_media_cleaner_field' , count($f_results) );
			foreach( $f_results as $key => $f_result ){
				update_option('options_page_media_cleaner_field_' . $key . '_image_id',  $f_result);
				update_option('options_page_media_cleaner_field_' . $key . '_image_url', get_attached_file($f_result) );
				update_option('options_page_media_cleaner_field_' . $key . '_thumbnail_preview', $f_result);

				if( $f_result == end($f_results) ){
					// Sleep for 2 seconds...
					sleep(2);
					// Send sucess message!
					wp_send_json_success('Done');
				}
			}
		} else {
			// If no rows are found send the error message!
			wp_send_json_error('No rows found!');
		}
	}



	/**
	 * Init Remove Unused Media .
	*/
	function ajax_do_init_remove_unused_media()
	{
		if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
			wp_send_json_error('Security check failed', '400');
			wp_die();
		}
		// Check if user is logged in.
		if (!is_user_logged_in()) {
			return;
		}

		$f_media_cleaner = get_field('page_media_cleaner_field', 'options');
		if($f_media_cleaner){
			foreach($f_media_cleaner as $key => $media_cleaner){

				// First lets copy the full image to the ronikdetached folder.
				$upload_dir   = wp_upload_dir();
				$link = wp_get_attachment_image_url( $media_cleaner['image_id'], 'full' );
				$file_path = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $link);
				$file_name = explode('/', $link);	
				
				//Year in YYYY format.
				$year = date("Y");
				//Month in mm format, with leading zeros.
				$month = date("m");
				//Day in dd format, with leading zeros.
				$day = date("d");
				//The folder path for our file should be YYYY/MM/DD
				$directory = dirname(__FILE__, 2).'/ronikdetached/'."$year/$month/$day/";
				//If the directory doesn't already exists.
				if(!is_dir($directory)){
					//Create our directory.
					mkdir($directory, 0777, true);
				}
				copy($file_path , $directory.end($file_name));

				// Delete attachment from database only, not file
				$delete_attachment = wp_delete_attachment( $media_cleaner['image_id'] , true);
				if($delete_attachment){
					//Delete attachment file from disk
					unlink( get_attached_file( $media_cleaner['image_id'] ) );
					error_log(print_r('File Deleted', true));
					update_option('options_page_media_cleaner_field_' . $key . '_image_id',  '');
					update_option('options_page_media_cleaner_field_' . $key . '_image_url', '' );
					update_option('options_page_media_cleaner_field_' . $key . '_thumbnail_preview', '');
				}

				if( $media_cleaner == end($f_media_cleaner) ){
					// Get the array count..
					update_option( 'options_page_media_cleaner_field' , '' );
					sleep(1);				
					// Send sucess message!
					wp_send_json_success('Done');
				}

			}
		} else {
			// If no rows are found send the error message!
			wp_send_json_error('No rows found!');
		}
		// Send sucess message!
		wp_send_json_success('Done');
	}



}