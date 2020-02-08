<?php

require_once (__DIR__.'/../mongo/MongoSource.php');

abstract class AbstractDomainService
{
    protected $dataSource;

    public function __construct()
    {
        $this->dataSource = new MongoSource();
    }
}