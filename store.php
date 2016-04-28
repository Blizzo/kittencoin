<?php require_once('src/header.html');
$title = "Items to buy with your Kitten Coins";
$css = "";
$subtitle = "Check out our selection!";
require_once('src/title.php');
#require_once('src/functions.php');
#check_errors();

#put this in functions when it's fixed
######################################
$RED_TEAM_ITEMS = "reditems.txt";
$BLUE_TEAM_ITEMS = "blueitems.txt";
$BLUE_TEAM_EXPENSES = "blueexpenses.txt";

function getItems($filename){
	$infile = @fopen($filename, "r");
	$lines = array();
	while(($line = fgets($infile)) !== false)
	{
		$line = rtrim($line);
		if($line == "")
			continue;

		array_push($lines, $line);
	}

	fclose($infile);
	return $lines;
}

######################################

$_SESSION['id'] = 3;
//get store items
if($_SESSION['id'] >= 11) //red team store items
	$items = getItems($RED_TEAM_ITEMS);
else if($_SESSION['id'] >= 3) //blue team store items
	$items = getItems($BLUE_TEAM_ITEMS);
else //show red and blue items bc this is an admin
{
	$items = getItems($BLUE_TEAM_ITEMS);
	$items .= getItems($RED_TEAM_ITEMS);
}

$counter = 0;
#loop through items and print them out
echo "<div id=\"store\">\n";
foreach($items as $item)
{
	$counter++;
	$option = $counter % 3;
	switch($option)
	{
		case 1: //title
			echo "<div class=\"store-item\">\n";
			echo "<h3>" . $item . "</h3>\n";
			break;
		case 2: //cost
			echo "<p><b>Cost:</b> " . $item;
			break;
		case 0: //description
			echo " <br> " . $item . "</p>\n";
			echo "</div>\n";
			break;
	}
}
echo "</div>\n";

require_once('src/footer.html');
?>
