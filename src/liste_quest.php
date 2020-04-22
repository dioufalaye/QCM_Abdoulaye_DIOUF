<?php
session_start();
if (!isset($_SESSION['user']['login'])) {
	header('location:../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title> liste questions </title>
	<link rel="stylesheet" type="text/css" href="../asset/css/style1.css">
</head>
<body>
	<div class="contener">
		<div class="haut">
			<div> <img class="img1" src="../asset/img/Images/logo-QuizzSA.png"></div>
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
						<img style=" width: 90px;height: 90px;border-radius: 50%; " src="../asset/img/<?php echo $_SESSION['user']['image'] ?>">
					</div>

					<div style="margin-left: 50%;color: white;font-size: 30px">
					<?php echo $_SESSION['user']['prenom'] ?>
					<br>
					<?php echo $_SESSION['user']['nom'] ?>
					</div>
				</div>
				<div class=menu>
					
					<a href="liste_quest.php?lien=1"><label class="i"><i class="d"></i>Liste Questions</label><img src="../asset/img/Icones/ic-liste-active.png" alt="" class="im"></a><br><br>
					
					<a href="liste_quest.php?lien=2"><label class="i"><i class="d"></i>Créer Admin</label><img src="../asset/img/Icones/ic-ajout.png" alt="" class="im"></a><br><br>
					
					<a href="liste_quest.php?lien=3"><label class="i"><i class="d"></i>Liste joueurs</label><img src="../asset/img/Icones/ic-liste.png" alt="" class="im"></a><br><br>
					
					<a href="liste_quest.php?lien=4"><label class="i"><i class="d"></i>Créer Questions</label><img src="../asset/img/Icones/ic-ajout.png" alt="" class="im"></a><br>
				</div>
			</div>
			<div class="form2">
			<?php
				if(isset($_GET['lien']))
				{
					$lien=$_GET['lien'];
					switch($lien)
					{
						case 1:{
							include('listeQuestion.php');
							break;
						}
						case 2:{
							include('addAdmin.php');
							break;
						}
						case 3:{
							include('gamerliste.php');
							break;
						}
						case 4:{
							include('question.php');
							break;
						}
						default:{
						include_once('gamerliste.php');
							break;}
						
							
					}

				}
				?>
			</div>
		</div>
	</div> 
</body>
</html>