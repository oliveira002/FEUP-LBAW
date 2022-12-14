
function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();

    request.open(method, url, true);
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
}

function addToFavorites() {
    document.getElementById("favbtn").addEventListener("click", function() {
        console.log("click");
        let data = {
            'idauction': document.getElementById("favbtn").getAttribute("idauction"),
        };
        sendAjaxRequest('post', '/auction/'+ data.idauction + '/favorite?idauction=' + data.idauction,{}, favoritesHandler
        );
    }
    
    );
        
    
}
 
function favoritesHandler() {
    let response = JSON.parse(this.responseText);
    console.log(response);
    if (response == 1) {
        $a = document.getElementById("favorite").setAttribute("class", "fa-solid fa-star");
        document.getElementById("favtext").innerHTML = "Remove from favorites";
    
        
    }
    else if(response == 0) {
      
        $a = document.getElementById("favorite").setAttribute("class", "fa-regular fa-star");
        
        document.getElementById("favtext").innerHTML = "Add to favorites";

        
    }
    else if(response == -2) {
        //redirect to login
        window.location.href = "/login";
    }
    else if(response == -1) {
        //show error message
        document.getElementById("favtext").innerHTML = "Error";
    }
    
}

addToFavorites();