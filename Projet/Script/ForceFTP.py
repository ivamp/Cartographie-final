#!/usr/bin/python
import sys, re, os
from ftplib import FTP
from connection import execute
# ------------------------------------ Fonctions-----------------------------
def ListeDossier():
	l = []
	ftp.retrlines('LIST', l.append)
#	print "<html>"
#       print "<h5><b>Liste des Dossiers / Fichiers </b></h5>"
	for i in l:
#		print "<p>"+i+"</p>"
		fResult.write(i)
		fResult.write("\n")

#def AffichageHTML(ban, anonyme,login, password):
#	print "<html>"
#	print "<p>---------------------------------------------------</p>"
#	print	"<h5><b>Informations FTP</b></h5>"
#	print 	"<p>Banierre : "+ban+"<br>"
#	print "Connexion anonyme : "+anonyme+"<br>"
#	print "Login : "+login+" <br>"
#	print "Mot de passe : "+password+"</p>"
#	print "<a href=Projet/Script/result.txt>Liste dans un fichie texte</a>"
#	print "<p>"+ListeDossier()+"</p>"
#	print "<a href=/html/Projet/Script/result.txt>Liste dans un fichie texte</a>"
#	print "</html>"

def InsertionBase(AddIP,Banniere,login,Password,anonyme,fichier):
	req ="INSERT INTO FTP VALUES ('"+AddIP+"','"+Banniere+"','"+login+"','"+Password+"','"+anonyme+"','"+fichier+"');"
	execute(req)
	if anonyme=="oui":
		req2="INSERT INTO Alerte VALUES ('','"+AddIP+"','FTP anonyme','0');"
	if anonyme=="non":
		req2="INSERT INTO Alerte VALUES ('','"+AddIP+"','FTP BruteForce Possible','0');"	
	execute(req2)
# ---------------------------------Programme Principal ----------------------
ip = sys.argv[1]
ftp = FTP(ip)
fLogin=open("login.txt","r")
fResult=open("result.txt","w")
fichier="result.txt"
ban=ftp.getwelcome()
anonyme="non"
# -----Connexion anonyme-------
try:
	ftp.login()
	anonyme="oui"
	login="/"
	password="/"
	InsertionBase(ip,ban,login,password,anonyme,fichier)
	ListeDossier()
	AffichageHTML(ban,anonyme,login,password)
	exit()

except Exception:
	i=0

# ----- Brute Force FTP ------
for login in fLogin:
	fPass=open("passwords.txt","r")
	for password in fPass :
		try:
			password=password.strip()
			login=login.strip()
			ftp.login(login,password)
			InsertionBase(ip,ban,login,password,anonyme,fichier)
			ListeDossier()
			AffichageHTML(ban,anonyme,login,password)	
			exit()
		
		except Exception, e:
			i=0
	fPass.close()	
fLogin.close()

#----------------------------------Fin du programme---------------------------
