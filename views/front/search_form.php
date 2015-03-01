<?php
$get_option = get_option('sfts_settings_value', 'affiliate_id');
$affiliate_value = esc_attr($get_option[affiliate_id]);

echo "<script>var theme='$themes';</script>";

?>
<div class="sf_box sf_<?php echo $themes; ?>" style="border-color:<?php echo $border_color; ?>; background:<?php echo $background_color; ?>; width:<?php if($themes == 'dynamic-width'){ echo $custom_width;} ?>px;">
    <h3 style="color:<?php echo $text_color; ?>;font-size:32px;">
       <?php _e('Shop the world','online-pre-travel-shopping');?>
        <span style="color:<?php echo $text_color; ?>;"><?php _e('before you leave home!','online-pre-travel-shopping');?></span> 
    </h3>
    <div class="sf_form_container">
        <form id="sf_formr" class="sf_form" name="sf_formr" method="post">
            <div class="sf_form_body">
                <p>
                    <label style="color:<?php echo $text_color; ?>;"><?php _e('What would you like to buy?','online-pre-travel-shopping');?></label>
                    <input type="text" name="sf_buy" id="sf_buy" class="sf_buy sf_input sf_input_large" placeholder="Johnnie Walker Black Label" style="color:<?php echo $input_text_color; ?>; background:<?php echo $input_box_color; ?>;" value=""/>
                </p>
                <p>
                    <span class="sf_from">
                        <label style="color:<?php echo $text_color; ?>;"><?php _e('From','online-pre-travel-shopping');?></label>
                        <input name="sf_from" id="sf_from" class="sf_autocomplete_input sf_airports" placeholder="<?php _e('city or airport','online-pre-travel-shopping');?>" style="color:<?php echo $input_text_color; ?>; background:<?php echo $input_box_color; ?>;" value="" title="" />
                    </span>
                    <span class="sf_to">
                        <label style="color:<?php echo $text_color; ?>;"><?php _e('To','online-pre-travel-shopping');?></label>
                        <input name="sf_to" id="sf_to" class="sf_autocomplete_input sf_airports" placeholder="<?php _e('city or airport','online-pre-travel-shopping');?>" style="color:<?php echo $input_text_color; ?>; background:<?php echo $input_box_color; ?>;" value="" title="" />
                    </span>
                </p>                               
            </div>
            <input type="hidden" name="affiliate_id" id="affiliate_id" value="<?php echo $affiliate_value; ?>"/>
            <div class="sf_form_footer">
                <p class="sf_form_submit">
                    <input type="submit" value="<?php _e('Search','online-pre-travel-shopping');?>" class="sf_search_button" onclick="javascript:void(0)" style="color:<?php echo $button_text_color; ?>; background:<?php echo $button_color; ?>;" />
                </p>
                <ul class="sf_steps" style="color:<?php echo $text_color; ?>;display:<?php if($custom_width<400){echo ('none');}?>;">
                    <li class="sf_step_shop" style="color:<?php echo $text_color; ?>;"><i class="icon-shop"></i><span style=" background:<?php echo $background_color; ?>;"><?php _e('Shop','online-pre-travel-shopping');?></span></li>
                    <li class="sf_step_collect" style="color:<?php echo $text_color; ?>;"><i class="icon-collect"></i><span style=" background:<?php echo $background_color; ?>;"><?php _e('Collect','online-pre-travel-shopping');?></span></li>
                    <li class="sf_step_fly" style="color:<?php echo $text_color; ?>;"><i class="icon-fly"></i><span style=" background:<?php echo $background_color; ?>;"><?php _e('Fly','online-pre-travel-shopping');?></span></li>
                </ul>
                <br>
                <span style="color:<?php echo $text_color; ?>;font-size:12px;font-family: 'Helvetica-Neue-Light', Arial;top:5px;"><a href="https://shopnfly.com" style="color:<?php echo $text_color; ?>;" title="Pre-travel shopping" target="_blank"><?php _e('Pre-travel shopping','online-pre-travel-shopping');?></a><?php if($themes == 'narrow' || $themes =='wide'){ echo "<br>" ;}?><?php _e(' by shopnfly','online-pre-travel-shopping');?></span>
            </div>
        </form>                        
    </div>
</div>
