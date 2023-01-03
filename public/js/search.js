var display = 0;
var sort = 0;
var min = 0;
var max = 100000000;
var texte_query = "";

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
function createElementFromHTML(htmlString) {
    var div = document.createElement('div');
    div.innerHTML = htmlString.trim();

    // Change this to div.childNodes to support multiple top-level nodes.
    return div.firstChild;
}
function auctionUpdatedHandler() {
    let item = JSON.parse(this.responseText);
    let auction = document.querySelectorAll('#auction div')
    auction.forEach(e => {
        e.remove()
    });
    let Fhtml = ``
    var number = 0
    for(const auc of item){
        number++
        const html = `
        <div class="d-flex flex-column ps-3 pe-3 pt-3 ">
                <div class = "itemauc">
                    <a href="${window.location.origin + '/auction/' + auc.idauction}"><img src= "${'/images/' + auc.idauction + '/1.jpg'}"+ width="287" height="190"></a>
                    <a href="${window.location.origin + '/auction/' + auc.idauction}">
                        <div class = "prop" >
                            <p id = "price" class = "fw-bold mb-0 mt-1"> ${auc.currentprice}€ </p>
                            <p id = "nome" class = "fw-bold mb-5"> ${auc.name} </p>
                        </div>
                    </a>
                </div>
            </div>
        `
        Fhtml = Fhtml.concat(html)
    }
    var a = document.querySelector("#content > div.pattern > div > div:nth-child(1) > div")
    a.innerHTML = number + " items displayed"
    document.querySelector('#auction').insertAdjacentHTML('beforeend',Fhtml)

}

function updateAuction(){
    if(this.type == "text"){
        texte_query = this.value
    }
    else if(this.name == "tempo"){
        display = this.value
    }
    else if(this.name == "filter"){
        sort = this.value
    }
    else if(this.name == "min"){
        min = this.value
    }
    else if(this.name == "max"){
        max = this.value
    }
    const url = window.location.pathname.split('/')
    const category = url.length > 2 ? url[2] : null
    sendAjaxRequest('get','/search/api?category=' + category + '&search_query='+texte_query + '&display='+display + '&sort='+sort + '&min='+min + '&max='+max,{},auctionUpdatedHandler )
}

function updateUser(){
    const text_query = this.value
    sendAjaxRequest('get','/search/user/api?' + '&search_query='+text_query,{},userUpdateHandler )
}

function userUpdateHandler(){
    let item = JSON.parse(this.responseText);
    let user = document.querySelectorAll("#tablecontent tr")
    user.forEach(e => {
        e.remove()
    });

    let Fhtml = ``
    for(const usr of item){
        console.log(usr.isbanned)
        let html;
        if(!usr.isbanned){
            html = `
            <div class = "d-flex align-items-center">
            <tr>
                <th class = "fw-bold">${usr.idclient}</th>
                <td>
                    <span class = "ms-2 fw-light">${usr.firstname} ${usr.lastname}</span>
                </td>
                <td class = "mt-3">${usr.email}</td>
                <td>
                    <a href = "${window.location.origin + '/profile/' + usr.username}" class = "linkii"> <i class="fa-solid fa-eye"></i></a>
                    <a class="open-modal fw-bold linkii" data-target="modal-${(usr.idclient * 2)-1}"> <i class="fa-solid fa-ban"></i> </a>
                    <a class="open-modal fw-bold linkii" data-target="modal-${(usr.idclient  * 2)}"> <i class="fa-solid fa-trash"></i> </a>
                </td>
            </tr>
            </div>
            <div id="modal-${(usr.idclient  * 2)-1}" class="modal-window">
                <div class = "d-flex">
                    <h2>Ban Confirmation</h2>
                    <button class = "close modal-hide"><i class="fa-solid fa-x "></i></button>
                </div>
                <p class = "rfix">This is a confirmation message to make sure you really want to <span class = "fw-bold"> BAN </span>  the user <span class = "fw-bold"></span> </p>
                <p class = "rfix">If you do not wish to perform this action, just press close otherwise press the confirm button.</p>
                <div class = "d-flex">
                    <button class="modal-btn modal-hide cl">Close</button>
                    <form action="{{route('ban',['id' => $user->idclient])}}" method="post">
                        <input type="submit" class="modal-btn cf ms-3"  value="Confirm"/>
                        @method('put')
                        @csrf
                    </form>
                </div>
            </div>
            <div id="modal-${(usr.idclient * 2)}" class="modal-window">
                <div class = "d-flex">
                    <h2>Delete Confirmation</h2>
                    <button class = "close modal-hide"><i class="fa-solid fa-x "></i></button>
                </div>
                <p class = "rfix">This is a confirmation message to make sure you really want to <span class = "fw-bold"> DELETE </span> the user <span class = "fw-bold">${usr.firstname} ${usr.lastname}</span> </p>
                <p class = "rfix">If you do not wish to perform this action, just press close otherwise press the confirm button.</p>
                <div class = "d-flex">
                    <button class="modal-btn modal-hide cl">Close</button>
                    <form action="{{route('deleteUser',['id' => $user->idclient])}}" method="post">
                        <input class="modal-btn cf ms-3" type="submit" value="Confirm" />
                        @method('delete')
                        @csrf
                    </form>
                </div>
            </div>
            <div class="modal-fader"></div>
            `
        } else{
            html = `
            <div class = "d-flex align-items-center">
            <tr>
                <th class = "fw-bold">${usr.idclient}</th>
                <td>
                    <span class = "ms-2 fw-light">${usr.firstname} ${usr.lastname}</span>
                </td>
                <td class = "mt-3">${usr.email}</td>
                <td>
                    <a href = "${window.location.origin + '/profile/' + usr.username}" class = "linkii"> <i class="fa-solid fa-eye"></i></a>
                    <a class="unban fw-bold linkii" data-target=""><i class="fa-solid fa-ban"></i> </a>
                    <style>
                        .unban{
                            visibility: hidden;
                        }
                    </style>
                    <a class="open-modal fw-bold linkii" data-target="modal-${(usr.idclient  * 2)}"> <i class="fa-solid fa-trash"></i> </a>
                </td>
            </tr>
            </div>
            <div id="modal-${(usr.idclient  * 2)-1}" class="modal-window">
                <div class = "d-flex">
                    <h2>Ban Confirmation</h2>
                    <button class = "close modal-hide"><i class="fa-solid fa-x "></i></button>
                </div>
                <p class = "rfix">This is a confirmation message to make sure you really want to <span class = "fw-bold"> BAN </span>  the user <span class = "fw-bold"></span> </p>
                <p class = "rfix">If you do not wish to perform this action, just press close otherwise press the confirm button.</p>
                <div class = "d-flex">
                    <button class="modal-btn modal-hide cl">Close</button>
                    <form action="{{route('ban',['id' => $user->idclient])}}" method="post">
                        <input type="submit" class="modal-btn cf ms-3"  value="Confirm"/>
                        @method('put')
                        @csrf
                    </form>
                </div>
            </div>
            <div id="modal-${(usr.idclient * 2)}" class="modal-window">
                <div class = "d-flex">
                    <h2>Delete Confirmation</h2>
                    <button class = "close modal-hide"><i class="fa-solid fa-x "></i></button>
                </div>
                <p class = "rfix">This is a confirmation message to make sure you really want to <span class = "fw-bold"> DELETE </span> the user <span class = "fw-bold">${usr.firstname} ${usr.lastname}</span> </p>
                <p class = "rfix">If you do not wish to perform this action, just press close otherwise press the confirm button.</p>
                <div class = "d-flex">
                    <button class="modal-btn modal-hide cl">Close</button>
                    <form action="{{route('deleteUser',['id' => $user->idclient])}}" method="post">
                        <input class="modal-btn cf ms-3" type="submit" value="Confirm" />
                        @method('delete')
                        @csrf
                    </form>
                </div>
            </div>
            <div class="modal-fader"></div>
            `
        }

        Fhtml = Fhtml.concat(html)
    }

    document.querySelector('#tablecontent').insertAdjacentHTML('beforeend',Fhtml)
    functionPopInit()
}

function updateAdminAuction(){
    const text_query = this.value
    sendAjaxRequest('get','/search/auction/api?search_query='+text_query,{},updateAdminAuctionHandler )
}

function updateAdminAuctionHandler(){
    let item = JSON.parse(this.responseText);
    let user = document.querySelectorAll("#tablecontent tr")
    user.forEach(e => {
        e.remove()
    });

    let Fhtml = ``
    for(const usr of item){
        const html = `
        <div class = "d-flex align-items-center">
            <tr>
                <th class = "fw-bold">${usr.idauction}</th>
                <td>
                    <span class = "ms-2 fw-light">${usr.name}</span>
                </td>
                <td class = "mt-3">${usr.username}</td>
                <td>
                    <a href = "${window.location.origin + '/auction/' + usr.idauction}" class = "linkii"> <i class="fa-solid fa-eye"></i></a>
                    <a href = "${window.location.origin + '/edit/' + usr.idauction}" class = "linkii"> <i class="fa-solid fa-pencil"></i></a>
                    <a class="open-modal fw-bold linkii" data-target="modal-${usr.idauction}"> <i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        </div>
        <div id="modal-${usr.idauction}" class="modal-window">
            <div class = "d-flex">
                <h2>Delete Confirmation</h2>
                <button class = "close modal-hide"><i class="fa-solid fa-x "></i></button>
            </div>
            <p class = "rfix">This is a confirmation message to make sure you really want to <span class = "fw-bold"> DELETE </span>  the auction <span class = "fw-bold">${usr.name}</span> </p>
            <p class = "rfix">If you do not wish to perform this action, just press close otherwise press the confirm button.</p>
            <div class = "d-flex">
                <button class="modal-btn modal-hide cl">Close</button>
                <form action="{{route('deleteAuction',['id' => $auctions[$idx]['idauction']])}}" method="post">
                    <input class="modal-btn cf ms-3" type="submit" value="Confirm"/>
                    @method('delete')
                    @csrf
                </form>
            </div>
        </div>
        <div class="modal-fader"></div>
        `
        Fhtml = Fhtml.concat(html)
    }
    document.querySelector('#tablecontent').insertAdjacentHTML('beforeend',Fhtml)
    functionPopInit()
}
