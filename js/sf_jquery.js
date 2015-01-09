;
jQuery(function($) {
    // Autocomplete
    $('body').append('<div class="sf_auto_container" />');
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
                    js: 1,
                    src: 'wp_plugin'
                },
                success: function(data) {
                    //debugger;
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
            $(".sf_airports:input[name=sf_from]").prop({"id": ui.item.id, "title": ui.item.label});
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
                    js: 1,
                    src: 'wp_plugin'
                },
                success: function(data) {
                    //debugger;
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
            $(".sf_airports:input[name=sf_to]").prop({"id": ui.item.id, "title": ui.item.label});
        }
    });
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

    $(".sf_form").each(function() {
        $(this).submit(function(event) {
            var q = $(this).find('input[name="sf_buy"]').val();
            var from = $(this).find(".sf_airports:input[name=sf_from]").attr("id");
            var to = $(this).find('.sf_airports:input[name=sf_to]').attr("id");
            var aff_id = $(this).find('input[name="affiliate_id"]').val();

            if (q == "")
            {
                alert("Please enter What would you like to buy?");
                $(this).find('input[name="sf_buy"]').focus();
                return false;
            }
            else if (from == "")
            {
                alert("Please enter From Airport");
                $(this).find(".sf_airports:input[name=sf_from]").focus();
                return false;
            }
            else if (to == "")
            {
                alert("Please enter To Airport");
                $(this).find('.sf_airports:input[name=sf_to]').focus();
                return false;
            }
            else if (from == to)
            {
                alert("From and To Airport cannot be same");
                $(this).find('.sf_airports:input[name=sf_to]').focus();
                return false;
            }
            else
            {
                var pos_from = from.indexOf("(") + 1;
                var from_code = from.slice(pos_from, from.lastIndexOf(")"));

                var pos_to = to.indexOf("(") + 1;
                var to_code = to.slice(pos_to, to.lastIndexOf(")"));

                //utm data for GA
                //https://www.shopnfly.com/?utm_source=<site_domain>&utm_medium=wp_plugin&utm_term=what%2Cfrom%2Cto&utm_campaign=wp-<widget_type>
                var utm_string = '&utm_source='+document.domain;
                utm_string += '&utm_medium=wp_plugin';
                utm_string += '&utm_term=from:'+from+',to:'+to+',what:'+q;
                utm_string += '&utm_campaign=wp-'+theme;
                window.open('https://www.shopnfly.com/search?q=' + q + '&fromAirport=' + from + '&toAirport=' + to + '&partner_id=' + aff_id + '&partner_b=wp' + utm_string, '_blank');
                   
                return true;
            }
        });
    });

});