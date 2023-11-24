<?php
switch ($action)
			{
				case "Verification":
					$_SESSION['role'] = $_POST['role'];
					$_SESSION['login'] = htmlspecialchars($_POST['login']);
					$_SESSION['pwd']= MD5($_POST['pwd']);
					$vue = new vueCentraleConnexion();
					$existe=$this->maBD->verifExistance($_SESSION['role'],$_SESSION['login'],$_SESSION['pwd']);

					session_regenerate_id(true);  // regénère un cokie de sesssion empéchant less attaques par fixations 


					$date = date('d-m-y h:i:s');
					$action = "Connexion";
					$this->maBD->logAction($_SESSION['login'], $_SESSION['role'], $date, $action);
					$vue->AfficherMenuContextuel($_SESSION['role'],$existe);
					$_GET['action'] = 'liste';
					$_GET['vue'] = 'Connexion';
					$this->affichePage($_GET['action'],$_GET['vue'],$role);
					break;

				case "Deconnexion" :
					$date = date('d-m-y h:i:s');
					$action = "Déconnexion";
					$this->maBD->logAction($_SESSION['login'], $_SESSION['role'], $date, $action);
					session_destroy();
					$vue=new vueCentraleConnexion();
					$vue->afficheMenuInternaute();
					break;

				case "Inscription" :
					$login = htmlspecialchars($_POST['login']);
					$pwd = MD5($_POST['pwd']);
					$vue = new vueCentraleConnexion;
					$vue->afficheMenuInternaute();
					break;

				case "modifierSonProfil" :
					try
					{
						if (isset($_POST['newMdp']))
						{
							$newMdp= $_POST['newMdp'];
							if(preg_match("#(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{12}#", $newMdp))
							{
								$this->maBD->changerLeMdpAdmin($newMdp);
								$date = date('d-m-y h:i:s');
								$action = "Changement mot de passe Admin";
								$this->maBD->logAction($_SESSION['login'], $_SESSION['role'], $date, $action);
							}
							else 
							{
								echo "Il faut 12 caractères dont une MIN, une MAJ, 1 caractère spécial et un nombre";
							}
						}
						$vue=new vueCentraleConnexion();
						$vue->afficheMenuAdmin();
						$vue->profilAdmin();
					}
					catch(Exception $e)
					{
						die;
					}
					break;

				case "liste":
					$liste= $this->maBD->chargementGenre();
					$i =0;
					echo '<div class="d-flex justify-content-center align-items-center flex-column">Selectionnez un thème 
					<select name="theme" class="form-select select" aria-label="Default select example" id ="theme" onchange=appelAjax()>
					<option value=-1 selected>---Sélectionner---</option>';

						while($i < count($liste))
						{
							echo '<option value='.$i.'>'.$liste[$i]->genre.'</option>';	
							$i++;
						}
					echo '</select>					
					<UL id=zoneResultat>
					</UL>';

			}
?>