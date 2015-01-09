#!/usr/bin/bash
transfertDNS() {
    mkdir tempDNS
    fierce -dns $1>tempDNS/transferDNS.txt 2>> /dev/nul
 
 #vérification reussite transfer de zone DNS
    DNStest=`cat tempDNS/transferDNS.txt|grep -P "Unsuccessful"`
    if [ -z "$DNStest" ]
    then
        #extraction de la list d'IP
	cat tempDNS/transferDNS.txt | grep -Po '([0-9]{1,3}\.){3}[0-9]{1,3}'|sort|uniq>tempDNS/IPs.txt
	#affichage du resultat du nombre d'ip trouvées
	nb=$(echo -e "\n\t`cat tempDNS/IPs.txt|wc -l` IPs trouvées \n")
        echo -e "INSERT INTO Alerte VALUES ('','$1','"Transfert de zone DNS possible : "$nb""',0);" >> tempDNS/requete.sql
        mysql  -u root --password=cdaisi Projet < tempDNS/requete.sql
    else
        echo "    transfer de zone DNS:    echec"
    fi
 
	}

transfertDNS
rm -r tempDNS
