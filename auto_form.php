<?php //Wurde aus jeder einzelnen Funktion herausgelöst und als eine für alle anderen funktionen benutzbare Funktion
// erstellt, um eine Datenbankverbindung (PDO -Objekt) zu erhalten bzw. zurückzugeben.
function getDBConnection(): PDO
{
    // Das Objekt benoetigt den der Ort der DBMS, den DBname, Username, Passwort.
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "auto_240617";
    // gibt ein Objekt der Klasse PDO zurück
    return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
}

function readAutoArray(): array //veraltete version des returns (zum nachlesen)
{
    //$dbcon = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); //Alte Methode
    $dbcon = getDBConnection();

    $stmt_read = "Select * from auto"; // Unsere "Normale" (all) abfrage an die Datenbank

    // Erstellen ein PDOStatment Objekt und teilen es mit einen SQL Befehl an die Datenbank zu senden
    $request = $dbcon->prepare($stmt_read);
    // Schicke den Befehl ab
    $request->execute();
    // Wir holen uns die Antwort
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    //Geben unsere Variable (in dem Fall ein Assoziatives Array) zurück
    return $result;
}

function readColorArray(): array //neuere variante (inline return)
{
    $dbcon = getDBConnection();

    $stmt_read = "Select * from color"; // Unsere "Normale" (all) abfrage an die Datenbank

    // Erstellen ein PDOStatment Objekt und teilen es mit einen SQL Befehl an die Datenbank zu senden
    $request = $dbcon->prepare($stmt_read);
    // Schicke den Befehl ab
    $request->execute();
    // Wir holen uns die Antwort
    return $request->fetchAll(PDO::FETCH_ASSOC);
    //Geben unsere Variable (in dem Fall ein Assoziatives Array) zurück
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto kaufen!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input, select {
            width: 90%;
            max-width: 250px;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .checkbox-group, .radio-group {
            display: flex;
            flex-direction: column;
        }

        .submit-btn {
            width: 100%;
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 15px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        .submit-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Auto kaufen</h2>
    <form action="auto_beamter.php" method="get">
        <label for="fname">Vorname:</label>
        <input id="fname" type="text" name="fname" required>

        <label for="lname">Nachname:</label>
        <input id="lname" type="text" name="lname" required>

        <label for="colors">Farbe:</label>
        <select id="colors" name="color">
            <?php
            $farbenarray = readColorArray(); // liest die tabelle farbe (color) aus und gibt uns ein farbarray zurück

            foreach ($farbenarray as $color) {
                echo "<option style = background-color:{$color['hexcode']} value = {$color['hexcode']}>{$color['name']}</option>";
                //erstellt je nach menge in der Datenbank optionen für die Farbauswahl in unserem Drop-Down Menu und färbt die auswahl
                //im hintergrund entsprechend der farbe ein (inline css)
            }
            ?>
        </select>

        <label>Extras:</label>
        <div class="checkbox-group">
            <input id="aus_1" type="checkbox" name="aus[]" value="abs"> <label for="aus_1">ABS</label>
            <input id="aus_2" type="checkbox" name="aus[]" value="klima"> <label for="aus_2">Klima</label>
            <input id="aus_3" type="checkbox" name="aus[]" value="airbag"> <label for="aus_3">Airbag</label>
        </div>

        <label for="marke">Marke:</label>
        <select id="marke" name="marke">
            <?php
            $markenarray = readAutoArray(); // liest die tabelle Auto aus und gibt uns ein Assoziatives array mit den Daten der Autos zurück

            for ($i = 0; $i < count($markenarray); $i++) {
                //echo "<option value='" . $markenarray[$i]["hersteller"] . "'>" . $markenarray[$i]["hersteller"] . "</option>";
                echo "<option value='{$markenarray[$i]['hersteller']}'>{$markenarray[$i]['hersteller']}</option>";
                //Generiert hier per for-loop ein DropDownmenu, sortiert bzw. selektiert nach HerstellerName

                // NOTE: Die {}-Klammern im HTML-Teil (innerhalb von PHP) ermöglichen die direkte Ausgabe von PHP-Variablen.
            }
            ?>
        </select>

        <button type="submit" class="submit-btn">Bestellen</button>
    </form>
</div>
</body>
</html>
