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
    const groups = JSON.parse(xhttp.responseText).groups;
    groups.forEach((group) => {
        let groupNode = document.createElement("p");
        let groupNumber = document.createTextNode(group.number);
        groupNode.addEventListener('click', () => {
            getGroupInfo(groupNumber);
        });
        groupNode.appendChild(groupNumber);
        let groupsDiv = document.getElementById("groups");
        groupsDiv.appendChild(groupNode);
    });
}

function getGroupInfo(groupNum) {
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
    xhttp.open("GET", "https://localhost/lab3/controller/groups.php?number=" + groupNum, true);
    xhttp.send();
}

function failureHandler(xhttp) {

}