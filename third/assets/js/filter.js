$(function ($) {
    $(function () {

        /*  GOGO: Live search table
        --------------------------------------------------*/
        var activeSystemClass = $('.list-group-item.active');

        //something is entered in search form
        $('#filter-search').keyup( function() {
           var that = this;
            // affect all table rows on in systems table
            var tableBody = $('.table-list-search tbody');
            var tableRowsClass = $('.table-list-search tbody tr');
            $('.search-sf').remove();
            tableRowsClass.each( function(i, val) {
            
                //Lower text for case insensitive
                var rowText = $(val).text().toLowerCase();
                var inputText = $(that).val().toLowerCase();
                if(inputText != '')
                {
                    $('.search-query-sf').remove();
                    /*tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Aranıyor: "'
                        + $(that).val()
                        + '"</strong></td></tr>');*/
                }
                else
                {
                    $('.search-query-sf').remove();
                }

                if( rowText.indexOf( inputText ) == -1 )
                {
                    //hide rows
                    tableRowsClass.eq(i).hide();
                    
                }
                else
                {
                    $('.search-sf').remove();
                    tableRowsClass.eq(i).show();
                }
            });
            //all tr elements are hidden
            if(tableRowsClass.children(':visible').length == 0)
            {
                tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">Hiç kayıt bulunamadı.</td></tr>');
            }
        });

    });

    function close_live_search()
    {
        $('#livesearch').hide();
    }
    $('.close_ls').on('click', close_live_search);

    function print_live_search()
    {
        $('#livesearch').hide();
        return window.print();
    }
    $('.print_ls').on('click', print_live_search);
})(jQuery);