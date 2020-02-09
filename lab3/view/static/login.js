function handleRequest() {
    let loginForm = document.getElementById("login-form");
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            console.log(this.status);
            if (this.status === 201) {
                successHandler(xhttp);
            } else {
                failureHandler(xhttp);
            }
        }
    };
    xhttp.open("POST", "https://localhost/lab3/controller/login.php", true);
    xhttp.send(new FormData(loginForm));
}

function successHandler(xhttp) {
    alert("You are logged in. CONGRATS");
    xhttp.open("GET", "https://localhost/lab3/controller/groups.php", true);
    xhttp.send();
}


function failureHandler(xhttp) {
    alert("SOMETHING WENT WRONG");

}