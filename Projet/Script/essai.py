#!/usr/bin/python
import sys
from ftplib import FTP



ip = sys.argv[1]
ftp = FTP(ip)
fLogin=open("login.txt","r")
fResult=open("result.txt","w")

print "Essai"
print ip
