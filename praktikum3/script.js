
const nim = document.getElementById("nim");
const nilai = document.getElementById("nilai");

const outnim = document.getElementById("outnim");
const outnilai = document.getElementById("outnilai");

const body = document.getElementById("Event");

body.addEventListener("keydown", function (event){
    if(event.key = "Enter"){
        Check();
    }
});

function Check(event){

    let nilaivalue = parseInt(nilai.value);
    let nimValue = nim.value;

    outnim.innerText = nimValue;

    if (nilaivalue <= 49) {
        outnilai.innerText = "E";

    } else if(nilaivalue <= 59){
        outnilai.innerText = "D";
    } else if(nilaivalue <= 69){
        outnilai.innerText = "C";
    } else if(nilaivalue <= 79){
        outnilai.innerText = "B";
    } else if(nilaivalue <= 100){
        outnilai.innerText = "A";
    } else{
        outnilai.innerText = "Nilai tidak valid!";
    }
}


function Reset(){
    nim.innerHTML = "";
    nilai.innerHTML = "";
    outnilai.innerHTML = "";
    outnim.innerHTML = "";
}


