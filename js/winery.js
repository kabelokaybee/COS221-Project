document.getElementById('filter-select-sort').addEventListener('change', refineWineries);
var url = "../COS221_Website/globals/api.php";
function refineWineries(){
    const winelist = document.querySelector('.brand-wrapper');
    winelist.innerHTML = '';
    var varietal = document.getElementById('filter-select-sort').value;
    //1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    var body = JSON.stringify({
                "type":"FilterWineries",
                "varietal": varietal
        })
    console.log(body);
    //I am using asynchronous because we want the cars to show as soons as the age is loaded.
    //2. create request
    request.open("POST",url,true);
    request.setRequestHeader("Content-type", "application/json");
    request.onreadystatechange = function(){
        if(request.readyState==4 && request.status == 200){
            console.log(JSON.parse(request.responseText).data[0]);
            let Q1=JSON.parse(request.responseText);
            var cars = Q1.data;
            if(cars.length == 0){
                const html = `<h2>Sorry seems like we don't have what you're looking for in stock<h2>`
                winelist.insertAdjacentHTML('beforeend',html);
            }else{
                for(let i=0; i<Q1.data.length; i++){
                    const html = `<div class="brand">
                        <img class="wineimage" src="${Q1.data[i]['Image']}" alt="${Q1.data[i]['WineryName']}">
                        <h2>${Q1.data[i]['WineryName']},${Q1.data[i]['Country']}</li> </h2>
                        <li>Winemaker: ${Q1.data[i]['Winemaker']}</li>
                        <li>Production Size: ${Q1.data[i]['ProductionSize']} bottles</li>
                        <li>Grape Varietal: ${Q1.data[i]['VarietalName']}</li>
                    </div>`
                    winelist.insertAdjacentHTML('beforeend',html);
               } 
            }
        }else{
            console.log("Error:"+request.responseText.message);
        }
    }
    request.send(body);
   
}
//Asynchronous call used.
window.addEventListener("load" , ()=>{
    const loading1 = document.querySelector(".loading");
    loading1.classList.add("loading-hidden");
    // applyTheme();
    wineryLoad();
    if(document.cookie.indexOf('validated')){
        //setTimeout(applyFilters,400);
    }
})
const loading1  = document.querySelector(".loading");

function showloading(){
    loading1.style.display = 'flex';
    loading1.style.transition = '0.2s'
}
function hideloading(){
    loading1.style.display = 'none';
}
//Const for section where cars are displayed
function getCookieValue(cookieName) {
    const cookies = document.cookie.split('; ');
    for (let i = 0; i < cookies.length; i++) {
      const parts = cookies[i].split('=');
      if (parts[0] === cookieName) {
        return decodeURIComponent(parts[1]);
      }
    }
    return '';
  }

//This function gets all the information about the cars
function wineryLoad(){
    showloading();
    const winelist = document.querySelector('.brand-wrapper');
    winelist.innerHTML = '';
    //1. Create the XMLHttpRequest Object
    let request = new XMLHttpRequest();
    var body = JSON.stringify({
                "type":"getWinery",
                "return":"*"
        })

    //I am using asynchronous because we want the cars to show as soons as the age is loaded.
    //2. create request
    request.open("POST",url,true);
    request.setRequestHeader("Content-type", "application/json");
    request.onreadystatechange = function(){
        if(request.readyState==4 && request.status == 200){
            console.log(JSON.parse(request.responseText).data[0]);
            let Q1=JSON.parse(request.responseText);
            var cars = Q1.data;
            if(cars.length == 0){
                const html = `<h2>Sorry seems like we don't have what you're looking for in stock<h2>`
                winelist.insertAdjacentHTML('beforeend',html);
            }else{
                for(let i=0; i<Q1.data.length; i++){
                    const html = `<div class="brand">
                        <img class="wineimage" src="${Q1.data[i]['Image']}" alt="${Q1.data[i]['WineryName']}">
                        <h2>${Q1.data[i]['WineryName']}, ${Q1.data[i]['Country']}</li> </h2>
                        <li>Winemaker: ${Q1.data[i]['Winemaker']}</li>
                        <li>Production Size: ${Q1.data[i]['ProductionSize']} bottles</li>
                        <li>Grape Varietal: ${Q1.data[i]['VarietalName']}</li>
                    </div>`
                    winelist.insertAdjacentHTML('beforeend',html);
               } 
            }
        }else{
            console.log("Error:"+request.responseText.message);
        }
    }
    request.send(body);   
}


const apiKey = getCookieValue('api_key');
console.log(apiKey);


