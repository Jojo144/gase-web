
### 1. Installer Ubuntu/Debian (Xubuntu Ubuntu Gnome)
Préferer une version LTS

http://www.ubuntu.com/download/desktop

### 2. Installer LAMP
Par exemple, pour Ubuntu 16.04 :

`sudo apt install apache2 php mysql-server libapache2-mod-php php-mysql`

https://doc.ubuntu-fr.org/lamp

(Notez le mot de passe root que vous donnez lors de l'installation de mysql.)
   
### 3. Copier le dossier du projet
- Télécharger les sources depuis GitHub

- Renommer les dossier contenant les sources en "gase" et le placer dans /var/www/html :

`sudo cp -r gase-web /var/www/html/gase `

- Et redoner les bonnes permissions (remplacer USER par le nom d'utilisateur Ubuntu) :

`sudo chown -R USER:USER /var/www/html/gase`

### 4 - Configurer correctement le fichier config.ini. Ça doit ressembler à :
```
[DB]
address = localhost             ; pour utilisation du logiciel en local
user = root 			; utilisateur Mysql
password = MOTDEPASSEMYSQL	; mot de passe utilisateur Mysql
name = gase			; nom de la base de donnée (gase convient très bien)
```
	
### 5 - Créer les tables dans la base de données.
Dans un terminal :

`cd /var/www/html/gase`

`./restore_backup.sh`

### 6 - Aller sur http://localhost/gase/source/ et vérifier que ça roule.
    

### 7. Backup
set config file path in backup_script.sh

http://www.thegeekstuff.com/2011/05/anacron-examples/ for anacron
    
### 8. Setup email send
