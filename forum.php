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
		$bdd = cobdd();
		createMenu();
		echo "<div id='Mid'>";




		switch ($_GET['action']) {

		    case "home":
		        
		    		homeForum($bdd);

		        break;

		    case "subjectid":
		        
		    		displaySubject($bdd);

		        break;

		    case "newSubject":
		        
		    		newSubject($bdd);

		        break;

		    case "createNewSubject":
		        
		    		createNewSubject($bdd);

		        break;

		    case "deleteSubject":
		        
		    		deleteSubject($bdd);
		    		homeForum($bdd);

		        break;


		    case "answerSubject":
		        
		    		answerSubject($bdd);
		    		displaySubject($bdd);
		        break;




}



		echo '</div>';
		
	}
	else{
		echo '<div class="clearFloat"></div>';
		echo "<div id='Mid'>You must <a href='sign.php'>login</a> to see your profile</div>";
	}

	
	createBot();
	


?>