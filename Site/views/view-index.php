<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
    <head>
        <?php require '/views/view-head.php'; ?>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <!-- Elément Google Maps indiquant que la carte doit être affiché en plein écran et qu'elle ne peut pas être redimensionnée par l'utilisateur -->
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?"></script>
        
    </head>
    
    <body onload="InitializeMoreDetails()">
        <?php require '/views/view-header.php'; ?>
        
        <section class="container">
            <table class="table" id="offers">
                <thead>
                    <tr>
                        <th>Ref.</th>
                        <th>Offre</th>
                        <th>Ville</th>
                        <th>Contrat</th>
                        <th>Nb. places</th>
                        <th>Société</th>
                    </tr>
                </thead>
                
                <tbody>
<?php               if(isset($offerList))
                    {
                        foreach($offerList as $key => $offer)
                        { 
                            $active= '';
                            if (isset($_GET['offer']) && $_GET['offer'] == $offer->Identifier())
                                $active= 'active';
                            ?>
                            <tr class="offer <?php echo $active; ?>" id="offer<?php echo $offer->Identifier(); ?>">
                                <td><?php echo $offer->Reference(); ?></td>
                                <td><?php echo $offer->Title(); ?></td>
                                <td><?php echo $offer->City(); ?></td>
                                <td><?php echo $offer->TypeOfContract()->Label(); ?></td>
                                <td><?php echo $offer->JobQuantity(); ?></td>
                                <td><?php echo $offer->Client()->Company(); ?></td>
                            </tr>
<?php                       if (isset($_GET['offer']) && $_GET['offer'] == $offer->Identifier())
                            { ?>
                               <tr id="optionButtons" class="toSelect">
                                   <td colspan="6">
                                       <div class="btn-group" role="group">
                                           <button class="btn btn-warning btn-lg" id="moreDetails">Plus de détails</button><button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#postulateModal" id="postulate">Postuler</button>
                                        </div>
                                    </td>
                                </tr>
<?php                       }
                        }
                    }
                    else
                    { ?>
                        <tr class="warning"><td colspan="6">Aucune offre n'est disponible</td></tr>
<?php               }?>
                </tbody>
            </table>
        </section>
        
        <div class="modal fade" id="postulateModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Postuler</h4>
                    </div>
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="idOffer" id="idOffer"/>
                            <div class="form-group">
                                <label for="firstname" class="col-sm-3 control-label">Prénom <span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="col-sm-3 control-label">Nom <span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">E-mail <span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber" class="col-sm-3 control-label">N° Téléphone <span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="N° Téléphone"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-3 control-label">Adresse <span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Adresse postale"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-sm-3 control-label">Ville <span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Ville"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="zipCode" class="col-sm-3 control-label">Code postal <span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="Code postal"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="letter" class="col-sm-3 control-label">Lettre de motivation</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="letter" name="letter"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cv" class="col-sm-3 control-label">CV <span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="cv" name="cv"/>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <div class="form-group">
                                    <div class="col-sm-6">
										<p class="require">* Champ obligatoire</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                        <button type="submit" name="sendPost" class="btn btn-warning">Postuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Description</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    <b>Société :</b>
                                    <span id="company"></span>
                                </p>
                                <p>
                                    <b>Titre :</b>
                                    <span id="title"></span>
                                </p>
                                <p>
                                    <b>Référence :</b>
                                    <span id="reference"></span>
                                </p>
                                <p>
                                    <b>Type de contract :</b>
                                    <span id="typeOfContract"></span>
                                </p>
                                <p>
                                    <b>Adresse :</b>
                                    <span id="address"></span>
                                </p>
                                <p>
                                    <b>Ville :</b>
                                    <span id="city"></span>
                                </p>
                                <p>
                                    <b>Code postal :</b>
                                    <span id="zipCode"></span>
                                </p>
                                <p>
                                    <b>Date de début du contrat :</b>
                                    <span id="dateStartContract"></span>
                                </p>
                                <p>
                                    <b>Nombre de place(s) :</b>
                                    <span id="jobQuantity"></span>
                                </p>
                                <p>
                                    <b>Description du poste :</b>
                                    <span id="jobDescription"></span>
                                </p>
                                <p>
                                    <b>Description du profile :</b>
                                    <span id="profileDescription"></span>
                                </p>
                            </div>
                            
                            <div id="mapContainer"class="col-sm-6" >
                                
                                <div id="map"></div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="/js/jquery.js"></script>
        <script src="/js/notify.js"></script>
        <script src="/js/bootstrap.js"></script>
        <script src="/js/main.js"></script>
        <script src="/js/index.js"></script>
    </body>
</html>