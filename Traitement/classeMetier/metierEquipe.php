<?php
Class metierEquipe
	{
	
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	
	public function __construct(private metierEntraineur $lEntraineur,private int $idEquipe=0, private string $nomEquipe='', private int $nbrPlaceEquipe=0, private int $ageMinEquipe=0, private int $ageMaxEquipe=0, private string $sexeEquipe='')
		{
			$this->lEntraineur->ajoutEntraineur($this);
		}
		
		public function ajoutEquipe($lEquipe)
		{
			$this->idEquipe = $lEquipe->idEquipe;
			$this->nomEquipe = $lEquipe->nomEquipe;
		}
	//ACCESSEURS-------------------------------------------------------------------------------
	public function __get($attribut)
		{	switch ($attribut)
			{	case 'idEquipe' :
					return $this->idEquipe; break;
				case 'nomEquipe' : 
					return $this->nomEquipe; break;
				case 'nbrPlaceEquipe' :
					return $this->nbrPlaceEquipe; break;
				case 'ageMinEquipe' :
					return $this->ageMinEquipe; break;
				case 'ageMaxEquipe' :
					return $this->ageMaxEquipe; break;
				case 'sexeEquipe' :
					return $this->sexeEquipe; break;
				case 'idEntraineur' :
					return $this->lEntraineur->idEntraineur; break;
				case 'nomEntraineur' :
					return $this->lEntraineur->nomEntraineur; break;
				default :
                    $trace = debug_backtrace();
                    trigger_error('Propriété non-accessible via _get() :'.$attribut.'dans '.$trace[0]['file'].' à la ligne'.$trace[0]['line'],E_USER_NOTICE);
				    break;
			}
		}
	
	//SETTEUR------------------------------------------------------------
	
	public function __set($attribut, $laValeurDeLAttribut)
		{	switch($attribut)
			{	case 'idEquipe' :
					$this->idEquipe=$laValeurDeLAttribut; break;
				case 'nomEquipe' : 
					$this->nomEquipe=$laValeurDeLAttribut; break;
				case 'nbrPlaceEquipe' :
					$this->nbrPlaceEquipe=$laValeurDeLAttribut; break;
				case 'sexeEquipe' :
						$this->sexeEquipe=$laValeurDeLAttribut; break;
				case 'ageMinEquipe' :
					$this->ageMinEquipe=$laValeurDeLAttribut; break;
				case 'ageMaxEquipe' :
					$this->ageMaxEquipe=$laValeurDeLAttribut; break;
				case 'idEntraineur' :
					$this->idEntraineur=$laValeurDeLAttribut; break;
				case 'nomEntraineur' :
					$this->nomEntraineur=$laValeurDeLAttribut; break;
				default :
                    $trace = debug_backtrace();
                    trigger_error('Propriété non-accessible via _get() :'.$attribut.'dans '.$trace[0]['file'].' à la ligne'.$trace[0]['line'],E_USER_NOTICE);
				    break;
			}
		}
		
	// méthode permettant d'afficher tous les attributs d'un seul coup
	public function afficheEquipe()
	{
		return $liste=$this->nomEquipe.' | '.$this->nbrPlaceEquipe.' | '.$this->ageMinEquipe.'|'.$this->ageMaxEquipe.' |'.$this->sexeEquipe.'|'.$this->lEntraineur->nomEntraineur.'|';
					
	}			    
	
	}
	
?>