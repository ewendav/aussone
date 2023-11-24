<?php

Class conteneurAdherent
	{
	//attribut de type arrayObjet, mais on est en php donc on ne met pas les types
	private $lesAdherents;
	
	//le constructeur créer un tableau vide
	public function __construct()
		{
		$this->lesAdherents = new arrayObject();
		}
	
	//les méthodes habituellement indispensables
	public function ajouterUnAdherent(int $unIdAdherent, string $unNomAdherent, string $unPrenomAdherent, int $ageAdherent, string $sexeAdherent,string $unLoginAdherent, string $unPwdAdherent)
		{	$unAdherent = new metierAdherent($unIdAdherent, $unNomAdherent, $unPrenomAdherent, $ageAdherent, $sexeAdherent,$unLoginAdherent, $unPwdAdherent);
		$this->lesAdherents->append($unAdherent);
			
		}
	public function nbAdherent()
		{
		return $this->lesAdherents->count();
		}	
		
	public function listeDesAdherents()
		{
		$liste = '';
		foreach ($this->lesAdherents as $unAdherent)
			{	$liste = $liste.$unAdherent->afficheAdherent();
			}
		return $liste;
		}
		
	public function lesAdherentsAuFormatHTML()
		{
		$liste = "<SELECT name = 'idAdherent'>";
		foreach ($this->lesAdherents as $unAdherent)
			{
			$liste = $liste."<OPTION value='".$unAdherent->idAdherent()."'>".$unAdherent->nomAdherent()."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}		

	public function donneObjetAdherentDepuisNumero($unIdAdherent)
		{
		$trouve=false;
		$leBonAdherent=null;
		$iAdherent = $this->lesAdherents->getIterator();
		while ((!$trouve)&&($iAdherent->valid()))
			{
			if ($iAdherent->current()->idAdherent()==$unIdAdherent)
				{
				$trouve=true;
				$leBonAdherent = $iAdherent->current();
				}
			else
				$iAdherent->next();
			}
		return $leBonAdherent;
		}	
		
		public function changementEquipe($nouvelEquipe)
		{
			foreach($this->lesAdherents as $A)
			{
				if($A->loginAdherent == $_SESSION['login'])
				{
					$A->idEquipe = $nouvelEquipe;
				}
			}

		}

		public function infosPersonnelles()
		{
			foreach ($this->lesAdherents as $A)
			{

				if($_SESSION['login'] == $A->loginAdherent && $_SESSION['pwd'] == $A->pwdAdherent)
				{
					$affiche = "<br>Nom : ".$A->nomAdherent."<br> Prénom : ".$A->prenomAdherent."<br> Age : ".$A->ageAdherent."<br> Sexe : ".$A->sexeAdherent."<br> Login : ".$A->loginAdherent;
					echo $affiche;
				}
			}
		}	
	}

	

	
?> 