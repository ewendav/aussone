let selectSport = document.querySelector(".selectSport");
let selectEntraineur = document.querySelector(".selectEntraineur");


let selectAgeMax = document.querySelector(".ageMax");
let selectAgeMin = document.querySelector(".ageMin");

selectAgeMax.addEventListener("change", ()=>{
    selectAgeMin.setAttribute("max", selectAgeMax.value)
})

selectAgeMin.addEventListener("change", ()=>{
    selectAgeMax.setAttribute("min", selectAgeMin.value)
})


    selectEntraineur.addEventListener("change", ()=>{   

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
       
    });


document.addEventListener("DOMContentLoaded", function() {

    // afiche l'erreur en swag => il faut modifier la partie dans le if match pour 
    // l'afficher a l'endroit voulu 
    let error = document.querySelector('.xdebug-error');
    if (error !== null){

        let inputString = document.querySelector('font > table > tbody > tr > th').innerHTML;


        let regexPattern = /1644(.*?)in C:/g;

        let match = regexPattern.exec(inputString);

        if (match && match[1]) {
            let extractedText = match[1].trim();
            // l'instruction en dessous affiche l'erreur sous le form 


            let textDiv = document.createElement('div');

            textDiv.classList.add('text-center', 'mb-4', 'mt-4' ,'h3' ,'text-danger', 'd-flex', 'flex-row', 'align-items-center', 'justify-content-center')

            textDiv.innerHTML = `
            Erreur : <br/>        
                ${extractedText}
           `;


            document.querySelector('.formEquipe').appendChild(textDiv);
        }     
        error.style.display='none';
        if(document.querySelector('pre') !== null){
            document.querySelector('pre').style.display='none';
        }

    }

});




