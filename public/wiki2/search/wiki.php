<?PHP
    
require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$number = $_REQUEST['Caller'];
$user = new User($number);
$pages = json_decode($_REQUEST['pages'], true);
$title = $_REQUEST['title'];
if(isset($title)){
  $page = get_wiki_page($title);
}else{
  foreach($pages as $key=>$title){
    if($_REQUEST['Digits'] === $key);
    $page = get_wiki_page($title);
  }
  $response->say($page,[
    'voice' => $user->voice,
    'language' => $user->language
  ]);
}

function get_wiki_page($title){
  $title = trim($title,'. ');
  $title = urlencode($title);
  $url = 'https://en.wikipedia.org/w/api.php?action=query&prop=extracts&titles='.$title.'&exintro=1&explaintext=1&exsectionformat=plain&format=json';
  $c = curl_init($url);
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  $json = curl_exec($c);
  $results = json_decode($json, true);
  $extract = '';
  foreach($results['query']['pages'] as $page){
   $extract .= $page['extract'];
  }
  return $extract;
}
echo $response;