<?php 
require_once('src/header.html');
$title = "Welcome to KittenCoin Wallet";
$css = "subheader";
$subtitle = "Your place for storing and trading KittenCoins!";
require_once('src/title.php')
?>

<div class="row">
    <div class="small-3 columns"><p></p></div>
    <div class="small-6 columns">
        <img src="img/kitten1.jpg" class="th small_bot_margin">
    </div>
    <div class="small-3 columns"><p></p></div>
</div>
<div class="row">
    <div class="small-6 columns">
        <a href="/register.php" class="button right">Register</a>
    </div>
    <div class="small-6 columns">
        <a href="/login.php" class="button left">Login</a>
    </div> 
</div>
<?php require_once('src/footer.html');?>