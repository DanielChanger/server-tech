<?php

require_once (__DIR__.'/../domain/UsersService.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    require (__DIR__.'/../view/login.html');

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $userService = new UsersService();
    $user = $userService->getUserByCreds($username, $password);

    if ($user) {
        session_start();
        $userResult = $user->toArray();
        echo $userResult;
        $_SESSION['isAdmin'] = $userResult[0]['isAdmin'];
        $_SESSION['group'] = $userResult[0]['group'];
        header('HTTP/1.1 201 Created');

    } else {
        header("HTTP/1.1 401 Unauthorized");
    }
} else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    session_abort();
    require (__DIR__.'/../view/login.html');
}

