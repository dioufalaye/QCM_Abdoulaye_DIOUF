<?php 
    if(isset($_POST['terminer']))
    {
        
        header('location:resultat.php');
        exit();
    
    }
    

    if(!isset($_SESSION['myscore']))
    {
        
        $_SESSION['myscore']=0;
    }
    if (empty($_SESSION['donnee'] )) {
        $_SESSION['j']=0;
        //nombre de question fixer par l'adminnnnnnn-------------------------
        $tab=file_get_contents('../asset/json/NbreQuestion.json');
        $tab=json_decode($tab, true);
        $_SESSION['nombreQuestion']=$tab['NumberOfQuestion'];


        //listedes question decodee----------------------------------------------    
        $messages = file_get_contents('../asset/json/question.json');
        $_SESSION['donnee'] = json_decode($messages, true);
        
    }
    if(isset($_POST['suivant']) || isset($_POST['terminer']) )
    {
       if(isset($_POST['rep']))
       {
            
         $_SESSION['donnee'][$_POST['l']]['reJoueur']= $_POST['rep'];
        // echo "votre score est".$_SESSION['myscore'];
       
         //var_dump($_SESSION['donnee'][$_POST['l']]);
        // var_dump($_SESSION['MesBonnesRep']);
       
 
       }
     //var_dump( $_SESSION['tableaubi']);
    }

    //
   
   

   
    
    


?>
<style>
    .gaming{
        background-color: lightskyblue;
        width: 100%;
        height: 100%;
        border-radius: 3%;
        border: 2px solid;
    }
    .marge{
        width: 100%;
        height: 2%;
        background-color: white;
    }
    .partquest{
        width: 100%;
        height: 30%;
        background-color: grey;
        border-radius: 10% 10% 0 0;
    }
    .entete{
        text-align: center;
        height: 10%;
    }
    .laques{
        width: 100%;
        height: 90%;

    }
    .repondeur{
        width: 100%;
        height: 100%;
        background-color: white;
        margin-top: 10%;
    }
</style>
<div class="gaming">

    <form action="" method="POST" id='demar' >
        <button name="demare" value="demare" type="submit"  style="margin-left: 40%;  "id='demarer'  >Demarer</button>
        <?php  if(isset($_POST['demare']))
        {
            $_SESSION['quiz']=array_rand($_SESSION['donnee'], $_SESSION['nombreQuestion'] );
            ?> <button name="quitter" value="" type="submit"  style=' margin-left: 40%; background-color: red; ' id="quitter" >Quitter</button>
             <?php
            $_SESSION[' resultats']=[];
            $_SESSION['MesBonnesRep']=array();
            $indice1=0;
            $_SESSION['MesFausseRep']=array();
            $indice2=0;
           
        }
        ?>
    </form>
    <div class="marge"></div>
    
        
    <?php
        if(!empty($_SESSION['quiz']))
        {?>

<form method="post" id="myGameForm" action="">
                 <table>
               
            
            
        </div>
        <div class="laques">
            
               
               
                   <?php
                       
                       
                       if (isset($_POST['suivant'] ) && $_SESSION['fin']<count($_SESSION['quiz'])) 
                       {   
                                       $debut=$_SESSION['fin'];
                                       $fin=$_SESSION['fin']+1;
                       }
                        elseif (isset($_POST['precedent']) && $_SESSION['fin']>1) 
                        {
                             $debut=$_SESSION['fin']-2;
                             $fin=$_SESSION['fin']-1;
                         }
                         else
                            {
                                 $debut=0;
                                  $fin=1;
                             }
                             $_SESSION['j']=$debut+1;
                                $_SESSION['monscore']=0;
                                
                                         
                        for ($i=$debut; $i <$fin ; $i++)
                        {
                            if ($i<=count($_SESSION['quiz'])) 
                            {
                               
                               
                                $jj=$i+1;
                                $k=0;
                                $l=$_SESSION['quiz'][$i];
                               
                             echo'   <div class="partquest"><div class="entete">';
                                echo "QUESTION"."<span class='blan' style='background-color:white; '>".$jj."/".$_SESSION['nombreQuestion']."</span>"; 
                                echo "<br>";
                                  echo $_SESSION['donnee'][$l]['question'];
                                  ?></div><div class="repondeur"><br><?php
                                  echo '<input type="number" name = "l" value="'.$l.'">';
                                  echo $_SESSION['monscore'];
                                     if ($_SESSION['donnee'][$l]['choix'] == "texte") {
                                        if (isset($_SESSION['donnee'][$l]['reJoueur'])) {
                                           echo' <input type="hidden" name="choice" value="texte">';
                                           echo '<input type="text" value="'.$_SESSION['donnee'][$l]['reJoueur'].'" name="rep">';
                                           if(in_array($_SESSION['donnee'][$l]['reJoueur'],$_SESSION['donnee'][$l]['Reponse']))
                                           {
                                            $_SESSION['donnee'][$l]['Qualite']="vrai";
                                            
                                            $_SESSION['myscore']+=$_SESSION['donnee'][$l]['nbr'];
                                            echo "votre score est".$_SESSION['myscore'];
                                           } 
                                           else
                                           {
                                            $_SESSION['donnee'][$l]['Qualite']="faux";
                                            echo "faux";
                                           }   
                                        }else{
                                            echo '<input type="text" name="rep">';
                                            $_SESSION['donnee'][$l]['Qualite']="faux";
                                            
                                        }
                                        
                                         
                                     }else if($_SESSION['donnee'][$l]['choix'] == "simple"){
                                        echo' <input type="hidden" name="choice" value="simple">';
                                        foreach ($_SESSION['donnee'][$l]['Reponse'] as $key => $value)
                                         {
                                             
                                             if (isset($_SESSION['donnee'][$l]['reJoueur'][0]) && $key == $_SESSION['donnee'][$l]['reJoueur'][0]) 
                                             {
                                                echo $value .'<input type="radio" value="'.$key.'" name=rep checked><br>';
                                                
                                               if(in_array($key,$_SESSION['donnee'][$l]['Vrai']))
                                               {
                                                $_SESSION['donnee'][$l]['Qualite']="vrai";         
                                                $_SESSION['myscore']+=$_SESSION['donnee'][$l]['nbr'];
                                                echo "votre score est".$_SESSION['myscore'];
                                                }
                                                 else
                                                {
                                                    $_SESSION['donnee'][$l]['Qualite']="faux"; 
                                                }
                                             }
                                             else{
                                               
                                                echo $value .'<input type="radio" value="'.$key.'" name=rep><br>'; 
                                                $_SESSION['donnee'][$l]['Qualite']="faux";
                                               
                                             } 
                                        }
                                        
                                     }
                                     else{
                                        echo' <input type="hidden" name="choice" value="multiple">';
                                        foreach ($_SESSION['donnee'][$l]['Reponse'] as $key => $value) {
                                            
                                            if (isset($_SESSION['donnee'][$l]['reJoueur']) && in_array($key,$_SESSION['donnee'][$l]['reJoueur'])) {
                                              echo $value .'<input type="checkbox" value="'.$key.'" name=rep[] checked><br>';
                                              $m=count($_SESSION['donnee'][$l]['Vrai']);
                                              $n=$m;
                                              $sa=count($_SESSION['donnee'][$l]['reJoueur']);
                                              if($m==$sa)
                                              {
                                                foreach ( $_SESSION['donnee'][$l]['reJoueur']as $key => $value) 
                                                {    
                                                  if(in_array($value,$_SESSION['donnee'][$l]['Vrai']))
                                                  {
                                                    $n--;
                                                  }                                                
                                                }
                                                
                                              }
                                              if($n==0 && $m==$sa )
                                                { echo "yes";
                                                    $_SESSION['donnee'][$l]['Qualite']="vrai";
                                                    $_SESSION['myscore']+=$_SESSION['donnee'][$l]['nbr']; 
                                                    echo "votre score est".$_SESSION['myscore'];
                                                }
                                                else{ $_SESSION['donnee'][$l]['Qualite']="faux";}
                                            }
                                            else{
                                               
                                               echo $value .'<input type="checkbox" value="'.$key.'" name=rep[]><br>'; 
                                               $_SESSION['donnee'][$l]['Qualite']="faux";
                                            } 
                                       }
                                      
                                     }





                                 if($i==count($_SESSION['quiz'])-1)
                                 {
                                   echo' <button name="terminer" type="submit"> terminer</button>';
                                 

                                 }
                            }
                        }
                        
                       $_SESSION['fin']=$fin;
                               if (isset($_POST['suivant']) OR $_SESSION['fin']>=2) {
                               
                                   echo "<button  name='precedent' style='float:left;margin-left:-0vw;'> Precedent</button> ";
                               }
                               ?>
                               <?php
                               if ($_SESSION['fin']< count($_SESSION['quiz'])) {
                                   echo "<button class='bttn' name='suivant' style='float:right;margin-top:1.7vw'> suivant</button> ";
                               }
       
                    ?>
                     <?php    }
         ?>
               </table>
          
    </form>
   
</div>
<?php 
   if(isset($_POST['precedent']))
   {
       $periode=$_SESSION['quiz'][$i];
       echo "la page est ". $periode;
       $_SESSION['myscore']-=$_SESSION['donnee'][$periode]['nbr'];
   }
/*
 if(isset($_POST['terminer']))
 {
     $_SESSION['resultats']=0;
     $nbrvrai=0;
   for ($i=0; $i<count($_SESSION['quiz']) ; $i++) 
   { 
       if($_SESSION['donnee'][$l]['Qualite']=="vrai")
       {
           $_SESSION['resultats']+=$_SESSION['donnee'][$l]['nbr'];
           $nbrvrai++;
       }
       
   }  echo $_SESSION['resultats'];
    echo  "<BR>nombre de vrairepest".$nbrvrai;

 }*/
 $j=$_SESSION['j']-2;
 
 if(isset($_POST['suivant']) || isset($_POST['terminer']) )
 {
    if(isset($_POST['rep']))
    {
         
     // $_SESSION['donnee'][$_POST['l']]['reJoueur']= $_POST['rep'];
     // echo "votre score est".$_SESSION['myscore'];
    
      //var_dump($_SESSION['donnee'][$_POST['l']]);
     // var_dump($_SESSION['MesBonnesRep']);
     if(isset($_POST['choice']))
     {
         if($_POST['choice']=="texte")
        {
            $_SESSION['tableaubi'][$j]=$_SESSION['donnee'][$_POST['l']]['reJoueur'];            
        }
        //
        if($_POST['choice']=="simple")
        {
            $_SESSION['tableaubi'][$j]=$_SESSION['donnee'][$_POST['l']]['reJoueur'];            
        }
        else
        {
            $_SESSION['tableaubi'][$j]=$_SESSION['donnee'][$_POST['l']]['reJoueur'];            
        }
        var_dump($_SESSION['tableaubi']);
        echo "essss";
        var_dump($j);
    }
        
    }
 
 }


?>

<script>
    
    

    
        
    var myGameForm=document.getElementById('myGameForm');
    alert('ok');
   /* myGameForm.addEventListener('suivant',function(e)
    {
        alert('ok');
        var inputs=document.getElementsByClassName('rep');
        var erreur=false;
        for(input of inputs)
        {
            if(input.value="")
            {
                idSpanErreur=input.getAttribute("erreur");
                if(!input.value)
                {
                    e.preventDefault;
                    document.getElementById(idSpanErreur).innerHTML="Ce champs est obligatoire";
                }
                erreur=true;
            }
         
        }
    }
    )*/
    var demar=document.getElementById('demar');
    demar.addEventListener('submit',function(e)
    {
        var demarer=document.getElementById('demarer').remove(();
        function suprimeInput('demarer'){
       var sup=document.getElementById('demarer');
       sup.remove();
    }
        
        
    })
    
</script>