<?php
class LoginCntrl extends Login{

    private $username;
    private $password;
    public function __construct($user_name,$password)
{
    $this->username=$user_name;
    $this->password=$password;
}   


public function Login(){
    
    if($this->empty_inputs()!==false)
    {   
        $_SESSION['login'] = "Fill All Fields";
         header("Location: ../index.php?error=empty");

          exit();
}  
    $this->getUser($this->username,$this->password);
}
private function empty_inputs()
{
$result;
  echo $this->username;
if( empty($this->username) || empty($this->password)) {
        $result = true;
    }
     else {
        $result = false;
    }

return  $result;
}    

}