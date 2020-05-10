<?php
session_start();
	if (!isset($_SESSION['user']['login'])) 
	{
		header('location:../index.php');
		exit();
	}
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<title> interface Gamer </title>
	<link rel="stylesheet" type="text/css" href="../asset/css/style2.css">
	<style>
	.score
		{
			border: solid 2px blueviolet;
			width: 50%;
			background-color: blue;

    	}
</style>
</head>
<body>
	<div class="contener">
		<div class="haut">
			<div> <img class="img1" src="../asset/img/Images/logo-QuizzSA.png"></div>
			<div> <center><h2 class="text1"> Le plaisir de jouer</h2> </center></div>
		</div>
		<div class="bande">
			<div class="roundeImage">
						<img style=" width: 60px;height: 60px;border-radius: 50%;"src="../asset/img/<?php echo $_SESSION['user']['image'] ?>">
						<?php echo $_SESSION['user']['prenom'] ?><?php echo $_SESSION['user']['nom'] ?>
					</div>
			<div><center><h4 class="text2">BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ <br>JOUER ET TESTER VOTRE NIVEAU DE<br>CULTURE G&Eacute;N&Eacute;RALE</h4> </center> </div>
			<div style="float: right;margin-top: -40px"><button><a href="logout.php"> Deconnexion</a></button></div>
		</div>
		<div class="form">
			<div class="gamingzone">
				
				<?php  require_once('jouer.php') ?>
			</div>
			<div class="affichage">
				<button id="togg1" style="width: 30%;">Top Score</button>
				<button id="togg2" style="width: 30%;">Meilleur Score</button>
				<div id="d1">
					<p><?php if(!empty($_SESSION['SCOREBI'])){echo $_SESSION['SCOREBI'];}else {echo 0;} ?></p>
				</div>
				<div id="d2">
					<p>Meilleur Score</p>
					<?php
					 $messages = file_get_contents('../asset/json/score.json');
					 $messages = json_decode($messages, true);
					 $l=count($messages);
					 $temp=array();
					 
					
											
					 for ($i=0; $i < $l; $i++)
					  { 
						for ($j=0; $j <$i ; $j++)
						 { 
							if($messages[$i]['score']>$messages[$j]['score'])
							{
								$temp=$messages[$i];
								$messages[$i]=$messages[$j];
							   $messages[$j]=$temp;
							}
						}
					 }
					 
					 ?><tr>
					 <td class="score"><?php echo  $messages[0]['prenom'] ?></td><?php
					 ?><td class="score"><?php echo  $messages[0]['nom'] ;?></td><?php
					 ?><td class="score"><?php echo  $messages[0]['score']."points" ;?></tr><?php
					 ?><tr>
					 <td class="score"><?php echo  $messages[1]['prenom'] ?></td><?php
					 ?><td class="score"><?php echo  $messages[1]['nom'] ;?></td><?php
					 ?><td class="score"><?php echo  $messages[1]['score']."points" ;?></tr><?php
					 ?><tr>
					 <td class="score"><?php echo  $messages[2]['prenom'] ?></td><?php
					 ?><td class="score"><?php echo  $messages[2]['nom'] ;?></td><?php
					 ?><td class="score"><?php echo  $messages[2]['score']."points" ;?></tr><?php
					 ?>
					 <tr>
						<td class="score"><?php echo  $messages[3]['prenom'] ?></td>
						<td class="score"><?php echo  $messages[3]['nom'] ;?></td>
						<td class="score"><?php echo  $messages[3]['score']."points" ;?></td>
					</tr><?php
					 ?></tr>
					 <td class="score"><?php echo  $messages[4]['prenom'] ?></td><?php
					 ?><td class="score"><?php echo  $messages[4]['nom'] ;?></td><?php
					 ?><td class="score"><?php echo  $messages[4]['score']."points" ;?></tr><?php
					


					?>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
    let togg1 = document.getElementById("togg1");
    let togg2 = document.getElementById("togg2");
    let d1 = document.getElementById("d1");
    let d2 = document.getElementById("d2");
    togg1.addEventListener("click", () => {

        d2.style.display = "none";
        d1.style.display = "block";

    })
    togg2.addEventListener("click", () => {

        d2.style.display = "block";
        d1.style.display = "none";
    })
</script>
</html>



