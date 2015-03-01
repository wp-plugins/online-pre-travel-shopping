<div class="sf_settings_page">
    <ul class="sf_default_settings sf_tab_head">
        <li id="sf_settings_tab" class="sf_current"><a class="sfts_settings current" href="javascript:void(0);">Default Settings</a></li>
        <li id="sf_shortcode_tab"><a class="sfts_shortcodegenerate" href="javascript:void(0);">Shortcode Generator</a></li>
    </ul>
    <div class="sf_tab_content">
        <div id="sf_basic_settings" class="sf_tabs sf_current sf_settings_tab">
            <form action="options.php" method="post">
                <?php
                /* 	Output nonce, action, and option_page hidden fields for a settings page;	 */
                settings_fields('sfts_settings_value');
                /* 	Prints out all settings sections added to a particular settings page;	 */
                do_settings_sections('sfts_settings_value');
                $get_option = get_option('sfts_settings_value', 'affiliate_id');

                if ($get_option[affiliate_id] != '12345') {
                    $affiliate_value = esc_attr($get_option[affiliate_id]);
                }
                ?>

                <p>
                    <label for="affiliateID"><?php _e('Enter your Shopnfly Affiliate ID:','online-pre-travel-shopping'); ?></label> 
                    <input class="widget-text" type="text" name="sfts_settings_value[affiliate_id]" id="affiliate_id" value="<? echo $affiliate_value; ?>" placeholder="Your Affiliate ID here" /> In order to get an affiliate id, please press on this <a href="https://www.shopnfly.com/affiliates" target="_blank">link</a>
                </p>

                <p class="submit">
                    <input type="submit" class="button-primary" value="<?php _e('Save Changes','online-pre-travel-shopping'); ?>" />
                </p>
            </form>
        </div>
        <div id="sf_shortcode_tabs" class="sf_tabs sf_shortcode_tab">
            <h3>Shortcode generator</h3>
            <br class="clear" />
            <ul class="theme-change sf_tab_con_head">
                <li class="sf_current"><a class="rectangle" href="javascript:void(0);">Rectangle</a></li>
                <li><a class="wide" href="javascript:void(0);">Wide</a></li>
                <li><a class="narrow" href="javascript:void(0);">Narrow</a></li>
                <li><a class="dynamic-width" href="javascript:void(0);">Dynamic Width</a></li>
            </ul><br class="clear" />

            <div class="sf_shortcode_theme_box">
                <?php require_once SF_TRAVELSHOPPING_ABSPATH . 'views/admin/sfts_theme/theme.php'; ?>
            </div>
            <div class="dynamic-shortcode" style="margin-top:50px;">
                <h4><i><strong>Implement anywhere on your blog</strong></i></h4>
                <p>a) To add a searchbox to your header, footer or sidebar, open the template file in WordPress editor and copy the following code in it:</p>
                <p><input type="text" size="80" value='&lt;?php echo do_shortcode(&#39;[sf_travel_shop t = "rectangle" bc = "#5a5a5a" bac = "#b92525" tc = "#ffffff" buc = "#ffffff" butc = "#b92525"]&#39;); ?&gt;' id="sftp_shortcode_php" onclick="this.select();" readonly /> <input type="button" class="button-highlighted button-primary" value="<?php _e('Select','online-pre-travel-shopping'); ?>" onclick="javascript:jQuery(this).prev().select();" /></p>

                <h4><i><strong>Implement inside a post/page</strong></i></h4>
                <p>a) Copy the following shorcode into any post/page inside WordPress visual editor:</p>
                <p><input type="text" size="80" value='[sf_travel_shop t = "rectangle" bc = "#5a5a5a" bac = "#b92525" tc = "#ffffff" buc = "#ffffff" butc = "#b92525"]' id="sftp_shortcode" onclick="this.select();" readonly /> <input type="button" class="button-highlighted button-primary" value="<?php _e('Select','online-pre-travel-shopping'); ?>" onclick="javascript:jQuery(this).prev().select();" /></p>                
            </div>
        </div>
    </div>
</div>
