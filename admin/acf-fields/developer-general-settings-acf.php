<?php
if (function_exists('acf_add_local_field_group')) :

	acf_add_local_field_group(array(
		'key' => 'group_5632d1b054c5b_ronikdesign',
		'title' => 'Site Options',
		'fields' => array(

			array(
				'key' => 'field_6437133a90e29_ronikdesign',
				'label' => 'Dynamic Icon Field',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_64371f478861a_ronikdesign',
				'label' => '',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => 'For best results please upload only black SVGs.
			Please keep SVG simple & error free.
			
			Please do not remove row instead overwrite pre-existing row.',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			),
			array(
				'key' => 'field_6437134290e2a_ronikdesign',
				'label' => 'Icons',
				'name' => 'page_migrate_icons',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => 'svg-migration_ronikdesign',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'table',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_6437137cbcbd7_ronikdesign',
						'label' => 'SVG',
						'name' => 'svg',
						'type' => 'image',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'preview_size' => 'medium',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => 'svg, SVG',
					),
				),
			),
			array(
				'key' => 'field_643716b3e158c_ronikdesign',
				'label' => '',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => 'page_svg_migration_ronikdesign',
				),
				'message' => '',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			),




			array(
				'key' => 'field_63b73d357ba4ef_ronikdesign',
				'label' => 'Media Cleaner Field',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),

			array(
				'key' => 'field_63b73e5f5511522_ronikdesign',
				'label' => 'Offset Field',
				'name' => 'offset_field_ronikdesign',
				'type' => 'number',
				'instructions' => 'This will offset the field amount. Default ratio is 0 start / 25 end. If no images are found please increment to the next number.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '100',
					'class' => '',
					'id' => '',
				),
				'default_value' => 25,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => 30000,
				'step' => '25',
			),

			array(
				'key' => 'field_63b73e5f551152_ronikdesign',
				'label' => 'Media Cleaner Field',
				'name' => 'page_media_cleaner_field',
				'type' => 'repeater',
				'instructions' => 'Media Cleaner will go through all unattached JPG, PNG, and GIF files. </br>
				Based on media size this may take a while. Please click the "Init Unused Media Migration" then review the selected images for deletion. </br>
				Then click "Init Deletion of Unused Media". Please backup site before clicking the button! </br>
				Keep in mind that if any pages or post are in the trash. The images that are attached to those pages will be deleted. </br>
				Also please keep in mind that the older the website the higher possibility of a huge number of images being detached.
				',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_63dbeb7889cfe2_ronikdesign',
						'label' => 'Image ID',
						'name' => 'image_id',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '33.33',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
					array(
						'key' => 'field_63dbec2589cff2_ronikdesign',
						'label' => 'Image URL',
						'name' => 'image_url',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '33.33',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
					array(
						'key' => 'field_63dc0c7d33e781_ronikdesign',
						'label' => 'Thumbnail Preview',
						'name' => 'thumbnail_preview',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '33.33',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
				),
			),
			array(
				'key' => 'field_63dc084a0d9162_ronikdesign',
				'label' => '',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => 'page_media_cleaner_field',
				),
				'message' => '',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			),


			

			array(
				'key' => 'field_63b73d357ba4e_ronikdesign',
				'label' => 'Page Url Migration',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_63b73e5f55115_ronikdesign',
				'label' => 'Page Url Migration',
				'name' => 'page_url_migration',
				'type' => 'repeater',
				'instructions' => 'Please provide a valid url that you would like to replace.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_63dbeb7889cfe_ronikdesign',
						'label' => 'Original Link',
						'name' => 'original_link',
						'type' => 'link',
						'instructions' => 'The Original Link will be renamed with an "-drafted" within the slug and put in status mode "draft".',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
					array(
						'key' => 'field_63dbec2589cff_ronikdesign',
						'label' => 'New Link',
						'name' => 'new_link',
						'type' => 'link',
						'instructions' => 'The New Link will automatically copy the original link slug.',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
					array(
						'key' => 'field_63dc0c7d33e78_ronikdesign',
						'label' => 'Migration Status',
						'name' => 'migration-status',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '100',
							'class' => 'migration-status',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
				),
			),
			array(
				'key' => 'field_63dc084a0d916_ronikdesign',
				'label' => '',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => 'page_url_migration_ronikdesign',
				),
				'message' => '',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			),


			array(
				'key' => 'field_638e451534176_ronikdesign',
				'label' => 'Abstract API Settings',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),

			array(
				'key' => 'field_638e45323417701_ronikdesign',
				'label' => 'Abstract API Instructions',
				'name' => 'abstract_api_instructions',
				'type' => 'message',
				'message' => '
			Please copy the following functions within JS file:
			Function will return an object success or failure. If you are on the free plan please throttle the second function by 2000ms. Otherwise you will reach the request limit.
			</br>  To verify Email Address <br> <strong> <code style="line-height: 1.7;">verificationProcess("email", "test@ronikdesign.com" );</code> </strong>
			</br>  To verify Phone Number <br> <strong> <code style="line-height: 1.7;">verificationProcess("phone", "123-456-7890" );</code> </strong>

			</br>  Error Notes: If you encounter typeof error of undefined. Please follow the list.  
				<ul>
					<li>Try declaring the plugin script as dependency. Script name is "ronikdesign".</li>
					<li>If that does not work. Try using the following script within the js file that youre trying to invoke.</li>
					<li>				
						<code style="line-height: 1.7;">jQuery.getScript("/wp-content/plugins/ronikdesign/public/js/ronikdesign-public.js", function(){<br>&nbsp;&nbsp;&nbsp;&nbsp;verificationProcess("email", "test@ronikdesign.com" );<br>});</code>
					</li>
				</ul>
			',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),

			array(
				'key' => 'field_638e453234177_ronikdesign',
				'label' => 'Abstract API Email',
				'name' => 'abstract_api_email_ronikdesign',
				'type' => 'text',
				'instructions' => 'To retrieve api key please visit this <a href="https://app.abstractapi.com/api/email-validation/settings" target="_blank">link</a>.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_638e454234178_ronikdesign',
				'label' => 'Abstract API Phone',
				'name' => 'abstract_api_phone_ronikdesign',
				'type' => 'text',
				'instructions' => 'To retrieve api key please visit this <a href="https://app.abstractapi.com/api/phone-validation/settings" target="_blank">link</a>.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),



			array(
				'key' => 'field_638e451534179_ronikdesign',
				'label' => 'Spam Blocker Settings',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_6372ada37a019_ronikdesign',
				'label' => 'Spam Buster',
				'name' => 'gform_spam_buster',
				'type' => 'group',
				'instructions' => 'Spam Buster for Gravity Form.
				<ul>
					<li>IP Rate Limit: Mark a submission as spam if the IP address is the source of multiple submissions.</li>
					<li>Integrate with iplocate.io: iplocate.io service to be used to get the country code for the IP address of the form submitter enabling you to mark submissions as spam if they originate from specified countries.</li>
					<li>Integrate with PurgoMalum profanity filter: Use the PurgoMalum profanity filter to mark submissions as spam if Text or Paragraph field values contain words found on the PurgoMalum profanity list.</li>
				</ul>
			',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_6372afa6da3f2_ronikdesign',
						'label' => 'Enable Gravity Form Spam Buster',
						'name' => 'enable_spam_buster',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 0,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_6372adce7a01a_ronikdesign',
						'label' => 'Country Code',
						'name' => 'country_code',
						'type' => 'repeater',
						'instructions' => 'Please Refer to this website <a href="https://datahub.io/core/country-list" target="_blank">here.</a>',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' => '',
						'min' => 0,
						'max' => 0,
						'layout' => 'table',
						'button_label' => 'Add item',
						'sub_fields' => array(
							array(
								'key' => 'field_6372ae707a01c_ronikdesign',
								'label' => 'Item',
								'name' => 'item',
								'type' => 'text',
								'instructions' => 'The two letter ISO 3166-1 alpha-2 country codes.',
								'required' => 1,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'maxlength' => 2,
							),
						),
					),
				),
			),



			array(
				'key' => 'field_638e45153417900_ronikdesign',
				'label' => 'CSP Settings',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_639a476a616df_ronikdesign',
				'label' => 'Enable CSP',
				'name' => 'csp_enable',
				'aria-label' => '',
				'type' => 'true_false',
				'instructions' => 'Enabling CSP automatically adds script & style optimization such as preload & Defer attributes.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
				'ui' => 1,
			),

			array(
				'key' => 'field_639a4921626d3sas_ronikdesign',
				'label' => 'Specify Scripts you want to avoid being "Deferred"',
				'name' => 'csp_disallow-script-defer',
				'aria-label' => '',
				'type' => 'repeater',
				'instructions' => 'Please include only the handle of the script.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'table',
				'pagination' => 0,
				'min' => 0,
				'max' => 0,
				'collapsed' => '',
				'button_label' => 'Add Row',
				'rows_per_page' => 20,
				'sub_fields' => array(
					array(
						'key' => 'field_639a4adcfc742as_ronikdesign',
						'label' => 'Handle',
						'name' => 'handle',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'parent_repeater' => 'field_639a4921626d3as_ronikdesign',
					),
				),
			),



			array(
				'key' => 'field_639a4921626d3_ronikdesign',
				'label' => 'Allowable Fonts',
				'name' => 'csp_allow-fonts',
				'aria-label' => '',
				'type' => 'repeater',
				'instructions' => 'Please include only the root domain.<br>
Please do not include any special characters such as ?, &, etc.<br><br>
Please do not include any domains that are not ssl certified. By doing so, you will risk the security of your application.<br>
Google, Twitter, Linkedin, Youtube, vimeo is automatically registered however please verfiy if not working correctly.<br>
Please follow the format below:<br>
https://fonts.com/',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'table',
				'pagination' => 0,
				'min' => 0,
				'max' => 0,
				'collapsed' => '',
				'button_label' => 'Add Row',
				'rows_per_page' => 20,
				'sub_fields' => array(
					array(
						'key' => 'field_639a4adcfc742_ronikdesign',
						'label' => 'Link',
						'name' => 'link',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'parent_repeater' => 'field_639a4921626d3_ronikdesign',
					),
				),
			),
			array(
				'key' => 'field_639a4c08d8202_ronikdesign',
				'label' => 'Allowable Scripts',
				'name' => 'csp_allow-scripts',
				'aria-label' => '',
				'type' => 'repeater',
				'instructions' => 'Please include only the root domain.<br>
Please do not include any domains that are not ssl certified. By doing so, you will risk the security of your application.<br>
Please do not include any special characters such as ?, &, etc.<br><br>
Google analytics automatically registered.<br>
Please follow the format below:<br>
https://test.com/',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'table',
				'pagination' => 0,
				'min' => 0,
				'max' => 0,
				'collapsed' => '',
				'button_label' => 'Add Row',
				'rows_per_page' => 20,
				'sub_fields' => array(
					array(
						'key' => 'field_639a4c08d8203_ronikdesign',
						'label' => 'Link',
						'name' => 'link',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'parent_repeater' => 'field_639a4c08d8202_ronikdesign',
					),
				),
			),




			array(
				'key' => 'field_638e4515341790_ronikdesign',
				'label' => 'Wordpress Cleaner Settings',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_6372ada37a0190_ronikdesign',
				'label' => 'Wordpress Cleaner Settings',
				'name' => 'wp_cleaner_settings',
				'type' => 'group',
				'instructions' => 'Wordpress Cleaner Settings',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_6372afa6da3f20_ronikdesign',
						'label' => 'Hide Posts from admin',
						'name' => 'hide_posts_from_admin',
						'type' => 'true_false',
						'instructions' => 'Remove posts link from admin menu && Remove new post link from admin bar',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_6372afa6da3f21_ronikdesign',
						'label' => 'Unregister default taxonomies for Posts',
						'name' => 'unregister_default_taxonomies_posts',
						'type' => 'true_false',
						'instructions' => 'Unregister categories for posts && Unregister tags for posts',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_6372afa6da3f22_ronikdesign',
						'label' => 'Wpdoc Dequeue Dashicon',
						'name' => 'wpdocs_dequeue_dashicon',
						'type' => 'true_false',
						'instructions' => 'Disable Dashicons on Front-end',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_6372afa6da3f23_ronikdesign',
						'label' => 'Disable Self Pingback',
						'name' => 'disable_pingback',
						'type' => 'true_false',
						'instructions' => 'Disable Self Pingback',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),

					array(
						'key' => 'field_6372afa6da3f24_ronikdesign',
						'label' => 'Dequeue Block Styles',
						'name' => 'ronik_dequeue_block_styles',
						'type' => 'true_false',
						'instructions' => 'Dequeue WP Block Editor styles',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_6372afa6da3f25_ronikdesign',
						'label' => 'Mitigate information leakage vulnerability',
						'name' => 'mitigate_vulnerability',
						'type' => 'true_false',
						'instructions' => 'Mitigate information leakage vulnerability',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),


					array(
						'key' => 'field_6372afa6da3f26_ronikdesign',
						'label' => 'Remove oEmbed discovery links and REST API endpoint',
						'name' => 'remove_oEmbed_discovery',
						'type' => 'true_false',
						'instructions' => 'Remove oEmbed discovery links and REST API endpoint',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_6372afa6da3f27_ronikdesign',
						'label' => 'Removes and cleans up the unnecessary files.',
						'name' => 'remove_cleanup_files',
						'type' => 'true_false',
						'instructions' => 'This removes and cleans up the unnecessary files generated by wp by default. Remove comments links from admin bar. Disable support for comments and trackbacks for all post types. Close comments, close pings, redirect any user trying to access comments page, emove comments metabox from dashboard',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),


					array(
						'key' => 'field_6372afa6da3f28_ronikdesign',
						'label' => 'Remove unnecessary header code',
						'name' => 'remove_unnecessary_header_code',
						'type' => 'true_false',
						'instructions' => 'Remove unnecessary header code. Remove RSD link used by blog clients. Remove Windows Live Writer client link. Remove shortlink. Remove generator meta tag. Displays the relational links for the posts adjacent to the current post',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_6372afa6da3f29_ronikdesign',
						'label' => 'Rss Feed Links',
						'name' => 'rss_feed_links',
						'type' => 'true_false',
						'instructions' => 'Rss Feed Links',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),


					array(
						'key' => 'field_6372afa6da3f30_ronikdesign',
						'label' => 'Disable WordPress emojis',
						'name' => 'disable_wordpress_em',
						'type' => 'true_false',
						'instructions' => 'Disable WordPress emojis',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),


					array(
						'key' => 'field_6372afa6da3f31_ronikdesign',
						'label' => 'Remove Site Icon control from Theme Customization',
						'name' => 'remove_site_icon_control',
						'type' => 'true_false',
						'instructions' => 'Remove Site Icon control from Theme Customization',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_6372afa6da3f32_ronikdesign',
						'label' => 'Disable search',
						'name' => 'disable_search',
						'type' => 'true_false',
						'instructions' => 'Disable search',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),


					array(
						'key' => 'field_6372afa6da3f33_ronikdesign',
						'label' => 'Ronik Tinymce Disable Emojis',
						'name' => 'ronik_tinymce_disable_emojis',
						'type' => 'true_false',
						'instructions' => 'Ronik Tinymce Disable Emojis',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_6372afa6da3f34_ronikdesign',
						'label' => 'Ronik Tinymce Paste as text',
						'name' => 'ronik_tinymce_paste_as_text',
						'type' => 'true_false',
						'instructions' => 'Enable TinyMCE paste as text by default',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),




				),
			),


			array(
				'key' => 'field_638e451534179244_ronikdesign',
				'label' => 'Login Settings ',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),

			array(
				'key' => 'field_638e4515341792b_ronikdesign',
				'label' => 'MFA Settings',
				'name' => 'mfa_settings',
				'type' => 'group',
				'instructions' => 'MFASettings',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_6372afa6da3f200c_ronikdesign',
						'label' => 'Enable MFA Settings',
						'name' => 'enable_mfa_settings',
						'type' => 'true_false',
						'instructions' => 'This will enable MFA settings.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 0,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
				),
			),


			array(
				'key' => 'field_638e4515341792ba_ronikdesign',
				'label' => 'Password Reset Settings',
				'name' => 'password_reset_settings',
				'type' => 'group',
				'instructions' => 'Password Reset Settings',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_6372afa6da3f200sc_ronikdesign',
						'label' => 'Enable Password Reset Settings',
						'name' => 'enable_pr_settings',
						'type' => 'true_false',
						'instructions' => 'This will enable Password Reset.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 0,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_6372afa6da3f200sd_ronikdesign',
						'label' => 'Password Reset Days',
						'name' => 'pr_days',
						'type' => 'number',
						'instructions' => 'This will dictate Password Reset day offset.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 30,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
				),
			),


			array(
				'key' => 'field_638e4515341792_ronikdesign',
				'label' => 'Custom JS Settings',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),

			array(
				'key' => 'field_638e4515341792a_ronikdesign',
				'label' => 'Custom JS Settings',
				'name' => 'custom_js_settings',
				'type' => 'group',
				'instructions' => 'Custom JS Settings',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_6372afa6da3f200a_ronikdesign',
						'label' => 'Dynamic Image Attributes',
						'name' => 'dynamic_image_attr',
						'type' => 'true_false',
						'instructions' => 'Detect if a image has alt text attributes or not. If not we dynamically pulls text from the closest div.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),

					array(
						'key' => 'field_6372afa6da3f200b_ronikdesign',
						'label' => 'Dynamic Button Attributes',
						'name' => 'dynamic_button_attr',
						'type' => 'true_false',
						'instructions' => 'Detect if a link/ button has the neccessary attributes. If not we dynamically pulls text from the closest div.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),

					array(
						'key' => 'field_6372afa6da3f200_ronikdesign',
						'label' => 'Dynamic External Link',
						'name' => 'dynamic_external_link',
						'type' => 'true_false',
						'instructions' => 'Detect if a link is internal or external. If external add target="_blank"',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),

					array(
						'key' => 'field_6372afa6da3f201_ronikdesign',
						'label' => 'Enable Smooth Scrolling & Scroll Function On Load',
						'name' => 'smooth_scroll',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),

					array(
						'key' => 'field_6372afa6da3f202_ronikdesign',
						'label' => 'Dynamic SVG Swap',
						'name' => 'dynamic_svg_migrations',
						'type' => 'true_false',
						'instructions' => 'Replace all SVG images src with inline SVG',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 1,
						'ui' => 1,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
				),
			),




			array(
				'key' => 'field_638e45153417923_ronikdesign',
				'label' => 'Gutenberg Settings',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),

			array(
				'key' => 'field_638e45153417924_ronikdesign',
				'label' => 'Disable Gutenberg Editor for Specific Post Types',
				'name' => 'disable_gutenberg_posttype',
				'aria-label' => '',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(),
				'default_value' => array(),
				'return_format' => 'label',
				'multiple' => 1,
				'multi_min' => '',
				'multi_max' => '',
				'dyn_post_loader' => 1,
				'allow_null' => 0,
				'ui' => 1,
				'ajax' => 1,
				'placeholder' => '',
			),




			array(
				'key' => 'field_638e45153417933_ronikdesign',
				'label' => 'Error Settings',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),

			array(
				'key' => 'field_638e45153417934_ronikdesign',
				'label' => 'Email for Error log catching.',
				'name' => 'error_email',
				'type' => 'text',
				'instructions' => 'Please add one email. If mutliple emails are required. Please add a comma inbetween.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 'kevin@ronikdesign.com',
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_638e45153417935_ronikdesign',
				'label' => 'Error log catching Function',
				'name' => 'error_email_message',
				'type' => 'message',
				'message' => 'Please write error log function as shown in php:  
					ronik_write_log("Error Message");',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
			),


		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'developer-settings',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

endif;
