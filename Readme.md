To reset the tables :
mysql -u root -proot < reset_tables.mysql


Installation :

1 - Installer les paquets ubuntu : apache mysql php php-mysql libapache2-mod-php
	(noter le mot de passe root que vous donnez, par exemple root)

2 - Placer le dossier "gase-web" contenant les sources dans /var/www/html

3 - Créer les tables dans la base de données. Dans un terminal :
	cd /var/www/html/gase-web
	mysql -u root -proot < reset_tables.mysql  (Rq : il n'y a pas d'espace entre le -p et le mot de passe root)

4 - Configurer correctement le fichier config.ini. Ça doit ressembler à :
	[DB]
	address = localhost
	user = root
	password = root
	name = gasedechips
	prefix = _inde_

5 - Aller sur http://localhost/gase/source/ et vérifier que ça roule.

6 - Mettre en place des backups.
