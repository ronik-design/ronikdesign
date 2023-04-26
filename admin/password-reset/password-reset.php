<?php






function password_reset_ronikdesigns(){
    // If user is not logged in we cancel the function.
	if(!is_user_logged_in()){
		return false;
	}

    function ronikdesigns_reserve_passwordreset_page_template( $page_template ){
        // If the page is 2fa we add our custom ronik 2fa-template to the page.
        if ( is_page( 'password-reset' ) ) {
            $page_template =  dirname( __FILE__ , 2).'/custom-templates/password_reset-template.php';
        }
        return $page_template;
    }
    add_filter( 'template_include', 'ronikdesigns_reserve_passwordreset_page_template', 99 );

    // Lets get the current user information
    $curr_user = wp_get_current_user();
    // Store the id.
    $curr_id = $curr_user->id;
    // Keep in mind all timestamp are within the UTC timezone. For constant all around.
    // https://www.timestamp-converter.com/
    // Get the current time.
    $current_date = strtotime((new DateTime())->format( 'd-m-Y' ));
    // Go back in time. Lets say 30 days.
    $past_date = strtotime((new DateTime())->modify('-1 day')->format( 'd-m-Y' ));

    // Lets check if the usermeta exist if it doesnt we create it.
    if( get_user_meta( $curr_id, 'wp_user-settings-time-password-reset', true) == '' ){
        // Store the current date.
        update_user_meta( $curr_id, 'wp_user-settings-time-password-reset', $current_date );
    } else {
        // Lets store the user meta for time comparison
        $current_user_reset_time_stamp = get_user_meta( $curr_id, 'wp_user-settings-time-password-reset', true);

        // Comment this out for live site..
		// This basically overrides the time.
        // $past_date_older = strtotime((new DateTime())->modify('-30 day')->format( 'd-m-Y' ));
		// error_log(print_r( $past_date_older, true));
        // $current_user_reset_time_stamp = $past_date_older;
        // End of Comment this out.

        // If past date is greater then current time stamp. We reset the user time stamp & reset the password & send them a mail.
        if( $current_user_reset_time_stamp <= $past_date ){



            if(isset($_SERVER['REDIRECT_URL'])){
                if(($_SERVER['REQUEST_URI'] !== '/wp-admin/admin-post.php') && ($_SERVER['REDIRECT_URL'] !== '/password-reset/')){
                    if( ($_SERVER['QUERY_STRING'] == 'success=success') && ($_SERVER['QUERY_STRING'] == 'error=nomatch') && ($_SERVER['QUERY_STRING'] == 'error=missing') && ($_SERVER['QUERY_STRING'] == 'error=nonce') ){
                        wp_redirect( esc_url(home_url('/password-reset/')) );
                        exit;
                    }
                }
            } else {
                if(($_SERVER['REQUEST_URI'] !== '/wp-admin/admin-post.php')){
                    wp_redirect( esc_url(home_url('/password-reset/')) );
                    exit;
                }
            }




            // update_user_meta( $curr_id, 'wp_user-settings-time-password-reset', $current_date );
			// // We reset the password to something impossibly to guess.
			// // $password = wp_generate_password( 10, true, true );
			// $password = 'admin';
			// wp_set_password( $password, $curr_id );

            // $to = $curr_user->user_email;
            // $subject = 'Password Expired.';
            // $body = 'Your password was deactivated. <br>
            // Due to not updating within the password expiration timeframe. <br>
            // Please follow this link to reset the password. <br>
            // <a href="'.wp_lostpassword_url( home_url() ).'">Password Reset.</a>';
            // $headers = array('Content-Type: text/html; charset=UTF-8');
            // wp_mail($to, $subject, $body, $headers);

            // $forgot_url = wp_lostpassword_url( home_url() );
            // setcookie("cookieForgotPassword", $forgot_url);
            // wp_logout();
            // die();
        }
    }

    // // This will redirect any backend && frontend page to 2fa.
    // function redirect_passwordreset() {
    //     // $get_current_secret = get_user_meta(get_current_user_id(), 'google2fa_secret', true);
    //     // $get_registration_status = get_user_meta(get_current_user_id(), $key = 'google2fa_status', true);
    //     if(is_user_logged_in()){
    //         // if( empty($get_current_secret) || $get_registration_status == 'google2fa_unverified'){
    //         //     // Prevent an infinite loop.
    //         //     if(get_permalink() !== home_url('/password-reset/')){
    //         //         wp_redirect( esc_url(home_url('/password-reset/')) );
    //         //         exit;
    //         //     }
    //         // }
    //         error_log(print_r('test' , true));
    //     } else{
    //         // Prevent an infinite loop.
    //         if(get_permalink() == home_url('/password-reset/')){
    //             wp_redirect( esc_url(home_url()) );
    //             exit;
    //         }
    //     }
    // }
    // add_action( 'admin_init', 'redirect_passwordreset' );
    // add_action( 'template_redirect', 'redirect_passwordreset' );





    // if(isset($_COOKIE['cookieForgotPassword'])) {
	// 	$f_url = urldecode($_COOKIE['cookieForgotPassword']);
	// 	// get current path
	// 	$url = $_SERVER['REQUEST_URI'];
	// 	// slug is already in URL, return early
	// 	if (strpos($url,'reset-password') !== false) {
	// 		return;
	// 	}
	// 	wp_redirect( $f_url );
	// 	exit;
	// }
}
add_action( 'admin_init', 'password_reset_ronikdesigns' );
add_action( 'template_redirect', 'password_reset_ronikdesigns' );


// add_filter( 'wp_mail_from', 'my_mail_from' );
// function my_mail_from( $email ) {
//     $config_wp_mail_from = 'kevin.m.mancuso@gmail.com';
//     // $config_wp_mail_from = get_field( 'config_wp_mail_from', 'options');
//     if($config_wp_mail_from){
//         return $config_wp_mail_from;
//     } else {
//         return $email;
//     }
// }
// add_filter( 'wp_mail_from_name', 'my_mail_from_name' );
// function my_mail_from_name( $name ) {
//     $config_wp_mail_from_name = 'kevin';
//     // $config_wp_mail_from_name = get_field( 'config_wp_mail_from_name', 'options');
//     if($config_wp_mail_from_name){
//         return $config_wp_mail_from_name;
//     } else {
//         return $name;
//     }
// }
