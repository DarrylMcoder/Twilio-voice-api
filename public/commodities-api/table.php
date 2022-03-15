<?PHP

ini_set('error_reporting', E_ALL ^ E_NOTICE); 
ini_set('display_errors', 1);
    
include('config.php');
$sql = 'CREATE TABLE users(
id INT AUTO_INCREMENT PRIMARY KEY,
phone BIGINT NOT NULL UNIQUE,
created_at BIGINT NOT NULL,
voice VARCHAR(255),
balance INT,
plan VARCHAR(255),
currency VARCHAR(255)
)';
$mysqli->query($sql);
echo $mysqli->error;