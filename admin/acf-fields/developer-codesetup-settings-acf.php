<?php 

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_63e6a449c38dd',
        'title' => 'Code Template',
        'fields' => array(
            array(
                'key' => 'field_63e6a4491d1d4',
                'label' => 'Code template',
                'name' => '',
                'aria-label' => '',
                'type' => 'message',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '
                    <strong>Please follow the screenshots below as a reference point to setting up the acf fields correctly.</strong>
                    </br></br>



                    <div class="acf-setup-instructions">
                        <div class="acf-setup-instruction__content">
                            <strong>Enable Standard Text </strong></br>
                            Create a new field. Then assign the Field Name as "standard-text". 

                            Then select "Clone" Field Type. You will see a list select the "All fields from CLONE: Text Block field group." 

                            Then Display select "Seamless (replaced this field with selected fields) Select "Prefix Field Names."

                            Function listed below. "standard-text" is the acf field name
                            </br>
                            <code>ronik_standard_text("standard-text");</code>
                        </div>
                        <div class="acf-setup-instruction__img"><img src="'.plugin_dir_url( __DIR__ ) . 'screenshots/standard-text.jpg'.'"></div>
                    </div>





                    <div class="acf-setup-instructions">
                        <div class="acf-setup-instruction__content">
                            <strong>Enable Advanced Settings & Flex Establishment </strong></br>
                            Create a new field. Then assign the Field Name as "advanced_settings". 

                            Then select "Clone" Field Type. You will see a list select the "All fields from CLONE: Advanced Settings field group." 

                            Then Display select "Seamless (replaced this field with selected fields) Select "Prefix Field Names."

                            To use ronikFlexEstablishment please reference code below.

                            

                            <code>$flexname = "flex-hero";</br>$f_flexname_outer = "flex-hero-block";</br>$f_flexname_inner = "flex-hero-block__inner";</br>$f_inlineStyle = "";</br>
                                $f_content = function(){ 
                                ronik_standard_text("standard-text");
                                };</br>
                                echo ronikFlexEstablishment($block=false, $flexname, $f_flexname_outer, $f_flexname_inner, $f_inlineStyle, $f_content, $f_mod=false, $f_pageID=false );</code>

                        </div>
                        <div class="acf-setup-instruction__img"><img src="'.plugin_dir_url( __DIR__ ) . 'screenshots/advanced-settings.jpg'.'"></div>
                    </div>
                    


                    <div class="acf-setup-instructions">
                        <div class="acf-setup-instruction__content">
                            <strong>Enable Lazy Loader </strong></br>
                            Create a standard image field.  

                            Make sure return format is set to "Image Array"

                            Function listed below. Please copy code example below:
                            </br>

                            The ronik_svgplaceholder(); function creates a blank svg placeholder with the provided ACF image size.

                            <code>src="" | ronik_svgplaceholder($f_image);</code>

                            <code>data-width="" | $f_image["width"];</code>
                            <code>data-height="" | $f_image["height"];</code>
                            <code>alt="" | $f_image["alt"];</code>
                            <code>data-src="" | $f_image["url"];</code>

                            <code><img data-width="" data-height="" class="lzy_img reveal-disabled" src="<?= ronik_svgplaceholder($f_image["image"]); ?>" data-src="<?= $f_image["image"]["url"]; ?>" alt="<?= $f_image["image"]["alt"]; ?>"></code>
                        </div>
                        <div class="acf-setup-instruction__img"><img src="'.plugin_dir_url( __DIR__ ) . 'screenshots/standard-image.jpg'.'"></div>
                    </div>
                
                ',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'code-template',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
    
endif;		