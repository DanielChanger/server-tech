<?php

$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

$removeApps = new MongoDB\Driver\BulkWrite;
$removeApps->delete([], ['limit' => false]);
$result = $manager->executeBulkWrite('profile.applications', $removeApps);

if ($result) {
    echo nl2br("Applications collection refreshed successfully");
}

$removeDevs = new MongoDB\Driver\BulkWrite;
$removeDevs->delete([], ['limit' => false]);
$result = $manager->executeBulkWrite('profile.developers', $removeDevs);

if ($result) {
    echo nl2br("Developers collection refreshed successfully");
}

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

$result = $manager->executeBulkWrite('profile.applications', $insertApps);

if ($result) {
    echo nl2br("New applications documents inserted successfully");
}

$developer = array(
    "first_name" => "Daniel",
    "last_name" => "Miniailo",
    "group" => "121-16-1",
    "profile" => "Java Developer",
);

$insertDev = new MongoDB\Driver\BulkWrite;
$insertDev->insert($developer);
$result = $manager->executeBulkWrite('profile.developers', $insertDev);

if ($result) {
    echo nl2br("New developer document inserted successfully");
}

try {
    $readAppsIds = new MongoDB\Driver\Query([], ['name' => 0, 'created_at' => 0, "_id" => 1]);
    $result = $appsIds = $manager->executeQuery("profile.applications", $readAppsIds);

    if ($result) {
        echo nl2br("Apps _ids fetched successfully");
    }
} catch (\MongoDB\Driver\Exception\Exception $e) {
    echo $e->getTraceAsString();
    exit(1);
}
    $applications = array();
    foreach ($appsIds as $id) {
        array_push($applications, $id);
    }

    $updateDev = new MongoDB\Driver\BulkWrite;
    $updateDev->update(['first_name' => 'Daniel'], ['$set' => ['applications' => $applications]]);
    $result = $manager->executeBulkWrite('profile.developers', $updateDev);
    if ($result) {
        echo nl2br("Developer document updated successfully");
    }
?>
