( function() {
    tinymce.PluginManager.add( 'sfts_plugin_arr', function( editor, url ) {

        // Add a button that opens a window
        editor.addButton( 'sfts_button_key', {

            text: 'Shopnfly Travel Shopping',
            icon: true,
            onclick: function() {
                // Open window
                editor.windowManager.open( {
                    title: 'Shopnfly Online Pre Travel Shopping',
                    body: [
								{
									type: 'listbox',
									name: 'themes',
									label: 'Themes',
									'values': [{text: 'Wide', value: 'wide'},
									{text: 'Narrow', value: 'narrow'},
									{text: 'Rectangle', value: 'rectangle'},
									{text: 'Dynamic Width', value: 'dynamic-width'}],
								},
								{
									type: 'textbox',
									name: 'border_color',
									label: 'Border Color',
									value: '#5a5a5a'
								},
								{
									type: 'textbox',
									name: 'background_color',
									label: 'Background Color',
									value: '#b92525'
								},
								{
									type: 'textbox',
									name: 'text_color',
									label: 'Text Color',
									value: '#ffffff'
								},
								{
									type: 'textbox',
									name: 'button_color',
									label: 'Button Color',
									value: '#ffffff'
								},
								{
									type: 'textbox',
									name: 'button_text_color',
									label: 'Button Text Color',
									value: '#b92525'
								}
								
                          ],
                    onsubmit: function( e ) {
                        // Insert content when the window form is submitted
                        editor.insertContent( '[sf_travel_shop t = "' + e.data.themes + '" bc = "' + e.data.border_color + '" bac = "' + e.data.background_color + '" tc = "' + e.data.text_color + '" buc = "' + e.data.button_color + '" butc = "' + e.data.button_text_color + '"]' );
                    }
					
                } );
            }

        } );

    } );

} )();