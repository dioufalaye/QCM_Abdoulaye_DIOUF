<?php
session_start();
$bd=file_get_contents("asset/json/base.json");
$contenu=json_decode($bd,true);
if (isset($_POST['val'])) {
 	for ($i=0; $i < count($contenu) ; $i++) { 
 		if (isset($contenu[$i])) {
 			if ($_POST['log'] == $contenu[$i]['login'] && $_POST['pass']==$contenu[$i]['password']){
 				if ($contenu[$i]['role'] == "admin" )  {
 					$_SESSION['user'] =$contenu[$i];
 					header('location:liste_quest.php');
 				}
 				else{
 				$_SESSION['user'] =$contenu[$i];
 				header('location:interface_joueur.php');
 				}
 			}
 			else{
 				$error='erreur';
 			}
 		}
 	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title> page de connexion </title>
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
</head>
<body>
	<div class="contener">
		<div class="haut">
			<div> <img class="img1" src="asset/img/Images/logo-QuizzSA.png"></div>
			<div> <center><h2 class="text1"> Le plaisir de jouer</h2> </center></div>
		</div>
		<div class="form">

			<div class="login_form">
				<h5 class="log_form"> Login Form </h5>
			</div>
			<div>
				<form method="POST" enctype="multipart/form-data">
					<input type="text" name="log" placeholder="Login" required>
					<img class="icone1" src="asset/img/Images/Icones/ic-login.png">
					<input type="password" name="pass" placeholder="password" required>
					<img class="icone2" src="asset/img/Images/Icones/ic-password.png">
					<button type="submit" name="val"> Connexion</button>
					<h6 class="inscrire"><a href="#"> S'inscrire pour jouer? </a></h6>
				</form>
			</div>
			</div>
			<div class="error">
			<?php if (isset($error)){
				?>
				<P>login ou mot de passe incorrecte!</p>
				<?php
			} ?>
			</div>
		</div>
		

	</div>
</body>
</html>
