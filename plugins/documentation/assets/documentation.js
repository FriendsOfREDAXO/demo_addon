// Dokument per Ajax laden
function load_doc(elem) {
    $('div.addon_documentation-navi a').removeClass('current');
    $(elem).addClass('current');
    $('html, body').animate({ scrollTop: 0 }, 0);

    $url = $(elem).attr('href') + '&ajax=true';
    $target = $('div.addon_documentation-content').find('div.panel-body');

    $($target).html('<div style="text-align:center;"><i class="fa fa-cog fa-spin fa-2x fa-fw"></i></div>');

    $.ajax({
        type: 'GET',
        url: $url,
        cache: true,
        dataType: 'html',
        success: function(response)
        {
            $($target).html(response);
            // Externe Links in neuem Fenster
            $('div.addon_documentation-content').find('a[href^="http"]').each(function(){
                if ($(this).html() != '') {
                    $html = $(this).html() + ' <sup><i class="fa fa-external-link"></i></sup>';
                    $(this).html($html).attr('target','_blank');
                }
            });
            // Bei internen Links Dokument laden
            $('div.addon_documentation-content a.doclink').on('click', function(event, container){
                load_doc($(this));
                event.preventDefault();
                return false;
            });
            // Link in der Navigaton hervorheben
            $('div.addon_documentation-navi').find('a[href^="'+$(elem).attr('href')+'"]').each(function(){
                if ($(this).html() != '') {
                    $(this).addClass('current');
                }
            });
            if (history.pushState) {
                history.pushState({}, null, $(elem).attr('href'));
            }
        }
    }).fail(function(jqXHR, textStatus) {
        $($target).html('<div class="alert alert-danger">AJAX-Error:<br>' + textStatus + '</div>');
    });
};

$(document).on('rex:ready', function (event, container) {

    // Externe Links in neuem Fenster
    $('div.addon_documentation-content').find('a[href^="http"]').each(function(){
        if ($(this).html() != '') {
            $html = $(this).html() + ' <sup><i class="fa fa-external-link"></i></sup>';
            $(this).html($html).attr('target','_blank');
        }
    });

    // Links in der Navigation, interne Links in Dokumenten
    $('div.addon_documentation-navi a, div.addon_documentation-content a.doclink').on('click', function(event, container){
        load_doc($(this));

        event.preventDefault();
        return false;
    });

    // Language select
    $('#doclang').change(function() {
        this.form.submit();
    });

}); // end rex:ready
