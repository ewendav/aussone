<?php
	
	class vueCentraleConnexion
	{
		public function __construct()
		{
			
		}
		
		public function AfficherMenuContextuel($role,$existe)
		{
			if($existe==1)
			{	switch($role)
				{
					case "2" : 
						$this->afficheMenuAdherent();
						break;
					case "3" :
						$this->afficheMenuEntraineur();
						break;
					case "1" : 
						$this->afficheMenuAdmin();
						break;
				}
			}
			else
			{
				echo "Erreur de connexion";
				$this->afficheMenuInternaute();
			}
		}
		
		public function afficheMenuInternaute()
		{
			echo '<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuEntraineur" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Menu Entraîneur 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuEntraineur">
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=visualiser>Visualiser les entraineurs</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuEquipe" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Menu Equipe 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuEquipe">
					<li><a class="dropdown-item" href=index.php?vue=Equipe&action=visualiser>Visualiser les équipes</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuAdherent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Menu Adherent 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuAdherent">
					<li><a class="dropdown-item" href=index.php?vue=Adherent&action=visualiser>Visualiser les Adherents</a></li>
				</ul></div></div>';


				echo'
				<UL id=zoneResultat>
				<!-- Ici on pourrait mettre un appel a $listeDesMatieres[0] avec un echo pour afficher la valeur de base -->
			   	</UL>
				
			</div>
			</div>	
			</div>';
						
		}
		public function afficheMenuAdherent()
		{	

			echo '<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuAdherent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Mon profil 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuAdherent">
					<li><a class="dropdown-item" href=index.php?vue=Adherent&action=modifierSonProfil>Modifier son profil</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuAdherent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Me déplacer 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuAdherent">
					<li><a class="dropdown-item" href=index.php?vue=Adherent&action=voyager>Aller en déplacement</a></li>
				</ul>
			</div>
			<div>
				<ul class="dropdown-menu" aria-labelledby="menuEntraineur">
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=modifierSonProfil>Modifier son profil</a></li>
				</ul>
			</div>
		</div>
		</form>';
		echo '<section>';
	 	require 'Vues/ihm/deconnexion.php';

				



		}
		public function afficheMenuEntraineur()
		{
			echo '<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle bordure" type="button" id="menuEntraineur" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Mon profil 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuEntraineur">
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=modifierSonProfil>Modifier son profil</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle bordure" type="button" id="menuEntraineur" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Mes sportifs 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuEntraineur">
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=visualiserSesEquipes>Visualiser ses Adherents</a></li>
				</ul>
			</div>
			<div>
				<ul class="dropdown-menu " aria-labelledby="menuEntraineur">
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=modifierSonProfil>Modifier son profil</a></li>
				</ul>
			</div>
			
			</div>
			</div>	';
			require 'Vues/ihm/deconnexion.php';
		}
		
		public function afficheMenuAdmin()
		{
			echo'<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuEntraineur" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Menu Entraîneur 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuEntraineur">
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=ajouter>Ajouter un Entraineur</a></li>
					<li><a class="dropdown-item" href=index.php?vue=Entraineur&action=modifier>Modifier un entraineur</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuEquipe" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Menu Equipe 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuEquipe">
					<li><a class="dropdown-item" href=index.php?vue=Equipe&action=ajouter>Ajouter une équipe</a></li>
					<li><a class=dropdown-item href=index.php?vue=Equipe&action=modifier>Modifier une équipe</a></li>
				</ul>
			</div>
			<div class="dropdown col">
				<button class="btn bg-transparent dropdown-toogle" type="button" id="menuAdherent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					Menu Adherent 
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="menuAdherent">
					<li><a class="dropdown-item" href=index.php?vue=Adherent&action=ajouter>Ajouter un Adherent</a></li>
					<li><a class="dropdown-item" href=index.php?vue=Adherent&action=modifier>Modifier un Adherent</a></li>
				</ul>
			</div>
			<div class="dropdown col">
			<button class="btn bg-transparent dropdown-toogle" type="button" id="menuAdherent" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				Mon profil 
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="menuAdherent">
				<li><a class="dropdown-item" href=index.php?vue=Connexion&action=modifierSonProfil>Modifier son profil</a></li>
			</ul>
		</div>
			</div>
		</div>';
		require 'Vues/ihm/deconnexion.php';
	
		}

		public function profilAdmin()
		{
			echo "<div class='milieu'><form action=index.php?vue=Connexion&action=modifierSonProfil method=POST>
			<div>
				<p>Changer son mot de passe : </p><input type=password name=newMdp id=newMdp>
		
				<input type='submit' class='btn btn-outline-primary'>
			</div><br>";
		}

		public function profilEntraineur()
		{
			echo "<div class='milieu'><form action=index.php?vue=Entraineur&action=modifierSonProfil method=POST>
			<div>
				<p>Changer son mot de passe : </p><input type=password name=newMdp id=newMdp required>
		
				<input type='submit' class='btn btn-outline-primary'>
			</div><br>";
		}


		public function profilAdherent()
		{
			echo "<div class='milieu'>
					<form action=index.php?vue=Adherent&action=modifierSonProfil method=POST>
						<div class=''>
							<p>Changer son mot de passe : </p><input type=password name=newMdp id=newMdp class=input>
							<input type='submit'  class='btn btn-outline-primary'>
						</div>
				
					<br>";
		}


		public function infosPersonnelle()
		{
			require "vues/ihm/deconnexion.php";
			echo "<br></div>";

		}

		public function listeTheme()
		{

		}
		
		
	}