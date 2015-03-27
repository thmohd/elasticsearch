<?php

class Company {

    const INDEX = 'company';
    protected static $client;


    /**
     * Constructor
     */
    public function __construct(){
        self::$client = new Elasticsearch\Client();
    }

    /**
     * avoid duplication
     * @return Company
     */
    protected function getInstance(){
        if(!self::$client){
            self::$client = new self();
        }

        return self::$client;

    }

}