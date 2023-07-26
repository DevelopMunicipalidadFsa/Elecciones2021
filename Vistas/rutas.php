<?php 

echo $url= $_SERVER["REQUEST_URI"];

switch ($url) {
    case ($url == '/TramitesOnline/'):
        $raiz = '';
        break;
    case ($url == '/TramitesOnline/Vistas/Areas/areas.php'):
        $raiz = '../../';
        break;
    case ($url == '/TramitesOnline/Vistas/Areas/Automotores/listaObjetos.php?param1=MTExMTI='):
        $raiz = '../../../';
        break;
     case ($url == '/TramitesOnline/Vistas/Areas/Automotores/gestionTramites.php'):
        $raiz = '../../../';
        break;
     case ($url == '/TramitesOnline/Vistas/Areas/Automotores/ConfirmacionTramites.php'):
        $raiz = '../../../';
        break;
     case ($url == '/TramitesOnline/Vistas/Areas/Automotores/DescargarArchivos.php'):
        $raiz = '../../../';
        break;
    case ($url == '/TramitesOnline/Vistas/ListasTramites/listaTramites.php'):
        $raiz = '../../';
        break;
    default:
    $raiz ='../../../';
    break;
}