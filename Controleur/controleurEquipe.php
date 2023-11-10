<?php
switch ($action)
			{
				case "ajouter":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();//J'ajoute une nouvelle équipe juste pour voir si cela fonctionne
					//mais la fonctionnalité reste à faire en réalité
					$this->toutesLesEquipes->ajouterUneEquipe($this->maBD->donneNumeroMaxEquipe(),'equipe essai',10,5,8,'F',$this->tousLesTitulaires->donneObjetTitulaireDepuisNumero(1));
					$this->maBD->insertEquipe('equipe essai',10,5,8,'F',1);			
					break;
				case "visualiser" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuInternaute();
					$message = $this->toutesLesEquipes->listeDesEquipes();
					$vue = new vueCentraleEquipe();
					$vue->visualiserEquipe($message);
					break;
				case "modifier" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					$message= $this->toutesLesEquipes->lesEquipesAuFormatHTML();
					$vue = new vueCentraleEquipe();
					// $vue->modifierEquipe($message);
					break;
				case "choixFaitPourModif":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					$choix=$_GET['idEquipe'];
					$lEquipe=$this->toutesLesEquipes->donneObjetEquipeDepuisNumero($choix);
					$vue = new vueCentraleEquipe();
					$vue->choixFaitPourModifEquipe($lEquipe->nomEquipe,$lEquipe->nbrPlaceEquipe,$lEquipe->ageMinEquipe,$lEquipe->ageMaxEquipe,$lEquipe->sexeEquipe,$choix,$this->tousLesTitulaires->lesTitulairesAuFormatHTML());	
					break;
				case "EnregModif":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					$idEquipe=$_GET['idEquipe'];
					$nomEquipe=$_GET['nomEquipe'];
					$nbrPlaceEquipe=$_GET['nbrPlaceEquipe'];
					$ageMinEquipe=$_GET['ageMinEquipe'];
					$ageMaxEquipe=$_GET['ageMaxEquipe'];
					$sexeEquipe=$_GET['sexeEquipe'];
					$idTitulaire = $_GET['idTitulaire'];
					$leTitulaire = $this->tousLesTitulaires->donneObjetTitulaireDepuisNumero($idTitulaire);
					$this->maBD->modifEquipe($idEquipe,$nomEquipe,$nbrPlaceEquipe,$ageMinEquipe,$ageMaxEquipe,$sexeEquipe,$idTitulaire);
					$this->toutesLesEquipes->modifierUneEquipe($idEquipe, $nomEquipe, $nbrPlaceEquipe, $ageMinEquipe, $ageMaxEquipe, $sexeEquipe, $leTitulaire);
					
			}
?>