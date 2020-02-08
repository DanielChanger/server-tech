<?php
set_include_path("/opt/lampp/htdocs/lab3/");

require '/domain/UsersService.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include 'lab3/view/login.html';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $userService = new UsersService();
    $user = $userService->getUserByCreds($username, $password);

    if ($user) {
        session_start();
        $_SESSION['isAdmin'] = $user->toArray()['isAdmin'];
        $_SESSION['group'] = $user->toArray()['group'];
        header('HTTP/1.1 201 Created');

    } else {
        header("HTTP/1.1 401 Unauthorized");
    }

}

