<?php

require 'constants.php';
require 'AbstractDomainService.php';

class GroupsService extends AbstractDomainService
{
    private $collectionName = DB_NAME . 'groups';

    public function getAllGroups()
    {
        $groups = $this->dataSource->executeQuery($this->collectionName);
        return $groups->toArray();
    }

}