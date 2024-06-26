<?php 

namespace Apps;

class Database {

    private $config = [];
    private $connections = null;

    function loadConfig(){
        $this->config['database'] = env('DB_NAME','');
        $this->config['drive'] = env('DB_DRIVER','');
        $this->config['host'] = env('DB_HOST','');
        $this->config['username'] = env('DB_USERNAME','');
        $this->config['password'] = env('DB_PASSWORD','');
    }

    function connect(){
        if($this->config['DB_DRIVER'] == 'mysql'){
            $this->connection = new mysqli(
                $this->config['host'],
                $this->config['username'],
                $this->config['password'],
                $this->config['database']
            );
        }else{
            die('Driver '.$this->config['DB_DRIVER'].' is not supported!');
        }
    }

    function disconnect(){
        if($this->isOpen()){
            $this->connection->close();
            $this->connection = null;
        }
    }

    function isOpen(){
        return $this->connection !== nul && $this->connection->ping();
    }

    function checkInitialMigration(){

    }

    function runQuery(){

    }

    function runNonQuery(){

    }
}