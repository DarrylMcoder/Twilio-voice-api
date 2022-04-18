<?PHP
    
require('../vendor/autoload.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

switch($_REQUEST['Digits']){
  case 1:
    $response->redirect('wikipediaMain.php');
    break;
  
  case 2:
    $response->redirect('account.php');
    break;
  
  case 8:
    $response->redirect('about.php');
    break;
    
  default:
    $response->say('You entered: '.$_POST['Digits'].'. Please enter valid input.',['voice' => 'Polly.Matthew']);
    $response->redirect('main.php');
}

echo $response;