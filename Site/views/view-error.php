<!DOCTYPE html>
<html>
    <head>
        <?php require 'views/view-head.php'; ?>
    </head>
    
    <body>
        <?php require 'views/view-header.php'; ?>
        
        <section class="container">
			<div class="jumbotron">
				<h2><span class="label label-warning"><?php echo $errorTitle; ?></span></h2>
				<hr />
				<p><?php echo $errorDescription; ?></p>
			</div>
		</section>
	</body>
</html>