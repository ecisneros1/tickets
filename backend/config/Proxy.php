<?php

class Proxy{
    //public $proxy='http://localhost:80/tickets/backend/api/';
    public $proxy='http://www.it3.com.ec/pruebas/tickets/backend/api/';

    function __constructor(){}

    /**
     * Get the value of proxy
     */ 
    public function getProxy()
    {
        return $this->proxy;
    }

    /**
     * Set the value of proxy
     *
     * @return  self
     */ 
    public function setProxy($proxy)
    {
        $this->proxy = $proxy;

        return $this;
    }
}

?>