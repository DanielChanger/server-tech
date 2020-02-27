<?php

require_once(__DIR__ . '/../includes.php');

class UsersService extends AbstractDomainService
{
    private $collectionName = DB_NAME . '.users';

    public function getUserByCreds(string $username, string $password)
    {
        $filters = ['username' => $username, 'password' => $password];
        return $this->dataSource->executeQuery($this->collectionName, $filters);
    }

    public function getStudentsByIds($studentIds) {
        $filters = ['oid' => ['$in' => $studentIds]];
        return $this->dataSource->executeQuery($this->collectionName, $filters);
    }
}