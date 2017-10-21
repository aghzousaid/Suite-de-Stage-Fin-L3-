<?php
if(isset($_POST['login']) && isset($_POST['password'])) {
	try{
		$bdd = new PDO('mysql:unix_socket=/opt/lampp/var/mysql/mysql.sock;mysql:host=localhost;dbname=admin;charset=utf8', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$identifiant = $bdd->query('SELECT * FROM connect');
	$i=0;
	while($donnees = $identifiant->fetch()) {
		$login[$i] = $donnees['login'];
		$password[$i] = $donnees['password'];
		$nom[$i] = $donnees['nom'];
		$prenom[$i] = $donnees['prenom'];
		$i++;
	}
	for($j=0;$j<=2;$j++) {
		if($login[$j] == $_POST['login'] && $password[$j] == $_POST['password']) {
			session_start ();
			$_SESSION['login'] = $_POST['login'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['nom'] = $nom[$j];
			$_SESSION['prenom'] = $prenom[$j];
			echo '<meta http-equiv="refresh" content="0;URL=form_formation.php">';
			break;
		}
	}
	if($j == 3) {
		echo "<script>alert(\"Membre non reconnu ...\")</script>";
		echo '<meta http-equiv="refresh" content="0;URL=AdminLogin.php">';
		break;
	}
}
else {
	echo "<script>alert(\"Erreur de connexion, veuillez réessayer ...\")</script>";
	echo '<meta http-equiv="refresh" content="0;URL=AdminLogin.php">';
}
			
$identifiant->closeCursor();
?>