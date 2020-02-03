<?php

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$bulk = new MongoDB\Driver\BulkWrite;
$read = new MongoDB\Driver\Query([], ['_id' => 1, 'total' => 1]);

$bulk->delete([], ['limit' => 0]);
$manager->executeBulkWrite('profile.applications', $bulk);
$manager->executeBulkWrite('profile.programmers', $bulk);


$applicationsList = array(
    array(
        "name" => "flOw",
        "createdAt" => new DateTime(),
    ),
    array(
        "name" => "Flower",
        "createdAt" => new DateTime()
    ),
    array(
        "name" => "The Journey",
        "createdAt" => new DateTime()
    )
);


foreach ($applicationsList as $app) {
    $bulk->insert($app);
}

try {
    $appsIds = $manager->executeQuery("profile.applications", $read);

    $manager->executeBulkWrite('profile.applications', $bulk);
    $programmer = array(
        "first_name" => "Daniel",
        "last_name" => "Miniailo",
        "group" => "121-16-1",
        "profile" => "Java Developer",
        "applications" => array()
    );

    foreach ($appsIds as $id) {
        array_push($programmer['applications'], $id);
    }

    $manager->executeBulkWrite('profile.programmers', $bulk);

} catch (\MongoDB\Driver\Exception\Exception $e) {
    echo "Fetching apps ids is failed";
    echo $e->getTraceAsString();
    exit(1);
}
?>
