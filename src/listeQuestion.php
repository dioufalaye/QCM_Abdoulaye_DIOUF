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
    }
</style>
<div class="zoneliste">
    <div class="questionJeu" >
        <form action="" method="POST">
            <label for="" class="" > Nbre question/jeu</label>
            <input type="text" name="elementsByPage" class="nbrquestion">
            <button type="submit" name="valider" value="valider">OK</button>
        </form>
    </div>
    <div class="affichage">
    <?php 
        if(isset($_POST['valider']))
        {
            if(empty($_POST['elementsByPage']) || !is_numeric($_POST['elementsByPage']) || $_POST['elementsByPage']<1)
            {
                echo "s'aisir le nombre de question a afficher par page";
            }
            else
            {
                $elementByPage=$_POST['elementsByPage'];
                $messages = file_get_contents('../asset/json/question.json');
                $messages = json_decode($messages, true);
                $l=count($messages);
                //$temp=array();        

                                    
             /*for ($i=0; $i < $l; $i++)
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
             }*/
             $_SESSION['meilleur']=$messages;  
             
             //
             if(isset($_SESSION['meilleur']))
             {
                 $total=sizeof($_SESSION['meilleur']);
              
                 $col=1;
                 $lign=$elementByPage;
                 $elePag=($col*$lign);
                 
                 $nbrPage=ceil($total/$elePag);
             
                 if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
                 {
                     $page_num=$_GET['page'];
            
                 }
                 else
                 {
                      $page_num=1;
                 }
             
                     echo'<table><tr>';
                        for($j=($page_num-1)*$lign;$j<$page_num*$lign;$j++)
                        {
                            if($j==$total)
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
                        echo'</tr></table>';
        
                     for ($i=1; $i <=$nbrPage ; $i++) 
                     {
                        echo "<a href='liste_quest.php?lien=1&page=".$i."' >Page $i  </a>";
                     
                 
                     }
                     
        
                 
             }    
        
            }
        }
      
       
    
    ?>

    </div>

</div>