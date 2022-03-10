<?PHP
/*
ini_set('error_reporting', E_ALL ^ E_NOTICE); 
ini_set('display_errors', 1); //*/
    
require('../vendor/autoload.php');
use \Twilio\TwiML\VoiceResponse;

$speechResult = $_POST['SpeechResult'];
$searchUrl = 'https://en.wikipedia.org/w/api.php?action=query&origin=%2A&generator=search&gsrnamespace=0&gsrlimit=5&gsrsearch=%27'.$speechResult.'%27&format=json';

$c = curl_init($searchUrl);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($c);
$results = json_decode($json, true);
$shints = implode(' or ', $results['query']['pages']);
$hints = implode(',', $results['query']['pages']);

$response = new VoiceResponse();
$gather = $response->gather([
  'action' => 'wiki.php',
  'method' => 'post',
  'input' => 'speech',
  'hints' => $hints
]);

$gather->say('Did you mean '. $shints.'?');


echo $response;