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
$f_footer = apply_filters( 'ronikdesign_2fa_custom_footer', false );
?>


<div id="Container">
	<?php if($f_header){ ?><?= $f_header; ?><?php } ?>

	<?php if($f_content){ ?><?= $f_content; ?><?php } ?>

	<div class="twofa-wrapper">
		<?php do_action('2fa-registration-page'); ?>
	</div>


</div><!-- /Container --> 

<?php if($f_footer){ ?><?= $f_footer; ?><?php } ?>


<?php get_footer(); ?>

