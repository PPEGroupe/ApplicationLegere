<!DOCTYPE html>
<html>
    <head>
        <?php require '/views/view-head.php'; ?>
    </head>
    
    <body>
        <?php require '/views/view-header.php'; ?>
        
        <section class="container">
            <table class="table table-striped" id="offers">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Offre</th>
                        <th>Référence</th>
                        <th>Ville</th>
                    </tr>
                </thead>
                
                <tbody>
<?php               if(isset($offerList))
                    {
                        $i = 1;
                        foreach($offerList as $key => $offer)
                        { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $offer->Title(); ?></td>
                                <td><?php echo $offer->Reference(); ?></td>
                                <td><?php echo $offer->City(); ?></td>
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
    </body>
</html>