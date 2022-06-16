<?PHP
    
class User{
  
  public $voice = 'man';
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