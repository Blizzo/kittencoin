<?php 
require_once('../../src/header.html');

require_once('../../src/functions.php');
session_start();
if (!isset($_SESSION['id'])) {
    $error = "You must login";
    header('Location: ../login.php?error='.urlencode($error));
    die();
}
$conn = connect_to_db();
$user = get_info($conn, $_SESSION['id']);
if (isset($user['error'])) {
    $error = "Something went wrong";
    header('Location: ../login.php?error='.urlencode($error));
    die();
}
if ($user['admin'] == 0) {
    $error = "Access Denied";
    header('Location: /?error='.urlencode($error));
    die();
}

$title = "Delete User";
$css = "";
$subtitle = "A New Coin King";
require_once('../../src/title.php');



?>


<?php require_once('../../src/footer.html');?>