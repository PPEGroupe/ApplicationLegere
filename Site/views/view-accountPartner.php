<!DOCTYPE html>
<html>

    <head>
        <?php require '/views/view-head.php'; ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        
    </head>

<body>
    <?php require '/views/view-header.php'; ?>
        <section class="container">
            <div class="col-sm-6 col-sm-offset-3" id="div_modification">
                <div class="form-group col-sm-12">
                    <label class="col-sm-4 " for="emailRegister">Identifiant : </label>
                    <p class="col-sm-3 col-sm-offset-4" ><?php echo $_SESSION['account']->Email(); ?></p>
                </div>
                 <div class="form-group col-sm-12">
                    <label class="col-sm-4 " for="urlRegister">Site web : </label>
                    <p class="col-sm-3 col-sm-offset-4" ><?php echo $_SESSION['account']->Url(); ?></p>
                </div>
                <div class="form-group col-sm-12 center">
                    <div class="btn-group" role="group">
                        <button class="btn btn-warning" id="btn-modifierInfo" data-toggle="modal" data-target="#informationModal">Modifier</button>
                        <button class="btn btn-warning" id="btn-modifierPassword" data-toggle="modal" data-target="#passwordModal">Modifier le mot de passe</button>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="modal fade" id="informationModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modifier</h4>
                    </div>
                    <form action="" method="post" class="form-horizontal">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Identifiant : <span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="emailRegister" name="emailRegister" value="<?php echo $_SESSION['account']->Email(); ?>" placeholder="Identifiant" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-sm-3 control-label">Site web : </label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" id="urlRegister" name="urlRegister" value="<?php echo $_SESSION['account']->Url(); ?>" placeholder="Site web"/>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <div class="form-group">
                                    <div class="col-sm-6">
										<p class="require">* Champ obligatoire</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                        <button type="submit" name="sendPostInfo" class="btn btn-warning">valider</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
        
        <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><u>[Modification de mot de passe]</u></h4>
                    </div>
                    <form action="" method="post" class="form-horizontal">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="old password" class="col-sm-4 control-label">Ancien mot de passe : <span class="require">*</span></label>
                                <div class="col-sm-8 ">
                                    <input type="password" class="form-control" id="oldPasswordRegister" name="oldPasswordRegister" placeholder="Ancien mot de passe"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new password" class="col-sm-4 control-label">Nouveau mot de passe : <span class="require">*</span></label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="newPasswordRegister" name="newPasswordRegister"  placeholder="Nouveau mot de passe" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirmation password" class="col-sm-4 control-label">Confirmation de mot de passe : <span class="require">*</span></label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="passwordConfirmationRegister" name="passwordConfirmationRegister" placeholder="confirmation Mot de passe "/>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <div class="form-group">
                                    <div class="col-sm-6">
										<p class="require">* Champ obligatoire</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                        <button type="submit" name="sendPostPassword" class="btn btn-warning">valider</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    
        <script src="/js/jquery.js"></script>
        <script src="/js/notify.js"></script>
        <script src="/js/bootstrap.js"></script>
        <script src="/js/account.js"></script>
        <script src="/js/main.js"></script>
    </body>
</html>