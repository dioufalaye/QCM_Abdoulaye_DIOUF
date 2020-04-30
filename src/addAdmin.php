
 <?php 
  include('fonction.php');
  if(isset($_POST['creer_compte'])){
  
  if (  
   Maj($_POST['prenom'])  &&  Maj($_POST['nom']) &&
     verif_alphaNum($_POST['pass']) &&  verif_alphaNum($_POST['passbi']) && verif_alphaNum($_POST['pass'])==verif_alphaNum($_POST['passbi']) 
     && verif_alphaNum($_POST['login'])  ) 
{ 

            // proccessus chargement image
            $dossier = '../asset/img/';
            $fichier = basename($_FILES['image']['name']);
            $taille_maxi = 100000;
            $taille = filesize($_FILES['image']['tmp_name']);
            $extensions = array('.png', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['image']['name'], '.'); 
            //Début des vérifications de sécurité...
            if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
            {
                $erreur = 'Vous devez uploader un fichier de type png , jpg, jpeg, txt ou doc...';
            }
            if($taille>$taille_maxi)
            {
                $erreur = 'Le fichier est trop gros...';
            }
            if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
            {
                //On formate le nom du fichier ici...
                $fichier = strtr($fichier, 
                    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                    echo 'Upload effectué avec succès !';
                }
                else //Sinon (la fonction renvoie FALSE).
                {
                    echo 'Echec de l\'upload !';
                }
            }
            else
            {
                echo $erreur;
            }


            //enregistrement dans le fichier json 
            $newgamer=array();
            $tab=file_get_contents('../asset/json/base.json');
            $tab=json_decode($tab, true);
        
           
            if(loginexistant($_POST['login'],$tab))
            {
                echo "ce login existe dejas";
            }
                else{
                    $newgamer['prenom']=Maj($_POST['prenom']);
                    $newgamer['nom']=Maj($_POST['nom']);
                    $newgamer['login']=$_POST['login'] ;
                    $newgamer['password']=$_POST['pass'];
                    $newgamer['role']="admin";
                    $newgamer['image']=$_FILES['image']['name'];
                    $tab[]=$newgamer;
                    $tab=json_encode($tab);
                    file_put_contents('../asset/json/base.json',$tab);
                    // header('location:../index.php');
                    exit();
                }
            }
           

           elseif( !Maj($_POST['prenom'])  ||  !Maj($_POST['nom']))
           {
               echo "le nom et  le prenom doivent etre de type alphanumerique";
           }
           elseif( verif_alphaNum($_POST['pass'])!=verif_alphaNum($_POST['passbi']))
           {
             
                 echo "le mot de passe doit etre alphanumerique et identique a cel confirmé";

           }
           
           
        } 
             
         
?>
    <style>
       
        .gauche{
            height: 100%;
            width: 70%;
           
        }
        .droite{
           float: right;
           height:120px;
           width: 120px;
           background-color: orange;
           margin-top: -70%;
           border-radius:50%;
           margin-right: 50px;
        }
        .label{
            margin-left: 5%;
            font-size: xx-large;

        }
   .prenom
    {
        width: 50%;
        height: 10%;
        margin-left: 2%;
        border-radius: 5%;
        margin: 2%;
    }
    .pass
    {
        width: 50%;
        height: 10%;
        margin-left: 2%;
        border-radius: 5%;
        margin: 2%;
        border:3px solid rgb(178,227,234);
    }
    .bouton
    {
        background-color:rgb(81,191,208);
        margin: 2%;
        width: 8vw;
    }
    .container
    {
        background-color: white;
    }
    label{
      margin-left: 2vw;
    }
      
    form input{
  margin-left: 2vw;
   }


    </style>
   
   <div class="container">
       <div class="cadre">
           <div class="gauche">
               <strong style="margin-left: 2vw"> Ajouter Admin</strong><br>
           <form action="" class="adherer" enctype="multipart/form-data" id="formul" method="POST">
                        <label for="">Prenom</label><br>
                        <input type="text" placeholder="Aaaa" name="prenom" class="prenom" id="pren" style="margin-left: 2vw" >
                        <span id="missprenom"></span><br>
                        <label for="">Nom</label><br>
                        <input type="text" placeholder="BBBB" name="nom" class="prenom" id="nom" style="margin-left: 2vw" >
                        <span id="missnom"></span><br>
                        <label for="">login</label><br>
                        <input type="text" placeholder="Login" name="login" class="prenom" id="login" style="margin-left: 2vw" >
                        <span id="misslogin"></span><br>
                        <label for="">Passeword</label><br>
                        <input type="password" placeholder="...." name="pass" class="pass" id="pass" style="margin-left: 2vw" >
                        <span id="misspass"></span><br>
                        <label for="">Confirmer Passeword</label><br>
                        <input type="password" placeholder="...." name="passbi" class="pass" id="passbi" style="margin-left: 2vw" >
                        <span id="misspassbi"></span><br>
                        <label for="">Avatar</label>
                        <input type="file" name="image" id="tof" class="bouton" onchange="document.getElementById('photo').src=window.URL.createObjectURL(this.files[0])">
                        <span id="misstof"></span><br>
                        <input type="submit" value="creer_compte" name="creer_compte" class="bouton" id="compte" style="margin-left: 4vw">

                    </form>

           </div>

           <img class="droite" id="photo">
            avatar  
           </div>

       </div>
      
   
   <script>
       
       var formul=document.getElementById('formul');

       
       formul.addEventListener('submit',function(e){
           var prenom=document.getElementById('pren');
           var nom=document.getElementById('nom');
           var login=document.getElementById('login');
           var pass=document.getElementById('pass');
           var passbi=document.getElementById('passbi');
           var image=document.getElementById('tof');
           if(prenom.value.trim()=="")
           {  
               var misspre=document.getElementById('missprenom');
               misspre.innerHTML="le prenom est requis";
               e.preventDefault(); 
               misspre.style.color="red";  
           }



           if(nom.value.trim()=="")
           {  
               var missnom=document.getElementById('missnom');
               missnom.innerHTML="le nom est requis";
               e.preventDefault(); 
               missnom.style.color="red";  
           }
           if(login.value.trim()=="")
           {  
               var misslogin=document.getElementById('misslogin');
               misslogin.innerHTML="un login est requis";
               e.preventDefault(); 
               misslogin.style.color="red";  
           }
           if(pass.value.trim()=="")
           {  
               var misspass=document.getElementById('misspass');
               misspass.innerHTML="un  mot de pass est requis";
               e.preventDefault(); 
               misspass.style.color="red";  
           }
           if(passbi.value.trim()=="")
           {  
               var misspassbi=document.getElementById('misspassbi');
               misspassbi.innerHTML="la confirmation du mot de passe est requis";
               e.preventDefault(); 
               misspassbi.style.color="red";  
           }
           if(tof.value.trim()=="")
           {  
               var misstof=document.getElementById('misstof');
               misstof.innerHTML="votre photo est requis";
               e.preventDefault(); 
               misstof.style.color="red";  
           }
        
       }
    )
   
   </script>
   
  