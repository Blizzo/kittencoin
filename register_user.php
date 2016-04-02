<?php 

require_once("src/functions.php");
$conn = connect_to_db();
$username = "";
$error = False;

if (isset($_POST['username']) && isset($_POST['pass1']) && isset($_POST['pass2'])) {
    if ($_POST['pass1'] != $_POST['pass2']) {
        $error = "Passwords did not match";
    }
    $username = $_POST['username'];
    if(check_user($conn, $username)){
        $error = "That username already exists";
    }
}
else{
    $error = "You must fill in all fields";
}
if (!$error) {
    $name = htmlentities(strtolower($username));
    $id = register_user($conn, $name, $_POST['pass1']);
    if (is_int($id)) {
        session_start();
        $_SESSION['id'] = $id;
        header('Location: /');
        die();
    }
    else{
        $error = $id;
    }
}

header('Location: /register.php?error='.urlencode($error));
die();
$conn->close();
?>
