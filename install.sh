#!/bin/bash

echo "Installation des prerequis"
apt-get update

echo "Faut-il installer apache2? y/n "
read response1
if [ "$response1" == 'y' ];
then
	apt-get install -y apache2
else
	""
fi
echo "Faut-il installer mysql-server ? y/n"
read response2
if [ "$response2" == 'y' ];
then
	apt-get install -y mysql-server
else
	""
fi
echo "Faut-il installer phpmyadmin ? y/n"
read response3
if [ "$response3" == 'y' ]
then
	apt-get install -y phpmyadmin
else
	""
fi
apt-get install -y nmap

apt-get install -y libmysqlclient-dev

echo "saisir nom utilisateur de la base de donnee"
read name
echo "saisir mot de passe base de donnee"
read -s mdp

mysql --verbose --batch --host=localhost --user="$name" --password="$mdp" --execute="CREATE DATABASE Projet;"
mysql --user="$name" --password="$mdp" --use="projet" < database.sql

bash cartographie.sh

