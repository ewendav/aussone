<?php
switch ($action)
			{
				case "ajouterSpe":
                    $vueMenu =new vueCentraleConnexion();
					$vueMenu ->afficheMenuAdmin();
					$vue=new vueCentraleSpe();
				
                    $vue->ajouterSpe();
					
				break;

                case "ajouterSpeBDD":
                    $this->maBD->insertSpe(htmlspecialchars($_POST['libelle']));
                    $vueMenu =new vueCentraleConnexion();
					$vueMenu ->afficheMenuAdmin();
					$vue=new vueCentraleSpe();
				
                    $vue->ajouterSpe();

                    echo'
                    
                    <div  class="mt-5 d-flex flex-column align-items-center justify-content-center">
                    ajout effectué
		
		</div>
                    
                    ';
                
				break;

				
			}
?>