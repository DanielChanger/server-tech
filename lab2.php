<?php

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$removeApps = new MongoDB\Driver\BulkWrite;
$removeApps->delete([], ['limit' => false]);
$manager->executeBulkWrite('profile.applications', $removeApps);

$removeDevs = new MongoDB\Driver\BulkWrite;
$removeDevs->delete([], ['limit' => false]);
$manager->executeBulkWrite('profile.developers', $removeDevs);

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
        "created_at" => new DateTime()
    )
);

$insertApps = new MongoDB\Driver\BulkWrite;
foreach ($applicationsList as $app) {
    $insertApps->insert($app);
}

$manager->executeBulkWrite('profile.applications', $insertApps);

$developer = array(
    "first_name" => "Daniel",
    "last_name" => "Miniailo",
    "group" => "121-16-1",
    "profile" => "Java Developer",
);

$insertDev = new MongoDB\Driver\BulkWrite;
$insertDev->insert($developer);
$manager->executeBulkWrite('profile.developers', $insertDev);

try {
    $readAppsIds = new MongoDB\Driver\Query([], ['name' => 0, 'created_at' => 0, "_id" => 1]);
    $appsIds = $manager->executeQuery("profile.applications", $readAppsIds);

} catch (\MongoDB\Driver\Exception\Exception $e) {
    echo $e->getTraceAsString();
    exit(1);
}
    $applications = array();
    foreach ($appsIds as $id) {
        array_push($applications, $id);
    }

echo '<pre>'; print_r($applications); echo '</pre>';

    $updateDev = new MongoDB\Driver\BulkWrite;
    $updateDev->update(['first_name' => 'Daniel'], ['$set' => ['applications' => $applications]]);
    $manager->executeBulkWrite('profile.developers', $updateDev);
?>
