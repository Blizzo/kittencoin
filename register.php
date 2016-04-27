<?php 
require_once('src/header.html');
$title = "Register for KittenCoin Wallet";
$css = "alert-box info round";
$subtitle = "Sign up today and get 10,000 free KittenCoins!";
require_once('src/title.php');
require_once('src/functions.php');
check_errors();
?>



<form action="/register_user.php" method="POST">
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
            <input type="password" placeholder="Password" name="pass1">
        </div>
        <div class="small-4 columns"><p></p></div>
    </div>
    <div class="row small_bot_margin">
        <div class="small-4 columns"><p></p></div>
        <div class="small-4 columns">
            <input type="password" placeholder="Confirm Password" name="pass2">
        </div>
        <div class="small-4 columns"><p></p></div>
    </div>
    <div class="row">
        <div class="small-6 columns">
            <input type="submit" class="button success right" value="Register">
        </div>
        <div class="small-6 columns">
            <a href="/welcome.php" class="button alert left">Cancel</a>
        </div> 
    </div>
</form>

<?php require_once('src/footer.html');?>
