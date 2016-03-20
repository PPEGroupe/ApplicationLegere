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
                    <form action="login.php" method="POST" class="form-horizontal" role="form">
                        <div class="form-group">
                            <?php if(isset($errorConnection)){echo $errorConnection ;} ?>
                                <legend>[Connexion]</legend>
                        </div>
                        <div class="form-group">
                            <label for="emailConnection">Identifiant</label>
                            <input type="email" class="form-control" id="emailConnection" name="emailConnection" placeholder="Insérer votre e-mail">
                        </div>
                        <div class="form-group">
                            <label for="passwordConnection">Mot de passe</label>
                            <input type="password" class="form-control" id="passwordConnection" name="passwordConnection" placeholder="Insérer votre mot de passe">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <input type="submit" class="btn btn-warning" style="width: 100px" name="sendConnection" value="Connexion" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <form action="login.php" method="POST" class="form-horizontal" role="form">
                        <div class="form-group">
                            <?php if(isset($errorRegister)){echo $errorRegister;} ?>
                                <legend>[Inscription]</legend>
                        </div>
                        <div class="form-group">
                            <label for="companyRegister">Société</label>
                            <input type="text" class="form-control" id="companyRegister" name="companyRegister" placeholder="Renseignez votre société">
                        </div>
                        <div class="form-group">
                            <label for="emailRegister">Identifiant</label>
                            <input type="email" class="form-control" id="emailRegister" name="emailRegister" placeholder="Insérer votre e-mail">
                        </div>
                        <div class="form-group">
                            <label for="passwordRegister">Mot de passe</label>
                            <input type="password" class="form-control" id="passwordRegister" name="passwordRegister" placeholder="Insérer votre mot de passe">
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirmationRegister">Confirmation de mot de passe</label>
                            <input type="password" class="form-control" id="passwordConfirmationRegister" name="passwordConfirmationRegister" placeholder="Confirmer votre mot de passe">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <input type="submit" class="btn btn-warning" style="width: 100px" name="sendRegister" value="S'inscrire" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
</body>

</html>