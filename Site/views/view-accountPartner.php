<!DOCTYPE html>
<html>

    <head>
        <?php require '/views/view-head.php'; ?>
        <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>
    </head>

<body>
    <?php require '/views/view-header.php'; ?>
        <section class="container">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group col-sm-12">
                    <h2 class="modal-title">[Informations personnelles]</h2>
                </div>  
                <div class="form-group col-sm-12">
                    <label class="col-sm-4 " for="emailRegister">Identifiant : </label>
                    <p id="emailValue" class="col-sm-3 col-sm-offset-4" ><?php echo $_SESSION['account']->Email(); ?></p>
                </div>
                 <div class="form-group col-sm-12">
                    <label class="col-sm-4 " for="urlRegister">Site web : </label>
                    <p id="urlValue" class="col-sm-3 col-sm-offset-4" ><?php echo $_SESSION['partner']->Url(); ?></p>
                </div>
                <div class="form-group col-sm-12">
                    <label class="col-sm-4 " for="urlRegister">Inscrit depuis le </label>
                    <p id="dateRegister" class="col-sm-3 col-sm-offset-4"><?php echo $_SESSION['partner']->DateRegister(); ?></p>
                </div>
                <div class="form-group col-sm-12 center">
                    <button class="btn btn-warning" id="btn-modifierInfo" data-toggle="modal" data-target="#informationModal">Modifier</button>
                    <button class="btn btn-warning" id="btn-modifierPassword" data-toggle="modal" data-target="#passwordModal">Modifier le mot de passe</button>
                </div>
                <div class="form-group col-sm-12 rss">
                    <pre><b>Flux RSS :</b>  <span id="rss">http://megacasting.local/rss.php</span>  <button class="btn btn-default" id="copy" data-clipboard-target="#rss">Copier</button></pre>
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
                                <label for="email" class="col-sm-3 control-label">Email : <span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="email" value="<?php //echo $_SESSION['partner']->Email(); ?>" placeholder="Email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-sm-3 control-label">Site web : </label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" id="url" value="<?php //echo $_SESSION['partner']->Url(); ?>" placeholder="Site web"/>
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
                                    <input type="password" class="form-control" id="oldPassword" placeholder="Ancien mot de passe"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new password" class="col-sm-4 control-label">Nouveau mot de passe : <span class="require">*</span></label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="newPassword" placeholder="Nouveau mot de passe" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirmation password" class="col-sm-4 control-label">Confirmation de mot de passe : <span class="require">*</span></label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="passwordConfirmation" placeholder="confirmation Mot de passe "/>
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
    
        <script src="js/jquery.js"></script>
        <script src="js/notify.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/accountPartner.js"></script>
        <script src="js/main.js"></script>
        <script>
            (function(){
              new Clipboard('#copy');
            })();
        </script>
    </body>
</html>