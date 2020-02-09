window.addEventListener(
    'load', () => getGroups()
);

function getGroups() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                successHandler(this);
            } else {
                failureHandler(this);
            }
        }
    };
    xhttp.open("GET", "https://localhost/lab3/controller/groups.php", true);
    xhttp.send();
}


function successHandler(xhttp) {
    console.log(JSON.parse(xhttp.responseText));
    console.log(JSON.parse(xhttp.responseText).results);
}

function failureHandler(xhttp) {

}