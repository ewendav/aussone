<?php


class conteneurEntraineur
	{
	//attribut de type arrayObjet, mais on est en php donc on ne met pas les types
	private $lesEntraineurs;
	
	//le constructeur créer un tableau vide
	public function __construct()
		{
		$this->lesEntraineurs = new arrayObject();
		}
	
	//les méthodes habituellement indispensables
	public function ajouterUnEntraineur(int $unIdEntraineur, string $unNomEntraineur, string $unLoginEntraineur, string $unPwdEntraineur)
	{
		$unEntraineur = new metierEntraineur(idEntraineur: $unIdEntraineur, nomEntraineur : $unNomEntraineur, loginEntraineur : $unLoginEntraineur, pwdEntraineur : $unPwdEntraineur);
		$this->lesEntraineurs->append($unEntraineur);
			
	}
	
	public function nbEntraineur()
		{
		return $this->lesEntraineurs->count();
		}	
		
	public function listeDesEntraineurs()
		{
		$liste = '';
		foreach ($this->lesEntraineurs as $unEntraineur)
			{	$liste = $liste.$unEntraineur->afficheEntraineur().'|';
			}
		
		return $liste;
		}
		
	public function lesEntraineursAuFormatHTML()
		{
		$liste = "<SELECT name = 'idEntraineur'>";
		foreach ($this->lesEntraineurs as $unEntraineur)
			{
			$liste = $liste."<OPTION value='".$unEntraineur->idEntraineur."'>".$unEntraineur->nomEntraineur."</OPTION>";
			}
		$liste = $liste."</SELECT>";
		return $liste;
		}		
	
	public function donneObjetEntraineurDepuisNumero($unIdEntraineur)
		{
		$trouve=false;
		$leBonEntraineur=null;
		$iEntraineur = $this->lesEntraineurs->getIterator();
		while ((!$trouve)&&($iEntraineur->valid()))
			{
			if ($iEntraineur->current()->idEntraineur==$unIdEntraineur)
				{
				$trouve=true;
				$leBonEntraineur = $iEntraineur->current();
				}
			else
				$iEntraineur->next();
			}
		return $leBonEntraineur;
		}	

		public function infosPersonnelles()
		{
			foreach ($this->lesEntraineurs as $A)
			{
				
				if($_SESSION['login'] == $A->loginEntraineurs && $_SESSION['pwd'] == $A->pwdEntraineurs)
				{
					$affiche = "<br>Nom : ".$A->nomEntraineurs."<br> Prénom : ".$A->prenomEntraineurs."<br> Age : ".$A->ageEntraineurs."<br> Sexe : ".$A->sexeEntraineurs."<br> Login : ".$A->loginEntraineurs;
					echo $affiche;
				}
			}
		}	
			
	}
?> 