<?php

require (__DIR__ . '/../mongo/constants.php');
require (__DIR__.'/../domain/AbstractDomainService.php');

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