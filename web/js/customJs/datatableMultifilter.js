$(document).ready(function() {
    $.fn.dataTable.moment('DD/MM/YYYY');
    $('#table').DataTable( {
        "order": [[0, 'desc']],
        initComplete: function () {
            this.api().columns([0,1,2,3]).every( function () {
                var column = this;
                var select = $('<select  class="form-control"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
});