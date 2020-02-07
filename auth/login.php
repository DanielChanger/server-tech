<?php
include 'mongo/mongo-config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$findUser = new MongoDB\Driver\Query(['username' => $username, 'password' => $password], []);
try {
    $user = $dbManager->executeQuery("reporting.user", $findUser);
} catch (\MongoDB\Driver\Exception\Exception $e) {
    echo $e->getTraceAsString();
}

if ($user) {
    session_start();
    $_SESSION['isAdmin'] = (bool) $user->toArray()['isAdmin'];

    echo $user;
    header("Location: groups/groups.php" . $user->toArray()["_id"]);

} else {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}
?>

