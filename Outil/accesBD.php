 <?php

class accesBD
{
	private $hote;
	private $login;
	private $passwd;
	private $base;
	private $conn;
	private $boolConnexion;
	// Nous construisons notre connexion
	public function __construct()
		{
		$this->hote="localhost";
		$this->login="root";
		$this->passwd="";
		$this->base="aussonnegitewen";

		$this->connexion();
		
		}
	private function connexion()
	{
		try
        {
            $this->conn = new PDO("mysql:host=".$this->hote.";dbname=".$this->base.";charset=utf8", $this->login, $this->passwd);
            $this->boolConnexion = true;
        }
        catch(PDOException $e)
        {
            die("Connection à la base de données échouée".$e->getMessage());
        }
	}
	
	public function verifExistance($role,$login,$pwd)
	{   
	
		switch ($role)
		{
			case "1" :
				$requete="SELECT idAdmin FROM administrateur where loginAdmin = '".$login."' and pwdAdmin = '".$pwd."' ;";
				break;
			case "2" :
				$requete="SELECT idAdherent FROM adherent where loginAdherent =  '".$login."' and pwdAdherent = '".$pwd."' ;";
				break;
			case "3" :
				$requete="SELECT idEntraineur FROM entraineur where loginEntraineur =  '".$login."' and pwdEntraineur = '".$pwd."' ;";
				break;
		}
		
		$result=$this->conn->query($requete);
		
		if ($result)
    	{
			if ($result->rowCount()==1)
			{
				return(1);
			}
			else
			{
				return(0);
			}
		}
	}	
		

	
	/******************************************************************************
	Nous avons toutes les fonctions d'insertion
	*******************************************************************************/
	public function insertVacataire($unNomEntraineur,$unLoginEntraineur, $unPwdEntraineur,$unTelephone)
	{
		$sonId = $this->donneProchainIdentifiant("ENTRAINEUR","idEntraineur");
		$requete = $this->conn->prepare("INSERT INTO ENTRAINEUR (idEntraineur,nomEntraineur,loginEntraineur,pwdEntraineur) VALUES (?,?,?,?)");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$unNomEntraineur);
		$requete->bindValue(3,$unLoginEntraineur);
		$requete->bindValue(4,$unPwdEntraineur);
		if(!$requete->execute())
		{
			die("Erreur dans insert Entraineur : ".$requete->errorCode());
		}
		
		$requete = $this->conn->prepare("INSERT INTO vacataire (idEntraineur,telephoneVacataire) VALUES (?,?)");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$unTelephone);
		if(!$requete->execute())
		{
			die("Erreur dans insert Vacataire : ".$requete->errorCode());
		}
		return $sonId;
	}
		
	public function insertTitulaire($unNomEntraineur,$unLoginEntraineur, $unPwdEntraineur,$uneDateEmbauche)
	{
		$sonId = $this->donneProchainIdentifiant("ENTRAINEUR","idEntraineur");
		$requete = $this->conn->prepare("INSERT INTO ENTRAINEUR (idEntraineur,nomEntraineur,loginEntraineur,pwdEntraineur) VALUES (?,?,?,?)");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$unNomEntraineur);
		$requete->bindValue(3,$unLoginEntraineur);
		$requete->bindValue(4,$unPwdEntraineur);
		if(!$requete->execute())
		{
			die("Erreur dans insert Entraineur : ".$requete->errorCode());
		}
		echo 'une date d embauche : '.$uneDateEmbauche;
		$requete = $this->conn->prepare("INSERT INTO titulaire (idEntraineur,dateEmbauche) VALUES (?,?)");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$uneDateEmbauche);
		if(!$requete->execute())
		{
			die("Erreur dans insert Titulaire : ".$requete->errorCode());
		}

		return $sonId;
	}
		
	public function insertEquipe($unNomEquipe,$unNbrPlaceEquipe,$unAgeMinEquipe,$unAgeMaxEquipe,$unSexeEquipe,$unIdEntraineur, $unIdSport)
	{
		$sonId = $this->donneProchainIdentifiant("EQUIPE","idEquipe");
		$requete = $this->conn->prepare("INSERT INTO EQUIPE (idEquipe,nomEquipe,nbrPlaceEquipe,ageMinEquipe,ageMaxEquipe,sexeEquipe,idEntraineur,idSport) VALUES (?,?,?,?,?,?,?,?)");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$unNomEquipe);
		$requete->bindValue(3,$unNbrPlaceEquipe);
		$requete->bindValue(4,$unAgeMinEquipe);
		$requete->bindValue(5,$unAgeMaxEquipe);
		$requete->bindValue(6,$unSexeEquipe);
		$requete->bindValue(7,$unIdEntraineur);
		$requete->bindValue(8,$unIdSport);
		if(!$requete->execute())
		{

		}
		else
		{
		}
		
	}
	
	public function selectAllSports()
	{
		$requete = $this->conn->prepare("select idSport, libelle from sport");
		$lesSports = [];

		if($requete->execute()){
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{

				$lesSports[] = $row;

			}
		}

		return $lesSports;
		
	}

		
	public function selectAllEntraineurs()
	{
		$requete = $this->conn->prepare("select idEntraineur, nomEntraineur from entraineur");
		$lesSports = [];

		if($requete->execute()){
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{

				$lesSports[] = $row;

			}
		}

		return $lesSports;
		
	}
		
	public function selectAjaxEquipe($type, $id)
	{

		if($type === "entraineur"){
			$requete = $this->conn->prepare("select C.idSpecialite, S.libelle from competent C
			inner join sport S on S.idSport = C.idSpecialite
				where C.idEntraineur = 
			" .+ $id);
		}else{
			$requete = $this->conn->prepare("select C.idEntraineur, E.nomEntraineur from competent C
			inner join entraineur E on E.idEntraineur = C.idEntraineur
				where C.idSpecialite = 
			" .+ $id);
		}

		$lesSports = [];

		if($requete->execute()){			

			while($row = $requete->fetch(PDO::FETCH_NUM))
			{

				$lesSports[] = '<option value="'.$row[0].'">'.$row[1].'</option>'
				;


			}
		}




		return json_encode($lesSports);
		
	}




	public function insertAdherent($unNomAdherent,$unPrenomAdherent,$unAgeAdherent, $unSexeAdherent,$unLoginAdherent, $unPwdAdherent)
	{
		$sonId = $this->donneProchainIdentifiant("ADHERENT","idAdherent")+1;
		$requete = $this->conn->prepare("INSERT INTO ADHERENT (idAdherent,nomAdherent, prenomAdherent, ageAdherent, sexeAdherent,loginAdherent, pwdAdherent,idEquipe) VALUES (?,?,?,?,?,?,?)");
		$requete->bindValue(1,$sonId);
		$requete->bindValue(2,$unNomAdherent);
		$requete->bindValue(3,$unPrenomAdherent);
		$requete->bindValue(4,$unAgeAdherent);
		$requete->bindValue(5,$unSexeAdherent);
		$requete->bindValue(6,$unLoginAdherent);
		$requete->bindValue(7,$unPwdAdherent);
		if(!$requete->execute())
		{
			$error = $requete->errorInfo();
				if($error[0]==10006)
				{
					echo "erreur provoquée par le Trigger : $error[2]\n";
				}
				else
				{
					echo "erreur provoquée par SQL : $error[2]\n";
				}
		}
		else
		{
			echo "L'ajout est effectué.";
		}
		return $sonId;
	}
	

	public function insertSpe($libelle)
	{
		$requete = $this->conn->prepare("INSERT INTO SPORT (libelle) VALUES (?)");
		$requete->bindValue(1,$libelle);
		if(!$requete->execute())
		{
			$error = $requete->errorInfo();
				if($error[0]==10004)
				{
					echo "une equipe porte déja ce nom";
				}
				else
				{
					echo "erreur provoquée par SQL : $error[2]\n";
				}
		}
		else
		{
		}
		
	}


	/***********************************************************************************************
	méthode qui va permettre de modifier les éléments d'une équipe.
	***********************************************************************************************/
	public function modifEquipe($idEquipe,$unNomEquipe,$unNbrPlaceEquipe,$unAgeMinEquipe,$unAgeMaxEquipe,$unSexeEquipe,$unIdEntraineur)
	{	$requete = $this->conn->prepare("UPDATE equipe SET nomEquipe = ?, nbrPlaceEquipe = ?, ageMinEquipe = ?, ageMaxEquipe = ?, sexeEquipe = ?, idEntraineur = ? where idEquipe = ?");
		
		$requete->bindValue(1,$unNomEquipe);
		$requete->bindValue(2,$unNbrPlaceEquipe);
		$requete->bindValue(3,$unAgeMinEquipe);
		$requete->bindValue(4,$unAgeMaxEquipe);
		$requete->bindValue(5,$unSexeEquipe);
		$requete->bindValue(6,$unIdEntraineur);
		$requete->bindValue(7,$idEquipe);
		
		echo "La modification est effectuée.";
		
		if(!$requete->execute())
		{
			die("Erreur dans modif Equipe : ".$requete->errorCode());
		}
		return $idEquipe;
	}
	
	/***********************************************************************************************
	C'est la fonction qui permet de charger les tables et de les mettre dans un tableau 2 dimensions. La petite fontions specialCase permet juste de psser des minuscules aux majuscules pour les noms des tables de la base de données
	************************************************************************************************/
	public function chargement($uneTable)
	{
		$lesInfos=null;
		$nbTuples=0;
		$stringQuery="SELECT * FROM ";
		$stringQuery = $this->specialCase($stringQuery,$uneTable);
		$query = $this->conn->prepare($stringQuery);
		if($query->execute())
		{
			while($row = $query->fetch(PDO::FETCH_NUM))
			{
				$lesInfos[$nbTuples] = $row;
				$nbTuples++;
			}
		}
		else
		{
			die('Problème dans chargement : '.$query->errorCode());
		}
		return $lesInfos;
	}

	public function chargementGenre()
	{
		$lesInfos=null;
		$nbTuples=0;
		$requete='SELECT genre FROM genreTheme;';
		$requete = $this->conn->prepare($requete);
		if($requete->execute())
		{
			while ( $row = $requete->fetch ( PDO::FETCH_OBJ ))
			{ 		
				$lesInfos[$nbTuples] = $row;
				$nbTuples++;
			}
		}
		else
		{
			die('Problème dans chargement : '.$requete->errorCode());
		}
		return $lesInfos;
	}

	public function chargementEquipe()
	{
		$lesInfos=null;
		$nbTuples=0;
		$requete='SELECT nomEquipe FROM equipe;';
		$requete = $this->conn->prepare($requete);
		
		if($requete->execute())
		{
			while ( $row = $requete->fetch ( PDO::FETCH_OBJ ))
			{ 		
				$lesInfos[$nbTuples] = $row;
				$nbTuples++;
			}
		}
		else
		{
			die('Problème dans chargement : '.$requete->errorCode());
		}
		return $lesInfos;
	}


	public function afficheListeDesThemes($genre)
	{	$requete = 'SELECT id, dateParution, description FROM theme WHERE genretheme = '.$genre.';';
		$liste="<UL>";
		$result=$this->conn->query($requete);
		while ( $row = $result->fetch ( PDO::FETCH_OBJ ) )
		{	$liste=$liste."<br><LI>".$row->id." ".$row->dateParution." ".$row->description."</LI>";}
		$liste=$liste.'</UL>';
		return $liste;
	}

	private function specialCase($stringQuery,$uneTable)
	{
			$uneTable = strtoupper($uneTable);
			switch ($uneTable) {
			case 'VACATAIRE':
				$stringQuery.='vacataire';
				break;
			case 'EQUIPE':
				$stringQuery.='equipe';
				break;
			case 'ADHERENT':
				$stringQuery.='adherent';
				break;
			case 'ENTRAINEUR':
				$stringQuery.='entraineur';
				break;
			case 'TITULAIRE':
				$stringQuery.='titulaire';
				break;
			case 'LOGACTION':
				$stringQuery.='logaction';
				break;
			case 'SPORT':
				$stringQuery.='sport';
				break;
			default:
				die('Pas une table valide');
				break;
			}

			return $stringQuery.";";
	}
	
	/**************************************************************************
	fonction qui permet d'avoir le prochain identifiant de la table. Elle est là uniquement parce que nous n'avons pas d'autoincremente dans notre base de données
	***************************************************************************/
	public function donneProchainIdentifiant($uneTable)
	{
		$stringQuery = $this->specialCase("SELECT * FROM ",$uneTable);
		$requete = $this->conn->prepare($stringQuery);
		//$requete->bindValue(1,$unIdentifiant);

		if($requete->execute())
		{
			$nb=0;
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{
				$nb = $row[0];
			}
			return $nb+1;
		}
		else
		{
			die('Erreur sur donneProchainIdentifiant : '+$requete->errorCode());
		}
	}
	
	/************************************************************************
     Fonction qui me permettent d'obtenir le numéro max pour l'entraineur car comme nous avons un héritage, nous ne pouvons pas savoir le dernier numéro grace à conteneurVacataire ou conteneurTitulaire et normalement on a supprimé le conteneuEntraineur.
	 On aurait pu optimisé en ayant qu'une méthode et en faisant passer le nom de la table...
    *************************************************************************/	 
	public function donneNumeroMaxEntraineur()
	{
		$stringQuery = "SELECT idEntraineur FROM entraineur";
		$requete = $this->conn->prepare($stringQuery);

		if($requete->execute())
		{
			$nb=0;
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{
				$nb + 1;
			}
			return $nb+1;
		}
		else
		{
			die('Erreur sur l identifiant de l entraineur : '+$requete->errorCode());
		}
	}
	
	public function donneNumeroMaxEquipe()
	{
		$stringQuery = "SELECT * FROM equipe";
		$requete = $this->conn->prepare($stringQuery);
		if($requete->execute())
		{
			$nb=0;
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{
				$nb + 1;
			}
			return $nb+1;
		}
		else
		{
			die('Erreur sur l identifiant de l equipe : '+$requete->errorCode());
		}
	}
	
	public function donneNumeroMaxAdherent()
	{
		$stringQuery = "SELECT * FROM adherent";
		$requete = $this->conn->prepare($stringQuery);
		if($requete->execute())
		{
			$nb=0;
			while($row = $requete->fetch(PDO::FETCH_NUM))
			{
			$nb + 1;
			}
			return $nb+1;
		}
		else
		{
			die('Erreur sur l identifiant de l adherent : '+$requete->errorCode());
		}
	}

		/************************************************************************
     Fonctions qui me permet de changer le mot de passe des différent rôles
    *************************************************************************/	 

	public function changerLeMdp($newMdp)
	{
		$Id = $_SESSION['login'];
		$newMdp =MD5($newMdp);
	
		$requete = $this->conn->prepare("UPDATE adherent SET pwdAdherent = ? where loginAdherent = ?");
		
		$requete->bindValue(1,$newMdp);
		$requete->bindValue(2,$Id);
		echo "La modification est effectuée.";
		
		if(!$requete->execute())
		{
			die("Erreur de modif : ".$requete->errorCode());
		}
	}

	public function changerLeMdpEntraineur($newMdp)
	{
		$Id = $_SESSION['login'];
		$newMdp =MD5($newMdp);
		$requete = $this->conn->prepare("UPDATE entraineur SET pwdEntraineur = ? where loginEntraineur = ?");
		
		$requete->bindValue(1,$newMdp);
		$requete->bindValue(2,$Id);

		echo "La modification est effectuée.";
		
		if(!$requete->execute())
		{
			die("Erreur de modif : ".$requete->errorCode());
		}
	}

	public function changerLeMdpAdmin($newMdp)
	{
		$Id = $_SESSION['login'];
		$newMdp =MD5($newMdp);
		$requete = $this->conn->prepare("UPDATE administrateur SET pwdAdmin = ? where loginAdmin = ?");
		
		$requete->bindValue(1,$newMdp);
		$requete->bindValue(2,$Id);

		if(!$requete->execute())
		{
			die("Erreur de modif : ".$requete->errorCode());
		}
		else
		{
			echo "La modification est effectuée.";
		}
	}

			/************************************************************************
     Fonctions qui me permet de voir les actions effectués par un utilisateur lorsqu'il est connecté
    *************************************************************************/	 

	public function logAction($loginUtilisateur, $roleUtilisateur, $dateConnexion, $actionUtilisateur)
	{
		$id = $this->donneProchainIdentifiant("logaction");
		$requete = $this->conn->prepare("INSERT INTO logaction VALUES (?,?,?,?,?)");
		
		$requete->bindValue(1,$id);
		$requete->bindValue(2,$loginUtilisateur);
		$requete->bindValue(3,$roleUtilisateur);
		$requete->bindValue(4,$dateConnexion);
		$requete->bindValue(5,$actionUtilisateur);

		if(!$requete->execute())
		{
			die("Erreur de modif : ".$requete->errorCode());
		}
	}	

				/************************************************************************
     Fonctions qui permet l'inscription d'un ADHERENT.
    *************************************************************************/	 

	public function ajoutUtilisateur($loginUtilisateur, $pwd)
	{
		$id = $this->donneProchainIdentifiant("adherent");
		$requete = $this->conn->prepare("INSERT INTO adherent VALUES (?,?,?)");
		
		$requete->bindValue(1,$id);
		$requete->bindValue(2,$loginUtilisateur);
		$requete->bindValue(3,$pwd);
		
		if(!$requete->execute())
		{
			die("Erreur de modif : ".$requete->errorCode());
		}
	}	

	public function changementEquipeBD($nouvelEquipe)
	{
		$requete = $this->conn->prepare("UPDATE adherent SET idEquipe = ? where loginAdherent = ?");
		
		$requete->bindValue(1,$nouvelEquipe);
		$requete->bindValue(2,$_SESSION['login']);

		if(!$requete->execute())
		{
			die("Erreur de modif : ".$requete->errorCode());
		}
	}

}