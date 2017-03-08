<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_form.css" /> 
		<title>ARCHIVES</title>
    </head>

    <body>
		<?php include 'inde_menu.php'; ?>

		<div style="text-align:center">
			<br />
			<br />
			BIENVENUE DANS L OUTIL D ARCHIVAGE DE FICHIERS .pdf, .doc ou .xls
			<br />
			<br />
			VEUILLEZ INDIQUER LE TYPE DE DOCUMENT A ARCHIVER.
			<?php
			require("inde_fonctionsDOCU.php");
			$listeTypesDoc = SelectionListeTypesDoc();
			?>
			
			<form id="formulaire" method="post" action="nouveauDocument.php">
				<div>
					<select name="idType" id="idType" onchange="this.form.submit()">
						<option value=""></option>
						<?php	
						foreach($listeTypesDoc as $cle => $element)
						{
							?>
							<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
							<?php
						}
						?>
					</select>
				</div>
			</form>
		</div>
	</body>
</html>
