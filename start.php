<?
define("HANDLER_DIR", "./model/handlers");
define("FILE_DIR", $_SERVER['DOCUMENT_ROOT']."/misc/");

date_default_timezone_set('Europe/Moscow');

spl_autoload_register(function ($class_name) {
	if(file_exists($_SERVER['DOCUMENT_ROOT'].'/classes/'.$class_name.'.php')){
    	include_once $_SERVER['DOCUMENT_ROOT'].'/classes/'.$class_name.'.php';
	}
});
try {
	$host = "localhost";
	$dbname = "SmartLeads";
	$username = "root";
	$password = "";
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, 
        array(
            PDO::ATTR_PERSISTENT => true,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        )
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Произошла ошибка: " . $e->message();
    die();
}
?>