<!DOCTYPE html>
<html>
    <head>
        <?php require 'views/view-head.php'; ?>
    </head>

    <body>
        <?php require 'views/view-header.php'; ?>
        <section class="container">
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

                <tbody>
<?php				if (!empty($postList))
					{
						foreach($postList as $post)
						{ ?>
							<tr>
								<td><?php echo $post->WebUser($db)->Firstname(); ?></td>
								<td><?php echo $post->WebUser($db)->Lastname(); ?></td>
								<td><?php echo $post->WebUser($db)->Address(); ?></td>
								<td><?php echo $post->WebUser($db)->City(); ?></td>
								<td><?php echo $post->WebUser($db)->PhoneNumber(); ?></td>
								<td><?php echo $post->WebUser($db)->Account($db)->Email(); ?></td>
								<td><?php echo $post->DatePost(); ?></td>
							</tr>
<?php					}
					}
                    else
                    { ?>
                        <tr class="warning"><td colspan="7">Aucune candidature n'a été trouvée</td></tr>
<?php				} ?>
				</tbody>
            </table>
        </section>
    
        <script src="js/jquery.js"></script>
        <script src="js/notify.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>