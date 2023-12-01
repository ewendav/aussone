<?php
	require '../accesBD.php';
	$maConnexion = new accesBD();

	$function = $_GET["function_slug"];
	
	switch ($function) {
		case 'listeEquipe':
			
			$id = $_GET["id_slug"];
			$type = $_GET["nomSelect_slug"];

			echo $maConnexion->selectAjaxEquipe($type, $id);
			break;
		
		default:
			break;
	}


