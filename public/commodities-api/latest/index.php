<?PHP
    
require('../../../vendor/autoload.php');
include('../functions.php');
include('../config.php');
use \Twilio\TwiML\VoiceResponse;

$from = $_POST['From'];
$user = getUser($from, $mysqli);
$response = new VoiceResponse();

$gather = $response->gather([
  'action' => 'index.php',
  'method' => 'post'
]);

$results = getCachedJSONArray('https://www.commodities-api.com/api/symbols?access_key='.getenv('COMMODITIES-API-ACCESS-KEY'), $user, 60*60*24*7);
$numRes = array_values($results);

$digits = $_REQUEST['Digits'];
if(ctype_digit($digits)){
  $item = array_search($numRes[$digits],$results);
  header('Location: readPrice.php?item='.$item.'&index='.$digits);
  exit;
}

if(strpos($digits,'*') === 0){
  $index = trim($digits,'* #');
}else{
  $index = 1;
}

$gather->say('Dial the number of the commodity you want. I will read the list to you in a moment. You can dial star, followed by any number, to start reading at that item.',['voice' => $user['voice']]);

for($i = $index; $i < count($results); $i++;){
  if($i < 10){
    $gather->say('For '.$numRes[$index].', dial '.$index.'.', ['voice' => $user['voice']]);
  }else{
    $gather->say('For '.$numRes[$index].', '.$index.'.', ['voice' => $user['voice']]);
  }
}

$response->redirect('../');

echo $response;