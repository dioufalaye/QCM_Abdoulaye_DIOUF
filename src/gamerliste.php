
<style>
    .score{
        
        border: solid 2px blueviolet;
        width: 50%;
        background-color: white;
       
    }
</style>
<div class="liste" style="  overflow: scroll;">
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
     $_SESSION['meilleur']=$messages;  
     
     //
     if(isset($_SESSION['meilleur']))
     {
         $total=sizeof($_SESSION['meilleur']);
      
         $col=1;
         $lign=15;
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
             for($j=($page_num-1)*15;$j<$page_num*15;$j++)
             {
                 if($j==$total)
                 {
                 break;
                 }
                 ?><td class="score"><?php echo $_SESSION['meilleur'][$j]['prenom'] ?></td>
                 <td class="score"><?php echo $_SESSION['meilleur'][$j]['nom'] ;?></td>
                 <td class="score"><?php echo $_SESSION['meilleur'][$j]['score']."points" ;?></td><?php

                
                echo '<br>';
                 {
                     echo'</tr><tr>';
                 }
             } 
             echo'</tr></table>';

             for ($i=1; $i <=$nbrPage ; $i++) 
             {
                echo "<a href='liste_quest.php?lien=3&page=".$i."' >Page $i  </a>";
             
         
             }
             

         
     }    

       
    
    ?>
</div>
