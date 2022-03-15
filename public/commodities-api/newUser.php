<?PHP
    
ini_set('error_reporting', E_ALL ^ ?E_NOTICE); 
ini_set('display_errors', 1);
require('../../vendor/autoload.php');
include('functions.php');
include('config.php');
use \Twilio\TwiML\VoiceResponse;
$from = $_POST['From'];
//createUser($from,$mysqli);
echo $mysqli->error;
$response = new VoiceResponse();

$response->say('An account has been created for you with 24 hours free trial period. After your trial has expired, you can choose to upgrade to a plan of 5 dollars per month, or continue using the free version with limited access to some features.',['voice' => 'Polly.Matthew']);

$response->redirect('index.php');

echo $response;