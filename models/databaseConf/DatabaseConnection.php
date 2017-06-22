<?php

class DatabaseConnection
{
    private $host;
	private $username;
	private $password;
	private $database;

    private $connection;
	private static $instance;
	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
        $this->host = DB_HOST;
        $this->username = DB_USERNAME;
        $this->password = DB_PASSWORD;
        $this->database = DB_NAME;

		$this->connection = new mysqli($this->host, $this->username,
			$this->password, $this->database);

		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}

	private function __clone() {}

	public function getConnection() {
		return $this->connection;
	}

    public function __destruct(){
        mysqli_close($this->connection);
    }
}
