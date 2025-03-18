<?php

$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'auto_240617';

// Erstellen ein Objekt der Klasse PDO
// Das Objekt benötigt den Ort der DBMS, den Datenbank namen, username und Passwort
$dbcon = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
// Erstelle einen String in SQL Befehl Form mit mehreren statements zur Auswahl

$stmt_create = "insert into auto (hersteller, name, ps, farbe, baujahr) values('Porsche','Cayenne RS',9000,'Durchsichtig Metallic', 1746)"; //Wird einene Datenbank Eintrag erstellen (mit gegebenen parametern)
$stmt_read   = "Select * from auto"; // Unsere "Normale" (all) abfrage an die Datenbank
$stmt_update = "UPDATE auto SET ps = 110 where hersteller = 'vw'"; // Wird ein Eintrag in unserer Datenbank zu unseren bedingungen ändern
$stmt_delete = "DELETE FROM auto where ps = 9000"; // Löscht einen Eintrag aus der Datenbank heraus.s



//AUFGABE: SCHREIBT DIE STATEMENTS PASSEND ZU IHREM NAMEN SO UM, DASS;

//1. Der VW 110 PS HAT
//2. EIN NEUES FAHRZEUG EURER WAHL HINZUGEFÜGT WIRD.
//3. EUER FAHRZEUG WIEDER GELÖSCHT WERDEN KANN!

// Erstellen ein PDOStatment Objekt und teilen es mit einen SQL Befehl an die Datenbank zu senden
$request = $dbcon->prepare($stmt_read);
// Schicke den Befehl ab
$request->execute();
// Wir holen uns die Antwort
$result = $request->fetchAll(PDO::FETCH_ASSOC);

//print_r($result);
//var_dump($antwort);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

<pre>
<?php  print_r($result);
?>
</pre>

</body>
</html>


