<!DOCTYPE html>
<html>

    <head>
        <?php require '/views/view-head.php'; ?>
    </head>

    <body>
        <?php require '/views/view-header.php'; ?>
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

                <tbody></tbody>
            </table>
        </section>
    
        <script src="/js/jquery.js"></script>
        <script src="/js/notify.js"></script>
        <script src="/js/bootstrap.js"></script>
        <script src="/js/main.js"></script>
    </body>
</html>