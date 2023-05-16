<?php
/**
 * Template Name: Ronik Reset Password
 *
 */

?>

<?php
get_header();

$f_header = apply_filters( 'ronikdesign_passwordreset_custom_header', false );
$f_content = apply_filters( 'ronikdesign_passwordreset_custom_content', false );
$f_instructions = apply_filters( 'ronikdesign_passwordreset_custom_instructions', false );
$f_footer = apply_filters( 'ronikdesign_passwordreset_custom_footer', false );
$f_success = isset($_GET['pr-success']) ? $_GET['pr-success'] : false;
$f_error = isset($_GET['pr-error']) ? $_GET['pr-error'] : false;

if(!is_user_logged_in()){
    wp_redirect( esc_url(home_url()) );
    exit;
}
$f_userdata = wp_get_current_user();
?>

<?php if($f_header){ ?><?= $f_header(); ?><?php } ?>
	<div class="pass-reset-wrapper">
        <?php if($f_success){ ?>
            Password Successfully Reset
        <?php } ?>
        <?php if($f_error == 'nomatch'){ ?>
            Sorry your password does not match!
        <?php } ?>
        <?php if($f_error == 'missing'){ ?>
            Sorry you did not input a password!
        <?php } ?>
        <br></br>
        <?php if($f_content){ ?><?= $f_content(); ?><?php } ?>
        <br></br>
        <?php if($f_instructions){ ?><?= $f_instructions(); ?><?php } ?>
        <br></br>
		<?php if($f_userdata){ ?>
            <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
                <label for="password">Password:</label>
                <input type="password" class="adv-passwordchecker" id="password" name="password" value="" required >
                <label for="password">Retype Password:</label>
                <input type="password" class="adv-passwordchecker" id="retype_password" name="retype_password" value="" required>
                <input type="hidden" name="action" value="ronikdesigns_admin_password_reset">
                <button type="submit" value="Reset Password">Reset Password</button>
            </form>
		<?php } else { ?>
            <?= "Whoops something went wrong!" ?>
		<?php } ?>
		<br><br>
	</div>
<?php if($f_footer){ ?><?= $f_footer(); ?><?php } ?>

<?php get_footer();

// Success message
if($f_success){
    // Lets Check for the password reset url cookie.
    $cookie_name = "ronik-password-reset-redirect";
    if(isset($_COOKIE[$cookie_name])) {
        wp_redirect( esc_url(home_url(urldecode($_COOKIE[$cookie_name]))) );
        exit;
    } else {
        // We run our backup plan for redirecting back to previous page.
        // The downside this wont account for pages that were clicked during the redirect. So it will get the page that was previously visited.
        add_action('wp_footer', 'ronik_redirect_js');
        function ronik_redirect_js(){ ?>
            <script type="text/javascript">
                var x = JSON.parse(window.localStorage.getItem("ronik-password-reset"));
                window.location.replace(x.redirect);
            </script>
        <?php };
    }
}

// Lets prevent users from accessing the password reset page if they are not expired.
$f_password_reset = get_field('password_reset_settings', 'options');
// Go back in time. Lets say 30 days.
$past_date = strtotime((new DateTime())->modify('-'.$f_password_reset['pr_days'].' day')->format( 'd-m-Y' ));
// Lets store the user meta for time comparison
$current_user_reset_time_stamp = get_user_meta( $f_userdata->ID, 'wp_user-settings-time-password-reset', true);
if( $current_user_reset_time_stamp > $past_date ){
    wp_redirect( esc_url(home_url()) );
    exit;
}
?>
