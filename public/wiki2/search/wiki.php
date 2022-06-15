<?PHP
    
require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$number = $_GET['Caller'];
$user = new User($number);
$pages = json_decode($_GET['pages'], true);
$title = $_GET['title'];
if(isset($title)){
  $page = get_wiki_page($title);
}else{
  foreach($pages as $key=>$title){
    if($_GET['Digits'] === $key);
    $page = get_wiki_page($title);
  }
}

function get_wiki_page($title){
  $title = trim($title,'. ');
  $title = urlencode($title);
  $url = 'https://en.wikipedia.org/w/api.php?action=query&prop=extracts&titles='.$title.'&exintro=1&explaintext=1&exsectionformat=plain&format=json';

  $c = curl_init($url);
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  $json = curl_exec($c);
  $results = json_decode($json, true);
  $page = $results['query']['pages'][0];
  return $page;
}