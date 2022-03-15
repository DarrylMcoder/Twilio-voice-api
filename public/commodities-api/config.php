<?PHP
    
define('DB_SERVER', 'x8autxobia7sgh74.cbetxkdyhwsb.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'x9eh5wiqp0arpju8');
define('DB_PASSWORD', 'ijtabk6yglffd69z');
define('DB_NAME',     's4pio293om11fizo');
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}