<?PHP
    
require('../../vendor/autoload.php');
require('User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();
$number = $_POST['Caller'];
$user = new User($number);

switch($_POST['Digits']){
  case 1:
    header('Location: text/text.php');
    break;
    
  case 2:
    header('Location: email/email.php');
    break;
    
  case 3:
    header('Location: whatsapp/whatsapp.php');
    break;
    
  case 7: 
    header('Location: account/acount.php');
    break;
    
  case 8:
    $response->say('The Email Machine is a telephone service for providing basic access to email over the landline.', [
      'voice' => $user->voice;
      'language' => $user->language;
    ]);
    break;
    
  case '*':
    header('Location: welcome.php');
    break;
    
  case '#':
    header('Location: welcome.php');
    break;
    
  default:
    $response->say('The number you entered was not valid.', [
      'voice' => $user->voice;
      'language' => $user->language;
    ]);
}
echo $response;