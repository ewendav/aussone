<?php
Class metierEntraineur
	{
		private $lesEntraineursSpe = [];
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct(private int $idEntraineur=0, private string $nomEntraineur='',private string $loginEntraineur='', private string $pwdEntraineur='')
	{

	}

	public function ajoutEntraineur($lEntraineur)
		{
			$this->idEntraineur = $lEntraineur->idEntraineur;
			$this->nomEntraineur = $lEntraineur->nomEntraineur;
		}
		
	//ACCESSEURS-------------------------------------------------------------------------------
	public function __get($attribut)
		{	switch ($attribut)
			{	case 'idEntraineur' :
					return $this->idEntraineur; break;
				case 'nomEntraineur' : 
					return $this->nomEntraineur; break;
				case 'loginEntraineur' :
					return $this->loginEntraineur; break;
				case 'lesEntraineursSpe':
					return $this->lesEntraineursSpe; break;
				case 'pwdEntraineur' :
					return $this->pwdEntraineur; break;
				default :
                    $trace = debug_backtrace();
                    trigger_error('Propriété non-accessible via _get() :'.$attribut.'dans '.$trace[0]['file'].' à la ligne'.$trace[0]['line'],E_USER_NOTICE);
				    break;
			}
		}
	
	//SETTEUR------------------------------------------------------------
	
	public function __set($attribut, $laValeurDeLAttribut)
		{	switch($attribut)
			{	case 'idEntraineur' :
					$this->idEntraineur=$laValeurDeLAttribut; break;
				case 'nomEntraineur' : 
					$this->nomEntraineur=$laValeurDeLAttribut; break;
				case 'loginEntraineur' :
					$this->loginEntraineur=$laValeurDeLAttribut; break;
				case 'pwdEntraineur' :
					$this->PwdEntraineur=$laValeurDeLAttribut; break;
				default :
                    $trace = debug_backtrace();
                    trigger_error('Propriété non-accessible via _get() :'.$attribut.'dans '.$trace[0]['file'].' à la ligne'.$trace[0]['line'],E_USER_NOTICE);
				    break;
			}
		}
			
	// méthode permettant d'afficher tous les attributs d'un seul coup
	public function afficheEntraineur()
		{
		return $this->idEntraineur.' | '.$this->nomEntraineur.' | '.$this->loginEntraineur.' |';
		}			    
	
		public function ajoutEntraineurSpecialites($lesEntSpecialites)
		{

			$this->lesEntraineursSpe = $lesEntSpecialites;	
		}	
	}
	
?>