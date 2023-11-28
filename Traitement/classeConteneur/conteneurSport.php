<?php


class conteneurSport
	{
	//attribut de type arrayObjet, mais on est en php donc on ne met pas les types
	private $lesSports;
	
	//le constructeur créer un tableau vide
	public function __construct()
		{
		$this->lesSports = new arrayObject();
		}
	
	//les méthodes habituellement indispensables
	public function ajouterUnSport(int $unIdSport, string $libelle)
	{
		$unSport = new metierSport( idSport : $unIdSport, libelle : $libelle);
		$this->lesSports->append($unSport);
			
	}
	
	public function modifierUneSport($unIdSport, $libelle)
	{
		foreach ($this->lesSports as $unSport)
		{
			if ($unSport->unIdSport == $unIdSport)
			{
				$unSport->libelle = $libelle;
			}
		}
	}

	public function nbSport()
		{
		return $this->lesSports->count();
		}	
		
	public function listeDesSport()
		{
		$liste = '';
		foreach ($this->lesSports as $unSport)
			{	$liste = $liste.$unSport->afficheSport();
			}
		return $liste;
		}

		public function lesSportsAuFormatHTML()
		{
		$liste = "";
		foreach ($this->lesSports as $unSport)
			{
			$liste = $liste."<OPTION value='".$unSport->idSport."'>".$unSport->libelle."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
	}		
	
	public function donneObjetSportDepuisNumero($unIdSport)
	{
		$trouve=false;
		$leBonSport=null;
		foreach ($this->lesSports as $unSport)
			{
				if ($unSport->idSport==$unIdSport)
				{
				$trouve=true;
				$leBonSport = $unSport;
				}
			}
		return $leBonSport;
		}	
			
	}
?> 