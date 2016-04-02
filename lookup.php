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

$title = "KittenCoin Lookup";
$css = "subheader";
$subtitle = "Gotta be able to find to give";
require_once('src/title.php');
check_errors();
?>

<form action="/lookup_user.php" method="GET">
    <div class="small-12 medium-3 large-5 columns"><p></p></div>
    <div class="small-12 medium-6 large-2 columns panel">
        <div class="row">
            <div class="small-12 columns center">
                <label>Lookup User ID:
                    <input type="text" placeholder="User ID" name="id">
                </label>
            </div>
        <div class="row">
            <div class="small-6 columns">
                <input type="submit" class="button right" value="Search">
            </div>
            <div class="small-6 columns">
                <a href="/" class="button text-center alert">Back</a>
            </div>
        </div>
    </div>
    </div>
    <div class="small-12 medium-6 large-5 columns"><p></p></div>
    <div class="row">
        <div class="small-3 columns"><p></p></div>
        <div class="small-6 columns">
            
        </div> 
    </div>
</form>

</div>

<?php require_once('src/footer.html');?>