<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DB
 *
 * @author enriquegomezpena
 */
require "rb-mysql.php";
//require "rb-mysql.php";

class DBSingleton {

    private static $instance;
    private $redBean;

    private function __construct() {
        $this->redBean = new R();
        $this->redBean->setup("mysql:host=localhost;dbname=allchances_db", "root", "");
        //$this->redBean->setup("mysql:host=localhost;dbname=TB", "root", "");
        //this->redBean->setup("mysql:host=localhost;dbname=c0600180_mycity","root","");
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new DBSingleton();
        }
        return self::$instance;
    }

    function getRedBean() {
        return $this->redBean;
    }

}
