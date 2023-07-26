
/*==================================
=    Cargar Formulario Mesa       =
==================================*/
	function pregunta(dataIde){
		var mesa = "Mesa "+dataIde;
		var formulario = "carga"+dataIde;
		Swal.fire({
			  title: '¿Esta seguro que desea abrir el Formulario de la '+mesa+'?',
			  text: '¡No podrás volver hasta completar la carga!',
			  icon: 'question',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Si'
			}).then((result) => {
			   if (result.isConfirmed) {
				    let form = document.getElementById(formulario);
		        	form.submit();
				}
			})
	}
/*=====  End Cargar Formulario Mesa  ======*/
/*==================================
=    Cargar Formulario Mesa       =
==================================*/
	function preguntaV(dataIde){
		var mesa = "Mesa "+dataIde;
		var formulario = "carga"+dataIde;
		Swal.fire({
			  title: '¿Esta seguro que desea abrir el Formulario de la '+mesa+'?',
			  text: '¡No podrás volver hasta completar la Verificación!',
			  icon: 'question',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Si'
			}).then((result) => {
			   if (result.isConfirmed) {
				    let form = document.getElementById(formulario);
		        	form.submit();
				}
			})
	}
/*=====  End Cargar Formulario Mesa  ======*/
/*==================================
=    Cargar Verificado       =
==================================*/
	function verificada(){
		Swal.fire({
		  icon: 'success',
		  title: '¡Atención!',
		  text: 'La mesa esta Cargada y Verificada'
		})
	}
/*=====  End Cargar Formulario Mesa  ======*/
/*==================================
=    Verificar Formulario Mesa       =
==================================*/
	function verificar(){
		
		Swal.fire({
			  title: '¡Atención!',
			  text: 'Falta Verificar',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Si'
			}).then((result) => {
			   if (result.isConfirmed) {
				    window.location.href='listaFormularios';
				}
			})
	}
/*=====  End Verificar Formulario Mesa  ======*/
/**
	CON ESTE SCRIPT SE RECUPERA EL VALOR DEL id DE LA IMAGEN DEL BOTON 
	"Eliminar " EN gestionTramites.php
 */

/*==========================================================
=            Cargar datos en input ListaObjetos            =
==========================================================*/

$(document).on("click", ".datos", function(){

	var Identidad = $(this).attr("Identidad");
	var CodObjeto = $(this).attr("CodObjeto");

	$("#Identidad").val(Identidad);
	$("#CodObjeto").val(CodObjeto);
	$("#seleccionar").attr('disabled',false);
});


/*=====  End of Cargar datos en input ListaObjetos  ======*/

/**

	CON ESTE SCRIPT SE RECUPERA EL VALOR DEL TITULO Y EL IDREQUERIMIENTO DEL BOTON 
	"Digitalizar Documento" EN gestionTramites.php

 */

$(document).on("click", ".Alta", function(){

	var idRequisitosTramites = $(this).attr("idRequisitosTramites");
	var titulo = $(this).attr("titulo");

	$("#idRequisitosTramites2").val(idRequisitosTramites);
	$("#titulo").val(titulo);
});
/**

	CON ESTE SCRIPT SE RECUPERA EL NOMBRE DEL ARCHIVO SELECCIONADO DE LA BIBLIOTECA DEL ORDENADOR
	Y SE LO ASIGNA AL INPUT EN LA VENTANA MODAL DE "Digitalizar Documento" EN gestionTramites.php

*/
$(document).on('change','.btn-file :file',function(){
	var input = $(this);
	var numFiles = input.get(0).files ? input.get(0).files.length : 1;
	var label = input.val().replace(/\\/g,'/').replace(/.*\//,'');
	input.trigger('fileselect',[numFiles,label]);
});
$(document).ready(function(){
	$('.btn-file :file').on('fileselect',function(event,numFiles,label){
		var input = $(this).parents('.input-group').find(':text');
		var log = numFiles > 1 ? numFiles + ' files selected' : label;
		if(input.length){ input.val(log); }else{ if (log) alert(log); }
	});
});


/**

	CON ESTE SCRIPT SE RECUPERA EL VALOR DEL tramite seleccionado para volver a RECARGARLO UNA
	VEZ QUE SE ACTUALICE LA PAGINA EN gestionTramites.php

 */

$(document).on("click", "#Submit", function(){
	var textoN = $(this).attr("texto");
	var iconoN = $(this).attr("icono");

	$("#icono").attr("class","spinner-grow spinner-grow-sm");
	jQuery('#texto').text("Guardando");
	
});

/*=============================================
=            Deshabilitar Boton JS            =
=============================================*/

$(document).ready(function () {
      $("#ConfirmarTramite").click(function () {
	        $('#FormularioConfirmacion').submit();
	        $("#ConfirmarTramite").attr("disabled", true);
		});
});

/*=====  End of Deshabilitar Boton JS  ======*/

/*=========================================================
=            boton yes/no selecccion de objeto            =
=========================================================*/

$('#radioBtn a').on('click', function(){
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
    $('#'+tog).prop('value', sel);
    
    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
})

/*=====  End of boton yes/no selecccion de objeto  ======*/

/*===========================================
=            Vista Previa Imagen            =
===========================================*/

 function previewImage(nb) {        
        var reader = new FileReader();         
        reader.readAsDataURL(document.getElementById('uploadImage'+nb).files[0]);         
        reader.onload = function (e) {             
            document.getElementById('uploadPreview'+nb).src = e.target.result;         
        };     
    }

/*=====  End of Vista Previa Imagen  ======*/
/*==============================================================
=           Script para esconder botones al imprimir Libre de deuda o baja            =
==============================================================*/

	$('.custom-file-input').on('change', function() { 
	   let fileName = $(this).val().split('\\').pop(); 
	   $(this).next('.custom-file-label').addClass("selected").html(fileName); 
	});

/*=====  End of Nombre de archivo en input alta imagen  ======*/

/*==============================================================
=          				  Recortar imagen    			       =
==============================================================*/
//   //Utilizamos jCrop en los elementos con el id cropbox
//   $(function(){
   
//     $('#cropbox').Jcrop({
//       aspectRatio: 0,
//       onSelect: updateCoords
//     });
    
//   });
  
//   function updateCoords(c)
//   {
//     $('#x').val(c.x);
//     $('#y').val(c.y);
//     $('#w').val(c.w);
//     $('#h').val(c.h);
//   };
  
//   function checkCoords()
//   {
//     if (parseInt($('#w').val())) return true;
//     alert('Selecciona una región en la imágen');
//     return false;
//   };
  
// $(document).ready(function(){
// //Mostrar alto y ancho en px del area seleccionada
// 	$("#target").mousemove(function(event){
// 		var ancho=$("#w").val();
// 		console.log(ancho);
// 		var alto=$("#h").val();
// 		console.log(alto);
// 		$("#ancho_seleccionado").html(ancho);
// 		$("#alto_seleccionado").html(alto);
// 	});
// });
/*=====  End of Recortar imagen  ======*/
/*==============================================================
=           Script para esconder botones al imprimir Libre de deuda o baja            =
==============================================================*/
		 function sacarBoton(){
			
	$(".esconder").hide();
	document.querySelector("#contenido").classList.remove("border");
	document.querySelector("#contenido").classList.remove("border-secondary");
  $('#Aut_Botonera').css('display','none');
	setTimeout(function() {	
		$('.esconder').show();
		document.querySelector("#contenido").classList.add("border");
		document.querySelector("#contenido").classList.add("border-secondary");
	}, 100);
		
		}
/*=====  End of Script para esconder botones al imprimir Libre de deuda o baja  ======*/

/*==============================================================
=          				  limpiar variable  			       =
==============================================================*/
$(document).on("click", ".cerrarSession", function(){
	if(window.history.replaceState){
		window.history.replaceState(null, null, window.location.href );
	}
	window.location = "noLogueado.php";

});
/*=====  End of limpiar variable ======*/
/**
	CON ESTE SCRIPT SE RECUPERA EL VALOR DEL TITULO Y LA rutaHtml DEL BOTON 
	"verImagen" EN gestionTramites.php
 */
$(document).on("click", ".verImagen", function(){
	var rutajs = $(this).attr("rutaHtml");
	var tituloModal = $(this).attr("titulo");
	var imagen = $(this).attr("imagen");

Swal.fire({
  title: tituloModal,
  imageUrl: rutajs,
  imageAlt: 'Cargando...',
})

});
/*==============================================================
=          pasa los datos al modal respuesta	       =
==============================================================*/
$(document).ready(function(){
	$(document).on('click', '.rta', function(){
	
		var mensajeJS = $(this).attr("mensaje");
		var tituloAutomotorJS = $(this).attr("tituloAutomotor");
		var dniFrenteJS = $(this).attr("dniFrente");
		var dniDorsoJS = $(this).attr("dniDorso");
		var formulario04RegAutJS = $(this).attr("formulario04RegAut");
		var fechaDevJS = $(this).attr("fechaDev");
		var HoraDevJS = $(this).attr("HoraDev");
		var idTramitesJS = $(this).attr("idT");
		var idTipoBajaJS = $(this).attr("idTB");
		var IdentidadJS = $(this).attr("Id");
		var fechaJS = $(this).attr("F");
		var ObjetoJS = $(this).attr("O");
		var idSolicitud = $(this).attr("idSol");
		
if (tituloAutomotorJS == 1) {
      var checkbox = document.getElementById("inlineCheckbox1");
      $("#inlineCheckbox1").attr("checked", true);
      $("#inlineCheckbox1").attr("disabled", true);
      $(".input").append(
        '<input type="hidden" name="FotocopiaTítuloAutomotor" value="1"/>'
      );
      $(".input").append(
        '<input type="hidden" name="titulo1" value="Fotocopia del Título del Automotor."/>'
      );
      $("#file1").attr("required", true);
    } else {
      $(".inlineCheckbox1").hide(); // Aqui le quitas el checked.
    }

    if (dniFrenteJS == 1) {
      var checkbox = document.getElementById("inlineCheckbox2"); // Aqui seleccionas tu checkbox.
      $("#inlineCheckbox2").attr("checked", true); // Aqui le agregas el checked.
      $("#inlineCheckbox2").attr("disabled", true);
      $(".input").append(
        '<input type="hidden" name="FotocopiaDNIFrente" value="2"/>'
      );
      $(".input").append(
        '<input type="hidden" name="titulo2" value="Fotocopia del DNI Frente."/>'
      );
      $("#file2").attr("required", true);
    } else {
      $(".inlineCheckbox2").hide(); // Aqui le quitas el checked.
    }

    if (dniDorsoJS == 1) {
      var checkbox = document.getElementById("inlineCheckbox3"); // Aqui seleccionas tu checkbox.
      $("#inlineCheckbox3").attr("checked", true); // Aqui le agregas el checked.
      $("#inlineCheckbox3").attr("disabled", true);
      $(".input").append(
        '<input type="hidden" name="FotocopiaDNIDorso" value="7"/>'
      );
      $(".input").append(
        '<input type="hidden" name="titulo3" value="Fotocopia del DNI Dorso."/>'
      );
      $("#file3").attr("required", true);
    } else {
      $(".inlineCheckbox3").hide(); // Aqui le quitas el checked.
    }

    if (formulario04RegAutJS == 1) {
      var checkbox = document.getElementById("inlineCheckbox4"); // Aqui seleccionas tu checkbox.
      $("#inlineCheckbox4").attr("checked", true); // Aqui le agregas el checked.
      $("#inlineCheckbox4").attr("disabled", true);
      $(".input").append(
        '<input type="hidden" name="Formulario04RegAut" value="36"/>'
      );
      $(".input").append(
        '<input type="hidden" name="titulo4" value="Formulario 04 emitido por el Registro del Automotor."/>'
      );
      $("#file4").attr("required", true);
    } else {
      $(".inlineCheckbox4").hide(); // Aqui le quitas el checked.
    }
    $(".input").append(
      '<input type="hidden" name="idSolicitud" value="' + idSolicitud + '"/>'
    );

    $("input[name=idTramites]").prop({ value: idTramitesJS });
    $("input[name=idRequisitosTramites2]").prop({ value: idTramitesJS });
    $("input[name=idTipoBaja]").prop({ value: idTipoBajaJS });
    $("input[name=Identidad]").prop({ value: IdentidadJS });
    $("input[name=fecha]").prop({ value: fechaJS });
    $("input[name=CodObjeto]").prop({ value: ObjetoJS });
    jQuery(".mensaje").text(mensajeJS);
    jQuery(".mensaje").text(mensajeJS);
    jQuery(".fecha").text("Revisión el " + fechaDevJS + " a las " + HoraDevJS);
  });
});
  $(".closed").click(function(){
 
   	window.location.reload();
 
  });
/*MUESTRA ESTE MSJ CUANDO NO HAY DEVOLUCION EN LISTA DE TRAMITES*/

$(document).ready(function(){
	$(document).on('click', '.ok', function(){
		Swal.fire({
		  icon: 'warning',
		  title: '',
		  text: '¡En la brevedad estaremos atendiendo su Solicitud!'
		})
	});
});
/*MUESTRA ESTE MSJ CUANDO NO COMPLETO LOS REQUISITOS EN LISTA DE TRAMITES DE GESTIONTRAMITES*/

$(document).ready(function(){
	$(document).on('click', '.noCont', function(){
		Swal.fire({
		  icon: 'warning',
		  title: '¡Atención!',
		  text: 'Para continuar debe tener todo los requisitos digitalizados.'
		})
	});
});
/*MUESTRA ESTE MSJ CUANDO NO COMPLETO LOS REQUISITOS EN LISTA DE TRAMITES DE GESTIONTRAMITES*/

// $(document).ready(function(){
// 	$(document).on('click', '#seleccionar', function(){
// 		Swal.fire({
// 		  icon: 'warning',
// 		  title: '¡Atención!',
// 		  text: 'Para continuar debe seleccionar un dominio.'
// 		})
// 	});
// });
/*MUESTRA ESTE MSJ EL TRAMITE A FINALIZADO CORRECTAMENTE EN LISTA DE TRAMITES*/


$(document).ready(function() {
    $(document).on('click', '.resp', function() {
        Swal.fire({
            icon: 'success',
            title: '!Solicitud Aprobada¡',
            text: 'Para continuar debe acercarse al cualquier Sede de la Municipalidad luego de las 72 horas hábiles, con el número de Solicitud y la documentación original para finalizar su trámite'
        })
    });
});
/* script de login mostar oculltar contraseña y cambio de icono*/
function mo(){
        var cambio = document.getElementById("password");
        if(cambio.type == "password"){
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }else{
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }
    }
/*MANEJO DE ICONOS DE ARCHIVO EN EL MODAL RESPUESTAS*/

$("#file1").change(function () {
  //   $("#id1").html('<i class="fa fa-check" id="ico"></i>').addClass("verde");
  //   $("#id1").html('<span class="form-check-label">Fotocopia del DNI Dorso.</span>').addClass("verde");
  // $("#Lfile1").add("verde");
  document.getElementById("Lfile1").classList.add("verde");
  //    document.getElementById("Upload-1").classList.add('Upload1');
  var element = document.getElementById("icono1");
  element.classList.remove("fa-file-upload");
  element.classList.add("fa-check");
});

/###########################################/
$("#file2").change(function () {
  //  $("#Lfile2").html('<i class="fa fa-check" id="ico"></i>').addClass("verde");
  document.getElementById("Lfile2").classList.add("verde");
  var element = document.getElementById("icono2");
  element.classList.remove("fa-file-upload");
  element.classList.add("fa-check");
});

/###########################################/
$("#file3").change(function () {
  //  $("#Lfile3").html('<i class="fa fa-check" id="ico"></i>').addClass("verde");
  document.getElementById("Lfile3").classList.add("verde");
  var element = document.getElementById("icono3");
  element.classList.remove("fa-file-upload");
  element.classList.add("fa-check");
});

/###########################################/
$("#file4").change(function () {
  //  $("#Lfile4").html('<i class="fa fa-check" id="ico"></i>').addClass("verde");
  document.getElementById("Lfile4").classList.add("verde");
  var element = document.getElementById("icono4");
  element.classList.remove("fa-file-upload");
  element.classList.add("fa-check");
});