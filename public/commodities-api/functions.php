<?PHP
    
function isNewUser($from,$mysqli){
  $sql = 'SELECT * FROM users WHERE phone = ?';
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('i',$from);
  $stmt->execute();
  return $stmt->num_rows === 0;
}

function getNotice($user){
  return $user['notice'];
}

function createUser($from,$mysqli){
  $sql = 'INSERT INTO users(phone, created_at, voice, balance, plan, currency) VALUES(?, ?, ?, ?, ?, ?)';
  $voice = 'Polly.Matthew';
  $plan = 'free';
  $currency = 'CAD';
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('iisiss',$from, time(), $voice, 0, $plan, $currency);
  $stmt->execute();
}

function getUser($from, $mysqli){
    $sql = 'SELECT * FROM users WHERE phone = ?';
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('i',$from);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->fetch_assoc();
}

function getCachedJSONArray($url, $user, $maxAge){
  if(trialEnded($user) && !paidUp($user)){
    $path = 'cache/'.$url;
    if(file_exists($path) && (time() - filemtime($path)) < $maxAge){
      $results = getJSONArray($path);
      return $results;
    }else{
      $result = getJSON($url);
      file_put_contents('cache/'.$url,$result);
      return json_decode($result, true);
    }
  }else{
    return getJSONArray($url);
  }
}

function getJSONArray($url){
  return json_decode(getJSON($url), true);
}

function getJSON($url){
  return file_get_contents($url);
}

function paidUp($user){
  return $user['balance'] > 0;
}

function trialEnded($user){
  return $user['created_at'] < time() - (60*60*24);
}

function getFreeHoursLeft($user){
  return 24 - ((time() - $user['created_at']) / 60 / 60);
}

function getLocalCurrency($phone){

}