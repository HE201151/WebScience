<!DOCTYPE html>


<?php

error_reporting(E_ALL);


	include "lib.php";
	setSession();
	createTop('Sign');
	echo '<div class="clearFloat"></div>';

	if ($_GET['action'] == 'forgot') {    	// forgot password
		echo "<div id='Mid'>";

		forgotForm();

		echo "</div>";

	}
	elseif ($_GET['action'] == 'reset') {
		echo "<div id='Mid'>";
		resetPass();
		echo "</div>";
	}
	else{

		if (empty($_POST)) {				// nothing special
			createMid('Sign');
		}
		else{								// try to sign
			$bdd=coBdd();
			echo "<div id='Mid'>";

			if (empty($_POST['mail'])) {	// try to sign in
				TrySign($bdd);
			}

			else{							// try to sign up
				TrySignup($bdd);
			}
			
			echo "</div>";
		}
	}

	createBot();


?>

