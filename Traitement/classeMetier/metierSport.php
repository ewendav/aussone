<?php
Class metierSport
	{
		
	//CONSTRUCTEUR-----------------------------------------------------------------------------
	public function __construct(private int $idSport=0, private string $libelle='')
		{

		}
	
	//ACCESSEURS-------------------------------------------------------------------------------
	public function __get($attribut)
		{	switch ($attribut)
			{	case 'idSport' :
					return $this->idSport; break;
				case 'libelle' : 
					return $this->libelle; break;
				default :
                    $trace = debug_backtrace();
                    trigger_error('Propriété non-accessible via _get() :'.$attribut.'dans '.$trace[0]['file'].' à la ligne'.$trace[0]['line'],E_USER_NOTICE);
				    break;
			}
		}
	
// les setteurs-----------------------------------------------------

public function __set($attribut, $laValeurDeLAttribut)
{	switch($attribut)
	{	case 'idSport' :
			$this->idSport=$laValeurDeLAttribut; break;
		case 'libelle' : 
			$this->libelle=$laValeurDeLAttribut; break;

		default :
			$trace = debug_backtrace();
			trigger_error('Propriété non-accessible via _get() :'.$attribut.'dans '.$trace[0]['file'].' à la ligne'.$trace[0]['line'],E_USER_NOTICE);
			break;
	}
}
		
	// méthode permettant d'afficher tous les attributs d'un seul coup
	public function afficheAdherent()
	{
		$liste=$this->libelle;
		return $liste;
	}	

	}

?>