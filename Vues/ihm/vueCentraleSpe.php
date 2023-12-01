<?php
	
	class vueCentraleSpe
	{
		public function __construct()
		{
			
		}

		public function AjouterSpe(){

			echo'
			<div  class="mt-5 d-flex flex-column align-items-center justify-content-center">
			<form class="d-flex flex-column align-items-center justify-content-center" style="width: 30vw;" 
			method="post" action="index.php?vue=Spe&action=ajouterSpeBDD">
				<h3>Ajouter une Spécialitée (sport)</h3>
			
				<input class="mt-3" name="libelle" type="text">
		
				<input class="btn mt-3 btn-outline-success" type="submit" value="créer">
			</form>
		
		</div>


			';

		}


		public function modifierSpe($lesSports){

			$listeSports = "";

			foreach($lesSports as $s){
 				$listeSports .= 
				"<tr>
					<td>".$s[0]."</td>
					<td>".$s[1]."</td>
					<td>  <input name='libelle".$s[0]."' type='text'>			
					</td>
				
				</tr>";
			};

			echo '
    <script defer>
        document.querySelector("body").style.overflowY = "visible";
    </script>';

			
			echo '<div   class="mt-5 d-flex flex-column align-items-center justify-content-center">
			<form style="height:100%; " class="d-flex flex-column align-items-center justify-content-center" style="width: 30vw;" 
			method="post" action="index.php?vue=Spe&action=modifierSpe">

				<h3 class="text-center mb-4" >Modifier les Spécialitée (sport)</h3>
		
				<table class="table">
					<tr>
						<td>id</td>
						<td>libelle</td>
						<td>modification libelle</td>
					</tr>
					
					'.$listeSports.'
						
					
		
				</table>
					
				<input class="btn mt-3 btn-outline-success" type="submit" value="créer">
			</form>
		
		</div>';


		}

		
		
	
}
?>