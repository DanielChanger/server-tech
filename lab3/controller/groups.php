<?php

require_once(__DIR__ . '/../domain/GroupsService.php');
require_once(__DIR__ . '/../filter/sessionFilter.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $groupsService = new GroupsService();

    if ((bool) $_SESSION['isAdmin']) {
        $groups = $groupsService->getAllGroupsNumbers();
        $response = ['groups:' => $groups];
        echo json_encode($response);

    } else {
        header("HTTP/1.1 200 OK");
        $response = ['groups' => [$_SESSION['group']]];
        echo json_encode($response);
    }
}
