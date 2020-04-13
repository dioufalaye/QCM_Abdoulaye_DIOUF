<?php
session_start();
if (!isset($_SESSION['user']['login'])) {
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title> liste questions </title>
	<link rel="stylesheet" type="text/css" href="asset/css/style2.css">
</head>
<body>
	<div class="contener">
		<div class="haut">
			<div> <img class="img1" src="asset/img/Images/logo-QuizzSA.png"></div>
			<div> <center><h2 class="text1"> Le plaisir de jouer</h2> </center></div>
		</div>
		<div class="bande">
			<div class="roundeImage">
						<img style=" width: 60px;height: 60px;border-radius: 50%;"src="asset/img/<?php echo $_SESSION['user']['image'] ?>">
						<?php echo $_SESSION['user']['prenom'] ?><?php echo $_SESSION['user']['nom'] ?>
					</div>
			<div><center><h4 class="text2">BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ <br>JOUER ET TESTER VOTRE NIVEAU DE<br>CULTURE G&Eacute;N&Eacute;RALE</h4> </center> </div>
			<div style="float: right;margin-top: -40px"><button><a href="logout.php"> Deconnexion</a></button></div>
		</div>
		<div class="form"></div>
	</div>
</body>
</html>