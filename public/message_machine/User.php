<?PHP
    
class User{
  
  public $voice = 'Polly.Matthew';
  public $language = 'en-US';
  function __construct($phone){
    
  }
  
  function isNew(){
    return false;
  }

  function hasAccess(){
    return true;
  }
}