<?PHP
    
//ini_set('error_reporting', E_ALL ^ ?E_NOTICE); 
//ini_set('display_errors', 1);

include('config.php');
include('functions.php');
require('../../vendor/autoload.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();
$from = $_POST['From'];

$gather = $response->gather([
  'action' => 'main_menu.php',
  'method' => 'post'
]);

$gather->say('Thank you for calling your prices assistant. ',['voice' => 'Polly.Matthew']);

if(isNewUser($from,$mysqli)){
  $response->redirect('newUser.php');
  echo $response;
  exit;
}

$user = getUser($from,$mysqli);

if(trialEnded($user) && !paidUp($user)){
  $gather->say('Your free trial has ended. You can choose to upgrade to a plan of 5 dollars per month, or continue using the free plan with access to only basic features.',['voice' => $user['voice']]);
}elseif(!trialEnded($user)){
  $gather->say('You have '.getFreeHoursLeft($user).' hours of free trial left. After your trial has ended this service will continue to work, but with limited access to some features. Please consider upgrading to a plan of 5 dollars per month. You can hear the details in your account menu.',['voice' => $user['voice']]);
}

$response->redirect('index.php');

echo $response;