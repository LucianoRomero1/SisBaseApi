$(document).ready( function () {
    //Esta propiedad me sirve para acomodar por fecha correctamente
    //Sumado a los dos scripts nuevos que agregue
    $.fn.dataTable.moment('DD/MM/YYYY');
    $('#table').DataTable({
        order: [[0, 'desc']],
    });
} );