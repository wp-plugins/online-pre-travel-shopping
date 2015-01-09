<?php
$get_option = get_option('sfts_settings_value', 'affiliate_id');
$affiliate_value = esc_attr($get_option[affiliate_id]);

echo "<script>var theme='$themes';</script>";

?>
<div class="sf_box sf_<?php echo $themes; ?>" style="border-color:<?php echo $border_color; ?>; background:<?php echo $background_color; ?>; width:<?php if($themes == 'Dynamic'){ echo $custom_width;} ?>px;">
    <h3 style="color:<?php echo $text_color; ?>;">
        Shop the world
        <span style="color:<?php echo $text_color; ?>;">before you leave home!</span> 
    </h3>
    <div class="sf_form_container">
        <form id="sf_formr" class="sf_form" name="sf_formr" method="post">
            <div class="sf_form_body">
                <p>
                    <label style="color:<?php echo $text_color; ?>;">What would you like to buy?</label>
                    <input type="text" name="sf_buy" id="sf_buy" class="sf_buy sf_input sf_input_large" placeholder="Johnnie Walker Black Label" style="color:<?php echo $input_text_color; ?>; background:<?php echo $input_box_color; ?>;" value=""/>
                </p>
                <p>
                    <span class="sf_from">
                        <label style="color:<?php echo $text_color; ?>;">From</label>
                        <input name="sf_from" id="sf_from" class="sf_autocomplete_input sf_airports" placeholder="city or airport" style="color:<?php echo $input_text_color; ?>; background:<?php echo $input_box_color; ?>;" value="" title="" />
                    </span>
                    <span class="sf_to">
                        <label style="color:<?php echo $text_color; ?>;">To</label>
                        <input name="sf_to" id="sf_to" class="sf_autocomplete_input sf_airports" placeholder="city or airport" style="color:<?php echo $input_text_color; ?>; background:<?php echo $input_box_color; ?>;" value="" title="" />
                    </span>
                </p>                               
            </div>
            <input type="hidden" name="affiliate_id" id="affiliate_id" value="<?php echo $affiliate_value; ?>"/>
            <div class="sf_form_footer">
                <p class="sf_form_submit">
                    <input type="submit" value="Search" class="sf_search_button" onclick="javascript:void(0)" style="color:<?php echo $button_text_color; ?>; background:<?php echo $button_color; ?>;" />
                </p>
                <ul class="sf_steps" style="color:<?php echo $text_color; ?>;">
                    <li class="sf_step_shop" style="color:<?php echo $text_color; ?>;"><i class="icon-shop"></i><span style=" background:<?php echo $background_color; ?>;">Shop</span></li>
                    <li class="sf_step_collect" style="color:<?php echo $text_color; ?>;"><i class="icon-collect"></i><span style=" background:<?php echo $background_color; ?>;">Collect</span></li>
                    <li class="sf_step_fly" style="color:<?php echo $text_color; ?>;"><i class="icon-fly"></i><span style=" background:<?php echo $background_color; ?>;">Fly</span></li>
                </ul>
                <br>
                <span style="color:<?php echo $text_color; ?>;"><a href="https://shopnfly.com" style="color:<?php echo $text_color; ?>;" title="Pre-travel shopping" target="_blank">Pre-travel shopping</a><?php if($themes == 'narrow' || $themes =='wide'){ echo "<br>" ;}?> by shopnfly</span>
            </div>
        </form>                        
    </div>
</div>