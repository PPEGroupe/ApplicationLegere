<!DOCTYPE html>
<html>
    <head>
        <?php require '/views/view-head.php'; ?>
    </head>
    
    <body>
        <?php require '/views/view-header.php'; ?>
        
        <section class="container">
			<div class="jumbotron">
				<p>Vous allez être redirigé vers la page d'accueil dans <span id="time">5</span> seconde<span id="plurial">s</span> ...</p>
				<hr />
				<h2 style="text-align: right"><span class="label label-warning">Au revoir !</span></h2>
			</div>
		</section>
		
        <script src="js/jquery.js"></script>
        <script src="js/main.js"></script>
		<script>
			var time;
			$(function() { 
				time = 5;
				
				function SetTime() {
					time--;
					$('#time').html(time);
					if (time <= 0) {
						window.location.href = '/';
					} else {
                        if (time <= 1) {
                            $('#plurial').html('');
                        }
						setTimeout(SetTime, 1000);
					}
				}
				
				setTimeout(SetTime, 1000);
			});
		</script>
	</body>
</html>