<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.ronikdesign.com/
 * @since      1.0.0
 *
 * @package    Ronikdesign
 * @subpackage Ronikdesign/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ronikdesign
 * @subpackage Ronikdesign/public
 * @author     Kevin Mancuso <kevin@ronikdesign.com>
 */
class Ronikdesign_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/ronikdesign-public.css', array(), $this->version, 'all');
		wp_enqueue_style($this->plugin_name . '2', plugin_dir_url(__FILE__) . 'assets/dist/main.min.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/ronikdesign-public.js', array('jquery'), $this->version, false);
		wp_enqueue_script($this->plugin_name . '2', plugin_dir_url(__FILE__) . 'assets/dist/app.min.js', array('jquery'), $this->version, false);

		// Ajax & Nonce
		wp_localize_script($this->plugin_name, 'wpVars', array(
			'ajaxURL' => admin_url('admin-ajax.php'),
			'nonce'	  => wp_create_nonce('ajax-nonce')
		));
	}


	function ajax_do_verification()
	{
		if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
			wp_send_json_error('Security check failed', '400');
			wp_die();
		}
		$f_val_type = $_POST['validationType'];
		$f_value = $_POST['validationValue'];
		// $f_email = 'kevin@ronikdesign.com';
		// $f_number = '1-631-617-4271';
		$f_phone_api_key = get_field('abstract_api_phone', 'option');
		$f_email_api_key = get_field('abstract_api_email', 'option');

		// Header Manipulation && local needs to be set to false to work correctly.
		if (defined('SITE_ENV') && SITE_ENV == 'PRODUCTION') {
			$f_sslverify = true;
		} else {
			$f_sslverify = false;
		}
		$args = array(
			'headers'     => array(
				'Content-Type' => 'application/json',
				'User-Agent'    => 'PHP',
			),
			'blocking' => true,
			'sslverify' => $f_sslverify,
		);
		// Lets run phone validation.
		if ($f_val_type == 'phone') {
			// Check if phone number has a 1
			if (substr($f_value, 0, 1) !== '1') {
				$f_value = '1' . $f_value;
			}
			$f_url = 'https://phonevalidation.abstractapi.com/v1/?api_key=' . $f_phone_api_key . '&phone=' . $f_value . '';
			$response = wp_remote_get($f_url, $args);
			// error_log(print_r($response, true ));
			if ((!is_wp_error($response)) && (200 === wp_remote_retrieve_response_code($response))) {
				$responseBody = json_decode($response['body']);
				if (json_last_error() === JSON_ERROR_NONE) {
					if ($responseBody->valid == 1) {
						error_log(print_r('Phone Vetted', true));
						wp_send_json_success($responseBody->valid);
					} else {
						wp_send_json_error('Error');
					}
				} else {
					wp_send_json_error('Error');
				}
			} else {
				wp_send_json_error('Error');
			}
		}
		// Lets run email validation.
		if ($f_val_type == 'email') {
			$f_url = 'https://emailvalidation.abstractapi.com/v1/?api_key=' . $f_email_api_key . '&email=' . $f_value . '';
			$response = wp_remote_get($f_url, $args);
			// error_log(print_r($response, true ));
			if ((!is_wp_error($response)) && (200 === wp_remote_retrieve_response_code($response))) {
				$responseBody = json_decode($response['body']);
				if (json_last_error() === JSON_ERROR_NONE) {
					if ($responseBody->is_valid_format->value == 1) {
						error_log(print_r('Email Vetted', true));
						wp_send_json_success($responseBody->is_valid_format->value);
					} else {
						wp_send_json_error('Error');
					}
				} else {
					wp_send_json_error('Error');
				}
			} else {
				wp_send_json_error('Error');
			}
		}
	}


	function my_body_classes($classes)
	{
		$f_custom_js_settings = get_field('custom_js_settings', 'options');

		if ($f_custom_js_settings['dynamic_external_link']) {
			$classes[] = 'dyn-external-link';
		}

		if ($f_custom_js_settings['smooth_scroll']) {
			$classes[] = 'smooth-scroll';
		}
		return $classes;
	}
}
