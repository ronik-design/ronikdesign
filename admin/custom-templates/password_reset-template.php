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
$f_userdata =  wp_get_current_user();

?>

<div id="Container">
	<?php if($f_header){ ?><?= $f_header; ?><?php } ?>

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


	<?php if($f_content){ ?><?= $f_content; ?><?php } ?>

	<div class="pass-reset-wrapper">
        <?php if($f_instructions){ ?><?= $f_instructions; ?><?php } ?>

		<?php if($f_userdata){ ?>
            <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
                <label for="password">Password:</label><br>
                <input type="password" class="adv-passwordchecker" id="password" name="password" value="" required ><br><br>
                <label for="password">Retype Password:</label><br>
                <input type="password" class="adv-passwordchecker" id="retype_password" name="retype_password" value="" required><br><br>
                <input type="hidden" name="action" value="ronikdesigns_admin_password_reset">
                <input type="submit" value="Send My Message">
            </form>   

		<?php } else { ?>
            <?= "Whoops something went wrong!" ?>
		<?php } ?>
		<br><br>
	</div>


</div><!-- /Container --> 

<?php if($f_footer){ ?><?= $f_footer; ?><?php } ?>


<?php get_footer(); ?>

