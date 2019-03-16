<?php 
spl_autoload_register(function($class_name){
        include("class/".$class_name.".php");
    });

class DB{
	private static $pdo;
	public static function connection(){
		if (!isset(self::$pdo)) {
			try {
				self::$pdo =new PDO('mysql:host=localhost;port=3306;dbname=oop','root','',
                  array(PDO::ATTR_PERSISTENT => true));
			} catch (PDOException $e) {
				echo $e->getMessage();
				}
		}
		return self::$pdo;
	}

	public static function prepare($sql){
		return self::connection()->prepare($sql);
	}
}


?>