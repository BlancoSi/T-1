<?php 

$type = $_POST["type"];
include('account.php');

switch($type)
{
case "login":
    Account::Login();
    break;
case "signup":
    Account::SignUp();
    break;
case "useraction":
    Account::UserAction();
    break;
case "guest":       //Todo:guest
    break;
case "recreatetable":
    Account::ReTable();
    break;
default:
    echo "Wrong type!";
    break;
}

?>