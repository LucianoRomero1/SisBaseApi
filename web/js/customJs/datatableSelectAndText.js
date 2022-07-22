$(document).ready( function () {
    $.fn.dataTable.moment('DD/MM/YYYY');
    $('#table').DataTable({
        order: [[1, 'asc']],
        initComplete: function() {
            //Especificar que columnas son un select en un array dentro de columns() => columns([1,2])
            this.api().columns().every(function() {
              var column = this;
              var select = $('<select class="form-control"><option value=""></option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function() {
                  var val = $.fn.dataTable.util.escapeRegex(
                    $(this).val()
                  );
      
                  column
                    .search(val ? '^' + val + '$' : '', true, false)
                    .draw();
                });
      
              column.data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>');
              });
            });
            
            //Especificar que columnas son un select en un array dentro de columns() => columns([1,2])
            this.api().columns().every(function() {
              var that = this;
              var input = $('<input class="form-control" type="text" placeholder="Search" />')
                .appendTo($(this.footer()).empty())
      
                .on('keyup change', function() {
                  if (that.search() !== this.value) {
                    that
                      .search(this.value)
                      .draw();
                  }
                });
            });
          }
    });
} );