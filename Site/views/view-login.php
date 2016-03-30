<!DOCTYPE html>
<html>

<head>
    <?php require '/views/view-head.php'; ?>
</head>

<body>
    <?php require '/views/view-header.php'; ?>
        <section class="container">
            <div class="row">
                <div class="col-sm-6">
                    <form action="" method="POST" class="form-horizontal" id="connection" role="form">
                        <h2>[Connexion]</h2>
                        <div class="form-group">
                            <label for="emailConnection">Identifiant</label>
                            <input type="email" class="form-control" id="emailConnection" name="email" placeholder="Insérer votre e-mail">
                        </div>
                        <div class="form-group">
                            <label for="passwordConnection">Mot de passe</label>
                            <input type="password" class="form-control" id="passwordConnection" name="password" placeholder="Insérer votre mot de passe">
                        </div>
                        <div class="form-group center">
                            <div class="btn-group" role="group">
                                <input type="submit" class="btn btn-warning" id="sendConnectionClient" value="Connexion client" />
                                <input type="button" class="btn btn-warning" id="sendConnectionPartner" value="Connexion partenaire" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <form action="" method="POST" class="form-horizontal" id="register" role="form">
                        <h2>[Inscription]</h2>
                        <div class="form-group">
                            <label for="companyRegister">Société</label>
                            <input type="text" class="form-control" id="companyRegister" name="company" placeholder="Renseignez votre société">
                        </div>
                        <div class="form-group">
                            <label for="emailRegister">Identifiant</label>
                            <input type="email" class="form-control" id="emailRegister" name="email" placeholder="Insérer votre e-mail">
                        </div>
                        <div class="form-group">
                            <label for="passwordRegister">Mot de passe</label>
                            <input type="password" class="form-control" id="passwordRegister" name="password" placeholder="Insérer votre mot de passe">
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirmationRegister">Confirmation de mot de passe</label>
                            <input type="password" class="form-control" id="passwordConfirmationRegister" name="passwordConfirmation" placeholder="Confirmer votre mot de passe">
                        </div>
                        <div class="form-group center">
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-warning" id="sendRegister" value="S'inscrire" />
                            </div>
                        </div>
                    </form>
                    <section></section>
                </div>
            </div>
            <script src="/js/jquery.js"></script>
            <script src="/js/notify.js"></script>
            <script src="/js/bootstrap.js"></script>
            <script src="/js/main.js"></script>
            <script src="/js/login.js"></script>
        </section>
</body>

</html>