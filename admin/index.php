<?php 
require_once('../src/header.html');

require_once('../src/functions.php');
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

$title = "KittenCoin Admin";
$css = "";
$subtitle = "Control the Wallet";
require_once('../src/title.php');
?>
<div class="row">
    <div class="small-2 columns"><p></p></div>
    <div class="small-8 columns panel">
        <div class="row">
            <div class="small-12 columns text-center">
                <h3>Total Coins</h3>
                <?php echo "<h1>".total_coins($conn)."</h1>" ?>
            </div>
        </div>
        <div class="row ">
            <div class="small-12 columns text-center">
                <a href="user/create.php" class="button success">Create Admin</a>
                <a href="/" class="button welcome">Home</a>
            </div>
        </div>
    </div>
    <div class="small-2 columns"><p></p></div>
</div>
<div class="row">
    <div class="small-2 columns"><p></p></div>
    <?php
        $transfers = get_transfers($conn, $user['id']);
     ?>
    <div class="small-8 columns panel">
        <div class="row">
            <div class="twelve columns text-center">
                <h2><strong>Users</strong></h2>
            </div>
            <table>
                <thead>
                    <th width="15">ID</th>
                    <th width="30"><h4>Name</h4></th>
                    <th width="50" class="text-center"><h4>Total</h4></th>
                    <th width="70" class="text-center"><h4>Update</h4></th>
                </thead>
                <tbody>
                    <?php 
                        $users = get_users($conn);
                        foreach ($users as $user) {
                            echo "<tr>";
                            echo "<td>".$user['id']."</td>";
                            echo "<td>".$user['name']."</td>";
                            echo "<td class='text-center'>".$user['total']."</td>";
                            echo "<td class='text-center'>
                                    <a href='user/update.php?id=".$user['id']."' class='button' >Edit</a>
                                    <a href='user/delete.php?id=".$user['id']."' class='button alert' >Delete</a>
                                    </td>";
                            echo "</tr>";
                        }
                     ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="small-2 columns"><p></p></div>
</div>
<?php require_once('../src/footer.html');?>