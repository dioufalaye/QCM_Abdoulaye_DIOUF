<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> acceuil admin</title>
    <link rel="stylesheet" type="text/css" href="cssaccueil.css">
</head>
<body>
<div class="content">
	<div class="divhaut"> 
	</div>
	<div class="formul">
		<div>
			<div>
				<div> <h1> <?php echo $_SESSION['prenom']." " .$_SESSION['nom'];?><img src="$_SESSION['image']"> </h1></div>
			</div>
		</div>
	</div>
</div>
</body>
</html>