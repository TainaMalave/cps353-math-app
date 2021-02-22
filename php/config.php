<?php
    class DB {
        protected $host = 'localhost';
        protected $dbname = 'trivia_game';
        protected $username = 'root';
        protected $password = '';
        public $connection;

        public function __construct() {
            $this->connection = new mysqli($this->host,$this->username, $this->password,$this->dbname);
        }
    }