<!DOCTYPE html>
<html>

<head>
    <?php require '/views/view-head.php'; ?>
</head>

<body>
    <?php require '/views/view-header.php'; ?>
        <section class="container">
                <div class="col-sm-6 col-sm-offset-3" id="div_modification">
                    <form action="account.php" method="POST" class="form-horizontal" role="form">
                        <div class="form-group">
                            <?php if(isset($errorRegister)){echo $errorRegister;} ?>
                                <legend>[Informations]</legend>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 " for="companyRegister">Société : </label>
                            <b     class="col-sm-3 col-sm-offset-1" ><?php echo $_SESSION['account']->Company(); ?></b>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 " for="emailRegister">Identifiant : </label>
                            <b     class="col-sm-3 col-sm-offset-1" ><?php echo $_SESSION['account']->Email(); ?></b>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 " for="phoneNumberRegister">N° de téléphone : </label>
                            <b     class="col-sm-3 col-sm-offset-1" ><?php echo $_SESSION['account']->PhoneNumber(); ?></b>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 " for="faxRegister">N° de Fax : </label>
                            <b     class="col-sm-3 col-sm-offset-1" ><?php echo $_SESSION['account']->Fax(); ?></b>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 " for="addressRegister">Adresse : </label>
                            <b     class="col-sm-3 col-sm-offset-1" ><?php echo $_SESSION['account']->Address(); ?></b>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 " for="cityRegister">Ville : </label>
                            <b     class="col-sm-3 col-sm-offset-1" ><?php echo $_SESSION['account']->City(); ?></b>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 " for="zipCodeRegister">Code postal : </label>
                            <b     class="col-sm-3 col-sm-offset-1" ><?php echo $_SESSION['account']->ZipCode(); ?></b>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-1 col-sm-offset-5">
                                <input type="submit" class="btn btn-warning" style="width: 100px" name="sendRegister" value="Modifier" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
</body>

</html>