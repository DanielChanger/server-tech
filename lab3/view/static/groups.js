window.addEventListener(
    'loadstart', () => getGroups()
);

function getGroups() {
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                successHandler(xhttp);
            } else {
                failureHandler(xhttp);
            }
        }
    };
    xhttp.open("GET", "https://localhost/lab3/controller/groups.php", true);
    xhttp.send();
}


function successHandler(xhttp) {
    console.log(xhttp.responseText);
}

function failureHandler(xhttp) {

}