<?php
switch ($action)
			{
				case "ajouter":
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					// a faire car on ajoute toujours le meme pour faire des tests
					$this->tousLesAdherents->ajouterUnAdherent($this->toutesLesEquipes->donneObjetEquipeDepuisNumero(3),$this->maBD->donneNumeroMaxAdherent(),'Essai','adherent',12,'F','essai','essai');
					$this->maBD->insertAdherent('Essai','adherent',12,'F','essai','essai',3);
					break;
				case "visualiser" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuInternaute();
					$message = $this->tousLesAdherents->listeDesAdherents();
					$vue = new vueCentraleAdherent();
					$vue->visualiserAdherent($message);
					break;
				case "modifier" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdmin();
					//a faire;
					break;
				case "modifierSonProfil" :
					try
					{
						$vue=new vueCentraleConnexion();
						$vue->afficheMenuAdherent();
						$vue->profilAdherent();
						$date = date('d-m-y h:i:s');
						if (isset($_POST['newMdp']) && $_POST['newMdp'])
						{
							$newMdp= $_POST['newMdp'];
							if(preg_match("#(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{12}#", $newMdp))
							{
								$this->maBD->changerLeMdp($newMdp);
								$date = date('d-m-y h:i:s');
								$action = "Changement de mot de passe Adhérent";
								$this->maBD->logAction($_SESSION['login'], $_SESSION['role'], $date, $action);
							}
							else 
							{
								if ($_POST['newMdp'] != "")
								{
									echo "Il faut 12 caractères dont une MIN, une MAJ, 1 caractère spécial et un nombre";
								}
							}
						}

						$this->tousLesAdherents->infosPersonnelles();
						$liste= $this->maBD->chargementEquipe();
						$i =1;
							echo '<form method=POST href="index.php?vue=Adherent&action=modifierSonProfil"><select name=nouvelEquipe>';
							echo '<option value=0 selected>---Sélectionner---</option>';
							while($i < count($liste))
							{
								echo '<option value='.$i.' >'.$liste[$i]->nomEquipe.'</option>';	
								$i++;
							}
						echo '</select><input type=submit></form>';
						if (isset($_POST['nouvelEquipe']) && $_POST['nouvelEquipe'] !=0)
						{
							$nouvelEquipe= $_POST['nouvelEquipe'];
							$this->tousLesAdherents->changementEquipe($nouvelEquipe);
							$this->maBD->changementEquipeBD($nouvelEquipe);		
						}	
					}
					catch(Exception $e)
					{
						die;
					}

					break;
				case "voyager" :
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuAdherent();
					$vue = new vueCentraleAdherent();
					$vue->voyagerAdherent();
					break;
			}
?>