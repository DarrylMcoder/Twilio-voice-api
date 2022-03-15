<?PHP
    
$from = $_POST['From'];
$digits = $_POST['Digits'];

switch($digits){
  case 1:
    header('Location: latest/');
    break;
    
  case 2:
    header('Location: historic/');
    break;
    
  case 3:
    header('Location: calculator/');
    break;
    
  case 4:
    header('Location: account/');
    break;
    
  case 5:
    header('Location: about/');
    break;
    
  default:
    header('Location: error/invalid.php');
    break;
}