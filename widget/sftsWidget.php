<? class sftsWidget extends WP_Widget {

    /* Register widget with WordPress.*/
    function __construct() {
        parent::__construct(
                'sfts-widget', // Base ID
                'Shopnfly Travel Shopping Widget', // Name
                array('classname' => 'swsbWidget', 'description' => 'Shop the world, before you leave home!') // Args
        );
    }

    /* Front-end display of widget.
     * do not rename this */
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $themes = esc_attr($instance['themes']);
		$custom_width = esc_attr($instance['custom_width']) == !null ? esc_attr($instance['custom_width']) : '';
        $border_color = esc_attr($instance['border_color']) == !null ? esc_attr($instance['border_color']) : '#5a5a5a';
        $background_color = esc_attr($instance['background_color']) == !null ? esc_attr($instance['background_color']) : '#b92525';
        $text_color = esc_attr($instance['text_color']) == !null ? esc_attr($instance['text_color']) : '#ffffff';
        $button_color = esc_attr($instance['button_color']) == !null ? esc_attr($instance['button_color']) : '#ffffff';
        $button_text_color = esc_attr($instance['button_text_color']) == !null ? esc_attr($instance['button_text_color']) : '#b92525';
        $input_box_color = esc_attr($instance['input_box_color']);
        $input_text_color = esc_attr($instance['input_text_color']);
        ?>
        <?php echo $before_widget; ?>
        <?php
        if ($title)
            echo $before_title . $title . $after_title;
        ?>
		<?php include(SF_TRAVELSHOPPING_ABSPATH . 'views/front/search_form.php');?>
        <?php echo $after_widget; ?>
        <?php
    }

    /* Update widget values in option table 
	* do not rename this */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['themes'] = strip_tags($new_instance['themes']);
		$instance['custom_width'] = strip_tags($new_instance['custom_width']);
        $instance['border_color'] = strip_tags($new_instance['border_color']);
        $instance['background_color'] = strip_tags($new_instance['background_color']);
        $instance['text_color'] = strip_tags($new_instance['text_color']);
        $instance['button_color'] = strip_tags($new_instance['button_color']);
        $instance['button_text_color'] = strip_tags($new_instance['button_text_color']);
        $instance['input_box_color'] = strip_tags($new_instance['input_box_color']);
        $instance['input_text_color'] = strip_tags($new_instance['input_text_color']);
        return $instance;
    }

    /* Backend Widget form
		* do not rename this */
    function form($instance) {
	
	$get_cw_option = get_option('shortcode_default_rectangle', 'custom_width');
	$get_brc_option = get_option('shortcode_default_rectangle', 'border_color');
	$get_bc_option = get_option('shortcode_default_rectangle', 'background_color');
	$get_tc_option = get_option('shortcode_default_rectangle', 'text_color');
	$get_bnc_option = get_option('shortcode_default_rectangle', 'button_color');
	$get_tc_option = get_option('shortcode_default_rectangle', 'button_text_color');
	
	$custom_width = esc_attr($get_cw_option[custom_width]);
	$border_color = esc_attr($get_brc_option[border_color]);
	$background_color = esc_attr($get_bc_option[background_color]);
	$text_color = esc_attr($get_tc_option[text_color]);
	$button_color = esc_attr($get_bnc_option[button_color]);
	$button_text_color = esc_attr($get_tc_option[button_text_color]);

      $themes_arr = array('rectangle_Rectangle', 'wide_Wide', 'narrow_Narrow', 'dynamic-width_Dynamic Width');
        $themes = esc_attr($instance['themes']);
		$custom_width = esc_attr($instance['custom_width']) == !null ? esc_attr($instance['custom_width']) : $custom_width;
        $border_color = esc_attr($instance['border_color']) == !null ? esc_attr($instance['border_color']) : $border_color;
        $background_color = esc_attr($instance['background_color']) == !null ? esc_attr($instance['background_color']) : $background_color;
        $text_color = esc_attr($instance['text_color']) == !null ? esc_attr($instance['text_color']) : $text_color;
        $button_color = esc_attr($instance['button_color']) == !null ? esc_attr($instance['button_color']) : $button_color;
        $button_text_color = esc_attr($instance['button_text_color']) == !null ? esc_attr($instance['button_text_color']) : $button_text_color;
        $input_box_color = esc_attr($instance['input_box_color']);
        $input_text_color = esc_attr($instance['input_text_color']);
        ?>
        <!-- Themes -->
        <div class="sf_widget_content">
            <p>
                <label for="<?php echo $this->get_field_name('themes'); ?>"><?php _e('Themes:'); ?></label> 

                <select id="<?php echo $this->get_field_id('themes'); ?>" name="<?php echo $this->get_field_name('themes'); ?>" class="widget-sel">
                    <?php
                    foreach ($themes_arr as $atheme) :
                        $atheme = explode('_', $atheme);
                        $atheme_name = $atheme[1];
                        $atheme_value = $atheme[0];
                        ?>
                        <option value="<?php echo esc_attr($atheme_value) ?>" <?php selected($themes, $atheme_value) ?>><?php echo esc_attr($atheme_name); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
			
			<!-- Custom Width -->
            <p class="sf_custom_widget_width">
                <label for="<?php echo $this->get_field_name('custom_width'); ?>"><?php _e('Custom Width'); ?></label> 
                <input class="widget-text widget-cw" id="<?php echo $this->get_field_id('custom_width'); ?>" name="<?php echo $this->get_field_name('custom_width'); ?>" type="text" value="<?php echo $custom_width; ?>" size="13" />
            </p> 

            <!-- Border Color -->
            <p>
                <label for="<?php echo $this->get_field_name('border_color'); ?>"><?php _e('Border Color'); ?></label> 
                <input class="widget-text sf_color_pick widget-bc" id="<?php echo $this->get_field_id('border_color'); ?>" name="<?php echo $this->get_field_name('border_color'); ?>" type="text" value="<?php echo $border_color; ?>" size="13" />
            </p>               
            <!-- Background Color -->
            <p>
                <label for="<?php echo $this->get_field_name('background_color'); ?>"><?php _e('Background Color'); ?></label> 
                <input class="widget-text sf_color_pick widget-bgc" id="<?php echo $this->get_field_id('background_color'); ?>" name="<?php echo $this->get_field_name('background_color'); ?>" type="text" value="<?php echo $background_color; ?>" size="13" />
            </p>


            <!-- Text Color -->
            <p>
                <label for="<?php echo $this->get_field_name('text_color'); ?>"><?php _e('Text Color'); ?></label> 
                <input class="widget-text sf_color_pick widget-tc" id="<?php echo $this->get_field_id('text_color'); ?>" name="<?php echo $this->get_field_name('text_color'); ?>" type="text" value="<?php echo $text_color; ?>" size="13" />
            </p>

            <!-- Button Color -->
            <p>
                <label for="<?php echo $this->get_field_name('button_color'); ?>"><?php _e('Button Color'); ?></label> 
                <input class="widget-text sf_color_pick widget-bnc" id="<?php echo $this->get_field_id('button_color'); ?>" name="<?php echo $this->get_field_name('button_color'); ?>" type="text" value="<?php echo $button_color; ?>" size="13" />
            </p>

            <!-- Button Text Color -->
            <p>
                <label for="<?php echo $this->get_field_name('button_text_color'); ?>"><?php _e('Button Text Color'); ?></label> 
                <input class="widget-text sf_color_pick widget-btc" id="<?php echo $this->get_field_id('button_text_color'); ?>" name="<?php echo $this->get_field_name('button_text_color'); ?>" type="text" value="<?php echo $button_text_color; ?>" size="13" />
            </p>

            <!-- Input Box Color -->
            <!--<p>
            <label for="<?php //echo $this->get_field_name('input_box_color');                                                                               ?>"><?php //_e('Input Box Color');                                                                               ?></label> -->
            <input id="<?php echo $this->get_field_id('input_box_color'); ?>" name="<?php echo $this->get_field_name('input_box_color'); ?>" type="hidden" value="<?php echo "#ffffff"; ?>" size="13" />
            <!--</p>-->

            <!-- Input Text Color -->
            <!--<p>
            <label for="<?php //echo $this->get_field_name('input_text_color');                                                                              ?>"><?php //_e('Input Text Color');                                                                              ?></label> -->
            <input id="<?php echo $this->get_field_id('input_text_color'); ?>" name="<?php echo $this->get_field_name('input_text_color'); ?>" type="hidden" value="<?php echo '#5a5a5a'; ?>" size="13" />
            <!--</p>-->            
        </div>
        <?php
    }
}
?>