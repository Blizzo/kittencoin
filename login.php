<?php require_once('src/header.html');
$title = "Login to KittenCoin Wallet";
$css = "";
$subtitle = "Please sign in!";
require_once('src/title.php');
require_once('src/functions.php');
check_errors();
?>
<form action="/login_user.php" method="POST">
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
            <input type="password" placeholder="Password" name="pass">
        </div>
        <div class="small-4 columns"><p></p></div>
    </div>
    <div class="row">
        <div class="small-6 columns">
            <input type="submit" class="button right" value="Login">
        </div>
        <div class="small-6 columns">
            <a href="/welcome.php" class="button alert left">Cancel</a>
        </div> 
    </div>
</form>


<?php require_once('src/footer.html');?>