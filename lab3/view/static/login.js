function handleRequest() {
    let loginForm = document.getElementById("login-form");
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
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
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (!this.status === 200) {
                failureHandler(xhttp);
            }
        }
        xhttp.open("GET", "https://localhost/lab3/controller/groups.php", true);
        xhttp.send();
    }
}


function failureHandler(xhttp) {
    alert("SOMETHING WENT WRONG");
}