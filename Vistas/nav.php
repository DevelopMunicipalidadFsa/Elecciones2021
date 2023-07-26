 <style type="text/css" media="screen">
   .btnVolver {
     vertical-align: middle;
     background: none;
     border: none;
     padding: 0px;
     margin-left: 4px;
     margin-right: -20px
   }

   .TituloNav {
     font-size: 13px;
     font-weight: bold;
   }

   .NavEscritorio {
     display: none;
   }
 </style>
 <?php
  if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $id = $_SESSION['id'];
  } else {
    echo '<script>
             if(window.history.replaceState){
              window.history.replaceState(null, null, window.location.href );
             }
             window.location = "login.php";
          </script>';
  }
  ?>

 <nav class="navbar navbar-expand-lg navbar-light p-0 m-0 NavResponsive esconder text-white" id="desaparecer" style="background-image: url('Librerias/img/fondoazultransp.png') !important;">
   <form class="navbar-brand" action="./">
     <button type="submit" class="btnVolver">
       <img src="Librerias/img/logoblancovert.png" class="logotipo d-inline-block bg-head" alt="" loading="lazy">
     </button>
   </form>
   <!-- <span class="fw-bold" style="font-size: 16px">Bienvenido</span><br> -->
   <h6 class="fw-bold text-center align-middle ml-2 TituloNav">¡HOLA!<br><span class="text-white"><?php echo $usuario; ?></span></h6>

   <button class="navbar-toggler btn-sm mr-2 p-2 text-white" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation" style="font-size: 16px;">
     <i class="fas fa-bars"></i>
   </button>

   <div class="collapse navbar-collapse text-center navbar-dark text-white" id="navbarsExample05">
     <div class="my-2 my-md-0 mt-1 text-white">
       <ul class="navbar-nav navbar-dark mt-1 text-white">
         <li class="nav-item dropdown mt-1 text-white">
           <a class="dropdown-item cerrarSession text-dark btncerrarSession ml-2" href="cerrarSession.php" style="font-weight: bold; background: #fff; color:#31328c !important;">Salir <i class="fas fa-sign-out-alt"></i></a>
         </li>
       </ul>
     </div>
   </div>
 </nav>
