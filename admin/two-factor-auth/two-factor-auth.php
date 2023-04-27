<?php
# Include packages
require_once(dirname(__DIR__, 2) . '/vendor/autoload.php');

use PragmaRX\Google2FA\Google2FA;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

use Twilio\Rest\Client;

    $f_mfa = get_field('mfa_settings', 'options');
    if(!isset($f_mfa['enable_mfa_settings']) || !$f_mfa['enable_mfa_settings']){
        return false;
    }

    function ronikdesigns_add_custom_mfa_page() {
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
    }
    ronikdesigns_add_custom_mfa_page();


    function ronikdesigns_reserve_page_template( $page_template ){
        // If the page is 2fa we add our custom ronik 2fa-template to the page.
        if ( is_page( '2fa' ) ) {
            $page_template =  dirname( __FILE__ , 2).'/custom-templates/2fa-template.php';
        }
        return $page_template;
    }
    add_filter( 'template_include', 'ronikdesigns_reserve_page_template', 99 );



    // do_action('2fa-registration-page');
    add_action('2fa-registration-page', function () {
        if($_GET["2faredirect"] == 'home'){
            header("Location:".home_url());
            die();
        }
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
            }  else {
                $valid = false;
            }
            ?>
            <?php if ($valid) { ?>
                <div class="">Authorization Saved!</div>
                <div id="countdown"></div>
                <script>
                    var timeleft = 5;
                    var downloadTimer = setInterval(function(){
                        if(timeleft <= 0){
                            clearInterval(downloadTimer);
                            document.getElementById("countdown").innerHTML = "Reloading";
                            setTimeout(() => {
                                window.location = window.location.pathname + "?2faredirect=home";
                            }, 1000);
                        } else {
                        document.getElementById("countdown").innerHTML = "Page will reload in: " + timeleft + " seconds";
                        }
                            timeleft -= 1;
                    }, 1000);
                </script>
            <?php } else { ?>
                <p><?= $get_current_secret; ?></p>
                <img src='<?= $qrcode ?>' alt='QR Code' width='100' height='100'>
                <form method="post" action="">
                    <input type="text" name="google2fa_code" value="">
                    <input type="submit" name="submit" value="Submit">
                </form>
            <?php } ?>
        <?php } else{ ?>
            Please contact system administrator. To reset 2fa code.
            <br>
            <div id="countdown"></div>
            <script>
                var timeleft = 5;
                var downloadTimer = setInterval(function(){
                    if(timeleft <= 0){
                        clearInterval(downloadTimer);
                        document.getElementById("countdown").innerHTML = "Reloading";
                        setTimeout(() => {
                            window.location = window.location.pathname + "?2faredirect=home";
                        }, 1000);
                    } else {
                    document.getElementById("countdown").innerHTML = "Page will reload in: " + timeleft + " seconds";
                    }
                        timeleft -= 1;
                }, 1000);
            </script>
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
        if(isset($_POST['google2fa_code'])){
            $login_google2fa = $_POST['google2fa_code'];
            //Get user object
            $user = get_user_by('login', $username);
            //Get stored value
            $get_current_secret = get_user_meta($user->ID, 'google2fa_secret', true);
            $google2fa_status = get_user_meta($user->ID, 'google2fa_status', true);
        } else{
            $login_google2fa = false;
            $get_current_secret = false;
        }
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
    add_action('show_user_profile', 'ronikdesign_extra_user_profile_fields');
    add_action('edit_user_profile', 'ronikdesign_extra_user_profile_fields');
    function ronikdesign_extra_user_profile_fields($user)
    {
        if(isset($_GET["user_id"])){
            $get_registration_status = get_user_meta($_GET["user_id"], $key = 'google2fa_status', true);
            if(!$get_registration_status){
                $get_registration_status = 'google2fa_unverified';
            }
        } else {
            $get_registration_status = get_user_meta(get_current_user_id(), $key = 'google2fa_status', true);
            if(!$get_registration_status){
                $get_registration_status = 'google2fa_unverified';
            }
        }
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
