<?php 

require_once('src/header.html');

require_once('src/functions.php');
session_start();
if (!isset($_SESSION['id'])) {
    $error = "You must login";
    header('Location: /login.php?error='.urlencode($error));
    die();
}
if (!isset($_GET['id'])) {
    $error = "You must enter an ID";
    header('Location: /lookup.php?error='.urlencode($error));
    die();
}
$conn = connect_to_db();

$title = "Lookup User";
$css = "";
$subtitle = "";
require_once('src/title.php');
check_errors();
?>

<div class="twelve columns text-center">
    <?php 
        $lookup = (lookup_user($conn, $_GET['id']));
        if (isset($lookup['error'])) {
            echo "<div class='error_msg welcome'>".$lookup['error']."</div>";
        }
        else{
			foreach ($lookup as $row)
			{
				foreach ($row as $user => $value)
				    echo "<strong>$user</strong>: $value<br>";

				echo "<br>";
			}

			echo "<br>";
        }
    ?>
</div>
<div class="row">
        <div class="small-6 columns">
            <a href="/lookup.php" class="button success right">Another Lookup</a>
        </div>
        <div class="small-6 columns">
            <a href="/" class="button left">Home</a>
        </div> 
    </div>

<?php require_once('src/footer.html');?>
