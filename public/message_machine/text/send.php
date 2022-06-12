<?PHP
    
require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
use \Twilio\Rest\Client;
$response = new VoiceResponse();
$user = new User($number);
$number = $_GET['number'];
$message = $_GET['message'];
switch($_POST['Digits']){
  case 1:
    $sid = getenv('TWILIO_SID');
    $token = getenv('TWILIO_TOKEN');
    $my_number = getenv('MY_NUMBER');
    $client = new Client($sid, $token);

    $client->messages->create(
        $number,
        [
            'from' => $my_number,
            'body' => $message
        ]
    );
    $response->say('Your message has been sent.',[
  'voice' => $user->voice,
  'language' => $user->language
]);
    break;
  case 2:
    header("Location: message.php?number=$number");
    break;
  case 3:
    header('Location: number.php');
    break;
}