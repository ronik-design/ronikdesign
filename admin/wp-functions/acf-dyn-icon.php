<?php

function dynamic_get_icon($icon){
    if(!$icon){
        return;
    }
    if($icon){
        $f_svg_path = get_stylesheet_directory_uri() . '/images/icon-acfset/migration/' . $icon['icon_select'] . '.svg';
    ?>
        <img src="<?= $f_svg_path; ?>" data-svg-color="<?= $icon['icon_color']; ?>" class="adv-svg-swap">
    <?php
    }
}