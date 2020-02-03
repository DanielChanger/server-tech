<?php
$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$bulk = new MongoDB\Driver\BulkWrite;

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

$manager->executeBulkWrite('profile.applications', $bulk);


$programmer = array(
    "first_name" => "Daniel",
    "last_name" => "Miniailo",
    "group" => "121-16-1",
    "profile" => "Java Developer",
    "Applications" => array(
        MongoDBRef::create('applications', $applicationsList[0]['_id']),
        MongoDBRef::create('applications', $applicationsList[1]['_id']),
        MongoDBRef::create('applications', $applicationsList[2]['_id']),
    )
);

$manager->executeBulkWrite('profile.programmers', $app);

?>
