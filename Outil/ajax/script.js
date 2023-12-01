



document.addEventListener("DOMContentLoaded", function() {

let selectSport = document.querySelector(".selectSport");



let selectAgeMax = document.querySelector(".ageMax");
let selectAgeMin = document.querySelector(".ageMin");

selectAgeMax.addEventListener("change", ()=>{
    selectAgeMin.setAttribute("max", selectAgeMax.value)
})

selectAgeMin.addEventListener("change", ()=>{
    selectAgeMax.setAttribute("min", selectAgeMin.value)
})

console.log(selectAgeMax)

function bullshit(){
    let id_slug = selectEntraineur.value;
    
    fetch("Outil/ajax/constructionRequeteAjax.php?id_slug=" + id_slug 
    + "&function_slug=" + "listeEquipe" 
    +  "&nomSelect_slug=" + "entraineur" , {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then((response) => {
           return response.json()
        })

        .then((responseJ)=>{

            selectSport.innerHTML ="";

            responseJ.forEach(e => {
                selectSport.innerHTML += e;
            });
        })

        .catch(function (error) {
            console.error(error);
        })
}

    let event = selectEntraineur.addEventListener("change", bullshit())

// afiche l'erreur en swag => il faut modifier la partie dans le if match pour 
// l'afficher a l'endroit voulu 
let error = document.querySelector('font');
if (error !== null){

    let inputString = document.querySelector('font > table > tbody > tr > th').innerHTML;


    let regexPattern = /1644(.*?)in C:/g;

    let match = regexPattern.exec(inputString);

    if (match && match[1]) {
        let extractedText = match[1].trim();
        // l'instruction en dessous affiche l'erreur sous le form 
        document.querySelector('.formEquipe').innerHTML += 
    
    `<div class=' text-center mb-4 mt-4 h3 text-danger d-flex flex-row align-items-center justify-content-center'>
    Erreur : <br/>    
    
    ${extractedText}
    </div>
    `;
    } 
    
    error.style.display='none';


    if(document.querySelector('pre') !== null){
        document.querySelector('pre').style.display='none';
    }

}

});




