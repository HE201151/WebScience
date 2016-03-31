<!DOCTYPE html>
<?php

    // Afficher les erreurs à l'écran
	ini_set('display_errors', 1);
	// Enregistrer les erreurs dans un fichier de log
	ini_set('log_errors', 1);
	// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
	ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
	// Afficher les erreurs et les avertissements
	//error_reporting(e_all);



	include "lib.php";
	setSession();
	createTop('Profil');
	
	if (isset($_SESSION['login'])) {
		
		createMenu();
		echo '<div id="Mid">';



		if ($_GET['action']=='profile'){

			displayProfile();


		}

		if ($_GET['action']=='editProfile') {
			editProfile();
		}

		if ($_GET['action']=='tryEditProfile') {
			tryEditProfile();
		}

		if ($_GET['action']=='upload') {
			formUpload();
		}

		if ($_GET['action']=='tryupload') {
			tryUploadAvatar();
		}

		if ($_GET['action']=='message') {
			displayMsg();
		}

		if ($_GET['action']=='messageid') {
			displayMsgID();
		}		

		if ($_GET['action']=='newMail') {
			displayNewMsg();
		}

		if ($_GET['action']=='reply') {
			displayNewMsg();
		}

		if ($_GET['action']=='delete') {
			deleteMsg();
		}




		echo '</div>';
		
	}
	else{
		echo '<div class="clearFloat"></div>';
		echo "<div id='Mid'>You must <a href='sign.php'>login</a> to see your profile</div>";
	}

	
	createBot();
	


?>