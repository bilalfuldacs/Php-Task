<?php
 
if(isset($_POST["login_submit"]))
{
$user_name=$_POST['username'];
$password=$_POST['password'];

include_once '../Classes/Database_Handler.php';
include_once '../Classes/login.php';
include_once '../Classes/login_controller.php';

$LoginCntrl=new LoginCntrl($user_name,$password);
$LoginCntrl->Login();

}



