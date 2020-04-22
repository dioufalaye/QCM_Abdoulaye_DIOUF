<div class="quest">
<form id="formQuestion">
        <div id="divQuestion">
            <label>Questions</label>
            <textarea name="question"  ></textarea>
        </div>
        <div class="divInput">
            <label>Score</label>
            <input type="num" name="scoreQuestion" />
        </div>
        <div id="divSelect">
            <label>Type</label>
            <select id="type" name="type" onchange="mySelection()">
                <option>Choix multiple
                <option>Choix simple
                <option>Choix texte  
            </select>
        </div>
        <div id="divNbreRep">
            <label>Nbre Reponses</label>
            <input id="nbreReponses" type="num" name="nbreReponses" />
        </div>
        <div id="reponses">
        </div> 
        <div id="divSubmit">
            <input type="submit" name="connexionAdmin" value="VALIDER" class="validerQuestion"/>
        </div>
    </form>
</div>
<script>
    document.querySelector('#nbreReponses').addEventListener('keyup', () => {
    var type=document.getElementById("type").value;
    if (type=="Choix multiple") {
        choixMultiple();
    }
    else{
        if (type=="Choix simple") {
            choixSimple();
        }
        else{
            choixTexte(); 
        }
    }
});
function mySelection() {
    var type=document.getElementById("type").value;
    if (type=="Choix multiple") {
        choixMultiple();
    }
    else{
        if (type=="Choix simple") {
            choixSimple(); 
        }
        else{
            choixTexte();
        }
    }
}

function choixMultiple(){
    var type=document.getElementById("type").value;
    const reponses = document.getElementById("reponses");
    reponses.innerHTML = '';
    var number = document.getElementById("nbreReponses").value;
    for (i=1;i<=number;i++){
        var label= document.createElement("label");
        var input = document.createElement("input");
        var checkbox = document.createElement("input");
        label.innerText= "Rep "+i;
        input.type = "text";
        input.className="inputReponse";
        checkbox.className="checkboxReponse";
        input.name ="reponse"+i;
        checkbox.type="checkbox";
        checkbox.name="checkboxRep"+i;
        reponses.appendChild(label);
        reponses.appendChild(input);
        reponses.appendChild(checkbox);
        reponses.appendChild(document.createElement("br"));
        reponses.appendChild(document.createElement("br"));
    }
}
function choixSimple(){
    var type=document.getElementById("type").value;
    const reponses = document.getElementById("reponses");
    reponses.innerHTML = '';
    var number = document.getElementById("nbreReponses").value;
    for (i=1;i<=number;i++){
        var label= document.createElement("label");
        var input = document.createElement("input");
        var radio = document.createElement("input");
        label.innerText= "Rep "+i;
        input.type = "text";
        input.className="inputReponse";
        radio.className="radioReponse";
        input.name ="reponse"+i;
        radio.type="radio";
        radio.name="reponse";
        reponses.appendChild(label);
        reponses.appendChild(input);
        reponses.appendChild(radio);
        reponses.appendChild(document.createElement("br"));
        reponses.appendChild(document.createElement("br"));
    }
}
function choixTexte(){
    var type=document.getElementById("type").value;
    const reponses = document.getElementById("reponses");
    reponses.innerHTML = '';
    var number = document.getElementById("nbreReponses").value;
    for (i=1;i<=number;i++){
        var label= document.createElement("label");
        var input = document.createElement("input");
        label.innerText= "Rep "+i;
        input.type = "text";
        input.className="inputReponse";
        input.name ="reponse"+i;
        reponses.appendChild(label);
        reponses.appendChild(input);
        reponses.appendChild(document.createElement("br"));
        reponses.appendChild(document.createElement("br"));
    }
}


</script>