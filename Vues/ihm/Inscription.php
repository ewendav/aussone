<button type="button" class="btn Connexion" data-toggle="modal" data-target="#Inscription">
  S'inscrire
</button>

<!-- La modal -->
<div class="modal fade" id="Inscription" tabindex="-1" role="dialog" aria-labelledby="monInscription" aria-hidden="true">
  <div class="tailleInscription" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="monInscription">Saisissez vos informations</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="container">
			<div class="row">
					<form action=index.php?vue=Connexion&action=Inscription method=POST align=center>
						<table class="table table-sm">
							<tbody>

								<tr>
                                    <td>
											<input type=text name=nom placeholder="Nom" required></input>
									</td>
                                    <td>
											<input type=text name=prenom placeholder="Prenom" required></input>
									</td>
                                </tr>
                                <tr>
                                    <td>
											<input type=text name=sexe placeholder="Sexe" required></input>
									</td>
                                    <td>
											<input type=number min=5 max=100 name=age placeholder="Age" required></input>
									</td>
                                </tr>
                                <tr>
									<td>
											<input type=text name=login placeholder="Login" required></input>
									</td>
									<td>
											<input type=text name=pwd placeholder="Mot de passe" required></input>
									</td>
                                </tr>
									<td>
									</td>
								<tr>
									<td >
									</td>
									<td>
									<button type="submit" class="btn btn-primary">S'inscrire</button>
					</form>
									</td>
								</tr>
							</tbody>
						</table>
						
			</div>
		</div>
	  </div>
      
    </div>
  </div>
</div>