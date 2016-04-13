<!DOCTYPE html>
<html>

    <head>
        <?php require '/views/view-head.php'; ?>
    </head>

    <body>
        <?php require '/views/view-header.php'; ?>
        <section class="container">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group col-sm-12">
                    <h2 class="modal-title">[Informations personnelles]</h2>
                </div>    
                <div class="form-group col-sm-12">
                    <label class="col-sm-4" for="companyValue">Société</label>
                    <p     class="col-sm-5 col-sm-offset-1" id="companyValue"><?php echo $client->Company(); ?></p>
                </div>
                <div class="form-group col-sm-12">
                    <label class="col-sm-4" for="emailValue">Identifiant</label>
                    <p     class="col-sm-5 col-sm-offset-1" id="emailValue" ><?php echo $account->Email(); ?></p>
                </div>
                <div class="form-group col-sm-12">
                    <label class="col-sm-4" for="phoneNumberValue">N° de téléphone</label>
                    <p     class="col-sm-5 col-sm-offset-1" id="phoneNumberValue"><?php echo $client->PhoneNumber(); ?></p>
                </div>
                <div class="form-group col-sm-12">
                    <label class="col-sm-4" for="faxValue">N° de Fax</label>
                    <p     class="col-sm-5 col-sm-offset-1"  id="faxValue"><?php echo $client->Fax(); ?></p>
                </div>
                <div class="form-group col-sm-12">
                    <label class="col-sm-4" for="addressValue">Adresse</label>
                    <p     class="col-sm-5 col-sm-offset-1" id="addressValue" ><?php echo $client->Address(); ?></p>
                </div>
                <div class="form-group col-sm-12">
                    <label class="col-sm-4" for="cityValue">Ville</label>
                    <p     class="col-sm-5 col-sm-offset-1" id="cityValue"><?php echo $client->City(); ?></p>
                </div>
                <div class="form-group col-sm-12">
                    <label class="col-sm-4" for="zipCodeValue">Code postal</label>
                    <p     class="col-sm-5 col-sm-offset-1" id="zipCodeValue"><?php echo $client->ZipCode(); ?></p>
                </div>
                 <div class="form-group col-sm-12">
                     <p id="dateRegister"><?php echo 'Inscrit depuis le ', date('d/m/Y', strtotime($client->DateRegister())); ?></p>
                </div>

               <div class="btn-group col-sm-12" role="group">
                   <div class="form-group center">
                       <button class="btn btn-warning" data-toggle="modal" data-target="#informationModal">Modifier</button>

                       <button class="btn btn-warning" data-toggle="modal" data-target="#passwordModal">Modifier le mot de passe</button>
                   </div>
                </div>
            </div>
        </section>
            
        
        <div class="modal fade" id="informationModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><u>[Modification des informations]</u></h4>
                    </div>
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="company" class="col-sm-3 control-label">Société<span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="company" name="company" value="<?php echo $client->Company(); ?>"  placeholder="Société"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Identifiant<span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $account->Email(); ?>" placeholder="Email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber" class="col-sm-3 control-label">N° de téléphone</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $client->PhoneNumber(); ?>"   placeholder="téléphone"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="zipCod" class="col-sm-3 control-label">N° de Fax</label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" id="fax" name="fax" value="<?php echo $client->Fax(); ?>" placeholder="Fax"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-sm-3 control-label">Site web</label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" id="url" name="url" value="<?php echo $client->Url(); ?>" placeholder="Site web"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-3 control-label">Adresse</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $client->Address(); ?>" placeholder="Adresse"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-sm-3 control-label">Ville</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $client->City(); ?>" placeholder="Ville"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="zipCode" class="col-sm-3 control-label">Code postal</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="zipCode" name="zipCode" value="<?php echo $client->ZipCode(); ?>" placeholder="Code postal"/>
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
                                <label for="old password" class="col-sm-4 control-label">Ancien mot de passe<span class="require">*</span></label>
                                <div class="col-sm-8 ">
                                    <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Ancien mot de passe"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new password" class="col-sm-4 control-label">Nouveau mot de passe<span class="require">*</span></label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="newPassword" name="newPassword"  placeholder="Nouveau mot de passe" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirmation password" class="col-sm-4 control-label">Confirmation de mot de passe<span class="require">*</span></label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation" placeholder="confirmation Mot de passe "/>
                                </div>
                            </div>
                            
                            
                            <div class="modal-footer">
                                <div class="form-group">
                                    <div class="col-sm-6">
										<p class="require">* Champ obligatoire</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-warning" name="sendPostPassword">valider</button>
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
        <script src="js/accountClient.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>