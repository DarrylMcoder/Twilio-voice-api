<?PHP
/*
ini_set('error_reporting', E_ALL ^ E_NOTICE); 
ini_set('display_errors', 1); //*/
    
require('../vendor/autoload.php');
use \Twilio\TwiML\VoiceResponse;

$textSpeechResult = trim($_REQUEST['SpeechResult'],'. ');
$speechResult = urlencode($textSpeechResult);
$searchUrl = 'https://en.wikipedia.org/w/api.php?action=query&origin=%2A&generator=search&gsrnamespace=0&gsrlimit=5&gsrsearch=%27'.$speechResult.'%27&format=json';

$c = curl_init($searchUrl);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($c);
$results = json_decode($json, true);
foreach($results['query']['pages'] as $page){
  $pages[] = $page['title'];
}
$shints = implode(', or ', $pages);
$hints = implode(',', $pages);

if(in_array($textSpeechResult, $pages)){
  $response->redirect('wiki.php?SpeechResult='.$textSpeechResult);
}

$response = new VoiceResponse();
$gather = $response->gather([
  'action' => 'wiki.php',
  'method' => 'post',
  'input' => 'speech',
  'hints' => $hints,
  'finishOnKey' => '#'
]);

$gather->say('I found several similar pages in the encyclopedia. Which of the following were you looking for: '. $shints.'?',['voice' => 'Polly.Matthew']);

$response->say('I\'m sorry. I didn\'t hear that. Please try again.',['voice' => 'Polly.Matthew']);

$response->redirect('wikipediaMain.php');


echo $response;