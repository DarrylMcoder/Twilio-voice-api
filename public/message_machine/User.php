<?PHP
    
class User{
  $voice = 'Polly.Matthew';
  $language = 'en-US';
  function __construct($phone){
    
  }
  
  function isNew(){
    return false;
  }

  function hasAccess(){
    return true;
  }
}