<?php

class Database {
    protected function connect(){
        try {
            $user = "root";
            $password = "";
            $dbh = new PDO('mysql:host=localhost;dbname=task', $user, $password);
            return $dbh;
        } catch (PDOException $e) {
            print "Error!" . $e->getMessage() . "<br>";
            die();
        }
    }
}
