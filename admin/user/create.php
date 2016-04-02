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

$title = "Create Admin";
$css = "";
$subtitle = "A New Coin King";
require_once('../../src/title.php');

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2'])) {
    if ($_POST['username'] !="" && $_POST['password'] != "" && $_POST['password2'] != "") {
        if ($_POST['password'] != $_POST['password2']) {
            echo "Passwords don't match. Try again.";
        }
        register_user($conn, $_POST['username'], $_POST['password'], 1);
        echo "<span class='text-center'><h4>User created!</h4></span>";
    }
}

?>

<form action="" method="POST">
    <div class="row">
        <div class="small-4 columns"><p></p></div>
        <div class="small-4 columns">
            <input type="text" placeholder="Username" name="username">
        </div>
        <div class="small-4 columns"><p></p></div>
    </div>
    <div class="row">
        <div class="small-4 columns"><p></p></div>
        <div class="small-4 columns">
            <input type="password" placeholder="Password" name="password">
        </div>
        <div class="small-4 columns"><p></p></div>
    </div>
    <div class="row small_bot_margin">
        <div class="small-4 columns"><p></p></div>
        <div class="small-4 columns">
            <input type="password" placeholder="Confirm Password" name="password2">
        </div>
        <div class="small-4 columns"><p></p></div>
    </div>
    <div class="row">
        <div class="small-6 columns">
            <input type="submit" class="button success right" value="Create">
        </div>
        <div class="small-6 columns">
            <a href="/admin/" class="button left">Cancel</a>
        </div> 
    </div>
</form>

<?php require_once('../../src/footer.html');?>