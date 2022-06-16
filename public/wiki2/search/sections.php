<?PHP
    
require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$number = $_REQUEST['Caller'];
$user = new User($number);
$title = $_GET['title'];
$titles = $_GET['titles'];
$titles = json_decode($titles, true);
$sections = get_wiki_sections($title);

$gather = $response->gather([
  'action' => 'sections.php?title='.urlencode($title).'&titles='.urlencode(json_encode($titles))
]);

foreach($titles as $number=>$section_title){
  if($number === $_REQUEST['Digits']){
    $gather->say($sections[$section_title],[
      'voice' => $user->voice,
      'language' => $user->language
    ]);
    $response->redirect("wiki.php?title=".urlencode($title));
  }
}

switch($_REQUEST['Digits']){
  case '*':
    $response->redirect('input.php');
    break;
  case '#':
    $response->redirect('../welcome.php');
    break;
}

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