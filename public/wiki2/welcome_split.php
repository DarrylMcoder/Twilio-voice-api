<?PHP
    
require('../../vendor/autoload.php');
require('User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();
$number = $_GET['Caller'];
$user = new User($number);

switch($_REQUEST['Digits']){
  case 1:
    $response->redirect('search/input.php');
    break;
    
  case 7: 
    $response->redirect('account/acount.php');
    break;
    
  case 8:
    $response->say('About', [
      'voice' => $user->voice,
      'language' => $user->language
    ]);
    $response->redirect('welcome.php');
    break;
    
  case '*':
    $response->redirect('welcome.php');
    break;
        
  case '#':
    $response->redirect('welcome.php');
    break;
    
  default:
    $response->say('The number you entered was not valid.', [
      'voice' => $user->voice,
      'language' => $user->language
    ]);
    $response->redirect('welcome.php');
}
echo $response;