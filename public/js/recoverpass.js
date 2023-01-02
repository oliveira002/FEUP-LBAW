const url = window.location.href;
const searchTerm = '?email=';
const index = url.indexOf(searchTerm);
let email = url.substring(index+searchTerm.length)
email = decodeURIComponent(email)

document.getElementById('recoveryEmail').value=email
