#!usr/bin/env python

import requests,sys, os
from connection import execute

site = sys.argv[1]

r = requests.options("http://"+site)


Banniere=r.headers['server']
date=r.headers['date']
methode=r.headers['allow']
#vary=r.headers['vary']
#PHP=os.popen("nikto -h "+site+" | grep PHP | cut -d ':' -f2").read()


req="INSERT INTO HTTP VALUES ('"+site+"','"+Banniere+"','"+date+"','"+methode+"');"

execute(req)
