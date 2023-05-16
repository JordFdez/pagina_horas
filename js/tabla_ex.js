//tabla con botones 

    function fecha() { //obtener nombre fichero
      var date = new Date();
      var year = date.getFullYear();
      var month = ("0" + (date.getMonth() + 1)).slice(-2);
      var day = ("0" + date.getDate()).slice(-2);
      var hours = ("0" + date.getHours()).slice(-2);
      var minutes = ("0" + date.getMinutes()).slice(-2);
      return (
        "BaumControl_" +
        year +
        "-" +
        month +
        "-" +
        day +
        "_" +
        hours +
        "-" +
        minutes
      );
    }

$(document).ready(function () {

    $('#mydatatable tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Filtrar.." />');
    });

    var table = $('#mydatatable').DataTable({
        "dom": 'B<"float-inherit"i><"float-right"f>t<"float-left"l><"float-right"p><"clearfix">',
        // B botones, i de informacion, f de filtro, t de tabla, l largo tabla, p botones de paginas
        "responsive": false,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        
        },
        
        "order": [
            [0, "desc"]
        ],
        "initComplete": function () {
            this.api().columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            })
        },
            
        "buttons": [{extend: 'excel', filename: fecha()}, {extend: 'pdf', filename: fecha() }, 'print']
    });
}
);