<?php 
require_once("src/functions.php");
$conn = connect_to_db();
session_start();
$error = False;
if (!isset($_SESSION['id'])) {
    $error = "You must login";
    header('Location: /login.php?error='.urlencode($error));
    die();
}

if (isset($_POST['to'])) {
    if($_POST['to']== "") {
        $error = "You must enter a username or id";
    }
}
else {
    $error = "";
}

if (!$error){
    
    # Check to see if username was supplied, if it was convert to id
    $amount = intval($_POST['amount']);
    $from = $_SESSION['id'];
    $comment = $_POST['comment'];
    $users_total = get_total($conn, $from);
    $error = False;
    
    $to_user = lookup_user($conn, $_POST['to']);
    if(isset($to_user['error'])){
        $error = $to_user['error'];
    }
    else{
        $to = $to_user['id'];
    }
    if (!((is_int($amount) || ctype_digit($amount)) && (int)$amount > 0 )){
        $error = "You can't transfer negative Kitten Coins";
    }
    if ($users_total) {
        if ($users_total['total'] < $amount) {
            $error = "You can't transfer more than is in your account";
        }
    }
    else{
        $error = "Something is wrong with your amount";
    }
    if ($to == $from ) {
        $error = "You can't transer to yourself!";
    }

	#checking to see if limit is reached
	$limiter = limiter($conn, $to, $from, $amount, $comment);

	if ($limiter){
		$error = "You can only transfer a max of 500 coins an hour.";
	}

	if (!$error) {
        $transfer = transfer($conn, $to, $from, $amount, $comment);
        if(is_bool($transfer)){
            header('Location: /');
            die();
        }
        else{
            $error = $transfer;
        }
    }
}
if ($error) {
    header('Location: /transfer.php?error='.urlencode($error));
    die();
}
$conn->close();
?>
