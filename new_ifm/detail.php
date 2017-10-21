<?php

	try{
		$bdd = new PDO('mysql:unix_socket=/opt/lampp/var/mysql/mysql.sock;mysql:host=localhost;dbname=Agenda;charset=utf8', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}
	
	if(isset($_GET['option'])) {
		$options=htmlentities(addslashes($_GET['option']));
		$req="SELECT * FROM evenements WHERE option=\"$options\"";
	}
	else{
		echo "erreur de get";
	}
	$identifiant = $bdd->query($req);
	
	
	 	$i=0;
		$donnees = $identifiant->fetch();
		
?>			
			
	       <li class="AccordionPanel clearfix colelem" id="u6238"><!-- vertical box -->
	       <div class="AccordionPanelTab rounded-corners clearfix colelem" id="u6239-4"><!-- content -->
	       	<p id="u6239-2"><?php echo $_GET['option'] ?></p>
	       </div>
	      
	       <div class="AccordionPanelContent rounded-corners clearfix colelem" id="u6240"><!-- column -->
	       <div class="position_content" id="u6240_position_content">
	       
			
	       		 

	       	<div class="clearfix grpelem" id="u20395-5" >
	       		 <p  style=" text-align: left;  font-family: Arial; font-weight: bold; font-size:20px;">Référence :</p>
	       		<?php echo'<p style="font-size:18px;">'.$donnees['reference'].'</p>'; ?>	       		 
	       		<br/>
	       		 <p style=" text-align: left;  font-family: Arial; font-weight: bold; font-size:20px;">Public Concerné :</p>
	       		 <?php echo'<p style="font-size:18px;">'.$donnees['PbConcerne'].'</p>'; ?>
	       		 <br/>
	       		 <p style=" text-align: left;  font-family: Arial; font-weight: bold; font-size:20px;">Objectif pédagogique :</p>
	       		 <?php echo'<p style="font-size:18px;">'.$donnees['ObjPedagogiques'].'</p>'; ?>
	       		 <br/>
	       		 <p style=" text-align: left;  font-family: Arial; font-weight: bold; font-size:20px;">Contenue de cette formation :</p>
	       		 <?php echo'<p style="font-size:18px;">'.$donnees['contenu_evenement'].'</p>'; ?>
	       		 <br/>
	       		 <p style=" text-align: left;  font-family: Arial; font-weight: bold; font-size:20px;">Durée :</p>
	       		 <?php echo '<p style="font-size:18px;">'.$donnees['duree'].'</p>'; ?>
	       		<br/>
	       		 <p style=" text-align: left;  font-family: Arial; font-weight: bold; font-size:20px;">Prix :</p>
	       		 <?php echo'<p style="font-size:18px;">'.$donnees['prix'].'</p>'; ?>
	       		<br/>
	       		 <p style=" text-align: left;  font-family: Arial; font-weight: bold; font-size:20px;">Cours à Choisir:</p>
	       		 <?php echo'<p style="font-size:18px;">'.$donnees['CaChoisir'].'</p>'; ?>
	       		 <br/>
	       		 <p style=" text-align: left;  font-family: Arial; font-weight: bold; font-size:20px;">Date de Début:</p>
	       		 <?php echo'<p style="font-size:18px;">'.$donnees['datedebut'].'</p>'; ?>
	       		 <br/>
	       		 <p style=" text-align: left;  font-family: Arial;">Date de Fin:</p>
	       		 <?php echo'<p style="font-size:18px;">'.$donnees['datefin'].'</p>'; ?>
	       		 
	       	</div>
	       		    
	       </div></div></li>
