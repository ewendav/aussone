<?php
switch ($action)
			{
				case "ajouter":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();

					$vue= new vueCentraleEquipe();
					$vue->AjouterEquipe($this->maBD->selectAllSports(), $this->maBD->selectAllEntraineurs());
					
					$this->toutesLesEquipes->ajouterUneEquipe($this->maBD->donneNumeroMaxEquipe(),'equipe essai',10,5,8,'F',$this->tousLesTitulaires->donneObjetTitulaireDepuisNumero(1));


					if(isset($_POST['libelle'])){

						echo '<div class="d-flex flex-row align-items-center justify-content-center">';

							$result = $this->maBD->insertEquipe($_POST['libelle'],$_POST['nbPlace'],$_POST['ageMin'],$_POST['ageMax'],$_POST['sexe'],$_POST['entraineur'],$_POST['sport']);			

						echo '</div>';
					}
					
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