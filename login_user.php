<?php 
require_once("src/functions.php");
$conn = connect_to_db();
$username = "";
$error = False;

if (isset($_POST['username']) && isset($_POST['pass'])) {
    if($_POST['username']== "") {
        $error = "You must enter a username";
    }
    if($_POST['pass']== ""){
        $error = "You must enter a password";   
    }
}
else {
    $error = "Hmm... Did you come from the login page?";
}
if (!$error){
    $username=strtolower($_POST['username']);
    $password=$_POST['pass'];
    $login = login_user($conn, $username, $password);
    if($login){
        if (gettype($login) == "string") {
            $error = $login;  
        }
        else{
            session_start();
            $_SESSION['id'] = $login['id'];
            header('Location: /');
            die();
        }
    }
    else{
        $error = "Invalid username or password";
    }
}
if ($error) {
    header('Location: /login.php?error='.urlencode($error));
    die();
}
$conn->close();
?>