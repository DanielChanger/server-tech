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
    // alert("You are logged in. CONGRATS");
    window.open("https://localhost/lab3/view/groups.html","_self");
}


function failureHandler(xhttp) {
    // alert("SOMETHING WENT WRONG");
}