<nav id="menu" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <h1><a href="/">MegaCasting</a></h1>
            <div id="icon">
                <a href="/"><img src="/pictures/icon.png" class="img-responsive" alt="MegaCasting"/></a>
            </div>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#responsiveMenu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse" id="responsiveMenu">
<?php		if (isset($_SESSION['account']))
			{ 
                if (get_class($_SESSION['account']) == 'Client')
                { ?>
                <p id="account"><?php echo $_SESSION['account']->Company(); ?></p>
                <ul class="nav navbar-nav">
                    <li><a <?php Selected('index');   ?> href="/">Accueil</a></li>
                    <li><a <?php Selected('account'); ?> href="account.php">Mon compte</a></li>
                    <li><a <?php Selected('offers');  ?> href="offers.php">Mes offres <span class="label label-warning"><?php echo $numberOfferClient; ?></span></a></li>
                    <li><a <?php Selected('logout');  ?> href="logout.php">Déconnexion</a></li>
                </ul>
<?php		     }
			     else if(get_class($_SESSION['account']) == 'Partner')
			     { ?>
                <ul class="nav navbar-nav">
                    <li><a <?php Selected('index');   ?> href="/">Accueil</a></li>
                    <li><a <?php Selected('account'); ?> href="account.php">Mon compte</a></li>
                    <li><a <?php Selected('logout');  ?> href="logout.php">Déconnexion</a></li>
                </ul>
<?php		    }  
                else
                { ?>
                <ul class="nav navbar-nav">
                    <li><a <?php Selected('index'); ?> href="/">Accueil</a></li>
                    <li><a <?php Selected('login'); ?> href="login.php">Se connecter ou s'inscrire</a></li>
                </ul>
<?php		   }
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