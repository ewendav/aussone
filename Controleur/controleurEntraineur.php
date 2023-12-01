<?php
switch ($action)
			{
				case "ajouter":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					$vue = new vueCentraleEntraineur();
					$vue->ajouterEntraineur();
					
				break;
				case 'SaisirEntraineur':
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					$typeEntraineur = $_POST['typeEntraineur'];
					$vue = new vueCentraleEntraineur();
					$vue->saisirEntraineur();
					break;
				case 'enregistrer':
					$typeEntraineur = $_POST['typeEntraineur'];
					$telEntraineur = null;
					$nomEntraineur=null;
					if ($typeEntraineur == "Vacataire") {
						$nomEntraineur = $_POST['nomEntraineur'];
						$loginEntraineur = $_POST['loginEntraineur'];
						$pwdEntraineur = $_POST['pwdEntraineur'];
						$telEntraineur = $_POST['numTelVacataire'];
						$this->tousLesVacataires->ajouterUnVacataire($this->maBD->donneProchainIdentifiant("ENTRAINEUR")+1, $nomEntraineur, $loginEntraineur,$pwdEntraineur,$telEntraineur);
						$this->maBD->insertVacataire($nomEntraineur,$loginEntraineur,$pwdEntraineur,$telEntraineur);
						$vue=new vueCentraleConnexion();
						$vue->afficheMenuAdmin();
					}
					else
					{	$nomEntraineur = $_POST['nomEntraineur'];
						$loginEntraineur = $_POST['loginEntraineur'];
						$pwdEntraineur = $_POST['pwdEntraineur'];
						$dateEmbEntraineur = $_POST['dateEmbaucheTitulaire'];
						$this->tousLesTitulaires->ajouterUnTitulaire($this->maBD->donneProchainIdentifiant("ENTRAINEUR")+1, $nomEntraineur,  $loginEntraineur,$pwdEntraineur,$dateEmbEntraineur);
						$this->maBD->insertTitulaire($nomEntraineur, $loginEntraineur,$pwdEntraineur,$dateEmbEntraineur);
						$vue=new vueCentraleConnexion();
						$vue->afficheMenuAdmin();
					}
					break;
				case "visualiser" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuInternaute();
					$liste=$this->tousLesTitulaires->listeDesTitulaires();
					$liste = $liste.$this->tousLesVacataires->listeDesVacataires();
					$vue = new vueCentraleEntraineur();
					$vue->VisualiserEntraineur($liste);
					break;
				case "modifier" :

					$vue=new vueCentraleConnexion();


					$vue->afficheMenuAdmin();
					$vue=new vueCentraleEntraineur();
					$listeEntraineur = $this->tousLesEntraineurs->lesEntraineursModif();
					$modifEnt = $this->tousLesSports->lesSportsAuFormatHTML();
					$vue->modifEntraineur($listeEntraineur, $modifEnt, $this->tousLesEntraineurs->getListe());

					if(isset($_POST["ok"]))
					{
						$idEntraineur = 1;
						if(isset($_POST['idSport0']))
							{
								$ancienSport = $_POST['SportDeb0'];
								echo $ancienSport;
								$select0 = $_POST["idSport0"];
								$this->maBD->modifEntraineurSpe($select0, $idEntraineur,$ancienSport);
							}
	
							if(isset($_POST["idSport1"]))
							{
								$ancienSport = $_POST['SportDeb1'];
								echo $ancienSport;
								$select1 = $_POST["idSport1"];
								$this->maBD->modifEntraineurSpe($select1, $idEntraineur, $ancienSport);
							}
	
							if(isset($_POST["idSport2"][2]))
							{
								$ancienSport = $_POST['SportDeb2'];	
								$select2 = $_POST["idSport2"];
								$this->modifEntraineurSpe($select2, $idEntraineur, $ancienSport);
							}
							

					}

					break;
				case "visualiserSesEquipes" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuEntraineur();
					//reste à faire
					break;
				case "modifierSonProfil" :
					try
					{

					if (isset($_POST['newMdp']))
						{
							$newMdp= $_POST['newMdp'];
							if(preg_match("#(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{12}#", $newMdp))
							{
								$this->maBD->changerLeMdpEntraineur($newMdp);
								$date = date('d-m-y h:i:s');
								$action = "Changement mot de passe Entraineur";
								$this->maBD->logAction($_SESSION['login'], $_SESSION['role'], $date, $action);
							}
							else 
							{
								echo "Il faut 12 caractères dont une MIN, une MAJ, 1 caractère spécial et un nombre";
							}
						}
					}
					catch(Exception $e)
					{
						die;
					}
					break;
			}
?>