<?php
/**
 * Template Name: Ronik 2fa
 *
 */

?>

<?php
get_header(); 


$f_header = apply_filters( 'ronikdesign_2fa_custom_header', false );
$f_content = apply_filters( 'ronikdesign_2fa_custom_content', false );
$f_instructions = apply_filters( 'ronikdesign_2fa_custom_instructions', false );
$f_footer = apply_filters( 'ronikdesign_2fa_custom_footer', false );

if($_GET["2faredirect"] == 'home'){
	$f_instructions_verfied_complete = true;
} else{
	$f_instructions_verfied_complete = false;
}
?>
	<?php if($f_header){ ?><?= $f_header(); ?><?php } ?>

	<div class="twofa-wrapper">
		<?php if($f_content){ ?><?= $f_content(); ?><?php } ?>
		<br></br>
		<?php if($f_instructions && !$f_instructions_verfied_complete){ ?>
			<?= $f_instructions(); ?>
		<?php } else { ?>
			<?php if(!$f_instructions_verfied_complete){ ?>
				<div class="instructions">
					<strong>Please Follow the instructions below:</strong>
					<br><br>
					<ul>
						<li>Download a Two-Factor Authentication App, the following have been tested and approved
							<ul>
								<li>Google Authenticator, Authy Authenticator, Microsoft Authenticator, LastPass Authenticator.</li>
							</ul>
						</li>
						<li>Once preferred app is downloaded and installed. 
							<ul>
								<li>Please open the app and either enter the setup key below or scan the qr code below.</li>
							</ul>
						</li>
						<li>From there you will see a 6 digit code to enter below. Every 30-15 seconds a new 6 digit code will appear within the Authentication app.
							<ul>
								<li>Once you enter the 6 digit code below. You will be redirected to the home screen. </li>
							</ul>
						</li>
						<li>From now on you will be required to enter a 6 digit code that will be generated randomly from within your preferred app.
	
						</li>
					</ul>
				</div>
			<?php } ?>
		<?php } ?>
		<br><br>
		<?php do_action('2fa-registration-page'); ?>
	</div>

	<?php if($f_footer){ ?><?= $f_footer(); ?><?php } ?>

<?php get_footer(); ?>

