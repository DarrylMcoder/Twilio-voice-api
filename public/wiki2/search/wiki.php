<?PHP

require('../../../vendor/autoload.php');
require('../User.php');
use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$number = $_REQUEST['Caller'];
$user = new User($number);
$title = $_GET['title'];

$digit = $_REQUEST['Digits'];
$pages = json_decode($_REQUEST['pages'], true);
$preindex = isset($_GET['preindex']) ? $_GET['preindex'] : null;
$gather = $response->gather([
  'action' => 'wiki.php?title='.urlencode($title).'&preindex='.urlencode($digit)
]);

if(isset($title)){
  $sections = get_wiki_sections($title);
}elseif(isset($pages)){
  $sections = get_wiki_sections($pages[$digit]);
}
              
if(isset($digit) && !isset($preindex)){
  $say = get_layer_text($sections[$digit]['content']);
}elseif(isset($preindex,$digit)){
  $say = get_layer_text($sections[$preindex]['content'][$digit]['content']);
}else{
  $say = get_layer_text($sections);
}

$gather->say($say,[
  'voice' => $user->voice,
  'language' => $user->language
]);

function get_wiki_sections($title){
  $title = trim($title,'. ');
  $title = urlencode($title);
  $url = 'https://en.wikipedia.org/w/api.php?action=query&prop=extracts&titles='.$title.'&explaintext=1&format=json';
  $c = curl_init($url);
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  $json = curl_exec($c);
  $results = json_decode($json, true);
  $extract = '';
  foreach($results['query']['pages'] as $page){
    $extract .= $page['extract'];
  }
  $extract = str_replace(".",". ",$extract);
  $sections = split_at("#\s==\s#i",$extract);
  foreach($sections as $key=>$val){
    if($key == 'intro'){
      continue;
    }
    if(strpos($val['content'],'=== ') != false){
      $sections[$key]['content'] = split_at("#\s===\s#i",$val['content']);
      foreach($sections[$key]['content'] as $subkey=>$subval){
        if($key == 'intro'){
          continue;
        }
        $sections[$key]['content'][$subkey]['content'] = [
          'intro' => $subval['content']
        ];
      }
    }else{
      $sections[$key]['content'] = [
        'intro' => $val['content']
      ];
    }
  }
  var_dump($sections);
  return $sections;
}
function split_at($split,$extract){
  $sections = [];
  $parts = preg_split($split,$extract);
  $sections['intro'] = array_shift($parts);
  $size = count($parts);
  $j =0;
  for($i = 0; $i < $size; $i += 2){
    $sections[$j] = [
      'name'    => $parts[$i],
      'content' => $parts[$i + 1]
    ];
    $j++;
  }
  return $sections;
}
function get_layer_text($sections){
  $say = '';
  $say .= $sections['intro'];
  foreach($sections as $key=>$val){
    if($key == 'intro'){
      continue;
    }
    $say .= " For {$val['name']}, dial {$key}. ";
  }
  return $say;
}
echo $response;