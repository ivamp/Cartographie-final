<?php

$serveur='localhost';	
$user='root';	
$mdp='cdaisi';	
$base='Projet';	

try {
	$connexion=new PDO('mysql:host='.$serveur.';dbname='.$base.'',''.$user.'',''.$mdp.'');
        $connexion->exec("SET CHARACTER SET utf8");
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
}
catch (PDOException $e){
	echo "erreur de type : " . $e->getMessage() . "<br/>";
	die();
}

?>
