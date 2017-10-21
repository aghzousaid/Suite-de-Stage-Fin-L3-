
 
<?php
 	
 	
	if($_GET['mois'] == 'JANVIER') { 
		$mois="01";
	}
	if($_GET['mois'] == 'FÉVRIER') {
		$mois="02";
	}
	if($_GET['mois'] == 'MARS') {
		$mois="03";
	}
	if($_GET['mois'] == 'AVRIL') {
		$mois="04";
	}
	if($_GET['mois'] == 'MAI') {
		$mois="05";
	}
	if($_GET['mois'] == 'JUIN') {
		$mois="06";
	}
	if($_GET['mois'] == 'JUILLET') {
		$mois="07";
	}
	if($_GET['mois'] == 'AOUT') {
		$mois="08";
	}
	if($_GET['mois'] == 'SEPTEMBRE') {
		$mois="09";
	}
	if($_GET['mois'] == 'OCTOBRE') {
		$mois="10";
	}
	if($_GET['mois'] == 'NOVEMBRE') {
		$mois="11";
	}
	if($_GET['mois'] == 'DÉCEMBRE') {
		$mois="12";
	}
	try{
		$bdd = new PDO('mysql:unix_socket=/opt/lampp/var/mysql/mysql.sock;mysql:host=localhost;dbname=Agenda;charset=utf8', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}

	$req="SELECT * FROM `evenements`";
	

	$identifiant = $bdd->query($req);
	
	
	 	$i=0;
		while($donnees = $identifiant->fetch()){
			
			$date = $donnees['datedebut'];
         $date_explosee = explode("/", $date);
         /*echo $date_explosee[1];
         echo '<br/>';
         echo $mois;
         echo '<br/>';*/
         if($mois == $date_explosee[1]) {
				$date_debut[$i] = $donnees['datedebut'];	
				$date_fin[$i]   = $donnees['datefin'];
				$formation[$i]  = $donnees['option'];
			   $i++;
			}
		}
?>
<table class="propriete" >
	<caption >Agenda  </caption>
  
	<tr>
		<th>Date de Début</th>
		<th>Date de Fin</th>
	   <th>La Formation</th>
	</tr>
	<?php
	if($i==0) echo'</table><br/><br/><p style="color:#F9429E; padding-right:200px;">Aucun formation disponible!!!!!!</p>';
	else {
		for($j=0; $j<$i; $j++){
			echo'<tr>';
			echo'<td style="background-color: #77B5FE; color: white">'.$date_debut[$j].'</td>';
			echo'<td style="background-color: #80D0D0; color:white">'.$date_fin[$j].'</td>';
			echo'<td style="background-color: #DFF2FF; color:white; text-align:left "><a style="text-decoration:none ; padding-left:120px; padding-right:-120px" href="information.php?option='.$formation[$j].'">'.$formation[$j].'</a></td>';
			echo'</tr>';
		}
	
		echo'</table>';
	}
	?>
