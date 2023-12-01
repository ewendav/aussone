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


                case "vueModifierSpe":
                    $vueMenu =new vueCentraleConnexion();
					$vueMenu ->afficheMenuAdmin();
					$vue=new vueCentraleSpe();                    

                    $vue->modifierSpe($this->maBD->selectAllSpe());      

                    break;

                case "modifierSpe":

                    
                    foreach($this->maBD->selectCountSpe() as $id[0]){

                        if (isset($_POST["libelle".$id[0]])){
                            if ($_POST["libelle".$id[0]] !== ""){
                                $this->maBD->updateSpe($id, $_POST["libelle".$id[0]]);
                            }
                        }

            

                    }

                    $vueMenu =new vueCentraleConnexion();
					$vueMenu ->afficheMenuAdmin();
					$vue=new vueCentraleSpe();                    

                    $vue->modifierSpe($this->maBD->selectAllSpe());     

            

                    break;

				
			}
?>