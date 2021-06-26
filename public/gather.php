<?PHP
    
if (array_key_exists('Digits', $_POST)) {
  $digits = str_split($_POST['Digits']);
  $path = '';
  foreach($digits as $digit){
    switch($digit){
      case '*':
        $path .= "../";
        break 2;
      case "#":
        $path = "http://twilio-voice-api.herokuapp.com/public/index.php";
        break 2;
      default:
        $path .= $digit."/";
    }
  }
  
  if(file_exists($path){
    header("Location: ".$path."index.php");
  }else{
    header("Location: error.php");
  }
}