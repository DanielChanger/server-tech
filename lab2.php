<?php

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$removeDevs = new MongoDB\Driver\BulkWrite;
$removeDevs->delete([], ['limit' => false]);
$manager->executeBulkWrite('profile.developers', $removeDevs);

$developer = array(
    "first_name" => "Daniel",
    "last_name" => "Miniailo",
    "group" => "121-16-1",
    "profile" => "Java Developer",
    "applications" => []
);

$insertDev = new MongoDB\Driver\BulkWrite;
$insertDev->insert($developer);
$devCursor = $manager->executeBulkWrite('profile.developers', $insertDev);

$applications = [
    [
        "name" => "flOw",
        "createdAt" => new DateTime(),
    ],
    ["name" => "Flower",
        "createdAt" => new DateTime()
    ],
    [
        "name" => "The Journey",
        "created_at" => new DateTime()
    ]
];

$updateDev = new MongoDB\Driver\BulkWrite;
$updateDev->update([], ['$set' => ['applications' => $applications]]);
$manager->executeBulkWrite('profile.developers', $updateDev);

$fetchDeveloper = new MongoDB\Driver\Query([], []);
try {
    $fetchedDev = $manager->executeQuery('profile.developers', $fetchDeveloper);
    echo '<pre>';
    print_r($fetchedDev->toArray());
    echo '</pre>';
} catch (\MongoDB\Driver\Exception\Exception $e) {
    echo $e->getTraceAsString();
}
?>
