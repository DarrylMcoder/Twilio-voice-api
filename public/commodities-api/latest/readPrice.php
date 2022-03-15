<?PHP
    
ini_set('error_reporting', E_ALL ^ E_NOTICE); 
ini_set('display_errors', 1);
require('../../../vendor/autoload.php');
include('../functions.php');
include('../config.php');

use \Twilio\TwiML\VoiceResponse;
$response = new VoiceResponse();

$from = $_POST['From'];
$user = getUser($from, $mysqli);
$item = $_GET['item'];

$currencies = getCachedJSONArray('https://www.commodities-api.com/api/symbols?access_key='.getenv('COMMODITIES-API-ACCESS-KEY'), $user, 60*60*24*7);

$results = getCachedJSONArray('https://www.commodities-api.com/api/latest?access_key='.getenv('COMMODITIES-API-ACCESS-KEY').'&base='.$item.'&symbols='.$user['currency'], $user, 60*60*24);

$response->say('As of '.date("F jS, Y", strtotime($results['data']['date'])).', according to data from commodities-api.com, the value of '.$results['data']['base'].' is '.$results['data']['rates'][$user['curency']].' '.$currencies[$user['currency']].' '.$results['data']['unit'].'.',['voice' => $user['voice']]);

$response->redirect('index.php?Digits=*'.$_GET['index']);

echo $response;