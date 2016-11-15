<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style_default.css" /> 
    <title>Bienvenue au Gase de Chips</title>
  </head>

  <body>
    <?php include 'inde_menu.php'; ?>

    <?php require("fonctions_bd_gase.php"); ?>
    <?php require("inde_fonctionsSTK.php"); ?>
    <div class="notification_alert_stock">
      <?php $alert_list = getReferencesWithStockAlert();
	    if (count($alert_list) > 0){
      echo "<strong>Alerte Stock ! </strong><a href=\"stock_alert_list.php\">détail</a>";
      }
      ?>
    </div>
    <div style="text-align:center">
      <h3>JOURNAL DE BORD DU GASE DE CHIPS</h3>
      <br/>
      Pour laisser un message, cliquer sur "JOURNAL DE BORD" dans le menu.
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
    </div>		
  </body>
</html>
