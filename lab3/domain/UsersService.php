<?php

require_once './constants.php';
require_once './AbstractDomainService.php';

class UsersService extends AbstractDomainService
{
    private $collectionName = DB_NAME . 'users';

    public function getUserByCreds(string $username, string $password)
    {
        $filters = ['username' => $username, 'password' => $password];
        return $this->dataSource->executeQuery($this->collectionName, $filters);
    }


}