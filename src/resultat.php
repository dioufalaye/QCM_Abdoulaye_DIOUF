<?php
session_start();
require('design.php');

?><div class='lelast' style=" position:absolute; top: 60px; left:30%;"><?php
$_SESSION['SCOREBI']=0;

foreach($_SESSION['tableaubi'] as $key=>$value)
{
    $_SESSION['SCOREBI']+=$_SESSION['donnee'][intval($value)]['nbr']; 
    
}
?><div style="background: blue;"><?php
echo "votre score est :".$_SESSION['SCOREBI']."<br>";
?>
</div><div style="background-color: lightgreen">

<?php

echo "les questions trouves sont<br>";

foreach($_SESSION['tableaubi'] as $key=>$value)
{
    echo  $_SESSION['donnee'][intval($value)]['question']; 
    echo' <br/>';
}echo '</div>';?>
<div style="background-color: red;">
<?php
echo "les questions faussées sont";
echo' </,>';
foreach($_SESSION['fauxsseReponse'] as $key=>$value)
{
    echo  $_SESSION['donnee'][intval($value)]['question']; 
    echo' </br>';
}
?>

</div>
<a href="interface_joueur.php"><button >Rejouer</button></a>
</div>;


  
