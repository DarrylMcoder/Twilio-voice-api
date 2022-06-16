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
  $titles[$i] = $name;
  $i++;
}

$gather = $response->gather([
  'action' => 'sections.php?title='.urlencode($title).'&titles='.urlencode(json_encode($titles))
]);

$gather->say($sections[0],[
  'voice' => $user->voice,
  'language' => $user->language
]);

$gather->pause(['length' => 3]);

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
  $url = 'https://en.wikipedia.org/w/api.php?action=query&prop=extracts&titles='.$title.'&explaintext=1&exsectionformat=plain&format=json';
  $c = curl_init($url);
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  $json = curl_exec($c);
  $results = json_decode($json, true);
  $extract = '';
  foreach($results['query']['pages'] as $page){
    error_log(json_encode($page));
    $extract .= $page['extract'];
  }
  $extract = "{0:\"$extract\"}";
  $regex = "#={2,}(.*?)={2,}#i";
  $replace = "\",\"$1\":\"";
  $extract = preg_replace($regex,$replace,$extract);
  echo $extract;
  $sections = json_decode($extract,true);
  return $sections;
}
echo $response;