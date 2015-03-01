<?php if ( !isset($req_theme) ) {
	$req_theme = 'rectangle';
	$option_name = 'shortcode_default_'.$req_theme;
	$get_cw_option = get_option('shortcode_default_'.$req_theme, 'custom_width');
	$get_brc_option = get_option('shortcode_default_'.$req_theme, 'border_color');
	$get_bc_option = get_option('shortcode_default_'.$req_theme, 'background_color');
	$get_tc_option = get_option('shortcode_default_'.$req_theme, 'text_color');
	$get_bnc_option = get_option('shortcode_default_'.$req_theme, 'button_color');
	$get_tc_option = get_option('shortcode_default_'.$req_theme, 'button_text_color');
	
	$themes = $req_theme; 
	$custom_width = ($req_theme == 'dynamic-width')?esc_attr($get_cw_option[custom_width]):'';
	$border_color = esc_attr($get_brc_option[border_color]);
	$background_color = esc_attr($get_bc_option[background_color]);
	$text_color = esc_attr($get_tc_option[text_color]);
	$button_color = esc_attr($get_bnc_option[button_color]);
	$button_text_color = esc_attr($get_tc_option[button_text_color]);
} ?>	
<div class="sf_shortcode_con_lt">
<form action="options.php" method="post">
	<?php
	/* 	Output nonce, action, and option_page hidden fields for a settings page;	 */
	settings_fields('shortcode_default_'.$req_theme);
	/* 	Prints out all settings sections added to a particular settings page;	 */
	do_settings_sections('shortcode_default_'.$req_theme);
	?>
	<input type="hidden" value="<?php echo admin_url( 'admin.php?page=sfts-settings' ); ?>" name="_wp_http_referer">
	<!-- Custom Width -->
    <p class="color_themes">
        <label for="color_themes"><?php _e('Color Themes','online-pre-travel-shopping'); ?></label>
        <select id="color_themes" name="color_themes">
            <option value="red">Red</option>
            <option value="grey">Grey</option>
        </select>        
    </p> 
    <!-- Custom Width -->
    <p class="custom_width">
        <label for="customwidth"><?php _e('Custom Width','online-pre-travel-shopping'); ?></label>
        <input class="widget-text sc_input" id="custom_width" name="<?php echo $option_name.'[custom_width]'; ?>" type="text" value="<?php echo $custom_width; ?>" size="13" />
    </p>  
    <!-- Border Color -->
    <p>
        <label for="borderColor"><?php _e('Border Color','online-pre-travel-shopping'); ?></label>
        <input class="widget-text sf_color_pick sc_input" id="border_color" name="<?php echo $option_name.'[border_color]'; ?>" type="text" value="<?php echo isset($border_color) ? $border_color : '#5a5a5a';?>" size="13" />
    </p>               
    <!-- Background Color -->
    <p>
        <label for="backgroundColor"><?php _e('Background Color','online-pre-travel-shopping'); ?></label>
        <input class="widget-text sf_color_pick sc_input" id="background_color" name="<?php echo $option_name.'[background_color]'; ?>" type="text" value="<?php echo isset($background_color) ? $background_color : '#b92525'; ?>" size="13" />
    </p>
    <!-- Text Color -->
    <p>
        <label for="textColor"><?php _e('Text Color','online-pre-travel-shopping'); ?></label>
        <input class="widget-text sf_color_pick sc_input" id="text_color" name="<?php echo $option_name.'[text_color]'; ?>" type="text" value="<?php echo isset($text_color) ? $text_color : '#ffffff'; ?>" size="13" />
    </p>
    <!-- Button Color -->
    

    <!-- Button Text Color -->
    <p>
        <label for="buttonTextColor"><?php _e('Button Text Color','online-pre-travel-shopping'); ?></label>
        <input class="widget-text sf_color_pick sc_input" id="button_text_color" name="<?php echo $option_name.'[button_text_color]'; ?>" type="text" value="<?php echo isset($button_text_color) ? $button_text_color : '#b92525'; ?>" size="13" />
    </p>

    <input id="inputBoxColor" name="input_box_color" type="hidden" value="<?php echo "#ffffff"; ?>" size="13" />
    <input id="input_text_color" name="input_text_color" type="hidden" value="<?php echo '#5a5a5a'; ?>" size="13" />
	
	<p class="submit">
	<input type="submit" class="button-primary" value="Save" />
	</p>
</form>
</div>
<div class="sf_shortcode_con_rt">
    <?php include(SF_TRAVELSHOPPING_ABSPATH . 'views/front/search_form.php'); ?>
</div>
