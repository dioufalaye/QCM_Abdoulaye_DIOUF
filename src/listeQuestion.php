<?php
    $tab=file_get_contents('../asset/json/NbreQuestion.json');
    $tab=json_decode($tab, true);
    $_SESSION['affiche']=$tab['NumberOfQuestion'];

    if(isset($_POST['valider']))
    {
        
        $tableau=file_get_contents('../asset/json/question.json');
        $tableau=json_decode($tableau, true);
        //
        $tab=file_get_contents('../asset/json/NbreQuestion.json');
        $tab=json_decode($tab, true);
        $_SESSION['affiche']=$tab['NumberOfQuestion'];
       
        

        
        
        
        if(is_numeric($_POST['elementsByPage']) && ($_POST['elementsByPage'])>4 &&  ($_POST['elementsByPage'])<count($tableau))
        {
            
    
            $newgamer['NumberOfQuestion']=$_POST['elementsByPage'];
                   
             $tab=$newgamer;
             $tab=json_encode($tab);
             file_put_contents('../asset/json/NbreQuestion.json',$tab);
                   
                
        }
        else
        {
            echo "le nomre de question par quiz doit etre superieur ou egal a  5 et inderieur au nombre total de question";
          

        }

    }
 
?>
<style>
    .zoneliste{
        height: 100%;
    }
    .questionJeu{
        margin-left: 10%;
        
        height: 10%;
    }
    .nbrquestion
    {
        width: 40px;
       
    }
    .affichage{
        
        width: 95%;
        height: 90%;
        margin: 10px;
        border: 1px solid burlywood;
        border-radius: 3%;
        overflow: scroll;
            
    }
</style>
<div class="zoneliste">
    <div class="questionJeu" >
        <form action="" method="POST"id="formul">
            <label for="" class="" > Nbre question/jeu</label>
            <input type="text" name="elementsByPage" class="nbrquestion" id="nombre"
             value="<?php if(isset($_POST['elementsByPage']) && $_POST['elementsByPage']>4){echo $_POST['elementsByPage'];} else echo  $_SESSION['affiche'] ; ?>" >
            <span id="missNombre"></span>
            
            <button type="submit" name="valider" value="valider">OK</button>
        </form>
    </div>
    <div class="affichage">
    <?php 
       
              
                $messages = file_get_contents('../asset/json/question.json');
                $messages = json_decode($messages, true);
               
             $_SESSION['meilleur']=$messages;  
             
             //
             if(isset($_SESSION['meilleur']))
             {
                echo '<table>
                     <form method="Post">';
                        if (isset($_POST['suivant'] ) && $_SESSION['fin']<count($_SESSION['meilleur'])) 
                        {
                                        $debut=$_SESSION['fin'];
                                        $fin=$_SESSION['fin']+5;
                        }
                                    elseif (isset($_POST['precedent']) && $_SESSION['fin']>count($_SESSION['meilleur'])) 
                                    {
                                        $debut=$_SESSION['fin']-10;
                                        $fin=$_SESSION['fin']-5;
                                    }else
                                    {
                                        $debut=0;
                                        $fin=5;
                                    }
                                    
                            for ($j=$debut; $j <$fin ; $j++)
                            {
                                if($j==count($_SESSION['meilleur']))
                                    {
                                    break;
                                    }
                                    echo $_SESSION['meilleur'][$j]['question'].'<br>';
                                    
                                    
                                    if($_SESSION['meilleur'][$j]['choix']=="texte")
                                    {
                                        foreach ($_SESSION['meilleur'][$j]['Reponse'] as $key => $value) 
                                        {
                                            
                                            ?><input type="text" disabled value="<?php echo  $value ;?>"></br> <?php 
                                            
                                        }
                                        
                                    }
                                    elseif($_SESSION['meilleur'][$j]['choix']=="simple")
                                    {
                                        foreach($_SESSION['meilleur'][$j]['Vrai'] as $key=>$value) 
                                        {       
                                            $t=$value;
                                            
                                            foreach ($_SESSION['meilleur'][$j]['Reponse'] as $key => $value)
                                            {
                                                if($key==$t)
                                                {
                                                    ?><input type="RADIO" checked="checked" style="background-color: blue;"  disabled ><?php
                                                    echo $_SESSION['meilleur'][$j]['Reponse'][$key].'</br>';
                                                }
                                                else
                                                {
                                                    ?> 
                                                
                                                <input type="RADIO" disabled  >
                                                <input type="text" disabled value="<?php echo $_SESSION['meilleur'][$j]['Reponse'][$key] ;?>"><br> 
                                                <?php
                                                }
                                            }
                                        
                                        
                                        }
                                    }
                                    else
                                    {
                                        foreach($_SESSION['meilleur'][$j]['Vrai'] as $key=>$value) 
                                        {       
                                            $t=$key;
                                            
                                            foreach ($_SESSION['meilleur'][$j]['Reponse'] as $key => $value)
                                            {
                                                if($key==$t)
                                                {
                                                    ?><input type="checkbox" checked="checked" style="background-color: blue;"  disabled ><?php
                                                    echo $_SESSION['meilleur'][$j]['Reponse'][$key].'</br>';
                                                }
                                                else
                                                {
                                                    ?> 
                                                
                                                <input type="checkbox" disabled  >
                                                <input type="text" disabled value="<?php echo $_SESSION['meilleur'][$j]['Reponse'][$key] ;?>"><br> 
                                                <?php
                                                }
                                            }
                                        
                                        
                                        }
                            }
                        }
                        $_SESSION['fin']=$fin;
                        if (isset($_POST['suivant']) OR $_SESSION['fin']>=9) 
                        {                                
                           echo "<button  name='precedent' style='float:left;margin-left:-0vw;'> Precedent</button> ";
                        }
                         
                      if ($_SESSION['fin']< count($_SESSION['meilleur'])) 
                      {
                           echo "<button class='bttn' name='suivant' style='float:right;margin-top:1.7vw'> suivant</button> ";
                      }

                    ?>
		        </table>
                                
                                
            <?php            
             }    
             ?>

    </div>

</div>
<script>
     var formul=document.getElementById('formul');
    formul.addEventListener('submit',function(e)
    {
        var nombre=document.getElementById('nombre'); 
        if(nombre.value.trim()=="" || nombre.value<5 )
        {  
            var missNombre=document.getElementById('missNombre');
            missNombre.innerHTML="le nombre doit etre superieur ou egal 5";
            e.preventDefault(); 
            missNombre.style.color="red";  
        }
    }
    )
</script>