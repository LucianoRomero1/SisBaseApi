$(document).ready(function(){
    $("#table").DataTable({
        ajax:{
            url: "../../json/data.json",
            dataSrc: 'data',
        },
        columns: [
            {'data': 'Name'},
            {'data': 'Position'},
            {'data': 'Office'},
            {'data': 'Age'},
            {'data': 'Start date'},
            {'data': 'Salary'},
        ]
    })

});