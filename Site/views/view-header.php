<header>
	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<h1><a href="/">MegaCasting</a></h1>
				</div>
				
				<div class="col-sm-3">
					<div id="icon">
						<a href="/"><img src="/pictures/icon.png" class="img-responsive" alt="MegaCasting"/></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container nav">
		<div class="row">
<?php		if (isset($_SESSION['account']))
			{ ?>
				<div class="col-sm-3">
					<p id="account"><b><?php echo $_SESSION['account']->Company(); ?></b></li>
				</div>
				
				<div class="col-sm-7">
					<nav>
						<ul>
							<li><a <?php Selected('index');   ?> href="/">Accueil</a></li>
							<li><a <?php Selected('account'); ?> href="account.php">Mon compte</a></li>
							<li><a <?php Selected('offers');  ?> href="offers.php">Mes offres <span class="label label-warning"><?php echo $numberOfferClient; ?></span></a></li>
							<li><a <?php Selected('logout');  ?> href="logout.php">Déconnexion</a></li>
						</ul>
					</nav>
				</div>
<?php		}
			else
			{ ?>
			<div class="col-sm-10">
				<nav>
					<ul>
						<li><a <?php Selected('index'); ?> href="/">Accueil</a></li>
						<li><a <?php Selected('login'); ?> href="login.php">Se connecter ou s'inscrire</a></li>
					</ul>
				</nav>
			</div>
<?php		} ?>
		</div>
	</div>
</header>