	<?php
	
	class vueCentraleEntraineur
	{
		public function __construct()
		{
			
		}
		
		public function ajouterEntraineur()
		{
			echo '<form action=index.php?vue=Entraineur&action=SaisirEntraineur method=POST align=center>
							<fieldset>
							<legend>L entraineur est un : </legend>
							<input type="radio" name="typeEntraineur" value="Vacataire" id="vacataire">
							<label for="vacataire">Vacataire</label> <br/>

							<input type="radio" name="typeEntraineur" value="Titulaire" id="titulaire">
							<label for="titulaire">Titulaire</label> <br/>

							
							
							<button type="submit" class="btn btn-primary">Valider</button>
							</fieldset>	
						  </form>';
					
		}
		public function visualiserEntraineur($liste)
		{
			$listeEntraineur=explode("|",$liste);
			
				echo '<table class="table table-striped table-bordered table-sm ">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Nom</th>
							<th scope="col">Login</th>
							<th scope="col">Date ou Téléphone</th>
						</tr>
					</thead>
					<tbody>';
					$nbE=0;
					while ($nbE<sizeof($listeEntraineur))
						{	
							$i=0;
							echo '<tr>';
							while (($i<4) && ($nbE<sizeof($listeEntraineur)))
							{
								echo '<td scope>';
									echo trim($listeEntraineur[$nbE]);
									$i++;
									$nbE++;
								echo '</td>';
							}
							echo '</tr>';
						
						}
					echo '</tbody>';
					echo '</table>';
		}
		public function saisirEntraineur()
		{
			$typeEntraineur = $_POST['typeEntraineur'];
						
				echo '<form action=index.php?vue=Entraineur&action=enregistrer method=POST>';
					
					switch ($typeEntraineur) 
					{
					case 'Vacataire':
						echo '<legend>Information du Vacataire</legend>
							
							<table class="table table-bordered table-sm table-striped">
								<thead>
									<tr>
									  <th scope="col">Téléphone</th>
									  <th scope="col">Nom</th>
									  <th scope="col">Login</th>
									  <th scope="col">Password</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									  <td scope>
										<input type="text" name="numTelVacataire" id="NumTel" required="true">
									  </td>
									  <td>
										<input type=text name=nomEntraineur id=nomEntraineur required=true>
									  </td>
									  <td>
										<input type=text name=loginEntraineur id=loginEntraineur required=true>
									  </td>
									  <td>
										<input type=text name=pwdEntraineur id=pwdEntraineur required=true>
									  </td>
									</tr>
									<tr colspan=5>
									  <input type=hidden name=typeEntraineur value='.$typeEntraineur.'>
									  <button type="submit" class="btn btn-primary">Valider</button>
									</tr>
								</tbody>
							</table>
							
					</form>';
					break;
			
					case 'Titulaire':
						echo '<legend>Information du Titulaire</legend>
												
							<table class="table table-bordered table-sm table-striped">
								<thead>
									<tr>
									  <th scope="col">Date Entrée</th>
									  <th scope="col">Nom</th>
									  <th scope="col">Login</th>
									  <th scope="col">Password</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									  <td scope>
									    <input type=date name="dateEmbaucheTitulaire" placeholder="YYYY-MM-DD" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" id="dateEmbaucheTitulaire" required="true">
									  </td>
									  <td>
										<input type=text name=nomEntraineur id=nomEntraineur required=true>
									  </td>
									  <td>
										<input type=text name=loginEntraineur id=loginEntraineur required=true>
									  </td>
									  <td>
										<input type=text name=pwdEntraineur id=pwdEntraineur required=true>
									  </td>
									</tr>
									<tr colspan=5>
									  <input type=hidden name=typeEntraineur value='.$typeEntraineur.'>
									  <button type="submit" class="btn btn-primary">Valider</button>
									</tr>
								</tbody>
							</table>
							
					</form>';
						break;
					}

			
		}


		
		
		public function modifEntraineur($message, $modifEnt, $listEntraineur)
		{
			echo '<form action=index.php?vue=Entraineur&action=modifier method=POST>';
			echo $message;

			echo '
		  
		  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">';

				foreach($listEntraineur as $Entraineur)
				{
					if($Entraineur->idEntraineur == 1)
					{
						$i = 0;
						echo '<span style="font-size:1.5rem; text-decoration:underline; color:red">'.$Entraineur->nomEntraineur.'</span>';
						$nba=0;						
						foreach($Entraineur->lesEntraineursSpe as $SportEnt){
							echo '<br>';
							echo $SportEnt[$nba];
							echo '<br>
							<SELECT name="idSport'.$i.'" value="'.$i.'">';
							echo '<option selected disabled>---Séléctionner---</option>';
								echo $modifEnt;
							echo '</SELECT>
							<input type="hidden" name="SportDeb'.$i.'" value="'.$SportEnt[1].'"></input>';
							$i++;
							echo '<br>';
						}
					}
				}



				
			echo '				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  <button type="submit" value="ok" name="ok" class="btn btn-primary">Save changes</button>
				</div>
			  </div>
			</div>
		  </div></form>';

		  echo "    <script>
		  document.addEventListener('DOMContentLoaded', function() {
			  // Récupérer les boutons
			  var monBouton = document.getElementById('btnEntraineur');s
  
			  // Ajouter un gestionnaire d'événement au clic sur le premier bouton
			  monBouton.addEventListener('click', function() {
				  // Récupérer la valeur du bouton et l'afficher
				  var valeurDuBouton = monBouton.value;
			  });

			  
  
		  });
	  </script>";
		}

		
		
	}

	