<?php
	
	class vueCentraleEquipe
	{
		public function __construct()
		{
			
		}
		
		public function modifierEquipe($message)
		{
			echo '<form action=index.php?vue=Equipe&action=choixFaitPourModif method = GET>';
			echo $message; 
			echo ' <input type=hidden name=vue value=Equipe></input>
				   <input type=hidden name=action value=choixFaitPourModif></input>
				   <button type="submit" class="btn btn-primary">Valider</button>
				  </form>
			';
		}

		public function AjouterEquipe($lesSports, $lesEntraineurs){

			$lesSportsListe ='';
			$lesEntraineursListe ='';

			foreach($lesSports as $sport){			

				$lesSportsListe .=
				'
				<option value=" '. $sport[0] .'  ">'. $sport[1]  .'</option>
				';

			};

			foreach($lesEntraineurs as $e){			

				$lesEntraineursListe .=
				'
				<option value=" '. $e[0] .'  ">'. $e[1]  .'</option>
				';

			};
			

			echo'
			<div class="mt-5 
			d-flex flex-column align-items-center justify-content-center">
    
	
			<form method="post" class="formEquipe" action="index.php?vue=Equipe&action=ajouter">
        <h3 class="text-center mb-3" >Ajouter une Equipe</h3>

        <div class=" mb-4 d-flex flex-row align-items-center justify-content-center">    
			<label for="1">Nom Equipe :</label>
            <input id="1" class="mx-2" name="libelle" type="text">                 
        </div>

		<div class=" mb-4 d-flex flex-row align-items-center justify-content-center">  
			<label for="2">Nombre de places :</label>          
            <input id="2" class="mx-2" name="nbPlace" type="number" min="0">                 
        </div>
        

		<div class=" mb-4 d-flex flex-row align-items-center justify-content-center">         
			<label for="3">Age minimum des adherents :</label>         			
            <input id="3" class="mx-2 ageMin" name="ageMin" type="number" min="0" max="100">                 
        </div>

		
		<div class=" mb-4 d-flex flex-row align-items-center justify-content-center">         
			<label for="4">Age maximum des adherents :</label>         			
            <input id="4" class="mx-2 ageMax" name="ageMax" type="number" min="0" max="100">                 
        </div>

		<div class=" mb-4 d-flex flex-row align-items-center justify-content-center">         
			<label for="5">Sexe des adherents :</label>      

			<select class="mx-2" name="sexe" id="5">
				<option value="homme">Homme</option>
				<option value="femme">Femme</option>
				<option value="homme">autre</option>
			</select>
			
        </div>

		
		<div class=" mb-4 d-flex flex-row align-items-center justify-content-center">         
			<label for="6">Entraineur :</label>      

			<select class="mx-2 selectEntraineur" name="entraineur" id="6">';

			echo $lesEntraineursListe; 

			echo '
	
			</select>
			
        </div>

		<div class=" mb-4 d-flex flex-row align-items-center justify-content-center">  

			<label for="7">Sport :</label>      

			<select class="mx-2 selectSport" name="sport" id="7">';
			
			
			
					echo $lesSportsListe;
			echo '
								
				
			</select>
			
        </div>
    
        
        
        <input class="btn mt-3" type="submit" value="créer">
    </form>

</div>
			';

			echo '<script src="Outil/ajax/script.js"></script>';
			

		}



		public function visualiserEquipe($message)
		{
						
			$listeEquipe=explode("|",$message);
			echo '<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">Nom</th>
							<th scope="col">Age Max</th>
							<th scope="col">Age Min</th>
							<th scope="col">Sexe</th>
							<th scope="col">Nbr de pers Max</th>
							<th scope="col">Entraineur</th>
														
						</tr>
					</thead>
					<tbody>';
			$nbE=0;
			while ($nbE<sizeof($listeEquipe))
			{	
				$i=0;
				while (($i<6) && ($nbE<sizeof($listeEquipe)))
				{
					echo '<td scope>';
					echo trim($listeEquipe[$nbE]);
					$i++;
					$nbE++;
					echo '</td>';
				}
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
			
		}
		
	public function choixFaitPourModifEquipe($nom, $nbrPlace, $ageMin, $ageMax, $sexe, $choix,$liste)
	{
		echo 'coucou';
		echo '<form action=index.php?vue=Equipe&action=EnregModif method = GET>
						<input type=text name=nomEquipe value='.$nom.'></input>
						<input type=integer name=nbrPlaceEquipe value='.$nbrPlace.'></input>
						<input type=integer name=ageMinEquipe value='.$ageMin.'></input>
						<input type=integer name=ageMaxEquipe value='.$ageMax.'></input>
						<input type=text name=sexeEquipe value='.$sexe.'></input>	';
						echo $liste;
						echo '<input type=hidden name=idEquipe value='.$choix.'></input>	
						<input type=hidden name=vue value=Equipe></input>
						<input type=hidden name=action value=EnregModif></input>
						<button type="submit" class="btn btn-primary">Valider</button>
			 </form>';
	}
}
?>