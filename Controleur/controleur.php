<?php

session_gc(); // vérifie manuellement si des sessions inactif n'ont pas été supr 

	class controleur
	{
		private $toutesLesEquipes;
		private $tousLesAdherents;
		private $tousLesEntraineurs;
		private $tousLesVacataires;
		private $tousLesTitulaires;
		private $tousLesSports;
		private $maBD;
		
/*********************************************************************************************************************
          CONSTRUCTEUR DE NOTRE CONTROLEUR
		       On construit tous les tableux d'objets et on les remplis vec la base de données
*********************************************************************************************************************/
		public function __construct()
		{
			$this->maBD = new accesBD();
			$this->tousLesVacataires = new conteneurVacataire();
			$this->tousLesTitulaires = new conteneurTitulaire();
			$this->toutesLesEquipes = new conteneurEquipe();
			$this->tousLesAdherents = new conteneurAdherent();
			$this->tousLesSports = new conteneurSport();
			$this->tousLesEntraineurs = new conteneurEntraineur();
			
	
			$this->chargeLesVacataires();
			$this->chargeLesTitulaires();
			$this->chargeLesEquipes();
			$this->chargeLesAdherents();
			$this->chargeLesSports();
			$this->chargeLesEntraineurs();
			
			
		}
/*****************************************************************************************
           AFFICHAGE DES ENTETES ET PIED DE PAGE
		   
******************************************************************************************/
        public function afficheEntete()
		{
			//appel de la vue de l'entête
			require 'Vues/ihm/entete.php';
		}
		
			
		public function affichePiedPage()
		{
		//appel de la vue du pied de page
		require 'Vues/ihm/piedPage.php';
		}
		
/******************************************************************************************
          EN FONCTION DE LA VUE DEMANDE ON EFFECTUE TELLE OU TELLE ACTION
********************************************************************************************/
		public function affichePage($action,$vue,$role)
		{
			if (isset($_GET['action']) && isset($_GET['vue']))
			{
				$action = $_GET['action'];
				$vue = $_GET['vue'];

				switch ($vue)
				{
					case "Entraineur" : 
						$this->actionEntraineur($action,$role);
						break;
					case "Equipe" :
						$this->actionEquipe($action,$role);
						break;
					case "Adherent" :
						$this->actionAdherent($action,$role);

						break;
					case "Connexion" :
						$this->actionConnexion($action,$role);
						break;
				}
			}
		}
/************************************************************************************************
              POUR LES ACTIONS CONCERNANT LA CONNEXION
					- Mise en lace d'un menu spécifique pour chacun des roles
*************************************************************************************************/
	
//---> On aiguille notre action
		public function actionConnexion($action,$role)
		{
			require 'controleur/controleurConnexion.php';
			
			
		}		

/************************************************************************************************
              POUR LES ACTIONS CONCERNANT LES ENTRAINEURS
					- ajouter un entraineur
					- enregistrer un entraineur
					- visualiser un entraineur
					- modifier un entraineur
*************************************************************************************************/
	
//---> On aiguille notre action
		public function actionEntraineur($action,$role)
		{
			require 'controleur/controleurEntraineur.php';
		}
		
// On a une fonction outil de chargement de notre conteneur
		public function chargeLesVacataires()
		{   $resultatEntraineur=$this->maBD->chargement('entraineur');
			$resultatVacataire=$this->maBD->chargement('vacataire');
			$nbE=0;
			while ($nbE<sizeof($resultatEntraineur))
			{
				$nbV=0;
				while ($nbV<sizeof($resultatVacataire))
				{
					if ($resultatEntraineur[$nbE][0] == $resultatVacataire[$nbV][0])
					{
						$this->tousLesVacataires->ajouterUnVacataire($resultatEntraineur[$nbE][0],$resultatEntraineur[$nbE][1],$resultatEntraineur[$nbE][2],$resultatEntraineur[$nbE][3],$resultatVacataire[$nbV][1]);
					}
					$nbV++;
				}
				$nbE++;
			}
		}
	
		public function chargeLesTitulaires()
		{   $resultatEntraineur=$this->maBD->chargement('entraineur');
			$resultatTitulaire=$this->maBD->chargement('titulaire');
			$nbE=0;
			while ($nbE<sizeof($resultatEntraineur))
			{
				$nbT=0;
				while ($nbT<sizeof($resultatTitulaire))
				{
					if ($resultatEntraineur[$nbE][0] == $resultatTitulaire[$nbT][0])
					{
						$this->tousLesTitulaires->ajouterUnTitulaire($resultatEntraineur[$nbE][0],$resultatEntraineur[$nbE][1],$resultatEntraineur[$nbE][2],$resultatEntraineur[$nbE][2],$resultatTitulaire[$nbT][1]);
					}
					$nbT++;
				}
				$nbE++;
			}
			
		}


/************************************************************************************************
              POUR LES ACTIONS CONCERNANT LES EQUIPES
					- ajouter une équipe
					- enregistrer une équipe
					- visualiser une équipe
					- modifier une équipe
*************************************************************************************************/
	
//---> On aiguille notre action
	
		function actionEquipe($action,$role)
		{
			require 'controleur/controleurEquipe.php';
			
		}
		
// On a une fonction outil de chargement de notre conteneur	

		public function chargeLesEquipes()
		{   $resultatEquipe=$this->maBD->chargement('equipe');
			$nbE=0;
			while ($nbE<sizeof($resultatEquipe))
			{
				if ($this->tousLesVacataires->chercherExistanceIdVacataire($resultatEquipe[$nbE][6]))
				{
						$this->toutesLesEquipes->ajouterUneEquipe($resultatEquipe[$nbE][0],$resultatEquipe[$nbE][1],$resultatEquipe[$nbE][2],$resultatEquipe[$nbE][3],$resultatEquipe[$nbE][4],$resultatEquipe[$nbE][5],$this->tousLesVacataires->donneObjetVacataireDepuisNumero($resultatEquipe[$nbE][6]));
				}
				else
				{		$this->toutesLesEquipes->ajouterUneEquipe($resultatEquipe[$nbE][0],$resultatEquipe[$nbE][1],$resultatEquipe[$nbE][2],$resultatEquipe[$nbE][3],$resultatEquipe[$nbE][4],				$resultatEquipe[$nbE][5],$this->tousLesTitulaires->donneObjetTitulaireDepuisNumero($resultatEquipe[$nbE][6]));
					
				}
				$nbE++;
			}
		
		}


/************************************************************************************************
              POUR LES ACTIONS CONCERNANT LES ADHERENTS
					- ajouter un adherent
					- enregistrer un adherent
					- visualiser un adherent
					- modifier un adherent
*************************************************************************************************/
//---> On aiguille notre action		
		function actionAdherent($action,$role)
		{
			require 'controleur/controleurAdherent.php';
		}

// On a une fonction outil de chargement de notre conteneur	
	
		public function chargeLesAdherents()
		{   $resultatAdherent=$this->maBD->chargement('adherent');
			$nbA=0;
			while ($nbA<sizeof($resultatAdherent))
			{	$this->tousLesAdherents->ajouterUnAdherent($resultatAdherent[$nbA][0],$resultatAdherent[$nbA][1],$resultatAdherent[$nbA][2],$resultatAdherent[$nbA][3],$resultatAdherent[$nbA][4],$resultatAdherent[$nbA][5],$resultatAdherent[$nbA][6]);
				$nbA++;
			}
		}

		public function chargeLesEntraineurs()
		{   $resultatAdherent=$this->maBD->chargement('entraineur');
			$nbA=0;
			while ($nbA<sizeof($resultatAdherent))
			{	$this->tousLesEntraineurs->ajouterUnEntraineur($resultatAdherent[$nbA][0],$resultatAdherent[$nbA][1],$resultatAdherent[$nbA][2],$resultatAdherent[$nbA][3]);
				$nbA++;
			}
		}

		public function chargeLesSports()
		{   $resultatSport=$this->maBD->chargement('sport');

			$nbA=0;
			while ($nbA<sizeof($resultatSport))
			{	$this->tousLesSports->ajouterUnSport($resultatSport[$nbA][0], $resultatSport[$nbA][1]);
				$nbA++;
			}
		}


		public function changerMdp($newMdp)
		{
			$this->maBD->changerLeMdp($newMdp);
		}


		public function afficheListeThemes($uneRef)
		{
			$this->maBD->afficheListeDesThemes($uneRef);
		}
	
	}



	
?>

	
	