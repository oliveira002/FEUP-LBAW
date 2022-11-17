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
    for(const auc of item){
        const html = `
        <div class="d-flex flex-column ps-3 pe-3 pt-3 ">
                <div class = "itemauc">
                    <a href="{{route('auction',['id' => ${auc.idauction}])}}"><img src= "../alo.jpg" width="287" height="190"></a>
                    <a href="{{route('auction',['id' => ${auc.idauction}])}}">
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
    document.querySelector('#auction').insertAdjacentHTML('beforeend',Fhtml)

}

function updateAuction(){
    const text_query = this.value
    const url = window.location.pathname.split('/')
    const category = url.length > 2 ? url[2] : null
    sendAjaxRequest('get','/search/api?category=' + category + '&search_query='+text_query,{},auctionUpdatedHandler )
}
