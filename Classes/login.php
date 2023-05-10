<?php 
class Login extends Database{


    protected function getUser($username,$password){
        $sql = "select password FROM users WHERE username = ?";
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute(array($username))){
            $stmt=null;
              $_SESSION['inval'] = "Invalid darta";
          header("Location: ../index.php?error=invalid");
            exit();
        }
        $pwdHasehd=$stmt->fetchALL(PDO::FETCH_ASSOC);
        $checkPwd=password_verify($password,$pwdHasehd[0]['password']);
        if($checkPwd==true){
            $sql = "select * FROM users WHERE username = ? AND password= ?";
            $stmt = $this->connect()->prepare($sql);
            if(!$stmt->execute(array($username,$password))){
                $stmt=null;
                  $_SESSION['inval'] = "Invalid darta";
          header("Location: ../index.php");
                exit();
            } else {
             
               session_start();
                $_SESSION["username"] = $username;
                header("Location: ../includes/News.php");
                exit();
            }
        } else {
            $stmt=null;
          $_SESSION['inval'] = "Invalid darta";
        
            header("Location: ../index.php?error=invalid");
            exit();
        }

    }
}
