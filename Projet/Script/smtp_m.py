#!/usr/bin/python

import smtplib,sys
from connection import execute

ip = sys.argv[1]

Moi = ''
Sujet = 'smtplib'
Message = 'envoie mail python smtplib'

#configuration mail

expediteur = ''

# Configuration du serveur de mail
server = smtplib.SMTP(ip)

# Corps du message

BODY = '\r\n'.join([
	'Moi: %s' % Moi,
	'expediteur: %s' % expediteur,
	'Sujet: %s' % Sujet,
	' ',
	Message
	])

# connection
try:
	server.sendmail(expediteur, [Moi], BODY)
	req="INSERT INTO Alerte VALUES ('','"+ip+"','SMTP ouvert','0');"
	execute(req)	
except:
	i=0

server.close()
	
