<?php

abstract class AbstractDomainService
{
    protected $dataSource;

    public function __construct()
    {
        $this->dataSource = new MongoSource();
    }
}