<?php
/**
 * Template Name: Ronik Authorization
 *
 */

// Lets check if 2fa && MFA  is enabled. If not we kill it. 
$f_auth = get_field('mfa_settings', 'options');
if(!$f_auth['enable_2fa_settings'] && !$f_auth['enable_mfa_settings']){
	// Redirect Magic, custom function to prevent an infinite loop.
	$dataUrl['reUrl'] = array('');
	$dataUrl['reDest'] = '';
	ronikRedirectLoopApproval($dataUrl, "ronik-2fa-reset-redirect");
}






// We put this in the header for fast redirect..
$f_success = isset($_GET['sms-success']) ? $_GET['sms-success'] : false;
// Success message
if($f_success){
    // Lets Check for the password reset url cookie.
    $cookie_name = "ronik-2fa-reset-redirect";
    if(isset($_COOKIE[$cookie_name])) {
        wp_redirect( esc_url(home_url(urldecode($_COOKIE[$cookie_name]))) );
        exit;
    } else {
        // We run our backup plan for redirecting back to previous page.
        // The downside this wont account for pages that were clicked during the redirect. So it will get the page that was previously visited.
        add_action('wp_footer', 'ronikdesigns_redirect_js');
        function ronikdesigns_redirect_js(){ ?>
            <script type="text/javascript">
                var x = JSON.parse(window.localStorage.getItem("ronik-url-reset"));
                window.location.replace(x.redirect);
            </script>
        <?php };
    }
}




get_header(); 

$f_header = apply_filters( 'ronikdesign_2fa_custom_header', false );
$f_content = apply_filters( 'ronikdesign_2fa_custom_content', false );
$f_instructions = apply_filters( 'ronikdesign_2fa_custom_instructions', false );
$f_footer = apply_filters( 'ronikdesign_2fa_custom_footer', false );

$f_error = isset($_GET['sms-error']) ? $_GET['sms-error'] : false;
?>
	<?php if($f_header){ ?><?= $f_header(); ?><?php } ?>

	<div class="twofa-wrapper">



		<div class="twofa-message">
			<?php if($f_success){ ?>
				<div class="twofa-message__success">Verification Success!</div>
			<?php } ?>
			<?php if($f_error == 'nomatch'){ ?>
				<div class="twofa-message__nomatch">Sorry your verification code does not match!</div>
			<?php } ?>
		</div>



		<?php if($f_content){ ?><?= $f_content(); ?><?php } ?>
		<br></br>
		<?php if($f_instructions){ ?>
			<?= $f_instructions(); ?>
		<?php } else { ?>
			<div class="instructions">
				<strong>Please Follow the instructions below:</strong>
				<br><br>
				<ul>
	
					<li>From there you will see a 6 digit code to enter below. Every 30-15 seconds a new 6 digit code will appear within the Authentication app.
						<ul>
							<li>Once you enter the 6 digit code below. You will be redirected to the home screen. </li>
						</ul>
					</li>
				</ul>
			</div>
		<?php } ?>
		<br><br>
		<?php do_action('auth-registration-page'); ?>
	</div>

	<?php if($f_footer){ ?><?= $f_footer(); ?><?php } ?>

<?php get_footer(); ?>

