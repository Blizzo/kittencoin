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

if (isset($_GET['id'])) {
    $user = get_info($conn, $_GET['id']);
}
else{
    $user = get_info($conn, $_SESSION['id']);
}
if (isset($user['error'])) {
    $error = "Something went wrong";
    header('Location: ../login.php?error='.urlencode($error));
    die();
}

if (isset($_POST['username']) && $_POST['username'] != "") {
    $used = check_user($conn, $_POST['username']);
    if (!$used) {
        $user_result = change_username($conn, $_GET['id'], $_POST['username']);
        if ($user_result == "Successful") {
            $user['name'] = $_POST['username'];
        }
    }
}

$title = "Update ".ucfirst($user['name']);
$css = "";
$subtitle = "KittenCoin Wallet";
require_once('../../src/title.php');

if (isset($_POST['new_pass']) && isset($_POST['new_pass_confirm']) && $_POST['new_pass'] != "") {
    if ($_POST['new_pass'] != $_POST['new_pass_confirm']) {
        echo "<span class='text-center'><h4>Passwords don't match. Try again.</h4></span>";
    }
    else{
        $result = change_password($conn, $_GET['id'], $_POST['new_pass']);
        if ($result == "Successful") {
            echo "<span class='text-center'><h4>Password Updated!</h4></span>";
        }
        else{
            echo "<div class='text-center alert welcome'><h4>Something went wrong!</h4>";
            echo "$result</div>";
        }
    }
}
if (isset($_POST['points']) && $_POST['points'] != "" && is_numeric($_POST['points'])) {
    $points_result = change_points($conn, $_GET['id'], (int)$_POST['points']);
    if ($points_result == "Successful") {
            echo "<span class='text-center'><h4>Points Updated!</h4></span>";
        }
        else{
            echo "<div class='text-center alert welcome'><h4>Something went wrong!</h4>";
            echo "$points_result</div>";
        }
}


// Print username errors (We want these to happen after we've printed the title)
if (isset($used) && $used==True) {
    echo "<span class='text-center welcome'><h4>That username is already in use</h4></span>";
}

if (isset($user_result)) {
    if ($user_result == "Successful") {
        echo "<span class='text-center'><h4>Username updated!</h4></span>";
    }
    else{
        echo "<div class='text-center alert'><h4>Something went wrong!</h4>";
        echo "$result</div>";
    }
}

?>
<form action="" method="POST">
    <div class="row">
        <div class="small-4 columns"><p></p></div>
        <div class="small-4 columns">
            Change Username:
            <input type="text" placeholder=<?php echo $user['name'] ?> name="username">
        </div>
        <div class="small-4 columns"><p></p></div>
    </div>
    <div class="row">
        <div class="small-4 columns"><p></p></div>
        <div class="small-4 columns">
            Change Points:
            <input type="text" placeholder=<?php echo get_total($conn, (int)$user)['total']; ?> name="points">
        </div>
        <div class="small-4 columns"><p></p></div>
    </div>
    <div class="row">
        <div class="small-4 columns"><p></p></div>
        <div class="small-4 columns">
            New Password:
            <input type="password" placeholder="New Password" name="new_pass">
        </div>
        <div class="small-4 columns"><p></p></div>
    </div>
    <div class="row small_bot_margin">
        <div class="small-4 columns"><p></p></div>
        <div class="small-4 columns">
            Confirm Password:
            <input type="password" placeholder="Confirm Password" name="new_pass_confirm">
        </div>
        <div class="small-4 columns"><p></p></div>
    </div>
    <div class="row">
        <div class="small-6 columns">
            <input type="submit" class="button success right" value="Update">
        </div>
        <div class="small-6 columns">
            <a href="/admin/" class="button left">Cancel</a>
        </div> 
    </div>
</form>
<?php require_once('../../src/footer.html');?>