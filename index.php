<?php 
require_once('src/header.html');

require_once('src/functions.php');
session_start();
if (!isset($_SESSION['id'])) {
    $error = "You must login";
    header('Location: /welcome.php');
    die();
}
$conn = connect_to_db();
$user = get_info($conn, $_SESSION['id']);
if (isset($user['error'])) {
    $error = "Something went wrong";
    header('Location: /login.php?error='.urlencode($error));
    die();
}

$title = "Welcome ".ucfirst($user['name']);
$css = "";
$subtitle = "KittenCoin Wallet";
require_once('src/title.php');
check_errors();
?>
<div class="row">
    <div class="small-2 columns"><p></p></div>
    <div class="small-8 columns panel">
        <div class="row">
            <div class="twelve columns text-center"><h3>Your current balance is:</h3><h1><?php echo $user['total'] ?></h1> KittenCoins</div>
        </div>
        <div class="row welcome">
            <div class="twelve columns text-center">
                <a href="/transfer.php" class="button success text-center">Transfer</a>
                <a href="/lookup.php" class="button text-center">Lookup</a>
                <a href="/edit.php" class="button text-center warning">Edit</a>
                <?php if ($user['name']=='admin' || $user['admin'] == 1) {
                    echo "<a href='/admin/' class='button text-center'>Admin</a>";
                } ?>
                <a href="/logout.php" class="button alert text-center">Logout</a>
            </div>
        </div>
    </div>
    <div class="small-2 columns"><p></p></div>
</div>
<div class="row">
    <div class="small-2 columns"><p></p></div>
    <?php
        $transfers = get_transfers($conn, $user['id']);
        if ($transfers != []) {
     ?>
    <div class="small-8 columns panel">
        <div class="row">
            <div class="twelve columns text-center"><h3><strong>Your transaction history</strong></h3></div>
        </div>
        <?php 
            
            foreach ($transfers as $transfer) {
                echo "<div class='small-12 columns panel'>";
                    $to = lookup_user($conn, $transfer['transfer_to']);
                    $from = lookup_user($conn, $transfer['transfer_from']);
                    echo "<div class='small-4 columns'><strong>Transfer To: </strong>".ucfirst($to['name'])."</div>";
                    echo "<div class='small-4 columns'><strong>Transfer From: </strong>".ucfirst($from['name'])."</div>";
                    echo "<div class='small-4 columns'><strong>Amount: </strong>".$transfer['amount']."</div>";
                    if ($transfer['comment'] != "") {
                        echo "<div class='small-12 columns text-center'><strong>Comment: </strong>".$transfer['comment']."</div>";
                    }
                echo "</div>";
         }
         } ?>
    </div>
    <div class="small-2 columns"><p></p></div>
</div>
<?php require_once('src/footer.html');?>