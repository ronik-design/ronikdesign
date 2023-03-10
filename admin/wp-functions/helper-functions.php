<?php
// Creates an encoded svg for src, lazy loading.
function ronik_svgplaceholder($imgacf = null)
{
	$iacf = $imgacf;
	if ($iacf) {
		if ($iacf['width']) {
			$width = $iacf['width'];
		}
		if ($iacf['height']) {
			$height = $iacf['height'];
		}
		$viewbox = "width='{$width}' height='{$height}' viewBox='0 0 {$width} {$height}'";
	} else {
		$viewbox = "viewBox='0 0 100 100'";
	}
	return "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' {$viewbox}%3E%3C/svg%3E";
}

// Creates an inline background image.
function ronikBgImage($image)
{
	return ' background-image: url(\'' . $image['url'] . '\'); ';
}

// Write error logs cleanly.
function ronik_write_log($log)
{
	$f_error_email = get_field('error_email', 'option');
	if ($f_error_email) {
		// Remove whitespace.
		$f_error_email = str_replace(' ', '', $f_error_email);
		// Lets run a backtrace to get more useful information.
		$t = debug_backtrace();
		$t_file = 'File Path Location: ' . $t[0]['file'];
		$t_line = 'File Path Location: ' .  $t[0]['line'];
		$to = $f_error_email;
		$subject = 'Error Found';
		$body = 'Error Message: ' . $log . '<br><br>' . $t_file . '<br><br>' . $t_line;
		$headers = array('Content-Type: text/html; charset=UTF-8');
		wp_mail($to, $subject, $body, $headers);
	}
	if (is_array($log) || is_object($log)) {
		error_log(print_r('<----- ' . $log . ' ----->', true));
	} else {
		error_log(print_r('<----- ' . $log . ' ----->', true));
	}
}
