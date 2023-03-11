<?php
# Include packages
require_once(dirname(__DIR__, 2) . '/vendor/autoload.php');

use PragmaRX\Google2FA\Google2FA;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

use Twilio\Rest\Client;


add_action('2fa-registration-page', function () {
    $options = new QROptions([
        'eccLevel' => QRCode::ECC_L,
        'outputType' => QRCode::OUTPUT_MARKUP_SVG,
        'version' => 7,
    ]);
    $google2fa = new Google2FA();
    // Lets generate the google2fa_secret key.
    $google2fa_secret = $google2fa->generateSecretKey();
    // Lets store important data inside the usermeta.
    $get_current_secret = get_user_meta(get_current_user_id(), $key = 'google2fa_secret', true);
    $get_registration_status = get_user_meta(get_current_user_id(), $key = 'google2fa_status', true);
    // Check if user has secret if not add secret.
    if (!$get_current_secret) {
        add_user_meta(get_current_user_id(), 'google2fa_secret', $google2fa_secret);
    }
    // Check if user has google2fa_status if not add secret.
    if (!$get_registration_status) {
        add_user_meta(get_current_user_id(), 'google2fa_status', 'google2fa_unverified');
    }
    // Check if google2fa_status is not equal to verified.
    if ($get_registration_status !== 'google2fa_verified' && is_user_logged_in()) {

        // Get the User Object.
        $author_obj = get_user_by('id', get_current_user_id());
        // Lets create the QR as well.
        $g2faUrl = $google2fa->getQRCodeUrl(
            'NBCU', // Set to a default value
            $author_obj->user_email, // Set for specific email
            $get_current_secret // Lets use the $google2fa_secret we created earlier.
        );
        $qrcode = (new QRCode($options))->render($g2faUrl);
        if (isset($_POST["google2fa_code"]) && $get_registration_status !== 'google2fa_verified') {
            // Lets save the google2fa_secret to the current user_meta.
            $code = $_POST["google2fa_code"];
            $valid = $google2fa->verifyKey($get_current_secret, $code);
            if ($valid) {
                update_user_meta(get_current_user_id(), 'google2fa_status', 'google2fa_verified');
            }
        } ?>
        <?php if ($valid) { ?>
            <div class="">Authorization Saved!</div>
        <?php } else { ?>
            <p><?= $get_current_secret; ?></p>
            <img src='<?= $qrcode ?>' alt='QR Code' width='800' height='800'>
            <form method="post" action="">
                <input type="text" name="google2fa_code" value="">
                <input type="submit" name="submit" value="Submit">
            </form>
        <?php } ?>
    <?php } else{ ?>
        Please contact system administrator. To reset 2fa code.
    <?php }
});


// Add additional login field
function my_added_login_field()
{ ?>
    <br>
    <p>
        <label for="google2fa_code">Google 2fa Code <sup>**If you have not registered yet. Please leave empty!</sup>
            <br>
            <input type="text" tabindex="20" size="20" value="" class="input" id="google2fa_code" name="google2fa_code">
        </label>
    </p>
<?php
}
add_action('login_form', 'my_added_login_field');


// Add logic for auth field
function my_custom_authenticate($user, $username, $password)
{
    $google2fa = new Google2FA();
    //Get POSTED value
    $login_google2fa = $_POST['google2fa_code'];
    //Get user object
    $user = get_user_by('login', $username);
    //Get stored value
    $get_current_secret = get_user_meta($user->ID, 'google2fa_secret', true);
    $google2fa_status = get_user_meta($user->ID, 'google2fa_status', true);

    // If stored value is empty, we proceed with standard login.
    if (!$get_current_secret || $google2fa_status == 'google2fa_unverified') {
        return null;
    }
    // Lets check for the following: If user comes back false
    if (!$user) {
        //User note found, or no value entered or doesn't match stored value - don't proceed.
        remove_action('authenticate', 'wp_authenticate_username_password', 20);
        remove_action('authenticate', 'wp_authenticate_email_password', 20);
        //Create an error to return to user
        return new WP_Error('denied', __("<strong>ERROR</strong>: Sorry incorrect credentials."));
    }
    // Check if verifed. 
    $valid = $google2fa->verifyKey($get_current_secret, $login_google2fa);
    if ($valid) {
        //Make sure you return null 
        return null;
    } else {
        //User note found, or no value entered or doesn't match stored value - don't proceed.
        remove_action('authenticate', 'wp_authenticate_username_password', 20);
        remove_action('authenticate', 'wp_authenticate_email_password', 20);
        //Create an error to return to user
        return new WP_Error('denied', __("<strong>ERROR</strong>: You're unique identifier was invalid."));
    }
}
add_filter('authenticate', 'my_custom_authenticate', 10, 3);


// Per each user
add_action('show_user_profile', 'extra_user_profile_fields');
add_action('edit_user_profile', 'extra_user_profile_fields');
function extra_user_profile_fields($user)
{
    $get_registration_status = get_user_meta(get_current_user_id(), $key = 'google2fa_status', true);
?>
    <h3><?php _e("Extra profile information", "blank"); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="google2fa_code"><?php _e("Google 2fa"); ?></label></th>
            <td>
                <select name="google2fa_code" id="google2fa_code">
                    <option value="google2fa_verified" <?php if ($get_registration_status == 'google2fa_verified') { ?>selected="selected" <?php } ?>>google2fa_verified</option>
                    <option value="google2fa_unverified" <?php if ($get_registration_status == 'google2fa_unverified') { ?>selected="selected" <?php } ?>>google2fa_unverified</option>
                </select>
            </td>
        </tr>
    </table>
<?php }
add_action('personal_options_update', 'save_extra_user_profile_fields');
add_action('edit_user_profile_update', 'save_extra_user_profile_fields');
function save_extra_user_profile_fields($user_id)
{
    if (empty($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'update-user_' . $user_id)) {
        return;
    }
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'google2fa_status', $_POST['google2fa_code']);
}


// This will redirect any backend && frontend page to 2fa.
function redirect_non_registered_2fa() {
    $get_current_secret = get_user_meta(get_current_user_id(), 'google2fa_secret', true);
    $get_registration_status = get_user_meta(get_current_user_id(), $key = 'google2fa_status', true);
    if(is_user_logged_in()){
        if( empty($get_current_secret) || $get_registration_status == 'google2fa_unverified'){
            // Prevent an infinite loop.
            if(get_permalink() !== home_url('/2fa/')){
                wp_redirect( esc_url(home_url('/2fa/')) ); 
                exit;
            }
        }
    } else{
        // Prevent an infinite loop.
        if(get_permalink() == home_url('/2fa/')){
            wp_redirect( esc_url(home_url()) ); 
            exit;
        }
    }
}
add_action( 'admin_init', 'redirect_non_registered_2fa' );
add_action( 'template_redirect', 'redirect_non_registered_2fa' );


// http://simple-website.local/?private=aksms&tel=6316174271
// if($_GET["private"] == 'aksms'){
//     $sid = "AC7a4f8200ecc4e62ade27865cc6e3141e";
//     $token = "bd8942e206ae87b6fed27ae19a3b2b15";
//     $twilio = new Client($sid, $token);

//     $myTelArray = explode(',', $_GET["tel"]);
//     if($myTelArray){
//         foreach($myTelArray as $telArray){
//             $message = $twilio->messages->create("+1".$telArray,
//                 [
//                     "body" =>  'Private Code.',
//                     "from" => "+19804948670"
//                 ]
//             );
//         }
//     }
// }


// Lets get the current user information
$curr_user = wp_get_current_user();
// Store the id.
$curr_id = $curr_user->id;
// Get the current time.
$current_date = strtotime((new DateTime())->format( 'd-m-Y' ));
// Get back in time.
$past_date = strtotime((new DateTime())->modify('-1 day')->format( 'd-m-Y' ));

// Lets check if the usermeta exist if it doesnt we create it.
if( get_user_meta( $curr_id, 'wp_user-settings-time-password-reset', true) == '' ){
    // Store the current date.
    update_user_meta( $curr_id, 'wp_user-settings-time-password-reset', $current_date );
} else {
    // Lets store the user meta for time comparison
    $current_user_reset_time_stamp = get_user_meta( $curr_id, 'wp_user-settings-time-password-reset', true);   

    // If past date is greater then current time stamp. We reset the user time stamp & reset the password & send them a mail.
    if($past_date > $current_user_reset_time_stamp  ){
        update_user_meta( $curr_id, 'wp_user-settings-time-password-reset', $current_date );

        $to = $curr_user->user_email;
        $subject = 'Your password has been reset.';
        $body = get_site_url().'/wp-login.php?action=lostpassword';
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($to, $subject, $body, $headers);

        // We reset the password to something impossibly & different from the rest of the users
        $password = wp_generate_password( 10, true, true );
        wp_set_password( $password, $curr_id );
        
        wp_redirect( get_site_url().'/wp-login.php?action=lostpassword' ); 
        die();

    }
}

	