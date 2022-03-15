<?PHP
    
require('../vendor/autoload.php');
include('functions.php');
include('config.php');
use \Twilio\TwiML\VoiceResponse;
$from = $_POST['From'];
$notice = getNotice($from,$mysqli);
$user = getUser($from,$mysqli);

$response = new VoiceResponse();
$gather = $response->gather([
  'action' => 'main_menu.php',
  'method' => 'post'
]);

$gather->say('For the latest prices, press one. For historical data, press two. For our currency calculator, press three. For your account, press four. For more information on the Assistant, press five.',['voice' => $user['voice']]);

$response->say('Please enter a valid key.', ['voice' => $user['voice']]);

$response->redirect('index.php');

echo $response;