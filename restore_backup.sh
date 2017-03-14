#!/bin/bash

#extract db details from config.ini file
#!!! path to config.ini file should be ABSOLUTE
config_file_path="/var/www/html/gase/config.ini"


################
db_user=$(awk -F " = " '/^user/ {print $2}' $config_file_path)
db_pass=$(awk -F " = " '/^password/ {print $2}' $config_file_path)
db_name=$(awk -F " = " '/^name/ {print $2}' $config_file_path)

# Si appelé sans argument : remise à zéro des tables
if [ $# = 0 ]; then
    #toto changer gasedechips en $db_name
    echo "DROP DATABASE IF EXISTS $db_name; CREATE DATABASE $db_name DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci; USE $db_name;" | mysql -u $db_user -p$db_pass
    mysql -u $db_user -p$db_pass  $db_name < reset_tables.mysql
else
    mysql -u $db_user -p$db_pass $db_name < $1
fi
