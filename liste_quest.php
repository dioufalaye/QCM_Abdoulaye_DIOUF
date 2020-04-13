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
	<link rel="stylesheet" type="text/css" href="asset/css/style1.css">
</head>
<body>
	<div class="contener">
		<div class="haut">
			<div> <img class="img1" src="asset/img/Images/logo-QuizzSA.png"></div>
			<div> <center><h2 class="text1"> Le plaisir de jouer</h2> </center></div>
		</div>
		<div class="bande">
			<div><center><h4 class="text2"> CREER ET PARAMERTER VOS QUIZZ</h4> </center> </div>
			<div style="float: right;margin-top: -5px"><button><a href="logout.php"> Deconnexion</a></button></div>
		</div>
		<div class="form">
			<div class="form1">
				<div class="profil">
					<div class="roundeImage">
						<img style=" width: 90px;height: 90px;border-radius: 50%; " src="asset/img/<?php echo $_SESSION['user']['image'] ?>">
					</div>

					<div style="margin-left: 50%;color: white;font-size: 30px">
					<?php echo $_SESSION['user']['prenom'] ?>
					<br>
					<?php echo $_SESSION['user']['nom'] ?>
					</div>
				</div>
				<div class=menu></div>
			</div>
			<div class="form2"></div>
		</div>
	</div>
</body>
</html>