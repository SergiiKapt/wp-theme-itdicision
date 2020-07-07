(function ($) {
    $(document).ready(function () {
    var work = $('#work__select2');
    work.select2({
        ajax: {
            url: ajaxurl,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    action: 'getwork'
                };
            },
            processResults: function( data ) {
                var options = [];
                if ( data ) {
                    $.each( data, function( index, text ) {
                        options.push( {
                            id: text[0],
                            // text: text[1]
                        } );
                    });
                }

                return {
                    results: options
                };
            },
            cache: true
        },
        minimumInputLength: 3
    });
    work.on("select2:select", function (evt) {
        let element = evt.params.data.element;
        let $element = $(element);

        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });

    work.on('select2:unselect', function (e) {
        let item = e.params.data.id;
        work.children('option[value='+ item +']').remove();
    });
    });
})(jQuery);