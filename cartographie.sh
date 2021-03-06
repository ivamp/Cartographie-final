#/bin/bash
echo "---------------------------------------------------------------------"
echo "Projet CDAISI : CARTOGRAPHIE RESEAU"
echo -e "Auteur : Lucas Benjaben, Hami Santa Cruz, Anthony Piesset \nSarah Elouad, Remi Chambolle"
echo "---------------------------------------------------------------------"
echo -e "Plage d'adresse IP à scanner + Masque (exemple :192.168.1.0/24)"
read plageIP
mkdir temp
echo "">temp/requete.sql
# Liste des IP actives
nmap -sP $plageIP | grep -Eo '[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}' > temp/ipactives.txt
NbLigne=$(cat temp/ipactives.txt | wc -l)
attente=$(($NbLigne*2))
compteur=0
echo "********************************************"
echo " Temps de scan estimé : $NbLigne / $attente minutes  *"
echo "************* Demarrage ********************"
# Parcours du fichier des IP actives
while read ligne
do
	# Pourcentage
	pourcentage=$(($compteur*100 / $NbLigne))
	echo "$pourcentage % "
	# Scan de l'IP
	nmap -O $ligne > temp/$ligne.txt

	#Recuperation de l'adresse MAC
	mac=$(cat temp/$ligne.txt | grep -Eo "([0-9a-fA-F]{2}:){5}[0-9a-fA-F]{2}")

	#Recuperation de l'os
	os=$(cat temp/$ligne.txt | grep Running: | cut -d ':' -f2)

	# Recuperation du nom 
	name=$( nslookup $ligne | grep name | cut -d '=' -f2)

	# Recuperation des Ports et Service + determination du type
	sed -i -e "s/ open/ open;/g" temp/$ligne.txt
	type=2
	#Parcours du fichier contenant les ports
	cat temp/$ligne.txt | grep tcp | cut -d ';' -f2 > temp/ListeService.txt
        cat temp/$ligne.txt | grep tcp | cut -d '/' -f1 >temp/ListePort.txt
        x=1


	while read port
        do
		leService=$(head -n $x temp/ListeService.txt | tail -n 1)
		ServPort=$(cat PortServeur.txt | grep $port | wc -w)
		#echo $ServPort
		if [ $ServPort -gt 0 ]
		then
			type=1
			#echo "$ligne sera classé en serveur car le port $port est ouvert"

		fi

		echo -e "INSERT INTO Resultat_Scan(ip, port, service, version_service, statut) VALUES ('$ligne','$port','$leService','?', 'open');" >> temp/requete.sql
		((x++))
 	done < temp/ListePort.txt

	#Preparation de la requete
	echo -e "INSERT INTO Liste_Machine(id, ip, mac, os, nom_machine, type) VALUES ('','$ligne','$mac','$os', '$name', '$type');" >> temp/requete.sql
#	y=1
#	while read system
#	do
#
#		osListe=$(head -n $y peripherique.txt | tail -n 1)
#		echo "if $os ==  $osListe"
#		if [ $os=!" " && $os==$osListe]
#		then
#		type=3
#		echo "ROUTEUR CAR : $os"
#		#echo -e "UPDATE Liste_Machine set type=$type WHERE ip = '$ligne';" >> temp/requete-port.sql
#		fi
#	((y++))
#	done < peripherique.txt

	#Incrementation du compteur Temps
	((compteur++))
done < temp/ipactives.txt
echo "99%"
echo "Finalisation : Cette étape peut durer quelques  minutes"
#Determination des routeur
traceroute google.fr > temp/traceroute.txt
echo $routeur
routeur=$(cat temp/traceroute.txt | head -n 2 | tail -1 | cut -d '(' -f2 | cut -d ')' -f1)
echo -e "UPDATE Liste_Machine set type=3 WHERE ip = '$routeur'" >> temp/requete.sql

#Insertion en base de donnees
mysql  -u root --password=cdaisi Projet < temp/requete.sql
echo "100%"
#Suppression des fichiers temporaires
rm -r temp
echo "************* Scan Fini ********************"
echo " *      Merci de lancer votre navigateur    *"
echo "********************************************"
