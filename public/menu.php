<?PHP
    
require('../vendor/autoload.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

switch($_POST['digits']){
  case 1:
    $response->redirect('wikipediaMain.php');
    break;
  
  case 2:
    $response->redirect('account.php');
    break;
  
  case 8:
    $response->redirect('about.php');
}

echo $response;