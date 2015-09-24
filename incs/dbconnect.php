<?php
include_once 'dbconfig.php';
include_once 'class.book.php';

if(!$user->is_loggedin()){
 $user->redirect('index.php');
}

$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);