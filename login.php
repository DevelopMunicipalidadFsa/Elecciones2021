<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="Librerias/css/Estilos/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="Librerias/css/jcrop/css/jquery.Jcrop.css" type="text/css" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.4/css/pro.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta name="description" content="Elecciones 2021 - Sistema de Carga de votos">
    <meta name="author" content="Acosta Rodrigo * * Formosa-Argentina 2021">
    <title>Elecciones 2021</title>
    <link rel="icon" type="image/png" href="Librerias/img/vc-logo2.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="Librerias/css/Estilos/styleLogin.css">
    <script src="Librerias/js/Script_Aut/sweetalert.2.10.js" type="text/javascript"></script>
    <script src="Librerias/js/Script_Aut/script.js" type="text/javascript"></script>
        <script type="text/javascript">
      $(document).ready(function() {  
          $('#usuario').on('blur', function(){
              $('#result-username').html('<i class="fad fa-spinner-third text-primary" style="transform: rotate(90deg); font-size:30px;"></i>').fadeOut(1000);

              var usuario = $(this).val();   
              var dataString = 'usuario='+usuario;

              $.ajax({
                  type: "POST",
                  url: "check_username_availablity.php",
                  data: dataString,
                  success: function(data) {
                      $('#result-username').fadeIn(1000).html(data);
                  }
              });
          });              
      });    
</script>
</head>

<body>
    <div class="contenedor">
        <div class="top text-center" style="background-image: url('Librerias/img/fondoazultransp.png') !important;">
            <span class="fw-bold text-center">Sistema de Carga - Elecciones Legislativas 2021</span>
        </div>
        <center class="align-middle">
        <div class="cuerpo mt-5 align-middle">

            <form method="post" action="validarLogin.php">
                <div class="form-floating mb-4" style="background: transparent; border-radius:none;">
                    <input type="number" length="3" class="form-control" name="usuario" id="usuario"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "2" required>
                    <label style="font-weight: bolder !important; color: #555">Usuario</label>
                </div>
                <center>
                    <div id="result-username"></div>
                </center>
                <div class="form-floating campo mt-4">
                    <input class="form-control" type="password" name="password" id="password" autocomplete="off" required>
                    <label style="font-weight: bolder !important; color: #555">Contraseña</label>

                    <i class="fas fa-eye icon" onclick="mo()"></i>
                </div>
                <button class="btn mt-3 w-100 fw-bold" style=" background: #31328c !important;">INGRESAR</button>
            </form>
            
        </div>
        </center>
    </div>
    <div class="pie text-center">
        <img src="Librerias/img/valorescolor vert.png" style="width:50px; height:50px;">
        <img src="Librerias/img/pie.png" style="width:100%">
    </div>
    
    <?php
    if (isset($_GET['SESSION_EXPIRED'])) {
        echo "<script>  
                jQuery(function(){
                    Swal.fire({
                    icon: 'error',
                    title: 'Su sesión expiró',
                    text: 'Ha superado el tiempo de inactividad en el sitio',
                    showConfirmButton: true, 
                    confirmButtonText: 'Ok'
                    }).then((result) => {
                      /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            if(window.history.replaceState){
                                window.history.replaceState(null, null, window.location.href );
                            }
                            window.location = 'login.php';
                        }
                    })
                });
            </script>";
    }
    ?>
</body>
</html>
