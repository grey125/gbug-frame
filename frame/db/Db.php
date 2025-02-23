<?php

namespace frame\db;
use PDO;
use PDOException;

class DB{
	
	static public $host = null;
	static public $user = null;
	static public $pwd = null;
	static public $dbname = null;
	static public $conn = null;
	
	private static $pdo = null;
	
	static public function config($host,$user,$pwd,$dbname){
		self::$host = $host;
		self::$user = $user;
		self::$pwd = $pwd;
		self::$dbname = $dbname;
		self::connect();
	}
	
	static public function pdo(){
		if (self::$pdo !== null) {
			return self::$pdo;
		}
		try {
			$dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', self::$host, self::$dbname);
			$option = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
			return self::$pdo = new PDO($dsn, self::$user, self::$pwd, $option);
		} catch (PDOException $e) {
			exit($e->getMessage());
		}
		
	}
	static public function connect(){
		self::$conn = mysqli_connect(self::$host,self::$user,self::$pwd);
		mysqli_select_db(self::$conn,self::$dbname);
		mysqli_query(self::$conn,"set names uft8");	
	}

	static public function query($sql){
		return mysqli_query(self::$conn,$sql);
	}
	static public function farray($result){
		return mysqli_fetch_array($result);
	}
	static public function assoc($result){
		return mysql_fetch_assoc($result);
	}
	static public function rows($result){
		return mysql_num_rows($result);
	}
	static public function select($tablename){
		return self::query("select * from $tablename");
	}
	static public function insert($tableName,$fields,$value){
		self::query("insert into $tableName ($fields) values ($value)");
	}
	static public function update($tableName,$change,$condition){
		self::query("update $tableName set $change $condition");
	}
	static public function del($tableName,$condition){
		self::query("delete from $tableName $condition");
	}
	static public function error($result){
		return mysqli_error(self::$conn);
	}
}

$DB = (new DB());

?>