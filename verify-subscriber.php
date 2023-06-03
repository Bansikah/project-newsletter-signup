<?php

include'config.php';

$statement = $pdo->prepare("SELECT * FROM subscribers WHERE email=? AND token=?");
$statement->execute([$_REQUEST['email'],$_REQUEST['token']]);
$total = $statement->rowCount();
if($total){
    
$statement = $pdo->prepare("UPDATE * FROM subscribers SET token=?,status=? WHERE email=? AND token=?");
$statement->execute('','Active',[$_REQUEST['email'],$_REQUEST['token']]);

header('Location:success.php');
else{
    header('Location:index.php');
}
}
