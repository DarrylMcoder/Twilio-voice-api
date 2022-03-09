<?PHP
    
require('../vendor/autoload.php');
use \Twilio\TwiML\VoiceResponse;

$speechResult = $_POST['SpeechResult'];
$searchUrl = 'https://en.wikipedia.org/w/api.php?action=query&origin=%2A&generator=search&gsrnamespace=0&gsrlimit=5&gsrsearch=%27'.$speechResult.'%27&format=json';

$c = curl_init($searchUrl);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($c);
$results = json_decode($json, true);
$shints = '';
$hints = '';
foreach($results['query']['pages'] as $result){
  $shints .= $result['title'].' or ';
  $hints .= $result['title'].',';
}

$response = new VoiceResponse();
$response->gather([
  'action' => 'wiki.php',
  'method' => 'post',
  'input' => 'speech',
  'hints' => $hints
]);

$response->say('Did you mean '. $shints.'?');

echo $response;