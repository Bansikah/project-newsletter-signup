<?php 
 $localhost = 'localhost';
 $dbname = 'project_newsletter_signup';
 $dbuser = 'root';
 $dbpass = '';

try{
    $pdo = new PDO("mysql:host={$localhost}; dbname={$dbname}", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    // echo 'Successfully connected';
}
catch(PDOException $ex){
    echo 'Connection error:'.$ex->getMessage();
}
?>