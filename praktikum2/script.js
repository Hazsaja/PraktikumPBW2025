
const parap = document.getElementById("change");
const backg = document.getElementById("background");

parap.addEventListener("mouseover", function(){
    parap.innerText = "Teks ini berwarna merah dengan ukuran 24 pixel!";
    parap.style.color = "red";
});

parap.addEventListener("mouseout", function(){
    parap.innerText = "Teks ini berwarna biru dengan ukuran 24 pixel!";
    parap.style.color = "blue";
});

backg.addEventListener("mouseover", function(){
    backg.innerText = "Paragraf ini memiliki background berwarna biru.";
    backg.style.backgroundColor = "blue";
    backg.style.color = "white";
});

backg.addEventListener("mouseout", function(){
    backg.innerText = "Paragraf ini memiliki background berwarna kuning.";
    backg.style.backgroundColor = "yellow";
    backg.style.color = "black";
});

