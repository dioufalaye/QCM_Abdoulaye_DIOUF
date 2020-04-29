<?php



    if (!empty($_POST)) 
    {
		$tab=[];
		unset($_POST['btn']);
        $tab=$_POST;    
        $data=file_get_contents('../asset/json/question.json');
        $data=json_decode($data,true);	
        $data[]=$tab;
        $data=json_encode($data) ;
        file_put_contents('../asset/json/question.json',$data);
    }
    else
    {
        echo "tous les champs sont obligatoire";
    }
				

?>
<div class="questionnaire">
   <form action="" id="form_quest" method="POST">
        <div class="question">
            <label for="">Question</label>
            <textarea name="question" id="" style="height: 30px; width:80%;"></textarea>
        </div>
        <div class="nbrpoint">

            <label for="">nombre de point</label>
            <?php $point=[1,2,3,4,5,6,7,8,9,10]; ?>
            <select name="nbr" id="">

                <?php
                
                
                foreach($point as $key=>$value)
                {
                    ?><option value="<?php echo $value;?>"><?php echo $value;?></option><?php

                }
                ?>  
                
            </select>
            

               
         
                            
        </div>
        <div class="typeRep">
            <label for="">Type de Reponse</label>
            <select id="choix" name="choix" onchange="monchoix();">
                <option value="texte">choix texte</option>
                <option value="simple">choix simple</option>
                <option value="multiple">choix multiple</option>
            </select> 
            <button type="button" id="ajout" onclick="ajoutInputs()">
                    <img src="../asset/img/Icones/ic-ajout-active.png" alt="IMAGEHOLDER">
            </button>
        </div>
            <div class="inputs" id="inputs">
                
                
                
        </div>
           
         <button type="submit" class="btn" name="btn" onclick="getValue();" >Enregistrer</button>

   </form>
</div>

<script>
    
    var nbr_row=0;
    var indice=0;
    function monchoix(){
        document.getElementById('inputs').innerHTML="";
        nbr_row=0;
    }
   
    function ajoutInputs()
    {  
        indice++;
        nbr_row+=1;
        var choix=document.getElementById('choix').value;
            var Divajouter=document.getElementById('inputs');
        var newInput=document.createElement('div');
        newInput.setAttribute('class','row');
       newInput.setAttribute('id','row_'+ nbr_row);
        
       if (choix==="simple") {
        newInput.innerHTML=`<label for="">Reponse${nbr_row}</label>
                    <input type="text" name="Reponse[${indice}]" id="Reponse${nbr_row}" class="rep"               >
                    <input type="radio" name="Vrai[${indice}]" id="maReponse" value="${indice}"  >
                    <button type="button" onclick="suprimeInput(${nbr_row});" >
                        <img src="../asset/img/Icones/ic-supprimer.png" alt="IMAGEHOLDER"> 
                    </button>`;
            
                    
                   
       }else if (choix==="multiple") {
        newInput.innerHTML=`<label for="">Reponse${nbr_row}</label>
                    <input type="text" name="Reponse[${indice}]" id="Reponse${nbr_row}" class="rep" >
                    <input type="checkbox" name="Vrai[${indice}]" id="maReponse"    value="${indice}"  >
                    <button type="button" onclick="suprimeInput(${nbr_row});" >
                        <img src="../asset/img/Icones/ic-supprimer.png" alt="IMAGEHOLDER"> 
                    </button>`;
                    
                   
       }else{
        newInput.innerHTML=`<label for="">Reponse${nbr_row}</label>
                    <input type="text"name="Reponse[]" id="Reponse${nbr_row}" class="rep">
    `;
                    document.getElementById('ajout').disabled=true;
       }
    
       
        inputs.appendChild(newInput);
        
    }
    function suprimeInput(n){
       var sup=document.getElementById('row_'+n);
       sup.remove();
    }
     function getValue()
     {  var tableau=document.getElementsByClassName('rep');
        var longeur=tableau.length;
        alert(longeur);
        var donnees=document.getElementsByTagName('input');
         
     } 
</script>