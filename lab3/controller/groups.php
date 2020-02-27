<?php

require_once(__DIR__ . '/../domain/GroupsService.php');
require_once(__DIR__ . '/../domain/UsersService.php');
require_once(__DIR__ . '/../filter/sessionFilter.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$groupId = null;

if ($uri[1] !== 'groups') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

if (isset($uri[2])) {
    $groupNumber = $uri[2];
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $groupsService = new GroupsService();

    if ($groupNumber != null) {
        $usersService = new UsersService();
        $group = $groupsService->getGroupByNumber($groupNumber);
        $studentsIds = array_map(function ($el) { return $el.oid; }, $group->students);
        $groupStudents = $usersService->getStudentsByIds($studentsIds);
        $response = ['students' => $groupStudents];
        header("HTTP/1.1 200 OK");
        echo json_encode($response);

    } else {
        if ((bool)$_SESSION['isAdmin']) {
            $groups = $groupsService->getAllGroupsNumbers();
            $response = ['groups' => $groups];

            header("HTTP/1.1 200 OK");
            echo json_encode($response);


        } else {
            header("HTTP/1.1 200 OK");
            $response = ['groups' => [$_SESSION['group']]];
            echo json_encode($response);
        }
    }
}
