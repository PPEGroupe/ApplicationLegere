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
                        <tr class="warning"><td colspan="6">Aucune offre n'est disponible</td></tr>
<?php               }?>
                </tbody>
            </table>
        </section>