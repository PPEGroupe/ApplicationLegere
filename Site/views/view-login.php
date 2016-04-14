<!DOCTYPE html>
<html>

<head>
    <?php require '/views/view-head.php'; ?>
</head>

<body>
    <?php require '/views/view-header.php'; ?>
    <?php //-------------------------------------------------------------- ### Connexion ### ---------------------------------------------------------- ?>
        <section class="container">
            <div class="row">
                <div class="col-sm-offset-3 col-sm-6">
                    <form action="" method="POST" class="form-horizontal" id="connection" role="form">
                        <h2>[Connexion]</h2>
                        <div class="form-group">
                            <label for="emailConnection">Identifiant</label>
                            <input type="email" class="form-control" id="emailConnection" name="email" placeholder="Insérez votre e-mail">
                        </div>
                        <div class="form-group">
                            <label for="passwordConnection">Mot de passe</label>
                            <input type="password" class="form-control" id="passwordConnection" name="password" placeholder="Insérer votre mot de passe">
                        </div>
                        <div class="form-group center">
                            <input type="submit" class="btn btn-warning" id="sendConnection" value="Se connecter" />
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ou s'inscrire <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="optionMenu" id="openWebUserRegister">En tant qu'utilisateur</li>
                                    <li role="separator" class="divider"></li>
                                    <li class="optionMenu" id="openClientRegister">En tant qu'entreprise</li>
                                    <li role="separator" class="divider"></li>
                                    <li class="optionMenu" id="openPartnerRegister">En tant que partenaire de diffusion</li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <?php //----------------------------------------------------------- ### Modales ### ----------------------------------------------------------?>
        
        <?php //------------------------------------------------------------ ## WebUser ## --------------------------------------------------------?>
        <div class="modal fade" id="webUserRegisterModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Inscription en tant qu'utilisateur</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="form-horizontal" id="webUserRegister" role="form">
                            <div class="form-group">
                                <label for="emailWebUser">Identifiant <span class="require">*</span></label>
                                <input type="email" class="form-control" id="emailWebUser" placeholder="Insérez votre e-mail">
                            </div>
                            <div class="form-group">
                                <label for="passwordWebUser">Mot de passe <span class="require">*</span></label>
                                <input type="password" class="form-control" id="passwordWebUser" placeholder="Insérez votre mot de passe">
                            </div>
                            <div class="form-group">
                                <label for="passwordConfirmationWebUser">Confirmation de mot de passe <span class="require">*</span></label>
                                <input type="password" class="form-control" id="passwordConfirmationWebUser" placeholder="Confirmer votre mot de passe">
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <div class="col-sm-6">
									<p class="require">* Champ obligatoire</p>
                                    </div>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                    <input type="submit" class="btn btn-warning" id="sendWebUser" value="S'inscrire" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php //------------------------------------------------------------ ## Client ## --------------------------------------------------------?>
        <div class="modal fade" id="clientRegisterModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Inscription en tant qu'entreprise</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="form-horizontal" id="clientRegister" role="form">
                            <div class="form-group">
                                <label for="emailClient">Identifiant <span class="require">*</span></label>
                                <input type="email" class="form-control" id="emailClient" placeholder="Insérez votre e-mail">
                            </div>
                            <div class="form-group">
                                <label for="companyClient">Société <span class="require">*</span></label>
                                <input type="text" class="form-control" id="companyClient" placeholder="Insérez votre société">
                            </div>
                            <div class="form-group">
                                <label for="passwordClient">Mot de passe <span class="require">*</span></label>
                                <input type="password" class="form-control" id="passwordClient" placeholder="Insérez votre mot de passe">
                            </div>
                            <div class="form-group">
                                <label for="passwordConfirmationClient">Confirmation de mot de passe <span class="require">*</span></label>
                                <input type="password" class="form-control" id="passwordConfirmationClient" placeholder="Confirmer votre mot de passe">
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <div class="col-sm-6">
										<p class="require">* Champ obligatoire</p>
                                    </div>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                    <input type="submit" class="btn btn-warning" id="sendClient" value="S'inscrire" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php //------------------------------------------------------------ ## Partner ## --------------------------------------------------------?>
        <div class="modal fade" id="partnerRegisterModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Inscription en tant que partenaire de diffusion</h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="form-horizontal" id="partnerRegister" role="form">
                            <div class="form-group">
                                <label for="emailPartner">Identifiant <span class="require">*</span></label>
                                <input type="email" class="form-control" id="emailPartner" placeholder="Insérez votre e-mail">
                            </div>
                            <div class="form-group">
                                <label for="companyPartner">Site web <span class="require">*</span></label>
                                <input type="text" class="form-control" id="urlPartner" placeholder="Insérez le lien de votre site web">
                            </div>
                            <div class="form-group">
                                <label for="passwordPartner">Mot de passe <span class="require">*</span></label>
                                <input type="password" class="form-control" id="passwordPartner" placeholder="Insérez votre mot de passe">
                            </div>
                            <div class="form-group">
                                <label for="passwordConfirmationPartner">Confirmation de mot de passe <span class="require">*</span></label>
                                <input type="password" class="form-control" id="passwordConfirmationPartner" placeholder="Confirmez votre mot de passe">
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <div class="col-sm-6">
										<p class="require">* Champ obligatoire</p>
                                    </div>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                    <input type="submit" class="btn btn-warning" id="sendPartner" value="S'inscrire" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
           
        <script src="js/jquery.js"></script>
        <script src="js/notify.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/main.js"></script>
        <script src="js/login.js"></script>
    </body>
</html>