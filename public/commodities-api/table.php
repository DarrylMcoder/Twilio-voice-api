<?PHP
    
include('config.php');
$sql = 'CREATE TABLE users(
id INT AUTO_INCREMENT,
phone BIGINT NOT NULL UNIQUE,
created_at BIGINT NOT NULL,
voice VARCHAR(255),
balance INT,
plan VARCHAR(255),
currency VARCHAR(255)
)';
$mysqli->query($sql);
echo $mysqli->error;