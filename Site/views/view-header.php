<nav id="menu" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <h1><a href="/">MegaCasting</a></h1>
            <div id="icon">
                <a href="/"><img src="pictures/icon.png" class="img-responsive" alt="MegaCasting"/></a>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#responsiveMenu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse" id="responsiveMenu">
<?php		if (isset($_SESSION['account']) && isset($_SESSION['connected']))
			{
                if ($_SESSION['connected'] == 'client')
                { ?>
                <p id="account"><?php echo $_SESSION['client']->Company(); ?></p>
                <ul class="nav navbar-nav">
                    <li><a href="/" <?php Selected('index');   ?> href="/">Accueil</a></li>
                    <li class="dropdown">
                        <a href="#" class="<?php SelectedWithoutClass('account'); ?>dropdown-toggle" data-toggle="dropdown">Mon compte <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="account.php" tabindex="-1" class="optionMenu">Mon compte</a></li>
                            
<?php		                if (isset($_SESSION['partner']) && $_SESSION['partner'] != null) 
                            { ?>
                                <li id="changeToPartner" class="action optionMenu">Se connecter en tant que partenaire</li>
<?php		                }
                            if (isset($_SESSION['webUser']) && $_SESSION['webUser'] != null) 
                            { ?>
                                <li id="changeToWebUser" class="action optionMenu">Se connecter en tant qu'utilisateur</li>
<?php		                } ?>
                        </ul>
                    </li>
                    <li><a <?php Selected('offers');  ?> href="offers.php">Mes offres <span class="label label-warning"><?php echo $numberOfferClient; ?></span></a></li>
                    <li><a <?php Selected('logout');  ?> href="logout.php">Déconnexion</a></li>
                </ul>
<?php		    }
			    else if ($_SESSION['connected'] == 'partner')
			    { ?>
                <ul class="nav navbar-nav">
                    <li><a <?php Selected('index');   ?> href="/">Accueil</a></li>
                    <li class="dropdown">
                        <a href="#" class="<?php SelectedWithoutClass('account'); ?>dropdown-toggle" data-toggle="dropdown">Mon compte <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1">Mon compte</a></li>
                            <li role="separator" class="divider"></li>
<?php		                if (isset($_SESSION['partner']) && $_SESSION['client'] != null) 
                            { ?>
                                <li id="changeToClient" class="action optionMenu">Se connecter en tant qu'entreprise</li>
<?php		                }
                            if (isset($_SESSION['webUser']) && $_SESSION['webUser'] != null) 
                            { ?>
                                <li id="changeToWebUser" class="action optionMenu">Se connecter en tant qu'utilisateur</li>
<?php		                } ?>
                        </ul>
                    </li>
                    <li><a <?php Selected('logout');  ?> href="logout.php">Déconnexion</a></li>
                </ul>
<?php		    }  
                else if ($_SESSION['connected'] == 'webUser')
                { ?>
                <p id="account"><?php echo $_SESSION['webUser']->Firstname(), ' ', $_SESSION['webUser']->Lastname(); ?></p>
                <ul class="nav navbar-nav">
                    <li><a href="/" <?php Selected('index'); ?>>Accueil</a></li>
                    <li class="dropdown">
                        <a href="#" class="<?php SelectedWithoutClass('account'); ?>dropdown-toggle" data-toggle="dropdown">Mon compte <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="account.php" tabindex="-1" class="optionMenu">Mon compte</a></li>
                            <li role="separator" class="divider"></li>
<?php		                if (isset($_SESSION['client']) && $_SESSION['client'] != null) 
                            { ?>
                                <li id="changeToClient" class="action optionMenu">Se connecter en tant qu'entreprise</li>
<?php		                }
                            if (isset($_SESSION['partner']) && $_SESSION['partner'] != null) 
                            { ?>
                                <li id="changeToParter" class="action optionMenu">Se connecter en tant que partenaire</li>
<?php		                } ?>
                        </ul>
                    </li>
                    <li><a <?php Selected('posts'); ?> href="posts.php">Mes candidatures <span class="label label-warning"><?php echo $numberPostWebUser; ?></span></a></li>
                    <li><a <?php Selected('logout'); ?> href="logout.php">Déconnexion</a></li>
                </ul>
<?php		    }
            }
			else
			{ ?>
            <ul class="nav navbar-nav">
                <li><a <?php Selected('index'); ?> href="/">Accueil</a></li>
                <li><a <?php Selected('login'); ?> href="login.php">Se connecter ou s'inscrire</a></li>
            </ul>
<?php		} ?>
        </div>
    </div>
</nav>