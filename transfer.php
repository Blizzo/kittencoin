<?php 
require_once('src/header.html');

require_once('src/functions.php');
session_start();
if (!isset($_SESSION['id'])) {
    $error = "You must login";
    header('Location: /login.php?error='.urlencode($error));
    die();
}
$conn = connect_to_db();
$user = get_info($conn, $_SESSION['id']);
if (isset($user['error'])) {
    $error = "Something went wrong";
    header('Location: /login.php?error='.urlencode($error));
    die();
}

$title = "Transfer KittenCoins";
$css = "subheader";
$subtitle = "Remember, all transfers are final!";
require_once('src/title.php');
check_errors();
?>

<div class="small-12 medium-2 large-4 columns"><p></p></div>
<div class="small-12 medium-8 large-4 columns panel">
    <form action="/make_transfer.php" method="POST">
    <div class="row">
        <div class="small-1 columns"><p></p></div>
        <div class="small-5 columns">
            <label>Transfer to:
            <input type="text" placeholder="Transfer to" name="to">
            </label>
        </div>
        <div class="small-3 columns">
            <label> Amount:
            <input type="number" placeholder="Amount" name="amount">
            </label>
        </div>
        <div class="small-3 columns"><p></p></div>
    </div>
    <div class="row">
        <div class="small-1 columns"><p></p></div>
        <div class="small-8 columns">
            <label>Comment:
            <textarea placeholder="Leave a comment" name="comment"></textarea>
            </label>
        </div>
        <div class="small-3 columns"><p></p></div>
    </div>
    <div class="row">
        <div class="small-6 columns">
            <input type="submit" class="button success right" value="Transfer">
        </div>
        <div class="small-6 columns">
            <a href="/" class="button left">Back</a>
        </div> 
    </div>
</form>
</div>
<div class="small-12 medium-2 large-4 columns"><p></p></div>


<?php require_once('src/footer.html');?>