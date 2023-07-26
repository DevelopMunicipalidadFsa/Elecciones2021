<?php 

require_once 'Controladores/plantillas.controlador.php';
require_once 'Controladores/AutomotoresControladores.php';
require_once 'Modelos/AutomotoresModelo.php';
require_once "Controladores/ControladorHabilitaciones.php";
require_once "Modelos/ModeloHabilitaciones.php";
$plantillas= new ControladorPlantilla();
$plantillas ->ctrPlantillas();