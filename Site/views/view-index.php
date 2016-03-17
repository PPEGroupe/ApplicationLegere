<!DOCTYPE html>
<html>
    <head>
        <?php require '/views/view-head.php'; ?>
    </head>
    
    <body>
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
                        { ?>
                            <tr class="offer" id="offer<?php echo $offer->Identifier(); ?>">
                                <td><?php echo $offer->Reference(); ?></td>
                                <td><?php echo $offer->Title(); ?></td>
                                <td><?php echo $offer->City(); ?></td>
                                <td><?php echo $offer->TypeOfContract()->Label(); ?></td>
                                <td><?php echo $offer->JobQuantity(); ?></td>
                                <td><?php echo $offer->Client()->Company(); ?></td>
                            </tr>
<?php                   }
                    }
                    else
                    { ?>
                        <tr class="warning"><td colspan="4">Aucune offre n'est disponible</td></tr>
<?php               }?>
                </tbody>
            </table>
        </section>
        
        <div class="modal fade" id="postulateModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Postuler</h4>
                    </div>
                    <form action="" method="post" class="form-horizontal">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-3 control-label">Titre</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Titre">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="website" class="col-sm-3 control-label">Site Internet</label>
                                <div class="col-sm-9">
                                    <input type="url" class="form-control" id="website" name="website" placeholder="Site internet">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">E-mail</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber" class="col-sm-3 control-label">N° Téléphone</label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="N° Téléphone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fax" class="col-sm-3 control-label">Titre</label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" id="fax" name="fax" placeholder="Titre">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-3 control-label">Adresse</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="address" name="adress" placeholder="Adresse postale">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cv" class="col-sm-3 control-label">CV</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="file" name="file"/>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                        <button type="submit" name="send" class="btn btn-warning">Postuler</button>
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
        <script src="/js/main.js"></script>
    </body>
</html>