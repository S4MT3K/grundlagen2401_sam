<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'auto_240617';

// Erstellen ein Objekt der Klasse PDO
// Das Objekt benötigt den Ort der DBMS, den Datenbank namen, username und Passwort
$dbcon = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
// Erstelle einen String in SQL Befehl Form
$sql = "Select * from auto";
// Erstellen ein PDOStatment Objekt und teilen es mit einen SQL Befehl an die Datenbank zu senden
$fragedieDB = $dbcon->prepare($sql);
// Schicke den Befehl ab
$fragedieDB->execute();
// Wir holen uns die Antwort
$antwort = $fragedieDB->fetchAll(PDO::FETCH_ASSOC);

var_dump($antwort);




