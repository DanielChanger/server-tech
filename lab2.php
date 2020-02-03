<?php
$connection = new MongoClient();
$connection->selectDB("profile");

try {
    $applications = $connection->selectDB("profile")->selectCollection("applications");
    $programmers = $connection->selectDB("profile")->selectCollection("programmers");

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
        $applications->insert($app);
    }

    $programmer = array(
        "first_name" => "Daniel",
        "last_name" => "Miniailo",
        "group" => "121-16-1",
        "profile" => "Java Developer",
        "Applications" => array(
            MongoDBRef::create("applications", $applicationsList[0]['_id']),
            MongoDBRef::create("applications", $applicationsList[1]['_id']),
            MongoDBRef::create("applications", $applicationsList[2]['_id']),
        )
    );

    $programmers->insert($programmer);


} catch (Exception $e) {
    echo "Something went wrong";
}

$connection->close();

?>
