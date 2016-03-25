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
                                <td class="hidden"><?php echo $postManager->CountByOffer($offer->Identifier()); ?></td>
                            </tr>
<?php                   }
                    }
                    else
                    { ?>
                        <tr class="warning"><td colspan="5">Aucune offre n'a été trouvée</td></tr>
<?php               }?>
                </tbody>
            </table>
        </section>
        
        <div class="modal fade" id="postsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Candidatures</h3>
                    </div>
                    <div class="modal-body">
                        <table class="table" id="posts">
                            <thead>
                                <tr>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Ville</th>
                                    <th>N° Téléphone</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="modal fade" id="postDetailsModal" tabindex="1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Candidature</h3>
                    </div>
                    <div class="modal-body">
					</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="/js/jquery.js"></script>
        <script src="/js/notify.js"></script>
        <script src="/js/bootstrap.js"></script>
        <script src="/js/main.js"></script>
        <script src="/js/offers.js"></script>
    </body>
</html>