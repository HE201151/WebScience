<!DOCTYPE html>

<script src="jquery.js"></script>
<script src="mon-script.js"></script>
<?php
	include "lib.php";
	setSession();
	createTop('Gallery');
	echo '<div class="clearFloat"></div>';



?>
<div id='Mid'>





<?php
echo "Images: </br>";
	foreach (glob("img/*.*") as $filename) {

		echo "<img src='".$filename."'   width=100 heigth=100 ></img>";

	}

echo '</br> Videos: </br>';

	foreach (glob("vid/*.*") as $filename) {

		echo '<video width="400"  height="230" controls>
			  <source src="'.$filename.'" type="video/mp4">
			  <source src="'.$filename.'" type="video/ogg">
			  Your browser does not support HTML5 video.
			</video>';

	}





?>




</div>
	
<?php
	createBot();
	


?>