<?php
include 'mongo/mongo-config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$findUser = new MongoDB\Driver\Query(['username' => $username, 'password' => $password], []);
try {
    $user = $dbManager->executeQuery("school.user", $findUser);
} catch (\MongoDB\Driver\Exception\Exception $e) {
    echo $e->getTraceAsString();
}

if ($user) {
//    header("Location: anotherDirectory/anotherFile.php?user=" . $user->toArray()["_id"]);
    echo "SUCCESS";
    echo $user;
} else {
//    header("Location: anotherDirectory/error.php");
    echo "FAILURE";
}
?>

