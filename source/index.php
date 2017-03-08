<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style_default.css" /> 
    <title>Compteur du Gase</title>
  </head>

  <body>
    <?php include 'menu.php'; ?>

    <?php require("fonctions_bd_gase.php"); ?>
    <?php require("inde_fonctionsSTK.php"); ?>
    <div class="notification_alert_stock">
      <?php $alert_list = getReferencesWithStockAlert();
	    if (count($alert_list) > 0){
      echo "<strong>Alerte Stock ! </strong><a href=\"alertesStock.php\">détail</a>";
      }
      ?>
    </div>
    <div style="text-align:center">
      <h3>BIENVENUE SUR LE COMPTEUR DU GASE</h3>
    </div>
      <br/>
      <br/>
      <br/>
      <br/>
    <div style="margin-left:30px">
      Pour laisser un message, cliquer sur "JOURNAL DE BORD" dans le menu.
    </div>
      <br/>
      <br/>
      <br/>
      <?php
	 $listeMessages = SelectionListeMessages();
	 if(count($listeMessages) > 0)
      {
      ?>
      <table style="margin-left:30px;">
      	<tr>
	  <td><label class="colonne1"><center><strong>DATE</strong></center></label></td>
	  <td><label class="colonne2"><center><strong>MESSAGE</strong></center></label></td>
	</tr>
	<?php	
	   foreach($listeMessages as $message)
	   {
	   ?>
	<tr>
	  <td><label class="colonne1"><center><strong><?php echo $message['DATE']; ?></strong></center></label></td>
	  <td><label class="colonne2"><?php echo stripslashes($message['MESSAGE']); ?></label></td>
	</tr>
	<?php
	   }
	   ?>
      </table>
      <?php
	 }
	 ?>
  </body>
</html>
