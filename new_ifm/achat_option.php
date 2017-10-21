<?php
try{
		$bdd = new PDO('mysql:unix_socket=/opt/lampp/var/mysql/mysql.sock;mysql:host=localhost;dbname=Agenda;charset=utf8', 'root', '');
	}
	catch(Exception $e) {
		die('Erreur : '.$e->getMessage());
	}
	
	$req="SELECT COUNT(*) AS nbr_doublon, `titre_evenement`, `contenu_evenement`, `reference`, `PbConcerne`, `ObjPedagogiques`, `duree`, `prix`, `CaChoisir`, `option` FROM `evenements` GROUP BY `titre_evenement`,
	 `contenu_evenement`, `reference`, `PbConcerne`, `ObjPedagogiques`, `duree`, `prix`, `CaChoisir`, `option` HAVING COUNT(*) = 1";
	$identifiant = $bdd->query($req);
	
	
	 	$i=0;
	while($donnees = $identifiant->fetch()) {
		$titre_evenement[$i] = $donnees['titre_evenement'];
		$contenu_evenement[$i] = $donnees['contenu_evenement'];
		$reference[$i] = $donnees['reference'];
		$PbConcerne[$i] = $donnees['PbConcerne'];
		$ObjPedagogiques[$i] = $donnees['ObjPedagogiques'];
		$duree[$i] = $donnees['duree'];
		$prix[$i] = $donnees['prix'];
		$CaChoisir[$i] = $donnees['CaChoisir'];
		$option[$i] = $donnees['option'];
		$i++;
	}
	
	//$nblignes=mysql_num_row($req);
	$nblignes = $bdd->query($req);
	$etat = $nblignes->rowCount();
	$j=0;
	for($i=0; $i<$etat; $i++) {
		if($titre_evenement[$i] == 'Achats'){
			$new_option[$j] = $option[$i];
			$j++;
		}
	}
?>			
			
	       <li class="AccordionPanel clearfix colelem" id="u6238"><!-- vertical box -->
	       <div class="AccordionPanelTab rounded-corners clearfix colelem" id="u6239-4"><!-- content -->
	       <p id="u6239-2">Formation Achats</p></div>
	       <div class="AccordionPanelContent rounded-corners clearfix colelem" id="u6240"><!-- column -->
	       <!--<div class="position_content" id="u6240_position_content">-->
	       
	       <?php
	      
	      $t1=0;
	      $t2=0;
	       for($k=0; $k<$j; $k++) {
	       	$reste = $k % 2;
	       	if($reste == 0) {
	       		/*
	       		 echo'<div class="clearfix colelem" id="pu'.$k.'">';
	       		 echo'<div class="clearfix grpelem" id="u'.$k.'" >';
	       		 echo'<ul class="list0 nls-None" id="u'.$k.'" >';
	       		 echo'<li ><a href ="achat_option.php">'.$new_option[$k].'</a></li>';
	       		 echo'</ul></div>';*/
	  		 		 $tab_one[$t1] = $new_option[$k];
	  		 		 $t1++;
	       		 
	       		 /*echo'<div class="clearfix colelem" id="pu6241-5">';-->
	       		 echo'<div class="clearfix grpelem" id="u6241-5" >';
	       		 echo'<ul class="list0 nls-None" id="u6241-3" >';
	       		 echo'<li ><a style="color:white; text-decoration:none; " id="" href ="information.php?option='.$new_option[$k].' ">'.$new_option[$k].'</a></li>';
	       		 echo'</ul></div>';*/
	       		 
	       		 
	       		 
	       	}
	       	
	       	else {
	       		
	       		 $tab_two[$t2] = $new_option[$k];
	  		 		 $t2++;
	       		/* echo'<div class="clearfix grpelem" id="u20395-5">';
	       		 echo'<ul class="list0 nls-None" id="u20395-3">';
	       		 echo'<li><a style="color:white; text-decoration:none; " id="" href ="information.php?option='.$new_option[$k].'">'.$new_option[$k].'</a></li>';
	       		 echo'</ul></div>';*/
	       	}
	       }
	       
	       ?>
	       <div class="tableaux">
	       
	    	 <!--<table id="tab1"> -->
	    	  <ul>
					<br/>
	    	 		<?php
	    	 		
	    	 			for($s=0; $s<$t1; $s++){
	    	 				/*if(strlen($tab_one[$s])>=50) {
	    	 					$mot = explode(" ", $tab_one[$s]);
	    	 					echo strlen($mot);
	    	 					echo'<tr><a style="color:white; text-decoration:none; " id="" href ="information.php?option='.$tab_one[$s].' ">';
	    	 					 for($i=0; $i<strlen($mot); $i++) {
	    	 					 		if($i<4){;
	    	 					 			echo "'.$mot[$i].'&nbsp";
	    	 					 		}
	    	 					 		else {
	    	 					 			if($i==4){
	    	 					 				echo'</br>';
	    	 					 			}
	    	 					 			
	    	 					 			echo "'.$mot[$i].'&nbsp";
	    	 					 		}
	    	 					 }
	    	 				
	    	 				   echo'</a></tr><br/>';
	    	 				 }
	    	 				else {
	    	 					echo'<tr><a style="color:white; text-decoration:none; " id="" href ="information.php?option='.$tab_one[$s].' ">'.$tab_one[$s].'</a></tr><br/>';
	    	 				}*/
	    	 			
	    	 			echo'<li><a style="color:white; text-decoration:none; " id="" href ="information.php?option='.$tab_one[$s].' ">'.$tab_one[$s].'</a></li><br/>';
	    	 			}
	    	 			
	    	 		  for($s=0; $s<$t2; $s++){
	    	 				echo'<li><a style="color:white; text-decoration:none; " id="" href ="information.php?option='.$tab_two[$s].' ">'.$tab_two[$s].'</a></li><br/>';
	    	 			}
	    	 		?>
	    	 	</ul>	
	    	 <!--</table> -->
	    
	    	</div>
	    	
	    <!--	<div class="tableaux">
	    
	    	 <table id="tab2">
	    	 		<?php
	    	 			for($s=0; $s<$t2; $s++){
	    	 				echo'<tr><a style="color:white; text-decoration:none; " id="" href ="information.php?option='.$tab_two[$s].' ">'.$tab_two[$s].'</a></tr><br/>';
	    	 			}
	    	 		?>
	    	 </table>

	    	 </div> -->
	       </div></div></li>