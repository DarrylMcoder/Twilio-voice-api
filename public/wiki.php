<?PHP
        
require('../vendor/autoload.php');
use \Twilio\TwiML\VoiceResponse;

$speechResult = $_POST['SpeechResult'];
$url = 'https://en.wikipedia.org/w/api.php?action=query&prop=extracts&titles='.$speechResult.'&exintro=1&explaintext=1&exsectionformat=plain&format=json';

$c = curl_init($url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($c);
$results = json_decode($json, true);

foreach($results['query']['pages'] as $res){
  $say = $res['extract'];
  
}
$response = new VoiceResponse();
$response->say($say,['voice' => 'Polly.Matthew']);
$response->pause(['length' => 3]);
$response->redirect('main.php');
echo $response;