<?php
class Dbconfig {
    protected $serverName;
    protected $userName;
    protected $passCode;
    protected $dbName;

    function Dbconfig() {
        $this -> serverName = 'localhost';
        $this -> userName = 'dishant';
        $this -> passCode = 'dishant';
        $this -> dbName = 'library_system';
    }
}
?>