<?PHP
    
require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$number = $_GET['Caller'];
$user = new User($number);

$q = $_GET['SpeechResult'];
$q = trim($q,'. ');
$json = get_wiki_json($q);

foreach($json['query']['pages'] as $page){
  $title = $page['title'];
  $pages[] = $title;
  if(strtolower($title) === strtolower($q)){
    $response->redirect("wiki.php?title={$title}");
  }
}


$response->say('I found more than one result. Please choose the correct one.',[
  'voice' => $user->voice,
  'language' => $user->language
]);


foreach($pages as $key=>$title){
  $response->say("For $title, dial $key. ",[
    'voice' => $user->voice,
    'language' => $user->language
  ]);
}

$gather = $response->gather([
  'action' => "wiki.php?pages=". json_encode($pages)
]);

$response->say('Sorry, I didn\'t get that.',[
  'voice' => $user->voice,
  'language' => $user->language
]);

function get_wiki_json($q){
  $q = trim($q,'. ');
  $q = urlencode($q);
  $url = 'https://en.wikipedia.org/w/api.php?action=query&origin=%2A&generator=search&gsrnamespace=0&gsrlimit=5&gsrsearch=%27'.$q.'%27&format=json';

  $c = curl_init($url);
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  $json = curl_exec($c);
  $json = json_decode($json, true);
  return $json;
}