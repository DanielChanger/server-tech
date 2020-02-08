<?php

include 'lab3/mongo/mongo-config.php';
include 'lab3/auth/sessionFilter.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if ((bool) $_SESSION['isAdmin']) {
        $options = [
            'projection' => ['_id' => 0, 'number' => 1],
        ];
        $getGroups = new MongoDB\Driver\Query([], $options);
        try {
            $groups = $manager->executeQuery('reporting.group', $getGroups);
            $response = ['groups:' => $groups];
            echo json_encode($response);

        } catch (\MongoDB\Driver\Exception\Exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
            echo $e->getTraceAsString();
            exit();
        }

    } else {
        header("HTTP/1.1 200 OK");
        $response = ['groups' => [$_SESSION['group']]];
        echo json_encode($response);
    }
}
