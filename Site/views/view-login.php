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
                    <form action="login.php" method="POST" class="form-horizontal" id="connection" role="form">
                        <div class="form-group">
                            <!--Teste si le tableau d'erreurs existe-->
                                <legend>[Connexion]</legend>
                        </div>
                        <div class="form-group">
                            <label for="emailConnection">Identifiant</label>
                            <input type="email" class="form-control" id="emailConnection" name="email" placeholder="Insérer votre e-mail">
                        </div>
                        <div class="form-group">
                            <label for="passwordConnection">Mot de passe</label>
                            <input type="password" class="form-control" id="passwordConnection" name="password" placeholder="Insérer votre mot de passe">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <input type="submit" class="btn btn-warning" style="width: 100px" id="sendConnection" value="Connexion" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <form action="login.php" method="POST" class="form-horizontal" id="register" role="form">
                        <div class="form-group">
                                <legend>[Inscription]</legend>
                        </div>
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
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <input type="submit" class="btn btn-warning" style="width: 100px" id="sendRegister" value="S'inscrire" />
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