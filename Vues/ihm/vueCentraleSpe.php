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

		
		
	
}
?>