<?php 
include 'Modelos/conexiones.php';
sleep(1);

if (isset($_POST)) {
    $username = $_POST['usuario'];
 	if ($username == true) {
    			$consulta="";
				$ContibuDatos = Conexiones::conEL()->prepare("SELECT [Responsables]
															  FROM [Elecciones2021].[dbo].[Responsables2021]
															  where [id]= $username");
				
				if ($ContibuDatos-> execute()) {
					$RTA= $ContibuDatos-> fetch();

					if(empty($RTA)) {
						echo '<strong class="text-danger text-center">Usuario no existe</strong>';
					}else{
						echo '<strong class="text-success text-center">'.$RTA[0].'</strong>';
					}
				}
				
	}
 
 }


