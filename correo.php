<?php
require_once 'Controladores/AutomotoresControladores.php';
require_once 'Modelos/AutomotoresModelo.php';
$destinatario = "$mail";
$asunto = "Municipalidad de la Ciudad de Formosa"; 
$cuerpo = '
<html> 
<head> 
   <title>Trámites Online</title>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head> 
<body style="font-family: "Montserrat", sans-serif;">  
<div style="text-align:center !important; display: flex !important; flex-direction: row !important; padding: 5px !important">
                    <img style="height: 50px !important; width: 50px !important; margin-right: -50px !important;" src="https://i.ibb.co/s5yKRLq/Fsa-Tu-Ciudad.png">
                    
                    <h3 style="color: #0b578a !important; margin: 0px !important; width: 100%; text-align: center !important; font-size: 13px !important; margin-top: 10px !important; font-family: Montserrat, sans-serif;">
                    MUNICIPALIDAD DE LA CIUDAD DE FORMOSA <br>
                    SECRETARÍA DE HACIENDA <br>
                    AGENCIA DE RECAUDACIÓN</h3>
                    
                    <img style="height: 50px !important; width: 40px !important;" src="https://upload.wikimedia.org/wikipedia/commons/3/36/COAFormosaMunicipalidad.jpg">
          </div>
<hr>
<div class="container">
    
      
     
      <p>  <center><h3>Hola '.$Contribuyente.'!</h3></center>
      La <b>'.$DetalleCaso.'</b> se realizó correctamente en la brevedad estaremos atendiendo su pedido y verificando la documentacion adjunta.<br>
       A continuación le detallaremos la solicitud:

            <div>
               <center style="background: #0b578a; color: white"><b>DATOS DE SOLICITUD</b></center>
               <ul class="list-unstyled text-uppercase" id="floatingSelectGrid" aria-label="Floating label select example">
                  <li>N° DE SOLICITUD: <b class="text-left color"> '.$IdMovimiento.'</b></li>
                  <li>FECHA INICIO: <b class="text-left color">'.$fecha=AutomotoresControlador::ctrFecha().'</b></li>
                  <li>OBJETO: <b class="text-left color">'.$_POST['Dominio'].'</b></li>
                  <li>ESTADO: <b class="text-left color">SOLICITADO</b></li>
                </ul>
            </div>
            <div>
               <center style="background: #0b578a; color: white"><b>IMPORTE DETALLADO DEL TRÁMITE</b></center>
               <ul class="list-unstyled" id="floatingSelectGrid" aria-label="Floating label select example">
                  <label>ESTAMPILLADO LIBRE DEUDA (AUTOMOTOR TF) <b style="whidth:100%; float:right;"> $'.$importe1.'</b></label><br>
                  <label>ESTAMPILLADO LIBRE DEUDA (AUTOMOTORES)<b style="whidth:100%; float:right;"> $'.$importe2.'</b></label><br>
                  <label>ESTAMPILLADO LIBRE FALTAS (AUTOMOTORES) <b style="whidth:100%; float:right;">  $'.$importe3.'</b></label><br>
                  <label>TOTAL <b style="whidth:100%; float:right; background: #0b578a; color: white;"> $'.$importetotal.'</b></label>
                </ul>
             </div>
             <div>
               <center style="background: #0b578a; color: white"><b>DATOS DEL AUTOMOTOR</b></center>
               <ul class="list-unstyled text-uppercase" id="floatingSelectGrid" aria-label="Floating label select example">
                  <li>Dominio: <b class="text-left color">'.$Dominio.'</b></li>
                  <li>Detalle: <b class="text-left color">'.$Marca.' '.$_POST['Tipo'].'</b></li>
                  <li>Modelo: <b class="text-left color">'.$Modelo.'</b></li>
                  <li>Año: <b class="text-left color">'.$ModeloY2K.'</b></li>
                </ul>
             </div><hr>
            <div>
             
             <ul class="text-justify m-2 mb-5">
               <label class="text-uppercase color">Recuerde que para retirar su certificado debe:</label>
               <li>Esperar la notificación del estado del tramite <b>"FINALIZADO"</b> en la pestaña <b>"LISTA TRÁMITE"</b>, de la página principal de la Aplicación luego de las 72hs. hábiles.</li>
               <li>Presentarse con <b class="text-uppercase">Documentación Original</b>.</li>
               <li>Contar con el comprobante de la <b class="text-uppercase">Solicitud Impresa</b>.</li>
               <li>El monto total del trámite.</li>
             </ul><br>
            <center><h2>¡NO RESPONDER ESTE CORREO!</h2></center>
      </p>
   </div>
   
</body> 
</html> 
'; 

//para el envío en formato HTML  
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html ' . "\r\n";

mail($destinatario,$asunto,$cuerpo,$headers) 
?>