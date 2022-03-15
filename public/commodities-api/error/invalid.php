<?PHP
    
require('../../vendor/autoload.php');
include('../functions.php');
include('../config.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();
$from = $_POST['From'];
$user = getUser($from,$mysqli);
$response->say('Invalid input. Please try again.',['voice' => $user['voice']]);
$response->redirect(dirname($_SERVER['HTTP_REFERER']).'/main.php');
echo $response;