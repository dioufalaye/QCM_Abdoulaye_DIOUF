<?php
function pagination($tableau)
{
echo "dollar";	
}



        /*pattern="[7]{1}[5-80]{1}[-\.]{?}[0-9]{3}[-\.]{?}[0-9]{2}[-\.]{?}[0-9]{2}" */

        function verif_alpha($str)//OK
        {
			
            // On cherche tt les caractères autre que [A-z]
            preg_match("/[^A-Za-z][\s]/",$str,$result);
            // si on trouve des caractère autre que A-z
            if(!empty($result)){
              return false;
            }
            return true;
        }


        function verif_alphaNum($str) //ok
        {
			
            // On cherche tt les caractères autre que [A-Za-z] ou [0-9]
            preg_match("/[^A-Za-z][0-9]{?}[\s]/",$str,$result);
            // si on trouve des caractère autre que A-Za-z ou 0-9
            if(!empty($result)){
              return false;
            }
            return true;
          }

        //retourne majuscule du premier element
        function Maj($identifiant)//ok
        {

            if(verif_alpha($identifiant) && strlen($identifiant)>=2)
            {
                return ucfirst($identifiant);
            }  
            else return false;          
        }

    

    // b adresse valide
    function adresseValide($adresse) //ok
    {
        if(strlen($adresse)>=5 &&  verif_alphaNum($adresse))
        {
            return $adresse;
        }
    }
    //GOOD CORRECTION NUMERO
    function correcteur_numero($numero){//ok
    
        $numero=preg_replace('#[ ]+#','',$numero);
        $numero=preg_replace('#[.]+#','',$numero);
        $numero=preg_replace('#(\\)+)#','',$numero);  
    
        return $numero;
    }
    



    //numero validé sans les caracteres 
    function numeroValide($numero)//OK
    {   $numero=correcteur_numero($numero);
        if(preg_match('/^[7]{1}[5-80]{1}[0-9]{7}/',$numero) && strlen($numero)==9)
        {
            return $numero;
        }
    }
        
    //numero identique
    function verifNumeroIdentique($nu1,$nu2)
    {
        if( numeroValide($nu1)=== numeroValide($nu2))
        {
            return true;
        }
    }

    function correcteur_espace(string $texte)
    {
        $correction_espace=preg_replace('#[ ]+#',' ',$texte);
        $correction_apostrophe_avant=preg_replace('#[ ]+\'#','\'',$correction_espace);
        $correction_apostrophe_apres=preg_replace('#\'[ ]#','\'',$correction_apostrophe_avant);
        $correction_virgule=preg_replace('#([ ]+,)#',',',$correction_apostrophe_apres);
        $correction_point_virgule=preg_replace('#([ ]+;)#',';',$correction_virgule);
        $correction_point=preg_replace('#([ ]+\.)#','.',$correction_point_virgule);
        return $correction_point;
    }
    
    /*recuperrateur phrase*/
    function recuperateur_phrase_bis(string $texte){
        preg_match_all('#[a-z]([^.!?]|([.][0-9]))*[.?!]#i' ,$texte,$phrases);
        return $phrases;
    }
   function loginexistant($login,$tab)
   {
    
        $resultat=false;
            foreach ($tab as $key=>$value)  
            {
                    if($_POST['login']==$value['login'])
                    {
                       $resultat=true;
                       return $resultat;
                    }

           }  
           return $resultat;      
    }

   
    




?>
