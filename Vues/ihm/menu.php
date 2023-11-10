
	<div class="dropdown col">
		<button class="btn bg-transparent dropdown-toogle bordure" type="button" id="menuEntraineur" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Menu Entraîneur 
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu bordureMenu" aria-labelledby="menuEntraineur">
			<li><a class="dropdown-item" href='index.php?vue=Entraineur&action=visualiser'>Visualiser les entraineurs</a></li>
		</ul>
	</div>
	<div class="dropdown col">
		<button class="btn bg-transparent dropdown-toogle bordure" type="button" id="menuEquipe" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			Menu Equipe 
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu bordureMenu" aria-labelledby="menuEquipe">
			<li><a class="dropdown-item" href = 'index.php?vue=Equipe&action=visualiser'>Visualiser les équipes</a></li>
		</ul>
	</div>
	<div class="dropdown col">
		<button class="btn bg-transparent dropdown-toogle bordure" type="button" id="menuAdherent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			Menu Adherent 
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu bordureMenu" aria-labelledby="menuAdherent">
			<li><a class="dropdown-item " href = 'index.php?vue=Adherent&action=visualiser'>Visualiser les Adherents</a></li>
		</ul>
	</div>
</div><br>
<section class=premiereSection>

	<?php
		$_GET['action'] = 'liste';
		$_GET['vue'] = 'Connexion';
		$monControleur->affichePage($_GET['action'],$_GET['vue'],$role);
	?>

		<UL id=zoneResultat class="d-flex  align-items-center justify-content-center">
			<!-- Ici on pourrait mettre un appel a $listeDesMatieres[0] avec un echo pour afficher la valeur de base -->
		</UL>

	</div>



