#!/bin/bash

# Ce script restaure un backup (exemple : ./restore_backup.sh MONBACKUP.sql)
# en utilisant la configuration de la BD donnée le fichier config.ini.
# Si aucun argument n'est donné au script, alors il réinitialise la base.

# TODO : rattraper les erreurs (au moins ne pas dire "c'est fait !")


#extract db details from config.ini file
config_file_path="./config.ini"

db_user=$(awk -F " = " '/^user/ {print $2}' $config_file_path)
db_pass=$(awk -F " = " '/^password/ {print $2}' $config_file_path)
db_name=$(awk -F " = " '/^name/ {print $2}' $config_file_path)



# Si appelé sans argument : remise à zéro des tables
if [ $# = 0 ]; then
    read -r -p "Ce script va remettre à zéro la base $db_name. Voulez-vous continuer ? [y/N] " response
    if [[ "$response" =~ ^([yY][eE][sS]|[yY])+$ ]]
    then
	mysql -u $db_user -p$db_pass -e "DROP DATABASE IF EXISTS $db_name; CREATE DATABASE $db_name DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci; USE $db_name;" 2>&1 | grep -v "Using a password"
	mysql -u $db_user -p$db_pass $db_name < reset_tables.mysql 2>&1 | grep -v "Using a password"
	echo "C'est fait !"
    else
	echo "Abort."
    fi
else
    read -r -p "Ce script va restaurer le backup $1 sur la base $db_name. Voulez-vous continuer ? [y/N] " response
    if [[ "$response" =~ ^([yY][eE][sS]|[yY])+$ ]]
    then
	mysql -u $db_user -p$db_pass $db_name < $1 2>&1 | grep -v "Using a password"
	echo "C'est fait !"
    else
	echo "Abort."
    fi
fi
