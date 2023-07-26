/*===============================================
=            datatable ListaTramites            =
===============================================*/

 $(document).ready(function() {
    $('#ListaTramites').DataTable({
	   lengthMenu:  [[1, 50, 100, -1], [1, 50, 100, 'Todos']],
	   pageLength:6,
       processing: 'Procesando...',
       scrollY: true,
       bAutoWidth: false,
       language: {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Vista _MENU_ Lista Tramites",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Debe seleccionar un Tipo de Baja para visualizar requeriminetos",
		"sInfo":           "",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de MAX registros)",
		"sInfoPostFix":    "",
		"sSearch":       { "visible": false},
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente Requisitos",
		"sPrevious": "Anterior Requisitos"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

		}
    	});}
    );
/*=====  End of datatable ListaTramites  ======*/