<?php

class MongoSource
{
    private $dbManager;

    /**
     * MongoSource constructor.
     */
    public function __construct()
    {
        $this->dbManager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    }

    public function getManager()
    {
        return $this->dbManager;
    }

    public function executeQuery($collectionName, $filters = [], $options = [])
    {
        return $this->getManager()
            ->executeQuery($collectionName, new MongoDB\Driver\Query($filters, $options))
            ->toArray();
    }

    public function getBulkWrite()
    {
        return new MongoDB\Driver\BulkWrite;
    }
}