/*==================================
=            Data Table            =
==================================*/

	$(document).ready(function() {
    $('#ListaObjetos2').DataTable({
		lengthMenu:  [[6, 12 , 50, 100, -1], [1, 12 , 50, 100, 'Todos']],
		order: [[ 1, 'desc' ]],
        pageLength:6,
        processing: 'Procesando...',
        orderCellsTop: true,
        scrollY: true,
        bAutoWidth: false,
    	language: {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Vista _MENU_ Lista Objetos",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de MAX registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

		}
    	});}
    );

/*=====  End of Data Table  ======*/