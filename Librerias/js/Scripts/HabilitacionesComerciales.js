//############## MODAL EN CASO DE QUE SE REQUIERA REENVIAR REQUISITOS (MisSolicitudes.php) ####################
$(document).on("click", ".btnModalRechazado", function () {
  //se extraen los parametros
  var id_solicitud = $(this).attr("id_solicitud");
  var id_contribuyente = $(this).attr("id_contribuyente");
  var idSolicitudContribuyente = $(this).attr("idSolicitudContribuyente");
  var partida = $(this).attr("partida");
  var DetalleComercio = $(this).attr("DetalleComercio");
  var dni = $(this).attr("dni");

  $.post(
    "Librerias/Ajax/HabilitacionesComerciales/SolicitudRechazadaMsj.php", //se envian a esta direccion
    {
      id_solicitud: id_solicitud,
      id_contribuyente: id_contribuyente,
      idSolicitudContribuyente: idSolicitudContribuyente,
      partida: partida,
      DetalleComercio: DetalleComercio,
      dni: dni,
    },
    function (data) {
      $("#mensajes").html(data); //se muestra la informacion en la etiqueta con id #mensajes
    }
  );
});

//############## MENSAJES DE SOLICITUDES (MisSolicitudes.php) ####################
$(document).ready(function () {
  $(document).on("click", ".ResAprobado", function () {
    Swal.fire({
      icon: "success",
      title: "Solicitud Aprobada",
      text: "Para finalizar debe acercarse la Dirección de Control Comercial en Fotheringham 1364 y realizar los pagos correspondientes despues de las 72Hs Habiles",
    });
  });
});

$(document).ready(function () {
  $(document).on("click", ".resEnviado", function () {
    Swal.fire({
      icon: "info",
      // title: "Solcitud enviada correctamente",
      text: "Solicitud enviada correctamente",
    });
  });
});

$(document).ready(function () {
  $(document).on("click", ".ResReenviado", function () {
    Swal.fire({
      icon: "info",
      title: "Solcitud Reenviada",
      text: "Su solicitud fue reenviada correctamente",
    });
  });
});

//############## OCULTAR NAV Y BOTONERA ####################
function OcultarElementos() {
  $(".esconder").hide();
  document.querySelector("#contenido").classList.remove("border");
  document.querySelector("#contenido").classList.remove("border-secondary");
  setTimeout(function () {
    $(".esconder").show();
    document.querySelector("#contenido").classList.add("border");
    document.querySelector("#contenido").classList.add("border-secondary");
  }, 100);
}

//############## MOSTRAR EL LOADER AL CARGAR LA PAGINA ####################
$(window).load(function () {
  $(".ConteinerPreloader").fadeOut("slow");
});

//############## SolicitudesHabilitacion.php ####################
$("#id_comercio").select2({
  //estilos para select2
  width: "100%",
});

$("#select_calles").select2({
  //estilos para select2
  width: "100%",
});

function SeleccionComercio() {
  var SeleccionComercio = document.getElementById("id_comercio").value;
  if (SeleccionComercio != "seleccione") {
    //si se selecciona un comercio
    document.getElementById("SeleccionFiltro").style.display = "block"; //se muestra la opciones de filtrado de partida
  }
}

function SeleccionFiltro() {
  var SeleccionFiltro = document.getElementById("id_filtro").value; //extraemos el id de opcion de filtrado

  if (SeleccionFiltro == 1) {
    //se es 1 (si posee numero de partida)
    if (document.getElementById("TienePartida")) {
      document.getElementById("TienePartida").style.display = "block";
      $("#Npartida").prop("required", true);

      $("#Npartida").keyup(function () {
        $("#Npartida").val(this.value.match(/[0-9]*/)); //se valida que no se pueda ingresar carácteres no númericos
      });

      if (document.getElementById("BuscarPartida")) {
        //si existe el llamado al filtro por partida
        document.getElementById("BuscarPartida").style.display = "none";
      }

      if (document.getElementById("MetodoCalleAltura")) {
        //si existe el llamado al filtro por calle y altura
        document.getElementById("MetodoCalleAltura").style.display = "none";
      }

      if (document.getElementById("MetodoManzanaCasa")) {
        //si existe el llamado al filtro por mz y casa
        document.getElementById("MetodoManzanaCasa").style.display = "none";
      }

      if (document.getElementById("ResultadoCalle")) {
        //si existe el llamado al filtro calle y altura (contenedor)
        document.getElementById("ResultadoCalle").style.display = "none";
      }

      if (document.getElementById("resultadoManzanaCasa")) {
        //si existe el llamado al filtro mz y casa (contenedor)
        document.getElementById("resultadoManzanaCasa").style.display = "none";
      }
    }
  } else if (SeleccionFiltro == 2) {
    //se es 2 (filtrar por domicilio)
    if (document.getElementById("BuscarPartida")) {
      //si existe el llamado al filtro por partida
      if (document.getElementById("respuestaValidacion")) {
        document.getElementById("respuestaValidacion").style.display = "none";
        $("#Npartida").prop("required", false); //aplicamos la propiedad required al input
      }
      document.getElementById("BuscarPartida").style.display = "block";
      document.getElementById("TienePartida").style.display = "none";
    }
  }
}

function MetodoSeleccionado() {
  var metodo = document.getElementById("id_metodo").value;

  if (metodo == 1) {
    if (document.getElementById("resultadoManzanaCasa")) {
      document.getElementById("resultadoManzanaCasa").style.display = "none";
    }
    $("#select_calles").prop("required", true);
    $("#altura").prop("required", true);
    $("#manzana").prop("required", false);
    $("#casa").prop("required", false);
    document.getElementById("MetodoCalleAltura").style.display = "block";
    document.getElementById("MetodoManzanaCasa").style.display = "none";
  } else if (metodo == 2) {
    if (document.getElementById("ResultadoCalle")) {
      document.getElementById("ResultadoCalle").style.display = "none";
    }
    document.getElementById("MetodoManzanaCasa").style.display = "block";
    $("#select_calles").prop("required", false);
    $("#altura").prop("required", false);
    $("#manzana").prop("required", true);
    $("#casa").prop("required", true);
    document.getElementById("MetodoCalleAltura").style.display = "none";
  }
}

function ValidarPartida() {
  let nro_partida = document.getElementById("Npartida").value;
  $.post('Librerias/Ajax/HabilitacionesComerciales/FiltroPartida.php', {
      "nro_partida": nro_partida,
  }, function (data) {
      $("#ResPartida").html(data);
  });
}

function ValidarCalleAltura() {
  let calle = document.getElementById("select_calles").value;
  let altura = document.getElementById("altura").value;
  if (calle == "") {
      alert('Debe Seleccionar una calle');
  }
  if (altura == "") {
      alert('Debe ingresar una altura');
  }

  $.post('Librerias/Ajax/HabilitacionesComerciales/FiltroCalleAltura.php', {
      "calle": calle,
      "altura": altura
  }, function (data) {
      $("#ResCalle").html(data);
      document.getElementById('ResultadoCalle').style.display = 'block';
  });

}

function ValidarManzanaCasa() {
  let Mz = document.getElementById("manzana").value;
  let Cs = document.getElementById("casa").value;
  if (Mz == "") {
      alert('Debe ingresar una Manzana');
  } else { }
  if (Cs == "") {
      alert('Debe ingresar un nro de Casa');
  }

  $.post('Librerias/Ajax/HabilitacionesComerciales/FiltroManzanaCasa.php', {
      "manzana": Mz,
      "casa": Cs
  }, function (data) {

      $("#ResMz").html(data);
      document.getElementById('resultadoManzanaCasa').style.display = 'block';
  });
}

//############## SolicitudHabiltiacion1.php ####################
$('#FormularioT1 input').on('change', function() {
  var car_seleccionado = $('input[name=car_ocupacion]:checked', '#FormularioT1').val();
  if (car_seleccionado == 1) {
      document.getElementById('ocultar').style.display = 'none';
      $("#contratoLocacion").prop('required', false);
  } else {
      document.getElementById('ocultar').style.display = 'block';
      $("#contratoLocacion").prop('required', true);
  }
});

function enviar() {
  var nroPartida = document.getElementById("numeroPartida");
  var formulario = document.getElementById("EnviarFormulario");
  if (nroPartida.value != false) {

      let timerInterval
      Swal.fire({
          title: 'Enviando Solicitud!',
          html: 'Esto puede tardar unos minutos, no cierre la aplicación.',
          timerProgressBar: true,
          didOpen: () => {
              Swal.showLoading()
              const b = Swal.getHtmlContainer().querySelector('b')
              timerInterval = setInterval(() => {
                  b.textContent = Swal.getTimerLeft()
              }, 100)
          },
          willClose: () => {
              clearInterval(timerInterval)
          }
      }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
              console.log('I was closed by the timer')
          }
      })

      formulario.submit();
      return true;
  } else {
      alert("No se envía el formulario");
      return false;
  }
}

$('#EnviarFormulario input').on('change', function() {
  var car_seleccionado = $('input[name=car_ocupacion]:checked', '#EnviarFormulario').val();
  if (car_seleccionado == 1) {
      document.getElementById('ocultar').style.display = 'none';
      $("#contratoLocacion").prop('required', false);
  } else {
      document.getElementById('ocultar').style.display = 'block';
      $("#contratoLocacion").prop('required', true);
  }
});