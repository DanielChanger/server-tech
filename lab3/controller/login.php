<?php

require_once(__DIR__ . '/../domain/UsersService.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    require(__DIR__ . '/../view/login.html');
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $userService = new UsersService();
    $user = $userService->getUserByCreds($username, $password)[0];

    if (!empty($userResult)) {
        session_start();
        $_SESSION['isAdmin'] = isset($user->isAdmin) ? $userResult->isAdmin : false;
        $_SESSION['group'] = isset($user->group) ? $userResult->group : null;
        header('HTTP/1.1 201 Created');

    } else {
        header("HTTP/1.1 401 Unauthorized");
    }

    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    session_abort();
    require(__DIR__ . '/../view/login.html');
    exit;
}

