$(document).on('click', '#verMensaje', function () {
    // console.log("hola");
    var desc = $(this).attr('desc');

    // console.log(id_solicitud, id_contribu, complejidad, usuario, "puto");
    $('#ModalMensaje textarea[name=desc]').val(desc);
    $('#ModalMensaje').showModal();

});

$(document).on('click', '#btnInfo', function () {
    $('#ModalMensaje').showModal();

});

function ValidarCamposFiltro() {
    let Mz = document.getElementById("mz").value;
    let Cs = document.getElementById("cs").value;
    if (Mz == "") {
        alert('Debe ingresar una Manzana');
    } else {}
    if (Cs == "") {
        alert('Debe ingresar un nro de Casa');
    }

    // $("#partidaMzC").val('250392');
    $.post('../Ajax/datosParitda.php', {
        "manzana": Mz,
        "casa": Cs
    }, function(data) {
        // console.log('procesamiento finalizado', data);
        // $("#partidaMzC").val(data);
        $("#nroPartida").html(data);
    });
}

function ValidarCamposFiltroCalle() {
    let calle = document.getElementById("calle").value;
    let altura = document.getElementById("altura").value;
    if (calle == "") {
        alert('Debe ingresar una Manzana');
    } 
    if (altura == "") {
        alert('Debe ingresar un nro de Casa');
    }

    // $("#partidaMzC").val('250392');
    $.post('../Ajax/datosPartidaCalle.php', {
        "calle": calle,
        "altura": altura
    }, function(data) {
        // console.log('procesamiento finalizado', data);
        // $("#partidaMzC").val(data);
        $("#nroPartida2").html(data);
    });
}
