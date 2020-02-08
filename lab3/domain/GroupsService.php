<?php
include_once './constants.php';

class GroupsService extends AbstractDomainService
{
    private $collectionName = DB_NAME . 'groups';

    public function getAllGroups()
    {
        $groups = $this->dataSource->executeQuery($this->collectionName);
        return $groups->toArray();
    }

}