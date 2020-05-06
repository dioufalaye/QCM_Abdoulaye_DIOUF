<?php 


    if (empty($_SESSION['donnee'] )) {
        //nombre de question fixer par l'adminnnnnnn-------------------------
        $tab=file_get_contents('../asset/json/NbreQuestion.json');
        $tab=json_decode($tab, true);
        $_SESSION['nombreQuestion']=$tab['NumberOfQuestion'];

        //listedes question decodee----------------------------------------------    
        $messages = file_get_contents('../asset/json/question.json');
        $_SESSION['donnee'] = json_decode($messages, true);
    }
    if(isset($_POST['suivant']))
    {
        //var_dump($_SESSION['donnee'][$_POST['l']]);
         $_SESSION['donnee'][$_POST['l']]['reJoueur']= $_POST['rep'];
        var_dump($_SESSION['donnee'][$_POST['l']]);

    //    die();

       /*
        unset($_POST['suivant']);
        $_SESSION['recup'][$l]=$_POST;
        	
        $data[]=$_SESSION['recup'][$l];
        $data=json_encode($data) ;
        file_put_contents('../asset/json/tempon.json',$data);
        */
    }
    


?>
<style>
    .gaming{
        background-color: red;
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
                                $_SESSION['tesChoix']=[];
                                
                                   
                        for ($i=$debut; $i <$fin ; $i++)
                        {
                            if ($i<=count($_SESSION['quiz'])) 
                            {
                               
                               
                                
                                $k=0;
                                $l=$_SESSION['quiz'][$i];
                                $j=$i+1;
                             echo'   <div class="partquest"><div class="entete">';
                                echo "QUESTION"."<span class='blan' style='background-color:white; '>".$j."/".$_SESSION['nombreQuestion']."</span>"; 
                                echo "<br>";
                                  echo $_SESSION['donnee'][$l]['question'];
                                  ?></div><div class="repondeur"><br><?php
                                  echo '<input type="number" name = "l" value="'.$l.'">';
                                     if ($_SESSION['donnee'][$l]['choix'] == "texte") {
                                        if (isset($_SESSION['donnee'][$l]['reJoueur'])) {
                                           echo '<input type="text" value="'.$_SESSION['donnee'][$l]['reJoueur'][0].'" name="rep">';
                                            
                                        }else{
                                            echo '<input type="text" name="rep">';
                                        }
                                         
                                     }else if($_SESSION['donnee'][$l]['choix'] == "simple"){
                                        foreach ($_SESSION['donnee'][$l]['Reponse'] as $key => $value) {
                                             if (isset($_SESSION['donnee'][$l]['reJoueur'][0]) && $key == $_SESSION['donnee'][$l]['reJoueur'][0]) {
                                               echo $value .'<input type="radio" value="'.$key.'" name=rep checked>';
                                             }else{
                                                echo $value .'<input type="radio" value="'.$key.'" name=rep>'; 
                                             } 
                                        }
                                         
                                     }else{
                                        foreach ($_SESSION['donnee'][$l]['Reponse'] as $key => $value) {
                                            if (isset($_SESSION['donnee'][$l]['reJoueur']) && in_array($key,$_SESSION['donnee'][$l]['reJoueur'])) {
                                              echo $value .'<input type="checkbox" value="'.$key.'" name=rep[] checked>';
                                            }else{
                                               echo $value .'<input type="checkbox" value="'.$key.'" name=rep[]>'; 
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
     $_SESSION['recup']=[];
     $data=file_get_contents('../asset/json/tempon.json');
     $data=json_decode($data,true);

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
        var demarer=document.getElementById('demarer');
        function suprimeInput('demarer'){
       var sup=document.getElementById('demarer');
       sup.remove();
    }
        
        
    })
    
</script>