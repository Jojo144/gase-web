# Le compteur du GASE

Logiciel de gestion de GASE ou d'épicerie associative.

Attention : stade expérimental. Testé principalement avec l'option "use_mail = false".




## Installation

1 - Installer les paquets ubuntu : apache mysql php php-mysql libapache2-mod-php
	(notez le mot de passe root que vous donnez lors de l'installation de mysql, par exemple root)

2 - Renommer les dossier contenant les sources en "gase" et le placer dans /var/www/html:
	sudo cp -r gase-web /var/www/html/gase 
    Et redoner les bonnes permissions (remplacer USER par le nom d'utilisateur Ubuntu):
	sudo chown -R USER:USER /var/www/html/gase

3 - Configurer correctement le fichier config.ini. Ça doit ressembler à :
	[DB]
	address = localhost
	user = root
	password = MOTDEPASSEMYSQL
	name = gase

4 - Créer les tables dans la base de données. Dans un terminal :
	cd /var/www/html/gase
	./restore_backup.sh

5 - Aller sur http://localhost/gase/source/ et vérifier que ça roule.

6 - Mettre en place des backups.


## Divers

Pour remettre les tables à zéro :
./restore_backup.sh

Pour restaurer un backup:
./restore_backup.sh MONBACKUP.sql
