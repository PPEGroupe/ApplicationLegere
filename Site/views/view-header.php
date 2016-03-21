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
			<div class="col-sm-9">
				<nav>
					<ul>
						<li><a <?php Selected('index'); ?> href="/">Accueil</a></li>
<?php					if (isset($_SESSION['account']))
						{ ?>
							<li><a <?php Selected('account'); ?> href="account.php">Mon compte</a></li>
							<li><a <?php Selected('offers'); ?> href="offers.php">Mes offres <span class="label label-warning"><?php echo count($_SESSION['account']->OfferList()); ?></span></a></li>
							<li style="padding: 0 10px"><b><?php echo $_SESSION['account']->Company(); ?></b></li>
<?php					}
						else
						{ ?>
							<li><a <?php Selected('login'); ?> href="login.php">Se connecter ou s'inscrire</a></li>
<?php					} ?>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</header>