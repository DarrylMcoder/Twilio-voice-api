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
              
if(isset($preindex)){
  $say = get_layer_text($sections[$preindex]['content'],$digit);
}elseif(isset($title,$digit)){
  $say = get_layer_text($sections,$digit);
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
function get_layer_text($sections,$digit = null){
  $say = '';
  if(isset($digit)){
    foreach($sections as $index=>$section){
    if($index == $digit){
      $say .= $section['intro'];
      $say .= " More about {$section['name']}. ";
      if(is_array($section['content'])){
        foreach($section['content'] as $key=>$val){
          $say .= " For {$val['name']}, dial {$key}. ";
        }
      }
    }
  }
  }else{
    $say .= $sections['intro'];
    foreach($sections as $key=>$val){
      $say .= " For {$val['name']}, dial {$key}. ";
    }
  }
  foreach($sections as $index=>$section){
    if($index == $digit){
      $say .= $section['intro'];
      $say .= " More about {$section['name']}. ";
      if(is_array($section['content'])){
        foreach($section['content'] as $key=>$val){
          $say .= " For {$val['name']}, dial {$key}. ";
        }
      }
    }
  }
  return $say;
}
echo $response;