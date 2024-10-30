(function () {
    tinymce.PluginManager.add('ig_testimonials_mce_button', function( editor, url ) {
        editor.addButton( 'ig_testimonials_mce_button' ,{
            text: 'IG Testimonials',
            icon: false,
            type: 'menubutton',
            menu: [
                // ACCORDION
                {
                    text: 'Testimonials',
                    onclick: function() {
                    editor.insertContent('[ig-testimonials image="true" perpage="12" cat=""]');
                    },
                },
                // BUTTONS
                {
                    text: 'Testimonials carousel',
                    onclick: function() {
                    editor.insertContent('[ig-testimonials-carousel items="1" autoplay="true" image="true" arrows="false" dots="true" cat="" perpage="12"]');
                    },
                },
            ]
        });
    });
})();
