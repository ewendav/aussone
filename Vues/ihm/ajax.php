<?php
	include ('../../Outil/accesBD.php');
	$maConnexion = new accesBD();
	$listeDesmatieres ="";
	if ($maConnexion)
	{
        $uneRef = $_POST['ref'] + 1; 
		$listeDesMatieres = $maConnexion->afficheListeDesThemes($uneRef);
        echo $listeDesMatieres;
    }

?>