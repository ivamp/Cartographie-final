#!/bin/bash

airmon-ng start wlan0

airodump-ng  -w fichier --output-format csv mon0 &  > /dev/null 2>/dev/null

sleep 5

pkill airodump

cat fichier-01.csv | awk -F"," '{print $1,$6,$14}' > sortie.txt

numLigne=$(cat sortie.txt | grep "Station" -n | cut -d ':' -f1)
numLigne=$(($numLigne-2))
numLigne2=$(($numLigne-2))
clear
head sortie.txt -n $numLigne | tail -n $numLigne2 > cartoWifi.txt
cat cartoWifi.txt | awk -F " " '{print $1,";",$2,";",$3}' >> traitementRequete.txt
while read ligne
do
	echo $ligne
	mac=$(echo $ligne | cut -d ';' -f1)
	secu=$(echo $ligne | cut -d ';' -f2)
	essid=$(echo $ligne | cut -d ';' -f3)
	echo $mac
	echo "INSERT INTO Wifi VALUES ('$mac','$essid','$secu');">>requete.sql 
done < traitementRequete.txt
airmon-ng stop mon0 > /dev/null
mysql  -u root --password=Adegpr47 Projet < requete.sql
rm requete.sql traitementRequete.txt sortie.txt cartoWifi.txt
