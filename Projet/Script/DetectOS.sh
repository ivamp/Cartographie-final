#!/bin/bash
ttl=$(ping $1 -c 1 | grep ttl | cut -d '=' -f3 | cut -d ' ' -f1)
if [[ ttl -eq 64 ]]
then
	os="Linux"
elif [[ ttl -eq 128 ]]
then 
	os="Windows"
elif [[ ttl -eq 255 ]]
then 
        os="Cisco"

else
	os="Unknow"

fi
echo -e "UPDATE Liste_Machine SET os='"$os"'WHERE ip='"$1"';" >> UpdateRequete.sql
mysql  -u root --password=cdaisi Projet < UpdateRequete.sql
rm UpdateRequete.sql
