<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html class="html" lang="fr-FR">
 <head>

  <script type="text/javascript">
   if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "jquery.musemenu.js", "webpro.js", "musewpdisclosure.js", "jquery.musepolyfill.bgsize.js", "musewpslideshow.js", "jquery.museoverlay.js", "touchswipe.js", "jquery.watch.js", "index.css"], "outOfDate":[]};
</script>
  
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="Bluefish 2.2.7" />
  <title>Formation Inter</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/site_global.css?3901403766"/>
  <link rel="stylesheet" type="text/css" href="../css/master_master.css?4014165139"/>
  <link rel="stylesheet" type="text/css" href="../css/ajoutevent.css" id="pagesheet"/>
    <link rel="stylesheet" type="text/css" href="../css/achat.css" id="pagesheet"/>
    <!--<link rel="stylesheet" type="text/css" href="../../design/calendrier.css" id="pagesheet"/>-->
  <!--[if lt IE 9]>
  <link rel="stylesheet" type="text/css" href="../css/iefonts_index.css?3935460640"/>
  <![endif]-->
  <!-- Other scripts -->
  <script type="text/javascript">
   document.documentElement.className += ' js';
var __adobewebfontsappname__ = "muse";
</script>
  <!-- JS includes -->
  <script type="text/javascript">
  document.write('\x3Cscript src="' + (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//webfonts.creativecloud.com/open-sans:n4:all;open-sans-condensed:n3,n7:all;coda:n4:all.js" type="text/javascript">\x3C/script>');
</script>
  <!--[if lt IE 9]>
  <script src="scripts/html5shiv.js?4241844378" type="text/javascript"></script>
  <![endif]-->
   </head>
<?php
if((!isset($_SESSION['login'])) || (empty($_SESSION['login']))) {
	echo "<script>alert(\"Vous n'êtes pas autorisez ...\")</script>";
	header ('location: AdminLogin.php');
}
else if (isset($_SESSION['login']) && isset($_SESSION['password']) && isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
?>
 <body>
<?php
                // Variables vides pour les valeurs par défaut des champs
                $titre=""; $description="";$option=""; $dateDebut = ""; $dateFin ="";$reference="";$PbConcerne="";
                $ObjPedagogiques="";$duree="";$prix="";$CoChoisir="";
               
                if(isset($_POST['envoi'])) {
                        // Traitement de l'envoi de l'événement
                        $titre = htmlentities(addslashes($_POST['For']));
                        $description = nl2br(htmlentities(addslashes($_POST['description'])));
                        $dateDebut = htmlentities($_POST['debut']);
                        $dateFin = htmlentities($_POST['fin']);
                        $reference = htmlentities($_POST['reference']);
                        $PbConcerne = nl2br(htmlentities(addslashes($_POST['PbConcerne'])));
                        $ObjPedagogiques = nl2br(htmlentities(addslashes($_POST['ObjPedagogiques'])));
                        $duree=htmlentities($_POST['duree']);
                        $prix=htmlentities($_POST['prix']);
                        $option=nl2br(htmlentities(addslashes($_POST['option'])));
                        $CoChoisir = htmlentities($_POST['CoChoisir']);
                        
                        
                       
                        $typeDate = "#^[0-3]?[0-9]/[01]?[0-9]/[0-9]{4}$#";
                       
                        if (preg_match($typeDate, $dateDebut) && preg_match($typeDate, $dateFin)) {
                                /*$tabDateDeb = explode("/", $dateDebut);
                                $timestampDebut = mktime(0, 0, 0, $tabDateDeb[1], $tabDateDeb[0], $tabDateDeb[2]);
                               
                                $tabDateFin = explode("/", $dateFin);
                                $timestampFin = mktime(0, 0, 0, $tabDateFin[1], $tabDateFin[0], $tabDateFin[2]);
                               
                                $timestampDiff = $timestampFin - $timestampDebut;
                                $nbreJours = intval($timestampDiff / 86400)+1;
                               
                                if($nbreJours <= 0) $nbreJours = 1;*/
                               
                               
                                if(!empty($titre) && !empty($description) && !empty($reference) && !empty($PbConcerne) && !empty($ObjPedagogiques) 
                                		&& !empty($duree) && !empty($prix) && !empty($option)){
                                        // Traitement de l'enregistrement de l'événement
                                        $identifiantCommun = time();
                                        /*$timeDuJour = $timestampDebut;*/
                                       
                                        include("../includes/sql_connect.php");
                                       
                                        /*for($i=0 ; $i<$nbreJours ; $i++) {
                                                $req = "INSERT INTO `calendrier` VALUES ('', ".date('d', $timeDuJour).", ".date('m', $timeDuJour).", ".date('Y', $timeDuJour).", '$identifiantCommun')";
                                                mysql_query($req) or die(mysql_error());
                                               
                                                $timeDuJour += 86400; // On augmente le timestamp d'un jour
                                        }*/
                                       
                                        $req = "INSERT INTO `evenements` VALUES (\"$identifiantCommun\", \"$titre\", \"$description\", \"$reference\", \"$PbConcerne\", \"$ObjPedagogiques\", 
                                        	\"$duree\", \"$prix\", \"$CoChoisir\", \"$option\", \"$dateDebut\", \"$dateFin\")";
                                        mysql_query($req) or die(mysql_error());
                                       
                                        mysql_close();
                                       
                                        echo '<script>alert(\"Evénement enregistré\")</script>';
                                } else {
                                        echo '<script>alert(\"Veuillez remplir toutes les cases ...\")</script>';
                                }
                        }
                        else
                        {
                                echo '<script>alert(\"Date de début ou de fin d\'événement non conforme (ex. 12/02/2008)\")</script>';
                        }
                }
        ?>
  <div class="clearfix" id="page"><!-- column -->
   <div class="position_content" id="page_position_content">
    <div class="clearfix colelem" id="pu205"><!-- group -->
     <div class="clip_frame grpelem" id="u205"><!-- image -->
      <img class="block" id="u205_img" src="../images/righttab.png" alt="" width="94" height="100"/>
     </div>
     <div class="clip_frame grpelem" id="u207"><!-- image -->
      <img class="block" id="u207_img" src="../images/lefttab.png" alt="" width="94" height="100"/>
     </div>
     <div class="shadow rounded-corners clearfix grpelem" id="u2074"><!-- column -->
      <div class="position_content" id="u2074_position_content">
       <div class="clearfix colelem" id="pu176"><!-- group -->
        <a class="nonblock nontext MuseLinkActive clip_frame grpelem" id="u176" href="../index.php"><!-- image --><img class="block" id="u176_img" src="../images/logo%202.png" alt="" width="244" height="114"/></a>
        <nav class="MenuBar clearfix grpelem" id="menuu91"><!-- horizontal box -->
         <div class="MenuItemContainer clearfix grpelem" id="u92"><!-- vertical box -->
          <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u93" href="../l-institut.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u94-4"><!-- content --><p><span id="u94">L'Institut</span></p></div></a>
         </div>
         <div class="MenuItemContainer clearfix grpelem" id="u155"><!-- vertical box -->
          <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u156" href="../nos-atouts.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u158-4"><!-- content --><p><span id="u158">Nos atouts</span></p></div></a>
         </div>
         <div class="MenuItemContainer clearfix grpelem" id="u106"><!-- vertical box -->
          <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u107" href="../actualit%c3%a9.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u109-4"><!-- content --><p><span id="u109">Actualités</span></p></div></a>
         </div>
         <div class="MenuItemContainer clearfix grpelem" id="u113"><!-- vertical box -->
          <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u151" href="../info-pratique.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u152-4"><!-- content --><p><span id="u152">Info Pratique</span></p></div></a>
         </div>
         <div class="MenuItemContainer clearfix grpelem" id="u162"><!-- vertical box -->
          <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u163" href="../nous-rejoindre.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u165-4"><!-- content --><p><span id="u165">Nous Rejoindre</span></p></div></a>
         </div>
         <div class="MenuItemContainer clearfix grpelem" id="u99"><!-- vertical box -->
          <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u102" href="../contact.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u105-4"><!-- content --><p><span id="u105">Contact</span></p></div></a>
         </div>
        </nav>
       </div>
       <nav class="MenuBar clearfix colelem" id="menuu278"><!-- horizontal box -->
        <div class="MenuItemContainer clearfix grpelem" id="u300"><!-- vertical box -->
         <a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive clearfix colelem" id="u301" href="../index.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u304-4"><!-- content --><p>Formation Inter</p></div></a>
        </div>
        <div class="MenuItemContainer clearfix grpelem" id="u368"><!-- vertical box -->
         <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u369" href="../solution-intra.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u372-4"><!-- content --><p>Solution Intra</p></div></a>
        </div>
        <div class="MenuItemContainer clearfix grpelem" id="u387"><!-- vertical box -->
         <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u390" href="../accompagnement-individuel.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u393-4"><!-- content --><p>Accompagnement Individuel</p></div></a>
        </div>
        <div class="MenuItemContainer clearfix grpelem" id="u412"><!-- vertical box -->
         <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u415" href="../particulier.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u418-4"><!-- content --><p>Particulier</p></div></a>
        </div>
        <div class="MenuItemContainer clearfix grpelem" id="u435"><!-- vertical box -->
         <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u438" href="../e-learning.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u441-4"><!-- content --><p>E-Learning</p></div></a>
        </div>
        <div class="MenuItemContainer clearfix grpelem" id="u460"><!-- vertical box -->
         <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u461" href="../langues.html"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u464-4"><!-- content --><p>Langues</p></div></a>
        </div>
       </nav>
       <div class="colelem" id="u21116"><!-- custom html -->
       
		 </div>
      </div>
     </div>
     <div class="clearfix grpelem" id="u196-4"><!-- content -->
      <p>Accélérateur de talents et accompagnateur de réussite</p>
     </div>
          <a class="nonblock nontext clip_frame grpelem" id="u13922" href="../contact.html"><!-- image --><img class="block" id="u13922_img" src="../images/doc2.png" alt="" width="206" height="88"/></a>
    </div>
    <div class="clearfix colelem" id="pu10565"><!-- group -->
     <div class="rounded-corners clearfix grpelem" id="u10565"><!-- column -->
      <div class="clearfix colelem" id="pu2315"><!-- group -->
       <div class="shadow rounded-corners clearfix grpelem" id="u2315"><!-- column -->
        
        
    <!-- Formulaire d'envoi -->

      <ul class="AccordionWidget clearfix" id="accordionu6237"><!-- column -->
       <div class="rounded-corners clearfix colelem" id="u14591-4"><!-- content -->
       <p>&nbsp;&nbsp;&nbsp; AJOUTER UN EVENEMENT</p>
       </div>
   				<div class="clearfix colelem" id="u14592-4"><!-- content -->
      				<?php echo ' <p>Bienvenue '.$_SESSION['nom'].' '.$_SESSION['prenom'].'</p>';?>
      			</div>
      			 <p style="text-align:right;"> <a href="../logout.php"> DECONNEXION</a></p>
    <form method="post" class="form-grp clearfix grpelem" id="widgetu21194" method="post" enctype="multipart/form-data" action="ajoutevent.php">
       <div class="fld-grp clearfix grpelem" id="widgetu21227" data-required="true"><!-- none box -->
       	<label class="fld-label actAsDiv clearfix grpelem" id="u21228-4" for="debut"><!-- content --><span class="actAsPara">Du :</span></label>
       	<span class="fld-input NoWrap actAsDiv clearfix grpelem" id="u21230-4"><!-- content --><input class="wrapped-input" size="20" type="text" spellcheck="false" id="widgetu21227_input" name="debut" value="<?php echo $dateDebut ?>"/></span> 
       </div>
       <div class="fld-grp clearfix grpelem" id="widgetu21215" data-required="true"><!-- none box -->
       	<label class="fld-label actAsDiv clearfix grpelem" id="u21218-4" for="fin"><!-- content --><span class="actAsPara">Au :</span></label>
       	<span class="fld-input NoWrap actAsDiv clearfix grpelem" id="u21217-4"><!-- content --><input class="wrapped-input" size="20" type="text" spellcheck="false" id="widgetu21215_input" name="fin"/></span> 
       </div>

        <br/>
        <div class="fld-grp clearfix grpelem" id="widgetu21203" data-required="true"><!-- none box -->
       <label class="fld-label actAsDiv clearfix grpelem" id="u21205-4" for="For"><!-- content --><span class="actAsPara">La Formation :</span></label>
                               <br/> 
                                <select name="For">
                                	<optgroup label="Achat - Logistique - Transport"> 
                                			<option>Achats
                                			<option>Entreposage & Gestion de Stock
                                			<option>Production & Planification
                                			<option>Logistique & Supply Chain Management
                                			<option>Transport
                                	</optgroup>
                                	<optgroup label="RSE - Conflits - Violences - Médiation">
                                	</optgroup>
                                	<optgroup label="Droit - Fiscalité - Comptabilité - Finance">
                                	</optgroup>
                                	<optgroup label="Environement - Dévellopement Durable">
                                	</optgroup>
                                	<optgroup label="Hotellerie - Restauration -Tourisme ">
                                	</optgroup>
                                	<optgroup label="Informatique - Système d'Information">
                                	</optgroup>
                                	<optgroup label="Qualités : Objectifs Management">
                                	</optgroup>>
                                	<optgroup label="Techniques">
                                	</optgroup> 
                                	<optgroup label="Langues">
                                	</optgroup>
                                </select> 
           </div>

            <br/><br/><br/><br/><br/>  
				<div class="fld-grp clearfix grpelem" id="widgetu21203" data-required="true"><!-- none box -->
       		<label class="fld-label actAsDiv clearfix grpelem" id="u21205-4" for="option"><!-- content --><span class="actAsPara">Option de cette Formation :</span></label>
                       <span class="fld-textarea actAsDiv clearfix grpelem" id="u21225-4"><!-- content --><textarea class="wrapped-input" rows="1" cols="50" id="widgetu21223_input"  name="option"></textarea></span>
				</div>
            <br/><br/><br/><br/><br/><br/><br/><br/>          
            <div class="fld-grp clearfix grpelem" id="widgetu21203" data-required="true"><!-- none box -->
       		<label class="fld-label actAsDiv clearfix grpelem" id="u21205-4" for="description"><!-- content --><span class="actAsPara">Description/contenu de l'option :</span></label>
                       <span class="fld-textarea actAsDiv clearfix grpelem" style="min-height: 180px;" id="u21225-4"><!-- content --><textarea class="wrapped-input" rows="10" cols="50" id="widgetu21223_input"  name="description"></textarea></span>
				</div>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div class="fld-grp clearfix grpelem" id="widgetu21215" data-required="true"><!-- none box -->
       	<label class="fld-label actAsDiv clearfix grpelem" id="u21218-4" for="reference"><!-- content --><span class="actAsPara">Référence :</span></label>
       	<span class="fld-input NoWrap actAsDiv clearfix grpelem" id="u21217-4"><!-- content --><input class="wrapped-input" size="20" type="text" spellcheck="false" id="widgetu21215_input" name="reference" /></span> 
       </div>
                		
            <br/>
				<div class="fld-grp clearfix grpelem" id="widgetu21203" data-required="true"><!-- none box -->
       		<label class="fld-label actAsDiv clearfix grpelem" id="u21205-4" for="PbConcerne"><!-- content --><span class="actAsPara">Public concerné :</span></label>
                       <span class="fld-textarea actAsDiv clearfix grpelem" id="u21225-4"><!-- content --><textarea class="wrapped-input" rows="1" cols="50" id="widgetu21223_input"  name="PbConcerne"></textarea></span>
				</div>	
				<br/><br/><br/><br/><br/><br/><br/><br/>
           <div class="fld-grp clearfix grpelem" id="widgetu21203" data-required="true"><!-- none box -->
       		<label class="fld-label actAsDiv clearfix grpelem" id="u21205-4" for="ObjPedagogiques"><!-- content --><span class="actAsPara">Objectifs pédagogiques :</span></label>
                       <span class="fld-textarea actAsDiv clearfix grpelem" style="min-height: 180px;" id="u21225-4"><!-- content --><textarea class="wrapped-input" rows="10" cols="50" id="widgetu21223_input"  name="ObjPedagogiques"></textarea></span>
				</div>
                			 
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
         <div class="fld-grp clearfix grpelem" id="widgetu21215" data-required="true"><!-- none box -->
       	<label class="fld-label actAsDiv clearfix grpelem" id="u21218-4" for="duree"><!-- content --><span class="actAsPara">Durée :</span></label>
       	<span class="fld-input NoWrap actAsDiv clearfix grpelem" id="u21217-4"><!-- content --><input class="wrapped-input" size="20" type="text" spellcheck="false" id="widgetu21215_input" name="duree" /></span> 
       </div>
              
            <br/><br/><br/><br/>
            <div class="fld-grp clearfix grpelem" id="widgetu21215" data-required="true"><!-- none box -->
       	<label class="fld-label actAsDiv clearfix grpelem" id="u21218-4" for="prix"><!-- content --><span class="actAsPara">Prix :</span></label>
       	<span class="fld-input NoWrap actAsDiv clearfix grpelem" id="u21217-4"><!-- content --><input class="wrapped-input" size="20" type="text" spellcheck="false" id="widgetu21215_input" name="prix" /></span> 
       </div>
          
          <div class="fld-grp clearfix grpelem" id="widgetu21203" data-required="true"><!-- none box -->
       <label class="fld-label actAsDiv clearfix grpelem" id="u21205-4" for="CoChoisir"><!-- content --><span class="actAsPara">Cours à choisir :</span></label>     
            <br/> <select name="CoChoisir">
             	<option>Inter_Formation
             	<option>Intra_Formation
             </select> 
       </div>
                <input class="submit-btn NoWrap grpelem" id="u21232-17" type="submit" value="" name="envoi" /><!-- state-based BG images -->
    </form>
    </ul>
     </div>
    </div>
    </div>
    </div>

<div class="verticalspacer"></div>
    <div class="clearfix colelem" id="ppu14032-4"><!-- group -->
     <div class="clearfix grpelem" id="pu14032-4"><!-- column -->
      <a class="nonblock nontext clearfix colelem" id="u14032-4" href="../achat.php"><!-- content --><p>Achat - Distribution – Logistique - Supply Chain – Transport</p></a>
      <a class="nonblock nontext clearfix colelem" id="u14033-4" href="../rse---conflits---violences-%e2%80%93-m%c3%a9diation.html"><!-- content --><p>RSE - Conflits - Violences – Médiation</p></a>
      <a class="nonblock nontext clearfix colelem" id="u14034-4" href="../droit---fiscalit%c3%a9-%e2%80%93-comptabilit%c3%a9-%e2%80%93-finance.html"><!-- content --><p>Droit - Fiscalité – Comptabilité – Finance</p></a>
      <a class="nonblock nontext clearfix colelem" id="u14035-4" href="../environnement%2c-d%c3%a9veloppement-durable.html"><!-- content --><p>Environnement - Développement Durable</p></a>
      <a class="nonblock nontext clearfix colelem" id="u14036-4" href="../h%c3%b4tellerie---restauration-%e2%80%93-tourisme.html"><!-- content --><p>Hôtellerie - Restauration – Tourisme</p></a>
      <a class="nonblock nontext clearfix colelem" id="u14037-4" href="../informatique-%e2%80%93-syst%c3%a8me-d%e2%80%99information.html"><!-- content --><p>Informatique – Système d’information</p></a>
     </div>
     <div class="clearfix grpelem" id="u14108-15"><!-- content -->
      <p id="u14108-2"><span id="u14108">Présence dans 5 grandes régions en France</span></p>
      <p id="u14108-4">UFR – 1 rue de l’Aube – 91940 Les Ulis</p>
      <p>166 bd du Montparnasse – 75014 Paris</p>
      <p>12, rue Crucy - BP 60515 - 44005 Nantes Cedex 1</p>
      <p>120 rue Masséna - 69006 Lyon</p>
      <p>165 avenue du Prado - 13008 Marseille</p>
      <p>&nbsp;</p>
     </div>
     <div class="clearfix grpelem" id="pu14041-4"><!-- column -->
      <a class="nonblock nontext clearfix colelem" id="u14041-4" href="../l-institut.html"><!-- content --><p>L'institut de Formation au Management</p></a>
      <a class="nonblock nontext clearfix colelem" id="u14042-4" href="../nos-atouts.html"><!-- content --><p>Nos Atouts</p></a>
      <a class="nonblock nontext clearfix colelem" id="u14043-4" href="../actualit%c3%a9.html"><!-- content --><p>Actualité</p></a>
      <a class="nonblock nontext clearfix colelem" id="u14044-4" href="../info-pratique.html"><!-- content --><p>Info-Pratique</p></a>
      <a class="nonblock nontext clearfix colelem" id="u14045-4" href="../nous-rejoindre.html"><!-- content --><p>Nous-Rejoindre</p></a>
      <a class="nonblock nontext clearfix colelem" id="u14046-4" href="../contact.html"><!-- content --><p>Contact</p></a>
     </div>
    </div>
    <a class="nonblock nontext clearfix colelem" id="u14038-4" href="../qualit%c3%a9-objectifs-management.html"><!-- content --><p>Qualité : objectifs Management</p></a>
    <div class="clearfix colelem" id="ppu14039-4"><!-- group -->
     <div class="clearfix grpelem" id="pu14039-4"><!-- column -->
      <a class="nonblock nontext clearfix colelem" id="u14039-4" href="../techniques.html"><!-- content --><p>Techniques</p></a>
      <a class="nonblock nontext clearfix colelem" id="u14040-4" href="../langues.html"><!-- content --><p>Langues</p></a>
     </div>
     <div class="grpelem" id="u10576"><!-- custom html -->
      
<a href="https://twitter.com/AdobeMuse" class="twitter-follow-button" data-lang="fr" data-show-screen-name="true" data-size="medium"></a>

</div>
     <div class="grpelem" id="u10574"><!-- custom html -->
      
<div class="g-plusone" data-action="share" data-size="standard" data-annotation="inline" data-width="193" data-href="http://ifmedu.net/index.php"></div>

</div>
     <a class="nonblock nontext clip_frame grpelem" id="u14566" href="https://www.facebook.com/institut.ifm"><!-- image --><img class="block" id="u14566_img" src="../images/social_facebook_button_blue.png" alt="" width="32" height="32"/></a>
     <a class="nonblock nontext clip_frame grpelem" id="u14572" href="https://www.linkedin.com/company/institut-de-formations-et-de-managements?trk=top_nav_home"><!-- image --><img class="block" id="u14572_img" src="../images/social_linkedin_button_blue.png" alt="" width="32" height="32"/></a>
     <div class="clip_frame grpelem" id="u14578"><!-- image -->
      <img class="block" id="u14578_img" src="../images/blogger.png" alt="" width="35" height="32"/>
     </div>
    </div>
    <div class="colelem" id="u10573"><!-- simple frame --></div>
    <div class="clearfix colelem" id="u10578-4"><!-- content -->
     <p>© 2015 IFM Institut de Formation au Management. All rights reserved.</p>
    </div>
   </div>
  </div>
  <div class="preload_images">
   <img class="preload" src="../images/left-arrow.png" alt=""/>
   <img class="preload" src="../images/right-arrow.png" alt=""/>
  </div>
  <!-- JS includes -->
  <script type="text/javascript">
   if (document.location.protocol != 'https:') document.write('\x3Cscript src="http://musecdn2.businesscatalyst.com/scripts/4.0/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
</script>
  <script type="text/javascript">
   window.jQuery || document.write('\x3Cscript src="scripts/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
</script>
  <script src="scripts/museutils.js?183364071" type="text/javascript"></script>
  <script src="scripts/jquery.musemenu.js?3957776250" type="text/javascript"></script>
  <script src="scripts/webpro.js?3803554875" type="text/javascript"></script>
  <script src="scripts/musewpdisclosure.js?3993616448" type="text/javascript"></script>
  <script src="scripts/jquery.musepolyfill.bgsize.js?4004268962" type="text/javascript"></script>
  <script src="scripts/musewpslideshow.js?242596657" type="text/javascript"></script>
  <script src="scripts/jquery.museoverlay.js?493285861" type="text/javascript"></script>
  <script src="scripts/touchswipe.js?4038331989" type="text/javascript"></script>
  <script src="scripts/jquery.watch.js?71412426" type="text/javascript"></script>
  <!-- Other scripts -->
  <script type="text/javascript">
   $(document).ready(function() { try {
(function(){var a={},b=function(a){if(a.match(/^rgb/))return a=a.replace(/\s+/g,"").match(/([\d\,]+)/gi)[0].split(","),(parseInt(a[0])<<16)+(parseInt(a[1])<<8)+parseInt(a[2]);if(a.match(/^\#/))return parseInt(a.substr(1),16);return 0};(function(){$('link[type="text/css"]').each(function(){var b=($(this).attr("href")||"").match(/\/?css\/([\w\-]+\.css)\?(\d+)/);b&&b[1]&&b[2]&&(a[b[1]]=b[2])})})();(function(){$("body").append('<div class="version" style="display:none; width:1px; height:1px;"></div>');
for(var c=$(".version"),d=0;d<Muse.assets.required.length;){var f=Muse.assets.required[d],g=f.match(/([\w\-\.]+)\.(\w+)$/),k=g&&g[1]?g[1]:null,g=g&&g[2]?g[2]:null;switch(g.toLowerCase()){case "css":k=k.replace(/\W/gi,"_").replace(/^([^a-z])/gi,"_$1");c.addClass(k);var g=b(c.css("color")),h=b(c.css("background-color"));g!=0||h!=0?(Muse.assets.required.splice(d,1),"undefined"!=typeof a[f]&&(g!=a[f]>>>24||h!=(a[f]&16777215))&&Muse.assets.outOfDate.push(f)):d++;c.removeClass(k);break;case "js":k.match(/^jquery-[\d\.]+/gi)&&
typeof $!="undefined"?Muse.assets.required.splice(d,1):d++;break;default:throw Error("Unsupported file type: "+g);}}c.remove();if(Muse.assets.outOfDate.length||Muse.assets.required.length)c="Certains fichiers sur le serveur sont peut-être manquants ou incorrects. Videz le cache du navigateur et réessayez. Si le problème persiste, contactez le créateur du site.",(d=location&&location.search&&location.search.match&&location.search.match(/muse_debug/gi))&&Muse.assets.outOfDate.length&&(c+="\nOut of date: "+Muse.assets.outOfDate.join(",")),d&&Muse.assets.required.length&&(c+="\nMissing: "+Muse.assets.required.join(",")),alert(c)})()})();/* body */
Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
Muse.Utils.prepHyperlinks(true);/* body */
Muse.Utils.initWidget('.MenuBar', function(elem) { return $(elem).museMenu(); });/* unifiedNavBar */
Muse.Utils.initWidget('#tab-panelu3158', function(elem) { return new WebPro.Widget.TabbedPanels(elem, {event:'click',defaultIndex:1}); });/* #tab-panelu3158 */
Muse.Utils.initWidget('#pamphletu1330', function(elem) { new WebPro.Widget.ContentSlideShow(elem, {contentLayout_runtime:'loose',event:'mouseover',deactivationEvent:'mouseout_both',autoPlay:false,displayInterval:3000,transitionStyle:'fading',transitionDuration:500,hideAllContentsFirst:true,shuffle:false,enableSwipe:true,resumeAutoplay:true,resumeAutoplayInterval:3000,playOnce:false,autoActivate_runtime:false}); });/* #pamphletu1330 */
Muse.Utils.initWidget('#pamphletu15195', function(elem) { new WebPro.Widget.ContentSlideShow(elem, {contentLayout_runtime:'stack',event:'mouseover',deactivationEvent:'',autoPlay:true,displayInterval:3000,transitionStyle:'fading',transitionDuration:500,hideAllContentsFirst:false,shuffle:false,enableSwipe:true,resumeAutoplay:true,resumeAutoplayInterval:3000,playOnce:false,autoActivate_runtime:false}); });/* #pamphletu15195 */
Muse.Utils.initWidget('#pamphletu6446', function(elem) { new WebPro.Widget.ContentSlideShow(elem, {contentLayout_runtime:'stack',event:'click',deactivationEvent:'none',autoPlay:true,displayInterval:3000,transitionStyle:'horizontal',transitionDuration:500,hideAllContentsFirst:false,shuffle:false,enableSwipe:true,resumeAutoplay:true,resumeAutoplayInterval:3000,playOnce:false,autoActivate_runtime:false}); });/* #pamphletu6446 */
Muse.Utils.initWidget('#pamphletu6323', function(elem) { new WebPro.Widget.ContentSlideShow(elem, {contentLayout_runtime:'loose',event:'mouseover',deactivationEvent:'mouseout_both',autoPlay:false,displayInterval:3000,transitionStyle:'fading',transitionDuration:500,hideAllContentsFirst:true,shuffle:false,enableSwipe:true,resumeAutoplay:true,resumeAutoplayInterval:3000,playOnce:false,autoActivate_runtime:false}); });/* #pamphletu6323 */
Muse.Utils.initWidget('#pamphletu14960', function(elem) { new WebPro.Widget.ContentSlideShow(elem, {contentLayout_runtime:'loose',event:'click',deactivationEvent:'mouseout_both',autoPlay:false,displayInterval:3000,transitionStyle:'fading',transitionDuration:500,hideAllContentsFirst:true,shuffle:false,enableSwipe:true,resumeAutoplay:true,resumeAutoplayInterval:3000,playOnce:false,autoActivate_runtime:false}); });/* #pamphletu14960 */
Muse.Utils.initWidget('#pamphletu14979', function(elem) { new WebPro.Widget.ContentSlideShow(elem, {contentLayout_runtime:'loose',event:'click',deactivationEvent:'mouseout_both',autoPlay:false,displayInterval:3000,transitionStyle:'fading',transitionDuration:500,hideAllContentsFirst:true,shuffle:false,enableSwipe:true,resumeAutoplay:true,resumeAutoplayInterval:3000,playOnce:false,autoActivate_runtime:false}); });/* #pamphletu14979 */
Muse.Utils.initWidget('#pamphletu14994', function(elem) { new WebPro.Widget.ContentSlideShow(elem, {contentLayout_runtime:'loose',event:'click',deactivationEvent:'mouseout_both',autoPlay:false,displayInterval:3000,transitionStyle:'fading',transitionDuration:500,hideAllContentsFirst:true,shuffle:false,enableSwipe:true,resumeAutoplay:true,resumeAutoplayInterval:3000,playOnce:false,autoActivate_runtime:false}); });/* #pamphletu14994 */
Muse.Utils.initWidget('#pamphletu21170', function(elem) { new WebPro.Widget.ContentSlideShow(elem, {contentLayout_runtime:'loose',event:'click',deactivationEvent:'mouseout_both',autoPlay:false,displayInterval:3000,transitionStyle:'fading',transitionDuration:500,hideAllContentsFirst:true,shuffle:false,enableSwipe:true,resumeAutoplay:true,resumeAutoplayInterval:3000,playOnce:false,autoActivate_runtime:false}); });/* #pamphletu21170 */
Muse.Utils.fullPage('#page');/* 100% height page */
Muse.Utils.showWidgetsWhenReady();/* body */
Muse.Utils.transformMarkupToFixBrowserProblems();/* body */
} catch(e) { if (e && 'function' == typeof e.notify) e.notify(); else Muse.Assert.fail('Error calling selector function:' + e); }});
</script>
  
  <!--HTML Widget code-->
  
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<script type="text/javascript">
     window.___gcfg = {
        lang: 'fr'
      };

      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
</script>
	<?php
	}
	else {
		echo "<script>alert(\"Erreur de connexion ...\")</script>";
		echo '<meta http-equiv="refresh" content="0;URL=AdminLogin.php">';
	}
	?>
   </body>
</html>