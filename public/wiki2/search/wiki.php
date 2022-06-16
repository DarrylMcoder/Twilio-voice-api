<?PHP

require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$number = $_REQUEST['Caller'];
$user = new User($number);
$pages = json_decode($_REQUEST['pages'], true);
$title = $_GET['title'];
if(isset($title)){
  $sections = get_wiki_sections($title);
}else{
  foreach($pages as $key=>$title){
    if($_REQUEST['Digits'] === $key);
    $sections = get_wiki_sections($title);
  }
}

$say = '';
$i = 0;
$titles = [];
foreach($sections as $name=>$section){
  if(is_numeric($name)){
    continue;
  }
  $say .= "For $name, dial $i. ";
  $title[$i] = $name;
  $i++;
}

$gather = $response->gather([
  'action' => 'sections.php?title='.urlencode($title).'&titles='.urlencode(json_encode($titles))
]);

$gather->say($sections[0],[
  'voice' => $user->voice,
  'language' => $user->language
]);

$gather->pause(3);

$gather->say("More information on $title. ", [
  'voice' => $user->voice,
  'language' => $user->language
]);

$gather->say($say,[
  'voice' => $user->voice,
  'language' => $user->language
]);

function get_wiki_sections($title){
  $title = trim($title,'. ');
  $title = urlencode($title);
  $url = 'https://en.wikipedia.org/w/api.php?action=query&prop=extracts&titles='.$title.'&exintro=1&explaintext=1&exsectionformat=plain&format=json';
  $c = curl_init($url);
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  $json = curl_exec($c);
  $results = json_decode($json, true);
  $extract = '';
  error_log($json);
  foreach($results['query']['pages'] as $page){
    error_log(json_encode($page));
    $extract .= $page['extract'];
  }
  
  $parts = explode('\n\n\n', $extract);
  $sections = [];
  $i = 0;
  foreach($parts as $part){
    $pair = explode('\n',$part, 2);
    if(count($pair) === 2){
      list($key, $val) = $pair;
      $sections[$key] = $val;
    }else{
      $sections[$i] = $pair[0];
      $i++;
    }
  }
  return $sections;
}
echo $response;