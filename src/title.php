<div class="welcome">
    <div class="row">
        <div class="twelve columns text-center"><h1><?php echo $title ?></h1></div>
    </div>
    <div class="row">
        <div class="small-4 columns"><p></p> </div>
        <?php 
        	echo '<div class="small-4 columns text-center ';
        	if (isset($css)) {
        	 	echo $css;
        	 }
        	 echo '">';
        ?>
            <strong><?php echo $subtitle ?></strong>
        </div>
        <div class="small-4 columns"><p></p> </div>
    </div>
</div>