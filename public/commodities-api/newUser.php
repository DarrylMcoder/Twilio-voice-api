<?PHP
    
ini_set('error_reporting', E_ALL ^ ?E_NOTICE); 
ini_set('display_errors', 1);
require('../../vendor/autoload.php');
include('functions.php');
include('config.php');
use \Twilio\TwiML\VoiceResponse;
$from = $_POST['From'];
createUser($from,$mysqli);
$response = new VoiceResponse();

$response->say('An account has been created for you with 48 hours free trial period. After your trial has expired, you can choose to upgrade to a plan of 5 dollars per month, or continue using the limited version with paid features removed.',['voice' => 'Polly.Matthew']);

$response->redirect('index.php');

echo $response;