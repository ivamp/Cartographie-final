import MySQLdb
db = MySQLdb.connect("localhost", "root", "cdaisi", "Projet")

def execute(req):
	db = MySQLdb.connect("localhost", "root", "cdaisi", "Projet")
	cursor = db.cursor()
	response = cursor.execute(req)
	db.commit()
	db.close()
	return response
