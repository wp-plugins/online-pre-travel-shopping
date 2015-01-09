;
jQuery(function($) {
// Settings Tabbed Content
    $('.sf_tab_head li').click(function() {
        $(this).parent().children('li').removeClass('sf_current');
        $('.sf_tab_content .sf_tabs').hide();
        $(this).addClass('sf_current');
        var cur_tab = $(this).attr('id');
        $('.' + cur_tab).show();
    });
    $('.sf_tab_con_head li').click(function() {
        $(this).parent().children('li').removeClass('sf_current');
        $(this).addClass('sf_current');
        var cur_theme = $(this).children('a').attr('class');
        var plugin_url = $("#purl").val();
        $('.sf_shortcode_con_rt .sf_box').removeClass().addClass('sf_box sf_' + cur_theme);
        $('.custom_width').hide();
        $('.custom_width #custom_width').val('');
        $('.sf_shortcode_con_rt .sf_box').css('width', '');
        generate_shortcode();
        shortcode_theme_page_change(cur_theme, plugin_url);
    });
// Pre-defined Color Themes
    pre_defined_colors();
    function pre_defined_colors()
    {
        $('#color_themes').change(function() {
            var cur_pre_color = $(this).val();
            if (cur_pre_color == 'red') {
                var sf_pbc = '#5a5a5a';
                var sf_pbac = '#b92525';
                var sf_ptc = '#ffffff';
                var sf_pbuc = '#ffffff';
                var sf_pbutc = '#b92525';
            } else if (cur_pre_color == 'grey') {
                var sf_pbc = '#5a5a5a';
                var sf_pbac = '#f5f5f5';
                var sf_ptc = '#5a5a5a';
                var sf_pbuc = '#bb231e';
                var sf_pbutc = '#ffffff';
            }
            $('.sf_shortcode_con_lt #border_color').val(sf_pbc);
            $('.sf_shortcode_con_lt #background_color').val(sf_pbac);
            $('.sf_shortcode_con_lt #text_color').val(sf_ptc);
            $('.sf_shortcode_con_lt #button_color').val(sf_pbuc);
            $('.sf_shortcode_con_lt #button_text_color').val(sf_pbutc);
            $('.sf_color_pick').each(function() {
                var pre_color = $(this).val();
                $(this).css({'background': pre_color}).val(pre_color);
                var pre_color_pick = $(this).attr('id');
                if (pre_color_pick == 'border_color') {
                    $('.sf_box').css({'border-color': pre_color});
                } else if (pre_color_pick == 'background_color') {
                    $('.sf_box, .sf_form_footer .sf_steps li span').css({'background': pre_color});
                } else if (pre_color_pick == 'text_color') {
                    $('.sf_box h3, .sf_form_body label, .sf_form_footer p, .sf_form_footer .sf_steps li, .sf_form_footer p a, .sf_box.sf_dynamic-width .sf_form_footer .sf_steps').css({'color': pre_color});
                } else if (pre_color_pick == 'button_color') {
                    $('.sf_form_footer input.sf_search_button[type="submit"]').css({'background': pre_color});
                } else if (pre_color_pick == 'button_text_color') {
                    $('.sf_form_footer input.sf_search_button[type="submit"]').css({'color': pre_color});
                }
                generate_shortcode();
            });
        });
    }

// Color Picker
    var $sf_widget_div = $('.sf_widget_content');
    var $sf_shortcode_tab_div = $('.sf_shortcode_tab');
    var f;
    if ($sf_widget_div.length || $sf_shortcode_tab_div.length) {
        $('body').append('<div class="sf_picker"> </div>');
        var f = $.farbtastic('.sf_picker');
    }
    var p = $('.sf_picker');
    p.hide();
    var selected;
    sf_color_picker();
    function sf_color_picker() {
        $('.sf_color_pick')
                .each(function() {
                    f.linkTo(this);
                })
                .blur(function() {
                    p.hide();
                    $('.sf_color_pick').removeClass('sf_color_pick_selected');
                })
                .focus(function() {
                    if (selected) {
                        $(selected).removeClass('sf_color_pick_selected');
                    }
                    f.linkTo(live_preview);
                    p.show();
                    var offset = $(this).offset();
                    p.css({"left": offset.left - 90, "top": offset.top + 30});
                    $(selected = this).addClass('sf_color_pick_selected');
                });
    }

// Live Preview
    function live_preview(color) {
        $('.sf_color_pick_selected').css({'background': color}).val(color);
        var sel_color_pick = $('.sf_color_pick_selected').attr('id');
        if (sel_color_pick == 'border_color') {
            $('.sf_box').css({'border-color': color});
        } else if (sel_color_pick == 'background_color') {
            $('.sf_box, .sf_form_footer .sf_steps li span').css({'background': color});
        } else if (sel_color_pick == 'text_color') {
            $('.sf_box h3, .sf_form_body label, .sf_form_footer p, .sf_form_footer .sf_steps li, .sf_form_footer p a, .sf_box.sf_dynamic-width .sf_form_footer .sf_steps').css({'color': color});
        } else if (sel_color_pick == 'button_color') {
            $('.sf_form_footer input.sf_search_button[type="submit"]').css({'background': color});
        } else if (sel_color_pick == 'button_text_color') {
            $('.sf_form_footer input.sf_search_button[type="submit"]').css({'color': color});
        }
        generate_shortcode();
    }

    shortcode_dynamic_width();
    function shortcode_dynamic_width()
    {
        //Shortcode color picker fix
        $('.sf_shortcode_theme_box input[type="submit"]').click(function() {
            setTimeout(function() {
                sf_color_picker();
            }, 2000);
        });
        // Dynamic Width
        $('.custom_width #custom_width').on('input', function() {
            var w_val = $(this).val();
            $('.sf_box').css('width', w_val);
            generate_shortcode();
        });
    }

// Widget Custom Width
    widget_change();
    function widget_change()
    {
        $('.widget-sel').each(function() {
            var cur_widget = $(this).closest('.widget').attr('id');
            if ($(this).val() == 'dynamic-width')
            {
                $('#' + cur_widget + ' p.sf_custom_widget_width').show();
            }
        }).change(function() {
            var cur_widget = $(this).closest('.widget').attr('id');
            if ($(this).val() == 'dynamic-width')
            {
                $('#' + cur_widget + ' p.sf_custom_widget_width').show();
            }
            else
            {
                $('#' + cur_widget + ' p.sf_custom_widget_width').hide();
            }

            var mydata = {
                action: "theme_update_request",
                'sel_theme': $(this).val(),
                'mode': 'widget'
            };
            $.ajax({
                type: "POST",
                url: ajaxurl,
                dataType: "json",
                data: mydata,
                success: function(data, textStatus, jqXHR) {
                    var th = data.themes;
                    var cw = data.custom_width;
                    var bc = data.border_color;
                    var bgc = data.background_color;
                    var txt = data.text_color;
                    var bnc = data.button_color;
                    var bntc = data.button_text_color;
                    $('#' + cur_widget + ' input.widget-cw').val(cw);
                    $('#' + cur_widget + ' input.widget-bc').val(bc);
                    $('#' + cur_widget + ' input.widget-bgc').val(bgc);
                    $('#' + cur_widget + ' input.widget-tc').val(txt);
                    $('#' + cur_widget + ' input.widget-bnc').val(bnc);
                    $('#' + cur_widget + ' input.widget-btc').val(bntc);
                    sf_color_picker();
                },
                error: function(errorMessage) {
                    console.log(errorMessage);
                }
            });
        });
    }
// Widget Color Picker Fix
    widget_color_picker_fix();
    function widget_color_picker_fix() {
        $('.widget-control-actions .widget-control-save').click(function() {
            var cur_save_id = $(this).closest('.widget').attr('id');
            if ($('#' + cur_save_id + ' .id_base').val() == 'sfts-widget') {
                setTimeout(function() {
                    sf_color_picker();
                    widget_change();
                }, 2000);
            }
        });
    }
    $('.widgets-holder-wrap').hover(function() {

        if ($(this).hasClass('widget-hover')) {
            setTimeout(function() {
                sf_color_picker();
                widget_color_picker_fix();
                widget_change();
            }, 2000);
        }
    });


// Generate Shortcode
    generate_shortcode();
    function generate_shortcode() {
        var sf_w = $('.sf_shortcode_con_lt #custom_width').val();
        var sf_t = $('.sf_tab_con_head li.sf_current').children('a').attr('class');
        var sf_bc = $('.sf_shortcode_con_lt #border_color').val();
        var sf_bac = $('.sf_shortcode_con_lt #background_color').val();
        var sf_tc = $('.sf_shortcode_con_lt #text_color').val();
        var sf_buc = $('.sf_shortcode_con_lt #button_color').val();
        var sf_butc = $('.sf_shortcode_con_lt #button_text_color').val();
        var sf_shcode = '[sf_travel_shop t = "' + sf_t + '" bc = "' + sf_bc + '" bac = "' + sf_bac + '" tc = "' + sf_tc + '" buc = "' + sf_buc + '" butc = "' + sf_butc + '"]';
        if ($('.custom_width #custom_width').val() != '') {
            sf_shcode = '[sf_travel_shop t = "' + sf_t + '" bc = "' + sf_bc + '" bac = "' + sf_bac + '" tc = "' + sf_tc + '" buc = "' + sf_buc + '" butc = "' + sf_butc + '" w = "' + sf_w + '"]';
        }

        $('#sftp_shortcode_php').val('<?php echo do_shortcode(\'' + sf_shcode + '\'); ?>');
        $('#sftp_shortcode').val(sf_shcode);
    }

// Autocomplete
    sf_auto_complete();
    function sf_auto_complete() {
        $('body').append('<div class="sf_auto_container" />')
        $('.sf_airports:input[name=sf_from]').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: buildUrl("airports/autocomplete"),
                    dataType: "json",
                    data: {
                        GET: 1,
                        token: 'SECRET',
                        q: request.term,
                        short: 1,
                        all: 1,
                        js: 1
                    },
                    success: function(data) {
                        // debugger;
                        initAutocomplete();
                        response(data);
                    }
                });
            },
            minLength: 3,
            autoFocus: true,
            maxHeight: 300,
            appendTo: ".sf_auto_container",
            select: function(event, ui) {
                $(".sf_airports:input[name=sf_from]").prop("id", ui.item.id);
            }
        });
        $('.sf_airports:input[name=sf_to]').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: buildUrl("airports/autocomplete"),
                    dataType: "json",
                    data: {
                        GET: 1,
                        token: 'SECRET',
                        q: request.term,
                        short: 1,
                        all: 1,
                        js: 1
                    },
                    success: function(data) {
                        // debugger;
                        initAutocomplete();
                        response(data);
                    }
                });
            },
            minLength: 3,
            autoFocus: true,
            maxHeight: 300,
            appendTo: ".sf_auto_container",
            select: function(event, ui) {
                $(".sf_airports:input[name=sf_to]").prop("id", ui.item.id);
            }
        });
    }

    // Base URL
    function buildUrl(baseUrl) {
        var finalUrl;
        finalUrl = "https://api.shopnfly.com/v1/index.php/" + baseUrl;
        return finalUrl;
    }

    // Load Dropdown Values
    function initAutocomplete() {
        $.ui.autocomplete.prototype._renderItem = function(ul, item) {
            var term = this.term.split(' ').join('|');
            var re = new RegExp("(" + term + ")", "gi");
            var t = item.label.replace(re, "<b>$1</b>");
            return $("<li></li>").data("item.autocomplete", item).append("<a>" + t + "</a>").appendTo(ul);
        };
    }

    admin_search_action();
    function admin_search_action()
    {
        $(".sf_form").each(function() {
            $(this).submit(function(event) {
                alert("Here you can generate dynamic shortcode only. If you want to check the search action.");
                return false;
            });
        });
    }

    function shortcode_theme_page_change(cur_theme, purl)
    {
        $.ajax({
            url: ajaxurl,
            data: {
                'action': 'theme_update_request',
                'sel_theme': cur_theme,
                'mode': 'shortcode'
            },
            success: function(data) {
                // This outputs the result of the ajax request
                $(".sf_shortcode_theme_box").html(data);
                if (cur_theme == 'dynamic-width') {
                    $('.custom_width').show();
                }
                admin_search_action();
                shortcode_dynamic_width();
                generate_shortcode();
                sf_color_picker();
                pre_defined_colors();
                sf_auto_complete();
            },
            error: function(errorThrown) {
                console.log(errorThrown);
            }
        });
    }
});