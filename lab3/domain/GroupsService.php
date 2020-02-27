<?php

require_once(__DIR__ . '/../includes.php');

class GroupsService extends AbstractDomainService
{
    private $collectionName = DB_NAME . '.groups';

    public function getAllGroupsNumbers()
    {
        $options = ['projection' => ['number' => 1, '_id' => 0,]];
        return $this->dataSource->executeQuery($this->collectionName, [], $options);
    }

    public function getGroupByNumber($number) {
        $filters = ['number' => $number];
        return $this->dataSource->executeQuery($this->collectionName, $filters);
    }

}