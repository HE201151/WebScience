<html>

<?php

error_reporting(E_ALL);

function hello(){

	echo 'hello hello';
}

function createTop($page){

if ($_GET['action']=='logout') {
	session_unset();
}
	
echo'
	<html>
	<head> 
		
		<meta name="author" content="Blan Romain">
		<meta name="description" content="Web Science project">
		
		<!-- <meta http-equiv="refresh" content="30"> -->

		<title>'.$page.'</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="css/index2.css">
	   
	</head>';

echo'
	<body>
		
		<div id="Top">
		
			<a href="index.php"><img id="logo"  src="img/logo2.png"  />	</a>	
			
			<h1 id="title"> Website </h1></li>';

if (isset($_SESSION['login'])) {
	echo "<a href='sign.php?action=logout'> <div id='logout'>Log out</div> </a>";
}

echo'
			<a href="contact.php" > <div id="contactButton"> Contact </div></a>
			
		</div>';

	


}

function createMenu(){

	echo "<div id='menu'>

	<a class='menuButtons' href='profil.php?action=profile'>Profile</a>
	<a class='menuButtons' href='forum.php?action=home'>Forum</a>
	<a class='menuButtons' href='profil.php?action=message'>Messages</a>";

	if (isset($_SESSION['Admin'])) {
		echo "<a class='menuButtons' href='profil.php?action=settings'>Settings</a>";
	}

	echo "</div>";

}

function createMid($page){

echo '<div id="Mid">';

	if ($page == 'Index') {
		echo' 
			
			
				<div id="newsletter"> 
				
					<H2> Newsletter: </h2>
					"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
					incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
					exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
					dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
					Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
					mollit anim id est laborum."

	 			</div>
	 	';
	 	
	 	if (!isset($_SESSION['login'])) {
		 	echo'
					<a href="sign.php"><div id="signButton"> Sign in / Sign up </div></a>
			';
		}
		else{
		 	echo'
					<a href="profil.php?action=profile"><div id="signButton"> Enter web site </div></a>
			';
		}

		echo '
		<a href="gallery.php" ><div id="slideshow">';
			foreach (glob("img/*.png") as $filename) {

				echo "<div> <img id='media' src='".$filename."'   ></img> </div> ";

			}
		echo'
		   <div>
		     <h2>Gallery</h2>
		   </div>
		</div></a>';




/*
		echo'
				<a href="gallery.php" ><div id="gallery"> 
					<img id="media"  src="img/game_over.jpg"  /> 
				</div></a>
			
			
		';
*/
	}

	if ($page == 'Contact') {
		form('Contact');
	}

	if ($page == 'Sign') {
		if (isset($_SESSION['login'])) {
			echo 'You are already logged';
		}
		else{
			if ($_GET['error']=='wrong') {
				echo "<div id='wrongPass'>Error, password or login is wrong</div>";
			}

			if ($_GET['error']=='activation') {
				echo "<div id='wrongPass'>Error, error, your account is not yet activated</div>";
			}

			if ($_GET['error']=='banned') {
				echo "<div id='wrongPass'>Error, your account is banned, <a href='contact.php'>contact admin</a></div>";
			}

			if ($_GET['success']=='signUp') {
				echo "<div id='succeed'>Registration successfull, you can now sign in</div>";
			}


			echo '
			
			</br>
				<form id="signIn" method="post" action="sign.php">
				<div class="sign-title"><h2>Sign in</h2></div>
			     
			     <label for="login" class="form-title" >Login :</label>

			     <input type="text" name="login" class="sign-field" placeholder="Ex : Roro" size="30" maxlength="15"  required />

			     </br>

				<label for="password" class="form-title">Password :</label> 
				<input type="password" name="password" class="sign-field" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" size="30" maxlength"15"  required />
				
				</br>

				<span id="passLost"><a href="sign.php?action=forgot"> Forgot your password ? </a> </span>
				
				 </br> 
				 <div class="submit-container">
				<input class="submit-button" type="submit" value="Sign in" />
			    </div>
				</form>




				<form id="signIn" method="post" action="sign.php">
				<div class="sign-title"><h2>Sign up</h2></div>';

				$wrongLogin = strpos($_GET['error'], 'login');
				$wrongMail = strpos($_GET['error'], 'mail');

			if ($wrongLogin!== FALSE) {
				echo "Login already exist";
			}

			echo'
			     
			     <label for="login" class="form-title" >Login :</label>

			     <input type="text" name="login" class="sign-field" placeholder="Ex : Roro" size="30" maxlength="15"  required />

			     </br>

				<label for="password" class="form-title">Password :</label> 
				<input type="password" name="password" class="sign-field" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" size="30" maxlength"15"  required />
				';

			if ($wrongMail !== FALSE) {
				echo "Mail already exist";
			}

			echo'
				<label for="mail" class="form-title">Mail :</label> 
				<input type="mail" name="mail" class="sign-field" placeholder="mail@domain.com" size="30" maxlength"15"  required />
				

				
				 </br> 
				 <div class="submit-container">
				<input class="submit-button" type="submit" value="Sign up" />
			    </div>
				</form>

			';


		}
	}
echo' </div>';
}


function form($title){

if ($title == 'Mail') {
	$path = 'profil.php?action=newMail';
}
if ($title == 'Contact') {
	$path = 'contact.php';
}
if ($title == 'Reply') {
	$path = 'profil.php?action=newMail';
	$id = $_GET['id'];

	$bdd = coBdd();

	$requete = $bdd->query('SELECT mail FROM users WHERE `id` = "'.$id.'"');
	$donnees = $requete->fetch();

	$mail = $donnees['mail'];

}
			echo'
			<div id="'.$title.'Title"><h2>'.$title.' form</h2></div>
				<form id="'.$title.'Form" method="post" action="'.$path.'">
			    <p>
					<label for="Subject">Subject : </label>
					<input type="text" name="Subject" id="Subject" placeholder="" size="30" maxlength="60" required />
					<br/>';
					

			if ($title == 'Contact') {
				echo '<label for="mail">E-mail : </label>';
				if (isset($_SESSION['login'])) {
					$mail=$_SESSION['mail'];
					echo'
						<input type="email" name="mail" id="mail" value="'.$mail.'" size="30" maxlength="80" disabled="disabled" />
						<br/>';
				}
				else{
					echo'
						<input type="email" name="mail" id="mail" placeholder="exemple@mail.com" size="30" maxlength="80" required />
						<br/>';
				}
			}
			if ($title == 'Mail'){
				echo '<label for="mail">E-mail : </label>';
				echo'
						<input type="email" name="mail" id="mail" placeholder="exemple@mail.com" size="30" maxlength="80" required />
						<br/>';
			}

			if ($title == 'Reply'){
				echo '<label for="mail">E-mail : </label>';
				echo'
						<input type="email" name="mail" id="mail" value="'.$mail.'" size="30" maxlength="80" readonly />
						<br/>';
			}

				
						

			echo'
					</br>
					<label for="Message">Message : </label>
					<textarea name="Message" rows="5" cols="40" required></textarea>
					</br>
					<div class="submit-'.$title.'-container">
						<input class="submit-'.$title.'" type="submit" value="Submit" />
			    	</div>
			    </p>


				</form>
			


			';
}

function createBot(){
echo' 
		<div id="Bot">
			Romain Blan </br>
			142977@hbv.no
		</div>


	</body>


	</html>';
}

function lorem(){
	echo' "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
	incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud 
	exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
	dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
	Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
	mollit anim id est laborum." ';
}

function sendContactMail(){


	$ini_path = 'conf.ini.php';
	$ini = parse_ini_file($ini_path, true);

	$destination = $ini['Gestionnaire']['mail'];


	$bdd = coBdd();

	echo "<div id='mid'>";



	$subject = $_POST['Subject'];

	if (isset($_SESSION['login'])) {
		$mail = $_SESSION['mail'];
	}
	else{
		$mail = $_POST['mail'];
	}
	$message = $_POST['Message'];
	$entete = "From: webSite@noreply.com" ;


	$text = 'Hi ,

	Your contact message has been send, the administrator will respond as soon as possible.

	This is your message : '.$message.'.
	 
	 
	---------------
	This is an automatic message, thanks to not answer.';

	mail($mail, $subject, $text) ;


	$state=0; //non lu









	


		$requete=$bdd->prepare('INSERT INTO msg SET subject=?, `message`=?, `destination` =?, `sender` =?, `state` = 0 ');

		$requete->execute(array($subject, $message, $destination,$mail));


echo "<div id='succeed'>Your message has been send successfully, we will try to answer as soon as possible </div></div>";


}


############################################################################# SIGN #########################################################################


function TrySign($bdd){
	if (!isset($_POST['login']) || !isset($_POST['password'])) {
		echo "<div class='error'>login or pasword not set>/div>";
		header("Refresh:3; url=sign.php");
		
	}
	else{
		
		$login=$_POST['login'];
		$password=$_POST['password'];




	$requete = $bdd->query('SELECT * FROM users INNER JOIN users_rank 
								ON users.id=users_rank.id_user 
								AND users.login =\''.$login.'\'
								');


		
		$donnee = $requete->fetch(); 

		$password = hash('sha256', $password);
					
		if($donnee['password'] == $password){
			echo "<div id='succeed'>Login successfull</div>";
			

			if ($donnee['id_rank'] == 1 ) {
				$_SESSION['id']=$donnee['id'];
				$_SESSION['rank']=$donnee['id_rank'];
				$_SESSION['name']=$donnee['login'];
				$_SESSION['mail']=$donnee['mail'];
				$_SESSION['Admin']="OK";
				$_SESSION['login']="OK";
			}

			if ($donnee['id_rank'] == 2 ) {
				$_SESSION['id']=$donnee['id'];
				$_SESSION['rank']=$donnee['id_rank'];
				$_SESSION['name']=$donnee['login'];
				$_SESSION['mail']=$donnee['mail'];
				$_SESSION['login']="OK";
			}

			if ($donnee['id_rank'] == 3 ) {
				header("Location: sign.php?error=activation");
			}			

			if ($donnee['id_rank'] == 4 ) {
				header("Location: sign.php?error=banned");
			}

			header("Refresh:2; url=profil.php?action=profile");	
		}
		else{
			header("Location: sign.php?error=wrong");

		}


		$requete->closeCursor();
		
	}
}

function TrySignup($bdd){
	$login=$_POST['login'];
	$mail=$_POST['mail'];
	$password=$_POST['password'];

	$requete = $bdd->query('SELECT login, mail FROM users WHERE (login)= "'.$login.'" OR  (mail) = "'.$mail.'"');
	$donnee = $requete->fetch();

	$error='';
	$test = $error;

	if($donnee['login'] == $login){
		$error = 'login';
	}

	if($donnee['mail'] == $mail){
		$error = $error.'mail';
	}
	if ($test==$error) {   //we can add to database
		echo "</br> it works</br>";
echo $login.'</br>'.$password.'</br>'.$mail;
	
		$password = hash('sha256', $password);
		$requete=$bdd->prepare('INSERT INTO users SET login=?, password=?, mail=? ');

		$requete->execute(array($login,$password,$mail));

		$requete = $bdd->query('SELECT id FROM users WHERE (login)= "'.$login.'" ');
		$donnee = $requete->fetch();

		$id=$donnee['id'];

		$requete=$bdd->prepare('INSERT INTO users_rank SET id_user=?, id_rank=?');

		$requete->execute(array($id,2));


		/*$sql ="INSERT INTO `142977`.`users` (`login`, `password`, `mail`) 
											VALUES('$login', '$password', '$mail')";
		$bdd->exec($sql);*/


		echo "Really";

		header("Location: sign.php?success=signUp");
	}
	else{
		header("Location: sign.php?error=".$error."Exist");
	}

}



function forgotForm(){
$bdd = coBdd();

	if (!isset($_POST['mail'])  && (!isset($_POST['answer']))) {
		
		formForgot();
	}

	if(isset($_POST['mail'])){
		$mail = $_POST['mail'];
		$_SESSION['mail']= $mail;
		$requete = $bdd->query('SELECT question FROM users WHERE (mail)= "'.$mail.'" ');
		$donnee = $requete->fetch();

		if (!$donnee) {
			echo "<div id='wrongPass'>Error, mail is wrong</div> <div class='clearFloat'></div>";
			formForgot();
		}
		else{
			formAnswer($donnee);
		}

	}

	if (isset($_POST['answer'])) {
		$mail= $_SESSION['mail'];
		$answer = $_POST['answer'];
		$requete = $bdd->query('SELECT * FROM users WHERE (mail)= "'.$mail.'" ');
		$donnee = $requete->fetch();


		if (strcmp($donnee['answer'], $answer) == 0 ){
			formResetPass();
		}
		else{
			echo "<div id='wrongPass'>Error, answer is wrong</div> <div class='clearFloat'></div>";


			formAnswer($donnee);
		}
	}

}


function resetPass(){
	$bdd = coBdd();

	if ($_POST['password'] == $_POST['conf']) {
		$password = $_POST['password'];
		$password = hash('sha256', $password);
		$mail= $_SESSION['mail'];
		

		$sql ="UPDATE `142977`.`users` SET `password` = '$password' WHERE `mail` = '$mail'";											
		$bdd->exec($sql);

		echo "<div id='succeed'>Password reset successfully, you can now sign in with your new password</div>";
		header("Refresh:3; url=sign.php");


	}
	else{
		echo "<div id='wrongPass'>Error, password and confirmation are not the same</div> <div class='clearFloat'></div>";
		formResetPass();
	}



}



function formResetPass(){
echo'
				<form id="forgot" method="post" action="sign.php?action=reset">
				<div class="sign-title"><h2>Forgot your password?</h2></div>
			     </br>
				Set your password</br>
				 </br> 

				<label for="password" class="form-title">Password :</label> 
				<input type="password" name="password" class="sign-field" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" size="30" maxlength"15"  required />


				<label for="conf" class="form-title">Confirm :</label> 
				<input type="password" name="conf" class="sign-field" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" size="30" maxlength"15"  required />
				

				
				 <div class="submit-container">
				<input class="submit-button" type="submit" value="Send" />
			    </div>
				</form>';

}


function formForgot(){


echo'
					<form id="forgot" method="post" action="sign.php?action=forgot">
				<div class="sign-title"><h2>Forgot your password?</h2></div>
			     </br>
				Enter your username here to reset your password</br>
				 </br> 

				<label for="mail" class="form-title">Mail :</label> 
				<input type="mail" name="mail" class="sign-field" placeholder="mail@domain.com" size="30" maxlength"15"  required />

				

				
				 <div class="submit-container">
				<input class="submit-button" type="submit" value="Send" />
			    </div>
				</form>';


}

function formAnswer($donnee){
		echo '
				<form id="forgot" method="post" action="sign.php?action=forgot">
				<div class="sign-title"><h2>Forgot your password?</h2></div>
			     </br>
				Answer your secret question </br>
				 </br> 

				<label id="answer" for="answer" class="form-title">'.$donnee["question"].' :</label> </br>
				<input type="text" name="answer" class="sign-field"  size="30" maxlength"15"  required />

				

				
				 <div class="submit-container">
				<input class="submit-button" type="submit" value="Send" />
			    </div>
				</form>';

}


############################################################################# PROFILE #########################################################################

function displayProfile(){

			$filename = 'avatars/'.$_SESSION['id'].'.png';
			if (file_exists($filename)) {
				$ini_path = 'conf.ini.php';
				$ini = parse_ini_file($ini_path, true);
				$width = $ini['Avatar']['width'];
				$height = $ini['Avatar']['height'];
				echo '<a href="profil.php?action=upload"><img id="profile_avatar" src="'.$filename.'" width="'.$width.'" height="'.$height.'"/></a></br>';
			}
			else{
				echo "<div id='profile_avatar'><a href='profil.php?action=upload'>You don't have avatar</a></div></br>";
			}


			$rank=getRank($_SESSION['rank']);

			echo'
				

				<div id="profile_info"> <div class="labelProfile"> <img src="img/login.png" height="25" width="20"> </div>     <div class="dataProfile">'.$_SESSION['name'].' </div>  
										<div class="labelProfile"> <img src="img/mail.png" height="20" width="25">	</div>      <div class="dataProfile">'.$_SESSION['mail'].'	</div>
										<div class="labelProfile"> <img src="img/'.$rank.'.png" height="25" width="20"> </div>  <div class="dataProfile">'.$rank.'	</div>
				</div>

				<div class="clearFloat"></div>

				</br>
				<a id="edit_profile_button" href="profil.php?action=editProfile"> Edit profile </a>


			';
}


function tryUploadAvatar(){
	
	$target_dir = "avatars/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	/*if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}*/
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		$extension = strrchr($_FILES['fileToUpload']['name'], '.');
		$fichier = $_SESSION['id'].$extension;
		$dossier = "avatars/";
		echo "</br>";
		//echo $dossier;
		//echo $fichier;
		echo "</br>";
		echo $target_file;
		echo "</br>";
	    if (move_uploaded_file($_FILES['fileToUpload']['name'], $target_file)) {
	        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";


	    } else {
	        echo "Sorry, there was an error uploading your file ". basename( $_FILES["fileToUpload"]["name"]). ".";
	        formUpload();
	    }
	}
}





function formUpload(){
	echo'
		<form action="profil.php?action=tryupload" method="post" enctype="multipart/form-data">
		    Select image to upload:
		    <input type="file" name="fileToUpload" id="fileToUpload">
		    <input type="submit" value="Upload Image" name="submit">
		</form>';
}

function tryEditProfile(){
	$bdd = coBdd();




	$login = $_POST['login'];
	$oldLogin = $_SESSION['name'];

	$mail = $_POST['mail'];
	$oldMail = $_SESSION['mail'];




	$requete = $bdd->query('SELECT password FROM users WHERE (login)= "'.$oldLogin.'"');
	$donnee = $requete->fetch();

	$password = hash('sha256', $_POST['password']);
	if ($password == $donnee['password']) {
		
		if ($login != $oldLogin) {
			

			
			$requete = $bdd->query('SELECT login FROM users WHERE (login)= "'.$login.'"');
			$donnee = $requete->fetch();
			if (!$donnee) {
				$sql ="UPDATE `142977`.`users` SET `login` = '$login' WHERE `login` = '$oldLogin'";											
				$bdd->exec($sql);
				$_SESSION['name']=$login;
				
			}
			else{
				echo "Error, Login already exist</br>";
			}
		}

		if ($mail != $oldMail) {
			

			
			$requete = $bdd->query('SELECT mail FROM users WHERE (mail)= "'.$mail.'"');
			$donnee = $requete->fetch();
			if (!$donnee) {
				$sql ="UPDATE `142977`.`users` SET `mail` = '$mail' WHERE `mail` = '$oldMail'";											
				$bdd->exec($sql);
				$_SESSION['mail']=$mail;
				
			}
			else{
				echo "Error, mail already exist</br>";
			}
		}


		if ($_POST['newPass'] != '') {
			
			$newPass = $_POST['newPass'];
			$conf = $_POST['conf'];
			$login = $_SESSION['name'];
			
			if ($newPass==$conf) {
				$newPass = hash('sha256', $newPass);
				$sql ="UPDATE `142977`.`users` SET `password` = '$newPass' WHERE `login` = '$login'";											
				$bdd->exec($sql);
				$_SESSION['mail']=$mail;
				echo "Change pass succeed</br>";
			}
			else{
				echo "Error, new pass and confirm are not the same";
			}
		}


		if (isset($_POST['question'])) {
			$question =$_POST['question'];
			$login = $_SESSION['name'];

			$sql ="UPDATE `142977`.`users` SET `question` = '$question' WHERE `login` = '$login'";											
			$bdd->exec($sql);
			
		}

		if (isset($_POST['answer'])) {
			$answer =$_POST['answer'];
			$login = $_SESSION['name'];

			$sql ="UPDATE `142977`.`users` SET `answer` = '$answer' WHERE `login` = '$login'";											
			$bdd->exec($sql);
			
		}



	}
	else{
		echo "Error, wrong password";
		
	}

	editProfile();

}




function editProfile(){
	$bdd = coBdd();
	$login = $_SESSION["name"];
	$requete = $bdd->query('SELECT *, answer FROM users WHERE (login)= "'.$login.'"');
	$donnee = $requete->fetch();


			echo '
				<form id="editProfile" method="post" action="profil.php?action=tryEditProfile">
				<div class="sign-title-edit"><h2>Edit profile</h2></div>
			  
				 </br> 
<div id="left">
				<label  for="login" class="form-title">Login:</label> 
				<input type="text" name="login" class="sign-field"  size="30" maxlength"15" value="'.$donnee["login"].'"  required />

				</br>

				<label for="mail" class="form-title">Mail:</label> 
				<input type="mail" name="mail" class="sign-field" placeholder="mail@domain.com" size="30" maxlength"15"  value="'.$donnee["mail"].'" required />
				</br>

				<label for="newPass" class="form-title">New pass:</label> 
				<input type="password" name="newPass" class="sign-field" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" size="30" maxlength"15"  />

				</br>

				<label for="conf" class="form-title">Confirm:</label> 
				<input type="password" name="conf" class="sign-field" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" size="30" maxlength"15"   />


				</br></br>
				Fill question and answer in case of forgoten password:
				</br></br>

				<label  for="question" class="form-title">Question:</label> 
				<input type="text" name="question" class="sign-field"  size="30" maxlength"15" value="'.$donnee["question"].'"   /> </br>

				<label  for="answer" class="form-title">Answer:</label> 
				<input type="text" name="answer" class="sign-field"  size="30" maxlength"15" value="'.$donnee["answer"].'"   /> </br>

	</div>	<div id="right">		

				For any change, you must enter your password:</br></br>

				<label for="password" class="form-title">Password:</label> 
				<input type="password" name="password" class="sign-field" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" size="30" maxlength"15" required />

				 <div class="submit-container">
				<input class="submit-edit" type="submit" value="Send" />
			    </div>
	</div>
				</form>';

}




############################################################################## MESSAGES #################################################################




function displayMsg(){
	$bdd = coBdd();
	$destination = $_SESSION['mail'];

	echo "<a href='profil.php?action=newMail' id='newMailBox'><img id='button_newMail' src='img/newMail.png' height='30' width='35'> <div id='newMail_text'>New message</div></a>
	 <div class='clearFloat'></div>";


	$requete = $bdd->query('SELECT * FROM msg WHERE `destination` = "'.$destination.'" ORDER BY `msg`.`date` DESC ');

echo'<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

$(document).ready(function(){
    $("table tr").click(function(){
        window.location = $(this).data("href");
        return false;
    });
});
  
</script>';


	echo '<table id="table_msg">';
		echo '<tr id="top_tr" data-href="profil.php?action=message">';
			echo '
				 <td>Subject : </td> 
				 <td>Mail : </td> '; 
		echo '</tr>';
		while ($donnees = $requete->fetch()){
			if ($donnees['state'] == 0) {
				echo '<tr class="notRead"   data-href="profil.php?action=messageid&id='.$donnees['id'].'"> ';
				echo ' <td > '.$donnees['subject'].' </td> <td> '.$donnees['sender'].' </td> ';
			}
			else{
				echo '<tr id="inside_tr"  data-href="profil.php?action=messageid&id='.$donnees['id'].'"> ';
				echo ' <td> '.$donnees['subject'].' </td> <td> '.$donnees['sender'].' </td> ';
			}
		
				



			echo '</tr>';
		}
	echo '</table>';
	$requete->closeCursor();
	





}


function displayMsgID(){

	$bdd = coBdd();
	$destination = $_SESSION['mail'];
	$msgid= $_GET['id'];

	$sql ="UPDATE `142977`.`msg` SET `state` = '2' WHERE `id` = '$msgid'";											
	$bdd->exec($sql);

	$requete = $bdd->query('SELECT * FROM msg WHERE `destination` = "'.$destination.'" AND `id` = '.$msgid.'');
	$donnees = $requete->fetch();

	$filename = 'avatars/'.$donnees['send_id'].'.png';
	if (file_exists($filename)) {
		$avatar=$filename;
	}
	else{
		$avatar= 'avatars/noavatar.png';
	}

	echo "<div id='displayOneMsg'>
		  	<div id='entete'>
		  		<div class='floatLeft'>
		  			<img src='".$avatar."' height='50' width='50'>
		  		</div>
		  		
		  		<div id='topDisplayOneMsg'>
		  			From: ".$donnees['sender']."  </br>
		  			Subject: ".$donnees['subject']."  </br>
		  		</div>
		   	</div>
		   <div class='clearFloat'></div>
		   </br>
		   </br>
		   <div id='contentMsg'>";
		   echo nl2br($donnees['message']);

		   echo"</div>

		</div>
<div class='clearFloat'></div>
		<a href='profil.php?action=reply&id=".$donnees['send_id']."' ><img id='replyMsg' src='img/mail_reply.png' height='50' width='50'></a>
		<a href='profil.php?action=delete&id=".$donnees['id']."' ><img id='deleteMsg' src='img/trash.png' height='40' width='30'></a>

	";


}

function deleteMsg(){
	$bdd = coBdd();
	$id = $_GET['id'];
	$requete=  $bdd->query("DELETE FROM `142977`.`msg` WHERE `id`=$id ");

	echo "<div id='wrongPass'>Message deleted</div>";
	header("Refresh:2; url=profil.php?action=message");

}

function displayNewMsg(){
	if (isset($_POST['Subject'])) {
		

		$bdd = coBdd();


		$sender = $_SESSION['mail'];
		$id = $_SESSION['id'];


		$subject = $_POST['Subject'];


		$mail = $_POST['mail'];

		$message = $_POST['Message'];
;


		$dest_userid=1;
		$state=0; //non lu
		$id=1;
		$date = date("Y-m-d H:i:s",time()); 

		$requete=$bdd->prepare('INSERT INTO msg SET subject=?, `message`=?, `destination` =?, `sender` =?, `send_id` =?, `date` =?,  `state` = 0 ');

		$requete->execute(array($subject, $message,$mail, $sender, $id, $date));

		echo "<div id='succeed'>Your message has been send successfully </div>";
		header("Refresh:2; url=profil.php?action=message");

	}
	else{
		if (isset($_GET['id'])) {
			form('Reply');
		}
		else{
			form('Mail');
		}
	}
}



############################################################################## FORUM #################################################################


function homeForum($bdd){
	$requete = $bdd->query('SELECT * FROM forum ');
	


	echo "
	<div id='forum'>
		<div id='top_forum'>
			FORUM
		</div>

		<div id='aboveForum'> <a class='forumButtons' href='forum.php?action=newSubject'> New subject </a></div>

		<div id='core_forum'>
			
				<table> 
					<tr  id='forumBar'> <td>Subject</td> <td> Posts </td> <td> Last Post </td> </tr> ";

/*<td>
  <a href="http://example.com">
    <div style="height:100%;width:100%">
      hello world
    </div>
  </a>
</td>
*/




					while ($donnees = $requete->fetch()){
						echo "<tr> 
									<td><a href='forum.php?action=subjectid&id=".$donnees['id']."'>
										<div style='height:100%;width:100%'>
											".$donnees['subject']." 
										</div>
									</a></td> 

									<td> ".$donnees['posts']." </td> <td> ".$donnees['updates']." ";

							if ($donnees['owner_id'] == $_SESSION['id']) {
								echo "<a href='forum.php?action=deleteSubject&id=".$donnees['id']."'><img id='deleteSubject'  src='img/deleteSubject.png' height='20' width='20'> </a>";
							}

									echo "</td> 
							</tr>";
					}
					

	echo"		</table>

			

		</div>
	</div>
	";


}


function newSubject($bdd){
	echo '

	<div id="newSubjectTitle">New subject:</div>

	<form id="newSubjectForm" method="post" action="forum.php?action=createNewSubject">

		<input type="text" name="Subject" id="Subject" placeholder="Enter the title of the subject" size="80" maxlength="80" required /> </br>

		<textarea name="content" placeholder="Enter your text here" rows="10" cols="62" required></textarea>
			
		<div class="submit-newSubject-container">
		<input id="submit-newSubject" type="submit" value="Post" />
		</div>

		</form>
	';
}


function createNewSubject($bdd){
	$subject = $_POST['Subject'];

	$updates = date("Y-m-d H:i:s",time()); 

	$owner_id = $_SESSION['id'];

	$content = $_POST['content'];

	$requete=$bdd->prepare('INSERT INTO forum SET subject=?, `posts`=1, `updates` =?, `owner_id` =?');

	$requete->execute(array($subject, $updates, $owner_id));


	$requete2 = $bdd->query('SELECT id FROM forum WHERE `subject` = "'.$subject.'" ');
	$donnee2 = $requete2->fetch();

	$subject_id = $donnee2['id'];

	$requete3=$bdd->prepare('INSERT INTO Posts SET subject_id=?, `content`=?, `date` =?, `id_user` =?');

	$requete3->execute(array($subject_id, $content, $updates, $owner_id));

	echo "<div id='succeed'>Your subject has been send</div>";
	header("Refresh:2; url=forum.php?action=home");

}



function displaySubject($bdd){

	$id= $_GET['id'];


	
	$requete = $bdd->query('SELECT * FROM Posts INNER JOIN users WHERE `subject_id` = "'.$id.'" AND Posts.id_user=users.id ORDER BY `Posts`.`date` ASC ');



	$requete2 = $bdd->query('SELECT * FROM forum WHERE `id` = "'.$id.'" ');
	$donnee2 = $requete2->fetch();

	echo " <div id='title_subject'><div id='subjectPost'> Subject: </div> 
			<div id='subject'>".$donnee2['subject']." </div> </div>";

	while ($donnees = $requete->fetch()){
		echo "


			<div class='post'>";

				$filename = 'avatars/'.$donnees['id_user'].'.png';
				if (file_exists($filename)) {
					$avatar=$filename;
				}
				else{
					$avatar= 'avatars/noavatar.png';
				}	

		echo "
			<img id='avatarPost' src='".$avatar."'' height='30' width='30' '>
			".$donnees['login']."

			<HR align=center size=1 width='100%'>
			</br>";

			echo nl2br($donnees['content']); 
			echo" </br>

			</div>


		";
	}

	echo'

		<form id="commentSubject" method="post" action="forum.php?action=answerSubject&id='.$id.'">

		

		<textarea name="content" placeholder="You can comment here" rows="10" cols="62" required></textarea>
			
		<div class="submit-newSubject-container">
		<input id="submit-newSubject" type="submit" value="Post" />
		</div>

		</form>';


}


function answerSubject($bdd){

	$subject_id = $_GET['id'];

	$content = $_POST['content'];

	$updates = date("Y-m-d H:i:s",time()); 

	$sender_id = $_SESSION['id'];

	$requete=$bdd->prepare('INSERT INTO Posts SET subject_id=?, `content`=?, `date` =?, `id_user` =?');

	$requete->execute(array($subject_id, $content, $updates, $sender_id));


	$requete = $bdd->query('SELECT posts FROM forum WHERE `id` = "'.$subject_id.'"');
	$donnees = $requete->fetch();

	$nbPost = $donnees['posts'];
	$nbPost = $nbPost+1;



	$sql ="UPDATE `142977`.`forum` SET `posts` = '".$nbPost."' WHERE `id` =  '".$subject_id."'";											
	$bdd->exec($sql);

	$sql ="UPDATE `142977`.`forum` SET `updates` = '".$updates."' WHERE `id` =  '".$subject_id."'";											
	$bdd->exec($sql);


}


function deleteSubject($bdd){

	$id = $_GET['id'];

	$requete=  $bdd->query("DELETE FROM `142977`.`forum` WHERE `id`=$id ");


	echo "<div id='wrongPass'>Subject deleted</div>";


}





############################################################################## GLOBAL #################################################################


function setSession(){
	session_name("HE201151");
	session_start();
}


function getRank($rank){
	switch ($rank) {
		case 1:
			return 'admin';
			break;

		case 2:
			return 'user';
			break;

		case 3:
			return 'need validation';
			break;

		case 4:
			return 'banned';
			break;
		
		default:
			return 'Error, contact support please';
			break;
	}
}

function coBdd(){
	$ini_path = 'conf.ini.php';
	$ini = parse_ini_file($ini_path, true);
	$dbName= $ini['BaseDeDonnee']['DBName'];
	$userName = $ini['BaseDeDonnee']['LoginBDD'];
	$passName = $ini['BaseDeDonnee']['MotDePassBDD'];   
	try{
		//echo "<script>alert('Avant essai de connexion')</script>";
		$bdd = new PDO('mysql:host='.$ini['BaseDeDonnee']['hostNameLocal'].';
		dbname='.$dbName.';', $userName, $passName);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $bdd;

	}
	catch (Exception $e){
		//echo "<script>alert('Erreur de connexion')</script>";
		die('Erreur : '. $e->getMessage());
	}
}

?>

</html>